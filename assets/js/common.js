$(document).ready(function(){

    var baseURL = $('body').data('baseurl');
    
    //Modal variables
    var md_head = $('.modal-header');
    var md_title = $('.modal-title');
    var md_body = $('.modal-body');
    
    var md_foot = $('.modal-footer');
    var md_submit = md_foot.find('input');

    //Clear Function
    function md_clear()
    {
        md_title.html('');
        md_body.html('');
        md_submit.val('Add');
    };

    $('#add-emp').click(function(){

        md_clear();
        md_title.html('Add Employee');
        
        $.post(baseURL + 'Dashboard_Controller/md_employee', function (data){
            md_body.html(data);
        });
        
        md_submit.val('Add Employee');
        //md_add_emp();

        md_submit.click(function(e){
            e.preventDefault();
            var postData = {
                full_name: md_body.find('input[name="full_name"]').val(),
                address: md_body.find('textarea[name="address"]').val(),
                email: md_body.find('input[name="email"]').val(),
                contact_no: md_body.find('input[name="contact_no"]').val()
            };
            var postReq = $.post(baseURL + 'Dashboard_Controller/add_employee', postData);

            postReq.done(function(data){
                md_body.html(data);
                md_submit.hide();
            });
        });
    });

    function md_add_emp()
    {
        md_submit.on('click', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: siteURL + 'Dashboard_Controller/add_employee',
                dataType: "JSON",
                data: { 
                    full_name: md_body.find('input[name="full_name"]').val(),
                    address: md_body.find('textarea[name="address"]').val(),
                    email: md_body.find('input[name="email"]').val(),
                    contact_no: md_body.find('input[name="contact_no"]').val()
                },
                success: function(data){
                    $('.page-wrapper').html(data);
                }
            });
        });
    }

    $('#add-service').click(function(){
        md_clear();
        md_title.html('Add Service');
        md_foot.find('input').val('Add Service');
    });

    $('#add-item').click(function(){
        md_title.html('Add Item');
        md_foot.find('input').val('Add Item');
    });


    // Sidebar Animation
    $('#sidebarToggle').on('click', function(){
        //Test it with collapsed to make it responsive
        $('#sidebar').animate({width: 'toggle', opacity: 'toggle'},  500);
    });
});