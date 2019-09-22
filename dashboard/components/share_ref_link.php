<section class="w-100 mt-3 text-center">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Refere Others</h4>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
        <p class="card-text">
        Copy the link below to Recruit others to join
        </p>
        <div class="input-group input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-lg">Share Link</span>
            </div>
                <input id="share_url" type="text" readonly class="form-control " value="<?php echo "$base_url/login/registration.php?ref=$user_details[id] "; ?>" placeholder="<?php echo "http:localhost/$base_url/login/registration.php?ref=$user_details[id] "; ?>" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>

        <div class="share_area">
            <button class="btn btn-primary" id="web-share-btn">Share</button>
        </div>
    </div>
    
    <div class="overlay"></div>
    <div class="share">
        <h2>Share now fallback</h2>
        <button>facebook</button>
        <button>twitter</button>
        <button>whatsapp</button>
    </div>
</section>