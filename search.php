<?php
// courses.php  —  demo UI tĩnh (không backend)
$courses = array_fill(0, 8, [
  "title" => "AWS Certified solutions Architect",
  "img"   => "https://images.pexels.com/photos/1181244/pexels-photo-1181244.jpeg?auto=compress&cs=tinysrgb&w=1200",
  "cat"   => "Design",
  "dur"   => "3 Month",
  "desc"  => "Lorem ipsum dolor sit amet, consectetur adipisciing elit, sed do eiusmod tempor",
  "author"=> "Lina",
  "price" => "$80",
  "old"   => "$100",
]);
$creatorImgs = [
  "https://images.pexels.com/photos/1181686/pexels-photo-1181686.jpeg?auto=compress&cs=tinysrgb&w=400",
  "https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=400",
  "https://images.pexels.com/photos/3778603/pexels-photo-3778603.jpeg?auto=compress&cs=tinysrgb&w=400",
];
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<title>TOTC – Courses</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#2F327D; --text:#48507a; --muted:#8a93b6;
  --line:#E7EDFF; --bg:#F6F8FE; --card:#fff;
  --teal:#2fc7c6; --teal-2:#22b6b5; --accent:#57d0cf;
  --chip:#F1F6FF; --shadow:0 16px 40px rgba(24,39,75,.08);
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#fff;color:var(--text)}
img{max-width:100%;display:block} a{text-decoration:none;color:inherit}

