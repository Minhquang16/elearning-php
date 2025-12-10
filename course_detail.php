<?php
// course_detail.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';
$db = (new Database())->connect();

// Lấy id khóa học từ URL
$courseId = (int)($_GET['id'] ?? 0);
if ($courseId <= 0) {
    http_response_code(404);
    $course = null;
} else {
    $stmt = $db->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param('i', $courseId);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();
}

// Nếu không tìm thấy khóa học
if (!$course) {
    include 'header.php';
    ?>
    <main style="min-height:60vh;display:flex;align-items:center;justify-content:center;">
        <div style="text-align:center;">
            <h1 style="font-size:28px;margin-bottom:8px;">Course not found</h1>
            <p style="color:#6b7280;margin-bottom:14px;">
                The course you are looking for does not exist or has been removed.
            </p>
            <a href="course.php" class="btn-primary">Back to courses</a>
        </div>
    </main>
    <?php
    include 'footer.php';
    exit;
}

// Xử lý ảnh khóa học
$rawImage = $course['image_url'] ?? '';
if ($rawImage !== '') {
    if (preg_match('#^(https?://|uploads/)#i', $rawImage)) {
        $courseImage = $rawImage;
    } else {
        $courseImage = 'uploads/IMAGE/' . $rawImage;
    }
} else {
    $courseImage = 'https://via.placeholder.com/800x450?text=Course';
}

// Avatar giảng viên
$rawAvatar = $course['teacher_avatar'] ?? '';
if ($rawAvatar !== '') {
    if (preg_match('#^(https?://|uploads/)#i', $rawAvatar)) {
        $teacherAvatar = $rawAvatar;
    } else {
        $teacherAvatar = 'uploads/IMAGE/' . $rawAvatar;
    }
} else {
    $teacherAvatar = 'https://via.placeholder.com/80?text=Teacher';
}

$oldPrice = isset($course['old_price']) ? (float)$course['old_price'] : 0;
$curPrice = isset($course['current_price']) ? (float)$course['current_price'] : 0;

