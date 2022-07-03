$(document).ready(function() {
	$(function(){
        var hidden=true;
        $('.slider_menu_icon').click(function(){
            if(hidden){
                $('#slider_menu').animate({left: '0px'}, 200); 
                $('body').animate({ left: '50px'}, 200);
                hidden=false;
            }
            else{
                $('#slider_menu').animate({left: '-50px'}, 200); 
                $('body').animate({ left: '0px'}, 200);
                hidden=true;    
            }
        });
        $("#slider_menu_hidden_stripe").dblclick(function(){
            if(hidden){
                $('#slider_menu').animate({left: '0px'}, 200); 
                $('body').animate({ left: '50px'}, 200);
                hidden=false;
            }
            else{
                $('#slider_menu').animate({left: '-50px'}, 200); 
                $('body').animate({ left: '0px'}, 200);
                hidden=true;
            }
        });
    });
});