<div class="container-fluid">
    <!-- <div class="table-responsive"> -->
        <table id="table_services_list" class="table table-striped table-bordered" width="100%">
            <thead>
                <tr>
                    <th width="33%">Service ID</th>
                    <th width="33%">Service Name</th>
                    <!-- <th width="34%">Action</th> -->
                </tr>
            </thead>
        </table>
    <!-- </div> -->
</div>

<script>
$(document).ready(function(){
    let baseURL = $('body').data('baseurl');
    let modal = $('.modal');
    let mdl_head = $('.modal-header');
    let mdl_title = $('.modal-title');
    let mdl_body = $('.modal-body');
    
    let mdl_foot = $('.modal-footer');
    let mdl_submit = mdl_foot.find('#btn-submit');

    //Clear Function
    function mdl_clear()
    {
        //console.log(' common.js :: md_clear()');
        mdl_title.html('');
        mdl_body.empty();
        mdl_submit.show();
        mdl_submit.off('click');
        mdl_submit.html('Add');
    };
    
    $('#table_services_list').DataTable({
        "ajax" : {
            url: '<?php echo site_url('Services_Controller/fetch_services')?>',
            type: 'GET'
        },

        drawCallback: function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        }
    });


    //   $(document).on('click', '.btn_delete', function(){
    //     let service_id = $(this).data("service_id");
    //     var table = $('#table_services_list').DataTable();
    //     var data = table.row( $(this).parents('tr') ).data();
    //     var service_name = data[1];
    //     bootbox.confirm("Are you sure want to delete " +service_name+"?", function(result) {
     
    //         if(result){
    //             $.ajax({
    //                 url:baseURL + "Services_Controller/delete_service", 
    //                 type: 'POST',
    //                 data: { service_id:service_id },
    //                 success: function(response){
    //                    table.ajax.reload();
    //                 }
    //             });
    //         }
    //     });
    // });
});  
</script>