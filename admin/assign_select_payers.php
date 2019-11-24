<?php
    require_once("../config/config.php");
    require_once("../global_functions.php");
    connect_to_db();

    // check if payer has been selected if not redirect to selectpayer
    security_check();
    if (!isset($_POST["submit"]) or $_POST["submit"] != "selected_reciever" or !isset($_POST["selected_reciever"])) {
        header("Location: $admin_url/assign_select_reciever.php");
    }
    require_once("admin_nav.php");
?>

<div id="page-wrapper">
    <div id="page-inner">
        <!-- PAGE TITLE -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line text-center">Select Payers</h1>
            </div>
        </div>
        <!-- /. ROW  -->


        <!-- get reciever details -->
        <?php
            if (isset($_POST["submit"]) and $_POST["submit"] == "selected_reciever" and isset($_POST["selected_reciever"])) {
                $selected_reciever_id = $_POST["selected_reciever"];
                // get reciever details
                $payer_query_reciever = "SELECT * FROM users WHERE id=\"$selected_reciever_id\" ";
                $payer_result_reciever = mysqli_query($db_connection,$payer_query_reciever);
                if (!$payer_result_reciever) {
                    log_alert(mysqli_error($db_connection));
                } else {
                    $payer_reciever_details = mysqli_fetch_assoc($payer_result_reciever);
                    // get main transction details
                    $payer_main_trans_query = "SELECT * FROM transactions WHERE recipient_id=\"$selected_reciever_id\" and status=\"pending\" " ;
                    $payer_result_main = mysqli_query($db_connection,$payer_main_trans_query);
                    if (!$payer_result_main) {
                        log_alert(mysqli_error($db_connection));
                    } else {
                        $main_trans_details = mysqli_fetch_assoc($payer_result_main);

                        echo "<!-- display info about the Receiver --> ";
                        echo "<section class=\"mt-5 text-center hide\">";
                        echo "<div class=\"alert alert-success\" role=\"alert\">";
                        echo "  <h4 class=\"alert-heading\">Reciever Details</h4>";
                        echo "  <div class=\"row\">";
                        echo "      <p class=\"col-2\">$payer_reciever_details[username]</p>";
                        echo "      <p class=\"col-2\">$main_trans_details[total_return_amount]</p>";
                        echo "      <p class=\"col-2\">$payer_reciever_details[bank_name]</p>";
                        echo "      <p class=\"col-2\">Time left</p>";
                        echo "      <p class=\"col-2\"><button class=\"btn btn-secondary btn-sm\">More</button></p>";
                        echo "  </div>";
                        echo " </div>";
                        echo "</section>";

                        // display info about the Receiver
                        ?>
                        <!-- /. ROW  -->
                        <div class="row ">                             
                                <div class="col-md-6">
                                    <div class="panel panel-default ">
                                        <div class="panel-heading bg-primary" align="center">
                                            <h3 style="margin-top:0px !important; margin-bottom:0px !important;"><b>Receiver Information</b></h3>
                                        </div>
                                        <div class="panel-body bg-success">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Username</th>
                                                            <th>Amount</th>
                                                            <th>Bank</th>
                                                            <th>Time Left</th>
                                                            <th>More</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo "$payer_reciever_details[username]"; ?></td>
                                                            <td><?php echo "$main_trans_details[total_return_amount]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[bank_name]"; ?></td>
                                                            <td><?php echo "Time left"; ?></td>
                                                            <td>
                                                                <?php echo "<button class=\"btn btn-primary btn-sm\" type=\"button\" data-toggle=\"collapse\" data-target=\"#more_info_rec\" aria-expanded=\"true\" aria-controls=\"more_info_rec\">More Details</button>" ; ?>
                                                            </td>
                                                        </tr>

                                                        <!-- <tr class="collapse  bg-danger border border-primary" id="more_info_rec" >";
                                                        
                                                        </tr> -->
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
                            <div class="row collapse  bg-danger border border-primary" id="more_info_rec">
                                
                                <div class="col-md-6">
                                    <div class="panel panel-default " style="background-color:inherit !important;">
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
                                                        <tr>
                                                            <td><?php echo "$payer_reciever_details[id]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[username]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[name]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[surname]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[email]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[bank_name]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[contact_cell]"; ?></td>
                                                            <td><?php echo "$payer_reciever_details[account_no]"; ?></td>
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
                            <?php

                    }
                    
                }
                
            }
            
        ?>

        <!-- payers -->
        <div class="row">
            <div class="col-md-6">
                <!--    Hover Rows  -->
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <h3><b>Payers</b></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="<?php echo $admin_url?>/transactions.php" method="post">
                                <input type="hidden" name="reciever_id" value="<?php echo $selected_reciever_id;?>">
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
                                            // get all users with status of 1
                                            $query_info_payers = "SELECT * FROM users WHERE status='1'";
                                            $result_info_payers = mysqli_query($db_connection,$query_info_payers);
                                            if (!$result_info_payers) {
                                                echo log_alert($db_connection,"error");
                                            } else {
                                                while ($info_payer_details = mysqli_fetch_assoc($result_info_payers)) {
                                                
                                                    // get payer package details
                                                    $query_info_payer_pckg = "SELECT * FROM packages WHERE id=\"$info_payer_details[selected_package]\" ";
                                                    $result_info_payer_pckg = mysqli_query($db_connection,$query_info_payer_pckg);
                                                    if (!$result_info_payer_pckg) {
                                                        echo log_alert($db_connection,"error");
                                                    } else {
                                                        $info_payer_pckg_details = mysqli_fetch_assoc($result_info_payer_pckg);
                                                        $time_left = calc_time_left($info_payer_details['reg_time'],12) / 3600;
                                                        $time_left = ceil($time_left);
                                                        echo "
                                                            <tr>
                                                                <!-- <th scope=\"row\">1</th> -->
                                                                <td>
                                                                    <input type=\"checkbox\" name=\"selected_payers[]\" value=\"$info_payer_details[id]\">
                                                                    <input type=\"hidden\" name=\"payer_amounts[]\" value=\"$info_payer_pckg_details[amount]\">
                                                                </td>
                                                                <td>$info_payer_details[username]</td>
                                                                <td>$info_payer_pckg_details[amount]</td>
                                                                <td>$info_payer_details[bank_name]</td>
                                                                <td>$time_left</td>
                                                                <td class=\"hide\">
                                                                    <button class=\"btn btn-success \">More</button>
                                                                </td>
                                                                <td>
                                                                    <button class=\"btn btn-primary btn-sm\" type=\"button\" data-toggle=\"collapse\" data-target=\"#more_info_$info_payer_details[id]\" aria-expanded=\"true\" aria-controls=\"more_info_$info_payer_details[id]\">More Details</button>
                                                                </td>
                                                            </tr>
                                                            ";

                                                            // more info row
                                                            echo "<tr class=\"collapse  bg-danger border border-primary\" id=\"more_info_$info_payer_details[id]\" >";
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
                                                                                                            <td><?php echo "$info_payer_details[id]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[username]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[name]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[surname]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[email]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[bank_name]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[contact_cell]"; ?></td>
                                                                                                            <td><?php echo "$info_payer_details[account_no]"; ?></td>
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
                                    <a href="<?php echo $admin_url; ?>/assign_select_reciever.php" class="btn btn-warning card-link">Back</a>
                                    <button type="submit" name="submit" value="finish_assign" class="btn btn-warning card-link">Finish</button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
             <!-- End  Hover Rows  -->
            </div>
        </div>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->

<?php
    require_once("admin_footer.php");
?>