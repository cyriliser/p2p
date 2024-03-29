<?php 
    require_once('config/config.php');

    //connects to database using parameters in the /config/config.php file and return true for success and false if failed to connect
    function connect_to_db(){
        global $dbname, $dbhost, $dbuser, $dbpass, $db_connection;

        $db_connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

        if (!$db_connection) {
            // TO DO: if error write error to log file
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            return false;
        }
        // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
        // echo "Host information: ".mysqli_get_host_info($db_connection).PHP_EOL;
        return true; // This should return the link to the db connection
    }

    function log_alert($message,$type = "info"){
        switch ($type) {
            case 'error':
                $type = 'danger';
                break;
            case 'info':
                $type = 'info';
                break;
            case 'secondary':
                $type = 'seconday';
                break;
            case 'success':
                $type = 'success';
                break;
            case 'warning':
                $type = 'warning';
                break; 
            case 'primary':
                $type = 'primary';
                break;
            default:
                $type = 'primary';
                break;
        }
        // echo "<div class=\"fixed-bottom alert alert-dismissible fade show alert-$type\" role=\"alert\">";
        //     echo $message;
        // echo "</div>";
    }


    function log_alert1($message,$type = "info"){
        switch ($type) {
            case 'error':
                $type = 'danger';
                break;
            case 'info':
                $type = 'info';
                break;
            case 'secondary':
                $type = 'seconday';
                break;
            case 'success':
                $type = 'success';
                break;
            case 'warning':
                $type = 'warning';
                break; 
            case 'primary':
                $type = 'primary';
                break;
            default:
                $type = 'primary';
                break;
        }
        echo "<div class=\"fixed-bottom alert alert-dismissible fade show alert-$type\" role=\"alert\">";
            echo $message;
        echo "</div>";
    }

    function count_investments($user_id){
        global $db_connection;
        $sql_query = "SELECT COUNT(*) FROM transactions WHERE recipient_id=\"$user_id\" ";
        $result = mysqli_query($db_connection,$sql_query);
        return mysqli_fetch_array($result)[0];
    }

    function security_check(){
        global $db_connection;

        foreach ($_POST as $key => $value) {
            if (gettype($value) == "array") {
                // is an array
                echo "array";
                foreach ($value as $sub_key => $sub_value) {
                    $sub_value = mysqli_real_escape_string($db_connection,$sub_value);
                    $sub_value = addslashes($sub_value);
                    $value[$sub_key] =  $sub_value;
                    $_POST[$key] =  $value;
                }
            } else {
                // not an array
                if(empty($value)){
                    return false;
                }
                $value = mysqli_real_escape_string($db_connection,$value);
                $value = addslashes($value);
                $_POST[$key] =  $value;
            }
            
        }
        
        foreach ($_GET as $key => $value) {
            if (gettype($value) == "array") {
                // is an array
                echo "array";
                foreach ($value as $sub_key => $sub_value) {
                    $sub_value = mysqli_real_escape_string($db_connection,$sub_value);
                    $sub_value = addslashes($sub_value);
                    $value[$sub_key] =  $sub_value;
                    $_GET[$key] =  $value;
                }
            } else {
                // not an array
                if(empty($value)){
                    return false;
                }
                $value = mysqli_real_escape_string($db_connection,$value);
                $value = addslashes($value);
                $_GET[$key] =  $value;
            }
            
        }
        foreach ($_REQUEST as $key => $value) {
            if (gettype($value) == "array") {
                // is an array
                echo "array";
                foreach ($value as $sub_key => $sub_value) {
                    $sub_value = mysqli_real_escape_string($db_connection,$sub_value);
                    $sub_value = addslashes($sub_value);
                    $value[$sub_key] =  $sub_value;
                    $_REQUEST[$key] =  $value;
                }
            } else {
                // not an array
                if(empty($value)){
                    return false;
                }
                $value = mysqli_real_escape_string($db_connection,$value);
                $value = addslashes($value);
                $_REQUEST[$key] =  $value;
            }
            
        }
        return true;
    }

    function countDown($time,$hours,$showClock) {
        // This function return true or false. true if count down has run out
        $db_time = ($time + ($hours*3600));
        $current_time = time();
        $time_left = $db_time - $current_time;
        // echo $current_time; 
        if($showClock) {
            if($time_left <= 0){
                return true;
            }else{
                // echo "showing";
                echo '
                    <div class="clock" style="margin:2em;"></div>
                    
                    <script type="text/javascript">
                        var clock;
                        $(document).ready(function() {
                            // Calculate the difference in seconds between the future and current date
                            var diff = '.$db_time.' - '.$current_time.';
                            // Instantiate a coutdown FlipClock
                            clock = $(\'.clock\').FlipClock(diff, {
                                clockFace: \'DailyCounter\',
                                countdown: true,
                                showSeconds: true
                            });
                        });
                    </script>';
                    }
            return false;
        }
    }

    function calc_time_left($db_time,$total_time){
        $db_time = ($db_time + ($total_time*3600));
        $time_left = $db_time -  time(); 
        return $time_left;
    }

    function is_reloaded(){

        // $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
        // if($is_page_refreshed ) {
        //     return !true;
        // } else {
        //     return false;
        // }
    }
?>