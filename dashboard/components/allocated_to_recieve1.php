<!-- Allocated to pay section -->
<section id="allocated-to-pay" class="bg-primary pt-3">
        <!-- <div class="my-5"></div> -->
           
        <div class="card bg-secondary text-white d-flex text-center">
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

                        <div class="w-100 ">
                                <div class="progress row bg-info">
                                <?php
                                        $percentage = $main_transaction1_details['completed_sub_transactions']  / $main_transaction1_details['total_sub_transactions'] * 100;
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
                                                        echo "<div class=\"payer-details my-1 my-3\" >";
                                                        echo "     <div class=\"details border border-info \" >
                                                                   <!-- details -->";

                                                        // get payer details   
                                                        $sql_query_payer = "SELECT * FROM users WHERE id=\"$sub_transaction_details[payer_id]\"";
                                                        $payer_result = mysqli_query($db_connection,$sql_query_payer);
                                                        if (!$payer_result) {
                                                                log_alert(mysqli_error(),"error");
                                                        } else {
                                                                        $payer_details = mysqli_fetch_assoc($payer_result);
                                                                                echo "  <div  class=\"row\" >
                                                                                                <p class=\"col-5\">Username</p> <p class=\"col-1\">:</p>
                                                                                                <p class=\"col-5\">$payer_details[username]</p>
                                                                                        </div>";

                                                                                echo "  <div  class=\"row\" >
                                                                                                <p class=\"col-5\">Name</p> <p class=\"col-1\">:</p>
                                                                                                <p class=\"col-5\">$payer_details[name]</p>
                                                                                        </div>";

                                                                                echo "  <div  class=\"row\" >
                                                                                                <p class=\"col-5\">Surname</p> <p class=\"col-1\">:</p>
                                                                                                <p class=\"col-5\">$payer_details[surname]</p>
                                                                                        </div>";

                                                                                echo "  <div  class=\"row\" >
                                                                                                <p class=\"col-5\">Contact No</p> <p class=\"col-1\">:</p>
                                                                                                <p class=\"col-5\">$payer_details[contact_cell]</p>
                                                                                        </div>";
                                                                                                
                                                                                echo "  <div  class=\"row\" >
                                                                                                <p class=\"col-5\">Email</p> <p class=\"col-1\">:</p>
                                                                                                <p class=\"col-5\">$payer_details[email]</p>
                                                                                        </div>";

                                                                                echo "  <div  class=\"row\" >
                                                                                                <p class=\"col-5\">BankName</p> <p class=\"col-1\">:</p>
                                                                                                <p class=\"col-5\">$payer_details[bank_name]</p>
                                                                                        </div>";
                                                                        echo "</div>";

                                                                echo "<!-- status -->";
                                                                echo "<div class=\"border border-info mt-4 px-1 py-1\">";
                                                                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"bg-primary my-1 text-center w-100 username\" >
                                                                                        <h5>Status</h5>
                                                                                </div>";

                                                                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 name\">
                                                                                        <strong class=\"mx-auto\">Pending</strong>
                                                                                        <i class=\"fas fa-check-square text-primary fa-2x mr-5\"></i>
                                                                                </div>";
                                                                        
                                                                        $check_payed = ($sub_transaction_details['marked_as_paid']) ? "text-primary" : "" ;
                                                                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 name\">
                                                                                        <strong class=\"mx-auto\">Marked As Paid</strong>
                                                                                        <i class=\"fas fa-check-square $check_payed fa-2x mr-5\"></i>
                                                                                </div>";
                                                                                
                                                                        echo "<!-- form start -->";

                                                                                if ($sub_transaction_details['marked_as_recieved'] == 1) {
                                                                                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 name\">
                                                                                                        <strong class=\"mx-auto\">Marked As Paid</strong>
                                                                                                        <i class=\"fas fa-check-square text-primary fa-2x mr-5\"></i>
                                                                                                </div>";
                                                                                } else {
                                                                                        echo "<div style=\"border: solid #a49797 1px;\"  class=\" px-auto py-1  cell\">";
                                                                                                echo "<form action=\"\" method=\"post\" class=\"row mx-auto px-auto\">";
                
                                                                                                        echo "<div class=\"custom-control custom-switch col-8 px-auto pr-0\">";
                                                                                                                echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_details[id]\">";
                                                                                                                echo "<input type=\"hidden\" name=\"sub_transaction_id\" value=\"$sub_transaction_details[id]\">";
                                                                                                                echo "<input type=\"checkbox\" class=\"custom-control-input\" name=\"mark_recieved\" value=\"1\" id=\"customSwitch1\">";
                                                                                                                echo "<label class=\"custom-control-label\" for=\"customSwitch1\">Mark As Recieved</label>";
                                                                                                        echo "</div>";
                                                                                                        
                                                                                                        echo "  <div class=\"col-4 my-auto text-left px-0\">
                                                                                                                        <button type=\"submit\" class=\"btn btn-primary btn-sm px-0 py-0\">Submit</button>
                                                                                                                </div>";
                                                                                        
                                                                                                echo "</form>";
                
                                                                                        echo "</div>";
                                                                                }
                                                                                
                
                                                                        echo "<!-- form end -->";
                                                                        
                                                                        $check_completed = ($sub_transaction_details['marked_as_paid']) ? "text-primary" : "" ;
                                                                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 name\">
                                                                                        <strong class=\"mx-auto\">Completed</strong>
                                                                                        <i class=\"fas fa-check-square $check_completed fa-2x mr-5\"></i>
                                                                                </div>";
                                                                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 name hide\">
                                                                                        <strong class=\"mx-auto\">Cancelled</strong>
                                                                                        <i class=\"fas fa-check-square text-primary fa-2x mr-5\"></i>
                                                                                </div>";


                                                                //         echo "<div  class=\"row \" ><Strong>Status</Strong></div>";
                                                                //         echo "<div  class=\"row \" ><Strong>Pending</Strong></div>";
                                                                //         echo "<div  class=\"row \" ><Strong>Marked As Paid</Strong></div>";

                                                                // echo "<!-- form start -->";

                                                                if ($sub_transaction_details['marked_as_recieved'] == 1) {
                                                                        echo "<div  class=\"row hide\" ><Strong>Marked As Recieved</Strong></div>";
                                                                } else {
                                                                        echo "<div  class=\"row cell hide\">";
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
                                                                

                                                                // echo "<!-- form end -->";

                                                                // echo "<div  class=\"row \" ><Strong>Completed</Strong></div>";
                                                                // echo "<div  class=\"row \" ><Strong>Cancelled</Strong></div>";
                                                                echo "</div>";

                                                                echo "<!-- time -->";
                                                                
                                                                echo "
                                                                        <div>
                                                                        <div class=\"mt-3\"><h3>Time Left To Pay:</h3></div>
                                                                        <div class=\"count-down row border border-primary mb-4\">
                                                                                <!-- <div class=\" col-1 col-sm-1\"></div> -->
                                                                                
                                                                                <div class=\" col-10 col-sm-8\">";
                                                                                        $db_time = $sub_transaction_details['time_assigned'];
                                                                                        // echo $db_time;
                                                                                        if(countDown($db_time,12,true)){
                                                                                                // echo "timer gone";
                                                                                                echo "<div class=\"alert alert-warning\" role=\"alert\">
                                                                                                        <h6>12 hours have passed please Notify the Admins. </br> we apologize for the inconvenience</h6>
                                                                                                        </div>";
                                                                                        }
                                                                                        else{
                                                                                                // echo "Timer still running";
                                                                                        }
                                                                
                                                                                echo "</div>
                                                                                
                                                                                <div class=\" col-1 col-sm-1\"></div>
                                                                        </div>
                                                                </div>
                                                                ";
                                                        }
                                                        
                                                }
                                        }   
                                ?>
                                                        
                                        
                        </div>
                </div>
        </div>
</section>