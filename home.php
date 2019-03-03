<?php 
include 'core/init.php';

$user_id = $_SESSION['user_id'];
$user = $getFromUser->userData($user_id);
$notify = $getFromMessage->getNotificationCount($user_id);

if($getFromUser->loggedIn() === false){
	header('Location: index.php');
	}


if(isset($_POST['recommend'])){

	$status = $getFromUser->inputCheck($_POST['status']);
	$rcmdImage ='';
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
			
	}else {
		$error = "Type or choose file to send";
	}
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https:
 	  	  <link rel="stylesheet" href="assets/css/style-complete.css"/> 
   		  <script src="https:


    <title>For Fans Of</title>


</head>
<body>
    
<div class="wrapper">

<div class="header-wrapper">

<div class="nav-container">

	<div class="nav">
		
		<div class="nav-left">
			<ul>
				<li><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<li><a href="i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification <span id="notification"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';}?></span></a></li>
				<li id="messagePopup"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"><?php if($notify->totalM > 0){echo '<span class="span-i">'.$notitfy->totalM.'</span>';}?></span></li>
				<li><a href="discover.php"><i class="fas fa-compact-disc"></i>Discover</a></li>
				<li><a href="ratings.php"><i class="fas fa-grin-stars"></i>Ratings</a></li>
						

			</ul>
		</div>
		<div class="nav-center"><ul><li>
					<input type="text" placeholder="Search" class="search"/>
					<div id="search-icon-box"><i class="fa fa-search" aria-hidden="true"></i></div>
					<div class="search-result">			
					</div>
				</li></ul></div>
		<div class="nav-right">
			<ul>
		

				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user->profilePic; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a></li>
							<li><a href="library.php">Library</a></li>
							<li><a href="settings/account">Settings</a></li>
							<li><a href="includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label class="addRecommendBtn">Recommend!</label></li>
			</ul>
		</div>

	</div>

</div>

</div>

<script type="text/javascript" src="assets/js/search.js"></script>
<script type="text/javascript" src="assets/js/hashtag.js"></script>


<div class="inner-wrapper">
<div class="in-wrapper">
	<div class="in-full-wrap">
		<div class="in-left">
			<div class="in-left-wrap">
		<div class="info-box">
			<div class="info-inner">
				<div class="info-in-head">
				
					<img src="<?php echo $user->profileCover; ?>"/>
				</div>
				<div class="info-in-body">
					<div class="in-b-box">
						<div class="in-b-img">
					
                            <img src="<?php echo $user->profilePic; ?>"/>
						</div>
					</div>
					<div class="info-body-name">
						<div class="in-b-name">
							<div><a href="<?php echo $user->username; ?>"><?php echo $user->screenName; ?></a></div>
							<span><small><a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a></small></span>
						</div>
					</div>
				</div>
				<div class="info-in-footer">
					<div class="number-wrapper">
						<div class="num-box">
							<div class="num-head">
								Recommends
							</div>
							<div class="num-body">
								<?php $getFromRec->countRcmds($user_id); ?>
							</div>
						</div>
						<div class="num-box">
							<div class="num-head">
								FOLLOWING
							</div>
							<div class="num-body">
								<span class="count-following"><?php echo $user->following; ?></span>
							</div>
						</div>
						<div class="num-box">
							<div class="num-head">
								FOLLOWERS
							</div>
							<div class="num-body">
								<span class="count-followers"><?php echo $user->followers; ?></span>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>


 	  <?php $getFromRec->trends(); ?>
	</div>
		</div>
		<div class="in-center">
			<div class="in-center-wrap">				
				<div class="recommend-wrap">
					<div class="recommend-inner">
						 <div class="recommend-h-left">
						 	<div class="recommend-h-img">
					
						 		<img src="<?php echo $user->profilePic; ?>"/>
						 	</div>
						 </div>
						 <div class="recommend-body">
						 <form method="post" enctype="multipart/form-data">
							<textarea class="status" name="status" placeholder="Type Something here!" rows="4" cols="50"></textarea>
 						 	<div class="hash-box">
						 		<ul>
  						 		</ul>
						 	</div>
 						 </div>
						 <div class="recommend-footer">
						 	<div class="t-fo-left">
						 		<ul>
						 			<input type="file" name="file" id="file"/>
						 			<li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
						 			<span class="recommend-error"><?php  if(isset($error)){echo $error;}elseif (isset($imageError)) {
										 echo $imageError;
									 } ?></span>
						 			</li>
						 		</ul>
						 	</div>
						 	<div class="t-fo-right">
						 		<span id="count">150</span>
						 		<input type="submit" name="recommend" value="Send"/>
				 		</form>
						 	</div>
						 </div>
					</div>
				</div>

			
				 <div class="recommends">
 				  <?php $getFromRec->rcmnds($user_id, 10); ?>
 				 </div>
 			

		    	<div class="loading-div">
		    		<img id="loader" src="assets/images/loading.svg" style="display: none;"/> 
		    	</div>
				<div class="popupRec"></div>
				
			 <script type="text/javascript" src="assets/js/like.js"></script>
			<script type="text/javascript" src="assets/js/popouprcmd.js"></script>
			<script type="text/javascript" src="assets/js/delete.js"></script>
			<script type="text/javascript" src="assets/js/comment.js"></script>
			<script type="text/javascript" src="assets/js/popupForm.js"></script>
			<script type="text/javascript" src="assets/js/fetch.js"></script>
			<script type="text/javascript" src="assets/js/messages.js"></script>
			<script type="text/javascript" src="assets/js/postMessage.js"></script>
			<script type="text/javascript" src="assets/js/search.js"></script>
			<script type="text/javascript" src="assets/js/notification.js"></script>
			</div>
		</div>

		<div class="in-right">
			<div class="in-right-wrap">


		     <?php $getFromFollow->whoToFollow($user_id, $user_id); ?>
  

 			</div>

		</div>
		<script type="text/javascript" src="assets/js/follow.js"></script>
	</div>

</div>
</div>
</div>





</body>
</html>