-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 06:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clemenabam285`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'johnrey', 'joqu.clemena.coc@phinmaed.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `leavedate` date NOT NULL,
  `leavereason` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `name`, `email`, `department`, `leavedate`, `leavereason`, `status`) VALUES
(1, 'Clemeña , John Rey', 'joqu.clemena.coc@phinmaed.com', 'Development', '2025-01-18', 'Maternity/Paternity Leave', 1),
(2, 'Clemeña , John Rey', 'joqu.clemena.coc@phinmaed.com', 'Development', '2025-01-16', 'Medical Appointment', 1),
(3, 'Clemeña , John Rey', 'joqu.clemena.coc@phinmaed.com', 'Development', '2025-01-31', 'Personal Reasons', 2),
(4, 'Clemeña , John Rey', 'joqu.clemena.coc@phinmaed.com', 'Development', '2025-01-30', 'Relocation', 0),
(5, 'Clemeña , John Rey', 'joqu.clemena.coc@phinmaed.com', 'Development', '2025-02-11', 'Training or Education', 0),
(6, 'Clemeña , John Rey', 'joqu.clemena.coc@phinmaed.com', 'Development', '2025-03-11', 'Bereavement', 1),
(8, 'Roy', 'roy@gmail.com', 'Marketing', '2025-01-11', 'Medical Appointment', 0),
(9, 'Roy', 'roy@gmail.com', 'Marketing', '2025-01-23', 'Medical Appointment', 0),
(10, 'Tan', 'tan@gmail.com', 'Design', '2025-01-11', 'Family Emergency', 0),
(11, 'Tan', 'tan@gmail.com', 'Design', '2025-04-17', 'Relocation', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(333) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `department`, `email`, `password`) VALUES
(1, 'Clemeña , John Rey', 'Development', 'joqu.clemena.coc@phinmaed.com', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'Roy', 'Marketing', 'roy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'Tan', 'Design', 'tan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
