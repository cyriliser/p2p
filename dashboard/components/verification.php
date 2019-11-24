<!-- verification/allocation Countdown -->
<section id="verification" class=" bg-primary mx-1 pt-3">
    <!-- <div class="my-5"></div> -->

    <div class="card bg-secondary text-white d-flex text-center">
        <h2 class="card-header">verification</h2>
        <div class="card-body ">
            <h5 class="card-title">Please Allow A Period Of 12hours or Less</h5>
            <h5 class="card-title">For Your Account To Be Approved</h5>
            <?php 
                // $twelve_hrs = 6000;
                // $twelve_hrs = 43200;
                // $db_time = 1566381518 ;
                // $current_time = time();
                // $time_left = $db_time + $twelve_hrs - $current_time;
                // echo "<div id=\"time_value\" style=\"display:none;\">". $time_left  . "</div>";
            ?>
            <!-- <div class="count-down row">
                <div class="col-sm-2"></div>
                <div class="clock_verification col-sm-8" style="margin:2em;"></div>
                <div class="col-sm-2"></div>
            </div> -->

            <div class="count-down row col-12 ">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <?php
                        $db_time = $user_details['reg_time'];
<<<<<<< HEAD
=======
                        // echo $db_time;
>>>>>>> master
                        if(countDown($db_time,12,true)){
                            echo "<div class=\"alert alert-warning\" role=\"alert\">
                                    <h1>12 hours have passed please Notify the Admins. </br> we apologize for the inconvenience</h1>
                                    </div>";
                        }
                        else{
                            echo "Timer still running";
                        }

                    ?>
                </div>
                <!-- <div class="clock_verification col-sm-8" style="margin:2em;"></div> -->
                <div class="col-sm-2"></div>
            </div>

            <p>
                Should The 12 Hour Period End <br>
                Without Being Approved Please Contact <br>
                Loyoala @ <a href="tel:0123456789">0123456789</a>
            </p>

            <div class="row  bg-primary text-white">
                <a class="btn btn-primary col-3 mx-auto my-auto hide">Edit Profile</a>

                <div class="col-12" >

                <form class="form-inline row pl-1" method="post">
                    <label class="col-6 pt-3 pl-1 ml-2 mb-0 " for="inlineFormInputName2"><p>Amount Invested:</p></label>
                    
                    <?php 
                        $sql_query = "SELECT * FROM packages where id=\"$user_details[selected_package]\"";
                        $packages_result = mysqli_query($db_connection,$sql_query);
                        if(!$packages_result){
                            log_alert(mysqli_error($db_connection),'error');
                        }
                        else{
                            $invested_amount = mysqli_fetch_assoc($packages_result)['amount'];
                            echo "
                            <input type=\"hidden\" name=\"user_id\" value=\"$user_details[id]\">
                            <input type=\"number\" max=\"5000\" min=\"500\" step=\"500\" name=\"new_investment_amount\" value=\"$invested_amount\" class=\"form-control col-4 my-auto\" id=\"inlineFormInputName2\" placeholder=\"500\" >";
                        }
                    ?>
                    <button type="submit" class="btn btn-secondary col-7 mx-auto mb-2">Change</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</section>