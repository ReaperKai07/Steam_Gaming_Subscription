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
?>

<?php
require_once "controllers/AdminProductsController.php";

$AdminProductsController = new AdminProductsController();

if (isset($_POST["deleteProduct"])) {
    $product_id = isset($_POST["product_id"]) ? $_POST["product_id"] : "";

    try {
        $success = $AdminProductsController->deleteProducts($product_id);

        if ($success) {
            // Set the flag for successful delete
            $message = true;
        } else {
            // Set the flag for unsuccessful delete
            $message = false;
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

$allProducts = $AdminProductsController->getAllProducts();

// Get the page number from the query parameter, default to 1
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

// Get paginated products for the current page
$perPage = 6;
$paginatedProducts = $AdminProductsController->getPaginatedProducts($page, $perPage);

// Calculate the total number of pages based on the total number of products and perPage value
$totalPages = ceil(count($allProducts) / $perPage);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Steam Gaming Membership System</title>
  <link rel="stylesheet" href="views/adminproduct/style.css">
  <link rel="icon" href="assets/logo.png">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

  <script src="views/adminproduct/script.js"></script>

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
                        <a class="nav-link active" href="AdminDashboard.php" style="color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-house-fill" style="color: whitesmoke;"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AdminUsers.php" style="color: whitesmoke; font-size: 17px;">
                            <i class="bi bi-person-fill" style="color: whitesmoke;"></i> User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AdminProducts.php" style="background: #169bf1; color: whitesmoke; font-size: 17px;">
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
            <div class="container-fluid">
                <div class="card shadow" style="border: 1px solid black; margin-left: 20px; margin-right: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <div class="card-header" style="background: #181824;">
                        <h5 class="mb-0" style="color: whitesmoke; font-size: 30px;">View Product
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" id="searchInput" placeholder="Search..." oninput="filterTable()">
                            </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead >
                                <tr>
                                    <th scope="col" style="font-size: 16px; color: black;">product id</th>
                                    <th scope="col" style="font-size: 16px; color: black;">name</th>
                                    <th scope="col" style="font-size: 16px; color: black;">price</th>
                                    <th></th>
                                    <th></th>
                                    <th scope="col" style="font-size: 16px; color: black;">category</th>
                                    <th class="text-end">
                                        <a href="AdminProductsAdd.php">
                                            <button type="button" class="btn btn-sm" style="background-color: #5cb85c; color: #ffffff;">Add New Product</button>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($paginatedProducts as $product): ?>
                                <tr>
                                    <td style="font-size: 15px; color: black;">
                                    <img src="data:image/jpeg;base64,<?= base64_encode($product["product_image"]) ?>" class="avatar avatar-lg me-6" alt="No Image" style="width: 100px; height: auto; object-fit: cover; object-position: center;">
                                    </td>
                                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($product["product_name"]) ?></td>
                                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($product["product_price"]) ?></td>
                                    <td></td>
                                    <td></td>
                                    <td style="font-size: 15px; color: black;"><?= htmlspecialchars($product["product_category"]) ?></td>
                                    <td class="text-end">
                                        <form action="AdminProductsDetail.php" method="post" style="display: inline;">
                                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product["product_id"]) ?>">
                                            <button type="submit" class="btn btn-sm btn-neutral" style="background: #0275d8; color:whitesmoke;">View</button>
                                        </form>
                                        <button type="button" data-toggle="modal" data-target="#confirmationModal" class="btn btn-sm btn-square btn-neutral" style="background: #d11a2a; color: whitesmoke;" data-product_id="<?= htmlspecialchars($product["product_id"]) ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0 py-5">
                        <?php
                        // Calculate the total number of results
                        $totalResults = count($allProducts);

                        // Calculate the range of items being shown on the current page
                        $startItem = ($page - 1) * $perPage + 1;
                        $endItem = min(
                            $startItem + $perPage - 1,
                            $totalResults
                        );

                        // Display the information about the current page and total results
                        echo '<span class="text-muted text-sm">Showing ' .
                            $startItem .
                            " to " .
                            $endItem .
                            " of " .
                            $totalResults .
                            " results found</span>";
                        ?>
                        <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php
                                // Generate "Previous" button
                                echo '<li class="page-item';
                                echo $page == 1 ? " disabled" : "";
                                echo '"><a class="page-link" href="?page=' .
                                    ($page - 1) .
                                    '" style="width: 100px; text-align: center; background: #0275d8; color:whitesmoke;">Previous</a></li>';

                                // Generate page numbers
                                $numToShow = 3; // Number of pages to show
                                $startPage = max(
                                    1,
                                    $page - floor($numToShow / 2)
                                );
                                $endPage = min(
                                    $totalPages,
                                    $startPage + $numToShow - 1
                                );

                                // Adjust $startPage if needed to ensure the specified number of pages is shown
                                $startPage = max(1, $endPage - $numToShow + 1);

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    echo '<li class="page-item';
                                    echo $page == $i ? " active" : ""; // Apply active class to the current page
                                    echo '"><a class="page-link" href="?page=' .
                                        $i .
                                        '"';
                                    echo $page == $i
                                        ? ' style="background-color: #2d3436; color: #ffffff;"'
                                        : ""; // Highlight the current page
                                    echo ">" . $i . "</a></li>";
                                }

                                // Generate "Next" button
                                echo '<li class="page-item';
                                echo $page == $totalPages ? " disabled" : "";
                                echo '"><a class="page-link" href="?page=' .
                                    ($page + 1) .
                                    '" style="width: 100px; text-align: center; background: #0275d8; color:whitesmoke;">Next</a></li>';
                                ?>
                            </ul>
                        </nav>
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
                <h5 class="modal-title" id="confirmationModalLabel" style="font-size:30px">Delete Product</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size:20px">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: #0275d8; color:whitesmoke;">Cancel</button>
                <form id="deleteForm" action="AdminProducts.php" method="post" style="display: inline;">
                    <input type="hidden" name="product_id" id="deleteProductID" value="">
                    <button type="submit" name="deleteProduct" class="btn btn-danger" style="background: #d11a2a; color: whitesmoke;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirmationModal').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget);
        var product_id = button.data('product_id');
        $('#deleteProductID').val(product_id);
    });
</script>
<script>
    function showSweetAlertDeleteSuccess()
{
  Swal.fire({
  position: "center",
  icon: "success",
  title: "Deleted!",
  text: 'Product has been successfully deleted.',
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
  text: 'Failed to delete product.',
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