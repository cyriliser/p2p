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

<h1 class="card-header">allocated to pay</h1>
<div class="card-body">
<h3 class="card-title">Payment Details For Pending Allocation of:</h3>
<h1><?php echo $sub_transaction_details['amount']; ?></h1>


<!-- status -->
<div class="status border px-1 ">
        <div style="border: solid #a49797 1px;" class="bg-primary my-1 text-center w-100 username" >
                <h5>Status</h5>
        </div>
        <div style="border: solid #a49797 1px;" class="my-1 d-flex justify-content-between w-100 name">
                <strong class="mx-auto">Pending</strong>
                <i class="fas fa-check-square text-primary fa-2x mr-5"></i>
        </div>

        <!-- form start -->
        <div style="border: solid #a49797 1px;" class="my-1 w-100 cell">
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
                        echo "  <div style=\"border: solid #a49797 1px;\" class=\"my-1 d-flex justify-content-between w-100 \">
                                        <strong class=\"mx-auto\">Marked As Recieved</strong>
                                        <i class=\"fas fa-check-square text-primary fa-2x mr-5\"></i>
                                </div>";
                }
                ?>
        </div>
        <!-- form end -->

        <div style="border: solid #a49797 1px;" class="my-1 d-flex justify-content-between w-100 name">
                <strong class="mx-auto">Marked as Received</strong>
                <?php
                        $check_recieved ="";
                        if ($sub_transaction_details['marked_as_recieved'] == 1) {
                                $check_recieved = "text-primary";
                        }
                        echo "<i class=\"fas fa-check-square $check_recieved fa-2x mr-5\"></i>" ;
                ?>
        </div>
        <div style="border: solid #a49797 1px;" class="my-1 d-flex justify-content-between w-100 name">
                <strong class="mx-auto">Completed</strong>
                <?php
                        $check_complete ="";
                        if ($sub_transaction_details['status'] == "completed") {
                                $check_complete = "text-primary";
                        }
                        echo "<i class=\"fas fa-check-square $check_complete fa-2x mr-5\"></i>" ;
                ?>
        </div>        
        <div style="border: solid #a49797 1px; display:none !important;" class="my-1 d-flex justify-content-between w-100 name">
                <strong class="mx-auto">Cancelled</strong>
                <i class="fas fa-check-square fa-2x mr-5"></i>
        </div></div>

<!-- clock -->
<div>
        <?php 
                // $twelve_hrs = 6000;
                $twelve_hrs = 43200;
                $db_time = 1566381518 ;
                $current_time = time();
                $time_left = $db_time + $twelve_hrs - $current_time;
                echo "<div id=\"time_value\" style=\"display:none;\">". $time_left  . "</div>";
        ?>

        <div class="mt-3"><h1>Time Left To Pay:</h1></div>
        <div class="count-down row">
                <div class="col-sm-2"></div>
                <div class="clock_verification col-sm-8" style="margin:2em;"></div>
                <div class="col-sm-2"></div>
        </div>
</div>

<!-- recipient details -->
<div class="recipient-details d-flex justify-content-center">
        <div class="card">
                <ul class="list-group list-group-flush">
                        <li class="list-group-item">User Details</li>
                        <!-- <li class="list-group-item">username <span> : </span> username</li> -->
                        <li class="list-group-item">Full Name <span> : </span> <?php echo $recipient_details['name']. "\t" .$recipient_details['surname']; ?></li>
                        <li class="list-group-item">Contact Cell No <span> : </span> <?php echo $recipient_details['contact_cell']; ?></li>
                        <li class="list-group-item">Email <span> : </span> <?php echo $recipient_details['email']; ?></li>
                </ul>
        </div>
        <div class="card">
                <ul class="list-group list-group-flush">
                        <li class="list-group-item">Bank Details</li>
                        <li class="list-group-item">Bank Name <span> : </span> <?php echo $recipient_details['bank_name']; ?></li>
                        <li class="list-group-item">Lnked Cell No <span> : </span> <?php echo $recipient_details['linked_cell']; ?></li>
                        <li class="list-group-item">Account No <span> : </span> <?php echo $recipient_details['account_no']; ?></li>
                </ul>
        </div>


</div>