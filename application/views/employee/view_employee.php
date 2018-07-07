<div class="container">
    <h3 class="center"><?php echo $title; ?></h3>
    <br>
    <div class="table-responsive">
        <table id="table_emp" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="10%">Employee ID</th>
                    <th width="15%">Full Name</th>
                    <th width="35%">Address</th>
                    <th width="20%">Email</th>
                    <th width="10%">Contact No</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        //$.getScript('<?php echo base_url( 'assets/js/common.js');?>');

        //let common_js = document.createElement("script");
        //common_js.src = '<?php echo base_url( 'assets/js/common.js');?>';

        $('#table_emp').DataTable({
            "ajax" : {
                url: '<?php echo site_url('Employee_Controller/get_employees')?>',
                type: 'GET'
            }
        });

        $(document).on('click', '.btn_edit', function(){
            console.log($(this).data('employee_id'));
        });
        
        $(document).on('click', '.btn_delete', function(){
            common_js.md_clear();
            
            // $(this).data('employee_id');
            // $.post('<?php echo base_url();?>')
        });
    });
</script>