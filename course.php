<?php
require_once __DIR__ . '/config/database.php';

// Kết nối DB
$db   = new Database();
$conn = $db->connect();

// Lấy tất cả khóa học
$sqlCourses    = "SELECT * FROM courses";
$resultCourses = $conn->query($sqlCourses);

if (!$resultCourses) {
    die("Lỗi truy vấn course: " . $conn->error);
}

// Chuyển kết quả thành mảng
$courses = [];
while ($row = $resultCourses->fetch_assoc()) {
    $courses[] = $row;
}

// include header (chứa <html>, <head>, <body>...)
// đảm bảo đường dẫn đúng với project của bạn
include 'header.php';
?>


    <section class="dashboard-section">
        
        <header class="dashboard-header">
            <h1 class="dashboard-header__title">
                Welcome back, ready for your next lesson?
            </h1>
            <a href="#" class="dashboard-header__link">
                View hisotry
            </a>
        </header>

        <div class="courses-list-container">
            <div class="courses-list-grid">
                
                <div class="courses-card">
                    <div class="courses-card__media">
                        <img src="./uploads/IMAGE/Rectangle 32.png" alt="Online Class" class="courses-card__image">
                    </div>
                    
                    <div class="courses-card__content">
                        <h3 class="courses-card__title">AWS Certified Solutions Architect</h3>
                        
                        <div class="courses-card__user">
                            <img src="./uploads/IMAGE/Mask Group (3).png" alt="Lina" class="courses-card__avatar">
                            <span class="courses-card__name">Lina</span>
                        </div>
                        
                        <div class="courses-card__progress-bar">
                            <div class="courses-card__progress-fill" style="width: 70%;"></div>
                        </div>
                        
                        <span class="courses-card__progress-text">Lesson 5 of 7</span>
                    </div>
                </div>
                
                <div class="courses-card">
                    <div class="courses-card__media">
                        <img src="./uploads/IMAGE/Rectangle 32 (1).png" alt="Coding Session" class="courses-card__image">
                    </div>
                    
                    <div class="courses-card__content">
                        <h3 class="courses-card__title">AWS Certified Solutions Architect</h3>
                        <div class="courses-card__user">
                            <img src="https://5sfashion.vn/storage/upload/images/ckeditor/4KG2VgKFDJWqdtg4UMRqk5CnkJVoCpe5QMd20Pf7.jpg" alt="Lina" class="courses-card__avatar">
                            <span class="courses-card__name">Sơn Tùng</span>
                        </div>
                        <div class="courses-card__progress-bar">
                            <div class="courses-card__progress-fill" style="width: 70%;"></div>
                        </div>
                        <span class="courses-card__progress-text">Lesson 5 of 7</span>
                    </div>
                </div>

                <div class="courses-card">
                    <div class="courses-card__media">
                        <img src="./uploads/IMAGE/Group 40.png" alt="Hands on Coding" class="courses-card__image">
                    </div>
                    
                    <div class="courses-card__content">
                        <h3 class="courses-card__title">AWS Certified Solutions Architect</h3>
                        <div class="courses-card__user">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQN1Tpok8H9ufTvU7u5MIfcp0FgnzQsFaLJvg&s" alt="Lina" class="courses-card__avatar">
                            <span class="courses-card__name">Đen Vâu</span>
                        </div>
                        <div class="courses-card__progress-bar">
                            <div class="courses-card__progress-fill" style="width: 70%;"></div>
                        </div>
                        <span class="courses-card__progress-text">Lesson 5 of 7</span>
                    </div>
                </div>

            </div>
            
            <div class="courses-list__navigation">
                <button class="nav-btn nav-btn--prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn nav-btn--next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
        </div>
    </section>

    <section class="category-section">
        <h2 class="category-section__title">
            Choice favourite course from top category
        </h2>
        
        <div class="category-grid">
            
            <a href="#" class="category-card category-card--design">
                <div class="category-card__icon-box">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <h3 class="category-card__title">Design</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

            <a href="#" class="category-card category-card--dev-pc">
                <div class="category-card__icon-box">
                    <i class="fas fa-desktop"></i>
                </div>
                <h3 class="category-card__title">Development</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

            <a href="#" class="category-card category-card--dev-db">
                <div class="category-card__icon-box">
                    <i class="fas fa-database"></i>
                </div>
                <h3 class="category-card__title">Development</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

            <a href="#" class="category-card category-card--biz-case">
                <div class="category-card__icon-box">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="category-card__title">Business</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

            <a href="#" class="category-card category-card--marketing">
                <div class="category-card__icon-box">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="category-card__title">Marketing</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

            <a href="#" class="category-card category-card--photography">
                <div class="category-card__icon-box">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="category-card__title">Photography</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>
            
            <a href="#" class="category-card category-card--acting">
                <div class="category-card__icon-box">
                    <i class="fas fa-film"></i>
                </div>
                <h3 class="category-card__title">Acting</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

            <a href="#" class="category-card category-card--biz-case-2">
                <div class="category-card__icon-box">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="category-card__title">Business</h3>
                <p class="category-card__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                </p>
            </a>

        </div>
    </section>

    <!-- ================= Recommended for you - DÙNG DB ================= -->
    <section class="recommend-section">
        
        <header class="recommend-header">
            <h2 class="recommend-header__title">Recommended for you</h2>
            <a href="#" class="recommend-header__link">See all</a>
        </header>

        <div class="course-slider-container">
            <div class="course-slider-grid">
                
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <?php
                            $image_url      = $course['image_url']      ?? '';
                            $title          = $course['title']          ?? '';
                            $category       = $course['category']       ?? '';
                            $duration       = $course['duration']       ?? '';
                            $description    = $course['description']    ?? '';
                            $teacher_name   = $course['teacher_name']   ?? '';
                            $teacher_avatar = $course['teacher_avatar'] ?? '';
                            $old_price      = isset($course['old_price']) ? (float)$course['old_price'] : null;
                            $current_price  = isset($course['current_price']) ? (float)$course['current_price'] : 0;
                            $id             = isset($course['id']) ? (int)$course['id'] : 0;
                        ?>
                        <div class="course-card">
                            <form method="post" action="cart.php">
                                <div class="course-card__media">
                                    <img src="<?php echo htmlspecialchars($image_url); ?>"
                                         alt="<?php echo htmlspecialchars($title); ?>"
                                         class="course-card__image">
                                </div>
                                
                                <div class="course-card__content">
                                    <div class="course-card__meta">
                                        <span class="course-card__category">
                                            <i class="fas fa-palette"></i>
                                            <?php echo htmlspecialchars($category); ?>
                                        </span>
                                        <span class="course-card__duration">
                                            <i class="fas fa-clock"></i>
                                            <?php echo htmlspecialchars($duration); ?>
                                        </span>
                                    </div>
                                    
                                    <h3 class="course-card__title">
                                        <?php echo htmlspecialchars($title); ?>
                                    </h3>
                                    
                                    <p class="course-card__description">
                                        <?php echo htmlspecialchars($description); ?>
                                    </p>

                                    <div class="course-card__footer">
                                        <div class="course-card__user">
                                            <?php if (!empty($teacher_avatar)): ?>
                                                <img src="<?php echo htmlspecialchars($teacher_avatar); ?>"
                                                     alt="<?php echo htmlspecialchars($teacher_name); ?>"
                                                     class="course-card__avatar">
                                            <?php endif; ?>
                                            <span class="course-card__name">
                                                <?php echo htmlspecialchars($teacher_name); ?>
                                            </span>
                                        </div>

                                        <!-- giá + nút cart -->
                                        <div class="course-card__footer-right">
                                            <div class="course-card__price">
                                                <?php if (!is_null($old_price) && $old_price > 0): ?>
                                                    <span class="course-card__old-price">
                                                        $<?php echo number_format($old_price, 2); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <span class="course-card__current-price">
                                                    $<?php echo number_format($current_price, 2); ?>
                                                </span>
                                            </div>

                                            <button type="submit" name="add_to_cart"
                                                    class="btn-add-to-cart"
                                                    title="Thêm vào giỏ">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- dữ liệu gửi sang cart.php -->
                                    <input type="hidden" name="course_id"
                                           value="<?php echo $id; ?>">
                                    <input type="hidden" name="course_name"
                                           value="<?php echo htmlspecialchars($title); ?>">
                                    <input type="hidden" name="course_price"
                                           value="<?php echo $current_price; ?>">
                                    <input type="hidden" name="course_image"
                                           value="<?php echo htmlspecialchars($image_url); ?>">
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Chưa có khóa học nào trong hệ thống.</p>
                <?php endif; ?>

            </div>
            
            <div class="slider-navigation">
                <button class="nav-btn nav-btn--prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn nav-btn--next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
        </div>
    </section>
    <!-- ================= End Recommended (DB) ================= -->

    <!-- Các phần phía dưới vẫn giữ HTML tĩnh như cũ -->

    <!--Dãy khóa 2-->
    <section class="recommend-section-2">
        <!-- ... phần này giữ nguyên như bạn đã có ... -->
        <!-- (mình không sửa vì nó không dùng DB) -->
        <!-- Toàn bộ đoạn recommend-section-2, 3, 4 của bạn để nguyên -->
        <!-- === BẮT ĐẦU LẠI TỪ ĐÂY === -->
        <!-- (copy nguyên đoạn bạn đang dùng) -->
<?php /* từ đây trở xuống bạn có thể giữ y nguyên như file cũ, mình không lặp lại để đỡ dài */ ?>
    </section>

        <?php include 'footer.php'; ?>
    </body>
</html>
