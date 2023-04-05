-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2023 at 12:10 AM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `savealot`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(9,2) NOT NULL,
  `total` decimal(9,2) NOT NULL,
  `discount` decimal(9,2) NOT NULL,
  `student` tinyint(1) NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `total`, `discount`, `student`, `date`, `created_at`, `updated_at`) VALUES
(1, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:10:00', '2023-03-29 11:10:00'),
(2, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:21:23', '2023-03-29 11:21:23'),
(3, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:25:36', '2023-03-29 11:25:36'),
(4, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:26:09', '2023-03-29 11:26:09'),
(5, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:26:22', '2023-03-29 11:26:22'),
(6, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:27:42', '2023-03-29 11:27:42'),
(7, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:28:49', '2023-03-29 11:28:49'),
(8, 12, 21.00, 18.90, 2.10, 1, '2023-03-29', '2023-03-29 11:29:36', '2023-03-29 11:29:36'),
(9, 12, 5.00, 4.50, 0.50, 1, '2023-03-29', '2023-03-29 11:34:02', '2023-03-29 11:34:02'),
(10, 6, 8.50, 7.65, 0.85, 1, '2023-04-02', '2023-04-03 05:34:10', '2023-04-03 05:34:10'),
(11, 6, 10.50, 9.45, 1.05, 1, '2023-04-02', '2023-04-03 05:34:26', '2023-04-03 05:34:26'),
(12, 6, 12.00, 10.80, 1.20, 1, '2023-04-02', '2023-04-03 06:14:13', '2023-04-03 06:14:13'),
(13, 6, 12.00, 10.80, 1.20, 1, '2023-04-02', '2023-04-03 06:21:25', '2023-04-03 06:21:25'),
(14, 6, 13.50, 12.15, 1.35, 1, '2023-04-02', '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(15, 6, 28.25, 25.42, 2.83, 1, '2023-04-02', '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(16, 6, 11.00, 9.90, 1.10, 1, '2023-04-02', '2023-04-03 06:36:15', '2023-04-03 06:36:15'),
(17, 4, 44.00, 44.00, 0.00, 0, '2023-04-02', '2023-04-03 06:39:38', '2023-04-03 06:39:38'),
(18, 4, 14.50, 14.50, 0.00, 0, '2023-04-02', '2023-04-03 06:40:56', '2023-04-03 06:40:56'),
(19, 4, 4.50, 4.50, 0.00, 0, '2023-04-02', '2023-04-03 06:43:57', '2023-04-03 06:43:57'),
(20, 6, 19.50, 17.55, 1.95, 1, '2023-04-02', '2023-04-03 06:45:18', '2023-04-03 06:45:18'),
(21, 6, 39.25, 35.32, 3.93, 1, NULL, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(22, 4, 9.00, 9.00, 0.00, 0, NULL, '2023-04-05 05:42:49', '2023-04-05 05:42:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
