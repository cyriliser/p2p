<?php
session_start();
require_once "../global_functions.php";
connect_to_db();
security_check();
function displayError($msg){
	if(isset($_GET['api'])) {
		
	}else {
		echo "
		<html>
			<head>
					<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
					<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
			</head>			
			<body style='height=100%'>
				<div class='container'>
					<div class=\"card text-white bg-info mb-3\" style='margin-top:25%'>
						  <div class=\"card-header text-center\">Error</div>
						  <div class=\"card-body\">
						    <h5 class=\"card-title text-center \">Error processing request</h5>
						    <p class=\"card-text text-center \">$msg</p>
						  </div>
					</div>
					<div>
						<a href='/admin'><button class='btn btn-danger w-100'>Back</button></a>
					</div>
				<div>
			</body>
		</html>
		";
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
			mysqli_query($db_connection,"update inbox set user_sender = $new_id, ref_sender = NULL where ref_sender = $id");
			if(!mysqli_query($db_connection,"delete from refs where id = ".$id)) {
				displayError("Error removing user from references, please delete user using delete button");
			}else {
				// Send confirmation to user
				$msg = "Account successfuly activated, now select a package to start scheming hehe";
				mysqli_query($db_connection,"insert into inbox (owner,user_sender,msg,opened,date_received) values (".$new_id.",".$_SESSION['user_id'].",'$msg',0,'".date("Y-m-d H:i:s")."')");
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