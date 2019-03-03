<?php 

    class Message  extends User{

        function __construct($pdo){

            $this->pdo = $pdo;
    
        }
    

    public function recentMessages($user_id){
        $stm= $this->pdo->prepare("SELECT * FROM  `messages` LEFT JOIN  `users` ON `messageFrom` = `user_id` WHERE `messageTo` = :user_id");
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);



    }

    public function getMessages($messageFrom, $user_id){
        $stm = $this->pdo->prepare("SELECT * FROM  `messages` LEFT JOIN  `users` ON `messageFrom` = `user_id`  WHERE `messageFrom` = :messageFrom AND `messageTo` = :user_id OR `messageTo` = :messageFrom AND `messageFrom` = :user_id");
        $stm->bindParam(":messageFrom", $messageFrom, PDO::PARAM_INT);
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();
        $messages =  $stm->fetchAll(PDO::FETCH_OBJ);

        foreach ($messages as $message){

            if($message->messageFrom === $user_id){

                echo '
  
                <div class="main-msg-body-right">
                        <div class="main-msg">
                            <div class="msg-img">
                                <a href="#"><img src="'.BASE_URL.$message->profilePic.'"/></a>
                            </div>
                            <div class="msg">'.$message->message.'
                                <div class="msg-time">
                                '.$this->timeAgo($message->messageOn).'
                                </div>
                            </div>
                            <div class="msg-btn">
                                <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                <a class="deleteMsg" data-message="'.$message->messageID.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
           
                ';

            }else{

                echo '
               
                    <div class="main-msg-body-left">
                        <div class="main-msg-l">
                            <div class="msg-img-l">
                                <a href="#"><img src=="'.BASE_URL.$message->profilePic.'"/></a>
                            </div>
                            <div class="msg-l">'.$message->message.'
                                <div class="msg-time-l">
                                    '.$this->timeAgo($message->messageOn).'
                                </div>	
                            </div>
                            <div class="msg-btn-l">	
                                <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                <a class="deleteMsg" data-message="'.$message->messageID.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div> 
            ';

            }


        }
    }

    public function deleteMsg($messageID, $user_id){

            $stm = $this->pdo->prepare("DELETE FROM `messages` WHERE `messageID` =  :messageID AND `messageFrom`= :user_id OR `messageID` = :messageID AND `messageTo` = :user_id ");

            $stm->bindParam(":messageID", $messageID, PDO::PARAM_INT);
            $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stm->execute();


    }

    public function getNotificationCount($user_id){
        $stm = $this->pdo->prepare("SELECT COUNT(`messageID`) AS `totalM`, (SELECT COUNT(`ID`) FROM `notification` WHERE `notificationFrom` = :user_id AND `status` = '0' ) AS `totalN`  FROM `messages` WHERE `messageTo` = :user_id AND `status` = '0'");
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public function messagesViewed($user_id){

        $stm = $this->pdo->prepare("UPDATE `messages` SET `status` = '1' WHERE `messageTo` = :user_id AND `status` = '0' ");
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();
    }

    public function notificationViewed($user_id){

        $stm = $this->pdo->prepare("UPDATE `notification` SET `status` = '1' WHERE  `notificationFor` = :user_id");
        $stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm->execute();
    }

    public function notification($user_id){

        $stm = $this->pdo->prepare("SELECT  * FROM `notification`  N 
        LEFT JOIN `users` U ON N.`notificationFrom` = U.`user_id` 
        LEFT JOIN `recommend` R ON N.`target` = R.`rcmd_id` 
        LEFT JOIN `likes` L ON N.`target` = L.`likeOn` 
        LEFT JOIN `follow` F ON N.`notificationFrom` = F.`sender` AND N.`notificationFor` = F.`reciver` 
        WHERE N.`notificationFor` = :user_id AND   N.`notificationFrom` != :user_id ");
        $stm->execute(array("user_id" => $user_id));
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function sendNotification($get_id, $user_id, $target, $type){

        $this->create('notification', array('notificationFor'=> $get_id, 'notificationFrom'=>$user_id, 'target'=> $target, 'type'=> $type, 'time'=> date('Y-m-d H:i:s')));



    }

    }

?>