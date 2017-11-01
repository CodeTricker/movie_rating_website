<?php
	
	$dbhost = 'localhost';
	$dbuser = 'movieuser';
	$dbpass = 'moviepass';
	$dbname = 'movies_database';
	//session_start();
	
	//$category_search = $_SESSION["category_search"];
	/* 
	require(connect_database.php);
	
	$movie_title = array();
	$movie_image = array();
	$movie_rating = array();
	
	$movie_title_by_rating = array();
	$movie_image_by_rating = array();
	$movie_rating_by_rating = array();
	 */
	
if(isset($_POST["categories"]))  
{  
		//print_r($_POST["categories"]);
		$array = array();
		$array = $_POST["categories"];
		//print_r($array);
		//$_SESSION["category_search"] = $array;
		//print_r($array);
		
		
		
		//$connect = mysqli_connect("localhost", "root", "", "testing");  
		//$query = "INSERT INTO tbl_language(name) VALUES ('".$_POST["languages"]."')";  
		//$result = mysqli_query($connect, $query);  
		//echo 'Check Box Data Inserted';
		//echo "hello from search movie";
		//echo "array[0]= ".$array[0];
	//}
	
	//require(connect_database.php);           ////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh///////////////////
	
	$category_Sql='';
			
	foreach($array as $i =>$key)
	{
		//echo $array.'<br>';
		if($i==0)
		{
			$category_Sql=$category_Sql." movies.category LIKE ? ";
		}
		else
		{
			$category_Sql=$category_Sql." OR movies.category LIKE ? ";
		}
	}
	
	//$category_Sql=$category_Sql.";";
	
	//echo "category_Sql= " . $category_Sql;
	
	//$sql = "SELECT id, title, wallpaper FROM movies WHERE ".$category_Sql;
	$sql = "SELECT title, wallpaper, rating FROM movies WHERE ".$category_Sql." ORDER BY title;";
	
	$sql2 = "SELECT title, wallpaper, rating FROM movies WHERE ".$category_Sql." ORDER BY rating;";
	
	
	//echo "sql= " . $sql;
	
	//echo "sql2= " . $sql2;
	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname); ////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh////
	
	$stmt = $connection->prepare( $sql ); ////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh///////////////////
	$stmt2 = $connection->prepare( $sql2 );
	
	$params = array('');
		
	foreach($array as $i =>$key)
	{
		//echo $i.' '.$key .'k</br>';
		$params[0] .= 's';
		array_push($params, '%'.trim($key).'%');
	}
	//echo "params= ";
	//print_r($params);
	
	call_user_func_array(array($stmt, 'bind_param'), refValues($params)); ////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh///////////////////
	call_user_func_array(array($stmt2, 'bind_param'), refValues($params));
	
	if( $stmt->execute()) 	////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh///////////////////
	{
		//echo '<h1>OK</h1>';
	}
	
	$stmt->bind_result($title, $wallpaper, $rating);
	
	
	echo '<h2 class="movie_by_title">ORDERED BY TITLE</h2>';
	
	$title_urls = array();
	$titles = array();
	$wallpapers = array();
	$ratings = array();
	
	while ($stmt->fetch()) 
	{
	
		$title_url = str_replace(' ', '-', $title); // Replaces all spaces with hyphens.

		$title_url = preg_replace('/[^A-Za-z0-9\-]/', '', $title_url);
		
		$title_url = strtolower($title_url);
		
		$title_url = $title_url . ".php";
		
		//echo "title_url= " . $title_url . ", wallpaper= " . $wallpaper . ", rating= " . $rating;
		
		array_push($title_urls, $title_url);
		array_push($titles, $title);
		array_push($wallpapers, $wallpaper);
		array_push($ratings, $rating);
		
		echo '<div class="movie_by_title">'. "<img src=\"images/$wallpaper\" class=\"preview\"> <a href=\"$title_url\">$title</a>".' '."$rating/5</div>";
	
	}
	
	echo "<button id=\"rating\" onclick=\"display_rate\">order by rating</button>";
	
	echo "<button id=\"descend_by_title\" onclick=\"descend_by_title\">descend order</button>";
	//echo "<button class=\"hide_me\" id=\"ascend_by_title\" onclick=\"ascend_by_title\">ascend order</button>";
	
	
	$count = count($titles);
	$count = $count-1;
	//echo "count= " . $count;
	//echo "DESCEND!<br>";
	//print_r($title_urls);
	//print_r($titles);
	//print_r($wallpapers);
	//print_r($ratings);
	//$i=$count;
 /* 
	for($i=$count; i>=0; $i-=1)
	{
		$title = $titles[$i];
		$title_url = $title_urls[$i];
		$wallpaper = $wallpapers[$i];
		$rating = $ratings[$i];
		echo '<div class="movie_by_title">'. "<img src=\"images/$wallpaper\" class=\"preview\"> <a href=\"$title_url\">$title</a>".' '."$rating/5</div>";
	}
	 */
	 while($count>=0)
	 {
		$title = $titles[$count];
		$title_url = $title_urls[$count];
		$wallpaper = $wallpapers[$count];
		$rating = $ratings[$count];
		
		echo '<div class="hide_me movie_by_title_descend">'. "<img src=\"images/$wallpaper\" class=\"preview\"> <a href=\"$title_url\">$title</a>".' '."$rating/5</div>";
		
		$count = $count-1;
	 }
	
	echo "<button class=\"hide_me\" id=\"ascend_by_title\" onclick=\"ascend_by_title\">ascend order</button>";
	
	
	
	
	//$stmt->bind_result($id, $title, $wallpaper); ////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh///////////////////
	
	if( $stmt2->execute()) 	////////////////////////////////eeeeeeeeee vgale ta sxoliaaaaaaaaaaaaaa apo authn thn entolh///////////////////
	{
		//echo '<h1>OK2</h1>';
	}
	
	$stmt2->bind_result($title_by_rate, $wallpaper_by_rate, $rating_by_rate);
	
	
	echo '<h2 class="hide_me movie_by_rate">ORDERED BY RATING</h2>';
	
	$title_url_rates = array();
	$title_by_rates = array();
	$wallpaper_by_rates = array();
	$rating_by_rates = array();
	
	while ($stmt2->fetch()) 
	{
	
		$title_url_rate = str_replace(' ', '-', $title_by_rate); // Replaces all spaces with hyphens.

		$title_url_rate = preg_replace('/[^A-Za-z0-9\-]/', '', $title_url_rate);
		
		$title_url_rate = strtolower($title_url_rate);
		
		$title_url_rate = $title_url_rate . ".php";
		
		array_push($title_url_rates, $title_url_rate);
		array_push($title_by_rates, $title_by_rate);
		array_push($wallpaper_by_rates, $wallpaper_by_rate);
		array_push($rating_by_rates, $rating_by_rate);
		
		//echo "title_url_rate= " . $title_url_rate . ", wallpaper= " . $wallpaper_by_rate . ", rating= " . $rating_by_rate;
		
		echo '<div class="hide_me movie_by_rate">'. "<img src=\"images/$wallpaper_by_rate\" class=\"preview\"> <a href=\"$title_url_rate\">$title_by_rate</a>".' '."$rating_by_rate/5</div>";
	
	}
	
	echo "<button class=\"hide_me\" id=\"title\">order by title</button>";
	
	echo "<button class=\"hide_me\" id=\"descend_by_rate\" onclick=\"descend_by_rate\">descend order</button>";
	//echo <button id="btn">Fetch Info for 3 New Animals</button>
	
	$count = count($title_by_rates);
	$count = $count-1;
	
	 while($count>=0)
	 {
		$title = $title_by_rates[$count];
		$title_url = $title_url_rates[$count];
		$wallpaper = $wallpaper_by_rates[$count];
		$rating = $rating_by_rates[$count];
		
		echo '<div class="hide_me movie_by_rate_descend">'. "<img src=\"images/$wallpaper\" class=\"preview\"> <a href=\"$title_url\">$title</a>".' '."$rating/5</div>";
		
		$count = $count-1;
	 }
	
	echo "<button class=\"hide_me\" id=\"ascend_by_rate\" onclick=\"ascend_by_rate\">ascend order</button>";
	
	
	//<script src="js/index2.js"></script>
	//<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>";
	echo "<script src=\"js/index4.js\"></script>";
	
	/*
	while ($stmt->fetch()) 
	{
		$movieRate=0;
		$connection2 = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
		$sql2 = "SELECT AVG(ratings.rating)as avg FROM ratings WHERE ratings.movie_id= $id GROUP BY ratings.movie_id;";

		$result = $connection2->query($sql2);
		
		if($result->num_rows !== 0)
		{
			$rate = $result->fetch_assoc();
			if($rate['avg']>0)
			$movieRate=round($rate['avg']);
			
		}
		
		$title_url = str_replace(' ', '-', $title); // Replaces all spaces with hyphens.

		$title_url = preg_replace('/[^A-Za-z0-9\-]/', '', $title_url);
		
		$title_url = $title_url . ".php";
		
		//echo '<div class="movieTitle">'. "<img src=\"images/$wallpaper\" class=\"preview\"> $title.".' '."$rating</div>";
		
		echo '<div class="movieTitle">'. "<img src=\"images/$wallpaper\" class=\"preview\"> <a href="$title_url">$title.</a>".' '."$rating</div>";
		//<a href="$title_url">$title</a>
		
	}
	*/

