-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2019 at 11:45 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--
CREATE DATABASE IF NOT EXISTS `booking` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `booking`;

-- --------------------------------------------------------

--
-- Table structure for table `booker`
--

DROP TABLE IF EXISTS `booker`;
CREATE TABLE IF NOT EXISTS `booker` (
  `booker_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finance_allowance` double NOT NULL,
  `title` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`booker_id`),
  KEY `booker_ibfk_1` (`user_id`),
  KEY `booker_ibfk_2` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booker`
--

INSERT INTO `booker` (`booker_id`, `first_name`, `last_name`, `phone_number`, `user_id`, `finance_allowance`, `title`, `company_id`) VALUES
(1, 'George', 'Smith', '07358298341', 1, 100, 'Mr', 1),
(2, 'Jenny', 'Jones', '07755982325', 2, 200, 'Miss', 2),
(3, 'John', 'Johnson', '07399201834', 11, 300, 'Mr', 3),
(4, 'Sal', 'Van Damm', '07888320123', 4, 400, 'Mr', 4),
(5, 'James', 'Brady', '07776649832', 12, 500, 'Mr', 5),
(6, 'Adam', 'Brown', '07638123556', 6, 600, 'Mr', 6),
(7, 'Alice', 'Grant', '07729678493', 7, 700, 'Ms', 7),
(8, 'James', 'Britton', '07293230248', 13, 800, 'Mr', 4);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_time` datetime NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `number_of_travelers` int(11) NOT NULL,
  `booker_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `service_fee` double NOT NULL,
  `route_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `driverID` (`driver_id`),
  KEY `booking_ibfk_3` (`route_id`),
  KEY `booking_ibfk_4` (`booker_id`),
  KEY `booking_ibfk_5` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_time`, `vehicle_id`, `number_of_travelers`, `booker_id`, `driver_id`, `service_fee`, `route_id`) VALUES
(1, '2019-01-01 00:00:00', 2, 1, 1, 1, 100, 1),
(2, '2019-01-01 00:00:00', 1, 2, 2, 2, 250, 2),
(3, '2019-02-02 00:00:00', 2, 1, 3, 1, 200, 3),
(4, '2019-02-01 00:00:00', 2, 2, 4, 1, 80, 4),
(5, '2019-01-19 00:00:00', 1, 4, 5, 2, 300, 5),
(6, '2019-02-12 00:00:00', 1, 1, 6, 2, 60, 6),
(7, '2019-02-09 00:00:00', 1, 1, 7, 2, 90, 7),
(8, '2019-01-11 00:00:00', 2, 2, 8, 1, 200, 8);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `budget` double NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `budget`) VALUES
(1, 'Tesco', 1100),
(2, 'Selfridges', 1200),
(3, 'YouTube', 1300),
(4, 'Google', 1400),
(5, 'Harrods', 1500),
(6, 'Brown and Associates', 1600),
(7, 'Amazon', 1700);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `license_type` varchar(11) NOT NULL,
  `working_time_slot` int(11) NOT NULL,
  `driver_rating` float NOT NULL,
  `title` varchar(11) NOT NULL,
  PRIMARY KEY (`driver_id`),
  KEY `userID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `user_id`, `first_name`, `last_name`, `phone_number`, `license_type`, `working_time_slot`, `driver_rating`, `title`) VALUES
(1, 9, 'Gavin', 'Greg', '07239840132', 'Bus', 0, 4.8, 'Mr'),
(2, 10, 'John', 'Roberts', '07995879192', 'Car', 1, 4.4, 'Mr');

-- --------------------------------------------------------

--
-- Table structure for table `loginuser`
--

