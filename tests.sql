-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2014 at 03:48 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE IF NOT EXISTS `conferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `participant_id` int(10) unsigned NOT NULL,
  `status` enum('active','closed') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `participant_id` (`participant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `conferences`
--

INSERT INTO `conferences` (`id`, `date`, `user_id`, `participant_id`, `status`) VALUES
(6, 1396029642, 10, 11, 'active'),
(7, 1397738215, 11, 10, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('active','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `password`, `status`) VALUES
(10, 'user1', 'last name 2', '202cb962ac59075b964b07152d234b70', 'active'),
(11, 'user2', 'last name 2', '202cb962ac59075b964b07152d234b70', 'active'),
(12, 'user3', 'last name 3', '202cb962ac59075b964b07152d234b70', 'active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conferences`
--
ALTER TABLE `conferences`
  ADD CONSTRAINT `conferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `conferences_ibfk_2` FOREIGN KEY (`participant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
