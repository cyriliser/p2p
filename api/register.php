<?php
session_start();
require_once('../global_functions.php');
require_once('../config/config.php');
connect_to_db();
security_check();

function validate_data($email,$username) {
	// check if username is taken
	global $db_connection;
	$result = mysqli_query($db_connection,"select username from users where usernmae = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $username;
	}
	$result = mysqli_query($db_connection,"select username from refs where username = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $username;
	}
	// check if email is registered
	$result = mysqli_query($db_connection,"select email from users where email = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $username;
	}
	$result = mysqli_query($db_connection,"select email from refs where email = '$username'");
	if($result){
		if(mysqli_num_rows($result) == 1)
			return $username;
	}
}
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
  if(isset($_SESSION['ref'])) {
    /********Save data to references table*******/
    // add backslashes
 	 $username = addslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($db_connection,$username); 
    $email = addslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($db_connection,$email);
    $valid = validate_data($email,$username);
    if($valid != "") {
		$_SESSION['taken'] = $valid;
		header("Location: $base_url/login/registration.php");
 	 }
    $password = addslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db_connection,$password);
    $name = addslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($db_connection,$name);
    $surname = addslashes($_REQUEST['surname']);
    $surname = mysqli_real_escape_string($db_connection,$surname);
    $date = addslashes($_REQUEST['dob']);
    $date = mysqli_real_escape_string($db_connection,$date);
    $cellno = addslashes($_REQUEST['cellphone']);
    $cellno = mysqli_real_escape_string($db_connection,$cellno);
    $bank_name = addslashes($_REQUEST['bank']);
    $bank_name = mysqli_real_escape_string($db_connection,$bank_name);
    $account_no = addslashes($_REQUEST['account_no']);
    $account_no = mysqli_real_escape_string($db_connection,$account_no);
    $cellno2 = addslashes($_REQUEST['cellphone2']);
    $cellno2 = mysqli_real_escape_string($db_connection,$cellno2);
    $trn_date = date("Y-m-d H:i:s");
    $query = "INSERT into refs (username, email, password, name, surname, date_of_birth, contact_cell, bank_name, account_no, linked_cell,referer_id) 
              VALUES ('$username', '$email', '".md5($password)."', '$name', '$surname', '$date','$cellno', '$bank_name', '$account_no', '$cellno2','".$_SESSION['ref']."')";
  }else{
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($db_connection,$username); 
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($db_connection,$email);
    $valid = validate_data($email,$username);
    if($valid != "") {
      $_SESSION['taken'] = $valid;
      header("Location: $base_url/login/registration.php");
    }

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db_connection,$password);
    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($db_connection,$name);
    $surname = stripslashes($_REQUEST['surname']);
    $surname = mysqli_real_escape_string($db_connection,$surname);
    $date = stripslashes($_REQUEST['dob']);
    $date = mysqli_real_escape_string($db_connection,$date);
    $cellno = stripslashes($_REQUEST['cellphone']);
    $cellno = mysqli_real_escape_string($db_connection,$cellno);
    $bank_name = stripslashes($_REQUEST['bank']);
    $bank_name = mysqli_real_escape_string($db_connection,$bank_name);
    $account_no = stripslashes($_REQUEST['account_no']);
    $account_no = mysqli_real_escape_string($db_connection,$account_no);
    $cellno2 = stripslashes($_REQUEST['cellphone2']);
    $cellno2 = mysqli_real_escape_string($db_connection,$cellno2);
    $trn_date = date("Y-m-d H:i:s");
    $query = "INSERT into `users` (username, email, password, name, surname, date_of_birth, contact_cell, bank_name, account_no, linked_cell)
      VALUES ('$username', '$email', '".md5($password)."', '$name', '$surname', '$date','$cellno', '$bank_name', '$account_no', '$cellno2')";
  }

  $result = mysqli_query($db_connection,$query);
  if(!$result){
    if (mysqli_errno($db_connection) == 1062){
      echo "user already exists";
    }else {
      echo mysqli_error($db_connection);
    }
  }else{
    $_SESSION['registration_successfull'] = true;
    header("Location: $base_url/login/login.php");
  }
}

?>