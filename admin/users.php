<?php
include('admin_nav.php');
require_once("../global_functions.php");
connect_to_db();
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Users</h1>

                    </div>
                </div>
                <!-- /. ROW  -->
				<div class="row">
				
                <div class="col-md-6">
                     <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <h3><b>USERS LIST</b></h3>
							<div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Filter by <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Verified</a></li>
                                            <li><a href="#">Assigned</a></li>
                                            <li><a href="#">Awating assignment</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>

                        </div>
                        <div class="panel-body">
						<div class = "scrollmenu">
                            <div class="table-responsive">
                                <table class="table table-hover">
								
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
											<th>Surname</th>
											<th>Bank</th>
											<th>Cellphone Number</th>
											<th>Email Account</th>
											<th>Account Number</th>
											
											
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                        <?php
										$sql_query_pending_trans = "SELECT * FROM users";
										$result_p_t = mysqli_query($db_connection,$sql_query_pending_trans);
										if (!$result_p_t) {
										echo mysqli_error($db_connection);
										} else {
											while ($row = mysqli_fetch_assoc($result_p_t)){
															echo "<tr>
																<td>".$row['id']."</td>
																<td>".$row['username']."</td>
																<td>".$row['name']."</td>
																<td>".$row['surname']."</td>
																<td>".$row['bank_name']."</td>
																<td>".$row['contact_cell']."</td>
																<td>".$row['email']."</td>
																<td>".$row['account_no']."</td>
																</tr>";
														}
													}
									?>
                                    </tbody>
                                </table>
								</div>
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
