$(document).ready(function(){
    $(function(){
        $('.profile_sendmes_form').hide();
        $('.profile_sendmes_button').click(function(){
            $('.profile_sendmes_form').slideDown(500);
        });
        var b_expand_clicked = true;
        $('.bexpand_mestext').click(function(){
            var btn_msgplate=$(this).attr('alt');
            var length_msg=$('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p span').text().length;
            var calculate_lpoints=length_msg/25;
            var plusheight=80+(calculate_lpoints*35);
            if(b_expand_clicked){
                $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"overflow":"visible"});
                if(plusheight<=900){$('.messages_show_user[alt='+btn_msgplate+']').css({"height":plusheight});}
                else{
                    $('.messages_show_user[alt='+btn_msgplate+']').css({"height":"900px"});
                    $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"max-height":"870px"});
                    $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"width":"400px"});
                    $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"overflow-y":"auto"});
                }
                b_expand_clicked=false;
            }
            else{
                $('.messages_show_user[alt='+btn_msgplate+']').css({"height":"80px"});
                $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"max-height":"50px"});
                $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"width":"250px"});
                $('.messages_show_user[alt='+btn_msgplate+'] .messages_show_user_lastmsg p').css({"overflow-y":"hidden"});
                b_expand_clicked=true;
            }
        })
    });
});