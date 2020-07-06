-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2020 at 04:14 AM
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
  `commodity_name` varchar(200) DEFAULT NULL,
  `hcommodity_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `commodity_size` varchar(100) DEFAULT NULL,
  `commodity_price` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Commodity`
--

INSERT INTO `Commodity` (`commodity_id`, `subsec_id`, `commodity_name`, `hcommodity_name`, `commodity_size`, `commodity_price`) VALUES
(1, 1, 'Amul Butter', 'अमूल बटर', '100_gram', 48),
(2, 1, 'Deogiri Dahi', 'देवगिरि दही', '200_gram', 20),
(3, 1, 'Vikas Gold Milk', 'विकास गोल्ड मिल्क', '500_milliliter', 25),
(4, 1, 'Amul Paneer', 'अमूल पनीर', '200_gram', 100),
(5, 1, 'Amul Cheese cubes', 'अमूल चीज़ क्यूब्स', '10_gram', 15),
(6, 1, 'Deogiri Buttermilk', 'देवगिरि छाछ', '250_milliliter', 12),
(7, 1, 'Vikas Buttermilk', 'विकास छाछ', '250_milliliter', 13),
(8, 2, 'Pranav Agro Sunflower Oil', 'प्रणव एग्रो सूरजमुखी तेल', '1_litre', 100),
(9, 2, 'Pranav Agro Soyabean Oil', 'प्रणव एग्रो सोयाबीन तेल', '1_litre', 95),
(10, 2, 'Veda Coconut Oil', 'वेदा नारियल तेल', '1_kilogram', 250),
(11, 2, 'Krishiv Dewaxed Mustard Oil', 'क्रिशिव डेवैक्सड सरसों का तेल', '1_litre', 125);

-- --------------------------------------------------------

--
-- Table structure for table `HShopkeeper`
--

