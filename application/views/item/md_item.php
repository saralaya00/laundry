<?php 

?>
<span data-returnval="0"></span>

<div class="container-fluid">
    <?php validation_errors(); ?>
    <?php echo form_open(); ?> 

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right">Item Name </label>
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="Enter item name" name="item_name" value="<?php echo set_value('item_name'); ?>">
            </div>
            <label class="col-md-5 col-form-label form-text text-danger">* &nbsp;<?php echo form_error('item_name');?></label>
        </div>
        
    </form>
</div>

