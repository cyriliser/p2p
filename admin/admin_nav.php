<?php
require_once("login/auth.php");
require_once("../global_functions.php");
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cash Bankers</title>

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
    <link rel="stylesheet" href="assets/css/style.css">
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

            <!-- top right navbar -->
            <div class="header-right">

                <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
                <a href="admin_login.php" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>

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
                                <a href="<?php echo $admin_url; ?>/login/logout.php" class="btn btn-primary btn-sm " style="margin-bottom:30px !important; margin-top:15px !important;" >LogOut</a>
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
                    <!-- SETTINGS ITEMS OPENS UP INTO MORE ITEMS -->
                    <li>
                        <a href="#"><i class="fa fa-desktop "></i>Settings <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="panel-tabs.html"><i class="fa fa-toggle-on"></i>Tabs & Panels</a>
                            </li>
                            <li>
                                <a href="notification.html"><i class="fa fa-bell "></i>Notifications</a>
                            </li>
                             <li>
                                <a href="progress.html"><i class="fa fa-circle-o "></i>Progressbars</a>
                            </li>
                             <li>
                                <a href="buttons.html"><i class="fa fa-code "></i>Buttons</a>
                            </li>
                             <li>
                                <a href="icons.html"><i class="fa fa-bug "></i>Icons</a>
                            </li>
                             <li>
                                <a href="wizard.html"><i class="fa fa-bug "></i>Wizard</a>
                            </li>
                             <li>
                                <a href="typography.html"><i class="fa fa-edit "></i>Typography</a>
                            </li>
                             <li>
                                <a href="grid.html"><i class="fa fa-eyedropper "></i>Grid</a>
                            </li>    
                        </ul>
                    </li>
                    <!-- MANAGE USERS -->
                    <li>
                        <a href="#"><i class="fa fa-yelp "></i>Manage Users <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="transactions.php"><i class="fa fa-coffee"></i>Transactions</a>
                            </li>
                            <li>
                                <a href="pricing.html"><i class="fa fa-flash "></i>Profits</a>
                            </li>
                             <li>
                                <a href="users.php"><i class="fa fa-key "></i>Users</a>
                            </li>
                            
                             <li>
                                <a href="assign.php"><i class="fa fa-recycle "></i>Assign Users</a>
                            </li>
                            
                           
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->