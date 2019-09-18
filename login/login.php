<?php
session_start();
require_once('../config/config.php');
if(isset($_SESSION['username']))
	header("Location: $base_url/dashboard");
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home Page</title>

  <!-- Custom fonts for this theme -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="../assets/css/freelancer.min.css" rel="stylesheet">

</head>
<body id="page-top">
	
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">CASH BANKERS</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
          </li>
	  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logon.php">Login</a>
          </li>
	  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="homepage.php#register">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
   <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
      <!-- Masthead Heading -->
      <h1 class="masthead-heading text-uppercase mb-0">Welcome!</h1>

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>

    </div>
  </header>
  
	
	<?php 
		if(isset($_SESSION['registration_successfull'])) {
			unset($_SESSION['registration_successfull']);
	?>
			<div class='form'>
				<h3 class="text-center">You are registered successfully.</h3>
				<p class="text-center">Please login to continue</p>
			</div>
	<?php 
		}
		if(isset($_SESSION['login_error'])) {
			unset($_SESSION['login_error']);
			echo "<div class='form'>
						<h3>Username/password is incorrect.</h3>
					</div>";
		} 
	?>

	<!-- log in form -->
	<section class="page-section" id="register">
		<div class="container">

		<!-- Registration Section Heading -->
			<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Login</h2>

			<!-- Icon Divider -->
			<div class="divider-custom">
				<div class="divider-custom-line"></div>
				<div class="divider-custom-icon">
					<i class="fas fa-star"></i>
				</div>
				<div class="divider-custom-line"></div>
			</div>
			
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<div class="form">
						<form action="../api/login.php" method="post" name="login">
							<div class="control-group">
								<div class="form-group floating-label-form-group controls mb-0 pb-10">
									<label>Username</label>
									<input class="form-control" id="name" name="username" type="text" placeholder="Username" required="required" data-validation-required-message="Please enter your name.">
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="control-group">
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<label>Password</label>
									<input class="form-control" id="password" name= "password"type="password" placeholder="Password" required="required" data-validation-required-message="Please enter your name.">
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<input name="submit" class="btn btn-primary btn-xl" type="submit" value="Login" />
						</form>
						<p>Not registered yet? <a href="<?php echo $base_url; ?>/login/registration.php">Register Here</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- <div class="form">
		<h1>Log In</h1>
		<form action="../api/login.php" method="post" name="login">
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input name="submit" type="submit" value="Login" />
		</form>
			<?php 
			//echo "<p>Not registered yet? <a href='$base_url/login/registration.php'>Register Here</a></p>";
			?>
	</div> -->
</body>
</html>