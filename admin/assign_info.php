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
        $sql_query = "SELECT * FROM packages WHERE return_amount=\"$package_amount\" ";
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



    // payers actions
        // payers to recievers
        function payers_to_recievers(){
            global $message;
            // check if submit value is payers_to_recievers
            if ($_POST['submit'] == "payers_to_recievers") {
                $selected_payers = $_POST['selected_payers'];
                $receive_amount = $_POST['new_package_amount'];

                // check if there is any selected payers
                if (count($selected_payers) >=1 ) {
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
                $selected_payers = $_POST['selected_payers'];
                // $receive_amount = $_POST['new_package_amount'];

                // check if there is any selected payers
                if (count($selected_payers) >=1 ) {
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

        }

        // move to others
        function recievers_to_others(){
            
        }



    // others functions
        // move to recievers
        function others_to_payers(){

        }
        // move to payers
        function others_to_recievers(){

        }


    // select function to excecute

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
                                    <button type="submit" name="submit"  value="recievers_to_payers"  class="btn btn-warning card-link">Move To Payers</button>
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
                                <button type="submit" name="submit"  value="others_to_recievers"  class="btn btn-warning card-link">Move To Recievers</button>
                                <button type="submit" name="submit"  value="others_to_payers" class="btn btn-warning card-link">Move To Payers</button>
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

