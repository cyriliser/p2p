<?php
session_start();
require_once "../global_functions.php";
connect_to_db();
security_check();
function displayError($msg){
	if(isset($_GET['api'])) {
		
	}else {
		$_SESSION['activateError'] = $msg;
		header("Location: ".$base_url."/dashboard?inbox");
	}
}

if(isset($_GET['activate_ref'])) {
	/*Check if person activating is admin or referer*/	
	$id = $_GET['user_id']; // The user to be activated
	$query = "select * from refs where id=$id";
	$result = mysqli_query($db_connection,$query);
	if($result){
		$data = mysqli_fetch_row($result);
		/*We now have referer id (current logged in user and refered user id)*/
		if($_SESSION['user_id'] != $data[11]) {
			// They don't have autorisation to activate the user
			header("Location: ".$base_url."/dashboard?inbox");
		}
		// Move user to users table
		$query = "INSERT into users (username, email, password, name, surname, date_of_birth, contact_cell, bank_name, account_no, linked_cell) 
        				VALUES ('$data[1]', '$data[2]', '".$data[3]."', '$data[4]', '$data[5]', '$data[6]','$data[7]', '$data[8]', '$data[9]', '$data[10]')";
		if(mysqli_query($db_connection,$query)) {
			// get new id
			$new_id = mysqli_fetch_row(mysqli_query($db_connection,"select id from users where email = '$data[2]' and password = '$data[3]'"))[0];
			// Move messages
			mysqli_query($db_connection,"update inbox set user_sender = $new_id, ref_sender = NULL, opened = 1 where ref_sender = $id");
			if(!mysqli_query($db_connection,"delete from refs where id = ".$id)) {
				displayError("Error removing user from references, please delete user using delete button");
			}else {
				// Send confirmation to user
				$msg = "Account successfuly activated, now select a package to start scheming hehe";
				mysqli_query($db_connection,"insert into inbox (owner,user_sender,msg,opened,date_received) values (".$new_id.",".$_SESSION['user_id'].",'$msg',0,'".date("Y-m-d H:i:s")."')");
				header("Location: ".$base_url."/dashboard?inbox");
			}
		}else {
			displayError("Error activating account, please try again");
		}
	}else {
		displayError("Error, requested user not found");
	}
}

if(isset($_GET['delete_ref'])) {
	$id = $_GET['user_id'];
	$query = "delete from refs where id=$id";
	$result = mysqli_query($db_connection,$query);
	if(!$result){
		displayError("Error removing referenced user");
	}

}

if(isset($_GET['verify_user'])){
	displayError("Error verifying user");
}

if(isset($_GET['delete_user'])){
	$id = $_GET['user_id'];
	$query = "delete from users where id=$id";
	$result = mysqli_query($db_connection,$query);
	if(!$result) {
		displayError("Error deleting user");
	}

}

// If something weird happens

//header("Location: /admin");
?>