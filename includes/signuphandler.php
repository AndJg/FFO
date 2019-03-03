<?php 

if(isset($_POST['signup'])){

	$screenName = $_POST['screenName'];
	$password 	= $_POST['password'];
	$email 		= $_POST['email'];
	$error 		= '';

	if(empty($screenName) or empty($password) or empty($email) ){

		$error ='All fields are required!';



	}else{

		$screenName = $getFromUser->inputCheck($screenName);
		$password = $getFromUser->inputCheck($password);
		$email = $getFromUser->inputCheck($email);
		
		if(!filter_var($email)){

			$error ='Invalid email format!';

		}else if(strlen($screenName) > 20  || strlen($screenName) < 3){

			$error ='Name must be between 3 and 20 characters!';

		}else{

			if($getFromUser->emailCheck($email) === true){

				$error ='Email is already in use!';

			}else{


		$user_id =	$getFromUser->create('users', array('email'=>$email,'password'=>$password, 'screenName'=>$screenName, 'profilePic'=>'assets/images/defaultprofileimage.png','profileCover'=>'assets/images/defaultCoverImage.png'));
		$_SESSION['user_id'] = $user_id;
			header('Location: includes/signup.php?step=1');
				
			}

		}



	}



}




?>

<form method="post">
<div class="signup-div"> 
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup!">
		</li>
	</ul>

	<?php 
	 
	 if(isset($error)){

		echo ' <li class="error-li">
		<div class="span-fp-error">'.$error.'</div>
	   </li> ';

	 }
	
	
	?>
	
	
	
</div>
</form>