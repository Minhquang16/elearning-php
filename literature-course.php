<?php
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
<?php include 'header.php'; ?>
<body>


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
              <!--  -->
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
  <?php include 'footer.php'; ?>

</body>
</html>
