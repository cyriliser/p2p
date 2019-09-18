<?php
//include auth.php file on all secure pages
require_once("auth.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Welcome Home</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="form">
			<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
			<p>user id is: <?php echo $_SESSION['user_id']; ?>!</p>
			<p>Thank you for joining us</p>
			<p><a href="/sites/p2p/dashboard">Dashboard</a></p>
			<a href="logout.php">Logout</a>
		</div>
	</body>
</html>