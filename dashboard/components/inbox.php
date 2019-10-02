<!-- Inbox -->
<?php
	$query = "select * from inbox where owner = ".$_SESSION['user_id']." order by date_received desc";
	$msgs = mysqli_query($db_connection,$query);
	
	if(isset($_SESSION['activateError'])) {
		echo "
		<div class='container'>
			<div class=\"card text-white bg-info\">
				  <div class=\"card-body\">
				    <h5 class=\"card-title text-center \">Error processing request</h5>
				    <p class=\"card-text text-center \">".$_SESSION['activateError']."</p>
				  </div>
			</div>
		<div>
		";		
		unset($_SESSION['activateError']);
	}
	
?>
<section class="min-vh-50 mt-3 pt-1">
	<div class="my-5"></div>
	<div class="card d-flex text-center">
		<h4 class="card-header">Inbox</h4>
		<div class="card-body" style="background-color:wheat">
			<?php
			if(mysqli_num_rows($msgs) > 0) {
				while($row = mysqli_fetch_assoc($msgs)) {
					$header = $row["date_received"];
					if(!$row['opened']) {
						$header = "<strong style='color: lime;'> New - ".$row["date_received"]."</strong>";
					}
					echo "
						<div class=\"card d-flex my-2 text-center\" style='background-color:red;'>
							<h4 class='card-header'>$header</h4>
							<div class='card-body'>
							".$row['msg']."
							</div>
						</div>
					";
				}
			}else {
				echo "<h4 class='card-header'>You have no messages</h4>";
			}
			?>
		</div>
	</div>
</section>
<?
	mysqli_query("update inbox set read=1 where id=".$_SESSION['user_id']);
?>