-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2019 at 07:26 AM
-- Server version: 5.7.24
-- PHP Version: 7.1.26

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
                                      `company_id` int(11) NOT NULL,
                                      PRIMARY KEY (`booker_id`),
                                      KEY `booker_ibfk_1` (`user_id`),
                                      KEY `booker_ibfk_2` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booker`
--

INSERT INTO `booker` (`booker_id`, `first_name`, `last_name`, `phone_number`, `user_id`, `finance_allowance`, `company_id`) VALUES
(22, 'Lebron', 'James', '07555666222', 39, 681.61, 1),
(23, 'Kyrie', 'Irving', '07555442165', 40, 648.63, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_time`, `vehicle_id`, `number_of_travelers`, `booker_id`, `driver_id`, `service_fee`, `route_id`) VALUES
(21, '2019-05-21 16:50:00', 2, 3, 22, 12, 112.78, 36),
(22, '2019-05-21 16:50:00', 1, 1, 22, 13, 104.47, 37),
(23, '2019-02-27 05:00:00', 2, 2, 22, 12, 101.14, 39),
(24, '2019-06-30 03:45:00', 5, 1, 23, 12, 163.68, 40),
(25, '2019-05-30 17:30:00', 4, 1, 23, 12, 187.69, 41);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
                                       `company_id` int(11) NOT NULL AUTO_INCREMENT,
                                       `company_name` varchar(50) NOT NULL,
                                       PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`) VALUES
(1, 'Tesco'),
(2, 'Selfridges'),
(3, 'YouTube'),
(4, 'Google'),
(5, 'Harrods'),
(6, 'Brown and Associates'),
(7, 'Amazon');

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
                                      `driver_rating` float NOT NULL,
                                      PRIMARY KEY (`driver_id`),
                                      KEY `userID` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `user_id`, `first_name`, `last_name`, `phone_number`, `driver_rating`) VALUES
(12, 37, 'Adam', 'Smith', '07444222111', 4.5),
(13, 38, 'John', 'Keynes', '07222111444', 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `loginuser`
--

DROP TABLE IF EXISTS `loginuser`;
CREATE TABLE IF NOT EXISTS `loginuser` (
                                         `user_id` int(11) NOT NULL AUTO_INCREMENT,
                                         `email` varchar(50) NOT NULL,
                                         `password` varchar(255) NOT NULL,
                                         PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loginuser`
--

INSERT INTO `loginuser` (`user_id`, `email`, `password`) VALUES
(37, 'adam.smith@gmail.com', '$2y$10$1Sc1VWgw/SHFdaIfQpqug.lWN.dY.1hx/2LxRJ7El0LMWrkUYcpZK'),
(38, 'j.keynes@gmail.com', '$2y$10$K1yYo/bBeB0G79JkivFbFe52Og/AFduLAcKwRos3xJTeuHFxUT.CG'),
(39, 'l.james@gmail.com', '$2y$10$QJCU8RLuluOu0Sx/clWFMepaPSUrXcY5Baz.XHc7wcOYA6FSrCi/O'),
(40, 'k.irving@gmail.com', '$2y$10$uKsVADQ2Z1ADKo/3XFczwerWpF15ZD00isoUvII4D13wpnP8vp6EC');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
                                     `route_id` int(11) NOT NULL AUTO_INCREMENT,
                                     `start_address` varchar(100) NOT NULL,
                                     `start_post_code` varchar(255) NOT NULL,
                                     `end_address` varchar(100) NOT NULL,
                                     `end_post_code` varchar(255) NOT NULL,
                                     PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `start_address`, `start_post_code`, `end_address`, `end_post_code`) VALUES
(36, 'NW1 1AS', 'NW1 1AS, London, England, United Kingdom', 'Terminal 4 Heathrow Airport', 'Terminal Four Roundabout, Hounslow, TW6 3, United Kingdom'),
(37, 'N1C 4AW', 'N1C 4AW, London, England, United Kingdom', 'Stanstead Airport', 'London Stansted Airport, Stansted Mountfitchet, England, United Kingdom'),
(38, 'N1C 4AS', 'N1C 4AS, London, England, United Kingdom', 'Luton Airport', 'Airport Way, Luton, LU2 9, United Kingdom'),
(39, 'N1S 4AR', 'N1C 4AR, London, England, United Kingdom', 'Stanstead Airport', 'London Stansted Airport, Stansted Mountfitchet, England, United Kingdom'),
(40, 'Malet Street London', 'Malet Street, London, WC1E 7, United Kingdom', 'Terminal 5 Heathrow Airport', 'Terminal 5 Roundabout, Hounslow, TW6 2, United Kingdom'),
(41, 'Bloomsbury London', 'Bloomsbury, London, England, United Kingdom', 'Gatwick Airport', 'Airport Way, Gatwick, RH6 0, United Kingdom');

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
                                        `email` varchar(50) NOT NULL,
                                        PRIMARY KEY (`traveler_id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `traveler`
--

INSERT INTO `traveler` (`traveler_id`, `first_name`, `last_name`, `phone_number`, `email`) VALUES
(139, 'Gordon', 'Hayward', '07888222111', 'g.hayward@gmail.com'),
(140, 'James', 'Harden', '07888555212', 'j.harden@gmail.com'),
(141, 'Dwayne', 'Wade', '07555222676', 'd.wade@gmail.com'),
(142, 'Kendrick', 'Lamar', '07965754231', 'k.lamar@gmail.com'),
(143, 'Chris', 'Bosh', '07654321222', 'c.bosh@gmail.com'),
(144, 'Klay', 'Thompson', '07543222111', 'k.thompson@gmail.com'),
(145, 'Damian', 'Lillard', '07656897650', 'd.lillard@gmail.com');

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
(21, 139),
(21, 140),
(21, 141),
(22, 142),
(23, 143),
(25, 143),
(23, 144),
(24, 145);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
                                       `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
                                       `vehicle_name` varchar(11) NOT NULL,
                                       `vehicle_cost` float NOT NULL,
                                       PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`, `vehicle_cost`) VALUES
(1, 'MEClass', 0.0306),
(2, 'MSClass', 0.0444),
(3, 'MVClass', 0.0472),
(4, 'RRover', 0.0417),
(5, 'RRPhantom', 0.0667),
(6, 'BMulsanne', 0.0583);

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
-- Constraints for table `travelerlist`
--
ALTER TABLE `travelerlist`
  ADD CONSTRAINT `travelerlist_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `travelerlist_ibfk_2` FOREIGN KEY (`traveler_id`) REFERENCES `traveler` (`traveler_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT ALL PRIVILEGES ON *.* TO 'groupB'@'localhost' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `booking`.* TO 'groupB'@'localhost';