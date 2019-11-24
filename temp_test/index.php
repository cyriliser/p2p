<?php 
    require_once('../global_functions.php');
    // connect_to_db();
?>

<html>
<head>

</head>

<body>
	<!-- <div>
	 	<?php //include_once "../dashboard/components/sub_components/time.php";?>
	 </div> -->

	 <!-- testing reload -->
	 <button id="refresh">Refresh</button>
	 <p id="response">Not Refreshed</p>
	 
	 <hr>
	 <p>Data</p>
	 <?php
	 	if ( isset($_POST['submit']) ) {
			 echo "<p id=\"data\"> $_POST[data]</p>";
		 }
	 ?>

	 <form action="" method="post">
	 	<input type="text" id="text-data" name="data" value="hello">
		<button type="submit" name="submit" value="submitted">Submit</button>
	 </form>

	 <?php
		 echo "<script src=\"./reloadtest.js\"></script>";
	 ?>

</body>

</html>