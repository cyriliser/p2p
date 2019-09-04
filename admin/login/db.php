<?php
// local version (xampp)
// $base_url = "localhost/sites/p2p"; ////// homepage
// $dashboard_url = "localhost/sites/p2p/dashboard"; ////// userdashboard
// $admin_url = "localhost/admin"; ////// Admin Panel URL
// $dbuser = "root"; //username on for the local database(xampp)
// $dbpass = ""; //password for the local database(xampp)

// online version
$base_url = "https://p2p.cyriliser.co.za"; ////// homepage
$dashboard_url = "https://p2p.cyriliser.co.za/dashboard"; ////// userdashboard
$admin_url = "https://p2p.cyriliser.co.za/admin"; ////// Admin Panel URL

$dbname = "cyrilise_p2p"; //name of the database
$dbhost = "localhost"; //address of the database
$dbuser = "cyrilise_p2p"; //username on for the online database(cyriliser.co.za)
$dbpass = "RoR1BcDOdeAgggq"; //password for the online database(cyriliser.co.za)

// Enter your Host, username, password, database below.
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>