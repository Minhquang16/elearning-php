<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// ==== CHỈ CHO ADMIN TRUY CẬP ====
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

// Thư mục upload (tương đối so với root project)
$uploadDir      = __DIR__ . '/../uploads/IMAGE/';
$uploadUrlBase  = 'uploads/IMAGE/'; // lưu vào DB

$errors   = [];
$success  = '';
$editingCourse = null;

// ==== XỬ LÝ POST (CREATE / UPDATE / DELETE) ====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // XÓA KHÓA HỌC
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $stmt = $db->prepare("DELETE FROM courses WHERE id = ?");
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                $success = "Đã xóa khóa học #{$id}.";
            } else {
                $errors[] = "Không thể xóa khóa học.";
            }
        }
    }

    // THÊM / SỬA KHÓA HỌC
    if ($action === 'create' || $action === 'update') {
        $id          = (int)($_POST['id'] ?? 0);
        $title       = trim($_POST['title'] ?? '');
        $category    = trim($_POST['category'] ?? '');
        $duration    = trim($_POST['duration'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $teacherName = trim($_POST['teacher_name'] ?? '');
        $oldPrice    = $_POST['old_price'] === '' ? null : (float)$_POST['old_price'];
        $curPrice    = $_POST['current_price'] === '' ? null : (float)$_POST['current_price'];
        $isActive    = isset($_POST['is_active']) ? 1 : 0;

        // Lấy đường dẫn cũ để update
        $imageUrl       = $_POST['current_image_url']       ?? '';
        $teacherAvatar  = $_POST['current_teacher_avatar']  ?? '';

        // Validate cơ bản
        if ($title === '') {
            $errors[] = 'Title không được để trống.';
        }
        if ($curPrice === null) {
            $errors[] = 'Current price không được để trống.';
        }

        // Xử lý upload ảnh khóa học
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $ext      = pathinfo($_FILES['image_url']['name'], PATHINFO_EXTENSION);
            $fileName = 'course_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
            $target   = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $target)) {
                $imageUrl = $uploadUrlBase . $fileName;
            } else {
                $errors[] = 'Upload ảnh khóa học thất bại.';
            }
        }

        // Xử lý upload avatar giảng viên
        if (isset($_FILES['teacher_avatar']) && $_FILES['teacher_avatar']['error'] === UPLOAD_ERR_OK) {
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $ext      = pathinfo($_FILES['teacher_avatar']['name'], PATHINFO_EXTENSION);
            $fileName = 'teacher_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
            $target   = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['teacher_avatar']['tmp_name'], $target)) {
                $teacherAvatar = $uploadUrlBase . $fileName;
            } else {
                $errors[] = 'Upload avatar giảng viên thất bại.';
            }
        }

        // Nếu không có lỗi -> insert / update
        if (empty($errors)) {
            if ($action === 'create') {
                $sql = "INSERT INTO courses
                        (title, category, duration, description,
                         image_url, teacher_name, teacher_avatar,
                         old_price, current_price, is_active, created_at)
                        VALUES (?,?,?,?,?,?,?,?,?,?,NOW())";
                $stmt = $db->prepare($sql);
                $stmt->bind_param(
                    'sssssssdii',
                    $title,
                    $category,
                    $duration,
                    $description,
                    $imageUrl,
                    $teacherName,
                    $teacherAvatar,
                    $oldPrice,
                    $curPrice,
                    $isActive
                );
                if ($stmt->execute()) {
                    $success = 'Đã tạo khóa học mới thành công.';
                } else {
                    $errors[] = 'Không thể tạo khóa học.';
                }
            } else { // update
                $sql = "UPDATE courses
                        SET title = ?, category = ?, duration = ?, description = ?,
                            image_url = ?, teacher_name = ?, teacher_avatar = ?,
                            old_price = ?, current_price = ?, is_active = ?
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param(
                    'sssssssdiii',
                    $title,
                    $category,
                    $duration,
                    $description,
                    $imageUrl,
                    $teacherName,
                    $teacherAvatar,
                    $oldPrice,
                    $curPrice,
                    $isActive,
                    $id
                );
                if ($stmt->execute()) {
                    $success = "Đã cập nhật khóa học #{$id}.";
                } else {
                    $errors[] = 'Không thể cập nhật khóa học.';
                }
            }
        }
    }
}

// ==== LẤY DỮ LIỆU LẤY LIST + FORM EDIT ====

// Lấy thông tin để edit nếu có ?edit=
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    if ($editId > 0) {
        $stmt = $db->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->bind_param('i', $editId);
        $stmt->execute();
        $editingCourse = $stmt->get_result()->fetch_assoc();
    }
}

// Lọc / tìm kiếm
$search = trim($_GET['q'] ?? '');
$courses = [];

