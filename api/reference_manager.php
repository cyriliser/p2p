<?php
session_start();
require_once('../config/config.php'); // has usefull functions
require_once('../global_functions.php'); // has usefull functions
connect_to_db(); //connects to database defined in global_funtions.php
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

function sendMsg($receiver,$sender) {
	global $user_id,$username,$db_connection;
	// $msg = addslashes("<a href='$base_url/api/reference_manager.php?confirm=$sender'>Confirm payment for $username</a>");
	$msg = addslashes("$sender $username");
	$date = date("Y-m-d H:i:s");
	$query = "insert into inbox (owner,ref_sender,msg,opened,date_received) values ('".$receiver."' , '".$user_id."' , '".$msg."',0,'".$date."')";
	if(!mysqli_query($db_connection,$query)) {
		echo "$query";
		//header("Location: /dashboard?msgError");
	}else {
		header("Location: ../dashboard?msgSent");
	}
}

security_check();
if(isset($_POST['send_user_msg'])){
	sendMsg($_POST['to'],$_SESSION['user_id']);
}
if(isset($_POST['send_admin_msg'])){
	sendMsg($_POST['to'],$_SESSION['user_id']);
}

if(isset($_GET['confirm'])) {
	// Check if currently logged in user matches the to in the db
	header("Location: $base_url/api/manage_users.php?activate_ref&user_id=".$_GET['confirm']);
}
?>