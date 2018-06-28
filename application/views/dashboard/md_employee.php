<span data-returnval="0"></span>

<div class="container-fluid">
    <?php validation_errors(); ?>
    <?php echo form_open();
    //Don't send the form through any link, The submit button has the post request and the link ?> 

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Full Name </label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="full_name" value="<?php echo set_value('full_name'); ?>">
            </div>
            <?php echo form_error('full_name');?>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Address </label>
            <div class="col-md-4">
                <textarea class="form-control" name="address" id="" rows="4"><?php echo trim(set_value('address')); ?></textarea>
            </div>
            <?php echo form_error('address');?>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Email </label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>">
            </div>
            <?php echo form_error('email');?>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Contact No </label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="contact_no" value="<?php echo set_value('contact_no'); ?>">
            </div>
            <?php echo form_error('contact_no');?>
        </div>
    </form>
</div>

