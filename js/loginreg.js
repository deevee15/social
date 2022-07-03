$(document).ready(function() {
	$(function(){
        $('.content_news_hidetext').hide();
        $('.form_reg').hide();
        //$('.content_news').hide();
        var content_hided = true;
        $('.select_reg').click(function(){
            $('.form_reg').show();
            $('.form_login').hide();
            $(this).css({"border-bottom":"2px solid #42aaff"});
            $('.select_enter').css({"border-bottom":"0"});
        });
        $('.select_enter').click(function(){
            $('.form_login').show();
            $('.form_reg').hide();
            $(this).css({"border-bottom":"2px solid #42aaff"});
            $('.select_reg').css({"border-bottom":"0"});
        });
        $('.content_news_button').click(function(){
            if(!content_hided){
                $('.content_news').slideDown(500);
                $('.content_news_showtext').show();
                $('.content_news_hidetext').hide();
                $('.content_news_button').css({"border-bottom":"1px solid #1f98fb"});
                content_hided=true;}
            else{$('.content_news').slideUp(500);
                $('.content_news_showtext').hide();
                $('.content_news_hidetext').show();
                $('.content_news_button').css({"border":"none"});
                content_hided=false;}
        });
    });
});