<div class="body_id">
    <div class="container box">  
        <h3 align="left"><?php echo $title; ?></h3><br />  
        <div class="table-responsive">  
            <br /><br />  
            <table id="item_price" class="table table-bordered table-striped" width="100%">  
                <thead>  
                    <tr>  
                        <th width="10%">Huccha</th>  
                        <th width="15%">Item Name</th>  
                        <th width="10%">Price</th>
                        <th width="5%">Actions</th>   
                    </tr>  
                </thead>  
            </table>  
        </div>  
    </div>  
</div>

<script type="text/javascript">
$(document).ready(function(){  
    var item_service = $('#item_price').DataTable({  
        "processing":true,  
        "serverSide":true,  
        "order":[],  
        "ajax":{  
            url: baseURL + 'ItemService_Controller/getItemServiceDetails',  
            type:"POST"  
        },  
        "columnDefs":[{  
                "targets":[0, 1, 2, 3],  
                "orderable":false,  
            },  
        ], 
    }); 
});  
</script>