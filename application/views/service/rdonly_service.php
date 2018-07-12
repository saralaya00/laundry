<?php
?>

<span data-returnval="1"></span>

<div class="container-fluid">
    <div class="form-group row">
        <label class="col-md-3 col-form-label text-right"> Service name </label>
        <label class="col-md-4 col-form-label"> <?php echo set_value('service_name'); ?> </label>
    </div>
    
    <div class="form-group row">
        <label class="col-md-3 col-form-label text-right"> Description </label>
        <div class="col-md-4">
            <textarea readonly class="form-control resize-vert" rows="4"><?php echo trim(set_value('description')); ?></textarea>
        </div>
    </div>

     <div class="form-group row">
        <label class="col-md-12 col-form-label text-primary text-center"> <?php echo set_value('message'); ?> </label>
    </div>  
</div>

