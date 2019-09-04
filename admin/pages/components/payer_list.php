
<!-- $payer_package_details -->
<!-- $payer_details -->
<div class="input-group mb-2">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <input type="checkbox" name="selected_payers[]" value="<?php echo $payer_details['id']  ?>" aria-label="Checkbox for following text input">
    </div>
  </div>
  <div class="payer-details form-control col-11 border bg-color-secondary-2-2" aria-label="Text input with checkbox">
        <!-- <p>payer details</p> -->
        <!-- <div class=" d-flex justify-content-around w-100"> -->
        <div class="row ml-2">
            <div class="col-3 pl-1 pr-3"><?php echo $payer_details["username"]; ?></div>
            <div class="col-3 pr-3"><?php echo $payer_details["name"]; ?></div>
            <div class="col-3 pr-3"><?php echo $payer_details["surname"]; ?></div>
            <div class="col-3 pr-3"><?php echo $payer_details["bank_name"]; ?></div>
        </div>
        <!-- <div class=" d-flex justify-content-around w-100"> -->
        <div class="row ml-2">
            <p class="col-3 pl-1 pr-3"><?php echo $payer_package_details["amount"]; ?></p>
            <p class="col-3 pr-3"><?php echo $payer_details["verification_time"]; ?></p>
            <p class="col-3 pr-3"><?php echo count_investments($payer_details["id"]);?></p>
            <div><button class="btn-sm btn-primary p-0">More</button></div>
        </div>
    </div>
</div>


