<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lỏ</title>
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
    <header class="header-nav">
        <div class="header-nav__left">
                <div class="header__logo">
                    <div class="header__logo-icon">
                    <i class="fa-brands fa-codiepie"></i>
                    </div>
                    dev <br> Alpha
                </div>
        </div>

        <nav class="header-nav__menu">
            <ul class="header-nav__list">
                <li class="header-nav__item"><a href="#" class="header-nav__link">Home</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">Courses</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">Careers</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">Blog</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">About Us</a></li>
            </ul>
        </nav>

        <div class="header-nav__profile">
            <img src="https://assets.realmadrid.com/is/image/realmadrid/1330603286208?$Mobile$&fit=wrap&wid=312" alt="Profile Picture" class="header-nav__avatar">
            <span class="header-nav__name">CR7</span>
            <span class="header-nav__toggle"><i class="fa-solid fa-chevron-down"></i></span>
        </div>
    </header>
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

    <section class="recommend-section">
        
        <header class="recommend-header">
            <h2 class="recommend-header__title">Recommended for you</h2>
            <a href="#" class="recommend-header__link">See all</a>
        </header>

        <div class="course-slider-container">
            <div class="course-slider-grid">
                
                <div class="course-card">
                    <div class="course-card__media">
                        <img src="https://springo.vn/image/cache/data/top5ungdunghotrohoctienganh-_1600x900-800-resize-500x333.jpg" alt="Student Learning" class="course-card__image">
                    </div>
                    
                    <div class="course-card__content">
                        <div class="course-card__meta">
                            <span class="course-card__category">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>

                        <div class="course-card__footer">
                            <div class="course-card__user">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-foreign-graduates-happy-picture_501055503.jpg" alt="Lina" class="course-card__avatar">
                                <span class="course-card__name">Lina</span>
                            </div>
                            <div class="course-card__price">
                                <span class="course-card__old-price">$180</span>
                                <span class="course-card__current-price">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="course-card"> 
                <div class="course-card__media">
                        <img src="https://letdiv.com/wp-content/uploads/2024/04/khoa-hoc-javascript.jpg" alt="Student Learning" class="course-card__image">
                    </div>
                    
                    <div class="course-card__content">
                        <div class="course-card__meta">
                            <span class="course-card__category">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>

                        <div class="course-card__footer">
                            <div class="course-card__user">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-overseas-students-take-books-picture_501031928.jpg" alt="Lina" class="course-card__avatar">
                                <span class="course-card__name">Lina</span>
                            </div>
                            <div class="course-card__price">
                                <span class="course-card__old-price">$180</span>
                                <span class="course-card__current-price">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-card"> 
                <div class="course-card__media">
                        <img src="https://itc.utt.edu.vn/wp-content/uploads/2023/09/php-course.jpg" alt="Student Learning" class="course-card__image">
                    </div>
                    
                    <div class="course-card__content">
                        <div class="course-card__meta">
                            <span class="course-card__category">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>

                        <div class="course-card__footer">
                            <div class="course-card__user">
                                <img src="https://img.lovepik.com/free-png/20211215/lovepik-student-and-foreign-teacher-and-group-photo-png-image_401636400_wh1200.png" alt="Lina" class="course-card__avatar">
                                <span class="course-card__name">Lina</span>
                            </div>
                            <div class="course-card__price">
                                <span class="course-card__old-price">$180</span>
                                <span class="course-card__current-price">$80</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course-card"> 
                    <div class="course-card__media">
                            <img src="https://funix.edu.vn/wp-content/uploads/2022/12/C-phat-trien-tren-ngon-ngu-lap-trinh-C.jpg" alt="Student Learning" class="course-card__image">
                        </div>
                        
                        <div class="course-card__content">
                            <div class="course-card__meta">
                                <span class="course-card__category">
                                    <i class="fas fa-palette"></i> Design
                                </span>
                                <span class="course-card__duration">
                                    <i class="fas fa-clock"></i> 3 Month
                                </span>
                            </div>
                            
                            <h3 class="course-card__title">AWS Certified solutions Architect</h3>
                            
                            <p class="course-card__description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            </p>

                            <div class="course-card__footer">
                                <div class="course-card__user">
                                    <img src="https://img.lovepik.com/free-png/20211215/lovepik-foreign-teachers-campus-image-png-image_401636396_wh1200.png" alt="Lina" class="course-card__avatar">
                                    <span class="course-card__name">Lina</span>
                                </div>
                                <div class="course-card__price">
                                    <span class="course-card__old-price">$180</span>
                                    <span class="course-card__current-price">$80</span>
                                </div>
                            </div>
                        </div>
                    </div>
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

