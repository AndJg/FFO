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
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script> 
    <title><?php echo "$user->username"; ?>'s Library</title>


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
				
                <div class="favs">
				<h1 id="hfavs">Favorites</h1>
				<div class="favbox"></div>
				<div class="favbox"></div>
				<div class="favbox"></div>
                </div>

				<div class="main-lib">
				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia ducimus culpa aperiam vitae maiores? Accusamus recusandae quos enim non impedit reprehenderit assumenda ducimus, et, earum quia eum provident, molestiae rerum. 
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim unde sunt nemo voluptates odit eius, placeat nam debitis sint laudantium corrupti perferendis vitae provident voluptatem iusto illo quisquam, dolorum tempore. Neque eveniet quis nulla maiores illo? Voluptate dignissimos in ratione. Voluptates cum fugiat et architecto omnis quibusdam labore! Similique molestiae aut, obcaecati dolorem nisi quisquam dolorum doloremque natus quos cumque necessitatibus neque voluptatum animi, deserunt cupiditate beatae expedita praesentium exercitationem eaque eos blanditiis atque rerum. Eaque harum aliquam laborum eum quidem perspiciatis quod quis recusandae possimus neque laboriosam, ipsam omnis repudiandae deleniti alias inventore hic cumque? Commodi molestiae aliquam, dicta doloribus repellat amet ratione cupiditate eveniet, asperiores nulla sequi ipsam aperiam modi aspernatur. Accusamus, ratione asperiores earum placeat ipsa rem tempora non, nisi molestias voluptates provident ab rerum harum voluptatum inventore quis dolorem, odio illum autem molestiae cum facere minus? Ea esse repudiandae unde perferendis cum? Magni ipsum optio, libero asperiores reiciendis pariatur repellendus, magnam cumque doloribus praesentium tempore ea veritatis natus qui earum? Adipisci eos eius suscipit? Distinctio expedita, dolorem officia atque consequuntur vero blanditiis explicabo nesciunt similique? Nemo, exercitationem quae quos, ducimus rem nostrum minus ab eius non architecto sed atque. Adipisci et omnis enim aspernatur asperiores magni!

					</div>

		  
				<div class="popupRec"></div>
			
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