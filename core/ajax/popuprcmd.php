<?php 
include '../init.php';
if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){

    $rcmd_id =  $_POST['showpopup'];
    $user_id =  $_SESSION['user_id'];
    $recommend    =  $getFromRec->getPopupRec($rcmd_id);
    $user    =  $getFromUser->userData($user_id);
    $likes   =  $getFromRec->likes($user_id, $rcmd_id);
	$rercmd  =  $getFromRec-> rercmdCheck($rcmd_id, $user_id);
	$comments = $getFromRec->comments($rcmd_id);
    ?>
    <div class="recommend-show-popup-wrap">
<input type="checkbox" id="recommend-show-popup-wrap">
<div class="wrap4">
	<label for="recommend-show-popup-wrap">
		<div class="recommend-show-popup-box-cut">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
	</label>
	<div class="recommend-show-popup-box">
	<div class="recommend-show-popup-inner">
		<div class="recommend-show-popup-head">
			<div class="recommend-show-popup-head-left">
				<div class="recommend-show-popup-img">
					<img src="<?php echo BASE_URL.$recommend->profilePic ?>"/>
				</div>
				<div class="recommend-show-popup-name">
					<div class="t-s-p-n">
						<a href="<?php  echo BASE_URL.$recommend ->username; ?>">
							<?php  echo $recommend ->screenName; ?>
						</a>
					</div>
					<div class="t-s-p-n-b">
						<a href="<?php  echo BASE_URL.$recommend ->username; ?>">
							@<?php  echo $recommend ->username; ?>
						</a>
					</div>
				</div>
			</div>
			<div class="recommend-show-popup-head-right">
				  <button class="f-btn"><i class="fa fa-user-plus"></i> Follow </button>
			</div>
		</div>
		<div class="recommend-show-popup-recommend-wrap">
			<div class="recommend-show-popup-recommend">
			<?php  echo $getFromRec->getRecLinks($recommend ->status); ?>
			</div>
			<div class="recommend-show-popup-recommend-ifram">
                <?php if(!empty($recommend ->rcmdImage)){ ?>
                  <img src="<?php  echo BASE_URL.$recommend->rcmdImage; ?>"/> 
                <?php } ?>
			</div>
		</div>
		<div class="recommend-show-popup-footer-wrap">
			<div class="recommend-show-popup-rerecommend-like">
				<div class="recommend-show-popup-rerecommend-left">
			
					<div class="recommend-like-count-wrap">
						<div class="recommend-like-count-head">
							LIKES
						</div>
						<div class="recommend-like-count-body">
                        <?php  echo $recommend ->likesCount; ?>
						</div>
					</div>
				</div>
				<div class="recommend-show-popup-rerecommend-right">
				 
				</div>
			</div>
			<div class="recommend-show-popup-time">
				<span><?php  echo $recommend ->postedOn; ?></span>
			</div>
			<div class="recommend-show-popup-footer-menu">
				<ul>
                    <?php  if($getFromUser->loggedIn() === true){

                        echo '<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
				
                        <li>'.(($likes['likeOn'] === $recommend->rcmd_id) ? '<button class="unlike-btn" data-recommend="'.$recommend->rcmd_id.'" data-user="'.$recommend->rcmd_by.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter">'.$recommend->likesCount.'</span></button>' : '<button class="like-btn" data-recommend ="'.$recommend->rcmd_id.'" data-user="'.$recommend->rcmd_by.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter">'.(($recommend->likesCount > 0) ? $recommend->likesCount : '').'</span></button>' ).'</li>
                            <li>
                            <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                            <ul> 
                              <li><label class="deleteRecommend">Delete Recommend</label></li>';

                    }else {?>
					<li><button type="buttton"><i class="fa fa-share" aria-hidden="true"></i></button></li>
				
                    <li><button type="button"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCount">LIKES-COUNT</span></button></button></li>
                    <?php }?>
				
				</ul>
			</div>
		</div>
    </div><!--recommend-show-popup-inner end-->
    <?php  if($getFromUser->loggedIn() === true){ ?>
 	<div class="recommend-show-popup-footer-input-wrap">
		<div class="recommend-show-popup-footer-input-inner">
			<div class="recommend-show-popup-footer-input-left">
				<img src="<?php echo BASE_URL.$user->profilePic;?>"/>
			</div>
			<div class="recommend-show-popup-footer-input-right">
				<input id="commentField" type="text" data-recommend="<?php echo $recommend->rcmd_id; ?>" name="comment"  placeholder="Reply to @<?php echo $recommend->username;?>">
			</div>
		</div>
		<div class="recommend-footer">
		 	<div class="t-fo-left">
		 		<ul>
		 			<li>
		 		
		 			</li>
		 			<li class="error-li">
				    </li> 
		 		</ul>
		 	</div>
		 	<div class="t-fo-right">
				  <input type="submit" id="postComment" value="recommend">
				  <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/follow.js"></script>
			
		 	</div>
		 </div>
	</div><!--recommend-show-popup-footer-input-wrap end-->
    <?php } ?>
<div class="recommend-show-popup-comment-wrap">
	<div id="comments">
	 	<?php 
		 
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
		 

		 ?>
	</div>

</div>

</div>
</div>

    
    
    <?php 
}


?>