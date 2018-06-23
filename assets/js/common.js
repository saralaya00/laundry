$(document).ready(function(){

    //Modal variables
    var md_head = $('.modal-header');
    var md_title = $('.modal-title');
    var md_body = $('.modal-body');
    var md_foot = $('.modal-footer');

    //Clear Function
    // $('.modal').click(function()
    // {
    //     md_title.html('');
    //     md_foot.find('input').val('Add');
    // });

    $('#add-emp').click(function(){
        md_title.html('Add Employee');
        md_foot.find('input').val('Add Employee');
    });

    $('#add-service').click(function(){
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