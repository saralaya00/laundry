<html>  
 <head>  
   <title><?php echo $title; ?></title>  
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
              <br /><br />  
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
      <div id="userModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="user_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add User</h4>  
                     </div>  
                     <div class="modal-body">  
                          <label>Enter First Name</label>  
                          <input type="text" name="first_name" id="first_name" class="form-control" />  
                          <br />  
                          <label>Enter Last Name</label>  
                          <input type="text" name="last_name" id="last_name" class="form-control" />  
                          <br />  
                          <label>Select User Image</label>  
                          <input type="file" name="user_image" id="user_image" />  
                     </div>  
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" value="Add" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>  
 </body> 
 <div id="assignOrderModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="user_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add User</h4>  
                     </div>  
                     <div class="modal-body">  
                        <label>Order Id</label>
                        <label id="order_id"></label>
                          <label>Select employee</label>  
                          <select id="employeeDropdown">
                              
                          </select>                        
                     </div>  
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" value="Add" id="assign_employee"/>  
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>   

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
  $(document).on('click', '.assign', function(){  
           $.ajax({  
                    url:"<?php echo base_url(); ?>view_orders_controller/get_employee", 
                    method:"POST",   
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    jsonpCallback: 'callback', 
                    success: function(json) {
                    $('#assignOrderModal').modal('show');  
                        var $select = $('#employeeDropdown');
                        $select.empty();

                        $select.append($('<option></option>').attr("value", '').text("Select Employee"));
                        
                        $.each(json, function(value, key) {
                            $select.append($('<option></option>').attr("value", value).text(key));
                        
                        });
                    }   
            })  
      });  
    $(document).on('click', '#assign_employee', function(){  
           $.ajax({  
                    url:"<?php echo base_url(); ?>view_orders_controller/assign_order", 
                    method:"POST",   
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    jsonpCallback: 'callback', 
                    success: function(json) {
                    $('#assignOrderModal').modal('show');  
                        var $select = $('#employeeDropdown');
                        $select.empty();

                        $select.append($('<option></option>').attr("value", '').text("Select Employee"));
                        
                        $.each(json, function(value, key) {
                            $select.append($('<option></option>').attr("value", value).text(key));
                        
                        });
                    }   
            })  
      });  
 </script>   
 </html>  
 