-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 30, 2019 at 09:20 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commomku_schoolc`
--
CREATE DATABASE IF NOT EXISTS `commomku_schoolc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `commomku_schoolc`;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `for_table` varchar(66) NOT NULL,
  `id_table_index` int(11) NOT NULL,
  `isdefault` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address`, `for_table`, `id_table_index`, `isdefault`) VALUES
(1, 'addersss , sads ,  asdasda65', 'employees', 1, 1),
(2, ' dsfdsfdf  ds  sffffdsf ,sdf  dsf,f', 'employees', 4, 1),
(3, '', 'employees', 5, 1),
(4, 'home aways , Cards , Schools ,Gauteng', 'employees', 6, 1),
(5, 'home addresss', 'child_parents', 3, 0),
(6, 'home address,in town, city', 'child_parents', 4, 0),
(7, 'home address,in town, city', 'child_parents', 5, 0),
(8, 'undefined', 'child_parents', 6, 0),
(9, 'asdsad asdas  d', 'child_parents', 7, 0),
(10, 'asdfsf sdfew, wef ewrew, ewrew', 'general_contacts', 2, 0),
(11, 'asd ,asdasdad,asdasd9', 'general_contacts', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `age_ranges`
--

DROP TABLE IF EXISTS `age_ranges`;
CREATE TABLE IF NOT EXISTS `age_ranges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_age_in_months` int(11) NOT NULL,
  `end_age_in_months` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `age_ranges`
--

INSERT INTO `age_ranges` (`id`, `start_age_in_months`, `end_age_in_months`) VALUES
(1, 12, 60),
(2, 24, 36),
(3, 36, 48),
(4, 48, 60),
(5, 24, 36),
(6, 36, 60),
(7, 24, 48);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_sign_in` varchar(44) NOT NULL,
  `id_user_created` int(11) DEFAULT NULL,
  `date_created` varchar(44) NOT NULL,
  `time_sign_out` varchar(44) DEFAULT NULL,
  `date_sign_in` varchar(42) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `id_staff` int(11) NOT NULL DEFAULT 1,
  `isvisible` int(11) NOT NULL DEFAULT 1,
  `isdeleted` int(11) NOT NULL DEFAULT 0,
  `id_child` int(11) NOT NULL,
  `date_actual_clockout` varchar(22) DEFAULT NULL,
  `id_room` int(11) DEFAULT 0 COMMENT '0 it means its all rooms but do not implement a foreign key on this colummn as this will have design problems as rooms are not forced to this table!',
  PRIMARY KEY (`id`),
  KEY `attendance_users_id_fk` (`id_user_created`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `time_sign_in`, `id_user_created`, `date_created`, `time_sign_out`, `date_sign_in`, `notes`, `id_staff`, `isvisible`, `isdeleted`, `id_child`, `date_actual_clockout`, `id_room`) VALUES
(3, '14:01', 1, '2019-12-16 23:00:16', '23:22', '2019-12-16', '', 1, 1, 0, 0, '2019-12-16 23:01:33', 0),
(4, '08:02', 1, '2019-12-16 23:05:35', '13:04', '2019-12-16', '', 6, 1, 0, 0, '2019-12-29 17:42:14', 0),
(7, '09:25', 1, '2019-12-18 07:56:50', '14:22', '2019-12-18', '', 0, 1, 0, 1, '2019-12-18 09:38:31', 2),
(8, '08:24', 1, '2019-12-18 07:56:50', '15:12', '2019-12-18', '', 0, 1, 0, 3, '2019-12-29 17:14:29', 2),
(9, '05:44', 1, '2019-12-18 08:24:31', '--', '2019-12-18', '', 0, 1, 0, 4, '--', 2);

-- --------------------------------------------------------

--
-- Table structure for table `calender`
--

