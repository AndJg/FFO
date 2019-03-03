<?php 

class Follow extends User{
  
    function __construct($pdo){

       $this->pdo = $pdo;
    }

    public function followCheck($follower_id, $user_id){
        
        $stm = $this->pdo->prepare("SELECT * FROM  `follow` WHERE `sender` = :user_id AND `reciver` = :follower_id");
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->bindParam(":follower_id", $follower_id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
        
      }

    public function followBtn($profileId, $user_id, $followID){

        $data = $this->followCheck($profileId, $user_id);

        if($this->loggedIn()===true){

            if($profileId != $user_id){

              if($data['reciver'] === $profileId){

                return" <button class='f-btn following-btn follow-btn' data-follow='".$profileId."' data-profile='".$followID."'>Following</button> ";

              }else {
                return "<button class='f-btn follow-btn' data-follow='".$profileId."' data-profile='".$followID."'><i class='fa fa-user-plus'></i>Follow</button>";
              }

            }else {
                 
                return "<button class='f-btn' onclick=location.href='profileEdit.php'>Edit</button> ";

            }


        }else {
            
            return "<button class='f-btn' onclick=location.href='index.php'><i class='fa fa-user-plus'></i>Follow</button> ";
        }

      }

    public function follow($followID, $user_id, $profileId){

        $this->create('follow', array('sender' => $user_id, 'reciver' => $followID, 'followOn'=>date("Y-M-D H:i:s")));
        $this->addFollowCount($followID,$user_id);
        $stm = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender`=:user_id AND CASE WHEN `reciver`= :user_id THEN `sender`= `user_id` END WHERE `user_id` = :profileId  ');
        $stm->execute(array( "user_id"=> $user_id, "profileId"=>$profileId));
        $data = $stm-fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
        Message::sendNotification($followID, $user_id, $followID, 'follow' );
      }

      public function unfollow($followID, $user_id, $profileId){

        $this->delete('follow', array('sender' => $user_id, 'reciver' => $followID));
        $this->removeFollowCount($followID,$user_id);
        $stm = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender`=:user_id AND CASE WHEN `reciver`= :user_id THEN `sender`= `user_id` END WHERE `user_id` = :profileId  ');
        $stm->execute(array( "user_id"=> $user_id, "profileId"=>$profileId));
        $data = $stm-fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
      }

      public function addFollowCount($followID, $user_id){
        $stm = $this->pdo->prepare("UPDATE `users` SET  `following` = `following` + 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` + 1 WHERE `user_id`=:followID");
        $stm->execute(array("user_id"=>$user_id, "followID"=>$followID));
    }

    public function removeFollowCount($followID, $user_id){
        $stm = $this->pdo->prepare("UPDATE `users` SET  `following` = `following` - 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` - 1 WHERE `user_id`=:followID");
        $stm->execute(array("user_id"=>$user_id, "followID"=>$followID));
        }

    public function followingList($profileId, $user_id, $followID){

        $stm = $this->pdo->prepare("SELECT * FROM `users`  LEFT JOIN `follow` ON `reciver` = `user_id` AND CASE WHEN `sender` = :user_id THEN `reciver`= `user_id` END WHERE `sender` IS NOT NULL ");
        $stm->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stm->execute();
        $followings = $stm->fetchAll(PDO::FETCH_OBJ);


        foreach ($followings as $following) {
        
            echo '<div class="follow-unfollow-box">
            <div class="follow-unfollow-inner">
                <div class="follow-background">
                    <img src="'.BASE_URL.$following->profileCover.'"/>
                </div>
                <div class="follow-person-button-img">
                    <div class="follow-person-img"> 
                         <img src="'.BASE_URL.$following->profilePic.'"/>
                    </div>
                    <div class="follow-person-button">
                         <!-- FOLLOW BUTTON -->
                         '.$this->followBtn($following->user_id, $user_id, $followID).'
                    </div>
                </div>
                <div class="follow-person-bio">
                    <div class="follow-person-name">
                        <a href="'.BASE_URL.$following->username.'">'.$following->screenName.'</a>
                    </div>
                    <div class="follow-person-tname">
                        <a href="'.BASE_URL.$following->username.'">'.$following->username.'</a>
                    </div>
                    <div class="follow-person-dis">
                    '.Recommend::getRecLinks($following->bio).'
                    </div>
                </div>
            </div>
        </div>';


        }


    }

    public function followersList($profileId, $user_id, $followID){

        $stm = $this->pdo->prepare("SELECT * FROM `users`  LEFT JOIN `follow` ON `sender` = `user_id` AND CASE WHEN `reciver` = :user_id THEN `sender`= `user_id` END WHERE `reciver` IS NOT NULL ");
        $stm->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stm->execute();
        $followings = $stm->fetchAll(PDO::FETCH_OBJ);


        foreach ($followings as $following) {
        
            echo '<div class="follow-unfollow-box">
            <div class="follow-unfollow-inner">
                <div class="follow-background">
                    <img src="'.BASE_URL.$following->profileCover.'"/>
                </div>
                <div class="follow-person-button-img">
                    <div class="follow-person-img"> 
                         <img src="'.BASE_URL.$following->profilePic.'"/>
                    </div>
                    <div class="follow-person-button">
                         <!-- FOLLOW BUTTON -->
                         '.$this->followBtn($following->user_id, $user_id, $followID).'
                    </div>
                </div>
                <div class="follow-person-bio">
                    <div class="follow-person-name">
                        <a href="'.BASE_URL.$following->username.'">'.$following->screenName.'</a>
                    </div>
                    <div class="follow-person-tname">
                        <a href="'.BASE_URL.$following->username.'">'.$following->username.'</a>
                    </div>
                    <div class="follow-person-dis">
                    '.Recommend::getRecLinks($following->bio).'
                    </div>
                </div>
            </div>
        </div>';


        }


    }

    public function whoToFollow($user_id, $profileId){

        $stm = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` != :user_id AND `user_id` NOT IN (SELECT `reciver` FROM `follow` WHERE `sender` = :user_id) ORDER BY rand() LIMIT 3");
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);

        echo '<div class="follow-wrap"><div class="follow-inner"><div class="follow-title"><h3>Who to follow</h3></div>';

        foreach ($data as $user) {
            
            echo '<div class="follow-body">
            <div class="follow-img">
              <img src="'.BASE_URL.$user->profilePic.'"/>
            </div>
            <div class="follow-content">
                <div class="fo-co-head">
                    <a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a><span>@'.$user->username.'</span>
                </div>
                <!-- FOLLOW BUTTON -->
                '.$this->followBtn($user->user_id, $user_id, $profileId).'
            </div>
        </div>';
        }

        echo '</div>
        </div>';




    }



}




?>