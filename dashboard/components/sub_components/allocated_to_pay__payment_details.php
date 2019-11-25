<?php

$sub_transaction_details = mysqli_fetch_assoc($sub_transaction_result);
// get details about the recipient
$sql_query1 = "SELECT * FROM users WHERE id=\"$sub_transaction_details[recipient_id]\" ";
$recipient_result = mysqli_query($db_connection,$sql_query1);
if (!$recipient_result && sqli_num_rows() == 0) {
        log_alert(mysqli_error($db_connection),'error');
}else{
        $recipient_details = mysqli_fetch_assoc($recipient_result);
}
?>

<!-- <h3 class="card-header">allocated to pay</h3> -->
<div class="card-body">
<h5 class="card-title">Allocated To Pay:</h5>
<h1><?php echo "R".$sub_transaction_details['amount']; ?></h1>


<!-- status -->
<div class="status  px-1 ">
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
                        if ($sub_transaction_details['marked_as_recieved'] == 1) {
                                $check_recieved = "text-primary";
                        }
                        echo "<i class=\"fas fa-check-square $check_recieved fa-2x mr-5\"></i>" ;
                ?>
        </div>
        <div  class="my-1 d-flex justify-content-between w-100 border border-primary name">
                <strong class="mx-auto">Completed</strong>
                <?php
                        $check_complete ="";
                        if ($sub_transaction_details['status'] == "completed") {
                                $check_complete = "text-primary";
                        }
                        echo "<i class=\"fas fa-check-square $check_complete fa-2x mr-5\"></i>" ;
                ?>
        </div>   


        <!-- form start -->
        <div class="my-1 w-100 border border-primary cell">
                <?php 
                // log_alert($sub_transaction_details['marked_as_paid']);
                if ($sub_transaction_details['marked_as_paid'] == 1) {
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
                                        echo "<input type=\"hidden\" name=\"main_transaction_id\" value=\"$sub_transaction_details[main_transaction_id]\">";
                                        echo "<input type=\"checkbox\" name=\"mark_paid\" value=\"1\" class=\"custom-control-input\" id=\"customSwitch1\">";
                                        echo "<label class=\"custom-control-label\" for=\"customSwitch1\">Mark As Paid</label>";
                                ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mr-4 py-0">Submit</button>
                </form>

                <?php 
                if ($sub_transaction_details['marked_as_paid'] == 1) {
                        // if paid display received
                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 border border-primary \">
                                        <strong class=\"mx-auto\">Marked As Recieved</strong>
                                        <i class=\"fas fa-check-square text-primary fa-2x mr-5\"></i>
                                </div>";
                }
                ?>
        </div>
        <!-- form end -->

        <div style="border: solid #a49797 1px; display:none !important;" class="my-1 d-flex justify-content-between w-100 border border-primary name">
                <strong class="mx-auto">Cancelled</strong>
                <i class="fas fa-check-square fa-2x mr-5"></i>
        </div></div>


<!-- clock -->
<div>
        <div class="mt-3"><h3>Time Left To Pay:</h3></div>
        <div class="count-down row border border-primary mb-4">
                <!-- <div class=" col-1 col-sm-1"></div> -->
                
                <div class=" col-10 col-sm-8">
                        <?php
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

                        ?>
                </div>
                
                <!-- <div class="clock_verification col-sm-8" style="margin:2em;"></div> -->
                <div class=" col-1 col-sm-1"></div>
        </div>
</div>

<!-- recipient details -->
<div class="recipient-details border border-primary">
        <div class="row text-center px-auto"><h5 class="col-12">User Details</h5></div>
        <div class="row px-auto text-left">
                <p class="col-4 px-auto pr-0 mx-1">FullName</p><p class="col-1 px-0">:</p>
                <p class="col-6 pl-0 text-left"><?php echo $recipient_details['name']. "\t" .$recipient_details['surname']; ?></p>
        </div>
        <div class="row px-auto text-left">
                <p class="col-4 px-auto pr-0 mx-1">Contact No</p><p class="col-1  px-0">:</p>
                <p class="col-6 pl-0 text-left"><?php echo $recipient_details['contact_cell']; ?></p>
        </div>
        <div class="row px-auto text-left">
                <p class="col-4 px-auto pr-0 mx-1">Email</p><p class="col-1  px-0">:</p>
                <p class="col-6 pl-0 text-left"><?php echo $recipient_details['email']; ?></p>
        </div>
</div>

<!-- recipient banking details -->
<div class="recipient-details border border-primary mt-4">
        <div class="row text-center px-auto"><h5 class="col-12">bank Details</h5></div>
        <div class="row px-auto text-left">
                <p class="col-4 px-auto pr-0 mx-1">Bank Name</p><p class="col-1 px-0">:</p>
                <p class="col-6 pl-0 text-left"><?php echo $recipient_details['bank_name']; ?></p>
        </div>
        <div class="row px-auto text-left">
                <p class="col-4 px-auto pr-0 mx-1">Linked No</p><p class="col-1  px-0">:</p>
                <p class="col-6 pl-0 text-left"><?php echo $recipient_details['linked_cell']; ?></p>
        </div>
        <div class="row px-auto text-left">
                <p class="col-4 px-auto pr-0 mx-1">Account No</p><p class="col-1  px-0">:</p>
                <p class="col-6 pl-0 text-left"><?php echo $recipient_details['account_no']; ?></p>
        </div>
</div>
<!-- <div class="recipient-details d-flex justify-content-center">
        <div class="card">
                <ul class="list-group list-group-flush">
                        <li class="list-group-item">User Details</li> -->
                        <!-- <li class="list-group-item">username <span> : </span> username</li> -->
                        <!-- <li class="list-group-item">Full Name <span> : </span> <?php //echo $recipient_details['name']. "\t" .$recipient_details['surname']; ?></li>
                        <li class="list-group-item">Contact Cell No <span> : </span> <?php //echo $recipient_details['contact_cell']; ?></li>
                        <li class="list-group-item">Email <span> : </span> <?php //echo $recipient_details['email']; ?></li>
                </ul>
        </div>
        <div class="card">
                <ul class="list-group list-group-flush">
                        <li class="list-group-item">Bank Details</li>
                        <li class="list-group-item">Bank Name <span> : </span> <?php //echo $recipient_details['bank_name']; ?></li>
                        <li class="list-group-item">Lnked Cell No <span> : </span> <?php //echo $recipient_details['linked_cell']; ?></li>
                        <li class="list-group-item">Account No <span> : </span> <?php //echo $recipient_details['account_no']; ?></li>
                </ul>
        </div>


</div> -->