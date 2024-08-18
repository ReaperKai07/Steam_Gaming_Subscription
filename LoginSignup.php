<?php
require_once "controllers/LoginSignupController.php";

$LoginSignupController = new LoginSignupController();

if (isset($_POST["signupUser"])) {
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $role = isset($_POST["role"]) ? $_POST["role"] : "";
    $picture = isset($_POST["picture"]) ? $_POST["picture"] : "";
    $membership = isset($_POST["membership"]) ? $_POST["membership"] : "";

    // Check if a file was uploaded
    if (
        isset($_FILES["picture"]) &&
        $_FILES["picture"]["error"] === UPLOAD_ERR_OK
    ) {
        // New file uploaded, use its content
        $picture = file_get_contents($_FILES["picture"]["tmp_name"]);
    } else {
        // No new file uploaded and no existing picture data, use the default image
        $defaultImagePath = "assets/defaultprofile.png";
        $picture = file_get_contents($defaultImagePath);
    }

    try {
        $success = $LoginSignupController->signupUser($name, $email, $password, $role, $picture, $membership);

        if ($success)
        {
            $message = true;
            
        } else {
            $message = false;

        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

if (isset($_POST["loginUser"])) {
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $role = isset($_POST["role"]) ? $_POST["role"] : "";

    if($email == "admin@gmail.com")
    {
    	$role = "2";

    	try 
    	{
	        $success = $LoginSignupController->loginUser($email, $password, $role);

	        if ($success)
	        {
				// Set session variable upon successful login
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['role'] = $role;

	            header('Location: AdminDashboard.php');
  				exit;
	            
	        }
	        else
	        {
	            $messageLogin = false;

	        }
	    } catch (Exception $e) {
	        echo "An error occurred: " . $e->getMessage();
	    }
    }

    else
    {
    	try 
    	{
	        $success = $LoginSignupController->loginUser($email, $password, $role);

	        if ($success)
	        {
				// Set session variable upon successful login
				session_start();
				$_SESSION['email'] = $email;
				
	            header('Location: UserProfile.php');
  				exit;
	            
	        } else {
	            $messageLogin = false;

	        }
	    } catch (Exception $e) {
	        echo "An error occurred: " . $e->getMessage();
	    }
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
  
	<!-- Import Main CSS Files -->
	<link href="views/loginsignup/login_signup.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">
  	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
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

        session_start();
        if (isset($_SESSION['user_id']))
        {
          echo '<li><a href="UserProfile.php">My Profile</a></li>';
		  echo '<li><a href="UserOrder.php">My Order</a></li>';
        }
        ?>

      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    <?php
        if (isset($_SESSION['user_id']))
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
	
	  <!-- Login/Singup Section -->
	<div class="container" id="main">
		<div class="sign-up">
			<form action="" method="POST" enctype="multipart/form-data">
				<h1>Create account</h1>
				<p>Use your email for registration</p>
				<input type="text" name="name" placeholder="Name" required>
				<input type="email" name="email" placeholder="Email" required>
				<input type="password" name="password" placeholder="Password" required>
				<input type="text" name="membership" value="No Membership" hidden>
				<input type="hidden" name="role" value="1" required>
				<input type="file" name="picture" hidden>
				<button type="submit" name="signupUser">Sign Up</button>
			</form>
		</div>
		<div class="sign-in">
			<form action="" method="POST">
				<h1>Login</h1>
				<p>Use your account</p>
				<input type="email" name="email" placeholder="Email" required>
				<input type="password" name="password" placeholder="Password" required>
				<input type="hidden" name="role" value="1" required>
				<a href="#">Forget your Password?</a>
				<button type="submit" name="loginUser">Login</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-left">
					<h1>Hello, Gaming Enthusiast</h1>
					<p>Enter your personal details and start journey with us</p>
					<button id="signIn">Login</button>
				</div>
				<div class="overlay-right">
					<h1>Welcome Back, Gaming Enthusiast!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	<script src="views/loginsignup/login.js"></script>
	
	<script>
    <?php if (isset($message)) {
        if ($message === true) {
            echo "showSweetAlertAddSuccess();";
        } elseif ($message === false) {
            echo "showSweetAlertAddFailed();";
        }
        $message = null;
    } ?>
</script>

<script>
    <?php if (isset($messageLogin)) {
        if ($messageLogin === false) {
            echo "showSweetAlertLoginFailed();";
        }
        $message = null;
    } ?>
</script>


</body>
</html>

