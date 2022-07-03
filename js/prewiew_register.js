$(document).ready(function() {
	$(function(){
        $('.u2').hide();
        var u2_hidden = true;
        $('.button_right,.button_left').click(function(){
            if(u2_hidden){
                $('.u2').show(800);
                $('.u1').hide(800);
                u2_hidden = false;
            }
            else{
                $('.u1').show(800);
                $('.u2').hide(800);
                u2_hidden = true;
            }
        });
    });
});