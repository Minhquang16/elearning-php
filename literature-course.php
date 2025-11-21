<?php
/* =======================
   CẤU HÌNH / DỮ LIỆU MẪU
   ======================= */
$instructor = [
  "name" => "John Anderson",
  "title" => "Assistant Professor at McMaster University",
  "bio" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt utlabore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud",
  "avatar" => "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300&h=300&fit=crop",
  "banner" => "https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1600&auto=format&fit=crop"
];

$tabs = ["About","Course","Notes","Project","Podcast","Book","Review"];

$books = [
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1485322551133-3a4c27a9d925?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1524578271613-d550eacf6090?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1513475382585-d06e58bcb0ea?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1495446815901-a7297e633e8d?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1528207776546-365bb710ee93?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1553729459-efe14ef6055d?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1526318472351-c75fcf070305?q=80&w=1200&auto=format&fit=crop"],
  ["title"=>"All Benefits of PLUS","price"=>24,"img"=>"https://images.unsplash.com/photo-1544947950-5222d4b25449?q=80&w=1200&auto=format&fit=crop"],
];

$perPage = 6;
$total = count($books);
$totalPages = (int)ceil($total/$perPage);
$current = max(1, min($totalPages, (int)($_GET['page'] ?? 3))); // theo ảnh là trang 3
$offset = ($current-1)*$perPage;
$visible = array_slice($books, $offset, $perPage);
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>TOTC – Literature Course</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#0f172a;--muted:#6b7280;--brand:#48b3b0;--accent:#22c55e;
  --panel:#ffffff;--bg:#f7fafc;--deep:#22283a;--border:#e5e7eb;
  --radius:16px;--shadow:0 10px 30px rgba(2,6,23,.08)
}
*{box-sizing:border-box}
body{margin:0;background:#fff;font-family:Inter,system-ui,Arial,sans-serif;color:var(--ink)}
.container{max-width:1100px;margin:0 auto;padding:0 20px}
a{color:inherit;text-decoration:none}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border-radius:999px;font-weight:600;border:0;cursor:pointer}
.btn-primary{background:var(--brand);color:#fff;box-shadow:0 8px 20px rgba(72,179,176,.25)}
.btn-soft{background:#e9f6f6;color:#0e807d}
.btn-ghost{background:#f3f4f6;color:var(--ink)}
.badge{font-size:12px;background:#eef2ff;border:1px solid #dbe2ff;padding:4px 8px;border-radius:999px}
.icon{width:18px;height:18px}

/* Header */
.nav{display:flex;align-items:center;justify-content:space-between;padding:16px 0}
.nav .menu{display:flex;gap:28px;color:#3f3f46}
.nav .user{display:flex;align-items:center;gap:10px}
.logo{display:flex;align-items:center;gap:8px;font-weight:800}

/* Hero instructor */
.hero{margin-top:10px;background:var(--panel);border-radius:18px;overflow:hidden;box-shadow:var(--shadow);position:relative}
.hero .cover{height:210px;background:#000;overflow:hidden}
.hero .cover img{width:100%;height:100%;object-fit:cover;opacity:.88}
.hero .profile{display:flex;align-items:center;gap:18px;padding:16px;transform:translateY(-36px)}
.avatar{width:120px;height:120px;border-radius:50%;border:6px solid #fff;overflow:hidden;flex:none;box-shadow:0 10px 20px rgba(2,6,23,.15)}
.avatar img{width:100%;height:100%;object-fit:cover}
.hero .info{flex:1;background:rgba(255,255,255,.78);backdrop-filter:blur(2px);border-radius:14px;padding:14px;border:1px solid var(--border)}
.hero h1{margin:0 0 4px;font-size:20px}
.hero p{margin:8px 0 10px;color:#4b5563}
.hero .stats{display:flex;gap:16px;font-size:12px;color:#6b7280}
.hero .cta{position:absolute;right:22px;top:22px}

/* Tabs */
.tabs{display:flex;gap:12px;margin:22px 0}
.tab{padding:10px 16px;border-radius:10px;border:1px solid var(--border);background:#f6f7f9;font-weight:600;color:#4b5563}
.tab.active{background:#49b4b163;color:#0c6c69}

/* Books */
.section-title{font-weight:700;margin:20px 0 14px}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.card{background:#fff;border:1px solid var(--border);border-radius:16px;box-shadow:0 8px 18px rgba(2,6,23,.05)}
.card .media{height:230px;border-radius:14px;overflow:hidden;margin:14px;background:#f8fafc}
.card .media img{width:100%;height:100%;object-fit:cover}
.card .body{padding:0 16px 16px;color:#6b7280;font-size:14px;display:flex;justify-content:space-between;align-items:center}
.price{color:#22c55e;font-weight:800}

/* Pagination */
.pager{display:flex;gap:8px;justify-content:center;align-items:center;margin:24px 0 56px}
.pager a,.pager span{display:inline-flex;min-width:38px;height:38px;border-radius:8px;border:1px solid var(--border);align-items:center;justify-content:center}
.pager .active{background:#49b4b1;color:#fff;border-color:transparent}
.pager .navbtn{background:#d9f0f0;border-color:transparent}

/* Footer */
footer{background:var(--deep);color:#c6d0e5;margin-top:0}
.footer-inner{max-width:1100px;margin:0 auto;padding:42px 20px}
.footer-top{display:flex;justify-content:space-between;align-items:center;padding-bottom:28px;border-bottom:1px solid rgba(255,255,255,.08)}
.brand{display:flex;align-items:center;gap:12px}
.brand .logo-shape{width:34px;height:34px;border:2px solid #6ee7e7;border-radius:8px;display:grid;place-items:center;color:#6ee7e7;font-weight:700}
.subscribe{display:flex;gap:10px}
.input{background:#293048;border:1px solid #3a405a;border-radius:999px;padding:12px 16px;min-width:260px;color:#e5e7eb}
.footer-bottom{display:flex;justify-content:space-between;align-items:center;margin-top:20px;font-size:13px}
.links{display:flex;gap:18px}
@media (max-width:960px){.grid{grid-template-columns:1fr 1fr}}
@media (max-width:640px){.grid{grid-template-columns:1fr} .hero .cta{position:static;margin:12px 0 0}}
</style>
</head>
<body>
  <header class="container">
    <nav class="nav">
      <div class="logo">
        <span class="logo-shape" style="border-color:#49b4b1;color:#49b4b1">T</span>
        TOTC
      </div>
      <div class="menu">
        <a href="#">Home</a>
        <a href="#">Courses</a>
        <a href="#">Careers</a>
        <a href="#">Blog</a>
        <a href="#">About Us</a>
      </div>
      <div class="user">
        <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=48&h=48&fit=crop" style="width:36px;height:36px;border-radius:99px;object-fit:cover" alt="">
        <strong>Lina</strong>
        <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M7 10l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </div>
    </nav>
  </header>

  <main class="container">
    <!-- HERO -->
    <section class="hero">
      <div class="cover">
        <img src="<?=htmlspecialchars($instructor['banner'])?>" alt="">
      </div>
      <button class="btn btn-primary hero cta">Enroll Now</button>
      <div class="profile">
        <div class="avatar"><img src="<?=htmlspecialchars($instructor['avatar'])?>" alt=""></div>
        <div class="info">
          <h1><?=$instructor['name']?></h1>
          <div class="badge" style="margin-bottom:8px"><?=$instructor['title']?></div>
          <p><?=$instructor['bio']?></p>
          <div class="stats">
            <span>⭐ 4.9 Instructor Rating</span>
            <span>👥 1,582 Students</span>
            <span>🏷️ 6 Courses</span>
            <span style="margin-left:auto;display:flex;gap:10px">
              <span>🐦</span><span>▶️</span><span>📷</span>
            </span>
          </div>
        </div>
      </div>
    </section>

    <!-- TABS -->
    <div class="tabs">
      <?php foreach($tabs as $i=>$t): ?>
        <a class="tab <?= $t==='Book'?'active':'' ?>" href="#"><?=htmlspecialchars($t)?></a>
      <?php endforeach; ?>
    </div>

    <!-- BOOKS -->
    <h3 class="section-title">Literature course</h3>
    <div class="grid">
      <?php foreach($visible as $b): ?>
        <article class="card">
          <div class="media"><img src="<?=htmlspecialchars($b['img'])?>" alt=""></div>
          <div class="body">
            <span><?=$b['title']?></span>
            <span class="price">$<?=number_format($b['price'])?></span>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- PAGINATION -->
    <div class="pager">
      <a class="navbtn" href="?page=<?= max(1,$current-1) ?>" title="Prev">
        <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </a>
      <?php for($i=1;$i<=$totalPages;$i++): ?>
        <?php if($i==$current): ?>
          <span class="active"><?= $i ?></span>
        <?php else: ?>
          <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <a class="navbtn" href="?page=<?= min($totalPages,$current+1) ?>" title="Next">
        <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </a>
    </div>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <div class="footer-top">
        <div class="brand">
          <div class="logo-shape">T</div>
          <div>
            <div style="font-weight:800">TOTC</div>
            <div style="opacity:.8">Virtual Class<br/>for Zoom</div>
          </div>
        </div>
        <form class="subscribe" onsubmit="event.preventDefault();alert('Subscribed!');">
          <input class="input" type="email" placeholder="Your Email" required>
          <button class="btn btn-primary">Subscribe</button>
        </form>
      </div>

      <div class="footer-bottom">
        <div class="links">
          <a href="#">Careers</a>
          <span>|</span>
          <a href="#">Privacy Policy</a>
          <span>|</span>
          <a href="#">Terms &amp; Conditions</a>
        </div>
        <div>© 2021 Class Technologies Inc.</div>
      </div>
    </div>
  </footer>

</body>
</html>
