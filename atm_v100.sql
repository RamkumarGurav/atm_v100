-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 09:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atm_v100`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_user_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `show_password` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(500) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) DEFAULT NULL,
  `address3` varchar(500) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `alt_mobile_no` varchar(50) DEFAULT NULL,
  `fax_no` varchar(50) DEFAULT NULL,
  `data_view` int(11) NOT NULL DEFAULT 0,
  `approval_access` int(11) NOT NULL DEFAULT 0,
  `user_image` varchar(250) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_loginip` varchar(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `termination_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_user_id`, `user_role_id`, `designation_id`, `name`, `first_name`, `last_name`, `password`, `show_password`, `email`, `username`, `country_id`, `state_id`, `city_id`, `address1`, `address2`, `address3`, `pincode`, `mobile_no`, `alt_mobile_no`, `fax_no`, `data_view`, `approval_access`, `user_image`, `added_by`, `added_on`, `updated_by`, `updated_on`, `status`, `last_login`, `last_loginip`, `joining_date`, `termination_date`) VALUES
(1, 1, 1, 'Krishna', 'Krishna', '', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'krishna@prachitours.in', 'admin', 1, 1, 8, 'Tumkuru', '', '', '560069', '9886551433', '', '', 0, 0, NULL, 1, '2022-11-21 00:00:00', 1, '2024-08-01 19:44:01', 1, '2024-08-21 18:02:49', '::1', '2022-03-11', '1970-01-01'),
(3, 0, 1, 'ramesh h', 'ramesh', 'h', 'edb43a6f411d80717742583ce13af55b', 'saitarun@annadatha', 'saitarun999@gmail.com', NULL, 1, 29, 1123, 'RAMAYAMPET', '', 'MEDAK DIST', '502101', '8555863004', '', '', 0, 0, NULL, 1, '2023-12-21 18:19:52', 1, '2024-06-19 16:57:47', 1, '2023-12-21 18:21:21', '49.249.163.201', '2023-12-21', NULL),
(4, 0, 1, 'ram gurav', 'ram', 'gurav', 'd74682ee47c3fffd5dcd749f840fcdd4', 'qwerqwer', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', 1, 1, 2, 'chandra layout', 'bengaluru,560060', '', '560060', '8549065626', '', '', 1, 0, NULL, 1, '2024-06-23 12:52:15', NULL, NULL, 1, '2024-07-20 18:57:44', '::1', '2024-06-23', '2024-06-23'),
(5, 0, 3, 'shamkumar meti', 'shamkumar', 'meti', '6a204bd89f3c8348afd5c77c717a097a', 'asdfasdf', 'asdframkumarsgurav@gmail.com', NULL, 1, 1, 9, 'chandra layout', '', '', '560060', '8549065626', '', '', 1, 0, NULL, 1, '2024-07-13 11:10:53', 1, '2024-08-01 16:26:30', 1, NULL, NULL, '2024-07-13', '2024-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_file`
--

CREATE TABLE `admin_user_file` (
  `admin_user_file_id` int(11) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_file`
--

INSERT INTO `admin_user_file` (`admin_user_file_id`, `admin_user_id`, `file_title`, `file_name`) VALUES
(7, 3, 'prachi1', 'prachi_3_1.png'),
(14, 5, 'aadhar', 'employee-atendance-report-31-07-2024 (6)_5_1.xls'),
(15, 5, 'image1', 'tour-img-21_5_2.png'),
(18, 1, 'AADHAR', 'admin_user_file_18.png'),
(19, 1, 'PAN', 'admin_user_file_19.xls');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_role`
--

CREATE TABLE `admin_user_role` (
  `admin_user_role` int(11) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `company_profile_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user_role`
--

INSERT INTO `admin_user_role` (`admin_user_role`, `admin_user_id`, `user_role_id`, `company_profile_id`) VALUES
(27, 1, 1, 1),
(14, 3, 4, 1),
(15, 4, 1, 1),
(22, 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_employee_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `attendance_login_image` varchar(255) DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `total_time` time DEFAULT NULL,
  `attendance_logout_image` varchar(255) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `user_employee_id`, `login_time`, `attendance_login_image`, `logout_time`, `total_time`, `attendance_logout_image`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(46, 4, '2024-07-19 11:07:05', 'attendance_login_image_46.png', '2024-07-19 13:07:05', '02:00:00', 'attendance_logout_image_46.png', '1', '2024-07-23 13:01:17', NULL, '2024-07-26 12:39:17', 1, '0', NULL, NULL),
(59, 5, '2024-07-25 11:00:00', 'attendance_login_image_59.png', NULL, '00:00:00', 'attendance_logout_image_59.png', '1', '2024-07-23 18:51:19', NULL, '2024-07-26 18:38:45', 1, '0', NULL, NULL),
(61, 4, '2024-02-23 09:23:53', 'attendance_login_image_61.png', '2024-02-23 19:24:24', '10:00:31', 'attendance_logout_image_61.png', '1', '2024-07-23 19:23:53', NULL, '2024-07-29 11:29:59', 1, '0', NULL, NULL),
(79, 4, '2024-07-24 11:24:19', 'attendance_login_image__79.png', '2024-07-24 17:25:32', '06:01:13', 'attendance_logout_image__79.png', '1', '2024-07-26 11:24:19', NULL, '2024-07-26 12:37:47', 1, '0', NULL, NULL),
(80, 4, '2024-07-26 11:06:44', 'attendance_login_image__80.png', '2024-07-26 16:40:00', '05:33:16', 'attendance_logout_image__80.png', '1', '2024-07-26 11:24:44', NULL, '2024-07-27 10:55:31', 1, '0', NULL, NULL),
(81, 5, '2024-07-26 10:09:08', 'attendance_login_image__81.png', NULL, '00:00:00', 'attendance_logout_image__81.png', '1', '2024-07-26 11:28:08', NULL, '2024-07-27 10:49:47', 1, '0', NULL, NULL),
(84, 5, '2024-07-26 11:00:00', NULL, NULL, '00:00:00', NULL, '1', '2024-07-27 11:06:20', 1, NULL, NULL, '0', NULL, NULL),
(85, 4, '2023-01-02 10:10:00', NULL, '2023-01-02 18:50:00', '08:40:00', NULL, '1', '2024-07-27 15:28:34', 1, '2024-07-27 17:55:52', 1, '0', NULL, NULL),
(86, 4, '2023-01-03 10:10:00', NULL, '2023-01-03 18:10:00', '08:00:00', NULL, '1', '2024-07-27 15:28:34', 1, '2024-07-27 18:42:01', 1, '0', NULL, NULL),
(87, 4, '2023-01-04 10:30:00', NULL, '2023-01-04 18:50:00', '08:20:00', NULL, '1', '2024-07-27 16:15:00', NULL, '2024-07-27 18:42:22', 1, '0', NULL, NULL),
(88, 4, '2023-01-05 10:30:00', NULL, '2023-01-05 18:10:00', '07:40:00', NULL, '1', '2024-07-27 16:15:00', NULL, '2024-07-27 18:46:59', 1, '0', NULL, NULL),
(91, 4, '2023-01-09 10:10:00', NULL, '2023-01-09 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:00', NULL, NULL, NULL, '0', NULL, NULL),
(92, 4, '2023-01-10 10:10:00', NULL, '2023-01-10 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(93, 4, '2023-01-11 10:30:00', NULL, '2023-01-11 18:50:00', '08:20:00', NULL, '1', '2024-07-27 16:15:01', NULL, '2024-07-27 18:25:20', 1, '0', NULL, NULL),
(94, 4, '2023-01-12 10:30:00', NULL, '2023-01-12 18:10:00', '07:40:00', NULL, '1', '2024-07-27 16:15:01', NULL, '2024-07-27 18:25:40', 1, '0', NULL, NULL),
(95, 4, '2023-01-16 10:10:00', NULL, '2023-01-16 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(96, 4, '2023-01-17 10:10:00', NULL, '2023-01-17 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(97, 4, '2023-01-18 10:30:00', NULL, '2023-01-18 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(98, 4, '2023-01-19 10:30:00', NULL, '2023-01-19 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(99, 4, '2023-01-23 10:10:00', NULL, '2023-01-23 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(100, 4, '2023-01-24 10:10:00', NULL, '2023-01-24 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(101, 4, '2023-01-25 10:30:00', NULL, '2023-01-25 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(102, 4, '2023-01-26 10:30:00', NULL, '2023-01-26 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:01', NULL, NULL, NULL, '0', NULL, NULL),
(103, 5, '2023-01-02 10:10:00', NULL, '2023-01-02 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(104, 5, '2023-01-03 10:10:00', NULL, '2023-01-03 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(105, 5, '2023-01-04 10:30:00', NULL, '2023-01-04 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(106, 5, '2023-01-05 10:30:00', NULL, '2023-01-05 18:10:00', '07:40:00', NULL, '1', '2024-07-27 16:15:53', NULL, '2024-07-27 18:26:20', 1, '0', NULL, NULL),
(107, 5, '2023-01-06 10:30:00', NULL, '2023-01-06 18:10:00', '07:40:00', NULL, '1', '2024-07-27 16:15:53', NULL, '2024-07-27 19:42:44', 1, '0', NULL, NULL),
(108, 5, '2023-01-09 10:10:00', NULL, '2023-01-09 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(109, 5, '2023-01-10 10:10:00', NULL, '2023-01-10 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(110, 5, '2023-01-11 10:30:00', NULL, '2023-01-11 18:50:00', '08:20:00', NULL, '1', '2024-07-27 16:15:53', NULL, '2024-07-27 18:26:40', 1, '0', NULL, NULL),
(111, 5, '2023-01-12 10:30:00', NULL, '2023-01-12 18:10:00', '07:40:00', NULL, '1', '2024-07-27 16:15:53', NULL, '2024-07-27 18:26:50', 1, '0', NULL, NULL),
(112, 5, '2023-01-16 10:10:00', NULL, '2023-01-16 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(113, 5, '2023-01-17 10:10:00', NULL, '2023-01-17 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(114, 5, '2023-01-18 10:30:00', NULL, '2023-01-18 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(115, 5, '2023-01-19 10:30:00', NULL, '2023-01-19 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(116, 5, '2023-01-23 10:10:00', NULL, '2023-01-23 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(117, 5, '2023-01-24 10:10:00', NULL, '2023-01-24 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(118, 5, '2023-01-25 10:30:00', NULL, '2023-01-25 18:50:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(119, 5, '2023-01-26 10:30:00', NULL, '2023-01-26 18:10:00', NULL, NULL, '1', '2024-07-27 16:15:53', NULL, NULL, NULL, '0', NULL, NULL),
(120, 5, '2023-01-27 10:30:00', NULL, '2023-01-27 18:10:00', '07:40:00', NULL, '0', '2024-07-27 16:15:53', NULL, '2024-07-31 17:38:57', 1, '0', NULL, NULL),
(121, 4, '2024-07-27 19:25:58', 'attendance_login_image__121.png', NULL, '00:00:00', NULL, '0', '2024-07-27 19:24:58', NULL, '2024-07-31 17:42:35', 1, '0', NULL, NULL),
(122, 4, '2024-07-30 10:10:08', 'attendance_login_image__122.png', '2024-07-30 14:06:58', '03:56:50', 'attendance_logout_image__122.png', '0', '2024-07-30 14:06:08', NULL, '2024-07-31 13:22:32', 1, '0', NULL, NULL),
(138, 4, '2024-07-31 11:30:31', 'attendance_login_image__138.png', '2024-07-31 18:20:00', '06:49:29', NULL, '1', '2024-07-30 20:25:31', NULL, '2024-07-31 11:56:06', 1, '0', NULL, NULL),
(139, 5, '2024-07-31 10:30:00', NULL, NULL, '00:00:00', NULL, '0', '2024-07-31 12:11:17', 1, '2024-07-31 13:22:03', 1, '0', NULL, NULL),
(140, 4, '2024-07-30 13:21:44', 'attendance_login_image__140.png', NULL, '00:00:00', NULL, '0', '2024-07-31 13:21:44', NULL, '2024-07-31 16:31:26', 1, '0', NULL, NULL),
(141, 10, '2024-07-30 10:01:00', NULL, '2024-07-30 17:01:00', '07:00:00', NULL, '1', '2024-07-31 16:01:46', 1, NULL, NULL, '0', NULL, NULL),
(142, 5, '2024-07-31 16:24:40', 'attendance_login_image__142.png', '2024-07-31 16:24:53', '00:00:13', 'attendance_logout_image__142.png', '1', '2024-07-31 16:24:40', NULL, '2024-07-31 16:24:53', NULL, '0', NULL, NULL),
(143, 5, '2024-07-31 16:26:22', 'attendance_login_image__143.png', '2024-07-31 16:27:16', '00:00:54', 'attendance_logout_image__143.png', '1', '2024-07-31 16:26:22', NULL, '2024-07-31 16:27:16', NULL, '0', NULL, NULL),
(144, 4, '2024-07-31 16:32:43', 'attendance_login_image__144.png', '2024-07-31 16:32:53', '00:00:10', 'attendance_logout_image__144.png', '1', '2024-07-31 16:32:43', NULL, '2024-07-31 16:32:53', NULL, '0', NULL, NULL),
(145, 5, '2024-07-30 16:33:10', 'attendance_login_image__145.png', '2024-07-30 17:22:00', '00:48:50', NULL, '1', '2024-07-31 16:33:10', NULL, '2024-07-31 17:22:45', 1, '0', NULL, NULL),
(146, 5, '2024-07-31 17:17:38', 'attendance_login_image__146.png', '2024-07-31 17:17:53', '00:00:15', 'attendance_logout_image__146.png', '0', '2024-07-31 17:17:38', NULL, '2024-07-31 17:18:13', 1, '0', NULL, NULL),
(150, 4, '2024-08-01 11:49:14', 'attendance_login_image__150.png', '2024-08-01 11:55:00', '00:05:46', 'attendance_logout_image__150.png', '1', '2024-08-01 11:49:14', NULL, '2024-08-01 11:55:00', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` text DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_address`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1, 'Bengalore branch', 'bengalore 560060', '1', '2024-07-12 13:26:58', NULL, '2024-07-13 16:27:05', 1, '0', NULL, NULL),
(2, 'Manglore Branch', 'Manglore 570070', '1', '2024-07-12 13:51:21', 1, '2024-07-12 13:55:25', 1, '0', NULL, NULL),
(3, 'Mysore branch', 'asdf asdf', '1', '2024-07-25 15:48:04', 1, NULL, NULL, '0', NULL, NULL),
(4, 'Kashmir', NULL, '1', '2024-07-25 16:44:06', 1, '2024-07-29 16:25:33', 1, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_code` varchar(255) DEFAULT NULL,
  `is_display` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `city_name`, `city_code`, `is_display`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1, 1, 1, 'Dharwad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(2, 1, 1, 'Hubli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(3, 1, 1, 'Belagavi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(4, 1, 1, 'Mangaluru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(5, 1, 1, 'Davanagere', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(6, 1, 1, 'Ballari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(7, 1, 1, 'Mysore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(8, 1, 1, 'Tumkur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(9, 1, 1, 'Kolar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(10, 1, 1, 'Mandya', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(11, 1, 1, 'Udupi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(12, 1, 1, 'Chikkamagaluru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(13, 1, 1, 'Karwar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(14, 1, 1, 'Gokak', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(15, 1, 1, 'Yadgir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(16, 1, 1, 'Tiptur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(17, 1, 1, 'Arsikere', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(18, 1, 1, 'Nanjangud', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(19, 1, 1, 'Athni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(20, 1, 1, 'Wadi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(21, 1, 1, 'Nelamangala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(22, 1, 1, 'Lakshmeshwar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(23, 1, 1, 'Nargund', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(24, 1, 1, 'Tarikere', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(25, 1, 1, 'Lingsugur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(26, 1, 1, 'Vijayapura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(27, 1, 1, 'Talikota', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(28, 1, 1, 'Afzalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(29, 1, 1, 'Tekkalakote', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(30, 1, 1, 'Terdal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(31, 1, 1, 'Navalgund', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(32, 1, 2, 'Port Blair', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(33, 1, 3, 'Visakhapatnam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(34, 1, 3, 'Vijayawada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(35, 1, 3, 'Guntur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(36, 1, 3, 'Nellore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(37, 1, 3, 'Kurnool', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(38, 1, 3, 'Kakinada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(39, 1, 3, 'Tirupati', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(40, 1, 3, 'Anantapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(41, 1, 3, 'Kadapa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(42, 1, 3, 'Vizianagaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(43, 1, 3, 'Eluru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(44, 1, 3, 'Ongole', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(45, 1, 3, 'Nandyal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(46, 1, 3, 'Machilipatnam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(47, 1, 3, 'Adoni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(48, 1, 3, 'Tenali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(49, 1, 3, 'Chittoor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(50, 1, 3, 'Hindupur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(51, 1, 3, 'Bhimavaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(52, 1, 3, 'Madanapalle', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(53, 1, 3, 'Guntakal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(54, 1, 3, 'Dharmavaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(55, 1, 3, 'Gudivada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(56, 1, 3, 'Narasaraopet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(57, 1, 3, 'Tadpatri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(58, 1, 3, 'Tadepalligudem', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(59, 1, 3, 'Chilakaluripet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(60, 1, 3, 'Yemmiganur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(61, 1, 3, 'Kadiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(62, 1, 3, 'Chirala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(63, 1, 3, 'Anakapalle', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(64, 1, 3, 'Kavali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(65, 1, 3, 'Tanuku', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(66, 1, 3, 'Bapatla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(67, 1, 3, 'Naidupet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(68, 1, 3, 'Nagari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(69, 1, 3, 'Gudur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(70, 1, 3, 'Vinukonda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(71, 1, 3, 'Narasapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(72, 1, 3, 'Nuzvid', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(73, 1, 3, 'Kandukur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(74, 1, 3, 'Bobbili', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(75, 1, 3, 'Jaggaiahpet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(76, 1, 3, 'Tuni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(77, 1, 3, 'Amalapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(78, 1, 3, 'Bheemunipatnam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(79, 1, 3, 'Venkatagiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(80, 1, 3, 'Gooty', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(81, 1, 3, 'Jammalamadugu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(82, 1, 3, 'Nidadavole', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(83, 1, 3, 'Kovvur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(84, 1, 3, 'Tiruvuru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(85, 1, 3, 'Uravakonda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(86, 1, 3, 'Narsipatnam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(87, 1, 3, 'Yerraguntla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(88, 1, 4, 'Naharlagun', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(89, 1, 5, 'Guwahati', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(90, 1, 5, 'Dibrugarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(91, 1, 5, 'Nagaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(92, 1, 5, 'Tinsukia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(93, 1, 5, 'Jorhat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(94, 1, 5, 'Bongaigaon City', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(95, 1, 5, 'Dhubri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(96, 1, 5, 'Diphu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(97, 1, 5, 'North Lakhimpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(98, 1, 5, 'Tezpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(99, 1, 5, 'Karimganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(100, 1, 5, 'Goalpara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(101, 1, 5, 'Barpeta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(102, 1, 5, 'Lanka', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(103, 1, 5, 'Lumding', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(104, 1, 5, 'Nalbari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(105, 1, 6, 'Gaya', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(106, 1, 6, 'Bhagalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(107, 1, 6, 'Muzaffarpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(108, 1, 6, 'Darbhanga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(109, 1, 6, 'Arrah', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(110, 1, 6, 'Begusarai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(111, 1, 6, 'Chhapra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(112, 1, 6, 'Katihar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(113, 1, 6, 'Munger', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(114, 1, 6, 'Saharsa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(115, 1, 6, 'Sasaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(116, 1, 6, 'Hajipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(117, 1, 6, 'Dehri-on-Sone', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(118, 1, 6, 'Bettiah', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(119, 1, 6, 'Motihari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(120, 1, 6, 'Bagaha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(121, 1, 6, 'Kishanganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(122, 1, 6, 'Jamalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(123, 1, 6, 'Buxar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(124, 1, 6, 'Jehanabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(125, 1, 6, 'Aurangabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(126, 1, 6, 'Lakhisarai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(127, 1, 6, 'Nawada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(128, 1, 6, 'Jamui', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(129, 1, 6, 'Araria', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(130, 1, 6, 'Gopalganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(131, 1, 6, 'Dumraon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(132, 1, 6, 'Arwal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(133, 1, 6, 'Forbesganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(134, 1, 6, 'BhabUrban Agglomeration', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(135, 1, 6, 'Narkatiaganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(136, 1, 6, 'Naugachhia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(137, 1, 6, 'Warisaliganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(138, 1, 6, 'Nokha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(139, 1, 6, 'Lalganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(140, 1, 7, 'Chandigarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(141, 1, 8, 'Bhilai Nagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(142, 1, 8, 'Korba', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(143, 1, 8, 'Bilaspur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(144, 1, 8, 'Durg', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(145, 1, 8, 'Jagdalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(146, 1, 8, 'Ambikapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(147, 1, 8, 'Mahasamund', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(148, 1, 8, 'Dhamtari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(149, 1, 8, 'Chirmiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(150, 1, 8, 'Bhatapara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(151, 1, 8, 'Dalli-Rajhara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(152, 1, 8, 'Naila Janjgir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(153, 1, 8, 'Tilda Newra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(154, 1, 19, 'Silvassa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(155, 1, 10, 'Delhi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(156, 1, 10, 'New Delhi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(157, 1, 11, 'Marmagao', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(158, 1, 11, 'Panaji', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(159, 1, 11, 'Margao', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(160, 1, 11, 'Mapusa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(161, 1, 12, 'Ahmedabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(162, 1, 12, 'Vadodara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(163, 1, 12, 'Bhavnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(164, 1, 12, 'Jamnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(165, 1, 12, 'Nadiad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(166, 1, 12, 'Anand', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(167, 1, 12, 'Morvi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(168, 1, 12, 'Mahesana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(169, 1, 12, 'Bharuch', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(170, 1, 12, 'Vapi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(171, 1, 12, 'Navsari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(172, 1, 12, 'Veraval', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(173, 1, 12, 'Bhuj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(174, 1, 12, 'Godhra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(175, 1, 12, 'Palanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(176, 1, 12, 'Valsad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(177, 1, 12, 'Deesa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(178, 1, 12, 'Amreli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(179, 1, 12, 'Anjar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(180, 1, 12, 'Dhoraji', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(181, 1, 12, 'Khambhat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(182, 1, 12, 'Keshod', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(183, 1, 12, 'Wadhwan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(184, 1, 12, 'Ankleshwar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(185, 1, 12, 'Kadi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(186, 1, 12, 'Visnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(187, 1, 12, 'Upleta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(188, 1, 12, 'Una', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(189, 1, 12, 'Unjha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(190, 1, 12, 'Viramgam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(191, 1, 12, 'Kapadvanj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(192, 1, 12, 'Kalavad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(193, 1, 12, 'Wankaner', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(194, 1, 12, 'Limbdi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(195, 1, 12, 'Thangadh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(196, 1, 12, 'Vyara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(197, 1, 12, 'Lunawada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(198, 1, 12, 'Vapi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(199, 1, 12, 'Umreth', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(200, 1, 12, 'Tharad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(201, 1, 12, 'Umbergaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(202, 1, 12, 'Talaja', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(203, 1, 12, 'Vadnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(204, 1, 12, 'Vijapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(205, 1, 12, 'Lathi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(206, 1, 13, 'Faridabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(207, 1, 13, 'Gurgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(208, 1, 13, 'Hisar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(209, 1, 13, 'Panipat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(210, 1, 13, 'Karnal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(211, 1, 13, 'Yamunanagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(212, 1, 13, 'Panchkula', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(213, 1, 13, 'Bhiwani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(214, 1, 13, 'Bahadurgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(215, 1, 13, 'Jind', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(216, 1, 13, 'Thanesar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(217, 1, 13, 'Kaithal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(218, 1, 13, 'Palwal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(219, 1, 13, 'Hansi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(220, 1, 13, 'Narnaul', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(221, 1, 13, 'Fatehabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(222, 1, 13, 'Gohana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(223, 1, 13, 'Tohana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(224, 1, 13, 'Narwana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(225, 1, 13, 'Charkhi Dadri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(226, 1, 13, 'Ladwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(227, 1, 13, 'Taraori', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(228, 1, 14, 'Nahan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(229, 1, 15, 'Jammu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(230, 1, 15, 'Baramula', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(231, 1, 15, 'Anantnag', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(232, 1, 15, 'KathUrban Agglomeration', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(233, 1, 15, 'Udhampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(234, 1, 16, 'Dhanbad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(235, 1, 16, 'Jamshedpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(236, 1, 16, 'Bokaro Steel City', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(237, 1, 16, 'Deoghar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(238, 1, 16, 'Adityapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(239, 1, 16, 'Hazaribag', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(240, 1, 16, 'Giridih', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(241, 1, 16, 'Jhumri Tilaiya', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(242, 1, 16, 'Medininagar (Daltonganj)', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(243, 1, 16, 'Chaibasa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(244, 1, 16, 'Chatra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(245, 1, 16, 'Gumia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(246, 1, 16, 'Dumka', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(247, 1, 16, 'Chirkunda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(248, 1, 16, 'Lohardaga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(249, 1, 16, 'Tenu dam-cum-Kathhara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(250, 1, 17, 'Thiruvananthapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(251, 1, 17, 'Kochi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(252, 1, 17, 'Kozhikode', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(253, 1, 17, 'Kollam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(254, 1, 17, 'Thrissur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(255, 1, 17, 'Alappuzha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(256, 1, 17, 'Malappuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(257, 1, 17, 'Vatakara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(258, 1, 17, 'Kanhangad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(259, 1, 17, 'Taliparamba', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(260, 1, 17, 'Koyilandy', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(261, 1, 17, 'Neyyattinkara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(262, 1, 17, 'Kayamkulam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(263, 1, 17, 'Nedumangad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(264, 1, 17, 'Kannur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(265, 1, 17, 'Tirur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(266, 1, 17, 'Kottayam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(267, 1, 17, 'Kasaragod', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(268, 1, 17, 'Kunnamkulam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(269, 1, 17, 'Ottappalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(270, 1, 17, 'Thiruvalla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(271, 1, 17, 'Thodupuzha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(272, 1, 17, 'Chalakudy', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(273, 1, 17, 'Changanassery', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(274, 1, 17, 'Nilambur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(275, 1, 17, 'Cherthala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(276, 1, 17, 'Varkala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(277, 1, 17, 'Attingal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(278, 1, 17, 'Kodungallur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(279, 1, 17, 'Chittur-Thathamangalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(280, 1, 17, 'Adoor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(281, 1, 17, 'Vaikom', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(282, 1, 17, 'Guruvayoor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(283, 1, 18, 'Indore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(284, 1, 18, 'Bhopal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(285, 1, 18, 'Jabalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(286, 1, 18, 'Gwalior', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(287, 1, 18, 'Ujjain', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(288, 1, 18, 'Murwara (Katni)', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(289, 1, 18, 'Morena', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(290, 1, 18, 'Vidisha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(291, 1, 18, 'Ganjbasoda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(292, 1, 18, 'Mandsaur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(293, 1, 18, 'Neemuch', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(294, 1, 18, 'Nagda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(295, 1, 18, 'Itarsi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(296, 1, 18, 'Balaghat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(297, 1, 18, 'Ashok Nagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(298, 1, 18, 'Tikamgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(299, 1, 18, 'Alirajpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(300, 1, 18, 'Nowgong', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(301, 1, 18, 'Lahar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(302, 1, 18, 'Umaria', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(303, 1, 18, 'Narsinghgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(304, 1, 18, 'Nepanagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(305, 1, 18, 'Wara Seoni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(306, 1, 18, 'Tarana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(307, 1, 18, 'Niwari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(308, 1, 18, 'Nainpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(309, 1, 18, 'Nowrozabad (Khodargama)', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(310, 1, 19, 'Mumbai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(311, 1, 19, 'Nagpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(312, 1, 19, 'Thane', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(313, 1, 19, 'Nashik', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(314, 1, 19, 'Kalyan-Dombivali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(315, 1, 19, 'Vasai-Virar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(316, 1, 19, 'Mira-Bhayandar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(317, 1, 19, 'Bhiwandi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(318, 1, 19, 'Amravati', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(319, 1, 19, 'Nanded-Waghala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(320, 1, 19, 'Malegaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(321, 1, 19, 'Akola', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(322, 1, 19, 'Latur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(323, 1, 19, 'Dhule', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(324, 1, 19, 'Ahmednagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(325, 1, 19, 'Ichalkaranji', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(326, 1, 19, 'Yavatmal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(327, 1, 19, 'Achalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(328, 1, 19, 'Osmanabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(329, 1, 19, 'Nandurbar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(330, 1, 19, 'Wardha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(331, 1, 19, 'Udgir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(332, 1, 19, 'Aurangabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(333, 1, 19, 'Amalner', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(334, 1, 19, 'Akot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(335, 1, 19, 'Washim', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(336, 1, 19, 'Ambejogai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(337, 1, 19, 'Uran Islampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(338, 1, 19, 'Wani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(339, 1, 19, 'Lonavla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(340, 1, 19, 'Talegaon Dabhade', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(341, 1, 19, 'Anjangaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(342, 1, 19, 'Umred', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(343, 1, 19, 'Ozar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(344, 1, 19, 'Yevla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(345, 1, 19, 'Vita', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(346, 1, 19, 'Umarkhed', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(347, 1, 19, 'Warora', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(348, 1, 19, 'Tumsar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(349, 1, 19, 'Arvi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(350, 1, 19, 'Nandura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(351, 1, 19, 'Vaijapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(352, 1, 19, 'Wadgaon Road', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(353, 1, 19, 'Tasgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(354, 1, 19, 'Yawal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(355, 1, 19, 'Nilanga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(356, 1, 19, 'Wai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(357, 1, 19, 'Umarga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(358, 1, 19, 'Nawapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(359, 1, 19, 'Tuljapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(360, 1, 19, 'Uchgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(361, 1, 19, 'Uran', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(362, 1, 19, 'Karjat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(363, 1, 19, 'Talode', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(364, 1, 19, 'Vadgaon Kasba', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(365, 1, 19, 'Tirora', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(366, 1, 19, 'Lonar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(367, 1, 19, 'Narkhed', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(368, 1, 19, 'Loha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(369, 1, 20, 'Imphal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(370, 1, 20, 'Thoubal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(371, 1, 20, 'Lilong', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(372, 1, 21, 'Tura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(373, 1, 21, 'Nongstoin', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(374, 1, 22, 'Aizawl', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(375, 1, 22, 'Lunglei', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(376, 1, 23, 'Dimapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(377, 1, 23, 'Kohima', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(378, 1, 23, 'Zunheboto', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(379, 1, 23, 'Tuensang', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(380, 1, 23, 'Wokha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(381, 1, 24, 'Bhubaneswar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(382, 1, 24, 'Cuttack', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(383, 1, 24, 'Brahmapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(384, 1, 24, 'Sambalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(385, 1, 24, 'Baleshwar Town', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(386, 1, 24, 'Baripada Town', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(387, 1, 24, 'Bhadrak', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(388, 1, 24, 'Balangir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(389, 1, 24, 'Jharsuguda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(390, 1, 24, 'Bargarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(391, 1, 24, 'Bhawanipatna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(392, 1, 24, 'Dhenkanal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(393, 1, 24, 'Barbil', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(394, 1, 24, 'Kendujhar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(395, 1, 24, 'Jatani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(396, 1, 24, 'Byasanagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(397, 1, 24, 'Kendrapara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(398, 1, 24, 'Talcher', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(399, 1, 24, 'Titlagarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(400, 1, 24, 'Nabarangapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(401, 1, 25, 'Karaikal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(402, 1, 25, 'Yanam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(403, 1, 26, 'Ludhiana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(404, 1, 26, 'Amritsar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(405, 1, 26, 'Jalandhar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(406, 1, 26, 'Bathinda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(407, 1, 26, 'Hoshiarpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(408, 1, 26, 'Batala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(409, 1, 26, 'Moga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(410, 1, 26, 'Malerkotla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(411, 1, 26, 'Khanna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(412, 1, 26, 'Barnala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(413, 1, 26, 'Firozpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(414, 1, 26, 'Kapurthala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(415, 1, 26, 'Zirakpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(416, 1, 26, 'Kot Kapura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(417, 1, 26, 'Faridkot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(418, 1, 26, 'Fazilka', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(419, 1, 26, 'Gurdaspur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(420, 1, 26, 'Kharar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(421, 1, 26, 'Gobindgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(422, 1, 26, 'Nabha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(423, 1, 26, 'Tarn Taran', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(424, 1, 26, 'Jagraon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(425, 1, 26, 'Dhuri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(426, 1, 26, 'Firozpur Cantt.', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(427, 1, 26, 'Jalandhar Cantt.', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(428, 1, 26, 'Nawanshahr', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(429, 1, 26, 'Nangal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(430, 1, 26, 'Nakodar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(431, 1, 26, 'Zira', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(432, 1, 26, 'Longowal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(433, 1, 26, 'Urmar Tanda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(434, 1, 26, 'Qadian', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(435, 1, 27, 'Jaipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(436, 1, 27, 'Jodhpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(437, 1, 27, 'Bikaner', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(438, 1, 27, 'Udaipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(439, 1, 27, 'Ajmer', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(440, 1, 27, 'Bhilwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(441, 1, 27, 'Alwar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(442, 1, 27, 'Bharatpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(443, 1, 27, 'Pali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(444, 1, 27, 'Barmer', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(445, 1, 27, 'Tonk', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(446, 1, 27, 'Nagaur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(447, 1, 27, 'Ladnu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(448, 1, 27, 'Nokha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(449, 1, 27, 'Nimbahera', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(450, 1, 27, 'Lachhmangarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(451, 1, 27, 'Nasirabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(452, 1, 27, 'Nohar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(453, 1, 27, 'Nathdwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(454, 1, 27, 'Neem-Ka-Thana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(455, 1, 27, 'Lalsot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(456, 1, 27, 'Taranagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(457, 1, 27, 'Vijainagar, Ajmer', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(458, 1, 27, 'Lakheri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(459, 1, 27, 'Udaipurwati', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(460, 1, 27, 'Losal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(461, 1, 27, 'Nadbai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(462, 1, 27, 'Nagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(463, 1, 27, 'Todaraisingh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(464, 1, 27, 'Todabhim', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(465, 1, 28, 'Chennai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(466, 1, 28, 'Coimbatore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(467, 1, 28, 'Madurai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(468, 1, 28, 'Tiruchirappalli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(469, 1, 28, 'Salem', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(470, 1, 28, 'Tirunelveli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(471, 1, 28, 'Tiruppur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(472, 1, 28, 'Nagercoil', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(473, 1, 28, 'Thanjavur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(474, 1, 28, 'Vellore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(475, 1, 28, 'Kancheepuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(476, 1, 28, 'Erode', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(477, 1, 28, 'Tiruvannamalai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(478, 1, 28, 'Neyveli (TS)', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(479, 1, 28, 'Nagapattinam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(480, 1, 28, 'Viluppuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(481, 1, 28, 'Tiruchengode', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(482, 1, 28, 'Vaniyambadi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(483, 1, 28, 'Theni Allinagaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(484, 1, 28, 'Udhagamandalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(485, 1, 28, 'Aruppukkottai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(486, 1, 28, 'Arakkonam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(487, 1, 28, 'Virudhachalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(488, 1, 28, 'Tindivanam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(489, 1, 28, 'Virudhunagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(490, 1, 28, 'Karur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(491, 1, 28, 'Valparai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(492, 1, 28, 'Sankarankovil', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(493, 1, 28, 'Tenkasi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(494, 1, 28, 'Tirupathur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(495, 1, 28, 'Udumalaipettai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(496, 1, 28, 'Gobichettipalayam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(497, 1, 28, 'Thiruvarur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(498, 1, 28, 'Thiruvallur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(499, 1, 28, 'Namakkal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(500, 1, 28, 'Thirumangalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(501, 1, 28, 'Vikramasingapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(502, 1, 28, 'Nellikuppam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(503, 1, 28, 'Tiruttani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(504, 1, 28, 'Nandivaram-Guduvancheri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(505, 1, 28, 'Vellakoil', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(506, 1, 28, 'Vadalur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(507, 1, 28, 'Tiruvethipuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(508, 1, 28, 'Usilampatti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(509, 1, 28, 'Vedaranyam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(510, 1, 28, 'Nanjikottai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(511, 1, 28, 'Thuraiyur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(512, 1, 28, 'Tiruchendur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(513, 1, 28, 'Vandavasi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(514, 1, 28, 'Tharamangalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(515, 1, 28, 'Tirukkoyilur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(516, 1, 28, 'Oddanchatram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(517, 1, 28, 'Vadakkuvalliyur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(518, 1, 28, 'Tirukalukundram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(519, 1, 28, 'Uthamapalayam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(520, 1, 28, 'Vadipatti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(521, 1, 28, 'Tirupathur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(522, 1, 28, 'Viswanatham', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(523, 1, 28, 'Uthiramerur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(524, 1, 28, 'Thiruthuraipoondi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(525, 1, 28, 'Lalgudi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(526, 1, 28, 'Natham', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(527, 1, 28, 'Unnamalaikadai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(528, 1, 28, 'Tharangambadi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(529, 1, 28, 'Tittakudi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(530, 1, 28, 'O\' Valley', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(531, 1, 28, 'Thammampatti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(532, 1, 28, 'Namagiripettai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(533, 1, 29, 'Hyderabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(534, 1, 29, 'Warangal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(535, 1, 29, 'Nizamabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(536, 1, 29, 'Karimnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(537, 1, 29, 'Khammam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(538, 1, 29, 'Mahbubnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(539, 1, 29, 'Adilabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(540, 1, 29, 'Jagtial', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(541, 1, 29, 'Nirmal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(542, 1, 29, 'Kamareddy', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(543, 1, 29, 'Kothagudem', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(544, 1, 29, 'Bodhan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(545, 1, 29, 'Koratla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(546, 1, 29, 'Tandur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(547, 1, 29, 'Wanaparthy', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(548, 1, 29, 'Kagaznagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(549, 1, 29, 'Gadwal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(550, 1, 29, 'Bellampalle', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(551, 1, 29, 'Bhongir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(552, 1, 29, 'Vikarabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(553, 1, 29, 'Jangaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(554, 1, 29, 'Bhadrachalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(555, 1, 29, 'Bhainsa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(556, 1, 29, 'Farooqnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(557, 1, 29, 'Narayanpet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(558, 1, 29, 'Yellandu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(559, 1, 29, 'Kyathampalle', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL);
INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `city_name`, `city_code`, `is_display`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(560, 1, 29, 'Nagarkurnool', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(561, 1, 30, 'Agartala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(562, 1, 30, 'Udaipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(563, 1, 30, 'Dharmanagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(564, 1, 30, 'Kailasahar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(565, 1, 31, 'Lucknow', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(566, 1, 31, 'Kanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(567, 1, 31, 'Firozabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(568, 1, 31, 'Agra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(569, 1, 31, 'Meerut', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(570, 1, 31, 'Varanasi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(571, 1, 31, 'Allahabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(572, 1, 31, 'Amroha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(573, 1, 31, 'Moradabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(574, 1, 31, 'Aligarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(575, 1, 31, 'Saharanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(576, 1, 31, 'Noida', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(577, 1, 31, 'Loni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(578, 1, 31, 'Jhansi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(579, 1, 31, 'Hapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(580, 1, 31, 'Etawah', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(581, 1, 31, 'Sambhal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(582, 1, 31, 'Orai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(583, 1, 31, 'Bahraich', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(584, 1, 31, 'Unnao', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(585, 1, 31, 'Lakhimpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(586, 1, 31, 'Lalitpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(587, 1, 31, 'Chandausi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(588, 1, 31, 'Hardoi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(589, 1, 31, 'Azamgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(590, 1, 31, 'Khair', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(591, 1, 31, 'Tanda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(592, 1, 31, 'Nagina', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(593, 1, 31, 'Najibabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(594, 1, 31, 'Vrindavan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(595, 1, 31, 'Ujhani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(596, 1, 31, 'Laharpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(597, 1, 31, 'Tilhar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(598, 1, 31, 'Kalpi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(599, 1, 31, 'Tundla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(600, 1, 31, 'Nanpara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(601, 1, 31, 'Nehtaur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(602, 1, 31, 'Thakurdwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(603, 1, 31, 'Nawabganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(604, 1, 31, 'Noorpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(605, 1, 31, 'Thana Bhawan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(606, 1, 31, 'Zaidpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(607, 1, 31, 'Nautanwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(608, 1, 31, 'Zamania', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(609, 1, 31, 'Naugawan Sadat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(610, 1, 31, 'Fatehpur Sikri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(611, 1, 31, 'Utraula', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(612, 1, 31, 'Lar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(613, 1, 31, 'Lal Gopalganj Nindaura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(614, 1, 31, 'Tulsipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(615, 1, 31, 'Tirwaganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(616, 1, 31, 'Warhapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(617, 1, 31, 'Achhnera', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(618, 1, 31, 'Naraura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(619, 1, 31, 'Nakur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(620, 1, 31, 'Lalganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(621, 1, 32, 'Dehradun', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(622, 1, 32, 'Hardwar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(623, 1, 32, 'Haldwani-cum-Kathgodam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(624, 1, 32, 'Kashipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(625, 1, 32, 'Nainital', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(626, 1, 32, 'Tehri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(627, 1, 32, 'Nagla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(628, 1, 33, 'Kolkata', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(629, 1, 33, 'Asansol', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(630, 1, 33, 'Kharagpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(631, 1, 33, 'Naihati', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(632, 1, 33, 'English Bazar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(633, 1, 33, 'Baharampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(634, 1, 33, 'Hugli-Chinsurah', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(635, 1, 33, 'Jalpaiguri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(636, 1, 33, 'Santipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(637, 1, 33, 'Balurghat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(638, 1, 33, 'Habra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(639, 1, 33, 'Bankura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(640, 1, 33, 'Nabadwip', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(641, 1, 33, 'Darjiling', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(642, 1, 33, 'Arambagh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(643, 1, 33, 'Tamluk', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(644, 1, 33, 'AlipurdUrban Agglomeratio', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(645, 1, 33, 'Jhargram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(646, 1, 33, 'Gangarampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(647, 1, 33, 'Kalimpong', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(648, 1, 33, 'Taki', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(649, 1, 33, 'Tarakeswar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(650, 1, 19, 'Parli Vaijnath', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(651, 1, 1, 'Bangalore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(652, 1, 16, 'Pakur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(653, 1, 19, 'Pune', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(654, 1, 31, 'Ballia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(655, 1, 28, 'Tambaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(656, 1, 27, 'Suratgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(657, 1, 27, 'Mount Abu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(658, 1, 1, 'Bidar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(659, 1, 31, 'Ghaziabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(660, 1, 19, 'Chiplun', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(661, 1, 15, 'Srinagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(662, 1, 3, 'Rajahmundry', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(663, 1, 3, 'Proddatur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(664, 1, 3, 'Srikakulam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(665, 1, 3, 'Rajampet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(666, 1, 3, 'Palacole', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(667, 1, 3, 'Sullurpeta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(668, 1, 3, 'Rayachoti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(669, 1, 3, 'Srikalahasti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(670, 1, 3, 'Markapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(671, 1, 3, 'Ponnur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(672, 1, 3, 'Rayadurg', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(673, 1, 3, 'Samalkot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(674, 1, 3, 'Sattenapalle', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(675, 1, 3, 'Pithapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(676, 1, 3, 'Palasa Kasibugga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(677, 1, 3, 'Parvathipuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(678, 1, 3, 'Macherla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(679, 1, 3, 'Salur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(680, 1, 3, 'Mandapeta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(681, 1, 3, 'Peddapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(682, 1, 3, 'Punganur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(683, 1, 3, 'Repalle', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(684, 1, 3, 'Ramachandrapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(685, 1, 3, 'Pedana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(686, 1, 3, 'Puttur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(687, 1, 3, 'Renigunta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(688, 1, 3, 'Rajam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(689, 1, 3, 'Srisailam Project (Right ', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(690, 1, 4, 'Pasighat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(691, 1, 5, 'Silchar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(692, 1, 5, 'Sibsagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(693, 1, 5, 'Mankachar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(694, 1, 5, 'Rangia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(695, 1, 5, 'Margherita', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(696, 1, 5, 'Mangaldoi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(697, 1, 5, 'Silapathar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(698, 1, 5, 'Mariani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(699, 1, 5, 'Marigaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(700, 1, 6, 'Patna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(701, 1, 6, 'Purnia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(702, 1, 6, 'Siwan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(703, 1, 6, 'Sitamarhi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(704, 1, 6, 'Madhubani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(705, 1, 6, 'Masaurhi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(706, 1, 6, 'Samastipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(707, 1, 6, 'Mokameh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(708, 1, 6, 'Supaul', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(709, 1, 6, 'Madhepura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(710, 1, 6, 'Sheikhpura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(711, 1, 6, 'Sultanganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(712, 1, 6, 'Raxaul Bazar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(713, 1, 6, 'Ramnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(714, 1, 6, 'Mahnar Bazar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(715, 1, 6, 'Revelganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(716, 1, 6, 'Rajgir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(717, 1, 6, 'Sonepur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(718, 1, 6, 'Sherghati', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(719, 1, 6, 'Sugauli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(720, 1, 6, 'Makhdumpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(721, 1, 6, 'Maner', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(722, 1, 6, 'Rosera', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(723, 1, 6, 'Piro', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(724, 1, 6, 'Rafiganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(725, 1, 6, 'Marhaura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(726, 1, 6, 'Mirganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(727, 1, 6, 'Murliganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(728, 1, 6, 'Motipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(729, 1, 6, 'Manihari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(730, 1, 6, 'Sheohar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(731, 1, 6, 'Maharajganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(732, 1, 6, 'Silao', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(733, 1, 6, 'Barh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(734, 1, 6, 'Asarganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(735, 1, 8, 'Raipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(736, 1, 8, 'Rajnandgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(737, 1, 8, 'Raigarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(738, 1, 8, 'Mungeli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(739, 1, 8, 'Manendragarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(740, 1, 8, 'Sakti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(741, 1, 12, 'Surat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(742, 1, 12, 'Rajkot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(743, 1, 12, 'Porbandar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(744, 1, 12, 'Patan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(745, 1, 12, 'Mahuva', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(746, 1, 12, 'Savarkundla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(747, 1, 12, 'Sidhpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(748, 1, 12, 'Mangrol', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(749, 1, 12, 'Modasa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(750, 1, 12, 'Palitana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(751, 1, 12, 'Petlad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(752, 1, 12, 'Sihor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(753, 1, 12, 'Mandvi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(754, 1, 12, 'Padra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(755, 1, 12, 'Rajpipla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(756, 1, 12, 'Sanand', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(757, 1, 12, 'Rajula', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(758, 1, 12, 'Radhanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(759, 1, 12, 'Mahemdabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(760, 1, 12, 'Ranavav', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(761, 1, 12, 'Mansa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(762, 1, 12, 'Manavadar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(763, 1, 12, 'Salaya', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(764, 1, 12, 'Pardi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(765, 1, 12, 'Rapar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(766, 1, 12, 'Songadh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(767, 1, 12, 'Adalaj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(768, 1, 13, 'Rohtak', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(769, 1, 13, 'Sonipat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(770, 1, 13, 'Sirsa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(771, 1, 13, 'Rewari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(772, 1, 13, 'Mandi Dabwali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(773, 1, 13, 'Shahbad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(774, 1, 13, 'Pehowa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(775, 1, 13, 'Samalkha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(776, 1, 13, 'Pinjore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(777, 1, 13, 'Sohna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(778, 1, 13, 'Safidon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(779, 1, 13, 'Mahendragarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(780, 1, 13, 'Ratia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(781, 1, 13, 'Rania', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(782, 1, 13, 'Sarsod', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(783, 1, 14, 'Shimla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(784, 1, 14, 'Mandi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(785, 1, 14, 'Solan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(786, 1, 14, 'Sundarnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(787, 1, 14, 'Palampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(788, 1, 15, 'Srinagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(789, 1, 15, 'Sopore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(790, 1, 15, 'Rajauri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(791, 1, 15, 'Poonch', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(792, 1, 16, 'Ranchi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(793, 1, 16, 'Phusro', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(794, 1, 16, 'Ramgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(795, 1, 16, 'Saunda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(796, 1, 16, 'Sahibganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(797, 1, 16, 'Madhupur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(798, 1, 16, 'Pakaur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(799, 1, 16, 'Simdega', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(800, 1, 16, 'Musabani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(801, 1, 16, 'Mihijam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(802, 1, 16, 'Patratu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(803, 1, 1, 'Shivamogga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(804, 1, 1, 'Raayachuru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(805, 1, 1, 'Robertson Pet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(806, 1, 1, 'Ranebennuru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(807, 1, 1, 'Ranibennur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(808, 1, 1, 'Ramanagaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(809, 1, 1, 'Rabkavi Banhatti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(810, 1, 1, 'Shahabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(811, 1, 1, 'Sirsi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(812, 1, 1, 'Sindhnur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(813, 1, 1, 'Sagara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(814, 1, 1, 'Sira', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(815, 1, 1, 'Puttur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(816, 1, 1, 'Mulbagal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(817, 1, 1, 'Surapura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(818, 1, 1, 'Siruguppa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(819, 1, 1, 'Mudhol', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(820, 1, 1, 'Sidlaghatta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(821, 1, 1, 'Shahpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(822, 1, 1, 'Saundatti-Yellamma', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(823, 1, 1, 'Manvi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(824, 1, 1, 'Ramdurg', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(825, 1, 1, 'Malavalli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(826, 1, 1, 'Savanur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(827, 1, 1, 'Sankeshwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(828, 1, 1, 'Madikeri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(829, 1, 1, 'Sedam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(830, 1, 1, 'Shikaripur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(831, 1, 1, 'Mahalingapura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(832, 1, 1, 'Mudalagi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(833, 1, 1, 'Muddebihal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(834, 1, 1, 'Pavagada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(835, 1, 1, 'Malur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(836, 1, 1, 'Sindhagi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(837, 1, 1, 'Sanduru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(838, 1, 1, 'Maddur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(839, 1, 1, 'Madhugiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(840, 1, 1, 'Mudabidri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(841, 1, 1, 'Magadi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(842, 1, 1, 'Shiggaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(843, 1, 1, 'Shrirangapattana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(844, 1, 1, 'Sindagi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(845, 1, 1, 'Sakaleshapura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(846, 1, 1, 'Srinivaspur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(847, 1, 1, 'Ron', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(848, 1, 1, 'Mundargi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(849, 1, 1, 'Sadalagi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(850, 1, 1, 'Piriyapatna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(851, 1, 1, 'Adyar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(852, 1, 17, 'Palakkad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(853, 1, 17, 'Ponnani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(854, 1, 17, 'Punalur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(855, 1, 17, 'Perinthalmanna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(856, 1, 17, 'Mattannur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(857, 1, 17, 'Shoranur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(858, 1, 17, 'Paravoor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(859, 1, 17, 'Pathanamthitta', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(860, 1, 17, 'Peringathur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(861, 1, 17, 'Pappinisseri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(862, 1, 17, 'Muvattupuzha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(863, 1, 17, 'Mavelikkara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(864, 1, 17, 'Mavoor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(865, 1, 17, 'Perumbavoor', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(866, 1, 17, 'Palai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(867, 1, 17, 'Panniyannur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(868, 1, 17, 'Puthuppally', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(869, 1, 17, 'Panamattom', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(870, 1, 18, 'Sagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(871, 1, 18, 'Ratlam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(872, 1, 18, 'Satna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(873, 1, 18, 'Singrauli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(874, 1, 18, 'Rewa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(875, 1, 18, 'Shivpuri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(876, 1, 18, 'Sarni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(877, 1, 18, 'Sehore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(878, 1, 18, 'Mhow Cantonment', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(879, 1, 18, 'Seoni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(880, 1, 18, 'Shahdol', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(881, 1, 18, 'Pithampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(882, 1, 18, 'Mandla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(883, 1, 18, 'Sheopur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(884, 1, 18, 'Shajapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(885, 1, 18, 'Panna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(886, 1, 18, 'Raghogarh-Vijaypur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(887, 1, 18, 'Sendhwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(888, 1, 18, 'Sidhi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(889, 1, 18, 'Pipariya', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(890, 1, 18, 'Shujalpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(891, 1, 18, 'Sironj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(892, 1, 18, 'Pandhurna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(893, 1, 18, 'Mandideep', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(894, 1, 18, 'Sihora', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(895, 1, 18, 'Raisen', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(896, 1, 18, 'Maihar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(897, 1, 18, 'Sanawad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(898, 1, 18, 'Sabalgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(899, 1, 18, 'Porsa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(900, 1, 18, 'Malaj Khand', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(901, 1, 18, 'Sarangpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(902, 1, 18, 'Mundi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(903, 1, 18, 'Pasan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(904, 1, 18, 'Mahidpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(905, 1, 18, 'Seoni-Malwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(906, 1, 18, 'Rehli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(907, 1, 18, 'Manawar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(908, 1, 18, 'Rahatgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(909, 1, 18, 'Panagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(910, 1, 18, 'Sausar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(911, 1, 18, 'Rajgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(912, 1, 18, 'Mauganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(913, 1, 18, 'Manasa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(914, 1, 18, 'Prithvipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(915, 1, 18, 'Sohagpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(916, 1, 18, 'Shamgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(917, 1, 18, 'Maharajpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(918, 1, 18, 'Multai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(919, 1, 18, 'Pachore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(920, 1, 18, 'Rau', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(921, 1, 18, 'Mhowgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(922, 1, 18, 'Vijaypur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(923, 1, 19, 'Solapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(924, 1, 19, 'Sangli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(925, 1, 19, 'Parbhani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(926, 1, 19, 'Panvel', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(927, 1, 19, 'Satara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(928, 1, 19, 'Pandharpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(929, 1, 19, 'Shrirampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(930, 1, 19, 'Parli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(931, 1, 19, 'Manmad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(932, 1, 19, 'Ratnagiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(933, 1, 19, 'Pusad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(934, 1, 19, 'Sangamner', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(935, 1, 19, 'Shirpur-Warwade', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(936, 1, 19, 'Malkapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(937, 1, 19, 'Palghar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(938, 1, 19, 'Shegaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(939, 1, 19, 'Phaltan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(940, 1, 19, 'Shahade', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(941, 1, 19, 'Pachora', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(942, 1, 19, 'Manjlegaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(943, 1, 19, 'Sillod', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(944, 1, 19, 'Sailu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(945, 1, 19, 'Murtijapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(946, 1, 19, 'Mehkar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(947, 1, 19, 'Pulgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(948, 1, 19, 'Paithan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(949, 1, 19, 'Rahuri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(950, 1, 19, 'Morshi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(951, 1, 19, 'Purna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(952, 1, 19, 'Satana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(953, 1, 19, 'Pathri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(954, 1, 19, 'Sinnar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(955, 1, 19, 'Pen', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(956, 1, 19, 'Manwath', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(957, 1, 19, 'Partur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(958, 1, 19, 'Sangole', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(959, 1, 19, 'Mangrulpir', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(960, 1, 19, 'Risod', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(961, 1, 19, 'Shirur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(962, 1, 19, 'Savner', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(963, 1, 19, 'Sasvad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(964, 1, 19, 'Pandharkaoda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(965, 1, 19, 'Shrigonda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(966, 1, 19, 'Shirdi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(967, 1, 19, 'Raver', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(968, 1, 19, 'Mukhed', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(969, 1, 19, 'Rajura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(970, 1, 19, 'Mahad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(971, 1, 19, 'Sawantwadi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(972, 1, 19, 'Pathardi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(973, 1, 19, 'Pauni', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(974, 1, 19, 'Ramtek', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(975, 1, 19, 'Mul', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(976, 1, 19, 'Soyagaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(977, 1, 19, 'Mangalvedhe', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(978, 1, 19, 'Shendurjana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(979, 1, 19, 'Patur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(980, 1, 19, 'Mhaswad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(981, 1, 19, 'Nandgaon', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(982, 1, 19, 'Warud', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(983, 1, 20, 'Mayang Imphal', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(984, 1, 21, 'Shillong', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(985, 1, 22, 'Saiha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(986, 1, 23, 'Mokokchung', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(987, 1, 24, 'Raurkela', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(988, 1, 24, 'Puri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(989, 1, 24, 'Paradip', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(990, 1, 24, 'Sunabeda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(991, 1, 24, 'Rayagada', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(992, 1, 24, 'Rajagangapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(993, 1, 24, 'Parlakhemundi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(994, 1, 24, 'Sundargarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(995, 1, 24, 'Phulabani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(996, 1, 24, 'Pattamundai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(997, 1, 24, 'Soro', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(998, 1, 24, 'Malkangiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(999, 1, 24, 'Rairangpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1000, 1, 24, 'Tarbha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1001, 1, 25, 'Pondicherry', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1002, 1, 25, 'Mahe', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1003, 1, 26, 'Patiala', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1004, 1, 26, 'Pathankot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1005, 1, 26, 'Mohali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1006, 1, 26, 'Phagwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1007, 1, 26, 'Muktsar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1008, 1, 26, 'Rajpura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1009, 1, 26, 'Sangrur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1010, 1, 26, 'Mansa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1011, 1, 26, 'Malout', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1012, 1, 26, 'Sunam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1013, 1, 26, 'Sirhind Fatehgarh Sahib', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1014, 1, 26, 'Rupnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1015, 1, 26, 'Samana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1016, 1, 26, 'Rampura Phul', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1017, 1, 26, 'Patti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1018, 1, 26, 'Raikot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1019, 1, 26, 'Morinda, India', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1020, 1, 26, 'Phillaur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1021, 1, 26, 'Pattran', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1022, 1, 26, 'Sujanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1023, 1, 26, 'Mukerian', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1024, 1, 26, 'Talwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1025, 1, 27, 'Sikar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1026, 1, 27, 'Sadulpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1027, 1, 27, 'Sawai Madhopur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1028, 1, 27, 'Makrana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1029, 1, 27, 'Sujangarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1030, 1, 27, 'Sardarshahar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1031, 1, 27, 'Ratangarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1032, 1, 27, 'Rajsamand', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1033, 1, 27, 'Rajgarh (Churu)', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1034, 1, 27, 'Phalodi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1035, 1, 27, 'Pilani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1036, 1, 27, 'Merta City', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1037, 1, 27, 'Sojat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1038, 1, 27, 'Sirohi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1039, 1, 27, 'Pratapgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1040, 1, 27, 'Rawatbhata', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1041, 1, 27, 'Sangaria', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1042, 1, 27, 'Pilibanga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1043, 1, 27, 'Pipar City', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1044, 1, 27, 'Sumerpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1045, 1, 27, 'Sagwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1046, 1, 27, 'Ramganj Mandi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1047, 1, 27, 'Sri Madhopur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1048, 1, 27, 'Ramngarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1049, 1, 27, 'Rawatsar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1050, 1, 27, 'Rajakhera', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1051, 1, 27, 'Shahpura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1052, 1, 27, 'Shahpura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1053, 1, 27, 'Raisinghnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1054, 1, 27, 'Malpura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1055, 1, 27, 'Sanchore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1056, 1, 27, 'Rajgarh (Alwar)', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1057, 1, 27, 'Sheoganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1058, 1, 27, 'Sadri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1059, 1, 27, 'Reengus', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1060, 1, 27, 'Rajaldesar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1061, 1, 27, 'Sadulshahar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1062, 1, 27, 'Sambhar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1063, 1, 27, 'Prantij', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1064, 1, 27, 'Mangrol', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1065, 1, 27, 'Phulera', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1066, 1, 27, 'Mandawa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1067, 1, 27, 'Pindwara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1068, 1, 27, 'Mandalgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1069, 1, 27, 'Takhatgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1070, 1, 28, 'Ranipet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1071, 1, 28, 'Pollachi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1072, 1, 28, 'Rajapalayam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1073, 1, 28, 'Sivakasi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1074, 1, 28, 'Pudukkottai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1075, 1, 28, 'Paramakudi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1076, 1, 28, 'Srivilliputhur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1077, 1, 28, 'Palani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1078, 1, 28, 'Pattukkottai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1079, 1, 28, 'Ramanathapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1080, 1, 28, 'Panruti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1081, 1, 28, 'Rasipuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1082, 1, 28, 'Periyakulam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1083, 1, 28, 'Pernampattu', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1084, 1, 28, 'Sivaganga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1085, 1, 28, 'Rameshwaram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1086, 1, 28, 'Perambalur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1087, 1, 28, 'Sathyamangalam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1088, 1, 28, 'Puliyankudi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1089, 1, 28, 'Sirkali', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1090, 1, 28, 'Periyasemur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1091, 1, 28, 'Sattur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1092, 1, 28, 'Palladam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1093, 1, 28, 'Surandai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1094, 1, 28, 'Sankari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1095, 1, 28, 'Shenkottai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1096, 1, 28, 'Sholingur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1097, 1, 28, 'Manachanallur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1098, 1, 28, 'Polur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1099, 1, 28, 'Panagudi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1100, 1, 28, 'Pallapatti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1101, 1, 28, 'Ponneri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1102, 1, 28, 'P.N.Patti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1103, 1, 28, 'Pacode', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1104, 1, 28, 'Suriyampalayam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1105, 1, 28, 'Sholavandan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1106, 1, 28, 'Peravurani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1107, 1, 28, 'Parangipettai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1108, 1, 28, 'Pudupattinam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1109, 1, 28, 'Pallikonda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1110, 1, 28, 'Sivagiri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1111, 1, 28, 'Punjaipugalur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1112, 1, 28, 'Padmanabhapuram', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1113, 1, 28, 'Thirupuvanam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1114, 1, 29, 'Ramagundam', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1115, 1, 29, 'Mancherial', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1116, 1, 29, 'Suryapet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1117, 1, 29, 'Miryalaguda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL);
INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `city_name`, `city_code`, `is_display`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1118, 1, 29, 'Palwancha', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1119, 1, 29, 'Mandamarri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1120, 1, 29, 'Sircilla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1121, 1, 29, 'Siddipet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1122, 1, 29, 'Sangareddy', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1123, 1, 29, 'Medak', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1124, 1, 29, 'Sadasivpet', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1125, 1, 29, 'Manuguru', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1126, 1, 30, 'Pratapgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1127, 1, 30, 'Belonia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1128, 1, 30, 'Khowai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1129, 1, 31, 'Shahjahanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1130, 1, 31, 'Rampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1131, 1, 31, 'Modinagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1132, 1, 31, 'Rae Bareli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1133, 1, 31, 'Sitapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1134, 1, 31, 'Pilibhit', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1135, 1, 31, 'Hardoi ', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1136, 1, 31, 'Sultanpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1137, 1, 31, 'Shamli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1138, 1, 31, 'Shikohabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1139, 1, 31, 'Sikandrabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1140, 1, 31, 'Shahabad, Hardoi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1141, 1, 31, 'Pilkhuwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1142, 1, 31, 'Renukoot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1143, 1, 31, 'Sahaswan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1144, 1, 31, 'Rath', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1145, 1, 31, 'Sherkot', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1146, 1, 31, 'Sandila', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1147, 1, 31, 'Sardhana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1148, 1, 31, 'Seohara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1149, 1, 31, 'Padrauna', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1150, 1, 31, 'Mathura', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1151, 1, 31, 'Siana', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1152, 1, 31, 'Sikandra Rao', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1153, 1, 31, 'Puranpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1154, 1, 31, 'Rudauli', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1155, 1, 31, 'Palia Kalan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1156, 1, 31, 'Shikarpur, Bulandshahr', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1157, 1, 31, 'Shahabad, Rampur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1158, 1, 31, 'Robertsganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1159, 1, 31, 'Sadabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1160, 1, 31, 'Rasra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1161, 1, 31, 'Sirsaganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1162, 1, 31, 'Pihani', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1163, 1, 31, 'Shamsabad, Agra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1164, 1, 31, 'Rudrapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1165, 1, 31, 'Soron', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1166, 1, 31, 'SUrban Agglomerationr', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1167, 1, 31, 'Samdhan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1168, 1, 31, 'Sahjanwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1169, 1, 31, 'Rampur Maniharan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1170, 1, 31, 'Sumerpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1171, 1, 31, 'Shahganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1172, 1, 31, 'PurqUrban Agglomerationzi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1173, 1, 31, 'Shamsabad, Farrukhabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1174, 1, 31, 'Powayan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1175, 1, 31, 'Sandi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1176, 1, 31, 'Sahaspur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1177, 1, 31, 'Safipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1178, 1, 31, 'Reoti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1179, 1, 31, 'Sikanderpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1180, 1, 31, 'Saidpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1181, 1, 31, 'Sirsi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1182, 1, 31, 'Purwa', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1183, 1, 31, 'Parasi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1184, 1, 31, 'Phulpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1185, 1, 31, 'Shishgarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1186, 1, 31, 'Sahawar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1187, 1, 31, 'Samthar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1188, 1, 31, 'Pukhrayan', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1189, 1, 31, 'Obra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1190, 1, 31, 'Niwai', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1191, 1, 32, 'Srinagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1192, 1, 32, 'Roorkee', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1193, 1, 32, 'Rudrapur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1194, 1, 32, 'Rishikesh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1195, 1, 32, 'Ramnagar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1196, 1, 32, 'Pithoragarh', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1197, 1, 32, 'Manglaur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1198, 1, 32, 'Mussoorie', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1199, 1, 32, 'Pauri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1200, 1, 32, 'Sitarganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1201, 1, 32, 'Bageshwar', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1202, 1, 33, 'Siliguri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1203, 1, 33, 'Raghunathganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1204, 1, 33, 'Raiganj', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1205, 1, 33, 'Medinipur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1206, 1, 33, 'Ranaghat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1207, 1, 33, 'Purulia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1208, 1, 33, 'AlipurdUrban Agglomeratio', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1209, 1, 33, 'Suri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1210, 1, 33, 'Rampurhat', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1211, 1, 33, 'Sainthia', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1212, 1, 33, 'Murshidabad', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1213, 1, 33, 'Memari', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1214, 1, 33, 'Paschim Punropara', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1215, 1, 33, 'Sonamukhi', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1216, 1, 33, 'PandUrban Agglomeration', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1217, 1, 33, 'Mainaguri', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1218, 1, 33, 'Malda', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1219, 1, 33, 'Panchla', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1220, 1, 33, 'Raghunathpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1221, 1, 33, 'Mathabhanga', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1222, 1, 33, 'Monoharpur', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1223, 1, 33, 'Srirampore', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1224, 1, 33, 'Adra', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL),
(1225, 1, 31, 'Shravasti', '', 1, '0000-00-00 00:00:00', 1, NULL, NULL, 1, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `company_profile_id` int(11) NOT NULL,
  `company_unique_name` varchar(1200) NOT NULL,
  `company_name` varchar(1200) NOT NULL,
  `company_email` varchar(500) DEFAULT NULL,
  `company_website` varchar(500) DEFAULT NULL,
  `letterhead_header_image` varchar(255) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) DEFAULT NULL,
  `address3` varchar(500) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `alt_mobile_no` varchar(50) DEFAULT NULL,
  `gst_no` varchar(15) DEFAULT NULL,
  `user_image` varchar(250) DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`company_profile_id`, `company_unique_name`, `company_name`, `company_email`, `company_website`, `letterhead_header_image`, `name`, `first_name`, `last_name`, `email`, `logo`, `country_id`, `state_id`, `city_id`, `address1`, `address2`, `address3`, `pincode`, `mobile_no`, `alt_mobile_no`, `gst_no`, `user_image`, `added_by`, `added_on`, `updated_by`, `updated_on`, `status`) VALUES
(1, 'A Travellers Mind', 'A Travelers Mind', 'info@atravelersmind.in', 'www.atravelersmind.in', 'letterhead_1.jpg', 'Krishna', 'Krishna', '', 'info@atravelersmind.in', 'logo_1.jpg', 1, 1, 8, 'Tumkuru', '', '', '502101', '9666364912', '', '29AASFM3822G1ZY', NULL, 1, '2022-11-21 15:17:21', 1, '2024-08-12 17:51:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_short_name` varchar(255) NOT NULL,
  `dial_code` varchar(255) NOT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `country_short_name`, `dial_code`, `country_code`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'India', 'IN', '0', '91', '2022-11-21 20:26:13', 1, '2023-01-06 10:46:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `currency_name` varchar(500) NOT NULL,
  `currency_code` varchar(500) NOT NULL,
  `currency_rate` varchar(100) NOT NULL,
  `symbol` varchar(225) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `defaults` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `country_id`, `currency_name`, `currency_code`, `currency_rate`, `symbol`, `added_on`, `updated_on`, `added_by`, `updated_by`, `status`, `defaults`) VALUES
(1, 1, 'Indian Rupee', 'INR', '1', '<i class=\'fa fa-inr\'></i>', '2019-01-31 11:15:18', '2019-10-26 17:36:12', 1, 1, 1, 1),
(2, 1, 'US Dollar', 'USD', '0.014', '$', '2019-01-31 11:47:06', '2019-10-26 17:36:45', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `datewise_shift_timing`
--

CREATE TABLE `datewise_shift_timing` (
  `datewise_shift_timing_id` int(11) NOT NULL,
  `user_employee_id` int(11) NOT NULL,
  `day_type` tinyint(4) DEFAULT 1,
  `date` date NOT NULL,
  `expected_login_time` time DEFAULT NULL,
  `expected_logout_time` time DEFAULT NULL,
  `expected_total_worked_time` time DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE `department_master` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`department_id`, `department_name`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1, 'Sales', 1, '2024-07-13 18:38:39', NULL, '2024-07-13 18:46:44', 1, '0', NULL, NULL),
(2, 'Marketing', 1, '2024-07-16 13:07:31', 1, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designation_master`
--

CREATE TABLE `designation_master` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation_master`
--

INSERT INTO `designation_master` (`designation_id`, `designation_name`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'Product Manager', '2022-11-21 20:27:11', 1, NULL, NULL, 1),
(2, 'Store Manager', '2024-06-19 12:32:44', 1, NULL, NULL, 1),
(3, 'Sales', '2024-06-26 16:38:52', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `document_name`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1, 'AADHAR', '1', '2024-08-01 16:49:34', 1, NULL, NULL, '0', NULL, NULL),
(2, 'PAN', '1', '2024-08-01 16:49:42', 1, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_log`
--

CREATE TABLE `email_log` (
  `id` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `template` longtext NOT NULL,
  `to` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `response` longtext DEFAULT NULL,
  `error_info` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_log`
--

INSERT INTO `email_log` (`id`, `subject`, `template`, `to`, `added_on`, `status`, `response`, `error_info`) VALUES
(1, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/1XI34UBYEKNR\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 16:58:32', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(2, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/G8MFWHAX1SM6\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 17:05:13', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(3, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/DYRLUWTHJSBJ\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 17:06:24', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(4, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/5KWMZUIF4HQQ\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 17:13:58', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(5, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/XZUPJ3ES3KY8\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 17:19:29', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(6, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/JV42116E3ADG\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 17:23:25', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(7, 'User Forgot Password on BPIT', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/FUN5WBY5DZC6\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 17:38:25', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(8, 'User Forgot Password on ATM', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/VVQGQ7HFRJMM\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 18:32:06', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(9, 'User Forgot Password on ATM', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/YW26J95DAFT8\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-07-20 18:55:57', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', ''),
(10, 'User Forgot Password on ATM', '<html>\r\n\r\n	<head>\r\n	<title>\"Forgot Password for BSNL, POSTAL & IT EMPLOYEES HBCS Ltd\"</title>\r\n	</head>\r\n	<body style=\"width:100%; font-family:Arial; font-size:13px; line-height:22px; background:#fff;  position:relative;color:#555555; margin:0px; padding:0px;\">\r\n	  	<div style=\"margin:0 auto; width:600px;\">\r\n<div style=\"background-color: #5f9116;; width:594px; float:left; padding:0px 3px 3px 3px; border:#5f9116 3px solid;\" >\r\n	<div style=\"padding:27px; width:540px; border-bottom:#5f9116 3px solid;\">\r\n    	<a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/\" target=\"_blank\" style=\"font-size:13px; color:#839ecd;text-decoration:none; text-align:center;\">\r\n    	<img src=\"http://localhost/xampp/MARS/atm_v100/secureRegions//admin/images/email-logo.png\" alt=\"\" /></a>\r\n\r\n    </div>\r\n    <div style=\"background:#fff; padding:44px 34px; width:526px; float:left;\">\r\n    <h1 style=\"color:#d95451; font-size:24px; font-family:Arial; font-weight:normal; margin-bottom:20px;\">Reset Password Link</h1>\r\n    <p style=\"margin-bottom:20px;\">\r\nIf you want to reset your password, click here the following link</p>\r\n <p style=\"margin-bottom:10px;\"><a href=\"http://localhost/xampp/MARS/atm_v100/secureRegions/admin_reset_password/2FKBDKDC2BAP\">Reset Password</a></p>\r\n    </div>\r\n</div>\r\n</div>\r\n\r\n	</body>\r\n	</html>\r\n', 'ramkumarsgurav@gmail.com', '2024-08-09 16:02:52', 1, 'error | 124 | Validity of your SMS pack has expired on \"%s\". You are not allowed to send messages now.\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `tour_date_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contactno` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiry_id`, `tour_id`, `tour_date_id`, `name`, `contactno`, `email`, `subject`, `description`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1, 24, 8, 'ram', '1236547891', 'ram@gmail.com', 'enquiery', 'enquiry description ;asdh f;ashdhf ;asl lsakjdf ;ASLD', '1', '2024-06-24 11:27:58', NULL, '2024-06-24 11:47:52', NULL, '0', NULL, NULL),
(2, 24, 9, 'sham edited', '165487984340', 'shamedited@gmail.com', 'booking enquiry edited', 'edited  sham ;kljdaf a;lskdjjf ;laskdfj a;lsdfjk a;lsdfj a;lsdfjk ;alsfkdj a;sldkfj as;ldfkj a;lsdfkj a;lfdkj', '1', '2024-06-24 11:27:58', NULL, '2024-06-24 12:44:14', 1, '0', NULL, NULL),
(18, 24, 8, 'asdf', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 14:47:12', NULL, NULL, NULL, '0', NULL, NULL),
(21, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'enquiry 2', '1', '2024-06-24 15:12:20', NULL, NULL, NULL, '0', NULL, NULL),
(22, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'safdf', '1', '2024-06-24 15:14:16', NULL, NULL, NULL, '0', NULL, NULL),
(23, 24, 9, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 15:16:05', NULL, NULL, NULL, '0', NULL, NULL),
(24, 24, 9, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 15:16:11', NULL, NULL, NULL, '0', NULL, NULL),
(25, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 15:16:21', NULL, NULL, NULL, '0', NULL, NULL),
(26, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 15:16:23', NULL, NULL, NULL, '0', NULL, NULL),
(27, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 15:16:46', NULL, NULL, NULL, '0', NULL, NULL),
(28, 24, 8, 'sham', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'enuqiry4', '1', '2024-06-24 15:17:26', NULL, NULL, NULL, '0', NULL, NULL),
(29, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdfd', '1', '2024-06-24 15:27:38', NULL, NULL, NULL, '0', NULL, NULL),
(30, 24, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-24 15:30:07', NULL, NULL, NULL, '0', NULL, NULL),
(31, 24, 8, 'sham', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'hi', '1', '2024-06-26 10:45:58', NULL, NULL, NULL, '0', NULL, NULL),
(32, 24, 9, 'gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdfasdf', '1', '2024-06-26 10:47:37', NULL, NULL, NULL, '0', NULL, NULL),
(33, 24, 9, 'sham', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdfasdf', '1', '2024-06-26 10:50:27', NULL, NULL, NULL, '0', NULL, NULL),
(34, 24, 9, 'sham', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdfasdf', '1', '2024-06-26 10:51:35', NULL, NULL, NULL, '0', NULL, NULL),
(35, 24, 8, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asd', '1', '2024-06-26 10:53:27', NULL, NULL, NULL, '0', NULL, NULL),
(36, 24, 8, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asd', '1', '2024-06-26 10:55:38', NULL, NULL, NULL, '0', NULL, NULL),
(37, 24, 9, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asd', '1', '2024-06-26 10:55:48', NULL, NULL, NULL, '0', NULL, NULL),
(38, 24, 9, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 10:57:35', NULL, NULL, NULL, '0', NULL, NULL),
(39, 24, 9, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 10:58:23', NULL, NULL, NULL, '0', NULL, NULL),
(40, 24, 9, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 10:58:27', NULL, NULL, NULL, '0', NULL, NULL),
(41, 24, 9, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 10:59:15', NULL, NULL, NULL, '0', NULL, NULL),
(42, 24, 9, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf adsf', '1', '2024-06-26 11:01:28', NULL, NULL, NULL, '0', NULL, NULL),
(43, 24, 8, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 11:11:21', NULL, NULL, NULL, '0', NULL, NULL),
(44, 24, 8, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 11:11:26', NULL, NULL, NULL, '0', NULL, NULL),
(45, 24, 8, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf asdf', '1', '2024-06-26 11:11:53', NULL, NULL, NULL, '0', NULL, NULL),
(46, 24, 8, 'asdf', 'asdf', 'sadf', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 11:14:33', NULL, NULL, NULL, '0', NULL, NULL),
(47, 24, 8, 'ramkumar gurav', '8549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 11:15:29', NULL, NULL, NULL, '0', NULL, NULL),
(48, 0, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asfd', '1', '2024-06-26 12:19:49', NULL, NULL, NULL, '0', NULL, NULL),
(49, 0, 18, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 12:32:44', NULL, NULL, NULL, '0', NULL, NULL),
(50, 0, 8, 'ramkumar gurav', '08549065626', 'ramkumarsgurav@gmail.com', 'upcoming adventures booking', 'asdf', '1', '2024-06-26 12:33:32', NULL, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_year`
--

CREATE TABLE `fiscal_year` (
  `fiscal_year_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `short_start` int(11) NOT NULL,
  `short_end` int(11) NOT NULL,
  `financial_year` varchar(255) NOT NULL,
  `short_financial_year` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fiscal_year`
--

INSERT INTO `fiscal_year` (`fiscal_year_id`, `start`, `end`, `short_start`, `short_end`, `financial_year`, `short_financial_year`) VALUES
(1, 2022, 2023, 22, 23, '2023', '22-23'),
(2, 2022, 2023, 22, 23, '2022', '22-23'),
(3, 2023, 2024, 23, 24, '2024', '23-24');

-- --------------------------------------------------------

--
-- Table structure for table `ip_address`
--

CREATE TABLE `ip_address` (
  `ip_address_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ip_address`
--

INSERT INTO `ip_address` (`ip_address_id`, `ip_address`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(8, '250.11.255.255', '1', '2024-07-24 16:08:28', 1, NULL, NULL, '0', NULL, NULL),
(9, '192.168.1.33', '1', '2024-07-24 16:14:56', 1, '2024-07-30 18:20:56', 1, '0', NULL, NULL),
(10, '::1', '1', '2024-07-24 16:14:56', 1, '2024-07-30 18:20:33', 1, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_master`
--

CREATE TABLE `module_master` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(500) NOT NULL,
  `is_master` int(11) NOT NULL,
  `parent_module_id` int(11) NOT NULL,
  `class_name` varchar(500) DEFAULT NULL,
  `function_name` varchar(500) DEFAULT NULL,
  `count_function_name` varchar(200) DEFAULT NULL,
  `is_company_profile_id` int(11) NOT NULL DEFAULT 0 COMMENT 'count according to company_profile_id 1=yes , 0=no',
  `direct_db_count` int(11) DEFAULT NULL,
  `table_name` varchar(500) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `is_display` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `icon` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_master`
--

INSERT INTO `module_master` (`module_id`, `module_name`, `is_master`, `parent_module_id`, `class_name`, `function_name`, `count_function_name`, `is_company_profile_id`, `direct_db_count`, `table_name`, `position`, `added_on`, `is_display`, `status`, `icon`) VALUES
(1, 'Role Manager', 1, 0, 'master/Role-Manager-Module', 'role-manager-list', '', 0, 1, 'users_role_master', 4, '2020-04-20 12:44:42', 1, 1, NULL),
(2, 'Country', 1, 0, 'master/Country-Module', 'country-list', '', 0, 1, 'country', 5, '2020-04-20 12:44:42', 1, 1, NULL),
(3, 'State', 1, 0, 'master/State-Module', 'state-list', '', 0, 1, 'state', 6, '2020-04-20 12:44:42', 1, 1, NULL),
(4, 'City', 1, 0, 'master/City-Module', 'city-list', '', 0, 1, 'city', 7, '2020-04-20 12:44:42', 1, 1, NULL),
(7, 'Designation', 1, 0, 'master/Designation-Module', 'designation-list', '', 0, 1, 'designation_master', 3, '2020-04-20 12:44:42', 1, 1, NULL),
(12, 'Employee', 2, 0, 'human_resource/Employee-Module', 'employee-list', '', 0, 1, 'admin_user', 11, '2022-03-11 00:00:00', 1, 1, NULL),
(14, 'Company Profile', 3, 0, 'company_profile/Company-Profile-Module', 'company-profile-list', '', 0, 1, 'company_profile', 100, '2020-04-20 12:44:42', 1, 1, NULL),
(196, 'Enquiry', 5, 0, 'enquiry/Enquiry-Module', 'listings', '', 0, 1, 'enquiry', 4, '2020-04-20 12:44:42', 1, 1, NULL),
(6, 'Department', 1, 0, 'master/Department-Module', 'department-list', '', 0, 1, 'department_master', 2, '2020-04-20 12:44:42', 1, 1, NULL),
(205, 'Attendance', 11, 0, 'user_employee/Attendance-Module', 'attendance-list', '', 0, 1, 'attendance', 2, '2020-04-20 12:44:42', 1, 1, NULL),
(201, 'Branches', 1, 0, 'master/Branch-Module', 'branch-list', '', 0, 1, 'branch', 1, '2020-04-20 12:44:42', 1, 1, NULL),
(202, 'User Employees', 11, 0, 'user_employee/User-Employee-Module', 'listings', '', 0, 1, 'user_employee', 8, '2020-04-20 12:44:42', 1, 1, NULL),
(203, 'IP Addressess', 1, 0, 'master/Ip-Address-Module', 'ip_address_list', '', 0, 1, 'ip_address', 1, '2020-04-20 12:44:42', 1, 1, NULL),
(207, 'Documents', 1, 0, 'master/Document-Module', 'document-list', '', 0, 1, 'document', 1, '2024-04-20 12:44:42', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_permissions`
--

CREATE TABLE `module_permissions` (
  `permission_id` bigint(20) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `view_module` tinyint(4) NOT NULL,
  `add_module` tinyint(4) NOT NULL,
  `update_module` tinyint(4) NOT NULL,
  `delete_module` tinyint(4) NOT NULL,
  `approval_module` tinyint(4) NOT NULL DEFAULT 0,
  `import_data` tinyint(4) NOT NULL,
  `export_data` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_permissions`
--

INSERT INTO `module_permissions` (`permission_id`, `module_id`, `user_role_id`, `view_module`, `add_module`, `update_module`, `delete_module`, `approval_module`, `import_data`, `export_data`) VALUES
(196, 44, 1, 1, 1, 1, 0, 0, 1, 1),
(195, 193, 1, 1, 1, 1, 0, 0, 1, 1),
(194, 192, 1, 1, 1, 1, 0, 0, 1, 1),
(193, 25, 1, 1, 1, 1, 0, 0, 1, 1),
(192, 24, 1, 1, 1, 1, 0, 0, 1, 1),
(191, 23, 1, 1, 1, 1, 0, 0, 1, 1),
(190, 22, 1, 1, 1, 1, 0, 0, 1, 1),
(189, 21, 1, 1, 1, 1, 0, 0, 1, 1),
(188, 20, 1, 1, 1, 1, 0, 0, 1, 1),
(187, 19, 1, 1, 1, 1, 0, 0, 1, 1),
(186, 10, 1, 1, 1, 1, 0, 0, 1, 1),
(185, 18, 1, 1, 1, 1, 0, 0, 1, 1),
(184, 16, 1, 1, 1, 1, 0, 0, 1, 1),
(183, 17, 1, 1, 1, 1, 0, 0, 1, 1),
(182, 15, 1, 1, 1, 1, 0, 0, 1, 1),
(16, 9, 3, 1, 1, 1, 0, 0, 0, 0),
(17, 15, 3, 1, 1, 1, 0, 0, 0, 0),
(18, 17, 3, 1, 1, 1, 0, 0, 0, 0),
(19, 16, 3, 1, 1, 1, 0, 0, 0, 0),
(181, 14, 1, 1, 1, 1, 0, 0, 1, 1),
(180, 13, 1, 1, 1, 1, 0, 0, 1, 1),
(179, 11, 1, 1, 1, 1, 0, 0, 1, 1),
(178, 8, 1, 1, 1, 1, 0, 0, 1, 1),
(177, 9, 1, 1, 1, 1, 0, 0, 1, 1),
(176, 12, 1, 1, 1, 1, 0, 0, 1, 1),
(175, 7, 1, 1, 1, 1, 0, 0, 1, 1),
(174, 6, 1, 1, 1, 1, 0, 0, 1, 1),
(173, 5, 1, 1, 1, 1, 0, 0, 1, 1),
(172, 4, 1, 1, 1, 1, 0, 0, 1, 1),
(171, 3, 1, 1, 1, 1, 0, 0, 1, 1),
(170, 2, 1, 1, 1, 1, 0, 0, 1, 1),
(169, 1, 1, 1, 1, 1, 0, 0, 1, 1),
(197, 194, 1, 1, 1, 1, 0, 0, 1, 1),
(198, 9, 4, 1, 1, 1, 0, 0, 1, 1),
(199, 15, 4, 1, 1, 1, 0, 0, 1, 1),
(200, 17, 4, 1, 1, 1, 0, 0, 1, 1),
(201, 16, 4, 1, 1, 1, 0, 0, 1, 1),
(202, 18, 4, 1, 1, 1, 0, 0, 1, 1),
(203, 195, 1, 1, 1, 1, 0, 0, 1, 1),
(204, 196, 1, 1, 1, 1, 0, 0, 1, 1),
(205, 197, 1, 1, 1, 1, 0, 0, 1, 1),
(206, 195, 5, 1, 1, 1, 0, 0, 1, 1),
(207, 196, 5, 1, 1, 1, 0, 0, 1, 1),
(208, 197, 5, 1, 1, 1, 0, 0, 1, 1),
(209, 198, 1, 1, 1, 1, 0, 0, 1, 1),
(210, 199, 1, 1, 1, 1, 0, 0, 1, 1),
(211, 201, 1, 1, 1, 1, 0, 0, 1, 1),
(212, 202, 1, 1, 1, 1, 0, 0, 1, 1),
(213, 203, 1, 1, 1, 1, 0, 0, 1, 1),
(214, 204, 1, 1, 1, 1, 0, 0, 1, 1),
(215, 205, 1, 1, 1, 1, 0, 0, 1, 1),
(216, 207, 1, 1, 1, 1, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift_timing`
--

CREATE TABLE `shift_timing` (
  `shift_timing_id` int(11) NOT NULL,
  `user_employee_id` int(11) NOT NULL,
  `is_working_day` tinyint(4) DEFAULT 1,
  `day` varchar(20) NOT NULL,
  `login_time` time NOT NULL,
  `logout_time` time NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift_timing`
--

INSERT INTO `shift_timing` (`shift_timing_id`, `user_employee_id`, `is_working_day`, `day`, `login_time`, `logout_time`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(450, 5, 0, '0', '00:00:00', '00:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(451, 5, 1, '1', '10:00:00', '19:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(452, 5, 1, '2', '10:00:00', '19:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(453, 5, 1, '3', '10:00:00', '19:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(454, 5, 1, '4', '10:00:00', '19:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(455, 5, 1, '5', '10:00:00', '19:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(456, 5, 0, '6', '00:00:00', '00:00:00', '1', '2024-07-31 13:41:52', 1, NULL, NULL, '0', NULL, NULL),
(464, 4, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(465, 4, 1, '1', '10:00:00', '19:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(466, 4, 1, '2', '10:00:00', '19:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(467, 4, 1, '3', '10:00:00', '19:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(468, 4, 1, '4', '10:00:00', '19:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(469, 4, 1, '5', '10:00:00', '19:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(470, 4, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-01 17:09:47', 1, NULL, NULL, '0', NULL, NULL),
(569, 10, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(570, 10, 1, '1', '10:00:00', '19:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(571, 10, 1, '2', '10:00:00', '19:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(572, 10, 1, '3', '10:00:00', '19:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(573, 10, 1, '4', '10:00:00', '19:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(574, 10, 1, '5', '10:00:00', '19:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(575, 10, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-01 19:36:38', 1, NULL, NULL, '0', NULL, NULL),
(576, 11, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:29', 1, NULL, NULL, '0', NULL, NULL),
(577, 11, 1, '1', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:29', 1, NULL, NULL, '0', NULL, NULL),
(578, 11, 1, '2', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:29', 1, NULL, NULL, '0', NULL, NULL),
(579, 11, 1, '3', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:29', 1, NULL, NULL, '0', NULL, NULL),
(580, 11, 1, '4', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:29', 1, NULL, NULL, '0', NULL, NULL),
(581, 11, 1, '5', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:30', 1, NULL, NULL, '0', NULL, NULL),
(582, 11, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-01 19:45:30', 1, NULL, NULL, '0', NULL, NULL),
(583, 12, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(584, 12, 1, '1', '07:48:00', '19:49:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(585, 12, 1, '2', '07:49:00', '19:49:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(586, 12, 1, '3', '07:49:00', '19:49:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(587, 12, 1, '4', '07:49:00', '19:49:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(588, 12, 1, '5', '07:49:00', '19:49:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(589, 12, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(590, 13, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(591, 13, 1, '1', '08:51:00', '20:51:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(592, 13, 1, '2', '08:51:00', '20:51:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(593, 13, 1, '3', '08:51:00', '20:51:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(594, 13, 1, '4', '08:51:00', '20:51:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(595, 13, 1, '5', '08:51:00', '20:51:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(596, 13, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(597, 14, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(598, 14, 1, '1', '08:52:00', '20:52:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(599, 14, 0, '2', '00:00:00', '00:00:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(600, 14, 0, '3', '00:00:00', '00:00:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(601, 14, 0, '4', '00:00:00', '00:00:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(602, 14, 0, '5', '00:00:00', '00:00:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(603, 14, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(611, 15, 0, '0', '00:00:00', '00:00:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL),
(612, 15, 0, '1', '00:00:00', '00:00:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL),
(613, 15, 0, '2', '00:00:00', '00:00:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL),
(614, 15, 0, '3', '00:00:00', '00:00:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL),
(615, 15, 0, '4', '00:00:00', '00:00:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL),
(616, 15, 1, '5', '06:45:00', '18:45:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL),
(617, 15, 0, '6', '00:00:00', '00:00:00', '1', '2024-08-03 18:50:46', 1, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_code` varchar(255) DEFAULT NULL,
  `is_display` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `province_code` varchar(255) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `is_display`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`, `province_code`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(1, 1, 'Karnataka', '29', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(2, 1, 'Andaman and Nicobar Islan', '35', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(3, 1, 'Andhra Pradesh', '28', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(4, 1, 'Arunachal Pradesh', '12', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(5, 1, 'Assam', '18', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(6, 1, 'Bihar', '10', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(7, 1, 'Chandigarh', '4', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(8, 1, 'Chhattisgarh', '22', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(9, 1, 'Dadra and Nagar Haveli', '26', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(10, 1, 'Delhi', '7', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(11, 1, 'Goa', '30', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(12, 1, 'Gujarat', '24', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(13, 1, 'Haryana', '6', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(14, 1, 'Himachal Pradesh', '2', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(15, 1, 'Jammu and Kashmir', '1', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(16, 1, 'Jharkhand', '20', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(17, 1, 'Kerala', '32', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(18, 1, 'Madhya Pradesh', '23', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(19, 1, 'Maharashtra', '27', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(20, 1, 'Manipur', '14', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(21, 1, 'Meghalaya', '17', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(22, 1, 'Mizoram', '15', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(23, 1, 'Nagaland', '13', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(24, 1, 'Odisha', '21', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(25, 1, 'Puducherry', '34', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(26, 1, 'Punjab', '3', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(27, 1, 'Rajasthan', '8', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(28, 1, 'Tamil Nadu', '33', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(29, 1, 'Telangana', '36', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(30, 1, 'Tripura', '16', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(31, 1, 'Uttar Pradesh', '9', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(32, 1, 'Uttarakhand', '5', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL),
(33, 1, 'West Bengal', '19', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `th_admin_resetpwd_token`
--

CREATE TABLE `th_admin_resetpwd_token` (
  `pwd_token_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `th_admin_resetpwd_token`
--

INSERT INTO `th_admin_resetpwd_token` (`pwd_token_id`, `email`, `token`, `user_fk`, `used`) VALUES
(1, 'ramkumarsgurav@gmail.com', 'JV42116E3ADG', 4, 1),
(2, 'ramkumarsgurav@gmail.com', 'FUN5WBY5DZC6', 4, 0),
(3, 'ramkumarsgurav@gmail.com', 'VVQGQ7HFRJMM', 4, 0),
(4, 'ramkumarsgurav@gmail.com', 'YW26J95DAFT8', 4, 1),
(5, 'ramkumarsgurav@gmail.com', '2FKBDKDC2BAP', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_role_master`
--

CREATE TABLE `users_role_master` (
  `user_role_id` int(11) NOT NULL,
  `user_role_name` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_role_master`
--

INSERT INTO `users_role_master` (`user_role_id`, `user_role_name`, `added_on`, `added_by`, `updated_on`, `updated_by`, `status`) VALUES
(1, 'Super User', '2020-04-20 13:02:15', 1, '2023-11-22 19:27:00', 1, 1),
(3, 'Product Data Entry', '2022-11-26 18:14:31', 1, NULL, NULL, 1),
(4, 'products manager', '2023-12-21 18:18:17', 1, NULL, NULL, 1),
(5, 'Sale Executive', '2024-06-26 16:38:26', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_employee`
--

CREATE TABLE `user_employee` (
  `user_employee_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attendance_log` varchar(255) DEFAULT NULL,
  `marital_status` tinyint(4) DEFAULT 0,
  `marriage_anniversary` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `contactno` varchar(50) NOT NULL,
  `alt_contactno` varchar(50) DEFAULT NULL,
  `personal_email` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `aadhar_number` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `user_employee_custom_id` varchar(100) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '2 is for temperary blocked,0 is for blocled , 1 is for active',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_employee`
--

INSERT INTO `user_employee` (`user_employee_id`, `branch_id`, `department_id`, `designation_id`, `name`, `attendance_log`, `marital_status`, `marriage_anniversary`, `gender`, `contactno`, `alt_contactno`, `personal_email`, `company_email`, `birthday`, `joining_date`, `pan_number`, `aadhar_number`, `address`, `pincode`, `country_id`, `state_id`, `city_id`, `profile_image`, `user_employee_custom_id`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(4, 2, 2, 2, 'Guru Hugar', 'On 01-August-2024 at 11:55 AM Employee trying to make another attendance login in same day', 2, '2024-07-19', NULL, '08549065626', '', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', '1998-07-30', '2024-07-14', 'sdaf1243', '818236182736', 'chandra layout,bengulur 56089', '', 0, 0, NULL, 'profile_image_4.png', 'emp111', '1', '2024-07-15 18:38:05', 1, '2024-08-01 17:09:47', 1, '0', NULL, NULL),
(5, 1, 2, 1, 'ram gurav', 'On 31-July-2024 at 05:22 PM Admin updated the Employee attendance record', 1, NULL, NULL, '08549065626', '', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', '1997-07-30', '2024-07-18', 'sdaf1243', 'asdf1243', 'chandra layout', '', 0, 0, NULL, 'profile_image_5.png', 'emp222', '1', '2024-07-19 19:12:20', 1, '2024-08-01 13:13:07', 1, '0', NULL, NULL),
(10, 1, 1, 1, 'Abhi yadav', 'On 31-July-2024 at 04:01 PM Admin created new Employee attendance record', 2, NULL, NULL, '8549065626', '', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', '1998-07-30', '2024-07-23', 'sdaf1243', 'asdf1243', 'chandra layout', '', 0, 0, NULL, 'profile_image_10.png', 'super333', '0', '2024-07-27 11:00:32', 1, '2024-08-01 19:36:38', 1, '0', NULL, NULL),
(11, 1, 2, 3, 'chethan singi', NULL, 2, NULL, NULL, '08549065626', '', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', '2024-07-16', '2024-08-28', 'sdaf1243', 'asdf1243', 'chandra layout', '', 0, 0, NULL, NULL, 'emp120', '1', '2024-08-01 19:45:29', 1, NULL, NULL, '0', NULL, NULL),
(12, 2, 1, 2, 'kitti', NULL, 1, NULL, NULL, '08549065626', '', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', '1998-07-17', '2024-07-24', 'PAN1234', 'asdf1243', 'chandra layout', '', 0, 0, NULL, NULL, 'emp107', '1', '2024-08-01 19:49:39', 1, NULL, NULL, '0', NULL, NULL),
(13, 1, 1, 1, 'ramkumar gurav', NULL, 1, NULL, NULL, '08549065626', '', 'ramkumarsgurav@gmail.com', 'ramkumarsgurav@gmail.com', '2024-08-29', '2024-08-14', 'sdaf1243', 'asdf1243', 'chandra layout', '', 0, 0, NULL, NULL, 'emp122', '1', '2024-08-02 20:51:42', 1, NULL, NULL, '0', NULL, NULL),
(14, 1, 2, 3, 'ramkumar gurav', NULL, 1, NULL, NULL, '08549065626', '', '', '', '2024-08-02', '2024-08-23', 'sdaf1243', 'ADHAR1234', 'chandra layout', '', 0, 0, NULL, NULL, 'EMP989', '1', '2024-08-02 20:52:33', 1, NULL, NULL, '0', NULL, NULL),
(15, 1, 2, 3, 'ramkumar gurav', NULL, 1, NULL, NULL, '08549065626', '', '', '', '2024-07-24', '2024-08-14', '', 'asdf1243', 'chandra layout', '', 0, 0, NULL, NULL, 'EMP1111', '1', '2024-08-03 18:46:06', 1, '2024-08-03 18:50:46', 1, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_employee_kyc_file`
--

CREATE TABLE `user_employee_kyc_file` (
  `user_employee_kyc_file_id` int(11) NOT NULL,
  `user_employee_id` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `added_on` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT '0',
  `is_deleted_on` datetime DEFAULT NULL,
  `is_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_employee_kyc_file`
--

INSERT INTO `user_employee_kyc_file` (`user_employee_kyc_file_id`, `user_employee_id`, `file_title`, `file`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_deleted`, `is_deleted_on`, `is_deleted_by`) VALUES
(5, 3, 'aadhar', 'user_employee_kyc_file_5.pdf', '1', '2024-07-15 12:49:34', 1, '2024-07-15 12:49:34', NULL, '0', NULL, NULL),
(7, 2, 'aadhar card', 'user_employee_kyc_file_7.png', '1', '2024-07-15 13:30:44', 1, '2024-07-15 13:30:44', NULL, '0', NULL, NULL),
(8, 2, 'pan card', 'user_employee_kyc_file_8.pdf', '1', '2024-07-15 13:30:44', 1, '2024-07-15 13:30:44', NULL, '0', NULL, NULL),
(9, 1, 'aadhar', 'user_employee_kyc_file_9.jpg', '1', '2024-07-15 18:26:01', 1, '2024-07-15 18:26:01', NULL, '0', NULL, NULL),
(10, 1, 'pan card', 'user_employee_kyc_file_10.pdf', '1', '2024-07-15 18:26:01', 1, '2024-07-15 18:26:01', NULL, '0', NULL, NULL),
(25, 11, 'AADHAR', 'user_employee_kyc_file_25.sql', '1', '2024-08-01 19:45:30', 1, '2024-08-01 19:45:30', NULL, '0', NULL, NULL),
(26, 12, 'AADHAR', 'user_employee_kyc_file_26.sql', '1', '2024-08-01 19:49:39', 1, '2024-08-01 19:49:39', NULL, '0', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `admin_user_file`
--
ALTER TABLE `admin_user_file`
  ADD PRIMARY KEY (`admin_user_file_id`);

--
-- Indexes for table `admin_user_role`
--
ALTER TABLE `admin_user_role`
  ADD PRIMARY KEY (`admin_user_role`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`company_profile_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `datewise_shift_timing`
--
ALTER TABLE `datewise_shift_timing`
  ADD PRIMARY KEY (`datewise_shift_timing_id`);

--
-- Indexes for table `department_master`
--
ALTER TABLE `department_master`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation_master`
--
ALTER TABLE `designation_master`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `email_log`
--
ALTER TABLE `email_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  ADD PRIMARY KEY (`fiscal_year_id`);

--
-- Indexes for table `ip_address`
--
ALTER TABLE `ip_address`
  ADD PRIMARY KEY (`ip_address_id`);

--
-- Indexes for table `module_master`
--
ALTER TABLE `module_master`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `shift_timing`
--
ALTER TABLE `shift_timing`
  ADD PRIMARY KEY (`shift_timing_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `th_admin_resetpwd_token`
--
ALTER TABLE `th_admin_resetpwd_token`
  ADD PRIMARY KEY (`pwd_token_id`);

--
-- Indexes for table `users_role_master`
--
ALTER TABLE `users_role_master`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `user_employee`
--
ALTER TABLE `user_employee`
  ADD PRIMARY KEY (`user_employee_id`),
  ADD UNIQUE KEY `id_of_employee` (`user_employee_custom_id`);

--
-- Indexes for table `user_employee_kyc_file`
--
ALTER TABLE `user_employee_kyc_file`
  ADD PRIMARY KEY (`user_employee_kyc_file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_user_file`
--
ALTER TABLE `admin_user_file`
  MODIFY `admin_user_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_user_role`
--
ALTER TABLE `admin_user_role`
  MODIFY `admin_user_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1226;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `company_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `datewise_shift_timing`
--
ALTER TABLE `datewise_shift_timing`
  MODIFY `datewise_shift_timing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_master`
--
ALTER TABLE `department_master`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designation_master`
--
ALTER TABLE `designation_master`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_log`
--
ALTER TABLE `email_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `fiscal_year`
--
ALTER TABLE `fiscal_year`
  MODIFY `fiscal_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ip_address`
--
ALTER TABLE `ip_address`
  MODIFY `ip_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `module_master`
--
ALTER TABLE `module_master`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `module_permissions`
--
ALTER TABLE `module_permissions`
  MODIFY `permission_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `shift_timing`
--
ALTER TABLE `shift_timing`
  MODIFY `shift_timing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=618;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `th_admin_resetpwd_token`
--
ALTER TABLE `th_admin_resetpwd_token`
  MODIFY `pwd_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_role_master`
--
ALTER TABLE `users_role_master`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_employee`
--
ALTER TABLE `user_employee`
  MODIFY `user_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_employee_kyc_file`
--
ALTER TABLE `user_employee_kyc_file`
  MODIFY `user_employee_kyc_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
