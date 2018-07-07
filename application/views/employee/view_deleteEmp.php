<?php
    echo $data;
?>
<span data-returnval="1"></span>

<div class="container-fluid">
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Full Name </label>
            <label class="col-md-4 col-form-label"> <?php echo set_value('full_name'); ?> </label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Address </label>
            <div class="col-md-4">
                <textarea readonly class="form-control resize-vert" rows="4"><?php echo trim(set_value('address')); ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Email </label>
            <label class="col-md-4 col-form-label"> <?php echo set_value('email'); ?> </label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Contact No </label>
            <label class="col-md-4 col-form-label"> <?php echo set_value('contact_no'); ?> </label>
        </div>
    </form>
</div>

