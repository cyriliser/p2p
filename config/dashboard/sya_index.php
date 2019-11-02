<!DOCTYPE html>
<?php 
    require_once('../config/config.php'); // has config options and db connection details
    require_once('../global_functions.php'); // has usefull functions
    connect_to_db(); //connects to database defined in global_funtions.php
    require_once('../login/auth.php');
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- styles -->
        <!-- bootstrap -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- flip clock -->
        <link rel="stylesheet" href="../assets/css/flipclock.css">
        <!-- main style sheet -->
        <link rel="stylesheet" href="../assets/css/style.css">

    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        
        <title>P2P | Dashboard</title>
    </head>

    <body>
        <!-- responses -->
        <?php 
            // pages with forms or that submit data will have that data processed here
            security_check();
            if (!is_reloaded()) {
                include('responses.php'); 
            }
        ?>
        
        <!-- header -->
        <div class="" id="dashboard-header">
            <?php include('navbar.php'); ?>     
        </div>

        <!-- body content -->
        <div class="container bg-secondary">
            <?php 
                if(isset($_SESSION['referenced'])) { //user has not payed referrer
                    $sql_query = "SELECT * FROM refs WHERE id='$user_id'";
                    $user_result = mysqli_query($db_connection,$sql_query);
                    if (!$user_result) { //if error
                        echo "<div class=\"alert alert-danger mt-5\" role=\"alert\">";
                            echo mysqli_error($db_connection);
                        echo "</div>";
                    }else { //include details to pay referrer
                        include('./components/pay_reference.php'); 
                    }
                }else { //user has payed referrer
                    $sql_query = "SELECT * FROM users WHERE id='$user_id'";
                    $user_result = mysqli_query($db_connection,$sql_query);
                    if (!$user_result) { //if error
                        echo "<div class=\"alert alert-danger mt-5\" role=\"alert\">";
                            echo mysqli_error($db_connection);
                        echo "</div>";
                    }else{ //include dashboard components
                        $user_details = mysqli_fetch_assoc($user_result);
                        $username = $user_details['username'];

                        //including dashboard components based on user status
                        switch($user_details['status']) {
                            case 0://if user needs to select package
                                include('./components/package_selection.php');
                                break;
                            case 1://if user needs to wait for verification
                                include('./components/verification.php'); 
                                break;
                            case 2://if user has been allocated to pay another user
                                include('./components/allocated_to_pay.php'); 
                                break;
                            case 3://if user has paid and is waiting for allocatiion to be paid
                                include('./components/wait_for_payment.php'); 
                                break;
                            case 4://if user has been allocated to recieve payment
                                include('./components/allocated_to_recieve.php'); 
                                break;
                            default:
                            
                        }

                        // including section containing ref link
                        require_once('./components/share_ref_link.php');
                        //past transactions
                        include('./components/past_transactions.php');
                    }
                }
                
            ?>
        </div>

        <!-- java script goes here -->
        <!-- jquery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- bootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- flip clock -->
        <script src="../assets/js/flipclock.min.js"></script>
        <script src="../assets/js/clock.js"></script>
        <!-- main js -->
        <script src="../assets/js/main.js"></script>
    </body>
</html>