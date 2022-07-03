$(document).ready(function() {
	$(function(){
        $('.fgtn_info').hide();
        var nhovered = true;
        $('.frtnacc_hoverzone').hover(
            function(){
                $('.fgtn_info').show(300);
            },
            function(){
                $('.fgtn_info').hide(300);
            });
    });
});