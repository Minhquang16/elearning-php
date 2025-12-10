<?php
// courses.php – danh sách khóa học lấy từ DB

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';
$db = (new Database())->connect();

/* ========= LẤY PARAM TỪ URL ========= */
$search   = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$sort     = $_GET['sort'] ?? 'latest';

/* ========= WHERE / ORDER ========= */

// nếu bảng bạn có cột is_active thì giữ dòng này, nếu không có thì bỏ hoặc comment lại
$conditions = []; // ["is_active = 1"];

if ($search !== '') {
    $s = $db->real_escape_string($search);
    $conditions[] = "(title LIKE '%$s%' 
                     OR category LIKE '%$s%' 
                     OR description LIKE '%$s%')";
}

if ($category !== '') {
    $c = $db->real_escape_string($category);
    $conditions[] = "category = '$c'";
}

$where = '';
if (!empty($conditions)) {
    $where = 'WHERE ' . implode(' AND ', $conditions);
}

// sắp xếp
switch ($sort) {
    case 'price_asc':
        // nếu không có cột current_price thì đổi thành cột giá của bạn
        $order = 'ORDER BY current_price ASC';
        break;
    case 'price_desc':
        $order = 'ORDER BY current_price DESC';
        break;
    default:
        // nếu không có created_at thì đổi thành id DESC
        $order = 'ORDER BY created_at DESC';
        // $order = 'ORDER BY id DESC';
        break;
}

/* ========= LẤY DANH SÁCH KHÓA HỌC ========= */

// dùng SELECT * cho chắc ăn, khỏi lo thiếu cột
$sql = "SELECT * FROM courses $where $order";

$result = $db->query($sql);
if (!$result) {
    die('SQL error: ' . $db->error);
}

$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}
$total = count($courses);

/* ========= LẤY CATEGORY DISTINCT ========= */
$categories = [];
$catRes = $db->query("SELECT DISTINCT category FROM courses WHERE category <> '' ORDER BY category");
if ($catRes) {
    while ($row = $catRes->fetch_assoc()) {
        $categories[] = $row['category'];
    }
}

// rút gọn mô tả
function short_text($text, $limit = 120)
{
    $text = trim($text ?? '');
    if (mb_strlen($text) <= $limit) return $text;
    return mb_substr($text, 0, $limit) . '...';
}
?>

<?php include 'header.php'; ?>

