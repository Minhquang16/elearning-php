<?php
// admin/manage_users.php
session_start();
require_once __DIR__ . '/../config/database.php';

// ==== CHỈ CHO ADMIN TRUY CẬP ====
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

$errors  = [];
$success = '';
$editingUser = null;

/* ================== XỬ LÝ POST (CREATE / UPDATE / DELETE) ================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // XÓA USER
    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);

        if ($id === (int)($_SESSION['user']['id'] ?? 0)) {
            $errors[] = 'You cannot delete your own account.';
        } elseif ($id > 0) {
            $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                $success = "User #{$id} has been deleted.";
            } else {
                $errors[] = 'Unable to delete user.';
            }
        }
    }

    // TẠO / CẬP NHẬT USER
    if ($action === 'save') {
        $id       = (int)($_POST['id'] ?? 0);
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $role     = $_POST['role'] ?? 'user';
        $password = $_POST['password'] ?? '';

        if ($username === '') {
            $errors[] = 'Username is required.';
        }
        if ($email === '') {
            $errors[] = 'Email is required.';
        }
        if (!in_array($role, ['user', 'admin'], true)) {
            $role = 'user';
        }

        if ($id === 0 && $password === '') {
            // tạo user mới bắt buộc phải có password
            $errors[] = 'Password is required when creating a new user.';
        }

        if (empty($errors)) {
            // TẠO MỚI
            if ($id === 0) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql  = "INSERT INTO users(username, email, password, role)
                         VALUES(?,?,?,?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param('ssss', $username, $email, $hash, $role);

                if ($stmt->execute()) {
                    $success = 'New user has been created.';
                } else {
                    $errors[] = 'Unable to create user (maybe username/email already exists).';
                }

            } else {
                // CẬP NHẬT
                if ($password !== '') {
                    // cập nhật cả password
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql  = "UPDATE users
                             SET username = ?, email = ?, role = ?, password = ?
                             WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('ssssi', $username, $email, $role, $hash, $id);
                } else {
                    // không đổi password
                    $sql  = "UPDATE users
                             SET username = ?, email = ?, role = ?
                             WHERE id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('sssi', $username, $email, $role, $id);
                }

                if ($stmt->execute()) {
                    $success = "User #{$id} has been updated.";
                    // nếu đang sửa chính mình và có đổi role/username/email thì update session cho đồng bộ
                    if ($id === (int)($_SESSION['user']['id'] ?? 0)) {
                        $_SESSION['user']['username'] = $username;
                        $_SESSION['user']['email']    = $email;
                        $_SESSION['user']['role']     = $role;
                    }
                } else {
                    $errors[] = 'Unable to update user.';
                }
            }
        }
    }
}

/* ================== LẤY DỮ LIỆU ĐỂ EDIT ================== */
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    if ($editId > 0) {
        $stmt = $db->prepare("SELECT id, username, email, role, created_at
                              FROM users
                              WHERE id = ?");
        $stmt->bind_param('i', $editId);
        $stmt->execute();
        $editingUser = $stmt->get_result()->fetch_assoc();
    }
}

/* ================== LẤY DANH SÁCH USER (SEARCH + FILTER) ================== */
$search     = trim($_GET['q'] ?? '');
$filterRole = $_GET['role'] ?? '';

$users = [];
$sql   = "SELECT id, username, email, role, created_at
          FROM users
          WHERE 1 ";
$params = [];
$types  = '';

if ($search !== '') {
    $sql    .= " AND (username LIKE ? OR email LIKE ?)";
    $like    = '%' . $search . '%';
    $params[] = $like;
    $params[] = $like;
    $types   .= 'ss';
}

if ($filterRole === 'user' || $filterRole === 'admin') {
    $sql     .= " AND role = ?";
    $params[] = $filterRole;
    $types   .= 's';
}

$sql .= " ORDER BY created_at DESC";

