<?php
// course-calendar-create2.php
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* -------- DATA: Sidebar -------- */
$sections = [
  [
    "title" => "Change Simplification",
    "items" => array_map(fn($i) => [
      "name" => "Lesson 01 : Introduction about XD",
      "duration" => "30 mins",
      "active" => $i === 0
    ], range(0, 9))
  ],
  [
    "title" => "PRACTICE QUIZ",
    "items" => array_map(fn($i) => [
      "name" => "Lesson 01 : Introduction about XD",
      "duration" => "30 mins",
      "active" => false
    ], range(0, 9))
  ],
];

/* -------- DATA: Calendar -------- */
$month  = isset($_GET['m']) ? (int)$_GET['m'] : (int)date('n'); // 1..12
$year   = isset($_GET['y']) ? (int)$_GET['y'] : (int)date('Y');
$first  = mktime(0,0,0,$month,1,$year);
$daysIn = (int)date('t', $first);
$startW = (int)date('w', $first);  // 0=Sun..6=Sat
$todayY = (int)date('Y'); $todayM = (int)date('n'); $todayD = (int)date('j');

function dayCellClass($y,$m,$d,$todayY,$todayM,$todayD){
  if ($y===$todayY && $m===$todayM && $d===$todayD) return 'day today';
  $isWeekend = (int)date('w', mktime(0,0,0,$m,$d,$y));
  return 'day '.($isWeekend===0 || $isWeekend===6 ? 'weekend' : '');
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Course Calendar – Create 2</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --ink:#2F327D;
      --text:#4c5276;
      --muted:#8b95b7;
      --line:#E8EEFF;
      --bg:#F6F8FE;
      --card:#FFFFFF;
      --teal:#2fc7c6;
      --teal-2:#22b6b5;
      --accent:#5ed1cf;
      --shadow:0 14px 34px rgba(24,39,75,.08);
      --radius:14px
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#fff;color:var(--text)}
    a{text-decoration:none;color:inherit}
    img{max-width:100%;display:block}

    .app{display:grid;grid-template-columns:280px 1fr;min-height:100vh;background:#fff}
    /* ===== SIDEBAR ===== */
    aside{background:#F7F9FF;border-right:1px solid var(--line);padding:14px 0}
    .back{display:flex;gap:10px;align-items:center;padding:8px 16px 6px}
    .back .btn{width:36px;height:36px;border-radius:8px;background:#3ec7c4;color:#fff;display:grid;place-items:center;box-shadow:0 10px 22px rgba(46,196,182,.28)}
    .sec{padding:8px 16px}
    .sec h4{color:#293168;font-weight:700;font-size:15px;margin:12px 0}
    .list{display:flex;flex-direction:column;gap:10px;max-height:calc(100vh - 150px);overflow:auto;padding-right:8px}
    .lesson{display:flex;justify-content:space-between;align-items:center;background:#fff;border:1px solid #eef2ff;border-radius:12px;padding:12px}
    .lesson.active{background:#E9FBFB;border-color:#c9efee}
    .lesson .left{display:flex;align-items:center;gap:10px;min-width:0}
    .book{width:28px;height:28px;border-radius:8px;background:#2f327d;display:grid;place-items:center}
    .book svg{width:16px;height:16px;color:#fff}
    .ltitle{font-size:13px;color:#46507d;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px}
    .badge{padding:6px 10px;border-radius:10px;background:#FFF7E6;color:#D89A00;border:1px solid #FFE0B0;font-size:12px;font-weight:600}

    /* ===== MAIN ===== */
    main{background:#fff}
    .hero{background:linear-gradient(90deg,var(--teal),var(--teal-2));color:#fff;padding:20px 26px;border-bottom:1px solid #DDF3F4}
    .hero .row{display:flex;justify-content:space-between;align-items:center}
    .hero h1{font-size:26px;font-weight:700}
    .hero p{opacity:.95;margin-top:4px}
    .pill{display:inline-flex;gap:8px;align-items:center;padding:8px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.6);font-size:13px}
    .pill svg{width:18px;height:18px}

    .sheet{padding:24px}
    .grid{display:grid;grid-template-columns:1.4fr .9fr;gap:22px}
    /* card base */
    .card{background:var(--card);border:1px solid var(--line);border-radius:16px;box-shadow:var(--shadow)}
    /* form card */
    .form-card{padding:22px}
    .form-card h2{color:#243467;font-size:20px;margin-bottom:6px}
    .lead{color:var(--muted);font-size:13px;line-height:1.8;margin-bottom:18px}
    form{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .full{grid-column:1/-1}
    label{display:block;font-size:13px;color:#5a6391;margin-bottom:8px;font-weight:600}
    input,select,textarea{
      width:100%;padding:12px 14px;border:1px solid #E3E9FF;border-radius:10px;background:#FBFDFF;
      font:inherit;color:#3f476e;outline:none
    }
    input:focus,select:focus,textarea:focus{border-color:#b8c9ff;box-shadow:0 0 0 3px rgba(86,143,255,.12);background:#fff}
    textarea{min-height:120px;resize:vertical}
    .actions{grid-column:1/-1;display:flex;justify-content:flex-end}
    .btn{background:var(--accent);color:#fff;border:none;border-radius:10px;padding:12px 22px;font-weight:700;cursor:pointer}
    .btn:hover{filter:brightness(.96)}

    /* calendar card */
    .calendar-card{padding:18px}
    .cal-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:10px}
    .cal-title{color:#223064;font-weight:700}
    .nav-btns{display:flex;gap:8px}
    .btn-ghost{
      width:36px;height:36px;border-radius:10px;border:1px solid #dfe6ff;background:#fff;display:grid;place-items:center;cursor:pointer
    }
    .dow{display:grid;grid-template-columns:repeat(7,1fr);gap:6px;margin:6px 0 8px}
    .dow div{font-size:12px;color:#8290bf;text-align:center}
    .grid-days{display:grid;grid-template-columns:repeat(7,1fr);gap:6px}
    .day{
      height:44px;background:#F8FAFF;border:1px solid #E6EDFF;border-radius:10px;font-size:13px;color:#515c87;
      display:flex;align-items:flex-start;justify-content:flex-end;padding:8px
    }
    .day.weekend{background:#F4F7FF}
    .day.muted{opacity:.45}
    .day.today{background:#E9FBFB;border-color:#BEEFED;box-shadow:inset 0 0 0 2px rgba(47,199,198,.35)}
    .upcoming{margin-top:14px;border-top:1px dashed #E6EDFF;padding-top:12px}
    .up-item{display:flex;justify-content:space-between;align-items:center;background:#F7FAFF;border:1px solid #E6EDFF;border-radius:10px;padding:10px 12px;margin-top:10px}
    .up-item .when{color:#7280ad;font-size:12px}
    .tag{padding:6px 10px;border-radius:999px;background:#e9fbfb;color:#1aa9a7;font-size:12px;border:1px solid #bfeeed}

    /* responsive */
    @media (max-width: 1100px) {
      .app{grid-template-columns:1fr}
      aside{border-right:none;border-bottom:1px solid var(--line)}
      .list{max-height:unset}
    }
    @media (max-width: 820px){
      .grid{grid-template-columns:1fr}
    }
  </style>
</head>
<body>

<div class="app">

  <!-- ===== SIDEBAR ===== -->
  <aside>
    <div class="back">
      <a class="btn" href="#" aria-label="Back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M15 18l-6-6 6-6"/>
        </svg>
      </a>
    </div>

    <?php foreach ($sections as $sec): ?>
      <div class="sec">
        <h4><?= htmlspecialchars($sec['title']) ?></h4>
        <div class="list">
          <?php foreach ($sec['items'] as $i => $item): ?>
            <div class="lesson <?= !empty($item['active']) ? 'active' : '' ?>">
              <div class="left">
                <div class="book">
                  <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" fill="none">
                    <path d="M4 19V5a2 2 0 012-2h10v18H6a2 2 0 01-2-2z"/>
                    <path d="M6 2h10a2 2 0 012 2v13"/>
                  </svg>
                </div>
                <div class="ltitle"><?= htmlspecialchars($item['name']) ?></div>
              </div>
              <div class="badge"><?= htmlspecialchars($item['duration']) ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </aside>

  <!-- ===== MAIN ===== -->
  <main>
    <!-- Hero -->
    <section class="hero">
      <div class="row">
        <div>
          <h1>Learn about Adobe XD &amp; Prototyping</h1>
          <p>Introduction about XD</p>
        </div>
        <div class="pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M12 7v6l3 3"></path>
          </svg>
          <span>1 hour</span>
        </div>
      </div>
    </section>

    <!-- Content -->
    <section class="sheet">
      <div class="grid">
        <!-- Left: Create form -->
        <div class="card form-card">
          <h2>Create new event</h2>
          <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Lorem ipsum dolor sit amet,
            consectetur adipisicing elit, sed do eiusmod.
          </p>

          <form action="#" method="post" autocomplete="off">
            <div class="full">
              <label for="event_name">Event Name</label>
              <input id="event_name" class="input" type="text"
                     placeholder="Adobe XD Auto – Animate : Your Guide to Creating">
            </div>

            <div>
              <label for="start_dt">Start date / Time</label>
              <input id="start_dt" class="input" type="text" placeholder="September 24, 2017 07:59 am">
            </div>

            <div>
              <label for="end_dt">End Date / Time</label>
              <input id="end_dt" class="input" type="text" placeholder="September 24, 2017 07:59 am">
            </div>

            <div class="full">
              <label for="location">Location</label>
              <input id="location" class="input" type="text"
                     placeholder="2118 Thornridge Cir, Syracuse, Connecticut 35624">
            </div>

            <div>
              <label for="notify">Notification</label>
              <select id="notify">
                <option>30 mins</option>
                <option>1 hour</option>
                <option>3 hours</option>
                <option>1 day before</option>
              </select>
            </div>

            <div>
              <label for="email">Email</label>
              <input id="email" type="email" placeholder="jessica.hansome@example.com">
            </div>

            <div class="full">
              <label for="desc">Event Description</label>
              <textarea id="desc" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod..."></textarea>
            </div>

            <div class="actions">
              <button class="btn" type="submit">Save Now</button>
            </div>
          </form>
        </div>

        <!-- Right: Calendar -->
        <aside class="card calendar-card">
          <div class="cal-head">
            <div class="cal-title"><?= date('F Y', mktime(0,0,0,$month,1,$year)) ?></div>
            <div class="nav-btns">
              <a class="btn-ghost" title="Prev" href="?m=<?= $month==1?12:$month-1 ?>&y=<?= $month==1?$year-1:$year ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M15 18l-6-6 6-6"/>
                </svg>
              </a>
              <a class="btn-ghost" title="Next" href="?m=<?= $month==12?1:$month+1 ?>&y=<?= $month==12?$year+1:$year ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M9 6l6 6-6 6"/>
                </svg>
              </a>
            </div>
          </div>

          <div class="dow">
            <?php foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d): ?>
              <div><?= $d ?></div>
            <?php endforeach; ?>
          </div>

          <div class="grid-days">
            <?php
            // empty cells before day 1
            for ($i=0; $i<$startW; $i++) echo '<div class="day muted"></div>';

            // days of month
            for ($d=1; $d<=$daysIn; $d++):
              $cls = dayCellClass($year,$month,$d,$todayY,$todayM,$todayD);
            ?>
              <div class="<?= $cls ?>"><?= $d ?></div>
            <?php endfor; ?>
            <?php
            // complete 6 x 7 grid if muốn (optional). Bỏ qua để giữ chiều cao gọn.
            ?>
          </div>

          <div class="upcoming">
            <div style="font-weight:700;color:#283669;margin-bottom:6px">Upcoming schedule</div>

            <div class="up-item">
              <div>
                <div style="font-weight:600;color:#354072">UX Critique – Group A</div>
                <div class="when">Tomorrow • 09:00–10:00</div>
              </div>
              <span class="tag">Reminder 30m</span>
            </div>

            <div class="up-item">
              <div>
                <div style="font-weight:600;color:#354072">Prototype Review</div>
                <div class="when">Fri, <?= date('M j', strtotime('+2 days')) ?> • 13:00–14:00</div>
              </div>
              <span class="tag">Online</span>
            </div>
          </div>
        </aside>
      </div>
    </section>
  </main>
</div>

</body>
</html>
