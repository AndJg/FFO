<?php 

class Recommend extends User{
 
    function __construct($pdo){

        $this->pdo = $pdo;

    }

    public function rcmnds($user_id, $num){

		$stm = $this->pdo->prepare("SELECT * FROM `recommend`LEFT JOIN `users` ON `rcmd_by` = `user_id` WHERE `rcmd_by`= :user_id  AND `rcmdfrom_id` = '0' OR `rcmd_by`= `user_id` AND  `rcmd_by` IN(SELECT `reciver` FROM `follow` WHERE `sender`= :user_id) ORDER BY `rcmd_id` DESC LIMIT :num ");
		$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stm->bindParam(":num", $num, PDO::PARAM_INT);
        $stm-> execute();
		$rcmnds = $stm->fetchAll(PDO::FETCH_OBJ);
		


        foreach ($rcmnds as $recommend) {

		$likes = $this->likes($user_id,$recommend->rcmd_id);
		$rercmd = $this->rercmdCheck($recommend->rcmd_id, $user_id);
		$user 	=  $this->userData( $recommend->rcmdfrom_by);
            echo '
            <div class="all-recommend">
<div class="t-show-wrap">	
 <div class="t-show-inner">

	<div class="t-show-popup" data-recommend="'.$recommend->rcmd_id.'">
		<div class="t-show-head">
			<div class="t-show-img">
				<img src="'.$recommend->profilePic.'"/>
			</div>
			<div class="t-s-head-content">
				<div class="t-h-c-name">
					<span><a href=""'.$recommend->username.'"">"'.$recommend->screenName.'"</a></span>
					<span>@"'.$recommend->username.'"</span>
					<span>"'.$this->timeAgo($recommend->postedOn).'"</span>
				</div>
				<div class="t-h-c-dis">
                '.$this->getRecLinks($recommend->status).'
				</div>
			</div>
        </div>';
        if(!empty($recommend->rcmdImage)){
		echo '<!--recommend show head end-->
		<div class="t-show-body">
		  <div class="t-s-b-inner">
		   <div class="t-s-b-inner-in">
		     <img src= "'.$recommend->rcmdImage.'" class="imagePopup" data-recommend="'.$recommend->rcmd_id.'"/>
		   </div>
		  </div>
		</div>
        <!--recommend show body end-->';
        }
     echo'
	        </div>
	<div class="t-show-footer">
		<div class="t-s-f-right">
			<ul> 
				<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
				
				<li>'.(($likes['likeOn'] === $recommend->rcmd_id) ? '<button class="unlike-btn" data-recommend="'.$recommend->rcmd_id.'" data-user="'.$recommend->rcmd_by.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter">'.$recommend->likesCount.'</span></button>' : '<button class="like-btn" data-recommend="'.$recommend->rcmd_id.'" data-user="'.$recommend->rcmd_by.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter">'.(($recommend->likesCount > 0) ? $recommend->likesCount : '').'</span></button>' ).'</li>
				'.(($recommend->rcmd_by === $user_id)? '
					<li>
					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<ul> 
					  <li><label class="deleteRcmd" data-recommend="'.$recommend->rcmd_id.'">Delete rcmd</label></li>
					</ul>
				</li>': '' ).'
			</ul>
		</div>
	</div>
</div>
</div>
</div>
            
            
            ';
            
        }

	}
	
public function getUserRec($user_id){

	$stm = $this->pdo->prepare("SELECT * FROM  `recommend` LEFT JOIN `users` ON `rcmd_by` = `user_id` WHERE  `rcmd_by` = :user_id ");
	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->execute();
	return $stm->fetchAll(PDO::FETCH_OBJ);
}


	
public function addLike($user_id, $rcmd_id, $get_id){

	$stm = $this->pdo->prepare("UPDATE `recommend` SET `likesCount` = `likesCount` +1 WHERE `rcmd_id` =:rcmd_id");
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();

	$this->create('likes', array('likeBy'=> $user_id, 'likeOn'=> $rcmd_id));
	if($get_id != $user_id){

		Message::sendNotification($get_id, $user_id, $rcmd_id, 'like' );
	}


}


public function unlike($user_id, $rcmd_id, $get_id){

	$stm = $this->pdo->prepare("UPDATE `recommend` SET `likesCount` = `likesCount` -1 WHERE `rcmd_id` =:rcmd_id");
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();

	$stm = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :rcmd_id");
	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();
}

public function likes($user_id, $rcmd_id){

	$stm = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn`= :rcmd_id ");
	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();

	return $stm->fetch(PDO::FETCH_ASSOC);


}

public function  getTrendByHash($hashtag){
    $stm = $this->pdo->prepare("SELECT * FROM `trends` WHERE `hashtag` LIKE :hashtag LIMIT 5");
    $stm->bindValue(':hashtag', $hashtag.'%');
    $stm->execute();
    
    return $stm->fetchAll(PDO::FETCH_OBJ);

}


public function  getMention($mention){
    $stm = $this->pdo->prepare("SELECT `user_id`, `username`, `screenName`, `profilePic` FROM `users` WHERE `username`  LIKE :mention OR `screenName` LIKE :mention LIMIT 5");
    $stm->bindValue(':mention', $mention.'%');
    $stm->execute();

    return $stm->fetchAll(PDO::FETCH_OBJ);

}

public function addTrend($hashtag){

    preg_match_all("/#+[a-zA-Z0-9_]+/i", $hashtag, $matches);
    if($matches){

        $result = array_values($matches[0]);
    }

    $sql = "INSERT INTO `trends` (`hashtag`, `createdOn`) VALUES(:hashtag, CURRENT_TIMESTAMP)";

    foreach ($result as $trend) {
        if($stm= $this->pdo->prepare($sql)){

            $stm->execute(array(':hashtag' => $trend));
        }
    } 


}

public function addMention($status, $user_id, $rcmd_id){

    preg_match_all("/@+[a-zA-Z0-9_]+/i", $status, $matches);
    if($matches){

        $result = array_values($matches[0]);
    }

    $sql = "SELECT * FROM `users` WHERE `username` = :mention";

    foreach ($result as $trend) {
        if($stm= $this->pdo->prepare($sql)){

			$stm->execute(array(':mention' => $trend));
			$data = $stm->fetch(PDO::FETCH_OBJ);
        }
    } 

	// if($data->user_id != $user_id){

	// 	Message::sendNotification($data->user_id, $user_id, $rcmd_id, 'mention' );

	// }

}

public function getRecLinks($recommend){

    $recommend = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/","<a href='$0' target='_blink'>$0</a>", $recommend );
    $recommend = preg_replace("/#([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>", $recommend);
	$recommend = preg_replace("/@([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>", $recommend);

    return $recommend;

}

public function getPopupRec($rcmd_id){
	$stm = $this->pdo->prepare("SELECT * FROM `recommend`, `users` WHERE `rcmd_id` = :rcmd_id AND `rcmd_by` = `user_id` ");
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();

	return $stm->fetch(PDO::FETCH_OBJ);

}

public function rercmd($rcmd_id, $user_id, $get_id, $comment){
	$stm = $this->pdo->prepare("UPDATE `recommend` SET `rcmdfromCount` = `rcmdfromCount`+1 WHERE `rcmd_id`=:rcmd_id ");
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();

	$stm = $this->pdo->prepare("INSERT INTO `recommend` (`status`, `rcmd_by`, `rcmdImage`,`rcmdfrom_id`,`rcmdfrom_by`, `postedOn`, `likesCount`,`rcmdfromCount`, `rcmdfromMsg`) SELECT  `status`, `rcmd_by`, `rcmdImage`, `rcmdfrom_id`, :user_id, CURRENT_TIMESTAMP,`likesCount`,`rcmdfromCount`, :rcmdfromMsg FROM `recommend` WHERE  `rcmd_id`= :rcmd_id ");

	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->bindParam(":rcmdfromMsg", $comment, PDO::PARAM_STR);
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();
}

public function rercmdCheck($rcmd_id, $user_id){
	$stm = $this->pdo->prepare("SELECT * FROM  `recommend` WHERE `rcmdfrom_id` = :rcmd_id AND `rcmdfrom_by` = :user_id OR `rcmd_id`=:rcmd_id `rcmdfrom_by` = :user_id ");
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->execute();

	return $stm->fetch(PDO::FETCH_ASSOC);
}

public function  comments($rcmd_id){

	$stm = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id`  WHERE `commentOn` = :rcmd_id");
	$stm->bindParam(":rcmd_id", $rcmd_id, PDO::PARAM_INT);
	$stm->execute();

	return $stm->fetchAll(PDO::FETCH_OBJ);

}

public function countRcmds($user_id){

	$stm = $this->pdo->prepare("SELECT COUNT(`rcmd_id`) AS `totalRcmds` FROM `recommend` WHERE `rcmd_by` = :user_id");
	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->execute();
	$count = $stm->fetch(PDO::FETCH_OBJ);
	echo $count->totalRcmds;
}

public function countLikes($user_id){

	$stm = $this->pdo->prepare("SELECT COUNT(`likeId`) AS `totalLikes` FROM `likes` WHERE `likeBy` = :user_id");
	$stm->bindParam(":user_id", $user_id, PDO::PARAM_INT);
	$stm->execute();
	$count = $stm->fetch(PDO::FETCH_OBJ);
	echo $count->totalLikes;

}

public function trends(){

	$stm = $this->pdo->prepare("SELECT *, COUNT(`rcmd_id`) AS `rcmdfromCount` FROM `trends` INNER JOIN `recommend` ON  `status` LIKE CONCAT('%#', `hashtag`, '%') GROUP BY `hashtag` ORDER BY `rcmd_id` ");
	$stm->execute();
	$trends = $stm->fetchAll(PDO::FETCH_OBJ);

	echo '<div class="trend-wrapper"><div class="trend-inner"><div class="trend-title"><h3>Trends</h3></div>';

	foreach ($trends as $trend) {
		
		echo '<div class="trend-body">
		<div class="trend-body-content">
			<div class="trend-link">
				<a href="'.BASE_URL.'hashtag/'.$trend->hashtag.'">#'.$trend->hashtag.'</a>
			</div>
			<div class="trend-recommends">
				'.$trend->rcmdfromCount.' <span>recommends</span>
			</div>
		</div>
	</div>';

	}

	echo '</div> </div>';
}











public function getRcmdByHash($hashtag){
	$stm = $this->pdo->prepare("SELECT * FROM  `recommend` LEFT JOIN `users` ON `rcmd_by` =`user_id` WHERE `status` LIKE :hashtag");

	$stm->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
	$stm->execute();

	return $stm->fetchAll(PDO::FETCH_OBJ);
	
}

public function getRcmdByBand($band){
	$stm = $this->pdo->prepare("SELECT * FROM  `band` LEFT JOIN `users` ON `rcmd_by` =`user_id` WHERE `status` LIKE :band");

	$stm->execute();

	return $stm->fetchAll(PDO::FETCH_OBJ);
	
}




}




?>