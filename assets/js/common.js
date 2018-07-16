$(document).ready(function(){

    let baseURL = $('body').data('baseurl');
    
    //Modal variables
    let modal = $('.modal');
    let md_head = $('.modal-header');
    let md_title = $('.modal-title');
    let md_body = $('.modal-body');
    
    let md_foot = $('.modal-footer');
    let md_submit = md_foot.find('#btn-submit');

    //Clear Function
    function md_clear()
    {
        //console.log(' common.js :: md_clear()');
        md_title.html('');
        md_body.empty();
        md_submit.show();
        md_submit.off('click');
        md_submit.html('Add');
    };

    modal.on('hide.bs.modal', function()
    {
        //Dont add this event in other boilerplate
        //It will auto invoke from here
        setTimeout(md_clear, 300); 
    }); 

    //Initailze Plugins
    $('[data-toggle="tooltip"]').tooltip(); 

    //Callback Functions
    $('#add-emp').click(function(){

        md_clear();
        md_title.html('<span class="fa fa-user-plus"></span> <span class="col-form-label">&nbsp;Add Employee</span>');
        md_submit.html('Add Employee');

        $.post(baseURL + 'Dashboard_Controller/md_employee', function (data){
            md_body.html(data);
        });
        
        md_submit.on('click', function(e){
            e.preventDefault();

            console.log('Add');
            let postData = {
                full_name: md_body.find('input[name="full_name"]').val(),
                address: md_body.find('textarea[name="address"]').val(),
                email: md_body.find('input[name="email"]').val(),
                contact_no: md_body.find('input[name="contact_no"]').val()
            };
            let postReq = $.post(baseURL + 'Dashboard_Controller/add_employee', postData);
            
            postReq.done(function(data){
                md_body.html(data);
                let returnval = md_body.find('span').data('returnval');

                if (returnval == "1")
                {
                    //On Successful Send, and the return
                    md_submit.hide();   
                }

                else if (returnval == "0")
                {
                    // todo : Error or nothing
                }
            });
        });
    });

    $('#add-service').click(function(){
        md_clear();
        md_title.html('<span class="fa fa-list-ul"></span> <span class="col-form-label">&nbsp;Add Service</span>');
        md_submit.html('Add Service');

        $.post(baseURL + 'Dashboard_Controller/md_service', function (data){
            md_body.html(data);
        });

        md_submit.click(function(e){
            e.preventDefault();

            let service_data = {
                service_name: md_body.find('input[name="service_name"]').val(),
                description: md_body.find('textarea[name="description"]').val(),
            };
            let service_req = $.post(baseURL + 'Dashboard_Controller/add_service', service_data);
            
            service_req.done(function(data){
                md_body.html(data);
                let service_val = md_body.find('span').data('returnval');

                if (service_val == "1")
                {
                    //On Successful Send, and the return
                    md_submit.hide();   
                }

                else if (service_val == "0")
                {
                    // todo : Error or nothing
                }
            });
        });
    });

    $('#add-item').click(function(){
        md_clear();
        md_title.html('<span class="fa fa-clone"></span> <span class="col-form-label">&nbsp;Add Item</span>');
        md_submit.html('Add Item');
        $.post(baseURL + 'Dashboard_Controller/md_item', function (data){
            md_body.html(data);
        });

        md_submit.click(function(e){
            e.preventDefault();

            let item_data = {
                item_name: md_body.find('input[name="item_name"]').val(),
            };
            let item_req = $.post(baseURL + 'Dashboard_Controller/add_item', item_data);
            
            item_req.done(function(data){
                md_body.html(data);
                let item_val = md_body.find('span').data('returnval');

                if (item_val == "1")
                {
                    //On Successful Send, and the return
                    md_submit.hide();   
                }

                else if (item_val == "0")
                {
                    // todo : Error or nothing
                }
            });
        });
    });

    // Sidebar Animation
    $('#sidebarToggle').on('click', function(){
        //Test it with collapsed to make it responsive
        $('#sidebar').animate({width: 'toggle', opacity: 'toggle'},  200);
    });
});