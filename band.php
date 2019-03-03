<?php  

include 'core/init.php';

if(isset($_GET['band_id'])){
    
    $band_id = $_GET['band_id'];
	$bandData = $getFromBand->bandData($band_id);
	
	$user_id = $_SESSION['user_id'];
	$user = $getFromUser->userData($user_id);
	$notify = $getFromMessage->getNotificationCount($user_id);


	if($getFromUser->loggedIn() === false){
		header('Location: index.php');
		}
}else{

    echo 'Something went wrong';
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style-complete.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script> 
    <title><?php echo $bandData->name;?></title>


</head>
<body>
    

<div class="wrapper">

<div class="header-wrapper">	
	<div class="nav-container">
    	<div class="nav">
		<div class="nav-left">
			<ul>
				<li><a href="<?php echo BASE_URL ?>home.php">
				<i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<?php if($getFromUser->loggedIn()===true) {?>
				<li><a href="<?php echo BASE_URL ?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
				<li><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
				<li><a href="discover.php"><i class="fas fa-compact-disc"></i>Discover</a></li>
				<li><a href="<?php echo BASE_URL ?>i/library"><i class="fas fa-atlas"></i>Library</a></li>

				<?php }?>
			</ul>
		</div><!-- nav left ends-->
		<div class="nav-center"><ul><li>
					<input type="text" placeholder="Search" class="search"/>
					<div id="search-icon-box"><i class="fa fa-search" aria-hidden="true"></i></div>
					<div class="search-result">			
					</div>
				</li></ul></div>
		<div class="nav-right">
			<ul>
		
				<?php if($getFromUser->loggedIn()===true) {?>		
				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profilePic; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a></li>
							<li><a href="<?php echo BASE_URL;?>settings/account">Settings</a></li>
							<li><a href="<?php echo BASE_URL;?>includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label for="pop-up-recommend" class="addRecommendBtn">Reccomend!</label></li>
				<?php }else {
					echo '<li><a href="'.BASE_URL.'index.php">Already have an account? Log in here!</a></li>';
				} ?>
			</ul>
		</div>

	</div>
	</div>
</div>
<div class="profile-cover-wrap"> 
<div class="profile-cover-inner">
	<div class="profile-cover-img">
		
		<img src="PROFILE-COVER"/>
	</div>
</div>
<div class="profile-nav">
 <div class="profile-navigation">
	
	<div class="edit-button">
		<span>
			<button class="f-btn follow-btn"  data-follow="user_id" data-user="user_id"><i class="fa fa-user-plus"></i> Follow </button>
		</span>
	</div>
    </div>
</div>
</div>
<div class="in-wrapper">
 <div class="in-full-wrap">
   <div class="in-left">
     <div class="in-left-wrap">

	<div class="profile-info-wrap">
	 <div class="profile-info-inner">

		<div class="profile-img">
			<img src="<?php echo $bandData->bandPic;?>"/>
		</div>	

		<div class="profile-name-wrap">
			<div class="profile-name">
				<a href="PROFILE-LINK"><?php echo $bandData->name;?></a>
			</div>

				<div class="profile-tname">
				GENRE:<span class="username"><?php echo $bandData->genre;?></span>
			</div>

			<div class="profile-tname">
				FORMED IN:<span class="username"><?php echo $bandData->forrmed_in;?></span>
			</div>
		
		</div>

	

<div class="profile-extra-info">
	<div class="profile-extra-inner">
		<ul>
				<li>
			<a href="#">
				<div class="n-head">
					LIKES
				</div>
				<div class="n-bottom">
					0
				</div>
			</a>
		</li>
		<br>
			<li>
				<div class="profile-ex-location-i">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
				
				<div class="profile-ex-location">
				<?php echo $bandData->country;?>
				</div>
			</li>
		

			<li>
				<div class="profile-ex-location-i">
					<i class="fa fa-link" aria-hidden="true"></i>
				</div>
				<div class="profile-ex-location">
					<a href="#">PROFILE-WEBSITE;</a>
				</div>
			</li>

			<li>
				<div class="profile-ex-location-i">
		
				</div>
				<div class="profile-ex-location">
 				</div>
			</li>
			<li>
				<div class="profile-ex-location-i">
		
				</div>
				<div class="profile-ex-location">
				</div>
			</li>
		</ul>						
	</div>
</div>

<div class="profile-extra-footer">
	<div class="profile-extra-footer-head">
		<div class="profile-extra-info">
			<ul>
				<li>
					<div class="profile-ex-location-i">
						<i class="fa fa-camera" aria-hidden="true"></i>
					</div>
					
				</li>
			</ul>
		</div>
	</div>
	<div class="profile-extra-footer-body">
		<ul>

		</ul>		
	</div>
</div>

	 </div>


	</div>


	</div>
  </div>

<div class="in-center">
	<div class="in-center-wrap">
	<div class="center-bio">
		<h2><?php echo $bandData->name;?></h2>
		<p><?php echo $bandData->bio;?> </p>



	</div>


	
	</div>
  <div class="popupRec"></div>
</div>


<div class="in-right">
	<div class="in-right-wrap">
			
	
	</div>
</div>


		</div>

	</div>

 </div>


	</div>
  <div class="popupRec"></div>
 			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/like.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popouprcmd.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/delete.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/comment.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popupForm.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fetch.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/search.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/hashtag.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/messages.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/postMessage.js"></script>
			<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/notification.js"></script>
		
</div>


<div class="in-right">
	<div class="in-right-wrap">
			

			
	</div>
</div>



		</div>
		
 	</div>
	
 </div>





</body>
</html>