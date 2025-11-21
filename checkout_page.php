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
        <link rel="stylesheet" href="./assets/CSS/checkout_page.css">
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
    Tuyệt vời! Đây là khối Thanh toán (Checkout Form) và Tóm tắt đơn hàng (Order Summary). Đây là khối cuối cùng trong chuỗi giao diện thanh toán.

Tôi sẽ cung cấp mã HTML với cấu trúc BEM và CSS để tái tạo toàn bộ khối này.

💻 Code Giao diện (HTML & CSS)
1. HTML Structure
Đây là cấu trúc HTML. Chúng ta sẽ đặt Checkout Form và Summary trong một container Flexbox để chúng nằm cạnh nhau. Bạn có thể lưu nó dưới tên checkout-page.html.

HTML

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="checkout-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="checkout-wrapper">
        <div class="checkout-layout">
            <section class="checkout-form-section">
                <h2 class="checkout-form__title">Checkout</h2>
                <form class="payment-form">
                    <h4 class="payment-form__subtitle">Cart Type</h4>
                    <div class="payment-methods">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkNuec_LJ5EAkOpnoH0L04wYSFKum6t-4goQ&s" alt="PayPal" class="payment-logo">
                        <img src="https://1000logos.net/wp-content/uploads/2016/10/American-Express-Color.png" alt="American Express" class="payment-logo">
                        <img src="https://1000logos.net/wp-content/uploads/2017/06/VISA-Logo-2006.png" alt="VISA" class="payment-logo">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD7oa6-WXok1YXYt8GN4CWbzJOpeBf69159Q&s" alt="MasterCard" class="payment-logo">
                    </div>
                    
                    <div class="form-group">
                        <label for="card-name" class="form-label">Name on Card</label>
                        <input type="text" id="card-name" placeholder="Enter Name on Card" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="card-number" class="form-label">Card Number</label>
                        <input type="text" id="card-number" placeholder="Enter Card Number" class="form-input">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group form-group--half">
                            <label for="expiry-date" class="form-label">Expiration Date (MM/YY)</label>
                            <input type="text" id="expiry-date" placeholder="Enter Expiration Date" class="form-input">
                        </div>
                        <div class="form-group form-group--half">
                            <label for="cvc" class="form-label">CVC</label>
                            <input type="text" id="cvc" placeholder="Enter CVC" class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="save-info">
                        <label for="save-info">Save my information for faster checkout</label>
                    </div>
                    
                    <button type="submit" class="confirm-button">Confirm Payment</button>
                    
                </form>
            </section>
            
            <aside class="order-summary">
                <h2 class="order-summary__title">Summary</h2>
                <div class="summary-items">
                    <div class="summary-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/1200px-Python-logo-notext.svg.png" alt="Item Image" class="summary-item__image">
                        <div class="summary-item__details">
                            <p class="summary-item__name">adipiscing elit, sed do eiusmod tempor</p>
                            <p class="summary-item__desc">Lorem ipsum dollar...</p>
                        </div>
                        <span class="summary-item__price">$24.69</span>
                    </div>

                    <div class="summary-item">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/ISO_C%2B%2B_Logo.svg/250px-ISO_C%2B%2B_Logo.svg.png" alt="Item Image" class="summary-item__image">
                        <div class="summary-item__details">
                            <p class="summary-item__name">sed do eiusmod tempor adipiscing elit</p>
                            <p class="summary-item__desc">Lorem ipsum dollar...</p>
                        </div>
                        <span class="summary-item__price">$24.69</span>
                    </div>
                </div>
                
                <div class="summary-totals">
                    <div class="summary-total-row">
                        <span>Subtotal</span>
                        <span class="total-value">$51.38</span>
                    </div>
                    <div class="summary-total-row">
                        <span>Coupon Discount</span>
                        <span class="total-value total-value--discount">0 %</span>
                    </div>
                    <div class="summary-total-row">
                        <span>TAX</span>
                        <span class="total-value total-value--tax">5</span>
                    </div>
                    <div class="summary-total-row summary-total-row--final">
                        <span>Total</span>
                        <span class="total-value total-value--final">$56.38</span>
                    </div>
                </div>
            </aside>
        </div>
    </div>
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
                    
                    <img src="./uploads/IMAGE/Rectangle 32.png" alt="Online Class" class="offer-card__image">
                    
                    <div class="offer-card__overlay offer-card__overlay--dark">
                         <span class="offer-card__badge offer-card__badge--50">50%</span>
                        
                        <h3 class="offer-card__title">Lorem ipsum dolor</h3>
                        <p class="offer-card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="offer-card">
                <div class="offer-card__media">
                    <img src="./uploads/IMAGE/Rectangle 33.png" alt="Kid Learning" class="offer-card__image">
                    <div class="offer-card__overlay offer-card__overlay--dark">
                        <span class="offer-card__badge offer-card__badge--10">10%</span>
                        
                        <h3 class="offer-card__title">Lorem ipsum dolor</h3>
                        <p class="offer-card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        </p>
                    </div>
                </div>
            </div>

            <div class="offer-card">
                <div class="offer-card__media">
                    <img src="./uploads/IMAGE/Rectangle 37.png" alt="Cat Online Class" class="offer-card__image">
                    <div class="offer-card__overlay offer-card__overlay--dark">
                        <span class="offer-card__badge offer-card__badge--50">50%</span>
                        
                        <h3 class="offer-card__title">Lorem ipsum dolor</h3>
                        <p class="offer-card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
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