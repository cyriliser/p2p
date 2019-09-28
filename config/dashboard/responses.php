<?php
    require_once('../global_functions.php');

    // package selection responses
    if(isset($_POST['selected_package'])){
        $selected_package_id = $_POST['selected_package'];
        $user_id1 = $_POST['user_id'];
        $verification_time = time();//to be used for the 12hr verification
        $reg_time = time();//to be used for the 12hr verification
        $sql_query = "UPDATE users SET selected_package=\"$selected_package_id\", status=1, reg_time=\"$reg_time\" WHERE id=\"$user_id1\""; 
        // $sql_query = "UPDATE users SET selected_package=\"$selected_package_id\", status=1, verification_time=\"$verification_time\" WHERE id=\"$user_id1\""; 
        $result1 = mysqli_query($db_connection,$sql_query);
        

        if (!$result1) {
            log_alert(mysqli_error($db_connection),'error');
        } else {
            log_alert("successfuly updated",'success');
        }
        
    }


    // verification responses
    if(isset($_POST['new_investment_amount'])){
        $new_invesment_amount = $_POST['new_investment_amount'];
        $user_id2 = $_POST['user_id'];
        $sql_query1 = "SELECT * FROM packages WHERE amount=\"$new_invesment_amount\"";
        $package_result = mysqli_query($db_connection,$sql_query1);
        if(!$package_result){
            log_alert(mysqli_error($db_connection),'message');
        }else{
            $package_details = mysqli_fetch_assoc($package_result);
            $sql_query = "UPDATE users SET selected_package=\"$package_details[id]\" where id=\"$user_id2\"";
            $result = mysqli_query($db_connection,$sql_query);
            if (!$result) {
                log_alert(mysqli_error(),'error');
            }else{
                log_alert("succefully updated",'success');
            }
        }
        
    }

    //allocated to pay responses
    if(isset($_POST['mark_paid'])){
        $user_id3 = $_POST['user_id'];
        $main_transaction_id = $_POST['main_transaction_id'];
        if($_POST['mark_paid'] == 1){
            // marking tha transaction as paid
            $sql_query = "UPDATE sub_transactions SET marked_as_paid=\"1\" WHERE payer_id=\"$user_id3\" and main_transaction_id=\"$main_transaction_id\" ";
            $result = mysqli_query($db_connection,$sql_query);
            if(!$result){
                log_alert(mysqli_error($db_connection),"error");
            }else {
                log_alert("successfully updated","success");
            }
        }

        // mark completed if both users have confirmed
        $sql_query_sub = "SELECT * FROM sub_transactions WHERE payer_id=\"$user_id3\" and main_transaction_id=\"$main_transaction_id\" " ;
        // echo $sql_query_sub;
        $sub_transaction7_result = mysqli_query($db_connection,$sql_query_sub);
        if(!$sub_transaction7_result){
            log_alert1(mysqli_error($db_connection),"error");
        }
        if(mysqli_num_rows($sub_transaction7_result) == 0){
            log_alert("No Matching Records","warning");
        }else {
            $sub_transaction7_details = mysqli_fetch_assoc($sub_transaction7_result);
            // set status to complete if both users have marked
            if ($sub_transaction7_details['marked_as_paid'] == "1" and $sub_transaction7_details['marked_as_recieved'] == "1") {
                // marking tha transaction as complete then create new main transaction for payer
                $sql_query2 = "UPDATE sub_transactions SET status=\"completed\" WHERE payer_id=\"$user_id3\" and main_transaction_id=\"$main_transaction_id\" ";
                // echo $sql_query2;
                $result2 = mysqli_query($db_connection,$sql_query2);
                if(!$result2){
                    log_alert(mysqli_error($db_connection),"error");
                }else {
                    //get user details
                    $sql_query_user = "SELECT * FROM users WHERE id=\"$user_id3\"";
                    $result_user = mysqli_query($db_connection,$sql_query_user);
                    if (!$result_user) {
                        log_alert(mysqli_error($db_connection));
                    } else {
                        $user_details_payer = mysqli_fetch_assoc($result_user);

                        // get package details
                        $sql_query_payer_package = "SELECT * FROM packages WHERE id=\"$user_details_payer[selected_package]\"";
                        $result_package = mysqli_query($db_connection,$sql_query_payer_package);
                        if (!$result_package) {
                            log_alert(mysqli_error($db_connection));
                        } else {
                            $user_package_details = mysqli_fetch_assoc($result_package);

                            // make the insert
                            $time = time();
                            $sql_query_main_trans = "INSERT INTO transactions (recipient_id, transaction_package_id, recieved_amount, total_return_amount, completed_sub_transactions, status, time_created) VALUES ( \"$user_details_payer[id]\", \"$user_package_details[id]\", \"0\", \"$user_package_details[return_amount]\", \"0\", \"pending\", $time)";
                            $result_main_trans = mysqli_query($db_connection,$sql_query_main_trans);
                            if (!$result_main_trans) {
                                log_alert(mysqli_error($db_connection));
                            } else {
                                log_alert("successfull");
                            }
                        }
                    } 
                }

                // update main Transaction
                // get main transaction
                $sql_query_main = "SELECT * FROM transactions WHERE id=\"$main_transaction_id\" " ;
                // echo $sql_query_main;
                $main_transaction_result = mysqli_query($db_connection,$sql_query_main);
                if(!$main_transaction_result){
                    log_alert(mysqli_error($db_connection),"error");
                }
                if(mysqli_num_rows($main_transaction_result) == 0){
                    log_alert("No Matching Records","warning");
                }else {
                    $main_transaction_details = mysqli_fetch_assoc($main_transaction_result);
                    $completed_sub_transactions = $main_transaction_details['completed_sub_transactions'] + 1; 
                    // echo $completed_sub_transactions;
                    // update main Transaction and both users
                    $recieved_amount = $main_transaction_details['recieved_amount'] +  $sub_transaction7_details['amount'];
                    if($completed_sub_transactions == $main_transaction_details['total_sub_transactions']){
                        $sql_query4 = "UPDATE transactions SET recieved_amount=\"$recieved_amount\",  completed_sub_transactions=\"$completed_sub_transactions\", status=\"completed\" WHERE id=\"$main_transaction_id\" ";
                    }else{
                        $sql_query4 = "UPDATE transactions SET recieved_amount=\"$recieved_amount\", completed_sub_transactions=\"$completed_sub_transactions\" WHERE id=\"$main_transaction_id\" ";
                    }
                    // echo $sql_query4;
                    $result4 = mysqli_query($db_connection,$sql_query4);
                    if(!$result4){
                        log_alert(mysqli_error($db_connection),"error");
                    }else {
                        // if main transaction is completed update users status 
                        if($completed_sub_transactions == $main_transaction_details['total_sub_transactions']){
                            //updating reciepient user
                            $sql_query5 = "UPDATE users SET status=\"0\" WHERE id=\"$main_transaction_details[recipient_id]\" ";
                            $result5 = mysqli_query($db_connection,$sql_query5);
                            if(!$result5){
                                log_alert(mysqli_error($db_connection),"error");
                            }

                            //updating payer user
                            $sql_query_pay = "UPDATE users SET status=\"0\" WHERE id=\"$main_transaction_details[recipient_id]\" ";
                            $result_pay = mysqli_query($db_connection,$sql_query_pay);
                            if(!$result_pay){
                                log_alert(mysqli_error($db_connection),"error");
                            }
                        }
                    }
                }


                // change user status
                $sql_query3 = "UPDATE users SET status=\"3\" WHERE id=\"$user_id3\" ";
                $result3 = mysqli_query($db_connection,$sql_query3);
                if(!$result3){
                    log_alert(mysqli_error($db_connection),"error");
                }

                if($result2 and $result3) {                
                    log_alert("complleted", "success");
                }
            }else {
                log_alert("Marked as payed, please contact the recipient to confirm recieving the money", "info");
            }
        }
    }

    // wait for payer responses



    // allocated to receive responses
    if (isset($_POST['mark_recieved'])) {
        $user_id4 = $_POST['user_id'];
        $sub_trabsaction_id = $_POST['sub_transaction_id'];

        // update subtransaction to marked as recieved
        if ($_POST['mark_recieved'] == 1) {
            $sql_query_rec = "UPDATE sub_transactions SET marked_as_recieved=\"1\" WHERE id=\"$sub_trabsaction_id\" ";
            $rec_result = mysqli_query($db_connection,$sql_query_rec);
            if (!$rec_result) {
                log_alert(mysqli_error($db_connection),"error");
            } else {
                log_alert("marked as recieved");

                // check if both users have marked then complete the transaction
                $sql_query_subt = "SELECT * FROM sub_transactions WHERE id=\"$sub_trabsaction_id\" ";
                $subt_result = mysqli_query($db_connection,$sql_query_subt);
                if (!$subt_result) {
                    log_alert(mysqli_error($db_connection),"error");
                } else {
                    $sub_transaction8_details = mysqli_fetch_assoc($subt_result);
                    if($sub_transaction8_details['marked_as_paid'] == 1 and $sub_transaction8_details['marked_as_recieved'] == 1){
                        // log_alert1("both marked");
                        // complete the transaction
                        $sql_query_9 = "UPDATE sub_transactions SET status=\"completed\" WHERE id=\"$sub_trabsaction_id\" " ;
                        $result9  = mysqli_query($db_connection,$sql_query_9);
                        if (!$result9) {
                            log_alert(mysqli_error(),"error");
                        } else {
                            // update status of payer then create new transaction for them
                            $sql_query13 = "UPDATE users SET status=\"3\" WHERE id=\"$sub_transaction8_details[payer_id]\" ";
                            $result13 = mysqli_query($db_connection,$sql_query13);
                            if (!$result13) {
                                log_alert(mysqli_error(),"error");
                            } else {
                                log_alert("successfull","info");

                                //get details of recipient
                                $sql_query196 = " SELECT * FROM users WHERE id=\"$sub_transaction8_details[recipient_id]\"";
                                log_alert1($sql_query196);
                                $result196 = mysqli_query($db_connection,$sql_query196);
                                if (mysqli_errno($db_connection)) {
                                    log_alert1(mysqli_error($db_connection)." error ","error");
                                } else {
                                    // log_alert1("got details");
                                    $reciepient_details196 = mysqli_fetch_assoc($result196);
                                    // log_alert1($reciepient_details196['id']);
                                    //get package details of recipient
                                    // TODO: get payer details
                                    $query_query_payer = "SELECT * FROM users WHERE id=\"$sub_transaction8_details[payer_id]\" ";
                                    $result_payer = mysqli_query($db_connection,$query_query_payer);
                                    if (!$result_payer) {
                                        log_alert(mysqli_error($db_connection));
                                    } else {
                                        $payer_details = mysqli_fetch_assoc($result_payer); 

                                        $sql_query16 = " SELECT * FROM packages WHERE id=\"$payer_details[selected_package]\"";
                                        $result16 = mysqli_query($db_connection,$sql_query16);
                                        if (!$result16) {
                                            log_alert(mysqli_error($db_connection),"error");
                                        } else {
                                            $package_details = mysqli_fetch_assoc($result16);
                                            
                                            // make insert query
                                            // add main transaction for user
                                            $time = time();
                                            $sql_query14 = "INSERT INTO transactions (recipient_id, transaction_package_id, recieved_amount, total_return_amount, completed_sub_transactions, status,time_created) VALUES ( \"$sub_transaction8_details[payer_id]\", \"$package_details[id]\", \"0\", \"$package_details[return_amount]\", \"0\", \"pending\", \"$time\" )";
                                            log_alert($sql_query14);
                                            $result14 = mysqli_query($db_connection,$sql_query14);
                                            if (!$result14) {
                                                log_alert(mysqli_error($db_connection));
                                            } else {
                                                log_alert("successfully added","success");
                                            }
                                            

                                        }
                                    }
                                    
                                    
                                } 
                            }
                            

                            // Update Main Transaction
                            // get main Transaction Details
                            $sql_query10 = "SELECT * FROM transactions WHERE id=\"$sub_transaction8_details[main_transaction_id]\" " ;
                            $reslut10 = mysqli_query($db_connection,$sql_query10);
                            if (!$reslut10) {
                                log_alert($db_connection);
                            } else {
                                $main_transaction10_details = mysqli_fetch_assoc($reslut10);
                                $number_of_completed_trans = $main_transaction10_details['completed_sub_transactions'] + 1;
                                $amount_recieved = $main_transaction10_details['recieved_amount'] + $sub_transaction8_details['amount'];
                                //check number of completed transaction
                                if ($number_of_completed_trans == $main_transaction10_details['total_sub_transactions'] ){
                                    $sql_query_11 = "UPDATE transactions SET completed_sub_transactions=\"$number_of_completed_trans\", recieved_amount=\"$amount_recieved\",status=\"completed\" WHERE id=\"$main_transaction10_details[id]\" " ;
                                }else {
                                    $sql_query_11 = "UPDATE transactions SET completed_sub_transactions=\"$number_of_completed_trans\", recieved_amount=\"$amount_recieved\" WHERE id=\"$main_transaction10_details[id]\" " ;
                                }

                                //making the update
                                // log_alert1($sql_query_11);
                                $result11  = mysqli_query($db_connection,$sql_query_11);
                                if (!$result11) {
                                    log_alert(mysqli_error($db_connection),"error");
                                }else {
                                    // update recipient user status
                                    if ($number_of_completed_trans == $main_transaction10_details['total_sub_transactions'] ) {
                                        $sql_query12 = "UPDATE users SET status=\"0\" WHERE id=\"$main_transaction10_details[recipient_id]\" ";
                                        $result12 = mysqli_query($db_connection,$sql_query12);
                                        if (!$result12) {
                                            log_alert(mysqli_error(),"error");
                                        } else {
                                            log_alert1("successfully updated");
                                        }
                                        
                                    }
                                }
                            }
                            
                        }
                        
                    }
                }
                
            }
            
        }
    }
?>