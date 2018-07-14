<div class="body_id">
    <div class="container">  
        <h3 align="left"><?php echo $title; ?></h3>
        <br/>
        <div class="row">
            <div class="col-md-4">
                <?php echo form_dropdown('services', set_value('services'), '', 'class="form-control"'); ?>
            </div>
        </div>
        
        <br><br>
        <table id="item_price" class="table table-bordered table-striped" width="100%">  
            <thead>  
            <tr>  
                <th width="5%">Current Items</th>  
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

    $('#item_price').DataTable();

    $('[name="services"]').change(function(){

        var id = $(this).children(":selected").attr("value");

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

    function fill_details(id){
       
    }
    

    $(document).on('change', 'input[type="checkbox"]', function(e){

        if($(this).is(":checked"))
        {
            $("#price").prop('readonly', false);
        }
        else
        {
       
        }
    });

    $(document).on('click', '.add', function(){


    });
});  
</script>