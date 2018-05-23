
$(document).ready(function(){
    $('#sidebarToggle').on('click', function(){
        $('#sidebar').animate({width: 'toggle', opacity: 'toggle'});
    });
});