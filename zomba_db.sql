-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2020 at 09:21 AM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zomba_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_billboard_type`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_billboard_type` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_billboard_type`
--

INSERT INTO `tbl_distr_minic_portal_billboard_type` (`typeID`, `typeName`) VALUES
(1, 'Static Billboard '),
(3, 'Mobile Billboards');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_instant_payment_permission`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_instant_payment_permission` (
  `instantID` int(11) NOT NULL,
  `instantPay_status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_instant_payment_permission`
--

INSERT INTO `tbl_distr_minic_portal_instant_payment_permission` (`instantID`, `instantPay_status`) VALUES
(3, 'No'),
(4, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_levy_type`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_levy_type` (
  `type_id` int(10) NOT NULL,
  `levy_type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_levy_type`
--

INSERT INTO `tbl_distr_minic_portal_levy_type` (`type_id`, `levy_type`) VALUES
(1, 'Miscellaneous Levy Souce'),
(2, 'Permanent Levy Souce');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_plot_block`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_plot_block` (
  `block_ID` int(50) NOT NULL,
  `block_Name` varchar(50) NOT NULL,
  `block_Size` varchar(50) NOT NULL,
  `plot_total` varchar(50) NOT NULL,
  `plot_sold` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `locatedArea` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_plot_block`
--

