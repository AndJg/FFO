$(function(){

    $(document).on('click', '.deleteRecommend', function(){

        var rcmd_id = $(this).data('recommend');
        $.post('http://localhost/ffo/core/ajax/deleteRecommend.php', {showPopup:rcmd_id}, function(data){

        $('.popupRec').html(data);
        $('.close-rerecommend-popup,.cancel-it').click(function(){
            $('.rerecommend-popoup').hide();

        });

        $(document).on('click', '.delete-it', function(){
                $.post('http://localhost/ffo/core/ajax/deleteRecommend.php', {deleteRecommend:rcmd_id}, function(){

                    $('.rerecommend-popoup').hide();
                    location.reload();

        });

        });

        });

    });

    $(document).on('click', '.deleteComment', function(){

        var comment_id = $(this).data('comment');
        var rcmd_id = $(this).data('recommend');

        $.post('http://localhost/ffo/core/ajax/deleteComment.php', {deleteComment:comment_id}, function(data){

            $.post('http://localhost/ffo/core/ajax/popuprcmd.php', {showPopup:rcmd_id}, function(data){

                $('.popupRec').html(data);
                $('.recommend-show-popup-box-cut').click(function(){
                $('.recommend-show-popup-wrap').hide();
                
                });
          
              });


        });

    });


});