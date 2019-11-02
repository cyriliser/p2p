<!-- Allocated to pay section -->
<section id="allocated-to-pay" class="bg-primary mx-2 pt-3">
        <!-- <div class="my-5"></div> -->
           
        <div class="card bg-secondary text-white d-flex text-center">

                <?php 
                        //get details about the sub transaction
                        $sql_query = "SELECT * FROM sub_transactions WHERE payer_id=\"$user_details[id]\" and status=\"pending\"";
                        $sub_transaction_result = mysqli_query($db_connection,$sql_query);
                        // log_alert("error");
                        if (!$sub_transaction_result) {
                                // log_alert("error");
                                log_alert(mysqli_error($db_connection),'error');
                        }
                        elseif(mysqli_num_rows($sub_transaction_result) == 0 ){
                                echo "
                                <h1 class=\"card-header\">allocated to pay</h1>
                                <div class=\"card-body\">
                                <h3 class=\"card-title\">System Error Please Contact Admins:</h3>
                                ";
                                
                                log_alert("No Matching Details Were Found","warning");
                        }else{
                                require_once("sub_components/allocated_to_pay__payment_details.php");
                                // log_alert("no error");
                                // log_alert($sub_transaction_details['id']);
                        }
                ?>

        </div>
</section>