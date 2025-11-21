<?php
// course-watch.php  —  Demo UI tĩnh (không có backend)
$sections = [
  "Change Simplification" => array_fill(0, 6, ["title" => "Lesson 01 : Introduction about XD", "mins" => "30 mins"]),
  "PRACTICE QUIZ"        => array_fill(0, 10, ["title" => "Lesson 01 : Introduction about XD", "mins" => "30 mins"]),
];

$cards = [
  [
    "img" => "https://images.pexels.com/photos/414379/pexels-photo-414379.jpeg?auto=compress&cs=tinysrgb&w=800",
    "title" => "AWS Certified solutions Architect",
    "cat" => "Design", "dur" => "3 Month",
    "desc" => "Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmod tempor",
    "author" => "Lina", "price" => "$80", "old" => "$100"
  ],
  [
    "img" => "https://images.pexels.com/photos/1181371/pexels-photo-1181371.jpeg?auto=compress&cs=tinysrgb&w=800",
    "title" => "AWS Certified solutions Architect",
    "cat" => "Design", "dur" => "3 Month",
    "desc" => "Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmod tempor",
    "author" => "Lina", "price" => "$80", "old" => "$100"
  ],
  [
    "img" => "https://images.pexels.com/photos/574077/pexels-photo-574077.jpeg?auto=compress&cs=tinysrgb&w=800",
    "title" => "AWS Certified solutions Architect",
    "cat" => "Design", "dur" => "3 Month",
    "desc" => "Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmod tempor",
    "author" => "Lina", "price" => "$80", "old" => "$100"
  ],
  [
    "img" => "https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=800",
    "title" => "AWS Certified solutions Architect",
    "cat" => "Design", "dur" => "3 Month",
    "desc" => "Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmod tempor",
    "author" => "Lina", "price" => "$80", "old" => "$100"
  ],
];
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<title>Course Watch – Learn about Adobe XD & Prototyping</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#2F327D; --ink-2:#1e3058;
  --text:#4a5078; --muted:#8691b6;
  --line:#E7EDFF; --bg:#F5F8FF; --card:#fff;
  --teal:#2fc7c6; --teal-2:#21b6b5; --accent:#5ed1cf;
  --sand:#f2cf93; --sand-bg:#f7e3b3;
  --chip-blue:#E9F0FF; --chip-rose:#FFE8EA; --chip-yellow:#FFEFC7;
  --shadow:0 14px 34px rgba(24,39,75,.08);
}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#fff;color:var(--text)}
img{max-width:100%;display:block} a{text-decoration:none;color:inherit}

