<section class="w-100 mt-3 text-center">
    <div class="card">
    <div class="card-body">
        <!-- <h4 class="card-title">Refere Others</h4> -->
        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
        <p class="card-text">
        Copy the link below to Recruit others to join
        </p>
        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg">Share Link</span> 
           </div> 
                <input type="text" readonly class="form-control " value="<?php echo "http:localhost/$base_url/login/registration.php?ref=$user_details[id] "; ?>s" placeholder="<?php echo "http:localhost/$base_url/login/registration.php?ref=$user_details[id] "; ?>" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
           </div>
        </div>
    </div>
</section>