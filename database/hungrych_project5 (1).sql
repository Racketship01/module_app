-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2021 at 09:08 PM
-- Server version: 10.3.24-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hungrych_project5`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject`
--

CREATE TABLE `assign_subject` (
  `assignID` int(11) NOT NULL,
  `assign_code` varchar(255) NOT NULL,
  `assign_teacher` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_subject`
--

INSERT INTO `assign_subject` (`assignID`, `assign_code`, `assign_teacher`, `semester`) VALUES
(1, 'AIS 111 1-1', 'INST3-18-2004', ''),
(2, 'AIS 111 1-2', 'INST3-18-2004', ''),
(3, 'AIS 111 1-3', 'INST3-18-2004', ''),
(4, 'AIS 111 1-4', 'INST3-18-2004', ''),
(5, 'AIS 111 1-5', 'INST3-18-2004', ''),
(6, 'AIS 111 1-6', 'INST3-18-2004', '');

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`course_id`, `course_name`) VALUES
(1, 'Bachelor of Science in Aviation Information System'),
(2, 'Bachelor of Science in Aviation Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `docu_id` int(11) NOT NULL,
  `docu_code` int(11) NOT NULL,
  `docu_title` varchar(255) NOT NULL,
  `uploaded_docu` varchar(255) NOT NULL,
  `doc_notes` text NOT NULL,
  `doc_files` varchar(255) NOT NULL,
  `docu_course` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `folder_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `doc_status` int(11) NOT NULL COMMENT 'Approve = 0, 1= Rejected  ',
  `archive_folder` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL COMMENT '0=files, 1= notes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`docu_id`, `docu_code`, `docu_title`, `uploaded_docu`, `doc_notes`, `doc_files`, `docu_course`, `date_created`, `folder_id`, `user_id`, `doc_status`, `archive_folder`, `doc_type`) VALUES
(32, 1336364698, 'Sample1', 'IMG20210126163247_00.jpg', '', '', 0, '2021-01-27 04:45:28', 22, 'admin', 0, 0, 0),
(33, 1988931776, 'Sample 2', 'capstone-layout.pdf', '', '', 0, '2021-01-27 04:49:37', 22, 'admin', 0, 0, 0),
(35, 482270810, 'Sana okay na', 'AIS-421-AIRPORT-AND-RAMP-HANDLING-PROCEDURE.pdf', '', '', 0, '2021-02-02 11:45:49', 24, 'admin', 0, 0, 0),
(39, 705232542, 'Module 1', 'MODULE-1-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:31:46', 27, 'admin', 0, 0, 0),
(40, 803471891, '', '../img/MODULE-2-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:32:47', 0, '', 0, 0, 0),
(41, 803471891, '', '../img/MODULE-2-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:32:50', 0, '', 0, 0, 0),
(42, 277731001, 'Module 3', 'MODULE-3-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:33:40', 21, 'admin', 0, 0, 0),
(44, 867665518, 'Module 2', 'MODULE-2-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:35:13', 26, 'admin', 0, 0, 0),
(45, 1955957011, 'Module 4', 'MODULE-4-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:37:11', 28, 'admin', 0, 0, 0),
(46, 76107298, 'Module 5', 'MODULE-5-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:37:41', 29, 'admin', 0, 0, 0),
(47, 742846769, 'Module 6', 'MODULE-6-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:38:12', 30, 'admin', 0, 0, 0),
(48, 842675693, 'Module 7', 'MODULE-7-AIS-314.docx.pdf', '', '', 0, '2021-02-12 10:38:38', 31, 'admin', 0, 0, 0),
(49, 1574277550, 'Module 3.1', '2020-2021-capstone-defense-sched.pdf', '', '', 0, '2021-02-13 00:47:25', 21, 'admin', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE `exam_result` (
  `result_id` int(11) NOT NULL,
  `quiz_id` varchar(255) NOT NULL,
  `exam_user` varchar(255) NOT NULL,
  `exam_score` varchar(255) NOT NULL,
  `exam_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_result`
--

INSERT INTO `exam_result` (`result_id`, `quiz_id`, `exam_user`, `exam_score`, `exam_date`) VALUES
(2, '26', '126', '1', '2019-03-12 10:19 pm'),
(4, '26', '132', '2', '2021-01-27 01:14 pm'),
(6, '29', '126', '0', '2021-02-12 05:01 pm'),
(8, '32', '137', '3', '2021-02-13 08:44 am'),
(9, '', '126', '0', '2021-02-19 08:53 pm'),
(11, '32', '126', '5', '2021-02-19 09:25 pm');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_desc`, `log_date`) VALUES
('Philippine State  College Of Aeronautics has login to the system', '2021-02-11 20:48:43'),
('Melds  Montes has login to the system', '2021-02-12 07:56:26'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 08:00:54'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 08:09:28'),
('Melds  Montes has login to the system', '2021-02-12 08:09:34'),
('Melds  Montes has logout to the system', '2021-02-12 08:17:01'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 08:17:17'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 08:18:06'),
('Melds  Montes has login to the system', '2021-02-12 08:18:25'),
('Melds  Montes has login to the system', '2021-02-12 08:20:08'),
('Melds  Montes has logout to the system', '2021-02-12 08:20:16'),
('Melds  Montes has login to the system', '2021-02-12 08:21:55'),
('Melds  Montes has logout to the system', '2021-02-12 08:23:15'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 08:23:24'),
('Melds  Montes has login to the system', '2021-02-12 08:31:11'),
('Melds  Montes has logout to the system', '2021-02-12 08:35:15'),
('Melds  Montes has login to the system', '2021-02-12 08:37:27'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 08:57:24'),
('Melds  Montes has login to the system', '2021-02-12 08:57:35'),
('Melds  Montes has logout to the system', '2021-02-12 09:00:39'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 09:00:55'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 09:06:23'),
('Melds  Montes has login to the system', '2021-02-12 09:06:30'),
('Melds  Montes has login to the system', '2021-02-12 10:14:40'),
('Melds  Montes has logout to the system', '2021-02-12 10:17:29'),
('Melds  Montes has login to the system', '2021-02-12 10:18:21'),
('Melds  Montes has logout to the system', '2021-02-12 10:19:01'),
('Melds  Montes has login to the system', '2021-02-12 10:20:34'),
('Melds  Montes has logout to the system', '2021-02-12 10:21:03'),
('Melds  Montes has login to the system', '2021-02-12 10:23:33'),
('Melds  Montes has logout to the system', '2021-02-12 10:24:02'),
('Melds  Montes has login to the system', '2021-02-12 10:25:01'),
('Melds  Montes has logout to the system', '2021-02-12 10:26:21'),
('Melds  Montes has login to the system', '2021-02-12 10:26:56'),
('Melds  Montes has login to the system', '2021-02-12 10:27:51'),
('Melds  Montes has login to the system', '2021-02-12 10:29:10'),
('Melds  Montes has logout to the system', '2021-02-12 10:29:28'),
('Melds  Montes has logout to the system', '2021-02-12 10:29:32'),
('Melds  Montes has login to the system', '2021-02-12 10:29:54'),
('Melds  Montes has logout to the system', '2021-02-12 10:31:00'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 10:31:06'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 10:31:12'),
('Melds  Montes has login to the system', '2021-02-12 10:31:31'),
('Melds  Montes has login to the system', '2021-02-12 10:31:55'),
('Melds  Montes has logout to the system', '2021-02-12 10:33:26'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 10:33:36'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 10:41:33'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 10:42:25'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-12 10:42:29'),
('Melds  Montes has login to the system', '2021-02-12 10:42:36'),
('Melds  Montes has login to the system', '2021-02-12 12:17:12'),
('Melds  Montes has login to the system', '2021-02-12 13:35:42'),
('Imelda  Bumanlag has login to the system', '2021-02-12 13:44:53'),
('Imelda  Bumanlag has logout to the system', '2021-02-12 13:46:07'),
('Imelda Santillan Bumanlag has login to the system', '2021-02-12 13:46:47'),
('Imelda  Bumanlag has logout to the system', '2021-02-12 13:47:49'),
('Mariel Shien Adap Morales has login to the system', '2021-02-12 13:48:02'),
('Imelda Santillan Bumanlag has logout to the system', '2021-02-12 13:55:14'),
('Imelda  Bumanlag has login to the system', '2021-02-12 13:55:24'),
('Imelda  Bumanlag has logout to the system', '2021-02-12 14:21:42'),
('Imelda  Bumanlag has login to the system', '2021-02-12 15:38:34'),
('Imelda  Bumanlag has logout to the system', '2021-02-12 15:42:11'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-12 23:48:53'),
('Imelda  Bumanlag has login to the system', '2021-02-12 23:50:53'),
('Imelda  Bumanlag has login to the system', '2021-02-12 23:59:01'),
('Imelda Santillan Bumanlag has login to the system', '2021-02-13 00:40:27'),
('Donita Rose Jovido Cantona has login to the system', '2021-02-13 00:43:45'),
('Imelda Santillan Bumanlag has logout to the system', '2021-02-13 00:44:53'),
('Imelda  Bumanlag has login to the system', '2021-02-13 00:45:03'),
('Donita Rose Jovido Cantona has logout to the system', '2021-02-13 00:48:54'),
('Imelda  Bumanlag has login to the system', '2021-02-13 00:49:02'),
('Imelda  Bumanlag has login to the system', '2021-02-13 00:49:02'),
('Imelda  Bumanlag has logout to the system', '2021-02-13 01:05:07'),
('Imelda Santillan Bumanlag has login to the system', '2021-02-13 01:05:44'),
('Imelda Santillan Bumanlag has logout to the system', '2021-02-13 01:12:50'),
('Imelda  Bumanlag has login to the system', '2021-02-13 01:46:35'),
('Imelda  Bumanlag has login to the system', '2021-02-13 02:08:43'),
('Imelda  Bumanlag has logout to the system', '2021-02-13 02:11:31'),
('Imelda  Bumanlag has login to the system', '2021-02-13 20:06:28'),
('Imelda  Bumanlag has logout to the system', '2021-02-13 20:09:12'),
('Imelda  Bumanlag has login to the system', '2021-02-13 22:58:42'),
('Imelda  Bumanlag has login to the system', '2021-02-14 07:47:53'),
('Imelda  Bumanlag has logout to the system', '2021-02-14 07:52:38'),
('Imelda  Bumanlag has login to the system', '2021-02-14 08:06:17'),
('Imelda  Bumanlag has login to the system', '2021-02-16 08:03:45'),
('Imelda  Bumanlag has logout to the system', '2021-02-16 08:07:10'),
('Imelda Santillan Bumanlag has login to the system', '2021-02-16 08:07:25'),
('Imelda Santillan Bumanlag has logout to the system', '2021-02-16 08:07:48'),
('Imelda  Bumanlag has login to the system', '2021-02-16 08:07:56'),
('Imelda  Bumanlag has logout to the system', '2021-02-16 08:29:27'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-16 08:29:36'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-16 08:31:11'),
('Imelda  Bumanlag has login to the system', '2021-02-16 08:31:20'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-16 15:43:20'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-16 15:47:52'),
('Imelda  Bumanlag has login to the system', '2021-02-16 15:49:02'),
('Imelda  Bumanlag has logout to the system', '2021-02-16 15:52:52'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-16 15:53:00'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-16 15:59:11'),
('Imelda  Bumanlag has login to the system', '2021-02-16 15:59:21'),
('Imelda  Bumanlag has logout to the system', '2021-02-16 16:04:14'),
('Imelda  Bumanlag has login to the system', '2021-02-16 16:06:58'),
('Imelda  Bumanlag has logout to the system', '2021-02-16 16:11:55'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-16 16:12:01'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-16 16:13:48'),
('Imelda  Bumanlag has login to the system', '2021-02-16 16:14:03'),
('Imelda  Bumanlag has login to the system', '2021-02-17 05:32:44'),
('Imelda  Bumanlag has login to the system', '2021-02-17 05:45:44'),
('Imelda  Bumanlag has login to the system', '2021-02-17 05:52:33'),
('Imelda  Bumanlag has login to the system', '2021-02-18 03:16:18'),
('Imelda  Bumanlag has logout to the system', '2021-02-18 03:20:41'),
('Imelda  Bumanlag has login to the system', '2021-02-18 03:23:55'),
('Imelda  Bumanlag has login to the system', '2021-02-18 03:43:25'),
('Imelda  Bumanlag has logout to the system', '2021-02-18 03:46:49'),
('Imelda  Bumanlag has logout to the system', '2021-02-18 03:47:11'),
('Imelda  Bumanlag has login to the system', '2021-02-18 03:48:35'),
('Imelda  Bumanlag has login to the system', '2021-02-18 04:15:17'),
('Imelda  Bumanlag has logout to the system', '2021-02-18 04:16:03'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-18 04:16:12'),
('Imelda  Bumanlag has login to the system', '2021-02-18 05:44:32'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 06:12:14'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 06:15:47'),
('Imelda  Bumanlag has login to the system', '2021-02-19 06:27:21'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 06:35:11'),
('Imelda  Bumanlag has login to the system', '2021-02-19 06:35:18'),
('Imelda  Bumanlag has login to the system', '2021-02-19 07:50:49'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 07:51:51'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 07:51:58'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 07:58:43'),
('Imelda  Bumanlag has login to the system', '2021-02-19 07:58:56'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 08:05:43'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 08:05:53'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 08:10:00'),
('Imelda  Bumanlag has login to the system', '2021-02-19 08:10:07'),
('Imelda  Bumanlag has login to the system', '2021-02-19 12:41:44'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 12:48:37'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 12:48:59'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 12:49:39'),
('Imelda  Bumanlag has login to the system', '2021-02-19 12:49:48'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 12:52:50'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 12:53:00'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 12:53:13'),
('Imelda  Bumanlag has login to the system', '2021-02-19 12:53:20'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 12:53:35'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 12:53:49'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 12:54:08'),
('Imelda  Bumanlag has login to the system', '2021-02-19 12:54:15'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 13:21:52'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 13:21:58'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 13:31:37'),
('Imelda  Bumanlag has login to the system', '2021-02-19 13:31:44'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 14:30:57'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 14:31:04'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-19 14:34:01'),
('Imelda  Bumanlag has login to the system', '2021-02-19 14:34:09'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 14:40:06'),
('Imelda  Bumanlag has login to the system', '2021-02-19 14:40:13'),
('Imelda  Bumanlag has logout to the system', '2021-02-19 14:44:08'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-19 14:44:20'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-20 13:34:08'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-20 13:38:16'),
('Imelda  Bumanlag has login to the system', '2021-02-20 13:38:22'),
('   has logout to the system', '2021-02-20 14:35:46'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-20 14:35:53'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:14:09'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:18:26'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:27:05'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:29:05'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:29:40'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:30:48'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:31:31'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:34:44'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:36:01'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:38:32'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:40:48'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:52:22'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:53:00'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:56:12'),
('Mikee Sotolombo Octubre has login to the system', '2021-02-21 11:56:24'),
('Mikee Sotolombo Octubre has logout to the system', '2021-02-21 11:57:05'),
('Imelda  Bumanlag has login to the system', '2021-02-21 11:57:13'),
('Imelda  Bumanlag has login to the system', '2021-02-21 11:59:31'),
('Imelda  Bumanlag has logout to the system', '2021-02-21 12:00:18'),
('Imelda  Bumanlag has login to the system', '2021-02-21 12:00:31'),
('Imelda  Bumanlag has logout to the system', '2021-02-21 12:02:03'),
('Imelda  Bumanlag has login to the system', '2021-02-21 12:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `main_folder`
--

CREATE TABLE `main_folder` (
  `folder_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `folder_title` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `folder_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_folder`
--

INSERT INTO `main_folder` (`folder_id`, `sub_id`, `folder_title`, `created_by`, `date_created`, `folder_status`) VALUES
(21, 1, 'Module 3', 'admin', '2021-02-12 10:30:42', 0),
(22, 1, 'Inflight servicing procedure test', 'admin', '2021-01-27 04:44:39', 0),
(23, 1, 'Quiz Test', 'admin', '2021-01-30 11:47:05', 0),
(24, 1, 'quiz 2', 'admin', '2021-02-02 08:00:46', 0),
(25, 1, 'Prelim Module', 'admin', '2021-02-12 08:15:26', 0),
(26, 1, 'Module 2', 'admin', '2021-02-12 08:19:41', 0),
(27, 1, 'Module 1', 'admin', '2021-02-12 10:28:06', 0),
(28, 1, 'Module 4', 'admin', '2021-02-12 10:36:16', 0),
(29, 1, 'Module 5', 'admin', '2021-02-12 10:36:24', 0),
(30, 1, 'Module 6', 'admin', '2021-02-12 10:36:32', 0),
(31, 1, 'Module 7', 'admin', '2021-02-12 10:36:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choice`
--

CREATE TABLE `multiple_choice` (
  `m_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `m_question` varchar(255) NOT NULL,
  `answer_a` varchar(255) NOT NULL,
  `ans_desc_a` varchar(255) NOT NULL,
  `answer_b` varchar(255) NOT NULL,
  `ans_desc_b` varchar(255) NOT NULL,
  `answer_c` varchar(255) NOT NULL,
  `ans_desc_c` varchar(255) NOT NULL,
  `answer_d` varchar(255) NOT NULL,
  `ans_desc_d` varchar(255) NOT NULL,
  `answer_e` varchar(255) NOT NULL,
  `ans_desc_e` varchar(255) NOT NULL,
  `correct_answer` text NOT NULL,
  `question_link` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multiple_choice`
--

INSERT INTO `multiple_choice` (`m_id`, `quiz_id`, `m_question`, `answer_a`, `ans_desc_a`, `answer_b`, `ans_desc_b`, `answer_c`, `ans_desc_c`, `answer_d`, `ans_desc_d`, `answer_e`, `ans_desc_e`, `correct_answer`, `question_link`, `photo`) VALUES
(1, 3, 'It is the baggage that is checked in at the counter and loaded in the aircraft.', 'A', 'Unchecked Baggage', 'B', 'Baggage', 'C', 'Checked Baggage', 'D', 'Pilfered Baggage', 'E', '', 'C', '', ''),
(2, 3, 'Any checked baggage with an airline baggage tag attached, located at a station other than that to which it was tagged.', 'A', 'Found Baggage', 'B', 'On-Hand Baggage', 'C', 'Missing Baggage', 'D', 'Damaged Baggage', 'E', '', 'A', '', ''),
(3, 3, 'Any baggage not available to the passenger at the time he is claiming for it.', 'A', 'On-Hand Baggage', 'B', 'Found Baggage', 'C', 'Damaged Baggage', 'D', 'Missing Baggage', 'E', '', 'D', '', ''),
(4, 3, 'What is the no.1 in the General Procedures when Checking-In Passengers?', 'A', 'Greet the passenger', 'B', 'Request for his ticket and travel documents.', 'C', 'Examine his ticket and travel documents. By this time you will be able to address the passenger by his name.', 'D', 'None of the above', 'E', '', 'A', '', ''),
(5, 3, 'What is the no.14 in the General Procedures when Checking-In Passengers?', 'A', 'Give instructions on where to proceed. Instruct the passenger to proceed to 		the Immigration Counters.', 'B', 'Do not forget to lift the appropriate coupon.', 'C', 'End with pleasantries like Have a nice flight!', 'D', 'None of the above', 'E', '', 'C', '', ''),
(6, 3, 'How many types are there in Boarding Passes?', 'A', '2', 'B', '3', 'C', '4', 'D', '5', 'E', '', 'A', '', ''),
(7, 3, 'What is the first step in Processing Passengers Baggage?', 'A', 'Tag baggage and attach claim checks on the passengers ticket.', 'B', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'C', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'D', 'Release baggage for loading.', 'E', '', 'C', '', ''),
(8, 3, 'What is the third step in Processing Passengers Baggage?', 'A', 'Release baggage for loading.', 'B', 'Tag baggage and attach claim checks on the passengers ticket.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'C', '', ''),
(9, 3, 'What is the last step in Processing Passengers Baggage?', 'A', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'B', 'Release baggage for loading.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'B', '', ''),
(10, 3, 'It is issued against the ticket as the legal document between a passenger and an airline company.', 'A', 'Ticket', 'B', 'Passport', 'C', 'Visa', 'D', 'Boarding Pass', 'E', '', 'D', '', ''),
(11, 3, 'Which is not included in the details of the Boarding Pass?', 'A', 'Passengers route', 'B', 'Date', 'C', 'Address', 'D', 'Seat Number', 'E', '', 'C', '', ''),
(12, 3, 'Which is not included in the functions of the Boarding Pass?', 'A', 'To be used for verification at transit stations or during a head-count.', 'B', 'To serve as identification tag for overcoats, raincoat, etc. which are handed over to cabin crew during flight.', 'C', 'All of the above', 'D', 'None of the above', 'E', '', 'D', '', ''),
(13, 3, 'It occurs when a First Class passenger is not accommodated in the First Class section and instead is accommodated at the Economy Class section.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading/Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'C', '', ''),
(14, 3, 'It occur when passengers move to a higher class of service.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading/Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'A', '', ''),
(15, 3, 'What is the first step to be followed when upgrading?', 'A', 'Assign seats if possible on last rows of the First Class cabin.', 'B', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'C', 'Advise next station of upgraded passengers.', 'D', 'Check catering supplies and order extra portions if necessary.', 'E', '', 'D', '', ''),
(16, 3, 'What is the third step to be followed when upgrading?', 'A', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'B', 'Advise next station of upgraded passengers.', 'C', 'Assign seats if possible on last rows of the First Class cabin.', 'D', 'Screen passenger list for upgrading of VIP passengers.', 'E', '', 'C', '', ''),
(17, 3, 'What is the last step to be followed when upgrading?', 'A', 'Advise next station of upgraded passengers.', 'B', 'Check catering supplies and order extra portions if necessary.', 'C', 'Screen passenger list for upgrading of VIP passengers.', 'D', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'E', '', 'A', '', ''),
(18, 3, 'It receives the same allowance as adults.', 'A', 'Senior Fare', 'B', 'Child Fare', 'C', 'Infant Fare', 'D', 'None of the above', 'E', '', 'B', '', ''),
(19, 3, 'It is permitted one checked piece. The sum of the 3 dimensions must not exceed 45 inches.', 'A', 'Infant', 'B', 'Child', 'C', 'Adult', 'D', 'None of the above', 'E', '', 'A', '', ''),
(20, 3, 'The maximum total dimensions allowable for cabin stowage is:', 'A', '23 cm x 36 cm x 56 cm = 115 cms. (45 inches)', 'B', '90cm x 65cm x 75 cm = 230 cms. (95 inches)', 'C', '50cm x 40 cm x 25xm = 115 cms. (45 inches)', 'D', 'All of the above', 'E', '', 'C', '', ''),
(21, 3, 'It is also used for a passenger who books a extra seat in order to carry special baggage on that seat.', 'A', 'Baggage Ticket', 'B', 'Excess Baggage Ticket', 'C', 'Passengers Ticket', 'D', 'None of the above', 'E', '', 'B', '', ''),
(22, 3, 'It has to be stapled behind the flight coupons of the passengers ticket.', 'A', 'Audit Coupon', 'B', 'Agent Coupon', 'C', 'Flight Coupon', 'D', 'Passenger Coupon', 'E', '', 'C', '', ''),
(23, 3, 'Any baggage with part or parts of its original contents was or were taken from it.', 'A', 'Pilfered Baggage', 'B', 'Damaged Baggage', 'C', 'Missing Baggage', 'D', 'On-Hand Baggage', 'E', '', 'A', '', ''),
(24, 3, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Missing Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'B', '', ''),
(25, 3, 'It is able to arrange for comparable air transportation which is planned to arrive at his destination / stopover point not later than four hours after the flight he had confirmed reserved space is planned to arrive.', 'A', 'Cebu Pac', 'B', 'Air Asia', 'C', 'pal', 'D', 'All of the above', 'E', '', 'C', '', ''),
(26, 3, 'It is a non-revenue passenger.', 'A', 'Child', 'B', 'Adult', 'C', 'Infant', 'D', 'Passenger', 'E', '', 'D', '', ''),
(27, 3, 'It provides disembarking and transit stations with information on any passengers on a flight requiring assistance or special handling.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'B', '', ''),
(28, 3, 'It provides enroute stations with information regarding transfer passengers and their checked baggage. It is sent to downline stations separately immediately after flight departure.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'C', '', ''),
(29, 3, 'This is where you will request the passenger to put his baggage.', 'A', 'Trash Bin', 'B', 'Scale', 'C', 'Under his/her seat', 'D', 'None of the above', 'E', '', 'B', '', ''),
(30, 3, 'It looks like a passengers ticket.', 'A', 'Excess Baggage Ticket', 'B', 'Baggage Ticket', 'C', 'Agent Ticket', 'D', 'Audit Ticket', 'E', '', 'A', '', ''),
(31, 10, 'It is the baggage that is checked in at the counter and loaded in the aircraft.', 'A', 'Unchecked Baggage', 'B', 'Baggage', 'C', 'Checked Baggage', 'D', 'Pilfered Baggage', 'E', '', 'C', '', ''),
(32, 10, 'Any checked baggage with an airline baggage tag attached, located at a station other than that to which it was tagged.', 'A', 'Found Baggage', 'B', 'On-Hand Baggage', 'C', 'Missing Baggage', 'D', 'Damaged Baggage', 'E', '', 'A', '', ''),
(33, 10, 'Any baggage not available to the passenger at the time he is claiming for it.', 'A', 'On-Hand Baggage', 'B', 'Found Baggage', 'C', 'Damaged Baggage', 'D', 'Missing Baggage', 'E', '', 'D', '', ''),
(34, 10, 'What is the no.1 in the General Procedures when Checking-In Passengers?', 'A', 'Greet the passenger', 'B', 'Request for his ticket and travel documents.', 'C', 'Examine his ticket and travel documents. By this time you will be able to address the passenger by his name.', 'D', 'None of the above', 'E', '', 'A', '', ''),
(35, 10, 'What is the no.14 in the General Procedures when Checking-In Passengers?', 'A', 'Give instructions on where to proceed. Instruct the passenger to proceed to 		the Immigration Counters.', 'B', 'Do not forget to lift the appropriate coupon.', 'C', 'End with pleasantries like Have a nice flight!', 'D', 'None of the above', 'E', '', 'C', '', ''),
(36, 10, 'How many types are there in Boarding Passes?', 'A', '2', 'B', '3', 'C', '4', 'D', '5', 'E', '', 'A', '', ''),
(37, 10, 'What is the first step in Processing Passengers Baggage?', 'A', 'Tag baggage and attach claim checks on the passengers ticket.', 'B', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'C', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'D', 'Release baggage for loading.', 'E', '', 'C', '', ''),
(38, 10, 'What is the third step in Processing Passengers Baggage?', 'A', 'Release baggage for loading.', 'B', 'Tag baggage and attach claim checks on the passengers ticket.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'C', '', ''),
(39, 10, 'What is the last step in Processing Passengers Baggage?', 'A', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'B', 'Release baggage for loading.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'B', '', ''),
(40, 10, 'It is issued against the ticket as the legal document between a passenger and an airline company.', 'A', 'Ticket', 'B', 'Passport', 'C', 'Visa', 'D', 'Boarding Pass', 'E', '', 'D', '', ''),
(41, 10, 'Which is not included in the details of the Boarding Pass?', 'A', 'Passengers route', 'B', 'Date', 'C', 'Address', 'D', 'Seat Number', 'E', '', 'C', '', ''),
(42, 10, 'Which is not included in the functions of the Boarding Pass?', 'A', 'To be used for verification at transit stations or during a head-count.', 'B', 'To serve as identification tag for overcoats, raincoat, etc. which are handed over to cabin crew during flight.', 'C', 'All of the above', 'D', 'None of the above', 'E', '', 'D', '', ''),
(43, 10, 'It occurs when a First Class passenger is not accommodated in the First Class section and instead is accommodated at the Economy Class section.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading/Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'C', '', ''),
(44, 10, 'It occur when passengers move to a higher class of service.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading/Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'A', '', ''),
(45, 10, 'What is the first step to be followed when upgrading?', 'A', 'Assign seats if possible on last rows of the First Class cabin.', 'B', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'C', 'Advise next station of upgraded passengers.', 'D', 'Check catering supplies and order extra portions if necessary.', 'E', '', 'D', '', ''),
(46, 10, 'What is the third step to be followed when upgrading?', 'A', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'B', 'Advise next station of upgraded passengers.', 'C', 'Assign seats if possible on last rows of the First Class cabin.', 'D', 'Screen passenger list for upgrading of VIP passengers.', 'E', '', 'C', '', ''),
(47, 10, 'What is the last step to be followed when upgrading?', 'A', 'Advise next station of upgraded passengers.', 'B', 'Check catering supplies and order extra portions if necessary.', 'C', 'Screen passenger list for upgrading of VIP passengers.', 'D', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'E', '', 'A', '', ''),
(48, 10, 'It receives the same allowance as adults.', 'A', 'Senior Fare', 'B', 'Child Fare', 'C', 'Infant Fare', 'D', 'None of the above', 'E', '', 'B', '', ''),
(49, 10, 'It is permitted one checked piece. The sum of the 3 dimensions must not exceed 45 inches.', 'A', 'Infant', 'B', 'Child', 'C', 'Adult', 'D', 'None of the above', 'E', '', 'A', '', ''),
(50, 10, 'The maximum total dimensions allowable for cabin stowage is:', 'A', '23 cm x 36 cm x 56 cm = 115 cms. (45 inches)', 'B', '90cm x 65cm x 75 cm = 230 cms. (95 inches)', 'C', '50cm x 40 cm x 25xm = 115 cms. (45 inches)', 'D', 'All of the above', 'E', '', 'C', '', ''),
(51, 10, 'It is also used for a passenger who books a extra seat in order to carry special baggage on that seat.', 'A', 'Baggage Ticket', 'B', 'Excess Baggage Ticket', 'C', 'Passenger&acirc;€™s Ticket', 'D', 'None of the above', 'E', '', 'B', '', ''),
(52, 10, 'It has to be stapled behind the flight coupons of the passengers ticket.', 'A', 'Audit Coupon', 'B', 'Agent Coupon', 'C', 'Flight Coupon', 'D', 'Passenger Coupon', 'E', '', 'C', '', ''),
(53, 10, 'Any baggage with part or parts of its original contents was or were taken from it.', 'A', 'Pilfered Baggage', 'B', 'Damaged Baggage', 'C', 'Missing Baggage', 'D', 'On-Hand Baggage', 'E', '', 'A', '', ''),
(54, 10, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Missing Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'B', '', ''),
(55, 10, 'It is able to arrange for comparable air transportation which is planned to arrive at his destination / stopover point not later than four hours after the flight he had confirmed reserved space is planned to arrive.', 'A', 'Cebu Pac', 'B', 'Air Asia', 'C', 'PAL', 'D', 'All of the above', 'E', '', 'C', '', ''),
(56, 10, 'It is a non-revenue passenger.', 'A', 'Child', 'B', 'Adult', 'C', 'Infant', 'D', 'Passenger', 'E', '', 'D', '', ''),
(57, 10, 'It provides disembarking and transit stations with information on any passengers on a flight requiring assistance or special handling.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'B', '', ''),
(58, 10, 'It provides enroute stations with information regarding transfer passengers and their checked baggage. It is sent to downline stations separately immediately after flight departure.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'C', '', ''),
(59, 10, 'This is where you will request the passenger to put his baggage.', 'A', 'Trash Bin', 'B', 'Scale', 'C', 'Under his/her seat', 'D', 'None of the above', 'E', '', 'B', '', ''),
(60, 10, 'It looks like a passengers ticket.', 'A', 'Excess Baggage Ticket', 'B', 'Baggage Ticket', 'C', 'Agent Ticket', 'D', 'Audit Ticket', 'E', '', 'A', '', ''),
(61, 11, 'It is the baggage that is checked in at the counter and loaded in the aircraft.', 'A', 'Unchecked Baggage', 'B', 'Baggage', 'C', 'Checked Baggage', 'D', 'Pilfered Baggage', 'E', '', 'A', '', ''),
(62, 11, 'Any checked baggage with an airline baggage tag attached, located at a station other than that to which it was tagged.', 'A', 'Found Baggage', 'B', 'On-Hand Baggage', 'C', 'Missing Baggage', 'D', 'Damaged Baggage', 'E', '', 'A', '', ''),
(63, 11, 'Any baggage not available to the passenger at the time he is claiming for it.', 'A', 'On-Hand Baggage', 'B', 'Found Baggage', 'C', 'Damaged Baggage', 'D', 'Missing Baggage', 'E', '', 'D', '', ''),
(64, 11, 'What is the no.1 in the General Procedures when Checking-In Passengers?', 'A', 'Greet the passenger.', 'B', 'Request for his ticket and travel documents.', 'C', 'Examine his ticket and travel documents. By this time you will be able to address the passenger by his name.', 'D', 'None of the above', 'E', '', 'A', '', ''),
(65, 11, 'What is the no.14 in the General Procedures when Checking-In Passengers?', 'A', 'Give instructions on where to proceed. Instruct the passenger to proceed to 		the Immigration Counters.', 'B', 'Do not forget to lift the appropriate coupon.', 'C', 'End with pleasantries like Have a nice flight!', 'D', 'None of the above', 'E', '', 'C', '', ''),
(66, 11, 'How many types are there in Boarding Passes?', 'A', '2', 'B', '3', 'C', '4', 'D', '5', 'E', '', 'A', '', ''),
(67, 11, 'What is the first step in Processing Passengers Baggage?', 'A', 'Tag baggage and attach claim checks on the passengers ticket.', 'B', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'C', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'D', 'Release baggage for loading.', 'E', '', 'C', '', ''),
(68, 11, 'What is the third step in Processing Passengers Baggage?', 'A', 'Release baggage for loading.', 'B', 'Tag baggage and attach claim checks on the passengers ticket.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'C', '', ''),
(69, 11, 'What is the last step in Processing Passengers Baggage?', 'A', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'B', 'Release baggage for loading.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'B', '', ''),
(70, 11, 'It is issued against the ticket as the legal document between a passenger and an airline company.', 'A', 'Ticket', 'B', 'Passport', 'C', 'Visa', 'D', 'Boarding Pass', 'E', '', 'D', '', ''),
(71, 11, 'Which is not included in the details of the Boarding Pass?', 'A', 'Passengers route', 'B', 'Date', 'C', 'Address', 'D', 'Seat Number', 'E', '', 'C', '', ''),
(72, 11, 'Which is not included in the functions of the Boarding Pass?', 'A', 'To be used for verification at transit stations or during a head-count.', 'B', 'To serve as identification tag for overcoats, raincoat, etc. which are handed over to cabin crew during flight.', 'C', 'All of the above', 'D', 'None of the above', 'E', '', 'D', '', ''),
(73, 11, 'It occurs when a First Class passenger is not accommodated in the First Class section and instead is accommodated at the Economy Class section.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'C', '', ''),
(74, 11, 'It occur when passengers move to a higher class of service.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'A', '', ''),
(75, 11, 'What is the first step to be followed when upgrading?', 'A', 'Assign seats if possible on last rows of the First Class cabin.', 'B', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'C', 'Advise next station of upgraded passengers.', 'D', 'Check catering supplies and order extra portions if necessary.', 'E', '', 'D', '', ''),
(76, 11, 'What is the third step to be followed when upgrading?', 'A', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'B', 'Advise next station of upgraded passengers.', 'C', 'Assign seats if possible on last rows of the First Class cabin.', 'D', 'Screen passenger list for upgrading of VIP passengers.', 'E', '', 'C', '', ''),
(77, 11, 'What is the last step to be followed when upgrading?', 'A', 'Advise next station of upgraded passengers.', 'B', 'Check catering supplies and order extra portions if necessary.', 'C', 'Screen passenger list for upgrading of VIP passengers.', 'D', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'E', '', 'A', '', ''),
(78, 11, 'It receives the same allowance as adults.', 'A', 'Senior Fare', 'B', 'Child Fare', 'C', 'Infant fare', 'D', 'None of the above', 'E', '', 'B', '', ''),
(79, 11, 'It is permitted one checked piece. The sum of the 3 dimensions must not exceed 45 inches.', 'A', 'Infant', 'B', 'Child', 'C', 'Adult', 'D', 'None of the above', 'E', '', 'A', '', ''),
(80, 11, 'The maximum total dimensions allowable for cabin stowage is:', 'A', '23 cm x 36 cm x 56 cm = 115 cms. (45 inches)', 'B', '90cm x 65cm x 75 cm = 230 cms. (95 inches)', 'C', '50cm x 40 cm x 25xm = 115 cms. (45 inches)', 'D', 'All of the above', 'E', '', 'C', '', ''),
(81, 11, 'It has to be stapled behind the flight coupons of the passengers ticket.', 'A', 'Audit Coupon', 'B', 'Agent Coupon', 'C', 'Flight Coupon', 'D', 'Passenger Coupon', 'E', '', 'C', '', ''),
(82, 11, 'It is also used for a passenger who books a extra seat in order to carry special baggage on that seat.', 'A', 'Baggage Ticket', 'B', 'Excess Baggage Ticket', 'C', 'Passengers Ticket', 'D', 'None of the above', 'E', '', 'B', '', ''),
(83, 11, 'Any baggage with part or parts of its original contents was or were taken from it.', 'A', 'Pilfered Baggage', 'B', 'Damaged Baggage', 'C', 'Missing Baggage', 'D', 'On-Hand Baggage', 'E', '', 'A', '', ''),
(84, 11, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Missing Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'B', '', ''),
(85, 11, 'It is able to arrange for comparable air transportation which is planned to arrive at his destination / stopover point not later than four hours after the flight he had confirmed reserved space is planned to arrive.', 'A', 'Cebu Pacific', 'B', 'Air Asia', 'C', 'PAL', 'D', 'Skyjet', 'E', '', 'C', '', ''),
(86, 11, 'It is a non-revenue passenger.', 'A', 'Child', 'B', 'Adult', 'C', 'Infant', 'D', 'Passenger', 'E', '', 'D', '', ''),
(87, 11, 'It provides disembarking and transit stations with information on any passengers on a flight requiring assistance or special handling.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'B', '', ''),
(88, 11, 'It provides enroute stations with information regarding transfer passengers and their checked baggage. It is sent to downline stations separately immediately after flight departure.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'C', '', ''),
(89, 11, 'This is where you will request the passenger to put his/her baggage.', 'A', 'Trash Bin', 'B', 'Scale', 'C', 'Under his/her seat', 'D', 'None of the above', 'E', '', 'B', '', ''),
(90, 11, 'It looks like a passengers ticket.', 'A', 'Excess Baggage Ticket', 'B', 'Baggage Ticket', 'C', 'Agent Ticket', 'D', 'Audit Ticket', 'E', '', 'A', '', ''),
(91, 17, 'It is the baggage that is checked in at the counter and loaded in the aircraft.', 'A', 'Unchecked Baggage', 'B', 'Baggage', 'C', 'Checked Baggage', 'D', 'None of the above', 'E', '', 'C', '', ''),
(92, 17, 'Any checked baggage with an airline baggage tag attached, located at a station other than that to which it was tagged.', 'A', 'Found Baggage', 'B', 'On-Hand Baggage', 'C', 'Missing Baggage', 'D', 'Damaged Baggage', 'E', '', 'A', '', ''),
(93, 17, 'Any baggage not available to the passenger at the time he is claiming for it.', 'A', 'On-Hand Baggage', 'B', 'Found Baggage', 'C', 'Damaged Baggage', 'D', 'Missing Baggage', 'E', '', 'D', '', ''),
(94, 17, 'What is the no.1 in the General Procedures when Checking-In Passengers?', 'A', 'Greet the passenger.', 'B', 'Request for his ticket and travel documents.', 'C', 'Examine his ticket and travel documents. By this time you will be able to address the passenger by his name.', 'D', 'None of the above', 'E', '', 'A', '', ''),
(95, 17, 'What is the no.14 in the General Procedures when Checking-In Passengers?', 'A', 'Give instructions on where to proceed. Instruct the passenger to proceed to 		the Immigration Counters.', 'B', 'Do not forget to lift the appropriate coupon.', 'C', 'End with pleasantries like Have a nice flight!', 'D', 'None of the above', 'E', '', 'C', '', ''),
(96, 17, 'How many types are there in Boarding Passes?', 'A', '2', 'B', '3', 'C', '4', 'D', '5', 'E', '', 'A', '', ''),
(97, 17, 'What is the first step in Processing Passengers Baggage?', 'A', 'Tag baggage and attach claim checks on the passengers ticket.', 'B', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'C', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'D', 'Release baggage for loading.', 'E', '', 'C', '', ''),
(98, 17, 'What is the third step in Processing Passengers Baggage?', 'A', 'Release baggage for loading.', 'B', 'Tag baggage and attach claim checks on the passengers ticket.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'C', '', ''),
(99, 17, 'What is the last step in Processing Passengers Baggage?', 'A', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'B', 'Release baggage for loading.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'B', '', ''),
(100, 17, 'It is issued against the ticket as the legal document between a passenger and an airline company.', 'A', 'Ticket', 'B', 'Passport', 'C', 'Visa', 'D', 'Boarding Pass', 'E', '', 'D', '', ''),
(101, 17, 'Which is not included in the details of the Boarding Pass?', 'A', 'Passengers route', 'B', 'Date', 'C', 'Address', 'D', 'Seat Number', 'E', '', 'C', '', ''),
(102, 17, 'Which is not included in the functions of the Boarding Pass?', 'A', 'To be used for verification at transit stations or during a head-count.', 'B', 'To serve as identification tag for overcoats, raincoat, etc. which are handed over to cabin crew during flight.', 'C', 'All of the above', 'D', 'None of the above', 'E', '', 'D', '', ''),
(103, 17, 'It occurs when a First Class passenger is not accommodated in the First Class section and instead is accommodated at the Economy Class section.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'C', '', ''),
(104, 17, 'It occur when passengers move to a higher class of service.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'A', '', ''),
(105, 17, 'What is the first step to be followed when upgrading?', 'A', 'Assign seats if possible on last rows of the First Class cabin.', 'B', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'C', 'Advise next station of upgraded passengers.', 'D', 'Check catering supplies and order extra portions if necessary.', 'E', '', 'D', '', ''),
(106, 17, 'What is the third step to be followed when upgrading?', 'A', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'B', 'Advise next station of upgraded passengers.', 'C', 'Assign seats if possible on last rows of the First Class cabin.', 'D', 'Screen passenger list for upgrading of VIP passengers.', 'E', '', 'C', '', ''),
(107, 17, 'What is the last step to be followed when upgrading?', 'A', 'Advise next station of upgraded passengers.', 'B', 'Check catering supplies and order extra portions if necessary.', 'C', 'Screen passenger list for upgrading of VIP passengers.', 'D', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'E', '', 'A', '', ''),
(108, 17, 'It receives the same allowance as adults.', 'A', 'Senior Fare', 'B', 'Child Fare', 'C', 'Infant fare', 'D', 'None of the above', 'E', '', 'B', '', ''),
(109, 17, 'It is permitted one checked piece. The sum of the 3 dimensions must not exceed 45 inches.', 'A', 'Infant', 'B', 'Child', 'C', 'Adult', 'D', 'None of the above', 'E', '', 'A', '', ''),
(110, 17, 'The maximum total dimensions allowable for cabin stowage is:', 'A', '23 cm x 36 cm x 56 cm = 115 cms. (45 inches)', 'B', '90cm x 65cm x 75 cm = 230 cms. (95 inches)', 'C', '50cm x 40 cm x 25xm = 115 cms. (45 inches)', 'D', 'All of the above', 'E', '', 'C', '', ''),
(111, 17, 'It is also used for a passenger who books a extra seat in order to carry special baggage on that seat.', 'A', 'Baggage Ticket', 'B', 'Excess Baggage Ticket', 'C', 'Passengers Ticket', 'D', 'None of the above', 'E', '', 'B', '', ''),
(112, 17, 'It has to be stapled behind the flight coupons of the passengers ticket.', 'A', 'Audit Coupon', 'B', 'Agent Coupon', 'C', 'Flight Coupon', 'D', 'Passenger Coupon', 'E', '', 'C', '', ''),
(113, 17, 'Any baggage with part or parts of its original contents was or were taken from it.', 'A', 'Pilfered Baggage', 'B', 'Damaged Baggage', 'C', 'Missing Baggage', 'D', 'On-Hand Baggage', 'E', '', 'A', '', ''),
(114, 17, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Missing Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'B', '', ''),
(115, 17, 'It is able to arrange for comparable air transportation which is planned to arrive at his destination / stopover point not later than four hours after the flight he had confirmed reserved space is planned to arrive.', 'A', 'Cebu Pacific', 'B', 'Air Asia', 'C', 'PAL', 'D', 'Skyjet', 'E', '', 'C', '', ''),
(116, 17, 'It is a non-revenue passenger.', 'A', 'Child', 'B', 'Adult', 'C', 'Infant', 'D', 'Passenger', 'E', '', 'D', '', ''),
(117, 17, 'It provides disembarking and transit stations with information on any passengers on a flight requiring assistance or special handling.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'B', '', ''),
(118, 17, 'It provides enroute stations with information regarding transfer passengers and their checked baggage. It is sent to downline stations separately immediately after flight departure.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'C', '', ''),
(119, 17, 'This is where you will request the passenger to put his/her baggage.', 'A', 'Trash Bin', 'B', 'Scale', 'C', 'Under his/her seat', 'D', 'None of the above', 'E', '', 'B', '', ''),
(120, 17, 'It looks like a passengers ticket.', 'A', 'Excess Baggage Ticket', 'B', 'Baggage Ticket', 'C', 'Agent Ticket', 'D', 'Audit Ticket', 'E', '', 'A', '', ''),
(121, 20, 'It is the baggage that is checked in at the counter and loaded in the aircraft.', 'A', 'Unchecked Baggage', 'B', 'Baggage', 'C', 'Checked Baggage', 'D', 'Pilfered Baggage', 'E', '', 'C', '', ''),
(122, 20, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Found Baggage', 'B', 'On-Hand Baggage', 'C', 'Missing Baggage', 'D', 'Damaged Baggage', 'E', '', 'A', '', ''),
(123, 20, 'Any baggage not available to the passenger at the time he is claiming for it.', 'A', 'On-Hand Baggage', 'B', 'Found Baggage', 'C', 'Damaged Baggage', 'D', 'Missing Baggage', 'E', '', 'D', '', ''),
(124, 20, 'What is the no.1 in the General Procedures when Checking-In Passengers?', 'A', 'Greet the passenger.', 'B', 'Request for his ticket and travel documents.', 'C', 'Examine his ticket and travel documents. By this time you will be able to address the passenger by his name.', 'D', 'None of the above', 'E', '', 'A', '', ''),
(125, 20, 'What is the no.14 in the General Procedures when Checking-In Passengers?', 'A', 'Give instructions on where to proceed. Instruct the passenger to proceed to 		the Immigration Counters.', 'B', 'Do not forget to lift the appropriate coupon.', 'C', 'End with pleasantries like Have a nice flight!', 'D', 'None of the above', 'E', '', 'C', '', ''),
(126, 20, 'How many types are there in Boarding Passes?', 'A', '2', 'B', '3', 'C', '4', 'D', '5', 'E', '', 'A', '', ''),
(127, 20, 'What is the first step in Processing Passengers Baggage?', 'A', 'Tag baggage and attach claim checks on the passengers ticket.', 'B', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'C', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'D', 'Release baggage for loading.', 'E', '', 'C', '', ''),
(128, 20, 'What is the third step in Processing Passengers Baggage?', 'A', 'Release baggage for loading.', 'B', 'Tag baggage and attach claim checks on the passengers ticket.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'C', '', ''),
(129, 20, 'What is the last step in Processing Passengers Baggage?', 'A', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'B', 'Release baggage for loading.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'B', '', ''),
(130, 20, 'It is issued against the ticket as the legal document between a passenger and an airline company.', 'A', 'Ticket', 'B', 'Passport', 'C', 'Visa', 'D', 'Boarding Pass', 'E', '', 'D', '', ''),
(131, 20, 'Which is not included in the details of the Boarding Pass?', 'A', 'Passengers route', 'B', 'Date', 'C', 'Address', 'D', 'Seat Number', 'E', '', 'C', '', ''),
(132, 20, 'Which is not included in the functions of the Boarding Pass?', 'A', 'To be used for verification at transit stations or during a head-count.', 'B', 'To serve as identification tag for overcoats, raincoat, etc. which are handed over to cabin crew during flight.', 'C', 'All of the above', 'D', 'None of the above', 'E', '', 'D', '', ''),
(133, 20, 'It occurs when a First Class passenger is not accommodated in the First Class section and instead is accommodated at the Economy Class section.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'C', '', ''),
(134, 20, 'It occur when passengers move to a higher class of service.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'A', '', ''),
(135, 20, 'What is the first step to be followed when upgrading?', 'A', 'Assign seats if possible on last rows of the First Class cabin.', 'B', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'C', 'Advise next station of upgraded passengers.', 'D', 'Check catering supplies and order extra portions if necessary.', 'E', '', 'D', '', ''),
(136, 20, 'What is the third step to be followed when upgrading?', 'A', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'B', 'Advise next station of upgraded passengers.', 'C', 'Assign seats if possible on last rows of the First Class cabin.', 'D', 'Screen passenger list for upgrading of VIP passengers.', 'E', '', 'C', '', ''),
(137, 20, 'What is the last step to be followed when upgrading?', 'A', 'Advise next station of upgraded passengers.', 'B', 'Check catering supplies and order extra portions if necessary.', 'C', 'Screen passenger list for upgrading of VIP passengers.', 'D', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'E', '', 'A', '', ''),
(138, 20, 'It receives the same allowance as adults.', 'A', 'Senior Fare', 'B', 'Child Fare', 'C', 'Infant fare', 'D', 'None of the above', 'E', '', 'B', '', ''),
(139, 20, 'It is permitted one checked piece. The sum of the 3 dimensions must not exceed 45 inches.', 'A', 'Infant', 'B', 'Child', 'C', 'Adult', 'D', 'None of the above', 'E', '', 'A', '', ''),
(140, 20, 'The maximum total dimensions allowable for cabin stowage is:', 'A', '23 cm x 36 cm x 56 cm = 115 cms. (45 inches)', 'B', '90cm x 65cm x 75 cm = 230 cms. (95 inches)', 'C', '50cm x 40 cm x 25xm = 115 cms. (45 inches)', 'D', 'All of the above', 'E', '', 'C', '', ''),
(141, 20, 'It is also used for a passenger who books a extra seat in order to carry special baggage on that seat.', 'A', 'Baggage Ticket', 'B', 'Excess Baggage Ticket', 'C', 'Passengers Ticket', 'D', 'None of the above', 'E', '', 'B', '', ''),
(142, 20, 'It has to be stapled behind the flight coupons of the passengers ticket.', 'A', 'Audit Coupon', 'B', 'Agent Coupon', 'C', 'Flight Coupon', 'D', 'Passenger Coupon', 'E', '', 'C', '', ''),
(143, 20, 'Any baggage with part or parts of its original contents was or were taken from it.', 'A', 'Pilfered Baggage', 'B', 'Damaged Baggage', 'C', 'Missing Baggage', 'D', 'On-Hand Baggage', 'E', '', 'A', '', ''),
(144, 20, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Missing Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'B', '', ''),
(145, 20, 'It is able to arrange for comparable air transportation which is planned to arrive at his destination / stopover point not later than four hours after the flight he had confirmed reserved space is planned to arrive.', 'A', 'Cebu Pacific', 'B', 'Air Asia', 'C', 'PAL', 'D', 'Skyjet', 'E', '', 'C', '', ''),
(146, 20, 'It is a non-revenue passenger.', 'A', 'Child', 'B', 'Adult', 'C', 'Infant', 'D', 'Passenger', 'E', '', 'D', '', ''),
(147, 20, 'It provides disembarking and transit stations with information on any passengers on a flight requiring assistance or special handling.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'B', '', ''),
(148, 20, 'It provides enroute stations with information regarding transfer passengers and their checked baggage. It is sent to downline stations separately immediately after flight departure.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'C', '', ''),
(149, 20, 'This is where you will request the passenger to put his/her baggage.', 'A', 'Trash Bin', 'B', 'Scale', 'C', 'Under his/her seat', 'D', 'None of the above', 'E', '', 'B', '', ''),
(150, 20, 'It looks like a passengers ticket.', 'A', 'Excess Baggage Ticket', 'B', 'Baggage Ticket', 'C', 'Agent Ticket', 'D', 'Audit Ticket', 'E', '', 'A', '', ''),
(151, 21, 'It is the baggage that is checked in at the counter and loaded in the aircraft.', 'A', 'Unchecked Baggage', 'B', 'Baggage', 'C', 'Checked Baggage', 'D', 'None of the above', 'E', '', 'C', '', ''),
(152, 21, 'Any checked baggage with an airline baggage tag attached, located at a station other than that to which it was tagged.', 'A', 'Found Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'A', '', ''),
(153, 21, 'Any baggage not available to the passenger at the time he is claiming for it.', 'A', 'On-Hand Baggage', 'B', 'Found Baggage', 'C', 'Damaged Baggage', 'D', 'Missing Baggage', 'E', '', 'D', '', ''),
(154, 21, 'What is the no.1 in the General Procedures when Checking-In Passengers?', 'A', 'Greet the passenger.', 'B', 'Request for his ticket and travel documents.', 'C', 'Examine his ticket and travel documents. By this time you will be able to address the passenger by his name.', 'D', 'None of the above', 'E', '', 'A', '', ''),
(155, 21, 'What is the no.14 in the General Procedures when Checking-In Passengers?', 'A', 'Give instructions on where to proceed. Instruct the passenger to proceed to 		the Immigration Counters.', 'B', 'Do not forget to lift the appropriate coupon.', 'C', 'End with pleasantries like Have a nice flight!', 'D', 'None of the above', 'E', '', 'C', '', ''),
(156, 21, 'How many types are there in Boarding Passes?', 'A', '2', 'B', '3', 'C', '4', 'D', '5', 'E', '', 'A', '', ''),
(157, 21, 'What is the first step in Processing Passengers Baggage?', 'A', 'Tag baggage and attach claim checks on the passengers ticket.', 'B', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'C', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'D', 'Release baggage for loading.', 'E', '', 'C', '', ''),
(158, 21, 'What is the third step in Processing Passengers Baggage?', 'A', 'Release baggage for loading.', 'B', 'Tag baggage and attach claim checks on the passengers ticket.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'C', '', ''),
(159, 21, 'What is the last step in Processing Passengers Baggage?', 'A', 'Assess acceptability of the baggage in terms of their nature, packing, size or weight and number of pieces.', 'B', 'Release baggage for loading.', 'C', 'Issue an excess baggage ticket and accept different forms of payment.', 'D', 'Weigh the baggage and if beyond the Free Baggage Allowance, compute for excess baggage charges.', 'E', '', 'B', '', ''),
(160, 21, 'It is issued against the ticket as the legal document between a passenger and an airline company.', 'A', 'Ticket', 'B', 'Passport', 'C', 'Visa', 'D', 'Boarding Pass', 'E', '', 'D', '', ''),
(161, 21, 'Which is not included in the details of the Boarding Pass?', 'A', 'Passengers route', 'B', 'Date', 'C', 'Address', 'D', 'Seat Number', 'E', '', 'C', '', ''),
(162, 21, 'Which is not included in the functions of the Boarding Pass?', 'A', 'To be used for verification at transit stations or during a head-count.', 'B', 'To serve as identification tag for overcoats, raincoat, etc. which are handed over to cabin crew during flight.', 'C', 'All of the above', 'D', 'None of the above', 'E', '', 'D', '', ''),
(163, 21, 'It occurs when a First Class passenger is not accommodated in the First Class section and instead is accommodated at the Economy Class section.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading /Downgrading of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'C', '', ''),
(164, 21, 'It occur when passengers move to a higher class of service.', 'A', 'Upgrading of Passengers', 'B', 'Upgrading/Downgrading  of Passengers', 'C', 'Downgrading of Passengers', 'D', 'None of the above', 'E', '', 'A', '', ''),
(165, 21, 'What is the first step to be followed when upgrading?', 'A', 'Assign seats if possible on last rows of the First Class cabin.', 'B', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'C', 'Advise next station of upgraded passengers.', 'D', 'Check catering supplies and order extra portions if necessary.', 'E', '', 'D', '', ''),
(166, 21, 'What is the third step to be followed when upgrading?', 'A', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'B', 'Advise next station of upgraded passengers.', 'C', 'Assign seats if possible on last rows of the First Class cabin.', 'D', 'Screen passenger list for upgrading of VIP passengers.', 'E', '', 'C', '', ''),
(167, 21, 'What is the last step to be followed when upgrading?', 'A', 'Advise next station of upgraded passengers.', 'B', 'Check catering supplies and order extra portions if necessary.', 'C', 'Screen passenger list for upgrading of VIP passengers.', 'D', 'Advise upgraded passengers that they have to be re accommodated in the Economy Class cabin as soon as Economy seats are available again.', 'E', '', 'A', '', ''),
(168, 21, 'It receives the same allowance as adults.', 'A', 'Senior Fare', 'B', 'Child Fare', 'C', 'Infant fare', 'D', 'None of the above', 'E', '', 'B', '', ''),
(169, 21, 'It is permitted one checked piece. The sum of the 3 dimensions must not exceed 45 inches.', 'A', 'Infant', 'B', 'Child', 'C', 'Adult', 'D', 'None of the above', 'E', '', 'A', '', ''),
(170, 21, 'The maximum total dimensions allowable for cabin stowage is:', 'A', '23 cm x 36 cm x 56 cm = 115 cms. (45 inches)', 'B', '90cm x 65cm x 75 cm = 230 cms. (95 inches)', 'C', '50cm x 40 cm x 25xm = 115 cms. (45 inches)', 'D', 'All of the above', 'E', '', 'C', '', ''),
(171, 21, 'It is also used for a passenger who books a extra seat in order to carry special baggage on that seat.', 'A', 'Baggage Ticket', 'B', 'Excess Baggage Ticket', 'C', 'Passengers Ticket', 'D', 'None of the above', 'E', '', 'B', '', ''),
(172, 21, 'It has to be stapled behind the flight coupons of the passengers ticket.', 'A', 'Audit Coupon', 'B', 'Agent Coupon', 'C', 'Flight Coupon', 'D', 'Passenger Coupon', 'E', '', 'C', '', ''),
(173, 21, 'Any baggage with part or parts of its original contents was or were taken from it.', 'A', 'Pilfered Baggage', 'B', 'Damaged Baggage', 'C', 'Missing Baggage', 'D', 'On-Hand Baggage', 'E', '', 'A', '', ''),
(174, 21, 'Any checked baggage left unclaimed in the customs area, airport hall, or any place in the airport after the owner passenger has had the opportunity to claim it.', 'A', 'Missing Baggage', 'B', 'On-Hand Baggage', 'C', 'Pilfered Baggage', 'D', 'Damaged Baggage', 'E', '', 'B', '', ''),
(175, 21, 'It is able to arrange for comparable air transportation which is planned to arrive at his destination / stopover point not later than four hours after the flight he had confirmed reserved space is planned to arrive.', 'A', 'Cebu Pacific', 'B', 'Air Asia', 'C', 'PAL', 'D', 'Skyjet', 'E', '', 'C', '', ''),
(176, 21, 'It is a non-revenue passenger.', 'A', 'Child', 'B', 'Adult', 'C', 'Infant', 'D', 'Passenger', 'E', '', 'D', '', ''),
(177, 21, 'It provides disembarking and transit stations with information on any passengers on a flight requiring assistance or special handling.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'B', '', ''),
(178, 21, 'It provides enroute stations with information regarding transfer passengers and their checked baggage. It is sent to downline stations separately immediately after flight departure.', 'A', 'PRM', 'B', 'PSM', 'C', 'PTM', 'D', 'PUM', 'E', '', 'C', '', ''),
(179, 21, 'This is where you will request the passenger to put his/her baggage.', 'A', 'Trash Bin', 'B', 'Scale', 'C', 'Under his/her seat', 'D', 'None of the above', 'E', '', 'B', '', ''),
(180, 21, 'It looks like a passengers ticket.', 'A', 'Excess Baggage Ticket', 'B', 'Baggage Ticket', 'C', 'Agent Ticket', 'D', 'Audit Ticket', 'E', '', 'A', '', ''),
(182, 25, 'asdasdasd', 'A', 'asdasd', 'B', 'asasdasd', 'C', 'asdasdasd', 'D', 'gfdgfdg', 'E', 'dfgdfgdfg', 'A', '', ''),
(183, 29, 'asdasdasd', 'A', 'asdasd', 'B', 'ghfgh', 'C', 'jhkjkh', 'D', 'jkhjk', 'E', 'hjkhjkhjk', 'A', '', 'saturn.PNG'),
(184, 35, 'Auwuwjwhwh', 'A', 'Ahsush', 'B', 'Hshsj', 'C', 'Hshssh', 'D', 'Jwjsis', 'E', 'Hsjssj', 'B', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_content`
--

CREATE TABLE `quiz_content` (
  `quiz_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quiz_type` int(11) NOT NULL,
  `quiz_status` int(11) NOT NULL,
  `timer` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `quiz_strand` text NOT NULL,
  `quiz_sem` varchar(155) NOT NULL,
  `quiz_yrlvl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_content`
--

INSERT INTO `quiz_content` (`quiz_id`, `user_id`, `sec_id`, `sub_code`, `quiz_title`, `quiz_date`, `quiz_type`, `quiz_status`, `timer`, `view`, `quiz_strand`, `quiz_sem`, `quiz_yrlvl`) VALUES
(32, 'admin', 0, '32', 'module 2', '2021-02-19 12:53:29', 2, 1, 30, 0, '', '', ''),
(33, 'admin', 0, '32', 'try lang', '2021-02-12 09:04:10', 2, 1, 60, 0, '', '', ''),
(34, 'admin', 0, '32', 'To na melds', '2021-02-11 16:00:00', 2, 0, 60, 0, '', '', ''),
(35, 'admin', 0, '35', ',asdkamsldmasd', '2021-02-19 14:10:56', 1, 1, 10, 0, '', '', ''),
(36, 'admin', 0, '35', 'sample by patrick', '2021-02-13 16:00:00', 1, 0, 10, 0, '', '', ''),
(37, 'admin', 0, '32', 'Gshsgs', '2021-02-18 16:00:00', 1, 0, 12, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(11) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `sub_desc` text NOT NULL,
  `sub_time` text NOT NULL,
  `sub_day` varchar(255) NOT NULL,
  `sub_sem` varchar(255) NOT NULL,
  `sub_year` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_code`, `sec_id`, `sub_desc`, `sub_time`, `sub_day`, `sub_sem`, `sub_year`) VALUES
(1, 'AIS 314', 1, 'Inflight Servicing Procedure', '07:00 - 08:30', 'MWF', '1st Semester', '2019 -  2020');

-- --------------------------------------------------------

--
-- Table structure for table `true_false`
--

CREATE TABLE `true_false` (
  `t_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `m_question` varchar(255) NOT NULL,
  `answer_a` varchar(255) NOT NULL,
  `answer_b` varchar(255) NOT NULL,
  `correct_answer` text NOT NULL,
  `question_link` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `true_false`
--

INSERT INTO `true_false` (`t_id`, `quiz_id`, `m_question`, `answer_a`, `answer_b`, `correct_answer`, `question_link`, `photo`) VALUES
(2, 1, 'CARRIER pertains to the airline, e.g., Philippine Airlines, Inc.', '', '', 'TRUE', '', ''),
(3, 1, 'CONNECTING POINT is the station en route where the passenger has to change aircraft either with the same airline or with a different airline.', '', '', 'TRUE', '', ''),
(4, 1, 'CUSTOMS AREA is where passengers declare the contents and value of their baggage and other things they brought into the country.', '', '', 'TRUE', '', ''),
(5, 1, 'MAAS PASSENGER are passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'TRUE', '', ''),
(6, 1, 'ORIGINATING AIRLINE is the airline transporting the passenger over the first portion of an itinerary.', '', '', 'TRUE', '', ''),
(7, 1, 'IMMEDIATE CONNECTING PASSENGER	is a Transfer passenger who arrives within two hours before ETD of his connecting flight.', '', '', 'TRUE', '', ''),
(8, 1, 'UNCHECKED BAGGAGE is the baggage of which the passenger retains custody.', '', '', 'TRUE', '', ''),
(9, 1, 'The Passenger must hold a ticket valid for travel from point of embarkation to the specified destination.', '', '', 'TRUE', '', ''),
(10, 1, 'In general, the permission to enter a county without a visa is based on the nationality as shown under nationality status in his travel document and not on the country which issued his travel document.', '', '', 'TRUE', '', ''),
(11, 1, 'PASSPORT is an official document issued by a competent public authority to nationals or to alien residents (mostly stateless persons) to be used for travel outside of the territorial domain of such country.', '', '', 'TRUE', '', ''),
(12, 1, 'ELECTRONIC TICKETS (E-TICKETS) are travel tickets that allow someone to travel without carrying a paper ticket; usually purchased over the internet.', '', '', 'TRUE', '', ''),
(13, 1, 'ISSUING AIRLINE is the airline whose name appears in the place of issue box of the passenger ticket.', '', '', 'TRUE', '', ''),
(14, 1, 'CARRIER BOX airline may endorse only the coupon(s) on which its code is shown.', '', '', 'TRUE', '', ''),
(15, 1, 'The coupons and number of boxes on the tickets are all the same, only the lay-out of the tickets may differ.', '', '', 'TRUE', '', ''),
(16, 1, 'The passenger coupon is printed on the inside back cover of the ticket. It constitutes the passengers written evidence of the contract of carriage.', '', '', 'TRUE', '', ''),
(17, 1, 'Intra-Conference Carriage is the carriage from one traffic conference or area to another.', '', '', 'FALSE', '', ''),
(18, 1, 'Local Passenger are the passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'FALSE', '', ''),
(19, 1, 'Left Behind Passenger is a passenger who due to the late arrival or non-operation of his / her original delivering flight, arrives at the interline point by his original delivering flight, a alternative flight or surface transportation, too late to board ', '', '', 'FALSE', '', ''),
(20, 1, 'Misrouted Passenger is a passenger who fails to join a flight on which he / she holds reserved space for reasons other than misconnection.', '', '', 'FALSE', '', ''),
(21, 1, 'Oversale is the situation which exists when more seats have been reserved on a flight than are allowable for sale.', '', '', 'FALSE', '', ''),
(22, 1, 'Return Flight is the flight that had to make an unscheduled stop in a place not included in its flight route.', '', '', 'FALSE', '', ''),
(23, 1, 'Non Restricted National is a passenger who is not allowed to enter the Philippines without a valid visa.', '', '', 'FALSE', '', ''),
(24, 1, 'Transit Without Visa Passenger is a passenger who stays in a place temporarily to connect to another flight for his final destination.', '', '', 'FALSE', '', ''),
(25, 1, 'Legality establish a smooth flow of operation within and among the airlines, the passenger must comply with company requirements.', '', '', 'FALSE', '', ''),
(26, 1, 'A ticket is transferable.', '', '', 'FALSE', '', ''),
(27, 1, 'Audit Coupon - this coupon is for the issuing office. It is detached after the ticket completion and is retained by the issuing office. It is not good for passage.', '', '', 'FALSE', '', ''),
(28, 1, 'Laissez - Passer - is issued by the Canada', '', '', 'FALSE', '', ''),
(29, 1, 'Seaman Discharge Book is issued to crew members.', '', '', 'FALSE', '', ''),
(30, 1, 'Immigrant Visa are those who wish to visit the United States for a limited for some particular reasons.', '', '', 'FALSE', '', ''),
(31, 1, 'Agent Coupon contain the passengers liability and each coupon is valid for travel only between the points outlined in heavy rule in the Good for Passage area of the ticket. These coupons are left in the ticket pass.', '', '', 'FALSE', '', ''),
(32, 9, 'CARRIER pertains to the airline, e.g., Philippine Airlines, Inc.', '', '', 'TRUE', '', ''),
(33, 9, 'CONNECTING POINT is the station en route where the passenger has to change aircraft either with the same airline or with a different airline.', '', '', 'TRUE', '', ''),
(34, 9, 'CUSTOMS AREA is where passengers declare the contents and value of their baggage and other things they brought into the country.', '', '', 'TRUE', '', ''),
(35, 9, 'MAAS PASSENGER are passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'TRUE', '', ''),
(36, 9, 'ORIGINATING AIRLINE is the airline transporting the passenger over the first portion of an itinerary.', '', '', 'TRUE', '', ''),
(37, 9, 'IMMEDIATE CONNECTING PASSENGER	is a Transfer passenger who arrives within two hours before ETD of his connecting flight.', '', '', 'TRUE', '', ''),
(38, 9, 'UNCHECKED BAGGAGE is the baggage of which the passenger retains custody.', '', '', 'TRUE', '', ''),
(39, 9, 'The Passenger must hold a ticket valid for travel from point of embarkation to the specified destination.', '', '', 'TRUE', '', ''),
(40, 9, 'In general, the permission to enter a county without a visa is based on the nationality as shown under nationality status in his travel document and not on the country which issued his travel document.', '', '', 'TRUE', '', ''),
(41, 9, 'PASSPORT is an official document issued by a competent public authority to nationals or to alien residents (mostly stateless persons) to be used for travel outside of the territorial domain of such country.', '', '', 'TRUE', '', ''),
(42, 9, 'ELECTRONIC TICKETS (E-TICKETS) are travel tickets that allow someone to travel without carrying a paper ticket; usually purchased over the internet.', '', '', 'TRUE', '', ''),
(43, 9, 'ISSUING AIRLINE is the airline whose name appears in the place of issue box of the passenger ticket.', '', '', 'TRUE', '', ''),
(44, 9, 'CARRIER BOX airline may endorse only the coupon(s) on which its code is shown.', '', '', 'TRUE', '', ''),
(45, 9, 'The coupons and number of boxes on the tickets are all the same, only the lay-out of the tickets may differ.', '', '', 'TRUE', '', ''),
(46, 9, 'The passenger coupon is printed on the inside back cover of the ticket. It constitutes the passengers written evidence of the contract of carriage.', '', '', 'TRUE', '', ''),
(47, 9, 'Intra-Conference Carriage is the carriage from one traffic conference or area to another.', '', '', 'FALSE', '', ''),
(48, 9, 'Local Passenger are the passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'FALSE', '', ''),
(49, 9, 'Left Behind Passenger is a passenger who due to the late arrival or non-operation of his / her original delivering flight, arrives at the interline point by his original delivering flight, a alternative flight or surface transportation, too late to board ', '', '', 'FALSE', '', ''),
(50, 9, 'Misrouted Passenger is a passenger who fails to join a flight on which he / she holds reserved space for reasons other than misconnection.', '', '', 'FALSE', '', ''),
(51, 9, 'Oversale is the situation which exists when more seats have been reserved on a flight than are allowable for sale.', '', '', 'FALSE', '', ''),
(52, 9, 'Return Flight is the flight that had to make an unscheduled stop in a place not included in its flight route.', '', '', 'FALSE', '', ''),
(53, 9, 'Non Restricted National is a passenger who is not allowed to enter the Philippines without a valid visa.', '', '', 'FALSE', '', ''),
(54, 9, 'Transit Without Visa Passenger is a passenger who stays in a place temporarily to connect to another flight for his final destination.', '', '', 'FALSE', '', ''),
(55, 9, 'Legality establish a smooth flow of operation within and among the airlines, the passenger must comply with company requirements.', '', '', 'FALSE', '', ''),
(56, 9, 'A ticket is transferable.', '', '', 'FALSE', '', ''),
(57, 9, 'Audit Coupon - this coupon is for the issuing office. It is detached after the ticket completion and is retained by the issuing office. It is not good for passage.', '', '', 'FALSE', '', ''),
(58, 9, 'Laissez - Passer - is issued by the Canada', '', '', 'FALSE', '', ''),
(59, 9, 'Seaman Discharge Book is  issued to crew members.', '', '', 'FALSE', '', ''),
(60, 9, 'Immigrant Visa are those who wish to visit the United States for a limited for some particular reasons.', '', '', 'FALSE', '', ''),
(61, 9, 'Agent Coupon contain the passengers liability and each coupon is valid for travel only between the points outlined in heavy rule in the Good for Passage area of the ticket. These coupons are left in the ticket pass.', '', '', 'FALSE', '', ''),
(62, 13, 'CARRIER pertains to the airline, e.g., Philippine Airlines, Inc.', '', '', 'TRUE', '', ''),
(63, 13, 'CONNECTING POINT is the station en route where the passenger has to change aircraft either with the same airline or with a different airline.', '', '', 'TRUE', '', ''),
(64, 13, 'CUSTOMS AREA is where passengers declare the contents and value of their baggage and other things they brought into the country', '', '', 'TRUE', '', ''),
(65, 13, 'MAAS PASSENGER are passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'TRUE', '', ''),
(66, 13, 'ORIGINATING AIRLINE is the airline transporting the passenger over the first portion of an itinerary.', '', '', 'TRUE', '', ''),
(67, 13, 'IMMEDIATE CONNECTING PASSENGER	is a Transfer passenger who arrives within two hours before ETD of his connecting flight.', '', '', 'TRUE', '', ''),
(68, 13, 'UNCHECKED BAGGAGE is the baggage of which the passenger retains custody.', '', '', 'TRUE', '', ''),
(69, 13, 'The Passenger must hold a ticket valid for travel from point of embarkation to the specified destination.', '', '', 'TRUE', '', ''),
(70, 13, 'In general, the permission to enter a county without a visa is based on the nationality as shown under nationality status in his travel document and not on the country which issued his travel document.', '', '', 'TRUE', '', ''),
(71, 13, 'PASSPORT is an official document issued by a competent public authority to nationals or to alien residents (mostly stateless persons) to be used for travel outside of the territorial domain of such country.', '', '', 'TRUE', '', ''),
(72, 13, 'ELECTRONIC TICKETS (E-TICKETS) are travel tickets that allow someone to travel without carrying a paper ticket; usually purchased over the internet.', '', '', 'TRUE', '', ''),
(73, 13, 'ISSUING AIRLINE is the airline whose name appears in the place of issue box of the passenger ticket.', '', '', 'TRUE', '', ''),
(74, 13, 'CARRIER BOX airline may endorse only the coupon(s) on which its code is shown.', '', '', 'TRUE', '', ''),
(75, 13, 'The coupons and number of boxes on the tickets are all the same, only the lay-out of the tickets may differ.', '', '', 'TRUE', '', ''),
(76, 13, 'The passenger coupon is printed on the inside back cover of the ticket. It constitutes the passengers written evidence of the contract of carriage.', '', '', 'TRUE', '', ''),
(77, 13, 'Intra-Conference Carriage is the carriage from one traffic conference or area to another.', '', '', 'FALSE', '', ''),
(78, 13, 'Local Passenger are the passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'FALSE', '', ''),
(79, 13, 'Left Behind Passenger is a passenger who due to the late arrival or non-operation of his / her original delivering flight, arrives at the interline point by his original delivering flight, a alternative flight or surface transportation, too late to board ', '', '', 'FALSE', '', ''),
(80, 13, 'Misrouted Passenger is a passenger who fails to join a flight on which he / she holds reserved space for reasons other than misconnection.', '', '', 'FALSE', '', ''),
(81, 13, 'Oversale is the situation which exists when more seats have been reserved on a flight than are allowable for sale.', '', '', 'FALSE', '', ''),
(82, 13, 'Return Flight is the flight that had to make an unscheduled stop in a place not included in its flight route.', '', '', 'FALSE', '', ''),
(83, 13, 'Non Restricted National is a passenger who is not allowed to enter the Philippines without a valid visa.', '', '', 'FALSE', '', ''),
(84, 13, 'Transit Without Visa Passenger is a passenger who stays in a place temporarily to connect to another flight for his final destination.', '', '', 'FALSE', '', ''),
(85, 13, 'Legality establish a smooth flow of operation within and among the airlines, the passenger must comply with company requirements.', '', '', 'FALSE', '', ''),
(86, 13, 'A ticket is transferable.', '', '', 'FALSE', '', ''),
(87, 13, 'Audit Coupon - this coupon is for the issuing office. It is detached after the ticket completion and is retained by the issuing office. It is not good for passage.', '', '', 'FALSE', '', ''),
(88, 13, 'Laissez Passer is issued by the Canada.', '', '', 'FALSE', '', ''),
(89, 13, 'Seaman Discharge Book is issued to crew members.', '', '', 'FALSE', '', ''),
(90, 13, 'Immigrant Visa are those who wish to visit the United States for a limited for some particular reasons.', '', '', 'FALSE', '', ''),
(91, 13, 'Agent Coupon contain the passengers liability and each coupon is valid for travel only between the points outlined in heavy rule in the Good for Passage area of the ticket. These coupons are left in the ticket pass.', '', '', 'FALSE', '', ''),
(92, 14, 'CARRIER pertains to the airline, e.g., Philippine Airlines, Inc.', '', '', 'TRUE', '', ''),
(93, 14, 'CONNECTING POINT is the station en route where the passenger has to change aircraft either with the same airline or with a different airline.', '', '', 'TRUE', '', ''),
(94, 14, 'CUSTOMS AREA is where passengers declare the contents and value of their baggage and other things they brought into the country', '', '', 'TRUE', '', ''),
(95, 14, 'MAAS PASSENGER are passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'TRUE', '', ''),
(96, 14, 'ORIGINATING AIRLINE is the airline transporting the passenger over the first portion of an itinerary.', '', '', 'TRUE', '', ''),
(97, 14, 'IMMEDIATE CONNECTING PASSENGER	is a Transfer passenger who arrives within two hours before ETD of his connecting flight.', '', '', 'TRUE', '', ''),
(98, 14, 'UNCHECKED BAGGAGE is the baggage of which the passenger retains custody.', '', '', 'TRUE', '', ''),
(99, 14, 'The Passenger must hold a ticket valid for travel from point of embarkation to the specified destination.', '', '', 'TRUE', '', ''),
(100, 14, 'In general, the permission to enter a county without a visa is based on the nationality as shown under nationality status in his travel document and not on the country which issued his travel document.', '', '', 'TRUE', '', ''),
(101, 14, 'PASSPORT is an official document issued by a competent public authority to nationals or to alien residents (mostly stateless persons) to be used for travel outside of the territorial domain of such country.', '', '', 'TRUE', '', ''),
(102, 14, 'ELECTRONIC TICKETS (E-TICKETS) are travel tickets that allow someone to travel without carrying a paper ticket; usually purchased over the internet.', '', '', 'TRUE', '', ''),
(103, 14, 'ISSUING AIRLINE is the airline whose name appears in the place of issue box of the passenger ticket.', '', '', 'TRUE', '', ''),
(104, 14, 'CARRIER BOX airline may endorse only the coupon(s) on which its code is shown.', '', '', 'TRUE', '', ''),
(105, 14, 'The coupons and number of boxes on the tickets are all the same, only the lay-out of the tickets may differ.', '', '', 'TRUE', '', ''),
(106, 14, 'The passenger coupon is printed on the inside back cover of the ticket. It constitutes the passengers written evidence of the contract of carriage.', '', '', 'TRUE', '', ''),
(107, 14, 'Intra-Conference Carriage is the carriage from one traffic conference or area to another.', '', '', 'FALSE', '', ''),
(108, 14, 'Local Passenger are the passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'FALSE', '', ''),
(109, 14, 'Left Behind Passenger is a passenger who due to the late arrival or non-operation of his / her original delivering flight, arrives at the interline point by his original delivering flight, a alternative flight or surface transportation, too late to board ', '', '', 'FALSE', '', ''),
(110, 14, 'Misrouted Passenger is a passenger who fails to join a flight on which he / she holds reserved space for reasons other than misconnection.', '', '', 'FALSE', '', ''),
(111, 14, 'Oversale is the situation which exists when more seats have been reserved on a flight than are allowable for sale.', '', '', 'FALSE', '', ''),
(112, 14, 'Return Flight is the flight that had to make an unscheduled stop in a place not included in its flight route.', '', '', 'FALSE', '', ''),
(113, 14, 'Non Restricted National is a passenger who is not allowed to enter the Philippines without a valid visa.', '', '', 'FALSE', '', ''),
(114, 14, 'Transit Without Visa Passenger is a passenger who stays in a place temporarily to connect to another flight for his final destination.', '', '', 'FALSE', '', ''),
(115, 14, 'Legality establish a smooth flow of operation within and among the airlines, the passenger must comply with company requirements.', '', '', 'FALSE', '', ''),
(116, 14, 'A ticket is transferable.', '', '', 'FALSE', '', ''),
(117, 14, 'Audit Coupon - this coupon is for the issuing office. It is detached after the ticket completion and is retained by the issuing office. It is not good for passage.', '', '', 'FALSE', '', ''),
(118, 14, 'Laissez Passer is issued by the Canada.', '', '', 'FALSE', '', ''),
(119, 14, 'Seaman Discharge Book is issued to crew members.', '', '', 'FALSE', '', ''),
(120, 14, 'Immigrant Visa are those who wish to visit the United States for a limited for some particular reasons.', '', '', 'FALSE', '', ''),
(121, 14, 'Agent Coupon contain the passengers liability and each coupon is valid for travel only between the points outlined in heavy rule in the Good for Passage area of the ticket. These coupons are left in the ticket pass.', '', '', 'FALSE', '', ''),
(122, 18, 'CARRIER pertains to the airline, e.g., Philippine Airlines, Inc.', '', '', 'TRUE', '', ''),
(123, 18, 'CONNECTING POINT is the station en route where the passenger has to change aircraft either with the same airline or with a different airline.', '', '', 'TRUE', '', ''),
(124, 18, 'CUSTOMS AREA is where passengers declare the contents and value of their baggage and other things they brought into the country', '', '', 'TRUE', '', ''),
(125, 18, 'MAAS PASSENGER are passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'TRUE', '', ''),
(126, 18, 'ORIGINATING AIRLINE is the airline transporting the passenger over the first portion of an itinerary.', '', '', 'TRUE', '', ''),
(127, 18, 'IMMEDIATE CONNECTING PASSENGER	is a Transfer passenger who arrives within two hours before ETD of his connecting flight.', '', '', 'TRUE', '', ''),
(128, 18, 'UNCHECKED BAGGAGE is the baggage of which the passenger retains custody.', '', '', 'TRUE', '', ''),
(129, 18, 'The Passenger must hold a ticket valid for travel from point of embarkation to the specified destination.', '', '', 'TRUE', '', ''),
(130, 18, 'In general, the permission to enter a county without a visa is based on the nationality as shown under nationality status in his travel document and not on the country which issued his travel document.', '', '', 'TRUE', '', ''),
(131, 18, 'PASSPORT is an official document issued by a competent public authority to nationals or to alien residents (mostly stateless persons) to be used for travel outside of the territorial domain of such country.', '', '', 'TRUE', '', ''),
(132, 18, 'ELECTRONIC TICKETS (E-TICKETS) are travel tickets that allow someone to travel without carrying a paper ticket; usually purchased over the internet.', '', '', 'TRUE', '', ''),
(133, 18, 'ISSUING AIRLINE is the airline whose name appears in the place of issue box of the passenger ticket.', '', '', 'TRUE', '', ''),
(134, 18, 'CARRIER BOX airline may endorse only the coupon(s) on which its code is shown.', '', '', 'TRUE', '', ''),
(135, 18, 'The coupons and number of boxes on the tickets are all the same, only the lay-out of the tickets may differ.', '', '', 'TRUE', '', ''),
(136, 18, 'The passenger coupon is printed on the inside back cover of the ticket. It constitutes the passengers written evidence of the contract of carriage.', '', '', 'TRUE', '', ''),
(137, 18, 'Intra-Conference Carriage is the carriage from one traffic conference or area to another.', '', '', 'FALSE', '', ''),
(138, 18, 'Local Passenger Passengers are the passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'FALSE', '', ''),
(139, 18, 'Left Behind Passenger is a passenger who due to the late arrival or non-operation of his / her original delivering flight, arrives at the interline point by his original delivering flight, a alternative flight or surface transportation, too late to board ', '', '', 'FALSE', '', ''),
(140, 18, 'Misrouted Passenger is a passenger who fails to join a flight on which he / she holds reserved space for reasons other than misconnection.', '', '', 'FALSE', '', ''),
(141, 18, 'Oversale is the situation which exists when more seats have been reserved on a flight than are allowable for sale.', '', '', 'FALSE', '', ''),
(142, 18, 'Return Flight is the flight that had to make an unscheduled stop in a place not included in its flight route.', '', '', 'FALSE', '', ''),
(143, 18, 'Non Restricted National is a passenger who is not allowed to enter the Philippines without a valid visa.', '', '', 'FALSE', '', ''),
(144, 18, 'Transit Without Visa Passenger is a passenger who stays in a place temporarily to connect to another flight for his final destination.', '', '', 'FALSE', '', ''),
(145, 18, 'Legality establish a smooth flow of operation within and among the airlines, the passenger must comply with company requirements.', '', '', 'FALSE', '', ''),
(146, 18, 'A ticket is transferable.', '', '', 'FALSE', '', ''),
(147, 18, 'Audit Coupon - this coupon is for the issuing office. It is detached after the ticket completion and is retained by the issuing office. It is not good for passage.', '', '', 'FALSE', '', ''),
(148, 18, 'Laissez Passer is issued by the Canada.', '', '', 'FALSE', '', ''),
(149, 18, 'Seaman Discharge Book is issued to crew members.', '', '', 'FALSE', '', ''),
(150, 18, 'Immigrant Visa are those who wish to visit the United States for a limited for some particular reasons.', '', '', 'FALSE', '', ''),
(151, 18, 'Agent Coupon contain the passengers liability and each coupon is valid for travel only between the points outlined in heavy rule in the Good for Passage area of the ticket. These coupons are left in the ticket pass.', '', '', 'FALSE', '', ''),
(152, 23, 'CARRIER pertains to the airline, e.g., Philippine Airlines, Inc.', '', '', 'TRUE', '', ''),
(153, 23, 'CONNECTING POINT is the station en route where the passenger has to change aircraft either with the same airline or with a different airline.', '', '', 'TRUE', '', ''),
(154, 23, 'CUSTOMS AREA is where passengers declare the contents and value of their baggage and other things they brought into the country', '', '', 'TRUE', '', ''),
(155, 23, 'MAAS PASSENGER are passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'TRUE', '', ''),
(156, 23, 'ORIGINATING AIRLINE is the airline transporting the passenger over the first portion of an itinerary.', '', '', 'TRUE', '', ''),
(157, 23, 'IMMEDIATE CONNECTING PASSENGER	is a Transfer passenger who arrives within two hours before ETD of his connecting flight.', '', '', 'TRUE', '', ''),
(158, 23, 'UNCHECKED BAGGAGE is the baggage of which the passenger retains custody.', '', '', 'TRUE', '', ''),
(159, 23, 'The Passenger must hold a ticket valid for travel from point of embarkation to the specified destination.', '', '', 'TRUE', '', ''),
(160, 23, 'In general, the permission to enter a county without a visa is based on the nationality as shown under nationality status in his travel document and not on the country which issued his travel document.', '', '', 'TRUE', '', ''),
(161, 23, 'PASSPORT is an official document issued by a competent public authority to nationals or to alien residents (mostly stateless persons) to be used for travel outside of the territorial domain of such country.', '', '', 'TRUE', '', ''),
(162, 23, 'ELECTRONIC TICKETS (E-TICKETS) are travel tickets that allow someone to travel without carrying a paper ticket; usually purchased over the internet.', '', '', 'TRUE', '', ''),
(163, 23, 'ISSUING AIRLINE is the airline whose name appears in the place of issue box of the passenger ticket.', '', '', 'TRUE', '', ''),
(164, 23, 'CARRIER BOX airline may endorse only the coupon(s) on which its code is shown.', '', '', 'TRUE', '', ''),
(165, 23, 'The coupons and number of boxes on the tickets are all the same, only the lay-out of the tickets may differ.', '', '', 'TRUE', '', ''),
(166, 23, 'The passenger coupon is printed on the inside back cover of the ticket. It constitutes the passengers written evidence of the contract of carriage.', '', '', 'TRUE', '', ''),
(167, 23, 'Intra-Conference Carriage is the carriage from one traffic conference or area to another.', '', '', 'FALSE', '', ''),
(168, 23, 'Local Passenger Passengers are the passengers who need to be met and assisted upon arrival due to some special assistance they need.', '', '', 'FALSE', '', ''),
(169, 23, 'Left Behind Passenger is a passenger who due to the late arrival or non-operation of his / her original delivering flight, arrives at the interline point by his original delivering flight, a alternative flight or surface transportation, too late to board ', '', '', 'FALSE', '', ''),
(170, 23, 'Misrouted Passenger is a passenger who fails to join a flight on which he / she holds reserved space for reasons other than misconnection.', '', '', 'FALSE', '', ''),
(171, 23, 'Oversale is the situation which exists when more seats have been reserved on a flight than are allowable for sale.', '', '', 'FALSE', '', ''),
(172, 23, 'Return Flight is the flight that had to make an unscheduled stop in a place not included in its flight route.', '', '', 'FALSE', '', ''),
(173, 23, 'Non Restricted National is a passenger who is not allowed to enter the Philippines without a valid visa.', '', '', 'FALSE', '', ''),
(174, 23, 'Transit Without Visa Passenger is a passenger who stays in a place temporarily to connect to another flight for his final destination.', '', '', 'FALSE', '', ''),
(175, 23, 'Legality establish a smooth flow of operation within and among the airlines, the passenger must comply with company requirements.', '', '', 'FALSE', '', ''),
(176, 23, 'A ticket is transferable.', '', '', 'FALSE', '', ''),
(177, 23, 'Audit Coupon - this coupon is for the issuing office. It is detached after the ticket completion and is retained by the issuing office. It is not good for passage.', '', '', 'FALSE', '', ''),
(178, 23, 'Laissez Passer is issued by the Canada.', '', '', 'FALSE', '', ''),
(179, 23, 'Seaman Discharge Book is issued to crew members.', '', '', 'FALSE', '', ''),
(180, 23, 'Immigrant Visa are those who wish to visit the United States for a limited for some particular reasons.', '', '', 'FALSE', '', ''),
(181, 23, 'Agent Coupon contain the passengers liability and each coupon is valid for travel only between the points outlined in heavy rule in the Good for Passage area of the ticket. These coupons are left in the ticket pass.', '', '', 'FALSE', '', ''),
(182, 26, 'true or false first question', '', '', 'TRUE', '', 'IMG20201123155915.jpg'),
(183, 28, 'Test sample hfhdjsksiw', '', '', 'TRUE', '', 'IMG20210126163247_00.jpg'),
(184, 28, 'Test question number 2', '', '', 'FALSE', '', ''),
(185, 32, 'Man is humankind', '', '', 'TRUE', '', ''),
(186, 32, 'Is zandro pogi?', '', '', 'TRUE', '', ''),
(187, 32, 'Is zandro pogi', '', '', 'TRUE', '', ''),
(188, 32, 'Habbahaha', '', '', 'TRUE', '', 'MODULE-7-AIS-314.docx.pdf'),
(189, 32, 'Habbahaha', '', '', 'TRUE', '', 'MODULE-7-AIS-314.docx.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `idno` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `year_lvl` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `sec_id`, `idno`, `pass`, `lname`, `mname`, `fname`, `address`, `email`, `sem`, `strand`, `year_lvl`, `course`, `major`, `role`, `user_photo`, `user_status`) VALUES
(69, 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Bumanlag', '', 'Imelda', 'Pasay City', 'admin@gmail.com', '', '', '', '', '', 2, 'yh.png', 1),
(126, 1, '11111', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Octubre', 'Sotolombo', 'Mikee', 'Pasay City', 'octubremikeeg@gmail.com', '1st Semester', '', '1st Year', '', '', 4, '25-512.png', 1),
(123, 0, 'INST3-18-2004', '12d2274e174cdb153d52cdf270746c65', 'Caguia', 'Casangcapan', 'Cielito', 'Cavite City', 'ccphilsca@gmail.com', '', '', '', '', '', 3, '22.jpg', 1),
(142, 1, '11718-011999', 'b9d4e765a412c55897ad15f39fe5ef60', 'Dela Cruz', 'Javier', 'Maria', 'Pasay City', 'mjavier@gmail.com', '', '', '', '', '', 4, 'nophoto.jpg', 1),
(141, 1, '1234567', 'fcea920f7412b5da7be0cf42b8c93759', 'Cruz', 'Luna', 'Juan', 'Manila', 'juan@gmai.com', '', '', '', '', '', 4, 'nophoto.jpg', 0),
(140, 1, '11718-011980', 'aef2195fb4c2c551638fa94eb888903f', 'Bumanlag', 'Santillan', 'Imelda', 'Pasay City', 'imelda09@gmail.com', '', '', '', '', '', 4, 'nophoto.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_subject`
--
ALTER TABLE `assign_subject`
  ADD PRIMARY KEY (`assignID`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`docu_id`);

--
-- Indexes for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `main_folder`
--
ALTER TABLE `main_folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indexes for table `multiple_choice`
--
ALTER TABLE `multiple_choice`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `quiz_content`
--
ALTER TABLE `quiz_content`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `true_false`
--
ALTER TABLE `true_false`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_subject`
--
ALTER TABLE `assign_subject`
  MODIFY `assignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `docu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `exam_result`
--
ALTER TABLE `exam_result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `main_folder`
--
ALTER TABLE `main_folder`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `multiple_choice`
--
ALTER TABLE `multiple_choice`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `quiz_content`
--
ALTER TABLE `quiz_content`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `true_false`
--
ALTER TABLE `true_false`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
