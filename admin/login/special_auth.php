<?php
session_start();
require_once("../../global_functions.php");
if(!isset($_SESSION["username"])){
header("Location: $admin_url/login/admin_login.php");
exit(); }
?>