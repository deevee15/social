$(document).ready(function() {
	$(function(){
        $('#show').hide();
        //
        var showed_form = true;
        $('.div_comment').hide();
        //
        $('.photos_show_avatar_img').click(function(){
            $('#show').show(500);
            var avatar_path = $(this).attr('src');
            $('.show_file img').attr("src",avatar_path);
            $('.show_author_title').html("аватар");
            $('.photos_show').hide(500);
        });
        $('.photos_show_wallphs_img').click(function(){
            $('#show').show(500);
            var wallph_path = $(this).attr('src');
            $('.show_file img').attr("src",wallph_path);
            $('.show_author_title').html("фотография со стены");
            $('.photos_show').hide(500);
        });
        //
        $('.show_close').click(function(){
            $('#show').hide(500);
            $('.photos_show').show(500);
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
    });
});