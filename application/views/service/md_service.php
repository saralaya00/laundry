<?php 

?>
<span data-returnval="0"></span>

<div class="container-fluid">
    <?php validation_errors(); ?>
    <?php echo form_open(); ?> 

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Service Name </label>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Enter service name" name="service_name" value="<?php echo set_value('service_name'); ?>">
            </div>
            <label class="col-md-5 col-form-label form-text text-danger">* &nbsp;<?php echo form_error('service_name');?></label>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right"> Description </label>
            <div class="col-md-4">
                <textarea class="form-control resize-vert" name="description" maxlength=100 placeholder="Enter description about service"  rows="4"><?php echo trim(set_value('description')); ?></textarea>
            </div>
            <label class="col-md-5 col-form-label form-text text-danger">* &nbsp;<?php echo form_error('description');?></label>
        </div>
    </form>
</div>

