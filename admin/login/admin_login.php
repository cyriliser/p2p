
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
        $query = "SELECT * FROM `admin_users` WHERE Username='$username' and Password='".md5($password)."'";
 $result = mysqli_query($con,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['username'] = $username;
            // Redirect user to index.php
     header("Location: index.php");
         }else{
	
			include('admin_login_form.php');
			#echo "<h3>$rows</h3>";
			echo "<h3>Username/password is incorrect.</h3>
				</div>
			</div>
		</div>
	</div>
</body>
</html>";
	
		}
}else{
		include('admin_login_form.php');
		echo "</div>
			</div>
		</div>
	</div>
</body>
</html>";
}
?>