// Lấy thêm vài khóa học khác để gợi ý
$recommendCourses = [];
$recRes = $db->query("
    SELECT * 
    FROM courses 
    WHERE id <> {$courseId}
    ORDER BY created_at DESC 
    LIMIT 4
");
if ($recRes) {
    while ($row = $recRes->fetch_assoc()) {
        $recommendCourses[] = $row;
    }
}

// Hàm rút gọn mô tả
function short_text_detail($text, $limit = 130) {
    $text = trim($text ?? '');
    if (mb_strlen($text) <= $limit) return $text;
    return mb_substr($text, 0, $limit) . '...';
}

$title = $course['title'] ?? 'Course detail';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= htmlspecialchars($title) ?> – Dev Alpha</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/CSS/base.css">
    <link rel="stylesheet" href="./assets/CSS/course_detail.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
          href="./assets/font/fontawesome-free-7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap"
          rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<main class="course-page-layout">

    <!-- ========== HEADER SECTION ========== -->
    <section class="course-header-section">
        <div class="header-media-area">

            <!-- Ảnh / video chính -->
            <img src="<?= htmlspecialchars($courseImage) ?>"
                 alt="<?= htmlspecialchars($course['title']) ?>"
                 class="main-image">

            <!-- Sidebar bên phải: giá + CTA + info -->
            <aside class="sidebar-cta">
                <div class="sidebar-cta__image-box">
                    <img src="<?= htmlspecialchars($courseImage) ?>"
                         alt="<?= htmlspecialchars($course['title']) ?>"
                         class="sidebar-cta__image">
                </div>

                <div class="sidebar-cta__price-box">
                    <?php if ($curPrice > 0): ?>
                        <span class="current-price">
                            $<?= number_format($curPrice, 2) ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($oldPrice > 0): ?>
                        <span class="old-price">
                            $<?= number_format($oldPrice, 2) ?>
                        </span>
                        <?php
                        $discount = $curPrice > 0 && $oldPrice > $curPrice
                            ? round(100 - ($curPrice / $oldPrice * 100))
                            : 0;
                        ?>
                        <?php if ($discount > 0): ?>
                            <span class="discount"><?= $discount ?>% Off</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php if (!empty($course['duration'])): ?>
                    <p class="sidebar-cta__timer">
                        Duration: <?= htmlspecialchars($course['duration']) ?>
                    </p>
                <?php endif; ?>

                <!-- Nút add to cart / buy -->
                <form action="cart.php" method="post" style="margin-top:10px;">
                        <input type="hidden" name="add_to_cart" value="1">
                        <!-- flag báo là muốn đi thẳng tới checkout -->
                        <input type="hidden" name="go_checkout" value="1">

                        <input type="hidden" name="course_id"
                            value="<?= (int)$course['id'] ?>">
                        <input type="hidden" name="course_name"
                            value="<?= htmlspecialchars($course['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="course_price"
                            value="<?= $curPrice > 0 ? $curPrice : $oldPrice ?>">
                        <input type="hidden" name="course_image"
                            value="<?= htmlspecialchars($courseImage, ENT_QUOTES, 'UTF-8'); ?>">

                        <button type="submit" class="sidebar-cta__button">
                            Buy Now
                        </button>
                    </form>


                <div class="course-features">
                    <h4 class="course-features__title">This course includes</h4>
                    <ul class="course-features__list">
                        <li><i class="fas fa-check-circle"></i> Money back guarantee</li>
                        <li><i class="fas fa-mobile-alt"></i> Access on all devices</li>
                        <li><i class="fas fa-certificate"></i> Certificate of completion</li>
                        <li><i class="fas fa-layer-group"></i> Lifetime access</li>
                    </ul>
                </div>

                <div class="course-training">
                    <h4 class="course-training__title">Training for your team</h4>
                    <p class="course-training__text">
                        Train your entire team with this course on our platform.
                        Contact us for special group pricing and dashboards.
                    </p>
                </div>

                <!-- <div class="course-share">
                    <h4 class="course-share__title">Share this course</h4>
                    <div class="course-share__icons">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                </div> -->
            </aside>
        </div>

        <!-- Tabs phần trên -->
        <div class="tabs-nav">
            <button class="tab-btn tab-btn--active">Overview</button>
            <button class="tab-btn">Curriculum</button>
            <button class="tab-btn">Instructor</button>
            <button class="tab-btn">Reviews</button>
        </div>
    </section>

    <!-- ========== MAIN CONTENT ========== -->
    <section class="main-content-area">

        <!-- Thông tin khóa học + teacher -->
        <div class="course-main-info">
            <h1 class="course-title">
                <?= htmlspecialchars($course['title']) ?>
            </h1>

            <div class="course-meta">
                <?php if (!empty($course['category'])): ?>
                    <span><i class="fa-solid fa-tag"></i>
                        <?= htmlspecialchars($course['category']) ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($course['duration'])): ?>
                    <span><i class="fa-solid fa-clock"></i>
                        <?= htmlspecialchars($course['duration']) ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($course['created_at'])): ?>
                    <span><i class="fa-solid fa-calendar"></i>
                        Published: <?= htmlspecialchars(substr($course['created_at'], 0, 10)) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="course-instructor-box">
                <img src="<?= htmlspecialchars($teacherAvatar) ?>"
                     alt="Instructor"
                     class="instructor-avatar">
                <div>
                    <div class="instructor-name">
                        <?= htmlspecialchars($course['teacher_name'] ?? 'Instructor') ?>
                    </div>
                    <div class="instructor-sub">
                        Lead instructor at Dev Alpha
                    </div>
                </div>
            </div>

            <div class="course-description">
                <h2>About this course</h2>
                <p>
                    <?= nl2br(htmlspecialchars($course['description'] ?? 'No description.')) ?>
                </p>
            </div>
        </div>

        <!-- Box review demo (giữ nguyên style bạn có) -->
        <div class="review-box">

            <div class="review-box__rating-summary">
                <div class="rating-display">
                    <span class="rating-display__score">4.8 / 5</span>
                    <div class="rating-display__stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-display__text">Student rating</span>
                </div>

                <div class="rating-bars">
                    <div class="rating-bar-item">
                        <span>5 Stars</span>
                        <div class="bar-container"><div class="bar-fill" style="width: 80%;"></div></div>
                    </div>
                    <div class="rating-bar-item">
                        <span>4 Stars</span>
                        <div class="bar-container"><div class="bar-fill" style="width: 15%;"></div></div>
                    </div>
                    <div class="rating-bar-item">
                        <span>3 Stars</span>
                        <div class="bar-container"><div class="bar-fill" style="width: 3%;"></div></div>
                    </div>
                    <div class="rating-bar-item">
                        <span>2 Stars</span>
                        <div class="bar-container"><div class="bar-fill" style="width: 1%;"></div></div>
                    </div>
                    <div class="rating-bar-item">
                        <span>1 Star</span>
                        <div class="bar-container"><div class="bar-fill" style="width: 1%;"></div></div>
                    </div>
                </div>
            </div>

            <!-- 2 review mẫu -->
            <div class="review-item">
                <div class="review-item__header">
                    <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=200"
                         alt="Student" class="review-item__avatar">
                    <span class="review-item__name">Savannah Nguyen</span>
                    <div class="review-item__stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <span class="review-item__time">3 months ago</span>
                </div>
                <p class="review-item__text">
                    Great explanations, well structured course and practical examples.
                    Highly recommended for beginners.
                </p>
            </div>

            <div class="review-item">
                <div class="review-item__header">
                    <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=200"
                         alt="Student" class="review-item__avatar">
                    <span class="review-item__name">Jacob Jones</span>
                    <div class="review-item__stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="review-item__time">1 month ago</span>
                </div>
                <p class="review-item__text">
                    I went from zero to being confident enough to build my own project.
                    The instructor explains every concept clearly.
                </p>
            </div>
        </div>
    </section>
