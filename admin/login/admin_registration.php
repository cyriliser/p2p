<?php
require_once("auth.php");
if(!$_SESSION["username"] == "master"){
?><head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Registration</title>

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
                <a class="navbar-brand" href="index.php">Cash Bankers</a>
            </div>
        </nav>
	</div>
         <div class="row ">
               <div class="row">
                    <div class="col-md-12" align="center">
                        <h1 class="page-head-line">REGISTRATION</h1>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="process_registration.php" method="post">
                                    <div class="row">
                                    
               	 <?php if(isset($_GET['securityError'])) {?>
               	 	<div class="form-group form">
               	 		<p class="text-center btn-danger">Error processing request, please check your data and try again</p>
               	 </div>
               	 <?php }?>
										<div class="col-md-12" align="center">
											<h2>Enter Details</h2>

										</div>
									</div>
									<br>
									<div class="row">
										 <div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                   <input type="text" class="form-control" name = "username" placeholder="Your Username " />
                               </div>
                                <div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                   <input type="password" name = "password" class="form-control"  placeholder="Your Password" />
                               </div>
							
                               <div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                   <input type="email" name = "email" class="form-control"  placeholder="Your Email" />
                               </div>
										 <div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                   <input type="text" class="form-control" name = "name" placeholder="Your Name " />
                               </div>
										 <div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                   <input type="text" class="form-control" name = "surname" placeholder="Your Surname " />
                               </div>
										<div class="form-group input-group">
                                   <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                   <input type="text" name = "cellno" class="form-control"  placeholder="Your  Cellphone Number" />
                               </div>
										<input type="submit" class="btn btn-primary" name="submit" value="Register" />
										<hr />
                                    Already registered ? <a href="admin_login.php" >click here to login </a>
                                     </div>
                                     
                                    </form>
							</div>
                </div>
			</div>
	</body>
</html>
<?php
}
else {?>
<div class="row">
    <div class="col-md-12">
        <h3 class="page-head-line">OOOps! You do not have access to this site</h3>
    </div>
</div>

<?php
}
?>