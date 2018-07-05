
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
});