-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2014 at 12:08 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`bookingdetail_id`, `booking_id`, `seat_id`, `no_of_seats`, `price`) VALUES
(3, '1271499799', 'SET_000005', 1, '5.00'),
(4, '1271499799', 'SET_000004', 1, '3.00'),
(5, '1244330429', 'SET_000005', 1, '5.00'),
(6, '1216595412', 'SET_000005', 1, '5.00'),
(7, '1250725906', 'SET_000005', 1, '5.00');

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
('1216595412', '2014-03-08 00:00:58', 'CUS_000002', '5.00', 1),
('1244330429', '2014-03-01 23:50:42', 'CUS_000003', '5.00', 1),
('1250725906', '2014-03-08 03:07:58', 'CUS_000002', '5.00', 1),
('1271499799', '2014-03-01 23:49:00', 'CUS_000002', '8.00', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `bookings_view`
--
CREATE TABLE IF NOT EXISTS `bookings_view` (
`bookingdetail_id` int(11) unsigned
,`booking_id` varchar(15)
,`seat_id` varchar(15)
,`no_of_seats` int(3)
,`price` decimal(10,2)
,`seat_title` varchar(50)
,`schedule_id` varchar(15)
,`flight_id` varchar(15)
,`route_id` varchar(15)
,`departure_datetime` datetime
,`arrival_datetime` datetime
,`departure_airport` varchar(50)
,`arrival_airport` varchar(50)
,`active` int(1)
,`remark` varchar(255)
,`name` varchar(50)
,`flight_remark` varchar(255)
,`title` varchar(50)
,`hour` int(2)
,`min` int(2)
,`route_remark` varchar(255)
);
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
('CUS_000001', 'admin', 'admin', '', '0000-00-00 00:00:00', '', '', '', '', '', ''),
('CUS_000002', 'a', 'a', 'M', '1990-01-02 00:00:00', 'a', 'a', 'a', 'a', 'a', 'a'),
('CUS_000003', 'b', 'b', 'M', '2014-03-08 00:00:00', 'b', 'b', 'b', 'b', 'b', 'b');

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
('FLH_000001', 'Air Bagan', 'aaa'),
('FLH_000002', 'Air KBZ', ''),
('FLH_000003', 'r', 'rr');

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
('1310702882', '2014-03-01 23:50:42', '1244330429', 'b', 'mastercard', 'b', 'b'),
('1356401797', '2014-03-08 03:07:58', '1250725906', 'a', 'mastercard', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `hour` int(2) NOT NULL,
  `min` int(2) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `title`, `hour`, `min`, `remark`) VALUES
('ROU_000001', 'Yangon - Mandalay', 1, 30, ''),
('ROU_000002', 'Yangon - Nay Pyi Daw', 0, 45, ''),
('ROU_000003', 'Yangon - Mandalay - Taunggyi', 2, 10, ''),
('ROU_000004', 'Yangon - Pathein', 0, 50, ''),
('ROU_000008', 'aa11', 1, 10, ''),
('ROU_000009', 'a', 1, 20, 'aa');

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
('SCH_000003', 'FLH_000001', 'ROU_000002', '2014-03-08 03:00:00', '2014-03-08 03:00:00', 'aaaaa', 'a', 1, ''),
('SCH_000004', 'FLH_000001', 'ROU_000008', '2014-03-08 03:01:00', '2014-03-08 03:01:00', 'aaaaa', 'aaaaaaaaaaa', 1, ''),
('SCH_000005', 'FLH_000001', 'ROU_000008', '2014-03-08 03:01:00', '2014-03-08 03:01:00', 'aaaaa', 'adsf', 1, ''),
('SCH_000006', 'FLH_000002', 'ROU_000003', '2014-03-08 03:04:00', '2014-03-08 03:04:00', 'a', 'a', 1, ''),
('SCH_000007', 'FLH_000003', 'ROU_000004', '2014-03-08 03:08:00', '2014-03-08 03:08:00', 'a', 'a', 1, ''),
('SCH_000008', 'FLH_000003', 'ROU_000004', '2014-03-08 03:08:00', '2014-03-08 03:08:00', 'b', 'b', 1, '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `schedules_view`
--
CREATE TABLE IF NOT EXISTS `schedules_view` (
`schedule_id` varchar(15)
,`flight_id` varchar(15)
,`route_id` varchar(15)
,`departure_datetime` datetime
,`arrival_datetime` datetime
,`departure_airport` varchar(50)
,`arrival_airport` varchar(50)
,`active` int(1)
,`remark` varchar(255)
,`name` varchar(50)
,`flight_remark` varchar(255)
,`title` varchar(50)
,`hour` int(2)
,`min` int(2)
,`route_remark` varchar(255)
);
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
('SET_000001', 'SCH_000001', 'STT_000002', 3, 0, '34.00'),
('SET_000002', 'SCH_000001', 'STT_000001', 5, 0, '54.00'),
('SET_000003', 'SCH_000002', 'STT_000001', 2, 0, '22.00'),
('SET_000004', 'SCH_000001', 'STT_000001', 30, 0, '30.00'),
('SET_000005', 'SCH_000001', 'STT_000002', 5, 0, '5.00'),
('SET_000006', 'SCH_000003', 'STT_000001', 3, 0, '5.00'),
('SET_000007', 'SCH_000005', 'STT_000002', 30, 0, '33.00');

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
('CUS_000001', 'admin', 'admin@gmail.com', 'admin', 'admin'),
('CUS_000002', 'a', 'a@gmail.com', 'a', 'member'),
('CUS_000003', 'b', 'b@gmail.com', 'b', 'member');

-- --------------------------------------------------------

--
-- Structure for view `bookings_view`
--
DROP TABLE IF EXISTS `bookings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bookings_view` AS select `bookingdetails`.`bookingdetail_id` AS `bookingdetail_id`,`bookingdetails`.`booking_id` AS `booking_id`,`bookingdetails`.`seat_id` AS `seat_id`,`bookingdetails`.`no_of_seats` AS `no_of_seats`,`bookingdetails`.`price` AS `price`,`seat_types`.`title` AS `seat_title`,`schedules_view`.`schedule_id` AS `schedule_id`,`schedules_view`.`flight_id` AS `flight_id`,`schedules_view`.`route_id` AS `route_id`,`schedules_view`.`departure_datetime` AS `departure_datetime`,`schedules_view`.`arrival_datetime` AS `arrival_datetime`,`schedules_view`.`departure_airport` AS `departure_airport`,`schedules_view`.`arrival_airport` AS `arrival_airport`,`schedules_view`.`active` AS `active`,`schedules_view`.`remark` AS `remark`,`schedules_view`.`name` AS `name`,`schedules_view`.`flight_remark` AS `flight_remark`,`schedules_view`.`title` AS `title`,`schedules_view`.`hour` AS `hour`,`schedules_view`.`min` AS `min`,`schedules_view`.`route_remark` AS `route_remark` from (((`bookingdetails` join `seats` on((`bookingdetails`.`seat_id` = `seats`.`seat_id`))) join `schedules_view` on((`seats`.`schedule_id` = `schedules_view`.`schedule_id`))) join `seat_types` on((`seats`.`seattype_id` = `seat_types`.`seattype_id`))) order by `bookingdetails`.`bookingdetail_id`;

-- --------------------------------------------------------

--
-- Structure for view `schedules_view`
--
DROP TABLE IF EXISTS `schedules_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `schedules_view` AS select `schedules`.`schedule_id` AS `schedule_id`,`schedules`.`flight_id` AS `flight_id`,`schedules`.`route_id` AS `route_id`,`schedules`.`departure_datetime` AS `departure_datetime`,`schedules`.`arrival_datetime` AS `arrival_datetime`,`schedules`.`departure_airport` AS `departure_airport`,`schedules`.`arrival_airport` AS `arrival_airport`,`schedules`.`active` AS `active`,`schedules`.`remark` AS `remark`,`flights`.`name` AS `name`,`flights`.`remark` AS `flight_remark`,`routes`.`title` AS `title`,`routes`.`hour` AS `hour`,`routes`.`min` AS `min`,`routes`.`remark` AS `route_remark` from ((`schedules` join `flights` on((`schedules`.`flight_id` = `flights`.`flight_id`))) join `routes` on((`schedules`.`route_id` = `routes`.`route_id`))) order by `schedules`.`schedule_id`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
