<?php
session_start();

// Ảnh avatar mặc định
$defaultAvatar = '';

// Nếu sau này bạn có lưu avatar trong session thì dùng, còn không thì dùng mặc định
$avatarPath = isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] !== ''
    ? $_SESSION['user']['avatar']
    : $defaultAvatar;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dev alpha</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Viewport meta tag cho responsive design:
             - width=device-width: chiều rộng bằng chiều rộng thiết bị
             - initial-scale=1.0: không zoom khi load trang -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <!-- FontAwesome 6.5.2 từ CDN CloudFlare - cung cấp hàng nghìn icon vector miễn phí -->
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="stylesheet" href="./assets/css/base.css">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Đảm bảo IE sử dụng engine hiện đại nhất (Edge mode) - ít cần thiết hiện tại -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <!-- Preconnect đến Google Fonts - thiết lập kết nối sớm để tăng tốc độ load -->
        <link rel="stylesheet" href="./assets/font/fontawesome-free-7.0.1/css/all.min.css">
        <!-- FontAwesome local backup version 7.0.1 - dự phòng khi CDN không khả dụng -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Preconnect đến fonts.gstatic.com với CORS - nơi lưu trữ file font thực tế -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
        <!-- Google Font Roboto với tất cả weight từ 100-900:
             - display=swap: hiện font fallback trước, sau đó swap sang Roboto
             - Roboto là font sans-serif phổ biến, dễ đọc trên web -->
        <link rel="stylesheet" href="assets/CSS/footer.css">
    </head>
    <body>
        <style>
            /* Avatar nhỏ trong popup tài khoản */
.header-nav__dropdown-avatar {
    width: 64px;          /* kích thước avatar */
    height: 64px;
    border-radius: 50%;   /* bo tròn */
    object-fit: cover;    /* crop vừa khung */
    flex-shrink: 0;
}

