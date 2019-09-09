<?php
// Enter your Host, username, password, database below.
// I left password empty because i do not set password on localhost.
$base_url = "localhost/sites/p2p"; ////// homepage
$dashboard_url = "localhost/sites/p2p/dashboard"; ////// userdashboard
$admin_url = "localhost/admin"; ////// Admin Panel URL

$dbname = "cyrilise_p2p"; //name of the database
$dbhost = "localhost"; //address of the database
// $dbuser = "cyrilise_p2p"; //username on for the onlinr database(cyriliser.co.za)
// $dbpass = "RoR1BcDOdeAgggq"; //password for the online database(cyriliser.co.za)
$dbuser = "root"; //username on for the local database(xampp)
$dbpass = ""; //password for the local database(xampp)

// Enter your Host, username, password, database below.
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>