INSERT INTO `tbl_distr_minic_portal_plot_block` (`block_ID`, `block_Name`, `block_Size`, `plot_total`, `plot_sold`, `location`, `locatedArea`) VALUES
(1, 'BLOCK A', '2000', '10', '2', '7', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_plot_use`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_plot_use` (
  `plot_useID` int(11) NOT NULL,
  `plot_useName` varchar(200) NOT NULL,
  `plot_price_TC` varchar(20) NOT NULL,
  `plot_price_DC` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_plot_use`
--

INSERT INTO `tbl_distr_minic_portal_plot_use` (`plot_useID`, `plot_useName`, `plot_price_TC`, `plot_price_DC`) VALUES
(1, 'Commercial', '173500', '173500');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_status`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_status` (
  `StatusId` int(50) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_status`
--

INSERT INTO `tbl_distr_minic_portal_status` (`StatusId`, `StatusName`) VALUES
(0, 'Not Paid'),
(1, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_transaction_source`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_transaction_source` (
  `source_id` int(11) NOT NULL,
  `source_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_transaction_source`
--

INSERT INTO `tbl_distr_minic_portal_transaction_source` (`source_id`, `source_name`) VALUES
(1, 'Bank'),
(2, 'Mobile App '),
(3, 'Web Portal '),
(4, 'Mobile Network Operator ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_user`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_user` (
  `UserId` int(50) NOT NULL,
  `UserName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_user`
--

INSERT INTO `tbl_distr_minic_portal_user` (`UserId`, `UserName`) VALUES
(1, 'Owner'),
(2, 'Agent'),
(3, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_minic_portal_user_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_minic_portal_user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_minic_portal_user_roles`
--

INSERT INTO `tbl_distr_minic_portal_user_roles` (`role_id`, `role_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Staff'),
(4, 'Manager'),
(7, 'Demo'),
(8, 'Demo2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_allowed_transactions`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_allowed_transactions` (
  `allow_id` int(11) NOT NULL,
  `device_number` int(11) NOT NULL,
  `pay_number` varchar(6) NOT NULL,
  `channel_type` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_allowed_transactions`
--

INSERT INTO `tbl_distr_munic_portal_allowed_transactions` (`allow_id`, `device_number`, `pay_number`, `channel_type`) VALUES
(15, 1, '1001', '00'),
(18, 1, '0001', '01'),
(19, 1, '0002', '01'),
(20, 2, '0001', '01'),
(21, 2, '0002', '01'),
(24, 3, '0001', '01'),
(25, 3, '0003', '01'),
(28, 3, '1001', '00'),
(29, 3, '1002', '00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_area_fee`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_area_fee` (
  `area_id` int(11) NOT NULL,
  `main_category` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_area_fee`
--

INSERT INTO `tbl_distr_munic_portal_area_fee` (`area_id`, `main_category`) VALUES
(1, 'URBAN  AREA'),
(2, 'RURAL  AREA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_banner_price`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_banner_price` (
  `bannerID` int(11) NOT NULL,
  `bannerDesc` varchar(50) NOT NULL,
  `bannerPrice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_banner_registered`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_banner_registered` (
  `regbannerID` int(11) NOT NULL,
  `ownerID` int(50) NOT NULL,
  `registeredDate` datetime NOT NULL,
  `location` int(50) NOT NULL,
  `descriptionID` int(50) NOT NULL,
  `days` int(10) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `payStatus` int(10) NOT NULL,
  `payDate` datetime NOT NULL,
  `receipt` varchar(200) NOT NULL,
  `paymentType` varchar(200) NOT NULL,
  `referenceNumber` varchar(200) NOT NULL,
  `acceptorID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_banner_training`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_banner_training` (
  `trainingID` int(11) NOT NULL,
  `ownerID` int(50) NOT NULL,
  `applicationDate` datetime NOT NULL,
  `trainingDesc` int(50) NOT NULL,
  `location` int(50) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `payStatus` int(10) NOT NULL,
  `payDate` datetime NOT NULL,
  `receipt` varchar(200) NOT NULL,
  `paymentType` varchar(200) NOT NULL,
  `referenceNumber` varchar(200) NOT NULL,
  `acceptorID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_batch_collection`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_batch_collection` (
  `batch_id` int(11) NOT NULL,
  `amount` int(254) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `agent_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tempo_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_department`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_department` (
  `department_ID` int(10) NOT NULL,
  `department_Name` varchar(50) NOT NULL,
  `department_acess` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_department`
--

INSERT INTO `tbl_distr_munic_portal_department` (`department_ID`, `department_Name`, `department_acess`) VALUES
(1, 'IT', 2147483647),
(2, 'Finance', 2147483647),
(3, 'Business', 2147483647),
(4, 'Land', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_department_acess`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_department_acess` (
  `department_acess_ID` int(10) NOT NULL,
  `department_ID` int(10) NOT NULL,
  `acess_Code` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_department_acess`
--

INSERT INTO `tbl_distr_munic_portal_department_acess` (`department_acess_ID`, `department_ID`, `acess_Code`) VALUES
(1, 1, '000001'),
(2, 1, '000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_device`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_device` (
  `deviceID` int(11) NOT NULL,
  `deviceType` varchar(50) NOT NULL,
  `deviceTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_device`
--

INSERT INTO `tbl_distr_munic_portal_device` (`deviceID`, `deviceType`, `deviceTypeName`) VALUES
(1, 'M', 'Mobile'),
(2, 'P', 'Pos');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_division`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_division` (
  `division_id` int(11) NOT NULL,
  `division_name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_division`
--

INSERT INTO `tbl_distr_munic_portal_division` (`division_id`, `division_name`) VALUES
(1, 'ZOMBA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_financial_year`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_financial_year` (
  `ID` int(11) NOT NULL,
  `form_date_year` date NOT NULL,
  `to_date_year` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_financial_year`
--

INSERT INTO `tbl_distr_munic_portal_financial_year` (`ID`, `form_date_year`, `to_date_year`) VALUES
(1, '2020-06-01', '2021-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_owner`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_owner` (
  `owner_id` int(100) NOT NULL,
  `tin_number` varchar(20) NOT NULL,
  `owner_fullname` varchar(50) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `po_box` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `district` varchar(50) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `owner_reg_number` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_owner`
--

INSERT INTO `tbl_distr_munic_portal_owner` (`owner_id`, `tin_number`, `owner_fullname`, `citizenship`, `po_box`, `email`, `image`, `phone_number`, `district`, `ward`, `street`, `owner_reg_number`) VALUES
(1, '232343', 'ANDREW K MTONGA', 'Tanzanian', 'P.O.Box 2435 TZ', '', 'masasi.png', '765438924', 'Zomba', 'Zomba', 'Zomba', '232343');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_past_payment_records`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_past_payment_records` (
  `Past_RecordID` int(11) NOT NULL,
  `payment_number` int(11) NOT NULL,
  `PRN` varchar(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `notification` int(11) NOT NULL,
  `agent_number` int(11) NOT NULL,
  `amount_pay` varchar(50) NOT NULL,
  `system_date` datetime NOT NULL,
  `terminal_date` datetime NOT NULL,
  `business_number` varchar(20) NOT NULL,
  `receipt` varchar(20) NOT NULL,
  `payment_slip` varchar(50) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `reference_number` varchar(250) NOT NULL,
  `extra_amount` varchar(250) NOT NULL,
  `new_licence` varchar(50) NOT NULL,
  `old_licence` varchar(50) NOT NULL,
  `transaction_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_payment_records`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_payment_records` (
  `payment_number` int(11) NOT NULL,
  `PRN` varchar(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `pay_status` varchar(10) NOT NULL,
  `reg_status` int(10) NOT NULL,
  `notification` int(11) NOT NULL,
  `agent_number` int(11) NOT NULL,
  `amount_pay` varchar(50) NOT NULL,
  `system_date` datetime NOT NULL,
  `terminal_date` datetime NOT NULL,
  `business_number` varchar(20) NOT NULL,
  `receipt` varchar(20) NOT NULL,
  `payment_slip` varchar(50) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `reference_number` varchar(250) NOT NULL,
  `extra_amount` varchar(250) NOT NULL,
  `new_licence` varchar(50) NOT NULL,
  `old_licence` varchar(50) NOT NULL,
  `transaction_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_payment_records`
--

INSERT INTO `tbl_distr_munic_portal_payment_records` (`payment_number`, `PRN`, `entity_id`, `pay_status`, `reg_status`, `notification`, `agent_number`, `amount_pay`, `system_date`, `terminal_date`, `business_number`, `receipt`, `payment_slip`, `payment_name`, `reference_number`, `extra_amount`, `new_licence`, `old_licence`, `transaction_status`) VALUES
(1, '1739030506', 1, '1', 1, 0, 0, '500', '2020-07-16 23:00:30', '2020-07-16 23:12:10', '0', '0000010716', '', '', '', '0', '', '', 0),
(2, '8482889710', 2, '1', 1, 0, 0, '500', '2020-07-21 12:21:41', '2020-09-23 09:51:17', '0', '0000100923', '', '', 'kxsc18Ys5s', '0', '', '', 0),
(3, '7050840354', 4, '1', 1, 0, 5, '500', '2020-07-25 12:40:08', '2020-10-22 08:50:42', '0', '0000151022', '7272727', 'Bank', 'cRyYUKVKqD', '0', '072500001', '', 0),
(4, '0032357325', 5, '1', 1, 0, 0, '500', '2020-07-28 12:34:18', '2020-10-22 08:52:44', '0', '0000161022', '', '', 'LAMeuPnscd', '0', '072800002', '', 0),
(5, '7784778364', 6, '1', 1, 0, 5, '500', '2020-09-16 11:15:53', '2020-11-17 18:08:22', '0', '0000181117', 'o8ea', 'Bank', 'RgKuZv9FUX', '0', '091600003', '', 0),
(6, '3956631436', 7, '1', 1, 0, 0, '500', '2020-10-22 17:06:35', '2020-11-17 15:11:31', '0', '0000191117', '', '', 'CmGNdECROF', '0', '102200004', '', 0),
(7, '4515542515', 8, '1', 1, 0, 0, '500', '2020-11-17 18:20:11', '2020-11-26 19:24:34', '0', '0000291126', '', '', '3z7B3DH70K', '0', '111700005', '', 0),
(8, '5477826742', 9, '1', 1, 0, 5, '500', '2020-11-24 12:57:16', '2020-11-26 18:39:57', '0', '0000221126', '0683542710', 'Cash', 'mpgwpiMaVU', '0', '112400006', '', 0),
(9, '3943262140', 10, '1', 1, 0, 0, '500', '2020-11-26 18:48:18', '2020-11-26 18:49:57', '0', '0000231126', '', '', '', '0', '112600007', '', 0),
(10, '3823447664', 11, '1', 1, 0, 0, '500', '2020-11-26 19:03:10', '2020-11-26 19:03:45', '0', '0000251126', '', '', '', '0', '112600008', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_payment_records_cancelled`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_payment_records_cancelled` (
  `cancelled_id` int(11) NOT NULL,
  `payment_number` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_payment_type`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_payment_type` (
  `payment_id` int(11) NOT NULL,
  `payment_name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_payment_type`
--

INSERT INTO `tbl_distr_munic_portal_payment_type` (`payment_id`, `payment_name`) VALUES
(1, 'Bank'),
(2, 'Cash'),
(3, 'Cheque');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_permanent_collection`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_permanent_collection` (
  `permanent_id` int(11) NOT NULL,
  `amount` int(254) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `amount_paid` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_permanent_entity`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_permanent_entity` (
  `entity_id` int(11) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `descr_id` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `hamlet_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `registration_name` varchar(50) NOT NULL,
  `manager_name` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `business_number` varchar(20) NOT NULL,
  `business_premises` varchar(50) NOT NULL,
  `block` varchar(50) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `principal_licence` varchar(50) DEFAULT NULL,
  `principal_fee` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_permanent_entity`
--

INSERT INTO `tbl_distr_munic_portal_permanent_entity` (`entity_id`, `owner_id`, `descr_id`, `date_register`, `hamlet_id`, `area_id`, `registration_name`, `manager_name`, `image`, `longitude`, `latitude`, `business_number`, `business_premises`, `block`, `house_no`, `vat`, `principal_licence`, `principal_fee`, `room_no`) VALUES
(1, 1, 1, '2020-07-16 23:00:30', 1, 1, 'Test', '', 'masasi.png', '0.00000000', '0.00000000', '0001', '', '', '', '', NULL, NULL, ''),
(2, 1, 2, '2020-07-21 12:21:41', 1, 1, 'Test', '', 'masasi.png', '0.00000000', '0.00000000', '0011', '', '', '', '', NULL, NULL, ''),
(3, 1, 2, '2020-07-25 12:34:57', 1, 2, 'Gravels', '', 'masasi.png', '0.00000000', '0.00000000', '0013', '', '', '', '', NULL, NULL, ''),
(4, 1, 2, '2020-07-25 12:40:08', 1, 2, 'Gravels', '', 'masasi.png', '0.00000000', '0.00000000', '0013', '', '', '', '', NULL, NULL, ''),
(5, 1, 2, '2020-07-28 12:34:18', 1, 1, 'Testin', '', 'masasi.png', '0.00000000', '0.00000000', '0017', '', '', '', '', NULL, NULL, ''),
(6, 1, 2, '2020-09-16 11:15:53', 1, 1, 'Testing', '', 'masasi.png', '0.00000000', '0.00000000', '0011', '', '', '', '', NULL, NULL, ''),
(7, 1, 2, '2020-10-22 17:06:34', 1, 1, 'test test', 'New', 'masasi.png', '0.00000000', '0.00000000', '0011', '', '', '', '', NULL, NULL, ''),
(8, 1, 1, '2020-11-17 18:20:11', 1, 1, 'test', 'TEST', 'masasi.png', '0.00000000', '0.00000000', '0011', '', '', '', '', NULL, NULL, ''),
(9, 1, 1, '2020-11-24 12:57:16', 1, 2, 'aaa', '', 'masasi.png', '0.00000000', '0.00000000', '2334444', '', '', '', '', NULL, NULL, ''),
(10, 1, 1, '2020-11-26 18:48:18', 1, 1, '12345', 'James Buretta', 'masasi.png', '0.00000000', '0.00000000', '12345', '', '', '', '', NULL, NULL, ''),
(11, 1, 2, '2020-11-26 19:03:10', 1, 2, '1234567', '', 'masasi.png', '0.00000000', '0.00000000', '1234567', '', '', '', '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_permanent_levy`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_permanent_levy` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `gf_code` int(6) unsigned zerofill NOT NULL,
  `LGA` int(4) unsigned zerofill NOT NULL,
  `channel_type` int(2) unsigned zerofill NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_permanent_levy`
--

INSERT INTO `tbl_distr_munic_portal_permanent_levy` (`type_id`, `type_name`, `gf_code`, `LGA`, `channel_type`) VALUES
(1, 'Business Licence Test', 000001, 3028, 00),
(2, 'Business Licence', 000001, 3028, 00),
(3, 'Land Licence', 000001, 3028, 00),
(4, 'House Licence', 000005, 3028, 00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_permanent_levy_descrption`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_permanent_levy_descrption` (
  `descr_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `pay_number` int(4) unsigned zerofill NOT NULL,
  `descrption_name` varchar(50) NOT NULL,
  `amount_required_HQ` varchar(50) NOT NULL,
  `amount_required_MINOR` varchar(50) NOT NULL,
  `extra_amount` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_permanent_levy_descrption`
--

INSERT INTO `tbl_distr_munic_portal_permanent_levy_descrption` (`descr_id`, `type_id`, `pay_number`, `descrption_name`, `amount_required_HQ`, `amount_required_MINOR`, `extra_amount`) VALUES
(1, 1, 1001, 'SHOP', '500', '500', '0'),
(2, 1, 1002, 'Pharmacy', '500', '500', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_system_user`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_system_user` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(500) NOT NULL,
  `department_ID` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_system_user`
--

INSERT INTO `tbl_distr_munic_portal_system_user` (`user_id`, `full_name`, `user_name`, `role_id`, `password`, `department_ID`, `title`, `email`, `phone_number`) VALUES
(5, 'TestAdmin', 'TestAdmin', 1, 'feec62854fa4d276b9e7ca69d4f4d59c7d99017c7a0e680707f454f44cebdbcf', 1, 'IT', 'fabianalex3232@yahoo.com', ''),
(6, 'Victor L  Massawe', 'villyman', 1, '24134c9466fe91e4c27d4be18355bfd1ab7c14f633abb4c96f97efc0756ce8c2', 1, 'IT', 'fabianalex3232@gmail.com', '0762988043'),
(13, 'ATHANASE MEDE', 'MedeA', 5, '3caeafc525abce062b0349bdf5051502f10098f41545de1e0995e67f953c90fb', 2, 'REVENUE ACCOUNTANT', 'athanasmede@gmail.com', '0784319457'),
(14, 'Admin', 'admin', 1, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 'Admin', 'peter.paul@bcx.co.tz', '00999999'),
(15, 'Harry Hackim', 'hhackim', 4, '1838163eb6650e7a85fe3c69fcfe4a341e4332612897dc01a3b57eb4c1a04f5f', 3, 'Project Manager', 'hhackim@nitel.mw', '0881250771');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_temporary_levy`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_temporary_levy` (
  `entity_id` int(11) NOT NULL,
  `pay_number` int(4) unsigned zerofill NOT NULL,
  `tempo_name` varchar(50) NOT NULL,
  `amount_worth` varchar(50) NOT NULL,
  `start_date` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `tempo_type_id` int(11) DEFAULT NULL,
  `location` int(11) NOT NULL,
  `instant_payment` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_temporary_levy`
--

INSERT INTO `tbl_distr_munic_portal_temporary_levy` (`entity_id`, `pay_number`, `tempo_name`, `amount_worth`, `start_date`, `status`, `end_date`, `tempo_type_id`, `location`, `instant_payment`) VALUES
(1, 0001, 'Tax Martkert A = 500', '100', '2020-06-02 13:59:23', 'Active', '2020-06-02 13:59:23', 4, 1, 4),
(2, 0002, 'Taxa do Camiao = 500', '200', '2020-07-21 12:16:52', 'Active', '2020-07-21 12:16:52', 5, 1, 4),
(3, 0003, 'Taxa do Camiao = 500', '200', '2020-07-28 12:35:58', 'Active', '2020-07-28 12:35:58', 5, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_user_permission`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_user_permission` (
  `permission_id` int(11) NOT NULL,
  `permission_description` varchar(20) DEFAULT NULL,
  `page` varchar(30) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1656 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_user_permission`
--

INSERT INTO `tbl_distr_munic_portal_user_permission` (`permission_id`, `permission_description`, `page`, `role_id`) VALUES
(399, 'edit', 'location', 3),
(400, 'add', 'location', 3),
(469, 'view', 'registration', 4),
(470, 'edit', 'registration', 4),
(471, 'add', 'registration', 4),
(472, 'delete', 'registration', 4),
(1058, 'view', 'location', 5),
(1059, 'edit', 'location', 5),
(1060, 'add', 'location', 5),
(1061, 'delete', 'location', 5),
(1062, 'view', 'registration', 5),
(1063, 'edit', 'registration', 5),
(1064, 'add', 'registration', 5),
(1065, 'delete', 'registration', 5),
(1066, 'view', 'list-view', 5),
(1067, 'edit', 'list-view', 5),
(1068, 'add', 'list-view', 5),
(1069, 'view', 'enforcement', 5),
(1070, 'edit', 'enforcement', 5),
(1071, 'add', 'enforcement', 5),
(1072, 'view', 'payment', 5),
(1073, 'edit', 'payment', 5),
(1074, 'add', 'payment', 5),
(1075, 'view', 'profile', 5),
(1076, 'edit', 'profile', 5),
(1077, 'add', 'profile', 5),
(1078, 'delete', 'profile', 5),
(1079, 'view', 'land-management', 5),
(1080, 'edit', 'land-management', 5),
(1081, 'view', 'transaction-management', 5),
(1082, 'edit', 'transaction-management', 5),
(1083, 'view', 'location', 2),
(1084, 'edit', 'location', 2),
(1085, 'add', 'location', 2),
(1086, 'delete', 'location', 2),
(1087, 'view', 'temporary', 2),
(1088, 'edit', 'temporary', 2),
(1089, 'add', 'temporary', 2),
(1090, 'delete', 'temporary', 2),
(1091, 'view', 'report', 2),
(1092, 'edit', 'report', 2),
(1093, 'add', 'report', 2),
(1094, 'delete', 'report', 2),
(1095, 'view', 'registration', 2),
(1096, 'edit', 'registration', 2),
(1097, 'add', 'registration', 2),
(1098, 'delete', 'registration', 2),
(1099, 'view', 'list-view', 2),
(1100, 'edit', 'list-view', 2),
(1101, 'add', 'list-view', 2),
(1102, 'delete', 'list-view', 2),
(1103, 'add', 'user-management', 2),
(1104, 'view', 'enforcement', 2),
(1105, 'edit', 'enforcement', 2),
(1106, 'add', 'enforcement', 2),
(1107, 'delete', 'enforcement', 2),
(1108, 'view', 'payment', 2),
(1109, 'edit', 'payment', 2),
(1110, 'add', 'payment', 2),
(1111, 'delete', 'payment', 2),
(1112, 'view', 'profile', 2),
(1113, 'edit', 'profile', 2),
(1114, 'add', 'profile', 2),
(1115, 'delete', 'profile', 2),
(1116, 'view', 'land-management', 2),
(1117, 'edit', 'land-management', 2),
(1118, 'add', 'land-management', 2),
(1119, 'delete', 'land-management', 2),
(1372, 'view', 'location', 5),
(1373, 'edit', 'location', 5),
(1374, 'add', 'location', 5),
(1375, 'delete', 'location', 5),
(1376, 'view', 'report', 5),
(1377, 'edit', 'report', 5),
(1378, 'add', 'report', 5),
(1379, 'delete', 'report', 5),
(1380, 'view', 'location', 6),
(1381, 'edit', 'location', 6),
(1382, 'add', 'location', 6),
(1383, 'delete', 'location', 6),
(1384, 'view', 'temporary', 6),
(1385, 'edit', 'temporary', 6),
(1386, 'add', 'temporary', 6),
(1387, 'delete', 'temporary', 6),
(1388, 'view', 'report', 6),
(1389, 'edit', 'report', 6),
(1390, 'add', 'report', 6),
(1391, 'delete', 'report', 6),
(1404, 'view', 'location', 7),
(1405, 'edit', 'location', 7),
(1406, 'add', 'location', 7),
(1407, 'delete', 'location', 7),
(1408, 'view', 'temporary', 7),
(1409, 'edit', 'temporary', 7),
(1410, 'add', 'temporary', 7),
(1411, 'delete', 'temporary', 7),
(1412, 'view', 'report', 7),
(1413, 'edit', 'report', 7),
(1414, 'add', 'report', 7),
(1415, 'delete', 'report', 7),
(1416, 'view', 'fire-section', 7),
(1417, 'edit', 'fire-section', 7),
(1418, 'add', 'fire-section', 7),
(1419, 'delete', 'fire-section', 7),
(1420, 'view', 'registration', 7),
(1421, 'edit', 'registration', 7),
(1422, 'add', 'registration', 7),
(1423, 'delete', 'registration', 7),
(1424, 'view', 'list-view', 7),
(1425, 'edit', 'list-view', 7),
(1426, 'add', 'list-view', 7),
(1427, 'delete', 'list-view', 7),
(1428, 'view', 'user-management', 7),
(1429, 'edit', 'user-management', 7),
(1430, 'add', 'user-management', 7),
(1431, 'delete', 'user-management', 7),
(1432, 'view', 'billboard', 7),
(1433, 'edit', 'billboard', 7),
(1434, 'add', 'billboard', 7),
(1435, 'delete', 'billboard', 7),
(1436, 'view', 'enforcement', 7),
(1437, 'edit', 'enforcement', 7),
(1438, 'add', 'enforcement', 7),
(1439, 'delete', 'enforcement', 7),
(1440, 'view', 'payment', 7),
(1441, 'edit', 'payment', 7),
(1442, 'add', 'payment', 7),
(1443, 'delete', 'payment', 7),
(1444, 'view', 'profile', 7),
(1445, 'edit', 'profile', 7),
(1446, 'add', 'profile', 7),
(1447, 'delete', 'profile', 7),
(1448, 'view', 'land-management', 7),
(1449, 'edit', 'land-management', 7),
(1450, 'add', 'land-management', 7),
(1451, 'delete', 'land-management', 7),
(1452, 'view', 'transaction-management', 7),
(1453, 'edit', 'transaction-management', 7),
(1454, 'add', 'transaction-management', 7),
(1455, 'delete', 'transaction-management', 7),
(1456, 'view', 'location', 8),
(1457, 'edit', 'location', 8),
(1458, 'add', 'location', 8),
(1459, 'delete', 'location', 8),
(1460, 'view', 'temporary', 8),
(1461, 'edit', 'temporary', 8),
(1462, 'add', 'temporary', 8),
(1463, 'delete', 'temporary', 8),
(1464, 'view', 'report', 8),
(1465, 'edit', 'report', 8),
(1466, 'add', 'report', 8),
(1467, 'view', 'fire-section', 8),
(1468, 'edit', 'fire-section', 8),
(1469, 'add', 'fire-section', 8),
(1470, 'view', 'registration', 8),
(1471, 'edit', 'registration', 8),
(1472, 'add', 'registration', 8),
(1473, 'delete', 'registration', 8),
(1474, 'view', 'list-view', 8),
(1475, 'edit', 'list-view', 8),
(1476, 'add', 'list-view', 8),
(1477, 'delete', 'list-view', 8),
(1478, 'view', 'billboard', 8),
(1479, 'edit', 'billboard', 8),
(1480, 'add', 'billboard', 8),
(1481, 'delete', 'billboard', 8),
(1482, 'view', 'user-management', 8),
(1483, 'edit', 'user-management', 8),
(1484, 'add', 'user-management', 8),
(1485, 'delete', 'user-management', 8),
(1486, 'view', 'enforcement', 8),
(1487, 'edit', 'enforcement', 8),
(1488, 'add', 'enforcement', 8),
(1489, 'delete', 'enforcement', 8),
(1490, 'view', 'payment', 8),
(1491, 'edit', 'payment', 8),
(1492, 'add', 'payment', 8),
(1493, 'view', 'land-management', 8),
(1494, 'edit', 'land-management', 8),
(1495, 'add', 'land-management', 8),
(1496, 'view', 'profile', 8),
(1497, 'edit', 'profile', 8),
(1498, 'view', 'transaction-management', 8),
(1499, 'edit', 'transaction-management', 8),
(1604, 'view', 'location', 1),
(1605, 'edit', 'location', 1),
(1606, 'add', 'location', 1),
(1607, 'delete', 'location', 1),
(1608, 'view', 'temporary', 1),
(1609, 'edit', 'temporary', 1),
(1610, 'add', 'temporary', 1),
(1611, 'delete', 'temporary', 1),
(1612, 'view', 'report', 1),
(1613, 'edit', 'report', 1),
(1614, 'add', 'report', 1),
(1615, 'delete', 'report', 1),
(1616, 'view', 'fire-section', 1),
(1617, 'edit', 'fire-section', 1),
(1618, 'add', 'fire-section', 1),
(1619, 'delete', 'fire-section', 1),
(1620, 'view', 'registration', 1),
(1621, 'edit', 'registration', 1),
(1622, 'add', 'registration', 1),
(1623, 'delete', 'registration', 1),
(1624, 'view', 'list-view', 1),
(1625, 'edit', 'list-view', 1),
(1626, 'add', 'list-view', 1),
(1627, 'delete', 'list-view', 1),
(1628, 'view', 'user-management', 1),
(1629, 'edit', 'user-management', 1),
(1630, 'add', 'user-management', 1),
(1631, 'delete', 'user-management', 1),
(1632, 'view', 'billboard', 1),
(1633, 'edit', 'billboard', 1),
(1634, 'add', 'billboard', 1),
(1635, 'delete', 'billboard', 1),
(1636, 'view', 'enforcement', 1),
(1637, 'edit', 'enforcement', 1),
(1638, 'add', 'enforcement', 1),
(1639, 'delete', 'enforcement', 1),
(1640, 'view', 'payment', 1),
(1641, 'edit', 'payment', 1),
(1642, 'add', 'payment', 1),
(1643, 'delete', 'payment', 1),
(1644, 'view', 'profile', 1),
(1645, 'edit', 'profile', 1),
(1646, 'add', 'profile', 1),
(1647, 'delete', 'profile', 1),
(1648, 'view', 'land-management', 1),
(1649, 'edit', 'land-management', 1),
(1650, 'add', 'land-management', 1),
(1651, 'delete', 'land-management', 1),
(1652, 'view', 'transaction-management', 1),
(1653, 'edit', 'transaction-management', 1),
(1654, 'add', 'transaction-management', 1),
(1655, 'delete', 'transaction-management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_village`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_village` (
  `village_id` int(11) NOT NULL,
  `village_name` varchar(20) NOT NULL,
  `ward_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_village`
--

INSERT INTO `tbl_distr_munic_portal_village` (`village_id`, `village_name`, `ward_id`) VALUES
(1, 'Zomba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_portal_ward`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_portal_ward` (
  `ward_id` int(11) NOT NULL,
  `ward_name` varchar(20) NOT NULL,
  `ward_code` int(3) unsigned zerofill NOT NULL,
  `division_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_portal_ward`
--

INSERT INTO `tbl_distr_munic_portal_ward` (`ward_id`, `ward_name`, `ward_code`, `division_id`) VALUES
(1, 'ZOMBA', 001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munic_svc_daily_receipt_count`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munic_svc_daily_receipt_count` (
  `receipt_identifier` int(11) NOT NULL,
  `time_recorded` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munic_svc_daily_receipt_count`
--

INSERT INTO `tbl_distr_munic_svc_daily_receipt_count` (`receipt_identifier`, `time_recorded`) VALUES
(1, '2020-06-02'),
(2, '2020-06-02'),
(3, '2020-06-02'),
(4, '2020-06-02'),
(5, '2020-06-02'),
(6, '2020-06-02'),
(7, '2020-06-02'),
(8, '2020-06-02'),
(9, '2020-06-02'),
(10, '2020-06-02'),
(11, '2020-06-02'),
(12, '2020-06-02'),
(13, '2020-06-02'),
(14, '2020-06-02'),
(15, '2020-06-02'),
(16, '2020-06-02'),
(17, '2020-06-02'),
(18, '2020-06-08'),
(19, '2020-06-24'),
(20, '2020-06-24'),
(21, '2020-07-16'),
(22, '2020-07-16'),
(23, '2020-07-16'),
(24, '2020-07-16'),
(25, '2020-07-16'),
(26, '2020-07-16'),
(27, '2020-07-21'),
(28, '2020-07-21'),
(29, '2020-07-30'),
(30, '2020-09-06'),
(31, '2020-09-16'),
(32, '2020-09-16'),
(33, '2020-09-16'),
(34, '2020-09-16'),
(35, '2020-09-16'),
(36, '2020-09-16'),
(37, '2020-09-16'),
(38, '2020-09-16'),
(39, '2020-09-16'),
(40, '2020-09-22'),
(41, '2020-09-22'),
(42, '2020-11-23'),
(43, '2020-11-24'),
(44, '2020-11-24'),
(45, '2020-11-24'),
(46, '2020-11-24'),
(47, '2020-11-24'),
(48, '2020-11-24'),
(49, '2020-11-24'),
(50, '2020-11-26'),
(51, '2020-11-26'),
(52, '2020-11-26'),
(53, '2020-11-26'),
(54, '2020-11-26'),
(55, '2020-11-26'),
(56, '2020-11-26'),
(57, '2020-11-26'),
(58, '2020-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_agent_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_agent_detail` (
  `agent_id` int(11) NOT NULL,
  `agent_address` varchar(50) NOT NULL,
  `agent_licence` varchar(50) NOT NULL,
  `agent_tin` varchar(15) NOT NULL,
  `agent_incop_no` varchar(50) NOT NULL,
  `agent_name` varchar(50) NOT NULL,
  `agent_phone` varchar(15) NOT NULL,
  `agent_image` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_agent_detail`
--

INSERT INTO `tbl_distr_munis_portal_agent_detail` (`agent_id`, `agent_address`, `agent_licence`, `agent_tin`, `agent_incop_no`, `agent_name`, `agent_phone`, `agent_image`) VALUES
(7, 'Test', 'Test', '111111', '', 'Test', 'Test', 'masasi.png'),
(8, 'Test', 'Test', '654356', '', 'Test', '0765438924', 'masasi.png'),
(9, 'Lilongwe', '1234', '4321', '', 'Company A', '0765438924', 'masasi.png'),
(10, 'Dar es Salaam, Tanzania', 'BL1122', '111222333', '112233', 'BCX Collectors', '0689361147', 'masasi.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_agent_devices`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_agent_devices` (
  `device_number` int(11) NOT NULL,
  `device_session_token` varchar(256) NOT NULL,
  `device_mobile_no` varchar(52) NOT NULL,
  `device_sim_serial` varchar(30) NOT NULL,
  `device_imei` varchar(30) NOT NULL,
  `device_printer` varchar(30) NOT NULL,
  `version` varchar(20) DEFAULT NULL,
  `has_offline_transactions` char(1) NOT NULL,
  `device_type` varchar(50) NOT NULL,
  `device_name` varchar(30) NOT NULL,
  `device_location` varchar(20) NOT NULL,
  `allowed_transaction` varchar(20) DEFAULT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_agent_devices`
--

INSERT INTO `tbl_distr_munis_portal_agent_devices` (`device_number`, `device_session_token`, `device_mobile_no`, `device_sim_serial`, `device_imei`, `device_printer`, `version`, `has_offline_transactions`, `device_type`, `device_name`, `device_location`, `allowed_transaction`, `agent_id`) VALUES
(1, '', '765438924', '99000750197941', '866995032276523', '02:0F:D7:72:27:53', '1595323075', '', 'M', 'Test-Device', '1', NULL, 6),
(2, '', '0765438924', '353007060375035x', '353007060375035x', '02:0F:D7:72:27:53', '1595324101', '', 'M', 'Company A device', '1', NULL, 9),
(3, '', 'AA:3D:78:AA:AA:96', '353007060374038', '353007060374038', 'AA:3D:78:AA:AA:96', '1606068757', '', 'P', 'james', '1', NULL, 7),
(4, '', '0689361147', 'EMULATOR29X2X0X0', '358240051111110', 'AA:3D:78:AA:AA:96', NULL, '', 'M', 'BCX Emulator P3a', '1', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_agent_device_operators`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_agent_device_operators` (
  `operator_id` int(11) NOT NULL,
  `operator_fullname` varchar(100) NOT NULL,
  `operator_username` varchar(10) NOT NULL,
  `operator_password` varchar(256) NOT NULL,
  `operator_mobile_no` varchar(12) NOT NULL,
  `operator_address` varchar(100) NOT NULL,
  `device_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_agent_device_operators`
--

INSERT INTO `tbl_distr_munis_portal_agent_device_operators` (`operator_id`, `operator_fullname`, `operator_username`, `operator_password`, `operator_mobile_no`, `operator_address`, `device_number`) VALUES
(1, 'Filbert Eusabius', 'test', '1234', '765438924', '1234', 1),
(2, 'Ally Hamis', 'test', '1234', '0765-000000', '1233', 2),
(3, 'james', 'James', '12345', '0683542710', '9111', 3),
(4, 'Ali Suleiman', 'ali', 'ali1234.', '0689361147', 'P.O Box 1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_approval_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_approval_payment` (
  `approve_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `agent_number` int(11) NOT NULL,
  `payment_slip` varchar(30) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `amount_receive` varchar(50) NOT NULL,
  `datetime_receive` datetime NOT NULL,
  `receipt_number` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_audit_trial`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_audit_trial` (
  `audit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_time` datetime NOT NULL,
  `activity` varchar(50) NOT NULL,
  `values_change` varchar(100) NOT NULL,
  `table_affected` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=323 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_audit_trial`
--

INSERT INTO `tbl_distr_munis_portal_audit_trial` (`audit_id`, `user_id`, `action_time`, `activity`, `values_change`, `table_affected`) VALUES
(1, 5, '2020-05-29 11:15:40', 'Login', '', 'System User'),
(2, 5, '2020-05-29 11:15:43', 'Login', '', 'System User'),
(3, 5, '2020-05-29 12:13:13', 'Login', '', 'System User'),
(4, 5, '2020-05-29 22:48:04', 'Login', '', 'System User'),
(5, 5, '2020-06-02 01:03:39', 'Login', '', 'System User'),
(6, 5, '2020-06-02 10:19:05', 'Login', '', 'System User'),
(7, 5, '2020-06-02 10:20:04', 'Delete', 'Agent Name : TEST AGENT Location : LUSAKA Phone Number : +255762988043', 'Agent Detail'),
(8, 5, '2020-06-02 10:20:09', 'Delete', 'Agent Name : BLANTYRE CITY COUNCIL Location : Blantyre Phone Number : +255765496378', 'Agent Detail'),
(9, 5, '2020-06-02 10:20:13', 'Delete', 'Agent Name : MALSWITCH LTD Location : Blantyre Phone Number : +255765496378', 'Agent Detail'),
(10, 5, '2020-06-02 10:20:18', 'Delete', 'Agent Name : R MANDA Location : NENO Phone Number : 0999000000', 'Agent Detail'),
(11, 5, '2020-06-02 10:20:22', 'Delete', 'Agent Name : Ronald Gwaza Location : Neno Phone Number : 088888888', 'Agent Detail'),
(12, 5, '2020-06-02 10:24:43', 'Login', '', 'System User'),
(13, 5, '2020-06-02 10:29:28', 'Add', 'Owner Name : Filbert Eusabius TPIN Number : 232343 Phone Number : 765438924', 'Owner'),
(14, 5, '2020-06-02 10:30:36', 'Add', 'Village Name : Zomba', 'Village'),
(15, 5, '2020-06-02 10:31:45', 'Add', 'Device Name : Test-Device Device Imei Number : 99000750197941 Device Printer : 02:0F:D7:72:27:53', 'Agent Device'),
(16, 5, '2020-06-02 13:22:37', 'Login', '', 'System User'),
(17, 5, '2020-06-02 13:43:01', 'Login', '', 'System User'),
(18, 5, '2020-06-02 13:45:18', 'Edit', 'Device Name : Test-Device Device Imei Number  : 99000750197941 Device Printer : 02:0F:D7:72:27:53', 'Agent Device'),
(19, 5, '2020-06-02 13:48:25', 'Add', 'Operator Name : Filbert Eusabius User Name : test Mobile Number : 765438924 P.O Box : 1234', 'Device Operator'),
(20, 5, '2020-06-02 13:58:37', 'Add', 'Temporary Levy Source : Markert 1 GFS Code : Testing', 'Temporary Levy Type'),
(21, 5, '2020-06-02 13:59:23', 'Add', 'Temporary Levy Name : Tax Martkert A = 500 Levy Worth : 100 Transaction Code : 1Instant Payment : 4', 'Temporary Levy'),
(22, 5, '2020-06-02 15:56:34', 'Login', '', 'System User'),
(23, 5, '2020-06-02 17:45:09', 'Login', '', 'System User'),
(24, 5, '2020-06-04 23:28:12', 'Login', '', 'System User'),
(25, 5, '2020-06-05 10:49:12', 'Login', '', 'System User'),
(26, 5, '2020-06-08 13:50:28', 'Login', '', 'System User'),
(27, 5, '2020-06-08 15:50:00', 'Login', '', 'System User'),
(28, 5, '2020-06-09 19:43:43', 'Login', '', 'System User'),
(29, 5, '2020-06-24 16:49:06', 'Login', '', 'System User'),
(30, 5, '2020-07-07 12:18:11', 'Login', '', 'System User'),
(31, 5, '2020-07-14 16:43:46', 'Login', '', 'System User'),
(32, 5, '2020-07-14 17:58:58', 'Login', '', 'System User'),
(33, 5, '2020-07-14 18:37:48', 'Add', 'Levy Source Name : 00001 GFS Code : Testing', 'Permanent Levy'),
(34, 5, '2020-07-14 19:14:39', 'Edit', 'Levy Source Name : Test GFS Code : 000000', 'Permanent Levy'),
(35, 5, '2020-07-14 19:16:18', 'Add', 'Agent Name : Test Location : Test Phone Number : Test', 'Agent Detail'),
(36, 5, '2020-07-14 19:17:27', 'Delete', 'Levy Source Name : Test GFS Code : 000000', 'Permanent Levy'),
(37, 5, '2020-07-14 19:17:33', 'Delete', 'Levy Source Name : PROPERTY TAX GFS Code : 007776', 'Permanent Levy'),
(38, 5, '2020-07-14 19:17:37', 'Delete', 'Levy Source Name : LIQUOR PERMIT GFS Code : 007878', 'Permanent Levy'),
(39, 5, '2020-07-14 19:17:41', 'Delete', 'Levy Source Name : Billboard License GFS Code : 010002', 'Permanent Levy'),
(40, 5, '2020-07-14 19:27:11', 'Add', 'Owner Name : Filbert Nyakunga TPIN Number : 232 Phone Number : 0765438924', 'Owner'),
(41, 5, '2020-07-16 16:58:20', 'Login', '', 'System User'),
(42, 5, '2020-07-16 22:41:33', 'Login', '', 'System User'),
(43, 5, '2020-07-16 22:42:40', 'Add', 'Levy Source Name : Business Licence Test GFS Code : 3087', 'Permanent Levy'),
(44, 5, '2020-07-16 22:44:15', 'Delete', 'Permanent Levy Name : HOTEL TC License Fee : 1000 DC License Fee : 1000 Extra Amount : 0', 'Permanent Levy Descrption'),
(45, 5, '2020-07-16 22:52:00', 'Add', 'Levy Source Name : Business Licence Test GFS Code : 1', 'Permanent Levy'),
(46, 5, '2020-07-16 22:58:19', 'Edit', 'IT Access : 000001', 'Department and Department Access'),
(47, 5, '2020-07-16 22:58:19', 'Edit', 'IT Access : 000000', 'Department and Department Access'),
(48, 5, '2020-07-16 22:59:29', 'Add', 'License Type Name : SHOP TC License Fee :  DC License Fee : 500 Extra Amount : ', 'Permanent Levy Descrption'),
(49, 5, '2020-07-16 22:59:29', 'Add', 'License Type Name : SHOP TC License Fee :  DC License Fee : 500 Extra Amount : ', 'Permanent Levy Descrption'),
(50, 5, '2020-07-17 00:33:48', 'Login', '', 'System User'),
(51, 5, '2020-07-17 09:27:29', 'Login', '', 'System User'),
(52, 5, '2020-07-17 13:19:25', 'Login', '', 'System User'),
(53, 5, '2020-07-17 17:48:22', 'Login', '', 'System User'),
(54, 5, '2020-07-20 15:24:43', 'Login', '', 'System User'),
(55, 5, '2020-07-20 16:17:21', 'Login', '', 'System User'),
(56, 5, '2020-07-20 16:18:28', 'Login', '', 'System User'),
(57, 5, '2020-07-20 16:19:15', 'Login', '', 'System User'),
(58, 5, '2020-07-20 16:20:29', 'Login', '', 'System User'),
(59, 5, '2020-07-21 12:05:45', 'Login', '', 'System User'),
(60, 5, '2020-07-21 12:15:47', 'Add', 'Agent Name : Test Location : Test Phone Number : 0765438924', 'Agent Detail'),
(61, 5, '2020-07-21 12:16:21', 'Add', 'Temporary Levy Source : Markert 2 GFS Code : 3087', 'Temporary Levy Type'),
(62, 5, '2020-07-21 12:16:52', 'Add', 'Temporary Levy Name : Taxa do Camiao = 500 Levy Worth : 200 Transaction Code : 2Instant Payment : 4', 'Temporary Levy'),
(63, 5, '2020-07-21 12:19:07', 'Add', 'Levy Source Name : Business Licence GFS Code : 3087', 'Permanent Levy'),
(64, 5, '2020-07-21 12:19:42', 'Add', 'License Type Name : Pharmacy TC License Fee :  DC License Fee : 500 Extra Amount : ', 'Permanent Levy Descrption'),
(65, 5, '2020-07-21 12:19:42', 'Add', 'License Type Name : Pharmacy TC License Fee :  DC License Fee : 500 Extra Amount : ', 'Permanent Levy Descrption'),
(66, 5, '2020-07-21 12:28:29', 'Add', 'Agent Name : Company A Location : Lilongwe Phone Number : 0765438924', 'Agent Detail'),
(67, 5, '2020-07-21 12:32:08', 'Add', 'Device Name : Company A device Device Imei Number : 353007060375035 Device Printer : 02:0F:D7:72:27:', 'Agent Device'),
(68, 5, '2020-07-21 12:34:25', 'Add', 'Operator Name : Ally Hamis User Name : test Mobile Number : 0765-000000 P.O Box : 1233', 'Device Operator'),
(69, 5, '2020-07-22 12:24:34', 'Login', '', 'System User'),
(70, 5, '2020-07-22 19:31:02', 'Login', '', 'System User'),
(71, 5, '2020-07-23 16:56:28', 'Login', '', 'System User'),
(72, 5, '2020-07-23 17:40:34', 'Login', '', 'System User'),
(73, 5, '2020-07-24 09:11:53', 'Login', '', 'System User'),
(74, 5, '2020-07-25 11:50:54', 'Login', '', 'System User'),
(75, 5, '2020-07-25 12:17:10', 'Login', '', 'System User'),
(76, 5, '2020-07-25 12:41:17', 'Receive Amount', 'Submission Amount : 500 Payment Type : Bank Reference Number : 7272727', 'Payment Records'),
(77, 5, '2020-07-25 17:29:07', 'Login', '', 'System User'),
(78, 5, '2020-07-25 17:30:03', 'Login', '', 'System User'),
(79, 5, '2020-07-27 11:13:23', 'Login', '', 'System User'),
(80, 5, '2020-07-27 11:55:01', 'Login', '', 'System User'),
(81, 5, '2020-07-27 11:55:14', 'Login', '', 'System User'),
(82, 5, '2020-07-27 11:57:38', 'Add', 'Device Name : james Device Imei Number : 352980106224576 Device Printer : AA:3D:78:AA:AA:51', 'Agent Device'),
(83, 5, '2020-07-27 11:58:38', 'Add', 'Operator Name : james User Name : james Mobile Number : 0683542710 P.O Box : 9111', 'Device Operator'),
(84, 5, '2020-07-28 12:33:21', 'Login', '', 'System User'),
(85, 5, '2020-07-28 12:35:58', 'Add', 'Temporary Levy Name : Taxa do Camiao = 500 Levy Worth : 200 Transaction Code : 3Instant Payment : 4', 'Temporary Levy'),
(86, 5, '2020-07-28 12:36:17', 'Add', 'Temporary Levy Source : Markert 3 GFS Code : 3087', 'Temporary Levy Type'),
(87, 5, '2020-07-28 14:11:29', 'Login', '', 'System User'),
(88, 5, '2020-07-30 10:22:11', 'Login', '', 'System User'),
(89, 5, '2020-07-30 10:36:02', 'Add', 'Agent Name : Jon Doe Location : BCX Collectors Phone Number : 0689361147', 'Agent Detail'),
(90, 5, '2020-07-30 10:37:01', 'Edit', 'Agent Name : BCX Collectors Location : Dar es Salaam, Tanzania Phone Number : 0689361147', 'Agent Detail'),
(91, 5, '2020-07-30 10:42:50', 'Add', 'Device Name : BCX Emulator P3a Device Imei Number : 358240051111110 Device Printer : AA:3D:78:AA:AA:', 'Agent Device'),
(92, 5, '2020-07-30 10:45:00', 'Add', 'Operator Name : Ali Suleiman User Name : ali Mobile Number : 0689361147 P.O Box : P.O Box 1', 'Device Operator'),
(93, 5, '2020-07-30 15:36:44', 'Login', '', 'System User'),
(94, 5, '2020-07-30 16:29:59', 'Login', '', 'System User'),
(95, 5, '2020-07-30 16:31:03', 'Edit', 'Device Name : james Device Imei Number  : 358240051111110 Device Printer : AA:3D:78:AA:AA:51', 'Agent Device'),
(96, 5, '2020-07-30 16:40:23', 'Edit', 'Device Name : james Device Imei Number  : 358240051111110 Device Printer : AA:3D:78:AA:AA:51', 'Agent Device'),
(97, 5, '2020-07-30 16:50:34', 'Edit', 'Device Name : james Device Imei Number  : 352980106224576 Device Printer : AA:3D:78:AA:AA:51', 'Agent Device'),
(98, 5, '2020-07-30 17:13:55', 'Login', '', 'System User'),
(99, 5, '2020-07-30 17:14:18', 'Login', '', 'System User'),
(100, 5, '2020-08-03 11:52:35', 'Login', '', 'System User'),
(101, 5, '2020-08-04 10:45:03', 'Login', '', 'System User'),
(102, 5, '2020-08-04 10:52:25', 'Login', '', 'System User'),
(103, 5, '2020-08-04 11:35:40', 'Login', '', 'System User'),
(104, 5, '2020-08-11 12:54:10', 'Login', '', 'System User'),
(105, 5, '2020-08-11 14:53:57', 'Login', '', 'System User'),
(106, 5, '2020-08-11 15:41:19', 'Login', '', 'System User'),
(107, 5, '2020-08-14 01:30:23', 'Login', '', 'System User'),
(108, 5, '2020-08-17 10:14:59', 'Login', '', 'System User'),
(109, 5, '2020-08-17 12:17:53', 'Login', '', 'System User'),
(110, 5, '2020-08-17 12:17:56', 'Login', '', 'System User'),
(111, 5, '2020-08-18 10:05:49', 'Login', '', 'System User'),
(112, 5, '2020-08-24 14:41:25', 'Login', '', 'System User'),
(113, 5, '2020-08-24 15:41:53', 'Login', '', 'System User'),
(114, 5, '2020-08-24 16:13:48', 'Edit', 'Levy Source Name : Business Licence GFS Code : 000001', 'Permanent Levy'),
(115, 5, '2020-08-24 16:15:29', 'Add', 'Levy Source Name : Land Licence GFS Code : 000001', 'Permanent Levy'),
(116, 5, '2020-08-24 16:37:56', 'Login', '', 'System User'),
(117, 5, '2020-08-24 16:38:01', 'Login', '', 'System User'),
(118, 5, '2020-08-24 16:43:14', 'Add', 'Levy Source Name : Land Licence GFS Code : 000005', 'Permanent Levy'),
(119, 5, '2020-08-24 16:43:30', 'Edit', 'Levy Source Name : House Licence GFS Code : 000005', 'Permanent Levy'),
(120, 5, '2020-08-31 15:39:26', 'Login', '', 'System User'),
(121, 5, '2020-08-31 15:39:30', 'Login', '', 'System User'),
(122, 5, '2020-09-01 09:40:44', 'Login', '', 'System User'),
(123, 5, '2020-09-01 11:51:03', 'Login', '', 'System User'),
(124, 5, '2020-09-01 17:22:11', 'Login', '', 'System User'),
(125, 5, '2020-09-02 12:07:07', 'Login', '', 'System User'),
(126, 5, '2020-09-02 12:09:11', 'Login', '', 'System User'),
(127, 5, '2020-09-02 12:34:09', 'Login', '', 'System User'),
(128, 5, '2020-09-02 12:34:12', 'Login', '', 'System User'),
(129, 5, '2020-09-09 11:26:58', 'Login', '', 'System User'),
(130, 5, '2020-09-10 13:54:32', 'Login', '', 'System User'),
(131, 5, '2020-09-10 14:02:35', 'Edit', 'Operator Name : jamess User Name : james Mobile Number : 0683542710 P.O Box : 9111', 'Device Operator'),
(132, 5, '2020-09-10 14:14:44', 'Edit', 'Operator Name : james User Name : James Mobile Number : 0683542710 P.O Box : 9111', 'Device Operator'),
(133, 5, '2020-09-10 14:15:12', 'Edit', 'Operator Name : james User Name : Jamess Mobile Number : 0683542710 P.O Box : 9111', 'Device Operator'),
(134, 5, '2020-09-10 14:34:02', 'Login', '', 'System User'),
(135, 5, '2020-09-10 15:19:59', 'Login', '', 'System User'),
(136, 5, '2020-09-10 17:27:06', 'Login', '', 'System User'),
(137, 5, '2020-09-10 17:28:28', 'Login', '', 'System User'),
(138, 5, '2020-09-10 17:29:30', 'Update Finacial Year', 'From Date : 2020-06-01 To Date : 2020-09-30', 'Financial Year'),
(139, 5, '2020-09-10 17:31:20', 'Update Finacial Year', 'From Date : 2020-06-01 To Date : 2021-06-30', 'Financial Year'),
(140, 5, '2020-09-11 19:14:46', 'Login', '', 'System User'),
(141, 5, '2020-09-11 19:50:47', 'Login', '', 'System User'),
(142, 5, '2020-09-14 18:44:38', 'Login', '', 'System User'),
(143, 5, '2020-09-15 10:57:11', 'Login', '', 'System User'),
(144, 5, '2020-09-15 13:48:15', 'Login', '', 'System User'),
(145, 5, '2020-09-15 14:32:32', 'Login', '', 'System User'),
(146, 5, '2020-09-15 14:32:35', 'Login', '', 'System User'),
(147, 5, '2020-09-15 16:34:21', 'Login', '', 'System User'),
(148, 5, '2020-09-16 10:29:41', 'Login', '', 'System User'),
(149, 5, '2020-09-16 11:10:38', 'Login', '', 'System User'),
(150, 5, '2020-09-16 11:11:33', 'Edit', 'Device Name : Test-Device Device Imei Number  : 869715030510856 Device Printer : 02:0F:D7:72:27:53', 'Agent Device'),
(151, 5, '2020-09-16 11:12:57', 'Edit', 'Device Name : Test-Device Device Imei Number  : 866995032276523 Device Printer : 02:0F:D7:72:27:53', 'Agent Device'),
(152, 5, '2020-09-16 11:16:57', 'Receive Amount', 'Submission Amount : 500 Payment Type : Cash Reference Number : 7272727', 'Payment Records'),
(153, 5, '2020-09-16 12:12:53', 'Login', '', 'System User'),
(154, 5, '2020-09-16 12:13:57', 'Edit', 'Device Name : Test-Device Device Imei Number  : 866995032276523 Device Printer : 66:22:65:1E:E8:50', 'Agent Device'),
(155, 5, '2020-09-16 12:34:41', 'Login', '', 'System User'),
(156, 5, '2020-09-16 12:46:51', 'Edit', 'Device Name : james Device Imei Number  : 352980106224576 Device Printer :  66:22:65:1E:E8:50', 'Agent Device'),
(157, 5, '2020-09-17 16:02:57', 'Login', '', 'System User'),
(158, 5, '2020-09-17 16:45:48', 'Login', '', 'System User'),
(159, 5, '2020-09-18 12:44:44', 'Login', '', 'System User'),
(160, 5, '2020-09-22 09:45:28', 'Login', '', 'System User'),
(161, 5, '2020-09-22 09:53:08', 'Edit', 'Device Name : Test-Device Device Imei Number  : 866995032276523 Device Printer : 02:0F:D7:72:27:53', 'Agent Device'),
(162, 5, '2020-09-22 09:58:53', 'Delete', 'Agent Name : BCX (T) LTD Location : MALSWITCH LTD Phone Number : 0784168160', 'Agent Detail'),
(163, 5, '2020-09-22 12:26:08', 'Login', '', 'System User'),
(164, 5, '2020-09-22 16:30:40', 'Login', '', 'System User'),
(165, 5, '2020-09-22 17:21:42', 'Receive Amount', 'Amount Deposit : 500 Payment Type : Cash Reference Number : erttgghh876543', 'Approval Payment'),
(166, 5, '2020-09-23 11:49:48', 'Login', '', 'System User'),
(167, 5, '2020-09-23 12:27:09', 'Login', '', 'System User'),
(168, 5, '2020-09-23 12:27:12', 'Login', '', 'System User'),
(169, 5, '2020-09-23 12:51:41', 'Login', '', 'System User'),
(170, 5, '2020-09-23 12:51:45', 'Login', '', 'System User'),
(171, 5, '2020-09-23 13:35:20', 'Login', '', 'System User'),
(172, 5, '2020-09-24 11:00:55', 'Login', '', 'System User'),
(173, 5, '2020-09-28 11:15:39', 'Login', '', 'System User'),
(174, 5, '2020-09-30 18:39:16', 'Login', '', 'System User'),
(175, 5, '2020-10-01 10:48:59', 'Login', '', 'System User'),
(176, 5, '2020-10-07 15:11:12', 'Login', '', 'System User'),
(177, 5, '2020-10-07 15:42:30', 'Login', '', 'System User'),
(178, 5, '2020-10-07 16:47:56', 'Login', '', 'System User'),
(179, 5, '2020-10-07 17:57:47', 'Login', '', 'System User'),
(180, 5, '2020-10-07 18:35:32', 'Login', '', 'System User'),
(181, 5, '2020-10-07 18:35:35', 'Login', '', 'System User'),
(182, 5, '2020-10-07 19:31:38', 'Login', '', 'System User'),
(183, 5, '2020-10-08 19:07:06', 'Login', '', 'System User'),
(184, 5, '2020-10-08 20:24:56', 'Login', '', 'System User'),
(185, 5, '2020-10-08 21:55:44', 'Login', '', 'System User'),
(186, 5, '2020-10-09 11:49:44', 'Login', '', 'System User'),
(187, 5, '2020-10-09 14:45:42', 'Login', '', 'System User'),
(188, 5, '2020-10-09 16:13:42', 'Login', '', 'System User'),
(189, 5, '2020-10-09 17:17:39', 'Login', '', 'System User'),
(190, 5, '2020-10-09 17:17:42', 'Login', '', 'System User'),
(191, 5, '2020-10-09 17:59:51', 'Login', '', 'System User'),
(192, 5, '2020-10-11 21:43:59', 'Login', '', 'System User'),
(193, 5, '2020-10-11 23:36:18', 'Login', '', 'System User'),
(194, 5, '2020-10-12 10:25:18', 'Login', '', 'System User'),
(195, 5, '2020-10-12 15:11:06', 'Login', '', 'System User'),
(196, 5, '2020-10-13 11:53:40', 'Login', '', 'System User'),
(197, 5, '2020-10-16 15:36:58', 'Login', '', 'System User'),
(198, 5, '2020-10-18 14:12:15', 'Login', '', 'System User'),
(199, 5, '2020-10-19 02:57:48', 'Login', '', 'System User'),
(200, 5, '2020-10-19 14:26:54', 'Login', '', 'System User'),
(201, 5, '2020-10-20 12:16:09', 'Login', '', 'System User'),
(202, 5, '2020-10-21 21:49:16', 'Login', '', 'System User'),
(203, 5, '2020-10-22 11:32:19', 'Login', '', 'System User'),
(204, 5, '2020-10-22 16:18:42', 'Login', '', 'System User'),
(205, 5, '2020-10-22 16:57:29', 'Login', '', 'System User'),
(206, 5, '2020-10-22 16:57:36', 'Login', '', 'System User'),
(207, 5, '2020-10-22 17:04:33', 'Login', '', 'System User'),
(208, 5, '2020-10-22 17:17:31', 'Login', '', 'System User'),
(209, 5, '2020-10-22 17:59:02', 'Login', '', 'System User'),
(210, 5, '2020-10-22 17:59:08', 'Login', '', 'System User'),
(211, 5, '2020-10-26 11:30:06', 'Login', '', 'System User'),
(212, 5, '2020-10-26 14:19:39', 'Login', '', 'System User'),
(213, 5, '2020-10-26 14:59:15', 'Login', '', 'System User'),
(214, 5, '2020-10-26 14:59:18', 'Login', '', 'System User'),
(215, 5, '2020-10-26 15:59:14', 'Login', '', 'System User'),
(216, 5, '2020-10-26 15:59:18', 'Login', '', 'System User'),
(217, 5, '2020-10-26 16:17:28', 'Login', '', 'System User'),
(218, 5, '2020-10-27 11:01:07', 'Login', '', 'System User'),
(219, 5, '2020-10-27 11:11:50', 'Login', '', 'System User'),
(220, 5, '2020-10-27 11:41:19', 'Login', '', 'System User'),
(221, 5, '2020-10-27 12:18:16', 'Login', '', 'System User'),
(222, 5, '2020-10-27 12:18:19', 'Login', '', 'System User'),
(223, 5, '2020-10-27 17:30:29', 'Login', '', 'System User'),
(224, 5, '2020-10-27 18:03:50', 'Login', '', 'System User'),
(225, 5, '2020-10-30 08:58:03', 'Login', '', 'System User'),
(226, 5, '2020-10-30 12:27:06', 'Login', '', 'System User'),
(227, 5, '2020-11-01 13:10:19', 'Login', '', 'System User'),
(228, 5, '2020-11-02 12:02:26', 'Login', '', 'System User'),
(229, 5, '2020-11-02 14:41:04', 'Login', '', 'System User'),
(230, 5, '2020-11-02 16:51:45', 'Login', '', 'System User'),
(231, 5, '2020-11-03 10:03:23', 'Login', '', 'System User'),
(232, 5, '2020-11-03 14:04:58', 'Login', '', 'System User'),
(233, 5, '2020-11-03 14:05:02', 'Login', '', 'System User'),
(234, 5, '2020-11-03 17:49:57', 'Login', '', 'System User'),
(235, 5, '2020-11-04 09:42:57', 'Login', '', 'System User'),
(236, 5, '2020-11-04 10:29:04', 'Login', '', 'System User'),
(237, 5, '2020-11-04 10:41:04', 'Login', '', 'System User'),
(238, 5, '2020-11-04 11:58:26', 'Login', '', 'System User'),
(239, 5, '2020-11-04 12:39:46', 'Login', '', 'System User'),
(240, 5, '2020-11-04 14:01:07', 'Login', '', 'System User'),
(241, 5, '2020-11-04 14:52:02', 'Login', '', 'System User'),
(242, 5, '2020-11-04 16:00:33', 'Login', '', 'System User'),
(243, 5, '2020-11-04 17:54:53', 'Login', '', 'System User'),
(244, 5, '2020-11-04 18:25:26', 'Login', '', 'System User'),
(245, 5, '2020-11-04 18:25:27', 'Login', '', 'System User'),
(246, 5, '2020-11-04 20:54:19', 'Login', '', 'System User'),
(247, 5, '2020-11-05 08:55:38', 'Login', '', 'System User'),
(248, 5, '2020-11-05 10:14:16', 'Login', '', 'System User'),
(249, 5, '2020-11-05 15:29:28', 'Login', '', 'System User'),
(250, 5, '2020-11-11 10:48:45', 'Login', '', 'System User'),
(251, 5, '2020-11-11 11:20:38', 'Login', '', 'System User'),
(252, 5, '2020-11-11 11:22:30', 'Edit', 'Owner Name : ANDREW K MTONGA TPIN Number : 232 Phone Number : 0765438924', 'Owner'),
(253, 5, '2020-11-11 11:23:01', 'Edit', 'Owner Name : ANDREW K MTONGA TPIN Number : 232343 Phone Number : 765438924', 'Owner'),
(254, 5, '2020-11-11 12:38:31', 'Login', '', 'System User'),
(255, 5, '2020-11-11 12:38:44', 'Login', '', 'System User'),
(256, 5, '2020-11-11 15:13:57', 'Login', '', 'System User'),
(257, 5, '2020-11-11 17:08:16', 'Login', '', 'System User'),
(258, 5, '2020-11-13 12:44:13', 'Login', '', 'System User'),
(259, 5, '2020-11-13 13:04:49', 'Login', '', 'System User'),
(260, 5, '2020-11-13 15:08:52', 'Login', '', 'System User'),
(261, 5, '2020-11-16 09:14:32', 'Login', '', 'System User'),
(262, 5, '2020-11-16 09:18:36', 'Login', '', 'System User'),
(263, 5, '2020-11-16 12:20:50', 'Login', '', 'System User'),
(264, 5, '2020-11-17 12:50:19', 'Login', '', 'System User'),
(265, 5, '2020-11-17 17:10:28', 'Login', '', 'System User'),
(266, 5, '2020-11-17 17:29:50', 'Add', 'Owner Name : testing TPIN Number : 232 Phone Number : 067876866', 'Owner'),
(267, 5, '2020-11-17 17:30:18', 'Delete', 'Owner Name : testing TPIN Number : 232 Phone Number : 067876866', 'Owner'),
(268, 5, '2020-11-17 17:53:29', 'Login', '', 'System User'),
(269, 5, '2020-11-17 17:58:15', 'Login', '', 'System User'),
(270, 5, '2020-11-17 18:08:22', 'Receive Amount', 'Submission Amount : 500 Payment Type : Bank Reference Number : o8ea', 'Payment Records'),
(271, 5, '2020-11-17 20:12:57', 'Login', '', 'System User'),
(272, 5, '2020-11-17 20:13:30', 'Login', '', 'System User'),
(273, 5, '2020-11-17 21:08:13', 'Login', '', 'System User'),
(274, 5, '2020-11-18 00:34:12', 'Login', '', 'System User'),
(275, 5, '2020-11-18 01:09:21', 'Login', '', 'System User'),
(276, 5, '2020-11-18 01:10:25', 'Delete', 'Owner Name : ANDREW K MTONGA TPIN Number : 232 Phone Number : 0765438924', 'Owner'),
(277, 5, '2020-11-18 13:26:02', 'Login', '', 'System User'),
(278, 5, '2020-11-18 20:17:53', 'Login', '', 'System User'),
(279, 5, '2020-11-18 20:18:17', 'Login', '', 'System User'),
(280, 5, '2020-11-18 23:18:18', 'Login', '', 'System User'),
(281, 5, '2020-11-18 23:18:22', 'Login', '', 'System User'),
(282, 5, '2020-11-19 00:23:00', 'Login', '', 'System User'),
(283, 5, '2020-11-19 11:56:38', 'Login', '', 'System User'),
(284, 5, '2020-11-20 17:39:48', 'Login', '', 'System User'),
(285, 5, '2020-11-22 21:07:08', 'Login', '', 'System User'),
(286, 5, '2020-11-22 21:08:39', 'Edit', 'Device Name : james Device Imei Number  : 358240051111110 Device Printer :  66:22:65:1E:E8:50', 'Agent Device'),
(287, 5, '2020-11-22 21:10:06', 'Edit', 'Device Name : james Device Imei Number  : 358240051111110 Device Printer :  66:22:65:1E:E8:50', 'Agent Device'),
(288, 5, '2020-11-23 11:55:32', 'Login', '', 'System User'),
(289, 5, '2020-11-23 11:56:25', 'Edit', 'Device Name : james Device Imei Number  : 352980106224576 Device Printer :  66:22:65:1E:E8:50', 'Agent Device'),
(290, 5, '2020-11-23 12:02:39', 'Edit', 'Operator Name : james User Name : James Mobile Number : 0683542710 P.O Box : 9111', 'Device Operator'),
(291, 5, '2020-11-23 12:11:10', 'Login', '', 'System User'),
(292, 5, '2020-11-23 12:12:54', 'Edit', 'Device Name : james Device Imei Number  : 353007060375035 Device Printer :  66:22:65:1E:E8:50', 'Agent Device'),
(293, 5, '2020-11-23 12:38:55', 'Edit', 'Device Name : Company A device Device Imei Number  : 353007060375035x Device Printer : 02:0F:D7:72:2', 'Agent Device'),
(294, 5, '2020-11-23 14:19:32', 'Login', '', 'System User'),
(295, 5, '2020-11-23 14:20:37', 'Edit', 'Device Name : james Device Imei Number  : 353007060375035 Device Printer : 353007060375035', 'Agent Device'),
(296, 5, '2020-11-24 11:11:22', 'Login', '', 'System User'),
(297, 5, '2020-11-24 11:12:42', 'Edit', 'Device Name : james Device Imei Number  : 352980106224576 Device Printer : AA:3D:78:AA:AA:51', 'Agent Device'),
(298, 5, '2020-11-24 11:39:45', 'Edit', 'Device Name : james Device Imei Number  : 352980106224576 Device Printer : AA:3D:78:AA:AA:96', 'Agent Device'),
(299, 5, '2020-11-24 11:39:49', 'Login', '', 'System User'),
(300, 5, '2020-11-24 12:49:30', 'Login', '', 'System User'),
(301, 5, '2020-11-24 17:41:58', 'Login', '', 'System User'),
(302, 5, '2020-11-25 14:09:55', 'Login', '', 'System User'),
(303, 5, '2020-11-25 14:52:34', 'Login', '', 'System User'),
(304, 5, '2020-11-25 15:01:33', 'Login', '', 'System User'),
(305, 5, '2020-11-25 15:45:02', 'Login', '', 'System User'),
(306, 5, '2020-11-25 15:52:33', 'Login', '', 'System User'),
(307, 5, '2020-11-25 17:05:09', 'Login', '', 'System User'),
(308, 5, '2020-11-25 18:01:49', 'Login', '', 'System User'),
(309, 5, '2020-11-26 00:32:54', 'Login', '', 'System User'),
(310, 5, '2020-11-26 00:33:44', 'Login', '', 'System User'),
(311, 5, '2020-11-26 00:46:29', 'Login', '', 'System User'),
(312, 5, '2020-11-26 10:41:46', 'Login', '', 'System User'),
(313, 5, '2020-11-26 17:33:57', 'Login', '', 'System User'),
(314, 5, '2020-11-26 17:37:42', 'Login', '', 'System User'),
(315, 5, '2020-11-26 18:26:16', 'Login', '', 'System User'),
(316, 5, '2020-11-26 18:27:11', 'Edit', 'Device Name : james Device Imei Number  : 353007060374038 Device Printer : AA:3D:78:AA:AA:96', 'Agent Device'),
(317, 5, '2020-11-26 18:39:57', 'Receive Amount', 'Submission Amount : 500 Payment Type : Cash Reference Number : 0683542710', 'Payment Records'),
(318, 5, '2020-11-30 11:33:01', 'Login', '', 'System User'),
(319, 5, '2020-11-30 12:39:23', 'Login', '', 'System User'),
(320, 5, '2020-12-01 11:08:51', 'Login', '', 'System User'),
(321, 5, '2020-12-03 16:44:36', 'Login', '', 'System User'),
(322, 5, '2020-12-03 16:46:56', 'Login', '', 'System User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_billboard_description`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_billboard_description` (
  `descriptionID` int(11) NOT NULL,
  `descriptionName` varchar(200) NOT NULL,
  `descriptionAmount` varchar(200) NOT NULL,
  `applicationFee` varchar(200) NOT NULL,
  `descriptionLocation` int(10) NOT NULL,
  `pay_number` int(4) unsigned zerofill NOT NULL,
  `typeID` int(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_billboard_description`
--

INSERT INTO `tbl_distr_munis_portal_billboard_description` (`descriptionID`, `descriptionName`, `descriptionAmount`, `applicationFee`, `descriptionLocation`, `pay_number`, `typeID`) VALUES
(1, 'Medium Size', '1500', '0', 2, 0001, 3),
(2, 'Medium Size', '500', '0', 1, 0002, 1),
(3, 'XYZ', '500.00', '201.88', 1, 0003, 1),
(4, 'Static Billboard Small Size', '5000', '500', 1, 0004, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_billboard_registered`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_billboard_registered` (
  `registeredID` int(11) NOT NULL,
  `ownerID` int(200) NOT NULL,
  `billboardName` varchar(200) NOT NULL,
  `registeredDate` datetime NOT NULL,
  `location` int(200) NOT NULL,
  `descriptionID` int(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_billboard_registered_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_billboard_registered_payment` (
  `paymentID` int(11) NOT NULL,
  `registeredID` int(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `payStatus` int(10) NOT NULL,
  `payDate` datetime NOT NULL,
  `receipt` varchar(200) DEFAULT NULL,
  `paymentType` varchar(200) NOT NULL,
  `referenceNumber` varchar(200) NOT NULL,
  `acceptorID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_enforcement`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_enforcement` (
  `enforce_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `receipt_number` varchar(30) NOT NULL,
  `location` varchar(10) NOT NULL,
  `status_id` int(11) NOT NULL,
  `source_id` int(10) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_enforcement`
--

INSERT INTO `tbl_distr_munis_portal_enforcement` (`enforce_id`, `agent_id`, `receipt_number`, `location`, `status_id`, `source_id`, `datetime`) VALUES
(1, 3, '4515542515', '1', 3, 0, '2020-11-26 18:33:47'),
(2, 3, '5477826742', '1', 0, 9, '2020-11-26 18:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_hamlet`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_hamlet` (
  `hamlet_id` int(11) NOT NULL,
  `GC_code` varchar(20) NOT NULL,
  `hamlet_name` varchar(30) NOT NULL,
  `village_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_hamlet`
--

INSERT INTO `tbl_distr_munis_portal_hamlet` (`hamlet_id`, `GC_code`, `hamlet_name`, `village_id`) VALUES
(1, '0000', 'Zomba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_land_management`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_land_management` (
  `soldplot_id` int(11) NOT NULL,
  `plot_number` varchar(100) NOT NULL,
  `plot_size` int(11) NOT NULL,
  `plot_price` varchar(50) NOT NULL,
  `plot_total_price` varchar(100) NOT NULL,
  `plot_type` varchar(100) NOT NULL,
  `plot_use` varchar(100) NOT NULL,
  `plot_location` int(11) NOT NULL,
  `reference_number` varchar(250) NOT NULL,
  `plot_buyer` varchar(50) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `date_paid` datetime NOT NULL,
  `authorizer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_licence_generation`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_licence_generation` (
  `id` int(11) NOT NULL,
  `day_time` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_distr_munis_portal_licence_generation`
--

INSERT INTO `tbl_distr_munis_portal_licence_generation` (`id`, `day_time`) VALUES
(1, '0725'),
(2, '0728'),
(3, '0916'),
(4, '1022'),
(5, '1117'),
(6, '1124'),
(7, '1126'),
(8, '1126');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_permanent_approval_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_permanent_approval_payment` (
  `approval_ID` int(11) NOT NULL,
  `amount` int(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_reference` varchar(100) NOT NULL,
  `operator_id` int(10) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `datetime_receive` datetime NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_permanent_approval_payment`
--

INSERT INTO `tbl_distr_munis_portal_permanent_approval_payment` (`approval_ID`, `amount`, `payment_type`, `payment_reference`, `operator_id`, `receipt_number`, `datetime_receive`, `user_id`) VALUES
(1, 500, 'Cash', 'erttgghh876543', 1, '0000090922', '2020-09-22 17:21:42', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_permanent_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_permanent_payment` (
  `payment_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `terminal_date` datetime NOT NULL,
  `system_date` datetime NOT NULL,
  `operator_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `online_receipt_number` varchar(30) DEFAULT NULL,
  `offline_receipt_number` varchar(30) DEFAULT NULL,
  `payment_code` varchar(10) NOT NULL,
  `field_7` varchar(20) NOT NULL,
  `field_11` varchar(20) NOT NULL,
  `customer_no` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_permanent_payment`
--

INSERT INTO `tbl_distr_munis_portal_permanent_payment` (`payment_id`, `amount`, `terminal_date`, `system_date`, `operator_id`, `user_id`, `entity_id`, `quantity`, `status`, `online_receipt_number`, `offline_receipt_number`, `payment_code`, `field_7`, `field_11`, `customer_no`) VALUES
(1, '500', '2020-07-16 10:08:02', '2020-07-16 23:08:34', 1, 0, 0, 1, '05', '160720-0021', NULL, '', '200716100802', '2007', '1001'),
(2, '500', '2020-07-16 10:08:30', '2020-07-16 23:09:01', 1, 0, 0, 1, '05', '160720-0022', NULL, '', '200716100830', '2007', '0001'),
(3, '500', '2020-07-16 10:09:34', '2020-07-16 23:10:05', 1, 0, 0, 1, '05', '160720-0023', NULL, '', '200716100934', '2007', '123456'),
(4, '500', '2020-07-16 10:10:03', '2020-07-16 23:10:34', 1, 0, 0, 1, '05', '160720-0024', NULL, '', '200716101003', '2007', '232343'),
(5, '500', '2020-07-16 10:10:32', '2020-07-16 23:11:04', 1, 0, 0, 1, '05', '160720-0025', NULL, '', '200716101032', '2007', '232'),
(6, '500', '2020-07-16 10:11:39', '2020-07-16 23:12:10', 1, 0, 1, 1, '00', '160720-0026', NULL, '', '200716101139', '2007', '1739030506'),
(7, '500', '2020-11-23 12:01:57', '2020-11-23 12:03:48', 3, 0, 8, 1, '00', '231120-0042', NULL, '', '201123120157', '2011', '4515542515'),
(8, '500', '2020-11-24 11:42:56', '2020-11-24 11:44:48', 3, 0, 8, 1, '26', '241120-0045', NULL, '', '201124114256', '2011', '4515542515'),
(9, '500', '2020-11-26 06:43:14', '2020-11-26 18:45:07', 3, 0, 9, 1, '26', '261120-0050', NULL, '', '201126064314', '2011', '5477826742'),
(10, '500', '2020-11-26 06:48:03', '2020-11-26 18:49:57', 3, 0, 10, 1, '00', '261120-0051', NULL, '', '201126064803', '2011', '3943262140'),
(11, '500', '2020-11-26 06:55:26', '2020-11-26 18:57:19', 3, 0, 8, 1, '00', '261120-0052', NULL, '', '201126065526', '2011', '4515542515'),
(12, '500', '2020-11-26 06:55:37', '2020-11-26 18:57:30', 3, 0, 8, 1, '26', '261120-0053', NULL, '', '201126065537', '2011', '4515542515'),
(13, '500', '2020-11-26 07:01:53', '2020-11-26 19:03:45', 3, 0, 11, 1, '00', '261120-0054', NULL, '', '201126070153', '2011', '3823447664'),
(14, '500', '2020-11-26 07:05:54', '2020-11-26 19:07:47', 3, 0, 8, 1, '00', '261120-0055', NULL, '', '201126070554', '2011', '4515542515'),
(15, '500', '2020-11-26 07:10:22', '2020-11-26 19:12:14', 3, 0, 8, 1, '00', '261120-0056', NULL, '', '201126071022', '2011', '4515542515'),
(16, '500', '2020-11-26 07:12:55', '2020-11-26 19:14:49', 3, 0, 8, 1, '00', '261120-0057', NULL, '', '201126071255', '2011', '4515542515'),
(17, '500', '2020-11-26 07:22:42', '2020-11-26 19:24:34', 3, 0, 8, 1, '00', '261120-0058', NULL, '', '201126072242', '2011', '4515542515');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_receipt_generation`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_receipt_generation` (
  `receipt-ID` int(10) NOT NULL,
  `day_time` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_receipt_generation`
--

INSERT INTO `tbl_distr_munis_portal_receipt_generation` (`receipt-ID`, `day_time`) VALUES
(1, '0716'),
(2, '0721'),
(3, '0725'),
(4, '0725'),
(5, '0725'),
(6, '0728'),
(7, '0916'),
(8, '0916'),
(9, '0922'),
(10, '0923'),
(11, '1022'),
(12, '1022'),
(13, '1022'),
(14, '1022'),
(15, '1022'),
(16, '1022'),
(17, '1022'),
(18, '1117'),
(19, '1117'),
(20, '1117'),
(21, '1124'),
(22, '1126'),
(23, '1126'),
(24, '1126'),
(25, '1126'),
(26, '1126'),
(27, '1126'),
(28, '1126'),
(29, '1126');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_temporary_approval_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_temporary_approval_payment` (
  `approval_ID` int(11) NOT NULL,
  `amount` int(100) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_reference` varchar(100) NOT NULL,
  `operator_id` int(10) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `datetime_receive` datetime NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_temporary_levy_type`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_temporary_levy_type` (
  `tempo_type_id` int(11) NOT NULL,
  `tempo_type_name` varchar(50) NOT NULL,
  `gf_code` int(6) unsigned zerofill NOT NULL,
  `LGA` int(4) unsigned zerofill NOT NULL,
  `channel_type` int(2) unsigned zerofill NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_temporary_levy_type`
--

INSERT INTO `tbl_distr_munis_portal_temporary_levy_type` (`tempo_type_id`, `tempo_type_name`, `gf_code`, `LGA`, `channel_type`) VALUES
(4, 'Markert 1', 000000, 3028, 01),
(5, 'Markert 2', 003087, 3028, 01),
(6, 'Markert 3', 003087, 3028, 01);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_temporary_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_temporary_payment` (
  `payment_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `terminal_date` datetime NOT NULL,
  `system_date` datetime NOT NULL,
  `operator_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `online_receipt_number` varchar(30) DEFAULT NULL,
  `offline_receipt_number` varchar(30) DEFAULT NULL,
  `payment_code` varchar(10) NOT NULL,
  `field_7` varchar(20) NOT NULL,
  `field_11` varchar(20) NOT NULL,
  `customer_no` varchar(20) NOT NULL,
  `transaction_status` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_distr_munis_portal_temporary_payment`
--

INSERT INTO `tbl_distr_munis_portal_temporary_payment` (`payment_id`, `amount`, `terminal_date`, `system_date`, `operator_id`, `user_id`, `client_name`, `entity_id`, `quantity`, `status`, `online_receipt_number`, `offline_receipt_number`, `payment_code`, `field_7`, `field_11`, `customer_no`, `transaction_status`) VALUES
(1, '100', '2020-06-02 01:10:43', '2020-06-02 14:10:46', 1, 0, '', 1, 1, '00', '020620-0001', NULL, '', '200602011043', '2006', '', NULL),
(2, '100', '2020-06-02 02:50:18', '2020-06-02 15:50:28', 1, 0, '', 1, 1, '00', '020620-0002', NULL, '', '200602025018', '2006', '', NULL),
(3, '100', '2020-06-02 02:53:52', '2020-06-02 15:53:55', 1, 0, '', 1, 1, '00', '020620-0003', NULL, '', '200602025352', '2006', '', NULL),
(4, '100', '2020-06-02 02:54:05', '2020-06-02 15:54:09', 1, 0, '', 1, 1, '00', '020620-0004', NULL, '', '200602025405', '2006', '', NULL),
(5, '100', '2020-06-02 03:49:22', '2020-06-02 16:49:30', 1, 0, '', 1, 1, '00', '020620-0005', NULL, '', '200602034922', '2006', '', NULL),
(6, '100', '2020-06-02 03:51:13', '2020-06-02 16:51:27', 1, 0, '', 1, 1, '00', '020620-0006', NULL, '', '200602035113', '2006', '', NULL),
(7, '100', '2020-06-02 03:57:35', '2020-06-02 16:57:38', 1, 0, '', 1, 1, '00', '020620-0007', NULL, '', '200602035735', '2006', '', NULL),
(8, '100', '2020-06-02 03:59:35', '2020-06-02 16:59:38', 1, 0, '', 1, 1, '00', '020620-0008', NULL, '', '200602035935', '2006', '', NULL),
(9, '100', '2020-06-02 04:04:01', '2020-06-02 17:04:04', 1, 0, '', 1, 1, '00', '020620-0009', NULL, '', '200602040401', '2006', '', NULL),
(10, '100', '2020-06-02 04:10:10', '2020-06-02 17:10:18', 1, 0, '', 1, 1, '00', '020620-0010', NULL, '', '200602041010', '2006', '', NULL),
(11, '100', '2020-06-02 04:19:34', '2020-06-02 17:19:37', 1, 0, '', 1, 1, '00', '020620-0011', NULL, '', '200602041934', '2006', '', NULL),
(12, '100', '2020-06-02 04:29:33', '2020-06-02 17:29:36', 1, 0, '', 1, 1, '00', '020620-0012', NULL, '', '200602042933', '2006', '', NULL),
(13, '100', '2020-06-02 04:32:38', '2020-06-02 17:32:41', 1, 0, '', 1, 1, '00', '020620-0013', NULL, '', '200602043238', '2006', '', NULL),
(14, '100', '2020-06-02 04:41:17', '2020-06-02 17:41:20', 1, 0, '', 1, 1, '00', '020620-0014', NULL, '', '200602044117', '2006', '', NULL),
(15, '100', '2020-06-02 16:41:46', '2020-06-02 17:43:35', 1, 0, '', 1, 1, '00', NULL, '001001020620', '', '200602164146', '2006', '', NULL),
(16, '100', '2020-06-02 16:42:46', '2020-06-02 17:43:35', 1, 0, '', 1, 1, '00', NULL, '002001020620', '', '200602164246', '2006', '', NULL),
(19, '100', '2020-06-02 04:47:39', '2020-06-02 17:47:42', 1, 0, '', 1, 1, '00', '020620-0015', NULL, '', '200602044739', '2006', '', NULL),
(20, '100', '2020-06-02 04:47:48', '2020-06-02 17:47:51', 1, 0, '', 1, 1, '00', '020620-0016', NULL, '', '200602044748', '2006', '', NULL),
(21, '100', '2020-06-02 04:47:57', '2020-06-02 17:48:00', 1, 0, '', 1, 1, '00', '020620-0017', NULL, '', '200602044757', '2006', '', NULL),
(22, '100', '2020-06-02 16:48:15', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '003001020620', '', '200602164815', '2006', '', NULL),
(23, '100', '2020-06-02 16:48:25', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '004001020620', '', '200602164825', '2006', '', NULL),
(24, '100', '2020-06-02 16:48:38', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '005001020620', '', '200602164838', '2006', '', NULL),
(25, '100', '2020-06-02 16:48:48', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '006001020620', '', '200602164848', '2006', '', NULL),
(26, '100', '2020-06-02 16:49:01', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '007001020620', '', '200602164901', '2006', '', NULL),
(27, '100', '2020-06-02 16:49:12', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '008001020620', '', '200602164912', '2006', '', NULL),
(28, '100', '2020-06-02 16:49:23', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '009001020620', '', '200602164923', '2006', '', NULL),
(29, '100', '2020-06-02 16:49:34', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '010001020620', '', '200602164934', '2006', '', NULL),
(30, '100', '2020-06-02 16:49:43', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '011001020620', '', '200602164943', '2006', '', NULL),
(31, '100', '2020-06-02 16:49:53', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '012001020620', '', '200602164953', '2006', '', NULL),
(32, '100', '2020-06-02 16:50:02', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '013001020620', '', '200602165002', '2006', '', NULL),
(33, '100', '2020-06-02 16:50:11', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '014001020620', '', '200602165011', '2006', '', NULL),
(34, '100', '2020-06-02 16:50:20', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '015001020620', '', '200602165020', '2006', '', NULL),
(35, '100', '2020-06-02 16:50:30', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '016001020620', '', '200602165030', '2006', '', NULL),
(36, '100', '2020-06-02 16:50:40', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '017001020620', '', '200602165040', '2006', '', NULL),
(37, '100', '2020-06-02 16:50:51', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '018001020620', '', '200602165051', '2006', '', NULL),
(38, '100', '2020-06-02 16:51:01', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '019001020620', '', '200602165101', '2006', '', NULL),
(39, '100', '2020-06-02 16:51:10', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '020001020620', '', '200602165110', '2006', '', NULL),
(40, '100', '2020-06-02 16:51:20', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '021001020620', '', '200602165120', '2006', '', NULL),
(41, '100', '2020-06-02 16:51:30', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '022001020620', '', '200602165130', '2006', '', NULL),
(42, '100', '2020-06-02 16:51:54', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '023001020620', '', '200602165154', '2006', '', NULL),
(43, '100', '2020-06-02 16:52:09', '2020-06-08 14:01:09', 1, 0, '', 1, 1, '00', NULL, '024001020620', '', '200602165209', '2006', '', NULL),
(44, '100', '2020-06-08 02:49:20', '2020-06-08 15:49:30', 1, 0, '', 1, 1, '00', '080620-0018', NULL, '', '200608024920', '2006', '', NULL),
(45, '100', '2020-06-24 03:48:36', '2020-06-24 16:49:19', 1, 0, '', 1, 1, '00', '240620-0019', NULL, '', '200624034836', '2006', '', NULL),
(46, '100', '2020-06-24 03:50:29', '2020-06-24 16:50:47', 1, 0, '', 1, 1, '00', '240620-0020', NULL, '', '200624035029', '2006', '', NULL),
(47, '100', '2020-06-24 15:51:19', '2020-07-16 23:07:24', 1, 0, '', 1, 1, '00', NULL, '001001240620', '', '200624155119', '2006', '', NULL),
(48, '100', '2020-06-24 15:51:40', '2020-07-16 23:07:24', 1, 0, '', 1, 1, '00', NULL, '002001240620', '', '200624155140', '2006', '', NULL),
(49, '100', '2020-06-24 15:51:54', '2020-07-16 23:07:24', 1, 0, '', 1, 1, '00', NULL, '003001240620', '', '200624155154', '2006', '', NULL),
(50, '100', '2020-06-24 16:03:35', '2020-07-16 23:07:24', 1, 0, '', 1, 1, '00', NULL, '004001240620', '', '200624160335', '2006', '', NULL),
(51, '100', '2020-07-21 11:11:34', '2020-07-21 12:12:08', 1, 0, '', 1, 1, '00', '210720-0027', NULL, '', '200721111134', '2007', '', NULL),
(52, '100', '2020-07-21 11:36:58', '2020-07-21 12:37:58', 1, 0, '', 1, 1, '00', '210720-0028', NULL, '', '200721113658', '2007', '', NULL),
(53, '100', '2020-07-30 05:24:45', '2020-07-30 17:25:25', 3, 0, '', 1, 1, '00', '300720-0029', NULL, '', '200730052445', '2007', 'James', NULL),
(54, '100', '2020-09-06 10:43:21', '2020-09-06 10:44:24', 3, 0, '', 1, 1, '00', '060920-0030', NULL, '', '200906104321', '2009', 'James', NULL),
(55, '100', '2020-09-16 11:12:43', '2020-09-16 11:13:51', 1, 0, '', 1, 1, '00', '160920-0031', NULL, '', '200916111243', '2009', '', NULL),
(56, '100', '2020-09-16 12:14:32', '2020-09-16 12:15:41', 1, 0, '', 1, 1, '00', '160920-0032', NULL, '', '200916121432', '2009', '', NULL),
(57, '100', '2020-09-16 12:14:49', '2020-09-16 12:15:58', 1, 0, '', 1, 1, '00', '160920-0033', NULL, '', '200916121449', '2009', '', NULL),
(58, '100', '2020-09-16 12:15:49', '2020-09-16 12:16:57', 1, 0, '', 1, 1, '00', '160920-0034', NULL, '', '200916121549', '2009', '', NULL),
(59, '100', '2020-09-16 12:19:02', '2020-09-16 12:20:11', 1, 0, '', 1, 1, '00', '160920-0035', NULL, '', '200916121902', '2009', '', NULL),
(60, '100', '2020-09-16 12:47:13', '2020-09-16 12:48:23', 3, 0, '', 1, 1, '00', '160920-0036', NULL, '', '200916124713', '2009', '', NULL),
(61, '100', '2020-09-16 12:48:22', '2020-09-16 12:49:32', 3, 0, '', 1, 1, '00', '160920-0037', NULL, '', '200916124822', '2009', '', NULL),
(62, '100', '2020-09-16 12:49:08', '2020-09-16 12:50:17', 3, 0, '', 1, 1, '00', '160920-0038', NULL, '', '200916124908', '2009', 'hhjj', NULL),
(63, '100', '2020-09-16 12:49:59', '2020-09-16 12:51:10', 3, 0, '', 1, 1, '00', '160920-0039', NULL, '', '200916124959', '2009', '', NULL),
(64, '100', '2020-09-22 09:49:46', '2020-09-22 09:50:58', 1, 0, '', 1, 1, '00', '220920-0040', NULL, '', '200922094946', '2009', '', NULL),
(65, '100', '2020-09-22 09:53:12', '2020-09-22 09:54:24', 1, 0, '', 1, 1, '00', '220920-0041', NULL, '', '200922095312', '2009', '', NULL),
(66, '100', '2020-11-24 11:41:08', '2020-11-24 11:43:00', 3, 0, '', 1, 1, '00', '241120-0043', NULL, '', '201124114108', '2011', '', NULL),
(67, '100', '2020-11-24 11:41:44', '2020-11-24 11:43:35', 3, 0, '', 1, 1, '00', '241120-0044', NULL, '', '201124114144', '2011', '', NULL),
(68, '100', '2020-11-24 11:44:00', '2020-11-24 11:45:52', 3, 0, '', 1, 1, '00', '241120-0046', NULL, '', '201124114400', '2011', '', NULL),
(69, '100', '2020-11-24 11:44:27', '2020-11-24 11:46:19', 3, 0, '', 1, 1, '00', '241120-0047', NULL, '', '201124114427', '2011', '', NULL),
(70, '100', '2020-11-24 11:57:34', '2020-11-24 11:59:26', 3, 0, '', 1, 1, '00', '241120-0048', NULL, '', '201124115734', '2011', '', NULL),
(71, '100', '2020-11-24 12:04:49', '2020-11-24 12:06:41', 3, 0, '', 1, 1, '00', '241120-0049', NULL, '', '201124120449', '2011', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distr_munis_portal_temporary_payment_cancelled`
--

CREATE TABLE IF NOT EXISTS `tbl_distr_munis_portal_temporary_payment_cancelled` (
  `cancelled_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scann_count`
--

CREATE TABLE IF NOT EXISTS `tbl_scann_count` (
  `ID` int(11) NOT NULL,
  `receipt_no` varchar(12) NOT NULL,
  `imei_no` varchar(20) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_scann_count`
--

INSERT INTO `tbl_scann_count` (`ID`, `receipt_no`, `imei_no`, `count`) VALUES
(1, '4515542515', '353007060374038', 1),
(2, '5477826742', '353007060374038', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_distr_minic_portal_billboard_type`
--
ALTER TABLE `tbl_distr_minic_portal_billboard_type`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `tbl_distr_minic_portal_instant_payment_permission`
--
ALTER TABLE `tbl_distr_minic_portal_instant_payment_permission`
  ADD PRIMARY KEY (`instantID`);

--
-- Indexes for table `tbl_distr_minic_portal_levy_type`
--
ALTER TABLE `tbl_distr_minic_portal_levy_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_distr_minic_portal_plot_block`
--
ALTER TABLE `tbl_distr_minic_portal_plot_block`
  ADD PRIMARY KEY (`block_ID`);

--
-- Indexes for table `tbl_distr_minic_portal_plot_use`
--
ALTER TABLE `tbl_distr_minic_portal_plot_use`
  ADD PRIMARY KEY (`plot_useID`);

--
-- Indexes for table `tbl_distr_minic_portal_status`
--
ALTER TABLE `tbl_distr_minic_portal_status`
  ADD PRIMARY KEY (`StatusId`);

--
-- Indexes for table `tbl_distr_minic_portal_transaction_source`
--
ALTER TABLE `tbl_distr_minic_portal_transaction_source`
  ADD PRIMARY KEY (`source_id`);

--
-- Indexes for table `tbl_distr_minic_portal_user`
--
ALTER TABLE `tbl_distr_minic_portal_user`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `tbl_distr_minic_portal_user_roles`
--
ALTER TABLE `tbl_distr_minic_portal_user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_distr_munic_portal_allowed_transactions`
--
ALTER TABLE `tbl_distr_munic_portal_allowed_transactions`
  ADD PRIMARY KEY (`allow_id`),
  ADD UNIQUE KEY `device_number` (`device_number`,`pay_number`),
  ADD KEY `allow_id` (`allow_id`);

--
-- Indexes for table `tbl_distr_munic_portal_area_fee`
--
ALTER TABLE `tbl_distr_munic_portal_area_fee`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_distr_munic_portal_banner_price`
--
ALTER TABLE `tbl_distr_munic_portal_banner_price`
  ADD PRIMARY KEY (`bannerID`);

--
-- Indexes for table `tbl_distr_munic_portal_banner_registered`
--
ALTER TABLE `tbl_distr_munic_portal_banner_registered`
  ADD PRIMARY KEY (`regbannerID`);

--
-- Indexes for table `tbl_distr_munic_portal_banner_training`
--
ALTER TABLE `tbl_distr_munic_portal_banner_training`
  ADD PRIMARY KEY (`trainingID`);

--
-- Indexes for table `tbl_distr_munic_portal_batch_collection`
--
ALTER TABLE `tbl_distr_munic_portal_batch_collection`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `tbl_distr_munic_portal_department`
--
ALTER TABLE `tbl_distr_munic_portal_department`
  ADD PRIMARY KEY (`department_ID`);

--
-- Indexes for table `tbl_distr_munic_portal_department_acess`
--
ALTER TABLE `tbl_distr_munic_portal_department_acess`
  ADD PRIMARY KEY (`department_acess_ID`);

--
-- Indexes for table `tbl_distr_munic_portal_device`
--
ALTER TABLE `tbl_distr_munic_portal_device`
  ADD PRIMARY KEY (`deviceID`);

--
-- Indexes for table `tbl_distr_munic_portal_division`
--
ALTER TABLE `tbl_distr_munic_portal_division`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `tbl_distr_munic_portal_financial_year`
--
ALTER TABLE `tbl_distr_munic_portal_financial_year`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_distr_munic_portal_owner`
--
ALTER TABLE `tbl_distr_munic_portal_owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD KEY `tin_number` (`tin_number`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `tbl_distr_munic_portal_past_payment_records`
--
ALTER TABLE `tbl_distr_munic_portal_past_payment_records`
  ADD PRIMARY KEY (`Past_RecordID`);

--
-- Indexes for table `tbl_distr_munic_portal_payment_records`
--
ALTER TABLE `tbl_distr_munic_portal_payment_records`
  ADD PRIMARY KEY (`payment_number`);

--
-- Indexes for table `tbl_distr_munic_portal_payment_records_cancelled`
--
ALTER TABLE `tbl_distr_munic_portal_payment_records_cancelled`
  ADD PRIMARY KEY (`cancelled_id`);

--
-- Indexes for table `tbl_distr_munic_portal_payment_type`
--
ALTER TABLE `tbl_distr_munic_portal_payment_type`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_distr_munic_portal_permanent_collection`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_collection`
  ADD PRIMARY KEY (`permanent_id`);

--
-- Indexes for table `tbl_distr_munic_portal_permanent_entity`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_entity`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `tbl_distr_munic_portal_permanent_levy`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_levy`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_distr_munic_portal_permanent_levy_descrption`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_levy_descrption`
  ADD PRIMARY KEY (`descr_id`);

--
-- Indexes for table `tbl_distr_munic_portal_system_user`
--
ALTER TABLE `tbl_distr_munic_portal_system_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_distr_munic_portal_temporary_levy`
--
ALTER TABLE `tbl_distr_munic_portal_temporary_levy`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `fk_foreign_key_name` (`tempo_type_id`);

--
-- Indexes for table `tbl_distr_munic_portal_user_permission`
--
ALTER TABLE `tbl_distr_munic_portal_user_permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `tbl_distr_munic_portal_village`
--
ALTER TABLE `tbl_distr_munic_portal_village`
  ADD PRIMARY KEY (`village_id`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `tbl_distr_munic_portal_ward`
--
ALTER TABLE `tbl_distr_munic_portal_ward`
  ADD PRIMARY KEY (`ward_id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `tbl_distr_munic_svc_daily_receipt_count`
--
ALTER TABLE `tbl_distr_munic_svc_daily_receipt_count`
  ADD PRIMARY KEY (`receipt_identifier`);

--
-- Indexes for table `tbl_distr_munis_portal_agent_detail`
--
ALTER TABLE `tbl_distr_munis_portal_agent_detail`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `tbl_distr_munis_portal_agent_devices`
--
ALTER TABLE `tbl_distr_munis_portal_agent_devices`
  ADD PRIMARY KEY (`device_number`);

--
-- Indexes for table `tbl_distr_munis_portal_agent_device_operators`
--
ALTER TABLE `tbl_distr_munis_portal_agent_device_operators`
  ADD PRIMARY KEY (`operator_id`);

--
-- Indexes for table `tbl_distr_munis_portal_approval_payment`
--
ALTER TABLE `tbl_distr_munis_portal_approval_payment`
  ADD PRIMARY KEY (`approve_id`);

--
-- Indexes for table `tbl_distr_munis_portal_audit_trial`
--
ALTER TABLE `tbl_distr_munis_portal_audit_trial`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `tbl_distr_munis_portal_billboard_description`
--
ALTER TABLE `tbl_distr_munis_portal_billboard_description`
  ADD PRIMARY KEY (`descriptionID`);

--
-- Indexes for table `tbl_distr_munis_portal_billboard_registered`
--
ALTER TABLE `tbl_distr_munis_portal_billboard_registered`
  ADD PRIMARY KEY (`registeredID`);

--
-- Indexes for table `tbl_distr_munis_portal_billboard_registered_payment`
--
ALTER TABLE `tbl_distr_munis_portal_billboard_registered_payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `tbl_distr_munis_portal_enforcement`
--
ALTER TABLE `tbl_distr_munis_portal_enforcement`
  ADD PRIMARY KEY (`enforce_id`);

--
-- Indexes for table `tbl_distr_munis_portal_hamlet`
--
ALTER TABLE `tbl_distr_munis_portal_hamlet`
  ADD PRIMARY KEY (`hamlet_id`);

--
-- Indexes for table `tbl_distr_munis_portal_land_management`
--
ALTER TABLE `tbl_distr_munis_portal_land_management`
  ADD PRIMARY KEY (`soldplot_id`);

--
-- Indexes for table `tbl_distr_munis_portal_licence_generation`
--
ALTER TABLE `tbl_distr_munis_portal_licence_generation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_distr_munis_portal_permanent_approval_payment`
--
ALTER TABLE `tbl_distr_munis_portal_permanent_approval_payment`
  ADD PRIMARY KEY (`approval_ID`);

--
-- Indexes for table `tbl_distr_munis_portal_permanent_payment`
--
ALTER TABLE `tbl_distr_munis_portal_permanent_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `operator_id` (`operator_id`,`field_7`,`field_11`);

--
-- Indexes for table `tbl_distr_munis_portal_receipt_generation`
--
ALTER TABLE `tbl_distr_munis_portal_receipt_generation`
  ADD PRIMARY KEY (`receipt-ID`);

--
-- Indexes for table `tbl_distr_munis_portal_temporary_approval_payment`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_approval_payment`
  ADD PRIMARY KEY (`approval_ID`);

--
-- Indexes for table `tbl_distr_munis_portal_temporary_levy_type`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_levy_type`
  ADD PRIMARY KEY (`tempo_type_id`);

--
-- Indexes for table `tbl_distr_munis_portal_temporary_payment`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `field_7` (`field_7`);

--
-- Indexes for table `tbl_distr_munis_portal_temporary_payment_cancelled`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_payment_cancelled`
  ADD PRIMARY KEY (`cancelled_id`);

--
-- Indexes for table `tbl_scann_count`
--
ALTER TABLE `tbl_scann_count`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_billboard_type`
--
ALTER TABLE `tbl_distr_minic_portal_billboard_type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_instant_payment_permission`
--
ALTER TABLE `tbl_distr_minic_portal_instant_payment_permission`
  MODIFY `instantID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_levy_type`
--
ALTER TABLE `tbl_distr_minic_portal_levy_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_plot_block`
--
ALTER TABLE `tbl_distr_minic_portal_plot_block`
  MODIFY `block_ID` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_plot_use`
--
ALTER TABLE `tbl_distr_minic_portal_plot_use`
  MODIFY `plot_useID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_status`
--
ALTER TABLE `tbl_distr_minic_portal_status`
  MODIFY `StatusId` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_transaction_source`
--
ALTER TABLE `tbl_distr_minic_portal_transaction_source`
  MODIFY `source_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_user`
--
ALTER TABLE `tbl_distr_minic_portal_user`
  MODIFY `UserId` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_distr_minic_portal_user_roles`
--
ALTER TABLE `tbl_distr_minic_portal_user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_allowed_transactions`
--
ALTER TABLE `tbl_distr_munic_portal_allowed_transactions`
  MODIFY `allow_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_area_fee`
--
ALTER TABLE `tbl_distr_munic_portal_area_fee`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_banner_price`
--
ALTER TABLE `tbl_distr_munic_portal_banner_price`
  MODIFY `bannerID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_banner_registered`
--
ALTER TABLE `tbl_distr_munic_portal_banner_registered`
  MODIFY `regbannerID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_banner_training`
--
ALTER TABLE `tbl_distr_munic_portal_banner_training`
  MODIFY `trainingID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_batch_collection`
--
ALTER TABLE `tbl_distr_munic_portal_batch_collection`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_department`
--
ALTER TABLE `tbl_distr_munic_portal_department`
  MODIFY `department_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_department_acess`
--
ALTER TABLE `tbl_distr_munic_portal_department_acess`
  MODIFY `department_acess_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_device`
--
ALTER TABLE `tbl_distr_munic_portal_device`
  MODIFY `deviceID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_division`
--
ALTER TABLE `tbl_distr_munic_portal_division`
  MODIFY `division_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_financial_year`
--
ALTER TABLE `tbl_distr_munic_portal_financial_year`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_owner`
--
ALTER TABLE `tbl_distr_munic_portal_owner`
  MODIFY `owner_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_past_payment_records`
--
ALTER TABLE `tbl_distr_munic_portal_past_payment_records`
  MODIFY `Past_RecordID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_payment_records`
--
ALTER TABLE `tbl_distr_munic_portal_payment_records`
  MODIFY `payment_number` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_payment_records_cancelled`
--
ALTER TABLE `tbl_distr_munic_portal_payment_records_cancelled`
  MODIFY `cancelled_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_payment_type`
--
ALTER TABLE `tbl_distr_munic_portal_payment_type`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_permanent_collection`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_collection`
  MODIFY `permanent_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_permanent_entity`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_entity`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_permanent_levy`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_levy`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_permanent_levy_descrption`
--
ALTER TABLE `tbl_distr_munic_portal_permanent_levy_descrption`
  MODIFY `descr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_system_user`
--
ALTER TABLE `tbl_distr_munic_portal_system_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_temporary_levy`
--
ALTER TABLE `tbl_distr_munic_portal_temporary_levy`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_user_permission`
--
ALTER TABLE `tbl_distr_munic_portal_user_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1656;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_village`
--
ALTER TABLE `tbl_distr_munic_portal_village`
  MODIFY `village_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_portal_ward`
--
ALTER TABLE `tbl_distr_munic_portal_ward`
  MODIFY `ward_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_munic_svc_daily_receipt_count`
--
ALTER TABLE `tbl_distr_munic_svc_daily_receipt_count`
  MODIFY `receipt_identifier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_agent_detail`
--
ALTER TABLE `tbl_distr_munis_portal_agent_detail`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_agent_devices`
--
ALTER TABLE `tbl_distr_munis_portal_agent_devices`
  MODIFY `device_number` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_agent_device_operators`
--
ALTER TABLE `tbl_distr_munis_portal_agent_device_operators`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_approval_payment`
--
ALTER TABLE `tbl_distr_munis_portal_approval_payment`
  MODIFY `approve_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_audit_trial`
--
ALTER TABLE `tbl_distr_munis_portal_audit_trial`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=323;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_billboard_description`
--
ALTER TABLE `tbl_distr_munis_portal_billboard_description`
  MODIFY `descriptionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_billboard_registered`
--
ALTER TABLE `tbl_distr_munis_portal_billboard_registered`
  MODIFY `registeredID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_billboard_registered_payment`
--
ALTER TABLE `tbl_distr_munis_portal_billboard_registered_payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_enforcement`
--
ALTER TABLE `tbl_distr_munis_portal_enforcement`
  MODIFY `enforce_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_hamlet`
--
ALTER TABLE `tbl_distr_munis_portal_hamlet`
  MODIFY `hamlet_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_land_management`
--
ALTER TABLE `tbl_distr_munis_portal_land_management`
  MODIFY `soldplot_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_licence_generation`
--
ALTER TABLE `tbl_distr_munis_portal_licence_generation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_permanent_approval_payment`
--
ALTER TABLE `tbl_distr_munis_portal_permanent_approval_payment`
  MODIFY `approval_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_permanent_payment`
--
ALTER TABLE `tbl_distr_munis_portal_permanent_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_receipt_generation`
--
ALTER TABLE `tbl_distr_munis_portal_receipt_generation`
  MODIFY `receipt-ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_temporary_approval_payment`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_approval_payment`
  MODIFY `approval_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_temporary_levy_type`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_levy_type`
  MODIFY `tempo_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_temporary_payment`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `tbl_distr_munis_portal_temporary_payment_cancelled`
--
ALTER TABLE `tbl_distr_munis_portal_temporary_payment_cancelled`
  MODIFY `cancelled_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_scann_count`
--
ALTER TABLE `tbl_scann_count`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_distr_munic_portal_temporary_levy`
--
ALTER TABLE `tbl_distr_munic_portal_temporary_levy`
  ADD CONSTRAINT `fk_foreign_key_name` FOREIGN KEY (`tempo_type_id`) REFERENCES `tbl_distr_munis_portal_temporary_levy_type` (`tempo_type_id`);

--
-- Constraints for table `tbl_distr_munic_portal_village`
--
ALTER TABLE `tbl_distr_munic_portal_village`
  ADD CONSTRAINT `ward_id` FOREIGN KEY (`ward_id`) REFERENCES `tbl_distr_munic_portal_ward` (`ward_id`);

--
-- Constraints for table `tbl_distr_munic_portal_ward`
--
ALTER TABLE `tbl_distr_munic_portal_ward`
  ADD CONSTRAINT `division_id` FOREIGN KEY (`division_id`) REFERENCES `tbl_distr_munic_portal_division` (`division_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
