<?php include 'header.php'; ?>
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
<body>
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
<?php include 'footer.php'; ?>

</body>
</html>
