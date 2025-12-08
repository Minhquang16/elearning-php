<?php
session_start();
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
        <div class="banner">
        <header class="header">
            <div class="header__container">
                <!--logo-->
                <div class="header__logo">
                    <div class="header__logo-icon">
                    <i class="fa-brands fa-codiepie"></i>
                    </div>
                    dev <br> Alpha
                </div>
                <!--nav-->
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a href="index.php" class="header__nav-item-link">Home</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="course.php" class="header__nav-item-link">Courses</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="" class="header__nav-item-link">Careers</a>
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
            <div class="header__auth">
    <?php if (isset($_SESSION['user'])): ?>
        
        <div class="header__profile">
            <img src="uploads/IMAGE/default-avatar.png" class="header__avatar" alt="avatar">
            <span class="header__username">
                <?= htmlspecialchars($_SESSION['user']['username']) ?>
            </span>
            <a href="controllers/AuthController.php?action=logout" class="btn btn--logout">Logout</a>
        </div>

    <?php else: ?>

        <a href="login.php" class="btn btn--login">Login</a>
        <a href="register.php" class="btn btn--singin">Sign Up</a>

    <?php endif; ?>
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
                                TOTC is an interesting platform that will teach <br> you in more an interactive way
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
                            </div>
                                </a>
                                

                            <!-- Congratulations Card -->
                            <div class="card card--notification card--middle-right">
                                <div class="card__icon card__icon--orange">
                                <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="card__content">
                                    <div class="card__title">Congratulations</div>
                                    <div class="card__subtitle">Your admission completed</div>
                                </div>
                            </div>

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
                            Ornare id fames interdum porttitor nulla turpis etiam. Diam vitae sollicitudin at nec 
                            <br>nam et pharetra gravida. Adipiscing a quis ultrices eu ornare tristique vel nisl orci.
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
                        TOTC is one powerful online software suite that combines all the tools
                        <br> needed to run a successful school or office.

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
                            Simple and secure control of your<br>
                            organization's financial and legal<br>
                            transactions. Send customized<br>
                            invoices and contracts
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
                            Schedule and reserve classrooms at<br>
                            one campus or multiple campuses.<br>
                             Keep detailed records of student <br>
                             attendance
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
                            Automate and track emails to<br>
                            individuals or groups. Skilline's<br>
                            built-in system helps organize<br>
                            your organization 
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
                        ALPHA is a platform that allows educators to create online classes whereby they can<br>
                        store the course materials online; manage assignments, quizzes and exams; monitor<br>
                        due dates; grade results and provide students with feedback all in one place.<br>
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
                        This very extraordinary feature, can make learning activities more efficient
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
                        Teachers don't get lost in the grid view <br> and have a dedicated Podium space.
                        </p>
                    </li>

                    <li class="virtuals__item">
                        <div class="virtuals__icon"><i class="fa-solid fa-layer-group"></i></div>
                        <p class="virtuals__text">
                        TA's and presenters can be moved to <br>the front of the class.
                        </p>
                    </li>

                    <li class="virtuals__item">
                        <div class="virtuals__icon"><i class="fa-solid fa-user-group"></i></div>
                        <p class="virtuals__text">
                        Teachers can easily see all students <br>and class data at one time.
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
                Class has a dynamic set of teaching tools built to<br>
                be deployed and used during class. Teachers can<br>
                hand out assignments in real-time for students to<br>
                complete and submit.
                </p>
                <div class="tools__deco-hand"><i class="fa-regular fa-hand"></i></div>
            </div>

            <div class="tools__image">
                <div class="tools__decor tools__decor--back"></div>
                <div class="tools__decor tools__decor--icon-left"><i class="fa-solid fa-clipboard-list"></i></div>
                <div class="tools__decor tools__decor--icon-right"><i class="fa-solid fa-person-chalkboard"></i></div>

                <div class="tools__photo">
                <img src="./uploads/IMAGE/image 12.png" alt="Teacher with books" class="tools__photo-img">
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
                            True or false? This play <br>
                            takes place in Italy</p>
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
                Easily launch live assignments, quizzes, and <br> tests.
                Student results are automatically entered in<br> the online gradebook.
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
                    Class provides tools to help run and manage the class <br>
                    such as Class Roster, Attendance, and more. With the <br>
                    Gradebook, teachers can review and grade tests and <br>
                    quizzes in real-time.
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
                    <span class="highlight">Discussions</span>
                </h2>
                <p class="discussion-description">
                    Teachers and teacher assistants can talk with <br>
                    students privately without leaving the Zoom <br>
                    environment.
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
                <p class="course__subtitle">Ut sed eros finibus, placerat orci id, dapibus.</p>
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
                                <div class="pill-inner-green"><div class="pill-orange"><div class="pill-text">Ut Sed Eros</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course2">
                                <div class="pill-inner-green"><div class="pill-pink"><div class="pill-text">Coure - Css</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course3">
                                <div class="pill-inner-green"><div class="pill-brown"><div class="pill-text">Quistelus Advieront</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course4">
                                <div class="pill-inner-green"><div class="pill-yellow"><div class="pill-text">Cur Socion Sit</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course5">
                                <div class="pill-inner-green"><div class="pill-purple"><div class="pill-text">Vestilum IT Ibique</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course6">
                                <div class="pill-inner-green"><div class="pill-blue"><div class="pill-text">Ut Sed Eleos</div></div></div>
                            </div>
                            <div class="pill-outer pill" data-course="course7">
                                <div class="pill-inner-green"><div class="pill-green--dark"><div class="pill-text">Vestlibum IT Ibisque</div></div></div>
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
                        <h2 class="section-title">What They Say?</h2>
                        
                        <p class="description">
                            TOTC has got more than 100k positive ratings from our users around the world.
                        </p>
                        <p class="description">
                            Some of the students and teachers were greatly helped by the Skillline.
                        </p>
                        
                        <p class="call-to-action">Are you too? Please give your assessment</p>
                        
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
                                    "Thank you so much for your help. It's exactly what I've been looking for. You won't regret it. It really saves me time and effort. TOTC is exactly what our business has been lacking."
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
                <p class="section-subtitle">See the developments that have occurred to TOTC in the world</p>
            </div>

            <div class="news-container">
                <div class="featured-article">
                    <div class="article-image-container">
                        <img src="./uploads/IMAGE/Group 40.png" alt="Zoom meeting on a laptop" class="article-image">
                        <span class="article-badge news-badge">NEWS</span>
                    </div>
                    <div class="article-content">
                        <h3>Class adds $30 million to its balance sheet for <br> a Zoom-friendly edtech solution</h3>
                        <p>Class, launched less than a year ago by Blackboard <br> co-founder Michael Chasen, integrates exclusively...</p>
                        <a href="#" class="read-more">Read more</a>
                    </div>
                </div>

                <div class="side-articles">
                    <div class="side-article-item">
                        <div class="item-image-container">
                            <img src="./uploads/IMAGE/Rectangle 33.png" alt="Girl using tablet" class="item-image">
                            <span class="article-badge press-badge">PRESS RELEASE</span>
                        </div>
                        <div class="item-content">
                            <h4>Class Technologies Inc. Closes $30 Million Series A Financing to Meet High Demand</h4>
                            <p>Class Technologies Inc., the company that created Class,...</p>
                        </div>
                    </div>

                    <div class="side-article-item">
                        <div class="item-image-container">
                            <img src="./uploads/IMAGE/Rectangle 34.png" alt="Person working on laptop" class="item-image">
                            <span class="article-badge news-badge">NEWS</span>
                        </div>
                        <div class="item-content">
                            <h4>Zoom's earliest investors are betting millions on a better Zoom for schools</h4>
                            <p>Zoom was never created to be a consumer product. Nonetheless, the...</p>
                        </div>
                    </div>

                    <div class="side-article-item">
                        <div class="item-image-container">
                            <img src="./uploads/IMAGE/Rectangle 37.png" alt="Cat on laptop" class="item-image">
                            <span class="article-badge news-badge">NEWS</span>
                        </div>
                        <div class="item-content">
                            <h4>Former Blackboard CEO Raises $16M to Bring LMS Features to Zoom Classrooms</h4>
                            <p>This year, investors have reaped big financial returns from betting on Zoom...</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>