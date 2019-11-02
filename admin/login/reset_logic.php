<?php
	session_start();
	$errors = [];
	require_once("../../config/config.php");
	require_once("../../global_functions.php");
	connect_to_db();
	
	if (isset($_POST['reset'])) {
	  $email = mysqli_real_escape_string($db_connection, $_POST['email']);
	  // ensure that the user exists on our system
	  $query = "SELECT email FROM admin_users WHERE email='$email'";
	  $results = mysqli_query($db_connection, $query);

	  if (empty($email)) {
		array_push($errors, "Your email is required");
	  }else if(mysqli_num_rows($results) <= 0) {
		array_push($errors, "Sorry, no user exists on our system with that email");
	  }
	  // generate a unique random token of length 100
	  $token = bin2hex(random_bytes(50));
	  $_SESSION['token'] = $token;

	  if (count($errors) == 0) {
		// store token in the password-reset database table against the user's email
		$sql = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
		$results = mysqli_query($db_connection, $sql);

		// Send email to user with the token in a link they can click on
		$to = $email;
		$subject = "Reset your password on Cashbankers";
		$msg = "Hi there, click on this <a href=\"new_pass.php?token=" . $token . "\">link</a> to reset your password on our site";
		$msg = wordwrap($msg,70);
		$headers = "From: yardieyard@outlook.co.za";
		mail($to, $subject, $msg, $headers);
		header('location: pending.php?email=' . $email);
	  }
	  else{
		  
		  require_once("messages.php");
	  }
	}

	// ENTER A NEW PASSWORD
	