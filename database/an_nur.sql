-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2025 at 02:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `an_nur`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_class_teacher`
--

CREATE TABLE `assign_class_teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_class_teacher`
--

INSERT INTO `assign_class_teacher` (`id`, `class_id`, `teacher_id`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 2, 26, 0, 0, 1, '2024-10-17 22:13:33', '2024-10-17 22:13:33'),
(6, 1, 27, 0, 0, 1, '2024-10-17 22:14:22', '2024-10-17 22:14:22'),
(14, 2, 28, 0, 0, 1, '2024-10-27 19:00:02', '2024-10-28 19:44:42'),
(16, 8, 2, 0, 0, 1, '2024-10-30 12:14:58', '2024-10-30 12:14:58'),
(18, 5, 26, 0, 0, 1, '2024-11-01 10:14:46', '2024-11-01 10:14:46'),
(19, 3, 31, 0, 0, 1, '2024-11-01 10:15:16', '2024-11-01 10:15:16'),
(20, 6, 32, 0, 0, 1, '2024-11-01 10:45:29', '2024-11-01 10:45:29'),
(21, 7, 33, 0, 0, 1, '2024-11-01 10:45:59', '2024-11-01 10:45:59'),
(22, 3, 33, 0, 0, 1, '2024-11-11 11:24:18', '2024-11-11 11:24:18'),
(23, 2, 32, 0, 0, 1, '2024-11-20 12:06:23', '2024-11-20 12:06:23'),
(24, 2, 27, 0, 0, 1, '2024-11-20 12:06:24', '2024-11-20 12:06:24'),
(27, 9, 37, 0, 0, 1, '2024-12-20 21:28:53', '2024-12-20 21:28:53'),
(28, 4, 37, 0, 0, 1, '2024-12-20 21:36:40', '2024-12-20 21:36:40'),
(29, 4, 26, 0, 0, 1, '2024-12-20 21:36:40', '2024-12-20 21:36:40'),
(30, 4, 2, 0, 0, 1, '2024-12-20 21:36:40', '2024-12-20 21:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not read, 1:read',
  `created_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active, 1:inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not, 1:yes',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `amount`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'JSS 1D', 25000, 0, 0, 1, '2024-09-03 20:51:42', '2025-05-29 19:29:58'),
