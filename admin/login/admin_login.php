<?php
session_start();
require_once("../../config/config.php");
require_once("../../global_functions.php");
connect_to_db();



// If form submitted, check if user exists in the database.
if (isset($_POST['username'])){
	// removes backslashes
	$username = stripslashes($_REQUEST['username']);
	//escapes special characters in a string
	$username = mysqli_real_escape_string($db_connection,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($db_connection,$password);
	//Checking is user existing in the database or not
	$query = "SELECT * FROM `admin` WHERE username='$username' and Password='".md5($password)."'";
	$result = mysqli_query($db_connection,$query) or die(mysqli_error($db_connection));
	$rows = mysqli_num_rows($result);
	if($rows==1){
     	$_SESSION['username'] = $username;
		// Redirect user to index.php
     	header("Location: ../index.php");
	}else{
		// print pass word incorrect
		require_once('admin_login_form.php');
		#echo "<h3>$rows</h3>";
		echo "<h3 class=\"text-danger\">Username/password is incorrect.</h3>
								</div>
							</div>
						</div>
					</div>
				</body>
				</html>";
		}
}else{
	// print login form
	// require_once("../admin_nav.php");
	require_once('admin_login_form.php');
	echo "			</div>
				</div>
			</div>
		</div>
	</body>
	</html>";
		}
?>

