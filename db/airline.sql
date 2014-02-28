-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2014 at 12:20 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airline`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` varchar(15) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  `DOB` datetime NOT NULL,
  `nrc_no` varchar(30) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `gender`, `DOB`, `nrc_no`, `phone_no`, `street`, `city`, `country`, `post_code`) VALUES
('CUS000001', 'admin', 'admin', '', '0000-00-00 00:00:00', '', '', '', '', '', ''),
('CUS000002', 'a', 'a', 'M', '1990-01-02 00:00:00', 'a', 'a', 'a', 'a', 'a', 'a'),
('CUS000003', '', '', '', '0000-00-00 00:00:00', '', '', '', '', '', ''),
('CUS000004', '', '', '', '0000-00-00 00:00:00', '', '', '', '', '', ''),
('CUS000005', '', '', '', '0000-00-00 00:00:00', '', '', '', '', '', ''),
('SET000001', '', '', '', '0000-00-00 00:00:00', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `flight_id` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`flight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `name`, `remark`) VALUES
('FLH_000001', 'Air Bagan', ''),
('FLH_000002', 'Air KBZ', '');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `title`, `duration`, `remark`) VALUES
('ROU_000001', 'Yangon - Mandalay', '1:00 hr', ''),
('ROU_000002', 'Yangon - Nay Pyi Daw', '0:30 hr', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `schedule_id` varchar(15) NOT NULL,
  `flight_id` varchar(15) NOT NULL,
  `route_id` varchar(15) NOT NULL,
  `departure_datetime` datetime NOT NULL,
  `arrival_datetime` datetime NOT NULL,
  `departure_airport` varchar(50) NOT NULL,
  `arrival_airport` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `flight_id`, `route_id`, `departure_datetime`, `arrival_datetime`, `departure_airport`, `arrival_airport`, `remark`) VALUES
('SCH000001', 'FLH_000001', 'ROU_000001', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'a', 'a', 'a'),
('SCH000002', 'FLH_000001', 'ROU_000001', '2014-02-25 01:28:00', '2014-02-25 01:28:00', 'a', 'a', 'a'),
('SCH000003', 'FLH_000001', 'ROU_000001', '2014-02-25 01:28:00', '2014-03-01 01:28:00', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE IF NOT EXISTS `seats` (
  `seat_id` varchar(15) NOT NULL,
  `schedule_id` varchar(15) NOT NULL,
  `seattype_id` varchar(15) NOT NULL,
  `no_of_seat` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`seat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `schedule_id`, `seattype_id`, `no_of_seat`, `price`) VALUES
('SET000001', 'SCH000001', 'STT_000002', 3, '34.00'),
('SET000002', 'SCH000001', 'STT_000001', 5, '54.00'),
('SET000003', 'SCH000002', 'STT_000001', 2, '22.00');

-- --------------------------------------------------------

--
-- Table structure for table `seat_types`
--

CREATE TABLE IF NOT EXISTS `seat_types` (
  `seattype_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`seattype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seat_types`
--

INSERT INTO `seat_types` (`seattype_id`, `title`) VALUES
('STT_000001', 'First Class'),
('STT_000002', 'Economy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
('CUS000001', 'admin', 'admin@gmail.com', 'admin', 'admin'),
('CUS000002', 'a', 'a@gmail.com', 'a', 'member'),
('CUS000003', '', '', '', 'member'),
('CUS000004', '', '', '', 'member'),
('CUS000005', '', '', '', 'member'),
('SET000001', '', '', '', 'member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
