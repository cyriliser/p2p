<!-- wait for payment section -->
<section id="wait-for-payment" class="min-vh-100 mt-5 pt-3">
        <div class="my-5"></div>
                   
        <div class="card  d-flex text-center">
        <h1 class="card-header">Wait For Allocation</h1>
        <div class="card-body">
                <h4 class="card-title">Please Allow A Period Of 5days or Less</h4>
                <h4 class="card-title">To Be Allocated Someone To Pay You</h4>

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
                <?php 
                        // $twelve_hrs = 6000;
                        $five_days = 432000;
                        $db_time = 1566381518 ;
                        $current_time = time();
                        $time_left = $db_time + $five_days - $current_time;
                        echo "<div id=\"time_value\" style=\"display:none;\">". $time_left  . "</div>";
                ?>
                <div class="count-down row">
                        <div class="col-sm-2"></div>
                        <div class="clock-allocation col-sm-8" style="margin:2em;"></div>
                        <div class="col-sm-2"></div>
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