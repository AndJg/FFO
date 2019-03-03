<?php
include '../init.php'; 
$user_id = $_SESSION['user_id'];
if(isset($_POST['rercmd']) && !empty($_POST['rercmd'])){
	$rcmd_id = $_POST['rercmd'];
	$get_id  = $_POST['user_id'];
	$comment = $getFromUser->inputCheck($_POST['comment']);
	$getFromRec->rercmd($rcmd_id, $user_id, $get_id, $comment );

}


if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
   
    $rcmd_id = $_POST['showPopup'];
    $get_id  = $_POST['user_id'];
    $recommend =  $getFromRec->getPopupRec($rcmd_id);
    ?>
    <div class="rerecommend-popup">
<div class="wrap5">
	<div class="rerecommend-popup-body-wrap">
		<div class="rerecommend-popup-heading">
			<h3>Rerecommend this to followers?</h3>
			<span><button class="close-rerecommend-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
		</div>
		<div class="rerecommend-popup-input">
			<div class="rerecommend-popup-input-inner">
				<input type="text" class="rerecommendMsg" placeholder="Add a comment.."/>
			</div>
		</div>
		<div class="rerecommend-popup-inner-body">
			<div class="rerecommend-popup-inner-body-inner">
				<div class="rerecommend-popup-comment-wrap">
					 <div class="rerecommend-popup-comment-head">
					 	<img src="<?php echo BASE_URL.$recommend->profilePic; ?>"/>
					 </div>
					 <div class="rerecommend-popup-comment-right-wrap">
						 <div class="rerecommend-popup-comment-headline">
						 	<a><?php echo $recommend->screenName; ?> </a><span>‏@<?php echo $recommend->username; ?> - <?php echo $recommend->postedOn; ?></span>
						 </div>
						 <div class="rerecommend-popup-comment-body">

                         <?php echo $recommend->status; ?>  <?php echo $recommend->rcmdImage; ?>
						 </div>
					 </div>
				</div>
			</div>
		</div>
		<div class="rerecommend-popup-footer"> 
			<div class="rerecommend-popup-footer-right">
				<button class="rerecommend-it" type="submit"><i class="fa fa-rerecommend" aria-hidden="true"></i>Rerecommend</button>
			</div>
		</div>
	</div>
</div>
</div><!-- Rerecommend PopUp ends-->

    <?php 


 

}


?>