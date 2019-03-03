$(function(){
$(document).ready(function(){
    $(".art-selection-wrapper").load("/ffo/sub/rock.php");
});

$('a').click(function(){

    var page = $(this).attr('href');
    $(".art-selection-wrapper").load(page);

    return false;
});


});