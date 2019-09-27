<?php
if (count($errors) > 0) : ?>
  	<?php foreach ($errors as $error) : 
		echo "<script type='text/javascript'>alert('$error');window.location.href='forgot_password.php';</script>";
	?>
  	<?php endforeach ?>
<?php  endif ?>