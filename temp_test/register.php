<?php
	session_start();
	
	if(isset($_GET['ref']){
		// Let's first check if the reference exists
		$query = "SELECT id from users where id = $_GET['ref']";
		if(mysql_query($query, $db_connection);) {		
			$SESSION['ref'] = $_GET['ref'];
		}else {
			echo "invalid reference found";
		}
	}
?>