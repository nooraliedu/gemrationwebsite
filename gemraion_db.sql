-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 09:41 AM
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
-- Database: `bakery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(6, 'umer', '$2y$10$SKCYNTnFePiDby3/beD2PeO8NwAyU4b3ooF4fILdjXHVWpkqSlgp2', '2024-10-25 17:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'asss', 'dddd', '2024-08-18 18:57:28'),
(2, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'asss', 'dddd', '2024-08-18 19:00:53'),
(3, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'asss', 'dddd', '2024-08-18 19:01:18'),
(4, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', '50000', 'ggg', '2024-08-24 09:21:37'),
(5, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', '50000', 'ggg', '2024-08-24 09:21:51'),
(6, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'ggg', 'ffff', '2024-08-24 09:22:14'),
(7, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'ggg', 'ffff', '2024-08-24 09:23:41'),
(8, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', '50000', 'ggggg', '2024-08-24 10:36:05'),
(9, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', '50000', 'ggggg', '2024-08-24 10:36:26'),
(10, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', '50000', 'gggg', '2024-10-05 14:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `shipping_address`, `city`, `total_price`, `order_date`, `contact_number`) VALUES
(45, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 1332.00, '2024-08-24 10:15:32', '015212478752'),
(46, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 56.00, '2024-08-24 10:16:52', '015212478752'),
(47, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 1110.00, '2024-08-24 10:26:27', '015212478752'),
(48, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am wollhaus 16', 'Heilbronn', 56.00, '2024-08-26 16:17:07', '015212478752'),
(49, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 56.00, '2024-10-05 14:48:36', '015212478752'),
(50, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 78.00, '2024-10-05 15:21:21', '015212478752'),
(51, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 56.00, '2024-10-05 15:31:04', '015212478752'),
(52, 'Abdul Haleem', 'a.haleemshinwari@gmail.com', 'Am Wollhaus 16', 'Heilbronn', 168.00, '2024-10-05 15:31:40', '015212478752');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `video_url`) VALUES
(1124, 'BlackDiamantStone', 'Good and expensive', 56.00, 'photo9.jpg', NULL),
(1130, 'product3', 'good product', 56.00, 'photo3.jpg', NULL),
(1133, 'Product5', 'Good procut', 1400.00, 'photo5.jpg', 'WhatsApp Video 2024-10-25 at 17.09.17_dc6eabfd.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txnid` (`txnid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1134;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
