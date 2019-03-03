$(function(){

    $(document).on('click', '#postComment', function(){

        var comment = $('#commentField').val();
        var rcmd_id = $('#commentField').data('recommend');

        if(comment != ""){

            $.post('http://localhost/ffo/core/ajax/comment.php', {comment:comment, rcmd_id:rcmd_id}, function(data){

                 $('#comments').html(data);
                 $('#commentField').val("");
            });
        }
    });

});