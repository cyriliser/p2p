<!-- past Transactions -->
<section id="past-transactions" class="min-vh-100 mt-5 pt-3">
    <div class="my-5"></div>
    
    <div class="card d-flex text-center">
        <h1 class="card-title">past Transactions</h1>
        <div class="card-body">

        <div class="past-transactions">
            <!-- column titles -->
            <div class="row mb-1 border border-secondary">
                <div class="col-1 px-0">#</div>
                <div class="col-2 px-0">Type</div>
                <div class="col-2 px-0">UserName</div>
                <div class="col-2 px-0">Amount</div>
                <div class="col-2 px-0">Status</div>
                <div class="col-2 px-0">Details</div>
            </div>

            <!-- past transaction entries -->
            <?php 

                $amount_paid = 0;
                $amount_recieved = 0;
                $total_earnings = 0;
                // get transactions where user was recieving
                $sql_pt_received = "SELECT * FROM transactions WHERE recipient_id=\"$user_id\" and status!=\"pending\"";
                $result_pt_recieved = mysqli_query($db_connection,$sql_pt_received);
                if (!$result_pt_recieved) {
                    log_alert(mysqli_error());
                }
                // get transactions where user was paying
                $sql_pt_paid = "SELECT * FROM sub_transactions WHERE recipient_id=\"$user_id\" and status!=\"pending\" ";
                $result_pt_paid = mysqli_query($db_connection,$sql_pt_paid);
                if (!$result_pt_paid) {
                    log_alert(mysqli_error());
                }

                // print transactions where user was recieving
                while ($recieved_trans_details = mysqli_fetch_assoc($result_pt_recieved)) {
                    echo "
                        <div class=\"row mb-1 border\">
                            <div class=\"col-1 px-0 py-1\" scope=\"row\">$recieved_trans_details[id]</div>
                            <div class=\"col-2 px-0 py-1\">Recieved</div>
                            <div class=\"col-2 px-0 py-1\">user 1</div>
                            <div class=\"col-2 px-0 py-1\">R$recieved_trans_details[recieved_amount]</div>
                            <div class=\"col-2 px-0 py-1\">$recieved_trans_details[status]</div>
                            <div class=\"col-3 \"><a href=\"#!\" class=\"btn btn-secondary btn-sm px-0 py-0\">Details</a></div>
                        </div>
                    ";

                    $amount_recieved += $recieved_trans_details['recieved_amount'];
                }

                // print transactions where user was paying
                while ($paid_trans_details = mysqli_fetch_assoc($result_pt_paid)) {
                    echo "
                        <div class=\"row mb-1 border \">
                            <div class=\"col-1  px-0 py-1\"  scope=\"row\">$paid_trans_details[id]</div>
                            <div class=\"col-2  px-0 py-1\" >paid</div>
                            <div class=\"col-2  px-0 py-1\" >user 1</div>
                            <div class=\"col-2  px-0 py-1\" >R$paid_trans_details[amount]</div>
                            <div class=\"col-2  px-0 py-1\" >$paid_trans_details[status]</div>
                            <div class=\"col-3\" ><a href=\"#!\" class=\"btn btn-secondary btn-sm px-0 py-0\">Details</a></div>
                        </div>
                    ";

                    $amount_paid += $paid_trans_details['amount'];
                }

                $total_earnings = $amount_recieved - $amount_paid;
            ?>
        </div>
            
        <table class="table table-striped hide">
            <thead>
                <tr>
                <th>#</th>
                <th>Type</th>
                <th>UserName</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $amount_paid = 0;
                    $amount_recieved = 0;
                    $total_earnings = 0;
                    // get transactions where user was recieving
                    $sql_pt_received = "SELECT * FROM transactions WHERE recipient_id=\"$user_id\" and status!=\"pending\"";
                    $result_pt_recieved = mysqli_query($db_connection,$sql_pt_received);
                    if (!$result_pt_recieved) {
                        log_alert(mysqli_error());
                    }
                    // get transactions where user was paying
                    $sql_pt_paid = "SELECT * FROM sub_transactions WHERE recipient_id=\"$user_id\" and status!=\"pending\" ";
                    $result_pt_paid = mysqli_query($db_connection,$sql_pt_paid);
                    if (!$result_pt_paid) {
                        log_alert(mysqli_error());
                    }

                    // print transactions where user was recieving
                    while ($recieved_trans_details = mysqli_fetch_assoc($result_pt_recieved)) {
                        echo "
                            <tr>
                                <td scope=\"row\">$recieved_trans_details[id]</td>
                                <td>Recieved</td>
                                <td>user 1</td>
                                <td>R$recieved_trans_details[recieved_amount]</td>
                                <td>$recieved_trans_details[status]</td>
                                <td><a href=\"#!\" class=\"btn btn-secondary\">Details</a></td>
                            </tr>
                        ";

                        $amount_recieved += $recieved_trans_details['recieved_amount'];
                    }

                    // print transactions where user was paying
                    while ($paid_trans_details = mysqli_fetch_assoc($result_pt_paid)) {
                        echo "
                            <tr>
                                <td scope=\"row\">$paid_trans_details[id]</td>
                                <td>paid</td>
                                <td>user 1</td>
                                <td>R$paid_trans_details[amount]</td>
                                <td>$paid_trans_details[status]</td>
                                <td><a href=\"#!\" class=\"btn btn-secondary\">Details</a></td>
                            </tr>
                        ";

                        $amount_paid += $paid_trans_details['amount'];
                    }

                    $total_earnings = $amount_recieved - $amount_paid;
                ?>
                
            </tbody>
        </table>

        <div>
            <?php 
                echo "
                    <h1>Amount Paid <span class=\"badge badge-secondary\">R$amount_paid</span></h1>
                    <h1>Amount received <span class=\"badge badge-secondary\">R$amount_recieved</span></h1>
                    <h1>Total Earnings <span class=\"badge badge-secondary\">R$total_earnings</span></h1>
                ";
            ?>
            
        </div>

        </div>
    </div>

</section>
