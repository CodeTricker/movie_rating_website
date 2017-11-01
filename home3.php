<?php 


//session_start();
/* Main page with two forms: sign up and log in */
require 'import_initial_tables.php';
//require 'connect_database.php';

session_start();

$logged_in = 0;

if(isset ($_SESSION['logged_in']))
{
	if($_SESSION['logged_in'] == 1)
	{
		$logged_in = 1;
	}
	
		
}
else
{
	$_SESSION['logged_in'] = 0;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  	<title>HOME</title>
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
		
		
		.searchbar
		{
			background-color: lightgray;
			width: 180px;
			height: 100%;
			float: left;
			text-align: left;
		}
		
		
		.searchbar >ul>li
		{
			display: block;
			text-align: left;
		}
		
		img
		{
			width: 80px;
			height: 80px;
		}
		
		
		
		.hide_me
		{
			display: none;
		}
		
		.display_me
		{
			display: block;
		}
		
		#search_result
		{
			text-align: left;
			display: inline-block;
		}
		
  	</style>
  </head>
  <body>
  
	<div class="banner">
		<h1>Welcome to MovieClick!</h1>
		<div class="tab">
			<a id="home" href="home3.php">Home</a>
			<a id="log_in" href="log_in.php">LogIn</a>
			<a id="register" href="register.php">Register</a>
			<a class="hide_me" id="log_out" href="log_out.php">LogOut</a>
			<input id="log" type="hidden" value="<?=$logged_in?>">
		</div>
		
		<div id="container">
		</div>
		
	</div>
	<div class="searchbar">
		<label>Search movie by category</label>
			<ul>
				<li><input class="category" id="action" type="checkbox" name="action" value="action"/>Action</li>
				<li><input class="category" id="fantasy" type="checkbox" name="fantasy" value="fantasy"/>Fantasy</li>
				<li><input class="category" id="adventure" type="checkbox" name="adventure" value="adventure"/>Adventure</li>
				<li><input class="category" id="sci-fi" type="checkbox" name="sci-fi" value="sci-fi"/>Sci-fi</li>
				<li><input class="category" id="" type="checkbox" name="romance" value="romance"/>Romance</li>
				<li><input class="category" id="romance" type="checkbox" name="comedy" value="comedy"/>Comedy</li>
				<li><input class="category" id="biography" type="checkbox" name="biography" value="biography"/>Biography</li>
				<li><input class="category" id="crime" type="checkbox" name="crime" value="crime"/>Crime</li>
				<li><input class="category" id="drama" type="checkbox" name="drama" value="drama"/>Drama</li>
				<li><input class="category" id="animation"type="checkbox" name="animation" value="animation"/>Animation</li><br>
				<li><input class="category" id="checkAll" type="checkbox" name="all" value="all"/>Check All</li>
			</ul>
			<input class="btn" id="btn" type="submit" name="search" value="search now"/>
	</div>
	
	<div id="search_result">
	</div>
	
	<!--<p>
		hey
		<?php// echo "session logged_in= " . $_SESSION['logged_in'];?>
		<?php// echo "logged_in= " . $logged_in;?>
	</p>-->
	
	<div class="movie_list" id="movie_list">
		
	</div>
	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> <!-- Einai polu shmantiko! Xwris auto den anagnwrizei tis metavlhtes $() sto index.js -->
	<script src="js/index6.js"></script>
	
  </body>
</html>