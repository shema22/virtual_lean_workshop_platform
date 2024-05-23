-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 11:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_vlwp`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `app_id` int(11) NOT NULL,
  `attendeeID` int(11) DEFAULT NULL,
  `pay_method` varchar(50) DEFAULT NULL,
  `amount` varchar(200) DEFAULT NULL,
  `proof` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`app_id`, `attendeeID`, `pay_method`, `amount`, `proof`) VALUES
(1, NULL, 'MM Method', '100,000', 'africa-map-logo-template_23-2148724914.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `attendeeID` int(11) NOT NULL,
  `wshopID` int(11) DEFAULT NULL,
  `reg_no` varchar(8) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT 'reg_no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`attendeeID`, `wshopID`, `reg_no`, `name`, `phone`, `email`, `created_at`, `updated_at`, `created_by`, `updated_by`, `password`) VALUES
(5, 4, '123', 'hh', '078987654', 'hh@gmail.com', '2024-05-15 13:59:53', '2024-05-15 13:59:53', NULL, NULL, '$2y$10$XCx4o/clFay84711ohigl.lOx3GF8CH1TC./dqmh4xETtvtuAYlmq'),
(7, 4, '111', 'shema', '0782893355', 'shema123@gmail.com', '2024-05-15 14:31:39', '2024-05-15 14:31:39', 25, NULL, '698d51a19d8a121ce581499d7b701668'),
(8, 4, '789', 'hassan', '078899889988', 'hh@gmail.com', '2024-05-15 14:32:37', '2024-05-19 10:36:18', 25, '25', '68053af2923e00204c3ca7c6a3150cf7'),
(10, 4, '7899', 'yvan', '07889988998', 'hhh@gmail.com', '2024-05-15 14:34:05', '2024-05-21 13:47:43', 25, '27', '7c792a8279211dece3b4df04719c818a');

-- --------------------------------------------------------

--
-- Table structure for table `attendees_attendance`
--

CREATE TABLE `attendees_attendance` (
  `att_id` int(11) NOT NULL,
  `moduleID` int(11) DEFAULT NULL,
  `attendeeID` int(11) DEFAULT NULL,
  `instructorID` int(11) DEFAULT NULL,
  `attendance` char(1) DEFAULT NULL,
  `datec` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees_attendance`
--

