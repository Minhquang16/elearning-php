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
        <link rel="stylesheet" href="./assets/CSS/course.css">
        <link rel="stylesheet" href="./assets/CSS/base.css">
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
                            <a href="" class="header__nav-item-link">Home</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="" class="header__nav-item-link">Courses</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="" class="header__nav-item-link">Careers</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="" class="header__nav-item-link">Blog</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="" class="header__nav-item-link">About Us</a>
                        </li>
                    </ul>
                </nav>
                <!--auth buttons-->
                <div class="header__auth">
                    <a href="" class="btn btn--login">Login</a>
                    <a href="" class="btn btn--singin">Sign Up</a>
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
                                <div class="card__icon card__icon--blue">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <div class="card__content">
                                    <div class="card__number">250k</div>
                                    <div class="card__label">Assisted Student</div>
                                </div>
                            </div>

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
    </body>