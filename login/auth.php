<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: $base_url/login/login.php");
exit(); }
?>