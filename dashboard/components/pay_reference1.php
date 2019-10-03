<!-- Pay Reference -->
<section id="pay-reference" class="min-vh-100 mt-5 pt-3">
	<div class="my-5"></div>
	<div class="card d-flex text-center">
		<h4 class="card-header">Account not activated</h4>
		<div class="card-body">
			<h4 class="car-title">Your account was referenced by <?php echo $_SESSION['ref_name']; ?> <h4>
			<p>First pay R500 to <?php echo $_SESSION['ref_bank']." account number ".$_SESSION['ref_account'] ?> for your account to be activated</p>
		 </div>
	 </div>
	 <div class="col text-center my-5">
	 	<form action="../api/reference_manager.php" class="btn form-control w-25" method="post">
	 		<input type="submit" class="btn btn-info" name="action" value="Request activation from user" />
	 		<input type="hidden" value="<?php echo $_SESSION['ref_user_id'];?>" name="to" />
	 		<input type="hidden" name="send_user_msg"/>
	 	</form>
	 	
	 	<form action="../api/reference_manager.php" method="post" class="btn form-control w-25">
	 		<input type="submit" class="btn btn-danger" name="action" value="Request activation from admin" />
	 		<input type="hidden" value="<?php echo $_SESSION['ref_user_id'];?>" name="to" />
	 		<input type="hidden" name="send_admin_msg"/>
	 	</form>
	 	<?php
	 		if(isset($_GET['msgError'])) {
	 			echo "<h4 class='card-header my-4 bg-danger'>Error sending msg</h4>";
	 		}
	 		if(isset($_GET['msgSent'])) {
	 			echo "<h4 class='card-header my-4 bg-success'>Message sent</h4>";
	 		}
	 	?>
	 </div>
</section>
