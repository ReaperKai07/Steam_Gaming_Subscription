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
require_once "controllers/AdminUsersProfileController.php";

// Validate and sanitize input to prevent security issues
$email = isset($_POST["email"]) ? $_POST["email"] : "";

if (!empty($email)) {
    // Check if $email is not empty before using it
    $AdminUserProfileController = new AdminUsersProfileController();
    $specificUsers = $AdminUserProfileController->getSpecificUsers($email);

    if (!empty($specificUsers)) {
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
                    $email,
                    $name,
                    $phone,
                    $address,
                    $membership,
                    $password,
                    $picture
                );

                if ($success) {
                    $specificUsers = $AdminUserProfileController->getSpecificUsers(
                        $email
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
    } else {
        echo "User not found";
    }
}
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Steam Gaming Membership System</title>
  <link rel="stylesheet" href="views/adminuserprofile/style.css">
  <link rel="icon" href="assets/logo.png">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

  <script src="views/adminuserprofile/script.js"></script>
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
                            <a class="nav-link" href="AdminUsers.php" style="background: #169bf1; color: whitesmoke; font-size: 17px;">
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
                <div class="container-fluid">
                    <div class="card shadow" style="border: 1px solid black; margin-left: 20px; margin-right: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <div class="card-header" style="background: #181824">
                            <h5 class="mb-0" style="color: whitesmoke; font-size: 30px;">Update Profile</h5>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card-footer border-0 py-5">
                                    <div class="row mb-5 gx-5">
                                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Name</label>
                                                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars(
                                                            $user["name"]
                                                        ) ?>" style="font-size: 16px; border: 1px solid black;">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Phone Number</label>
                                                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars(
                                                            $user["phone"]
                                                        ) ?>" style="font-size: 16px; border: 1px solid black;">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label" style="font-size: 20px;">Address</label>
                                                        <textarea name="address" class="form-control" style="font-size: 16px; border: 1px solid black;"><?= htmlspecialchars(
                                                            $user["address"]
                                                        ) ?></textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Membership</label>
                                                        <select name="membership" class="form-select" style="font-size: 16px; border: 1px solid black;">
                                                            <option value="No Membership" <?= $user[
                                                                "membership"
                                                            ] == "No Membership"
                                                                ? "selected"
                                                                : "" ?>>No Membership</option>
                                                            <option value="Bronze" <?= $user[
                                                                "membership"
                                                            ] == "Bronze"
                                                                ? "selected"
                                                                : "" ?>>Bronze</option>
                                                            <option value="Silver" <?= $user[
                                                                "membership"
                                                            ] == "Silver"
                                                                ? "selected"
                                                                : "" ?>>Silver</option>
                                                            <option value="Gold" <?= $user[
                                                                "membership"
                                                            ] == "Gold"
                                                                ? "selected"
                                                                : "" ?>>Gold</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Email</label>
                                                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars(
                                                            $user["email"]
                                                        ) ?>" style="font-size: 16px; border: 1px solid black; background-color: #fff; cursor: not-allowed;" readonly>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" style="font-size: 20px;">Password</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password" class="form-control" value="<?= htmlspecialchars(
                                                                $user[
                                                                    "password"
                                                                ]
                                                            ) ?>" style="font-size: 16px; border: 1px solid black;" id="passwordInput">
                                                            <span class="input-group-text" id="togglePassword" style="border: 1px solid black;">
                                                                <i class="bi bi-eye" style="cursor: pointer;" onclick="togglePasswordVisibility()"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4">
                                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                                <div class="row g-3">
                                                    <h4 class="mb-4 mt-0" style="text-align: center; font-size: 25px;">Profile Photo</h4>
                                                    <div class="text-center">

                                                        <!-- Rounded profile picture -->
                                                        <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 270px; height: 270px;">
                                                            <img id="profileImage" src="data:image/jpeg;base64,<?= base64_encode(
                                                                $user["picture"]
                                                            ) ?>" alt="Profile Image" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
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
                                    <br>
                                    <div class="gap-12 d-md-flex justify-content-md-left text-center mx-auto" style="padding-left: 27px">
                                        <a href="AdminUsers.php">
                                            <button type="button" class="btn btn-primary btn-lg">Back</button>
                                        </a>
                                        <button type="submit" name="updateProfile" class="btn btn-lg" style="background-color: #5cb85c; color: #ffffff; margin-left: 25%">Update profile</button>
                                        <button type="button" data-toggle="modal" data-target="#confirmationModal" class="btn btn-danger btn-lg" data-email="<?= htmlspecialchars(
                                            $user["email"]
                                        ) ?>">Delete profile</button>
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

    <script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');

        // Toggle the password field's type attribute between 'password' and 'text'
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.innerHTML = '<i class="bi bi-eye-slash" style="cursor: pointer;" onclick="togglePasswordVisibility()"></i>';
        } else {
            passwordInput.type = 'password';
            togglePassword.innerHTML = '<i class="bi bi-eye" style="cursor: pointer;" onclick="togglePasswordVisibility()"></i>';
        }
    }
</script>

    
</body>
</html>