DROP TABLE IF EXISTS `calender`;
CREATE TABLE IF NOT EXISTS `calender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text DEFAULT NULL,
  `isclass_related` int(11) NOT NULL DEFAULT 1,
  `start_` varchar(22) DEFAULT NULL,
  `end_` varchar(22) DEFAULT NULL,
  `id_user_saved` int(11) NOT NULL,
  `date_created` varchar(22) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calender_users_id_fk` (`id_user_saved`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

DROP TABLE IF EXISTS `children`;
CREATE TABLE IF NOT EXISTS `children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) NOT NULL,
  `surname` varchar(222) NOT NULL,
  `sex` varchar(9) NOT NULL,
  `date_of_birth` varchar(22) NOT NULL,
  `notes` text DEFAULT NULL,
  `isvisible` int(11) NOT NULL DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `name`, `surname`, `sex`, `date_of_birth`, `notes`, `isvisible`, `isdeleted`) VALUES
(1, 'John', 'Taps', 'male', '2015-05-07', 'ertr', 1, 0),
(3, 'Sean', 'Sames', 'male', '2011-02-04', '', 1, 0),
(4, 'Siphiwe', 'Sate', 'female', '2014-08-09', '', 1, 0),
(5, 'OFC', 'Set', 'male', '2010-02-10', 'this babey is crezy', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `children_attendance_register`
--

DROP TABLE IF EXISTS `children_attendance_register`;
CREATE TABLE IF NOT EXISTS `children_attendance_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_` varchar(22) NOT NULL,
  `time_` varchar(22) NOT NULL,
  `id_child` int(11) NOT NULL,
  `id_parent_brought` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `children_classes`
--

DROP TABLE IF EXISTS `children_classes`;
CREATE TABLE IF NOT EXISTS `children_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lesson` int(11) NOT NULL,
  `date_on_date` varchar(66) DEFAULT NULL,
  `id_user_saved_by` int(11) NOT NULL,
  `rooms_ids` varchar(22) DEFAULT NULL,
  `isvisible` int(11) DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  `date_created` varchar(55) NOT NULL,
  `day` varchar(22) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `children_classes_users_id_fk` (`id_user_saved_by`),
  KEY `children_classes_lessons_id_fk` (`id_lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `children_classes`
--

INSERT INTO `children_classes` (`id`, `id_lesson`, `date_on_date`, `id_user_saved_by`, `rooms_ids`, `isvisible`, `isdeleted`, `date_created`, `day`) VALUES
(8, 1, '2019-12-10', 1, '', 1, 0, '2019-12-19 16:46:41', 'Monday'),
(9, 3, '2019-12-10', 1, '', 1, 0, '2019-12-19 16:46:41', 'Tuesday'),
(10, 2, '2019-12-10', 1, '', 1, 0, '2019-12-19 18:40:25', 'Tuesday'),
(11, 3, '2019-12-10', 1, '', 1, 0, '2019-12-19 18:40:25', 'Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `children_health_details`
--

DROP TABLE IF EXISTS `children_health_details`;
CREATE TABLE IF NOT EXISTS `children_health_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_child` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `child_assessment`
--

DROP TABLE IF EXISTS `child_assessment`;
CREATE TABLE IF NOT EXISTS `child_assessment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_assessment_marker` int(11) NOT NULL,
  `id_child` int(11) NOT NULL,
  `id_user_created` int(11) NOT NULL,
  `date_created` varchar(22) DEFAULT NULL,
  `id_milestone_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `child_assessment_child_assessment_markers_id_fk` (`id_assessment_marker`),
  KEY `child_assessment_children_id_fk` (`id_child`),
  KEY `child_assessment_users_id_fk` (`id_user_created`),
  KEY `child_assessment_milestone_category_id_fk` (`id_milestone_category`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_assessment`
--

INSERT INTO `child_assessment` (`id`, `id_assessment_marker`, `id_child`, `id_user_created`, `date_created`, `id_milestone_category`) VALUES
(3, 1, 1, 1, '2019-12-22', 1),
(4, 1, 3, 1, '2019-12-22', 2),
(5, 3, 1, 1, '2019-12-22', 4),
(6, 3, 5, 1, '2019-12-23 16:53:43', 1),
(7, 5, 5, 1, '2019-12-23 16:53:43', 2);

-- --------------------------------------------------------

--
-- Table structure for table `child_assessment_markers`
--

DROP TABLE IF EXISTS `child_assessment_markers`;
CREATE TABLE IF NOT EXISTS `child_assessment_markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_assessment_markers`
--

INSERT INTO `child_assessment_markers` (`id`, `title`) VALUES
(1, 'Developing'),
(2, 'Advanced'),
(3, 'Proficient'),
(4, 'Limited'),
(5, 'Not Observed');

-- --------------------------------------------------------

--
-- Table structure for table `child_health_records`
--

DROP TABLE IF EXISTS `child_health_records`;
CREATE TABLE IF NOT EXISTS `child_health_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notes` text DEFAULT NULL,
  `id_child` int(11) DEFAULT NULL,
  `date_created` varchar(33) DEFAULT NULL,
  `id_user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `child_parents`
--

DROP TABLE IF EXISTS `child_parents`;
CREATE TABLE IF NOT EXISTS `child_parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) NOT NULL,
  `surname` varchar(222) NOT NULL,
  `id_number` varchar(87) DEFAULT NULL,
  `sex` varchar(9) DEFAULT NULL,
  `date_created` varchar(22) DEFAULT NULL,
  `isvisible` int(11) DEFAULT 1,
  `email` varchar(33) DEFAULT NULL,
  `id_user_created` int(11) NOT NULL,
  `isparent` int(11) DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  `occupation` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `child_parents_users_id_fk` (`id_user_created`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_parents`
--

INSERT INTO `child_parents` (`id`, `name`, `surname`, `id_number`, `sex`, `date_created`, `isvisible`, `email`, `id_user_created`, `isparent`, `isdeleted`, `occupation`) VALUES
(1, 'Luke', 'Taps', 'QWE4567', 'female', '2019-12-12 16:35:59', 1, 'ertrt@gmai.com', 1, 1, 0, 'erttt'),
(3, 'John', 'Sames', '68887899', 'female', '2019-12-12 17:07:20', 1, 'Kaji@mail.com', 1, 1, 0, 'Artist'),
(4, 'Jamey', 'Sate', '342233323', 'male', '2019-12-14 02:13:49', 1, 'bvdjhgfj@esd.ksl', 1, 1, 0, 'worker'),
(5, 'Mary', 'Sate', '342235453323', 'female', '2019-12-14 02:13:49', 1, '7yugfj@esd.ksl', 1, 1, 0, 'worker'),
(6, 'Offsett', 'Migos', 'undefined', 'male', '2019-12-14 06:09:23', 1, '32@dsd.coc', 1, 1, 0, 'undefined'),
(7, 'Cardi ', 'B', '6578', 'female', '2019-12-14 06:09:24', 1, 'ema@sd.sda', 1, 1, 0, 'Rapper');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

DROP TABLE IF EXISTS `company_details`;
CREATE TABLE IF NOT EXISTS `company_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(212) NOT NULL,
  `address` text DEFAULT NULL,
  `contacts` varchar(212) DEFAULT NULL,
  `logo` varchar(212) DEFAULT NULL,
  `email` varchar(212) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `title`, `address`, `contacts`, `logo`, `email`) VALUES
(1, 'SchoolCare', 'asdfsf sdfew, wef ewrew, ewrew', '3243423242', '../../../storage/files/schoolcare/company/files/Screenshot_from_2019_11_25_13_12_47.png', 'as3d@gms.com');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_number` varchar(44) NOT NULL,
  `for_table` varchar(66) NOT NULL,
  `id_table_index` int(11) NOT NULL,
  `isdefault` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_number`, `for_table`, `id_table_index`, `isdefault`) VALUES
