<?php
    // Employee View, with Datatables
?>
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
        
        let baseURL = $('body').data('baseurl');
    
        //Modal variables
        let md_head = $('.modal-header');
        let md_title = $('.modal-title');
        let md_body = $('.modal-body');
        
        let md_foot = $('.modal-footer');
        let md_submit = md_foot.find('#btn-submit');

        //Clear Function
        function md_clear()
        {
            md_title.html('');
            md_body.html('');
            md_submit.show();
            md_submit.html('Add');
        };

        //Initialze Plugins
        $('[data-toggle="tooltip"]').tooltip(); 

        $('#table_emp').DataTable({
            "ajax" : {
                url: '<?php echo site_url('Employee_Controller/get_employees')?>',
                type: 'GET'
            },

            drawCallback: function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            }
        });

        $(document).on('click', '.btn_edit', function(){

            md_clear();
            md_title.html('Edit Employee');
            md_submit.html('Update');

            let employee_id = $(this).data('employee_id');

            $.post(baseURL + 'Employee_Controller/view_update_employee/' + employee_id, function(data){
                md_body.html(data);
            });

            // md_submit.click(function(e){
            //     e.preventDefault();

            //     let postRequest = $.post(baseURL + 'Employee_Controller/update_employee/' + employee_id);
                
            //     postRequest.done(function(data){
                    
            //         md_submit.hide();
            //     });
            // });
        });
        
        $(document).on('click', '.btn_delete', function(){
            
            md_clear();
            md_title.html('Remove Employee');
            md_submit.html('Delete');

            let employee_id = $(this).data('employee_id');
            let user_id = $(this).data('user_id');

            $.post(baseURL + 'Employee_Controller/view_delete_employee/' + employee_id, function(data){
                md_body.html(data);
            });
            
            md_submit.click(function(e){
                e.preventDefault();

                let postRequest = $.post(baseURL + 'Employee_Controller/delete_employee/' + user_id);
                
                postRequest.done(function(data){
                    location.reload();
                });
            });
        });
    });
</script>