<?php 
include 'core/init.php';


$user_id = $_SESSION['user_id'];
$user = $getFromUser->userData($user_id);
$notify = $getFromMessage->getNotificationCount($user_id);




if($getFromUser->loggedIn() === false){
	header('Location: index.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script> 
    <title>Discover</title>


</head>
<body>
    

<div class="wrapper">
<!-- header wrapper -->
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
			
				<?php }else {
					echo '<li><a href="'.BASE_URL.'index.php">Already have an account? Log in here!</a></li>';
				} ?>
			</ul>
		</div><!-- nav right ends-->

	</div><!-- nav ends -->
	</div><!-- nav container ends -->
</div><!-- header wrapper end -->


<div class="inner-wrapper">
<div class="in-wrapper">
	<div class="in-full-wrap">
		<div class="in-left">
			<div class="in-left-wrap">

    </div>
</div>
    
<div class="in-center">
	<div class="in-center-wrap">

 <span id="artists_list"></span>




    </div>
</div>
    
</div>
</div>
</div>     


  

  
<script type="text/javascript" src="assets/js/rating.js"></script>		

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


</body>
</html>