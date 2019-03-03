<?php 
include '../core/init.php';
$user_id = $_SESSION['user_id'];
$user    = $getFromUser->userData($user_id);


if(isset($_GET['step']) === true && empty($_GET['step']) === false){

    if(isset($_POST['next'])){
        $username = $getFromUser->inputCheck($_POST['username']);

        if(!empty($username) ){

            if(strlen($username) > 20){

                $error =" Username must be between 3 and 20 characters!";
            }elseif ($getFromUser->usernameCheck($username) === true) {

                $error = "Username is already taken!";
              
            }else{

                $getFromUser->update('users', $user_id, array('username'=>$username ));
                header('Location: signup.php?step=2');

            }


        }else {
            $error = "Choose proper username!";
        }
            


    }



    ?> 
    
    

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="assets/css/font/css/font-awesome.css"/>
	<link rel="stylesheet" href="../assets/css/style-complete.css"/>

	</head>
	<!--Helvetica Neue-->
<body>
<div class="wrapper">
<!-- nav wrapper -->
<div class="nav-wrapper">
	
	<div class="nav-container">	
		<div class="nav-second">
			<ul>
				<li><a href="#" <i class="fa fa-twitter" aria-hidden="true"></i></a></li>							
			</ul>
		</div><!-- nav second ends-->
	</div><!-- nav container ends -->

</div><!-- nav wrapper end -->

<!---Inner wrapper-->
<div class="inner-wrapper">
	<!-- main container -->
	<div class="main-container">
		<!-- step wrapper-->

        <?php if($_GET['step'] == '1'){ ?>
 		<div class="step-wrapper">
		    <div class="step-container">
				<form method="post">
					<h2>Choose a Username</h2>
					<h4>Don't worry, you can always change it later.</h4>
					<div>
						<input type="text" name="username" placeholder="Username"/>
					</div>
					<div>
						<ul>
						  <li><?php if(isset($error)){echo $error;}  ?></li>
						</ul>
					</div>
					<div>
						<input type="submit" name="next" value="Next"/>
					</div>
				 </form>
			</div>
        </div>
        <?php }?>

        <?php if($_GET['step'] == '2') {?>
  			
	<div class='lets-wrapper'>
		<div class='step-letsgo'>
			<h2 style="color: white;">We're glad you're here, <?php echo $user->screenName; ?></h2>
			<p style="color: white;">Please help us by choosing three artist you like:</p>
			<br/>
		

			<span>
				<a href='../home.php' class='backButton'>Let's go!</a>
			</span>
		</div>
	</div>
        <?php } ?>

		
    
		
	</div><!-- main container end -->

</div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->

</body>
</html>
	
    
    
    
    
    <?php 

}


?>