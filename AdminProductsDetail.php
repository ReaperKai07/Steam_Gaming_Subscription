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
require_once "controllers/AdminProductsDetailController.php";

// Validate and sanitize input to prevent security issues
$product_id = isset($_POST["product_id"]) ? $_POST["product_id"] : "";

if (!empty($product_id)) {
    // Check if $email is not empty before using it
    $AdminProductsDetailController = new AdminProductsDetailController();
    $specificProducts = $AdminProductsDetailController->getSpecificProducts($product_id);

    if (!empty($specificProducts)) {
        $product = $specificProducts[0];

        if (isset($_POST["updateProduct"])) {
            $product_name = isset($_POST["product_name"]) ? $_POST["product_name"] : "";
            $product_price = isset($_POST["product_price"]) ? $_POST["product_price"] : "";
            $product_category = isset($_POST["product_category"]) ? $_POST["product_category"] : "";
            $product_description = isset($_POST["product_description"]) ? $_POST["product_description"] : "";

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
                $picture = $product["product_image"];
            }

            try {
                $success = $AdminProductsDetailController->updateProduct(
                    $product_id,
                    $product_name,
                    $product_price,
                    $product_category,
                    $product_description,
                    $picture
                );

                if ($success) {
                    $specificProducts = $AdminProductsDetailController->getSpecificProducts(
                        $product_id
                    );
                    if (!empty($specificProducts)) {
                        $product = $specificProducts[0];

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
    } else {
        echo "Product not found";
    }
}
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Steam Gaming Membership System</title>
  <link rel="stylesheet" href="views/adminproductdetail/style.css">
  <link rel="icon" href="assets/logo.png">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

  <script src="views/adminproductdetail/script.js"></script>
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
                        <div class="card-header" style="background: #181824">
                            <h5 class="mb-0" style="color: whitesmoke; font-size: 30px;">Update Product</h5>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-footer border-0 py-5">
                                    <div class="row mb-5 gx-5">
                                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Product Name</label>
                                                        <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars(
                                                            $product["product_name"]
                                                        ) ?>" style="font-size: 16px; border: 1px solid black;">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Product Price</label>
                                                        <input type="text" name="product_price" class="form-control" value="<?= htmlspecialchars(
                                                            $product["product_price"]
                                                        ) ?>" style="font-size: 16px; border: 1px solid black;">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label" style="font-size: 20px;">Product Category</label>
                                                        <textarea name="product_category" class="form-control" style="font-size: 16px; border: 1px solid black;"><?= htmlspecialchars(
                                                            $product["product_category"]
                                                        ) ?></textarea>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label" style="font-size: 20px;">Product Description</label>
                                                        <textarea name="product_description" class="form-control" style="font-size: 16px; border: 1px solid black;"><?= htmlspecialchars(
                                                            $product["product_description"]
                                                        ) ?></textarea>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row g-3">
                                                    <div class="col-md-2">
                                                        <label class="form-label" style="font-size: 20px;">Product ID</label>
                                                        <input type="text" name="product_id" class="form-control" value="<?= htmlspecialchars($product["product_id"]) ?>" style="font-size: 16px; border: 1px solid black; background-color: #fff; cursor: not-allowed;" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4">
                                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                                <div class="row g-3">
                                                    <h4 class="mb-4 mt-0" style="text-align: center; font-size: 25px;">Product Image</h4>
                                                    <div class="text-center">

                                                        <!-- Rounded profile picture -->
                                                        <div class="overflow-hidden mx-auto mb-3" style="width: 250px; height: 340px;">
                                                            <img id="profileImage" src="data:image/jpeg;base64,<?= base64_encode($product["product_image"]) ?>" alt="Profile Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                                        </div>

                                                        <input type="file" id="customFile" name="picture" onchange="checkImageSize(this)" hidden>
                                                        <label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
                                                        <!--<label class="btn btn-danger-soft btn-block" onclick="removeProfileImage()">Remove</label>-->

                                                        <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gap-12 d-md-flex justify-content-md-left text-center mx-auto" style="padding-left: 27px">
                                        <a href="AdminProducts.php">
                                            <button type="button" class="btn btn-primary btn-lg">Back</button>
                                        </a>
                                        <button type="submit" name="updateProduct" class="btn btn-lg" style="background-color: #5cb85c; color: #ffffff; margin-left: 25%">Update product</button>
                                        <button type="button" data-toggle="modal" data-target="#confirmationModal" class="btn btn-danger btn-lg" data-product_id="<?= htmlspecialchars($product["product_id"]) ?>">Delete product</button>
                                    </div>
                            </div>
                        </form>
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

    <script>
    // Function to remove the profile image
    function removeProfileImage()
    {
        // Reset the file input
        document.getElementById('customFile').value = '';

        // Reset the preview image
        document.getElementById('profileImage').src = 'assets/defaultprofile.png';
    }
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