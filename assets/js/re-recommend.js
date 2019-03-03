$(function(){

    $(document).on('click', '.rercmd', function(){

         $rcmd_id = $(this).data('rec');
         $user_id = $(this).data('user');
         $counter = $(this).find('.rercmdCounter');
         $count   = $counter.text();
         $button  = $(this);

        $.post('http://localhost/ffo/core/ajax/re-recommend.php', {showPopup:$rcmd_id, user_id:$user_id,}, function(data){ 

        $('.popupRec').html(data);
        $('.close-rerecommend-popup').click(function(){
            $('.rerecommend-popup').hide();

        });


        });
    });

    $(document).on('click', '.rerecommend-it', function(){

        var comment = $('.rerecommendMsg').val();
        $.post('http://localhost/ffo/core/ajax/re-recommend.php', { rercmd:$rcmd_id, user_id:$user_id,comment:comment }, function(){

        $('.rerecommend-popup').hide();
        $count++;
        $counter.text($count);
        $button.removeClass('rercmd').addClass('rercmded');



        });

    });

});