$(document).ready(function() {
	$(function(){
        $('.settings').hide();
        var clicked = true;
        $('.header_enter').click(function(){
            if(clicked){
                $('.settings').show();
                $('.header_enter').css({"background":"#2a9efc"});
                clicked = false;
            }
            else{
                $('.settings').hide();
                $('.header_enter').css({"background":"0"});
                clicked = true;
            }
        });
    });
});