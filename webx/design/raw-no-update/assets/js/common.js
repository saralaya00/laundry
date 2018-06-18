
$(document).ready(function(){
    $('#sidebarToggle').on('click', function(){
        //Test it with collapsed to make it responsive
        $('#sidebar').animate({width: 'toggle', opacity: 'toggle'});
        //$('#sidebar').toggle('fold');
        
    });
});