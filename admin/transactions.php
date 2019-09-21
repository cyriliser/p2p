<?php
include('admin_nav.php');
require_once("../global_functions.php");
connect_to_db();
$user = "";
$trans = ""; 
$id_array= array();
$id_trans = array();
//process a transaction
if (isset($_POST["submit"])) {
    if ($_POST["submit"]="finish_assign" and isset($_POST["selected_payers"])) {
        $reciever_id = $_POST['reciever_id'] ;
        $selected_payers = $_POST['selected_payers'];
        $payer_amounts = $_POST['payer_amounts'];

        //get main transaction details
        $trans_query_main = "SELECT * FROM transactions WHERE recipient_id=\"$reciever_id\" and status='pending' ";
        $trans_result_main = mysqli_query($db_connection,$trans_query_main);
        if (!$trans_result_main) {
            log_alert(mysqli_error($db_connection));
        } else {
            $main_trans_details = mysqli_fetch_assoc($trans_result_main);

            //get reciever details
            $trans_query_reciever = "SELECT * FROM users WHERE id=\"$main_trans_details[recipient_id]\" ";
            $trans_result_reciever = mysqli_query($db_connection,$trans_query_reciever);
            if (!$trans_result_reciever) {
                log_alert(mysqli_error($db_connection));
            } else {
                $reciever_details = mysqli_fetch_assoc($trans_result_reciever);

                // TODO
                // check if sum of payer amounts equals total return amount
                // mysqli_fetch_all($result,MYSQLI_ASSOC);

                $payer_total_amount = array_sum($payer_amounts);
                $num_selected_payers = sizeof($payer_amounts);

                // loop through the payers
                $index = 0;
				
                foreach ($selected_payers as  $payer_id ) {
                    // create subtransactions
                    $trans_query_ins_sub = "INSERT INTO sub_transactions (main_transaction_id, payer_id, recipient_id, amount, marked_as_paid, marked_as_recieved, status) 
                                                                VALUES (\"$main_trans_details[id]\", \"$payer_id\", \"$main_trans_details[recipient_id]\", \"$payer_amounts[$index]\", '0', '0', 'pending') ";
                    $trans_result_ins_sub = mysqli_query($db_connection,$trans_query_ins_sub) ;
                    if (!$trans_result_ins_sub) {
                        log_alert(mysqli_error($db_connection));
                    } else {
                        // update payer status
                        $trans_query_up_payer = "UPDATE users SET status='2' WHERE id=\"$payer_id\" ";
                        $trans_result_up_payer = mysqli_query($db_connection,$trans_query_up_payer);
                        if (!$trans_result_up_payer) {
                            log_alert(mysqli_error($db_connection));
                        }
                    }

                    $index++;
                }

                // update main transaction
                $trans_query_up_main = "UPDATE transactions SET total_sub_transactions=\"$num_selected_payers\" WHERE id=\"$main_trans_details[id]\" ";
                $trans_result_up_main = mysqli_query($db_connection,$trans_query_up_main);
                if (!$trans_result_up_main) {
                    log_alert(mysqli_error($db_connection));
                } else {
                    // update recipient status
                    $trans_query_up_rec = "UPDATE users SET status=\"4\" WHERE id=\"$reciever_details[id]\" ";
                    $trans_result_up_rec  = mysqli_query($db_connection,$trans_query_up_rec);
                    if (!$trans_result_up_rec) {
                        log_alert(mysqli_error($db_connection));
                    }
                }
            }
        }
    }else{
        header("Location: $admin_url/assign_select_payers.php");
    }
            
}

?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Transactions</h1>

                    </div>
                </div>
                <!-- /. ROW  -->
            
            <!-- assigned transactions -->
            <div class="row">
                <div class="col-md-6">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>PENDING TRANSACTIONS | ASSIGNED</b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Trans ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
											<th>Surname</th>
											<th>Subtrans</th>
											<th>Total R</th>
											<th>More details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$count = 0;
										$sql_query_pending_trans = "SELECT * FROM transactions WHERE status='pending' AND total_sub_transactions>='1' ORDER BY id desc";
										$result_p_t = mysqli_query($db_connection,$sql_query_pending_trans);
										if (!$result_p_t) {
										echo mysqli_error($db_connection);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t)){
												
												foreach($row as $x => $x_value) {
													if($x == 'recipient_id'){
														$sql_query_person = "SELECT * FROM users WHERE id ='".$x_value."' ";
														$result_person = mysqli_query($db_connection,$sql_query_person);
														if (!$result_person) {
															echo mysqli_error($db_connection);
														} else {
															$person = mysqli_fetch_assoc($result_person);
															array_push($id_array,$person['id']);
															array_push($id_trans, $row['id']);
															$user = $person['id'];
															$trans = $row['id'];
															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$row['completed_sub_transactions']."/".$row['total_sub_transactions']."</td>
																<td>".$row['total_return_amount']."</td>
																<td><a class=\"btn btn-primary btn-sm\" href=\"more_info.php?user=".$id_array[$count]."&trans=".$id_trans[$count]."\">More Details</a></td>
																
																</tr>";
																$count++;
														}
													}
												}
											}
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
				
			</div>

            <!-- Unassigned transactions -->
            <div class="row">
                <div class="col-md-6">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>PENDING TRANSACTIONS | NOT ASSIGNED</b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Trans ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
											<th>Surname</th>
											<th>Subtrans</th>
											<th>Total R</th>
											<th>More details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$sql_query_pending_trans = "SELECT * FROM transactions WHERE status='pending' AND total_sub_transactions='0' ORDER BY id ASC";
										$result_p_t = mysqli_query($db_connection,$sql_query_pending_trans);
										if (!$result_p_t) {
										echo mysqli_error($db_connection);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t)){
												
												foreach($row as $x => $x_value) {
													if($x == 'recipient_id'){
														$sql_query_person = "SELECT * FROM users WHERE id ='".$x_value."' ";
														$result_person = mysqli_query($db_connection,$sql_query_person);
														if (!$result_person) {
															echo mysqli_error($db_connection);
														} else {
															$person = mysqli_fetch_assoc($result_person);
															array_push($id_array,$person['id']);
															array_push($id_trans, $row['id']);
												
															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$row['completed_sub_transactions']."/".$row['total_sub_transactions']."</td>
																<td>".$row['total_return_amount']."</td>
																<td><a class=\"btn btn-primary btn-sm\" href=\"more_info.php?user=".$id_array[$count]."&trans=".$id_trans[$count]."\">More Details</a></td>
																</tr>";
																
														array_pop($id_array);
														}
													}
												}
											}
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
				
			</div>
			
			<div class="row">
				
                <div class="col-md-6">
                     <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>COMPLETED TRANSACTIONS</b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Trans ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
											<th>Surname</th>
											<th>Subtrans</th>
											<th>Total R</th>
											<th>More details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                        <?php
										$sql_query_pending_trans = "SELECT * FROM transactions WHERE status='completed' ";
										$result_p_t = mysqli_query($db_connection,$sql_query_pending_trans);
										if (!$result_p_t) {
										echo mysqli_error($db_connection);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t)){
												
												foreach($row as $x => $x_value) {
													if($x == 'recipient_id'){
														$sql_query_person = "SELECT * FROM users WHERE id ='".$x_value."' ";
														$result_person = mysqli_query($db_connection,$sql_query_person);
														if (!$result_person) {
															echo mysqli_error($db_connection);
														} else {
															$person = mysqli_fetch_assoc($result_person);
															array_push($id_array,$person['id']);
															array_push($id_trans, $row['id']);

															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$row['completed_sub_transactions']."/".$row['total_sub_transactions']."</td>
																<td>".$row['total_return_amount']."</td>
																<td><a class=\"btn btn-primary btn-sm\" href=\"more_info.php?user=".$id_array[$count]."&trans=".$id_trans[$count]."\">More Details</a></td>
																</tr>";
																
															array_pop($id_array);
														}
													}
												}
											}
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
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
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
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
