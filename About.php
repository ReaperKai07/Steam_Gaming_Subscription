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
  <link href="views/about/about.css" rel="stylesheet">

</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

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
          echo '<a class="btn-getstarted" style="background: linear-gradient(to right, #00D4FF, #00CC88);" href="controllers/LogoutController.php" onclick="return confirm(\'Are you sure you want to logout?\')">Logout</a>';
        }
        
        else
        {
          echo '<a class="btn-getstarted" style="background: linear-gradient(to right, #00D4FF, #00CC88);" href="LoginSignup.php">Login</a>';
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
            <h2 data-aos="fade-up" data-aos-delay="100">Learn about us.</h2>
            <p data-aos="fade-up" data-aos-delay="200">We are dreamful designers, passionate programmers and hardcore gamers.</p>
            <p data-aos="fade-up" data-aos-delay="300">We hope to gather all type of gamers into a single platform where we all can enjoy together. </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="team">

      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team Members</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-5 justify-content-center">
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="assets/team/team-1.jpg" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4>MUHAMMAD HIFZHAN BIN AZMA FIZAL</h4>
              <span>Chief Executive Officer</span>
              <p>2022898318</p>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
            <div class="member-img">
              <img src="assets/team/team-2.jpg" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4>NURAINA SURAYA BINTI SUHAIMI</h4>
              <span>Product Manager</span>
              <p>2022491406</p>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">
            <div class="member-img">
              <img src="assets/team/team-3.jpg" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4>KHAIRUL IZZAT BIN ROSLAN</h4>
              <span>CTO</span>
              <p>2022464134</p>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
            <div class="member-img">
              <img src="assets/team/team-4.jpg" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4>MUHAMMAD ALIF AIMAN BIN MUHAMAD SOPIAN</h4>
              <span>Accountant</span>
              <p>2021454662</p>
            </div>
          </div><!-- End Team Member --> 
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="500">
            <div class="member-img">
              <img src="assets/team/team-5.jpg" class="img-fluid" alt="">
              <div class="social">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info text-center">
              <h4>MUHAMMAD AMIRUL FAHMY BIN AZIRUL</h4>
              <span>Marketing</span>
              <p>2021486184</p>
            </div>
          </div><!-- End Team Member -->
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">

      <!--  Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Technology Mara University,</p>
                  <p>02600,Arau, Perlis, Malaysia.</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+60 12 3456 789</p>
                  <p>Please respect our curfew hours.</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>steamgaming@email.com</p>
                  <p>We will getback at you within 3 workdays.</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Thursday</p>
                  <p>09:00AM - 05:00PM</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-6">
            <form class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

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
              <h3>Join The Membership</h3>
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

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="views/about/main.js"></script>

</body>
</html>