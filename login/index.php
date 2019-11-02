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
		<link href="../assets/css/freelancer.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css" />
	</head>
	<body id="page-top " class="bg-primary">

		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
			<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="<?php echo $base_url;?>"><?php echo $site_name;?></a>
			<button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
				<li class="nav-item mx-0 mx-lg-1">
					<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Portfolio</a>
				</li>
				<li class="nav-item mx-0 mx-lg-1">
					<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
				</li>
				<li class="nav-item mx-0 mx-lg-1">
					<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
				</li>
				<li class="nav-item mx-0 mx-lg-1 d-flex">
					<span class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger text-white px-1 py-1"><?php echo  $_SESSION['username'];?></span>
					<a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger px-1 py-1" href="<?php echo $base_url; ?>/login/logout.php">Logout</a>
				</li>

				</ul>
			</div>
			</div>
		</nav>

		<!-- Masthead -->
		<header class="masthead bg-primary text-white text-center pt-5 pb-0 bg-primary mt-5">
			<div class="container d-flex align-items-center flex-column hide">

			<!-- Masthead Avatar Image -->
			<img class="masthead-avatar mb-5" src="../assets/img/avataaars.svg" alt="">

			<!-- Masthead Heading -->
			<h1 class="masthead-heading text-uppercase mb-0">Welcome <?php echo $_SESSION['username']; ?></h1>

			<!-- Icon Divider -->
			<div class="divider-custom divider-light">
				<div class="divider-custom-line"></div>
				<div class="divider-custom-icon">
				<i class="fas fa-star"></i>
				</div>
				<div class="divider-custom-line"></div>
			</div>

			<!-- Masthead Subheading -->
			<h2 class="masthead-subheading font-weight-light mb-0">Thank you for joining us</h2>

			</div>

			<div class="card container mt-4 p-3">
				<h4>Please Proceed to the Dashboard or Logout</h4>
				<div class="btns">
					<a class="btn btn-info " href="<?php echo $base_url; ?>/dashboard/index1.php">Dashboard</a>

					<a class="btn btn-danger" href="/login/logout.php">Logout</a>
				</div>

				<!-- <p>Welcome <?php //echo $_SESSION['username']; ?>!</p> -->
				<!-- <p>  -->
					<?php// if(isset($_SESSION['referenced']))
								// echo "temporary "; // If a user is referenced, they have a temporary ref id
							// echo "user id is:".$_SESSION['user_id']; 
					?>
				<!-- </p> -->
			</div>

		</header>

	</body>
</html>