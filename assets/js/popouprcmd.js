

$(function(){

$(document).on('click','.t-show-popup', function(){

    var rcmd_id = $(this).data('recommend');
    $.post('http://localhost/ffo/core/ajax/popuprcmd.php', {showpopup:rcmd_id}, function(data){

      $('.popupRec').html(data);
    

      $('.recommend-show-popup-box-cut').click(function(){

        $('.recommend-show-popup-wrap').hide();
      });

    });
    
});

$(document).on('click', '.imagePopup', function(e){
  e.stopPropagation();
  var rcmd_id = $(this).data('recommend');

  $.post('http://localhost/ffo/core/ajax/imagePopup.php', {showImage:rcmd_id}, function(data){

    $('.popupRec').html(data);
  
    $('.close-imagePopup').click(function(){

      $('.img-popup').hide();

  });
  
});

});

});


