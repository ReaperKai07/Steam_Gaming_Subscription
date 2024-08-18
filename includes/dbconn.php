<?php

///set database connection configuration
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "steamgaming";

//create connection
	$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

//check connection
	if (!$conn)
	{
	// Log the error to a file
	    error_log("Connection failed: " . mysqli_connect_error());

	// Display a generic error message to the user
	    die("Oops! Something went wrong. Please try again later.");

	// Close connection
	    mysqli_close($conn);
	}

?>