DROP TABLE IF EXISTS `loginuser`;
CREATE TABLE IF NOT EXISTS `loginuser` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loginuser`
--

INSERT INTO `loginuser` (`user_id`, `email`, `password`) VALUES
(1, 'georgesmith@gmail.com', 'Password123'),
(2, 'jenrocks@yahoo.com', 'JennyJRocks'),
(3, 'c.bentley@youtube.com', 'YouTube2'),
(4, 'dammsal@gmail.com', '32123'),
(5, 'bradshaw.hannah@yahoo.com', 'Bradshaw'),
(6, 'a.brown@gmail.com', 'qwerty'),
(7, 'a.grant@gmail.com', 'zxcv'),
(8, 'a.patel@gmail.com', 'lkjh'),
(9, 'oigav@bdfcars.com', 'Password123'),
(10, 'j.roberts@bdfcars.com', 'asdf'),
(11, 'jjyoutube@youtube.com', 'CEOJohn'),
(12, 'brady.james@yahoo.com', 'Harrods111'),
(13, 'j.britton@googleinc.comm', 'mnbv');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_address` varchar(100) NOT NULL,
  `start_post_code` varchar(11) NOT NULL,
  `end_address` varchar(100) NOT NULL,
  `end_post_code` varchar(11) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `start_address`, `start_post_code`, `end_address`, `end_post_code`) VALUES
(1, 'Gower Street', 'gowerstpc', 'Heathrow', 'hthrwpc'),
(2, 'Stanstead Airport', 'stnstdpc', 'Kings Cross', 'kngscrsspc'),
(3, 'North Road', 'N7 9EG', 'Heathrow', 'hthrwpc'),
(4, 'Gatwick', 'gtwckpc', 'Oxford Circus', 'oxfdcrcspc'),
(5, 'Heathrow', 'hthrwpc', 'Knightsbridge', 'knghtbrdgpc'),
(6, 'Warren street', 'W1T 5LS', 'Heathrow', 'hthrwpc'),
(7, 'Harrington Square', 'NW1 2JH', 'Gatwick', 'gtwckpc'),
(8, 'Heathrow', 'hthrwpc', 'Sandland Street', 'WC1V');

-- --------------------------------------------------------

--
-- Table structure for table `traveler`
--

DROP TABLE IF EXISTS `traveler`;
CREATE TABLE IF NOT EXISTS `traveler` (
  `traveler_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`traveler_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `traveler`
--

INSERT INTO `traveler` (`traveler_id`, `first_name`, `last_name`, `phone_number`, `user_id`) VALUES
(1, 'George', 'Smith', '07358298341', 1),
(2, 'Jenny', 'Jones', '07755982325', 2),
(3, 'Charlotte', 'Bentley', '07555893142', 3),
(4, 'Sal', 'Van Damm', '07888320123', 4),
(5, 'Hannah', 'Bradshaw', '07998512645', 5),
(6, 'Adam', 'Brown', '07638123556', 6),
(7, 'Alice', 'Grant', '07729678493', 7),
(8, 'Alex', 'Patel', '07582980248', 8);

-- --------------------------------------------------------

--
-- Table structure for table `travelerlist`
--

DROP TABLE IF EXISTS `travelerlist`;
CREATE TABLE IF NOT EXISTS `travelerlist` (
  `booking_id` int(11) NOT NULL,
  `traveler_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`,`traveler_id`),
  KEY `booking_id` (`booking_id`,`traveler_id`),
  KEY `traveler_id` (`traveler_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `travelerlist`
--

INSERT INTO `travelerlist` (`booking_id`, `traveler_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_name` varchar(11) NOT NULL,
  `number_of_travelers` int(11) NOT NULL,
  `number_of_luggages` int(11) NOT NULL,
  `vehicle_cost` float NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`, `number_of_travelers`, `number_of_luggages`, `vehicle_cost`) VALUES
(1, 'MEClass', 4, 2, 0.0306),
(2, 'MSClass', 4, 2, 0.0444),
(3, 'MVClass', 6, 2, 0.0472),
(4, 'RRover', 4, 4, 0.0417),
(5, 'RRPhantom', 4, 2, 0.0667),
(6, 'BMulsanne', 4, 2, 0.0583);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booker`
--
ALTER TABLE `booker`
  ADD CONSTRAINT `booker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginuser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booker_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`booker_id`) REFERENCES `booker` (`booker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginuser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `traveler`
--
ALTER TABLE `traveler`
  ADD CONSTRAINT `traveler_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `loginuser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `travelerlist`
--
ALTER TABLE `travelerlist`
  ADD CONSTRAINT `travelerlist_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `travelerlist_ibfk_2` FOREIGN KEY (`traveler_id`) REFERENCES `traveler` (`traveler_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
