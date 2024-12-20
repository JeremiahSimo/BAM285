-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 10:28 AM
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
-- Database: `forms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation_form`
--

CREATE TABLE `reservation_form` (
  `rsv_id` int(11) NOT NULL,
  `rsv_name` varchar(255) NOT NULL,
  `rsv_email` varchar(255) NOT NULL,
  `rsv_phone` int(11) NOT NULL,
  `rsv_date` date NOT NULL,
  `rsv_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation_form`
--

INSERT INTO `reservation_form` (`rsv_id`, `rsv_name`, `rsv_email`, `rsv_phone`, `rsv_date`, `rsv_time`) VALUES
(2, '', '', 0, '0000-00-00', '00:00:00'),
(3, '', '', 0, '0000-00-00', '00:00:00'),
(4, 'serot', 'serot@gmail.com', 2147483647, '2024-12-02', '02:15:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation_form`
--
ALTER TABLE `reservation_form`
  ADD PRIMARY KEY (`rsv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation_form`
--
ALTER TABLE `reservation_form`
  MODIFY `rsv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
