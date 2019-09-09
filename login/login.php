<!DOCTYPE html>
<?php
session_start();
require_once('../config/config.php');
if(isset($_SESSION['username']))
	header("Location: $base_url/dashboard");
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<?php 
			if(isset($_SESSION['registration_successfull'])) {
				unset($_SESSION['registration_successfull']);
		?>
				<div class='form'>
				<h3>You are registered successfully.</h3>
				<br>Please login to continue</div>"
		<?php 
			}
			if(isset($_SESSION['login_error'])) {
				unset($_SESSION['login_error']);
				echo "<div class='form'>
	 						<h3>Username/password is incorrect.</h3>
	 					</div>";
			} 
		?>
		<div class="form">
			<h1>Log In</h1>
			<form action="/api/login.php" method="post" name="login">
				<input type="text" name="username" placeholder="Username" required />
				<input type="password" name="password" placeholder="Password" required />
				<input name="submit" type="submit" value="Login" />
			</form>
			 <?php 
			  echo "<p>Not registered yet? <a href='$base_url/login/registration.php'>Register Here</a></p>";
			 ?>
		</div>
	</body>
</html>