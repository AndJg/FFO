$(function(){

    var win = $(window);
    var offset =  10;

    win.scroll(function(){
        if($(document).height() <= (win.height() + (win).scrollTop())){

            offset +=10;
            $('#loader').show();
            $.post('http://localhost/ffo/core/ajax/fetchPosts.php', {fetchPosts:offset}, function(data){

                $('.recommends').html(data);
                $('#loader').hide();

            });
        }

    });
});