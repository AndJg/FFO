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
    <title>Discover</title>


</head>
<body>
    
<div class="wrapper">
<!-- header wrapper -->
<div class="header-wrapper">

<div class="nav-container">
	<!-- Nav -->
	<div class="nav">
		
		<div class="nav-left">
			<ul>
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<li><a href="i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification <span id="notification"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';}?></span></a></li>
				<li id="messagePopup"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"><?php if($notify->totalM > 0){echo '<span class="span-i">'.$notitfy->totalM.'</span>';}?></span></li>
				<li><a href="discover.php"><i class="fas fa-compact-disc"></i>Discover</a></li>
				<li><a href="ratings.php"><i class="fas fa-grin-stars"></i>Ratings</a></li>
						

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
		</div><!-- nav right ends-->

	</div><!-- nav ends -->

</div><!-- nav container ends -->

</div><!-- header wrapper end -->


    <div class="discover-wrapper">  

    <div class="row">

        <div class="discover-pills">

   	 <div class="discover-pills-inner">
		<ul>
		<li><a href="recommender.php">Recommender</a></li>
		<li><a href="sub/rock.php">Rock</a></li>
		<li><a href="sub/classical.php">Classical</a></li>
		<li><a href="discover.php">Electronic</a></li>
		<li><a href="discover.php">Metal</a></li>
		<li><a href="sub/prog.php">Prog</a></li>
		<li><a href="sub/jazz.php">Jazz</a></li>
		<li><a href="discover.php">Folk</a></li>
		<li><a href="discover.php">Ambient</a></li>
		<li><a href="discover.php">Pop</a></li>
		<li><a href="sub/add.php">Add Artist</a></li>
		</ul>
	</div>
     </div>
        <!--  -->
</div>     

</div>


<div class="art-selection-wrapper">
<div class="grid">
  


</div>

</div>



</div>
</div>
</div>    
<script type="text/javascript" src="assets/js/popouprcmd.js"></script>
<script type="text/javascript" src="assets/js/pageloader.js"></script>
<script type="text/javascript" src="assets/js/brain.js"></script>

</body>
</html>