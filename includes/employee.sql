-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 10:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` text DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `user_zip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`user_id`, `user_name`, `user_email`, `user_address`, `user_city`, `user_zip`) VALUES
(1, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(2, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(3, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(4, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(5, 'mae binihahah', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(6, 'mae binihahah', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(7, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(8, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(9, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(10, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(11, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(12, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(13, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(14, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(15, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(16, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(17, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(18, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(19, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(20, 'mae bini', 'vanjaminmagpantay@gmail.com', '123 St.', 'Cagayan de oro', '9000'),
(21, 'step sumanda', 'vanjaminmagpantay@gmail.com', 'cdo city', 'Cagayan de oro', '9000'),
(22, 'step sumanda', 'vanjaminmagpantay@gmail.com', 'cdo city', 'Cagayan de oro', '9000'),
(23, 'step sumanda', 'vanjaminmagpantay@gmail.com', 'cdo city', 'Cagayan de oro', '9000'),
(24, 'step sumanda', 'vanjaminmagpantay@gmail.com', 'cdo city', 'Cagayan de oro', '9000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
