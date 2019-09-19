<html>

<head>
	<link rel="stylesheet" href="../assets/css/flipclock.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
	
	<?php
		include_once "../global_functions.php";
		$db_time = 1568905738;
		if(countDown($db_time,12,true)){
			echo "timer has run out";
		}
		else{
			echo "Timer still running";
		}

	?>

	<script src="../assets/js/flipclock.js"></script>
	<script type="text/javascript">
		var clock;
		$(document).ready(function() {
			// Calculate the difference in seconds between the future and current date
			var diff = '.$db_time.' - '.$current_time.';
			// Instantiate a coutdown FlipClock
			clock = $(\'.clock\').FlipClock(diff, {
				clockFace: \'DailyCounter\',
				countdown: true,
				showSeconds: true
			});
		});
	</script>

</body>

</html>