//base URL
let baseURL = $('body').data('baseurl');

//Modal variables
let mdl_head = $('.modal-header');
let mdl_title = $('.modal-title');
let mdl_body = $('.modal-body');

let mdl_foot = $('.modal-footer');
let mdl_submit = mdl_foot.find('#btn-submit');

function mdl_clear()
{
    mdl_title.html('');
    mdl_body.html('');
    mdl_submit.show();
    mdl_submit.html('Add');
};

$(document).ready(function(){  
    //All orders table
    var tableUserData = $('#order_data').DataTable({  
        "processing":true,  
        "serverSide":true,  
        "order":[],  
        "ajax":{  
            url: baseURL + 'View_orders_controller/fetch_orders',  
            type:"POST"  
        },  
        "columnDefs":[{  
                "targets":[0, 1, 2, 3, 4],  
                "orderable":false,  
            },  
        ],  
    });  
});

$(document).on('click', '.viewOrder', function(){
    event.preventDefault();
    //fill label text
    var order_id = $(this).data("id");
    var table = $('#order_data').DataTable();
    var data = table.row( $(this).parents('tr') ).data();
    var full_name = data[1];
    var order_date = data[2];
    var delivery_date = data[3];
    $. ajax({
        url:baseURL + "view_orders_controller/viewOrderDetailsPage",
        method:"POST", 
        data : {order_id : order_id,
                full_name : full_name,
                order_date : order_date,
                delivery_date : delivery_date},
        dataType :"json",
        success : function(result){ 
                    $(".body_id").html(result);
                    var order_id = $('#order_id').text();

                    //View order details
                    var tableItemdletails = $('#itemdletails').DataTable({  
                        "processing":true,  
                        "serverSide":true,  
                        "order":[],  
                        "ajax":{  
                                    url: baseURL + 'view_orders_controller/fetchOrderDetails',  
                                    type:"POST",
                                    data : {order_id : order_id},
                                },  
                        "columnDefs":[{  
                                "targets":[0, 1, 2, 3, 4, 5],  
                                "orderable":false,  
                            },  
                        ],  
                    });  
                },
        error: function(data){
        }
    })
})


//Assign Order button in View orders clicked
$(document).on('click', '.assign', function(){ 
    mdl_clear();
    mdl_title.html('<span class="fa fa-user-plus"></span> <span class="col-form-label">&nbsp;Assign Order</span>');
    mdl_submit.html('Assign Order');

    let order_id = $(this).data("id");
    $.post(baseURL + 'View_orders_controller/md_assignOrder', function (data){
        mdl_body.html(data);
        getEmployee(order_id);
    });   
    //fill dropdown of assignOrder modal
    function getEmployee(order_id){
        $("#order_id").text(order_id);
        $.ajax({  
            url : baseURL + "view_orders_controller/get_employee", 
            method:"POST",   
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            jsonpCallback: 'callback', 
            success: function(json){
                var $select = $('#employeeDropdown');
                $select.empty();
    
                $select.append($('<option></option>').attr("value",'').text("Select Employee"));
                
                $.each(json, function(key, value){
                    $select.append($('<option></option>').attr("value", value.employee_id).text(value.full_name));
                });

                $("#employeeDropdown").change(function(){
                    var id = $(this).children(":selected").attr("value");
                    assign_order(id);
                }); 
            }   
        })  
    } 
    //Assign Employee button in assign_order modal clicked
    function assign_order(id){
        mdl_submit.click(function(e){  
            e.preventDefault();  
            var order_id = $("#order_id").text();
            var employee_id= id;
           
            $.ajax({  
                type:"POST",
                url:baseURL + "view_orders_controller/assign_order",  
                data: {order_id:order_id,employee_id:employee_id},
                dataType :'JSON',
                cache: "false",
                success:function(data)  
                {  
                    alert("Order assigned successfuly");
                    location.reload();
                }   
            });  
        });  
    }  
});

//Change Employee button in View orders clicked
$(document).on('click', '.changeEmployee', function(){ 
    let order_id = $(this).data("id");
    mdl_clear();
    mdl_title.html('<span class="fa fa-exchange"></span> <span class="col-form-label">&nbsp;Change Employee</span>');
    mdl_submit.html('Change Employee');
    
    $.post(baseURL + 'View_orders_controller/md_changeEmployee', function (data){
        mdl_body.html(data);
        changeEmployee(order_id);
    });

    //Fill labels of change Employee page
    function changeEmployee(order_id){
        $("#change_order_id").text(order_id);
        var order_id =  $("#change_order_id").text();
        $.ajax({
                url:baseURL + "view_orders_controller/getEmployeeName", 
                method:"POST",   
                data : {order_id:order_id},
                dataType: "json",
                success : function(employee_name){

                    $("#employee_name").text(employee_name);
                    fill_employee(employee_name,order_id);

                }
        })
    }

    //Fill dropdown of change employee
    function fill_employee(employee_name,order_id)
    {
        $.ajax({  
            url:baseURL + "view_orders_controller/get_employee", 
            method:"POST",   
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            jsonpCallback: 'callback', 
            success: function(json) {
                var $select = $('#changeEmployeeDropdown');
                $select.empty();
                
                $select.append($('<option></option>').attr("value",'').text("Change Employee"));

                $.each(json, function(key, value) {
                    $select.append($('<option name="options"></option>').attr("value", value.employee_id).text(value.full_name));
                });

                $("#changeEmployeeDropdown").change(function() {
                    var employee_id = $(this).children(":selected").attr("value");
                    var order_id = $('#change_order_id').text();
                    updateEmployeeID(employee_id,order_id);  
                });
            }   
        }) 
    }

    //Change Employee button in change Employee Modal clicked
    function updateEmployeeID(employee_id,order_id) 
    {
        mdl_submit.click(function(e){    
            e.preventDefault();         
            $. ajax({
                url:baseURL + "view_orders_controller/updateEmployeeId", 
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
});











