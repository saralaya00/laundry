<div class="body_id">
    <div class="container">  
        <h3 align="left"><?php echo $title; ?></h3>
        <br/>
        <div class="row">
            <div class="col-md-4">
                <?php echo form_dropdown('services', set_value('services'), '', 'class="form-control" id="serviceDropdown"'); ?>
            </div>

            <div class="col-md-8">
                <button class="btn_services btn btn-secondary" data-toggle="modal" data-target="#modal-template"><span data-toggle="tooltip" data-placement="bottom" title="Edit or delete services">List of service</span></button>
                <button class="btn_items btn btn-secondary" data-toggle="modal" data-target="#modal-template"><span data-toggle="tooltip" data-placement="bottom" title="Edit or delete items">List of items</button>

            </div>
            <!-- <div class="col-md-4">
            </div> -->
            
        </div>
        
        <br><br>
        <table id="item_price" class="table table-bordered table-striped" width="100%">  
            <thead>  
            <tr>  
                <th width="5%">Serial Number</th>  
                <th width="10%">Item Name</th>  
                <th width="10%">Price</th>
                <th width="5%">Actions</th>   
            </tr>  
            </thead>  
        </table>  
    </div>  
</div>

<script type="text/javascript">
$(document).ready(function(){  
    
    let baseURL = $('body').data('baseurl');
    let modal = $('.modal');
    let mdl_head = $('.modal-header');
    let mdl_title = $('.modal-title');
    let mdl_body = $('.modal-body');
    
    let mdl_foot = $('.modal-footer');
    let mdl_submit = mdl_foot.find('#btn-submit');
    $('#item_price').DataTable();

    $('[name="services"]').change(function(){
        var id = $('#serviceDropdown').children(":selected").attr("value");
        //Preemptive clear for a change in selected Service.
        var item_service = $('#item_price').DataTable();
        item_service.destroy();

        if (id == 'placeholder')
        {
            $('#item_price').find('tbody').html('');
            $('#item_price').DataTable();
            return;
        }

        item_service = $('#item_price').DataTable({  
            
            "processing":true,  
            "serverSide":true,  
            "order":[],  
            "ajax":{  
                url: baseURL + 'ItemService_Controller/getItemServiceDetails',  
                type:"POST",
                data: {id:id},
                sucess:function(){
                    item_service.ajax.reload();  
                }
            },
            drawCallback: function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            },
            "columnDefs":[{  
                    "targets":[0, 1, 2, 3],  
                    "orderable":false,  
                },  
            ], 
        }); 
    }); 

    $(document).on('click', '.add', function(e){
        var table = $('#item_price').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        // var price = ;
        console.log(price);
        var item_name = data[1];
        service_id = $('#serviceDropdown').children(":selected").attr("value");
        let id = $(this).data("id");
        e.preventDefault();         
        $. ajax({
            url:baseURL + "ItemService_Controller/addItemService", 
            method:"POST", 
            data : {service_id:service_id,
                    id:id,
                    item_name : item_name,
                    price:price},
            success : function(){
                        table.ajax.reload();
            } 
        })
   
    });
    
    //when edit button clicked
    $(document).on('click', '.edit', function(){ 
        mdl_clear();
        mdl_title.html('<span class="fa fa-edit"></span> <span class="col-form-label">&nbsp;Edit price</span>');
        mdl_submit.html('Update');

        var table = $('#item_price').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        var t_item_name = data[1];
        var t_service_name = $('#serviceDropdown').children(":selected").text();
        var t_service_id = $('#serviceDropdown').children(":selected").attr("value");
        var t_price = data[2];
        let id = $(this).data("id");

        //to display edit modal
        $.post(baseURL + 'ItemService_Controller/md_edit', function (data){
            mdl_body.html(data);
            $('#c_service_name').text(t_service_name);
            $('#c_item_name').text(t_item_name);
            $('#c_price').text(t_price);
            $('#price').val(t_price);
            updateItem_service();
        }); 

        function updateItem_service() 
        {
            mdl_submit.click(function(e){    
                var price = $('#price').val();

                if(price == t_price){
                    alert("Please change price");
                }
                else
                {
                    e.preventDefault();         
                    $.ajax({
                        url:baseURL + "ItemService_Controller/updateItem_service", 
                        method:"POST", 
                        data : {id:id,
                                price:price},
                        success : function(){
                                    $('.modal').modal('toggle');
                                    table.ajax.reload();
                        } 
                    });
                }
            });
        }  
    });  

    //when delete button clicked
    $(document).on('click', '.delete', function(){
        let id = $(this).data("id");
        var table = $('#item_price').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        var t_item_name = data[1];
        var t_service_name = $('#serviceDropdown').children(":selected").text();
        bootbox.confirm("Are you sure want to delete " +t_service_name+" on "+t_item_name+"?", function(result) {
     
            if(result){
                $.ajax({
                    url:baseURL + "ItemService_Controller/deleteItem_service", 
                    type: 'POST',
                    data: { id:id },
                    success: function(response){
                        table.ajax.reload();
                    }
                });
            }
        });
    });    

    $(document).on('click', '.btn_items', function(){
        $.post(baseURL + 'Items_Controller')
        .done(function(data){

            mdl_title.html('<span class="fa fa-columns"></span> <span class="col-form-label">&nbsp;Items List</span>');
            mdl_submit.hide();

            mdl_body.html(data);
        });
    });

    $(document).on('click', '.btn_services', function(){
        $.post(baseURL + 'Services_Controller')
        .done(function(data){
            mdl_title.html('<span class="fa fa-columns"></span> <span class="col-form-label">&nbsp;Services List</span>');
            mdl_submit.hide();

            mdl_body.html(data);
        });
    });
});
</script>