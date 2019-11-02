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
<section class="pt-3 ">
	<div class="card bg-secondary text-white d-flex text-center">
		<h4 class="card-header">Inbox</h4>
		<h4 class="card-title">confirm if someone you shared your link with has paid you the referral fee</h4>
		<div class="card-body">

			<?php
			if(mysqli_num_rows($msgs) > 0) {
				while($row = mysqli_fetch_assoc($msgs)) {
					$header = $row["date_received"];
					if(!$row['opened']) {
						$header = "<strong style='color: lime;'> New - ".$row["date_received"]."</strong>";
					}
					// $row['msg']
					$str_arr = explode (" ", $row['msg']); 
					$id = $str_arr[0];
					$usernme = $str_arr[1] ;
					$url = "<a class=\"btn btn-secondary\" href='$base_url/api/reference_manager.php?confirm=$id'>Confirm payment for $usernme</a>";
					echo "
						<div class=\"card bg-primary text-white d-flex text-center\">

							<h4 class='card-header'>$header</h4>
							<div class='card-body'>
								$url
							</div>
						</div>
					";

					// <a href='/api/reference_manager.php?confirm=4'>Confirm payment for lolly_ref1</a>
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