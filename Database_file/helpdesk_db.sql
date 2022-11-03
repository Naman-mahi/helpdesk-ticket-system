-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 07:31 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_id` int(11) NOT NULL,
  `admin_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user_id`, `admin_name`) VALUES
(1, 8, 'naman'),
(14005, 8, 'namana');

-- --------------------------------------------------------

--
-- Table structure for table `assign_ticket`
--

CREATE TABLE `assign_ticket` (
  `assign_id` int(11) NOT NULL,
  `at_ticket_id` int(11) NOT NULL,
  `at_assign_to` int(50) NOT NULL,
  `at_assign_by` int(50) NOT NULL,
  `date_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `generate_ticket`
--

CREATE TABLE `generate_ticket` (
  `ticket_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `school` enum('st admas high school','ms high school','brillant grammar high school') NOT NULL,
  `role` enum('student','parent','teacher','school') NOT NULL,
  `ticketsubject` text NOT NULL,
  `description` text NOT NULL,
  `ticketattachment` text NOT NULL,
  `ticket_status` int(11) NOT NULL,
  `ticket_importance` int(11) NOT NULL,
  `ticket_assign` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `generate_ticket`
--

INSERT INTO `generate_ticket` (`ticket_id`, `firstname`, `lastname`, `email`, `school`, `role`, `ticketsubject`, `description`, `ticketattachment`, `ticket_status`, `ticket_importance`, `ticket_assign`, `datetime`) VALUES
(9, 'real', 'FAKE', 'real@fake.com', 'ms high school', 'student', 'hello users', 'okay your database is working fine', '', 1, 3, 5, '2022-10-17 11:11:55'),
(10, 'sana', 'yousuf', 'sana@gmail.com', 'st admas high school', 'student', 'admission', 'fees structure', '', 1, 1, 5, '2022-10-17 12:36:47'),
(11, 'mudassir', 'abdul', 'muddasir@gmail.com', 'ms high school', 'student', 'tutions', 'extra classes', '', 2, 1, 5, '2022-10-17 12:37:47'),
(12, 'naveen', 'p', 'naveen@gmail.com', 'brillant grammar high school', 'parent', 'teahing', 'no.of subjects', '', 1, 3, 5, '2022-10-17 12:38:35'),
(13, 'bala', 'raju', 'bala@gmail.com', 'ms high school', 'school', 'problem with documents', 'new documents', '', 2, 1, 5, '2022-10-17 12:39:27'),
(18, 'fdd', 'gfdg', 'gfdg@gmail.bnm', '', 'teacher', 'vgghfh', 'hgfhfg', '', 1, 1, 5, '0000-00-00 00:00:00'),
(19, 'gg', 'fgf', 'admin@webdamn.com', '', 'parent', 'gfg', 'gfg', '', 1, 1, 5, '0000-00-00 00:00:00'),
(20, 'gg', 'fgf', 'admin@webdamn.com', '', 'parent', 'gfg', 'gfg', '', 1, 1, 5, '2022-10-18 15:49:28'),
(21, 'dsf', 'dsf', 'fdsf@g.m', '', 'teacher', 'fdsfds', 'fdsfsd', '', 1, 1, 5, '2022-10-18 15:49:44'),
(22, 'dsf', 'dsf', 'fdsf@g.m', '', 'teacher', 'fdsfds', 'fdsfsd', '', 1, 1, 5, '2022-10-18 15:54:05'),
(23, 'gg', 'fgf', 'admin@webdamn.com', '', 'parent', 'gfg', 'gfg', '', 1, 1, 5, '2022-10-18 15:54:11'),
(24, 'VCB', 'CVBCVB', 'gfdgfd@gmail.com', '', 'teacher', 'fg', 'edfdsf', '', 1, 1, 5, '2022-10-19 09:38:39'),
(29, 'VCB', 'CVBCVB', 'gfdgfd@gmail.com', '', 'teacher', 'fg', 'edfdsf', '', 1, 1, 5, '2022-10-19 09:49:35'),
(30, 'fer', 'rtert', 'gfdgfd@gmail.com', '', 'teacher', 'retre', 'terter', '', 1, 1, 5, '2022-10-19 09:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `technical_staff`
--

CREATE TABLE `technical_staff` (
  `ts_id` int(11) NOT NULL,
  `ts_user_id` int(11) NOT NULL,
  `ts_name` tinytext NOT NULL,
  `avtar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technical_staff`
--

INSERT INTO `technical_staff` (`ts_id`, `ts_user_id`, `ts_name`, `avtar`) VALUES
(5, 9, 'naman', '');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_importance`
--

CREATE TABLE `ticket_importance` (
  `importance_id` int(11) NOT NULL,
  `importance` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_importance`
--

INSERT INTO `ticket_importance` (`importance_id`, `importance`) VALUES
(1, 'low'),
(2, 'minor'),
(3, 'major');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status`
--

CREATE TABLE `ticket_status` (
  `status_id` int(11) NOT NULL,
  `ts_status` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`status_id`, `ts_status`) VALUES
(1, 'close'),
(2, 'ongoing'),
(3, 'on-hold'),
(4, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` tinytext NOT NULL,
  `user_password` text NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_role`) VALUES
(8, 'naman', 'e10adc3949ba59abbe56e057f20f883e', 1),
(9, 'namanmahi', 'dfdytryrt6y56566y', 2),
(10, 'fdftgfg', '202cb962ac59075b964b07152d234b70', 2),
(11, 'naman_mahi', '827ccb0eea8a706c4c34a16891f84e7b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `user_role_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_type`) VALUES
(1, 'Admin'),
(2, 'Technical staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`) USING BTREE,
  ADD KEY `userid` (`admin_user_id`);

--
-- Indexes for table `assign_ticket`
--
ALTER TABLE `assign_ticket`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `assign_by` (`at_assign_by`),
  ADD KEY `assignto` (`at_assign_to`),
  ADD KEY `ticketid` (`at_ticket_id`);

--
-- Indexes for table `generate_ticket`
--
ALTER TABLE `generate_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_status` (`ticket_status`),
  ADD KEY `FK_IMPORTANCE` (`ticket_importance`),
  ADD KEY `ticket_assign` (`ticket_assign`);

--
-- Indexes for table `technical_staff`
--
ALTER TABLE `technical_staff`
  ADD PRIMARY KEY (`ts_id`),
  ADD KEY `tsuserid` (`ts_user_id`);

--
-- Indexes for table `ticket_importance`
--
ALTER TABLE `ticket_importance`
  ADD PRIMARY KEY (`importance_id`);

--
-- Indexes for table `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user` (`user_role`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14006;

--
-- AUTO_INCREMENT for table `assign_ticket`
--
ALTER TABLE `assign_ticket`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `generate_ticket`
--
ALTER TABLE `generate_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `technical_staff`
--
ALTER TABLE `technical_staff`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_importance`
--
ALTER TABLE `ticket_importance`
  MODIFY `importance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `userid` FOREIGN KEY (`admin_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `assign_ticket`
--
ALTER TABLE `assign_ticket`
  ADD CONSTRAINT `assign_by` FOREIGN KEY (`at_assign_by`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `assignto` FOREIGN KEY (`at_assign_to`) REFERENCES `technical_staff` (`ts_id`),
  ADD CONSTRAINT `ticketid` FOREIGN KEY (`at_ticket_id`) REFERENCES `generate_ticket` (`ticket_id`);

--
-- Constraints for table `generate_ticket`
--
ALTER TABLE `generate_ticket`
  ADD CONSTRAINT `FK_ASSIGN` FOREIGN KEY (`ticket_assign`) REFERENCES `technical_staff` (`ts_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_IMPORTANCE` FOREIGN KEY (`ticket_importance`) REFERENCES `ticket_importance` (`importance_id`),
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`ticket_status`) REFERENCES `ticket_status` (`status_id`);

--
-- Constraints for table `technical_staff`
--
ALTER TABLE `technical_staff`
  ADD CONSTRAINT `tsuserid` FOREIGN KEY (`ts_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_role`) REFERENCES `user_role` (`user_role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
