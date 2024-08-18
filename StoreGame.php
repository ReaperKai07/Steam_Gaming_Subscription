<?php
require_once "controllers/ProductController.php";

// Validate and sanitize input to prevent security issues
$product = isset($_POST["product_id"]) ? $_POST["product_id"] : "";

if (!empty($product))
{
    // Check if $product is not empty before using it
    $ProductController = new ProductController();
    $specificProducts = $ProductController->getSpecificProducts($product);

    if (!empty($specificProducts))
    {
        $product = $specificProducts[0];
    }

    else
    {
        echo "Product not found";
    }
}
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
  <link href="views/storegame/store.css" rel="stylesheet">

</head>

<body class="membership-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- Navigation Bar -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0"><img src="assets/steamgaming.png" alt=""></a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php" style="color:black;">Home</a></li>   
        <li><a href="Store.php" style="color:black;">Store</a></li>         
        <li class="dropdown has-dropdown"><a href="Membership.php"><span style="color:black;">Membership</span> <i class="bi bi-chevron-down"></i></a>
          <ul class="dd-box-shadow">
            <li><a href="Membership.php#features" style="color:black;">Features</a></li>
            <li><a href="Membership.php#glimpse" style="color:black;">Glimpse</a></li>
            <li><a href="Membership.php#pricing" style="color:black;">Pricing</a></li>
            <li><a href="Membership.php#faq" style="color:black;">FAQ</a></li>
          </ul>
        </li>
        <li class="dropdown has-dropdown"><a href="About.php"><span style="color:black;">About</span> <i class="bi bi-chevron-down"></i></a>
          <ul class="dd-box-shadow">
            <li><a href="About.php#team" style="color:black;">Team Members</a></li>
            <li><a href="About.php#contact" style="color:black;">Contact</a></li>
          </ul>
        </li>
        
        <?php

        session_start();
        if (isset($_SESSION['email']))
        {
          echo '<li><a href="UserProfile.php" style="color:black;">My Profile</a></li>';
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
    <div class="container" style="margin-top: 130px;">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card" style="background: #121212; width: 1100px">
            <div class="row g-0">
              <!-- Image on the left -->
              <div class="col-md-6" style="height: auto;">
              <img src="data:image/jpeg;base64,<?= base64_encode($product["product_image"]) ?>" alt="No Image" class="img-fluid" style="width: 100%; height: auto; object-fit: contain; object-position: center;">
              </div>
              <!-- Details on the right -->
              <div class="col-md-6" style="background: #121212;">
                <div class="container" style="margin-top: 20px; margin-left: 10px;">
                  <b style="font-size: 50px; color: whitesmoke;"><p style="text-align: center;"><?= htmlspecialchars($product["product_name"]) ?><p></b>
                  <!-- Product Details Section -->
                  <section id="product-details" class="product-details" style="background: #121212; color: whitesmoke;">
                    <div class="container" style="margin-top: -50px;">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="rounded-box">
                            <b style="font-size: 30px;">Price</b>
                            <br>
                            <button style="padding:0.6em 0.6em; border-radius: 8px; color:#fff; background-color:#2e7d32; font-size:1.1em; border:0; cursor:pointer;">RM<?= htmlspecialchars($product["product_price"]) ?></button>
                          </div>
                        </div>
                        <br><br><br><br><br>
                        <div class="col-lg-12">
                          <div class="rounded-box">
                          <b style="font-size: 30px;">Category/Genre</b>
                            <br>
                            <button style="padding:0.6em 0.6em; border-radius: 8px; color:#fff; background-color:#1976d2; font-size:1.1em; border:0; cursor:pointer;"><?= htmlspecialchars($product["product_category"]) ?></button>
                          </div>
                        </div>
                        <br><br><br><br><br>
                        <div class="col-lg-12">
                          <div class="rounded-box">
                          <b style="font-size: 30px;">Description</b>
                            <p><?= htmlspecialchars($product["product_description"]) ?></p>
                            <form action="UserPaymentGame.php" method="post">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product["product_id"]) ?>">
                                <button type="submit" style="padding:0.6em 0.6em; border-radius: 8px; color:black; background-color:#ffffff; font-size:1.1em; border:0; cursor:pointer;">Get Game</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br><br><br><br>

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
<script src="views/storegame/store.js"></script>

</body>

</html> 