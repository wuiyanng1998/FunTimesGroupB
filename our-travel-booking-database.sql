-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 24, 2019 at 11:38 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BDF`
--
CREATE DATABASE IF NOT EXISTS `booking` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `booking`;

-- --------------------------------------------------------

--
-- Table structure for table `booker`
--

DROP TABLE IF EXISTS `booker`;
CREATE TABLE `booker` (
  `booker_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finance_allowance` double NOT NULL,
  `title` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `self_booking` tinyint(1) NOT NULL,
  `booking_time` date NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `number_of_travelers` int(11) NOT NULL,
  `number_of_luggages` int(11) NOT NULL,
  `booker_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `service_fee` double NOT NULL,
  `route_id` int(11) NOT NULL,
  `traveler_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `budget` double NOT NULL,
  `finance_manager_id` int(11) NOT NULL,
  `booker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `license_type` varchar(11) NOT NULL,
  `working_time_slot` int(11) NOT NULL,
  `driver_rating` float NOT NULL,
  `title` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `financeManager`
--

DROP TABLE IF EXISTS `financeManager`;
CREATE TABLE `financeManager` (
  `finance_manager_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `loginUser`
--

DROP TABLE IF EXISTS `loginUser`;
CREATE TABLE `loginUser` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `start_address` varchar(100) NOT NULL,
  `start_post_code` varchar(11) NOT NULL,
  `end_address` varchar(100) NOT NULL,
  `end_post_code` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `traveler`
--

DROP TABLE IF EXISTS `traveler`;
CREATE TABLE `traveler` (
  `traveler_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booker_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `number_of_travelers` int(11) NOT NULL,
  `number_of_luggages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booker`
--
ALTER TABLE `booker`
  ADD PRIMARY KEY (`booker_id`),
  ADD KEY `booker_ibfk_1` (`user_id`),
  ADD KEY `booker_ibfk_2` (`company_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `driverID` (`driver_id`),
  ADD KEY `booking_ibfk_3` (`route_id`),
  ADD KEY `booking_ibfk_4` (`booker_id`),
  ADD KEY `booking_ibfk_5` (`vehicle_id`),
  ADD KEY `traveler_id` (`traveler_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD KEY `company_ibfk_1` (`booker_id`),
  ADD KEY `company_ibfk_2` (`finance_manager_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `userID` (`user_id`);

--
-- Indexes for table `financeManager`
--
ALTER TABLE `financeManager`
  ADD PRIMARY KEY (`finance_manager_id`),
  ADD KEY `financemanager_ibfk_1` (`company_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `loginUser`
--
ALTER TABLE `loginUser`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `traveler`
--
ALTER TABLE `traveler`
  ADD PRIMARY KEY (`traveler_id`),
  ADD KEY `traveler_ibfk_1` (`booker_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booker`
--
ALTER TABLE `booker`
  MODIFY `booker_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financeManager`
--
ALTER TABLE `financeManager`
  MODIFY `finance_manager_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginUser`
--
ALTER TABLE `loginUser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `traveler`
--
ALTER TABLE `traveler`
  MODIFY `traveler_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booker`
--
ALTER TABLE `booker`
  ADD CONSTRAINT `booker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginUser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booker_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`booker_id`) REFERENCES `booker` (`booker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`traveler_id`) REFERENCES `traveler` (`traveler_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`booker_id`) REFERENCES `booker` (`booker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_ibfk_2` FOREIGN KEY (`finance_manager_id`) REFERENCES `financeManager` (`finance_manager_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginUser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `financeManager`
--
ALTER TABLE `financeManager`
  ADD CONSTRAINT `financemanager_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `financemanager_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `loginUser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `traveler`
--
ALTER TABLE `traveler`
  ADD CONSTRAINT `traveler_ibfk_1` FOREIGN KEY (`booker_id`) REFERENCES `booker` (`booker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `traveler_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `loginUser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
