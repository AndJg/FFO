<?php 
include '../init.php';
if(isset($_POST) && !empty($_POST)){

    $status = $getFromUser->inputCheck($_POST['status']);
    $user_id = $_SESSION['user_id'];
    $rcmdImage = '';

    if(!empty($status) or !empty($_FILES['file']['name'][0])){

        if(!empty($_FILES['file']['name'][0])){
            $rcmdImage = $getFromUser->uploadImage($_FILES['file']);
        }
        if(strlen($status) > 140){
            $error = "Your text is too long";
        }
       $getFromUser->create('recommend', array('status'=> $status,'rcmd_by'=> $user_id, 'rcmdImage'=>$rcmdImage,'postedOn'=>date('Y-m-d H:i:s')));
        preg_match_all("/#+[a-zA-Z0-9_]+/i", $status, $hashtag);
        if(!empty($hashtag)){

            $getFromRec->addTrend($status);
        }

        // $getFromRec-> addMention($status, $user_id, $rcmd_id);

        $result['success'] = "Successfully Recommended!";
     
        echo json_encode($result);
}else {
    $error = "Type or choose file to send";
}


if(isset($error)){

    $result['error'] = $error;
   
    echo json_encode($result);
}
}





?>