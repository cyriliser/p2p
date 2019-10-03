<!-- verification/allocation Countdown -->
<section id="verification" class="min-vh-100 mt-5 pt-3">
    <div class="my-5"></div>
    
    <div class="card  d-flex text-center">
        <h1 class="card-header">verification</h1>
        <div class="card-body">
            <h4 class="card-title">Please Allow A Period Of 12hours or Less</h4>
            <h4 class="card-title">For Your Account To Be Approved</h4>

            <div class="count-down row col-12">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <?php
                        $db_time = $user_details['reg_time'];
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

            <div class="d-flex justify-content-around">
                <a class="btn btn-primary">Edit Profile</a>

                <div class="d-flex" >
                <form class="form-inline" method="post">
                    <label class="mb-2" for="inlineFormInputName2"><h3>Amount Invested: </h3></label>
                    
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
                            <input type=\"number\" max=\"5000\" min=\"500\" step=\"500\" name=\"new_investment_amount\" value=\"$invested_amount\" class=\"form-control mb-2 mr-sm-2 ml-2\" id=\"inlineFormInputName2\" placeholder=\"500\">";
                        }
                    ?>
                    <button type="submit" class="btn btn-primary mb-2">Change</button>
                </form>

                </div>
            </div>
        </div>
    </div>
</section>