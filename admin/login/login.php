<?php
//session_start();
require_once("../../config/config.php");
//require_once("../../global_functions.php");

?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="../assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
	<body>
		 <div id="wrapper">
			  <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
				  <div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						  <span class="sr-only">Toggle navigation</span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
					  </button>
				  <a class="navbar-brand" href="<?php echo $base_url; ?>">Cash Bankers</a>
				  </div>
			  </nav>
		</div>
		
		<div class="row ">
			<div class="row">
				<div class="col-md-12" align="center">
					<h1 class="page-head-line">ADMIN LOGIN</h1>
				</div>
			</div>
			 <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
				 <div class="panel-body">
					<form role="form" action="process_login.php" method="post" name="login">
						<div class="row">
							<div class="col-md-12" align="center">
								<h2>Enter Details to login</h2>		
							</div>
						</div>
						<br>
						<?php if(isset($_GET['loginError'])) { ?>
						<div class="form-group form">
							<p class="btn-danger text-center"> Incorrect username/password please try</p>
						</div>

						<?php }
							if(isset($_GET['securityError'])) { ?>
							<div class="form-group form">
								<p class="btn-danger text-center"> Error processing your log in details, please check your input and try again </p>
							</div>
						<?php } ?>
						
						<div class="row">
							<div class="form-group input-group">
							  <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
							  <input type="text" class="form-control" required="required" name = "username" placeholder="Your Username " />
							 </div>
							 <div class="form-group input-group">
							  <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
							  <input type="password" name = "password" required="required" class="form-control"  placeholder="Your Password" />
							 </div>
							<div class="form-group">
								  <label class="checkbox-inline">
								  		<input type="checkbox" /> Remember me
								  </label>
								  <span class="pull-right">
								  	<a href="index.php" >Forgot password ? </a> 
								  </span>
							 </div>
							<input name="submit" type="submit" class="btn btn-primary" value="Login" />
						</div>
					  </form>
				 </div>
			  </div>
		 </div>
	 </body>
 </html>