<!--Dãy khóa 2-->
    <section class="recommend-section-2">
            
        <header class="recommend-header-2">
            <h2 class="recommend-header__title-2">Get choice of your course</h2>
            <a href="#" class="recommend-header__link-2">See all</a>
        </header>

        <div class="course-slider-container-2">
            <div class="course-slider-grid-2">
                
                <div class="course-card-2">
                    <div class="course-card__media-2">
                        <img src="https://springo.vn/image/cache/data/top5ungdunghotrohoctienganh-_1600x900-800-resize-500x333.jpg" alt="Student Learning" class="course-card__image-2">
                    </div>
                    
                    <div class="course-card__content-2">
                        <div class="course-card__meta-2">
                            <span class="course-card__category-2">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-2">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-2">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>

                        <div class="course-card__footer-2">
                            <div class="course-card__user-2">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-foreign-graduates-happy-picture_501055503.jpg" alt="Lina" class="course-card__avatar-2">
                                <span class="course-card__name-2">Lina</span>
                            </div>
                            <div class="course-card__price-2">
                                <span class="course-card__old-price-2">$180</span>
                                <span class="course-card__current-price-2">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="course-card-2"> 
                    <div class="course-card__media-2">
                        <img src="https://letdiv.com/wp-content/uploads/2024/04/khoa-hoc-javascript.jpg" alt="Student Learning" class="course-card__image-2">
                    </div>
                    
                    <div class="course-card__content-2">
                        <div class="course-card__meta-2">
                            <span class="course-card__category-2">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-2">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-2">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>

                        <div class="course-card__footer-2">
                            <div class="course-card__user-2">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-overseas-students-take-books-picture_501031928.jpg" alt="Lina" class="course-card__avatar-2">
                                <span class="course-card__name-2">Lina</span>
                            </div>
                            <div class="course-card__price-2">
                                <span class="course-card__old-price-2">$180</span>
                                <span class="course-card__current-price-2">$80</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course-card-2"> 
                    <div class="course-card__media-2">
                        <img src="https://itc.utt.edu.vn/wp-content/uploads/2023/09/php-course.jpg" alt="Student Learning" class="course-card__image-2">
                    </div>
                    
                    <div class="course-card__content-2">
                        <div class="course-card__meta-2">
                            <span class="course-card__category-2">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-2">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-2">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>

                        <div class="course-card__footer-2">
                            <div class="course-card__user-2">
                                <img src="https://img.lovepik.com/free-png/20211215/lovepik-student-and-foreign-teacher-and-group-photo-png-image_401636400_wh1200.png" alt="Lina" class="course-card__avatar-2">
                                <span class="course-card__name-2">Lina</span>
                            </div>
                            <div class="course-card__price-2">
                                <span class="course-card__old-price-2">$180</span>
                                <span class="course-card__current-price-2">$80</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course-card-2"> 
                    <div class="course-card__media-2">
                            <img src="https://funix.edu.vn/wp-content/uploads/2022/12/C-phat-trien-tren-ngon-ngu-lap-trinh-C.jpg" alt="Student Learning" class="course-card__image-2">
                        </div>
                        
                        <div class="course-card__content-2">
                            <div class="course-card__meta-2">
                                <span class="course-card__category-2">
                                    <i class="fas fa-palette"></i> Design
                                </span>
                                <span class="course-card__duration-2">
                                    <i class="fas fa-clock"></i> 3 Month
                                </span>
                            </div>
                            
                            <h3 class="course-card__title-2">AWS Certified solutions Architect</h3>
                            
                            <p class="course-card__description-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            </p>

                            <div class="course-card__footer-2">
                                <div class="course-card__user-2">
                                    <img src="https://img.lovepik.com/free-png/20211215/lovepik-foreign-teachers-campus-image-png-image_401636396_wh1200.png" alt="Lina" class="course-card__avatar-2">
                                    <span class="course-card__name-2">Lina</span>
                                </div>
                                <div class="course-card__price-2">
                                    <span class="course-card__old-price-2">$180</span>
                                    <span class="course-card__current-price-2">$80</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <div class="cta-banner-wrapper">
            <section class="cta-banner">
                <h1 class="cta-banner__title">
                    Online coaching lessons for remote learning.
                </h1>
                <p class="cta-banner__description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempos Lorem ipsum dolor 
                    sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                </p>
                <a href="#" class="cta-banner__button">
                    Start learning now
                </a>
            </section>
    </div>

