<section class="w-100 mt-3 text-center">
	<!-- FACEBOOK STUFF-->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=1716134951786163&autoLogAppEvents=1"></script>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<script src="/assets/js/clipboard.min.js"></script>
	<script src="https://kit.fontawesome.com/6e4574c2a7.js" crossorigin="anonymous"></script>

<?php 
// Facebook string
$link = htmlspecialchars_decode("http:localhost/$base_url/login/registration.php?ref=$user_details[id]");

// Email stuff

function getEmail() {
	// Let's use the html characteristics of emails
	?>
	<p>You have been referenced to join cashbankers</p>
	<?php
}

?>
	<!-- Modal -->
	<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <h1 class="text-success">Copied to clipboard</h1>
	      </div>
	    </div>
	  </div>
	</div>
	
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Refere Others</h4>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
        <p class="card-text">
        Copy the link below to Recruit others to join
        </p>
        <div class="input-group input-group-lg">
        		<input type="text" readonly class="form-control" id="theLink" value="<?php echo $link; ?>" placeholder="<?php echo $link; ?>" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            <div class="input-group-append">
                <button type="button" class="btn btn-primary" id="copyBtn"  data-toggle="tooltip" data-placement="bottom" title="Copy Link to ClipBoard" data-clipboard-action="copy" data-clipboard-target="#theLink">
						  Copy
						</button>
            </div>
        </div>
        <div class="w-100 m-1 py-5 row text-center">
				<div id="facebook" class="col-2">
				<!--Facebook-->
					<iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo $link;?>&layout=button&size=large&appId=1716134951786163&width=59&height=20"
						width="100"
					  	height="100"
					  	style="border:none;overflow:hidden"
					  	scrolling="no"
					  	frameborder="0"
					  	allowTransparency="true"
					  	allow="encrypted-media">
					</iframe>
				</div> 
				<!--Twitter-->
				<div id="twitter" class="col-2">
					<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a>
				</div>

				<div id="email" class="col-2">
					<button
					class="btn btn-success"
					style="width: 100px;height: 30px;color: white;border-radius: 5px"
					onclick="window.open('mailto:?subject=CashBankers%20Reference%20Link&body=Checkout%20Cashbankers%20and%20improve%20your%20capital%20now','popup','width=600,height=600'); return false;"
					><p class="text-sm fas fa-envelope">Email</p></button>
				</div>
        </div>
        </div>
    </div>
    <script type="text/javascript" >
    	var clipboard = new ClipboardJS('#copyBtn');
		clipboard.on('success', function(e) {
		    $('#successModal').modal('show');
		    e.clearSelection();
		});
		clipboard.on('error', function(e) {
		    console.error('Action:', e.action);
		    console.error('Trigger:', e.trigger);
		});
		// For modal timeout
		$(function(){
		    $('#successModal').on('show.bs.modal', function(){
		        var myModal = $(this);
		        clearTimeout(myModal.data('hideInterval'));
		        myModal.data('hideInterval', setTimeout(function(){
		            myModal.modal('hide');
		        }, 1000));
		    });
		});
    </script>
</section>