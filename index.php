<?php 
 include 'core/init.php';
 if(isset($_SESSION['user_id'])){
	 header('Location: home.php');
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
		<link rel="stylesheet" href="assets/css/style-complete.css"/>

    <title>For Fans Of</title>



</head>
<body>
<div class="front-img">
	<img src="assets/images/background.jpg"></img>
</div>	

<div class="wrapper">

<div class="header-wrapper">
	
	<div class="nav-container">
	
		<div class="nav">
			
			<div class="nav-left">
				<ul>
					<li><img src="" alt=""><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
				</ul>
			</div>

			<div class="nav-right">
			
			</div>

		</div>

	</div>

</div>

<div class="inner-wrapper">

	<div class="main-container">

		<div class="content-left">


		
		</div>

		<div class="content-right">

			<h1>  Login as user:</h1>
			<div class="login-wrapper">
			  <?php include 'includes/login.php';  ?>
			</div>

		
			<div class="signup-wrapper">
            <?php include 'includes/signuphandler.php';  ?>
			</div>



		</div>
	</div>

</div>
</div>



</body>
</html>