-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 12:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collage_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('0','1') NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `date`) VALUES
(1, 'admin', '123456', '0', 'admin@admin.com', '9855648231', '2023-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `date`) VALUES
(4, 'ali', 'ali@gmail.com', '987456321', 'this is first contact', '2023-05-31 21:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) NOT NULL,
  `exam_date` timestamp NULL DEFAULT current_timestamp(),
  `teacher_id` int(11) DEFAULT NULL,
  `sub_id` bigint(20) NOT NULL,
  `time` enum('first','second') DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `invigilators` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `exam_date`, `teacher_id`, `sub_id`, `time`, `date`, `invigilators`) VALUES
(117, '2023-06-06 21:00:00', NULL, 13, 'first', '2023-05-31 22:22:37', '[\"1\",\"8\"]'),
(118, '2023-05-27 21:00:00', NULL, 14, 'second', '2023-05-31 22:22:37', '[\"9\",\"1\"]'),
(119, '2023-06-17 21:00:00', NULL, 15, 'first', '2023-05-31 22:22:37', '[\"8\",\"9\"]'),
(120, '2023-05-30 21:00:00', NULL, 16, 'second', '2023-05-31 22:22:37', '[\"1\",\"8\"]');

-- --------------------------------------------------------

--
-- Table structure for table `season`
--

CREATE TABLE `season` (
  `id` bigint(20) NOT NULL,
  `season` tinyint(4) DEFAULT NULL,
  `start_exams` date DEFAULT NULL,
  `end_exams` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `season`
--

INSERT INTO `season` (`id`, `season`, `start_exams`, `end_exams`, `date`) VALUES
(1, 2, '2023-05-09', '2023-06-22', '2023-05-31 20:50:05'),
(2, 1, '2023-06-13', '2023-06-20', '2023-05-31 21:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ac_year` int(11) NOT NULL DEFAULT 1,
  `season` int(11) NOT NULL,
  `desc` text DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `ac_year`, `season`, `desc`, `date`) VALUES
(13, 'برمجة1', 2, 1, NULL, '2023-05-03'),
(14, 'arabic', 1, 2, NULL, '2023-05-09'),
(15, 'ميكانيكا', 2, 1, NULL, '2023-05-30'),
(16, 'كفر جوال', 2, 2, NULL, '2023-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `password`, `date`) VALUES
(1, 'ali mohammed ', '123456', '2023-05-03 16:10:13'),
(8, 'khaled mohammed', '123456', '2023-05-09 15:19:05'),
(9, 'ahmed', '123456', '2023-05-09 15:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `teach_subject`
--

CREATE TABLE `teach_subject` (
  `id` bigint(20) NOT NULL,
  `tech_id` bigint(20) NOT NULL,
  `sub_id` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teach_subject`
--

INSERT INTO `teach_subject` (`id`, `tech_id`, `sub_id`, `date`) VALUES
(3, 9, 13, '2023-05-09 15:23:42'),
(4, 8, 14, '2023-05-09 15:23:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teach_subject`
--
ALTER TABLE `teach_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `tech_id` (`tech_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `season`
--
ALTER TABLE `season`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teach_subject`
--
ALTER TABLE `teach_subject`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teach_subject`
--
ALTER TABLE `teach_subject`
  ADD CONSTRAINT `teach_subject_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teach_subject_ibfk_2` FOREIGN KEY (`tech_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
