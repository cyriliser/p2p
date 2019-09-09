<?php 
    require_once("admin_header.php");
    require_once("admin_nav.php");


    //process a transaction
    if (isset($_POST["submit"]) and $_POST["submit"]="finish_assign" and isset($_POST["selected_payers"])) {
        $reciever_id = $_POST['reciever_id'] ;
        $selected_payers = $_POST['selected_payers'];
        $payer_amounts = $_POST['payer_amounts'];

        //get main transaction details
        $trans_query_main = "SELECT * FROM transactions WHERE recipient_id=\"$reciever_id\" and status='pending' ";
        $trans_result_main = mysqli_query($db_connection,$trans_query_main);
        if (!$trans_result_main) {
            log_alert(mysqli_error($db_connection));
        } else {
            $main_trans_details = mysqli_fetch_assoc($trans_result_main);

            //get reciever details
            $trans_query_reciever = "SELECT * FROM users WHERE id=\"$main_trans_details[recipient_id]\" ";
            $trans_result_reciever = mysqli_query($db_connection,$trans_query_reciever);
            if (!$trans_result_reciever) {
                log_alert(mysqli_error($db_connection));
            } else {
                $reciever_details = mysqli_fetch_assoc($trans_result_reciever);

                // TODO
                // check if sum of payer amounts equals total return amount
                // mysqli_fetch_all($result,MYSQLI_ASSOC);

                $payer_total_amount = array_sum($payer_amounts);
                $num_selected_payers = sizeof($payer_amounts);

                // loop through the payers
                $index = 0;
                foreach ($selected_payers as  $payer_id ) {
                    // create subtransactions
                    $trans_query_ins_sub = "INSERT INTO sub_transactions (main_transaction_id, payer_id, recipient_id, amount, marked_as_paid, marked_as_recieved, status) 
                                                                VALUES (\"$main_trans_details[id]\", \"$payer_id\", \"$main_trans_details[recipient_id]\", \"$payer_amounts[$index]\", '0', '0', 'pending') ";
                    $trans_result_ins_sub = mysqli_query($db_connection,$trans_query_ins_sub) ;
                    if (!$trans_result_ins_sub) {
                        log_alert(mysqli_error($db_connection));
                    } else {
                        // update payer status
                        $trans_query_up_payer = "UPDATE users SET status='2' WHERE id=\"$payer_id\" ";
                        $trans_result_up_payer = mysqli_query($db_connection,$trans_query_up_payer);
                        if (!$trans_result_up_payer) {
                            log_alert(mysqli_error($db_connection));
                        }
                    }

                    $index++;
                }

                // update main transaction
                $trans_query_up_main = "UPDATE transactions SET total_sub_transactions=\"$num_selected_payers\" WHERE id=\"$main_trans_details[id]\" ";
                $trans_result_up_main = mysqli_query($db_connection,$trans_query_up_main);
                if (!$trans_result_up_main) {
                    log_alert(mysqli_error($db_connection));
                } else {
                    // update recipient status
                    $trans_query_up_rec = "UPDATE users SET status=\"4\" WHERE id=\"$reciever_details[id]\" ";
                    $trans_result_up_rec  = mysqli_query($db_connection,$trans_query_up_rec);
                    if (!$trans_result_up_rec) {
                        log_alert(mysqli_error($db_connection));
                    }
                }
                

                
            }
        }     
    }else{
        header("Location: $admin_url/assign_select_payers.php");
    }


    require_once("pages/transactions.php");
    require_once("admin_footer.php");
?>