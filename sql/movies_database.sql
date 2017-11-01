
--create user!!!!
--GRANT ALL PRIVILEGES ON *.* TO 'movieuser'@'localhost' IDENTIFIED BY PASSWORD '*D9A84FAEFDBF819CF68D8A360DD1DA5EE3E06476' WITH GRANT OPTION;

--GRANT ALL PRIVILEGES ON `movieuser\_%`.* TO 'movieuser'@'localhost';

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 05:32 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `year` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `wallpaper` varchar(200) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `rating` double(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `year`, `category`, `wallpaper`, `summary`, `rating`) VALUES
(1, 'The Lord of the Rings: The Fellowship of the Ring', 2001, 'adventure/drama/fantasy', 'the-lord-of-the-rings-wallpaper.jpg', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle Earth from the Dark Lord Sauron.', 0.00),
(2, 'Harry Potter and the Sorcerer\'s Stone', 2001, 'adventure/fantasy', 'harry-potter-and-the-sorcerers-stone-wallpaper.jpg', 'Rescued from the outrageous neglect of his aunt and uncle, a young boy with a great destiny proves his worth while attending Hogwarts School of Witchcraft and Wizardry.', 0.00),
(3, 'Mission: Impossible', 1996, 'action/adventure', 'mission-impossible-wallpaper.jpg', 'An American agent, under false suspicion of disloyalty, must discover and expose the real spy without the help of his organization.', 0.00),
(4, 'The Matrix', 1999, 'action/sci-fi', 'the-matrix-wallpaper.jpg', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 0.00),
(5, 'Pirates of the Caribbean: The Curse of the Black Pearl', 2003, 'action/adventure/fantasy', 'pirates-of-the-caribbean-wallpaper.jpg', 'Blacksmith Will Turner teams up with eccentric pirate Captain Jack Sparrow to save his love, the governor\'s daughter, from Jack\'s former pirate allies, who are now undead.', 0.00),
(6, 'Titanic', 1997, 'drama/romance', 'titanic-wallpaper.jpg', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', 0.00),
(7, 'Meet the Parents', 2000, 'comedy/romance', 'meet-the-parents-wallpaper.jpg', 'Male nurse Greg Focker meets his girlfriend\'s parents before proposing, but her suspicious father is every date\'s worst nightmare.', 0.00),
(8, 'The Lion King', 1994, 'animation/adventure/drama', 'the-lion-king-wallpaper.jpg', 'Lion cub and future king Simba searches for his identity. His eagerness to please others and penchant for testing his boundaries sometimes gets him into trouble.', 0.00),
(9, 'Tarzan', 1999, 'animation/adventure', 'tarzan-wallpaper.jpg', 'A man raised by gorillas must decide where he really belongs when he discovers he is a human.', 0.00),
(10, 'Inception', 2010, 'action/adventure/sci-fi', 'inception-wallpaper.jpg', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 0.00),
(11, 'The Wolf of Wall Street', 2013, 'biography/comedy/crime', 'the-wolf-of-wallstreet-wallpaper.jpg', 'Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker living the high life to his fall involving crime, corruption and the federal government.', 0.00),
(12, 'The Shawshank Redemption', 1994, 'crime/drama', 'the-shawshank-redemption-wallpaper.jpg', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 0.00),
(13, 'American History X', 1998, 'crime/drama', 'american-history-x-wallpaper.jpg', 'A former neo-nazi skinhead tries to prevent his younger brother from going down the same wrong path that he did.', 0.00),
(14, 'Fight Club', 1999, 'drama', 'fight-club-wallpaper.jpg', 'An insomniac office worker, looking for a way to change his life, forming an underground fight club that evolves into something much, much more.', 0.00),
(15, 'Sahara', 2005, 'action/adventure/comedy', 'sahara-wallpaper.jpg', 'Master explorer Dirk Pitt goes on the adventure of a lifetime of seeking out a lost Civil War battleship in the deserts of West Africa hounded by a ruthless dictator.', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
