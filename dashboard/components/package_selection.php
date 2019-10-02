<!-- packages Selection -->
<section id="package-selection" class="min-vh-100 mt-5 pt-3">
        <div class="my-5"></div>

        <div class="card d-flex text-center">
                <h1 class="card-header">Package Selection</h1>

                <div class="card-body">
                        <h4 class="car-title">Please Select Investment Amount</h4>
                        <!-- package Selection form -->
                        <form class="card" action="" method="post" >
                                <!-- row 1 -->
                                <div class="form-group row d-flex text-center justify-content-around">
                                        <?php
                                                $sql_query = "SELECT * FROM packages";
                                                $packages_result = mysqli_query($db_connection,$sql_query);
                                                if(!$packages_result){
                                                        log_alert(mysqli_error($db_connection));
                                                }

                                                while ($package = mysqli_fetch_assoc($packages_result)) {
                                                        echo "
                                                                <div class=\"custom-control custom-radio col-sm-1 bg-info text-white mx-1\">
                                                                        <input type=\"hidden\" name=\"user_id\" value=\"$user_details[id]\">
                                                                        <input type=\"radio\" id=\"$package[id]\" value=\"$package[id]\" name=\"selected_package\" class=\"custom-control-input\">
                                                                        <label class=\"custom-control-label\" for=\"$package[id]\">R$package[amount]</label>
                                                                </div>
                                                        ";
                                                
                                                }
                                        ?>
                                </div>

                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </form>

                </div>
    </div>

</section>
