<section class="w-100 mt-3 text-center">
	<!-- FACEBOOK STUFF-->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=1716134951786163&autoLogAppEvents=1"></script>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Share Link</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body col">
				<div id="facebook">
				<!--Facebook-->
					<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.cashbankers.com%2Flogin%2Fregistration.php%3Fref%3D36%20&layout=button&size=small&appId=1716134951786163&width=59&height=20"
						width="73"
					  	height="28"
					  	style="border:none;overflow:hidden"
					  	scrolling="no"
					  	frameborder="0"
					  	allowTransparency="true"
					  	allow="encrypted-media">
					</iframe>
				</div>
				<!--Twitter-->
				<div id="twitter">
					<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-show-count="false">Tweet</a>
				</div>
				
				<div id="linkedIn" class="">
					<button type="button" class="btn btn-li"><i class="fab fa-linkedin-in pr-1"></i> Linkedin</button>
				</div>
				
				<div id="email">
					<!--Email-->
					<form method="post" action="mailto:?subject=Register%20To%20CashBankers&msg=link%20and%20stuff">
					<input type="submit" class="btn" />
					</form>
				</div>
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
            <div class="input-group-prepend">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						  Share Link
						</button>
            </div>
                <input type="text" readonly class="form-control " value="<?php echo "http:localhost/$base_url/login/registration.php?ref=$user_details[id] "; ?>" placeholder="<?php echo "http:localhost/$base_url/login/registration.php?ref=$user_details[id] "; ?>" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    
    <script type="text/javascript" >
    	$('#myModal').on('shown.bs.modal', function () {
		  $('#myInput').trigger('focus')
		})
    </script>
</section>