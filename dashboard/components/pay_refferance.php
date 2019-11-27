<!-- Allocated to pay section -->
<section id="allocated-to-pay" class="bg-primary mx-2 pt-3">
        <!-- <div class="my-5"></div> -->
           
        <div class="card bg-secondary text-white d-flex text-center">

                <?php 
                        //get referrer details 
                        $sql_query = "SELECT * FROM users WHERE id=\"$user_details[referrer_id]\" ";
                        $referrer_result = mysqli_query($db_connection,$sql_query);
                        // log_alert("error");
                        if (!$referrer_result) {
                                // log_alert("error");
                                log_alert(mysqli_error($db_connection),'error');
                        }else{
                            $referrer_details = mysqli_fetch_assoc($referrer_result);
                            echo "
                                <h1 class=\"card-header\">Referral Fee</h1>
                                <div class=\"card-body\">
                                <h5 class=\"card-title\"> Please pay <strong>$referrer_details[username]</strong> R50</h5>
                                <h6>For Your Account To Be Activated</h6>
                                ";
                            ?>

                                <!-- status start -->
                                <div class="status  px-1  border border-primary my-4" >
                                    <div  style="border: solid #a49797 1px;"  class="bg-primary my-1 text-center w-100 username" >
                                            <h5>Status</h5>
                                    </div>
                                    <div  class="my-1 d-flex justify-content-between w-100 border border-primary name">
                                            <strong class="mx-auto">Pending</strong>
                                            <i class="fas fa-check-square text-primary fa-2x mr-5"></i>
                                    </div>


                                    <div  class="my-1 d-flex justify-content-between w-100 border border-primary name">
                                            <strong class="mx-auto">Marked As Received</strong>
                                            <?php
                                                    $check_recieved ="";
                                                    if ($user_details['reference_received'] == 1) {
                                                            $check_recieved = "text-primary";
                                                    }
                                                    echo "<i class=\"fas fa-check-square $check_recieved fa-2x mr-5\"></i>" ;
                                            ?>
                                    </div>
                                    <div  class="my-1 d-flex justify-content-between w-100 border border-primary name">
                                            <strong class="mx-auto">Completed</strong>
                                            <?php
                                                    $check_complete ="";
                                                    if ($user_details['reference_received'] == 1 and $user_details['reference_paid'] == 1) {
                                                            $check_complete = "text-primary";
                                                    }
                                                    echo "<i class=\"fas fa-check-square $check_complete fa-2x mr-5\"></i>" ;
                                            ?>
                                    </div>   


                                    <!-- form start -->
                                    <div class="my-1 w-100 border border-primary cell">
                                            <?php 
                                            // log_alert($sub_transaction_details['marked_as_paid']);
                                            if ($user_details['reference_paid'] == 1) {
                                                    // if markrd as paid hide form
                                                    echo "<form action=\"\" method=\"post\" class=\"d-flex\" style=\"display:none !important;\">  ";
                                            }
                                            else {
                                                    // if not paid display form
                                                    echo "<form action=\"\" method=\"post\" class=\"d-flex justify-content-between\"> ";
                                            }
                                            ?>
                                                    <div class="custom-control custom-switch mx-auto">
                                                            <?php 
                                                                    echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_details[id]\">";
                                                                    // echo "<input type=\"hidden\" name=\"main_transaction_id\" value=\"$sub_transaction_details[main_transaction_id]\">";
                                                                    echo "<input type=\"checkbox\" name=\"reference_received\" value=\"1\" class=\"custom-control-input\" id=\"customSwitch1\">";
                                                                    echo "<label class=\"custom-control-label\" for=\"customSwitch1\">Mark As Paid</label>";
                                                            ?>
                                                    </div>
                                                    <button type="submit" name="paid_submit" value="reference_paid" class="btn btn-primary btn-sm mr-4 py-0">Submit</button>
                                            </form>

                                            <?php 
                                            if ($user_details['reference_paid'] == 1) {
                                                    // if paid display received
                                                    echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 border border-primary \">
                                                                    <strong class=\"mx-auto\">Marked As paid</strong>
                                                                    <i class=\"fas fa-check-square text-primary fa-2x mr-5\"></i>
                                                            </div>";
                                            }
                                            ?>
                                    </div>
                                    <!-- form end -->

                                    <div style="border: solid #a49797 1px; display:none !important;" class="my-1 d-flex justify-content-between w-100 border border-primary name">
                                            <strong class="mx-auto">Cancelled</strong>
                                            <i class="fas fa-check-square fa-2x mr-5"></i>
                                    </div>
                                </div>

                                <!-- referrer details -->
                                <div class="referrer-details border border-primary">
                                        <div class="row text-center px-auto"><h5 class="col-12">referrer Details</h5></div>
                                        <div class="row px-auto text-left">
                                                <p class="col-4 px-auto pr-0 mx-1">FullName</p><p class="col-1 px-0">:</p>
                                                <p class="col-6 pl-0 text-left"><?php echo $referrer_details['name']. "\t" .$referrer_details['surname']; ?></p>
                                        </div>
                                        <div class="row px-auto text-left">
                                                <p class="col-4 px-auto pr-0 mx-1">Contact No</p><p class="col-1  px-0">:</p>
                                                <p class="col-6 pl-0 text-left"><?php echo $referrer_details['contact_cell']; ?></p>
                                        </div>
                                        <div class="row px-auto text-left">
                                                <p class="col-4 px-auto pr-0 mx-1">Email</p><p class="col-1  px-0">:</p>
                                                <p class="col-6 pl-0 text-left"><?php echo $referrer_details['email']; ?></p>
                                        </div>
                                </div>
                                
                                <!-- referrer banking details -->
                                <div class="recipient-details border border-primary mt-4">
                                        <div class="row text-center px-auto"><h5 class="col-12">bank Details</h5></div>
                                        <div class="row px-auto text-left">
                                                <p class="col-4 px-auto pr-0 mx-1">Bank Name</p><p class="col-1 px-0">:</p>
                                                <p class="col-6 pl-0 text-left"><?php echo $referrer_details['bank_name']; ?></p>
                                        </div>
                                        <div class="row px-auto text-left">
                                                <p class="col-4 px-auto pr-0 mx-1">Linked No</p><p class="col-1  px-0">:</p>
                                                <p class="col-6 pl-0 text-left"><?php echo $referrer_details['linked_cell']; ?></p>
                                        </div>
                                        <div class="row px-auto text-left">
                                                <p class="col-4 px-auto pr-0 mx-1">Account No</p><p class="col-1  px-0">:</p>
                                                <p class="col-6 pl-0 text-left"><?php echo $referrer_details['account_no']; ?></p>
                                        </div>
                                </div>




                                <?php
                                // require_once("sub_components/allocated_to_pay__payment_details.php");
                                // log_alert("no error");
                                // log_alert($sub_transaction_details['id']);
                        }
                ?>

        </div>
</section>