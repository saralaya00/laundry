<html>  
 <head>  
   <title>Order details</title>  
 
</head>  
<body>  
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
                        <tr>  
                            <th width="35%">Item Name</th>
                            <th width="35%">Service Name</th>  
                            <th width="35%">Quantity</th>  
                            <th width="35%">Price</th> 
                            <!-- <th width="35%">Total</th>    -->
                        </tr>  
                    </thead>  
            </table>  
        </div>  
    </div>  
 </body> 
 <script type="text/javascript" language="javascript">
   $(document).ready(function(){  
    var order_id = $('#order_id').text();
    console.log(order_id);

    // $.ajax({  
    //         url:"<?php echo base_url() . 'view_orders_controller/fetchOrderDetails'; ?>",  
    //         type:"POST",
    //         data : {order_id : order_id},
    //         dataType : 'json',
    //         successs : function(data)
    //                     {
                            
    //                     }  
    //     })  
    var dataTable = $('#itemDetails').DataTable({  
        "processing":true,  
        "serverSide":true,  
        "order":[],  
        "ajax":{  
                    url:"<?php echo base_url() . 'view_orders_controller/fetchOrderDetails'; ?>",  
                    type:"POST",
                    data : {order_id : order_id},
                },  
        "columnDefs":[{  
                "targets":[0, 1, 2, 3],  
                "orderable":false,  
            },  
        ],  
    });  
});
 </script>
 </html>