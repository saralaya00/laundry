$(document).ready(function () 
{    
  $('[data-toggle="offcanvas"]').click(function () {
    $('#wrapper').toggleClass('toggled');
  });  
});

/*
var trigger = $('#sidebarToggle'),
isClosed = false;

trigger.click(function () {
 hamburger_cross();      
});

function hamburger_cross() {

 if (isClosed == true) {          
   trigger.removeClass('is-open');
   trigger.addClass('is-closed');
   isClosed = false;
 } else {   
   trigger.removeClass('is-closed');
   trigger.addClass('is-open');
   isClosed = true;
 }
}*/ 