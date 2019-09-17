<html>

<head>

</head>

<body>

	<?php include_once "../global_functions.php";
	
	if(countDown(time(),true))
		echo "timer has run out";
	else
		echo "Timer still running";
	
	?>

</body>

</html>