-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2020 at 08:07 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Product.inhand`
--
CREATE DATABASE IF NOT EXISTS `Product.inhand` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Product.inhand`;

-- --------------------------------------------------------

--
-- Table structure for table `Commodity`
--

DROP TABLE IF EXISTS `Commodity`;
CREATE TABLE `Commodity` (
  `commodity_id` int(255) NOT NULL,
  `subsec_id` int(255) DEFAULT NULL,
  `commodity_name` int(200) DEFAULT NULL,
  `hcommodity_name` int(200) DEFAULT NULL,
  `commodity_size` varchar(100) DEFAULT NULL,
  `commodity_price` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `List_of_Item`
--

DROP TABLE IF EXISTS `List_of_Item`;
CREATE TABLE `List_of_Item` (
  `lid` int(255) NOT NULL,
  `rid` int(255) DEFAULT NULL,
  `sid` int(255) DEFAULT NULL,
  `Item_name` varchar(200) DEFAULT NULL,
  `Item_price` varchar(200) DEFAULT NULL,
  `Item_size` varchar(200) DEFAULT NULL,
  `Item_quantity` varchar(200) DEFAULT NULL,
  `available_quantity` varchar(200) DEFAULT NULL,
  `availability` varchar(200) DEFAULT NULL,
  `completion` int(1) DEFAULT '0',
  `acceptance` int(1) DEFAULT '0',
  `Status` int(1) NOT NULL DEFAULT '0',
  `OTP` varchar(50) DEFAULT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `Total` int(10) NOT NULL DEFAULT '0',
  `Commision` int(10) NOT NULL DEFAULT '0',
  `ratingStatus` int(1) NOT NULL DEFAULT '0',
  `Arrival_span` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

DROP TABLE IF EXISTS `Registration`;
CREATE TABLE `Registration` (
  `rid` int(255) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Registration_date` date DEFAULT NULL,
  `Phone_number` varchar(10) DEFAULT NULL,
  `Customer_type` varchar(1) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Flag` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Registration`
--

INSERT INTO `Registration` (`rid`, `Name`, `Username`, `Registration_date`, `Phone_number`, `Customer_type`, `City`, `State`, `Password`, `Flag`) VALUES
(1, 'Piyush Avinash Chincholikar', 'piyushac123', '2020-06-05', '9404012207', 'C', NULL, NULL, 'PNoxyC/si0nMuQ==', 0),
(2, 'Nirmala Chincholikar', 'nimu', '2020-06-05', '9421665566', 'C', NULL, NULL, 'I6rgb2UotzgY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

DROP TABLE IF EXISTS `Reviews`;
CREATE TABLE `Reviews` (
  `fid` int(255) NOT NULL,
  `lid` int(255) DEFAULT NULL,
  `ratingApp` int(1) NOT NULL DEFAULT '0',
  `commentApp` varchar(200) DEFAULT NULL,
  `ratingShopkeeper` int(1) NOT NULL DEFAULT '0',
  `commentShopkeeper` varchar(200) DEFAULT NULL,
  `ratingProduct` int(1) NOT NULL DEFAULT '0',
  `commentProduct` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Section`
--

DROP TABLE IF EXISTS `Section`;
CREATE TABLE `Section` (
  `sec_id` int(255) NOT NULL,
  `sec_name` varchar(200) DEFAULT NULL,
  `hsec_name` varchar(200) DEFAULT NULL,
  `shop_type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Shopkeeper`
--

DROP TABLE IF EXISTS `Shopkeeper`;
CREATE TABLE `Shopkeeper` (
  `sid` int(255) NOT NULL,
  `rid` int(255) DEFAULT NULL,
  `Shop_name` varchar(100) DEFAULT NULL,
  `Shop_type` varchar(50) DEFAULT NULL,
  `Shop_photo` varchar(100) DEFAULT NULL,
  `Shop_certificate` varchar(100) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `rating` float DEFAULT '0',
  `opening_time` time(6) DEFAULT NULL,
  `closing_time` time(6) DEFAULT NULL,
  `open_days` varchar(7) DEFAULT NULL,
  `current_open_status` int(1) DEFAULT NULL,
  `mode_of_payments` varchar(3) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Area` varchar(50) DEFAULT NULL,
  `Landmark` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL,
  `Activation` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SubSection`
--

DROP TABLE IF EXISTS `SubSection`;
CREATE TABLE `SubSection` (
  `subsec_id` int(255) NOT NULL,
  `sec_id` int(255) DEFAULT NULL,
  `subsec_name` varchar(200) DEFAULT NULL,
  `hsubsec_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token` (
  `tid` int(11) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `time_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`tid`, `Username`, `token`, `time_modified`) VALUES
(1, 'piyushac123', 'EQ0XgF3G2g', '2020-06-05 05:18:05'),
(2, 'nimu', 'RO3GzVlIXg', '2020-06-05 05:54:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Commodity`
--
ALTER TABLE `Commodity`
  ADD PRIMARY KEY (`commodity_id`),
  ADD KEY `commoditysection` (`subsec_id`);

--
-- Indexes for table `List_of_Item`
--
ALTER TABLE `List_of_Item`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `registered_user_2` (`rid`),
  ADD KEY `registered_shopkeeper` (`sid`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `List_number` (`lid`);

--
-- Indexes for table `Section`
--
ALTER TABLE `Section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `Shopkeeper`
--
ALTER TABLE `Shopkeeper`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `registered_user` (`rid`);

--
-- Indexes for table `SubSection`
--
ALTER TABLE `SubSection`
  ADD PRIMARY KEY (`subsec_id`),
  ADD KEY `subsection` (`sec_id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Commodity`
--
ALTER TABLE `Commodity`
  MODIFY `commodity_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `List_of_Item`
--
ALTER TABLE `List_of_Item`
  MODIFY `lid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Registration`
--
ALTER TABLE `Registration`
  MODIFY `rid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `fid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Section`
--
ALTER TABLE `Section`
  MODIFY `sec_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Shopkeeper`
--
ALTER TABLE `Shopkeeper`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `SubSection`
--
ALTER TABLE `SubSection`
  MODIFY `subsec_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Commodity`
--
ALTER TABLE `Commodity`
  ADD CONSTRAINT `commoditysection` FOREIGN KEY (`subsec_id`) REFERENCES `SubSection` (`subsec_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `List_of_Item`
--
ALTER TABLE `List_of_Item`
  ADD CONSTRAINT `registered_shopkeeper` FOREIGN KEY (`sid`) REFERENCES `Shopkeeper` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registered_user_2` FOREIGN KEY (`rid`) REFERENCES `Registration` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `List_number` FOREIGN KEY (`lid`) REFERENCES `List_of_Item` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Shopkeeper`
--
ALTER TABLE `Shopkeeper`
  ADD CONSTRAINT `registered_user` FOREIGN KEY (`rid`) REFERENCES `Registration` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SubSection`
--
ALTER TABLE `SubSection`
  ADD CONSTRAINT `subsection` FOREIGN KEY (`sec_id`) REFERENCES `Section` (`sec_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
