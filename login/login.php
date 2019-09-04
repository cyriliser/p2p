<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
session_start();
require_once('../global_functions.php');
require_once('../config/config.php');
connect_to_db();

// If form submitted, insert values into the database.
if (isset($_POST['username'])){
       // removes backslashes
       $username = stripslashes($_REQUEST['username']);
       //escapes special characters in a string
       $username = mysqli_real_escape_string($db_connection,$username);
       $password = stripslashes($_REQUEST['password']);
       $password = mysqli_real_escape_string($db_connection,$password);
       //Checking is user existing in the database or not
       $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
       // $result = mysqli_query($db_connection,$query) or die(mysqli_error($db_connection));
       // $rows = mysqli_num_rows($result);
       // if($rows==1){
       if(($result = mysqli_query($db_connection,$query)) && mysqli_num_rows($result) == 1){
              $user_details = mysqli_fetch_assoc($result);
              $_SESSION['username'] = $username;
              $_SESSION['user_id'] = $user_details['id'];
              // Redirect user to index.php
              header("Location: $base_url/dashboard");
       }else{
              /*Lets check in the references table*/
	 	if(($result = mysqli_query($db_connection,"SELECT * FROM refs WHERE username='$username' and password='".md5($password)."'")) && mysqli_num_rows($result) == 1) {
			$user_details = mysqli_fetch_assoc($result);
		 	$_SESSION['username'] = $username;
		 	$_SESSION['user_id'] = $user_details['id'];
		 	$_SESSION['referenced'] = true;
		 	$_SESSION['ref_user_id'] = $user_details['referer_id'];
		 	$result = mysqli_fetch_row(mysqli_query($db_connection,"SELECT username, bank_name, account_no from users where id=".$user_details['referer_id']));
		 	$_SESSION['ref_name'] = $result[0];
		 	$_SESSION['ref_bank'] = $result[1];
		 	$_SESSION['ref_account'] = $result[2];
		 	header("Location: $base_url/login");	
	 	}else{
			/*The user is not found in either tables*/
	 		echo "<div class='form'>
	 		<h3>Username/password is incorrect.</h3>
	 		<br/>Click here to <a href='$base_url/login/login.php'>Login</a></div>";
	 	}
              // echo "<div class='form'>
              // <h3>Username/password is incorrect.</h3>
              // <br/>Click here to <a href='$base_url/login/login.php'>Login</a></div>";
       }

}else{
?>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
       <?php 
              echo "<p>Not registered yet? <a href='$base_url/login/registration.php'>Register Here</a></p>";
       ?>
</div>
<?php } ?>
</body>
</html>