<body>
<main class="courses-page">

    <!-- HERO + SEARCH/FILTER -->
    <section class="hero">
        <div class="search-wrap">
            <form class="search-bar" method="get">
                <input
                    class="input"
                    type="text"
                    name="q"
                    placeholder="Search your favourite course"
                    value="<?= htmlspecialchars($search) ?>"
                >

                <select class="input" name="category">
                    <option value="">All categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>"
                            <?= $cat === $category ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select class="input" name="sort">
                    <option value="latest"     <?= $sort === 'latest' ? 'selected' : '' ?>>Newest</option>
                    <option value="price_asc"  <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low → High</option>
                    <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High → Low</option>
                </select>

                <button class="btn-primary" type="submit">Search</button>
            </form>

            <div class="filters-info">
                <?= $total ?> course<?= $total !== 1 ? 's' : '' ?> found
                <?php if ($search !== ''): ?>
                    for "<strong><?= htmlspecialchars($search) ?></strong>"
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- GRID KHÓA HỌC -->
    <section class="section">
        <?php if ($total === 0): ?>
            <p style="color:#6b7280; font-size:14px; margin-top:10px;">
                No courses matched your search. Try another keyword or remove some filters.
            </p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($courses as $c): ?>
                    <?php
                        // ===== xử lý ảnh khóa học =====
                        $rawImage = $c['image_url'] ?? $c['image'] ?? '';

                        if ($rawImage !== '') {
                            // Nếu là link đầy đủ hoặc đã có 'uploads/'
                            if (preg_match('#^(https?://|uploads/)#i', $rawImage)) {
                                $imgSrc = $rawImage;
                            } else {
                                // chỉ là tên file → tự thêm thư mục
                                $imgSrc = 'uploads/IMAGE/' . $rawImage;
                            }
                        } else {
                            $imgSrc = 'https://via.placeholder.com/600x400?text=Course';
                        }

                        // ===== avatar giảng viên =====
                        $rawAvatar = $c['teacher_avatar'] ?? '';
                        if ($rawAvatar !== '') {
                            if (preg_match('#^(https?://|uploads/)#i', $rawAvatar)) {
                                $avatarSrc = $rawAvatar;
                            } else {
                                $avatarSrc = 'uploads/IMAGE/' . $rawAvatar;
                            }
                        } else {
                            $avatarSrc = 'https://via.placeholder.com/80?text=Teacher';
                        }

                        $detailUrl = 'course_detail.php?id=' . (int)$c['id'];

                        // giá
                        $oldPrice  = isset($c['old_price']) ? (float)$c['old_price'] : 0;
                        $curPrice  = isset($c['current_price']) ? (float)$c['current_price'] : 0;
                    ?>

                    <article class="card">
                        <a href="<?= $detailUrl ?>" class="thumb">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="">
                            <div class="badges">
                                <?php if (!empty($c['category'])): ?>
                                    <span class="badge"><?= htmlspecialchars($c['category']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($c['duration'])): ?>
                                    <span class="badge"><?= htmlspecialchars($c['duration']) ?></span>
                                <?php endif; ?>
                            </div>
                        </a>

                        <div class="body">
                            <a href="<?= $detailUrl ?>" class="title">
                                <?= htmlspecialchars($c['title']) ?>
                            </a>
                            <p class="desc">
                                <?= htmlspecialchars(short_text($c['description'] ?? '')) ?>
                            </p>

                            <div class="foot">
                                <div class="author">
                                    <img src="<?= htmlspecialchars($avatarSrc) ?>" alt="">
                                    <span><?= htmlspecialchars($c['teacher_name'] ?? 'Unknown') ?></span>
                                </div>

                                <div class="price-block">
                                    <?php if ($oldPrice > 0): ?>
                                        <span class="old">$<?= number_format($oldPrice, 2) ?></span>
                                    <?php endif; ?>
                                    <?php if ($curPrice > 0): ?>
                                        <span class="price">$<?= number_format($curPrice, 2) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-actions">
                                <a href="<?= $detailUrl ?>" class="btn-outline-sm">
                                    View details
                                </a>

                                <!-- GỬI ĐÚNG DỮ LIỆU THEO cart.php (POST) -->
                                <form action="cart.php" method="post" class="card-add-form">
                                    <input type="hidden" name="add_to_cart" value="1">
                                    <input type="hidden" name="course_id"
                                           value="<?= (int)$c['id']; ?>">
                                    <input type="hidden" name="course_name"
                                           value="<?= htmlspecialchars($c['title'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="course_price"
                                           value="<?= $curPrice; ?>">
                                    <input type="hidden" name="course_image"
                                           value="<?= htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>">

                                    <button type="submit" class="btn-primary-sm">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- BANNER NGẮN -->
    <section class="banner">
        <div>
            <h3>Upgrade your skills with Dev Alpha</h3>
            <div class="b-list">
                <div class="b-item"><span class="dot"></span> High-quality curated courses</div>
                <div class="b-item"><span class="dot"></span> Experienced instructors & mentors</div>
                <div class="b-item"><span class="dot"></span> Lifetime access to purchased content</div>
            </div>
            <div class="b-cta">
                <a href="course-watch.php" class="btn-cta">Start learning now</a>
            </div>
        </div>
        <div class="mock">
            <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
            <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
        </div>
    </section>

</main>

<?php include 'footer.php'; ?>
</body>
</html>
