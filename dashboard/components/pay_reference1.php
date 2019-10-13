<!-- Pay Reference -->
<section id="pay-reference" class="pt-3 mx-2">
	<div class="card bg-secondary  text-white d-flex text-center">
		<h4 class="card-header px-0">Account not activated</h4>
		<div class="card-body">
			<h6 class="car-title">Your account was referenced by <?php echo $_SESSION['ref_name']; ?> <h6>
			<p>First pay R500 to the following account then Request Activation</p>
			
			<!-- recipient details -->
			<div class="recipient-details border border-info">
				<div class="row text-center px-auto"><h5 class="col-12">User Details</h5></div>
				<div class="row px-auto">
						<p class="col-4 px-auto pr-0 mx-1">Bank Name</p><p class="col-1 px-0">:</p>
						<p class="col-6 pl-0 text-left"><?php echo $_SESSION['ref_bank']; ?></p>
				</div>
				<div class="row px-auto">
						<p class="col-4 px-auto pr-0 mx-1">Account No</p><p class="col-1  px-0">:</p>
						<p class="col-6 pl-0 text-left"><?php echo $_SESSION['ref_account']; ?></p>
				</div>

			</div>

		</div>
	</div>

	<div class=" bg-dark my-2 text-center py-2 px-2">
		<div class="col-4 my-2">
			<form action="../api/reference_manager.php" class="" method="post">
				<input type="submit" class="btn btn-info" name="action" value="Request activation from user" />
				<input type="hidden" value="<?php echo $_SESSION['ref_user_id'];?>" name="to" />
				<input type="hidden" name="send_user_msg"/>
			</form>
		</div>
		
		<div class="col-4 my-2">
			<form action="../api/reference_manager.php" method="post" class=" ">
				<input type="submit" class="btn btn-danger" name="action" value="Request activation from admin" />
				<input type="hidden" value="<?php echo $_SESSION['ref_user_id'];?>" name="to" />
				<input type="hidden" name="send_admin_msg"/>
			</form>
		</div>

			<?php
				if(isset($_GET['msgError'])) {
					echo "<h4 class='card-header my-4 bg-danger'>Error sending msg</h4>";
				}
				if(isset($_GET['msgSent'])) {
					echo "<h4 class='card-header my-4 bg-success'>Message sent</h4>";
				}
			?>
		</div>
	</div>
</section>
