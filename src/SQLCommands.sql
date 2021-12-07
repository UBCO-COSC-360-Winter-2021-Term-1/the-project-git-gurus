-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2017 at 11:59 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_39738166`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`username`, `firstName`, `lastName`, `email`, `password`) VALUES
('dvader', 'darth', 'vader', 'vader@dark.force', '0f359740bd1cda994f8b55330c86d845');

ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users` ADD `userID` INT NOT NULL AUTO_INCREMENT , ADD UNIQUE (`userID`);

CREATE TABLE `userImages` (
  `userID` int(11) NOT NULL,
  `contentType` varchar(255) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `userImages`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`);

ALTER TABLE `userImages` ADD CONSTRAINT `userimages_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `userPosts` (
  userID int(11) NOT NULL,
  postTitle varchar(100) NOT NULL,
  postContent varchar(8000),
  postDateTime datetime NOT NULL,
  FOREIGN KEY (UserID) REFERENCES users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `userPosts` ADD `postID` INT NOT NULL AUTO_INCREMENT , ADD UNIQUE (`postID`);
ALTER TABLE `userPosts` ADD `postVoteCount` INT NOT NULL;
ALTER TABLE `userPosts` ADD PRIMARY KEY (`postID`);

CREATE TABLE `postImages` (
  `postID` int(11) NOT NULL,
  `contentType` varchar(255) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `postImages`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `postID` (`postID`);

ALTER TABLE `postImages`
  ADD CONSTRAINT `postimages_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `userPosts` (`postID`) ON DELETE CASCADE ON UPDATE CASCADE;