$(document).ready(function() {
	$(function(){
        var timer;
        //
        $('#friends,#followers,#wall,#photos,#show').hide();
        //
        var wall = $('#wall').height()+40, photos = $('#photos').height()+40, friends = $('#friends').height()+40, followers = $('#followers').height()+40;
        var margin_wall = wall+30, margin_photos = photos+30, margin_friends = friends+30, margin_followers = followers+30;
        var wall_showed = 0, photos_showed = 0, friends_showed = 0, followers_showed = 0;
        var wall_write_showed = 0;
        $('.wall_write').hide();
        //
        var showed_form = true;
        $('.div_comment').hide();
        //
        $('.profile_friendadded_list').hide();
        var slided_friendlist = true;
        $('.profile_hesubscribed_list').hide();
        var slided_sublist = true;
        //
        $('.wall_vl').hide();$('.photos_vl').hide();$('.friends_vl').hide();$('.followers_vl').hide();$('.audios_vl').hide();$('.videos_vl').hide();
        var avatar_path = $('.profile_avatar_img').attr('src');
        $('.points_list_wall').click(function(){
            $('#wall').css({"margin-top":-margin_wall});
            $('#wall').show();
            $('#points').css({"margin-top":wall});
            wall_showed = 1;
            if(photos_showed==1){
                $('#photos').css({"margin-top":"0"});
                $('#photos').hide();
                photos_showed = 0;
            }
            else if(friends_showed==1 || followers_showed==1){
                $('#friends,#followers').css({"margin-top":"0"});
                $('#friends,#followers').hide();
                friends_showed = 0;followers_showed = 0;
            }
        });
        $('.title_close').click(function(){
            $('#wall,#friends,#photos,#followers').css({"margin-top":"0"});
            $('#wall,#friends,#photos,#followers').hide();
            $('#points').css({"margin-top":"20px"});
            $('.wall_show').css({"max-height":"400px"});
        });
        $('.wall_title').click(function(){
            if(wall_write_showed==0){
                $('.wall_show').hide(500);
                $('.wall_write').show(500);
                $('#points').css({"margin-top":"220px"});
                $('#wall').css({"margin-top":"-240px"});
                wall_write_showed = 1;
            }
            else{
                $('.wall_write').hide(500);
                $('.wall_show').show(500);
                $('#points').css({"margin-top":wall});
                $('#wall').css({"margin-top":-margin_wall});
                wall_write_showed = 0;
            }
        });
        $('.wall_title_full').click(function(){
            $('.wall_show').css({"max-height":"100%"});
        });
        $('.points_list_photos').click(function(){
            if(wall_showed==1){
                $('#wall').css({"margin-top":"0"});
                $('#wall').hide();
                wall_showed = 0;
            }
            else if(friends_showed==1 || followers_showed==1){
                $('#friends,#followers').css({"margin-top":"0"});
                $('#friends,#followers').hide();
                friends_showed = 0;followers_showed = 0;
            }
            $('#photos').css({"margin-top":-margin_photos});
            $('#photos').show();
            $('#points').css({"margin-top":photos});
            photos_showed = 1;
        });
        $('.profile_avatar_img').click(function(){
            $('#show').show(500);
            $('#profile').hide(500);
            $('.show_file img').attr("src",avatar_path);
            $('.show_author_title').html("аватар");
            $(".show_file img").data("id", "0");
            $(".show_file img").data("type", "avatar");
        });
        $('.photos_show_img').click(function(){
            $('#show').show(500);
            $('#profile').hide(500);
            var photos_path = $(this).attr('src');
            $('.show_file img').attr("src",photos_path);
            var photo_id = $(".photos_show_img").data("photoid");
            $('.show_author_title').html("фотография со стены");
            $(".show_file img").data("id", photo_id);
            $(".show_file img").data("type", "wall");
        });
        $('.points_list_friends').click(function(){
            if(wall_showed==1){
                $('#wall').css({"margin-top":"0"});
                $('#wall').hide();
                wall_showed = 0;
            }
            else if(photos_showed==1){
                $('#photos').css({"margin-top":"0"});
                $('#photos').hide();
                photos_showed = 0;
            }
            else if(followers_showed==1){
                $('#followers').css({"margin-top":"0"});
                $('#followers').hide();
                followers_showed = 0;
            }
            $('#friends').css({"margin-top":-margin_friends});
            $('#friends').show();
            $('#points').css({"margin-top":friends});
            friends_showed = 1;
        });
        $('.points_list_followers').click(function(){
            if(wall_showed==1){
                $('#wall').css({"margin-top":"0"});
                $('#wall').hide();
                wall_showed = 0;
            }
            else if(photos_showed==1){
                $('#photos').css({"margin-top":"0"});
                $('#photos').hide();
                photos_showed = 0;
            }
            else if(friends_showed==1){
                $('#friends').css({"margin-top":"0"});
                $('#friends').hide();
                friends_showed = 0;
            }
            $('#followers').css({"margin-top":-margin_followers});
            $('#followers').show();
            $('#points').css({"margin-top":followers});
            followers_showed = 1;
        });
        //
        $('.show_close').click(function(){
            $('#show').hide(500);
            $('#profile').show(500);
            $('.show_file img').attr("src","");
            $('.show_author_title').html("");
        });
        //
        $('.first_comment_button').click(function(){
            if(showed_form){
                showed_form=false;
                $('.div_comment').show(500);
            }
            else{
                showed_form=true;
                $('.div_comment').hide(500);
            }
        });
        //
        $('.points_list_wall').hover(function(){
            clearTimeout(timer);
            var obj = $('.wall_vl').show(300);
            obj.addClass('active');
            timer = setTimeout(function() {
                $('.wall_vl').hide();
            }, 12000);
        });
        $('.points_list_friends').hover(function(){
            clearTimeout(timer);
            var obj = $('.friends_vl').show(300);
            obj.addClass('active');
            timer = setTimeout(function() {
                $('.friends_vl').hide();
            }, 12000);
        });
        $('.points_list_followers').hover(function(){
            clearTimeout(timer);
            var obj = $('.followers_vl').show(300);
            obj.addClass('active');
            timer = setTimeout(function() {
                $('.followers_vl').hide();
            }, 12000);
        });
        $('.points_list_photos').hover(function(){
            clearTimeout(timer);
            var obj = $('.photos_vl').show(300);
            obj.addClass('active');
            timer = setTimeout(function() {
                $('.photos_vl').hide();
            }, 12000);
        });
        $('.points_list_audios').hover(function(){
            clearTimeout(timer);
            var obj = $('.audios_vl').show(300);
            obj.addClass('active');
            timer = setTimeout(function() {
                $('.audios_vl').hide();
            }, 12000);
        });
        $('.points_list_videos').hover(function(){
            clearTimeout(timer);
            var obj = $('.videos_vl').show(300);
            obj.addClass('active');
            timer = setTimeout(function() {
                $('.videos_vl').hide();
            }, 12000);
        });
        //
        $('.profile_friendadded_button').click(function(){
            if(slided_friendlist){
            $('.profile_friendadded_list').slideDown(300);slided_friendlist=false;$('.profile_friendadded_button').css({"border-bottom":"1px solid #b6dcfc"});}
            else{
                $('.profile_friendadded_list').slideUp(function(){
                     $('.profile_friendadded_list').hide(300);$('.profile_friendadded_button').css({"border-bottom":"1px solid #cbe7fd"});
                });
                slided_friendlist=true;}
        });
        $('.profile_hesubscribed_button').click(function(){
            if(slided_sublist){
            $('.profile_hesubscribed_list').slideDown(300);slided_sublist=false;$('.profile_hesubscribed_button').css({"border-bottom":"1px solid #b6dcfc"});}
            else{
                $('.profile_hesubscribed_list').slideUp(function(){
                     $('.profile_hesubscribed_list').hide(300);$('.profile_hesubscribed_button').css({"border-bottom":"1px solid #cbe7fd"});
                });
                slided_sublist=true;}
        });
        //
        $('.file_settings_like_a').click(function(){
            var get_data1 = $(".show_file_img").data("id");
            var get_data2 = $(".show_file_img").data("type");
            var get_data3 = $(".show_file_img").data("authorid");
            var url = "/settings/like.php?id="+get_data3+"&type="+get_data2+"&fid="+get_data1;
            $(location).attr('href',url);
        });
    });
});