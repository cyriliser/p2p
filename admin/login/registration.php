<?php
session_start();
require_once('../../config/config.php');
require_once('../../global_functions.php');
connect_to_db();
security_check();
?>

<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php

// If form submitted, insert values into the database.
if (isset($_REQUEST['submit'])){
        // removes backslashes
 		$username = stripslashes($_REQUEST['email']);
        //escapes special characters in a string
		$username = mysqli_real_escape_string($db_connection,$username); 
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($db_connection,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($db_connection,$password);
		$password = md5($password);
		$name = stripslashes($_REQUEST['name']);
		$name = mysqli_real_escape_string($db_connection,$name);
		$surname = stripslashes($_REQUEST['surname']);
		$surname = mysqli_real_escape_string($db_connection,$surname);

       	$query = "INSERT into `admin` (username, email, password, name, surname)
							VALUES ('$username', '$email', '$password', '$name', '$surname')";
		$result = mysqli_query($db_connection,$query);
		if(!$result){
			echo mysqli_error($db_connection);
		}
        if($result){
			// echo "heloo world5n";
            echo "<div class='form'>
					<h3>You are registered successfully.</h3>
					<br/>Click here to <a href='login.php'>Login</a></div>";
			// echo "heloo world6\n";
		}
		// echo "heloo world7\n";

}else{
			?>
					<div class="form">
						<h1>Registration</h1>
						<form name="registration" action="" method="post">
							<div>
							<h1>Personal Details</h1>
							
							<input type="email" name="email" placeholder="Email" required />
							<input type="password" name="password" placeholder="Password" required />
							<input type="text" name="name" placeholder="Name" required />
							<input type="text" name="surname" placeholder="Surname" required />
							</div>
							
							<input type="submit" name="submit" value="Register" />

					</form>
					</div>
		<?php 
	} ?>

</body>
</html>