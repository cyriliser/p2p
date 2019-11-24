<?php
require_once("login/auth.php");
require_once("../global_functions.php");
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cash Bankers</title>

    <!-- fontawsome  -->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- custome css -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div id="wrapper">
        <!-- top navbar -->
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <!-- top navbar -->
            <div class="navbar-header">
                <!-- button for toggling navvigation -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- navbar brand / site name / links to homepage  -->
                <a class="navbar-brand" href="<?php echo $admin_url; ?>">Cash Bankers</a>
            </div>

            <!-- top navbar middle -->

            
            
            <!-- top right navbar -->
            <div class="header-right">
                
                <button id="refresh" class="btn btn-primary refresh-btn">Refresh</button>
    
                <a href="admin_login.php" class="btn btn-danger" href="<?php echo $admin_url; ?>/login/logout.php" title="Logout">LogOut</a>

            </div>
        </nav>
        <!-- /. NAV TOP END  -->

        <!-- SIDE NAVBAR -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <!-- SIDE NAVBAR ITEMS  -->
                <ul class="nav" id="main-menu">
                    <!-- LOGGED IN ADMIN NAME -->
					<li>
                        <div class="user-img-div">
                            <div class="user-img-div inner-text" style="display:flex !important;">
                                <h4><i class="fa fa-sign-in "></i>   Administrator: <?php echo $_SESSION['username']; ?></h4>
                                
                            </div>
                        </div>
                    </li>
                    <!--DASHBOARD LINK  -->
                    <li>
                        <a class="active-menu" href="<?php echo $admin_url; ?>"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                    <!--ASSIGN INFO USERS LINK  -->
                    <li>
                        <a class="" href="<?php echo $admin_url; ?>/assign_info.php"><i class="fa fa-dashboard "></i>Assign Info</a>
                    </li>
                    <!--ASSIGN  USERS LINK  -->
                    <li>
                        <a class="" href="<?php echo $admin_url; ?>/assign_select_reciever.php"><i class="fa fa-dashboard "></i>Assign Users</a>
                    </li>
                    <!--USERS LINK  -->
                    <li>
                        <a class="" href="<?php echo $admin_url; ?>/users.php"><i class="fa fa-dashboard "></i>Users</a>
                    </li>
                    <!--Transactions LINK  -->
                    <li>
                        <a class="" href="<?php echo $admin_url; ?>/transactions.php"><i class="fa fa-dashboard "></i>Transactions</a>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->