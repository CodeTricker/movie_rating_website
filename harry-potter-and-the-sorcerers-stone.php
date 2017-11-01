<?php


/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 )
{
	$logged_in = 0;
	$_SESSION['message'] = "You must log in order to submit a rating!";
	$user_id = -1;
	//header("location: error.php");    
}
else 
{
    // Makes it easier to read
	$user_id = $_SESSION['user_id'];    ///////////////////////////////prep na vgalw ta sxolia apo authn thn entolh..................................
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
	
	$logged_in = 1;
	
    //$active = $_SESSION['active'];
}
 
$dbhost = 'localhost';
$dbuser = 'movieuser';
$dbpass = 'moviepass';
$dbname = 'movies_database';

//create mysql connection
$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

$sql="SELECT movie_id, title, year, category, wallpaper, summary, rating FROM movies WHERE title = 'Harry Potter and the Sorcerer\'\s Stone'";

$result=$connection->query($sql) ;
			
if(!$result)
{
	echo"Could not execute sql query";
}

while($row=$result->fetch_assoc())
{
	$movie_id = $row["movie_id"];
	$title = $row["title"];
	$year = $row["year"];
	$category = $row["category"];
	$wallpaper = $row["wallpaper"];
	$summary = $row["summary"];
	$rating = $row["rating"];
}

//movie_data=array();



//$exist= -1;

if($logged_in == 1)
{
	
	$sql4 = "SELECT count(1) as count FROM ratings WHERE user_id = '$user_id' AND movie_id = '$movie_id'";

		$result4=$connection->query($sql4);
					
		if(!$result4)
		{
			echo"Could not execute sql4 query";
		}

		while($row=$result4->fetch_assoc())
		{
			$exist = $row["count"];
		}
		
		echo "exist= " . $exist;
	
	if($exist==1)
	{
		$sql2="SELECT rating FROM ratings WHERE user_id = '$user_id' AND movie_id =  '$movie_id'";
		
		echo "user_id= " . $user_id;
		
		$result2=$connection->query($sql2);
					
		if(!$result2)
		{
			echo"Could not execute sql2 query";
		}

		while($row=$result2->fetch_assoc())
		{
			$rating = $row["rating"];
		}
		
		echo "rating= " . $rating;
		
		$votes=1;
	}
	else
	{
		$votes=0;
		$rating = 0;
	}
		
	/* 	
	$sql3 = "SELECT count(1) as count FROM ratings WHERE user_id = '$user_id' AND movie_id = $movie_id'";

		$result3=$connection->query($sql3);
					
		if(!$result3)
		{
			echo"Could not execute sql query";
		}

		while($row=$result3->fetch_assoc())
		{
			$exist = $row["count"];
		}
		 */
		
		
}
else
{
	$sql3 = "SELECT count(rating_id) as count FROM ratings WHERE movie_id = '$movie_id'";
	
	$result3=$connection->query($sql3);
					
		if(!$result3)
		{
			echo"Could not execute sql3 query";
		}

		while($row=$result3->fetch_assoc())
		{
			$votes = $row["count"];
		}
}








$star_rate= intval($rating);
//$exist= intval($exist);

$new_rate=0;

//$user_id=2;

	
$connection->close();	
?>




<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>harry-potter-and-the-sorcerers-stone</title>
  <!--<link href="rating-widget.css" rel="stylesheet" type="text/css" />-->
  <?//php include 'css/css.html'; ?>

	<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
	<!--<script type="text/javascript" src="js/star_widget.js"></script>
	<script>

		$('.ratings_stars').hover
		(
			// Handles the mouseover
			function() 
			{
				$(this).prevAll().andSelf().addClass('ratings_over');
				$(this).nextAll().removeClass('ratings_vote'); 
			},
			// Handles the mouseout
			function() 
			{
				$(this).prevAll().andSelf().removeClass('ratings_over');
				// can't use 'this' because it wont contain the updated data
				//set_votes($(this).parent());
			}
		);

	</script>-->

<style type="text/css">
		body
		{
			background-color: lightblue;
			text-align: left;
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
		
		#log_out
		{
			display: none;
		}
		
		
		.hide_me
		{
			display: none;
		}
		
		.display_me
		{
			display: block;
		}
		
		ul
		{
			list-style-type: none;
		}
		
		img
		{
			float: left;
			width: 300px;
			height: 500px;
		}
		
		.common div + div
		{
			margin-left: 270px;
		}
		<!--//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////-->
		.rate_widget 
		{
            border:     1px solid #CCC;
            overflow:   visible;
            padding:    10px;
            position:   relative;
            width:      180px;
            height:     32px;
        }
		
		.ratings_stars 
		{
            background: url('star_empty.png') no-repeat;
            float:      left;
            height:     28px;
            padding:    2px;
            width:      32px;
        }
        .ratings_vote 
		{
            background: url('star_full.png') no-repeat;
        }
        .ratings_over 
		{
            background: url('star_highlight.png') no-repeat;
        }
		
		
		
		
  	</style>
	
</head>	
<body>
	<div class="tab">

	  
	  <a href="index.php">HOME</a>
	  <a id="log_out" href="logout.php"><button name="logout"/>Log Out</button></a>

	</div>
	<div class="common">
		<h1><?=$title?></h1>
		<div>
		<img src="images/<?=$wallpaper?>" class=\"preview\">
		</div>
		<div>
		<ul>
			<li>Year: <?=$year?></li>
			<li>Categories: <?=$category?></li>
			<br>
			<li>Summary: <?=$summary?></li>
			<br><br>
			<li class="submitted">Rating: <?=$rating?> out of 5</li>
			<li class="hide_me never">Rating: You haven't submitted a rating for this movie</li>
		</ul>
		</div>
	</div>
	
	<div class='movie_choice'>
    Star Rate:
    <div id="r1" class="rate_widget">
		 <!--<div class="star_1 ratings_stars" value=1 onclick="rate1()"></div>-->
		<div class="star_1 ratings_stars" value="1"></div>
        <div class="star_2 ratings_stars" value="2"></div>
        <div class="star_3 ratings_stars" value="3"></div>
        <div class="star_4 ratings_stars" value="4"></div>
        <div class="star_5 ratings_stars" value="5"></div>
		<br><br>
        <div class="total_votes">votes:<?=$votes?></div>
		<input id="logged_in" type="hidden" value="<?=$logged_in?>">
		<input id="exist" type="hidden" value="<?=$exist?>">
		<input id="rating" type="hidden" value="<?=$star_rate?>">
		<input id="new_rating" type="hidden" value=<?=$new_rate?>>
		<input id="movie_id" type="hidden" value=<?=$movie_id?>>
		<input id="user_id" type="hidden" value=<?=$user_id?>>
		<!--<input id="title" type="hidden" value=<?=$title?>>-->
		<div class="new_rate">
			<!--<p>new rate = <?=$new_rate?></p>-->
			<button class="hide_me btn" id="btn">submit</button>
		</div>
		<div id="new_result">
		</div>
		<div id="new_result2">
		</div>
    </div>
	<!--<input class="btn" id="btn" type="submit" name="rate" value="show rating"/>
	<button id="btn">show rating</button>-->
	<?php// echo "star_rate= " . $star_rate; ?>
</div>
	


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!--<script src="js/index.js"></script>-->

<!--<script type="text/javascript" src="js/rating-widget2.js"></script>-->

<script type="text/javascript" src="js/star_widget4.js"></script>
</body>
</html>