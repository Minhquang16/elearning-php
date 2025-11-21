<!DOCTYPE html>
<html lang="en">
    <head>
        <title>okt</title>
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
        <link rel="stylesheet" href="assets/CSS/footer.css">
        <link rel="stylesheet" href="./assets/CSS/base.css">
        <link rel="stylesheet" href="./assets/CSS/course_detail.css">
         <link rel="stylesheet" href="./assets/CSS/blog.css">
         <link rel="stylesheet" href="assets/CSS/checkout_page.css">
         <link rel="stylesheet" href="assets/CSS/search.css">
         <link rel="stylesheet" href="assets/CSS/literature-course.css">
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
                <li class="header-nav__item"><a href="index.php" class="header-nav__link">Home</a></li>
                <li class="header-nav__item"><a href="course.php" class="header-nav__link">Courses</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">Careers</a></li>
                <li class="header-nav__item"><a href="blog.php" class="header-nav__link">Blog</a></li>
                <li class="header-nav__item"><a href="blog-details.php" class="header-nav__link">About Us</a></li>
            </ul>
        </nav>

        <div class="header-nav__profile">
            <img src="https://assets.realmadrid.com/is/image/realmadrid/1330603286208?$Mobile$&fit=wrap&wid=312" alt="Profile Picture" class="header-nav__avatar">
            <span class="header-nav__name">CR7</span>
            <span class="header-nav__toggle"><i class="fa-solid fa-chevron-down"></i></span>
        </div>
    </header>
    </body>
