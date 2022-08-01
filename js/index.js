$(document).ready(function() {
	$(function(){
        $('.right_bslogin').click(function(){
            $('#login').show();
            $('#right, #left').hide();
        });
        $('.login_choice_back, .login_logo svg').click(function(){
            $('#login').hide();
            $('#right, #left').show();
        });
        $('.right_bsungup').click(function(){
            $('#login, #right').hide();
            $('#registration').addClass("showed");
        }); 
        $('.registration_logo svg').click(function(){
            $('#registration').removeClass("showed");
            $('#right').show();
        });
        var lang_slided=true;
        $('.footer_ul_lang span').click(function(){
            if(lang_slided){
                $('.ul_lang_list').css({"margin-top":"-19.9vh"});
                $('.footer_ul_lang svg').addClass('slided');
                lang_slided=false;
            }
            else{
                $('.ul_lang_list').css({"margin-top":"0"});
                $('.footer_ul_lang svg').removeClass('slided');
                lang_slided=true;
            }
        });
    });
});