<?php 
    //A Reusable Modal-body for Add/Edit Employee
?>
<span data-returnval="0"></span>

<div class="container-fluid">
    <?php validation_errors(); ?>
    <?php echo form_open();
    //Don't send the form through any link, The submit button has the post request and the link ?> 

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Full Name<span class="text-danger">&nbsp; *</span></label>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Firstname Lastname" name="full_name" value="<?php echo set_value('full_name'); ?>">
            </div>
            <label class="col-md-5 col-form-label form-text text-danger"><?php echo form_error('full_name');?></label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Address &nbsp;&nbsp;</label>
            <div class="col-md-4">
                <textarea class="form-control resize-vert" name="address" maxlength=100 placeholder="Enter Address"  rows="4"><?php echo trim(set_value('address')); ?></textarea>
            </div>
            <label class="col-md-5 col-form-label form-text text-danger"><?php echo form_error('address');?></label>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Email<span class="text-danger">&nbsp; *</span> </label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="email" placeholder="Enter Email" value="<?php echo set_value('email'); ?>">
            </div>
            <label class="col-md-5 col-form-label form-text text-danger"><?php echo form_error('email');?></label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Contact No<span class="text-danger">&nbsp; *</span></label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="contact_no" maxlength=10 placeholder="Enter your 10 digits contact number" value="<?php echo set_value('contact_no'); ?>">
            </div>
            <label class="col-md-5 col-form-label form-text text-danger"><?php echo form_error('contact_no');?></label>
        </div>
    </form>
</div>

