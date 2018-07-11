$(document).ready(function(){

    let baseURL = $('body').data('baseurl');
    
    //Modal variables
    let modal = $('.modal');
    let md_head = $('.modal-header');
    let md_title = $('.modal-title');
    let md_body = $('.modal-body');
    
    let md_foot = $('.modal-footer');
    let md_submit = md_foot.find('#btn-submit');

    modal.on('hide.bs.modal', function(){
        md_clear();
    });

    //Clear Function
    function md_clear()
    {
        md_title.html('');
        md_body.html('');
        md_submit.show();
        md_submit.html('Add');
    };

    //Initailze Plugins
    $('[data-toggle="tooltip"]').tooltip(); 

    //Callback Functions
    $('#add-emp').click(function(){

        md_clear();
        md_title.html('Add Employee');
        md_submit.html('Add Employee');

        $.post(baseURL + 'Dashboard_Controller/md_employee', function (data){
            md_body.html(data);
        });
        
        md_submit.click(function(e){
            e.preventDefault();

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
        md_title.html('Add Service');
        md_submit.html('Add Service');
    });

    $('#add-item').click(function(){
        md_title.html('Add Item');
        md_submit.html('Add Item');
    });

    // Sidebar Animation
    $('#sidebarToggle').on('click', function(){
        //Test it with collapsed to make it responsive
        $('#sidebar').animate({width: 'toggle', opacity: 'toggle'},  200);
    });
});