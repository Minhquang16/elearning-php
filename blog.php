<?php
// index.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>TOTC Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/CSS/main.css">
        <link rel="stylesheet" href="./assets/CSS/base.css">
        <link rel="stylesheet" href="./assets/CSS/course_detail.css">
         <link rel="stylesheet" href="./assets/CSS/blog.css">
    
</head>
<body>
<div class="page">

    <!-- HEADER -->
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
                <li class="header-nav__item"><a href="landing.php" class="header-nav__link">Home</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">Courses</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">Careers</a></li>
                <li class="header-nav__item"><a href="blog.php" class="header-nav__link">Blog</a></li>
                <li class="header-nav__item"><a href="#" class="header-nav__link">About Us</a></li>
            </ul>
        </nav>

        <div class="header-nav__profile">
            <img src="https://assets.realmadrid.com/is/image/realmadrid/1330603286208?$Mobile$&fit=wrap&wid=312" alt="Profile Picture" class="header-nav__avatar">
            <span class="header-nav__name">CR7</span>
            <span class="header-nav__toggle"><i class="fa-solid fa-chevron-down"></i></span>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="container hero-inner">
            <div>
                <p class="hero-tagline">By Themadrbrains in <span>inspiration</span></p>
                <h1 class="hero-title">
                    Why Swift UI Should Be on the Radar of Every Mobile Developer
                </h1>
                <p class="hero-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sitamet,
                    consectetur adipiscing elit, sed do eiusmod tempor.
                </p>
                <button class="btn-primary">Start learning now</button>
            </div>
            <div class="hero-media">
                <img src="uploads/IMAGE/Group 40 (1).png" alt="Hero">
            </div>
        </div>
    </section>

    <!-- READING BLOG LIST -->
    <section>
        <div class="container">
            <h2 class="section-title">Reading blog list</h2>
            <div class="reading-grid">
                <?php
                $reading = ["UX/UI", "React", "PHP", "JavaScript"];
                foreach ($reading as $item): ?>
                    <div class="reading-card">
                        <img src="uploads/IMAGE/Group 251.png" alt="<?= $item ?>">
                        <div class="reading-card-label">
                            <span class="reading-pill"><?= $item ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- RELATED BLOG -->
    <section style="background: var(--bg);">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" style="margin-bottom:0;">Related Blog</h2>
                <a href="#" class="link-small">See all</a>
            </div>
            <div class="related-grid">
                <?php for ($i = 0; $i < 2; $i++): ?>
                    <article class="related-card">
                        <div class="related-media">
                            <img src="uploads/IMAGE/Rectangle 23.png" alt="Related">
                        </div>
                        <h3 class="related-title">
                            Class adds $30 million to its balance sheet for a Zoom-friendly edtech solution
                        </h3>
                        <div class="author-row">
                            <img src="uploads/IMAGE/Group 40 (1).png" alt="Lina">
                            <span>Lina</span>
                        </div>
                        <p class="related-desc">
                            Class, launched less than a year ago by Blackboard co-founder Michael Chasen, integrates exclusively...
                        </p>
                        <div class="related-footer">
                            <a href="#" class="link-small">Read more</a>
                            <div class="view-row">
                                <span class="view-icon"></span>
                                <span>251,232</span>
                            </div>
                        </div>
                    </article>
                <?php endfor; ?>
            </div>
            <div class="slider-controls">
                <button class="slider-btn">&#8249;</button>
                <button class="slider-btn">&#8250;</button>
            </div>
        </div>
    </section>

    <!-- MARKETING ARTICLES -->
    <section>
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" style="margin-bottom:0;">Marketing Articles</h2>
                <a href="#" class="link-small">See all</a>
            </div>
            <div class="marketing-grid">
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <article class="marketing-card">
                        <div class="marketing-media">
                            <img src="uploads/IMAGE/Rectangle 33.png" alt="Course">
                        </div>
                        <div class="marketing-body">
                            <div class="meta-row">
                                <span>Design</span>
                                <span>3 Month</span>
                            </div>
                            <h3 class="marketing-title">AWS Certified solutions Architect</h3>
                            <p class="marketing-desc">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                            </p>
                            <div class="marketing-footer">
                                <div class="marketing-author">
                                    <img src="uploads/IMAGE/image 12.png" alt="Lina">
                                    <span>Lina</span>
                                </div>
                                <div>
                                    <span class="price-old">$100</span>
                                    <span class="price-new">$80</span>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
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

</div>
</body>
</html>
