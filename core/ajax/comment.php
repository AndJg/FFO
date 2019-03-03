<?php
include '../init.php';

if(isset($_POST['comment']) && !empty($_POST['comment'])){

    $comment = $getFromUser->inputCheck($_POST['comment']);
    $user_id = $_SESSION['user_id'];
    $rcmd_id =  $_POST['rcmd_id'];

    if(!empty($comment)){

        $getFromUser->create('comments', array('comment'=> $comment, 'commentOn' => $rcmd_id, 'commentBy'=> $user_id, 'commentAt'=> date('Y-m-d H:i:s')));
        $comments =  $getFromRec->comments($rcmd_id);
        $recommend =$getFromRec->getPopupRec($rcmd_id);

        foreach ($comments as $comment) {
		

			echo '
			<div class="recommend-show-popup-comment-box">
			<div class="recommend-show-popup-comment-inner">
				<div class="recommend-show-popup-comment-head">
					<div class="recommend-show-popup-comment-head-left">
						 <div class="recommend-show-popup-comment-img">
							 <img src="'.BASE_URL.$comment->profilePic.'">
						 </div>
					</div>
					<div class="recommend-show-popup-comment-head-right">
						  <div class="recommend-show-popup-comment-name-box">
							 <div class="recommend-show-popup-comment-name-box-name"> 
								 <a href="'.BASE_URL.$comment->username.'">'.$comment->screenName.'</a>
							 </div>
							 <div class="recommend-show-popup-comment-name-box-tname">
								 <a href="'.BASE_URL.$comment->username.'">@'.$comment->username.' - '.$comment->commentAt.'</a>
							 </div>
						 </div>
						 <div class="recommend-show-popup-comment-right-recommend">
								 <p><a href="TWEET-USER-'.BASE_URL.$recommend->username.'">@'.$recommend->username.'</a> '.$comment->comment.'</p>
						 </div>
						 <div class="recommend-show-popup-footer-menu">
							<ul>
								<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
								<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
								'.(($comment->commentBy === $user_id) ? '
								<li>
								<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
								<ul> 
								  <li><label class="deleteComment" data-recommend="'.$recommend->rcmd_id.'" data-comment="'.$comment->comment_Id.'">Delete Recommend</label></li>
								</ul>
								</li> ' : '').'
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--TWEET SHOW POPUP COMMENT inner END-->
			</div>
			
			
			';

		 }
		 


    }


}


?> 