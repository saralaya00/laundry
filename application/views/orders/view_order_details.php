
    <h3 align="center"></h3><br />  
    <div class="container box text-center">
        <div >
            <label for=""  id="order_id_label">Order Id: <span id="order_id"><?php echo $order_id; ?></span></label>
            <br>
            <label for=""  id="order_date_label">Order Date:<span id="order_date"> <?php echo $full_name; ?> </span></label>
            <br>
            <label for=""  id="customer_name_label">Customer Name: <span id="customer_name"><?php echo $order_date; ?></span> </label>
            <br>
            <label for="" id="delivery_date_label">Delivery Date:<span id="delivery_date"> <?php echo $delivery_date; ?></span></label>
            <br>
        </div>
    </div>
    <div class="container box">  
        <div class="table-responsive">  
            <br /><br />  
            <table id="itemDetails" class="table table-bordered table-striped">  
                    <thead>
                    <!-- <input type="text" class="form-control" id="bookSearch" placeholder="Search book..."> -->
                        <tr>  
                            <th width="15%">Serial No.</th>  
                            <th width="25%">Item Name</th>
                            <th width="25%">Service Name</th>  
                            <th width="25%">Quantity</th>  
                            <th width="25%">Price</th> 
                            <th width="35%">Total</th>   
                        </tr>  
                    </thead>  
            </table>  
        </div>  
    </div>  