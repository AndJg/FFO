<?php  

include '../init.php';

if(isset($_GET['showNotification']) && !empty($_GET['showNotification'])){

    $user_id = $_SESSION['user_id'];
    $data = $getFromMessage->getNotificationCount($user_id);
    echo json_encode(array('notification' => $data->totalN, 'messages' => $data->totalM));
}

?>