<!--Dãy khóa 3 -->
<section class="recommend-section-3">
        
        <header class="recommend-header-3">
            <h2 class="recommend-header__title-3">The course in personal development</h2>
            <a href="#" class="recommend-header__link-3">See all</a>
        </header>
    
        <div class="course-slider-container-3">
            <div class="course-slider-grid-3">
                
                <div class="course-card-3">
                    <div class="course-card__media-3">
                        <img src="https://springo.vn/image/cache/data/top5ungdunghotrohoctienganh-_1600x900-800-resize-500x333.jpg" alt="Student Learning" class="course-card__image-3">
                    </div>
                    
                    <div class="course-card__content-3">
                        <div class="course-card__meta-3">
                            <span class="course-card__category-3">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-3">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-3">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-3">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
    
                        <div class="course-card__footer-3">
                            <div class="course-card__user-3">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-foreign-graduates-happy-picture_501055503.jpg" alt="Lina" class="course-card__avatar-3">
                                <span class="course-card__name-3">Lina</span>
                            </div>
                            <div class="course-card__price-3">
                                <span class="course-card__old-price-3">$180</span>
                                <span class="course-card__current-price-3">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="course-card-3"> 
                    <div class="course-card__media-3">
                        <img src="https://letdiv.com/wp-content/uploads/2024/04/khoa-hoc-javascript.jpg" alt="Student Learning" class="course-card__image-3">
                    </div>
                    
                    <div class="course-card__content-3">
                        <div class="course-card__meta-3">
                            <span class="course-card__category-3">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-3">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-3">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-3">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
    
                        <div class="course-card__footer-3">
                            <div class="course-card__user-3">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-overseas-students-take-books-picture_501031928.jpg" alt="Lina" class="course-card__avatar-3">
                                <span class="course-card__name-3">Lina</span>
                            </div>
                            <div class="course-card__price-3">
                                <span class="course-card__old-price-3">$180</span>
                                <span class="course-card__current-price-3">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="course-card-3"> 
                    <div class="course-card__media-3">
                        <img src="https://itc.utt.edu.vn/wp-content/uploads/2023/09/php-course.jpg" alt="Student Learning" class="course-card__image-3">
                    </div>
                    
                    <div class="course-card__content-3">
                        <div class="course-card__meta-3">
                            <span class="course-card__category-3">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-3">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-3">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-3">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
    
                        <div class="course-card__footer-3">
                            <div class="course-card__user-3">
                                <img src="https://img.lovepik.com/free-png/20211215/lovepik-student-and-foreign-teacher-and-group-photo-png-image_401636400_wh1200.png" alt="Lina" class="course-card__avatar-3">
                                <span class="course-card__name-3">Lina</span>
                            </div>
                            <div class="course-card__price-3">
                                <span class="course-card__old-price-3">$180</span>
                                <span class="course-card__current-price-3">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="course-card-3"> 
                    <div class="course-card__media-3">
                            <img src="https://funix.edu.vn/wp-content/uploads/2022/12/C-phat-trien-tren-ngon-ngu-lap-trinh-C.jpg" alt="Student Learning" class="course-card__image-3">
                        </div>
                        
                        <div class="course-card__content-3">
                            <div class="course-card__meta-3">
                                <span class="course-card__category-3">
                                    <i class="fas fa-palette"></i> Design
                                </span>
                                <span class="course-card__duration-3">
                                    <i class="fas fa-clock"></i> 3 Month
                                </span>
                            </div>
                            
                            <h3 class="course-card__title-3">AWS Certified solutions Architect</h3>
                            
                            <p class="course-card__description-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            </p>
    
                            <div class="course-card__footer-3">
                                <div class="course-card__user-3">
                                    <img src="https://img.lovepik.com/free-png/20211215/lovepik-foreign-teachers-campus-image-png-image_401636396_wh1200.png" alt="Lina" class="course-card__avatar-3">
                                    <span class="course-card__name-3">Lina</span>
                                </div>
                                <div class="course-card__price-3">
                                    <span class="course-card__old-price-3">$180</span>
                                    <span class="course-card__current-price-3">$80</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>

