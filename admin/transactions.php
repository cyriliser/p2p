<?php
include('admin_nav.php');
require_once("../global_functions.php");
connect_to_db();


$user = "";
$trans = ""; 
$id_array= array();
$id_trans = array();
                          
if (!is_reloaded()) {
//process a transaction
security_check();
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
                    $time = time();
                    $trans_query_ins_sub = "INSERT INTO sub_transactions (main_transaction_id, payer_id, recipient_id, amount, marked_as_paid, marked_as_recieved, status, time_assigned) 
                                                                VALUES (\"$main_trans_details[id]\", \"$payer_id\", \"$main_trans_details[recipient_id]\", \"$payer_amounts[$index]\", '0', '0', 'pending', \"$time\") ";
                    $trans_result_ins_sub = mysqli_query($db_connection,$trans_query_ins_sub) ;
                    if (!$trans_result_ins_sub) {
                        log_alert(mysqli_error($db_connection));
                    } else {
                        // update payer status
                        $trans_query_up_payer = "UPDATE users SET status='2' WHERE id=\"$payer_id\" ";
                        $trans_result_up_payer = mysqli_query($db_connection,$trans_query_up_payer);
                        if (!$trans_result_up_payer) {
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
                    $time = time();
                    $trans_query_up_main = "UPDATE transactions SET total_sub_transactions=\"$num_selected_payers\", time_created=\"$time\" WHERE id=\"$main_trans_details[id]\" ";
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
        }
        }else{
            header("Location: $admin_url/assign_select_payers.php");
        }
                
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
                                            <!-- <th>Name</th> -->
											<!-- <th>Surname</th> -->
											<th>Subtrans</th>
											<th>Received R</th>
											<th>Total R</th>
                                            <th>Time Created</th>
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
											while ($pending_trans_details = mysqli_fetch_assoc($result_p_t)){
												
												// foreach($pending_trans_details as $col_name => $value) {
													// if($col_name == 'recipient_id'){
														$sql_query_reciever1 = "SELECT * FROM users WHERE id ='".$pending_trans_details['recipient_id']."' ";
														$result_reciever1 = mysqli_query($db_connection,$sql_query_reciever1);
														if (!$result_reciever1) {
															echo mysqli_error($db_connection);
														} else {
															$reciever_details1 = mysqli_fetch_assoc($result_reciever1);
															array_push($id_array,$reciever_details1['id']);
															array_push($id_trans, $pending_trans_details['id']);
															$user = $reciever_details1['id'];
                                                            $trans = $pending_trans_details['id'];

                                                            $time_left = calc_time_left($pending_trans_details['time_created'],12) / 3600;
                                                            $time_left = ceil($time_left);

															echo "<tr>
																<td>".$pending_trans_details['id']."</td>
																<td>".$reciever_details1['username']."</td>
																<td>".$pending_trans_details['completed_sub_transactions']."/".$pending_trans_details['total_sub_transactions']."</td>
																<td>".$pending_trans_details['recieved_amount']."</td>
																<td>".$pending_trans_details['total_return_amount']."</td>
																<td>$time_left Hrs</td>
																<td><a class=\"btn btn-primary btn-sm\" href=\"more_info.php?user=".$id_array[$count]."&trans=".$id_trans[$count]."\">More Details</a></td>
                                                                <td>
                                                                    <button class=\"btn btn-primary btn-sm\" type=\"button\" data-toggle=\"collapse\" data-target=\"#more_info_$id_trans[$count]\" aria-expanded=\"true\" aria-controls=\"more_info_$id_trans[$count]\">More Details</button>
                                                                </td>
                                                                </tr>";
                                                                
                                                            // more info row
                                                            $reciever_id = $id_array[$count];
                                                            $transaction_id = $id_trans[$count];
                                                            echo "  <tr class=\"collapse  bg-success\" id=\"more_info_$id_trans[$count]\" style=\"\">";
                                                            ?>
                                                                        <td colspan="8" class="card card-body  bg-secondary" >
                                                                            <!-- /. ROW  -->
                                                                            <div class="row">
                                                                                
                                                                                <div class="col-md-6">
                                                                                    <div class="panel panel-default">
                                                                                        <div class="panel-heading" align="center">
                                                                                            <h3 style="margin-top:0px !important; margin-bottom:0px !important;"><b>Receiver Information</b></h3>
                                                                                        </div>
                                                                                        <div class="panel-body">
                                                                                            <div class="table-responsive">
                                                                                                <table class="table table-hover">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>User ID</th>
                                                                                                            <th>Username</th>
                                                                                                            <th>Name</th>
                                                                                                            <th>Surname</th>
                                                                                                            <th>Email</th>
                                                                                                            <th>Bank</th>
                                                                                                            <th>Cellphone Number</th>
                                                                                                            <th>Account Number</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                    <?php
                                                                                                        $sql_query_reciever2 = "SELECT * FROM users WHERE id ='".$reciever_id."' ";
                                                                                                            $result_reciever2 = mysqli_query($db_connection,$sql_query_reciever2);
                                                                                                                if (!$result_reciever2) {
                                                                                                                    echo mysqli_error($db_connection);
                                                                                                                        } else {
                                                                                                                            $reciever2_details = mysqli_fetch_assoc($result_reciever2);
                                                                                                                            
                                                                                                                            
                                                                                                                            echo "<tr>
                                                                                                                                <td>".$reciever2_details['id']."</td>
                                                                                                                                <td>".$reciever2_details['username']."</td>
                                                                                                                                <td>".$reciever2_details['name']."</td>
                                                                                                                                <td>".$reciever2_details['surname']."</td>
                                                                                                                                <td>".$reciever2_details['email']."</td>
                                                                                                                                <td>".$reciever2_details['bank_name']."</td>
                                                                                                                                <td>".$reciever2_details['contact_cell']."</td>
                                                                                                                                <td>".$reciever2_details['account_no']."</td>
                                                                                                                                </tr>";
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
                                                                            <!--End of ROW -->
                                                                            
                                                                            <!-- /. ROW  -->
                                                                            <div class="row">
                                                                                
                                                                                <div class="col-md-6">
                                                                                    <div class="panel panel-info">
                                                                                        <div class="panel-heading bg-info" align="center">
                                                                                            <h3 style="margin-top:0px !important; margin-bottom:0px !important;"><b>Sub-Transaction Information</b></h3>
                                                                                        </div>
                                                                                        <div class="panel-body" style="padding-top:0px !important;">
                                                                                        <?php
                                                                                            // get all sub-transactions
                                                                                            $sql_query_subs = "SELECT * FROM sub_transactions WHERE main_transaction_id=\"$transaction_id\" AND status=\"pending\" ";
                                                                                            $result_subs = mysqli_query($db_connection,$sql_query_subs);
                                                                                            if (!$result_subs) {
                                                                                                log_alert(mysqli_error($db_connection));
                                                                                            } else {
                                                                                                // loop throught all of the sub-transactions
                                                                                                while ($sub_trans_details =mysqli_fetch_assoc($result_subs)) {
                                                                                                    ?>
                                                                                                        <!-- sub-transaction details -->
                                                                                                        <h4 class="text-center border">Sub-Transaction Info</h4>
                                                                                                        <div class="table-responsive">
                                                                                                            <table class="table table-hover">
                                                                                                                <thead>
                                                                                                                    <tr>
                                                                                                                        <th>Sub-Trans ID</th>
                                                                                                                        <th>Amount</th>
                                                                                                                        <th>marked as paid</th>
                                                                                                                        <th>marked as received</th>
                                                                                                                        <th>status</th>
                                                                                                                        <th>Time left</th>
                                                                                                                    </tr>
                                                                                                                </thead>
                                                                                                                <tbody>
                                                                                                                <?php
                                                                                                                    // $sql_query_reciever2 = "SELECT * FROM users WHERE id ='".$reciever_id."' ";
                                                                                                                    //     $result_reciever2 = mysqli_query($db_connection,$sql_query_reciever2);
                                                                                                                    //         if (!$result_reciever2) {
                                                                                                                    //             echo mysqli_error($db_connection);
                                                                                                                    //                 } else {
                                                                                                                    //                     $reciever2_details = mysqli_fetch_assoc($result_reciever2);
                                                                                                                                        
                                                                                                                                        
                                                                                                                    echo "<tr>
                                                                                                                        <td>".$sub_trans_details['id']."</td>
                                                                                                                        <td>".$sub_trans_details['amount']."</td>
                                                                                                                        <td>".$sub_trans_details['marked_as_paid']."</td>
                                                                                                                        <td>".$sub_trans_details['marked_as_recieved']."</td>
                                                                                                                        <td>".$sub_trans_details['status']."</td>
                                                                                                                        <td>".$sub_trans_details['time_assigned']."</td>

                                                                                                                        </tr>";
                                                                                                                                    // }
                                                                                                                ?>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>

                                                                                                        <!-- payer information -->
                                                                                                        <h4 class="text-center border">Payer Info</h4>
                                                                                                        <div class="table-responsive">
                                                                                                            <table class="table table-hover">
                                                                                                                <thead>
                                                                                                                    <tr>
                                                                                                                        <th>User ID</th>
                                                                                                                        <th>Username</th>
                                                                                                                        <th>Name</th>
                                                                                                                        <th>Surname</th>
                                                                                                                        <th>Email</th>
                                                                                                                        <th>Bank</th>
                                                                                                                        <th>Cellphone Number</th>
                                                                                                                        <th>Account Number</th>
                                                                                                                    </tr>
                                                                                                                </thead>
                                                                                                                <tbody>
                                                                                                                <?php
                                                                                                                    $sql_query_reciever2 = "SELECT * FROM users WHERE id ='".$reciever_id."' ";
                                                                                                                        $result_reciever2 = mysqli_query($db_connection,$sql_query_reciever2);
                                                                                                                            if (!$result_reciever2) {
                                                                                                                                echo mysqli_error($db_connection);
                                                                                                                                    } else {
                                                                                                                                        $reciever2_details = mysqli_fetch_assoc($result_reciever2);
                                                                                                                                        
                                                                                                                                        
                                                                                                                                        echo "<tr>
                                                                                                                                            <td>".$reciever2_details['id']."</td>
                                                                                                                                            <td>".$reciever2_details['username']."</td>
                                                                                                                                            <td>".$reciever2_details['name']."</td>
                                                                                                                                            <td>".$reciever2_details['surname']."</td>
                                                                                                                                            <td>".$reciever2_details['email']."</td>
                                                                                                                                            <td>".$reciever2_details['bank_name']."</td>
                                                                                                                                            <td>".$reciever2_details['contact_cell']."</td>
                                                                                                                                            <td>".$reciever2_details['account_no']."</td>
                                                                                                                                            </tr>";
                                                                                                                                    }
                                                                                                                ?>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    <?php
                                                                                                }
                                                                                                 
                                                                                            }
                                                                                            
                                                                                        ?>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- End  Hover Rows  -->
                                                                                </div>
                                                                            </div>
                                                                            <!--End of ROW -->
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                            $count++;
														}
													// }
												// }
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
											<th>Time Created</th>
											<th>More details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$sql_query_pending_trans1 = "SELECT * FROM transactions WHERE status='pending' AND total_sub_transactions='0' ORDER BY id ASC";
                                        $result_p_t1 = mysqli_query($db_connection,$sql_query_pending_trans1);
										if (!$result_p_t1) {
										echo mysqli_error($db_connection);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t1)){
												
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

                                                            $time_left = calc_time_left($row['time_created'],12) / 3600;
                                                            $time_left = ceil($time_left);

															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$row['completed_sub_transactions']."/".$row['total_sub_transactions']."</td>
																<td>".$row['total_return_amount']."</td>
																<td>$time_left</td>
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
