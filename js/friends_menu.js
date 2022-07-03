$(document).ready(function() {
	$(function(){
        $('.friends_moves_list').hide();
        var slided = false;
        $('.friended').click(function(){
            if(slided){
                $('.friends_moves_list').hide();
                slided = false;
            }
            else{
                $('.friends_moves_list').show();
                slided = true;
            }
        });
    });
    $(function(){
        $('.subscriber_moves_list').hide();
        var slided = false;
        $('.subscribed').click(function(){
            if(slided){
                $('.subscriber_moves_list').hide();
                slided = false;
            }
            else{
                $('.subscriber_moves_list').show();
                slided = true;
            }
        });
    });
});