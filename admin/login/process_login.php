<?php
session_start();
require_once("../../config/config.php");
require_once("../../global_functions.php");
connect_to_db();
// If form submitted, check if user exists in the database.
if (isset($_POST['username'])){
	$link = "login.php";
	$get = "?";
	if(!security_check()) {
		$link = $link.$get."securityError=1";
		$get = "";
	}else {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		//Checking is user existing in the database or not
		$query = "SELECT * FROM `admin` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($db_connection,$query);
		if($result) {
			$rows = mysqli_num_rows($result);
			if($rows==1){
				$admin_details = mysqli_fetch_assoc($result);
				$_SESSION['username'] = $username;
				$_SESSION['admin_id'] = $admin_details['id'];
				$_SESSION['admin'] = true;
				// Redirect user to index.php
				header("Location: ../");
				die();
			}else {
				$link = $link.$get."loginError=1";
				$get = "";
			}
		}else{
			$link = $link.$get."loginError=1";
			$get = "";
		}
	}
	header("Location: $link"); // Reach here if failed login
}
?>