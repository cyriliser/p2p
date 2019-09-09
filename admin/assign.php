<?php
include('admin_nav.php');

?>
<title>Assign Users</title>
<body>
	<div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">ASSIGN USERS</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
				<div class="row">
                    <div class="col-md-12">
                        <h1 class="user-img-div inner-text" color = "#fff"><font color="white">PAYERS</font></h1>
                    </div>
                </div>
                <!-- /. ROW  -->
				
				<div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
							<?php
                        //GET LIST OF PAYERS 
                        $sql_query_payers = "SELECT * FROM users WHERE status='1' ";
                        $result_payers = mysqli_query($db_connection,$sql_query_payers);
                        if (!$result_payers) {
                            log_alert(mysqli_error($db_connection));
                        } else {
                            while ($payer_details = mysqli_fetch_assoc($result_payers)) {
                                // get payer package details
                                $sql_query_payer_package = "SELECT * FROM packages WHERE id=\"$payer_details[selected_package]\" ";
                                $result_payer_package = mysqli_query($db_connection,$sql_query_payer_package);
                                if (!$result_payer_package) {
                                    log_alert(mysqli_error($db_connection));
                                } else {
                                    $payer_package_details = mysqli_fetch_assoc($result_payer_package );
                                    include("components/payer_list.php");
                                }
                            }
                        }    
                    ?>
						</form>
                    </div>
                </div>
                <!-- /. ROW  -->
				
			</div>
	</div>
</body>