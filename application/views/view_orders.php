<html>  
 <head>  
   <title><?php echo $title; ?></title>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
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
                width:900px;  
                padding:20px;  
                background-color:#fff;  
                border:1px solid #ccc;  
                border-radius:5px;  
                margin-top:10px;  
           }  
      </style>  
 </head>  
 <body>  
      <div class="container box">  
           <h3 align="center"><?php echo $title; ?></h3><br />  
           <div class="table-responsive">  
                <br />  
                <table id="user_data" class="table table-bordered table-striped">  
                     <thead>  
                          <tr>  
                               <th width="10%">Order Id</th>  
                               <th width="35%">Full name</th>  
                               <th width="35%">Order Date</th>  
                               <th width="10%">Delivery Date</th>  
                               <th width="10%">status</th>  
                               <th width="10%">View Order</th>  
                               <th width="10%">Assign Order</th>  
                               
                          </tr>  
                     </thead>  
                </table>  
           </div>  
      </div>  
 </body>  
 </html>  
 <script type="text/javascript" language="javascript">
  $(document).ready(function(){  
      var dataTable = $('#user_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'view_orders_controller/fetch_orders'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 1, 2, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
 });  
 </script>  