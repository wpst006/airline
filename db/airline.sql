-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2014 at 12:37 AM
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
-- Table structure for table `bookingdetails`
--

CREATE TABLE IF NOT EXISTS `bookingdetails` (
  `bookingdetail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(15) NOT NULL,
  `seat_id` varchar(15) NOT NULL,
  `no_of_seats` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`bookingdetail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`bookingdetail_id`, `booking_id`, `seat_id`, `no_of_seats`, `price`) VALUES
(3, '1271499799', 'SET000005', 1, '5.00'),
(4, '1271499799', 'SET000004', 1, '3.00'),
(5, '1244330429', 'SET000005', 1, '5.00'),
(6, '1216595412', 'SET000005', 1, '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` varchar(15) NOT NULL,
  `bookingdate` datetime NOT NULL,
  `customer_id` varchar(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `bookingdate`, `customer_id`, `total`, `status`) VALUES
('1216595412', '2014-03-08 00:00:58', 'CUS000002', '5.00', 1),
('1244330429', '2014-03-01 23:50:42', 'CUS000002', '5.00', 1),
('1271499799', '2014-03-01 23:49:00', 'CUS000002', '8.00', NULL);

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
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` varchar(15) NOT NULL,
  `paymentdate` datetime NOT NULL,
  `booking_id` varchar(15) NOT NULL,
  `cardno` varchar(30) NOT NULL,
  `cardtype` varchar(10) NOT NULL,
  `cardholdername` varchar(30) NOT NULL,
  `securitycode` varchar(5) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `paymentdate`, `booking_id`, `cardno`, `cardtype`, `cardholdername`, `securitycode`) VALUES
('1125316184', '2014-03-08 00:00:58', '1216595412', 'a', 'mastercard', 'a', 'asdf'),
('1191387565', '2014-03-01 23:49:00', '1271499799', 'a', 'mastercard', 'a', 'asd'),
('1310702882', '2014-03-01 23:50:42', '1244330429', 'b', 'mastercard', 'b', 'b');

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
('ROU_000002', 'Yangon - Nay Pyi Daw', '0:30 hr', ''),
('ROU_000003', 'Yangon - Mandalay - Taunggyi', '2:00 hr', ''),
('ROU_000004', 'Yangon - Pathein', '1:00 hr', '');

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
  `active` int(1) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `flight_id`, `route_id`, `departure_datetime`, `arrival_datetime`, `departure_airport`, `arrival_airport`, `active`, `remark`) VALUES
('SCH_000001', 'FLH_000001', 'ROU_000001', '2014-02-06 10:00:00', '2014-02-07 09:30:00', 'aaaaa', 'aaaaa', 1, ''),
('SCH_000002', 'FLH_000002', 'ROU_000001', '2014-02-25 01:28:00', '2014-02-25 01:28:00', 'cccccc', 'cccccc', 1, ''),
('SCH_000003', 'FLH_000001', 'ROU_000001', '2014-03-02 01:01:00', '2014-03-02 01:01:00', 'b', 'b', 1, 'b'),
('SCH_000004', 'FLH_000001', 'ROU_000001', '2014-03-19 08:09:00', '2014-03-04 20:07:00', 'a', '1a', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE IF NOT EXISTS `seats` (
  `seat_id` varchar(15) NOT NULL,
  `schedule_id` varchar(15) NOT NULL,
  `seattype_id` varchar(15) NOT NULL,
  `no_of_seat` int(3) NOT NULL,
  `booked_seat` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`seat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `schedule_id`, `seattype_id`, `no_of_seat`, `booked_seat`, `price`) VALUES
('SET000001', 'SCH000001', 'STT_000002', 3, 0, '34.00'),
('SET000002', 'SCH000001', 'STT_000001', 5, 0, '54.00'),
('SET000003', 'SCH000002', 'STT_000001', 2, 0, '22.00'),
('SET000004', 'SCH_000001', 'STT_000001', 30, 0, '30.00'),
('SET000005', 'SCH_000001', 'STT_000002', 5, 0, '5.00'),
('SET000006', 'SCH_000003', 'STT_000001', 3, 0, '5.00');

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
