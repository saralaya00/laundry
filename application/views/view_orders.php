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
    <div class="body_id">
        <div class="container box">  
            <h3 align="center"><?php echo $title; ?></h3><br />  
            <div class="table-responsive">  
                <br /><br />  
                    <table id="user_data" class="table table-bordered table-striped">  
                        <thead>  
                            <tr>  
                                <th width="10%">Order Id</th>  
                                <th width="35%" id="full_name">Full name</th>  
                                <th width="35%">Order Date</th>  
                                <th width="35%">Delivery Date</th>  
                                <th width="35%">status</th>  
                                <th width="10%">View Order</th>  
                                <th width="10%">Assign Order</th>     
                            </tr>  
                        </thead>  
                    </table>  
            </div>  
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
                        <div class="form_group">
                            <br>
                            <label class="form_control">Select employee</label>  
                            <select class="form_control" id="employeeDropdown">
                                
                            </select>  
                        </div>
                     </div>  
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success form_control" k="Assign" id="assign_employee"/>  
                          <button type="button" class="btn btn-default form_control" data-dismiss="modal" id="close">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>   

 <div id="changeEmployeeModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="assign_order_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     </div>  
                     <div class="modal-body">  
                        <div class="form_group">
                            <label class="form_control">Order ID <span id="change_order_id"></span> has been assigned to <span id="employee_name"></span></label>  
                            <br>
                            <label class="form_control">Change employee</label>  
                            <select id="changeEmployeeDropdown" class="form_control">
                                
                            </select>  
                        </div>
                     </div>  
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" k="Change" id="change_employee"/>  
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
        "columnDefs":[{  
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
            
            $.each(json, function(key, value){
                $select.append($('<option></option>').attr("value", value.employee_id).text(value.full_name));
            });
        }   
    })  
});  

$("#employeeDropdown").change(function(){
    var id = $(this).children(":selected").attr("value");
    assign_order(id);
});

function assign_order(id){
    $(document).on('click', '#assign_employee', function(event){  
        event.preventDefault();  
        var order_id = $("#order_id").text();
        var employee_id= id;
        
        $.ajax({  
            type:"POST",
            url:"<?php echo site_url('view_orders_controller/assign_order')?>",  
            data: {order_id:order_id,employee_id:employee_id},
            dataType :'JSON',
            cache: "false",
            success:function(data)  
            {  
                dataTable.ajax.reload();  
            }  
            
        });  
        
        alert("Order assigned successfuly");
        $('#assignOrderModal').modal('hide');  
        location.reload();
    });  
}

$(document).on('click', '.changeEmployee', function(){     
    $("#change_order_id").text($(this).data("id"));
    var order_id =  $("#change_order_id").text();
    $.ajax({
            url:"<?php echo base_url(); ?>view_orders_controller/getEmployeeName", 
            method:"POST",   
            data : {order_id:order_id},
            dataType: "json",
            success : function(employee_name){
                $("#employee_name").text(employee_name);
                fill_employee(employee_name,order_id)
            }
        })
    
    function fill_employee(employee_name,order_id)
    {
        $.ajax({  
            url:"<?php echo base_url(); ?>view_orders_controller/get_employee", 
            method:"POST",   
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            jsonpCallback: 'callback', 
            success: function(json) {
                $('#changeEmployeeModal').modal('show');  
            
                var $select = $('#changeEmployeeDropdown');
                $select.empty();
                
                $select.append($('<option></option>').attr("value",'').text("Change Employee"));

                $.each(json, function(key, value) {
                    $select.append($('<option name="options"></option>').attr("value", value.employee_id).text(value.full_name));
                });
            }   
        }) 
    }
})

$("#changeEmployeeDropdown").change(function() {
            var employee_id = $(this).children(":selected").attr("value");
            var order_id = $('#change_order_id').text();
            updateEmployeeID(employee_id,order_id);  
});

function updateEmployeeID(employee_id,order_id)
{
    $(document).on('click', '#change_employee', function(event){  
        event.preventDefault();         
        $. ajax({
            url:"<?php echo base_url(); ?>view_orders_controller/updateEmployeeId", 
            method:"POST", 
            data : {employee_id:employee_id,
                    order_id:order_id},
            success : function(){
                        alert("Employee changed successfully");
                        $('#assignOrderModal').modal('hide');  
                        location.reload();
                    } 
        })
    })
}

$(document).on('click', '.viewOrder', function(){
    event.preventDefault();
    var order_id = $(this).data("id");
    var table = $('#user_data').DataTable();
    var data = table.row( $(this).parents('tr') ).data();
    var full_name = data[1];
    var order_date = data[2];
    var delivery_date = data[3];
    $. ajax({
            url:"<?php echo base_url(); ?>view_orders_controller/viewOrderDetailsPage",
            method:"POST", 
            data : {order_id : order_id,
                    full_name : full_name,
                    order_date : order_date,
                    delivery_date : delivery_date},
            dataType :"json",
            success : function(result){ 
                       $(".body_id").html(result);
                    },
            error: function(data){
              
            }
        })

})
</script>   
 </html>  
 