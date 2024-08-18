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

      $allOrders = $AdminUserProfileController->getAllOrder($userEmail);
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
      <table class="table table-hover table-nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col" style="font-size: 16px; color: black;">Order ID</th>
                <th scope="col" style="font-size: 16px; color: black;">Product ID</th>
                <th scope="col" style="font-size: 16px; color: black;">Total Price</th>
                <th scope="col" style="font-size: 16px; color: black;">Date</th>
                <th scope="col" style="font-size: 16px; color: black;">Status</th>
                <th scope="col" style="font-size: 16px; color: black;">Actions</th> <!-- New column for Actions -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allOrders as $orders): ?>
                <tr>
                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($orders["order_id"]) ?></td>
                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($orders["product_id"]) ?></td>
                    <td style="font-size: 15px; color: black;">RM <?= htmlspecialchars($orders["total_price"]) ?></td>
                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($orders["date"]) ?></td>
                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($orders["status"]) ?></td>
                    <td style="font-size: 15px; color: black;">
                        <?php if ($orders["status"] == "Approve"): ?>
                          <form action="PrintOrders.php" method="post" target="_blank">
                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($orders["order_id"]) ?>">
                            <button type="submit" style="background: #0275d8; color: whitesmoke; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Print</button>
                          </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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

<script>
    function printOrder(orderId) {
    // Make an AJAX request to retrieve the order details
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var order = JSON.parse(this.responseText);

            // Generate the print content
            var printContent = '<h1>Order Details</h1>';
            printContent += '<p><strong>Order ID:</strong> ' + order.order_id + '</p>';
            printContent += '<p><strong>Product ID:</strong> ' + order.product_id + '</p>';
            printContent += '<p><strong>Total Price:</strong> RM ' + order.total_price + '</p>';
            printContent += '<p><strong>Date:</strong> ' + order.date + '</p>';
            printContent += '<p><strong>Status:</strong> ' + order.status + '</p>';

            // Create a new window for printing
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print Order</title></head><body>' + printContent + '</body></html>');
            printWindow.document.close();

            // Print the window
            printWindow.print();
        }
    };
    xhr.open('GET', 'getOrderDetails.php?orderId=' + orderId, true);
    xhr.send();
}

</script>
</body>
</html> 