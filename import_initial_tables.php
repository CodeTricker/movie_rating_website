<?php
//php code//$sql  = 'CREATE USER \'movieuser\'@\'localhost\' IDENTIFIED VIA mysql_native_password USING \'***\'GRANT ALL PRIVILEGES ON *.* TO \'movieuser\'@\'localhost\' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0GRANT ALL PRIVILEGES ON `movieuser\\_%`.* TO \'movieuser\'@\'localhost\'';


//CREATE USER 'movieuser'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'movieuser'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `movieuser\_%`.* TO 'movieuser'@'localhost';
//connection variables
	$dbhost = 'localhost';
	$dbuser = 'movieuser';
	$dbpass = 'moviepass';
	$dbname = 'movies_database';

//create mysql connection
$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if( !$connection ) 
{
	die("Could not connect: " . mysqli_error());
}

/* 
if ($connection->connect_errno) 
{
    printf("Connection failed: %s\n", $connection->connect_error);
    die();
}
 */

//create users table with all the fields
$connection->query
(
"SELECT `user_id` FROM `users`;"
)
or 
$connection->query
(
'CREATE TABLE `movies_database`.`users`
(
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`password` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`user_id`) 
);'
)
or die($connection->error);



$connection->query
(
"SELECT `movie_id` FROM `movies`;"
)
or
$connection->query
(
'CREATE TABLE `movies_database`.`movies`
(
	`movie_id` INT NOT NULL,
	`title` VARCHAR(150) NOT NULL,
	`year` INT NOT NULL,
	`category` VARCHAR(200) NOT NULL,
	`wallpaper` VARCHAR(200) NOT NULL,
	`summary` VARCHAR(1000) NOT NULL,
	`rating` DOUBLE PRECISION(3,2) NOT NULL,
	PRIMARY KEY (`movie_id`)
);'
)
or die($connection->error);



//foreign key (`customer_id`) references `Customers`(`customer_id`)
//$query3 = "SELECT `rating_id` FROM `ratings`;";
//$result3 = mysqli_query($connection, $query3);

//if(empty($result3))
$connection->query
(
"SELECT `rating_id` FROM `ratings`;"
)
or	

