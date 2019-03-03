<?php  

include 'core/init.php';

if(isset($_GET['hashtag'])  && !empty($_GET['hashtag'])){

    $hashtag = $getFromUser->inputCheck($_GET['hashtag']);
    $user_id = $_SESSION['user_id'];
	$user = $getFromUser->userData($user_id);
	$rcmds = $getFromRec->getRcmdByHash($hashtag);
	

}else{

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
   		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>  
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
				<li><a href="<?php echo BASE_URL ?>home.php">
				<i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<?php if($getFromUser->loggedIn()===true) {?>
				<li><a href="<?php echo BASE_URL ?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
				<li><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
				<li><a href="#"><i class="fas fa-compact-disc"></i>Discover</a></li>
				<li><a href="<?php echo BASE_URL ?>i/library"><i class="fas fa-atlas"></i>Library</a></li>

				<?php }?>
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



<div class="hash-header">
	<div class="hash-inner">
		<h1>#<?php echo $hashtag;?></h1>
	</div>
</div>	

<div class="hash-menu">
	<div class="hash-menu-inner">
		<ul>
 			<li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag;?>">Latest</a></li>
			<li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=users';?>">Accounts</a></li>
			<li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=photos';?>">Photos</a></li>
  		</ul>
	</div>
</div>

<div class="in-wrapper">
	<div class="in-full-wrap">
		





		<div class="in-left">
			<div class="in-left-wrap">

			   

			   <?php $getFromRec->trends(); ?> 
			   
			</div>
		
		</div>
	
	 <div class="in-center">
		<div class="in-center-wrap">
		<?php
		
		
		?>
		</div>
	</div>


	</div>
</div>

</div>


</body>
</html>