DROP TABLE IF EXISTS `HShopkeeper`;
CREATE TABLE `HShopkeeper` (
  `hsid` int(255) NOT NULL,
  `rid` int(255) DEFAULT NULL,
  `Shop_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Shop_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Shop_photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Shop_certificate` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `opening_time` time(6) DEFAULT NULL,
  `closing_time` time(6) DEFAULT NULL,
  `open_days` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `current_open_status` int(1) DEFAULT NULL,
  `mode_of_payments` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Address` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Area` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Landmark` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `City` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `State` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Country` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Pincode` int(6) DEFAULT NULL,
  `Activation` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `HShopkeeper`
--

INSERT INTO `HShopkeeper` (`hsid`, `rid`, `Shop_name`, `Shop_type`, `Shop_photo`, `Shop_certificate`, `rating`, `Email`, `opening_time`, `closing_time`, `open_days`, `current_open_status`, `mode_of_payments`, `Address`, `Area`, `Landmark`, `City`, `State`, `Country`, `Pincode`, `Activation`) VALUES
(1, 1, 'पारमीता आइसक्रीम और डेली नीड्स', 'किराने और आवश्यक वस्तुएं', 'photo/1/photo1.jpg', 'certificate/1/certificate.jpeg', 0, 'piyush.chincholikar@gmail.com', '10:00:00.000000', '17:00:00.000000', '123456', 1, '13', 'एम.आई.जी.-30, अविष्कार कॉलोनी', 'एन -6, सिडको', 'अरिहंत बुक सेंटर, सिद्धार्थ चौक', 'औरंगाबाद', 'महाराष्ट्र', 'भारत', 431003, 1);

-- --------------------------------------------------------

--
-- Table structure for table `List_of_Item`
--

DROP TABLE IF EXISTS `List_of_Item`;
CREATE TABLE `List_of_Item` (
  `lid` int(255) NOT NULL,
  `rid` int(255) DEFAULT NULL,
  `sid` int(255) DEFAULT NULL,
  `Item_info` varchar(255) DEFAULT NULL,
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

--
-- Dumping data for table `List_of_Item`
--

INSERT INTO `List_of_Item` (`lid`, `rid`, `sid`, `Item_info`, `Item_name`, `Item_price`, `Item_size`, `Item_quantity`, `available_quantity`, `availability`, `completion`, `acceptance`, `Status`, `OTP`, `DATE`, `TIME`, `Total`, `Commision`, `ratingStatus`, `Arrival_span`) VALUES
(1, 2, 1, '[\"1-1-1\",\"1-1-4\",\"1-1-6\",\"2-2-10\"]', NULL, NULL, NULL, '[\"1\",\"2\",\"3\",\"1\"]', '[\"1\",\"2\",\"2\",\"1\"]', '[\"1\",\"1\",\"1\",\"1\"]', 1, 1, 1, 'L5uF+Cv5', '2020-06-27', '17:41:52', 522, 11, 2, '20 mins');

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
  `Photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Registration`
--

INSERT INTO `Registration` (`rid`, `Name`, `Username`, `Registration_date`, `Phone_number`, `Customer_type`, `City`, `State`, `Password`, `Photo`) VALUES
(1, 'Piyush Avinash Chincholikar', 'piyushac123', '2020-06-05', '9404012207', 'C', 'AURANGABAD', 'MAHARASHTRA', 'PNoxyC/si0nMuQ==', 'piyushac123_1.jpg'),
(2, 'Nirmala Chincholikar', 'nimu', '2020-06-05', '9421665566', 'C', 'AURANGABAD', 'MAHARASHTRA', 'I6rgb2UotzgY', 'img_avatar2.png'),
(3, 'Avinash Tukaram Chincholikar', 'Avinash', '2020-06-07', '9371676572', 'C', 'AURANGABAD', 'MAHARASHTRA', 'HZwpf9yK', NULL);

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

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`fid`, `lid`, `ratingApp`, `commentApp`, `ratingShopkeeper`, `commentShopkeeper`, `ratingProduct`, `commentProduct`) VALUES
(18, 1, 4, 'Aacha hai', 4, 'aachi hai', 4, 'Aachi hai');

-- --------------------------------------------------------

--
-- Table structure for table `Section`
--

DROP TABLE IF EXISTS `Section`;
CREATE TABLE `Section` (
  `sec_id` int(255) NOT NULL,
  `sec_name` varchar(200) DEFAULT NULL,
  `hsec_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `shop_type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Section`
--

INSERT INTO `Section` (`sec_id`, `sec_name`, `hsec_name`, `shop_type`) VALUES
(1, 'Essentials', 'अनिवार्य', 'grocery and essentials'),
(2, 'Oil', 'तेल', 'grocery and essentials');

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
  `rating` float NOT NULL DEFAULT '0',
  `Email` varchar(50) DEFAULT NULL,
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

--
-- Dumping data for table `Shopkeeper`
--

INSERT INTO `Shopkeeper` (`sid`, `rid`, `Shop_name`, `Shop_type`, `Shop_photo`, `Shop_certificate`, `rating`, `Email`, `opening_time`, `closing_time`, `open_days`, `current_open_status`, `mode_of_payments`, `Address`, `Area`, `Landmark`, `City`, `State`, `Country`, `Pincode`, `Activation`) VALUES
(1, 1, 'Parmita Ice-cream and Daily Needs', 'grocery and essentials', 'photo/1/photo1.jpg', 'certificate/1/certificate.jpeg', 0, 'piyush.chincholikar@gmail.com', '10:00:00.000000', '17:00:00.000000', '123456', 1, '13', 'M.I.G.-30, Avishkar Colony', 'N-6, CIDCO', 'Arihant Book Center, Siddharth chowk', 'AURANGABAD', 'MAHARASHTRA', 'INDIA', 431003, 1);

-- --------------------------------------------------------

--
-- Table structure for table `SubSection`
--

DROP TABLE IF EXISTS `SubSection`;
CREATE TABLE `SubSection` (
  `subsec_id` int(255) NOT NULL,
  `sec_id` int(255) DEFAULT NULL,
  `subsec_name` varchar(200) DEFAULT NULL,
  `hsubsec_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SubSection`
--

INSERT INTO `SubSection` (`subsec_id`, `sec_id`, `subsec_name`, `hsubsec_name`) VALUES
(1, 1, 'Diary Products ', 'दुग्ध उत्पाद'),
(2, 2, 'Edible oil', 'खाद्य तेल');

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
(1, 'piyushac123', 'ERrsBT8DZX', '2020-06-05 05:18:05'),
(2, 'nimu', 'VIdogKnDiI', '2020-06-05 05:54:22'),
(3, 'Avinash', 'TmdO3EsMyW', '2020-06-07 01:50:48'),
(4, 'piyu', 'WCC5GgPps6', '2020-06-07 02:28:16'),
(5, 'alice', 'uLWSfWvt3P', '2020-06-13 11:11:25'),
(6, 'bob123', '7ATELj34MH', '2020-06-13 11:50:55'),
(7, 'alice123', 'uTUK9qqWF8', '2020-06-13 11:53:02');

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
-- Indexes for table `HShopkeeper`
--
ALTER TABLE `HShopkeeper`
  ADD PRIMARY KEY (`hsid`),
  ADD KEY `registered_user_3` (`rid`);

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
  MODIFY `commodity_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `HShopkeeper`
--
ALTER TABLE `HShopkeeper`
  MODIFY `hsid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `List_of_Item`
--
ALTER TABLE `List_of_Item`
  MODIFY `lid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Registration`
--
ALTER TABLE `Registration`
  MODIFY `rid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `fid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Section`
--
ALTER TABLE `Section`
  MODIFY `sec_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Shopkeeper`
--
ALTER TABLE `Shopkeeper`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `SubSection`
--
ALTER TABLE `SubSection`
  MODIFY `subsec_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Commodity`
--
ALTER TABLE `Commodity`
  ADD CONSTRAINT `commoditysection` FOREIGN KEY (`subsec_id`) REFERENCES `SubSection` (`subsec_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `HShopkeeper`
--
ALTER TABLE `HShopkeeper`
  ADD CONSTRAINT `registered_user_3` FOREIGN KEY (`rid`) REFERENCES `Registration` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
