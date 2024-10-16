-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 04:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vending_machine`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `quantityAvailable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantityAvailable`) VALUES
(12, 'Coke', '4.500', 17),
(15, 'Pizza', '2.500', 11),
(17, 'rice', '50.000', 10),
(18, 'Hot pot', '6.500', 12),
(19, 'Hot dot', '11.000', 10),
(20, 'sandwish', '8.300', 10),
(21, 'Marlar Update', '4.300', 10);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `transaction_date`) VALUES
(1, 5, 12, 2, '9', '2024-10-15 16:13:20'),
(2, 5, 12, 100, '450', '2024-10-15 16:23:06'),
(3, 5, 12, 2, '9', '2024-10-15 16:32:08'),
(4, 5, 12, 2, '9', '2024-10-15 16:33:21'),
(5, 5, 14, 3, '2', '2024-10-15 16:33:31'),
(6, 5, 14, 7, '4', '2024-10-15 16:39:53'),
(7, 5, 14, 7, '4', '2024-10-15 16:49:49'),
(8, 4, 12, 1, '5', '2024-10-15 16:51:39'),
(9, 5, 16, 1, '1', '2024-10-15 17:42:43'),
(10, 5, 16, 3, '3', '2024-10-15 19:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(4, 'Ye Aung Khant', 'yeaungkhant077@gmail.com', '$2y$10$BjEt5Ymaj4b6O/yS6ZrizO/qfDtS7alfniCfe8opqnQUavZ11eanS', 'User', '2024-10-15 06:17:28', '2024-10-15 06:17:28'),
(5, 'Admin', 'admin@gmail.com', '$2y$10$UOn76AGvaZGxLAIPd6TB3.iRniK9vWJehZIES503JwqJrPYYjQONW', 'Admin', '2024-10-15 07:41:46', '2024-10-15 07:41:46'),
(8, 'testinguser', 'user1@gmail.com', '$2y$10$L8Hc5yY3ZFeEEk3op178lO.5UkxtOKW/jJNHuIL9nUHNonWO11k4O', 'User', '2024-10-15 20:54:17', '2024-10-15 20:54:17'),
(9, 'superadmin', 'yeaungkhant077@gmail.com', '$2y$10$j2ljS3UfAHgzCvTGR.SCau7TVQ4.lrXhk9Smft5UF3OsflTXLemma', 'User', '2024-10-15 20:55:15', '2024-10-15 20:55:15'),
(10, 'superadmin', 'yeaungkhant077@gmail.com', '$2y$10$NUSvhxJ5zxkG1mfD8DKxT.E8i1ZDA8a7njDXyKmOpt5zoZRK6gBJm', 'User', '2024-10-15 20:56:48', '2024-10-15 20:56:48'),
(11, 'superadmin', 'yeaungkhant077@gmail.com', '$2y$10$HIX.eSDbzAUesTetFBc/RuCdZHHmyk0qAjH3BSCbjpySL5elqTSQW', 'User', '2024-10-15 20:57:55', '2024-10-15 20:57:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
