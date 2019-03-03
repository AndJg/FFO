<?php 
include 'core/init.php';

$user_id = $_SESSION['user_id'];
$user = $getFromUser->userData($user_id);
$getFromMessage->notificationViewed($user_id);
$notify = $getFromMessage->getNotificationCount($user_id);
$notification = $getFromMessage->notification($user_id);

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
 	  	  <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/style-complete.css"/> 
   		  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>  


    <title>Document</title>


</head>
<body>
    
<div class="wrapper">

<div class="header-wrapper">

<div class="nav-container">

	<div class="nav">
		
		<div class="nav-left">
			<ul>
				<li><a href="<?php echo BASE_URL;?>"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<li><a href="<?php echo BASE_URL;?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification <span id="notification"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';}?></span></a></li>
				<li id="messagePopup"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"><?php if($notify->totalM > 0){echo '<span class="span-i">'.$notitfy->totalM.'</span>';}?></span></li>
				<li><a href="#"><i class="fas fa-compact-disc"></i>Discover</a></li>

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
		

				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profilePic; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo BASE_URL.$user->username; ?>"><?php echo $user->username; ?></a></li>
							<li><a href="<?php echo BASE_URL;?>settings/account">Settings</a></li>
							<li><a href="<?php echo BASE_URL;?>includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label class="addRecommendBtn">Recommend</label></li>
			</ul>
		</div>

	</div>

</div>

</div>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/hashtag.js"></script>

<div class="inner-wrapper">
<div class="in-wrapper">
	<div class="in-full-wrap">
		<div class="in-left">
			<div class="in-left-wrap">
		<div class="info-box">
			<div class="info-inner">
				<div class="info-in-head">
				
					<img src="<?php echo BASE_URL.$user->profileCover; ?>"/>
				</div>
				<div class="info-in-body">
					<div class="in-b-box">
						<div class="in-b-img">
						
                            <img src="<?php echo BASE_URL.$user->profilePic; ?>"/>
						</div>
					</div>
					<div class="info-body-name">
						<div class="in-b-name">
							<div><a href="<?php echo BASE_URL.$user->username; ?>"><?php echo $user->screenName; ?></a></div>
							<span><small><a href="<?php echo BASE_URL.$user->username; ?>"><?php echo $user->username; ?></a></small></span>
						</div>
					</div>
				</div>
				<div class="info-in-footer">
					<div class="number-wrapper">
						<div class="num-box">
							<div class="num-head">
								RECOMMENDS
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
				

<div class="notification-full-wrapper">

<div class="notification-full-head">
	<div>
		<a href="#">All</a>
	</div>
	<div>
		<a href="#">Mention</a>
	</div>
	<div>
		<a href="#">settings</a>
	</div>
</div>
<?php foreach ($notification as $data) : ?>
<?php if($data->type == 'follow'):?>

<div class="notification-wrapper">
<div class="notification-inner">
	<div class="notification-header">
		
		<div class="notification-img">
			<span class="follow-logo">
				<i class="fa fa-child" aria-hidden="true"></i>
			</span>
		</div>
		<div class="notification-name">
			<div>
				 <img src="<?php echo BASE_URL.$data->profilePic; ?>"/>
			</div>
		 
		</div>
		<div class="notification-recommend"> 
		<a href="<?php echo BASE_URL.$data->username; ?>" class="notifi-name"><?php echo $data->screenName; ?></a><span> Followed you your - <span><?php echo $getFromUser->timeAgo($data->time); ?></span>
		
		</div>
	
	</div>
	
</div>

</div>


<?php endif; ?>
<?php if($data->type == 'like'):?>



<div class="notification-wrapper">
<div class="notification-inner">
	<div class="notification-header">
		<div class="notification-img">
			<span class="heart-logo">
				<i class="fa fa-heart" aria-hidden="true"></i>
			</span>
		</div>
		<div class="notification-name">
			<div>
				 <img src="<?php echo BASE_URL.$data->profilePic; ?>"/>
			</div>
		</div>
	</div>
	<div class="notification-recommend"> 
		<a href="<?php echo BASE_URL.$data->username; ?>" class="notifi-name"><?php echo $data->screenName; ?></a><span> liked your <?php  if($data->rcmd_by == $user_id){echo 'Recommend';} ?>- <span><?php echo $getFromUser->timeAgo($data->time); ?></span>
	</div>
	<div class="notification-footer">
		<div class="noti-footer-inner">
			<div class="noti-footer-inner-left">
				<div class="t-h-c-name">
					<span><a href="<?php echo BASE_URL.$data->username; ?>"><?php echo $data->screenName; ?></a></span>
					<span>@<?php echo $data->username; ?></span>
					<span><?php echo $getFromUser->timeAgo($data->postedOn);?></span>
				</div>
				<div class="noti-footer-inner-right-text">		
				<?php echo $getFromRec->getRecLinks($data->status); ?>
				</div>
			</div>
			<?php if(!empty($data->rcmdImage)) : ?>
			<div class="noti-footer-inner-right">
				<img src="<?php echo BASE_URL.$data->rcmdImage; ?>"/>	
			</div> 
			<?php endif;?>

		</div>
	</div>
</div>
</div>


<?php endif; ?>
<?php if($data->type == 'mention'):?>

<?php endif; ?>


<?php endforeach; ?> 

</div>

			

		    	<div class="loading-div">
		    		<img id="loader" src="<?php echo BASE_URL;?>assets/images/loading.svg" style="display: none;"/> 
		    	</div>
				<div class="popupRec"></div>
			<!--Recommend END WRAPER-->
			 <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/like.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popouprcmd.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/delete.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/comment.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/popupForm.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/fetch.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/messages.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/postMessage.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/search.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/notification.js"></script>
			</div>
		</div>

		<div class="in-right">
			<div class="in-right-wrap">

	
		     <?php $getFromFollow->whoToFollow($user_id, $user_id); ?>
     	

 			</div>

		</div>
		<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/follow.js"></script>
	</div>

</div>
</div>
</div>




</body>
</html>