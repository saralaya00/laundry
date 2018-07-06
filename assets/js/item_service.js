
$(document).ready(function(){  
    //All orders table
    var tableUserData = $('#item_service').DataTable({  
        "processing":true,  
        "serverSide":true,  
        "order":[],  
        "ajax":{  
            url: baseURL + 'Item_service_controller/getItemServiceDetails',  
            type:"POST"  
        },  
        "columnDefs":[{  
                "targets":[0, 1, 2, 3, 4],  
                "orderable":false,  
            },  
        ],  
    });  

  
    $(document).on('click', '.edit', function(){ 
        mdl_clear();
        mdl_title.html('Edit Order');
        mdl_submit.html('Update');
    
        // let id = $(this).data("id");
        $.post(baseURL + 'Item_service_controller/md_edit', function (data){
            mdl_body.html(data);
           // getEmployee(order_id);
        });   
    
    });
    
    
});