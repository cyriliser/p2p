<!-- Referrals -->
<?php
    // functions
?>

<section id="Referrals" class=" pt-3 px-1">
        <!-- <div class="my-5"></div> -->

        <div class="card bg-secondary text-white d-flex text-center">
            <h4 class="card-header">Referred Users</h4>

            <div class="card-body">
                <!-- <h6 class="car-title">Referred Users</h6> -->

                <div>
                    <?php
                        $sql_query = "SELECT * FROM users WHERE referrer_id=\"$user_details[id]\" ";
                        $referrals_result = mysqli_query($db_connection,$sql_query);
                        if (!$referrals_result) {
                            log_alert(mysql_error($db_connection));
                        } else {
                            while ($referral_details = mysqli_fetch_assoc($referrals_result)) {
                                require("sub_components/referral.php");
                            }
                        }
                        
                    ?>
                </div>

            </div>
        </div>