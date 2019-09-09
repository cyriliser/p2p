<?php
session_start();
require_once('../config/config.php');
if(!isset($_SESSION["username"])){
header("Location: $base_url/login/login.php");
exit(); }
?>