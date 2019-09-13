<?php
    require_once("../config/config.php");
    require_once("../global_functions.php");
    connect_to_db();
    // require_once("admin_header.php"); 
    require_once("admin_nav.php");
?>

<!-- responses -->
<?php
    if(isset($_POST["submit"])){
        switch ($_POST["submit"]) {
            case 'payers_to_recievers':
                # code...
                break;
            case 'payers_to_others':
                # code...
                break;

            case 'recievers_to_payers':
                # code...
                break;
            case 'recievers_to_others':
                # code...
                break;
            
            case 'others_to_payers':
                # code...
                break;
            case 'others_to_recievers':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }

?>

<div id="page-wrapper">
    <div id="page-inner">
        <!-- PAGE TITLE -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line text-center">Assign Info</h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <!-- page html -->
        <!-- nav -->
        <!-- <section id="assign_nav fixed-top">
            <ul class="nav nav-pills nav-justified navbar-light bg-secondary p-1 fixed-top">
                <li class="nav-item">
                    <a class="nav-link border text-white" href="#payers">Payers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border text-white" href="#recievers">Recievers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border text-white" href="#others">Others</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border text-white" href="<?php //echo $admin_url;?>/assign_select_reciever.php">Next</a>
                </li>
            </ul>

        </section> -->

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
                            <form class="" action="" method="post">
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
                                                        echo "
                                                            <tr>
                                                                <!-- <th scope=\"row\">1</th> -->
                                                                <td>
                                                                    <input type=\"checkbox\" name=\"selected_payers[]\" value=\"$info_payer_details[id]\">
                                                                </td>
                                                                <td>$info_payer_details[username]</td>
                                                                <td>$info_payer_pckg_details[amount]</td>
                                                                <td>$info_payer_details[bank_name]</td>
                                                                <td>6hrs</td>
                                                                <td>
                                                                    <button class=\"btn btn-success \">More</button>
                                                                </td>
                                                            </tr>
                                                            ";
                                                    }   
                                                }
                                            }

                                        ?>
                                    </tbody>
                                </table>
                                <div class="buttons assign-info-btns" >
                                    <button type="submit" value="payers_to_recievers"  class="btn btn-warning card-link">Move To Recievers</button>
                                    <button type="submit" value="payers_to_others" class="btn btn-warning card-link">Move To Others</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End  Hover Rows  -->
        </div>

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
                            <form action="" method="post">
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
                                                            echo "
                                                                <tr>
                                                                    <!-- <th scope=\"row\">1</th> -->
                                                                    <td>
                                                                        <input type=\"checkbox\" name=\"selected_recievers[]\" value=\"$info_rec_user_details[id]\">
                                                                    </td>
                                                                    <td>$info_rec_user_details[username]</td>
                                                                    <td>$info_main_trans_details[total_return_amount]</td>
                                                                    <td>$info_rec_user_details[bank_name]</td>
                                                                    <td>6hrs</td>
                                                                    <td>
                                                                        <button class=\"btn btn-success \">More</button>
                                                                    </td>
                                                                </tr>
                                                                ";
                                                        }   
                                                    }
                                                }

                                            ?>
                                    </tbody>
                                </table>
                                <div class="buttons assign-info-btns" >
                                    <button type="submit" value="recievers_to_payers"  class="btn btn-warning card-link">Move To Payers</button>
                                    <button type="submit" value="recievers_to_others" class="btn btn-warning card-link">Move To Others</button>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End  Hover Rows  -->
        </div>

        <!-- others -->
        <div class="row">
            <div class="col-md-6">
                    <!--    Hover Rows  -->
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <h3><b>Others</b></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <form action="" method="post">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                    <th>Select</th>
                                    <th>UserName</th>
                                    <th>Bank</th>
                                    <th>Num Investments</th>
                                    <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query_info_user_other = "SELECT * FROM users WHERE status=\"0\" ";
                                        $result_info_user_other = mysqli_query($db_connection,$query_info_user_other);
                                        if (!$result_info_user_other) {
                                            log_alert(mysqli_error(),"error");
                                        } else {
                                            while ($info_other_user_details = mysqli_fetch_assoc($result_info_user_other)) {
                                                $num_investments = count_investments($info_other_user_details['id']);
                                                echo "
                                                    <tr>
                                                        <!-- <th scope=\"row\">1</th> -->
                                                        <td>
                                                            <input type=\"checkbox\" name=\"selected_others[]\" value=\"$info_other_user_details[id]\">
                                                        </td>
                                                        <td>$info_other_user_details[username]</td>
                                                        <td>$info_other_user_details[bank_name]</td>
                                                        <td>$num_investments</td>
                                                        <td>
                                                            <button class=\"btn btn-success \">More</button>
                                                        </td>
                                                    </tr>
                                                    ";
                                            }
                                        }
                                        
                                    ?>
                                    
                                </tbody>
                            </table>
                            <div class="buttons assign-info-btns" >
                                <button type="submit" value="others_to_recievers"  class="btn btn-warning card-link">Move To Recievers</button>
                                <button type="submit" value="others_to_payers" class="btn btn-warning card-link">Move To Payers</button>
                            </div> 
                        </form>
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

