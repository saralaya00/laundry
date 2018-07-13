
$(document).ready(function(){  
    //All orders table
  
    var item_service = $('#item_service').DataTable({  
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

    //when edit button clicked
    $(document).on('click', '.edit', function(){ 
        mdl_clear();
        mdl_title.html('Edit Order');
        mdl_submit.html('Update');

        var table = $('#item_service').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        var t_item_name = data[1];
        var t_service_name = data[2];
        var t_price = data[3];
        let id = $(this).data("id");

        //to display edit modal
        $.post(baseURL + 'Item_service_controller/md_edit', function (data){
            mdl_body.html(data);
            $('#c_service_name').text(t_service_name);
            $('#c_item_name').text(t_item_name);
            $('#c_price').text(t_price);
            $('#price').val(t_price);
            // getItem();
            // getService();
            updateItem_service();
        }); 

        // function getItem(){
        //     $.ajax({  
        //         url : baseURL + "Item_service_controller/getItem", 
        //         method:"POST",   
        //         contentType: "application/json; charset=utf-8",
        //         dataType: "json",
        //         jsonpCallback: 'callback', 
        //         success: function(json){
        //             var $select = $('#itemDropdown');
        //             $select.empty();
        
        //             $select.append($('<option></option>').attr("value",'').text("Change Item"));
                    
        //             $.each(json, function(key, value){
        //                 $select.append($('<option></option>').attr("value", value.item_id).text(value.item_name));
        //             });

        //             $("#itemDropdown").change(function(){
        //                 display();
        //             });
        //         }   
        //     })  
        // }  

        // function getService(){
        //     $.ajax({  
        //         url : baseURL + "Item_service_controller/getService", 
        //         method:"POST",   
        //         contentType: "application/json; charset=utf-8",
        //         dataType: "json",
        //         jsonpCallback: 'callback', 
        //         success: function(json){
        //             var $select = $('#serviceDropdown');
        //             $select.empty();
        
        //             $select.append($('<option></option>').attr("value",'').text("Change Service"));
                    
        //             $.each(json, function(key, value){
        //                 $select.append($('<option></option>').attr("value", value.service_id).text(value.service_name));
        //             });

        //             $("#serviceDropdown").change(function(){
        //                display(); 
        //             }); 
        //         }   
        //     })  
        // }
        function updateItem_service() 
        {
            mdl_submit.click(function(e){    
                var service_name = $('#u_service_name').text();
                var item_name = $('#u_item_name').text();
                var price = $('#u_price').text();

                if(service_name == t_service_name && item_name == t_item_name && price == t_price){
                    alert("Details are same can't update...Please edit details");
                }
                else{
                        e.preventDefault();         
                    $. ajax({
                        url:baseURL + "Item_service_controller/updateItem_service", 
                        method:"POST", 
                        data : {id:id,
                                service_name:service_name,
                                item_name:item_name,
                                price:price},
                        success : function(){
                                    alert("Updated successfully");
                                    location.reload();
                        } 
                    })
                } 
            })
        }  
    });

    $(document).on('click', '.delete', function(){
        let id = $(this).data("id");
        var table = $('#item_service').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        var t_item_name = data[1];
        var t_service_name = data[2];
        bootbox.confirm("Are you sure want to delete " +t_service_name+" on "+t_item_name+"?", function(result) {
     
            if(result){
                $.ajax({
                    url:baseURL + "Item_service_controller/deleteItem_service", 
                    type: 'POST',
                    data: { id:id },
                    success: function(response){
                        alert("deleted successfully");
                        location.reload();
                    }
                });
            }
        });
    });    
});
// function showTextPrice()
// {
//     $('#price_check').change(function() {
//         if(this.checked) {
//             $('.price').show();
//         }
//         else{
//             $('.price').hide();
//         }
//     });
// }
// function showItemDropdown(){
//     $('#item_check').change(function() {
//         if(this.checked) {
//             $('.itemDropdown').show();
//         }
//         else{
//             $('.itemDropdown').hide();
//         }
//     });
// }
// function showServiceDropdown(){
//     $('#service_check').change(function() {
//         if(this.checked) {
//             $('.serviceDropdown').show();
//         }
//         else{
//             $('.serviceDropdown').hide();
//         }
//     });
// }
function display(){
    $price = $('#price').val();
    // var item_name = $('#itemDropdown').children(":selected").text();
    // var service_name = $('#serviceDropdown').children(":selected").text();

    var t_service_name = $('#c_service_name').text();
    var t_item_name = $('#c_item_name').text();
    var t_price = $('#c_price').text();
    $('.status').show();
    $('#u_price').text($price);
    $('#u_item_name').text(t_item_name);
    $('#u_service_name').text(t_service_name);
    //     $('#u_item_name').text(t_item_name);
    //don't edit anything
    // if((item_name == "Change Item" || item_name == undefined) && (service_name == "Change Service" || service_name == undefined) && ($price == "" || $price == undefined))
    // {
    //     $('#u_service_name').text(t_service_name);
    //     $('#u_item_name').text(t_item_name);
    //     $('#u_price').text(t_price);
    // }
    // //edit item only
    // else if((item_name != "Change Item" || item_name != undefined) && (service_name == "Change Service" || service_name == undefined) && ($price == "" || $price == undefined))
    // {
    //     $('#u_service_name').text(t_service_name);
    //     $('#u_item_name').text(item_name);
    //     $('#u_price').text(t_price);
    // }
    // //edit service only
    // else if((item_name == "Change Item" || item_name == undefined) && (service_name != "Change Service" || service_name != undefined) && ($price == "" || $price == undefined))
    // {
    //     $('#u_service_name').text(service_name);
    //     $('#u_item_name').text(t_item_name);
    //     $('#u_price').text(t_price);
    // }
    // //edit price only
    // else if((item_name == "Change Item" || item_name == undefined) && (service_name == "Change Service" || service_name == undefined) && ($price != "" || $price != undefined))
    // {
    //     $('#u_service_name').text(t_service_name);
    //     $('#u_item_name').text(t_item_name);
    //     $('#u_price').text($price);
    // }
    // //edit item and service
    // else if((item_name != "Change Item" || item_name != undefined) && (service_name != "Change Service" || service_name != undefined) && ($price == "" || $price == undefined))
    // {
    //     $('#u_service_name').text(service_name);
    //     $('#u_item_name').text(item_name);
    //     $('#u_price').text(t_price);
    // }
    // //edit item and price
    // else if((item_name != "Change Item" || item_name != undefined) && (service_name == "Change Service" || service_name == undefined) && ($price != "" || $price != undefined))
    // {
    //     $('#u_service_name').text(t_service_name);
    //     $('#u_item_name').text(item_name);
    //     $('#u_price').text($price);
    // }
    // //edit service and item
    // else if((item_name == "Change Item" || item_name == undefined) && (service_name != "Change Service" || service_name != undefined) && ($price != "" || $price != undefined))
    // {
    //     $('#u_service_name').text(service_name);
    //     $('#u_item_name').text(t_item_name);
    //     $('#u_price').text($price);
    // }
    // //edit all
    // else
    // {
    //     console.log("if 8");
    //     $('#u_service_name').text(service_name);
    //     $('#u_item_name').text(item_name);
    //     $('#u_price').text($price);
    // }
}




