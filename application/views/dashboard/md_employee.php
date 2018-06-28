<span data-returnval="0"></span>

<div class="container-fluid">
    <?php echo validation_errors(); ?>
    <?php echo form_open('form')?>
        <div class="row form-group">
            <div class="col-md-3"><label> Full Name </label></div>
            <div class="col-md-6"><input class="form-control" type="text" name="full_name"></div>
        </div>
        
        <div class="row form-group">
            <div class="col-md-3"><label> Address </label></div>
            <div class="col-md-6"><textarea class="form-control" name="address" id="" rows="4"></textarea></div>
        </div>

        <div class="row form-group">
            <div class="col-md-3"><label> Email </label></div>
            <div class="col-md-6"><input class="form-control" type="text" name="email"></div>
        </div>
        
        <div class="row form-group">
            <div class="col-md-3"><label> Contact No </label></div>
            <div class="col-md-6"><input class="form-control" type="text" name="contact_no"></div>
        </div>
    </form>
</div>

