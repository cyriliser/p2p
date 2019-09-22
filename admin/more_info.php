<?php
include('admin_nav.php');
require_once("../global_functions.php");
connect_to_db();
$person_id = $_GET['user'];
$transaction_id = $_GET['trans'];

?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">More Information</h1>
            </div>
		</div>
        <!-- /. ROW  -->
			<div class="row">
				
                <div class="col-md-6">
                     <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>Receiver Information</b></h3>
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
										$sql_query_person = "SELECT * FROM users WHERE id ='".$person_id."' ";
											$result_person = mysqli_query($db_connection,$sql_query_person);
												if (!$result_person) {
													echo mysqli_error($db_connection);
														} else {
															$person = mysqli_fetch_assoc($result_person);
															
															
															echo "<tr>
																<td>".$person['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$person['email']."</td>
																<td>".$person['bank_name']."</td>
																<td>".$person['contact_cell']."</td>
																<td>".$person['account_no']."</td>
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
			
			
			<div class="row">
				
                <div class="col-md-6">
                     <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>Sub Transactions</b></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sub Transaction ID</th>
                                            <th>Payer Name</th>
                                            <th>Amount</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$sql_query_pending_trans = "SELECT * FROM sub_transactions WHERE recipient_id='".$person_id."' AND main_transaction_id='".$transaction_id."'ORDER BY id desc";
										$result_p_t = mysqli_query($db_connection,$sql_query_pending_trans);
										if (!$result_p_t) {
											echo mysqli_error($db_connection);
										}else{
											
											$result_arr = mysqli_fetch_assoc($result_p_t);
											$sql_query_person = "SELECT * FROM users WHERE id ='".$result_arr['payer_id']."' ";
											$result_person = mysqli_query($db_connection,$sql_query_person);
												if (!$result_person) {
													echo mysqli_error($db_connection);
													} else {
														$payer = mysqli_fetch_assoc($result_person);
														echo "<tr>
														<td>".$result_arr['id']."</td>
														<td>".$payer['name']."</td>
														<td>".$result_arr['amount']."</td>
														<td>".$result_arr['status']."</td>
														</tr>";
														
										
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
			<div class="row">
				
                <div class="col-md-6">
                     <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>Payers Information</b></h3>
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
															
															echo "<tr>
																<td>".$payer['id']."</td>
																<td>".$payer['username']."</td>
																<td>".$payer['name']."</td>
																<td>".$payer['surname']."</td>
																<td>".$payer['email']."</td>
																<td>".$payer['bank_name']."</td>
																<td>".$payer['contact_cell']."</td>
																<td>".$payer['account_no']."</td>
																</tr>";
														}
										}
										mysqli_close($db_connection);
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
	</div>
</div>