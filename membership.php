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
        <link rel="stylesheet" href="./assets/CSS/membership.css">
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

    <section class="pricing">
        <h2 class="pricing__title">Affordable pricing</h2>

        <div class="pricing__table">
            
            <div class="pricing__card pricing__card--starter">
                <div class="pricing__header">
                    <h3 class="pricing__plan-name">Like a pussy</h3>
                    <p class="pricing__plan-price">Free <span class="pricing__plan-period">/ FOREVER</span></p>
                </div>
                
                <ul class="pricing__features">
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon1"><i class="fa-solid fa-circle-check"></i></span>
                    Components-driven system</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon1"><i class="fa-solid fa-circle-check"></i></span>
                        Sales-boosting landing pages</li>
                    <li class="pricing__feature-item pricing__feature-item--disabled"><span class="icon1"><i class="fa-solid fa-circle-check"></i></span>
                        Awesome Feather icons pack</li>
                </ul>
                
                <button class="pricing__button pricing__button--outline">Try for free</button>
            </div>
            
            <div class="pricing__card pricing__card--best">
                <div class="pricing__badge">BEST!</div>
                <div class="pricing__header">
                    <h3 class="pricing__plan-name">
                        <i class="pricing__icon"><i class="fa-solid fa-user"></i></i> Individual
                    </h3>
                    <p class="pricing__plan-price">$24 <span class="pricing__plan-period">/ MONTH</span></p>
                </div>
                
                <ul class="pricing__features">
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon2"><i class="fa-solid fa-circle-check"></i></span>
                        Components-driven system</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon2"><i class="fa-solid fa-circle-check"></i></span>
                        Sales-boosting landing pages</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon2"><i class="fa-solid fa-circle-check"></i></span>
                        Awesome Feather icons pack</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon2"><i class="fa-solid fa-circle-check"></i></span>
                        Themed into 3 different styles</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon2"><i class="fa-solid fa-circle-check"></i></span>
                        Will help to learn Figma</li>
                </ul>
                
                <button class="pricing__button pricing__button--outline">Regular license</button>
            </div>
            
            <div class="pricing__card pricing__card--corporate">
                <div class="pricing__header">
                    <h3 class="pricing__plan-name">
                        <i class="pricing__icon"><i class="fa-solid fa-users"></i></i> Corporate
                    </h3>
                    <p class="pricing__plan-price">$12 <span class="pricing__plan-period">/ EDITOR</span></p>
                </div>
                
                <ul class="pricing__features">
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon3"><i class="fa-solid fa-circle-check"></i></span>
                        Components-driven system</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon3"><i class="fa-solid fa-circle-check"></i></span>
                        Sales-boosting landing pages</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon3"><i class="fa-solid fa-circle-check"></i></span>
                        Awesome Feather icons pack</li>
                    <li class="pricing__feature-item pricing__feature-item--checked"><span class="icon3"><i class="fa-solid fa-circle-check"></i></span>
                        Themed into 3 different styles</li>
                </ul>
                
                <button class="pricing__button pricing__button--outline">Extended license</button>
            </div>
            
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.pricing__card');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    cards.forEach(c => {
                        c.classList.remove('pricing__card--active');
                    });
                    this.classList.add('pricing__card--active');
                });
            });
        });
    </script>

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

        <section class="accordion-section">
        <h2 class="accordion-section__title">
            Online coaching lessons for remote learning
        </h2>
        
        <div class="accordion-list">
            
            <div class="accordion-item">
                <button class="accordion-item__header" aria-expanded="false">
                    <span class="accordion-item__icon"></span>
                    <span class="accordion-item__question">Lorem ipsum dolor sit amet</span>
                    <span class="accordion-item__arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="accordion-item__content" hidden>
                    <p>Nội dung câu trả lời sẽ xuất hiện ở đây.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-item__header" aria-expanded="false">
                    <span class="accordion-item__icon"></span>
                    <span class="accordion-item__question">Consectetur adipiscing elit, sed do</span>
                    <span class="accordion-item__arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="accordion-item__content" hidden>
                    <p>Nội dung câu trả lời sẽ xuất hiện ở đây.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-item__header" aria-expanded="false">
                    <span class="accordion-item__icon"></span>
                    <span class="accordion-item__question">Eiusmod tempos Lorem ipsum</span>
                    <span class="accordion-item__arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="accordion-item__content" hidden>
                    <p>Nội dung câu trả lời sẽ xuất hiện ở đây.</p>
                </div>
            </div>

            <div class="accordion-item accordion-item--open">
                <button class="accordion-item__header" aria-expanded="true">
                    <span class="accordion-item__icon"></span>
                    <span class="accordion-item__question">Lorem ipsum dolor sit amet</span>
                    <span class="accordion-item__arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="accordion-item__content" hidden>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor 
                        sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur 
                        adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet.
                    </p>
                </div>
            </div>

             <div class="accordion-item">
                <button class="accordion-item__header" aria-expanded="false">
                    <span class="accordion-item__icon"></span>
                    <span class="accordion-item__question">Lorem ipsum dolor sit amet</span>
                    <span class="accordion-item__arrow"><i class="fa-solid fa-chevron-down"></i></span>
                </button>
                <div class="accordion-item__content" hidden>
                    <p>Nội dung câu trả lời sẽ xuất hiện ở đây.</p>
                </div>
            </div>
            
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headers = document.querySelectorAll('.accordion-item__header');
            
            headers.forEach(header => {
                header.addEventListener('click', function() {
                    const item = this.closest('.accordion-item');
                    const content = item.querySelector('.accordion-item__content');
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    // Đóng tất cả các mục khác
                    document.querySelectorAll('.accordion-item').forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('accordion-item--open');
                            otherItem.querySelector('.accordion-item__header').setAttribute('aria-expanded', 'false');
                            otherItem.querySelector('.accordion-item__content').setAttribute('hidden', '');
                        }
                    });

                    // Mở hoặc đóng mục hiện tại
                    if (isExpanded) {
                        item.classList.remove('accordion-item--open');
                        this.setAttribute('aria-expanded', 'false');
                        content.setAttribute('hidden', '');
                    } else {
                        item.classList.add('accordion-item--open');
                        this.setAttribute('aria-expanded', 'true');
                        content.removeAttribute('hidden');
                    }
                });
            });
        });
    </script>
    <section class="testimonials-section">
        <h2 class="testimonials-section__title">
            What our students have to say
        </h2>
        
        <div class="testimonial-slider">
            <button class="slider__nav-btn slider__nav-btn--prev">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="slider__track">
                <div class="testimonial-card">
                    <div class="testimonial-card__head">
                        <img src="https://pbs.twimg.com/media/Gxly6IRXkAAR1z2.png" alt="Bulkin Simons" class="testimonial-card__avatar">
                        <h3 class="testimonial-card__name">Nicolas Jackson</h3>
                    </div>
                    <p class="testimonial-card__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmodadipiscing elit, sed do eiusmod
                    </p>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-card__head">
                        <img src="https://cdn.soccerwiki.org/images/player/80336.png" alt="Bulkin Simons" class="testimonial-card__avatar">
                        <h3 class="testimonial-card__name">André Onana</h3>
                    </div>
                    <p class="testimonial-card__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmodadipiscing elit, sed do eiusmod
                    </p>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-card__head">
                        <img src="https://b.fssta.com/uploads/application/soccer/headshots/6318.png" alt="Bulkin Simons" class="testimonial-card__avatar">
                        <h3 class="testimonial-card__name">Harry Maguire</h3>
                    </div>
                    <p class="testimonial-card__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmodadipiscing elit, sed do eiusmod
                    </p>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-card__head">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSCJGzmRxda90ieKzv06-Xvkrt8ViitiZNHU6OBI6TqgmYtsynN3whIeZCBwHsQDO-zpw&usqp=CAU" alt="Bulkin Simons" class="testimonial-card__avatar">
                        <h3 class="testimonial-card__name">Endrick</h3>
                    </div>
                    <p class="testimonial-card__text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmodadipiscing elit, sed do eiusmod
                    </p>
                </div>
            </div>
            
            <button class="slider__nav-btn slider__nav-btn--next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>
    <section class="app-cta-banner">
        <div class="app-cta-banner__content">
            <h2 class="app-cta-banner__title">APP is available for free</h2>
            <div class="app-cta-banner__buttons">
                <a href="#" class="app-cta-banner__btn app-cta-banner__btn--android">
                    <i class="fab fa-android"></i> Android APP
                </a>
                <a href="#" class="app-cta-banner__btn app-cta-banner__btn--ios">
                    <i class="fab fa-apple"></i> IOS APP
                </a>
            </div>
        </div>
    </section>
    <section class="card-grid-section">
        <div class="card-grid">
            <div class="course-card">
                <div class="course-card__media">
                    <img src="https://5.imimg.com/data5/MK/MF/GA/SELLER-22577115/it-courses.jpg" alt="Online Video Conference" class="course-card__image">
                </div>
                
                <div class="course-card__content">
                    <h3 class="course-card__title">Become a Teacher</h3>
                    <p class="course-card__description">
                        Class, launched less than a year ago by Blackboard co-founder 
                        Michael Chasen, integrates exclusively...
                    </p>
                    <a href="#" class="course-card__button course-card__button--teacher">
                        Apply a Teacher
                    </a>
                </div>
            </div>

            <div class="course-card">
                <div class="course-card__media">
                    <img src="https://www.visme.co/wp-content/uploads/2021/12/comparison-chart-maker-header-new-1024x582.jpg" alt="Online Video Conference" class="course-card__image">
                </div>
                
                <div class="course-card__content">
                    <h3 class="course-card__title">Become a Coursector</h3>
                    <p class="course-card__description">
                        Class, launched less than a year ago by Blackboard co-founder 
                        Michael Chasen, integrates exclusively...
                    </p>
                    <a href="#" class="course-card__button course-card__button--coursector">
                        Apply a Coursector
                    </a>
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
<html