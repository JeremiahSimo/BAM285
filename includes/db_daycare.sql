-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 09:20 AM
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
-- Database: `db_daycare`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `child_id` int(11) NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `delete_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `child_id`, `check_in`, `check_out`, `attendance_status`, `delete_status`) VALUES
(1, '2025-01-10', 1, '03:56:00', '02:59:00', 'Present', 0),
(2, '2025-01-09', 3, '02:41:00', '14:41:00', 'Present', 0),
(3, '2025-01-08', 1, '02:44:00', '14:44:00', 'Absent', 0),
(4, '2025-01-08', 3, '02:44:00', '14:44:00', 'Present', 0),
(5, '2025-01-11', 1, '13:43:00', '18:44:00', 'Present', 0),
(6, '2025-01-11', 3, '13:43:00', '18:44:00', 'Present', 0);

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `special_notes` text DEFAULT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `delete_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `full_name`, `date_of_birth`, `parent_name`, `contact_info`, `special_notes`, `age`, `gender`, `delete_status`) VALUES
(1, 'Van Jamin', '2020-01-01', 'Ben Jamin', '09111111111', 'Bawal sya sa baboy', 5, 'Male', 0),
(2, 'Mae Jabulan', '2019-02-02', 'Jabulan', '09222222222', 'Bawal sa ', 6, 'Female', 0),
(3, 'Vann Jans', '2020-03-03', 'Vans', '09333333333', 'None', 5, 'Male', 1),
(4, 'Maeee', '2019-02-01', 'Maene', '09121212121', 'Hadlokan sa okok', 6, 'Female', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `good_at` text NOT NULL,
  `overall_feedback` text NOT NULL,
  `date_submitted` datetime DEFAULT current_timestamp(),
  `delete_status` tinyint(1) DEFAULT 0,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `good_at`, `overall_feedback`, `date_submitted`, `delete_status`, `student_id`) VALUES
(1, 'Yeah', 'Yeah', '2025-01-12 12:15:30', 1, 1),
(9, 'Painting', 'gOODS', '2025-01-22 00:00:00', 0, 3),
(10, 'Kabuang', 'Oki', '2025-01-11 15:13:19', 0, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `children` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
