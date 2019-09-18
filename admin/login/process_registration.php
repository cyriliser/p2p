<?php
require_once("../../config/config.php");
require_once("../../global_functions.php");
connect_to_db();

// If form submitted, insert values into the database.

if (isset($_REQUEST['username'])){
	 if(!security_check()){
	 	header("Location: admin_registration.php?securityError");
	 }else {
	    $username = $_REQUEST['username'];
		 if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			$nameErr = "Only letters and white space allowed"; 
	    } 
	    $email = $_REQUEST['email'];
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	        $emailErr = "Invalid email format"; 
	    }
	    $password = $_REQUEST['password'];
	    $cellno = $_REQUEST['cellno'];
	    $name = $_REQUEST['name'];
	    $surname = $_REQUEST['surname'];
	    $query = "INSERT into `admin` (username, name, surname, email, password, phone)
	        VALUES ('$username', '$name' , '$surname' , '$email' ,'".md5($password)."', '$cellno')";
	    $result = mysqli_query($db_connection,$query);
	    if(!$result){
	        echo mysqli_error($db_connection);
	    }else{
	        echo "<div class='form'>
	                <h3>You are registered successfully.</h3>
	                <br/>Click here to <a href='ogin.php'>Login</a></div>";
	    }
	 }    
 }