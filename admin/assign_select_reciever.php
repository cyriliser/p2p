<?php
    require_once("../config/config.php");
    require_once("../global_functions.php");
    connect_to_db();
    // require_once("admin_header.php"); 
    require_once("admin_nav.php");
?>


<div id="page-wrapper">
    <div id="page-inner">
        <!-- PAGE TITLE -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line text-center">Select Reciever</h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <!-- recievers -->
        <div class="row">
            <div class="col-md-6">
                    <!--    Hover Rows  -->
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <h3><b>Recievers</b></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="<?php echo $admin_url?>/assign_select_payers.php" method="post">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th>Select</th>
                                        <th>UserName</th>
                                        <th>Amount</th>
                                        <th>Bank</th>
                                        <th>Time Left</th>
                                        <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php 
                                                // get all pending main transactions
                                                $query_info_main = "SELECT * FROM transactions WHERE status='pending' and total_sub_transactions='0' ";
                                                $result_info_main = mysqli_query($db_connection,$query_info_main);
                                                if (!$result_info_main) {
                                                    echo log_alert($db_connection,"error");
                                                } else {
                                                    while ($info_main_trans_details = mysqli_fetch_assoc($result_info_main)) {
                                                        // get reciever details
                                                        $query_info_user_rec = "SELECT * FROM users WHERE id=\"$info_main_trans_details[recipient_id]\" ";
                                                        $result_info_user_rec = mysqli_query($db_connection,$query_info_user_rec);
                                                        if (!$result_info_user_rec) {
                                                            echo log_alert($db_connection,"error");
                                                        } else {
                                                            $info_rec_user_details = mysqli_fetch_assoc($result_info_user_rec);
                                                            $time_left = calc_time_left($info_main_trans_details['time_created'],120) / 86400 ;
                                                            $time_left = ceil($time_left);
                                                            echo "
                                                                <tr>
                                                                    <!-- <th scope=\"row\">1</th> -->
                                                                    <td>
                                                                        <input type=\"radio\" name=\"selected_reciever\" value=\"$info_rec_user_details[id]\">
                                                                    </td>
                                                                    <td>$info_rec_user_details[username]</td>
                                                                    <td>$info_main_trans_details[total_return_amount]</td>
                                                                    <td>$info_rec_user_details[bank_name]</td>
                                                                    <td>$time_left</td>
                                                                    <td class=\"hide\">
                                                                        <button class=\"btn btn-success \">More</button>
                                                                    </td>
                                                                    <td>
                                                                        <button class=\"btn btn-primary btn-sm\" type=\"button\" data-toggle=\"collapse\" data-target=\"#more_info_$info_rec_user_details[id]\" aria-expanded=\"true\" aria-controls=\"more_info_$info_rec_user_details[id]\">More Details</button>
                                                                    </td>
                                                                </tr>
                                                                ";

                                                                // more info row
                                                                echo "<tr class=\"collapse  bg-danger border border-primary\" id=\"more_info_$info_rec_user_details[id]\" >";
                                                                ?>
                                                                <td colspan="8" class="card card-body " style="border:solid grey 1px;">
                                                                    <!-- /. ROW  -->
                                                                    <div class="row">
                                                                        
                                                                        <div class="col-md-6">
                                                                            <div class="panel panel-default " style="background-color:inherit !important;">
                                                                                <div class="panel-heading" align="center">
                                                                                    <h3 style="margin-top:0px !important; margin-bottom:0px !important;"><b>Payer Information</b></h3>
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
                                                                                                <tr>
                                                                                                    <td><?php echo "$info_rec_user_details[id]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[username]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[name]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[surname]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[email]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[bank_name]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[contact_cell]"; ?></td>
                                                                                                    <td><?php echo "$info_rec_user_details[account_no]"; ?></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- End  Hover Rows  -->
                                                                        </div>
                                                                    </div>
                                                                    <!--End of ROW -->
                                                                                

                                                                </tr>
                                                                <?php
                                                        }   
                                                    }
                                                }

                                            ?>
                                    </tbody>
                                </table>
                                <div class="buttons assign-info-btns" >
                                    <a href="<?php echo $admin_url; ?>/assign_info.php" class="btn btn-warning card-link">Back</a>
                                    <button type="submit" name="submit" value="selected_reciever" class="btn btn-warning card-link">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End  Hover Rows  -->
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php
    require_once("admin_footer.php");
?>