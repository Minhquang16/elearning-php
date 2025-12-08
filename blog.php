<?php include 'header.php'; ?>

<body>
<div class="page">
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
     <?php include 'footer.php'; ?>

</div>
</body>
</html>