(1, '2736455', 'employees', 1, 1),
(2, '34342432', 'employees', 4, 1),
(3, '4354', 'employees', 5, 1),
(4, '+27604252809', 'employees', 6, 1),
(7, '632581155', 'child_parents', 3, 0),
(8, '(+27)52-515-5555', 'child_parents', 4, 0),
(9, '(+27)52-515-7555', 'child_parents', 5, 0),
(10, 'undefined', 'child_parents', 6, 0),
(11, '(+27)54-654-6554', 'child_parents', 7, 0),
(13, '32343243434', 'general_contacts', 2, 0),
(14, '212312312', 'general_contacts', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) NOT NULL,
  `surname` varchar(222) NOT NULL,
  `date_of_birth` varchar(44) DEFAULT NULL,
  `id_number` varchar(55) DEFAULT NULL,
  `id_user_saved` int(11) NOT NULL,
  `date_created` varchar(22) NOT NULL,
  `sex` varchar(8) NOT NULL,
  `id_job_position` int(11) NOT NULL,
  `isvisible` int(11) DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  `email` varchar(66) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_job_positions_id_fk` (`id_job_position`),
  KEY `employees_users_id_fk` (`id_user_saved`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `surname`, `date_of_birth`, `id_number`, `id_user_saved`, `date_created`, `sex`, `id_job_position`, `isvisible`, `isdeleted`, `email`) VALUES
(1, 'Kinsley', 'Kajiva', '1985-05-04', 'et44657766ttt', 1, '2018-09-05', 'male', 1, 1, 0, 'kajiva@gmil.com'),
(4, 'Taku', 'dd', '09/07/52', '4534', 1, '2019-12-11 08:42:20', 'male', 1, 0, 0, 'kasjd@343.com'),
(5, 'hkyu', 'yui', 'yuiu', 'yuui', 1, '2019-12-11 09:04:23', 'male', 2, 0, 0, 'kasjd@343.com'),
(6, 'John ', 'Maxi', '1985-05-04', '34334', 1, '2019-12-11 09:17:58', 'male', 1, 1, 0, 'kajivakinsley@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `fees_financial_year`
--

DROP TABLE IF EXISTS `fees_financial_year`;
CREATE TABLE IF NOT EXISTS `fees_financial_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_child` int(11) DEFAULT NULL,
  `id_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_financial_year_financial_year_id_fk` (`id_year`),
  KEY `fees_financial_year_children_id_fk` (`id_child`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_financial_year`