<!--Dãy khóa 4-->
    <section class="recommend-section-4">
        
        <header class="recommend-header-4">
            <h2 class="recommend-header__title-4">Student are viewing</h2>
            <a href="#" class="recommend-header__link-4">See all</a>
        </header>
    
        <div class="course-slider-container-4">
            <div class="course-slider-grid-4">
                
                <div class="course-card-4">
                    <div class="course-card__media-4">
                        <img src="https://springo.vn/image/cache/data/top5ungdunghotrohoctienganh-_1600x900-800-resize-500x333.jpg" alt="Student Learning" class="course-card__image-4">
                    </div>
                    
                    <div class="course-card__content-4">
                        <div class="course-card__meta-4">
                            <span class="course-card__category-4">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-4">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-4">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-4">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
    
                        <div class="course-card__footer-4">
                            <div class="course-card__user-4">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-foreign-graduates-happy-picture_501055503.jpg" alt="Lina" class="course-card__avatar-4">
                                <span class="course-card__name-4">Lina</span>
                            </div>
                            <div class="course-card__price-4">
                                <span class="course-card__old-price-4">$180</span>
                                <span class="course-card__current-price-4">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="course-card-4"> 
                    <div class="course-card__media-4">
                        <img src="https://letdiv.com/wp-content/uploads/2024/04/khoa-hoc-javascript.jpg" alt="Student Learning" class="course-card__image-4">
                    </div>
                    
                    <div class="course-card__content-4">
                        <div class="course-card__meta-4">
                            <span class="course-card__category-4">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-4">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-4">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-4">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
    
                        <div class="course-card__footer-4">
                            <div class="course-card__user-4">
                                <img src="https://watermark.lovepik.com/photo/20211125/large/lovepik-overseas-students-take-books-picture_501031928.jpg" alt="Lina" class="course-card__avatar-4">
                                <span class="course-card__name-4">Lina</span>
                            </div>
                            <div class="course-card__price-4">
                                <span class="course-card__old-price-4">$180</span>
                                <span class="course-card__current-price-4">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="course-card-4"> 
                    <div class="course-card__media-4">
                        <img src="https://itc.utt.edu.vn/wp-content/uploads/2023/09/php-course.jpg" alt="Student Learning" class="course-card__image-4">
                    </div>
                    
                    <div class="course-card__content-4">
                        <div class="course-card__meta-4">
                            <span class="course-card__category-4">
                                <i class="fas fa-palette"></i> Design
                            </span>
                            <span class="course-card__duration-4">
                                <i class="fas fa-clock"></i> 3 Month
                            </span>
                        </div>
                        
                        <h3 class="course-card__title-4">AWS Certified solutions Architect</h3>
                        
                        <p class="course-card__description-4">
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
    
                        <div class="course-card__footer-4">
                            <div class="course-card__user-4">
                                <img src="https://img.lovepik.com/free-png/20211215/lovepik-student-and-foreign-teacher-and-group-photo-png-image_401636400_wh1200.png" alt="Lina" class="course-card__avatar-4">
                                <span class="course-card__name-4">Lina</span>
                            </div>
                            <div class="course-card__price-4">
                                <span class="course-card__old-price-4">$180</span>
                                <span class="course-card__current-price-4">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="course-card-4"> 
                    <div class="course-card__media-4">
                            <img src="https://funix.edu.vn/wp-content/uploads/2022/12/C-phat-trien-tren-ngon-ngu-lap-trinh-C.jpg" alt="Student Learning" class="course-card__image-4">
                        </div>
                        
                        <div class="course-card__content-4">
                            <div class="course-card__meta-4">
                                <span class="course-card__category-4">
                                    <i class="fas fa-palette"></i> Design
                                </span>
                                <span class="course-card__duration-4">
                                    <i class="fas fa-clock"></i> 3 Month
                                </span>
                            </div>
                            
                            <h3 class="course-card__title-4">AWS Certified solutions Architect</h3>
                            
                            <p class="course-card__description-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            </p>
    
                            <div class="course-card__footer-4">
                                <div class="course-card__user-4">
                                    <img src="https://img.lovepik.com/free-png/20211215/lovepik-foreign-teachers-campus-image-png-image_401636396_wh1200.png" alt="Lina" class="course-card__avatar-4">
                                    <span class="course-card__name-4">Lina</span>
                                </div>
                                <div class="course-card__price-4">
                                    <span class="course-card__old-price-4">$180</span>
                                    <span class="course-card__current-price-4">$80</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="main-footer">
            <div class="footer-container">
            <div class="footer-header">
                <div class="footer__logo">
                    <div class="footer__logo-icon">
                        <i class="fa-brands fa-codiepie"></i>
                    </div>
                    dev <br> Alpha
                </div>
                <div class="vertical-divider"></div>
                <div class="footer-title">Virtual Class <br> for Zoom</div>
            </div>

                <div class="newsletter-section">
                    <p class="subscribe-text">Subscribe to get our Newsletter</p>
                    <form class="subscribe-form">
                        <input type="email" placeholder="Your Email" class="email-input" required>
                        <button type="submit" class="subscribe-btn">Subscribe</button>
                    </form>
                </div>

                <div class="footer-links-and-copyright">
                    <div class="footer-links">
                        <a href="#" class="footer-link">Careers</a>
                        <span class="link-separator">·</span>
                        <a href="#" class="footer-link">Privacy Policy</a>
                        <span class="link-separator">·</span>
                        <a href="#" class="footer-link">Terms & Conditions</a>
                    </div>
                    <p class="copyright-text">
                        © 2021 Class Technologies Inc.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>