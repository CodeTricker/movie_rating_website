<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

session_start(); 
 
$dbhost = 'localhost';
$dbuser = 'movieuser';
$dbpass = 'moviepass';
$dbname = 'movies_database';


 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	
	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	// Set session variables to be used on profile.php page
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['username'] = $_POST['username'];

	// Escape all $_POST variables to protect against SQL injections
	$username = $connection->escape_string($_POST['username']);
	$email = $connection->escape_string($_POST['email']);
	$password = $connection->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
	//$hash = $connection->escape_string( md5( rand(0,1000) ) );


	// Check if user with that email already exists
	$result = $connection->query("SELECT * FROM users WHERE email='$email'")
	or die($connection->error());

	// We know user email exists if the rows returned are more than 0
	if ( $result->num_rows > 0 ) 
	{
		$_SESSION['message'] = 'User with this email already exists!';
		
		header("location: error.php");
	}
	else 
	{ // Email doesn't already exist in a database, proceed...

		// active is 0 by DEFAULT (no need to include it here)
		$sql = "INSERT INTO users (username, email, password) " 
				. "VALUES ('$username','$email','$password')";

		// Add user to the database
		if ( $connection->query($sql) )
		{
			
			$connection2 = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

			//$_SESSION['active'] = 0; //0 until user activates their account with verify.php
			
			$_SESSION['logged_in'] = 1; // So we know the user has logged in
			
			$sql2 = "SELECT user_id FROM users WHERE username = '$username' AND email = '$email'";
			
			$result2=$connection2->query($sql2);
					
			if(!$result2)
			{
				echo"Could not execute sql2 query";
			}

			while($row=$result2->fetch_assoc())
			{
				$user_id = $row["user_id"];
			}
			
			$_SESSION['user_id'] = $user_id;
			
			
			
			
			/*
			$_SESSION['message'] =
					
					 "Confirmation link has been sent to $email, please verify
					 your account by clicking on the link in the message!";

			// Send registration confirmation link (verify.php)
			$to      = $email;
			$subject = 'Account Verification ( MovieRank.com )';
			$message_body = '
			Hello '.$username.',

			Thank you for signing up!

			Please click this link to activate your account:

			http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;  //PREPEI NA ALLA3W TO LINK!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

			mail( $to, $subject, $message_body );
			
			*/

			header("location: index.php"); 

		}
		else 
		{
			$_SESSION['message'] = 'Registration failed!';
			header("location: error.php");
		}
		
		

	}

}

?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  	<title>REGISTER</title>
  	<style type="text/css">
		body
		{
			background-color: lightblue;
			text-align: center;
		}
		
		#container
		{
			margin-top: 100px;
		}
		
		.banner
		{
			background-color: white;
			height: 100px;
		}
		
		.tab
		{
			float: right;
			margin-right: 20%;
		}
		.tab a + a
		{
			margin-left: 20px;
		}
		
		.top-row
		{
			margin-top: 20px;
			margin-left: 40%;
			margin-right: 40%;
			text-align: left;
			display: inline-block;
			
		}
		
		input
		{
			display: block;
			margin-left = 10px;
		}
		
  	</style>
  </head> 
  <body>

	<div id="signup">   
          <h1>REGISTER</h1>
          
          <form action="register.php" method="post" autocomplete="off">
          
			<div class="top-row">
				<div class="field-wrap">
				  <label>
					Username<span class="req">*</span>
				  </label>
				  <input type="text" required autocomplete="off" name='username' />
				</div>
					
				<div class="field-wrap">
					<label>
					  Email Address<span class="req">*</span>
					</label>
					<input type="email"required autocomplete="off" name='email' />
				</div>
			  
				<div class="field-wrap">
					<label>
					  Set A Password<span class="req">*</span>
					</label>
					<input type="password"required autocomplete="off" name='password'/>
				</div>
			  
			  <button type="submit" class="button button-block" name="register" />Register</button>
			  
			  </form>

			</div>

	</body>
</html>