INSERT INTO `attendees_attendance` (`att_id`, `moduleID`, `attendeeID`, `instructorID`, `attendance`, `datec`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 5, 5, 9, '1', '2024-05-15', '2024-05-15 20:07:53', '2024-05-15 20:07:53', NULL, NULL),
(2, 6, NULL, NULL, '0', '2024-05-19', '2024-05-19 14:20:33', '2024-05-19 14:20:33', NULL, NULL),
(3, 6, NULL, NULL, '0', '2024-05-19', '2024-05-19 14:20:33', '2024-05-19 14:20:33', NULL, NULL),
(4, 6, NULL, NULL, '0', '2024-05-19', '2024-05-19 14:20:33', '2024-05-19 14:20:33', NULL, NULL),
(5, 6, NULL, NULL, '0', '2024-05-19', '2024-05-19 14:20:33', '2024-05-19 14:20:33', NULL, NULL),
(6, 6, 5, NULL, '1', '2024-05-19', '2024-05-19 14:21:07', '2024-05-19 14:21:07', NULL, NULL),
(7, 6, 7, NULL, '0', '2024-05-19', '2024-05-19 14:21:07', '2024-05-19 14:21:07', NULL, NULL),
(8, 6, 8, NULL, '0', '2024-05-19', '2024-05-19 14:21:07', '2024-05-19 14:21:07', NULL, NULL),
(9, 6, 10, NULL, '0', '2024-05-19', '2024-05-19 14:21:07', '2024-05-19 14:21:07', NULL, NULL),
(10, 6, 5, 10, '1', '2024-05-19', '2024-05-19 14:22:05', '2024-05-19 14:22:05', NULL, NULL),
(11, 6, 7, 10, '0', '2024-05-19', '2024-05-19 14:22:05', '2024-05-19 14:22:05', NULL, NULL),
(12, 6, 8, 10, '0', '2024-05-19', '2024-05-19 14:22:05', '2024-05-19 14:22:05', NULL, NULL),
(13, 6, 10, 10, '0', '2024-05-19', '2024-05-19 14:22:05', '2024-05-19 14:22:05', NULL, NULL),
(14, 6, 5, 10, '1', '2024-05-21', '2024-05-21 14:05:05', '2024-05-21 14:05:05', NULL, NULL),
(15, 6, 7, 10, '1', '2024-05-21', '2024-05-21 14:05:05', '2024-05-21 14:05:05', NULL, NULL),
(16, 6, 8, 10, '1', '2024-05-21', '2024-05-21 14:05:05', '2024-05-21 14:05:05', NULL, NULL),
(17, 6, 10, 10, '1', '2024-05-21', '2024-05-21 14:05:05', '2024-05-21 14:05:05', NULL, NULL),
(18, 6, 10, 10, '1', '2024-05-21', '2024-05-21 14:05:05', '2024-05-21 14:05:05', NULL, NULL),
(19, 6, 5, 10, '1', '2024-05-22', '2024-05-22 20:54:12', '2024-05-22 20:54:12', NULL, NULL),
(20, 6, 7, 10, '1', '2024-05-22', '2024-05-22 20:54:12', '2024-05-22 20:54:12', NULL, NULL),
(21, 6, 8, 10, '1', '2024-05-22', '2024-05-22 20:54:12', '2024-05-22 20:54:12', NULL, NULL),
(22, 6, 10, 10, '1', '2024-05-22', '2024-05-22 20:54:12', '2024-05-22 20:54:12', NULL, NULL),
(23, 6, 10, 10, '1', '2024-05-22', '2024-05-22 20:54:12', '2024-05-22 20:54:12', NULL, NULL),
(24, 5, 5, 9, '1', '2024-05-22', '2024-05-22 21:09:42', '2024-05-22 21:09:42', NULL, NULL),
(25, 5, 5, 9, '1', '2024-05-22', '2024-05-22 21:09:42', '2024-05-22 21:09:42', NULL, NULL),
(26, 5, 7, 9, '1', '2024-05-22', '2024-05-22 21:09:42', '2024-05-22 21:09:42', NULL, NULL),
(27, 5, 8, 9, '1', '2024-05-22', '2024-05-22 21:09:42', '2024-05-22 21:09:42', NULL, NULL),
(28, 5, 10, 9, '1', '2024-05-22', '2024-05-22 21:09:42', '2024-05-22 21:09:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendees_modules`
--

CREATE TABLE `attendees_modules` (
  `ID` int(11) NOT NULL,
  `attendeeID` int(11) DEFAULT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp(),
  `createdBy` varchar(30) DEFAULT NULL,
  `updatedBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees_modules`
--

INSERT INTO `attendees_modules` (`ID`, `attendeeID`, `ModuleID`, `createdAt`, `updatedAt`, `createdBy`, `updatedBy`) VALUES
(34, 5, 5, '2024-05-15 14:18:58', '2024-05-15 14:18:58', '25', ''),
(35, 5, 5, '2024-05-19 10:36:36', '2024-05-19 10:36:36', '5', ''),
(36, 7, 5, '2024-05-19 10:36:49', '2024-05-19 10:36:49', '7', ''),
(37, 8, 5, '2024-05-19 10:37:04', '2024-05-19 10:37:04', '8', ''),
(38, 5, 6, '2024-05-19 10:37:32', '2024-05-19 10:37:32', '5', ''),
(39, 7, 6, '2024-05-19 10:37:50', '2024-05-19 10:37:50', '7', ''),
(40, 8, 6, '2024-05-19 10:38:00', '2024-05-19 10:38:00', '8', ''),
(41, 10, 6, '2024-05-19 11:58:06', '2024-05-19 11:58:06', '10', ''),
(42, 10, 5, '2024-05-21 13:49:19', '2024-05-21 13:49:19', '10', ''),
(43, 10, 6, '2024-05-21 13:49:19', '2024-05-21 13:49:19', '10', '');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructorID` int(11) NOT NULL,
  `wshopID` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(24) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(30) DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT 'name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructorID`, `wshopID`, `name`, `phone`, `email`, `created_at`, `updated_at`, `created_by`, `updated_by`, `password`) VALUES
(4, 4, 'pac', '0782893354', 'admin123@gmail.com', '2024-05-15 13:36:51', '2024-05-19 10:38:49', 'shema', 'pac', '789adfdcea5becf7ab4b27347b0dca88'),
(9, 4, 'shema', '0782893359', 'admin123@gmail.col', '2024-05-15 13:41:22', '2024-05-15 13:41:22', 'shema', NULL, '789adfdcea5becf7ab4b27347b0dca88'),
(10, 5, 'java', '0722567890', 'java@gmail.com', '2024-05-19 11:53:18', '2024-05-19 11:53:18', 'java', NULL, '93f725a07423fe1c889f448b33d21f46');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_moules`
--

CREATE TABLE `instructor_moules` (
  `id` int(11) NOT NULL,
  `instructorID` int(11) NOT NULL,
  `moduleID` int(11) NOT NULL,
  `assignedBy` varchar(30) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_moules`
--

INSERT INTO `instructor_moules` (`id`, `instructorID`, `moduleID`, `assignedBy`, `createdAt`, `updatedAt`, `updatedBy`) VALUES
(15, 4, 5, '', '2024-05-15 13:58:31', '2024-05-15 13:58:31', ''),
(16, 9, 5, '', '2024-05-15 14:11:17', '2024-05-15 14:11:17', ''),
(17, 10, 6, '', '2024-05-19 11:57:51', '2024-05-19 11:57:51', ''),
(18, 4, 5, '', '2024-05-21 13:52:07', '2024-05-21 13:52:07', ''),
(19, 9, 5, '', '2024-05-22 21:08:56', '2024-05-22 21:08:56', '');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `ModuleID` int(11) NOT NULL,
  `Course_name` varchar(50) DEFAULT NULL,
  `Course_code` varchar(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(30) DEFAULT NULL,
  `updated_by` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`ModuleID`, `Course_name`, `Course_code`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'web technology', '001', '2024-05-15 13:43:12', '2024-05-15 13:43:12', NULL, NULL),
(6, 'java programming', 'JP003', '2024-05-19 10:37:23', '2024-05-19 10:37:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problem_issued`
--

CREATE TABLE `problem_issued` (
  `id` int(11) NOT NULL,
  `reporter` int(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `probem` text DEFAULT NULL,
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem_issued`
--

INSERT INTO `problem_issued` (`id`, `reporter`, `email`, `probem`, `reported_at`) VALUES
(8, 7, 'shema123@gmail.com', 'hhhh', '2024-05-19 15:41:03'),
(9, 8, 'hh@gmail.com', 'missing attendance because of sickness? what i suppose to do?', '2024-05-22 20:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `problem_reply`
--

CREATE TABLE `problem_reply` (
  `id` int(11) NOT NULL,
  `rep` int(11) DEFAULT NULL,
  `reply` varchar(250) DEFAULT NULL,
  `replied_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem_reply`
--

INSERT INTO `problem_reply` (`id`, `rep`, `reply`, `replied_at`) VALUES
(1, NULL, ' how we can help you?', '2024-05-19 17:10:59'),
(2, NULL, ' XXX', '2024-05-19 17:13:27'),
(3, NULL, ' ccc', '2024-05-19 17:14:42'),
(4, 8, ' dddeeeee', '2024-05-19 17:20:09'),
(5, 9, ' you have to communicate with your Instructor, then make sure you participate in all activities settled on workshop. so you will have special case because you missing some activities', '2024-05-22 21:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `subscribe_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `name`, `email`, `password`, `subscribe_at`) VALUES
(1, '0', 'kaBlaise2020@gmail.com', '$2y$10$xoLRXYVV86XDm', '2024-05-12 08:10:57'),
(2, '0', 'niyo250@gmail.com', '$2y$10$xCxsVFdzdwe.g', '2024-05-12 08:12:01'),
(3, 'keza joana', 'kezajo2@gmail.com', '$2y$10$xHOQjINOKTp3P', '2024-05-12 08:56:10'),
(4, 'Rukundo shema Aloys', 'rashonly8@gmail.com', '$2y$10$k1Gq4CSlZwKvL', '2024-05-21 13:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userName` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createdBy` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `email`, `userName`, `password`, `createdBy`, `created_at`, `updated_at`) VALUES
(19, 'rashonly8@gmail.com', 'shema', '$2y$10$8m.OwhWh6PQBNx5wMBpU5ur06FYa9uAZOz32RMHocPqQlaWtNeiSq', 'shema', '2024-05-15 12:57:53', '2024-05-15 12:57:53'),
(24, 'admin123@gmail.com', 'shema', '$2y$10$VCmu.lZHBuK4HrEQ6sYJ1eAw4Y2nmd7WEuMcxMS/Ml2uTvuWojn6C', 'shema', '2024-05-15 13:03:08', '2024-05-15 13:03:08'),
(25, 'hh@gmail.com', 'hh', '202cb962ac59075b964b07152d234b70', 'hh', '2024-05-15 13:10:47', '2024-05-15 13:10:47'),
(26, 'admin123@gmail.col', 'shema', '789adfdcea5becf7ab4b27347b0dca88', 'shema', '2024-05-15 13:41:22', '2024-05-15 13:41:22'),
(27, 'admin@gmail.com', 'admins', '202cb962ac59075b964b07152d234b70', 'admins', '2024-05-19 11:51:34', '2024-05-19 11:51:34'),
(28, 'admin@gmail.com', 'admins', '202cb962ac59075b964b07152d234b70', 'admins', '2024-05-19 11:52:15', '2024-05-19 11:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `wshopID` int(11) NOT NULL,
  `wname` varchar(50) DEFAULT NULL,
  `physical_addres` varchar(25) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdBy` varchar(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`wshopID`, `wname`, `physical_addres`, `url`, `email`, `phone`, `password`, `created_at`, `createdBy`, `updated_at`) VALUES
(4, 'learing wise', 'HUYE-UR', 'learningwise.com', 'xxx2024@gmail.com', '0788435623', '5f9514f9334fba3970ef4b1bf131b4e7', '2024-05-15 13:31:36', 'learing wise', '2024-05-15 13:31:36'),
(5, 'INNOVATION HUB', 'HUYE-UR', 'ur.innovationhub.rw', 'innovationhub@gmail.com', '0788435625', '9859c272f4e4495766e06fcca38723df', '2024-05-19 10:13:00', 'INNOVATION HUB', '2024-05-19 10:13:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `attendeeID` (`attendeeID`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendeeID`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD KEY `wshopID` (`wshopID`);

--
-- Indexes for table `attendees_attendance`
--
ALTER TABLE `attendees_attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `attendeeID` (`attendeeID`),
  ADD KEY `moduleID` (`moduleID`),
  ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `attendees_modules`
--
ALTER TABLE `attendees_modules`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `attendeeID` (`attendeeID`),
  ADD KEY `moduleID` (`ModuleID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructorID`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `wshopID` (`wshopID`);

--
-- Indexes for table `instructor_moules`
--
ALTER TABLE `instructor_moules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moduleID` (`moduleID`),
  ADD KEY `instructorID` (`instructorID`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`ModuleID`),
  ADD UNIQUE KEY `Course_name` (`Course_name`),
  ADD UNIQUE KEY `Course_code` (`Course_code`);

--
-- Indexes for table `problem_issued`
--
ALTER TABLE `problem_issued`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporter` (`reporter`);

--
-- Indexes for table `problem_reply`
--
ALTER TABLE `problem_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rep` (`rep`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`wshopID`),
  ADD UNIQUE KEY `wname` (`wname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `attendeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendees_attendance`
--
ALTER TABLE `attendees_attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `attendees_modules`
--
ALTER TABLE `attendees_modules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instructor_moules`
--
ALTER TABLE `instructor_moules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `ModuleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `problem_issued`
--
ALTER TABLE `problem_issued`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `problem_reply`
--
ALTER TABLE `problem_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `wshopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`attendeeID`) REFERENCES `attendees` (`attendeeID`);

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`wshopID`) REFERENCES `workshop` (`wshopID`);

--
-- Constraints for table `attendees_attendance`
--
ALTER TABLE `attendees_attendance`
  ADD CONSTRAINT `attendees_attendance_ibfk_1` FOREIGN KEY (`attendeeID`) REFERENCES `attendees` (`attendeeID`),
  ADD CONSTRAINT `attendees_attendance_ibfk_2` FOREIGN KEY (`moduleID`) REFERENCES `modules` (`ModuleID`),
  ADD CONSTRAINT `attendees_attendance_ibfk_3` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`);

--
-- Constraints for table `attendees_modules`
--
ALTER TABLE `attendees_modules`
  ADD CONSTRAINT `attendees_modules_ibfk_1` FOREIGN KEY (`attendeeID`) REFERENCES `attendees` (`attendeeID`),
  ADD CONSTRAINT `attendees_modules_ibfk_2` FOREIGN KEY (`ModuleID`) REFERENCES `modules` (`ModuleID`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`wshopID`) REFERENCES `workshop` (`wshopID`);

--
-- Constraints for table `instructor_moules`
--
ALTER TABLE `instructor_moules`
  ADD CONSTRAINT `instructor_moules_ibfk_1` FOREIGN KEY (`moduleID`) REFERENCES `modules` (`ModuleID`),
  ADD CONSTRAINT `instructor_moules_ibfk_2` FOREIGN KEY (`instructorID`) REFERENCES `instructor` (`instructorID`);

--
-- Constraints for table `problem_issued`
--
ALTER TABLE `problem_issued`
  ADD CONSTRAINT `problem_issued_ibfk_1` FOREIGN KEY (`reporter`) REFERENCES `attendees` (`attendeeID`);

--
-- Constraints for table `problem_reply`
--
ALTER TABLE `problem_reply`
  ADD CONSTRAINT `problem_reply_ibfk_1` FOREIGN KEY (`rep`) REFERENCES `problem_issued` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
