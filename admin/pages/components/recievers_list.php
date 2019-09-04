
<!-- $reciever_package_details -->
<!-- $reciever_details -->
<!-- $pending_trans_details -->
<div class="input-group row mx-0 mb-2">
  <div class="input-group-prepend">
    <div class="input-group-text">
        <input type="radio" name="selected_reciever_id" value="<?php echo $reciever_details['id']  ?>" aria-label="Radio button for following text input">
    </div>
  </div>

  <div class="payer-details form-control border bg-color-secondary-2-2" aria-label="Text input with radio button">
        <!-- <p>payer details</p> -->
        <!-- <div class=" d-flex justify-content-around w-100"> -->
        <div class="row ml-2">
            <div class="col-3 pl-1 pr-3"><?php echo $reciever_details["username"]  ?></div>
            <div class="col-3 pr-3"><?php echo $reciever_details["name"]  ?></div>
            <div class="col-3 pr-3"><?php echo $reciever_details["surname"]  ?></div>
            <div class="col-3 pr-3"><?php echo $reciever_details["bank_name"]  ?></div>
        </div>
        <!-- <div class=" d-flex justify-content-around w-100"> -->
        <div class="row ml-2">
            <p class="col-3 pl-1 pr-3">R<?php echo $pending_trans_details["total_return_amount"]  ?></p>
            <p class="col-3 pr-3">6Hrs</p>
            <p class="col-3 pr-3"><?php echo count_investments($payer_details["id"]); ?></p>
            <div><button class="btn-sm btn-primary p-0">More</button></div>
        </div>

    </div>
</div>

