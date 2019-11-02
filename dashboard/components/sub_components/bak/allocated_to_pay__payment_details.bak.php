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
<div class="status d-flex justify-content-around">

        <div style="border: solid #a49797 3px;" class="w-100 username" ><Strong>Status</Strong></div>
        <div style="border: solid #a49797 3px;" class="w-100 name">Pending</div>
        <div style="border: solid #a49797 3px;" class="w-100 cell">
                <?php 
                // log_alert($sub_transaction_details['marked_as_paid']);
                if ($sub_transaction_details['marked_as_paid'] == 1) {
                        // if markrd as paid hide form
                        echo "<form action=\"\" method=\"post\" class=\"d-flex\" style=\"display:none !important;\">  ";
                }
                else {
                        // if not paid display form
                        echo "<form action=\"\" method=\"post\" class=\"d-flex\"> ";
                }
                ?>
                        <div class="custom-control custom-switch">
                                <?php 
                                        echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_details[id]\">";
                                        echo "<input type=\"hidden\" name=\"main_transaction_id\" value=\"$sub_transaction_details[main_transaction_id]\">";
                                        echo "<input type=\"checkbox\" name=\"mark_paid\" value=\"1\" class=\"custom-control-input\" id=\"customSwitch1\">";
                                        echo "<label class=\"custom-control-label\" for=\"customSwitch1\">Mark As Paid</label>";
                                ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>

                <?php 
                if ($sub_transaction_details['marked_as_paid'] == 1) {
                        // if paid display received
                        echo "<div style=\"border: solid #a49797 3px;\" class=\"w-100 \">Marked As Recieved</div>";
                }
                ?>
        </div>
        <div style="border: solid #a49797 3px;" class="w-100 surname">Marked As Recieved</div>
        <div style="border: solid #a49797 3px;" class="w-100 email">Completed</div>
        <div style="border: solid #a49797 3px;" class="w-100 bankname">Cancelled</div>
</div>

<!-- clock -->
<div>
        <div class="mt-3"><h1>Time Left To Pay:</h1></div>
        <div class="count-down row">
        <div class="col-sm-2"></div>
                <div class="col-sm-8">
                        <?php
                        $db_time = $sub_transaction_details['time_assigned'];
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