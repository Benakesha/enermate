-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2018 at 07:12 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enermate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `enermate_alert`
--

CREATE TABLE `enermate_alert` (
  `id` int(30) NOT NULL,
  `alertname` varchar(100) NOT NULL,
  `alert_type` int(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `define_event` int(100) NOT NULL,
  `gtltlist` int(100) NOT NULL,
  `simpleThresholdValue` bigint(100) NOT NULL,
  `custom_event` varchar(100) NOT NULL,
  `duration` int(100) NOT NULL,
  `ondays` int(100) NOT NULL,
  `startHour` int(100) NOT NULL,
  `startMin` int(100) NOT NULL,
  `endHour` int(100) NOT NULL,
  `endMin` int(100) NOT NULL,
  `repeatday` int(100) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lastActivityTime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enermate_alert`
--

INSERT INTO `enermate_alert` (`id`, `alertname`, `alert_type`, `location`, `define_event`, `gtltlist`, `simpleThresholdValue`, `custom_event`, `duration`, `ondays`, `startHour`, `startMin`, `endHour`, `endMin`, `repeatday`, `mobileno`, `email`, `lastActivityTime`) VALUES
(9, 'Benaka', 0, 'PRODUCTION PANEL SMSB1', 0, 1, 2910, '', 2, 3, 11, 0, 15, 30, 60, '9632888779', 'halesh.sachin@gmail.com,benakeshnagaraj@gmail.com', '07/31/2018 19:10 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enermate_alert`
--
ALTER TABLE `enermate_alert`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enermate_alert`
--
ALTER TABLE `enermate_alert`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
