<?php
if (session_status() !== PHP_SESSION_ACTIVE) 
{
  session_start();
  // Check if the user is logged in
  if (isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role'] == "2")
  {
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

require_once "controllers/AdminDashboardController.php";

$AdminDashboardController = new AdminDashboardController();

$user = $AdminDashboardController->countUser();
$product = $AdminDashboardController->countProduct();
$order = $AdminDashboardController->countOrder();

$allproduct = $AdminDashboardController->getAllProducts();

$allorderpending = $AdminDashboardController->getAllOrdersPending();



?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Steam Gaming Membership System</title>
  <link rel="stylesheet" href="views/admindashboard/style.css">
  <link rel="stylesheet" href="views/admindashboard/style1.css">
  <link rel="icon" href="assets/logo.png">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

  <script src="views/admindashboard/script.js"></script>
  <script src="views/admindashboard/script1.js"></script>

  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

  <style>
  table.table-hover tbody tr:hover {
    background-color: #bdc3c7; /* Change this color as per your preference */
  }
</style>

</head>

<body>
<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav style="background: #181824" class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical" >
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="AdminDashboard.php">
                <h3 class="text-success"><img src="assets/logo.png" width="40"><span class="text-info">STEAM</span>GAMING</h3> 
            </a>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="AdminDashboard.php" style="background: #169bf1; color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-house-fill" style="color: whitesmoke;"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AdminUsers.php" style="color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-person-fill" style="color: whitesmoke;"></i> User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AdminProducts.php" style="color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-cart-fill" style="color: whitesmoke;"></i> Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AdminOrders.php" style="color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-box-fill" style="color: whitesmoke;"></i> Order
                        </a>
                    </li>
                </ul>


                <!-- Push content down -->
                <div class="mt-auto"></div>
                <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="controllers/LogoutController.php" onclick="return confirm('Are you sure you want to logout?')" style="color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-box-arrow-left" style="color: whitesmoke;"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-12 mb-4 mb-sm-0" style="text-align: center;">
                            <!-- Title -->
                            <h1 class="h2 mb-0 ls-tight"></h1>
                        </div>
                        <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end">
                            <div class="mx-n1">
                                <img src="assets/logo1.png" class="avatar avatar-sm rounded-circle me-2">
                                <a class="text-heading font-semibold">
                                    admin
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Nav -->
                    <ul class="nav nav-tabs mt-4 overflow-x border-0">
                    </ul>
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
          <div class="home-content">
            <div class="overview-boxes">
              <div class="box">
                <div class="right-side">
                  <div class="box-topic">Total Order</div>
                  <div class="number"><?= htmlspecialchars($order) ?></div>
                  <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Up from yesterday</span>
                  </div>
                </div>
                <i class="bx bx-cart-alt cart"></i>
              </div>
              <div class="box">
                <div class="right-side">
                  <div class="box-topic">Total User</div>
                  <div class="number"><?= htmlspecialchars($user) ?></div>
                  <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Up from yesterday</span>
                  </div>
                </div>
                <i class="bx bxs-cart-add cart two"></i>
              </div>
              <div class="box">
                <div class="right-side">
                  <div class="box-topic">Total Product</div>
                  <div class="number"><?= htmlspecialchars($product) ?></div>
                  <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Up from yesterday</span>
                  </div>
                </div>
                <i class="bx bx-cart cart three"></i>
              </div>
                      </div>

            <div class="sales-boxes">

            <div class="recent-sales box">
                <div class="title">Pending Order</div>
                <div class="sales-details">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="font-size: 18px;">Order ID</th>
                                <th style="font-size: 18px;">Product ID</th>
                                <th style="font-size: 18px;">Total Price</th>
                                <th style="font-size: 18px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allorderpending as $order) : ?>
                                <tr>
                                    <td style="font-size: 18px;"><?= htmlspecialchars($order['order_id']) ?></td>
                                    <td style="font-size: 18px;"><?= htmlspecialchars($order['product_id']) ?></td>
                                    <td style="font-size: 18px;"><?= htmlspecialchars($order['total_price']) ?></td>
                                    <td style="font-size: 18px;"><?= htmlspecialchars($order['status']) ?></td>
                                    <!-- Add other order details as needed -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>



              <div class="top-sales box">
                <div class="title">Top Product</div>
                <ul class="top-sales-details">
                    <?php foreach ($allproduct as $product) : ?>
                        <li>
                            <div class="product-info">
                                <img src="data:image/jpeg;base64,<?= base64_encode($product["product_image"]) ?>" alt="Product Image" width="50" height="50">
                                <label class="product-name">&nbsp;&nbsp;&nbsp;<?= htmlspecialchars($product['product_name']); ?></label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            </div>
          </div>
        </main>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel" style="font-size:30px">Delete Profile</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size:20px">
                Are you sure you want to delete this profile?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: #0275d8; color:whitesmoke;">Cancel</button>
                <form id="deleteForm" action="AdminUsers.php" method="post" style="display: inline;">
                    <input type="hidden" name="email" id="deleteEmail" value="">
                    <button type="submit" name="deleteProfile" class="btn btn-danger" style="background: #d11a2a; color: whitesmoke;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirmationModal').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget);
        var email = button.data('email');
        $('#deleteEmail').val(email);
    });
</script>
<script>
    function showSweetAlertDeleteSuccess()
{
  Swal.fire({
  position: "center",
  icon: "success",
  title: "Deleted!",
  text: 'Profile has been successfully deleted.',
  showConfirmButton: false,
  timer: 2000
});
}

function showSweetAlertDeleteFailed()
{
  Swal.fire({
  position: "center",
  icon: "error",
  title: "Error!",
  text: 'Failed to delete profile.',
  showConfirmButton: false,
  timer: 2000
});
}
</script>
<script>
    <?php if (isset($message)) {
        if ($message === true) {
            echo "showSweetAlertDeleteSuccess();";
        } elseif ($message === false) {
            echo "showSweetAlertDeleteFailed();";
        }
        $message = null;
    } ?>
</script>
<script>
    // Function to filter table rows based on user input
    function filterTable() {
        // Get the value entered by the user
        var input = document.getElementById('searchInput').value.toUpperCase();

        // Get the table rows
        var rows = document.querySelectorAll('tbody tr');

        // Loop through each row and hide/show based on the search input
        for (var i = 0; i < rows.length; i++) {
            var rowData = rows[i].innerText.toUpperCase();

            // Check if the row data contains the search input
            if (rowData.includes(input)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    // Attach the filterTable function to the input field's input event
    document.getElementById('searchInput').addEventListener('input', filterTable);
</script>

</body>
</html>