if ($types === '') {
    // không có tham số
    $res = $db->query($sql);
    if ($res) {
        $users = $res->fetch_all(MYSQLI_ASSOC);
    }
} else {
    $stmt = $db->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Tên admin hiện tại
$currentAdminName = htmlspecialchars($_SESSION['user']['username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Manage Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS chung của admin (sidebar + layout + card, button, table...) -->
    <link rel="stylesheet" href="../assets/CSS/_sidebar.css">
    <link rel="stylesheet" href="../assets/CSS/admin-manage-courses.css">

    <!-- Một ít CSS riêng cho trang user -->
    <style>
        .user-role-pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
        }
        .user-role-pill--admin {
            background: rgba(255, 99, 71, 0.12);
            color: #ff5c5c;
        }
        .user-role-pill--user {
            background: rgba(0, 198, 215, 0.12);
            color: #00a4b8;
        }
        .user-chip-id {
            font-size: 11px;
            color: #9ca3c8;
        }
        .user-created-at {
            font-size: 11px;
            color: #9ca3c8;
        }
        .form-help {
            font-size: 11px;
            color: #9ca3c8;
            margin-top: 2px;
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php
        $activePage = 'users';
        include __DIR__ . '/_sidebar.php';
    ?>

    <main class="main">
        <!-- HEADER -->
        <header class="main__header">
            <div>
                <div class="main__title">Manage Users</div>
                <div class="main__subtitle">
                    View, create and manage all accounts on the platform.
                </div>
            </div>
            <div class="admin-user">
                <img src="../uploads/IMAGE/OIP.webp" class="admin-user__avatar" alt="admin">
                <div class="admin-user__name">
                    <?php echo $currentAdminName; ?>
                </div>
                <a href="../controllers/AuthController.php?action=logout"
                   class="btn btn--outline btn--xs">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </header>

        <!-- THÔNG BÁO -->
        <?php if (!empty($success)): ?>
            <div class="msg msg--success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $e): ?>
                <div class="msg msg--error"><?php echo htmlspecialchars($e); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="grid">
            <!-- DANH SÁCH USER -->
            <section class="card card--list">
                <div class="card__header">
                    <div class="card__title">User List</div>
                    <span class="tag"><?php echo count($users); ?> Users</span>
                </div>

                <form class="search-bar" method="get">
                    <input type="text" name="q" class="input"
                           placeholder="Search by username or email..."
                           value="<?php echo htmlspecialchars($search); ?>">

                    <select name="role" class="input" style="max-width:150px;">
                        <option value="">All roles</option>
                        <option value="user" <?php echo $filterRole === 'user' ? 'selected' : ''; ?>>
                            Student (user)
                        </option>
                        <option value="admin" <?php echo $filterRole === 'admin' ? 'selected' : ''; ?>>
                            Admin
                        </option>
                    </select>

                    <button class="btn btn--outline" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </button>
                </form>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined at</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="5">No users found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td>
                                        <div class="course-title">
                                            <?php echo htmlspecialchars($u['username']); ?>
                                        </div>
                                        <div class="user-chip-id">
                                            ID #<?php echo (int)$u['id']; ?>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                                    <td>
                                        <?php if ($u['role'] === 'admin'): ?>
                                            <span class="user-role-pill user-role-pill--admin">
                                                <i class="fa-solid fa-crown" style="margin-right:5px;"></i>
                                                Admin
                                            </span>
                                        <?php else: ?>
                                            <span class="user-role-pill user-role-pill--user">
                                                <i class="fa-solid fa-user-graduate" style="margin-right:5px;"></i>
                                                User
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="user-created-at">
                                            <?php echo htmlspecialchars($u['created_at'] ?? ''); ?>
                                        </span>
                                    </td>
                                    <td style="text-align:right;">
                                        <a href="manage_users.php?edit=<?php echo (int)$u['id']; ?>"
                                           class="btn btn--outline btn--xs">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>

                                        <?php if ((int)$u['id'] !== (int)($_SESSION['user']['id'] ?? 0)): ?>
                                            <form method="post" style="display:inline;"
                                                  onsubmit="return confirm('Delete this user?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id"
                                                       value="<?php echo (int)$u['id']; ?>">
                                                <button class="btn btn--danger btn--xs" type="submit">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- FORM TẠO / SỬA USER -->
            <section class="card card--form">
                <div class="card__header">
                    <div class="card__title">
                        <?php echo $editingUser ? 'Edit User' : 'Create New User'; ?>
                    </div>
                    <?php if ($editingUser): ?>
                        <span class="tag">ID #<?php echo (int)$editingUser['id']; ?></span>
                    <?php endif; ?>
                </div>

                <form method="post">
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="id"
                           value="<?php echo (int)($editingUser['id'] ?? 0); ?>">

                    <div class="form-grid">
                        <div class="full">
                            <label for="username">Username *</label>
                            <input class="input" id="username" name="username" required
                                   value="<?php echo htmlspecialchars($editingUser['username'] ?? ''); ?>">
                        </div>

                        <div class="full">
                            <label for="email">Email *</label>
                            <input type="email" class="input" id="email" name="email" required
                                   value="<?php echo htmlspecialchars($editingUser['email'] ?? ''); ?>">
                        </div>

                        <div>
                            <label for="role">Role</label>
                            <select id="role" name="role" class="input">
                                <option value="user"
                                    <?php echo (($editingUser['role'] ?? 'user') === 'user') ? 'selected' : ''; ?>>
                                    User (student)
                                </option>
                                <option value="admin"
                                    <?php echo (($editingUser['role'] ?? '') === 'admin') ? 'selected' : ''; ?>>
                                    Admin
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="password">
                                <?php echo $editingUser ? 'New password' : 'Password *'; ?>
                            </label>
                            <input type="password" class="input" id="password" name="password"
                                   <?php echo $editingUser ? '' : 'required'; ?>>
                            <div class="form-help">
                                <?php if ($editingUser): ?>
                                    Leave blank to keep the current password.
                                <?php else: ?>
                                    At least 6 characters is recommended.
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($editingUser): ?>
                            <div class="full">
                                <label>Joined at</label>
                                <div class="user-created-at">
                                    <?php echo htmlspecialchars($editingUser['created_at'] ?? ''); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-actions">
                        <?php if ($editingUser): ?>
                            <a href="manage_users.php" class="btn btn--outline">
                                Cancel
                            </a>
                        <?php endif; ?>
                        <button type="submit" class="btn btn--primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <?php echo $editingUser ? 'Save changes' : 'Create user'; ?>
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</div>

</body>
</html>
