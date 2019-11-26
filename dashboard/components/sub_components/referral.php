
<div class="card bg-secondary text-white d-flex text-center">
    <h4 class="card-header"><?php echo $referral_details['name'];?></h4>

    <div class="card-body">
        <!-- <h6 class="car-title">Please Select Investment Amount</h6> -->

        <div>
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
                        <strong class="mx-auto">Marked As Paid</strong>
                        <?php
                                $check_paid ="";
                                if ($referral_details['reference_paid'] == 1) {
                                        $check_paid = "text-primary";
                                }
                                echo "<i class=\"fas fa-check-square $check_paid fa-2x mr-5\"></i>" ;
                        ?>
                </div>
                <div  class="my-1 d-flex justify-content-between w-100 border border-primary name">
                        <strong class="mx-auto">Completed</strong>
                        <?php
                                $check_complete ="";
                                if ($referral_details['reference_received'] == 1 and $referral_details['reference_paid'] == 1) {
                                        $check_complete = "text-primary";
                                }
                                echo "<i class=\"fas fa-check-square $check_complete fa-2x mr-5\"></i>" ;
                        ?>
                </div>   


                <!-- form start -->
                <div class="my-1 w-100 border border-primary cell">
                        <?php 
                        // log_alert($sub_transaction_details['marked_as_paid']);
                        if ($referral_details['reference_received'] == 1) {
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
                                                echo "<input type=\"hidden\" name=\"user_id\" value=\"$referral_details[id]\">";
                                                // echo "<input type=\"hidden\" name=\"main_transaction_id\" value=\"$sub_transaction_details[main_transaction_id]\">";
                                                echo "<input type=\"checkbox\" name=\"reference_paid\" value=\"1\" class=\"custom-control-input\" id=\"customSwitch$referral_details[id]\">";
                                                echo "<label class=\"custom-control-label\" for=\"customSwitch$referral_details[id]\">Mark As Received</label>";
                                        ?>
                                </div>
                                <button type="submit" name="received_submit" value="reference_received" class="btn btn-primary btn-sm mr-4 py-0">Submit</button>
                        </form>

                        <?php 
                        if ($referral_details['reference_received'] == 1) {
                                // if paid display received
                                echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 border border-primary \">
                                                <strong class=\"mx-auto\">Marked As Received</strong>
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
                    <div class="row text-center px-auto"><h5 class="col-12"> Details</h5></div>
                    <div class="row px-auto text-left">
                            <p class="col-4 px-auto pr-0 mx-1">FullName</p><p class="col-1 px-0">:</p>
                            <p class="col-6 pl-0 text-left"><?php echo $referral_details['name']. "\t" .$referral_details['surname']; ?></p>
                    </div>
                    <div class="row px-auto text-left">
                            <p class="col-4 px-auto pr-0 mx-1">Contact No</p><p class="col-1  px-0">:</p>
                            <p class="col-6 pl-0 text-left"><?php echo $referral_details['contact_cell']; ?></p>
                    </div>
                    <div class="row px-auto text-left">
                            <p class="col-4 px-auto pr-0 mx-1">Email</p><p class="col-1  px-0">:</p>
                            <p class="col-6 pl-0 text-left"><?php echo $referral_details['email']; ?></p>
                    </div>
            </div>

        </div>
    </div>
</div>