/* nếu card của bạn cần co lại nữa thì có thể thêm */
.header-nav__dropdown {
    max-width: 320px;     /* hoặc 280 tuỳ ý */
}
.header-nav__dropdown-avatar {
    width: 40px;
    height: 40px;
}
    /* ==== PROFILE DROPDOWN ==== */
    .header-nav__profile {
        position: relative;
        display: flex;
        align-items: center;
    }

    .header-nav__user {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid rgba(0,0,0,0.03);
        background: transparent;
        cursor: pointer;
        outline: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
        transition: box-shadow 0.15s ease, transform 0.15s ease, border-color 0.15s ease;
    }

    .header-nav__user:hover {
        box-shadow: 0 6px 14px rgba(0,0,0,0.07);
        transform: translateY(-1px);
        border-color: rgba(0,198,215,0.2);
    }

    .header-nav__avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        object-fit: cover;
    }

    .header-nav__name {
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }

    .header-nav__caret {
        font-size: 12px;
        color: #999;
    }

    .header-nav__dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        min-width: 190px;
        background: transparent;
        border-radius: 14px;
        /* border: 1px solid #e4ebff; */
        box-shadow: 0 14px 30px rgba(0,0,0,0.08);
        padding: 6px 0;
        opacity: 0;
        transform: translateY(6px);
        pointer-events: none;
        transition: opacity 0.16s ease, transform 0.16s ease;
        z-index: 1500;
    }

    .header-nav__profile--open .header-nav__dropdown {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .header-nav__dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 14px;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        transition: background 0.15s ease, color 0.15s ease;
    }

    .header-nav__dropdown-item i {
        width: 18px;
        text-align: center;
        color: #00c6d7;
    }

    .header-nav__dropdown-item:hover {
        background: #f5fbff;
        color: #111827;
    }

    .header-nav__dropdown-item--logout i {
        color: #f97373;
    }
    .header-nav__dropdown-item--logout:hover {
        background: #fff0f0;
    }

    .header-nav__divider {
        border: 0;
        border-top: 1px solid #edf2ff;
        margin: 4px 0;
    }
        </style>
        <div class="banner">
        <header class="header">
            <div class="header__container">
                <!--logo-->
                <a href="index.php">
                   <div class="header__logo">
                    <div class="header__logo-icon">
                        <i class="fa-brands fa-codiepie"></i>
                    </div>
                </div> 
                </a>
                
                <!--nav-->
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a href="index.php" class="header__nav-item-link">Home</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="course.php" class="header__nav-item-link">My Courses</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="search.php" class="header__nav-item-link">All Courses</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="blog.php" class="header__nav-item-link">Blog</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="blog-details.php" class="header__nav-item-link">About Us</a>
                        </li>
                    </ul>
                </nav>

                <!--auth buttons-->
                <div class="header-nav__profile">
        <?php if (isset($_SESSION['user'])): ?>
            <?php $role = $_SESSION['user']['role'] ?? 'user'; ?>

            <!-- Nút tài khoản -->
            <button type="button" class="header-nav__user">
                <img src="uploads/IMAGE/OIP.webp" class="header-nav__avatar" alt="Avatar">
                <span class="header-nav__name">
                    <?= htmlspecialchars($_SESSION['user']['username']); ?>
                </span>
                <i class="fa-solid fa-chevron-down header-nav__caret"></i>
            </button>

            <!-- Dropdown -->
            <div class="header-nav__dropdown">
                <?php if ($role === 'admin'): ?>
                    <a href="admin/dashboard.php" class="header-nav__dropdown-item">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                    <hr class="header-nav__divider">
                <?php endif; ?>

                <a href="cart.php" class="header-nav__dropdown-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Cart</span>
                </a>

                <a href="orders.php" class="header-nav__dropdown-item">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Orders</span>
                </a>

                <a href="controllers/AuthController.php?action=logout"
                   class="header-nav__dropdown-item header-nav__dropdown-item--logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>

        <?php else: ?>
            <a href="login.php" class="header-nav__link btn-login">Login</a>
            <a href="register.php" class="header-nav__link btn-register">Sign Up</a>
        <?php endif; ?>
    </div>
            </div>
        </header>

         <!-- HERO SECTION BLOCK -->
            <section class="hero">
                <div class="hero__container">
                    <!-- Hero Content Block -->
                    <div class="hero__content">
                        <div class="hero__text">
                            <h1 class="hero__title">
                                <!--Nhấn manh chữ-->
                                <span class="hero__title-highlight">Studying</span> 
                                Online is now <br> much easier
                            </h1>
                            <p class="hero__description">
                            DevAlpha helps you master programming through <br> hands-on lessons,
                            real projects, and expert <br> guidance—designed for beginners 
                            and future developers.
                            </p>
                        </div>

                        <!-- Hero Actions Block -->
                        <div class="hero__actions">
                            <button class="btn btn--primary btn--large">Join for free</button>
                            <button class="btn btn--play">
                                <!--chèn icon-->
                                <span class="btn__icon"><i class="fa-solid fa-circle-play"></i></span>
                                Watch how it works
                            </button>
                        </div>
                    </div>

                    <!-- Hero Visual Block -->
                    <div class="hero__visual">
                        <!-- Main Image banner -->
                        <div class="hero__image">
                            <img src="./uploads/IMAGE/image (1).png" alt="Student" class="hero__img">
                        </div>

                        <!-- Floating Cards Block -->
                        <div class="cards">
                            <!-- Student Stats Card -->
                            <div class="card card--stats card--top-right">
                                <a href="course-calandar.php">
                                    <div class="card__icon card__icon--blue">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>
                                    <div class="card__content">
                                        <div class="card__number"><a href="course-calandar.php"></a>250k</div>
                                        <div class="card__label">Assisted Student</div>
                                    </div>
                                </a>
                            </div>

                            <!-- Congratulations Card -->
                             <a href="contact.php">
                                <div class="card card--notification card--middle-right">
                                    <div class="card__icon card__icon--orange">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="card__content">
                                        <div class="card__title">Congratulations</div>
                                        <div class="card__subtitle">Your admission completed</div>
                                    </div>
                                </div>
                            </a>
                            

                            <!-- User Experience Class Card -->
                            <div class="card card--class card--bottom-left">
                                <div class="card__avatar">
                                    <img src="./uploads/IMAGE/teacher-avatar.jpg" alt="Teacher" class="card__avatar-img">
                                </div>
                                <div class="card__content">
                                    <div class="card__class-name">User Experience Class</div>
                                    <div class="card__schedule">Today at 12.00 PM</div>
                                    <button class="btn btn--small btn--pink">Join Now</button>
                                </div>
                            </div>
                        </div>

                        <!-- Decorative Elements Block -->
                        <div class="decorations">
                            <div class="decoration decoration--chart decoration--top-left"></div>
                            <div class="decoration decoration--dots decoration--bottom-right"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- SUCCESS SECTION BLOCK -->
        <section class="success">
                <div class="success__container">
                    <div class="success__content">
                        <h2 class="success__title">Our Success</h2>
                        <p class="success__description">
                        We are proud to have supported thousands of learners in building strong foundations in programming.<br>
