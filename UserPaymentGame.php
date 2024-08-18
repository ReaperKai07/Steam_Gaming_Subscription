<?php
require_once "controllers/AdminUsersProfileController.php";
require_once "controllers/UserPaymentController.php";
$AdminUserProfileController = new AdminUsersProfileController();
$UserPaymentController = new UserPaymentController();

if (session_status() !== PHP_SESSION_ACTIVE) 
{
  session_start();
  // Check if the user is logged in
  if (isset($_SESSION['email']))
  {
      $userEmail = $_SESSION['email'];

      $specificUsers = $AdminUserProfileController->getSpecificUsers($userEmail);
      $user = $specificUsers[0];

      if (isset($_POST['product_id']))
      {
        $product_id = $_POST['product_id'];

        $specificProducts = $UserPaymentController->getSpecificProducts($product_id);
        $product = $specificProducts[0];

        if (isset($_POST["addOrder"]))
        {
          $product_id = isset($_POST["product_id"]) ? $_POST["product_id"] : "";
          $total_price = isset($_POST["total_price"]) ? $_POST["total_price"] : "";
          $status = isset($_POST["status"]) ? $_POST["status"] : "";

          $date = date("Y-m-d H:i:s");

          try
          {
            $success = $UserPaymentController->addOrder($product_id, $total_price, $date, $status, $userEmail);

            if ($success)
            {
              $message = true;
              header('Location: UserOrder.php');
              exit;
            }
            else
            {
              $message = false;
            }
          }
          
          catch (Exception $e)
          {
            echo "An error occurred: " . $e->getMessage();
          }
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
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <!-- Import Main CSS Files -->
  <link href="views/userpayment/user_profile.css" rel="stylesheet">

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

<!-- Payment -->
<section style="background-color: #212529;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center">
          <div class="col-md-8 col-xl-6 mb-4 mb-md-0">
            <!-- <div class="py-1 d-flex flex-row"> -->
              <!-- Back Button -->
              <!-- <h4><a href="#!"><i class="bi bi-arrow-bar-left"></i>Back</a></h4> -->
            <!-- </div> -->

            <div class="row py-5">
              <!-- Product Picture -->
              <div id="paypic" class="col-md-7" style="height: auto;">
                <img src="data:image/jpeg;base64,<?= base64_encode($product["product_image"]) ?>" alt="No Image" class="img-fluid" style="width: 100%; height: auto; object-fit: contain; object-position: center;">
              </div>
              <!-- Product Info -->
              <div id="payinfo" class="col-md-5" style="height: auto;">
                <!-- Product Price -->
                <h4 class="text-success py-4">RM <?php echo $product["product_price"]; ?></h4>
                <!-- Product Name -->
                <h4><?php echo $product["product_name"]; ?></h4>
                <!-- Product Description -->
                <div class="rounded py-3 d-flex" style="background-color: #f8f9fa; height: 70%; width: 100%;">
                <div class="p-2"><?php echo $product["product_description"]; ?></div>
                </div>          
              </div>
            </div>
          </div>

          <div class="col-md-4 col-xl-4 offset-xl-1 py-5">
            <!-- Order Recap -->
            <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                <div class="p-2 me-3">
                    <h4>Order Recap</h4>
                </div>
                <!-- Item Price Recap -->
                <div class="p-2 d-flex">
                    <div class="col-8">Item Price</div>
                    <div class="ms-auto">RM <?php echo $product["product_price"]; ?></div>
                </div>

                <?php
                // Assuming $user["membership"] holds the membership level
                $membershipDiscount = 0;

                if ($user["membership"] == "Silver Membership") {
                  $membershipDiscount = 0.20;
              } elseif ($user["membership"] == "Gold Membership") {
                  $membershipDiscount = 0.30;
              } elseif ($user["membership"] == "Bronze Membership") {
                  $membershipDiscount = 0.10;
              } else {
                  // Default case for "No Membership" or any other unhandled membership
                  $membershipDiscount = 0.00;
              }
              
                // Add other membership levels with corresponding discounts as needed

                $discountedPrice = $product["product_price"] - ($product["product_price"] * $membershipDiscount);
                ?>

                <!-- Discount Recap -->
                <div class="border-top px-2 mx-2"></div>
                <div class="p-2 d-flex pt-3">
                    <div class="col-8">
                        <?php echo $user["membership"] . " Discount (" . ($membershipDiscount * 100) . "%)"; ?>
                    </div>
                    <div class="ms-auto"><?php echo number_format($membershipDiscount * 100, 0) . " %"; ?></div>
                </div>
                <div class="p-2 d-flex">
                    <div class="col-8">Price Cut</div>
                    <div class="ms-auto">RM <?php echo number_format($product["product_price"] * $membershipDiscount, 2); ?></div>
                </div>

                <!-- Total Price Recap -->
                <div class="border-top px-2 mx-2"></div>
                <div class="p-2 d-flex pt-3">
                    <div class="col-8"><b>Total</b></div>
                    <div class="ms-auto"><b class="text-success">RM <?php echo number_format($discountedPrice, 2); ?></b></div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="pt-2">
              <div class="d-flex pb-2 py-3">
                <div>
                  <p><b>Payment Method</b></p>
                </div>
              </div>
              <!-- Payment Method Radio -->
              <div class="pb-3">
                <!-- Payment Method 1 -->
                <div class="d-flex flex-row pb-3">
                  <div class="d-flex align-items-center pe-2">
                    <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1" value="" aria-label="..." checked />
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0"><i class="fab fa-cc-visa fa-lg text-primary pe-2"></i>Touch 'n Go</p>
                  </div>
                </div>
                <!-- Payment Method 2 -->
                <div class="d-flex flex-row pb-3">
                  <div class="d-flex align-items-center pe-2">
                    <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2" value="" aria-label="..." />
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0"><i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>Online Banking</p>
                  </div>
                </div>
                <!-- Payment Method 3 -->
                <div class="d-flex flex-row pb-3">
                  <div class="d-flex align-items-center pe-2">
                    <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2" value="" aria-label="..." />
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0"><i class="fab fa-cc-mastercard fa-lg text-dark pe-2"></i>Paypal</p>
                  </div>
                </div>
              </div>
              <form action="UserPaymentGame.php" method="post">
                <button type="submit" name="addOrder" class="btn btn-primary btn-block btn-lg" >Proceed to Payment</button>
                <input type="text" name="product_id" value="<?php echo $product["product_id"]; ?>" class="btn btn-primary btn-block btn-lg" hidden/>
                <input type="text" name="total_price" value="<?php echo number_format($discountedPrice, 2); ?>" class="btn btn-primary btn-block btn-lg" hidden/>
                <input type="text" name="status" value="Pending" class="btn btn-primary btn-block btn-lg" hidden/>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
  <script src="views/userpayment/main.js"></script>

  <script>
    <?php if (isset($message))
    {
        if ($message === true) {
            echo "showSweetAlertBuySuccess();";
        } elseif ($message === false) {
            echo "showSweetAlertBuyFailed();";
        }
        $message = null;
    } ?>
</script>

<script>
  function showSweetAlertBuySuccess()
{
  Swal.fire({
  position: "center",
  icon: "success",
  title: "Done Payment!",
  text: 'Payment Successful.',
  showConfirmButton: false,
  timer: 5000
});
}

function showSweetAlertBuyFailed()
{
  Swal.fire({
  position: "center",
  icon: "error",
  title: "Payment Not Completed!",
  text: 'Payment Unsuccessful.',
  showConfirmButton: false,
  timer: 5000
});
}
</script>

</body>
</html> 