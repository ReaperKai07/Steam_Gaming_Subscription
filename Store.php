<?php
require_once "controllers/ProductController.php";

$ProductController = new ProductController();
$allProducts = $ProductController->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SteamGaming</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Page Mini Icon -->
  <link href="assets/favicon.png" rel="icon">
  <link href="assets/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Import Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  
  <!-- Import CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Import Main CSS Files -->
  <link href="views/store/store.css" rel="stylesheet">

</head>

<body class="membership-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- Navigation Bar -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0"><img src="assets/steamgaming.png" alt=""></a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php">Home</a></li>   
        <li><a href="Store.php">Store</a></li>         
        <li class="dropdown has-dropdown"><a href="Membership.php"><span>Membership</span> <i class="bi bi-chevron-down"></i></a>
          <ul class="dd-box-shadow">
            <li><a href="Membership.php#features">Features</a></li>
            <li><a href="Membership.php#glimpse">Glimpse</a></li>
            <li><a href="Membership.php#pricing">Pricing</a></li>
            <li><a href="Membership.php#faq">FAQ</a></li>
          </ul>
        </li>
        <li class="dropdown has-dropdown"><a href="About.php"><span>About</span> <i class="bi bi-chevron-down"></i></a>
          <ul class="dd-box-shadow">
            <li><a href="About.php#team">Team Members</a></li>
            <li><a href="About.php#contact">Contact</a></li>
          </ul>
        </li>
        
        <?php

        session_start();
        if (isset($_SESSION['email']))
        {
          echo '<li><a href="UserProfile.php">My Profile</a></li>';
          echo '<li><a href="UserOrder.php">My Order</a></li>';
        }
        ?>

      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    <?php
        if (isset($_SESSION['email']))
        {
          echo '<a class="btn-getstarted" href="controllers/LogoutController.php" onclick="return confirm(\'Are you sure you want to logout?\')">Logout</a>';
        }
        
        else
        {
          echo '<a class="btn-getstarted" href="LoginSignup.php">Login</a>';
        }
    ?>
  </div>
</header>

  <main id="main">

    <!-- Banner Section -->
    <section id="banner" class="banner">
      <img src="assets/banner-bg.png" alt="" data-aos="fade-in">
      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Hey there, Gaming Enthusiast!</h2><br>
            <p data-aos="fade-up" data-aos-delay="200">Welcome to the coolest corner of the internet – our Steam Gaming Website! 🎮</p><br>
            <p data-aos="fade-up" data-aos-delay="300">Get ready to dive into a world of endless fun and excitement. We've got an awesome collection of games waiting for you to download and play! 🚀</p>
          </div>
        </div>
      </div>
    </section>

    <!-- collabs Section -->
    <section id="collabs" class="collabs">
      <div class="container-fluid" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-3.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-4.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-5.png" class="img-fluid" alt="">
          </div>
          <div class="col-xl-2 col-md-3 col-6 collab-logo">
            <img src="assets/collabs/collab-6.png" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section>

      <!-- Game Slider Section -->
      <h2 style="text-align: center">Trending Games</h2>
    <section id="game-slider" class="game-slider">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="popular-game-slider">
        
        <div class="swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide game-slide">
              <img src="assets/game/Apex_Legends.jpg" alt="Apex Legends">
              <div class="game-info">
                <h3>Apex Legends</h3>
                <span>Price: RM253.50</span>
              </div>
            </div>
            <div class="swiper-slide game-slide">
              <img src="assets/game/Dota_2.jpg" alt="Dota 2">
              <div class="game-info">
                <h3>Dota 2</h3>
                <span>Price: RM164.20</span>
              </div>
            </div>
            <div class="swiper-slide game-slide">
              <img src="assets/game/The_Evil_Within_2.jpg" alt="The Evil Within 2">
              <div class="game-info">
                <h3>The Evil Within 2</h3>
                <span>Price: RM172.45</span>
              </div>
            </div>
            <div class="swiper-slide game-slide">
              <img src="assets/game/Farcry_5.jpg" alt="Far Cry 5">
              <div class="game-info">
                <h3>Far Cry 5</h3>
                <span>Price: RM130.70</span>
              </div>
            </div>
            <div class="swiper-slide game-slide">
                <img src="assets/game/Left_4_Dead_2.jpg" alt="Left 4 Dead 2">
                <div class="game-info">
                  <h3>Left 4 Dead 2</h3>
                  <span>Price: RM95.40</span>
                </div>
              </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>

  <h2 style="text-align: center">Featured Games</h2>
  <section class="game-list">
    <?php foreach ($allProducts as $product): ?>
      <article class="game-card" style="margin-bottom: 20px;">
          <div class="icon-box">
          <img src="data:image/jpeg;base64,<?= base64_encode($product["product_image"]) ?>" alt="No Image">
          <h3><?= htmlspecialchars($product["product_name"]) ?></h3>
          <p>Price: RM<?= htmlspecialchars($product["product_price"]) ?></p>

          <form action="StoreGame.php" method="post">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product["product_id"]) ?>">
            <button type="submit" class="view-more">View More</button>
          </form>

          </div>
      </article>
    <?php endforeach; ?>
  </section>
  
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="membership.php" class="logo d-flex align-items-center"><span>Steam Gaming</span></a>
          <p>Your all-in-one gaming platform.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://store.steampowered.com/"><i class="bi bi-steam"></i></a>
            <a href="https://twitter.com/Steam"><i class="bi bi-twitter"></i></a>
            <a href="https://www.instagram.com/steamgamingofficial/"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/Steam/"><i class="bi bi-facebook"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Store.php">Store</a></li>
            <li><a href="Membership.php">Membership</a></li>
            <li><a href="About.php">About</a></li>
        </ul>
        </div>
        <div class="col-lg-2 col-6 footer-links">
          <h4>Our features</h4>
          <ul>
            <li><a></a></li>
            <li><a>Game List</a></li>
            <li><a>Game Pass</a></li>
            <li><a>Game News</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Technology Mara University</p>
          <p>Arau, Perlis, 02600</p>
          <p>Malaysia</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+60 12 345 6789</span></p>
          <p><strong>Email:</strong> <span>steamgaming@email.com</span></p>
        </div>
      </div>
    </div>
    
    <!-- We keep this section for copyright purpose-->
    <!--<div class="container copyright text-center mt-4">-->
      <!--<p>&copy; <span>Copyright</span> <strong class="px-1">Append</strong> <span>All Rights Reserved</span></p>-->
      <!--<div class="credits">-->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
      <!--</div>-->
    <!--</div>-->
    
  </footer>

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Import JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Import Main JS Files -->
  <script src="views/store/store.js"></script>

</body>

</html> 