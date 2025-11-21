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
        <link rel="stylesheet" href="./assets/CSS/course_detail.css">
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
    <main class="course-page-layout">
        
        <section class="course-header-section">
            <div class="header-media-area">
                <img src="./uploads/IMAGE/Rectangle 77.png" alt="Classroom Meeting" class="main-image">
                
                <aside class="sidebar-cta">
                    <div class="sidebar-cta__image-box">
                        <img src="./uploads/IMAGE/Rectangle 77.png" alt="Small Classroom View" class="sidebar-cta__image">
                    </div>
                    
                    <div class="sidebar-cta__price-box">
                        <span class="current-price">$49.65</span>
                        <span class="old-price">$99.99</span>
                        <span class="discount">50% Off</span>
                    </div>
                    
                    <p class="sidebar-cta__timer">11 hour left at this price</p>
                    
                    <button class="sidebar-cta__button">Buy Now</button>
                    
                    <div class="course-features">
                        <h4 class="course-features__title">This Course included</h4>
                        <ul class="course-features__list">
                            <li><i class="fas fa-check-circle"></i> Money Back Guarantee</li>
                            <li><i class="fas fa-mobile-alt"></i> Access on all devices</li>
                            <li><i class="fas fa-certificate"></i> Certification of completion</li>
                            <li><i class="fas fa-layer-group"></i> 22 Moduls</li>
                        </ul>
                    </div>
                    
                    <div class="course-training">
                        <h4 class="course-training__title">Training 5 or more people</h4>
                        <p class="course-training__text">Class, launched less than a year ago by Blackboard co-founder Michael Chasen, integrates exclusively...</p>
                    </div>

                    <div class="course-share">
                        <h4 class="course-share__title">Share this course</h4>
                        <div class="course-share__icons">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-instagram"></i>
                            <i class="fab fa-youtube"></i>
                            <i class="fab fa-pinterest-p"></i>
                        </div>
                    </div>
                </aside>
            </div>
            
            <div class="tabs-nav">
                <button class="tab-btn">Overview</button>
                <button class="tab-btn">Overview</button>
                <button class="tab-btn">Overview</button>
                <button class="tab-btn tab-btn--active">Overview</button>
            </div>
        </section>

        <section class="main-content-area">
            <div class="review-box">
                <div class="review-box__rating-summary">
                    <div class="rating-display">
                        <span class="rating-display__score">4 out of 5</span>
                        <div class="rating-display__stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="rating-display__text">Top Raiting</span>
                    </div>
                    
                    <div class="rating-bars">
                        <div class="rating-bar-item">
                            <span>5 Stars</span>
                            <div class="bar-container"><div class="bar-fill" style="width: 80%;"></div></div>
                        </div>
                         <div class="rating-bar-item">
                            <span>4 Stars</span>
                            <div class="bar-container"><div class="bar-fill" style="width: 65%;"></div></div>
                        </div>
                         <div class="rating-bar-item">
                            <span>3 Stars</span>
                            <div class="bar-container"><div class="bar-fill" style="width: 40%;"></div></div>
                        </div>
                         <div class="rating-bar-item">
                            <span>2 Stars</span>
                            <div class="bar-container"><div class="bar-fill" style="width: 20%;"></div></div>
                        </div>
                         <div class="rating-bar-item">
                            <span>1 Stars</span>
                            <div class="bar-container"><div class="bar-fill" style="width: 15%;"></div></div>
                        </div>
                    </div>
                </div>

                <div class="review-item">
                    <div class="review-item__header">
                        <img src="https://media-cdn-v2.laodong.vn/storage/newsportal/2023/6/30/1210827/339006310_3359181837.jpg" alt="Lina" class="review-item__avatar">
                        <span class="review-item__name">Mason Mount</span>
                        <div class="review-item__stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        </div>
                        <span class="review-item__time">3 Month</span>
                    </div>
                    <p class="review-item__text">
                         Class, launched less than a year ago by Blackboard co-founder Michael Chasen, integrates exclusively...
                    </p>
                </div>
                
                <div class="review-item">
                    <div class="review-item__header">
                        <img src="https://b.fssta.com/uploads/application/soccer/headshots/24167.vresize.350.350.medium.1.png" alt="Lina" class="review-item__avatar">
                        <span class="review-item__name">N'Golo Kante</span>
                        <div class="review-item__stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        </div>
                        <span class="review-item__time">3 Month</span>
                    </div>
                    <p class="review-item__text">
                         Class, launched less than a year ago by Blackboard co-founder Michael Chasen, integrates exclusively...
                    </p>
                </div>
                
            </div>
        </section>
    </main>
    <section class="recommend-section-2">
            
        <header class="recommend-header-2">
            <h2 class="recommend-header__title-2">Marketing Articles</h2>
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
                            
                            <img src="./uploads/IMAGE/box1.png" alt="Instructor" class="offer-card__image">
                            
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
                            <img src="./uploads/IMAGE/box1.png" alt="Instructor" class="offer-card__image">
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
                            <img src="./uploads/IMAGE/box1.png" alt="Instructor" class="offer-card__image">
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