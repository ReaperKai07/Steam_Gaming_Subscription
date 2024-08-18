<?php
require_once "controllers/AdminUsersProfileController.php";
$AdminUserProfileController = new AdminUsersProfileController();

if (session_status() !== PHP_SESSION_ACTIVE) 
{
  session_start();
  // Check if the user is logged in
  if (isset($_SESSION['email']))
  {
      $userEmail = $_SESSION['email'];

      $specificUsers = $AdminUserProfileController->getSpecificUsers($userEmail);
      $user = $specificUsers[0];
      
  }

  else
  {
    // Redirect to login if not logged in
    header('Location: controllers/LogoutController.php');
    exit;
  }
}

else
{
  // Redirect to login if not logged in
  header('Location: controllers/LogoutController.php');
  exit;
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
  <link href="assets/logo.png" rel="apple-touch-icon">

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
  <link href="views/userprofile/user_profile.css" rel="stylesheet">

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
    <!-- Backgroud Wallpaper -->
    <section class="bgwallpaper h-100 " style="background: url('assets\\bg.jpg') center center fixed; background-size: cover;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-9 col-xl-10">
            <div class="card">
              <!-- Banner Wallpaper -->
              <div class="rounded-top text-white d-flex flex-row" style="background: url('assets\\recent\\banner.jpg'); background-size: cover; height:200px;">
                <div class="ms-5 mt-5 d-flex flex-column" style="width: 180px;">
                  <!-- User Profile Image -->
                  <img src="data:image/jpeg;base64,<?= base64_encode($user["picture"]) ?>" alt="Profile Image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 180px; height: 180px; object-fit: cover; object-position: center; z-index: 1">
                  <!--Profile Edit Button-->
                  <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;" onclick="window.location.href='UserProfileUpdate.php'">
                      Edit profile
                  </button>
                </div>
                <div class="ms-3" style="margin-top: 130px;">
                  <h4 style="color: whitesmoke;"><b><?php echo $user["name"]; ?></b></h4> <!-- User name-->
                  <p><?php echo $user["email"]; ?></p> <!-- User email-->
                </div>
              </div>
              <!-- counter -->
              <div class="p-4 text-black" style="background-color: #f8f9fa;">
                <div class="d-flex justify-content-end text-center py-1">
                  <div  class="card py-3 px-3" style="margin: 10px;">
                    <!-- Count Games Owned-->
                    <p class="mb-1 h3">00</p>
                    <p class="text-muted mb-0">Games Owned</p>
                  </div>
                  <div class="card py-3 px-3" style="margin: 10px;">
                    <!-- Count DLCs Owned-->
                    <p class="mb-1 h3">00</p>
                    <p class="text-muted mb-0">DLCs Owned</p>
                  </div>
                  <div  class="card py-3 px-3" style="margin: 10px;">
                    <!-- Display Membership Type-->
                    <p class="mb-1 h3"><?php echo $user["membership"]; ?></p>
                    <p class="text-muted mb-0">Membership</p>
                  </div>
                </div>
              </div>
              <div class="card-body p-4 text-black">      
                <div class="mb-5">
                  
                  <div class="p-2" style="background-color: #f8f9fa;">
                  <p class="lead fw-normal mb-1">Address</p> 
                    <p class="font-italic mb-1"><?php echo $user["address"]; ?></p>
                  </div>

                  <div class="p-2" style="background-color: #f8f9fa;">
                  <p class="lead fw-normal mb-1">Phone</p> 
                    <p class="font-italic mb-1"><?php echo $user["phone"]; ?></p>
                  </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <p class="lead fw-normal mb-0">Recent photos</p>
                </div>

                <div class="row g-2">
                  <div class="col mb-2">
                    <img src="assets/recent/dmc4.jpg"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                  <div class="col mb-2">
                    <img src="assets/recent/assassincreed.jpg"
                      alt="image 1" class="w-100 rounded-3">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Call-to-action Section -->
    <section id="call-to-action" class="call-to-action">
      <img src="assets/cta-bg.jpg" alt="">
      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Upgrade Your Membership</h3>
              <p>Will you answer the call ?</p>
              <a class="cta-btn" href="Membership.php#pricing">Let's Go</a>
            </div>
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
        <a href="Membership.php" class="logo d-flex align-items-center"><span>Steam Gaming</span></a>
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
        <p>Technology Mara University,</p>
        <p>02600, Arau, Perlis,</p>
        <p>Malaysia.</p>
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
  <script src="views/userprofile/main.js"></script>

</body>
</html> 