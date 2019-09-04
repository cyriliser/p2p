<?php require_once("responses/assign_responses.php");?>
<div class="h-100" >
    <div class="sec-1 h-20">
        
        <h3 class="text-center mb-0">Admin Assign</h3>
    </div>
    <div class="assign_nav">
        <?php require_once("components/assign_nav.php"); ?>
    </div>
    
    <form action="" method="post">

    <div id="payers" class="sec-2 h-40">
        <div class="spacer1"></div>
        <h3 class="text-center mt-3">payers</h3>
        <div class="">
            <div class="payer-list">
                <!-- <form>                    -->
                    <?php
                        //GET LIST OF PAYERS 
                        $sql_query_payers = "SELECT * FROM users WHERE status='1' ";
                        $result_payers = mysqli_query($db_connection,$sql_query_payers);
                        if (!$result_payers) {
                            log_alert(mysqli_error($db_connection));
                        } else {
                            while ($payer_details = mysqli_fetch_assoc($result_payers)) {
                                // get payer package details
                                $sql_query_payer_package = "SELECT * FROM packages WHERE id=\"$payer_details[selected_package]\" ";
                                $result_payer_package = mysqli_query($db_connection,$sql_query_payer_package);
                                if (!$result_payer_package) {
                                    log_alert(mysqli_error($db_connection));
                                } else {
                                    $payer_package_details = mysqli_fetch_assoc($result_payer_package );
                                    include("components/payer_list.php");
                                }
                            }
                        }    
                    ?>
                <!-- </form> -->
            </div>
        </div>
    </div>
    
    
    <div id="recievers" class="sec-3 h-40">

        <div class="spacer1">
        <?php 
            // if (isset($_POST["submit"])) {
            //     echo "heloooooo!!!!!!!!!!!!!!!!!!!";
            //     $fields = array();
            //     $values = array();
            //     foreach($_POST as $field => $value) {
            //         $fields[] = $field;
            //         $values[] = $value;
            //     }
            //     print_r($fields);
            //     print_r($values);
            // }

        ?>
        </div>
        <div><button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mt-4 ">Assign</button></div>

        <h3 class="text-center">recievers</h3>
        <div class="">
            </div>
            <div class="recievers-list border">
                <!-- <form method="post" >                    -->
                    <?php 
                        // GET LIST OF RECIEVERS(status 3)
                        $sql_query_recievers = "SELECT * FROM users WHERE status='3' ";
                        $result_recievers = mysqli_query($db_connection,$sql_query_recievers);
                        if (!$result_recievers) {
                            echo mysqli_error($db_connection);
                        } else {
                            // while ($pending_trans_details = mysqli_fetch_assoc($result_pending)) {
                                // $sql_query_recievers = "SELECT * FROM users WHERE id=\"$pending_trans_details[recipient_id]\" ";
                                // $result_recievers = mysqli_query($db_connection,$sql_query_recievers);
                                // if (!$result_recievers) {
                                    // echo mysqli_error($db_connection);
                                // } else {
                                    while ($reciever_details = mysqli_fetch_assoc($result_recievers)) {
                                        // get payer package details
                                        $sql_query_reciever_package = "SELECT * FROM packages WHERE id=\"$reciever_details[selected_package]\" ";
                                        $result_reciever_package = mysqli_query($db_connection,$sql_query_reciever_package);
                                        if (!$result_reciever_package) {
                                            log_alert(mysqli_error($db_connection));
                                        } else {
                                            $payer_reciever_details = mysqli_fetch_assoc($result_reciever_package );

                                            // get main transaction details
                                            $sql_query_main_trans = "SELECT * FROM transactions WHERE recipient_id=\"$reciever_details[id]\" and status=\"pending\" ";
                                            $result_main_trans = mysqli_query($db_connection,$sql_query_main_trans);
                                            if (!$result_main_trans) {
                                                echo mysqli_error($db_connection);
                                            } else {
                                                $pending_trans_details = mysqli_fetch_assoc($result_main_trans);

                                                include("components/recievers_list.php");
                                            }
                                            
                                        }
                                    }
                                // }
                            // }
                        }
                    ?>
                <!-- </form> -->
            </div>
        </div>
        <div class="spacer"></div>
    </div>
    </form>
</div>

