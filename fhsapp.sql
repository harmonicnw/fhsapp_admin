-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2013 at 09:54 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fhsapp`
--
CREATE DATABASE IF NOT EXISTS `fhsapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fhsapp`;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` date NOT NULL COMMENT 'should we change this??',
  `location` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `start_date` date NOT NULL COMMENT 'see date',
  `end_date` date NOT NULL COMMENT 'see date',
  `author` int(10) NOT NULL COMMENT 'Go by id',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `date`, `location`, `time`, `start_date`, `end_date`, `author`, `timestamp`) VALUES
(51, 'HW', '<p>Read Chpt. 1 - 4 by Thursday.</p>', '0000-00-00', '', '', '2013-11-25', '2013-12-16', 1, '2013-12-14 20:04:09'),
(52, 'General Announcement', '<p>General</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:02:17'),
(53, 'Class', '<p>Class</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:03:23'),
(54, 'Club', '<p>Clubby stuff</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:03:33'),
(55, 'Sports', '<p>Sporty stuff</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 1, '2013-12-14 20:03:53'),
(56, 'Announcement for the masses', '<p>Study things.</p>', '2013-12-08', '', '', '2013-12-07', '2013-12-16', 12, '2013-12-14 20:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `anno_subtype`
--

CREATE TABLE IF NOT EXISTS `anno_subtype` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `anno_id` int(10) NOT NULL,
  `subtype_id` int(10) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=298 ;

--
-- Dumping data for table `anno_subtype`
--

INSERT INTO `anno_subtype` (`index`, `anno_id`, `subtype_id`) VALUES
(268, 52, 11),
(269, 52, 12),
(270, 52, 13),
(271, 52, 14),
(272, 52, 15),
(273, 53, 40),
(274, 53, 41),
(275, 53, 42),
(276, 53, 43),
(277, 53, 44),
(278, 53, 45),
(279, 53, 46),
(281, 54, 133),
(282, 55, 137),
(283, 51, 11),
(284, 51, 13),
(285, 51, 15),
(286, 51, 41),
(287, 51, 43),
(288, 51, 46),
(289, 51, 137),
(290, 56, 138),
(291, 56, 139),
(292, 56, 140),
(293, 56, 141),
(294, 56, 142),
(295, 56, 143),
(296, 56, 144),
(297, 56, 145);

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `radio` varchar(5) NOT NULL,
  `checkbox` varchar(5) NOT NULL,
  `select` varchar(10) NOT NULL,
  `textarea` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`id`, `text`, `radio`, `checkbox`, `select`, `textarea`) VALUES
(1, 'First', 'r1', 'on', 'opt1', 'ajdqofjqiofpwjdio'),
(2, 'First', 'r1', 'on', 'opt1', 'ajdqofjqiofpwjdio');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
  `name` varchar(20) NOT NULL,
  `value` varchar(10000) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`name`, `value`, `id`) VALUES
('excluded_dates', '2013-07-15,2013-07-17', 1),
('start_date', '2013-07-15', 2),
('end_date', '2013-08-15', 3),
('SurveyUrl', 'http://dialog.fuseinsight.com/topic/start/franklin_app_Dw', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subtype`
--

CREATE TABLE IF NOT EXISTS `subtype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type_id` int(100) NOT NULL,
  `author_id` int(11) NOT NULL,
  `period` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `subtype`
--

INSERT INTO `subtype` (`id`, `name`, `type_id`, `author_id`, `period`) VALUES
(11, 'College, Career, and Counseling Info', 1, 1, 0),
(12, 'Important Continuing Items', 1, 1, 0),
(13, 'New/Timely Entries', 1, 1, 0),
(14, 'Library', 1, 1, 0),
(15, 'SUN News', 1, 1, 0),
(133, 'MESA', 3, 1, 0),
(137, 'Swimming', 4, 1, 0),
(40, 'Testing', 2, 1, 1),
(41, 'Test', 2, 1, 2),
(42, 'Test Period', 2, 1, 3),
(43, 'More Tests', 2, 1, 4),
(44, 'Testing Testing', 2, 1, 5),
(45, 'Test Period', 2, 1, 6),
(46, 'Still Testing', 2, 1, 7),
(47, '', 2, 1, 8),
(138, 'Period 1', 2, 12, 1),
(139, 'Period 2', 2, 12, 2),
(140, 'Period 3', 2, 12, 3),
(141, 'Period 4', 2, 12, 4),
(142, 'Period 5', 2, 12, 5),
(143, 'Period 6', 2, 12, 6),
(144, 'Period 7', 2, 12, 7),
(145, 'Period 8', 2, 12, 8);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Classes'),
(3, 'Clubs'),
(4, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `teacher` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `club` tinyint(1) NOT NULL,
  `sports` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='The teachers.' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `teacher`, `admin`, `club`, `sports`) VALUES
(1, 'fhsapp', 'e91bde1d1f1c4fbab46f3ec44a354f8b', 'dustindiep0@gmail.com', 'Supreme', 'Admin', 1, 1, 1, 1),
(14, 'Sports', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Sports', 'User', 0, 0, 0, 1),
(13, 'Clubs', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Club', 'User', 0, 0, 1, 0),
(12, 'Teacher', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Teacher', 'User', 1, 0, 0, 0),
(11, 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'dustindiep0@gmail.com', 'Admin', 'User', 0, 1, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
