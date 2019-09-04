<?php 
    require_once("../config/config.php");
    require_once("../global_functions.php");
    connect_to_db();
    require_once("login/auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- main style sheet -->
    <link rel="stylesheet" href="assets/css/palatte.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Admin | Home</title>
</head>
<body class=" container vh-100 bg-color-secondary-1-2">
    