/* layout */
.app{display:grid;grid-template-columns:300px 1fr;min-height:100vh;background:#fff}

/* sidebar */
aside{background:#F7FAFF;border-right:1px solid var(--line);padding:14px 12px}
.back{display:flex;align-items:center;gap:10px;margin-bottom:10px}
.back .btn{width:36px;height:36px;border-radius:8px;background:#3ec7c4;display:grid;place-items:center;color:#fff;box-shadow:0 8px 18px rgba(50,200,195,.25)}
.back svg{width:18px;height:18px;stroke:#fff;stroke-linecap:round;stroke-linejoin:round}
.side-title{font-weight:800;color:#272f63;margin:12px 8px}
.group{background:#fff;border-radius:12px;padding:10px;box-shadow:var(--shadow);margin-bottom:14px}
.item{display:flex;justify-content:space-between;align-items:center;background:#fff;border-radius:10px;padding:12px;border:1px solid #eef2ff}
.item + .item{margin-top:10px}
.left{display:flex;align-items:center;gap:10px;min-width:0}
.book{width:28px;height:28px;border-radius:8px;background:#2f327d;display:grid;place-items:center}
.book svg{width:16px;height:16px;color:#fff}
.name{font-size:13px;color:#4b5382;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:150px}
.badge{padding:6px 10px;border-radius:10px;background:#E6FBF1;color:#39b77c;border:1px solid #bfeede;font-size:12px;font-weight:600}
.item:nth-child(3n+2) .badge{background:var(--chip-yellow);color:#d89a00;border:1px solid #ffe0a6}
.item:nth-child(3n) .badge{background:var(--chip-rose);color:#dc6c77;border:1px solid #f6c2c7}

/* main header */
.head{background:linear-gradient(90deg,var(--teal),var(--teal-2));color:#fff;border-bottom:1px solid #d8f1f1}
.head-inner{display:flex;justify-content:space-between;align-items:center;padding:18px 22px}
.h-title{font-size:28px;font-weight:700}
.h-sub{opacity:.95;margin-top:4px}
.h-pill{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border:1px solid rgba(255,255,255,.6);border-radius:999px}
.h-pill svg{width:18px;height:18px}

/* content */
.page{background:#EAF2FF}
.wrapper{max-width:1080px;margin:0 auto;padding:18px 18px}
.card{background:var(--card);border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow)}
.player{padding:18px}
.video{border-radius:12px;overflow:hidden;background:#000}
.progress{height:6px;background:#e8eefc;border-radius:999px;margin-top:12px;position:relative}
.progress > i{position:absolute;inset:0;width:68%;background:#2fc7c6;border-radius:999px}
.progress .dot{position:absolute;left:calc(68% - 7px);top:-6px;width:18px;height:18px;border-radius:50%;background:#2fc7c6;border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.2)}
.meta{display:flex;justify-content:space-between;align-items:center;color:#fff;margin-top:-32px;padding:0 10px 10px}
.meta .time{font-size:12px;background:rgba(0,0,0,.45);padding:4px 8px;border-radius:8px}

/* article text */
.content{background:#EAF2FF}
.article{max-width:780px;margin:18px auto}
.article h3{color:#2a3364;font-size:18px;margin:20px 0 8px}
.article p{color:#667198;line-height:1.9}
.highlight{margin:16px 0;padding:16px;border-radius:10px;background:#f6e7c7;border:1px solid #f0d7a1;color:#6f5a2e}

/* testimonial */
.testi{display:flex;gap:12px;align-items:center;background:#f3cc89;border:1px solid #e6b762;padding:14px;border-radius:12px;margin:18px 0 4px;max-width:780px}
.t-avatar{width:44px;height:44px;border-radius:50%;overflow:hidden}
.t-name{font-weight:700;color:#303b6b}
.stars{color:#f7b500;font-size:18px;line-height:1}
.t-desc{background:#f7e3b3;border-radius:8px;padding:10px;margin-top:8px;color:#6f5a2e}

/* student also bought */
.slider-wrap{background:#E1EEFF;padding:26px 0;border-top:1px solid #d6e6ff}
.slider-head{max-width:1080px;margin:0 auto 14px;display:flex;justify-content:space-between;align-items:center;padding:0 18px}
.slider-head h3{color:#2a3364}
.arrows{display:flex;gap:10px}
.btn-ghost{width:34px;height:34px;border-radius:10px;border:1px solid #cfe0ff;background:#fff;display:grid;place-items:center}
.btn-ghost svg{width:18px;height:18px}
.track{max-width:1080px;margin:0 auto;display:grid;grid-template-columns:repeat(4, minmax(0,1fr));gap:18px;padding:0 18px}
.course-card{background:#fff;border:1px solid #e3ebff;border-radius:16px;box-shadow:var(--shadow);overflow:hidden}
.cc-media{position:relative}
.cc-media img{width:100%;height:160px;object-fit:cover}
.cc-chip{position:absolute;left:12px;bottom:10px;display:flex;gap:8px}
.chip{font-size:12px;background:rgba(255,255,255,.9);padding:6px 8px;border-radius:8px;border:1px solid #dfe7ff}
.cc-body{padding:14px}
.cc-title{color:#293465;font-weight:700;margin:4px 0 6px}
.cc-desc{font-size:13px;color:#7a84aa}
.cc-foot{display:flex;justify-content:space-between;align-items:center;margin-top:12px}
.author{display:flex;align-items:center;gap:8px}
.author img{width:28px;height:28px;border-radius:50%}
.price{font-weight:800;color:#2dbf9d}
.old{color:#a8b1d4;text-decoration:line-through;font-weight:600;margin-right:6px}

/* responsive */
@media (max-width: 1150px){ .app{grid-template-columns:1fr} aside{border-right:none;border-bottom:1px solid var(--line)} }
@media (max-width: 900px){ .track{grid-template-columns:repeat(2,1fr)} .h-title{font-size:24px} }
@media (max-width: 560px){ .track{grid-template-columns:1fr} .head-inner{flex-direction:column;gap:10px} }
</style>
</head>
<body>

<div class="app">
  <!-- SIDEBAR -->
  <aside>
    <div class="back">
      <button type="button" class="btn" onclick="history.back()" aria-label="Back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
      </button>
    </div>

    <?php foreach ($sections as $label => $items): ?>
      <div class="side-title"><?= htmlspecialchars($label) ?></div>
      <div class="group">
        <?php foreach ($items as $i => $it): ?>
          <div class="item">
            <div class="left">
              <div class="book">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" fill="none">
                  <path d="M4 19V5a2 2 0 012-2h10v18H6a2 2 0 01-2-2z"/>
                  <path d="M6 2h10a2 2 0 012 2v13"/>
                </svg>
              </div>
              <div class="name"><?= htmlspecialchars($it["title"]) ?></div>
            </div>
            <div class="badge"><?= htmlspecialchars($it["mins"]) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </aside>

  <!-- MAIN -->
  <main>
    <!-- Header -->
    <div class="head">
      <div class="head-inner">
        <div>
          <div class="h-title">Learn about Adobe XD &amp; Prototyping</div>
          <div class="h-sub">Introduction about XD</div>
        </div>
        <div class="h-pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M12 7v6l3 3"></path>
          </svg>
          <span>1 hour</span>
        </div>
      </div>
    </div>

    <!-- Player + article -->
    <div class="page">
      <div class="wrapper">
        <div class="card player">
          <div class="video">
            <img src="https://images.pexels.com/photos/3184325/pexels-photo-3184325.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="">
          </div>
          <div class="meta">
            <div class="time">00:05 / 03:26</div>
            <div class="time">⛶</div>
          </div>
          <div class="progress"><i></i><span class="dot"></span></div>
        </div>

        <div class="article">
          <h3>06 Super Coins on the way</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adi picing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur
          adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>

          <h3>Who this course is for?</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet,
          consectetur adipisicing elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>

          <h3>Archievable</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmodLorem ipsum dolor sit amet, consectetur
          adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet, consectetur adipising elit, sed do eiusmod.</p>

          <div class="testi">
            <div class="t-avatar"><img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=200" alt=""></div>
            <div style="flex:1">
              <div class="t-name">Bulkin Simons</div>
              <div class="stars">★★★★★</div>
              <div class="t-desc">Lorem ipsum dolor sit amet, consectetur adi picing elit, sed do eiusmodLorem ipsum dolor sit amet,
                consectetur adipisicing elit, sed do eiusmod.</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Student also bought -->
      <div class="slider-wrap">
        <div class="slider-head">
          <h3>Student also bought</h3>
          <div class="arrows">
            <button class="btn-ghost" type="button" onclick="slide(-1)" aria-label="Prev">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
              </svg>
            </button>
            <button class="btn-ghost" type="button" onclick="slide(1)" aria-label="Next">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 6 15 12 9 18"></polyline>
              </svg>
            </button>
          </div>
        </div>

        <div class="track" id="track">
          <?php foreach ($cards as $c): ?>
          <article class="course-card">
            <div class="cc-media">
              <img src="<?= $c['img'] ?>" alt="">
              <div class="cc-chip">
                <span class="chip"><?= htmlspecialchars($c['cat']) ?></span>
                <span class="chip"><?= htmlspecialchars($c['dur']) ?></span>
              </div>
            </div>
            <div class="cc-body">
              <div class="cc-title"><?= htmlspecialchars($c['title']) ?></div>
              <div class="cc-desc"><?= htmlspecialchars($c['desc']) ?></div>
              <div class="cc-foot">
                <div class="author">
                  <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=200" alt="">
                  <span><?= htmlspecialchars($c['author']) ?></span>
                </div>
                <div><span class="old"><?= $c['old'] ?></span><span class="price"><?= $c['price'] ?></span></div>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
/* mini slider (dịch ngang bằng scroll) */
function slide(dir){
  const el = document.getElementById('track');
  const w = el.querySelector('.course-card').clientWidth + 18; // card width + gap
  el.scrollBy({left: dir * w, behavior:'smooth'});
}
</script>
</body>
</html>
