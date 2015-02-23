-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2015 at 09:56 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Bookmarks`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookmark`
--

CREATE TABLE IF NOT EXISTS `Bookmark` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `votes` int(10) NOT NULL DEFAULT '1',
  `idUser` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `title` (`title`),
  KEY `UserBookmarks` (`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Bookmark`
--

INSERT INTO `Bookmark` (`id`, `url`, `title`, `description`, `date`, `votes`, `idUser`) VALUES
(1, 'http://www.google.com', 'Google', 'Search Engine', '2015-02-10 19:32:28', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE IF NOT EXISTS `Tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Tags`
--

INSERT INTO `Tags` (`id`, `name`) VALUES
(4, 'english'),
(2, 'news'),
(1, 'search engine'),
(3, 'usa');

-- --------------------------------------------------------

--
-- Table structure for table `Tags_Bookmark`
--

CREATE TABLE IF NOT EXISTS `Tags_Bookmark` (
  `tagsId` int(10) NOT NULL,
  `bookmarkId` int(10) NOT NULL,
  PRIMARY KEY (`tagsId`,`bookmarkId`),
  KEY `FKTags_Bookm380487` (`tagsId`),
  KEY `FKTags_Bookm654520` (`bookmarkId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Tags_Bookmark`
--

INSERT INTO `Tags_Bookmark` (`tagsId`, `bookmarkId`) VALUES
(1, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username_2` (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `email`, `password`, `role`, `date`) VALUES
(2, 'admin', 'admin@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-01-27 14:47:39'),
(3, 'user', 'user@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-01-27 14:47:22'),
(5, 'user4', 'user4@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-01-27 14:47:27'),
(6, 'testing', 'user5@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-01-27 14:47:32'),
(7, 'user10', 'user10@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-02-18 17:36:53'),
(8, 'xen', 'xen@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-02-22 21:56:57'),
(9, 'tur', 'tur@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-02-22 21:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `Votes`
--

CREATE TABLE IF NOT EXISTS `Votes` (
  `userId` int(10) NOT NULL,
  `bookmarkId` int(10) NOT NULL,
  PRIMARY KEY (`userId`,`bookmarkId`),
  KEY `FKVotes537977` (`userId`),
  KEY `FKVotes159548` (`bookmarkId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bookmark`
--
ALTER TABLE `Bookmark`
  ADD CONSTRAINT `UserBookmarks` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Constraints for table `Tags_Bookmark`
--
ALTER TABLE `Tags_Bookmark`
  ADD CONSTRAINT `FKTags_Bookm380487` FOREIGN KEY (`tagsId`) REFERENCES `Tags` (`id`),
  ADD CONSTRAINT `FKTags_Bookm654520` FOREIGN KEY (`bookmarkId`) REFERENCES `Bookmark` (`id`);

--
-- Constraints for table `Votes`
--
ALTER TABLE `Votes`
  ADD CONSTRAINT `FKVotes159548` FOREIGN KEY (`bookmarkId`) REFERENCES `Bookmark` (`id`),
  ADD CONSTRAINT `FKVotes537977` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
