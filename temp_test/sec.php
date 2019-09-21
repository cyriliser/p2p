<?php
    $message = array();
    include("../global_functions.php");
    connect_to_db();
    if (isset($_POST['submit'])) {
        array_push($message,"before function");
        foreach ($_POST as $key => $value) {
            array_push($message,$value);
        }
        array_push($message,"after function");
        security_check();
        foreach ($_POST as $key => $value) {
            array_push($message,$value);
        }
    }
    print_r($_POST);
    echo " = POST <br>>";
    print_r($_REQUEST);
    echo " = REQUEST ";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <title>Document</title>
</head>
<body class="container pt-5">
    <div class="alert alert-primary" role="alert">
        <?php
            foreach ($message as $key => $value) {
                echo $value."</br>";
            }
        ?>
    </div>

    <form action="" method="post">
        <input type="text" name="text" id="">
        <button name="submit" class="btn btn-primary">submit</button>
    </form>
</body>
</html>