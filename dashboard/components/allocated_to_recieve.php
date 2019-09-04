<!-- Allocated to pay section -->
<section id="allocated-to-pay" class="min-vh-100 mt-5 pt-3">
        <div class="my-5"></div>
           
        <div class="card d-flex text-center">
                <h1 class="card-header">allocated to Receive</h1>
                <div class="card-body">

                        <?php 
                                // get main transaction details
                                $sql_query_main1 = "SELECT * FROM transactions WHERE recipient_id=\"$user_details[id]\" and status=\"pending\"";
                                $main_transaction1_result = mysqli_query($db_connection,$sql_query_main1);
                                if (!$main_transaction1_result) {
                                        log_alert(mysqli_error($db_connection),"error");
                                } else {
                                       $main_transaction1_details = mysqli_fetch_assoc($main_transaction1_result);
                                       echo "<h3 class=\"card-title\">You Have Been Allocated To Recieve: <strong>R$main_transaction1_details[total_return_amount]</strong></h3>";

                                       echo "<h4>Completed Payments: <strong>$main_transaction1_details[completed_sub_transactions]/$main_transaction1_details[total_sub_transactions]</strong></h4>";

                                       echo "<h4>Amount Revieved: <strong>R$main_transaction1_details[recieved_amount]/ R$main_transaction1_details[total_return_amount]</strong></h4>";

                                }
                                
                        ?>

                        <div class="row ">
                                <div class="progress w-100 bg-secondary">
                                <?php
                                        $percentage = $main_transaction1_details['completed_sub_transactions']  / $main_transaction1_details['total_sub_transactions'];
                                        // $percentage = 50;
                                      echo  "<div class=\"progress-bar text-white\" role=\"progressbar\" style=\"width: $percentage%;\" aria-valuenow=\"$percentage\" aria-valuemin=\"0\" aria-valuemax=\"100\">$percentage%</div>";
                                ?>
                                </div>
                        </div>
                        
                        <div class="payers">
                                <h3>Payer Details</h3>
                                <?php 
                                        $sql_query_subs1 = "SELECT * FROM sub_transactions WHERE main_transaction_id=\"$main_transaction1_details[id]\"";
                                        $subs1_result = mysqli_query($db_connection,$sql_query_subs1);
                                        if (!$subs1_result) {
                                                log_alert(mysqli_error(),"error");
                                        } else {
                                                while ($sub_transaction_details = mysqli_fetch_assoc($subs1_result)) {
                                                        echo "<!-- payer 1 -->";
                                                        echo "<div class=\"payer-details my-1 bg-light my-3\" style=\"border: solid black 2px; padding: 3px;\">";
                                                        echo "<div class=\"details d-flex justify-content-around\" >
                                                                <!-- details -->";

                                                        // get payer details   
                                                        $sql_query_payer = "SELECT * FROM users WHERE id=\"$sub_transaction_details[payer_id]\"";
                                                        $payer_result = mysqli_query($db_connection,$sql_query_payer);
                                                        if (!$payer_result) {
                                                                log_alert(mysqli_error(),"error");
                                                        } else {
                                                                $payer_details = mysqli_fetch_assoc($payer_result);
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100\" >$payer_details[username]</div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100\" >$payer_details[name]</div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100\" >$payer_details[surname]</div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100\" >$payer_details[contact_cell]</div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100\" >$payer_details[email]</div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100\" >$payer_details[bank_name]</div>";
                                                                echo "</div>";

                                                                echo "<!-- status -->";
                                                                echo "<div class=\"status d-flex justify-content-around\">";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \" ><Strong>Status</Strong></div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \" ><Strong>Pending</Strong></div>";
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \" ><Strong>Marked As Paid</Strong></div>";

                                                                echo "<!-- form start -->";

                                                                if ($sub_transaction_details['marked_as_recieved'] == 1) {
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \" ><Strong>Marked As Recieved</Strong></div>";
                                                                } else {
                                                                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 cell\">";
                                                                                echo "<form action=\"\" method=\"post\" class=\"d-flex\">";

                                                                                        echo "<div class=\"custom-control custom-switch\">";
                                                                                                echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_details[id]\">";
                                                                                                echo "<input type=\"hidden\" name=\"sub_transaction_id\" value=\"$sub_transaction_details[id]\">";
                                                                                                echo "<input type=\"checkbox\" class=\"custom-control-input\" name=\"mark_recieved\" value=\"1\" id=\"customSwitch1\">";
                                                                                                echo "<label class=\"custom-control-label\" for=\"customSwitch1\">Mark As Recieved</label>";
                                                                                        echo "</div>";

                                                                                        echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\">Submit</button>";
                                                                        
                                                                                echo "</form>";

                                                                        echo "</div>";
                                                                }
                                                                

                                                                echo "<!-- form end -->";

                                                                echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \" ><Strong>Completed</Strong></div>";
                                                                echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \" ><Strong>Cancelled</Strong></div>";
                                                                echo "</div>";

                                                                echo "<!-- time -->";
                                                                echo "<div class=\"time\">";
                                                                        echo "<div>Time Left: </div>";

                                                                        // $twelve_hrs = 6000;
                                                                        $twelve_hrs = 43200;
                                                                        $db_time = 1566381518 ;
                                                                        $current_time = time();
                                                                        $time_left = $db_time + $twelve_hrs - $current_time;

                                                                        echo "<div id=\"time_value\" style=\"display:none;\">". $time_left  . "</div>";

                                                                        echo "<div class=\"count-down row\">";
                                                                                echo "<div class=\"col-sm-2\"></div>";
                                                                                echo "<div class=\"clock_verification col-sm-8\" style=\"margin:2em;\"></div>";
                                                                                echo "<div class=\"col-sm-2\"></div>";
                                                                        echo "</div>";

                                                                echo "</div>";
                                                                echo "</div>";
                                                        }
                                                        
                                                }
                                        }   
                                ?>
                                                        
                                        
                        </div>
                </div>
        </div>
</section>