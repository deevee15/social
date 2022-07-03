$(document).ready(function() {
	$(function(){
        var hidden=true;
        $('#header_dlg_a').click(function(){
            if(hidden){
                $("#menu").slideUp(function(){
                    $("#menu").hide(500);
                });
                hidden=false;
            }
            else{
                $("#menu").slideDown(500);
                hidden=true;    
            }
        });
    });
});