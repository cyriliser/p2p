<?php
require_once('master_nav.php');
if($_SESSION["username"] == "master"){
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <!-- page Title -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">DASHBOARD</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <!-- TRANSACTIONS -->
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a style="width:100% !important; height:100% !important;" href="<?php echo $admin_url; ?>/transactions.php">
                                <i style="width:100% !important; height:100% !important;" class="fa fa-bolt fa-5x"></i>
                                <h5 style="width:100% !important; height:100% !important;" >Transactions</h5>
                            </a>
                        </div>
                    </div>
                    <!-- ASSIGN INFO -->
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="<?php echo $admin_url; ?>/assign_info.php">
                                <i style="width:100% !important; height:100% !important;" class="fa fa-plug fa-5x"></i>
                                <h5 style="width:100% !important; height:100% !important;">Assign Info </h5>
                            </a>
                        </div>
                    </div>
                    <!-- USERS -->
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="<?php echo $admin_url; ?>/users.php">
                                <i style="width:100% !important; height:100% !important;" class="fa fa-key fa-5x"></i>
                                <h5 style="width:100% !important; height:100% !important;" >Users</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        <!-- &copy; 2019 CashBankers | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a> -->
        &copy; 2019 CashBankers | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
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