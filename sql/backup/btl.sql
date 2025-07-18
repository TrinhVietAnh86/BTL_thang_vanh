-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 10:43 AM
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
-- Database: `btl`
--

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `giasp` int(11) NOT NULL DEFAULT 0,
  `anh` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `tensp`, `giasp`, `anh`, `mota`) VALUES
(10, 'cahgbjb', 120000000, '1.jpg', 'fshjfy'),
(11, 'ca', 12000000, '3.jpg', 'dfg'),
(12, 'SGTH', 45635, '5.jpg', 'FHTRH'),
(13, 'hfhaf', 53643856, '4.jpg', 'sfjafa'),
(14, 'SGTHgjk', 4354545, '3.jpg', '43yrtu7t'),
(15, 'cahgbjb', 453254, 'Screenshot 2024-09-24 191301.png', '435dfdjt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `address`, `password`, `role`) VALUES
(4, 'haivanba', 'trinhvanh5@gmail.com', '0962361521', 'hà nội', '$2y$10$JtinnCHlKgRHcG4zP62BD.b5lYtoJuFSpXkMEPao8URUZCdPmjAhC', 'user'),
(5, 'bon', 'trinhvanh4@gmail.com', '0962361521', 'hà nội', '$2y$10$NFY9jI.ogZikTyOStDi6z.Aca0DzPjPXEP..rK3Dbb5NxFEzeA3be', 'admin'),
(6, 'sau', 'trinhvanh6@gmail.com', '0962361521', 'hà nội', '$2y$10$PHIZ12RGhzWdmCFI3iJageQ5wDhY2XYNVT3sXItTxZObm0YpJwh1.', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
