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

      if (isset($_POST["updateProfile"])) {
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
        $address = isset($_POST["address"]) ? $_POST["address"] : "";
        $membership = isset($_POST["membership"])
            ? $_POST["membership"]
            : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        // Check if a file was uploaded
        if (
            isset($_FILES["picture"]) &&
            $_FILES["picture"]["error"] === UPLOAD_ERR_OK
        ) {
            // New file uploaded, use its content
            $picture = file_get_contents($_FILES["picture"]["tmp_name"]);
        } else {
            // No new file uploaded and no existing picture data, use the default image
            //$defaultImagePath = 'assets/defaultprofile.png';
            //$picture = file_get_contents($defaultImagePath);
            $picture = $user["picture"];
        }

        try {
            $success = $AdminUserProfileController->updateProfile(
                $userEmail,
                $name,
                $phone,
                $address,
                $membership,
                $password,
                $picture
            );

            if ($success) {
                $specificUsers = $AdminUserProfileController->getSpecificUsers(
                  $userEmail
                );
                if (!empty($specificUsers)) {
                    $user = $specificUsers[0];

                    // Set the flag for successful update
                    $message = true;
                }
            } else {
                // Set the flag for unsuccessful update
                $message = false;
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Import Main CSS Files -->
  <link href="views/userprofileupdate/user_profile.css" rel="stylesheet">

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
                  <img id="profileImage" src="data:image/jpeg;base64,<?= base64_encode($user["picture"]) ?>" alt="Profile Image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 180px; height: 180px; object-fit: cover; object-position: center; z-index: 1">
                  <!--Profile Edit Button-->
                  <label for="customFile" type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                    Upload Picture
                  </label>
                  <p class="text-muted mt-3 mb-0" style="z-index: 1; font-size: 13px; text-align: center">Minimum size 300px x 300px</p>
                </div>
                <div class="ms-3" style="margin-top: 130px;">
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
              <div class="card-body p-4 text-black" style="display: flex; width: 100%">      
              <form class="row g-3" method="post" action="" enctype="multipart/form-data">
                  <div class="col-md-6">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Please Fill Your Name." value="<?php echo $user["name"]; ?>" style="border: 1px solid black">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Please Fill Your Phone." value="<?php echo $user["phone"]; ?>" style="border: 1px solid black">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Please Fill Your Address." value="<?php echo $user["address"]; ?>" style="border: 1px solid black">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Please Fill Your Email." value="<?php echo $user["email"]; ?>" style="border: 1px solid black; cursor: not-allowed;" readonly>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" name="password" placeholder="Please Fill Your Password." value="<?php echo $user["password"]; ?>" id="passwordInput" style="border: 1px solid black">
                      <span class="input-group-text" id="togglePassword" style="border: 1px solid black">
                        <i class="bi bi-eye"></i>
                      </span>
                    </div>
                  </div>
                  <input type="file" id="customFile" name="picture" onchange="checkImageSize(this)" hidden>
                  <input type="text" name="membership" value="<?php echo $user["membership"]; ?>" hidden>
                  <div class="col-12">
                    <br><br>
                    <div class="text-center">
                      <a class="btn btn-outline-dark" data-mdb-ripple-color="dark" onclick="window.location.href='UserProfile.php'">Back</a>
                      <button type="submit" name="updateProfile" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">Update profile</button> 
                    </div>
                    <br>
                  </div>
              </form>
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
  <script src="views/userprofileupdate/main.js"></script>

  <!-- Include Bootstrap Icons (bi) in your project for the eye icon -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/dist/bootstrap-icons.min.js"></script>
<script>
  var passwordInput = document.getElementById('passwordInput');
  var togglePassword = document.getElementById('togglePassword');

  togglePassword.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
      passwordInput.type = 'password';
      togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
    }
  });
</script>
<script>
        function checkImageSize(input)
{
  const file = input.files[0];

  if (file)
  {
    const img = new Image();
    img.onload = function ()
    {
      if (img.width < 300 || img.height < 300)
      {
        alert('Minimum image size should be 300px x 300px.');
        // Clear the file input to prevent uploading
        input.value = '';
      }
      else
      {
      // Display the selected image
        document.getElementById('profileImage').src = URL.createObjectURL(file);
      }
    };
    
    img.src = URL.createObjectURL(file);
  }
}
    </script>

</script>

<script>
<?php if (isset($message)) {
    if ($message === true) {
        echo "showSweetAlertUpdateSuccess();";
    } elseif ($message === false) {
        echo "showSweetAlertUpdateFailed();";
    }
    $message = null;
} ?>
</script>
</body>
</html> 