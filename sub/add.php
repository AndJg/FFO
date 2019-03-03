<?php 

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $genre = $_POST['genre'];
    $country = $_POST['country'];
    $members = $_POST['members'];
    $inspiration = $_POST['inspiration'];
    $instruments = $_POST['instruments'];

	$error = '';

	if(empty($name) or empty($genre) or empty($country) or empty($members) or empty( $inspiration) or empty( $instruments) ){
		$error ='All fields are required!';

	}else{


        $getFromBand->createBand();

		
			}

		}



?>


<form method="post">
<div  class="signup-div"> 
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="name" placeholder="Artist Name"/>
		</li>
        <li>
		    <input type="text" name="genre" placeholder="Genre"/>
		</li>
         <li>
		    <input type="text" name="country" placeholder="Country of origin"/>
		</li>
		<li>
		    <input type="text" name="members" placeholder="Members"/>
		</li>
		<li>
			<input type="text" name="inspiration" placeholder="Inspired by"/>
		</li>
        <li>
			<input type="text" name="instruments" placeholder="Main Instrument"/>
		</li>
		<li>
        <input style="position: absolute; margin-top: 70px;"  name="send" type="submit" value="Submit">
		
		</li>
	</ul>

    <?php 
	 
	 if(isset($error)){

		echo ' <li class="error-li">
		<div class="span-fp-error">'.$error.'</div>
	   </li> ';

	 }
	
	
	?>