
<h3 align="center"></h3><br />  
<!-- display basic details of order -->
<div class="container-fluid text-center">
    <div >
        <label for=""  id="order_id_label">Order Id: <span id="order_id"><?php echo $order_id; ?></span></label>
        <br>
        <label for=""  id="order_date_label">Order Date:<span id="order_date"> <?php echo $order_date; ?>  </span></label>
        <br>
        <label for=""  id="customer_name_label">Customer Name: <span id="customer_name"><?php echo $full_name; ?></span> </label>
        <br>
        <label for="" id="delivery_date_label">Delivery Date:<span id="delivery_date"> <?php echo $delivery_date; ?></span></label>
        <br>
    </div>
</div>
<!-- display order details -->
<div class="container-fluid">  
    <div class="table-responsive">  
        <br /><br />  
        <table id="itemdletails" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>  
                        <th width="15%">Serial No.</th>  
                        <th width="20%">Item Name</th>
                        <th width="20%">Service Name</th>  
                        <th width="15%">Quantity</th>  
                        <th width="15%">Price</th> 
                        <th width="15%">Total</th>   
                    </tr>  
                </thead>  
        </table>  
    </div>  
</div>  
<script type="text/javascript">

//  View order details
var order_id = $('#order_id').text();
var tableItemdletails = $('#itemdletails').DataTable({  
    "processing":true,  
    "serverSide":true,  
    "order":[],  
    "ajax":{  
                url: baseURL + 'view_orders_controller/fetchOrderDetails',//fetch order details
                type:"POST",
                data : {order_id : order_id},
            },  
    "columnDefs":[{  
            "targets":[0, 1, 2, 3, 4, 5],  
            "orderable":false,  
        },  
    ],  
});  
</script>