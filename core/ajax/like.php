<?php
include '../init.php';
if(isset($_POST['like']) && !empty($_POST['like'])){

    $user_id = $_SESSION['user_id'];
    $rcmd_id = $_POST['like'];
    $get_id  = $_POST['user_id'];

    $getFromRec->addLike($user_id,$rcmd_id,$get_id);

}

if(isset($_POST['unlike']) && !empty($_POST['unlike'])){

    $user_id = $_SESSION['user_id'];
    $rcmd_id = $_POST['unlike'];
    $get_id  = $_POST['user_id'];

    $getFromRec->unlike($user_id,$rcmd_id,$get_id);

}




?>
