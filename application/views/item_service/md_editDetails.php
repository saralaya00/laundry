<div class="container-fluid">
<div class="form-group row">
        <div class="col-md-12">
            <label class="col-form-label text-left current_status">Current Price is Rs.<span id="c_price"></span> </label> 
        </div>
    </div>
    <div class="form-group row justify-content-center">
        <!-- <label class="col-md-12 col-form-label text-right">Id <span id="id"></span></label>  -->
        <!-- <div class="col-md-4">
            <input  type="checkbox" name="price_check" value="price_check" id="price_check" onclick = "showTextPrice()"><label class="col-form-label text-right">Edit price</label>
        </div>  
        <div class="col-md-4">
            <input type="checkbox" name="item_check" value="item_check" id="item_check" onclick = "showItemDropdown()" ><label class="col-form-label text-right">Edit Item details</label>   
        </div>
        <div class="col-md-4">
            <input  type="checkbox" name="service_check" value="service_check" id="service_check" onclick = "showServiceDropdown()"><label class="col-form-label text-right">Edit service details</label>  
        </div>
         -->

    </div>
    <div class="form-group-12">
    <!-- <label class="col-form-label text-right">Edit price</label> -->
    </div>
    <div class="form-group row">
             <label class="col-md-3 col-form-label text-left">Edit price </label>
            <div class="col-md-4">
                <input type="text" id="price" class="form-control price">
            </div>
        <!-- <div class="col-md-4">
        <label class="col-form-label text-right">Edit price</label>
        </div> -->
        <!-- <div class="col-md-4" >
            <div id="itemDropdownDiv" >
                <select id="itemDropdown" class="form_control col-md-6 itemDropdown">

                </select> 
            </div>
        </div>
        <div class="col-md-4">
            <select id="serviceDropdown" class="form_control col-md-6 serviceDropdown"> 

            </select> 
        </div> -->
        
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <label class="col-form-label text-left status">Update price Rs.<span id="u_price"></span> </label> 
        </div>
    </div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
    // $(".itemDropdown").hide();
    // $(".serviceDropdown").hide();
    // $("#price").hide();
    $(".status").hide();
 });



</script>