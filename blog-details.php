<?php
// blog-detail.php
$author = [
    "name"   => "Lina",
    "avatar" => "uploads/IMAGE/image 12.png"
];

$post = [
    "title"   => "Why Swift UI Should Be on the Radar of Every Mobile Developer",
    "hero"    => "uploads/IMAGE/group236 blog detai.png",
    "tags"    => ["affordable", "stunning", "making", "modbrawns"],
    "content" => [
        "TOTC is a platform that allows educators to create online classes whereby they can store the course materials online; manage assignments, quizzes and exams; monitor due dates; grade results and provide students with feedback all in one place.",
        "TOTC is a platform that allows educators to create online classes whereby they can store the course materials online; manage assignments, quizzes and exams; monitor due dates; grade results and provide students with feedback all in one place. TOTC is a platform that allows educators to create online classes whereby they can store the course materials online.",
        "TOTC is a platform that allows educators to create online classes whereby they can store the course materials online; manage assignments, quizzes and exams; monitor due dates; grade results and provide students with feedback all in one place.",
        "TOTC is a platform that allows educators to create online classes whereby they can store the course materials online; manage assignments, quizzes and exams; monitor due dates; grade results and provide students with feedback all in one place."
    ]
];
?>
<?php include 'header.php'; ?>
    <style>
        :root{
            --navy: #2F327D;
            --ink: #1F2559;
            --muted: #8B90B5;
            --text: #4C5271;
            --bg: #F6F8FE;
            --card: #FFFFFF;
            --teal: #29C6C6;
            --teal-dark:#12B3B2;
            --line: #E7ECFF;
            --shadow: 0 14px 34px rgba(24, 39, 75, .08);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:"Poppins",sans-serif;color:var(--text);background:var(--bg)}
        a{text-decoration:none;color:inherit}
        img{max-width:100%;display:block}

        .container{max-width:1140px;margin:0 auto;padding:0 20px}

        /* ========== HEADER ========== */
        header{background:#fff;box-shadow:0 3px 14px rgba(30,42,90,.06);position:sticky;top:0;z-index:50}
        .nav{display:flex;align-items:center;justify-content:space-between;padding:16px 0}
        .brand{display:flex;align-items:center;gap:12px}
        .diamond{
            width:36px;height:36px;border:2px solid var(--teal);
            transform:rotate(45deg);border-radius:6px;display:flex;align-items:center;justify-content:center;
            color:var(--navy);font-weight:700;font-size:10px;background:#fff;
        }
        .diamond span{transform:rotate(-45deg)}
        .menu{display:flex;gap:30px;list-style:none}
        .menu a{color:#5A628F;font-weight:500}
        .menu a.active,.menu a:hover{color:var(--teal-dark)}
        .user{display:flex;align-items:center;gap:10px}
        .user img{width:34px;height:34px;border-radius:50%;object-fit:cover}
        .caret{width:6px;height:6px;border-right:2px solid #9aa3c6;border-bottom:2px solid #9aa3c6;transform:rotate(45deg)}
        /* sectiom */
        section{
            padding: 0;
        }
        /* HERO */
        .hero img{width:100%;height:420px;object-fit:cover}

        /* ARTICLE */
        .article{background:#fff}
        .article .container{padding:40px 20px 60px}
        h1.title{font-size:28px;color:var(--navy);text-align:center;font-weight:700;margin-bottom:18px}
        .meta{text-align:center;color:#9aa2c9;font-size:13px;margin-bottom:28px}
        .content{max-width:860px;margin:0 auto}
        .content p{line-height:1.9;margin:14px 0}
        /* indent body like design */
        .content p{padding-left:28px;position:relative}
        .content p:before{content:"";position:absolute;left:10px;top:11px;width:6px;height:6px;background:#d9def5;border-radius:50%}

        /* Tags */
        .tags{display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-start;margin-top:22px ; margin-bottom: 10px;}
        .tag{padding:8px 16px;border-radius:999px;background:#EEF3FF;color:#6673A6;font-size:12px}

        /* Author bar (top of Related section) */
        .author-bar{display:flex;align-items:center;justify-content:space-between;padding:10px 0 22px;border-top:1px solid var(--line)}
        .author-left{display:flex;gap:10px;align-items:center;color:var(--muted);font-size:13px}
        .author-left img{width:36px;height:36px;border-radius:50%}
        .follow-btn{border:1px solid #D9E5FF;background:#fff;padding:10px 22px;border-radius:10px;color:var(--navy);font-weight:600;cursor:pointer}
        .follow-btn:hover{background:#f5fbff}

        /* Related */
        .related{background:#F3F8FF;padding:36px 0 70px;border-top:1px solid #EAF1FF}
        .related h2{color:var(--ink);font-weight:600;margin-bottom:18px}
        .related-head{display:flex;align-items:center;justify-content:space-between}
        .related-head a{color:var(--teal-dark);font-size:13px;font-weight:600}
        .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:26px;margin-top:14px}
        .card{background:#fff;border-radius:20px;box-shadow:var(--shadow);padding:22px;display:flex;flex-direction:column}
        .card .thumb{border-radius:14px;overflow:hidden;margin-bottom:18px}
        .card h3{color:var(--ink);font-size:18px;line-height:1.4;margin-bottom:16px}
        .card .by{display:flex;align-items:center;gap:10px;margin-bottom:8px}
        .by img{width:28px;height:28px;border-radius:50%}
        .by span{font-size:13px;color:#6b7399}
        .excerpt{font-size:13px;color:#8790b6;margin-bottom:16px}
        .card-foot{margin-top:auto;display:flex;align-items:center;justify-content:space-between}
        .more{color:var(--teal-dark);font-weight:600}
        .views{display:flex;gap:8px;align-items:center;color:#8B95B7;font-size:12px}
        .views svg{width:18px;height:18px}

        .pager{display:flex;gap:12px;justify-content:flex-end;margin-top:26px}
        .pager button{width:40px;height:40px;border:none;border-radius:10px;background:#18B5C8;color:#fff;font-size:18px;cursor:pointer}
        .pager button:first-child{background:#fff;border:1px solid #d7e5ff;color:#18B5C8}

        /* Footer */
        footer{background:#171C3E;color:#C8D0F0;padding:44px 0 28px}
        .foot-top{display:flex;flex-direction:column;align-items:center;gap:24px;margin-bottom:12px}
        .foot-brand{display:flex;gap:14px;align-items:center;color:#fff}
        .foot-sep{border-left:1px solid #2b345a;height:26px}
        .newsletter{color:#d6dcff;text-align:center}
        .sub-form{margin-top:10px;background:#0F1434;border-radius:999px;display:flex;align-items:center;gap:12px;padding:6px 6px 6px 16px;width:360px;max-width:100%}
        .sub-form input{flex:1;border:none;background:transparent;color:#cfd6ff;outline:none;font-size:13px}
        .sub-form button{border:none;background:#5ad7d6;color:#0f1534;font-weight:700;padding:10px 20px;border-radius:999px;cursor:pointer}
        .foot-links{display:flex;gap:16px;justify-content:center;margin:18px 0 6px}
        .foot-links a{color:#c8d0f0;font-size:12px}
        .copy{color:#7f86b1;font-size:12px;text-align:center}

        /* Responsive */
        @media (max-width: 980px){
            .grid{grid-template-columns:1fr}
            .menu{gap:18px}
        }
        @media (max-width: 640px){
            .nav{flex-wrap:wrap;gap:10px}
            .hero img{height:300px}
            h1.title{font-size:22px}
            .author-bar{flex-direction:column;align-items:flex-start;gap:10px}
        }
    </style>
<body>
<!-- HERO -->
<section class="hero">
    <img src="<?= $post['hero'] ?>" alt="Classroom cover">
</section>

<!-- ARTICLE -->
<article class="article">
    <div class="container">
        <h1 class="title"><?= htmlspecialchars($post['title']) ?></h1>
        <p class="meta">Written by <?= htmlspecialchars($author['name']) ?> · May 21, 2021 · 10 min read</p>

        <div class="content">
            <?php foreach ($post['content'] as $p): ?>
                <p><?= htmlspecialchars($p) ?></p>
            <?php endforeach; ?>

            <div class="tags">
                <?php foreach ($post['tags'] as $tag): ?>
                    <span class="tag"><?= htmlspecialchars($tag) ?></span>
                <?php endforeach; ?>
            </div>

            <!-- Author bar (the small bar shown above Related section) -->
            <div class="author-bar">
                <div class="author-left">
                    <img src="<?= $author['avatar'] ?>" alt="<?= htmlspecialchars($author['name']) ?>">
                    <div>
                        <div style="font-weight:600;color:#4e5682">Written by</div>
                        <div><?= htmlspecialchars($author['name']) ?></div>
                    </div>
                </div>
                <button class="follow-btn" type="button">Follow</button>
            </div>
        </div>
    </div>
</article>

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

<!-- FOOTER -->
<?php include 'footer.php'; ?>

</body>
</html>
