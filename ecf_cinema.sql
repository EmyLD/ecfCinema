-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 02:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecf_cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`id`, `name`, `firstname`) VALUES
(1, 'Allen', 'Alfie'),
(2, 'Brando', 'Marlon'),
(3, 'Brasseur', 'Claude'),
(4, 'De Niro', 'Robert'),
(5, 'Fishburne', 'Laurence'),
(6, 'Keaton', 'Diane'),
(7, 'L. Jackson', 'Samuel'),
(8, 'Moss', 'Carrie-Anne'),
(9, 'Pacino', 'Al'),
(10, 'Ratinier', 'Claude'),
(11, 'Reeves', 'Keanu'),
(12, 'Rich', 'Claude'),
(13, 'Thurman', 'Uma'),
(14, 'Travolta', 'John'),
(15, 'De Funes', 'Louis'),
(28, 'Crowe', 'Russell'),
(29, 'Reed', 'Oliver'),
(30, 'Nielsen', 'Connie '),
(33, 'Marion ', 'Cotillard'),
(34, 'Leonardo', 'Di Caprio'),
(43, 'Washington', 'John David '),
(44, 'Lauby', 'Chantal');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `director` varchar(50) NOT NULL,
  `poster` varchar(150) NOT NULL,
  `year` char(4) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `director`, `poster`, `year`, `type`) VALUES
(1, 'Matrix', 'Les Wachowski', 'http://fr.web.img6.acsta.net/r_1920_1080/medias/04/34/49/043449_af.jpg', '1999', ''),
(2, 'La soupe aux choux', 'Jean Girault', 'http://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/36/11/21/18478117.jpg', '1981', ''),
(3, 'John Wick', 'David Leitch', 'http://fr.web.img4.acsta.net/pictures/14/10/08/11/49/255061.jpg', '2014', ''),
(4, 'Le Parrain', 'Francis Ford Coppola', 'http://fr.web.img4.acsta.net/medias/nmedia/18/35/57/73/18660716.jpg', '1972', ''),
(5, 'Le souper', 'Edouard Molinaro', 'http://www.cinemapassion.com/lesaffiches/Le-Souper-affiche-12388.jpg', '1992', ''),
(6, 'Pulp Fiction', 'Quentin Tarantino', 'http://fr.web.img4.acsta.net/r_1920_1080/medias/nmedia/18/36/02/52/18686501.jpg', '1994', ''),
(7, 'Le Parrain, 2eme Partie', 'Francis Ford Coppola', 'https://musicart.xboxlive.com/7/6d295200-0000-0000-0000-000000000002/504/image.jpg?w=1920&h=1080', '1974', ''),
(22, 'Gladiator', 'Ridley Scott', 'http://fr.web.img6.acsta.net/r_1920_1080/medias/nmedia/18/68/64/41/19254510.jpg', '2000', ''),
(25, 'Inception', 'Christopher Nolan', 'https://media.senscritique.com/media/000004710747/source_big/Inception.jpg', '2010', ''),
(40, 'Tenet', 'Christopher Nolan', 'https://fr.web.img2.acsta.net/pictures/20/08/03/12/15/2118693.jpg', '2020', ''),
(42, 'La Cité de la peur', ' Alain Berbérian', 'https://media.senscritique.com/media/000020381903/300/la_cite_de_la_peur.jpg', '1994', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `fk_movie` int(11) DEFAULT NULL,
  `fk_actor` int(11) DEFAULT NULL,
  `character` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `fk_movie`, `fk_actor`, `character`) VALUES
(17, 1, 11, 'Neo'),
(18, 3, 11, 'John Wick'),
(19, 1, 5, 'Morpheus'),
(20, 2, 15, 'Le Glaude'),
(21, 4, 4, 'Vito Corleone'),
(22, 4, 9, 'Mickael Corleone'),
(23, 7, 9, 'Mickael Corleone'),
(24, 3, 6, 'Iosef Tarasov'),
(25, 1, 8, 'Trinity '),
(26, 5, 3, 'Joseph Fouché'),
(27, 5, 12, 'Talleyrand'),
(28, 6, 14, 'Vincent Vega'),
(29, 6, 7, 'Jules Winnfield'),
(30, 6, 13, 'Mia Wallace'),
(31, 7, 6, 'Kay Adams-Corleone'),
(32, 4, 2, 'Vito Corleone'),
(35, 22, 28, 'Maximus'),
(36, 22, 29, 'Proximo'),
(37, 22, 30, 'Lucilla'),
(40, 25, 33, 'Mall'),
(41, 25, 34, 'Dom Cobb'),
(51, 40, 43, 'Le protagoniste');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie` (`fk_movie`),
  ADD KEY `fk_actor` (`fk_actor`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`fk_movie`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`fk_actor`) REFERENCES `actor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
