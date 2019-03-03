$(function(){

    var regex = /[#|@](\w+)$/ig;

    $(document).on('keyup','.status',function(){
        var contnet = $.trim($(this).val());
        var text    = contnet.match(regex);
        var max     = 150;

        if(text != null){
            var dataStr = 'hashtag='+text;

            $.ajax({
                type: "POST",
                url: "http://localhost/ffo/core/ajax/getHashtag.php",
                data: dataStr,
                cache: false,
                success: function(data){
                    $('.hash-box ul').html(data);
                    $('.hash-box li').click(function(){
                        var value = $.trim($(this).find('.getValue').text());
                        var oldContent = $('.status').val();
                        var newContent =  oldContent.replace(regex, "");

                        $('.status').val(newContent+value+ ' ');
                        $('.hash-box li').hide();
                        $('.status').focus();

                        $('#count').text(max - contnet.length);


                    });

                }

            });


        }else{
            $('.hash-box li').hide();
        }
        $('#count').text(max - contnet.length);
        if(contnet.length === max){

            $('#count').css('color', '#f00');
        }else{
            $('#count').css('color', '#000');
        }


    });

});