Through practical training, real-world projects, and guidance from industry experts,<br>
we help students transform their passion for coding into real opportunities.
                        </p>
                    </div>
                </div>
        </section>

        <!--Row total-->
        <div class="totals">
            <div class="total__student">
                <div class="total__student-number">
                    15K+
                </div>
                <div class="total__student-text">
                    Students
                </div>
            </div>
            <div class="total__success">
                <div class="total__success-num">
                    75%
                </div>
                <div class="total__success-text">
                    Total success
                </div>
            </div>
            <div class="total__questions">
                <div class="total__questions-num">
                    35
                </div>
                <div class="total__questions-text">
                    Main question
                </div>
            </div>
            <div class="total__chief">
                <div class="total__chief-num">
                    26
                </div>
                <div class="total__chief-text">
                    Chief experts
                 </div>
            </div>
            <div class="total__years">
                <div class="total__years-num">
                    16
                </div>
                <div class="total__years-text">
                    Years of experience
                </div>
            </div>
        </div>

        <section class="software">
            <div class="software__container">
                <div class="software__content">
                    <h2 class="software__title">All-In-One
                        <span class="software___highligt-text">
                            Cloud Software.
                        </span>
                    </h2>
                    <p class="software__description">
                    We provide a complete learning ecosystem that gives you everything you need to master programming —<br>
                    from beginner lessons to advanced projects, mentoring, career support, and a thriving community of learners.<br>
                    Our platform is designed to help you learn faster, stay motivated, and achieve real results.
                    </p>
                </div>
            </div>
        </section>

        <!--3-block-->
        <div class="blocks">
            <div class="block__container">
                <div class="block__file">
                    <div class="block__icon block__icon--color1">
                        <i class="fa-regular fa-file-zipper"></i>
                    </div>
                    <div class="block__content">
                        <div class="block__title">
                            Online Billing,<br> Invoicing, & Contracts
                        </div>
                        <div class="block__description ">
                        Stay organized with a clean, intuitive <br> dashboard
                        that tracks your lessons, <br> progress, and upcoming tasks.<br>
                        Everything you need is in one place
                        </div>
                    </div>
                </div>
                <div class="block__scheduling ">
                    <div class="block__icon block__icon--color2">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="block__content">
                        <div class="block__title">
                            Easy Scheduling & <br>Attendance Tracking
                        </div>
                        <div class="block__description ">
                        Join live sessions, book mentoring <br> appointments,
                        and manage your <br> learning schedule with ease.<br>
                        Never miss a class again.
                        </div>
                    </div>
                </div>
                <div class="block__customer">
                    <div class="block__icon block__icon--color3">
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                    <div class="block__content">
                        <div class="block__title">
                            Customer Tracking
                        </div>
                        <div class="block__description ">
                        Monitor your performance with <br> real-time tracking,
                        quiz results, <br> and project milestones.
                        Get personalized insights to improve faster.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--what is alpha-->
        <section class="alpha">
            <div class="alpha__container">
                <div class="alpha__content">
                    <h2 class="alpha__title">What is
                        <span class="alpha___highligt-text">
                            ALPHA?
                        </span>
                    </h2>
                    <p class="alpha__description">
                    ALPHA offers a complete coding–learning platform where you can study C, C++, PHP,<br>
                    Python, Java, and more through structured lessons, hands-on projects, real-time guidance,<br>
                    and progress tracking — all in one powerful online system.
                    </p>
                </div>
            </div>
        </section>

        <!--2 boxs-->
        <div class="boxes">
            <div class="box box--instructors">
                <div class="box__title">
                    FOR INSTRUCTORS
                </div>
                <button class="box__btn1">Start a class today</button>
            </div>
            <div class="box box--students">
                <div class="box__title">
                    FOR STUDENTS
                </div>
                <button class="box__btn2">Enter access code</button>
            </div>
        </div>

        <section class="totc-feature-section">
            <div class="feature-content">
                <div class="deco-block-1 top-left1-deco"></div>
                <div class="contents">
                    <h2 class="feature-heading">
                        Everything you can do in a physical <br>classroom,
                        <span class="highlight-blue">you can do with TOTC</span>
                    </h2>
                    <p class="feature-description">
                    ALPHA gives you a full online coding experience with structured lessons,<br>
                    live sessions, hands-on projects, and personalized support.<br>
                    Whether you're learning C, C++, PHP, Python, or Java, you can study anytime,<br>
                    anywhere, with the same effectiveness as an in-person class — all powered<br>
                    by our modern cloud-based platform.
                    </p>
                    <a href="#" class="learn-more">Learn more</a>
                </div>
                <div class="deco-block-2 bottom-right1-deco"></div>
            </div>

            <div class="feature-visual">
                <div class="deco-block-3 top-left2-deco"></div>
                <img src="./uploads/IMAGE/confident-teacher-explaining-lesson-pupils 1.png" alt="Teacher instructing students in a hybrid classroom setting" class="classroom-image">
                <div class="deco-block-4 bottom-right2-deco"></div>
            </div>
        </section>
    
        <section class="feature-sections">
            <div class="section-headers section-header--centered">
                <h2 class="section-headers__title">
                    Our 
                    <span class="section-headers__title-highlight">Features</span>
                </h2>
                <p class="section-headers__subtitle">
                This set of powerful features makes learning programming<br>
                easier, faster, and more engaging.
                </p>
            </div>
        </section>

        <section class="virtuals">
            <!--deco blocks top-->
            <div class="block__top-green"></div>
            <div class="block__top-blue"></div>

            <div class="virtuals__zooms">
                <div class="app-frame__header">
                    <div class="app-frame__dot app-frame__dot--red"></div>
                    <div class="app-frame__dot app-frame__dot--yellow"></div>
                    <div class="app-frame__dot app-frame__dot--green"></div>
                </div>

                <!-- zoom-->
                <div class="virtuals-class">
                    <div class="virtuals-class-one">
                        <div class="zoom__inst">
                            <img src="./uploads/IMAGE/portrait-teacher-giving-online-class 1.png" alt="Instructor on the meet" class="virtuals-class__inst">
                            <div class="virtuals-class__infor">
                                <div class="virtuals-class__icon"><i class="fa-solid fa-signal"></i></div>
                                <div class="virtuals-class__office">Instructor</div>
                                <div class="virtuals-class__name">Eveny Howard</div>
                            </div>
                        </div>
                        <!--button-->
                        <div class="virtuals-class__controls">
                            <button class="virtuals-class__button virtuals-class__button--present">Present</button>
                            <button class="virtuals-class__button1 virtuals-class__button--call">
                                 <i class="fas fa-phone-alt call-icon"></i> Call
                            </button>
                        </div>
                    </div>

                    <div class="virtuals-class-two">
                        <div class="zoom__member1">
                            <img src="./uploads/IMAGE/image 7.png" alt="Collaborator on the meet" class="virtuals-class__col">
                            <div class="virtuals-class__infor-list">
                                <div class="virtuals-class__icon"><i class="fa-solid fa-signal"></i></div>
                                <div class="virtuals-class__name">Tamara Clarke</div>
                            </div>
                        </div>

                        <div class="zoom__member2">
                            <img src="./uploads/IMAGE/Mask Group.png" alt="Collaborator on the meet" class="virtuals-class__col">
                            <div class="virtuals-class__infor-list">
                                <div class="virtuals-class__icon"><i class="fa-solid fa-signal"></i></div>
                                <div class="virtuals-class__name">Humbert Holland</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="virtuals__mem">
                <div class="zoom__member3">
                    <img src="./uploads/IMAGE/Mask Group (1).png" alt="Collaborator on the meet" class="virtuals-class__col3">
                    <div class="virtuals-class__infor-list-3">
                        <div class="virtuals-class__icon"><i class="fa-solid fa-signal"></i></div>
                        <div class="virtuals-class__name">Adam Levin</div>
                    </div>
                </div>
                <div class="zoom__member4">
                    <img src="./uploads/IMAGE/image 10.png" alt="Collaborator on the meet" class="virtuals-class__col4">
                    <div class="virtuals-class__infor-list-4">
                        <div class="virtuals-class__icon"><i class="fa-solid fa-signal"></i></div>
                        <div class="virtuals-class__name">Paticia Mendoza</div>
                    </div>
                </div>
            </div>

            <!--deco blocks - bottom -->
            <div class="block__bottom-red"></div>
            <div class="block__bottom-purple"></div>

            <div class="virtuals__content">
                <h2 class="virtuals__title">
                    A <span class="virtuals__title--highlight">user interface</span> designed<br>
                    for the classroom
                </h2>
                <ul class="virtuals__list">
                    <li class="virtuals__item">
                        <div class="virtuals__icon"><i class="fa-solid fa-grip"></i></div>
                        <p class="virtuals__text">
                        Clear, distraction-free layout that helps learners <br> focus on coding lessons and projects.
                        </p>
                    </li>

                    <li class="virtuals__item">
                        <div class="virtuals__icon"><i class="fa-solid fa-layer-group"></i></div>
                        <p class="virtuals__text">
                        Instructors and mentors can highlight key <br> explanations during live sessions.
                        </p>
                    </li>

                    <li class="virtuals__item">
                        <div class="virtuals__icon"><i class="fa-solid fa-user-group"></i></div>
                        <p class="virtuals__text">
                        Students can easily follow along, view code examples, <br>and track class progress in real time.
                        </p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="tools">
            <div class="tools__content">
                <h2 class="tools__title">
                    <span class="tools__highlight">Tools </span>
                    For Teachers <br>And Learners
                </h2>
                <p class="tools__description">
                ALPHA provides a powerful set of coding tools <br> designed to support both learners
                and instructors. <br> Students can practice code in real-time,<br> receive instant feedback,
                and submit projects easily, <br> while mentors can guide, review, and track progress<br>
                directly on the platform.
                </p>
                <div class="tools__deco-hand"><i class="fa-regular fa-hand"></i></div>
            </div>

            <div class="tools__image">
                <div class="tools__decor tools__decor--back"></div>
                <div class="tools__decor tools__decor--icon-left"><i class="fa-solid fa-clipboard-list"></i></div>
                <div class="tools__decor tools__decor--icon-right"><i class="fa-solid fa-person-chalkboard"></i></div>

                <div class="tools__photo">
                    <img src="uploads/IMAGE/image (1).png" alt="Teacher with books" class="tools__photo-img">
                </div>

                <div class="tools__decor tools__decor--dots"></div>

                <div class="deco-dot dot-green"></div>
                <div class="deco-dot dot-orange"></div>
                <div class="deco-dot dot-purple"></div>
            </div>
        </section>

        <section class="questions">
            <div class="questions__form">
                <div class="questions__deco deco-ques--orange"></div>
                <div class="questions__deco deco-ques--purpule"></div>

                <!--icon ture- false-->
                <div class="questions__icon-tf icon-ques--false"><i class="fa-regular fa-circle-xmark"></i></div>
                <div class="questions__icon-tf icon-ques--true"><i class="fa-regular fa-circle-check"></i></div>

                <div class="question__form-1">
                    <div class="question__form-button">
                        Question 1
                    </div>
                    <p class="question__form-note">
                    True or false? <br>Arrays in C have fixed size.
                    </p>
                </div>
                
                <div class="questions__image">
                    <img src="./uploads/IMAGE/Mask Group (2).png" alt="ảnh" class="questions__image-deco">
                </div>

                <div class="questions__form-2 ">
                    <div class="questions__form-icon "><i class="fa-solid fa-plane-departure"></i></div>
                    <p class="questions__form-2--note ">
                        Your answer was <br> sent successfully
                        <div class="questions__deco deco-ques--greens"></div>
                    </p>
                </div> 

                <div class="questions__deco deco-ques--pick"></div>
                <div class="questions__deco deco-ques--green"></div>
            </div>

            <div class="questions__content">
                <h2 class="questions__title">
                    Assessments,<br><span class="questions__title-hight">Quizzes, </span>Tests
                </h2>
                <p class="questions__desctription">
                Improve your programming skills with interactive <br> quizzes, coding challenges,
                and real-time tests designed<br>for languages like C, C++, PHP, Python, and Java.<br>
                All results are automatically evaluated and recorded, <br>helping you track your
                progress and <br> identify areas to improve..
                </p>
            </div>
        </section>

        <section class="class-management">
            <div class="management-content">
                <h2 class="management-title">
                    <span class="highlights">Class Management</span> 
                    <br>
                    Tools for Educators
                </h2>
                <p class="management-description">
                ALPHA provides powerful tools to help instructors <br> 
                manage their coding classes effortlessly. <br> 
                Track student progress, monitor completed lessons, <br> 
                review code submissions, and grade quizzes or challenges <br>
                in real time. The integrated GradeBook gives a clear <br> 
                overview of each learner’s performance across all <br>
                programming modules.
                </p>
            </div>

            <div class="gradebook-mockup">  
                <div class="gradebook-card">

                    <div class="start-icon--shadow">
                        <div class="star-icon">
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>

                    <div class="book-icon--shadow">
                        <div class="book-icon">
                            <i class="fa-solid fa-book"></i>
                        </div>
                    </div>

                    <div class="card-header">
                        <p class="header-title">GradeBook</p>
                    </div>

                    <div class="crossbar crossbarr--blue"></div>
                    <div class="student-row top-left">
                        <div class="avatar">
                            <img src="./uploads/IMAGE/Mask Group.png" alt="admin1" class="avatar-img">
                        </div>
                        <div class="score-bar bar-blue">100</div>
                        <div class="king"><i class="fa-solid fa-crown"></i></div>
                    </div>
                    
                    <div class="crossbar crossbarr--dark"></div>
                    <div class="student-row top-right">
                        <div class="avatar">
                            <img src="./uploads/IMAGE/Mask Group (1).png" alt="admin1" class="avatar-img">
                        </div>
                        <div class="score-bar bar-dark">98</div>
                    </div>

                    <div class="crossbar crossbarr--green"></div>
                    <div class="student-row bottom-center">
                        <div class="avatar">
                            <img src="./uploads/IMAGE/image 7.png" alt="admin1" class="avatar-img">
                        </div>
                        <div class="score-bar bar-green">85</div>
                    </div>
                    
                    <div class="crossbar crossbarr--red"></div>
                    <div class="student-row bottom-right">
                        <div class="avatar">
                            <img src="./uploads/IMAGE/image 10.png" alt="admin1" class="avatar-img">
                        </div>
                        <div class="score-bar bar-red">75</div>
                    </div>

                    <button class="export-button">Export</button>
                </div>
                
                <div class="deco-wave"><i class="fa-solid fa-water"></i></div>
                <div class="deco-bubble bubble-1"></div>
                <div class="deco-bubble bubble-2"></div>
                <div class="deco-bubbles bubble-3"></div>
            </div>
        </section>

        <section class="discussion-section">
            <div class="mockup-area">

                <div class="window-base-shadow"></div>

                <div class="window-large">
                    <div class="window-dots">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                    </div>
                    <div class="mockup-image-bg">
                        <div class="mockup-image-men1">
                            <img src="./uploads/IMAGE/image 7.png" alt="ảnh 1" class="mockup-image-deco">
                        </div>
                        <div class="mockup-image-men2">
                            <img src="./uploads/IMAGE/Mask Group.png" alt="ảnh 2" class="mockup-image-deco">
                        </div>
                    </div>
                    <button class="blue-button--shadow">Successs on</button>
                </div>

                <div class="window-small">
                    <div class="window-dots">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                    </div>

                    <div class="icon-group-wrapper">
                        <div class="deco-icon-group">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                    </div>

                    <div class="image-grid">
                        <div class="image-pane teacher-pane">
                            <img src="./uploads/IMAGE/portrait-teacher-giving-online-class 1.png" alt="Teacher with headset" class="pane-img">
                        </div>
                        
                        <div class="image-pane student-pane">
                            <img src="./uploads/IMAGE/image 10.png" alt="Student Patricia Mendoza" class="pane-img">
                            <span class="student-name">
                                <i class="fas fa-chart-bar"></i> Patricia Mendoza
                            </span>
                        </div>
                    </div>
                    
                    <div class="footer-controls">
                        <p class="private-text">
                            Private Discussion<br>
                            <strong class="text-small">Your video can't be seen by others</strong>
                        </p>
                        <button class="end-button">End Discussion</button>
                    </div>
                </div>
                
                <div class="deco-circle circle-blue-top"></div>
                <div class="deco-arrow"></div>
            </div>

            <div class="text-content">
                <h2 class="discussion-title">
                    One-on-One <br>
                    <span class="highlight">Coding Support</span>
                </h2>
                <p class="discussion-description">
                Get private, personalized help from mentors  <br> 
                whenever you need it. Discuss your code, fix <br> 
                errors together, review assignments, and receive<br>
                direct guidance without leaving the learning platform.
                </p>
            </div>
        </section>

        <section class="see-more">
            <button class="more-button">See more features</button>
        </section>

        <!-- Khóa học -->
        <script src="script.js"></script>
        <div class="container__course">
            <div class="container__course-header">
                <div class="container__course-title">Explore Course</div>
                <p class="course__subtitle">Discover practical programming courses designed to help you master C, C++,<br>
                PHP, Python, Java, and more — from beginner to advanced levels.</p>
            </div>

            <section class="course-section">
                <div class="section-header">
                    <div class="section-title">
                        <span class="icon">🌐</span>
                        <h2>Informations</h2>
                    </div>
                    <a href="#" class="see-all">SEE ALL <span class="arrow">→</span></a>
                </div>

                <div class="course-content">
                    <div class="pills-wrapper">
                        <div class="pills-container" id="pills-container">
                            <div class="pill-outer pill" data-course="course1">
                                <div class="pill-inner-green"><div class="pill-orange"><div class="pill-text">C Programming</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course2">
                                <div class="pill-inner-green"><div class="pill-pink"><div class="pill-text">C++ OOP</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course3">
                                <div class="pill-inner-green"><div class="pill-brown"><div class="pill-text">PHP Fundamentals</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course4">
                                <div class="pill-inner-green"><div class="pill-yellow"><div class="pill-text">HTML & CSS Basics</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course5">
                                <div class="pill-inner-green"><div class="pill-purple"><div class="pill-text">JavaScript for Beginners</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course6">
                                <div class="pill-inner-green"><div class="pill-blue"><div class="pill-text">Python Core</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course7">
                                <div class="pill-inner-green"><div class="pill-green--dark"><div class="pill-text">Java Programmings</div></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="course-card" id="course-card-single">
                        <div class="course--img">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400" alt="Food dish" id="course-image">
                            <div class="card-badge" id="course-badge">LOREM IPSUM</div>
                        </div>
                        <div class="card-content">
                            <h3 id="course-title">Integer id Orc Sed Ante Tincidunt</h3>
                            <p id="course-desc">Cras convallis lacus orci, tristique tincidunt magna fringilla at faucibus vel.</p>
                            <div class="card-footer">
                                <div class="rating" id="course-rating">
                                    <span class="star">⭐</span>
                                    <span class="star">⭐</span>
                                    <span class="star">⭐</span>
                                    <span class="star">⭐</span>
                                    <span class="star">⭐</span>
                                </div>
                                <div class="price" id="course-price">$ 450</div>
                            </div>
                            <button class="explore-btn">EXPLORE</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="testimonial-section">
            <div class="testimonial-container">
                <div class="testimonial-content">
                    <div class="line-text">
                        <div class="line"></div>
                        <p class="section-tag">TESTIMONIAL</p>
                    </div>
                    <h2 class="section-title">What Developers Say?</h2>
                    
                    <p class="description">
                    Our programming courses have helped more than 100k learners worldwide start their tech careers.
                    </p>
                    <p class="description">
                    Many students and developers improved their coding skills and landed better job opportunities through our platform.
                    </p>
                    
                    <p class="call-to-action">Are you one of them? Share your learning experience with us.</p>
                    
                    <button class="assessment-btn">
                        Write your assessment 
                        <span class="arrow-icon">→</span>
                    </button>
                </div>

                <div class="testimonial-card-wrapper">
                    <div class="testimonial-card">
                        <div class="card-image-container">
                            <img src="./uploads/IMAGE/Mask Group (3).png" alt="A smiling young woman holding files" class="card-image">
                            <button class="nav-arrow right">
                                <span class="arrow-icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </button>
                        </div>
                        
                        <div class="card-review">
                            <p class="review-text">
                            "These programming courses are amazing. The explanations are clear, the projects are practical, 
                                and I learned much faster than I expected. Thanks to this platform, I finally understand C, Python,
                                and JavaScript much better. "
                            </p>

                            <div class="review-footer">
                                <div class="user-info">
                                    <p class="user-name">Gloria Rose</p>
                                </div>
                                <div class="tolo_start">
                                    <div class="rating-stars">
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                        <span class="star">★</span>
                                    </div>
                                    <p class="review-source">12 reviews at Yelp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="news-section">
            <div class="news-header">
                <h2 class="section-title">Lastest News and Resources</h2>
                <p class="section-subtitle">Stay updated with the newest trends, tools, and breakthroughs in programming and software development.
                </p>
            </div>

            <div class="news-container">
                <div class="featured-article">
                    <div class="article-image-container">
                        <img src="./uploads/IMAGE/Group 40.png" alt="Zoom meeting on a laptop" class="article-image">
                        <span class="article-badge news-badge">NEWS</span>
                    </div>
                    <div class="article-content">
                        <h3>Our Coding Courses Now Reach Over 150,000 <br>
                         Learners Worldwide
                        </h3>
                        <p>Thanks to our updated curriculum in C, Python, JavaScript,<br>
                         and other modern technologies, thousands of students have advanced<br>
                          their programming skills and secured new career opportunities.
                        </p>
                        <a href="#" class="read-more">Read more</a>
                    </div>
                </div>

                <div class="side-articles">
                    <div class="side-article-item">
                        <div class="item-image-container">
                            <img src="data:image/jpeg;base64,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" alt="Girl using tablet" class="item-image">
                            <span class="article-badge press-badge">PRESS RELEASE</span>
                        </div>
                        <div class="item-content">
                            <h4>AI Tools Are Transforming How Developers Learn Programming
                            </h4>
                            <p>New AI-powered coding assistants are helping students...
                            </p>
                        </div>
                    </div>

                    <div class="side-article-item">
                        <div class="item-image-container">
                            <img src="data:image/jpeg;base64,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" alt="Person working on laptop" class="item-image">
                            <span class="article-badge news-badge">NEWS</span>
                        </div>
                        <div class="item-content">
                            <h4>JavaScript Remains the Most In-Demand Skill for 2025 Developers
                            </h4>
                            <p>Companies continue to seek JavaScript developers...
                            </p>
                        </div>
                    </div>

                    <div class="side-article-item">
                        <div class="item-image-container">
                            <img src="data:image/jpeg;base64,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" alt="Cat on laptop" class="item-image">
                            <span class="article-badge news-badge">NEWS</span>
                        </div>
                        <div class="item-content">
                            <h4>Python Continues to Dominate Data Science and Machine Learning
                            </h4>
                            <p>A recent report shows Python adoption growing at...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'footer.php'; ?>
    </body>
</html>
