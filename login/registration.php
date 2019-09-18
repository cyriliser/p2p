<?php
session_start();
require_once('../global_functions.php');
require_once('../config/config.php');
if(isset($_SESSION['username']))
	header("Location: $base_url/dashboard");
connect_to_db();

if(isset($_SESSION['form_data'])) {
	if(!(strpos($_SESSION['form_data']['name'],"=") !== false)) { // Check if we've modified the form_data before
		foreach($_SESSION['form_data'] as $key => $value)
			$_SESSION['form_data'][$key] = "value=".$value; // This allows form to keep it's data if redirected back here
	}
}else {
	$_SESSION['form_data']['username'] = "";
	$_SESSION['form_data']['email'] = "";
	$_SESSION['form_data']['password'] = "";
	$_SESSION['form_data']['name'] = "";
	$_SESSION['form_data']['surname'] = "";
	$_SESSION['form_data']['dob'] = "";
	$_SESSION['form_data']['cellphone'] = "";
	$_SESSION['form_data']['cellphone2'] = "";
	$_SESSION['form_data']['account_no'] = "";
	$_SESSION['form_data']['bank_name'] = "";
	
}
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Nhlaluko" >

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
      <a class="navbar-brand js-scroll-trigger" href="<?php echo $base_url; ?>">CASH BANKERS</a>
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
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo $base_url; ?>/login/login.php">Login</a>
          </li>
	  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo $base_url; ?>/login/registration.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">

      <!-- Masthead Avatar Image -->
     

      <!-- Masthead Heading -->
	  <a href="#register"> <img class="masthead-avatar mb-5" src="img/avataaars.svg" alt=""></a>
      <h1 class="masthead-heading text-uppercase mb-0">Register</h1>

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

  <!-- About Section -->
  <section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">

      <!-- About Section Heading -->
      <!-- <h2 class="page-section-heading text-center text-uppercase text-white">About</h2> -->

      <!-- Icon Divider -->
      <!-- <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div> -->

      <!-- About Section Content -->
      <!-- <div class="row">
        <div class="col-lg-4 ml-auto">
          <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.</p>
        </div>
        <div class="col-lg-4 mr-auto">
          <p class="lead">You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!</p>
        </div>
      </div> -->

      <!-- About Section Button -->
      <!-- <div class="text-center mt-4">
        <a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/themes/freelancer/">
          <i class="fas fa-download mr-2"></i>
          Free Download!
        </a>
      </div> -->

    </div>
  </section>
  <!-- Contact Section -->
  <section class="page-section" id="register">
    <div class="container">
    <?php
    	if(isset($_SESSION['taken'])) {
    		echo "<div class=\"form-group floating-label-form-group controls mb-0 pb-2\">
						<p class='text-center'>".$_SESSION['taken']." already registered</p>
					</div>";
			unset($_SESSION['taken']);
    	}
    	if(isset($_SESSION['security_check'])) {
    		unset($_SESSION['security_check']);
    		echo "
    		<div class='form-group floating-label-form-group controls mb-0 pb-2'>
    			<p class='text-center btn-danger'>Security check failed, please check your information and try again</p>
    		</div>
    		";
    	}
    	if(isset($_SESSION['registration_failed'])) {
    		unset($_SESSION['registration_failed']);
    		echo "
    		<div class='form-group floating-label-form-group controls mb-0 pb-2'>
    			<p class='text-center btn-danger'>Error saving your information, please check and try again</p>
    		</div>
    		";
    	}
    ?>
      <div class="row">
        <div class="col-lg-8 mx-auto">
			<!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
			<h1>Personal Details</h1>
			<form name="sentMessage" onsubmit="return checkForm(this);" method="post" action="../api/register.php" id="contactForm">
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Username</label>
					<?php echo '<input class="form-control" id="name" name="username" type="text" placeholder="Username" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['username'].'>'; ?>
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Email Address</label>
					<?php echo '<input class="form-control" id="email" name="email"type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address." '.$_SESSION['form_data']['email'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Password</label>
					<?php echo '<input class="form-control" id="password" name= "password" type="password" placeholder="Password" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['password'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Password</label>
					<?php echo '<input class="form-control" id="password2" name= "password2" type="password" placeholder="Verify Password" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['password'].'>'; ?>					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Name</label>
					<?php echo '<input class="form-control" id="name" name ="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['name'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Surname</label>
					<?php echo '<input class="form-control" id="name" name="surname" type="text" placeholder="Surname" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['surname'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Date of Birth</label>
					<?php echo '<input class="form-control" id="name" name = "dob" type="text" placeholder="Date of Birth" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['dob'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Phone Number</label>
					<?php echo '<input class="form-control" id="name" name = "cellphone" type="text" placeholder="Cellphone Number" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['cellphone'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				
				<h1>Banking details</h1>
				<select name= "bank">
					<option value="capitec">Capitec Bank</option>
					<option value="standard">Standard Bank</option>
					<option value="fnb">First National Bank</option>
					<option value="absa">ABSA</option>
					<option value="ithala">Ithala Bank</option>
				</select>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
						<label>Account Number</label>
						<?php echo '<input class="form-control" id="name" type="text" name="account_no" placeholder="Account number" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['account_no'].'>'; ?>
						
						<p class="help-block text-danger"></p>
					</div>
					</div>
					<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
						<label>Linked Cellphone Number</label>
						<?php echo '<input class="form-control" id="name"  type="text" name="cellphone2" placeholder="Linked Cellphone Number" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['cellphone2'].'>'; ?>
						
						<p class="help-block text-danger"></p>
					</div>
					</div>
					<br>
					<div id="success"></div>
					<div class="form-group">
					<button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Register</button>
					<?php
								if(isset($_GET['ref'])) {
									$_SESSION['ref'] = $_GET['ref'];
									// Let's check if the reference exists
									$result = mysqli_query($db_connection,"SELECT username from users where id=".$_GET['ref']);
									if($result)
										echo "<input type='text' class='btn' placeholder='Referrer: ".mysqli_fetch_row($result)[0]."' disabled />";
								}?>
          </div>
			</form>
			</div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <div class="row">

        <!-- Footer Location -->
        <div class="col-lg-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4">Location</h4>
          <p class="lead mb-0">2215 John Daniel Drive
            <br>Clark, MO 65243</p>
        </div>

        <!-- Footer About Text -->
        <div class="col-lg-4">
          <h4 class="text-uppercase mb-4">About Freelancer</h4>
          <p class="lead mb-0">Freelance is a free to use, MIT licensed Bootstrap theme created by
            <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
        </div>

      </div>
    </div>
  </footer>

  <!-- Copyright Section -->
  <section class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright &copy; Your Website 2019</small>
    </div>
  </section>

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Portfolio Modals -->

  <!-- Portfolio Modal 1 -->
  <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="fas fa-times"></i>
          </span>
        </button>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Log Cabin</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Image -->
                <img class="img-fluid rounded mb-5" src="img/portfolio/cabin.png" alt="">
                <!-- Portfolio Modal - Text -->
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                <button class="btn btn-primary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Close Window
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 2 -->
  <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="fas fa-times"></i>
          </span>
        </button>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tasty Cake</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Image -->
                <img class="img-fluid rounded mb-5" src="img/portfolio/cake.png" alt="">
                <!-- Portfolio Modal - Text -->
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                <button class="btn btn-primary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Close Window
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 3 -->
  <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="fas fa-times"></i>
          </span>
        </button>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Circus Tent</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Image -->
                <img class="img-fluid rounded mb-5" src="img/portfolio/circus.png" alt="">
                <!-- Portfolio Modal - Text -->
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                <button class="btn btn-primary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Close Window
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 4 -->
  <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-labelledby="portfolioModal4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="fas fa-times"></i>
          </span>
        </button>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Controller</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Image -->
                <img class="img-fluid rounded mb-5" src="img/portfolio/game.png" alt="">
                <!-- Portfolio Modal - Text -->
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                <button class="btn btn-primary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Close Window
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 5 -->
  <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-labelledby="portfolioModal5Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="fas fa-times"></i>
          </span>
        </button>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Locked Safe</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Image -->
                <img class="img-fluid rounded mb-5" src="img/portfolio/safe.png" alt="">
                <!-- Portfolio Modal - Text -->
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                <button class="btn btn-primary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Close Window
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 6 -->
  <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-labelledby="portfolioModal6Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            <i class="fas fa-times"></i>
          </span>
        </button>
        <div class="modal-body text-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <!-- Portfolio Modal - Title -->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Submarine</h2>
                <!-- Icon Divider -->
                <div class="divider-custom">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon">
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Image -->
                <img class="img-fluid rounded mb-5" src="img/portfolio/submarine.png" alt="">
                <!-- Portfolio Modal - Text -->
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                <button class="btn btn-primary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Close Window
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/password.js" ></script>
  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/freelancer.min.js"></script>
  <script type="text/javascript" >
  	  function checkForm(form){
    if(form.username.value == "") {
      alert("Error: Username cannot be blank!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    }
	 
    if(form.password.value != "" && form.password.value == form.password2.value) {
      if(form.password.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.password.focus();
        return false;
      }
      if(form.password.value == form.username.value) {
        alert("Error: Password must be different from Username!");
        form.password.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.password.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.password.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.password.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.password.focus();
      return false;
    }
    return true;
  }
  </script>
</body>

</html>
