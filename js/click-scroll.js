//jquery-click-scroll
//by syamsul'isul' Arifin

var sectionArray = [1, 2, 3, 4, 5];

$.each(sectionArray, function(index, value){
          
     $(document).scroll(function(){
         var offsetSection = $('#' + 'section_' + value).offset().top - 0;
         var docScroll = $(document).scrollTop();
         var docScroll1 = docScroll + 1;
         
        
         if ( docScroll1 >= offsetSection ){
             $('#sidebarMenu .nav-link').removeClass('active');
             $('#sidebarMenu .nav-link:link').addClass('inactive');  
             $('#sidebarMenu .nav-item .nav-link').eq(index).addClass('active');
             $('#sidebarMenu .nav-item .nav-link').eq(index).removeClass('inactive');
         }
         
     });
    
    $('.click-scroll').eq(index).click(function(e){
        var offsetClick = $('#' + 'section_' + value).offset().top - 0;
        e.preventDefault();
        $('html, body').animate({
            'scrollTop':offsetClick
        }, 300)
    });
    
});

$(document).ready(function(){
    $('#sidebarMenu .nav-item .nav-link:link').addClass('inactive');    
    $('#sidebarMenu .nav-item .nav-link').eq(0).addClass('active');
    $('#sidebarMenu .nav-item .nav-link:link').eq(0).removeClass('inactive');
});

// Smooth scroll + activation for reviews anchor
$(function(){
    // click handler for reviews link
    $('#sidebarMenu .nav-link[href="#reviews"]').click(function(e){
        e.preventDefault();
        var offsetClick = $('#reviews').offset().top - 120; // raise target to show section header
        $('html, body').stop().animate({ scrollTop: offsetClick }, 300, function(){
            try { history.replaceState(null, null, '#reviews'); } catch(e){}
        });
        // set active class on the clicked link
        $('#sidebarMenu .nav-link').removeClass('active').addClass('inactive');
        $(this).addClass('active').removeClass('inactive');
    });

    // update active state while scrolling for reviews
    $(document).scroll(function(){
        var docScroll = $(document).scrollTop() + 20;
        if ($('#reviews').length) {
            var revTop = $('#reviews').offset().top;
            if (docScroll >= revTop) {
                $('#sidebarMenu .nav-link').removeClass('active').addClass('inactive');
                $('#sidebarMenu .nav-link[href="#reviews"]').addClass('active').removeClass('inactive');
            }
        }
    });
});