</main>

<!-- ========== RECOMMENDED COURSES ========== -->
<section class="recommend-section-2">
    <header class="recommend-header-2">
        <h2 class="recommend-header__title-2">Recommended</h2>
        <a href="course.php" class="recommend-header__link-2">See all</a>
    </header>

    <div class="course-slider-container-2">
        <div class="course-slider-grid-2">
            <?php if (empty($recommendCourses)): ?>
                <p style="color:#6b7280;">No other courses to recommend yet.</p>
            <?php else: ?>
                <?php foreach ($recommendCourses as $rc): ?>
                    <?php
                    // xử lý ảnh
                    $rcRawImage = $rc['image_url'] ?? '';
                    if ($rcRawImage !== '') {
                        if (preg_match('#^(https?://|uploads/)#i', $rcRawImage)) {
                            $rcImage = $rcRawImage;
                        } else {
                            $rcImage = 'uploads/IMAGE/' . $rcRawImage;
                        }
                    } else {
                        $rcImage = 'https://via.placeholder.com/500x333?text=Course';
                    }

                    $rcOld = isset($rc['old_price']) ? (float)$rc['old_price'] : 0;
                    $rcCur = isset($rc['current_price']) ? (float)$rc['current_price'] : 0;
                    ?>
                    <div class="course-card-2">
                        <a href="course_detail.php?id=<?= (int)$rc['id']; ?>"
                           class="course-card__media-2">
                            <img src="<?= htmlspecialchars($rcImage) ?>"
                                 alt="<?= htmlspecialchars($rc['title']) ?>"
                                 class="course-card__image-2">
                        </a>

                        <div class="course-card__content-2">
                            <div class="course-card__meta-2">
                                <?php if (!empty($rc['category'])): ?>
                                    <span class="course-card__category-2">
                                        <i class="fas fa-palette"></i>
                                        <?= htmlspecialchars($rc['category']) ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($rc['duration'])): ?>
                                    <span class="course-card__duration-2">
                                        <i class="fas fa-clock"></i>
                                        <?= htmlspecialchars($rc['duration']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h3 class="course-card__title-2">
                                <a href="course_detail.php?id=<?= (int)$rc['id']; ?>">
                                    <?= htmlspecialchars($rc['title']) ?>
                                </a>
                            </h3>

                            <p class="course-card__description-2">
                                <?= htmlspecialchars(short_text_detail($rc['description'] ?? '')) ?>
                            </p>

                            <div class="course-card__footer-2">
                                <div class="course-card__user-2">
                                    <img src="<?= htmlspecialchars($teacherAvatar) ?>"
                                         alt="Instructor"
                                         class="course-card__avatar-2">
                                    <span class="course-card__name-2">
                                        <?= htmlspecialchars($rc['teacher_name'] ?? 'Instructor') ?>
                                    </span>
                                </div>
                                <div class="course-card__price-2">
                                    <?php if ($rcOld > 0): ?>
                                        <span class="course-card__old-price-2">
                                            $<?= number_format($rcOld, 2) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($rcCur > 0): ?>
                                        <span class="course-card__current-price-2">
                                            $<?= number_format($rcCur, 2) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== CÁC PHẦN STATIC BÊN DƯỚI (giữ nguyên) ========== -->
<!-- 
<section class="totc-feature-section">
    <div class="feature-content">
        <div class="deco-block-1 top-left1-deco"></div>
        <div class="contents">
            <h2 class="feature-heading">
                Everything you can do in a physical <br>classroom,
                <span class="highlight-blue">you can do with TOTC</span>
            </h2>
            <p class="feature-description">
                TOTC's school management software helps traditional <br>
                and online schools manage scheduling, attendance,<br>
                payments and virtual classrooms all in one secure cloud-<br>
                based system.
            </p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
        <div class="deco-block-2 bottom-right1-deco"></div>
    </div>

    <div class="feature-visual">
        <div class="deco-block-3 top-left2-deco"></div>
        <img src="./uploads/IMAGE/confident-teacher-explaining-lesson-pupils 1.png"
             alt="Teacher instructing students"
             class="classroom-image">
        <div class="deco-block-4 bottom-right2-deco"></div>
    </div>
</section>

<section class="offer-section">
    <header class="offer-header">
        <h2 class="offer-header__title">
            Top Education offers and deals are listed here
        </h2>
        <a href="#" class="offer-header__link">See all</a>
    </header>

    <div class="offer-grid">
        <div class="offer-card">
            <div class="offer-card__media">
                <span class="offer-card__badge">50%</span>
                <img src="./uploads/IMAGE/box1.png"
                     alt="Instructor" class="offer-card__image">
                <div class="offer-card__overlay">
                    <h3 class="offer-card__title">FOR INSTRUCTORS</h3>
                    <p class="offer-card__description">
                        TOTC's school management software helps traditional and
                        online schools manage scheduling.
                    </p>
                </div>
            </div>
        </div>

        <div class="offer-card">
            <div class="offer-card__media">
                <span class="offer-card__badge">50%</span>
                <img src="./uploads/IMAGE/box1.png"
                     alt="Instructor" class="offer-card__image">
                <div class="offer-card__overlay">
                    <h3 class="offer-card__title">FOR INSTRUCTORS</h3>
                    <p class="offer-card__description">
                        TOTC's school management software helps traditional and
                        online schools manage scheduling.
                    </p>
                </div>
            </div>
        </div>

        <div class="offer-card">
            <div class="offer-card__media">
                <span class="offer-card__badge">50%</span>
                <img src="./uploads/IMAGE/box1.png"
                     alt="Instructor" class="offer-card__image">
                <div class="offer-card__overlay">
                    <h3 class="offer-card__title">FOR INSTRUCTORS</h3>
                    <p class="offer-card__description">
                        TOTC's school management software helps traditional and
                        online schools manage scheduling.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<?php include 'footer.php'; ?>

</body>
</html>
