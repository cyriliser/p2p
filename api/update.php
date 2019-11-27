<?php
session_start();
require_once('../global_functions.php');
require_once('../config/config.php');
connect_to_db();
if(!security_check()) {
	// We are working with forms if we arrive at this page, might as well secure them
	$_SESSION['security_check'] = false;
	header("Location: $base_url/dashboard/update_details.php");
}
function validate_data($email,$username) {
	// check if username  or email is taken
	global $db_connection;
	$append = "Username '";
	$result = mysqli_query($db_connection,"select username from users where usernmae = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 2)
			return $append.$username."'";
	}
	$result = mysqli_query($db_connection,"select username from refs where username = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 2)
			return $append.$username."'";
	}
	// check if email is registered
	$append = "Email '";
	$result = mysqli_query($db_connection,"select email from users where email = '$email'");
	if($result){
		if(mysqli_num_rows($result) == 2)
			return $append.$email."'";
	}
	$result = mysqli_query($db_connection,"select email from refs where email = '$email'");
	if($result){
		if(mysqli_num_rows($result) == 2)
			return $append.$email."'";
	}
	return null;
}

//if (!is_reloaded()) {
  // If form submitted, insert values into the database.
  if (isset($_REQUEST['username'])){
    if(isset($_SESSION['form_data']))
      unset($_SESSION['form_data']);
      $_SESSION['form_data'] = $_POST;
      $username = $_REQUEST['username'];
      $email = $_REQUEST['email'];
      $valid = validate_data($email,$username);
      if($valid != null){
        $_SESSION['taken'] = $valid;
        header("Location: $base_url/dashboard/update_details.php");
        die();
      }
      $password = $_REQUEST['password'];
      $name = $_REQUEST['name'];
      $surname = $_REQUEST['surname'];
      $date = $_REQUEST['dob'];
      $cellno = $_REQUEST['cellphone'];
      $bank_name = $_REQUEST['bank'];
      $account_no = $_REQUEST['account_no'];
      $cellno2 = $_REQUEST['cellphone2'];
      $trn_date = date("Y-m-d H:i:s");
      $query = "UPDATE `users` SET username = '$username', email = '$email', password = '".md5($password)."', name = '$name', surname = '$surname', date_of_birth = '$date', contact_cell='$cellno', bank_name ='$bank_name', account_no='$account_no', linked_cell = '$cellno2' WHERE id='$user_id'";
    }
    $result = mysqli_query($db_connection,$query);
    if(!$result){
      $_SESSION['update_failed'] = true;
	  $_SESSION['error_msg'] = mysqli_error($db_connection);
      header("Location: $base_url/dashboard/update_details.php");
    }else{
      $_SESSION['update_successfull'] = true;
	  
	
      header("Location: $base_url/dashboard/index.php");
	  log_alert("successfuly updated",'success');
	  
    }
?>
