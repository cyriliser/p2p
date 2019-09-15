<?php
    require_once("../config/config.php");
    require_once("../global_functions.php");
    connect_to_db();
    // require_once("admin_header.php"); 
    require_once("admin_nav.php");
    $message= array();
?>

<!-- responses -->
<?php

    // functions
    // reusable functions
    function change_user_status($user_id,$new_status){
        global $message, $db_connection;
        $sql_query = "UPDATE users SET status=\"$new_status\" WHERE id=\"$user_id\" ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push(mysqli_error($db_connection));
            return false;
        } else {
            return true;
        }
        
    }

    function change_user_package($user_id,$new_package){
        global $message, $db_connection;
        $sql_query = "UPDATE users SET selected_package=\"$new_package\" WHERE id=\"$user_id\" ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push(mysqli_error($db_connection));
            return false;
        } else {
            return true;
        }
        
    }

    function create_transaction($user_id,$package_id, $package_return_amount){
        global $message, $db_connection;
        $sql_query = "INSERT INTO transactions (recipient_id, transaction_package_id, total_return_amount, status ) VALUES ($user_id, $package_id, $package_return_amount, 'pending')";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
            return false;
        } else {
            return true;
        }
        
    }

    function get_assoc_package_details($package_id){
        global $message, $db_connection;
        $sql_query = "SELECT * FROM packages WHERE id=\"$package_id\" ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        } else {
            return mysqli_fetch_assoc($result);
        }
        
    }

    function get_assoc_package_details_amount($package_amount){
        global $message, $db_connection;
        if ($package_amount <= 500) {
            $sql_query = "SELECT * FROM packages WHERE id='1' ";
        } else {
            $sql_query = "SELECT * FROM packages WHERE return_amount=\"$package_amount\" ";
        }
        
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        } else {
            return mysqli_fetch_assoc($result);
        }
    }

    function get_assoc_user_details($user_id){
        global $message, $db_connection;
        $sql_query = "SELECT * FROM users WHERE id=\"$user_id\" ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        } else {
            return mysqli_fetch_assoc($result);
        }
        
    }

    function get_assoc_pending_transaction_details_rec($recipient_id){
        global $message, $db_connection;
        $sql_query = "SELECT * FROM transactions WHERE recipient_id=\"$recipient_id\" AND status='pending'  ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        } else {
            return mysqli_fetch_assoc($result);
        }
    }

    function cancel_sub_transaction($sub_transaction_id){
        global $message, $db_connection;
        $sql_query = "UPDATE sub_transactions SET status='canceled' WHERE id=\"$sub_transaction_id\" ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        }else {
            return true;
        }
    }

    function cancel_all_pending_sub_transactions($main_trans_id){
        global $message, $db_connection;
        // $sql_query = "UPDATE sub_transactions SET status='canceled' WHERE main_transaction_id=\"$main_trans_id\" and status='pending'  ";
        $sql_query = "SELECT * FROM sub_transactions WHERE main_transaction_id=\"$main_trans_id\" and status='pending'  ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        } else {
            while ($sub_transaction_details = mysqli_fetch_assoc($result)) {
                if (cancel_sub_transaction($sub_transaction_details['id'])) {
                    change_user_status($sub_transaction_details[payer_id]);
                }
            }
        }
    }

    function cancel_transaction($recipient_id){
        global $message, $db_connection;
        // get transaction details using recipient id and status pending
        $main_trans_details = get_assoc_pending_transaction_details_rec($recipient_id);
        if ($main_trans_details['total_sub_transactions'] >= 1) {
            // cancel all sub transactions
            cancel_all_pending_sub_transactions($main_trans_details['id']);
        }

        $sql_query = "UPDATE transactions SET status='canceled' WHERE id=\"$main_trans_details[id]\" ";
        $result = mysqli_query($db_connection,$sql_query);
        if (!$result) {
            array_push($message,mysqli_error($db_connection));
        }else {
            return true;
        }
    }



    // payers actions
        // payers to recievers
        function payers_to_recievers(){
            global $message;
            // check if submit value is payers_to_recievers
            if ($_POST['submit'] == "payers_to_recievers") {
                
                // check if there is any selected payers
                if (isset($_POST['selected_payers'])) {
                    $selected_payers = $_POST['selected_payers'];
                    $receive_amount = $_POST['new_package_amount'];
                    // loop through selected payers
                    foreach ($selected_payers as $index => $payer_id) {
                        // get user details
                        $payer_details = get_assoc_user_details($payer_id);
                        // get package details
                        // $payer_package_details = get_assoc_package_details($payer_details['selected_package']);
                        $payer_package_details = get_assoc_package_details_amount($receive_amount);
                        // create a transaction
                        if (create_transaction($payer_details['id'],$payer_package_details['id'],$payer_package_details['return_amount'])) {
                            // change status
                            change_user_status($payer_details['id'], '3');
                            change_user_package($payer_details['id'], $payer_package_details['id'] );
                            array_push($message,"Successfully Moved to Recievers");
                        }
                        
                    }
                } else {
                    array_push($message,"Please select 1 or more payers");
                }
                
                // array_push($message,"payers to recievers");

                
            } else {
                array_push($message,"not payers to recievers");
            }
             
        }

        // payers to others
        function payers_to_others(){
            global $message;
            // check if submit value is payers_to_others
            if ($_POST['submit'] == "payers_to_others") {
                
                // check if there is any selected payers
                if (isset($_POST['selected_payers'])) {
                    $selected_payers = $_POST['selected_payers'];
                    // $receive_amount = $_POST['new_package_amount'];
                    // loop through selected payers
                    foreach ($selected_payers as $index => $payer_id) {
                        // get user details
                        $payer_details = get_assoc_user_details($payer_id);
                        if (change_user_status($payer_id,0)) {
                            array_push($message,"successfully moved to others");
                        }                        
                    }
                } else {
                    array_push($message,"Please select 1 or more payers");
                }
                
                // array_push($message,"payers to recievers");

                
            } else {
                array_push($message,"not payers to recievers");
            }
             
        }


    // recievers functions
        // move to payers 
        function recievers_to_payers(){
            global $message;
            // check if submit value is recievers_to_payers
            if ($_POST['submit'] == "recievers_to_payers") {
                
                // check if there is any selected payers
                if (isset($_POST['selected_recievers'])) {
                    $selected_receivers = $_POST['selected_recievers'];
                    $receive_amount = $_POST['new_package_amount'];
                    $new_package_details = get_assoc_package_details_amount($receive_amount);
                    // loop through selected payers
                    foreach ($selected_receivers as $index => $receiver_id) {
                        // get transaction details
                        // need to cancel a transaction  
                        cancel_transaction($receiver_id);
                        // change user status and package 
                        change_user_status($receiver_id,'1');
                        change_user_package($receiver_id,$new_package_details['id']);
                    }
                } else {
                    array_push($message,"Please select 1 or more receivers");
                }
                
            } else {
                array_push($message,"not payers to recievers");
            }
           
        }

        // move to others
        function recievers_to_others(){
            global $message;
            // check if submit value is recievers_to_others
            if ($_POST['submit'] == "recievers_to_others") {
                
                // check if there is any selected payers
                if (isset($_POST['selected_recievers'])) {
                    $selected_receivers = $_POST['selected_recievers'];
                    // $receive_amount = $_POST['new_package_amount'];
                    // $new_package_details = get_assoc_package_details_amount($receive_amount);
                    // loop through selected payers
                    foreach ($selected_receivers as $index => $receiver_id) {
                        // get transaction details
                        // need to cancel a transaction  
                        cancel_transaction($receiver_id);
                        // change user status and package 
                        change_user_status($receiver_id,'0');
                        // change_user_package($receiver_id,$new_package_details['id']);
                    }
                } else {
                    array_push($message,"Please select 1 or more receivers");
                }
                
            } else {
                array_push($message,"not payers to recievers");
            }
           
        }



    // others functions
        // move to recievers
        function others_to_recievers(){
            global $message;
            // check if submit value is others_to_recievers
            if ($_POST['submit'] == "others_to_recievers") {
                
                // check if there is any selected others
                if (isset($_POST['selected_others'])) {
                    $selected_others = $_POST['selected_others'];
                    $receive_amount = $_POST['new_package_amount'];
                    $new_package_details = get_assoc_package_details_amount($receive_amount);
                    // loop through selected payers
                    foreach ($selected_others as $index => $other_id) {
                        // create a transaction (userid,packageid,totalreturn)
                        if (create_transaction($other_id,$new_package_details['id'],$new_package_details['return_amount'])) {
                            if (change_user_package($other_id,$new_package_details['id']) and change_user_status($other_id,'3') ) {
                                array_push($message,"Successfully moved to recievers");
                            }
                        }
                    }
                } else {
                    array_push($message,"Please select 1 or more receivers");
                }
            } else {
                array_push($message,"not payers to recievers");
            }
           
        }
        // move to payers
        function others_to_payers(){
            global $message;
            // check if submit value is others_to_recievers
            if ($_POST['submit'] == "others_to_payers") {
                
                // check if there is any selected others
                if (isset($_POST['selected_others'])) {
                    $selected_others = $_POST['selected_others'];
                    $pay_amount = $_POST['new_package_amount'];
                    $new_package_details = get_assoc_package_details_amount($pay_amount);
                    // loop through selected payers
                    foreach ($selected_others as $index => $other_id) {
                        if (change_user_package($other_id,$new_package_details['id']) and change_user_status($other_id,'1') ) {
                            array_push($message,"Successfully moved to payers");
                        }
                    }
                } else {
                    array_push($message,"Please select 1 or more others");
                }
            } else {
                array_push($message,"not payers to recievers");
            }
           
        }


    // select function to execute
    if(isset($_POST["submit"])){
        // array_push($message,"submit");
        switch ($_POST["submit"]) {
            case 'payers_to_recievers':
                // array_push($message,"func called ");
                payers_to_recievers();
                break;
            case 'payers_to_others':
                payers_to_others();
                break;

            case 'recievers_to_payers':
                recievers_to_payers();
                break;
            case 'recievers_to_others':
                recievers_to_others();
                break;
            
            case 'others_to_payers':
                others_to_payers();
                break;
            case 'others_to_recievers':
                others_to_recievers();
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

        <!-- message -->
        <?php
            if (count($message) >= 1) {
                // close php ?> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info text-center" role="alert">
                            <?php 
                                foreach ($message as $msg) {
                                    echo "<p>$msg</p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php //open php
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
                                    <div>
                                        <label for="new_package_amount">Receiving Amount:</label>
                                        <input class="input-sm" type="number" value="500" name="new_package_amount" min="500" max="10000" step="500">
                                        <button type="submit" name="submit" value="payers_to_recievers"  class="btn btn-warning card-link">Move To Recievers</button>
                                    </div>
                                    <button type="submit" name="submit" value="payers_to_others" class="btn btn-warning card-link">Move To Others</button>
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
                                                $query_info_main = "SELECT * FROM transactions WHERE status='pending'";
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
                                    <div>
                                        <label for="new_package_amount">Receiving Amount:</label>
                                        <input class="input-sm" type="number" value="500" name="new_package_amount" min="500" max="10000" step="500">   
                                        <button type="submit" name="submit"  value="recievers_to_payers"  class="btn btn-warning card-link">Move To Payers</button>
                                    </div>
                                    <button type="submit" name="submit"  value="recievers_to_others" class="btn btn-warning card-link">Move To Others</button>
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
                                <div>
                                    <label for="new_package_amount">Amount to receive:</label>
                                    <input class="input-sm" type="number" value="500" name="new_package_amount" min="500" max="10000" step="500">
                                    <button type="submit" name="submit"  value="others_to_recievers"  class="btn btn-warning card-link">Move To Recievers</button>
                                </div>
                                <div>
                                    <label for="new_package_amount">Amount to pay:</label>
                                    <input class="input-sm" type="number" value="500" name="new_package_amount" min="500" max="10000" step="500">
                                    <button type="submit" name="submit"  value="others_to_payers" class="btn btn-warning card-link">Move To Payers</button>
                                </div>
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

