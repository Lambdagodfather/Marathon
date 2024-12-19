-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 11:37 PM
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
-- Database: `marathon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `time` datetime NOT NULL,
  `ranges` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `address`, `time`, `ranges`, `image`) VALUES
(1, 'Test Course', 'Ho Tay', '2024-12-20 07:00:00', '10', 'images/courseimg/c.png'),
(2, 'Test Course', 'Ho Tay', '2024-12-20 07:00:00', '10', 'images/courseimg/c.png'),
(3, 'Test Course', 'Ho Tay', '2024-12-21 03:23:00', '5', 'images/courseimg/c.png'),
(4, 'Another Course', 'Ho Hoan Kiem', '2024-12-28 05:00:00', '12', 'images/courseimg/c.png'),
(5, 'Final', 'Long Bien', '2024-12-27 05:30:00', '10', 'images/courseimg/pexels-runffwpu-2002209.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `racebib` varchar(255) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  `record` time DEFAULT NULL,
  `standing` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`name`, `email`, `birthdate`, `passport`, `gender`, `nationality`, `address`, `phone`, `racebib`, `hotel`, `record`, `standing`, `course_id`) VALUES
('Test', 'a1@gmail.com', '1990-11-11', NULL, 'male', 'vn', 'Ho Tay', '1111111112', '3', NULL, '00:00:02', 1, 1),
('Test', 'a2@gmail.com', '2000-11-11', NULL, 'male', 'jp', 'Ho Tay', '1111111113', '2', NULL, '00:00:07', 4, 1),
('Test', 'a3@gmail.com', '2000-11-11', NULL, 'male', 'vn', 'Ho Tay', '1111111115', NULL, NULL, NULL, NULL, 1),
('Test', 'a@gmail.com', '1990-11-11', NULL, 'male', 'vn', 'Ho Tay', '1111111111', '1', NULL, '00:00:03', 2, 1),
('Vu Hoang Hiep', 'vuhoanghiep1606@gmail.com', '2004-12-06', NULL, 'male', 'jp', 'Dong Ky - Tu Son - Bac Ninh', '0329341704', '50', 'none', '00:00:05', 3, 1),
('Vu Hoang Hiep', 'vuhoanghiep1606@gmail.com', '2004-06-12', NULL, 'male', 'vn', 'Dong Ky - Tu Son - Bac Ninh', '0329341704', NULL, 'none', NULL, NULL, 2),
('Vu Hoang Hiep', 'vuhoanghiep1606@gmail.com', '2004-12-06', NULL, 'male', 'vn', 'Dong Ky - Tu Son - Bac Ninh', '0329341704', NULL, 'none', NULL, NULL, 4),
('Vu Hoang Hiep', 'vuhoanghiep1606@gmail.com', '2004-12-01', NULL, 'male', 'vn', 'Dong Ky - Tu Son - Bac Ninh', '0329341704', NULL, 'none', NULL, NULL, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`email`,`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
