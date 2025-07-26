-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 12:51 PM
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
-- Database: `btl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`) VALUES
(7, 8, 7, 5, '2025-07-18 16:15:17'),
(8, 8, 8, 4, '2025-07-18 16:15:43'),
(10, 8, 9, 2, '2025-07-18 18:59:19'),
(11, 6, 9, 1, '2025-07-19 16:10:26'),
(12, 6, 8, 1, '2025-07-19 17:25:45'),
(13, 6, 7, 1, '2025-07-19 17:25:50'),
(26, 11, 9, 2, '2025-07-26 09:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'củ'),
(3, 'quả'),
(5, 'rau');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `giasp` int(11) NOT NULL DEFAULT 0,
  `anh` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `tensp`, `giasp`, `anh`, `mota`, `category_id`) VALUES
(7, 'quả nho', 20000, 'tải xuống (2).jpg', 'quả nho', 3),
(8, 'quả chanh', 30000, 'images.jpg', 'quả chanh ', 3),
(9, 'táo', 10000, 'OIP.jfif', 'táo siêu ngọt', 3),
(11, 'khoai tây', 100000, 'khoai.jpg', 'củ khoai tây ', 2),
(12, 'cà rốt', 20000, 'caruot.jpg', 'cà ruốt tươi nhập khẩu bán theo kg', 2),
(13, 'quả dưa chuột', 8000, 'duachuot.jpg', 'quả dưa chuột nhập bán theo kg', 3),
(14, 'cà tím', 15000, 'tải xuống.jpg', 'quả cà tím nhập khẩu bán theo kg', 3),
(15, 'quả cà chua', 5000, 'cachua.webp', 'cà chua trồng nhà kính siêu sạch', 3),
(16, 'rau muống', 5000, 'raumuong.jpg', 'rau muống siêu sạch', 5),
(17, 'xúp lơ', 10000, 'xuplo.jpg', 'xúp lơ siêu sạch siêu tươi', 5);

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
(4, 'thang12131', 'trinhvanh7@gmail.com', '0999999999', 'bac ninh', '$2y$10$Vv04wZU3UjRvw7qsSqI6EuKYNQopJQbJ4TMCxfNE/btXExqVWH19u', 'admin'),
(5, 'bon', 'trinhvanh4@gmail.com', '9999999999', 'TRONG', '$2y$10$oSFwaj.A8aw.GMm87fJB3ugDKxtEljY3lpXdac5a14CULkI2Uwgim', 'admin'),
(6, 'sausausausausausau', 'trinhvanh6@gmail.com', '', '', '$2y$10$m4YEBryBBPGQ4vqEqSiTJurN6Pwi9QjgAIPxCqM7Mq4Nd7pb2uReq', 'user'),
(7, 'thang', 'thang7@gmai.com', '0382795496', 'sjdaihshad', '$2y$10$qKjilL7gyFwZRRKswnLPEe5HgXkPzk3BhLpiQam.rabWUkcX65kq.', 'user'),
(8, 'tam', 'trinhvanh8@gmail.com', '0962361521', 'hcm', '$2y$10$M0ry/q2CyaICPibFDPSlJesYts0.SF52ILtK1LwQvtV6cehfT9cEK', 'user'),
(9, 'chin', 'trinhvanh9@gmail.com', '0962361521', 'hà nội', '$2y$10$z37B4Jeo2XEpN2gBhn3yhOPyIInir5oYIx08cURYpJE4uAAhitJDC', 'admin'),
(10, 'muoi', 'trinhvanh10@gmail.com', '0962361521', 'ha', '$2y$10$AxWnd1k5rDd1GIJPC1OT1OM2eP3SpeoE0kWcEB2/0BN.SKcjj0e.a', 'user'),
(11, 'thang123', 'thang123@gmail.com', '02938928932', 'ajsdajsdj', '$2y$10$ZS4diu2D3y2GPY/IJ8h/9.aMGHliEgClTZXp0abyqGXjOlMcKB62a', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sanpham_category_id` (`category_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `sanpham` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
