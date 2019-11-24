<?php include('reset_logic.php'); ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset</title>

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
                        <h1 class="page-head-line">Awaiting Email validation</h1>
					</div>
                </div>
				<div class="row">
				<form class="login-form" action="admin_login.php" method="post" style="text-align: center;">
				<p>
					We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account. 
				</p>
				<p>Please login into your email account and click on the link we sent to reset your password</p>
				</div>
	</form>
		
</body>
</html>