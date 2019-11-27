<?php
//include auth.php file on all secure pages
require_once("../config/config.php");
require_once("../global_functions.php");
connect_to_db();
include("../login/auth.php");


?>
<html>
<head>

<!-- <!DOCTYPE html> -->


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  

  <title>Home Page</title>
 
  <!..........................................................................................................>
  <?php 
  

  $user_id = $_SESSION['user_id'];

  $sql_query = "SELECT * FROM users WHERE id='$user_id'";
    $user_result = mysqli_query($db_connection,$sql_query);
    if (!$user_result) {
      echo "<div class=\"alert alert-danger mt-5\" role=\"alert\">";
              echo mysqli_error($db_connection);
          echo "</div>";
    }else{
		$user_details = mysqli_fetch_assoc($user_result);
		$username = $user_details['username'];
		$_SESSION['form_data']['username'] = $user_details['username'];
		$_SESSION['form_data']['email'] = $user_details['email'];
		$_SESSION['form_data']['password'] = $user_details['password'];
		$_SESSION['form_data']['name'] = $user_details['name'];
		$_SESSION['form_data']['surname'] = $user_details['surname'];
		$_SESSION['form_data']['dob'] = $user_details['date_of_birth'];
		$_SESSION['form_data']['cellphone'] = $user_details['contact_cell'];
		$_SESSION['form_data']['cellphone2'] = $user_details['linked_cell'];
		$_SESSION['form_data']['account_no'] = $user_details['account_no'];
		$_SESSION['form_data']['bank_name'] = $user_details['bank_name'];
	
	
}

?>


<!..........................................................................................................>


  <!-- Custom fonts for this theme -->
  <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
  <link href="../assets/css/freelancer.css" rel="stylesheet">
  <!-- flip clock -->
  <link rel="stylesheet" href="../assets/css/flipclock.css">
  <!-- main style sheet -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<header class="masthead bg-primary text-white text-center">
<body>
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
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo $dashboard_url; ?>">Dashboard</a>
          </li>
		  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo $dashboard_url; ?>">Update Details</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
           <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger">user: <?php echo $_SESSION['username']; ?></a></li>
	  <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo "$base_url/login/logout.php";?>" >Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <!..........................................................................................................>



    <!..........................................................................................................>

  </nav>

    <div class="container d-flex align-items-center flex-column">
      <!-- Masthead Heading -->
     <!-- <h1 class="masthead-heading text-uppercase mb-0">Welcome <?php// echo $_SESSION['username']; ?>!</h1> -->

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
		  </div>
	  </div>
	  </div>
	  
	  <!-- Update information form-->
	  
	<div class="row">
        <div class="col-lg-8 mx-auto">
			<!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
			<h1>Personal Details Update</h1>
			<form name="sentMessage" onsubmit="return checkForm(this);" method="post" action="../api/update.php" id="contactForm">
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Username</label>
					<?php echo '<input class="form-control" id="name" name="username" type="text" value='.$_SESSION['form_data']['username'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['username'].'>'; ?>
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Email Address</label>
					<?php echo '<input class="form-control" id="email" name="email"type="email" value ='.$_SESSION['form_data']['email'].' required="required" data-validation-required-message="Please enter your email address." '.$_SESSION['form_data']['email'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Password</label>
					<?php echo '<input class="form-control" id="password" name= "password" type="password" placeholder= "Password" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['password'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Password</label>
					<?php echo '<input class="form-control" id="password2" name= "password2" type="password" placeholder= "COnfirm password" required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['password'].'>'; ?>					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Name</label>
					<?php echo '<input class="form-control" id="name" name ="name" type="text" value='.$_SESSION['form_data']['name'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['name'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Surname</label>
					<?php echo '<input class="form-control" id="name" name="surname" type="text" value='.$_SESSION['form_data']['surname'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['surname'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Date of Birth</label>
					<?php echo '<input class="form-control" id="name" name = "dob" type="text" value='.$_SESSION['form_data']['dob'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['dob'].'>'; ?>
					
					<p class="help-block text-danger"></p>
				</div>
				</div>
				<div class="control-group">
				<div class="form-group floating-label-form-group controls mb-0 pb-2">
					<label>Phone Number</label>
					<?php echo '<input class="form-control" id="name" name = "cellphone" type="text" value='.$_SESSION['form_data']['cellphone'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['cellphone'].'>'; ?>
					
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
						<?php echo '<input class="form-control" id="name" type="text" name="account_no" value='.$_SESSION['form_data']['account_no'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['account_no'].'>'; ?>
						
						<p class="help-block text-danger"></p>
					</div>
					</div>
					<div class="control-group">
					<div class="form-group floating-label-form-group controls mb-0 pb-2">
						<label>Linked Cellphone Number</label>
						<?php echo '<input class="form-control" id="name"  type="text" name="cellphone2" value='.$_SESSION['form_data']['cellphone2'].' required="required" data-validation-required-message="Please enter your name." '.$_SESSION['form_data']['cellphone2'].'>'; ?>
						
						<p class="help-block text-danger"></p>
					</div>
					</div>
					<br>
					<div id="success"></div>
					<div class="form-group">
					<button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Update</button>
          </div>
			</form>
			</div>
      </div>
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


