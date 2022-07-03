$(document).ready(function(){
    $(function(){
        function lightlogin(){
            $('.auth_login').css({'border-color':'#e93939'});
            //$('.auth_login').css("box-shadow","0 0 1px red");
            setTimeout(function(){
            $('.auth_login').removeAttr('style');
            },700);
        }
        function lightpassword(){
            $('.auth_password').css({'border-color':'#e93939'});
            //$('.auth_password').css("box-shadow","0 0 1px red");
            setTimeout(function(){
            $('.auth_password').removeAttr('style');
            },700);
        }
        $('.auth_submit').click(function(){
            var login = $('.auth_login').val();
            var pass = $('.auth_password').val();
            var l_length = $(".auth_login").val().length;
            var p_length = $(".auth_password").val().length;
            if(login=='' && pass==''){
                lightlogin();
                lightpassword();
                return false;
            }
            else if(login==''){
                lightlogin();
                return false;
            }
            else if(pass==''){
                lightpassword();
                return false;
            }
            else if(l_length<6){
                $('.info').text("Логин от 6 символов");
                return false;
            }
            else if(p_length<5){
                $('.info').text("Пароль от 5 символов");
                return false;
            }
        });
    });
});
