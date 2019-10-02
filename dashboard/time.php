<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- styles -->
    <!-- bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- flip clock -->
    <link rel="stylesheet" href="../assets/css/flipclock.css">
    <!-- main style sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <?php 
        // $twelve_hrs = 6000;
        $twelve_hrs = 43200;
        $twenty4_hrs = 86400;
        $db_time = 1566685950 ;
        $current_time = time();
        $time_left = $twelve_hrs -  $db_time + $current_time;
        echo "<div id=\"time_value\" style=\"display:none2;\">". time()  . "</div>";
    ?>
    <div class="count-down row">
        <div class="col-sm-2"></div>
        <div class="clock_test col-sm-8" style="margin:2em;"></div>
        <div class="col-sm-2"></div>
    </div>

    <!-- java script goes here -->
    <!-- jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- flip clock -->
    <script src="../assets/js/flipclock.js"></script>
    <script src="../assets/js/clock.js"></script>
    <!-- main js -->
    <script src="../assets/js/main.js"></script>
</body>
</html>

