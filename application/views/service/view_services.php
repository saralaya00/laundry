<div class="container-fluid">
    <div class="table-responsive">
        <table id="table_services_list" class="table table-striped table-bordered" width="100%">
            <thead>
                <tr>
                    <th width="33%">Service ID</th>
                    <th width="33%">Service Name</th>
                    <th width="34%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        $('#table_services_list').DataTable({
            "ajax" : {
                url: '<?php echo site_url('Services_Controller/fetch_services')?>',
                type: 'GET'
            },

            drawCallback: function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            }
        });
    });
</script>