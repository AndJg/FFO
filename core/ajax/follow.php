<?php 
include '../init.php';

if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){

    $user_id = $_SESSION['user_id'];
    $followID = $_POST['unfollow'];
    $profileId = $_POST['profile'];
    $getFromFollow->unfollow($followID, $user_id, $profileId);
}

if(isset($_POST['follow']) && !empty($_POST['follow'])){

    $user_id = $_SESSION['user_id'];
    $followID = $_POST['follow'];
    $profileId = $_POST['profile'];
    $getFromFollow->follow($followID, $user_id, $profileId);

}

?>