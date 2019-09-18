<?php 
    require_once("../../../global_functions.php");
    security_check();
    if (isset($_POST["submit"])) {

        if (isset($_POST['selected_payers']) and isset($_POST['selected_reciever_id'])){
            $reciever_id = $_POST['selected_reciever_id'];
            $selected_payers = $_POST['selected_payers'];
            // get reciever details
            $sql_query_reciever = "SELECT * FROM users WHERE id=\"$reciever_id\" ";
            $result_reciever = mysqli_query($db_connection,$sql_query_reciever);
            if (!$result_reciever) {
                echo mysqli_error($db_connection);
            } else {
                $reciever_details = mysqli_fetch_assoc($result_reciever);

                // get main transaction details
                $sql_query_main = "SELECT * FROM transactions WHERE recipient_id=\"$reciever_id\" and status='pending' ";
                $result_main = mysqli_query($db_connection,$sql_query_main);
                if (!$result_main) {
                    echo mysqli_error($db_connection);
                } else {
                    $main_trans_details = mysqli_fetch_assoc($result_main);

                    // loop through the payers create subtransactions, and chenge the payers status
                    foreach ($selected_payers as $payer_id) {
                        // get payer details
                        $sql_query_payer = "SELECT * FROM users WHERE id=\"$payer_id\" ";
                        $result_payer = mysqli_query($db_connection,$sql_query_payer);
                        if (!$result_payer) {
                            echo mysqli_error($db_connection);
                        } else {
                            $payer_details = mysqli_fetch_assoc($result_payer);

                            // get payer package details
                            $sql_query_payer_package = "SELECT * FROM packages WHERE id=\"$payer_details[selected_package]\" ";
                            $result_payer_package = mysqli_query($db_connection,$sql_query_payer_package);
                            if (!$result_payer_package) {
                                echo mysqli_error($db_connection);
                            } else {
                                $payer_package_details = mysqli_fetch_assoc($result_payer_package);
                                
                                //make the insert
                                $sql_query_sub = "INSERT INTO sub_transactions (main_transaction_id, payer_id, recipient_id, amount, marked_as_paid, marked_as_recieved, status) VALUES ($main_trans_details[id],$payer_id,$reciever_id,$payer_package_details[amount],'0','0','pending')";
                                $result_sub = mysqli_query($db_connection,$sql_query_sub);
                                if (!$result_sub) {
                                    echo mysqli_error($db_connection);
                                } else {
                                    // make the update
                                    $sql_query_payer_up = "UPDATE users SET status='2' WHERE id=\"$payer_id\" ";
                                    $result_payer_up = mysqli_query($db_connection,$sql_query_payer_up);
                                    if (!$result_payer_up) {
                                        echo mysqli_error($db_connection);
                                    } else {
                                        
                                    }
                                }
   
                            }
                        }
                       

                        
                    }

                    // update the main transaction and the recievers status
                    $total_sub_transactions = count($selected_payers);
                    $sql_query_main_trans_up = "UPDATE transactions SET total_sub_transactions=\"$total_sub_transactions\" WHERE id=\"$main_trans_details[id]\" ";
                    $result_main_trans_up = mysqli_query($db_connection,$sql_query_main_trans_up);
                    if (!$result_main_trans_up) {
                        echo mysqli_error($db_connection);
                    } else {
                        
                        // make the update
                        $sql_query_reciever_up = "UPDATE users SET status='4' WHERE id=\"$reciever_id\" ";
                        $result_reciever_up = mysqli_query($db_connection,$sql_query_reciever_up);
                        if (!$result_reciever_up) {
                            echo mysqli_error($db_connection);
                        } else {
                            
                        }
                        
                    }  
                }
            }
        }
    } 
?>