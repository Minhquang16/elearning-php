<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>okt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/CSS/course.css">
    <link rel="stylesheet" href="./assets/CSS/base.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-7.0.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/CSS/footer.css">
    <link rel="stylesheet" href="./assets/CSS/base.css">
    <link rel="stylesheet" href="assets/CSS/checkout_page.css">
    <link rel="stylesheet" href="./assets/CSS/course_detail.css">
    <link rel="stylesheet" href="./assets/CSS/blog.css">
    <link rel="stylesheet" href="assets/CSS/checkout_page.css">
    <link rel="stylesheet" href="assets/CSS/search.css">
    <link rel="stylesheet" href="assets/CSS/literature-course.css">
    <link rel="stylesheet" href="assets/CSS/course.css">
    <link rel="stylesheet" href="assets/CSS/cart.css">
    <link rel="stylesheet" href="assets/CSS/search.css">
    <link rel="stylesheet" href="assets/CSS/contact.css">
</head>
<body>
<style>
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
        background: #ffffff;
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
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e4ebff;
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
            <li class="header-nav__item"><a href="course.php" class="header-nav__link">My Courses</a></li>
            <li class="header-nav__item"><a href="search.php" class="header-nav__link">All Courses</a></li>
            <li class="header-nav__item"><a href="blog.php" class="header-nav__link">Blog</a></li>
            <li class="header-nav__item"><a href="blog-details.php" class="header-nav__link">About Us</a></li>
        </ul>
    </nav>

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
</header>

<script>
// Toggle dropdown mở/đóng
document.addEventListener('click', function (e) {
    const profile = document.querySelector('.header-nav__profile');
    if (!profile) return;

    const button = profile.querySelector('.header-nav__user');

    // Click vào nút avatar -> toggle
    if (button && button.contains(e.target)) {
        profile.classList.toggle('header-nav__profile--open');
        return;
    }

    // Click ra ngoài -> đóng
    if (!profile.contains(e.target)) {
        profile.classList.remove('header-nav__profile--open');
    }
});
</script>

</body>
</html>
