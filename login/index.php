<?php
// session_start(); session is started on auth.php
//include auth.php file on all secure pages
include("auth.php");
require_once("../config/config.php");
require_once("../global_functions.php");
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
		<p> <?php if(isset($_SESSION['referenced']))
						echo "temporary "; // If a user is referenced, they have a temporary ref id
					echo "user id is:".$_SESSION['user_id']; 
		?>!</p>
		<p>Thank you for joining us</p>
		<p><a href="<?php echo $base_url; ?>/dashboard">Dashboard</a></p>
		<a href="logout.php">Logout</a>
	</div>
	</body>
</html>