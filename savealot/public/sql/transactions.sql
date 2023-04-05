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
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_picture` varchar(255) DEFAULT NULL,
  `prod_price` decimal(9,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_total` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `prod_id`, `prod_name`, `prod_picture`, `prod_price`, `item_qty`, `item_total`, `created_at`, `updated_at`) VALUES
(1, 12, 1, 12, '', NULL, 6.00, 1, 6.00, '2023-03-29 11:29:36', '2023-03-29 11:29:36'),
(2, 12, 1, 12, '', NULL, 4.50, 1, 4.50, '2023-03-29 11:29:36', '2023-03-29 11:29:36'),
(3, 12, 1, 12, '', NULL, 6.00, 1, 6.00, '2023-03-29 11:29:36', '2023-03-29 11:29:36'),
(4, 12, 1, 12, '', NULL, 4.50, 1, 4.50, '2023-03-29 11:29:36', '2023-03-29 11:29:36'),
(5, 12, 1, 12, '', NULL, 5.00, 1, 5.00, '2023-03-29 11:34:02', '2023-03-29 11:34:02'),
(6, 6, 10, 22, '', NULL, 8.50, 1, 8.50, '2023-04-03 05:34:10', '2023-04-03 05:34:10'),
(7, 6, 11, 21, '', NULL, 6.00, 1, 6.00, '2023-04-03 05:34:26', '2023-04-03 05:34:26'),
(8, 6, 11, 24, '', NULL, 4.50, 1, 4.50, '2023-04-03 05:34:26', '2023-04-03 05:34:26'),
(9, 6, 12, 2, '', NULL, 6.00, 2, 12.00, '2023-04-03 06:14:13', '2023-04-03 06:14:13'),
(10, 6, 13, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 2, 12.00, '2023-04-03 06:21:25', '2023-04-03 06:21:25'),
(11, 6, 14, 7, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(12, 6, 14, 8, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(13, 6, 14, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(14, 6, 15, 21, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 6.00, 1, 6.00, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(15, 6, 15, 22, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 8.50, 1, 8.50, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(16, 6, 15, 23, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 9.25, 1, 9.25, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(17, 6, 15, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(18, 6, 16, 24, 'Miss Vickie\'s Favourites Chips', 'pics/Miss Vickie\'s Favourites.jpeg', 4.50, 1, 4.50, '2023-04-03 06:36:15', '2023-04-03 06:36:15'),
(19, 6, 16, 25, 'Miss Vickie\'s Favourites Chips', 'pics/Miss Vickie\'s Favourites.jpeg', 6.50, 1, 6.50, '2023-04-03 06:36:15', '2023-04-03 06:36:15'),
(20, 4, 17, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 3, 18.00, '2023-04-03 06:39:38', '2023-04-03 06:39:38'),
(21, 4, 17, 3, 'Unsalted Cashews', 'pics/Unsalted_Cashews.webp', 13.00, 1, 13.00, '2023-04-03 06:39:38', '2023-04-03 06:39:38'),
(22, 4, 17, 4, 'Salted Cashews', 'pics/Salted_Cashews.webp', 13.00, 1, 13.00, '2023-04-03 06:39:38', '2023-04-03 06:39:38'),
(23, 4, 18, 21, 'Kellogg\'s Fun Pac Cereal', 'pics/Kellogg\'s Fun Pac Cereal.jpeg', 6.00, 1, 6.00, '2023-04-03 06:40:56', '2023-04-03 06:40:56'),
(24, 4, 18, 22, 'Pop Tarts Jumbo Pack', 'pics/Pop Tarts Jumbo Pack.jpeg', 8.50, 1, 8.50, '2023-04-03 06:40:56', '2023-04-03 06:40:56'),
(25, 4, 19, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-03 06:43:57', '2023-04-03 06:43:57'),
(26, 6, 20, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-03 06:45:18', '2023-04-03 06:45:18'),
(27, 6, 20, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-03 06:45:18', '2023-04-03 06:45:18'),
(28, 6, 20, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-03 06:45:18', '2023-04-03 06:45:18'),
(29, 6, 20, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-03 06:45:18', '2023-04-03 06:45:18'),
(30, 6, 21, 21, 'Kellogg\'s Fun Pac Cereal', 'pics/Kellogg\'s Fun Pac Cereal.jpeg', 6.00, 1, 6.00, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(31, 6, 21, 22, 'Pop Tarts Jumbo Pack', 'pics/Pop Tarts Jumbo Pack.jpeg', 8.50, 1, 8.50, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(32, 6, 21, 23, 'Lay\'s Chips Variety Pack', 'pics/Lays Mix Variety Pack.jpeg', 9.25, 1, 9.25, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(33, 6, 21, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 2, 9.00, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(34, 6, 21, 25, 'Miss Vickie\'s Favourites Chips', 'pics/Miss Vickie\'s Favourites.jpeg', 6.50, 1, 6.50, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(35, 4, 22, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 2, 9.00, '2023-04-05 05:42:49', '2023-04-05 05:42:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
