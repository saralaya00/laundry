<html>
  <head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/mystyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  
   <!-- <script type="text/javascript" src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css" />
    <link rel="stylesheet" href="assets/css/mystyle.css">-->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      
  <style> 
      body  
            {  
                    margin:0;  
                    padding:0;  
                    background-color:#f1f1f1;  
            }  
            .box  
            { 
                   overflow-y: auto;
                   height: 700px;
                    background-color:#fff;  
                    border:1px solid #ccc;  
                    border-radius:5px;  
                    padding-top: 50px;
                   
            }  
            </style>
  </head>
<body class="fix-header fix-sidebar">
  <div id="main-wrapper">
    <div class="header">
      <nav class="navbar top-navbar navbar-expand-md navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <!-- Logo icon -->
                <b><img src="assets/icons/cloth.png" class="profile-pic" style="max-width: width 20px;max-height:30px;margin-top:-5px;" /></b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span> <b> Laundry </b> </span>
            </a>
          </div>
          <div class="navbar-header navbar-right pull-right">
            <ul class="nav pull-right">
              <li class="pull-right"><a href="#"><i class="fas fa-sign-out-alt"></i></a></li>
              <li class="pull-right"><a href="#"><i class="fas fa-clipboard-list"></i></a></li>
              <li class="pull-right"><a href="#"><i class="fas fa-bell"></i></a></li>
              <li class="pull-right"><a href="#"><i class="fas fa-cart-arrow-down"></i></a></li>
              <li class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="far fa-thumbs-up"></i></a> 
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div> <!--/.navbar-right -->
                                      
        </div>
      </nav>
    </div>
    <!-- end of header part-->
    <!--display services -->
    <div class="container-fluid">
      <div class="row">   
        <div class="col-sm-3 box">
          <?php
            if(count($fetch_data) > 0)
            {
              foreach($fetch_data as $row)
              {?>
                <div>
                  <button type="button" class="btn btn-success displayitems" data-id="<?php echo $row['service_id'] ?>" style=" padding:10%; margin:12%; width:50%;" ><?php echo $row['service_name']; ?></button><br/>
                </div>
              <?php
              }
            }
            else
            {?>
              <div>No data found</div>
            <?php
            }?>
        </div>
        <div class="col-sm-1"></div>      
        <div class="col-sm-8 box container-fluid">
          <h3 align="center"><?php echo $title; ?></h3>
          <br/>
            <div class="table-responsive">
              <br/>
              <table id="order_details" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="20%">Serial No</th>
                    <th width="35%">Item</th>
                    <th width="35%">Rate</th>
                    <th width="35%">Quantity</th>
                    <th width="35%">Price</th>
                    <th width="35%">select</th>
                  </tr>    
                </thead>  
              </table>
            </div>   
        </div> 
      </div>
    </div>
    <!-- end of display services -->
    <!--space>-->
    <div class="container-fluid">
        <div class="row">
            </br>
        </div>
    </div>
    <!-- end of space>-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-10"></div>   
          <div class="col-sm-2">
            <button data-id = "" class="placeOrder btn btn-success" data-toggle="modal" data-target="#placeOrderModal" disabled>Place Order</button>
          </div>
            <footer class="footer">
              <div class="container">
                <span class="text-muted">&copy; 2017 | pooja v tendulkar.| All rigths reserved.</span>
              </div>
            </footer>
      </div>
    </div>  
  </div><!--end of main wrappper-->
  <div class="modal fade" id="placeOrderModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Your Order Successful</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <br/>
            <table id="view_order_details" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="20%">Serial No</th>
                  <th width="35%">Service</th>
                  <th width="35%">Item</th>
                  <th width="35%">Quantity</th>
                  <th width="35%">Price</th>
                </tr>    
              </thead>  
            </table>
          </div>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default Edit" data-dismiss="modal">Edit Order</button>
          <button type="button" class="btn btn-default submit" data-dismiss="modal">Submit Order</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $(document).on('click', '.displayitems', function(event){
        event.preventDefault();
        //fill label text
        var service_id = $(this).data("id");
        var item_service = $('#order_details').DataTable();    
        item_service.destroy();

        var dataTable = $('#order_details').DataTable({
          "processing":true, 
          "serverSide":true,
          "order":[],
          "ajax":{
              url:"<?php echo base_url().'Customer_Controller/getItemServiceDetails';?>",
              type:"POST",
              data : {service_id : service_id}
          },
          "columnDefs":[
              {
                  "targets":[0,1,2,3,4,5], 
                  "orderable":false,
              }
          ]
        });
    });

    $(document).on('input', '.text_qty', function(){
          let text_qty = $(this);
          let slno = text_qty.data('slno');
          let qty = text_qty.val().trim();
          let id = text_qty.data('id');
          let check_box = '#'+id;//id of check_box to disable
          let rate = $('label[name="lbl-rate-' + slno + '"]').html();

          if (!$.isNumeric(qty) || (qty < 1 || qty > 99) )
          {
            text_qty.val(qty);
            text_qty.val('');
            $('input[name="txt-total-' + slno + '"]').val(0);
            $(check_box).prop('disabled', true);//enable check bo

          }

          else 
          {
            text_qty.val(qty);
            $('input[name="txt-total-' + slno + '"]').val( qty * rate);
            $(check_box).prop('disabled', false);//enable 
          }
    });

    $(document).on('change','.check_order',function(){
      let id = $(this).data('id');
      let service_id = $(this).data('service_id');
      let slno =  $(this).data('slno');
      let order_details = $('#order_details').DataTable();
      let data = order_details.row( $(this).parents('tr') ).data();
      let item_name = data[1];
      
      let customer_id = <?php echo set_value('customer_id'); ?>;
      let text_box = $('input[name="quantity-' + id + '"]');
      let quantity = text_box.val();
      if(this.checked)
      {
        $.ajax({
            url:"<?php echo base_url().'Customer_Controller/place_order_details';?>",
            type:"POST",
            data : {id : id,
                    customer_id : customer_id,
                    service_id : service_id,
                    item_name : item_name,
                    quantity : quantity},
            success:function(data)  
            {  
              data = JSON.parse(data);
              // alert(data);
              $('.placeOrder').prop('disabled', false);
              $('.placeOrder').attr('data-id',data);
              $('.submit').attr('data-id',data);
              
            }   
        });  
      }
      else{
          var qty = ".Quantity-"+id;
          var price = ".Price-"+id;
          // console.log(qty);
          $(qty).html('<input type="text" name="quantity-' + id +'" maxlength=2 class="text_qty form-control" data-slno="' + slno +'" size="3">');
          $(price).html('<input type="text" class="form-control" name="txt-total-'+slno+'" size="3" readonly>',);

          $.ajax({
              url:"<?php echo base_url().'Customer_Controller/remove_order_details';?>",
              type:"POST",
              data : {customer_id : customer_id,
                      service_id : service_id,
                      item_name : item_name
                    },
              success:function(data)  
              {  
                  
              }   
          });  
      }
    });
    $(document).on('click', '.placeOrder', function(event){
      let order_id = $(this).data('id');

      var view_order_details = $('#view_order_details').DataTable();    
      view_order_details.destroy();

      var dataTable = $('#view_order_details').DataTable({
        "processing":true, 
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"<?php echo base_url().'Customer_Controller/fetchOrderDetails';?>",
            type:"POST",
            data : {order_id : order_id}
        },
        "columnDefs":[
            {
                "targets":[0,1,2,3,4], 
                "orderable":false,
            }
        ]
      });
    });
    
    $(document).on('click', '.submit', function(event){
      let order_id = $(this).data('id');
    
      $.ajax({
        url:"<?php echo base_url().'Customer_Controller/update_status';?>",
        type:"POST",
        data : {order_id : order_id},
        success:function(data)  
        {  
          
        }   
      });  
    });

    $(document).on('click', '.Edit', function(event){
      $('.placeOrder').modal('hide');
    });

  });
  </script>
</body>   
<!-- <script>



 </script> -->
 </html>
 



