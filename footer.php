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
                        <a href="search.php" class="footer-link">All Courses</a>
                        <span class="link-separator">·</span>
                        <a href="contact.php" class="footer-link">Contact</a>
                        <span class="link-separator">·</span>
                        <a href="#" class="footer-link">Terms & Conditions</a>
                    </div>
                    <p class="copyright-text">
                        © Web E-Learning Nhom 1
                    </p>
                </div>
            </div>
            <script>
document.addEventListener('DOMContentLoaded', function () {
    const profile = document.querySelector('.header-nav__profile');
    const userBtn = document.querySelector('.header-nav__user');

    if (!profile || !userBtn) return;

    // Toggle khi click vào nút tài khoản
    userBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        profile.classList.toggle('header-nav__profile--open');
    });

    // Click ra ngoài thì đóng dropdown
    document.addEventListener('click', function () {
        profile.classList.remove('header-nav__profile--open');
    });
});
</script>

        </footer>