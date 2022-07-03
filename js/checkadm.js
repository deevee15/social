$(document).ready(function() {
	$(function(){
        $('.a_check').click(function(){
            var key = document.getElementById("key").value;
            $.ajax({
                url: 'accept_admin.php',
                type: 'post',
                data: {key: key},
                success: function(data){
                    $('#data').html(data);
                }
            });
        });
    });
});