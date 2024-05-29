SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- -- Création de la BDD ECF_Cinema
CREATE DATABASE IF NOT EXISTS ECF_Cinema;

USE ECF_Cinema;

-- Création de la table Film
CREATE TABLE `movie` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(50) NOT NULL,
    `director` VARCHAR(50) NOT NULL,
    `poster` VARCHAR(150) NOT NULL,
    `year` CHAR(4) NOT NULL,
      PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `actor` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `firstname` VARCHAR(100) NOT NULL,
      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `role` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `fk_movie` int,
    `fk_actor` int,
    `character` VARCHAR(50),
    FOREIGN KEY (`fk_movie`) REFERENCES movie(`id`),
    FOREIGN KEY (`fk_actor`) REFERENCES actor(`id`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;