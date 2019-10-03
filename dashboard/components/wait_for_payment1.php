<!-- wait for payment section -->
<section id="wait-for-payment" class="bg-primary px-2 pt-3">
        <!-- <div class="my-5"></div> -->
                   
        <div class="card bg-secondary text-white  d-flex text-center">
        <h4 class="card-header">Wait For Allocation</h4>
        <div class="card-body px-1">
                <h6 class="card-title">Please Allow A Period Of <br> 5days or Less</h6>
                <h6 class="card-title">To Be Allocated Someone <br> To Pay You</h6>

                <?php 
                        // get user details and package ID
                        // log_alert1($user_details['selected_package']);
                        // get package return amount
                        $sql_query_wp_package = "SELECT * FROM packages WHERE id=\"$user_details[selected_package]\"";
                        $result_wp_package = mysqli_query($db_connection,$sql_query_wp_package);
                        if (!$result_wp_package) {
                                log_alert(mysqli_error());
                        } else {
                                $wp_package_details = mysqli_fetch_assoc($result_wp_package);
                                // log_alert($wp_package_details['return_amount']);
                                echo "<h1> <strong> R$wp_package_details[return_amount] </strong></h1>";
                        }
                        
                ?>

                <!-- clock -->
                <div>
                        <div class="count-down row border border-primary mb-4 py-2 mx-auto">
                                <div class=" col-1 col-sm-1"></div>
                                
                                <div class=" col-11 col-sm-8">
                                        <?php
                                        $sql_main_tran = "SELECT * FROM transactions WHERE recipient_id=\"$user_id\" and status=\"pending\" ";
                                        $result_main_tran = mysqli_query($db_connection,$sql_main_tran);
                                        if (!$result_main_tran) {
                                                log_alert(mysqli_error($db_connection),"error");
                                        } else {
                                                $transaction_details = mysqli_fetch_assoc($result_main_tran);
                                        }
                                        $db_time = $transaction_details['time_created'];
                                        if(countDown($db_time,120,true)){
                                                // echo "timer gone";
                                                echo "<div class=\"alert alert-warning mb-0\" role=\"alert\">
                                                        <h6>12 hours have passed please Notify the Admins. </br> we apologize for the inconvenience</h6>
                                                        </div>";
                                        }
                                        else{
                                                // echo "Timer still running";
                                        }

                                        ?>
                </div>
                
                <!-- <div class="clock_verification col-sm-8" style="margin:2em;"></div> -->
                <div class=" col-1 col-sm-1"></div>
        </div>
</div>
                <p>
                        Should The 5 Days Period End <br>
                        Without Being Approved Please Contact <br>
                        Loyola @ <a href="tel:0123456789">0123456789</a>
                </p>

                <div class="d-flex justify-content-around">
                        <a class="btn btn-primary text-white">Edit Profile</a>
                </div>
            </div>
        </div>
</section>