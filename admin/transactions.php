<?php
include('admin_nav.php');
include('db.php');
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Transactions</h1>

                    </div>
                </div>
                <!-- /. ROW  -->
              
            <div class="row">
                <div class="col-md-6">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>PENDING TRANSACTIONS</b></h3>
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
										$sql_query_pending_trans = "SELECT * FROM transactions WHERE status='pending' ";
										$result_p_t = mysqli_query($con,$sql_query_pending_trans);
										if (!$result_p_t) {
										echo mysqli_error($con);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t)){
												
												foreach($row as $x => $x_value) {
													if($x == 'recipient_id'){
														$sql_query_person = "SELECT * FROM users WHERE id ='".$x_value."' ";
														$result_person = mysqli_query($con,$sql_query_person);
														if (!$result_person) {
															echo mysqli_error($con);
														} else {
															$person = mysqli_fetch_assoc($result_person);
															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$row['completed_sub_transactions']."/".$row['total_sub_transactions']."</td>
																<td>".$row['total_return_amount']."</td>
																<td>more info</td>
																</tr>";
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
										$result_p_t = mysqli_query($con,$sql_query_pending_trans);
										if (!$result_p_t) {
										echo mysqli_error($con);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t)){
												
												foreach($row as $x => $x_value) {
													if($x == 'recipient_id'){
														$sql_query_person = "SELECT * FROM users WHERE id ='".$x_value."' ";
														$result_person = mysqli_query($con,$sql_query_person);
														if (!$result_person) {
															echo mysqli_error($con);
														} else {
															$person = mysqli_fetch_assoc($result_person);
															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$person['username']."</td>
																<td>".$person['name']."</td>
																<td>".$person['surname']."</td>
																<td>".$row['completed_sub_transactions']."/".$row['total_sub_transactions']."</td>
																<td>".$row['total_return_amount']."</td>
																<td>more info</td>
																</tr>";
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
