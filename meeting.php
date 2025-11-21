<?php
// ---------- DỮ LIỆU MẪU ----------
$title = "UX/UI Design Conference Meeting";
$meta = ["lessons" => 9, "duration" => "6h 30min"];

$participants = [
  ["name" => "Emma", "avatar" => "https://images.unsplash.com/photo-1529665253569-6d01c0eaf7b6?w=300&h=300&fit=crop"],
  ["name" => "Liam", "avatar" => "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300&h=300&fit=crop"],
  ["name" => "Olivia", "avatar" => "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop"]
];

$sections = [
  [
    "title" => "Get Started",
    "time"  => "1 Hour",
    "lessons" => [
      ["title" => "Giới thiệu khóa học", "time" => "15:00"],
      ["title" => "Cài đặt công cụ", "time" => "45:00"],
    ],
    "open" => false,
  ],
  [
    "title" => "Illustrator Structures",
    "time"  => "2 Hour",
    "lessons" => [
      ["title" => "1. Lorem ipsum dolor sit amet", "time" => "6:30"],
      ["title" => "2. Lorem ipsum dolor", "time" => "25:00"],
      ["title" => "3. Lorem ipsum dolor sit amet", "time" => "30:00"],
    ],
    "open" => true,
  ],
  [
    "title" => "Using Illustrator",
    "time"  => "1 Hour",
    "lessons" => [
      ["title" => "Làm quen giao diện", "time" => "1:00:00"],
      ["title" => "Phím tắt & mẹo", "time" => "—"],
    ],
    "open" => false,
  ],
  [
    "title" => "What is Pandas?",
    "time"  => "12:54",
    "lessons" => [
      ["title" => "Series & DataFrame", "time" => "—"],
      ["title" => "Indexing cơ bản", "time" => "—"],
      ["title" => "GroupBy nhanh", "time" => "—"],
      ["title" => "Merge/Join", "time" => "—"],
      ["title" => "Plot đơn giản", "time" => "—"],
    ],
    "open" => false,
  ],
  [
    "title" => "Work with Numpy",
    "time"  => "50:00",
    "lessons" => [
      ["title" => "Mảng & broadcast", "time" => "—"],
      ["title" => "uFuncs", "time" => "—"],
      ["title" => "Random & stats", "time" => "—"],
    ],
    "open" => false,
  ],
];

