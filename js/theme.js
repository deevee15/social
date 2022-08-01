$(document).ready(function() {
	$(function(){
        var mode=1;
        $('.header_menu_showed_theme_a').bind("click",function(){
            if($('.header_menu_showed_theme_night').is(':visible')){mode=0;}
            else{mode=1;}
            $.ajax({
                url: "/getdark.php",
                type:"POST",
                  data:({ mode: mode }),
                  dataType: "html",
                  success: function (data) {
                    if(data==1){
                        $('#additional_css').attr('href','/css/optimization/darkacc.css');
                        $('.header_menu_showed_theme_day').hide();
                        $('.header_menu_showed_theme_night').show();
                    }
                    else{
                        $('#additional_css').attr('href','');
                        $('.header_menu_showed_theme_night').hide();
                        $('.header_menu_showed_theme_day').show();
                    }
                }
            }); 
        });
        $('.footer_nightmode').click(function(){
            if($('.footer_nightmode_nightnow').is(':visible')){mode=0;}
            else{mode=1;}
            $.ajax({
                url: "/getdark.php",
                type:"POST",
                  data:({ mode: mode }),
                  dataType: "html",
                  success: function (data) {
                    if(data==1){
                        $('#additional_css').attr('href','/css/optimization/darkindex.css');
                        $('.footer_nightmode_daynow').hide();
                        $('.footer_nightmode_nightnow').show();
                    }
                    else{
                        $('#additional_css').attr('href','');
                        $('.footer_nightmode_daynow').show();
                        $('.footer_nightmode_nightnow').hide();
                    }
                }
            }); 
        });
    });
});