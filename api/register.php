<?php
session_start();
require_once('../global_functions.php');
require_once('../config/config.php');
connect_to_db();
if(!security_check()) {
	// We are working with forms if we arrive at this page, might as well secure them
	$_SESSION['security_check'] = false;
	header("Location: $base_url/login/registration.php");
}
function validate_data($email,$username) {
	// check if username  or email is taken
	global $db_connection;
	$append = "Username '";
	$result = mysqli_query($db_connection,"select username from users where usernmae = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $append.$username."'";
	}
	$result = mysqli_query($db_connection,"select username from refs where username = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $append.$username."'";
	}
	// check if email is registered
	$append = "Email '";
	$result = mysqli_query($db_connection,"select email from users where email = '$email'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $append.$email."'";
	}
	$result = mysqli_query($db_connection,"select email from refs where email = '$email'");
	if($result){
		if(mysqli_num_rows($result) == 1)
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
    if(isset($_SESSION['ref'])) {
      /********Save data to references table*******/
      // add backslashes
      $username = $_REQUEST['username'];
      $email = $_REQUEST['email'];
      $valid = validate_data($email,$username);
      if($valid != null) {
      $_SESSION['taken'] = $valid;
      header("Location: $base_url/login/registration.php");		
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
      $query = "INSERT into refs (username, email, password, name, surname, date_of_birth, contact_cell, bank_name, account_no, linked_cell,referer_id) 
                VALUES ('$username', '$email', '".md5($password)."', '$name', '$surname', '$date','$cellno', '$bank_name', '$account_no', '$cellno2','".$_SESSION['ref']."')";
    }else{
      $username = $_REQUEST['username'];
      $email = $_REQUEST['email'];
      $valid = validate_data($email,$username);
      if($valid != null){
        $_SESSION['taken'] = $valid;
        header("Location: $base_url/login/registration.php");
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
      $query = "INSERT into `users` (username, email, password, name, surname, date_of_birth, contact_cell, bank_name, account_no, linked_cell, selected_package, status, reg_time)
        VALUES ('$username', '$email', '".md5($password)."', '$name', '$surname', '$date','$cellno', '$bank_name', '$account_no', '$cellno2',NULL,0,'".time()."')";
    }
    $result = mysqli_query($db_connection,$query);
    if(!$result){
      $_SESSION['registration_failed'] = true;
      header("Location: $base_url/login/registration.php");
    }else{
      $_SESSION['registration_successfull'] = true;
      header("Location: $base_url/login/login.php");
    }
  //}
}
//header("Location: $base_url/login/registration.php");
?>
