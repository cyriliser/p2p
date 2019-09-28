<!-- Inbox -->
<?php
	$query = "select * from inbox where owner = ".$_SESSION['user_id']." order by date_received desc";
	$msgs = mysqli_query($db_connection,$query);
?>
<section class="min-vh-50 mt-5 pt-3">
	<div class="my-5"></div>
	<div class="card d-flex text-center">
		<h4 class="card-header">Inbox</h4>
		<div class="card-body">
			<?php
			if(mysqli_num_rows($msgs) > 0) {
				while($row = mysqli_fetch_assoc($msgs)) {
					$header = $row["date_received"];
					if(!$row['opened']) {
						$header = "<strong> New - ".$row["date_received"]."</strong>";
					}
					echo "
						<div class=\"card d-flex text-center\">
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