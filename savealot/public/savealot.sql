-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2023 at 04:25 AM
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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_description` varchar(255) DEFAULT NULL,
  `prod_purchase_price` decimal(9,2) DEFAULT NULL,
  `prod_selling_price` decimal(9,2) DEFAULT NULL,
  `prod_units` varchar(255) DEFAULT NULL,
  `prod_size` int(11) DEFAULT NULL,
  `prod_quantity` int(11) DEFAULT NULL,
  `prod_picture` varchar(255) DEFAULT NULL,
  `prod_color` text DEFAULT '#198754',
  `prod_sold` int(11) NOT NULL DEFAULT 0,
  `prod_revenue` decimal(12,2) NOT NULL DEFAULT 0.00,
  `competitor_saveonfoods` decimal(8,2) DEFAULT NULL,
  `competitor_tnt` decimal(8,2) DEFAULT NULL,
  `competitor_walmart` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `prod_name`, `prod_description`, `prod_purchase_price`, `prod_selling_price`, `prod_units`, `prod_size`, `prod_quantity`, `prod_picture`, `prod_color`, `prod_sold`, `prod_revenue`, `competitor_saveonfoods`, `competitor_tnt`, `competitor_walmart`, `created_at`, `updated_at`) VALUES
(2, 'Yakisoba Chow Mein', 'These noodles don\'t taste like either Yakisoba or Chow Mein, but they\'re still pretty good. Especially at this price!', 4.00, 6.00, '5x102g', 510, 21, 'pics/Yakisoba_Noodles.jpg', '#ffc200', 18, 108.00, 7.39, NULL, NULL, NULL, '2023-04-09 04:10:17'),
(3, 'Unsalted Cashews', 'These cashews are cheaper than they are at other stores.', 10.00, 13.00, NULL, 800, 19, 'pics/Unsalted_Cashews.webp', '#ef5c02', 1, 13.00, 19.99, 17.99, NULL, '2023-03-21 12:38:50', '2023-04-09 04:10:25'),
(4, 'Salted Cashews', 'These cashews are saltier than other cashews.', 10.00, 13.00, NULL, 800, 17, 'pics/Salted_Cashews.webp', '#4abbe7', 1, 13.00, 19.99, 17.99, NULL, NULL, '2023-04-09 04:10:27'),
(7, 'Que Pasa Yellow Tortilla Chips', 'These whole grain corn tortilla chips are yellow and only a little bit salty.', 3.00, 4.50, NULL, 350, 23, 'pics/Que_Pasa_Yellow.jpg', '#ffb95b', 13, 58.50, 5.69, NULL, 4.97, '2023-03-21 08:27:27', '2023-04-09 04:10:04'),
(8, 'Que Pasa Blue Tortilla Chips', 'These whole grain corn tortilla chips are blue and a little bit salty.', 3.00, 4.50, NULL, 350, 22, 'pics/Que_Pasa_Blue.jpg', '#698abd', 13, 58.50, 5.69, NULL, 4.97, '2023-03-21 08:32:18', '2023-04-09 04:10:02'),
(9, 'Que Pasa Red Tortilla Chips', 'These whole grain corn chips are red and a little bit salty.', 3.00, 4.50, NULL, 350, 22, 'pics/Que_Pasa_Red.jpg', '#f4685a', 13, 58.50, 5.69, NULL, 4.97, '2023-03-21 08:36:30', '2023-04-09 04:10:00'),
(21, 'Kellogg\'s Fun Pac Cereal', '8 small packages of cereal, including Rice Krispies, Corn Pops!, Froot Loops, and Frosted Flakes. Theeyyy\'re great!', 4.00, 6.00, '8x210g', 1680, 10, 'pics/Kellogg\'s Fun Pac Cereal.jpeg', '#00bcfa', 4, 24.00, 6.29, NULL, 4.97, '2023-03-29 03:45:03', '2023-04-09 03:48:02'),
(22, 'Pop Tarts Jumbo Pack', '24-pack of Pop Tarts with three flavours: Strawberry, Blueberry, Raspberry', 7.00, 8.50, '24x48g', 1150, 15, 'pics/Pop Tarts Jumbo Pack.jpeg', '#00afef', 5, 42.50, 11.49, NULL, NULL, '2023-03-29 03:50:16', '2023-04-09 04:10:08'),
(23, 'Lay\'s Chips Variety Pack', '18 packages of Lay\'s chips: 6 Original, 4 Bar-B-Q, 4 Ketchup, 4 Salt & Vinegar. Warning, most of these flavours are polarizing.', 8.00, 9.25, '18x28g', 504, 16, 'pics/Lays Mix Variety Pack.jpeg', '#e69f0d', 4, 37.00, 14.49, NULL, 9.27, '2023-03-29 03:57:12', '2023-04-09 04:10:09'),
(24, 'Hardbite Ghost Pepper Chips', 'These Hardbite Sweet Ghost Pepper Potato Chips are pretty spicy. Eat them at your own risk.', 3.50, 4.50, NULL, 128, 21, 'pics/Hardbite Ghost Pepper Chips.jpeg', '#a72c3b', 14, 63.00, 4.99, NULL, 4.47, '2023-03-29 04:02:41', '2023-04-09 04:10:20'),
(25, 'Miss Vickie\'s Favourites Chips', '10 packs of Miss Vickie\'s potato chips: 4 Original Recipe, 3 Sweet Chili & Sour Cream, 3 Sea Salt & Malt Vinegar', 5.00, 6.50, '10x24g', 240, 16, 'pics/Miss Vickie\'s Favourites.jpeg', '#efe2ba', 9, 58.50, 9.29, NULL, 6.97, '2023-03-29 04:26:14', '2023-04-09 04:09:58'),
(34, 'Monster Energy - Mango Loco', 'This 4 pack of Monster Energy - Mango Loco packs a punch! It combines the taste of a regular energy drink with a lot of real fruit juices and ends up being delicious.', 8.00, 9.50, '4x473ml', NULL, 17, 'pics/Monster_Punch_Mango.jpeg', '#269fcc', 13, 123.50, 13.49, NULL, 9.97, '2023-04-08 10:07:14', '2023-04-09 04:10:15'),
(36, 'Monster Energy - Zero Ultra', 'Despite having almost no calories, this 4-pack of Monster Energy Zero Ultra will boost your energy, all with a smooth taste', 8.00, 9.50, '4x473ml', NULL, 13, 'storage/pics/Monster_Zero_Ultra.jpeg', '#f0f0f0', 7, 66.50, 13.49, NULL, 9.97, '2023-04-09 03:04:18', '2023-04-09 04:10:18'),
(46, 'Monster Energy', 'The original Monster Energy flavour in a pack of 4.', 8.00, 9.50, '4x473ml', NULL, 14, 'storage/pics/Monster_Energy.jpeg', '#86ca00', 6, 57.00, 13.49, NULL, 9.97, '2023-04-09 03:44:02', '2023-04-09 04:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_03_20_083342_create_transactions_table', 2),
(8, '2023_03_20_083350_create_orders_table', 3),
(9, '2023_03_20_083358_create_inventory_table', 4);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `total`, `discount`, `student`, `created_at`, `updated_at`) VALUES
(8, 12, 21.00, 18.90, 2.10, 1, '2023-03-29 11:29:36', '2023-03-29 11:29:36'),
(9, 12, 5.00, 4.50, 0.50, 1, '2023-03-29 11:34:02', '2023-03-29 11:34:02'),
(10, 6, 8.50, 7.65, 0.85, 1, '2023-04-03 05:34:10', '2023-04-03 05:34:10'),
(11, 6, 10.50, 9.45, 1.05, 1, '2023-04-03 05:34:26', '2023-04-03 05:34:26'),
(12, 6, 12.00, 10.80, 1.20, 1, '2023-04-03 06:14:13', '2023-04-03 06:14:13'),
(13, 6, 12.00, 10.80, 1.20, 1, '2023-04-03 06:21:25', '2023-04-03 06:21:25'),
(14, 6, 13.50, 12.15, 1.35, 1, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(15, 6, 28.25, 25.42, 2.83, 1, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(16, 6, 11.00, 9.90, 1.10, 1, '2023-04-03 06:36:15', '2023-04-03 06:36:15'),
(17, 4, 44.00, 44.00, 0.00, 0, '2023-04-03 06:39:38', '2023-04-03 06:39:38'),
(18, 4, 14.50, 14.50, 0.00, 0, '2023-04-03 06:40:56', '2023-04-03 06:40:56'),
(19, 4, 4.50, 4.50, 0.00, 0, '2023-04-03 06:43:57', '2023-04-03 06:43:57'),
(20, 6, 19.50, 17.55, 1.95, 1, '2023-04-03 06:45:18', '2023-04-03 06:45:18'),
(21, 6, 39.25, 35.32, 3.93, 1, '2023-04-03 06:57:26', '2023-04-03 06:57:26'),
(22, 4, 9.00, 9.00, 0.00, 0, '2023-04-05 05:42:49', '2023-04-05 05:42:49'),
(24, 4, 12.00, 12.00, 0.00, 0, '2023-04-05 02:23:29', '2023-04-05 02:23:29'),
(25, 4, 13.50, 13.50, 0.00, 0, '2023-04-05 02:27:26', '2023-04-05 02:27:26'),
(26, 4, 6.00, 6.00, 0.00, 0, '2023-04-06 23:33:48', '2023-04-06 23:33:48'),
(27, 4, 34.50, 0.00, 0.00, 0, '2023-04-08 04:54:19', '2023-04-08 08:39:11'),
(36, 14, 52.50, 47.25, 5.25, 1, '2023-04-08 08:40:14', '2023-04-08 09:54:52'),
(38, 4, 6.00, 6.00, 0.00, 0, '2023-04-08 08:44:55', '2023-04-08 08:44:55'),
(39, 15, 70.50, 70.50, 0.00, 0, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(40, 16, 95.00, 85.50, 9.50, 1, '2023-04-08 10:08:44', '2023-04-08 10:09:17'),
(41, 17, 29.00, 29.00, 0.00, 0, '2023-04-08 10:25:52', '2023-04-08 10:25:52'),
(42, 17, 18.25, 18.25, 0.00, 0, '2023-04-08 10:27:04', '2023-04-08 10:27:04'),
(43, 4, 9.00, 9.00, 0.00, 0, '2023-04-08 19:50:53', '2023-04-08 19:50:53'),
(44, 17, 9.00, 9.00, 0.00, 0, '2023-04-08 23:06:53', '2023-04-08 23:06:53'),
(45, 18, 9.50, 9.50, 0.00, 0, '2023-04-08 23:21:13', '2023-04-08 23:21:13'),
(46, 19, 6.00, 5.40, 0.60, 1, '2023-04-08 23:25:39', '2023-04-08 23:25:39'),
(47, 20, 13.50, 12.15, 1.35, 1, '2023-04-08 23:26:54', '2023-04-08 23:26:54'),
(48, 38, 23.50, 21.15, 2.35, 1, '2023-04-09 03:49:44', '2023-04-09 03:49:44'),
(49, 38, 47.00, 42.30, 4.70, 1, '2023-04-02 07:00:00', '2023-04-09 04:01:22'),
(50, 38, 9.50, 8.55, 0.95, 1, '2023-03-30 07:00:00', '2023-04-09 04:01:55'),
(51, 38, 19.00, 17.10, 1.90, 1, '2023-03-29 07:00:00', '2023-04-09 04:02:10'),
(52, 38, 9.50, 8.55, 0.95, 1, '2023-03-28 07:00:00', '2023-04-09 04:02:27'),
(53, 38, 18.75, 16.87, 1.88, 1, '2023-03-27 07:00:00', '2023-04-09 04:02:41'),
(54, 38, 14.00, 12.60, 1.40, 1, '2023-04-06 07:00:00', '2023-04-09 04:03:25'),
(55, 38, 15.50, 13.95, 1.55, 1, '2023-04-05 07:00:00', '2023-04-09 04:03:39'),
(56, 38, 14.00, 12.60, 1.40, 1, '2023-04-07 07:00:00', '2023-04-09 04:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(6, 6, 10, 22, 'Pop Tarts Jumbo Pack', 'pics/Pop Tarts Jumbo Pack.jpeg', 8.50, 1, 8.50, '2023-04-03 05:34:10', '2023-04-03 05:34:10'),
(7, 6, 11, 21, 'Kellogg\'s Fun Pac Cereal', 'pics/Kellogg\'s Fun Pac Cereal.jpeg', 6.00, 1, 6.00, '2023-04-03 05:34:26', '2023-04-03 05:34:26'),
(8, 6, 11, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-03 05:34:26', '2023-04-03 05:34:26'),
(9, 6, 12, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 2, 12.00, '2023-04-03 06:14:13', '2023-04-03 06:14:13'),
(10, 6, 13, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 2, 12.00, '2023-04-03 06:21:25', '2023-04-03 06:21:25'),
(11, 6, 14, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(12, 6, 14, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(13, 6, 14, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-03 06:35:19', '2023-04-03 06:35:19'),
(14, 6, 15, 21, 'Kellogg\'s Fun Pac Cereal', 'pics/Kellogg\'s Fun Pac Cereal.jpeg', 6.00, 1, 6.00, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(15, 6, 15, 22, 'Pop Tarts Jumbo Pack', 'pics/Pop Tarts Jumbo Pack.jpeg', 8.50, 1, 8.50, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(16, 6, 15, 23, 'Lay\'s Chips Variety Pack', 'pics/Lays Mix Variety Pack.jpeg', 9.25, 1, 9.25, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(17, 6, 15, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-03 06:35:58', '2023-04-03 06:35:58'),
(18, 6, 16, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-03 06:36:15', '2023-04-03 06:36:15'),
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
(35, 4, 22, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 2, 9.00, '2023-04-05 05:42:49', '2023-04-05 05:42:49'),
(38, 4, 24, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 2, 12.00, '2023-04-05 02:23:29', '2023-04-05 09:23:29'),
(39, 4, 25, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-05 02:27:26', '2023-04-05 02:27:26'),
(40, 4, 25, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-05 02:27:26', '2023-04-05 02:27:26'),
(41, 4, 25, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-05 02:27:26', '2023-04-05 02:27:26'),
(42, 4, 26, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-06 23:33:48', '2023-04-06 23:33:48'),
(43, 4, 27, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 2, 12.00, '2023-04-08 04:54:19', '2023-04-08 08:39:11'),
(44, 4, 27, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 2, 9.00, '2023-04-08 04:54:19', '2023-04-08 04:54:19'),
(45, 4, 27, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-08 04:54:19', '2023-04-08 04:54:19'),
(46, 4, 27, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-08 04:54:19', '2023-04-08 04:54:19'),
(47, 4, 27, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-08 04:54:19', '2023-04-08 04:54:19'),
(57, 14, 36, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-08 08:40:14', '2023-04-08 08:40:14'),
(58, 14, 36, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-08 08:40:14', '2023-04-08 08:40:14'),
(59, 14, 36, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-08 08:40:14', '2023-04-08 08:40:14'),
(60, 14, 36, 25, 'Miss Vickie\'s Favourites Chips', 'pics/Miss Vickie\'s Favourites.jpeg', 6.50, 6, 39.00, '2023-04-08 08:40:14', '2023-04-08 09:54:52'),
(62, 4, 38, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-08 08:44:55', '2023-04-08 08:44:55'),
(63, 15, 39, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(64, 15, 39, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 3, 13.50, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(65, 15, 39, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 4, 18.00, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(66, 15, 39, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 4, 18.00, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(67, 15, 39, 22, 'Pop Tarts Jumbo Pack', 'pics/Pop Tarts Jumbo Pack.jpeg', 8.50, 1, 8.50, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(68, 15, 39, 25, 'Miss Vickie\'s Favourites Chips', 'pics/Miss Vickie\'s Favourites.jpeg', 6.50, 1, 6.50, '2023-04-08 09:46:14', '2023-04-08 09:46:14'),
(69, 16, 40, 34, 'Monster Energy - Mango Loco', 'pics/Monster_Punch_Mango.jpeg', 9.50, 10, 95.00, '2023-04-08 10:08:44', '2023-04-08 10:09:17'),
(70, 17, 41, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-08 10:25:52', '2023-04-08 10:25:52'),
(71, 17, 41, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-08 10:25:52', '2023-04-08 10:25:52'),
(72, 17, 41, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 2, 9.00, '2023-04-08 10:25:52', '2023-04-08 10:25:52'),
(73, 17, 41, 34, 'Monster Energy - Mango Loco', 'pics/Monster_Punch_Mango.jpeg', 9.50, 1, 9.50, '2023-04-08 10:25:52', '2023-04-08 10:25:52'),
(74, 17, 42, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-08 10:27:04', '2023-04-08 10:27:04'),
(75, 17, 42, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-08 10:27:04', '2023-04-08 10:27:04'),
(76, 17, 42, 23, 'Lay\'s Chips Variety Pack', 'pics/Lays Mix Variety Pack.jpeg', 9.25, 1, 9.25, '2023-04-08 10:27:04', '2023-04-08 10:27:04'),
(77, 4, 43, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 2, 9.00, '2023-04-08 19:50:53', '2023-04-08 19:50:53'),
(78, 17, 44, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 2, 9.00, '2023-04-08 23:06:53', '2023-04-08 23:06:53'),
(79, 18, 45, 34, 'Monster Energy - Mango Loco', 'pics/Monster_Punch_Mango.jpeg', 9.50, 1, 9.50, '2023-04-08 23:21:13', '2023-04-08 23:21:13'),
(80, 19, 46, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-08 23:25:40', '2023-04-08 23:25:40'),
(81, 20, 47, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-08 23:26:54', '2023-04-08 23:26:54'),
(82, 20, 47, 8, 'Que Pasa Blue Tortilla Chips', 'pics/Que_Pasa_Blue.jpg', 4.50, 1, 4.50, '2023-04-08 23:26:54', '2023-04-08 23:26:54'),
(83, 20, 47, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-08 23:26:54', '2023-04-08 23:26:54'),
(84, 38, 48, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-09 03:49:44', '2023-04-09 03:49:44'),
(85, 38, 48, 36, 'Monster Energy - Zero Ultra', 'storage/pics/Monster_Zero_Ultra.jpeg', 9.50, 2, 19.00, '2023-04-09 03:49:44', '2023-04-09 03:49:44'),
(86, 38, 49, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-02 07:00:00', '2023-04-09 04:01:23'),
(87, 38, 49, 9, 'Que Pasa Red Tortilla Chips', 'pics/Que_Pasa_Red.jpg', 4.50, 1, 4.50, '2023-04-02 07:00:00', '2023-04-09 04:01:23'),
(88, 38, 49, 34, 'Monster Energy - Mango Loco', 'pics/Monster_Punch_Mango.jpeg', 9.50, 1, 9.50, '2023-04-02 07:00:00', '2023-04-09 04:01:23'),
(89, 38, 49, 36, 'Monster Energy - Zero Ultra', 'storage/pics/Monster_Zero_Ultra.jpeg', 9.50, 1, 9.50, '2023-04-02 07:00:00', '2023-04-09 04:01:23'),
(90, 38, 49, 46, 'Monster Energy', 'storage/pics/Monster_Energy.jpeg', 9.50, 2, 19.00, '2023-04-02 07:00:00', '2023-04-09 04:01:23'),
(91, 38, 50, 46, 'Monster Energy', 'storage/pics/Monster_Energy.jpeg', 9.50, 1, 9.50, '2023-03-30 07:00:00', '2023-04-09 04:01:55'),
(92, 38, 51, 36, 'Monster Energy - Zero Ultra', 'storage/pics/Monster_Zero_Ultra.jpeg', 9.50, 1, 9.50, '2023-03-29 07:00:00', '2023-04-09 04:02:10'),
(93, 38, 51, 46, 'Monster Energy', 'storage/pics/Monster_Energy.jpeg', 9.50, 1, 9.50, '2023-03-29 07:00:00', '2023-04-09 04:02:10'),
(94, 38, 52, 36, 'Monster Energy - Zero Ultra', 'storage/pics/Monster_Zero_Ultra.jpeg', 9.50, 1, 9.50, '2023-03-28 07:00:00', '2023-04-09 04:02:27'),
(95, 38, 53, 23, 'Lay\'s Chips Variety Pack', 'pics/Lays Mix Variety Pack.jpeg', 9.25, 1, 9.25, '2023-03-27 07:00:00', '2023-04-09 04:02:41'),
(96, 38, 53, 46, 'Monster Energy', 'storage/pics/Monster_Energy.jpeg', 9.50, 1, 9.50, '2023-03-27 07:00:00', '2023-04-09 04:02:41'),
(97, 38, 54, 24, 'Hardbite Ghost Pepper Chips', 'pics/Hardbite Ghost Pepper Chips.jpeg', 4.50, 1, 4.50, '2023-04-06 07:00:00', '2023-04-09 04:03:25'),
(98, 38, 54, 46, 'Monster Energy', 'storage/pics/Monster_Energy.jpeg', 9.50, 1, 9.50, '2023-04-06 07:00:00', '2023-04-09 04:03:25'),
(99, 38, 55, 2, 'Yakisoba Chow Mein', 'pics/Yakisoba_Noodles.jpg', 6.00, 1, 6.00, '2023-04-05 07:00:00', '2023-04-09 04:03:39'),
(100, 38, 55, 36, 'Monster Energy - Zero Ultra', 'storage/pics/Monster_Zero_Ultra.jpeg', 9.50, 1, 9.50, '2023-04-05 07:00:00', '2023-04-09 04:03:39'),
(101, 38, 56, 7, 'Que Pasa Yellow Tortilla Chips', 'pics/Que_Pasa_Yellow.jpg', 4.50, 1, 4.50, '2023-04-07 07:00:00', '2023-04-09 04:03:58'),
(102, 38, 56, 36, 'Monster Energy - Zero Ultra', 'storage/pics/Monster_Zero_Ultra.jpeg', 9.50, 1, 9.50, '2023-04-07 07:00:00', '2023-04-09 04:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `student` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `student`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alice', 'alice@gmail.com', NULL, '$2y$10$ivXLgzRdjDhxv6Fv27q6BudydP0vUB7dvMYnTrr8R0IXfpU9c1jc6', 0, NULL, '2023-03-20 15:16:19', '2023-03-20 15:16:19'),
(2, 'Bob', 'bob@hotmail.com', NULL, '$2y$10$h9TfKrn/YvhBC7q5CQVBo./Cvm5BXQJDwN4AB8cZax6D.BKST.mIe', 0, NULL, '2023-03-22 03:38:31', '2023-03-22 03:38:31'),
(4, 'saladmin', 'saladmin@localhost', NULL, '$2y$10$5oUHxQpPAHUHroJLjb1suuXQafiwdqSLmUorHmC3qOZ181UhISzji', 0, NULL, '2023-03-22 12:18:09', '2023-03-22 12:18:09'),
(5, 'ron', 'ron@hogwarts.edu', NULL, '$2y$10$3AGZQj.B2FmxVJeHGI0Lfe3Cdaaexqq58gW5lqz5nnj6Yq56jD2mW', 1, NULL, '2023-03-29 06:49:09', '2023-03-29 06:49:09'),
(6, 'harry', 'harry@hogwarts.edu', NULL, '$2y$10$1fObGpSNGeUcxxZcP4L8..PkdcKH38A3ctmSfExixmJ6cYoh1PBbG', 1, NULL, '2023-03-29 06:50:00', '2023-03-29 06:50:00'),
(7, 'new', 'new@edu.edu', NULL, '$2y$10$lANlZM.uXs2XRxvImYIiO.pzyMI9aECCwnxntaDQSkzxDaQT4JX1u', 1, NULL, '2023-03-29 06:50:52', '2023-03-29 06:50:52'),
(8, 'test', 'test@test', NULL, '$2y$10$v0KMRXKYnD2M/dxznoG2nu3pwNx4gmFS7VZgttiy7dsu1ceGjsqTO', 0, NULL, '2023-03-29 06:52:55', '2023-03-29 06:52:55'),
(9, 'lets go', 'letsgo@edu.edu', NULL, '$2y$10$/o1w7t5NvsIemdKdUDyEp.KFloe73RcH8fAeUNWIA9qV4Yy/CMP6O', 1, NULL, '2023-03-29 06:59:43', '2023-03-29 06:59:43'),
(10, 'go', 'go@h.edu', NULL, '$2y$10$h5cFCeJu8srkrMeiwPu6Yu9Zwl8dMvEFd7xY1rhcXcYHMiKeHs8Wm', 1, NULL, '2023-03-29 07:03:13', '2023-03-29 07:03:13'),
(11, 'non-student', 'non-student@non-student', NULL, '$2y$10$02pLxuYur0ilbW4DitgAF.tgA.C5tC1vhK/ZrY9TzASPoYkUcUaXe', 0, NULL, '2023-03-29 07:05:48', '2023-03-29 07:05:48'),
(12, 'Student Email', 'student@student.edu', NULL, '$2y$10$vI5k59nrykDfjIGEsHy3X.S5HZkAxAV/igXgmaCdVZAkoAFKoVawa', 1, NULL, '2023-03-29 11:09:41', '2023-03-29 11:09:41'),
(13, 'Chris', 'chris@gmail.com', NULL, '$2y$10$eOKv0eACxazikJUujkcEiukCGhxbGSflSdL3ZohHdK17.MOFZyje2', 0, NULL, '2023-04-08 04:57:37', '2023-04-08 04:57:37'),
(14, 'David Student', 'david@school.edu', NULL, '$2y$10$96jhDmFFSBOCU/Y9cFNz2.XMqGsFJ8gE6HYdKfxho9vvp//Mn1.3C', 1, NULL, '2023-04-08 08:39:35', '2023-04-08 08:39:35'),
(15, 'Emily Carr', 'emilycarr@victoria', NULL, '$2y$10$RnR1YA17ZEcIfUh8bWFtSe/I.jfuDDGWhXb.XS7zkWY6oyKBuXBay', 0, NULL, '2023-04-08 09:45:25', '2023-04-08 09:45:25'),
(16, 'Jacob', 'jacob@student.edu', NULL, '$2y$10$NQtb.NSjSVLEc2EcbRDV.e4wRnpiAo71SHJS90ttOr3s9dKY3MlJq', 1, NULL, '2023-04-08 10:08:07', '2023-04-08 10:08:07'),
(17, 'Fire', 'fire@hotmail.com', NULL, '$2y$10$HadB0lsOLxTAeEJUQGaI3.wXCAZm6K/hRlh38zs1VkEapgBDVxdU2', 0, NULL, '2023-04-08 10:25:30', '2023-04-08 10:25:30'),
(18, 'deleted', 'deleted@localhost', NULL, 'deleted123!', 0, NULL, '2023-04-08 23:21:07', '2023-04-08 23:21:26'),
(19, 'deleted', 'deleted19@localhost', NULL, 'deleted123!', 1, NULL, '2023-04-08 23:25:34', '2023-04-08 23:25:44'),
(20, 'deleted', 'deleted20@localhost', NULL, 'deleted123!', 1, NULL, '2023-04-08 23:26:42', '2023-04-08 23:26:59'),
(21, 'deleted', 'deleted21@localhost', NULL, 'deleted123!', 0, NULL, '2023-04-08 23:29:43', '2023-04-08 23:29:50'),
(22, 'deleted', 'deleted22@localhost', NULL, 'deleted123!', 1, NULL, '2023-04-08 23:30:07', '2023-04-08 23:30:11'),
(28, 'deleted', 'deleted27@localhost', NULL, '$2y$10$Kjy8juG6jOO7WdOHfIOP5.QYHyhq8mYJZyYEVnNECMElNCKLOUbJ6', 1, NULL, '2023-04-09 00:02:08', '2023-04-09 00:55:05'),
(37, 'deleted', 'deleted34@localhost', NULL, '$2y$10$.azrajfIDPZmNoAgJNFbHuKTN0STuVQ1gleTGgZcbWVl47J9ZTn5m', 1, NULL, '2023-04-09 00:09:04', '2023-04-09 00:59:55'),
(38, 'Hermione Granger', 'hermione@hogwarts.edu', NULL, '$2y$10$2kOjrdN72vTxP/N51QqST.vYM7xo9TKMbCqIqFysyF7Yvu91/AP0S', 1, NULL, '2023-04-09 03:49:16', '2023-04-09 03:49:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_prod_name_unique` (`prod_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