$bookForYou = [
  [
    "title" => "All Benefits of PLUS",
    "price" => 24,
    "image" => "https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=640&h=420&fit=crop"
  ],
  [
    "title" => "All Benefits of PLUS",
    "price" => 24,
    "image" => "https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=640&h=420&fit=crop"
  ],
];
?>
<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title><?= htmlspecialchars($title) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#eaf3ff;
    --panel:#ffffff;
    --ink:#0f172a;
    --muted:#6b7280;
    --brand:#4f46e5;
    --success:#10b981;
    --border:#e5e7eb;
    --chip:#eef2ff;
    --shadow:0 10px 30px rgba(2,6,23,.06);
    --radius:18px;
  }

  *{box-sizing: border-box}
  body{
    margin:0;
    background:var(--bg);
    font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
    color:var(--ink);
  }

  .wrap{
    max-width: 1180px;
    margin: 24px auto 40px;
    padding: 0 18px;
  }

  /* Top bar */
  .toolbar{
    display:flex;
    align-items:center;
    gap:14px;
    background:var(--panel);
    padding:14px 18px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
  }
  .btn-icon{
    width:36px;height:36px;border-radius:12px;border:1px solid var(--border);
    display:grid;place-items:center;background:#f8fafc;cursor:pointer;
  }
  .title{
    display:flex;align-items:center;gap:12px;flex:1;
  }
  .title h1{
    margin:0;font-size:16px;font-weight:700;
  }
  .meta{font-size:12px;color:var(--muted)}

  /* Layout */
  .grid{
    display:grid;
    grid-template-columns: 1.4fr .9fr;
    gap:22px;
    margin-top:18px;
  }
  .left, .right{
    background:var(--panel);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow:hidden;
  }

  /* Video area */
  .video{
    position:relative;
    background:#0b1220;
    min-height:520px;
    display:grid;
    place-items:center;
  }
  .video .hero{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
    filter: saturate(1.04);
  }
  .stack{
    position:absolute;right:18px;top:18px;
    display:flex;flex-direction:column;gap:14px;
  }
  .thumb{
    width:130px;height:96px;border-radius:14px;overflow:hidden;border:2px solid rgba(255,255,255,.85);
    box-shadow: 0 8px 16px rgba(2,6,23,.12);
  }
  .thumb img{width:100%;height:100%;object-fit:cover;display:block}

  /* Call controls */
  .controls{
    position:absolute;left:50%;transform:translateX(-50%);
    bottom:16px;background:#f1f5f9;border:1px solid var(--border);
    padding:12px 14px;border-radius:16px;display:flex;gap:12px;
    backdrop-filter: blur(4px);
  }
  .chip{
    width:48px;height:40px;border-radius:12px;border:1px solid var(--border);
    display:grid;place-items:center;background:white;cursor:pointer;transition:.2s;
  }
  .chip.primary{background:var(--brand);border-color:transparent}
  .chip.primary svg{filter:invert(1)}
  .chip:hover{transform:translateY(-2px)}

  /* Right column */
  .right{
    display:grid;grid-template-rows:auto 1fr auto;
    padding:18px;
    gap:18px;
  }
  .card{
    background:#f8fafc;border:1px solid var(--border);
    border-radius:14px;padding:14px;
  }
  .heading{font-weight:700;margin:0 0 10px}
  .progress{
    height:6px;background:#e5e7eb;border-radius:10px;overflow:hidden;margin-bottom:12px
  }
  .progress>span{display:block;height:100%;background:var(--success);width:50%}
  .section{
    border:1px solid var(--border);border-radius:12px;margin-bottom:10px;background:#fff;
  }
  .section .row{
    display:grid;grid-template-columns:1fr auto auto;gap:10px;
    align-items:center;padding:10px 12px;cursor:pointer;
  }
  .row:hover{background:#f9fafb}
  .row .sub{font-size:12px;color:var(--muted)}
  .row .badge{font-size:11px;background:var(--chip);padding:4px 8px;border-radius:999px;border:1px solid #dbe2ff}
  .lessons{padding:8px 12px;border-top:1px dashed var(--border);display:none}
  .lessons.open{display:block}
  .lesson{display:grid;grid-template-columns:1fr auto;gap:8px;padding:8px;border-radius:10px}
  .lesson:hover{background:#f8fafc}
  .lesson .time{font-size:12px;color:var(--muted)}

  /* Book for you */
  .cards{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  .product{
    border:1px solid var(--border);border-radius:14px;background:#fff;overflow:hidden
  }
  .product img{width:100%;height:120px;object-fit:cover;display:block}
  .product .padd{padding:12px}
  .price{font-weight:700;color:#059669}

  /* Responsive */
  @media (max-width: 1024px){
    .grid{grid-template-columns:1fr}
    .right{order:2}
  }
  @media (max-width: 560px){
    .controls{bottom:10px}
    .thumb{width:104px;height:78px}
    .video{min-height:420px}
  }
  /* util icons */
  .icon{width:18px;height:18px;display:block}
  .muted{color:var(--muted)}
</style>
</head>
<body>
  <div class="wrap">
    <!-- TOOLBAR -->
    <div class="toolbar">
      <button class="btn-icon" aria-label="Back">
        <!-- left arrow -->
        <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="title">
        <div>
          <div style="font-size:14px;font-weight:700;"><?= htmlspecialchars($title) ?></div>
          <div class="meta">
            <?= $meta["lessons"] ?> Lesson · <?= $meta["duration"] ?>
          </div>
        </div>
      </div>
      <button class="btn-icon" aria-label="Settings">
        <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" stroke="currentColor" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06A1.65 1.65 0 0015 19.4a1.65 1.65 0 00-1.5 1.6V21a2 2 0 01-4 0v-.01A1.65 1.65 0 008 19.4 1.65 1.65 0 006.18 19l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.6 15 1.65 1.65 0 003 13.5H3a2 2 0 010-4h.01A1.65 1.65 0 004.6 8 1.65 1.65 0 004 6.18l-.06-.06A2 2 0 016.77 3.3l.06.06A1.65 1.65 0 008 4.6 1.65 1.65 0 009.5 3H9.5a2 2 0 014 0h.01A1.65 1.65 0 0015 4.6c.48 0 .93-.19 1.27-.53l.06-.06A2 2 0 0119.16 6.8l-.06.06c-.34.34-.53.79-.53 1.27 0 .57.22 1.12.6 1.53.35.36.53.83.53 1.31 0 .48-.18.95-.53 1.31-.38.41-.6.96-.6 1.53z" stroke="currentColor" stroke-width="1.5" opacity=".35"/></svg>
      </button>
    </div>

    <!-- MAIN -->
    <div class="grid">
      <!-- LEFT: Video -->
      <div class="left">
        <div class="video">
          <img class="hero" src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1280&h=720&fit=crop" alt="Video">
          <div class="stack">
            <?php foreach($participants as $p): ?>
              <div class="thumb" title="<?= htmlspecialchars($p['name']) ?>">
                <img src="<?= htmlspecialchars($p['avatar']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Controls -->
          <div class="controls" role="group" aria-label="Call controls">
            <button class="chip" title="Tắt/Bật camera">
              <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M15 10l4-4v12l-4-4v2H5V8h10v2z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
            </button>
            <button class="chip" title="Tắt/Bật mic">
              <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M12 14a3 3 0 003-3V7a3 3 0 10-6 0v4a3 3 0 003 3z" stroke="currentColor" stroke-width="2"/><path d="M19 11a7 7 0 01-14 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <button class="chip primary" title="Chia sẻ màn hình">
              <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M4 5h16v10H4z" stroke="currentColor" stroke-width="2"/><path d="M8 19h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M12 8v4m0 0l-2-2m2 2l2-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button class="chip" title="Chat">
              <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M21 12a8 8 0 11-3.3-6.5L21 5l-.5 3.3A7.98 7.98 0 0121 12z" stroke="currentColor" stroke-width="2"/><path d="M8 13h5M8 9h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <button class="chip" title="Kết thúc">
              <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M4 12c4-3 12-3 16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M7 13v4M17 13v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- RIGHT: Sidebar -->
      <aside class="right">
        <!-- Course contents -->
        <section class="card">
          <h3 class="heading">Course Contents</h3>
          <div class="muted" style="font-size:12px;margin-bottom:10px">2/5 COMPLETED</div>
          <div class="progress"><span style="width:40%"></span></div>

          <?php foreach($sections as $i=>$s): ?>
            <div class="section" data-section="<?= $i ?>">
              <div class="row" role="button" aria-expanded="<?= $s['open'] ? 'true':'false' ?>">
                <div>
                  <div style="font-weight:600"><?= htmlspecialchars($s['title']) ?></div>
                  <div class="sub"><?= htmlspecialchars($s['time']) ?></div>
                </div>
                <div class="badge"><?= count($s['lessons']) ?> Lessons</div>
                <svg class="icon" viewBox="0 0 24 24" fill="none" style="opacity:.6">
                  <path d="M8 10l4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="lessons <?= $s['open']?'open':'' ?>">
                <?php foreach($s['lessons'] as $ls): ?>
                  <div class="lesson">
                    <div><?= htmlspecialchars($ls['title']) ?></div>
                    <div class="time"><?= htmlspecialchars($ls['time']) ?></div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </section>

        <!-- Book for you -->
        <section class="card">
          <h3 class="heading" style="display:flex;justify-content:space-between;align-items:center">
            <span>Book for you</span>
            <button class="btn-icon" title="Add">
              <svg class="icon" viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
          </h3>
          <div class="cards">
            <?php foreach($bookForYou as $b): ?>
              <article class="product">
                <img src="<?= htmlspecialchars($b['image']) ?>" alt="">
                <div class="padd">
                  <div style="font-weight:600"><?= htmlspecialchars($b['title']) ?></div>
                  <div class="price">$<?= number_format($b['price']) ?></div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section>
      </aside>
    </div>
  </div>

<script>
  // Mở/đóng từng section
  document.querySelectorAll(".section .row").forEach((row)=>{
    row.addEventListener("click", ()=>{
      const lessons = row.parentElement.querySelector(".lessons");
      const open = lessons.classList.toggle("open");
      row.setAttribute("aria-expanded", open ? "true" : "false");
    });
  });
</script>
</body>
</html>
