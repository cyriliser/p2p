<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once('../global_functions.php');
require_once('../config/config.php');
connect_to_db();
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
// echo "heloo world4\n";

        // removes backslashes
 		$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
		$username = mysqli_real_escape_string($db_connection,$username); 
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($db_connection,$email);
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
		$result = mysqli_query($db_connection,$query);
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
							
							<input type="text" name="username" placeholder="Username" required />
							<input type="email" name="email" placeholder="Email" required />
							<input type="password" name="password" placeholder="Password" required />
							<input type="text" name="name" placeholder="Name" required />
							<input type="text" name="surname" placeholder="Surname" required />
							<input type="text" name="dob" placeholder="Date of birth" required />
							<input type="text" name="cellphone" placeholder="Cellphone Number" required />
							</div>
							
							<div>
							<h1>Banking details</h1>
							<select name= "bank">
								<option value="capitec">Capitec Bank</option>
								<option value="standard">Standard Bank</option>
								<option value="fnb">First National Bank</option>
								<option value="absa">ABSA</option>
								<option value="ithala">Ithala Bank</option>
							</select>
							<input type="text" name="account_no" placeholder="Account number" required />
							<input type="text" name="cellphone2" placeholder="Linked Cellphone Number" required />
							</div>
							<input type="submit" name="submit" value="Register" />

					</form>
					</div>
		<?php 
	} ?>

</body>
</html>