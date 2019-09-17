<html>

<head>

</head>

<body>

	<?php include_once "../global_functions.php";
	
	if(countDown(time(),13,true))
		echo "timer has run out";
	else
		echo "Timer still running";
	
	?>

</body>

</html>