--

INSERT INTO `fees_financial_year` (`id`, `id_child`, `id_year`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 4, 1),
(4, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_items`
--

DROP TABLE IF EXISTS `fees_items`;
CREATE TABLE IF NOT EXISTS `fees_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(44) DEFAULT NULL,
  `cost` double(8,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_items`
--

INSERT INTO `fees_items` (`id`, `title`, `cost`) VALUES
(1, 'Registration Fee', 5010.00),
(2, 'Foods', 6.00),
(3, 'desert', 34.00),
(4, 'TV DVS', 370.00),
(5, 'Fee Food Times', 89.00);

-- --------------------------------------------------------

--
-- Table structure for table `fees_packages`
--

DROP TABLE IF EXISTS `fees_packages`;
CREATE TABLE IF NOT EXISTS `fees_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(212) NOT NULL,
  `fee_items_ids` varchar(22) DEFAULT NULL,
  `id_payment_periods` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_packages_fees_payment_periods_id_fk` (`id_payment_periods`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_packages`
--

INSERT INTO `fees_packages` (`id`, `title`, `fee_items_ids`, `id_payment_periods`) VALUES
(2, 'Starter 15', '1,3,4', 1),
(3, 'Ending Pack', '1,2', 2),
(4, 'Starter 4', '1,3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_packages_structure_for_child`
--

DROP TABLE IF EXISTS `fees_packages_structure_for_child`;
CREATE TABLE IF NOT EXISTS `fees_packages_structure_for_child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_title` varchar(212) DEFAULT NULL,
  `fee_item_title` varchar(211) DEFAULT NULL,
  `fee_item_amount` decimal(10,2) DEFAULT NULL,
  `id_posted_child` int(11) NOT NULL,
  `id_fee_item` int(11) DEFAULT NULL,
  `id_package_fee` int(11) DEFAULT NULL,
  `payment_period_title` varchar(15) DEFAULT NULL,
  `id_payment_period` int(11) DEFAULT NULL,
  `date_created` varchar(33) DEFAULT NULL,
  `id_user_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_packages_structure_for_child_users_id_fk` (`id_user_created`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_packages_structure_for_child`
--

INSERT INTO `fees_packages_structure_for_child` (`id`, `package_title`, `fee_item_title`, `fee_item_amount`, `id_posted_child`, `id_fee_item`, `id_package_fee`, `payment_period_title`, `id_payment_period`, `date_created`, `id_user_created`) VALUES
(1, 'Starter 15', 'desert', '34.00', 1, 3, 2, 'Every Month', 1, '2019-12-26 14:23:02', 1),
(2, 'Starter 15', 'Registration Fee', '5010.00', 1, 1, 2, 'Every Month', 1, '2019-12-26 14:25:48', 1),
(3, 'Starter 15', 'desert', '34.00', 1, 3, 2, 'Every Month', 1, '2019-12-26 14:25:48', 1),
(4, 'Starter 15', 'TV DVS', '370.00', 1, 4, 2, 'Every Month', 1, '2019-12-26 14:25:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_periods`
--

DROP TABLE IF EXISTS `fees_payment_periods`;
CREATE TABLE IF NOT EXISTS `fees_payment_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(144) NOT NULL,
  `monthly_period_counts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_payment_periods`
--

INSERT INTO `fees_payment_periods` (`id`, `title`, `monthly_period_counts`) VALUES
(1, 'Every Month', 1),
(2, 'Every Two Months', 2),
(3, 'Every Three Months', 3),
(4, 'Every Six Months', 6),
(5, 'Every Twelve Months', 12);

-- --------------------------------------------------------

--
-- Table structure for table `fee_payment_ledger`
--

DROP TABLE IF EXISTS `fee_payment_ledger`;
CREATE TABLE IF NOT EXISTS `fee_payment_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(212) DEFAULT NULL,
  `id_payment_type` int(11) DEFAULT NULL,
  `reference_txt` varchar(111) DEFAULT NULL,
  `id_child` int(11) DEFAULT NULL,
  `notes_description` text DEFAULT NULL,
  `id_user_saved_by` int(11) DEFAULT NULL,
  `date_created` varchar(44) DEFAULT NULL,
  `iscredit` int(11) NOT NULL DEFAULT 1,
  `amount` decimal(10,2) DEFAULT 0.00,
  `id_journal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fee_payment_ledger_payment_type_id_fk` (`id_payment_type`),
  KEY `fee_payment_ledger_children_id_fk` (`id_child`),
  KEY `fee_payment_ledger_users_id_fk` (`id_user_saved_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_payment_ledger`
--

INSERT INTO `fee_payment_ledger` (`id`, `title`, `id_payment_type`, `reference_txt`, `id_child`, `notes_description`, `id_user_saved_by`, `date_created`, `iscredit`, `amount`, `id_journal`) VALUES
(3, 'Payment', 2, '345345', 1, 'sdad ', 1, '2019-12-26 14:54:20', 1, '450.10', 6);

-- --------------------------------------------------------

--
-- Table structure for table `financial_year`
--

DROP TABLE IF EXISTS `financial_year`;
CREATE TABLE IF NOT EXISTS `financial_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `financial_year`
--

INSERT INTO `financial_year` (`id`, `year`) VALUES
(1, '2019'),
(2, '2020'),
(3, '2021'),
(4, '2022'),
(5, '2023'),
(6, '2024'),
(7, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `general_contacts`
--

DROP TABLE IF EXISTS `general_contacts`;
CREATE TABLE IF NOT EXISTS `general_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(212) DEFAULT NULL,
  `surname` varchar(211) DEFAULT NULL,
  `organisation` varchar(211) DEFAULT NULL,
  `isvisible` int(11) DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  `date_created` varchar(33) DEFAULT NULL,
  `id_user_created` int(11) DEFAULT NULL,
  `email` varchar(88) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `general_contacts_users_id_fk` (`id_user_created`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_contacts`
--

INSERT INTO `general_contacts` (`id`, `name`, `surname`, `organisation`, `isvisible`, `isdeleted`, `date_created`, `id_user_created`, `email`) VALUES
(2, 'Samer', 'Sfefh', 'NULL', 1, 0, '2019-12-28 17:19:44', 1, 'asd@gms.com'),
(3, 'NULL', 'NULL', 'Locker Orgasations X', 1, 0, '2019-12-28 17:20:51', 1, 'as3d@gms.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` text NOT NULL,
  `id_user_created` int(11) DEFAULT NULL,
  `date_created` varchar(55) DEFAULT NULL,
  `due_date` varchar(21) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_users_id_fk` (`id_user_created`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

DROP TABLE IF EXISTS `job_positions`;
CREATE TABLE IF NOT EXISTS `job_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text DEFAULT NULL,
  `isvisible` tinyint(4) DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_positions`
--

INSERT INTO `job_positions` (`id`, `title`, `description`, `isvisible`, `isdeleted`) VALUES
(1, 'Teacher', 'Teacher.. |', 1, 0),
(2, 'Sister', 'helping out with the kids !', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

DROP TABLE IF EXISTS `journal`;
CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(212) NOT NULL,
  `iscredit` int(11) NOT NULL DEFAULT 1,
  `date_created` varchar(22) DEFAULT NULL,
  `id_user_saved_by` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `journal_users_id_fk` (`id_user_saved_by`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id`, `description`, `iscredit`, `date_created`, `id_user_saved_by`, `amount`) VALUES
(6, '345345\n Notes:\nsdad ', 1, '2019-12-26 14:54:20', 1, 450.10);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `id_lesson_category` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `id_age_ranges` int(11) NOT NULL DEFAULT 1,
  `mile_stones` varchar(122) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_lessons_category_id_fk` (`id_lesson_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `id_lesson_category`, `description`, `id_age_ranges`, `mile_stones`) VALUES
(1, 'Sample - Easter Egg Hunt', 3, 'Today staff hid different-colored plastic easter eggs throughout the yard. Children had time to search the designated space and fill their baskets with the eggs they found. ', 1, NULL),
(2, 'Stafff 3 ', 3, 'Today staff hid different-colored plastic easter eggs throughout the yard. Children had time to search the designated space and fill their baskets with the eggs they found. ', 1, NULL),
(3, 'ds dfds ', 1, ' jgyjy rtsert ', 4, '9,11,12');

-- --------------------------------------------------------

--
-- Table structure for table `lessons_category`
--

DROP TABLE IF EXISTS `lessons_category`;
CREATE TABLE IF NOT EXISTS `lessons_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(212) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons_category`
--

INSERT INTO `lessons_category` (`id`, `title`) VALUES
(1, 'Arts'),
(2, 'Songs'),
(3, 'Outdoor Activity'),
(4, 'Story Time');

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

DROP TABLE IF EXISTS `milestones`;
CREATE TABLE IF NOT EXISTS `milestones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text DEFAULT NULL,
  `id_milestone_category` int(11) NOT NULL,
  `isvisible` int(11) DEFAULT 1,
  `isdeleted` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `milestones_milestone_category_id_fk` (`id_milestone_category`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `title`, `description`, `id_milestone_category`, `isvisible`, `isdeleted`) VALUES
(1, 'Reflection and Interpretation', NULL, 1, 1, 0),
(2, 'Creativity and Inventiveness', NULL, 1, 1, 0),
(3, 'Persistence and Attentiveness', NULL, 1, 1, 0),
(4, 'Initiative', NULL, 1, 1, 0),
(5, 'Curiosity and Interest', NULL, 1, 1, 0),
(6, 'Writing for a Variety of Purposes', NULL, 2, 1, 0),
(7, 'Writing Conventions', NULL, 2, 1, 0),
(8, 'Writing: Alphabet Knowledge', NULL, 2, 1, 0),
(9, 'Reading: Appreciation and Enjoyment of Reading', NULL, 2, 1, 0),
(10, 'Reading: Alphabetic Principle', NULL, 2, 1, 0),
(11, 'Reading: Phonological Awareness', NULL, 2, 1, 0),
(12, 'Conventions of Social Communication', NULL, 2, 1, 0),
(13, 'Oral and Written Communication', NULL, 2, 1, 0),
(14, 'Listening Skills', NULL, 2, 1, 0),
(15, 'Expressive Vocabulary', NULL, 2, 1, 0),
(16, 'Receptive Vocabulary', NULL, 2, 1, 0),
(17, 'Dual Language Acquisition', NULL, 2, 1, 0),
(18, 'Understanding & Appreciation: understanding and appreciation of the creative arts', NULL, 3, 1, 0),
(19, 'Expression & Representation: use creative arts to express and represent what they know, think, believe, or feel', NULL, 3, 1, 0),
(20, 'Civic Responsibility', NULL, 3, 1, 0),
(21, 'Community: awareness of their community, human interdependence, and social roles', NULL, 3, 1, 0),
(22, 'Culture: awareness and appreciation of their own and others\' culture', NULL, 3, 1, 0),
(23, 'Family: awareness and understanding of family', NULL, 3, 1, 0),
(24, 'Ecology: awareness of the relationship between humans and the environment', NULL, 4, 1, 0),
(25, 'Economics: knowledge of various occupations related to trade and currency', NULL, 4, 1, 0),
(26, 'Geography: knowledge of the relationship between people, places, and regions', NULL, 4, 1, 0),
(27, 'Geography: awareness of location and spatial relationships', NULL, 4, 1, 0),
(28, 'History: knowledge of past events and awareness of how they may influence the present and future', NULL, 4, 1, 0),
(29, 'Properties of Ordering: able to sort, classify, and organize objects', NULL, 5, 1, 0),
(30, 'Properties of Ordering: Identify labels & Shapes', NULL, 5, 1, 0),
(31, 'Measurement: knowledge of size, volume, height, weight, and length', '', 5, 1, 0),
(32, 'Number and Sense Operations: knowledge of numbers and counting', NULL, 5, 1, 0),
(33, 'Technology: understanding and use of technology in their surroundings', NULL, 6, 1, 0),
(34, 'Scientific Knowledge: observe and describe characteristics of the earth', NULL, 6, 1, 0),
(35, 'Scientific Knowledge: observe and describe characteristics of living things', NULL, 6, 1, 0),
(36, 'Scientific Thinking: engage in exploring the natural world by asking questions and making predictions', NULL, 6, 1, 0),
(37, 'Scientific Thinking: collect information through observation and manipulation', NULL, 6, 1, 0),
(38, 'Representational Thought: distinguish between fantasy and reality', NULL, 6, 1, 0),
(39, 'Representational Thought: use symbols to represent objects', NULL, 6, 1, 0),
(40, 'Problem-Solving: find multiple solutions to questions, tasks, problems, and challenges', NULL, 6, 1, 0),
(41, 'Critical and Analytic Thinking: use past knowledge to build new knowledge', NULL, 6, 1, 0),
(42, 'Critical and Analytic Thinking: compare, contrast, examine, and evaluate experiences, tasks, and events', NULL, 6, 1, 0),
(43, 'Causation: demonstrate awareness of cause and effect', NULL, 6, 1, 0),
(44, 'Rules and Regulations', NULL, 7, 1, 0),
(45, 'Safe Practices', NULL, 7, 1, 0),
(46, 'Nutrition', NULL, 7, 1, 0),
(47, 'Hygiene', NULL, 7, 1, 0),
(48, 'Daily Living Skills', NULL, 7, 1, 0),
(49, 'Physical Fitness: Variety and Well-Being', NULL, 8, 1, 0),
(50, 'Physical Fitness: Daily Activities', NULL, 8, 1, 0),
(51, 'Sensorimotor skills', NULL, 8, 1, 0),
(52, 'Fine Motor Skills', NULL, 8, 1, 0),
(53, 'Gross Motor Skills', NULL, 8, 1, 0),
(54, 'Emotional Expression', NULL, 9, 1, 0),
(55, 'Self-Control: Feelings and Impulses', NULL, 9, 1, 0),
(56, 'Self-Control', NULL, 9, 1, 0),
(57, 'Self-Efficacy', NULL, 9, 1, 0),
(58, 'Self-Concept: Abilities and Preferences', NULL, 9, 1, 0),
(59, 'Self-Concept', NULL, 9, 1, 0),
(60, 'Appreciating Diversity', NULL, 10, 1, 0),
(61, 'Adaptive Social Behavior: Empathy', NULL, 10, 1, 0),
(62, 'Adaptive Social Behavior: Diverse Settings', NULL, 10, 1, 0),
(63, 'Adaptive Social Behavior: Group Activities', NULL, 10, 1, 0),
(64, 'Adaptive Social Behavior', NULL, 10, 1, 0),
(65, 'Interactions with Peers: Negotiation', NULL, 10, 1, 0),
(66, 'Interactions with Peers: Cooperation', NULL, 10, 1, 0),
(67, 'Interactions with Peers: respond to and engage with other children', NULL, 10, 1, 0),
(68, 'Interaction from Adults: seeking assistance from adults', NULL, 10, 1, 0),
(69, 'Interactions with Adults: respond to and engage with adults', NULL, 10, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `milestone_category`
--

DROP TABLE IF EXISTS `milestone_category`;
CREATE TABLE IF NOT EXISTS `milestone_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(121) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestone_category`
--

INSERT INTO `milestone_category` (`id`, `title`) VALUES
(1, 'Approach to Learning'),
(2, 'Language,Communication,Literacy'),
(3, 'Culture,Community,Expression'),
(4, 'History,Social Studies'),
(5, 'Mathematics,Numeracy'),
(6, 'Cognition'),
(7, 'Health,Personal Care'),
(8, 'Physical,Motor Development'),
(9, 'Emotional Development'),
(10, 'Social Development');

-- --------------------------------------------------------

--
-- Table structure for table `parent_child_intermediary`
--

DROP TABLE IF EXISTS `parent_child_intermediary`;
CREATE TABLE IF NOT EXISTS `parent_child_intermediary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `id_child` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_child_intermediary_child_parents_id_fk` (`id_parent`),
  KEY `parent_child_intermediary_children_id_fk` (`id_child`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_child_intermediary`
--

INSERT INTO `parent_child_intermediary` (`id`, `id_parent`, `id_child`) VALUES
(1, 1, 1),
(3, 3, 3),
(4, 4, 4),
(5, 5, 4),
(6, 6, 5),
(7, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE IF NOT EXISTS `payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(211) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `title`) VALUES
(1, 'Cash'),
(2, 'Cheque'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(148) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'Admin'),
(2, 'Simple ');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `id_age_range` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rooms_age_ranges_id_fk` (`id_age_range`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `id_age_range`) VALUES
(1, 'Play Room', 6),
(2, 'Room P', 4);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

DROP TABLE IF EXISTS `school_year`;
CREATE TABLE IF NOT EXISTS `school_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_month` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_month` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `isvisible` tinyint(1) NOT NULL DEFAULT 1,
  `id_role` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `id_employee`, `isvisible`, `id_role`) VALUES
(1, 'me', '$2y$06$SgSkeLEBSCDflN/4mVq6S.DIMVEeA/spaEoVXvPD5mdW57g00.l66', 1, 1, 1),
(3, 'joh', '$2y$08$DeJNU9zQyo6AHbVGRj6Mr.5Et/BtqMPunMgstWjEgSb12T3f7c3TK', 6, 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_users_id_fk` FOREIGN KEY (`id_user_created`) REFERENCES `users` (`id`);

--
-- Constraints for table `calender`
--
ALTER TABLE `calender`
  ADD CONSTRAINT `calender_users_id_fk` FOREIGN KEY (`id_user_saved`) REFERENCES `users` (`id`);

--
-- Constraints for table `children_classes`
--
ALTER TABLE `children_classes`
  ADD CONSTRAINT `children_classes_lessons_id_fk` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `children_classes_users_id_fk` FOREIGN KEY (`id_user_saved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `child_assessment`
--
ALTER TABLE `child_assessment`
  ADD CONSTRAINT `child_assessment_child_assessment_markers_id_fk` FOREIGN KEY (`id_assessment_marker`) REFERENCES `child_assessment_markers` (`id`),
  ADD CONSTRAINT `child_assessment_children_id_fk` FOREIGN KEY (`id_child`) REFERENCES `children` (`id`),
  ADD CONSTRAINT `child_assessment_milestone_category_id_fk` FOREIGN KEY (`id_milestone_category`) REFERENCES `milestone_category` (`id`),
  ADD CONSTRAINT `child_assessment_users_id_fk` FOREIGN KEY (`id_user_created`) REFERENCES `users` (`id`);

--
-- Constraints for table `child_parents`
--
ALTER TABLE `child_parents`
  ADD CONSTRAINT `child_parents_users_id_fk` FOREIGN KEY (`id_user_created`) REFERENCES `users` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_job_positions_id_fk` FOREIGN KEY (`id_job_position`) REFERENCES `job_positions` (`id`),
  ADD CONSTRAINT `employees_users_id_fk` FOREIGN KEY (`id_user_saved`) REFERENCES `users` (`id`);

--
-- Constraints for table `fees_financial_year`
--
ALTER TABLE `fees_financial_year`
  ADD CONSTRAINT `fees_financial_year_children_id_fk` FOREIGN KEY (`id_child`) REFERENCES `children` (`id`),
  ADD CONSTRAINT `fees_financial_year_financial_year_id_fk` FOREIGN KEY (`id_year`) REFERENCES `financial_year` (`id`);

--
-- Constraints for table `fees_packages`
--
ALTER TABLE `fees_packages`
  ADD CONSTRAINT `fees_packages_fees_payment_periods_id_fk` FOREIGN KEY (`id_payment_periods`) REFERENCES `fees_payment_periods` (`id`);

--
-- Constraints for table `fees_packages_structure_for_child`
--
ALTER TABLE `fees_packages_structure_for_child`
  ADD CONSTRAINT `fees_packages_structure_for_child_users_id_fk` FOREIGN KEY (`id_user_created`) REFERENCES `users` (`id`);

--
-- Constraints for table `fee_payment_ledger`
--
ALTER TABLE `fee_payment_ledger`
  ADD CONSTRAINT `fee_payment_ledger_children_id_fk` FOREIGN KEY (`id_child`) REFERENCES `children` (`id`),
  ADD CONSTRAINT `fee_payment_ledger_payment_type_id_fk` FOREIGN KEY (`id_payment_type`) REFERENCES `payment_type` (`id`),
  ADD CONSTRAINT `fee_payment_ledger_users_id_fk` FOREIGN KEY (`id_user_saved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `general_contacts`
--
ALTER TABLE `general_contacts`
  ADD CONSTRAINT `general_contacts_users_id_fk` FOREIGN KEY (`id_user_created`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_users_id_fk` FOREIGN KEY (`id_user_created`) REFERENCES `users` (`id`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_users_id_fk` FOREIGN KEY (`id_user_saved_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_lessons_category_id_fk` FOREIGN KEY (`id_lesson_category`) REFERENCES `lessons_category` (`id`);

--
-- Constraints for table `milestones`
--
ALTER TABLE `milestones`
  ADD CONSTRAINT `milestones_milestone_category_id_fk` FOREIGN KEY (`id_milestone_category`) REFERENCES `milestone_category` (`id`);

--
-- Constraints for table `parent_child_intermediary`
--
ALTER TABLE `parent_child_intermediary`
  ADD CONSTRAINT `parent_child_intermediary_child_parents_id_fk` FOREIGN KEY (`id_parent`) REFERENCES `child_parents` (`id`),
  ADD CONSTRAINT `parent_child_intermediary_children_id_fk` FOREIGN KEY (`id_child`) REFERENCES `children` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_age_ranges_id_fk` FOREIGN KEY (`id_age_range`) REFERENCES `age_ranges` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