$stmt->close();
$stmt2->close();
$connection->close();
//*/

}


/////////////////////////////////
///////////////////////////////

function refValues($arr)
{
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        
		return $refs;
    }
    
	return $arr;
}
	
/*	
$genreSql=$genreSql.";";
			$sql = "SELECT movie_id, title, image FROM movies WHERE ".$genreSql;
			
			//echo $sql;
			
			$mysqli = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
			$stmt= $mysqli->prepare( $sql );
			
			//---------------------------
			$params = array('');
			//for($i=0; $i<$tokens.length; $i++)
				
			foreach($tokens as $i =>$key)
			{
				//echo $i.' '.$key .'k</br>';
				$params[0] .= 's';
				array_push($params, '%'.trim($key).'%');
			}
			//--------------
			call_user_func_array(array($stmt, 'bind_param'), refValues($params));

			if( $stmt->execute()) {
				//echo '<h1>OK</h1>';
			}
			
			$stmt->bind_result($movie_id, $title, $image);
			
			while ($stmt->fetch()) {
				$movieRate=0;
				$mysqli2 = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
				$sql2 = "SELECT AVG(ratings.rating)as avg FROM ratings WHERE ratings.movie_id= $movie_id GROUP BY ratings.movie_id;";

				$result = $mysqli2->query($sql2);
					if($result->num_rows !== 0){
						$rate = $result->fetch_assoc();
						if($rate['avg']>0)
						$movieRate=round($rate['avg']);
						
					}
				
				echo '<div class="movieTitle">'. "<img src=\"images/$image\" class=\"preview\"> $title.".' '."$movieRate</div>";
				
			}
			$stmt->close();
			$mysqli->close();
			
		}
	}
	
	function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}
*/	
	
	
	


?>