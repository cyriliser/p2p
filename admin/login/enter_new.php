<?php
require_once("reset_logic.php");
if (isset($_POST['new_password'])) {
	  $new_pass = mysqli_real_escape_string($db_connection, $_POST['new_pass']);
	  $new_pass_c = mysqli_real_escape_string($db_connection, $_POST['new_pass_c']);

	  // Grab to token that came from the email link
	   $token = $_SESSION['token'];
	  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
	  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
	  if (count($errors) == 0) {
		// select email address of user from the password_reset table 
		$sql = "SELECT email FROM password_reset WHERE token='$token' LIMIT 1";
		$results = mysqli_query($db_connection, $sql);
		$email = mysqli_fetch_assoc($results)['email'];

		if ($email) {
		  $new_pass = md5($new_pass);
		  $sql = "UPDATE admin_users SET password='$new_pass' WHERE email='$email'";
		  $results = mysqli_query($db_connection, $sql);
		  header('location: ../index.php');
		}
	  }
	}
	?>