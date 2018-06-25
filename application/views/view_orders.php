<html>  
 <head>  
   <title><?php echo $title; ?></title>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  

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
 </body> 
 <div id="assignOrderModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="assign_order_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Order ID <span id="order_id_label"></span> </h4>  
                     </div>  
                     <div class="modal-body">  
                     <label>Order id</label>
                     <input type="text" id="order_id" val="">
                        <br>
                          <label>Select employee</label>  
                          <select id="employeeDropdown">
                              
                          </select>  
                          <label>Order id</label>
                     <input type="text" id="employee_id" val="">                      
                     </div>  

                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" k="Assign" id="assign_employee"/>  
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
    $("#order_id").val($(this).data("id"));
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

                    $select.append($('<option></option>').attr("value",'').text("Select Employee"));
                    
                    $.each(json, function(key, value) {
                        $select.append($('<option></option>').attr("value", value.employee_id).text(value.full_name));
                    });
                }   
        })  
    });  

    $("#employeeDropdown").change(function() {
        var id = $(this).children(":selected").attr("value");
        $("#employee_id").val(id);

        assign_order();
        });

    function assign_order(){
        $(document).on('click', '#assign_employee', function(event){  
            event.preventDefault();  
           var employee_name = $('#employeeDropdown').val();  
            var order_id = $("#order_id").val();
            var employee_id= $("#employee_id").val();
            
            // var data_details={
            //         "order_id" : order_id,
            //         "employee_id" : employee_id
            //     };
            
            $.ajax({  
                type:"POST",
                url:"<?php echo site_url('view_orders_controller/assign_order')?>",  
                dataType : "JSON",
                //data : {"order_id" : 'hello',"employee_id" : 'hi'},
                // data :  $('#assign_order_form').serialize(),
                // data : {'order_id':order_id,
                //     'employee_id':employee_id},
                data: {order_id:order_id,employee_id:employee_id},
                success:function(data)  
                {  
                   if(data=="Order assigned sucessfully")
                   {
                    $('#assignOrderModal').modal('hide');  
                    dataTable.ajax.reload();  
                   }
                }  
            });  
            
           
      });  
    }

 </script>   
 </html>  
 