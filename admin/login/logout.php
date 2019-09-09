<?php
session_start();
require_once("../../global_functions.php");
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
header("Location: $admin_url/login/admin_login.php");
}
?>