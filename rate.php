<?php
/* 
preg_match('/star_([1-5]{1})/', $_POST['clicked_on'], $match);
$vote = $match[1];

echo "the selected star is number " . $vote;
 */
 
if(isset($_POST["new_rating"]))  
{ 
 
	echo "helloooooooooooo<br>";
	
	$rating = $_POST["new_rating"];
	
	if($rating!=0)
	{
		$movie_id = $_POST["movie_id"];
		
		$user_id = $_POST["user_id"];
		
		
		//echo "rating= " . $rating;
		
		//echo "<br>movie_id= " . $movie_id;
		
		//echo "<br>user_id= " . $user_id;
		
		
		$dbhost = 'localhost';
		$dbuser = 'movieuser';
		$dbpass = 'moviepass';
		$dbname = 'movies_database';

		//create mysql connection
		$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
			
		 	
		$sql = "SELECT count(1) as count FROM ratings WHERE user_id = " . $user_id . " AND movie_id = " . $movie_id;

		$result=$connection->query($sql);
					
		if(!$result)
		{
			echo"Could not execute sql query";
		}

		while($row=$result->fetch_assoc())
		{
			$exist = $row["count"];
		}
		
		//echo "exist= " . $exist;
		
		
		
		
		if($exist == 0)
		{
			$sql2 = "INSERT INTO ratings (rating, movie_id, user_id) VALUES(" . $rating . "," . $movie_id . "," . $user_id . ")";
		}
		else if($exist == 1)
		{
			$sql2 = "UPDATE ratings SET rating = '$rating' WHERE user_id = '$user_id' AND movie_id = '$movie_id'";
			//$sql2 = "UPDATE ratings SET rating = " . $rating . " WHERE user_id = " . $user_id . "AND movie_id = " . $movie_id;
		}
		
		//$connection->query($sql2);
		$result2=$connection->query($sql2);
					
		if(!$result2)
		{
			echo"Could not execute sql2 query";
		}
		
		
		$sql3 = "SELECT avg(rating) as avg FROM ratings WHERE movie_id = " . $movie_id;
		//$sql3 = "SELECT title, avg(rating) as avg FROM ratings WHERE movie_id = '$movie_id'";
		
		$result3=$connection->query($sql3);
					
		if(!$result3)
		{
			echo"Could not execute sql3 query";
		}

		while($row=$result3->fetch_assoc())
		{
			$new_rating = $row["avg"];
		}	
		
		$sql4 = "UPDATE movies SET rating = " . $new_rating . " WHERE movie_id = " . $movie_id;
		
		$result4=$connection->query($sql4);
					
		if(!$result4)
		{
			echo"Could not execute sql4 query";
		}
		/* 
		
		$sql5 = "SELECT title FROM movies WHERE movie_id = " . $movie_id;
		
		$result5=$connection->query($sql5);
					
		if(!$result5)
		{
			echo"Could not execute sql5 query";
		}
		
		while($row=$result5->fetch_assoc())
		{
			$title = $row["title"];
		}
		
		
		$title_url = str_replace(' ', '-', $title); // Replaces all spaces with hyphens.

		$title_url = preg_replace('/[^A-Za-z0-9\-]/', '', $title_url);
		
		$title_url = strtolower($title_url);
		
		$title_url = $title_url . ".php";
			
		echo "title_url= " . $title_url;
	 */
		//header("location: ",$title_url);
		
		//header("location: '$title_url'");
	
	
	
	
	
	
	}
	
	
	
	
	
	
	
	
}
 
//echo "helloooooooooooo";

 
?>