$connection->query
(
'CREATE TABLE `movies_database`.`ratings`
(
	`rating_id` INT NOT NULL AUTO_INCREMENT,
	`rating` INT NOT NULL,
	`movie_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`rating_id`),
	foreign key (`movie_id`) references `movies`(`movie_id`),
	foreign key (`user_id`) references `users`(`user_id`)
);'
)
or die($connection->error);



/* 
//update inception
$connection->query
(
"UPDATE `movies_database`.`movies`
SET `wallpaper` = 'inception-wallpaper.jpg'
WHERE `movie_id` = 10;"
)
or die($connection->error);
*/

$sql="SELECT count(*) as count FROM movies";

$result=$connection->query($sql);
					
if(!$result)
{
	echo"Could not execute sql query";
}

while($row=$result->fetch_assoc())
{
	$full = $row["count"];
}


//insert////////////////////////////////////////////////

if($full==0)
{
	$connection->query
	(
	"INSERT INTO `movies_database`.`movies`(movie_id, title, year, category, wallpaper, summary, rating)
	Values
	(1, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'adventure/drama/fantasy', 'the-lord-of-the-rings-wallpaper.jpg',
	'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle Earth from the Dark Lord Sauron.', 0.00),
	(2, 'Harry Potter and the Sorcerer\'\s Stone', 2001, 'adventure/fantasy', 'harry-potter-and-the-sorcerers-stone-wallpaper.jpg',
	'Rescued from the outrageous neglect of his aunt and uncle, a young boy with a great destiny proves his worth while attending Hogwarts School of Witchcraft and Wizardry.', 0.00),
	(3, 'Mission: Impossible', 1996, 'action/adventure', 'mission-impossible-wallpaper.jpg',
	'An American agent, under false suspicion of disloyalty, must discover and expose the real spy without the help of his organization.', 0.00),
	(4, 'The Matrix', 1999, 'action/sci-fi', 'the-matrix-wallpaper.jpg',
	'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 0.00),
	(5, 'Pirates of the Caribbean: The Curse of the Black Pearl', 2003, 'action/adventure/fantasy', 'pirates-of-the-caribbean-wallpaper.jpg',
	'Blacksmith Will Turner teams up with eccentric pirate Captain Jack Sparrow to save his love, the governor\'\s daughter, from Jack\'\s former pirate allies, who are now undead.', 0.00),
	(6, 'Titanic', 1997, 'drama/romance', 'titanic-wallpaper.jpg',
	'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', 0.00),
	(7, 'Meet the Parents', 2000, 'comedy/romance', 'meet-the-parents-wallpaper.jpg',
	'Male nurse Greg Focker meets his girlfriend\'\s parents before proposing, but her suspicious father is every date\'\s worst nightmare.', 0.00),
	(8, 'The Lion King', 1994, 'animation/adventure/drama', 'the-lion-king-wallpaper.jpg',
	'Lion cub and future king Simba searches for his identity. His eagerness to please others and penchant for testing his boundaries sometimes gets him into trouble.', 0.00),
	(9, 'Tarzan', 1999, 'animation/adventure', 'tarzan-wallpaper.jpg',
	'A man raised by gorillas must decide where he really belongs when he discovers he is a human.', 0.00),
	(10, 'Inception', 2010, 'action/adventure/sci-fi', 'inception-wallpaper.jpg',
	'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 0.00),
	(11, 'The Wolf of Wall Street', 2013, 'biography/comedy/crime', 'the-wolf-of-wallstreet-wallpaper.jpg',
	'Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker living the high life to his fall involving crime, corruption and the federal government.', 0.00),
	(12, 'The Shawshank Redemption', 1994, 'crime/drama', 'the-shawshank-redemption-wallpaper.jpg',
	'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 0.00),
	(13, 'American History X', 1998, 'crime/drama', 'american-history-x-wallpaper.jpg',
	'A former neo-nazi skinhead tries to prevent his younger brother from going down the same wrong path that he did.', 0.00),
	(14, 'Fight Club', 1999, 'drama', 'fight-club-wallpaper.jpg',
	'An insomniac office worker, looking for a way to change his life, forming an underground fight club that evolves into something much, much more.', 0.00),
	(15, 'Sahara', 2005, 'action/adventure/comedy', 'sahara-wallpaper.jpg',
	'Master explorer Dirk Pitt goes on the adventure of a lifetime of seeking out a lost Civil War battleship in the deserts of West Africa hounded by a ruthless dictator.', 0.00)
	;"
	)
	or die($connection->error);

}

/*
$sql3 = "INSERT INTO questions(quiz_id,question,choice1,choice2,choice3,answer)
	VALUES(1,'Which is the capital of Sweden?','Uppsala','Gothenburg','Oslo','Stockholm'),
	(2,'Which is the 5th largest country by population?','United States of America','China','India','Brazil'),
	(3,'Which is the largest country by area?','China','Brazil','Australia','Russia'),
	(4,'Which is the highest mountain?','Olympus','Makalu','Manaslu','Everest'),
	(5,'Which is the largest ocean?','Caribbean Sea','Arctic Ocean','Mediterranean Sea','Pacific Ocean'),
	(6,'How many states do USA constist of?','56','48','40','50'),
	(7,'Which is the largest island by area in Greece?','Corfu','Mykonos','Euboea','Crete'),
	(8,'Which is the largest desert?','Sahara','Gobi Desert','Patagonian Desert','Maudlandia'),
	(9,'Which is the bussiest port?','Piraeus','Singapore','Santos','Shanghai'),
	(10,'Which is the largest forest','Taiga','Equador Cloud Forest','Daintree','Amazon Forests')";

	$retval2 = mysqli_query( $conn, $sql3 );
*/


mysqli_close($connection);

?>