if ($search !== '') {
    $like = '%' . $search . '%';
    $sql  = "SELECT * FROM courses
             WHERE title LIKE ? OR category LIKE ?
             ORDER BY created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ss', $like, $like);
    $stmt->execute();
    $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $sql  = "SELECT * FROM courses ORDER BY created_at DESC";
    $res  = $db->query($sql);
    if ($res) {
        $courses = $res->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Manage Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/CSS/base.css">
    <style>
        :root{
            --ink:#1f2340;
            --muted:#7b81a5;
            --accent:#09c3c8;
            --accent-soft:#e5fafb;
            --danger:#ff4d6a;
            --bg:#f4f6ff;
            --card:#ffffff;
            --line:#e1e6ff;
        }
        body{
            margin:0;
            font-family: "Roboto", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:var(--bg);
            color:var(--ink);
        }
        .layout{
            display:grid;
            grid-template-columns: 240px 1fr;
            min-height:100vh;
        }
        .sidebar{
            background:#10132f;
            color:#fff;
            padding:20px 18px;
            display:flex;
            flex-direction:column;
            gap:24px;
        }
        .sidebar__brand{
            display:flex;
            align-items:center;
            gap:10px;
            font-weight:700;
            font-size:18px;
        }
        .sidebar__brand-icon{
            width:32px;
            height:32px;
            border-radius:50%;
            display:grid;
            place-items:center;
            background:linear-gradient(135deg,#0ee3f0,#09c3c8);
            color:#fff;
        }
        .sidebar__menu{
            margin-top:10px;
            display:flex;
            flex-direction:column;
            gap:8px;
        }
        .sidebar__link{
            display:flex;
            align-items:center;
            gap:10px;
            padding:9px 10px;
            border-radius:10px;
            font-size:14px;
            color:#d4ddff;
            text-decoration:none;
        }
        .sidebar__link:hover{
            background:rgba(255,255,255,.07);
        }
        .sidebar__link--active{
            background:#fff;
            color:#10132f;
        }
        .sidebar__footer{
            margin-top:auto;
            font-size:12px;
            color:#757bb0;
        }

        .main{
            padding:20px 26px 40px;
        }
        .main__header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }
        .main__title{
            font-size:22px;
            font-weight:700;
        }
        .main__subtitle{
            font-size:13px;
            color:var(--muted);
        }
        .admin-user{
            display:flex;
            align-items:center;
            gap:10px;
        }
        .admin-user__avatar{
            width:34px;
            height:34px;
            border-radius:50%;
            object-fit:cover;
            border:2px solid rgba(9,195,200,.3);
        }
        .admin-user__name{
            font-size:13px;
            font-weight:500;
        }

        .grid{
            display:grid;
            grid-template-columns: 3fr 2fr;
            gap:20px;
            align-items:flex-start;
        }
        .card{
            background:var(--card);
            border-radius:18px;
            border:1px solid var(--line);
            box-shadow:0 16px 40px rgba(22,30,84,.04);
        }
        .card--list{padding:18px 18px 10px;}
        .card--form{padding:18px 18px 20px;}

        .card__header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:12px;
        }
        .card__title{
            font-size:16px;
            font-weight:600;
        }
        .tag{
            font-size:11px;
            padding:4px 10px;
            border-radius:999px;
            background:var(--accent-soft);
            color:#059197;
        }

        .search-bar{
            display:flex;
            gap:8px;
            margin-bottom:10px;
        }
        .input, textarea, select{
            font:inherit;
            border-radius:10px;
            border:1px solid #dbe2ff;
            padding:9px 11px;
            width:100%;
            outline:none;
            background:#f9fbff;
        }
        .input:focus, textarea:focus, select:focus{
            border-color:#9fb4ff;
            box-shadow:0 0 0 3px rgba(159,180,255,.25);
            background:#fff;
        }
        .btn{
            border:none;
            border-radius:999px;
            padding:9px 16px;
            font-size:13px;
            cursor:pointer;
            font-weight:500;
            display:inline-flex;
            align-items:center;
            gap:6px;
        }
        .btn--primary{
            background:linear-gradient(135deg,#0ee3f0,#09c3c8);
            color:#fff;
            box-shadow:0 10px 24px rgba(9,195,200,.4);
        }
        .btn--outline{
            background:#fff;
            border:1px solid #dbe2ff;
            color:#4a4f86;
        }
        .btn--danger{
            background:var(--danger);
            color:#fff;
        }
        .btn--xs{
            padding:5px 10px;
            font-size:11px;
            border-radius:999px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            font-size:13px;
        }
        th,td{
            padding:8px 6px;
            border-bottom:1px solid #edf0ff;
            vertical-align:middle;
        }
        th{
            text-align:left;
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:.06em;
            color:#8a8fb7;
        }
        tr:last-child td{
            border-bottom:none;
        }
        .course-thumb{
            width:48px;
            height:36px;
            border-radius:8px;
            object-fit:cover;
        }
        .course-title{
            font-weight:500;
        }
        .pill-status{
            padding:3px 8px;
            border-radius:999px;
            font-size:11px;
        }
        .pill-status--on{
            background:#e4fbf3;
            color:#0e9f6e;
        }
        .pill-status--off{
            background:#ffe8ef;
            color:#de365c;
        }
        .price{
            font-weight:600;
        }
        .price--old{
            text-decoration:line-through;
            color:#9ca3c8;
            font-weight:400;
            font-size:12px;
        }

        .msg{
            margin-bottom:10px;
            font-size:13px;
            padding:8px 10px;
            border-radius:10px;
        }
        .msg--success{
            background:#e4fbf3;
            color:#047857;
        }
        .msg--error{
            background:#ffe8ef;
            color:#b91c1c;
        }

        .form-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:10px 14px;
            margin-top:6px;
        }
        .form-grid .full{
            grid-column:1/-1;
        }
        label{
            font-size:12px;
            font-weight:500;
            color:#5d648f;
            margin-bottom:4px;
            display:block;
        }
        textarea{
            min-height:80px;
            resize:vertical;
        }
        .form-actions{
            margin-top:12px;
            display:flex;
            justify-content:flex-end;
            gap:8px;
        }

        @media (max-width: 1024px){
            .layout{
                grid-template-columns: 1fr;
            }
            .sidebar{
                display:none;
            }
        }
        @media (max-width: 900px){
            .grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>
<body>
<div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar__brand">
            <div class="sidebar__brand-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            Dev Alpha<br>Admin
        </div>

        <nav class="sidebar__menu">
            <a href="dashboard.php" class="sidebar__link">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
            <a href="manage_courses.php" class="sidebar__link sidebar__link--active">
                <i class="fa-solid fa-book"></i> Manage Courses
            </a>
            <a href="manage_users.php" class="sidebar__link">
                <i class="fa-solid fa-users"></i> Manage Users
            </a>
            <a href="../order.php" class="sidebar__link">
                <i class="fa-solid fa-receipt"></i> Orders
            </a>
        </nav>

        <div class="sidebar__footer">
            &copy; <?php echo date('Y'); ?> Dev Alpha
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
        <header class="main__header">
            <div>
                <div class="main__title">Manage Courses</div>
                <div class="main__subtitle">
                    Create, update and organize all courses on the platform.
                </div>
            </div>
            <div class="admin-user">
                <img src="../uploads/IMAGE/OIP.webp" class="admin-user__avatar" alt="admin">
                <div class="admin-user__name">
                    <?php echo htmlspecialchars($_SESSION['user']['username'] ?? 'Admin'); ?>
                </div>
                <a href="../controllers/AuthController.php?action=logout"
                   class="btn btn--outline btn--xs">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </header>

        <!-- Thông báo -->
        <?php if (!empty($success)): ?>
            <div class="msg msg--success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $e): ?>
                <div class="msg msg--error"><?php echo htmlspecialchars($e); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="grid">

            <!-- DANH SÁCH KHÓA HỌC -->
            <section class="card card--list">
                <div class="card__header">
                    <div class="card__title">Course List</div>
                    <span class="tag"><?php echo count($courses); ?> Courses</span>
                </div>

                <form class="search-bar" method="get">
                    <input type="text" name="q" class="input"
                           placeholder="Search by title or category..."
                           value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn--outline" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                </form>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                        <tr>
                            <th>Course</th>
                            <th>Category</th>
                            <th>Teacher</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($courses)): ?>
                            <tr>
                                <td colspan="6">No course found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($courses as $c): ?>
                                <tr>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <?php if (!empty($c['image_url'])): ?>
                                                <img src="../<?php echo htmlspecialchars($c['image_url']); ?>"
                                                     class="course-thumb" alt="">
                                            <?php else: ?>
                                                <div class="course-thumb"
                                                     style="background:#e5e9ff;display:grid;place-items:center;">
                                                    <i class="fa-solid fa-image" style="color:#9ca3c8;"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="course-title">
                                                    <?php echo htmlspecialchars($c['title']); ?>
                                                </div>
                                                <div style="font-size:11px;color:#9ca3c8;">
                                                    <?php echo htmlspecialchars($c['duration'] ?? ''); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($c['category'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($c['teacher_name'] ?? ''); ?></td>
                                    <td>
                                        <div>
                                            <?php if (!empty($c['old_price'])): ?>
                                                <span class="price--old">
                                                    $<?php echo number_format((float)$c['old_price'], 2); ?>
                                                </span><br>
                                            <?php endif; ?>
                                            <span class="price">
                                                $<?php echo number_format((float)$c['current_price'], 2); ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($c['is_active'])): ?>
                                            <span class="pill-status pill-status--on">Active</span>
                                        <?php else: ?>
                                            <span class="pill-status pill-status--off">Hidden</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align:right;">
                                        <a href="manage_courses.php?edit=<?php echo (int)$c['id']; ?>"
                                           class="btn btn--outline btn--xs">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>

                                        <form method="post" style="display:inline;"
                                              onsubmit="return confirm('Delete this course?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id"
                                                   value="<?php echo (int)$c['id']; ?>">
                                            <button class="btn btn--danger btn--xs" type="submit">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- FORM TẠO / SỬA -->
            <section class="card card--form">
                <div class="card__header">
                    <div class="card__title">
                        <?php echo $editingCourse ? 'Edit Course' : 'Create New Course'; ?>
                    </div>
                    <?php if ($editingCourse): ?>
                        <span class="tag">ID #<?php echo (int)$editingCourse['id']; ?></span>
                    <?php endif; ?>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action"
                           value="<?php echo $editingCourse ? 'update' : 'create'; ?>">
                    <input type="hidden" name="id"
                           value="<?php echo (int)($editingCourse['id'] ?? 0); ?>">
                    <input type="hidden" name="current_image_url"
                           value="<?php echo htmlspecialchars($editingCourse['image_url'] ?? ''); ?>">
                    <input type="hidden" name="current_teacher_avatar"
                           value="<?php echo htmlspecialchars($editingCourse['teacher_avatar'] ?? ''); ?>">

                    <div class="form-grid">
                        <div class="full">
                            <label for="title">Title *</label>
                            <input class="input" id="title" name="title" required
                                   value="<?php echo htmlspecialchars($editingCourse['title'] ?? ''); ?>">
                        </div>

                        <div>
                            <label for="category">Category</label>
                            <input class="input" id="category" name="category"
                                   value="<?php echo htmlspecialchars($editingCourse['category'] ?? ''); ?>">
                        </div>

                        <div>
                            <label for="duration">Duration</label>
                            <input class="input" id="duration" name="duration"
                                   placeholder="e.g. 8h 40m"
                                   value="<?php echo htmlspecialchars($editingCourse['duration'] ?? ''); ?>">
                        </div>

                        <div class="full">
                            <label for="description">Short Description</label>
                            <textarea id="description" name="description"><?php
                                echo htmlspecialchars($editingCourse['description'] ?? '');
                            ?></textarea>
                        </div>

                        <div>
                            <label for="teacher_name">Teacher name</label>
                            <input class="input" id="teacher_name" name="teacher_name"
                                   value="<?php echo htmlspecialchars($editingCourse['teacher_name'] ?? ''); ?>">
                        </div>

                        <div>
                            <label for="old_price">Old price ($)</label>
                            <input type="number" step="0.01" min="0"
                                   class="input" id="old_price" name="old_price"
                                   value="<?php echo htmlspecialchars($editingCourse['old_price'] ?? ''); ?>">
                        </div>

                        <div>
                            <label for="current_price">Current price ($) *</label>
                            <input type="number" step="0.01" min="0" required
                                   class="input" id="current_price" name="current_price"
                                   value="<?php echo htmlspecialchars($editingCourse['current_price'] ?? ''); ?>">
                        </div>

                        <div>
                            <label>&nbsp;</label>
                            <label style="display:flex;align-items:center;gap:6px;font-size:13px;">
                                <input type="checkbox" name="is_active"
                                    <?php echo !empty($editingCourse['is_active']) ? 'checked' : ''; ?>>
                                Active course
                            </label>
                        </div>

                        <div class="full">
                            <label for="image_url">Course image</label>
                            <input type="file" id="image_url" name="image_url"
                                   accept="image/*" class="input">
                            <?php if (!empty($editingCourse['image_url'])): ?>
                                <div style="margin-top:6px;font-size:12px;color:#7b81a5;">
                                    Current:
                                    <a href="../<?php echo htmlspecialchars($editingCourse['image_url']); ?>"
                                       target="_blank">View image</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="full">
                            <label for="teacher_avatar">Teacher avatar</label>
                            <input type="file" id="teacher_avatar" name="teacher_avatar"
                                   accept="image/*" class="input">
                            <?php if (!empty($editingCourse['teacher_avatar'])): ?>
                                <div style="margin-top:6px;font-size:12px;color:#7b81a5;">
                                    Current:
                                    <a href="../<?php echo htmlspecialchars($editingCourse['teacher_avatar']); ?>"
                                       target="_blank">View avatar</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <?php if ($editingCourse): ?>
                            <a href="manage_courses.php" class="btn btn--outline">
                                Cancel
                            </a>
                        <?php endif; ?>
                        <button type="submit" class="btn btn--primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <?php echo $editingCourse ? 'Save changes' : 'Create course'; ?>
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </main>
</div>
</body>
</html>