(2, 'JSS 1C', 25000, 0, 0, 1, '2024-09-03 21:40:17', '2025-05-29 19:29:31'),
(3, 'JSS 1B', 25000, 0, 0, 1, '2024-09-04 19:59:29', '2025-05-29 19:29:09'),
(4, 'JSS 1A', 25000, 0, 0, 1, '2024-09-04 20:00:21', '2025-05-29 19:30:22'),
(5, 'JSS 2A', 20000, 0, 0, 1, '2024-09-06 11:32:30', '2025-05-28 12:11:21'),
(6, 'JSS 2B', 20000, 0, 0, 1, '2024-09-06 11:32:49', '2025-05-28 12:11:04'),
(7, 'JSS 2C', 20000, 0, 0, 1, '2024-09-06 11:33:25', '2025-05-28 12:10:22'),
(8, 'JSS 3A', 20000, 0, 0, 1, '2024-09-06 11:34:43', '2025-05-28 12:10:01'),
(9, 'PART TERM', 35000, 0, 0, 1, '2024-12-20 21:22:55', '2025-05-28 12:09:26'),
(10, 'SS 2F', 30000, 0, 0, 1, '2025-05-28 12:08:30', '2025-05-28 12:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject`
--

CREATE TABLE `class_subject` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 1, 0, 0, '2024-09-06 16:47:50', '2024-09-06 16:47:50'),
(2, 5, 3, 1, 0, 0, '2024-09-06 16:47:50', '2024-09-06 16:47:50'),
(3, 5, 1, 1, 0, 0, '2024-09-06 16:47:50', '2024-09-06 16:47:50'),
(4, 5, 4, 1, 0, 0, '2024-09-06 16:47:50', '2024-09-06 16:47:50'),
(5, 8, 5, 1, 0, 0, '2024-09-06 16:49:31', '2024-09-06 16:49:31'),
(6, 8, 3, 1, 0, 0, '2024-09-06 16:49:31', '2024-09-06 16:49:31'),
(7, 8, 7, 1, 0, 0, '2024-09-06 16:49:31', '2024-09-06 16:49:31'),
(8, 8, 1, 1, 1, 0, '2024-09-06 16:49:31', '2024-09-06 21:23:39'),
(9, 3, 7, 1, 0, 0, '2024-09-06 16:50:16', '2024-09-06 16:50:16'),
(10, 3, 1, 1, 0, 0, '2024-09-06 16:50:16', '2024-09-06 16:50:16'),
(11, 3, 4, 1, 0, 0, '2024-09-06 16:50:16', '2024-09-06 16:50:16'),
(12, 3, 2, 1, 0, 0, '2024-09-06 16:50:16', '2024-09-06 16:50:16'),
(28, 1, 3, 1, 0, 0, '2024-09-06 22:35:35', '2024-09-06 22:35:35'),
(29, 1, 7, 1, 0, 0, '2024-09-06 22:35:36', '2024-09-06 22:35:36'),
(30, 1, 2, 1, 0, 0, '2024-09-06 22:35:36', '2024-09-07 22:27:48'),
(31, 1, 5, 1, 0, 0, '2024-09-06 22:35:36', '2024-09-07 22:26:24'),
(37, 4, 5, 1, 0, 0, '2024-09-07 22:28:18', '2024-09-07 22:28:18'),
(38, 4, 3, 1, 0, 0, '2024-09-07 22:28:18', '2024-09-07 22:28:18'),
(39, 7, 5, 1, 0, 0, '2024-10-17 12:07:06', '2024-10-17 12:07:06'),
(40, 7, 1, 1, 0, 0, '2024-10-17 12:07:06', '2024-10-17 12:07:06'),
(41, 7, 2, 1, 0, 0, '2024-10-17 12:07:06', '2024-10-17 12:07:06'),
(42, 4, 1, 1, 0, 0, '2024-10-22 20:47:56', '2024-10-22 20:47:56'),
(43, 4, 2, 1, 0, 0, '2024-10-22 20:47:56', '2024-10-22 20:47:56'),
(44, 8, 4, 1, 0, 0, '2024-11-01 20:26:45', '2024-11-01 20:26:45'),
(45, 8, 2, 1, 0, 0, '2024-11-01 20:26:45', '2024-11-01 20:26:45'),
(46, 8, 6, 1, 0, 0, '2024-11-01 20:26:45', '2024-11-01 20:26:45'),
(47, 2, 5, 1, 0, 0, '2024-11-20 12:07:08', '2024-11-20 12:07:08'),
(48, 2, 1, 1, 0, 0, '2024-11-20 12:07:08', '2024-11-20 12:07:08'),
(49, 2, 2, 1, 0, 0, '2024-11-20 12:07:08', '2024-11-20 12:07:08'),
(50, 9, 5, 1, 0, 0, '2024-12-20 21:26:36', '2024-12-20 21:26:36'),
(51, 9, 3, 1, 0, 0, '2024-12-20 21:26:36', '2024-12-20 21:26:36'),
(52, 9, 7, 1, 0, 0, '2024-12-20 21:26:36', '2024-12-20 21:26:36'),
(53, 9, 1, 1, 0, 0, '2024-12-20 21:26:36', '2024-12-20 21:26:36'),
(54, 9, 2, 1, 0, 0, '2024-12-20 21:26:36', '2024-12-20 21:26:36'),
(55, 9, 6, 1, 0, 0, '2024-12-20 21:26:36', '2024-12-20 21:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject_timetable`
--

CREATE TABLE `class_subject_timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subject_timetable`
--

INSERT INTO `class_subject_timetable` (`id`, `class_id`, `subject_id`, `week_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(6, 4, 2, 1, '11:00', '13:00', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(7, 4, 2, 2, '08:30', '09:30', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(8, 4, 2, 3, '10:30', '11:30', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(9, 4, 2, 4, '16:03', '17:30', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(10, 4, 2, 5, '07:00', '20:00', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(11, 4, 2, 6, '13:30', '14:30', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(12, 4, 2, 7, '10:00', '11:00', '12345', '2024-11-05 18:36:05', '2024-11-05 18:36:05'),
(13, 3, 2, 1, '07:00', '08:00', '1', '2024-11-12 12:35:00', '2024-11-12 12:35:00'),
(14, 3, 2, 2, '09:00', '10:00', '1', '2024-11-12 12:35:00', '2024-11-12 12:35:00'),
(15, 3, 2, 3, '11:00', '00:00', '1', '2024-11-12 12:35:00', '2024-11-12 12:35:00'),
(16, 3, 2, 4, '13:00', '14:00', '1', '2024-11-12 12:35:00', '2024-11-12 12:35:00'),
(17, 3, 2, 5, '08:00', '09:00', '1', '2024-11-12 12:35:00', '2024-11-12 12:35:00'),
(18, 3, 2, 6, '08:30', '09:30', '1', '2024-11-12 12:35:00', '2024-11-12 12:35:00'),
(19, 2, 2, 1, '08:00', '09:00', '2', '2024-11-20 12:14:41', '2024-11-20 12:14:41'),
(20, 2, 2, 2, '08:00', '09:30', '2', '2024-11-20 12:14:41', '2024-11-20 12:14:41'),
(21, 2, 2, 3, '08:00', '09:20', '2', '2024-11-20 12:14:41', '2024-11-20 12:14:41'),
(22, 2, 2, 4, '09:00', '10:00', '2', '2024-11-20 12:14:41', '2024-11-20 12:14:41'),
(23, 2, 2, 5, '10:00', '11:00', '2', '2024-11-20 12:14:41', '2024-11-20 12:14:41'),
(24, 9, 6, 1, '09:29', '10:29', '1', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(25, 9, 6, 2, '09:29', '11:29', '2', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(26, 9, 6, 3, '23:30', '23:30', '1', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(27, 9, 6, 4, '10:30', '11:30', '2', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(28, 9, 6, 5, '10:31', '11:31', '1', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(29, 9, 6, 6, '23:31', '00:31', '3', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(30, 9, 6, 7, '09:31', '10:31', '3', '2024-12-20 21:32:08', '2024-12-20 21:32:08'),
(31, 3, 4, 1, '17:39', '17:40', '1', '2025-01-22 17:40:37', '2025-01-22 17:40:37'),
(32, 3, 4, 2, '19:39', '17:42', '2', '2025-01-22 17:40:37', '2025-01-22 17:40:37'),
(33, 3, 4, 3, '20:39', '17:43', '2', '2025-01-22 17:40:37', '2025-01-22 17:40:37'),
(34, 3, 4, 4, '21:39', '17:45', '2', '2025-01-22 17:40:37', '2025-01-22 17:40:37'),
(35, 3, 4, 5, '17:45', '17:46', '1', '2025-01-22 17:40:37', '2025-01-22 17:40:37'),
(38, 3, 10, 1, '19:40', '17:44', '1', '2025-01-22 17:52:46', '2025-01-22 17:52:46'),
(39, 3, 10, 2, '17:44', '17:45', '2', '2025-01-22 17:52:46', '2025-01-22 17:52:46'),
(40, 3, 10, 3, '20:42', '17:47', '3', '2025-01-22 17:52:46', '2025-01-22 17:52:46'),
(41, 3, 10, 4, '17:56', '17:57', '2', '2025-01-22 17:52:46', '2025-01-22 17:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `name`, `note`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'FIRST TERM EXAM 2022/2023', 'note 1', 1, 0, '2024-11-21 16:01:59', '2024-12-14 20:59:19'),
(2, 'FIRST TERM EXAM 2023/2024', 'note 2', 1, 0, '2024-11-21 16:03:06', '2024-12-13 21:56:38'),
(3, 'FIRST TERM EXAM 2024/2025', 'note 3', 1, 0, '2024-11-21 16:03:31', '2024-12-14 21:07:06'),
(4, 'SECOND TERM 2024/2025', 'ALL SECTIONS', 1, 0, '2025-01-21 20:45:08', '2025-01-21 20:45:08'),
(5, 'THIRD TERM 2024/2025', '', 1, 0, '2025-02-17 12:12:24', '2025-02-17 12:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `room_number` varchar(25) DEFAULT NULL,
  `full_marks` varchar(25) DEFAULT NULL,
  `passing_mark` varchar(25) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_marks`, `passing_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 3, 4, 2, '2024-12-29', '05:59', '05:59', '1', '100', '60', 1, '2025-01-23 18:02:54', '2025-01-23 18:02:54'),
(3, 3, 4, 1, '2024-12-30', '06:59', '05:01', '1', '100', '70', 1, '2025-01-23 18:02:54', '2025-01-23 18:02:54'),
(4, 3, 4, 3, '2025-01-01', '06:00', '06:02', '3', '100', '70', 1, '2025-01-23 18:02:54', '2025-01-23 18:02:54'),
(5, 3, 4, 5, '2025-01-02', '06:03', '06:04', '2', '100', '60', 1, '2025-01-23 18:02:54', '2025-01-23 18:02:54'),
(21, 1, 4, 2, '2025-01-02', '11:11', '10:10', 'A101', '100', '65', 1, '2025-01-23 22:11:15', '2025-01-23 22:11:15'),
(22, 1, 4, 1, '2025-01-02', '09:27', '10:28', '1', '100', '65', 1, '2025-01-23 22:11:15', '2025-01-23 22:11:15'),
(23, 1, 4, 3, '2025-01-08', '09:28', '09:29', '3', '100', '65', 1, '2025-01-23 22:11:15', '2025-01-23 22:11:15'),
(26, 1, 2, 2, '2024-12-30', '10:58', '11:00', 'B101', '100', '80', 1, '2025-01-25 22:00:14', '2025-01-25 22:00:14'),
(27, 1, 2, 1, '2025-01-01', '11:59', '12:59', '1', '100', '60', 1, '2025-01-25 22:00:14', '2025-01-25 22:00:14'),
(28, 1, 2, 5, '2025-01-03', '09:59', '11:59', '3', '100', '70', 1, '2025-01-25 22:00:15', '2025-01-25 22:00:15'),
(29, 4, 8, 6, '2025-01-02', '10:15', '00:15', 'A101', '100', '65', 1, '2025-01-25 22:16:20', '2025-01-25 22:16:20'),
(30, 4, 8, 2, '2025-01-10', '10:16', '11:16', '1', '100', '60', 1, '2025-01-25 22:16:20', '2025-01-25 22:16:20'),
(31, 1, 1, 5, '2025-01-01', '10:23', '00:23', 'B101', '100', '60', 1, '2025-01-25 22:24:01', '2025-01-25 22:24:01'),
(32, 1, 1, 2, '2025-01-03', '12:23', '14:23', '1', '100', '60', 1, '2025-01-25 22:24:01', '2025-01-25 22:24:01'),
(33, 1, 5, 4, '2025-01-01', '10:03', '11:04', 'B101', '100', '80', 1, '2025-02-13 11:44:35', '2025-02-13 11:44:35'),
(34, 1, 5, 1, '2025-01-02', '10:06', '00:07', '1', '100', '70', 1, '2025-02-13 11:44:35', '2025-02-13 11:44:35'),
(35, 1, 5, 3, '2025-01-30', '11:43', '12:44', '3', '100', '70', 1, '2025-02-13 11:44:35', '2025-02-13 11:44:35'),
(36, 1, 5, 5, '2025-02-27', '11:44', '13:44', '2', '100', '60', 1, '2025-02-13 11:44:35', '2025-02-13 11:44:35'),
(37, 2, 4, 2, '2025-01-29', '12:02', '13:03', 'B101', '100', '80', 1, '2025-02-13 12:03:41', '2025-02-13 12:03:41'),
(38, 2, 4, 1, '2025-01-30', '12:02', '14:04', '1', '100', '70', 1, '2025-02-13 12:03:42', '2025-02-13 12:03:42'),
(39, 2, 4, 3, '2025-02-05', '13:03', '15:03', '3', '100', '70', 1, '2025-02-13 12:03:42', '2025-02-13 12:03:42'),
(40, 2, 4, 5, '2025-01-30', '12:04', '14:03', '2', '100', '60', 1, '2025-02-13 12:03:42', '2025-02-13 12:03:42'),
(41, 4, 2, 2, '2025-01-28', '12:24', '13:25', '111', '100', '60', 1, '2025-02-17 12:25:19', '2025-02-17 12:25:19'),
(42, 4, 2, 1, '2025-02-05', '14:24', '15:24', '112', '100', '60', 1, '2025-02-17 12:25:19', '2025-02-17 12:25:19'),
(43, 4, 2, 5, '2025-02-02', '15:25', '16:25', '113', '100', '60', 1, '2025-02-17 12:25:19', '2025-02-17 12:25:19'),
(44, 4, 4, 2, '2024-12-31', '08:30', '10:39', '2', '100', '60', 1, '2025-02-28 22:46:26', '2025-02-28 22:46:26'),
(45, 4, 4, 1, '2025-01-01', '09:11', '11:30', '3', '100', '70', 1, '2025-02-28 22:46:26', '2025-02-28 22:46:26'),
(46, 4, 4, 3, '2025-02-04', '14:30', '16:30', '1', '100', '70', 1, '2025-02-28 22:46:26', '2025-02-28 22:46:26'),
(47, 4, 4, 5, '2025-02-12', '08:09', '10:09', '1', '100', '70', 1, '2025-02-28 22:46:26', '2025-02-28 22:46:26'),
(48, 5, 4, 2, '2025-01-27', '08:00', '10:00', '11', '100', '75', 1, '2025-02-28 22:54:00', '2025-02-28 22:54:00'),
(49, 5, 4, 1, '2025-02-04', '10:00', '12:00', '10', '100', '70', 1, '2025-02-28 22:54:01', '2025-02-28 22:54:01'),
(50, 1, 3, 2, '2025-03-06', '09:54', '10:54', 'A101', '100', '65', 1, '2025-03-13 09:56:32', '2025-03-13 09:56:32'),
(51, 1, 3, 4, '2025-03-06', '11:55', '00:55', '1', '100', '60', 1, '2025-03-13 09:56:32', '2025-03-13 09:56:32'),
(52, 1, 3, 1, '2025-03-12', '09:55', '11:55', '3', '100', '70', 1, '2025-03-13 09:56:32', '2025-03-13 09:56:32'),
(53, 1, 3, 7, '2025-03-12', '13:56', '14:56', '2', '100', '65', 1, '2025-03-13 09:56:32', '2025-03-13 09:56:32'),
(54, 3, 2, 2, '2025-02-26', '10:49', '11:50', 'A101', '100', '60', 1, '2025-03-13 10:52:22', '2025-03-13 10:52:22'),
(55, 3, 2, 1, '2025-02-27', '10:50', '11:50', '1', '100', '70', 1, '2025-03-13 10:52:22', '2025-03-13 10:52:22'),
(56, 3, 2, 5, '2025-03-05', '10:50', '11:52', '3', '100', '70', 1, '2025-03-13 10:52:22', '2025-03-13 10:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `class_id`, `subject_id`, `homework_date`, `submission_date`, `document_file`, `description`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 4, 5, '2025-04-12', '2025-04-15', NULL, 'sdfgh, sdfgth, sdfgh.', 1, 1, '2025-04-15 21:42:07', '2025-04-17 21:20:28'),
(2, 3, 1, '2025-04-12', '2025-07-07', '20250508124635aiqzqme3nhipatvn90i8.doc', 'CVBNM, CVBGNHJM, 123456&nbsp;', 1, 1, '2025-04-15 22:01:14', '2025-05-17 17:11:40'),
(3, 3, 2, '2025-04-15', '2025-04-17', '20250508124709f8o4rwqxkyg8v7uchzkr.pdf', 'CVBNM, CVBGNHJM', 0, 1, '2025-04-17 21:03:07', '2025-05-08 12:47:09'),
(4, 4, 5, '2025-04-12', '2025-04-15', '202504170904084uqb1cij65x88ighse0j.pdf', 'sdfgh, sdfgth, sdfgh.', 1, 1, '2025-04-17 21:04:09', '2025-05-08 12:47:26'),
(5, 4, 37, '2025-04-12', '2025-04-17', NULL, 'sdfgh, sdfgth, sdfgh.', 0, 1, '2025-04-17 21:15:59', '2025-04-17 21:15:59'),
(6, 3, 12, '2025-04-17', '2025-04-26', '20250417091803zsau5xxd6btuhkmnpmru.pptx', 'CVBNM, CVBGNHJM', 0, 1, '2025-04-17 21:18:03', '2025-04-17 21:18:03'),
(7, 3, 12, '2025-04-19', '2025-04-26', NULL, 'CVBNM, CVBGNHJM', 0, 1, '2025-04-17 21:19:31', '2025-04-17 21:19:31'),
(8, 3, 2, '2025-04-18', '2025-04-20', NULL, 'I always submit my assignment', 1, 1, '2025-04-17 21:28:20', '2025-04-17 21:28:46'),
(9, 4, 5, '2025-04-12', '2025-04-25', NULL, 'sdfgh, sdfgth, sdfgh.', 1, 1, '2025-04-17 21:34:27', '2025-04-17 21:50:47'),
(10, 4, 5, '2025-04-12', '2025-04-17', NULL, 'sdfgh, sdfgth, sdfgh.', 1, 1, '2025-04-17 22:16:02', '2025-04-17 22:23:40'),
(11, 4, 3, '2025-04-12', '2025-09-09', '20250508124522filq9cixckeycxyqjwaa.pptx', 'sdfgh, sdfgth, 123456.', 0, 1, '2025-04-17 22:23:15', '2025-05-08 12:45:22'),
(12, 2, 7, '2025-04-17', '2025-04-21', '20250417103040xh9n0ffs13slshyh8gxj.pdf', 'are you ready?', 0, 1, '2025-04-17 22:30:40', '2025-04-17 22:30:40'),
(13, 4, 5, '2025-04-12', '2025-04-19', '2025041809473729l24ybnkna4fsdj1t5x.pdf', 'sdfgh, sdfgth, sdfgh.', 0, 1, '2025-04-18 09:47:37', '2025-04-18 09:47:37'),
(14, 3, 4, '2025-05-17', '2025-05-22', '20250517044455dzakdl7o8fs4tvvpc3kt.docx', 'hello', 0, 31, '2025-05-17 16:44:55', '2025-05-17 18:28:45'),
(15, 3, 5, '2025-05-17', '2025-05-17', '20250517064017dw9kejqmeqq6g2hq4a6m.docx', 'xcdfg', 0, 31, '2025-05-17 18:40:17', '2025-05-17 18:40:17'),
(16, 3, 5, '2025-05-17', '2025-05-17', '20250517064139zngxz5unnnxrhhuql4lp.docx', 'c vnm', 0, 31, '2025-05-17 18:41:39', '2025-05-17 18:41:39'),
(17, 2, 3, '2025-05-17', '2025-05-17', NULL, 'XDFGHJ', 0, 26, '2025-05-17 19:09:43', '2025-05-17 19:09:43'),
(18, 2, 1, '2025-05-17', '2025-05-19', '20250517071337x1jdhnx2at2znpdxxgxr.docx', 'VBHNJKL;', 0, 28, '2025-05-17 19:13:37', '2025-05-17 19:13:37'),
(19, 3, 4, '2025-05-22', '2025-05-24', '20250522095728jzhlyvrkm2egrvq8kzej.docx', 'here is an attached', 0, 1, '2025-05-22 21:57:28', '2025-05-22 21:57:28'),
(20, 4, 6, '2025-05-22', '2025-05-23', '202505220959521psk8fdevbs4mtazu7m3.docx', 'i am from chaina', 0, 1, '2025-05-22 21:59:52', '2025-05-22 21:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `homework_submit`
--

CREATE TABLE `homework_submit` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework_submit`
--

INSERT INTO `homework_submit` (`id`, `homework_id`, `student_id`, `description`, `document_file`, `created_at`, `updated_at`) VALUES
(1, 13, 22, 'asdfgh', '20250519125303dij0pg2vjdwx8xsjpai3.docx', '2025-05-19 12:53:03', '2025-05-19 12:53:03'),
(2, 11, 22, 'cvbnm', '20250519012702p3dgfffuxifd7gpgdgku.docx', '2025-05-19 13:27:02', '2025-05-19 13:27:02'),
(3, 19, 40, 'find attached', '20250527052358bptnw5t2h15evaewgjqa.docx', '2025-05-27 17:23:58', '2025-05-27 17:23:58'),
(4, 15, 40, 'here is my assignment submitted', '20250527052444jpu82abtptufyvvkesiz.docx', '2025-05-27 17:24:44', '2025-05-27 17:24:44'),
(5, 3, 40, 'submitted', '20250527052521wswq9rwog2hq6sbk3b28.docx', '2025-05-27 17:25:21', '2025-05-27 17:25:21'),
(6, 18, 41, 'submited', '20250704111656xgbed9qpwiymov5fm5go.docx', '2025-07-04 11:16:56', '2025-07-04 11:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `marks_grade`
--

CREATE TABLE `marks_grade` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `percent_from` int(11) DEFAULT 0,
  `percent_to` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks_grade`
--

INSERT INTO `marks_grade` (`id`, `name`, `percent_from`, `percent_to`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'A', 70, 100, 1, '2025-03-10 11:37:35', '2025-08-08 20:14:23'),
(2, 'B', 60, 69, 1, '2025-03-12 22:22:31', '2025-08-08 20:14:50'),
(3, 'C', 50, 59, 1, '2025-03-12 22:23:28', '2025-08-08 20:15:18'),
(4, 'D', 45, 49, 1, '2025-03-12 22:24:47', '2025-08-08 20:16:05'),
(5, 'E', 40, 44, 1, '2025-03-12 22:25:57', '2025-08-08 20:16:31'),
(6, 'F', 0, 39, 1, '2025-03-13 08:40:05', '2025-03-13 08:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `mark_register`
--

CREATE TABLE `mark_register` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `ca1` int(11) DEFAULT 0,
  `ca2` int(11) DEFAULT 0,
  `ca3` int(11) DEFAULT 0,
  `exam` int(11) NOT NULL DEFAULT 0,
  `full_marks` int(11) NOT NULL DEFAULT 0,
  `passing_mark` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mark_register`
--

INSERT INTO `mark_register` (`id`, `student_id`, `exam_id`, `class_id`, `subject_id`, `ca1`, `ca2`, `ca3`, `exam`, `full_marks`, `passing_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 38, 2, 4, 2, 10, 10, 19, 60, 100, 80, 1, '2025-02-27 12:38:16', '2025-02-27 13:14:29'),
(2, 38, 2, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-02-27 12:38:16', '2025-02-27 13:14:56'),
(3, 38, 2, 4, 3, 10, 20, 8, 57, 100, 70, 1, '2025-02-27 12:38:16', '2025-02-27 13:14:56'),
(4, 38, 2, 4, 5, 10, 10, 10, 40, 100, 60, 1, '2025-02-27 12:38:16', '2025-02-27 13:14:56'),
(5, 38, 4, 4, 2, 12, 15, 12, 13, 100, 60, 1, '2025-02-28 22:48:15', '2025-02-28 22:48:15'),
(6, 38, 4, 4, 1, 17, 13, 11, 14, 100, 70, 1, '2025-02-28 22:48:15', '2025-02-28 22:48:15'),
(7, 38, 4, 4, 3, 11, 14, 10, 14, 100, 70, 1, '2025-02-28 22:48:15', '2025-02-28 22:48:15'),
(8, 38, 4, 4, 5, 10, 15, 9, 50, 100, 70, 1, '2025-02-28 22:48:15', '2025-02-28 22:48:15'),
(9, 38, 5, 4, 2, 17, 10, 21, 35, 100, 75, 1, '2025-02-28 22:55:07', '2025-02-28 22:55:07'),
(10, 38, 5, 4, 1, 11, 9, 18, 45, 100, 70, 1, '2025-02-28 22:55:07', '2025-02-28 22:55:07'),
(11, 22, 2, 4, 2, 10, 10, 11, 54, 100, 80, 1, '2025-03-06 21:22:56', '2025-03-06 21:30:32'),
(12, 22, 2, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-03-06 21:22:56', '2025-03-06 21:22:56'),
(13, 22, 2, 4, 3, 10, 20, 10, 57, 100, 70, 1, '2025-03-06 21:23:27', '2025-03-06 21:26:03'),
(14, 22, 2, 4, 5, 10, 10, 11, 40, 100, 60, 1, '2025-03-06 21:23:30', '2025-03-06 21:29:59'),
(15, 8, 2, 4, 2, 10, 10, 9, 60, 100, 80, 1, '2025-03-13 08:43:25', '2025-03-13 08:44:18'),
(16, 8, 2, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-03-13 08:43:43', '2025-03-13 08:44:18'),
(17, 8, 2, 4, 3, 10, 8, 10, 49, 100, 70, 1, '2025-03-13 08:44:00', '2025-03-13 08:44:19'),
(18, 8, 2, 4, 5, 10, 10, 11, 40, 100, 60, 1, '2025-03-13 08:44:14', '2025-03-13 08:44:14'),
(19, 8, 4, 4, 2, 10, 10, 9, 65, 100, 60, 1, '2025-03-13 09:22:41', '2025-03-13 09:23:28'),
(20, 8, 4, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-03-13 09:22:56', '2025-03-13 09:23:28'),
(21, 8, 4, 4, 3, 10, 8, 10, 50, 100, 70, 1, '2025-03-13 09:23:10', '2025-03-13 09:23:28'),
(22, 8, 4, 4, 5, 10, 10, 11, 40, 100, 70, 1, '2025-03-13 09:23:24', '2025-03-13 09:23:24'),
(23, 29, 4, 4, 2, 10, 10, 9, 60, 100, 60, 1, '2025-03-13 09:25:55', '2025-03-13 09:25:55'),
(24, 29, 4, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-03-13 09:26:08', '2025-03-13 09:26:08'),
(25, 29, 4, 4, 3, 10, 20, 10, 45, 100, 70, 1, '2025-03-13 09:26:22', '2025-03-13 09:26:22'),
(26, 29, 4, 4, 5, 10, 10, 11, 40, 100, 70, 1, '2025-03-13 09:26:38', '2025-03-13 09:26:38'),
(27, 21, 4, 4, 2, 20, 20, 20, 20, 100, 60, 1, '2025-03-13 09:27:25', '2025-03-13 09:27:25'),
(28, 21, 4, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-03-13 09:27:41', '2025-03-13 09:27:41'),
(29, 21, 4, 4, 3, 10, 20, 10, 45, 100, 70, 1, '2025-03-13 09:27:59', '2025-03-13 09:27:59'),
(30, 21, 4, 4, 5, 10, 10, 11, 40, 100, 70, 1, '2025-03-13 09:28:13', '2025-03-13 09:28:13'),
(31, 22, 4, 4, 2, 20, 20, 20, 20, 100, 60, 1, '2025-03-13 09:38:09', '2025-03-13 09:38:09'),
(32, 22, 4, 4, 1, 10, 9, 8, 55, 100, 70, 1, '2025-03-13 09:38:24', '2025-03-13 09:38:57'),
(33, 22, 4, 4, 3, 10, 20, 10, 50, 100, 70, 1, '2025-03-13 09:38:38', '2025-03-13 09:38:38'),
(34, 22, 4, 4, 5, 10, 10, 11, 40, 100, 70, 1, '2025-03-13 09:38:52', '2025-03-13 09:38:52'),
(35, 38, 1, 4, 2, 10, 10, 9, 40, 100, 65, 1, '2025-03-13 09:41:13', '2025-03-13 09:41:13'),
(36, 38, 1, 4, 1, 10, 9, 8, 55, 100, 65, 1, '2025-03-13 09:41:31', '2025-03-13 09:41:31'),
(37, 38, 1, 4, 3, 10, 20, 10, 50, 100, 65, 1, '2025-03-13 09:42:09', '2025-03-13 09:42:09'),
(38, 29, 1, 4, 2, 10, 10, 9, 40, 100, 65, 1, '2025-03-13 09:42:52', '2025-03-13 09:44:04'),
(39, 29, 1, 4, 1, 10, 7, 8, 8, 100, 65, 1, '2025-03-13 09:43:08', '2025-03-13 09:43:29'),
(40, 29, 1, 4, 3, 10, 8, 10, 10, 100, 65, 1, '2025-03-13 09:43:25', '2025-03-13 09:43:29'),
(41, 40, 1, 3, 2, 10, 10, 9, 65, 100, 65, 1, '2025-03-13 10:05:38', '2025-03-13 10:06:28'),
(42, 40, 1, 3, 4, 10, 9, 8, 55, 100, 60, 1, '2025-03-13 10:05:53', '2025-03-13 10:06:28'),
(43, 40, 1, 3, 1, 10, 20, 10, 49, 100, 70, 1, '2025-03-13 10:06:10', '2025-03-13 10:06:10'),
(44, 40, 1, 3, 7, 10, 10, 11, 40, 100, 65, 1, '2025-03-13 10:06:24', '2025-03-13 10:06:24'),
(45, 39, 1, 3, 2, 10, 10, 10, 65, 100, 65, 1, '2025-03-13 10:08:44', '2025-03-13 10:08:44'),
(46, 39, 1, 3, 4, 10, 9, 8, 55, 100, 60, 1, '2025-03-13 10:09:02', '2025-03-13 10:09:43'),
(47, 39, 1, 3, 1, 10, 8, 10, 66, 100, 70, 1, '2025-03-13 10:09:18', '2025-03-13 10:09:43'),
(48, 39, 1, 3, 7, 10, 10, 11, 40, 100, 65, 1, '2025-03-13 10:09:39', '2025-03-13 10:09:39'),
(49, 41, 3, 2, 2, 10, 10, 10, 60, 100, 60, 1, '2025-03-13 10:55:25', '2025-03-13 10:55:25'),
(50, 41, 3, 2, 1, 10, 7, 8, 55, 100, 70, 1, '2025-03-13 10:55:37', '2025-03-13 10:55:37'),
(51, 41, 3, 2, 5, 10, 20, 10, 45, 100, 70, 1, '2025-03-13 10:55:53', '2025-03-13 10:55:53'),
(52, 22, 1, 4, 2, 10, 8, 20, 60, 100, 65, 1, '2025-08-10 22:24:07', '2025-08-10 22:24:07'),
(53, 22, 1, 4, 1, 10, 9, 8, 55, 100, 65, 1, '2025-08-10 22:24:16', '2025-08-10 22:24:16'),
(54, 22, 1, 4, 3, 10, 8, 10, 50, 100, 65, 1, '2025-08-10 22:24:27', '2025-08-10 22:24:27'),
(55, 29, 2, 4, 2, 10, 9, 11, 50, 100, 80, 1, '2025-08-12 20:38:38', '2025-08-12 20:39:33'),
(56, 29, 2, 4, 1, 10, 8, 10, 55, 100, 70, 1, '2025-08-12 20:38:56', '2025-08-12 20:39:33'),
(57, 29, 2, 4, 3, 9, 10, 9, 57, 100, 70, 1, '2025-08-12 20:39:12', '2025-08-12 20:39:33'),
(58, 29, 2, 4, 5, 10, 10, 11, 40, 100, 60, 1, '2025-08-12 20:39:27', '2025-08-12 20:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

CREATE TABLE `notice_board` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notice_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice_board`
--

INSERT INTO `notice_board` (`id`, `title`, `notice_date`, `publish_date`, `message`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'Admission', '2025-04-06', '2025-04-08', '<div style=\"color: rgb(204, 204, 204); background-color: rgb(31, 31, 31); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\"><div><span style=\"color: #808080;\">&lt;</span><span style=\"color: #569cd6;\">p</span><span style=\"color: #808080;\">&gt;</span>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; was born and I will give you a complete account of the system, and expound the actual teachings</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; of the great explorer of the truth, the master-builder of human happiness. No one rejects,</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; but because occasionally circumstances occur in which toil and pain can procure him some great</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; except to obtain some advantage from it? But who has any right to find fault with a man who</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; produces no resultant pleasure? On the other hand, we denounce with righteous indignation and</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; blinded by desire, that they cannot foresee<span style=\"color: #808080;\">&lt;/</span><span style=\"color: #569cd6;\">p</span><span style=\"color: #808080;\">&gt;</span></div></div>', 1, '2025-04-08 13:46:06', '2025-04-08 13:46:06'),
(4, 'event', '2025-04-07', '2025-04-10', '<div style=\"color: rgb(204, 204, 204); background-color: rgb(31, 31, 31); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\"><div><span style=\"color: #808080;\">&lt;</span><span style=\"color: #569cd6;\">p</span><span style=\"color: #808080;\">&gt;</span>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; was born and I will give you a complete account of the system, and expound the actual teachings</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; of the great explorer of the truth, the master-builder of human happiness. No one rejects,</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; but because occasionally circumstances occur in which toil and pain can procure him some great</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; except to obtain some advantage from it? But who has any right to find fault with a man who</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; produces no resultant pleasure? On the other hand, we denounce with righteous indignation and</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; blinded by desire, that they cannot foresee<span style=\"color: #808080;\">&lt;/</span><span style=\"color: #569cd6;\">p</span><span style=\"color: #808080;\">&gt;</span></div></div>', 1, '2025-04-08 13:50:09', '2025-04-09 23:46:32'),
(5, 'speech', '2025-04-04', '2025-04-10', '<div style=\"color: rgb(204, 204, 204); background-color: rgb(31, 31, 31); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\"><div><span style=\"color: #808080;\">&lt;</span><span style=\"color: #569cd6;\">p</span><span style=\"color: #808080;\">&gt;</span>Post-ironic shabby chic VHS, Marfa keytar flannel lomo try-hard keffiyeh cray. Actually fap fanny</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; pack yr artisan trust fund. High Life dreamcatcher church-key gentrify. Tumblr stumptown four dollar</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; toast vinyl, cold-pressed try-hard blog authentic keffiyeh Helvetica lo-fi tilde Intelligentsia. Lomo</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; locavore salvia bespoke, twee fixie paleo cliche brunch Schlitz blog McSweeney\'s messenger bag swag</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; slow-carb. Odd Future photo booth pork belly, you probably haven\'t heard of them actually tofu ennui</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; keffiyeh lo-fi Truffaut health goth. Narwhal sustainable retro disrupt.<span style=\"color: #808080;\">&lt;/</span><span style=\"color: #569cd6;\">p</span><span style=\"color: #808080;\">&gt;</span></div></div>', 1, '2025-04-10 22:25:41', '2025-04-10 22:25:41'),
(6, 'price', '2025-04-07', '2025-04-10', 'i am very sorry, xcvbnm,. bnm,. sdfghjxcvbasdfghsdt', 1, '2025-04-10 22:27:30', '2025-04-10 22:27:30');

-- --------------------------------------------------------

--
-- Table structure for table `notice_board_message`
--

CREATE TABLE `notice_board_message` (
  `id` int(11) NOT NULL,
  `notice_board_id` int(11) DEFAULT NULL,
  `message_to` int(11) DEFAULT NULL COMMENT 'user_type',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice_board_message`
--

INSERT INTO `notice_board_message` (`id`, `notice_board_id`, `message_to`, `created_at`, `updated_at`) VALUES
(1, 3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 3, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 5, 3, '2025-04-10 22:25:42', '2025-04-10 22:25:42'),
(17, 5, 4, '2025-04-10 22:25:42', '2025-04-10 22:25:42'),
(18, 5, 2, '2025-04-10 22:25:42', '2025-04-10 22:25:42'),
(19, 6, 3, '2025-04-10 22:27:30', '2025-04-10 22:27:30'),
(20, 4, 4, '2025-04-12 13:57:26', '2025-04-12 13:57:26'),
(21, 4, 2, '2025-04-12 13:57:26', '2025-04-12 13:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `exam_description` text DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `paystack_key` varchar(500) DEFAULT NULL,
  `paystack_secret` varchar(500) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fevicon_icon` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `school_name`, `exam_description`, `paypal_email`, `paystack_key`, `paystack_secret`, `logo`, `fevicon_icon`, `created_at`, `updated_at`) VALUES
(1, 'AN-NUR MODEL ISLAMIC SCHOOL', '', '', 'pk_test_336a18695498026643e57fa34136dddef1e54ee4', 'sk_test_de0cf9d0395858d39611c35e80636e10eda77696', '20250807095720afxespwkbm.jpg', '20250807095720nxrt2k94ko.png', '2025-06-03 13:06:20', '2025-08-07 21:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_add_fees`
--

CREATE TABLE `student_add_fees` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT 0,
  `paid_amount` int(11) DEFAULT 0,
  `remaining_amount` int(11) DEFAULT 0,
  `payment_type` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `is_payment` tinyint(4) NOT NULL DEFAULT 0,
  `payment_data` text DEFAULT NULL,
  `paystack_reference` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_add_fees`
--

INSERT INTO `student_add_fees` (`id`, `student_id`, `class_id`, `total_amount`, `paid_amount`, `remaining_amount`, `payment_type`, `remark`, `is_payment`, `payment_data`, `paystack_reference`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 39, 3, 25000, 2000, 23000, 'cash', 'vbnm,', 1, NULL, NULL, 1, '2025-06-02 10:56:14', '2025-06-02 10:56:14'),
(2, 41, 2, 25000, 3000, 22000, 'cash', 'fghh', 1, NULL, NULL, 1, '2025-06-02 10:58:56', '2025-06-02 10:58:56'),
(3, 40, 3, 25000, 5000, 20000, 'cheque', 'dfg', 1, NULL, NULL, 1, '2025-06-02 11:22:11', '2025-06-02 11:22:11'),
(4, 29, 4, 25000, 0, 0, 'cash', 'dfgh', 1, NULL, NULL, 1, '2025-06-02 11:24:15', '2025-06-02 11:24:15'),
(5, 41, 2, 22000, 20000, 2000, 'cash', 'fgh', 1, NULL, NULL, 1, '2025-06-02 11:26:07', '2025-06-02 11:26:07'),
(7, 40, 40, 20000, 2000, 18000, 'paypal', NULL, 1, NULL, NULL, 40, '2025-06-02 17:10:35', '2025-06-02 17:10:35'),
(8, 40, 40, 20000, 0, 0, 'paypal', 'DFG', 1, NULL, NULL, 40, '2025-06-07 17:11:26', '2025-06-02 17:11:26'),
(10, 40, 3, 20000, 4000, 16000, 'paypal', 'paid', 0, NULL, NULL, 40, '2025-06-04 11:10:51', '2025-06-04 11:10:51'),
(11, 40, 3, 20000, 4000, 16000, 'paypal', 'paid', 0, NULL, NULL, 40, '2025-06-04 11:23:35', '2025-06-04 11:23:35'),
(12, 40, 3, 20000, 12, 19988, 'paypal', NULL, 0, NULL, NULL, 40, '2025-06-04 11:29:51', '2025-06-04 11:29:51'),
(13, 40, 3, 20000, 23, 19977, 'paypal', NULL, 1, NULL, NULL, 40, '2025-06-07 20:49:58', '2025-06-04 20:49:58'),
(14, 22, 4, 25000, 0, 0, 'cash', 'paid once', 1, NULL, NULL, 1, '2025-06-28 20:24:43', '2025-06-28 20:24:43'),
(15, 39, 3, 23000, 20000, 3000, 'cheque', 'paid', 1, NULL, NULL, 1, '2025-07-02 20:16:13', '2025-07-02 20:16:13'),
(16, 41, 2, 2000, 0, 0, 'cash', 'paid', 1, NULL, NULL, 1, '2025-07-02 20:18:14', '2025-07-02 20:18:14'),
(17, 21, 4, 25000, 10000, 15000, 'cash', 'pay', 1, NULL, NULL, 1, '2025-08-06 10:54:41', '2025-08-06 10:54:41'),
(18, 21, 4, 15000, 5000, 10000, 'cash', 'paid', 1, NULL, NULL, 1, '2025-08-06 11:16:10', '2025-08-06 11:16:10'),
(19, 40, 3, 19977, 10000, 9977, 'paystack', 'pay', 0, NULL, NULL, 40, '2025-08-06 11:34:16', '2025-08-06 11:34:16'),
(20, 40, 3, 19977, 10000, 9977, 'paystack', 'PAID', 0, NULL, NULL, 40, '2025-08-06 13:46:21', '2025-08-06 13:46:21'),
(21, 40, 3, 19977, 233, 19744, 'paystack', 'ghj', 0, NULL, NULL, 40, '2025-08-06 13:55:43', '2025-08-06 13:55:43'),
(22, 40, 3, 19977, 1000, 18977, 'paystack', 'transfer', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5214456706,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"22\",\"receipt_number\":null,\"amount\":100000,\"message\":\"test-3ds\",\"gateway_response\":\"[Test] Approved\",\"paid_at\":\"2025-08-06T14:01:43.000Z\",\"created_at\":\"2025-08-06T14:01:00.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.93.175\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754488859,\"time_spent\":37,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":28},{\"type\":\"auth\",\"message\":\"Authentication Required: 3DS\",\"time\":29},{\"type\":\"action\",\"message\":\"Third-party authentication window opened\",\"time\":35},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":37},{\"type\":\"action\",\"message\":\"Third-party authentication window closed\",\"time\":37}]},\"fees\":1500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_udeza91pki\",\"bin\":\"408408\",\"last4\":\"0409\",\"exp_month\":\"01\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_frB8WyN70Q1Zaq6c21qC\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297638606,\"first_name\":null,\"last_name\":null,\"email\":\"idrisfati@gmail.com\",\"customer_code\":\"CUS_dgx3rio1j3tkc4f\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T14:01:43.000Z\",\"createdAt\":\"2025-08-06T14:01:00.000Z\",\"requested_amount\":100000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T14:01:00.000Z\",\"plan_object\":[],\"subaccount\":[]}}', NULL, 40, '2025-08-06 14:00:51', '2025-08-06 14:01:38'),
(23, 40, 3, 18977, 10000, 8977, 'paystack', 'fgh', 0, NULL, NULL, 40, '2025-08-06 14:02:17', '2025-08-06 14:02:17'),
(24, 40, 3, 18977, 10000, 8977, 'paystack', 'paid', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5214473163,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"24\",\"receipt_number\":null,\"amount\":1000000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T14:09:03.000Z\",\"created_at\":\"2025-08-06T14:08:32.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.93.175\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754489307,\"time_spent\":29,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":28},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":29}]},\"fees\":25000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_4u3v8et8nj\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297638606,\"first_name\":null,\"last_name\":null,\"email\":\"idrisfati@gmail.com\",\"customer_code\":\"CUS_dgx3rio1j3tkc4f\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T14:09:03.000Z\",\"createdAt\":\"2025-08-06T14:08:32.000Z\",\"requested_amount\":1000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T14:08:32.000Z\",\"plan_object\":[],\"subaccount\":[]}}', NULL, 40, '2025-08-06 14:08:23', '2025-08-06 14:08:58'),
(25, 21, 4, 10000, 0, 0, 'paystack', 'paid balance', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5214480172,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"25\",\"receipt_number\":null,\"amount\":1000000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T14:12:09.000Z\",\"created_at\":\"2025-08-06T14:11:37.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.93.175\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754489493,\"time_spent\":30,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"auth\",\"message\":\"Authentication Required: vault otp\",\"time\":6},{\"type\":\"action\",\"message\":\"Set payment method to: card\",\"time\":17},{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":29},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":30}]},\"fees\":25000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_2dbfwek2rp\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297643204,\"first_name\":null,\"last_name\":null,\"email\":\"zainab@gmail.com\",\"customer_code\":\"CUS_u2dbvicrp2d0s8m\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T14:12:09.000Z\",\"createdAt\":\"2025-08-06T14:11:37.000Z\",\"requested_amount\":1000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T14:11:37.000Z\",\"plan_object\":[],\"subaccount\":[]}}', NULL, 25, '2025-08-06 14:11:29', '2025-08-06 14:12:05'),
(26, 19, 9, 35000, 10000, 25000, 'paystack', 'fghj', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5214526301,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"6893676a2a214\",\"receipt_number\":null,\"amount\":1000000,\"message\":\"test-3ds\",\"gateway_response\":\"[Test] Approved\",\"paid_at\":\"2025-08-06T14:32:46.000Z\",\"created_at\":\"2025-08-06T14:32:18.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.93.175\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754490737,\"time_spent\":23,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":14},{\"type\":\"auth\",\"message\":\"Authentication Required: 3DS\",\"time\":16},{\"type\":\"action\",\"message\":\"Third-party authentication window opened\",\"time\":19},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":23},{\"type\":\"action\",\"message\":\"Third-party authentication window closed\",\"time\":23}]},\"fees\":25000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_02fr7lazku\",\"bin\":\"408408\",\"last4\":\"0409\",\"exp_month\":\"01\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_frB8WyN70Q1Zaq6c21qC\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T14:32:46.000Z\",\"createdAt\":\"2025-08-06T14:32:18.000Z\",\"requested_amount\":1000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T14:32:18.000Z\",\"plan_object\":[],\"subaccount\":[]}}', NULL, 25, '2025-08-06 14:32:42', '2025-08-06 14:32:42'),
(27, 40, 3, 8977, 5000, 3977, 'paystack', 'fgh', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215212707,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"46b66853-b986-4cbb-9c4c-5d59efa43191\",\"receipt_number\":null,\"amount\":500000,\"message\":\"test-3ds\",\"gateway_response\":\"[Test] Approved\",\"paid_at\":\"2025-08-06T20:11:13.000Z\",\"created_at\":\"2025-08-06T20:10:47.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754511044,\"time_spent\":22,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":15},{\"type\":\"auth\",\"message\":\"Authentication Required: 3DS\",\"time\":16},{\"type\":\"action\",\"message\":\"Third-party authentication window opened\",\"time\":20},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":22},{\"type\":\"action\",\"message\":\"Third-party authentication window closed\",\"time\":22}]},\"fees\":17500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_qr0ysaibr1\",\"bin\":\"408408\",\"last4\":\"0409\",\"exp_month\":\"01\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_frB8WyN70Q1Zaq6c21qC\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297638606,\"first_name\":null,\"last_name\":null,\"email\":\"idrisfati@gmail.com\",\"customer_code\":\"CUS_dgx3rio1j3tkc4f\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T20:11:13.000Z\",\"createdAt\":\"2025-08-06T20:10:47.000Z\",\"requested_amount\":500000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T20:10:47.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '46b66853-b986-4cbb-9c4c-5d59efa43191', 40, '2025-08-06 20:11:08', '2025-08-06 20:11:08'),
(28, 19, 9, 25000, 4000, 21000, 'paystack', 'v bn', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215223409,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"ae50f9be-c7a4-492f-9489-ec8c7bc711f1\",\"receipt_number\":null,\"amount\":400000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T20:16:48.000Z\",\"created_at\":\"2025-08-06T20:16:37.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754511392,\"time_spent\":8,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":7},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":8}]},\"fees\":16000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_48lcqr0hmw\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T20:16:48.000Z\",\"createdAt\":\"2025-08-06T20:16:37.000Z\",\"requested_amount\":400000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T20:16:37.000Z\",\"plan_object\":[],\"subaccount\":[]}}', 'ae50f9be-c7a4-492f-9489-ec8c7bc711f1', 25, '2025-08-06 20:16:42', '2025-08-06 20:16:42'),
(29, 19, 9, 21000, 4000, 17000, 'paystack', 'fgh', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215253684,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"e55f15d3-8ffe-454e-829d-4966b8b9d18b\",\"receipt_number\":null,\"amount\":400000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T20:34:24.000Z\",\"created_at\":\"2025-08-06T20:34:00.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754512438,\"time_spent\":19,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":18},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":19}]},\"fees\":16000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_39oxb2en2r\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T20:34:24.000Z\",\"createdAt\":\"2025-08-06T20:34:00.000Z\",\"requested_amount\":400000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T20:34:00.000Z\",\"plan_object\":[],\"subaccount\":[]}}', 'e55f15d3-8ffe-454e-829d-4966b8b9d18b', 25, '2025-08-06 20:34:19', '2025-08-06 20:34:19'),
(30, 19, 9, 17000, 4000, 13000, 'paystack', 'fgh', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215260999,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"57691a16-a1a0-49c2-8a61-94dd3bf0bf62\",\"receipt_number\":null,\"amount\":400000,\"message\":\"test-3ds\",\"gateway_response\":\"[Test] Approved\",\"paid_at\":\"2025-08-06T20:38:28.000Z\",\"created_at\":\"2025-08-06T20:38:04.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754512679,\"time_spent\":22,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":17},{\"type\":\"auth\",\"message\":\"Authentication Required: 3DS\",\"time\":18},{\"type\":\"action\",\"message\":\"Third-party authentication window opened\",\"time\":21},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":22},{\"type\":\"action\",\"message\":\"Third-party authentication window closed\",\"time\":22}]},\"fees\":16000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_bzwkm336aw\",\"bin\":\"408408\",\"last4\":\"0409\",\"exp_month\":\"01\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_frB8WyN70Q1Zaq6c21qC\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T20:38:28.000Z\",\"createdAt\":\"2025-08-06T20:38:04.000Z\",\"requested_amount\":400000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T20:38:04.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '57691a16-a1a0-49c2-8a61-94dd3bf0bf62', 25, '2025-08-06 20:38:23', '2025-08-06 20:38:23'),
(31, 19, 9, 13000, 7000, 6000, 'paystack', 'PAID', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215286581,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"8a3e2ce1-7051-47e4-972a-d51f55a4b308\",\"receipt_number\":null,\"amount\":700000,\"message\":\"test-3ds\",\"gateway_response\":\"[Test] Approved\",\"paid_at\":\"2025-08-06T20:53:21.000Z\",\"created_at\":\"2025-08-06T20:52:59.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754513581,\"time_spent\":13,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":9},{\"type\":\"auth\",\"message\":\"Authentication Required: 3DS\",\"time\":9},{\"type\":\"action\",\"message\":\"Third-party authentication window opened\",\"time\":12},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":13},{\"type\":\"action\",\"message\":\"Third-party authentication window closed\",\"time\":13}]},\"fees\":20500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_p1csz2azsy\",\"bin\":\"408408\",\"last4\":\"0409\",\"exp_month\":\"01\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_frB8WyN70Q1Zaq6c21qC\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T20:53:21.000Z\",\"createdAt\":\"2025-08-06T20:52:59.000Z\",\"requested_amount\":700000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T20:52:59.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '8a3e2ce1-7051-47e4-972a-d51f55a4b308', 25, '2025-08-06 20:53:16', '2025-08-06 20:53:16'),
(32, 19, 9, 6000, 2000, 4000, 'paystack', 'ooo', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215300766,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"eedec677-094b-464b-b165-e6a0b958487f\",\"receipt_number\":null,\"amount\":200000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T21:02:32.000Z\",\"created_at\":\"2025-08-06T21:02:18.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754514139,\"time_spent\":6,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":5},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":6}]},\"fees\":3000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_f5vd0n2xya\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T21:02:32.000Z\",\"createdAt\":\"2025-08-06T21:02:18.000Z\",\"requested_amount\":200000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T21:02:18.000Z\",\"plan_object\":[],\"subaccount\":[]}}', 'eedec677-094b-464b-b165-e6a0b958487f', 25, '2025-08-06 21:02:27', '2025-08-06 21:02:27'),
(33, 19, 9, 4000, 1000, 3000, 'paystack', 'qwer', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215305451,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"ea3318f1-90ea-4a4f-9817-82b1dbc22955\",\"receipt_number\":null,\"amount\":100000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T21:05:44.000Z\",\"created_at\":\"2025-08-06T21:05:03.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754514299,\"time_spent\":38,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Set payment method to: bank_transfer\",\"time\":13},{\"type\":\"action\",\"message\":\"Set payment method to: card\",\"time\":33},{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":37},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":38}]},\"fees\":1500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_su0e9ymbyp\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T21:05:44.000Z\",\"createdAt\":\"2025-08-06T21:05:03.000Z\",\"requested_amount\":100000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T21:05:03.000Z\",\"plan_object\":[],\"subaccount\":[]}}', 'ea3318f1-90ea-4a4f-9817-82b1dbc22955', 25, '2025-08-06 21:05:39', '2025-08-06 21:05:39'),
(34, 19, 9, 3000, 1500, 1500, 'paystack', 'vbn', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5215311460,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"80ec30a4-39cd-4e10-b0fc-23680420d1d0\",\"receipt_number\":null,\"amount\":150000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-06T21:08:39.000Z\",\"created_at\":\"2025-08-06T21:08:22.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.115.165\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754514506,\"time_spent\":5,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":5},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":5}]},\"fees\":2250,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_jjs6xxd8aw\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-06T21:08:39.000Z\",\"createdAt\":\"2025-08-06T21:08:22.000Z\",\"requested_amount\":150000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-06T21:08:22.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '80ec30a4-39cd-4e10-b0fc-23680420d1d0', 25, '2025-08-06 21:08:33', '2025-08-06 21:08:33'),
(35, 42, 8, 20000, 10000, 10000, 'paystack', 'vbn', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5216996356,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"1f14fd3e-f7ba-4ac3-b55a-05a03c566e40\",\"receipt_number\":null,\"amount\":1000000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-07T11:35:52.000Z\",\"created_at\":\"2025-08-07T11:35:31.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.102.40\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754566537,\"time_spent\":10,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":7},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":10}]},\"fees\":25000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_xeam1hs8fr\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297879845,\"first_name\":null,\"last_name\":null,\"email\":\"haruna@gmail.com\",\"customer_code\":\"CUS_p7me0nqr9uiaiy4\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-07T11:35:52.000Z\",\"createdAt\":\"2025-08-07T11:35:31.000Z\",\"requested_amount\":1000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-07T11:35:31.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '1f14fd3e-f7ba-4ac3-b55a-05a03c566e40', 42, '2025-08-07 11:35:49', '2025-08-07 11:35:49'),
(36, 22, 4, 25000, 7000, 18000, 'paystack', 'bnm', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5217097294,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"6d4ded66-cf0a-44ab-bfbd-46d8773b9b5a\",\"receipt_number\":null,\"amount\":700000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-07T12:05:16.000Z\",\"created_at\":\"2025-08-07T12:04:59.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.102.40\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754568301,\"time_spent\":8,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":6},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":8}]},\"fees\":20500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_qf61qwt2rr\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297886833,\"first_name\":null,\"last_name\":null,\"email\":\"hauwaisah@gmail.com\",\"customer_code\":\"CUS_anteps68ukqx7gz\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-07T12:05:16.000Z\",\"createdAt\":\"2025-08-07T12:04:59.000Z\",\"requested_amount\":700000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-07T12:04:59.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '6d4ded66-cf0a-44ab-bfbd-46d8773b9b5a', 25, '2025-08-07 12:05:12', '2025-08-07 12:05:12'),
(37, 22, 4, 18000, 555, 17445, 'paystack', 'cvb', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5217121052,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"59b2d553-3a24-44a3-b2f3-dc44c2d54e60\",\"receipt_number\":null,\"amount\":55500,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-07T12:13:35.000Z\",\"created_at\":\"2025-08-07T12:13:17.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.102.40\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754568800,\"time_spent\":8,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":6},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":8}]},\"fees\":833,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_452c9z9sis\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297886833,\"first_name\":null,\"last_name\":null,\"email\":\"hauwaisah@gmail.com\",\"customer_code\":\"CUS_anteps68ukqx7gz\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-07T12:13:35.000Z\",\"createdAt\":\"2025-08-07T12:13:17.000Z\",\"requested_amount\":55500,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-07T12:13:17.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '59b2d553-3a24-44a3-b2f3-dc44c2d54e60', 25, '2025-08-07 12:13:40', '2025-08-07 12:13:40'),
(38, 22, 4, 17445, 10000, 7445, 'paystack', 'vbv', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5217196495,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"8ef01ccb-4bd8-4eae-899d-1c9846a25654\",\"receipt_number\":null,\"amount\":1000000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-07T12:40:23.000Z\",\"created_at\":\"2025-08-07T12:40:04.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.102.40\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754570408,\"time_spent\":8,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":6},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":8}]},\"fees\":25000,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_q6bfi14d5y\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297886833,\"first_name\":null,\"last_name\":null,\"email\":\"hauwaisah@gmail.com\",\"customer_code\":\"CUS_anteps68ukqx7gz\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-07T12:40:23.000Z\",\"createdAt\":\"2025-08-07T12:40:04.000Z\",\"requested_amount\":1000000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-07T12:40:04.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '8ef01ccb-4bd8-4eae-899d-1c9846a25654', 25, '2025-08-07 12:40:18', '2025-08-07 12:40:18'),
(39, 19, 9, 1500, 1000, 500, 'paystack', 'bnm', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5217201323,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"94d78874-282f-4695-84cf-4a38dfcd7cf1\",\"receipt_number\":null,\"amount\":100000,\"message\":\"test-3ds\",\"gateway_response\":\"[Test] Approved\",\"paid_at\":\"2025-08-07T12:41:44.000Z\",\"created_at\":\"2025-08-07T12:41:28.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.91.102.40\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754570486,\"time_spent\":11,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":5},{\"type\":\"auth\",\"message\":\"Authentication Required: 3DS\",\"time\":5},{\"type\":\"action\",\"message\":\"Third-party authentication window opened\",\"time\":8},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":10},{\"type\":\"action\",\"message\":\"Third-party authentication window closed\",\"time\":11}]},\"fees\":1500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_9vqzu9kv2d\",\"bin\":\"408408\",\"last4\":\"0409\",\"exp_month\":\"01\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_frB8WyN70Q1Zaq6c21qC\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297649123,\"first_name\":null,\"last_name\":null,\"email\":\"dangana@gmail.com\",\"customer_code\":\"CUS_rzabbb3589393yv\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-07T12:41:44.000Z\",\"createdAt\":\"2025-08-07T12:41:28.000Z\",\"requested_amount\":100000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-07T12:41:28.000Z\",\"plan_object\":[],\"subaccount\":[]}}', '94d78874-282f-4695-84cf-4a38dfcd7cf1', 25, '2025-08-07 12:41:39', '2025-08-07 12:41:39'),
(40, 40, 3, 3977, 3000, 977, 'paystack', 'cvb', 1, '{\"status\":true,\"message\":\"Verification successful\",\"data\":{\"id\":5227228683,\"domain\":\"test\",\"status\":\"success\",\"reference\":\"ae7bc826-174c-4726-90c1-8fa93adf1d8e\",\"receipt_number\":null,\"amount\":300000,\"message\":null,\"gateway_response\":\"Successful\",\"paid_at\":\"2025-08-10T22:59:44.000Z\",\"created_at\":\"2025-08-10T22:59:21.000Z\",\"channel\":\"card\",\"currency\":\"NGN\",\"ip_address\":\"102.88.110.233\",\"metadata\":{\"referrer\":\"http:\\/\\/localhost\\/\"},\"log\":{\"start_time\":1754866766,\"time_spent\":7,\"attempts\":1,\"errors\":0,\"success\":true,\"mobile\":false,\"input\":[],\"history\":[{\"type\":\"action\",\"message\":\"Attempted to pay with card\",\"time\":7},{\"type\":\"success\",\"message\":\"Successfully paid with card\",\"time\":7}]},\"fees\":14500,\"fees_split\":null,\"authorization\":{\"authorization_code\":\"AUTH_zuz3akryp8\",\"bin\":\"408408\",\"last4\":\"4081\",\"exp_month\":\"12\",\"exp_year\":\"2030\",\"channel\":\"card\",\"card_type\":\"visa \",\"bank\":\"TEST BANK\",\"country_code\":\"NG\",\"brand\":\"visa\",\"reusable\":true,\"signature\":\"SIG_SBMmnOeKaxADsxmxHJWs\",\"account_name\":null,\"receiver_bank_account_number\":null,\"receiver_bank\":null},\"customer\":{\"id\":297638606,\"first_name\":null,\"last_name\":null,\"email\":\"idrisfati@gmail.com\",\"customer_code\":\"CUS_dgx3rio1j3tkc4f\",\"phone\":null,\"metadata\":null,\"risk_action\":\"default\",\"international_format_phone\":null},\"plan\":null,\"split\":[],\"order_id\":null,\"paidAt\":\"2025-08-10T22:59:44.000Z\",\"createdAt\":\"2025-08-10T22:59:21.000Z\",\"requested_amount\":300000,\"pos_transaction_data\":null,\"source\":null,\"fees_breakdown\":null,\"connect\":null,\"transaction_date\":\"2025-08-10T22:59:21.000Z\",\"plan_object\":[],\"subaccount\":[]}}', 'ae7bc826-174c-4726-90c1-8fa93adf1d8e', 40, '2025-08-10 22:59:35', '2025-08-10 22:59:35'),
(41, 29, 4, 25000, 15000, 10000, 'cash', 'paid half', 1, NULL, NULL, 1, '2025-08-11 20:13:52', '2025-08-11 20:13:52'),
(42, 21, 4, 10000, 8000, 2000, 'cheque', 'fghj', 1, NULL, NULL, 1, '2025-08-11 20:46:09', '2025-08-11 20:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `attendance_type` int(11) DEFAULT NULL COMMENT '1=Present, 2= Late, 3=Absent, 4=Half Day',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `class_id`, `attendance_date`, `student_id`, `attendance_type`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 4, '2025-03-20', 38, 4, 1, '2025-03-20 11:21:43', '2025-03-20 21:27:59'),
(2, 3, '2025-03-20', 40, 1, 1, '2025-03-20 21:25:38', '2025-03-20 21:25:38'),
(3, 3, '2025-03-20', 39, 1, 1, '2025-03-20 21:25:43', '2025-03-20 21:26:30'),
(4, 4, '2025-03-20', 29, 1, 1, '2025-03-20 21:27:40', '2025-03-20 21:27:40'),
(5, 4, '2025-03-20', 22, 2, 1, '2025-03-20 21:51:28', '2025-03-20 21:51:28'),
(6, 4, '2025-03-20', 21, 1, 1, '2025-03-20 21:51:34', '2025-03-20 21:51:34'),
(7, 4, '2025-03-20', 8, 1, 1, '2025-03-20 21:51:40', '2025-03-20 21:51:40'),
(8, 3, '2025-03-31', 40, 1, 1, '2025-03-31 21:24:20', '2025-03-31 21:24:20'),
(9, 3, '2025-03-31', 39, 3, 1, '2025-03-31 21:24:26', '2025-03-31 21:24:26'),
(10, 2, '2025-03-31', 41, 1, 28, '2025-03-31 22:20:36', '2025-03-31 22:25:43'),
(11, 2, '2025-04-01', 41, 2, 28, '2025-03-31 22:26:08', '2025-03-31 22:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Active, 1:Inactive ',
  `is_delete` int(11) NOT NULL DEFAULT 0 COMMENT '0:not, 1:yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `type`, `created_by`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'English Language', 'Theory', 1, 0, 0, '2024-09-04 22:11:45', '2024-09-04 23:11:47'),
(2, 'Mathematics', 'Practical', 1, 0, 0, '2024-09-04 22:17:13', '2024-09-04 23:26:36'),
(3, 'Biology', 'Practical', 1, 0, 0, '2024-09-05 16:54:37', '2024-09-05 16:55:33'),
(4, 'Government', 'Theory', 1, 0, 0, '2024-09-05 22:06:20', '2024-09-05 22:06:20'),
(5, 'Agric', 'Theory', 1, 0, 0, '2024-09-06 11:37:13', '2024-09-06 11:37:13'),
(6, 'Phisics', 'Theory', 1, 0, 0, '2024-09-06 11:38:33', '2024-09-06 11:38:33'),
(7, 'Chemistry', 'Theory', 1, 0, 0, '2024-09-06 11:38:59', '2024-09-06 11:38:59'),
(8, 'Geography', 'Theory', 1, 0, 0, '2025-06-28 20:27:13', '2025-06-28 20:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `admission_number` varchar(50) DEFAULT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1: admin, 2: teacher, 3: student, 4: parent',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1:deleted',
  `status` tinyint(4) DEFAULT 0 COMMENT '0:active, 1:inactive ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `admission_number`, `roll_number`, `class_id`, `gender`, `marital_status`, `date_of_birth`, `date_of_joining`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_pic`, `blood_group`, `height`, `weight`, `occupation`, `qualification`, `work_experience`, `address`, `permanent_address`, `note`, `user_type`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$10$XxGd2tFdIJABxXPBtSTkBOR.mX//f7AHWLBgSh53YqfgFHaFT6dyq', 'CvIcjeqVPA9HvgxpRJEb21CcxdWqFfi3g0Os8k81EvOOwlCEHlcdRHlOLmjy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250719101944prnhl8xzyqphhlc5dmgb.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-08-23 21:20:04', '2025-07-19 21:19:44'),
(2, NULL, 'Teacher', 'IDRIS', 'teacher11@gmail.com', NULL, '$2y$10$LOWnxYwfjdD63GJhPDF2Wu9jWd2zjz0T6YQaYrxHZHDFDkkw0pvb2', 'AaMRqVJRLNEJusGjhYP2K4MIMRAhtnu10v5Dfh3k7m9RMB0WhfBNcHTYgx6t', NULL, NULL, NULL, '', 'Married', '2022-06-07', '2024-09-29', NULL, NULL, '08034567888', NULL, '20241009083225c4q7vlgrfhorfvnvqdye.jpg', NULL, NULL, NULL, NULL, 'B.Tech', 'asdfghj', 'Tunga', 'area 11', 'class teacher', 2, 0, 0, '2024-08-23 21:20:04', '2024-11-11 11:23:30'),
(3, NULL, 'Student', 'IDRIS', 'student@gmail.com', NULL, '$2y$10$V7q6svnGIpwmX2wCoPaGEenmHRF2KjZ86w8Gz6rP.m5CopF92LzDq', '8Xy1VduhqZEh7pcbbMb5Sf7HO6jFAsUClU3jz5b6Z4uiNqe3icKxKGNDeKCd', NULL, NULL, NULL, 'Female', NULL, '2023-11-29', NULL, 'zxcvbnmbn', 'Islamic Religion', '08045678988', NULL, '20241010105040bc2ucecids9lmqdam4mi.jpg', 'B+', '65', '65', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-08-23 21:20:04', '2024-10-10 09:59:39'),
(4, NULL, 'Parent', 'IDRIS', 'parent@gmail.com', NULL, '$2y$10$54OTawzxb7AigmsyNPgBk.ew3kp9XHEIvtWzwl8qkLJ9kw0HDpIkS', '5DjI4bKbmBpjNcafwGsrM0N7IiZmfy8b9etWK1z2MyLzm8G42QLPFIIsvkep', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '090876500000', NULL, '20240923092012eaqw759pz1xe7rsl1cub.jpg', NULL, NULL, NULL, 'civil servant', NULL, NULL, 'Soje \'B\' Kpakungu Mx.', NULL, NULL, 4, 0, 0, '2024-08-23 21:20:04', '2024-10-15 15:14:50'),
(6, NULL, 'Aisha Musa', NULL, 'aisha@gmail.com', NULL, '$2y$10$m6Mw85Pgb15Wzp0o49Ccs.nQUUVrYnlGELlmp6.cV5qGme04f8c1W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2024-08-28 10:02:32', '2024-09-19 22:51:31'),
(8, NULL, 'Yahaya', 'Isah', 'issah@gmail.com', NULL, '$2y$10$ID0z2gh6Ym0LEcmA8O7Ne.I1L3DFrT42CrDjhf/CQodZTLEOt6eoe', NULL, '1256ju', '32', 4, 'Male', NULL, '2022-02-03', NULL, 'fghjkl', 'Islam', '09076543200', NULL, '20240919095738lofebolh3edjijtpllhw.jpeg', '65', '65', '65', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-08-28 10:07:44', '2024-09-19 20:57:38'),
(9, NULL, 'Abbas Ibrahim', NULL, 'abbas@gmail.com', NULL, '$2y$10$6.gG0LhE5jfv8h2nLgthB.VszgdGrsO2RsI.ObenAWvSyVf.tQWm6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, '2024-08-28 10:09:56', '2024-09-03 16:30:20'),
(10, NULL, 'fauziya A. umar', NULL, 'fauziya@gmail.com', NULL, '$2y$10$OxI1h9r2lBqpxHnQMeMaEuK55lnEjGDLd9FH0L7H9u2qFMhdelzb.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250709082806au3dlzdgzvddxlkhigyk.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-08-28 10:13:25', '2025-07-09 19:28:06'),
(11, NULL, 'Ibrahim Yusuf', NULL, 'ibrahim@gmail.com', NULL, '$2y$10$IBuh95.ohgGn1TkOR8DFDeuws3E60VRs.eQLcSFtJ/uYqbVJliEE6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250709084422kxv45ygv3gwjlhrwa29t.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-08-28 10:15:41', '2025-07-09 19:44:22'),
(12, NULL, 'Bashir Musa', NULL, 'bashir@gmail.com', NULL, '$2y$10$rLPgOD5hana.DS52NRiIrOZ/FRWZATAXjcGi17.Hyi7M3xC2jsR4u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250709084359mvkrs4xonxdav6zmyqxs.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-08-28 10:23:03', '2025-07-09 19:43:59'),
(13, NULL, 'Aisha Musa Baba', NULL, 'fatiidris2012@gmail.com', NULL, '$2y$10$KooJTPTzs6J.iTv3XhfHberKDwyYlAuIdM9rw5ElnshRHoFky3rd6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '202507090843375riidu3b3rxgysscrzvh.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-08-30 23:06:40', '2025-07-09 19:43:37'),
(14, NULL, 'yusuf isah', NULL, 'yusuf@gmail.com', NULL, '$2y$10$jldmCRaVWlR1.5nqh49wD./KdWhr66wy5PlYM2f0iQEpgMYXPHr.i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '202507090842332mn19qxebjpapksnmthm.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-09-03 16:04:43', '2025-07-09 19:42:33'),
(15, NULL, 'umar nuhu', NULL, 'umar@gmail.com', NULL, '$2y$10$bNloC/9z0WnyL3.bCsPJ8.V2I.Dh4UpjHYbGWH0ggLhnbXXJHUCzC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250709084309wqzgo8gvjmpivw57iogy.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, '2024-09-03 16:13:19', '2025-08-14 09:34:13'),
(16, NULL, 'Haruna yahaya', NULL, 'yahaya@gmail.com', NULL, '$2y$10$bOHbA1bPKKKv6UmQ.Xfar.77v9Huq5E0eRHVpPxtQcQC0qTgVa56.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250814103543ww3fjhzu8mopsrfw4vk4.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2024-09-03 16:23:35', '2025-08-14 09:35:43'),
(19, 25, 'Yahaya', 'IDRIS Dangana', 'dangana@gmail.com', NULL, '$2y$10$Jc4wJTd.Cjh9UWbdxCo42OxJNxcfmDP0aA1LN5oBE3C7U4sSEkW2q', NULL, '1234gt', '34', 9, 'Male', NULL, '2024-08-01', NULL, 'fghj', 'Islam', '09087654322', '2024-09-17', '20240919100156zpgovs90klaa64yxr3sc.jpg', 'o+', '56', '56', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-09-17 11:32:38', '2024-12-22 21:01:22'),
(21, 25, 'Zainab', 'IDRIS', 'zainab@gmail.com', NULL, '$2y$10$.uA7RXaS6rZ6t7CsdOBl6u5jdpCxV29sP4DVgqmcFltHg.2BsCh3W', 'xvZcUPgfshurk9YIOlFN0Geb3gL8BzT2uEmGooql8yTQBshbDf6loP53MfDb', '1717AJ', '23', 4, 'Male', NULL, '2022-12-01', NULL, 'fghja00', 'Islam', '09087654344', NULL, '20240919095114d4fmxk30h885qjfjbayw.jpg', 'A+', '65', '65', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-09-17 12:13:28', '2025-01-14 14:12:12'),
(22, 25, 'Hauwa', 'Isah', 'hauwaisah@gmail.com', NULL, '$2y$10$drWXV3.R67yNgX2/7OPxWOy0um/mYNc7KjIa8jMI1uarq/MgWzpCG', 'Zc0Ur4ZiHMQuFdlB9JBE2GM1n8iM5yR3fxPrRawYVdAlSZT2bi3HZnfAaxiB', '56778ji', '67', 4, 'Female', NULL, '2021-09-02', NULL, 'ghjkk', 'islam', '09076543211', NULL, '20250719095104rilcykmdew0sqtqupmux.jpg', 'o+', '89', '89', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-09-19 08:05:58', '2025-07-19 20:51:04'),
(23, NULL, 'Tahiru', 'IDRIS', 'tahir@gmail.com', NULL, '$2y$10$ErWBGz3wC9CSiEsuWiBPveidU66bn4dwimvA4LLbn1pqukWzMSaW2', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '09076543266', NULL, NULL, NULL, NULL, NULL, 'civil servant', NULL, NULL, 'Soje \'B\' Kpakungu Mx.', NULL, NULL, 4, 1, 0, '2024-09-22 20:56:35', '2024-09-24 08:49:02'),
(24, NULL, 'Rukkaiya ii', 'Isah baba', 'rukkkaiya@gmail.com', NULL, '$2y$10$CJLg6jXA/TEIDhqPCan80Oq/oKIUHWZBukUvPxUUnFdoTEwJfLvAi', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '09067890966', NULL, '20240923084103jx8eoypph2topd2hqrev.jpg', NULL, NULL, NULL, 'Business woman', NULL, NULL, 'Tudunfulani \'A\'', NULL, NULL, 4, 0, 0, '2024-09-23 19:41:03', '2024-09-24 10:37:50'),
(25, NULL, 'Jamila', 'Lawal', 'jamila@gmail.com', NULL, '$2y$10$gb.VApACfYIAQiegBelwZOGwqTB8IfKcE9HTLR1l3GfoFoKrcEYQG', 'rRaSQGR92B7ck6DgHtTvPDiXfsnvoVNwQ9ALYgVsaSPXPF7btemIC5tGkaB9', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '08076543211', NULL, '20240924114201euw0msychwj7muohol7k.jpg', NULL, NULL, NULL, 'civil servant', NULL, NULL, 'Bosso', NULL, NULL, 4, 0, 0, '2024-09-24 10:41:14', '2024-10-21 20:12:23'),
(26, NULL, 'Umar', 'Saifullahi', 'saifulahiumar@gmail.com', NULL, '$2y$10$SVbaX7pqexImXy.yw2.pGeQG9Dhubbzboo6XPwAculbiDQjpSbfG.', 'efKOAsXUOHuQzr1aaVLpOZdUBVKwXdPgsEryrv0prNA2PX53k9R46t517dkF', NULL, NULL, NULL, '', 'Single', '2010-06-07', '2022-08-31', NULL, NULL, '08034567800', NULL, '20241007103718bczq3chsnxoayvcuqtdo.jpg', NULL, NULL, NULL, NULL, 'M.Tech', '5 years of teaching', 'Soje \'B\' Kpakungu Mx.', 'hill-top model school', 'class teacher', 2, 0, 0, '2024-10-07 09:37:18', '2024-10-07 10:28:01'),
(27, NULL, 'Joy', 'Gana', 'joygana@gmail.com', NULL, '$2y$10$Oj.tesXTRTM2hxEGuX8MTuqo3p8k5Ve2fT8HbPChdnbZcv1HDjBLC', 'XU89TTTjIhA6JB5UVC1RPRQP9fEqavtWY69FNGwM0vWe6Ew49qkYziJ3DOcL', NULL, NULL, NULL, '', 'Married', '2019-06-04', '2024-10-07', NULL, NULL, '08056789000', NULL, '202410071138054iaem4mlety8smxbslro.jpg', NULL, NULL, NULL, NULL, 'B.Tech', 'administrative', 'Tunga', 'area 11', 'administrative officer', 2, 0, 0, '2024-10-07 10:38:05', '2024-10-07 10:43:32'),
(28, NULL, 'Musa', 'Rukkaiya', 'rukaiya@gmail.com', NULL, '$2y$10$tRZub7v35fCEYihOfFUtquY/tjW94CcfONq5MpW.3KKSjStC8rq4.', NULL, NULL, NULL, NULL, '', 'Married', '2014-10-07', '2024-10-07', NULL, NULL, '07045678800', NULL, '20241007120825jawsknahxcr333b2lzyq.jpg', NULL, NULL, NULL, NULL, 'N.C.E', 'administrative assistance', 'Soje \'B\' Kpakungu Mx.', 'bosso', 'class teacher', 2, 0, 0, '2024-10-07 11:08:25', '2024-10-07 11:08:25'),
(29, NULL, 'Aisha', 'Isah', 'aishaisah@gmail.com', NULL, '$2y$10$rjFJa9y9YZ81W89FcyYXCOP/7UY1Rwe51LR2hDltQdiN05sh0Waa2', NULL, '3456', '23', 4, 'Female', NULL, '2014-11-28', NULL, 'sdfghjk', 'islam', '08056432211', NULL, '20241008114415nksqjqufl0ozbjxr9ohf.jpg', 'o+', '89', '59', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-10-08 10:44:15', '2025-08-14 09:40:58'),
(30, NULL, 'Hauwa Kulu', 'PARENT2', 'hauwaparent2@gmail.com', NULL, '$2y$10$FmUFHhvLi5JrhUc1.UrgsuWKKgWF/UlinXSspvyhwpBOxbqB4mAPe', 'dRDefu0PKnCH5cCx5QiRyjGYHPr0kgKduGuVTF1QmEE77bYcpUquzNono1Jf', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '09067889990', NULL, '20241120111023zffgyxo9f5rr4ykw1xnm.jpg', NULL, NULL, NULL, 'civil servant', NULL, NULL, 'Tudunfulani \'A\'', NULL, NULL, 4, 0, 0, '2024-10-21 20:07:14', '2024-11-20 11:15:42'),
(31, NULL, 'JAMILA', 'HALIRU', 'haliru@gmail.com', NULL, '$2y$10$tbIFu9CegHoOjlSCEYF8AO3jd66Mrg/Z5ViXpM1JtzXNVwBx2OoVm', NULL, NULL, NULL, NULL, '', 'Married', '2021-12-30', '2024-10-31', NULL, NULL, '08056789000', NULL, '20241031114813lt0oafd5amjzptdt5h2x.jpg', NULL, NULL, NULL, NULL, 'N.C.E', 'administrative assistance', 'Bosso', 'bosso', 'active class teacher', 2, 0, 0, '2024-10-31 11:22:06', '2024-10-31 11:48:13'),
(32, NULL, 'ABDULLAHI', 'GIMBA', 'abdullahi@gmail.com', NULL, '$2y$10$Q20odYlDnFFUALbM31av8eLByJXYU8kL/oaoltFT/nwbdTns/nMM2', NULL, NULL, NULL, NULL, 'Male', 'Married', '2015-07-01', '2024-11-01', NULL, NULL, '09023456744', NULL, '20241101103508ajfdmwpf0xq5xc4re9bx.jpg', NULL, NULL, NULL, NULL, 'M.Tech', '5 years of Teaching', 'Gurara', 'Gurara', 'active class teacher', 2, 0, 0, '2024-11-01 10:35:08', '2024-11-01 10:35:08'),
(33, NULL, 'FAIZA', 'BABAKANO', 'faiza@gmail.com', NULL, '$2y$10$yPVMhXpVZ.RR8sqfWMQK8OjSyJ93cQV6X1hTg6asG6pLa0gDM8Vz6', '0dHuEKezA5OSvrScCVgvaMTG4liAwyxWqqralpsE5VlV8t88tEvKu5Kd39YV', NULL, NULL, NULL, 'Female', 'Married', '2020-03-04', '2024-11-01', NULL, NULL, '08054678900', NULL, '20241101104446izy5qmgvvzomc2jkhxkj.jpg', NULL, NULL, NULL, NULL, 'B.Tech', 'Teaching for Two Years', 'Tunga Lowcost', 'Tunga', 'class teacher', 2, 0, 0, '2024-11-01 10:44:46', '2024-11-01 10:44:46'),
(34, NULL, 'SAIFULLAHI', 'MUSA', 'saifullahi@gmail.com', NULL, '$2y$10$CPAOPdjKI6CMW8HbivL3WO4/6vzqcLZgoKU0Ty9T2q/5khhLDCIwC', NULL, '0234HJ', '21', 7, 'Male', NULL, '2014-02-01', NULL, 'HJK', 'islam', '08021345677', NULL, '20241101110529czcdutjxiwpr25m8nv5c.jpg', 'o+', '50', '50', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2024-11-01 11:05:30', '2024-11-01 11:07:34'),
(35, NULL, 'YAHAYA', 'PARENT1', 'yahayaparent1@gmail.com', NULL, '$2y$10$YQKGqy8dtO2XRbUnS3fKb.qEZfp0/0QYcE/xPsyPL8GVIPtFdkl9C', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '09087654341', NULL, '20241113120728qz63joklan0s86tbgp3m.jpg', NULL, NULL, NULL, 'civil servant', NULL, NULL, 'tunga', NULL, NULL, 4, 0, 0, '2024-11-13 12:07:28', '2025-01-08 11:11:11'),
(36, NULL, 'Nura', 'BASHIR', 'nura@gmail.com', NULL, '$2y$10$zkvjzjr0lA2rsDWR11b/DuCXek0QIfLgn/itrmD5AwSLO7Vzrfe6e', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, '08056789666', NULL, '20241120120458rlbw6vuq8xrjoqlt2czk.jpg', NULL, NULL, NULL, 'civil servant', NULL, NULL, 'Area I', NULL, NULL, 4, 0, 0, '2024-11-20 12:04:59', '2024-11-20 12:04:59'),
(37, NULL, 'NURA', 'USMAN', 'usman@gmail.com', NULL, '$2y$10$anuy/qj9OrNecejrMp2MPetr94gzJQf.oh9rDyuv2jZMn/Y4v.Mry', NULL, NULL, NULL, NULL, 'Male', 'Single', '2024-12-02', '2024-12-20', NULL, NULL, '09067890566', NULL, '20241220092156prgmmqmvgldwglj1zdf2.jpg', NULL, NULL, NULL, NULL, 'B.Tech', 'Teaching for Two Years', 'Darussalam Area II', 'bosso', 'class teacher', 2, 0, 0, '2024-12-20 21:21:56', '2024-12-20 21:21:56'),
(38, NULL, 'sxbnm', 'zxcvbn', 'eerr@gmail.com', NULL, '$2y$10$WkP3kfR9tQxLGjbWWLmbVez96OJhs4GTk4kCgI9LAic8f7b14s4Ya', NULL, '123', '12', 4, '', NULL, '2025-01-01', NULL, '12', 'weee', '0803455666', NULL, '20250108110945f3ccfk1rg4hqimvbmewj.jpg', '0', '45', '67', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2025-01-08 11:09:46', '2025-01-08 11:09:46'),
(39, NULL, 'ADAMU', 'LAWAL', 'adamulawal@gmail.com', NULL, '$2y$10$v20l85oPYxtxm8MgxVQ4N.eHs6GKirTz6VkGRiAa3Kbzez.3qtgW.', NULL, '002', '03', 3, '', NULL, '2025-03-06', NULL, '12', 'Islam', '08036849688', NULL, '20250313100258z3rzqul689uflh2qnjd0.jpg', '0', '65', '65', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2025-03-13 10:02:58', '2025-03-13 10:02:58'),
(40, NULL, 'Fati', 'Idris', 'idrisfati@gmail.com', NULL, '$2y$10$r0lz9WIpTAB/O5r8N.TeluHu2pEr.GSy9KGVLtgQCVqxhkkr6usKG', NULL, '123', '12', 3, 'Female', NULL, '2025-02-26', NULL, '12', 'ISLAM', '08036849688', NULL, '20250313100451rl4yndstz7etx3nz5vqh.jpg', '0', '65', '65', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2025-03-13 10:04:51', '2025-07-19 21:14:24'),
(41, NULL, 'Fati', 'Usman', 'usmanfati@gmail.com', NULL, '$2y$10$YMbH.nuT/EEyJovb/wF1nuwWh0TtZLDBuwBLpxbc36TwJm6DmLRM2', NULL, '123', '12', 2, 'Female', NULL, '2025-02-23', NULL, '12', 'ISLAM', '08036849688', NULL, '202503131054506mhmkksrxfpzbuhewwde.jpg', 'A+', '65', '65', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2025-03-13 10:54:50', '2025-07-19 21:29:05'),
(42, NULL, 'haruna', 'jibrin', 'haruna@gmail.com', NULL, '$2y$10$c3XOK052f93/F7hDmzxE/OL/lVIqRwbLXGW6gfvjpMQksNbIqnGDC', NULL, '1234', '16', 8, 'Male', NULL, '2025-07-07', NULL, 'zxcv', 'ISLAM', '09087654322', NULL, '2025071011391317xyh3armpptkgubosvd.jpg', '0', '150', '150', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2025-07-07 11:03:53', '2025-07-10 10:39:13'),
(43, NULL, 'Gana', NULL, 'admin09@gmail.com', NULL, '$2y$10$eqePVmCUhCS9FALhJYJQZ.Xe7gJw0z42bB/b/PiVggiMavf3xUatC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2025-08-14 10:00:22', '2025-08-14 10:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

CREATE TABLE `week` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fullcalendar_day` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`id`, `name`, `fullcalendar_day`, `created_at`, `updated_at`) VALUES
(1, 'Monday', 1, NULL, NULL),
(2, 'Tuesday', 2, NULL, NULL),
(3, 'Wednesday ', 3, NULL, NULL),
(4, 'Thursday ', 4, NULL, NULL),
(5, 'Friday  ', 5, NULL, NULL),
(6, 'Saturday   ', 6, NULL, NULL),
(7, 'Sunday    ', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework_submit`
--
ALTER TABLE `homework_submit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks_grade`
--
ALTER TABLE `marks_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark_register`
--
ALTER TABLE `mark_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_board_message`
--
ALTER TABLE `notice_board_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_add_fees`
--
ALTER TABLE `student_add_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `homework_submit`
--
ALTER TABLE `homework_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `marks_grade`
--
ALTER TABLE `marks_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mark_register`
--
ALTER TABLE `mark_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notice_board_message`
--
ALTER TABLE `notice_board_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_add_fees`
--
ALTER TABLE `student_add_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `week`
--
ALTER TABLE `week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
