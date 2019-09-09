<?php
    require_once("../global_functions.php");
    require_once("admin_header.php"); 
    require_once("admin_nav.php");
?>


<!-- recievers -->
<section id="recievers" class="my-5">
    <div class="spacer1"></div>
    <h1 class="text-center">Select Reciever</h1>
    <div class="card text-center">
        <div class="card-body">
            <h4 class="card-title">reciever</h4>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
            <form action="<?php echo $admin_url?>/assign_select_payers.php" method="post">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                    <th>Select</th>
                    <th>UserName</th>
                    <th>Amount</th>
                    <th>Bank</th>
                    <th>Time Left</th>
                    <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            // get all pending main transactions
                            $query_info_main = "SELECT * FROM transactions WHERE status='pending'";
                            $result_info_main = mysqli_query($db_connection,$query_info_main);
                            if (!$result_info_main) {
                                echo log_alert($db_connection,"error");
                            } else {
                                while ($info_main_trans_details = mysqli_fetch_assoc($result_info_main)) {
                                    // get reciever details
                                    $query_info_user_rec = "SELECT * FROM users WHERE id=\"$info_main_trans_details[recipient_id]\" ";
                                    $result_info_user_rec = mysqli_query($db_connection,$query_info_user_rec);
                                    if (!$result_info_user_rec) {
                                        echo log_alert($db_connection,"error");
                                    } else {
                                        $info_rec_user_details = mysqli_fetch_assoc($result_info_user_rec);
                                        echo "
                                            <tr>
                                                <!-- <th scope=\"row\">1</th> -->
                                                <td>
                                                    <input type=\"radio\" name=\"selected_reciever\" value=\"$info_rec_user_details[id]\">
                                                </td>
                                                <td>$info_rec_user_details[username]</td>
                                                <td>$info_main_trans_details[total_return_amount]</td>
                                                <td>$info_rec_user_details[bank_name]</td>
                                                <td>6hrs</td>
                                                <td>
                                                    <button class=\"btn btn-secondary \">More</button>
                                                </td>
                                            </yr>
                                            ";
                                    }   
                                }
                            }

                        ?>
                </tbody>
            </table>
            <a href="<?php echo $admin_url; ?>/assign_info.php" class="btn btn-primary card-link">Back</a>
            <!-- <a href="<?php //echo $admin_url; ?>/assign_select_payers.php" class="btn btn-primary card-link">Next</a> -->
            <button type="submit" name="submit" value="selected_reciever" class="btn btn-primary card-link">Next</button>
            </form>
        </div>
    </div>
</section>



<?php
    require_once("admin_footer.php");
?>