<?php
       session_start();
       require_once('../../config/config.php');
       require_once('../../global_functions.php');
       connect_to_db();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php

// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
       $username = mysqli_real_escape_string($db_connection,$username);
       $password = stripslashes($_REQUEST['password']);
       $password = mysqli_real_escape_string($db_connection,$password);
       //Checking is user existing in the database or not
       $query = "SELECT * FROM `admin` WHERE username='$username' and password='".md5($password)."'";
       $result = mysqli_query($db_connection,$query) or die(mysql_error());
       $rows = mysqli_num_rows($result);
        if($rows==1){
              $admin_details = mysqli_fetch_assoc($result);
              $_SESSION['username'] = $username;
              $_SESSION['admin_id'] = $admin_details['id'];
              // Redirect user to index.php
              header("Location: http://localhost/sites/p2p/admin");
         }else{
              echo "<div class='form'>
              <h3>Username/password is incorrect.</h3>
              <br/>Click here to <a href='login.php'>Login</a></div>";
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
              echo "<p>Not registered yet? <a href='registration.php'>Register Here</a></p>";
       ?>
</div>
<?php } ?>
</body>
</html>