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
                          <h4 class="modal-title">Order ID <span id="order_id"></span> </h4>  
                     </div>  
                     <div class="modal-body">  
                       
                        <br>
                          <label>Select employee</label>  
                          <select id="employeeDropdown">
                              
                          </select>                        
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
    $("#order_id").text($(this).data("id"));
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
                            console.log(key, value);
                            $select.append($('<option></option>').attr("id", value.employee_id).text(value.full_name));
                        
                        });
                    }   
            })  
      });  

      $("#employeeDropdown").change(function() {
            var id = $(this).children(":selected").attr("id");
            assign_order(id);
            });

    function assign_order(id){
        $(document).on('submit', '#assign_order_form', function(event){  
            event.preventDefault();  
           // var employee_name = $('#employeeDropdown').val();  
            var order_id = $("#order_id").text();
            var employee_id=id;

            var data_details={
                    employee_id : employee_id,
                  //  employee_name : employee_name,
                    order_id : order_id
                };

            if(employee_name != 'Select Employee')  
            {  
                    $.ajax({  
                        url:"<?php echo base_url() . 'view_orders_controller/assign_order'?>",  
                        method:'POST',  
                        data:data_details,  
                        contentType:false,  
                        processData:false,  
                        success:function(data)  
                        {  
                            alert(data);  
                            $('#assign_order_form')[0].reset();  
                            $('#assignOrderModal').modal('hide');  
                            dataTable.ajax.reload();  
                        }  
                    });  
            }  
            else  
            {  
                    alert("Select employee");  
            }  
      });  
    }
 </script>   
 </html>  
 