/* NAV */
.nav{border-bottom:1px solid #eef2ff;background:#fff;position:sticky;top:0;z-index:40}
.nav .inner{max-width:1180px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;padding:14px 18px}
.brand{display:flex;align-items:center;gap:10px}
.diamond{width:36px;height:36px;border:2px solid var(--teal);transform:rotate(45deg);border-radius:8px;display:grid;place-items:center}
.diamond span{transform:rotate(-45deg);font-weight:800;color:#17314f}
.menu{display:flex;gap:26px}
.menu a{color:#556092;font-weight:500}
.menu a:hover{color:var(--teal-2)}
.user{display:flex;align-items:center;gap:10px}
.user img{width:34px;height:34px;border-radius:50%}

/* HERO */
.hero{background:linear-gradient(90deg,var(--teal),var(--teal-2));height:210px;position:relative}
.hero:before{content:"";position:absolute;inset:0;background:url('https://images.pexels.com/photos/1181359/pexels-photo-1181359.jpeg?auto=compress&cs=tinysrgb&w=1600') center/cover;opacity:.3}
.search-wrap{position:absolute;left:50%;top:56%;transform:translate(-50%,-50%);width:min(1020px,92%);}
.search-bar{display:grid;grid-template-columns:1fr auto;gap:10px}
.input{height:48px;border-radius:12px;border:none;padding:0 16px}
.btn-primary{height:48px;border:none;border-radius:12px;background:#5ed1cf;color:#fff;font-weight:700;padding:0 20px;cursor:pointer}
.filters{display:flex;gap:12px;margin-top:14px;flex-wrap:wrap}
.filter{background:#fff;border:1px solid #DDE6FF;border-radius:12px;padding:10px 12px;color:#31406d;font-weight:600;display:inline-flex;align-items:center;gap:10px}
.filter i{width:8px;height:8px;border-right:2px solid #8ea1d7;border-bottom:2px solid #8ea1d7;transform:rotate(45deg);margin-left:2px}

/* GRID */
.section{max-width:1180px;margin:0 auto;padding:28px 18px}
.grid{display:grid;grid-template-columns:repeat(4, minmax(0, 1fr));gap:22px}
.card{background:#fff;border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);overflow:hidden}
.thumb{position:relative}
.thumb img{width:100%;height:170px;object-fit:cover}
.badges{position:absolute;left:12px;bottom:10px;display:flex;gap:8px}
.badge{background:rgba(255,255,255,.95);border:1px solid #dfebff;border-radius:10px;font-size:12px;padding:4px 8px}
.body{padding:14px}
.title{font-weight:700;color:#293665;margin:6px 0}
.desc{font-size:13px;color:#7a84a7}
.foot{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
.author{display:flex;align-items:center;gap:8px}
.author img{width:28px;height:28px;border-radius:50%}
.price{font-weight:800;color:#24b99d}
.old{color:#aab2d3;text-decoration:line-through}

/* Banner info */
.banner{background:#E8F3FF;border-radius:18px;box-shadow:var(--shadow);padding:24px;margin-top:26px;display:grid;grid-template-columns:1.1fr 1fr;gap:20px}
.banner h3{color:#20315f}
.b-list{margin:14px 0;display:grid;gap:10px}
.b-item{display:flex;gap:10px;align-items:center;color:#5a6591}
.dot{width:10px;height:10px;border-radius:50%;background:#5ed1cf}
.b-cta{margin-top:6px}
.btn-cta{background:#49bdbb;color:#fff;border:none;border-radius:10px;font-weight:700;padding:12px 18px;cursor:pointer}
.mock{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.mock .bubble{background:#fff;border-radius:14px;border:1px solid #e0e9ff;height:110px;overflow:hidden}

/* Blue section */
.blue{background:#EAF3FF;padding:26px 0;margin-top:10px}
.s-head{max-width:1180px;margin:0 auto 10px;padding:0 18px;display:flex;align-items:center;justify-content:space-between}
.s-head a{color:#13b1b3;font-weight:700}

/* Creators grid */
.creators{max-width:1180px;margin:0 auto;padding:0 18px 28px}
.cgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.person{background:#fff;border:1px solid #e6ecff;border-radius:10px;box-shadow:var(--shadow);padding:20px;text-align:center}
.person img{width:160px;height:120px;object-fit:cover;border-radius:4px;margin:-40px auto 10px;display:block}

/* Testimonial */
.testi{max-width:1180px;margin:0 auto;padding:0 18px 26px}
.tbox{background:#EAF5FF;border-radius:18px;padding:24px;display:grid;grid-template-columns:240px 1fr 110px;gap:16px;align-items:center}
.tbox .pic{background:#fff;border-radius:50%;aspect-ratio:1/1;overflow:hidden;border:8px solid #e2f2ff}
.tbox .pic img{width:100%;height:100%;object-fit:cover}
.tbox h4{color:#213165}
.social{display:flex;gap:10px;margin-top:10px}
.s-dot{width:28px;height:28px;border-radius:50%;background:#0ea5a6;opacity:.85}

/* Deals */
.deals{max-width:1180px;margin:0 auto;padding:0 18px 34px}
.dgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.deal{position:relative;border-radius:14px;overflow:hidden;box-shadow:var(--shadow)}
.deal img{width:100%;height:220px;object-fit:cover;filter:brightness(.75)}
.off{position:absolute;left:14px;top:14px;background:#1ab6b8;color:#fff;font-weight:800;padding:10px 12px;border-radius:8px}
.dcopy{position:absolute;left:16px;bottom:14px;color:#fff;max-width:80%}
.dcopy h5{font-size:18px;margin:4px 0 6px}
.dline{height:4px;background:rgba(255,255,255,.6);border-radius:10px;margin-top:10px}

/* FOOTER */
footer{background:#151b38;color:#c8d0f0;padding:40px 0}
.fwrap{max-width:1180px;margin:0 auto;padding:0 18px;text-align:center}
.fbrand{display:flex;gap:12px;align-items:center;justify-content:center;color:#fff}
.fbrand .diamond{border-color:#23c7c6}
.f-news{margin:18px 0 10px}
.f-form{display:inline-flex;gap:10px;background:#0f1434;border-radius:999px;padding:6px 6px 6px 14px}
.f-form input{border:none;background:transparent;color:#cfd6ff;outline:none;padding:8px 6px;min-width:260px}
.f-form button{border:none;border-radius:999px;padding:10px 18px;background:#59d4d3;color:#0f1534;font-weight:800;cursor:pointer}
.f-links{display:flex;gap:20px;justify-content:center;color:#aeb5d8;font-size:13px;margin-top:6px}

@media (max-width:1100px){ .grid{grid-template-columns:repeat(3,1fr)} .banner{grid-template-columns:1fr} .mock{grid-template-columns:repeat(6,1fr)} .cgrid{grid-template-columns:repeat(2,1fr)} .dgrid{grid-template-columns:repeat(2,1fr)} }
@media (max-width:720px){ .grid{grid-template-columns:repeat(2,1fr)} .tbox{grid-template-columns:1fr} .dgrid{grid-template-columns:1fr} }
@media (max-width:520px){ .grid{grid-template-columns:1fr} .filters{justify-content:center} .menu{display:none} }
</style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
  <div class="inner">
    <div class="brand"><div class="diamond"><span>TOTC</span></div></div>
    <div class="menu">
      <a href="#">Home</a><a href="#" style="color:var(--teal-2);font-weight:700">Courses</a><a href="#">Careers</a><a href="#">Blog</a><a href="#">About Us</a>
    </div>
    <div class="user"><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=200" alt=""><strong>Lina</strong></div>
  </div>
</nav>

<!-- HERO + SEARCH -->
<section class="hero">
  <div class="search-wrap">
    <div class="search-bar">
      <input class="input" type="text" placeholder="Search your favourite course">
      <button class="btn-primary">Search</button>
    </div>
    <div class="filters">
      <div class="filter">Subject <i></i></div>
      <div class="filter">Partner <i></i></div>
      <div class="filter">Program <i></i></div>
      <div class="filter">Language <i></i></div>
      <div class="filter">Abailability <i></i></div>
      <div class="filter">Learning Type <i></i></div>
    </div>
  </div>
</section>

<!-- CARDS GRID -->
<section class="section">
  <div class="grid">
    <?php
      $thumbs = [
        "https://images.pexels.com/photos/4226261/pexels-photo-4226261.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/1181216/pexels-photo-1181216.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/374631/pexels-photo-374631.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/4050306/pexels-photo-4050306.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/3745631/pexels-photo-3745631.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/461064/pexels-photo-461064.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/1181371/pexels-photo-1181371.jpeg?auto=compress&cs=tinysrgb&w=1200",
      ];
      foreach ($courses as $i => $c):
        $img = $thumbs[$i % count($thumbs)];
    ?>
      <article class="card">
        <div class="thumb">
          <img src="<?= $img ?>" alt="">
          <div class="badges"><span class="badge"><?= htmlspecialchars($c["cat"]) ?></span><span class="badge"><?= htmlspecialchars($c["dur"]) ?></span></div>
        </div>
        <div class="body">
          <div class="title"><?= htmlspecialchars($c["title"]) ?></div>
          <p class="desc"><?= htmlspecialchars($c["desc"]) ?></p>
          <div class="foot">
            <div class="author">
              <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=200" alt="">
              <span><?= htmlspecialchars($c["author"]) ?></span>
            </div>
            <div><span class="old"><?= $c["old"] ?></span> <span class="price"><?= $c["price"] ?></span></div>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <!-- Banner info -->
  <div class="banner">
    <div>
      <h3>Know about learning<br>learning platform</h3>
      <div class="b-list">
        <div class="b-item"><span class="dot"></span>Free E-book, video &amp; consolation</div>
        <div class="b-item"><span class="dot"></span>Top instructors from around world</div>
        <div class="b-item"><span class="dot"></span>Top courses from your team</div>
      </div>
      <div class="b-cta"><button class="btn-cta">Start learning now</button></div>
    </div>
    <div class="mock">
      <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
      <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
    </div>
  </div>
</section>

<!-- Recommended (blue) -->
<section class="blue">
  <div class="s-head">
    <h3>Recommended for you</h3>
    <a href="#">See all</a>
  </div>
  <div class="section" style="padding-top:0">
    <div class="grid">
      <?php for ($i=0;$i<4;$i++): $img=$thumbs[$i]; ?>
        <article class="card">
          <div class="thumb">
            <img src="<?= $img ?>" alt="">
            <div class="badges"><span class="badge">Design</span><span class="badge">3 Month</span></div>
          </div>
          <div class="body">
            <div class="title">AWS Certified solutions Architect</div>
            <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</p>
            <div class="foot">
              <div class="author"><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=200"><span>Lina</span></div>
              <div><span class="old">$100</span> <span class="price">$80</span></div>
            </div>
          </div>
        </article>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- Creators -->
<section class="s-head" style="margin-top:10px">
  <h3>Classes tought by real creators</h3><a href="#">See all</a>
</section>
<section class="creators">
  <div class="cgrid">
    <?php
      $names = ["Jane Cooper","Adam","Tomara","Jane Cooper","Jane Cooper","Jane Cooper"];
      for($i=0;$i<6;$i++):
        $p = $creatorImgs[$i % count($creatorImgs)];
    ?>
      <div class="person">
        <img src="<?= $p ?>" alt="">
        <div style="font-weight:700;margin:8px 0 4px;color:#26356a"><?= $names[$i] ?></div>
        <div style="color:#7b85a9">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</div>
      </div>
    <?php endfor; ?>
  </div>
</section>

<!-- Testimonial -->
<section class="testi">
  <div class="tbox">
    <div class="pic"><img src="https://images.pexels.com/photos/3769021/pexels-photo-3769021.jpeg?auto=compress&cs=tinysrgb&w=400" alt=""></div>
    <div>
      <h4>Savannah Nguyen</h4>
      <div style="color:#6a78a8;margin-top:6px;line-height:1.9">
        tanya.hill@example.com<br>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
      </div>
      <div class="social">
        <span class="s-dot"></span><span class="s-dot"></span><span class="s-dot"></span><span class="s-dot"></span>
      </div>
    </div>
    <div style="display:grid;gap:10px;justify-items:end">
      <img src="https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=200" width="46" height="46" style="border-radius:50%">
      <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=200" width="46" height="46" style="border-radius:50%">
      <img src="https://images.pexels.com/photos/3778603/pexels-photo-3778603.jpeg?auto=compress&cs=tinysrgb&w=200" width="46" height="46" style="border-radius:50%">
    </div>
  </div>
</section>

<!-- Deals -->
<section class="s-head">
  <h3>Top Education offers and deals are listed here</h3><a href="#">See all</a>
</section>
<section class="deals">
  <div class="dgrid">
    <?php
      $dimgs = [
        "https://images.pexels.com/photos/4226261/pexels-photo-4226261.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/414422/pexels-photo-414422.jpeg?auto=compress&cs=tinysrgb&w=1200",
        "https://images.pexels.com/photos/109371/pexels-photo-109371.jpeg?auto=compress&cs=tinysrgb&w=1200",
      ];
      $off = ["50%","10%","50%"];
      foreach($dimgs as $k=>$img):
    ?>
      <div class="deal">
        <img src="<?= $img ?>" alt="">
        <div class="off"><?= $off[$k] ?></div>
        <div class="dcopy">
          <h5>Lorem ipsum dolor</h5>
          <div style="line-height:1.7">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</div>
          <div class="dline"></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="fwrap">
    <div class="fbrand">
      <div class="diamond"><span>TOTC</span></div>
      <div style="border-left:1px solid #2b3560;height:20px;margin:0 12px"></div>
      <div>Virtual Class<br>for Zoom</div>
    </div>

    <div class="f-news">Subscribe to get our Newsletter</div>
    <form class="f-form" action="#" method="post">
      <input type="email" placeholder="Your Email">
      <button type="submit">Subscribe</button>
    </form>

    <div class="f-links" style="margin-top:18px">
      <span>Careers</span><span>|</span><span>Privacy Policy</span><span>|</span><span>Terms &amp; Conditions</span>
    </div>
    <div style="color:#8b92ba;margin-top:6px">© 2021 Class Technologies Inc.</div>
  </div>
</footer>

</body>
</html>
