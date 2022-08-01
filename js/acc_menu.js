$(document).ready(function() {
	$(function(){
        $('.settings').hide();
        $('.mainstripe_photos_name,.mainstripe_photos_backb,.info_sendmes,.post_edit_form_all,.wall_post_settings p,#send').hide();
        var clicked = true;
        $('.header_account').click(function(){
            if(clicked){
                $('.settings').show();
                $('.header_account').css({"background":"#2a9efc"});
                clicked = false;
            }
            else{
                $('.settings').hide();
                $('.header_account').css({"background":"0"});
                clicked = true;
            }
        });
        $('.slider_menu_icon').click(function(){
            $(this).toggleClass('active');
        });
        //new
        $('.header_menu_user').click(function(){
            $('.header_menu_showed').toggleClass('showed');
            $('.header_menu_user_button').toggleClass('clicked');
        });
        var get_ava=$('.photo_show_img').attr('src');
        var get_avaid=$('.photo_show_img').attr('firstid');
        var get_owner=$('.photo_show_img').attr('owner');
        $('.photos_list img').click(function(){
            //iteraction with photos block in acc.php
            if($(window).width()<1800){$('html, body').stop().animate({scrollTop : 0}, 300);}
            var get_id=$(this).attr('data-photoid');
            $('.photo_show_img').attr('src', '/user/photos/'+get_id);
            //
            var process=get_id.replace('.jpg','');
            var process_2=process.replace(get_owner+'/','');
            $('.photo_show_img').attr('object_id', process_2);
            $('.photo_show_img').attr('type', '2');
            //
            $('.photo_settings_saveb').attr('href','/user/photos/'+get_id);
            //check likes in photo
            $.ajax({
                url: "/settings/checklike.php?owner="+get_owner,
                type:"POST",
                data:({ type: 2, object_id: process_2 }),
                dataType: "html",
                success: function (data) {
                    if(data=='is'){$('.photo_info_liketext').text('Liked');$('.photo_info_avatar_likes').addClass('liked');}
                    else{$('.photo_info_liketext').text('Like');$('.photo_info_avatar_likes').removeClass('liked');}
                }
            });
            //
            $.ajax({
                url: "/settings/getlikes.php?owner="+get_owner,
                type:"POST",
                data:({ type: 2, object_id: process_2 }),
                dataType: "html",
                success: function (data) {
                    $('.photo_info_getlike').html(data);
                }
            });
            //
            $('.mainstripe_online, .mainstripe_name').hide();
            $('.mainstripe_photos_name,.mainstripe_photos_backb').show();
            $('.photo_show_img').addClass('changed');
            setTimeout(function(){
                $('.photo_show_img').removeClass('changed');
            }, 2000);
        });
        $('.mainstripe_photos_backb').click(function(){
            $('.photo_show_img').attr('src', get_ava);
            $('.photo_settings_saveb').attr('href',get_ava);
            //
            $('.photo_show_img').attr('object_id', get_avaid);
            $('.photo_show_img').attr('type', '1');
            //
            $('.mainstripe_online, .mainstripe_name').show();
            $('.mainstripe_photos_name,.mainstripe_photos_backb').hide();
            $('.photo_show_img').removeClass('changed');
            var get_photosposy=$('#photos').offset().top;
            var get_photosposy_1=get_photosposy-100;
            if($(window).width()<1800){$("html, body").animate({scrollTop: get_photosposy_1});}
            //
            $.ajax({
                url: "/settings/checklike.php?owner="+get_owner,
                type:"POST",
                data:({ type: 1, object_id: $('.photo_show_img').attr('object_id') }),
                dataType: "html",
                success: function (data) {
                    if(data=='is'){
                        $('.photo_info_liketext').text('Liked');
                        $('.photo_info_avatar_likes').addClass('liked');
                    }
                    else{$('.photo_info_liketext').text('Like');$('.photo_info_avatar_likes').removeClass('liked');}
                }
            });
            //
            $.ajax({
                url: "/settings/getlikes.php?owner="+get_owner,
                type:"POST",
                data:({ type: 1, object_id: $('.photo_show_img').attr('object_id') }),
                dataType: "html",
                success: function (data) {
                    $('.photo_info_getlike').html(data);
                }
            });
        });
        $('.info_left_msg').click(function(){
            $('.info_sendmes').show(200);
            $('.info_left,.info_right').hide();
        });
        $('.info_sendmes_close').click(function(){
            $('.info_sendmes').hide();
            $('.info_left,.info_right').show(200);
        });
        $('.header_logo_link svg').click(function(){
             $('html, body').stop().animate({scrollTop : 0}, 300);
        });
        /*Send message panel*/
        $('.friends_list_fr_msgb').click(function(){
            var getid=$(this).attr('friendid');
            var getava=$(this).attr('avatar');
            var getname=$(this).attr('name');
            var getn=$(this).attr('n');
            $('#send').show();
            $('.send-panel p span').text(getname);
            $('.block-button span').text(getn);
            $('.send-panel img').attr('src',getava);
        }); 
        $('.send-cover').click(function(){
            $('#send').hide();
            $('.send-panel textarea').val('');
        });
    });
});