-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2015 at 01:53 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Studentproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `grouplist`
--

CREATE TABLE IF NOT EXISTS `grouplist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `marks` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `grouplist`
--

INSERT INTO `grouplist` (`id`, `name`, `marks`, `status`) VALUES
(1, 'SASH', 50, 1),
(2, 'DEX', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentlist`
--

CREATE TABLE IF NOT EXISTS `studentlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `group_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `studentlist`
--

INSERT INTO `studentlist` (`id`, `name`, `status`, `group_id`) VALUES
(1, 'Shreya Ghosh', 1, 1),
(2, 'Sammita Chakravarti', 1, 1),
(3, 'Sakshi Saraogi', 1, 1),
(4, 'Arpit Singh', 0, 2),
(5, 'Sammy', 0, 2),
(6, 'Sameetha', 0, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
