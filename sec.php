<?php
    $message = array();
    include("global_functions.php");
    connect_to_db();
    if (isset($_POST['submit'])) {
        array_push($message,"before function");
        foreach ($_POST as $key => $value) {
            if (gettype($value) == "array") {
                $value = implode(" ",$value);
            }
            array_push($message,$value);
        }
        array_push($message,"after function");
        security_check();
        foreach ($_POST as $key => $value) {
            if (gettype($value) == "array") {
                $value = implode(" ",$value);
            }
            array_push($message,$value);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <title>Document</title>
</head>
<body class="container pt-5">
    <div class="alert alert-primary" role="alert">
        <?php
            foreach ($message as $key => $value) {
                if (gettype($value) == "array") {
                    print_r($value);
                } else {
                    echo $value."</br>";
                }
                
            }
        ?>
    </div>

    <form action="" method="post">
        <div class="checkboxes">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checked[]" value="1" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    checkbox 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checked[]" value="2" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck3">
                    checkbox 2
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="checked[]" value="3" id="defaultCheck3">
                <label class="form-check-label" for="defaultCheck3">
                    checkbox 3
                </label>
            </div>
        </div>

        <input type="text" name="text" id="">
        <button name="submit" class="btn btn-primary">submit</button>
    </form>
</body>
</html>