<section class="w-100 mt-3 text-center">
	<!-- FACEBOOK STUFF-->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=1716134951786163&autoLogAppEvents=1"></script>
	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	<script src="/assets/js/clipboard.min.js"></script>
	<script src="https://kit.fontawesome.com/6e4574c2a7.js" crossorigin="anonymous"></script>
	<style type="text/css">
 
#share-buttons img {
width: 45px;
padding: 5px;
border: 0;
box-shadow: 0;
display: inline;
}
#share-buttons button {
background: rgba(0,0,0,0);
border: none;
box-shadow: 0;
}
</style>
<?php 
// Facebook string
$link = "https://localhost/$base_url/login/registration.php?ref=$user_details[id]";
// Email stuff
$subject = htmlspecialchars("CashBankers Reference Link");
$body = htmlspecialchars("Checkout Cashbankers and improve your capital now");
function getEmail() {
	// Let's use the html characteristics of emails
	?>
	
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
    <div class="modal-header">
    	<h4 class="card-title text-center">Refere Others</h4>
    </div>
    <div class="card-body">
        
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
    	  <!-- I got these buttons from simplesharebuttons.com -->
			<div id="share-buttons">
			    <!-- Facebook -->
			    <button onclick="openWindow(this);" href="https://www.facebook.com/plugins/share_button.php?href=<?php echo $link;?>" target="_blank">
			        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
			    </button>
			     
			    <!-- Twitter -->
			    <button onclick="openWindow(this);" href="https://twitter.com/share?url=<?php echo $link;?>&amp;text=Register%20to%20Bankers&amp;hashtags=cashbankers" target="_blank">
			        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
			    </button>
			    
			    <!-- LinkedIn -->
			    <button onclick="openWindow(this);" href="http://www.linkedin.com/shareArticle?mini=true&url=https://system.cashbankers.co.za" target="_blank">
			        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
			    </button>
			    
			    <!-- Google+ -->
			    <button onclick="openWindow(this);" href="https://plus.google.com/share?url=https://simplesharebuttons.com" target="_blank">
			        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
			    </button>
			    
			    <!-- Email -->
			    <button onclick="openWindow(this);" href='mailto:?subject=CashBankers%20Reference%20Link&body=Checkout%20Cashbankers%20and%20improve%20your%20capital%20now'>
			        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
			    </button>
			    
			    <!-- Tumblr-->
			    <button onclick="openWindow(this);" href="http://www.tumblr.com/share/link?url=<? echo $link;?>&amp;title=Register to CashBankers!" target="_blank">
			        <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
			    </button>
			    
			    <!-- Print -->
			    <button href="javascript:;" onclick="window.print()">
			        <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
			    </button>
			
			</div>
    </div>
    </div>
    	
    <!-- For sharing icons -->
    <script async src="https://static.addtoany.com/menu/page.js"></script>
    
    
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
		
		// For opening in new window
		function openWindow(element) {
			window.open(element.getAttribute('href'),'MyWindow','width=600,height=300');
			return false;
		}
    </script>
</section>