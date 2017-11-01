<?php


session_start();

/* User login process, checks if user exists and password is correct */
$dbhost = 'localhost';
$dbuser = 'movieuser';
$dbpass = 'moviepass';
$dbname = 'movies_database';


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	// Escape email to protect against SQL injections
	$email = $connection->escape_string($_POST['email']);
	$result = $connection->query("SELECT * FROM users WHERE email='$email'");

	if ( $result->num_rows == 0 )
	{ // User doesn't exist
		$_SESSION['message'] = "User with that email doesn't exist!";
		header("location: error.php");
	}
	else 
	{ // User exists
		$user = $result->fetch_assoc();

		if ( password_verify($_POST['password'], $user['password']) ) 
		{
			
			$_SESSION['user_id'] = $user['user_id'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['username'] = $user['username'];
			//$_SESSION['active'] = $user['active'];
			
			// This is how we'll know the user is logged in
			$_SESSION['logged_in'] = 1;

			header("location: index.php");
		}
		else 
		{
			$_SESSION['message'] = "You have entered wrong password, try again!";
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
		
		#login
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
		<h1>Log In</h1>
		
		<div id="login">   
          
          
          <form action="log_in.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <!--<p class="forgot"><a href="forgot.php">Forgot Password?</a></p>-->
          
          <button class="button button-block" name="login" />Log In</button>
          
          </form>

        </div>
 </body>
</html>