-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2023 at 11:13 PM
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
  `prod_exp_date` varchar(255) DEFAULT NULL,
  `prod_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `prod_name`, `prod_description`, `prod_purchase_price`, `prod_selling_price`, `prod_units`, `prod_size`, `prod_quantity`, `prod_exp_date`, `prod_picture`, `created_at`, `updated_at`) VALUES
(1, 'Project ERD', 'This is the project ERD.', NULL, NULL, NULL, NULL, NULL, NULL, 'pics/Save-a-lot ERD.png', NULL, NULL),
(2, 'Yakisoba Chow Mein', 'These noodles don\'t taste like either Yakisoba or Chow Mein, but they\'re still pretty good. Especially at this price!', 4.00, 6.00, '5x102g', 510, 10, '2024-01-01', 'pics/Yakisoba_Noodles.jpg', NULL, NULL),
(3, 'Unsalted Cashews', 'These cashews are cheaper than they are at other stores.', 10.00, 13.00, NULL, 800, 10, '2024-01-01', 'pics/Unsalted_Cashews.webp', '2023-03-21 12:38:50', NULL),
(4, 'Salted Cashews', 'These cashews are saltier than other cashews.', 10.00, 13.00, NULL, 800, 10, '2024-03-31', 'pics/Salted_Cashews.webp', NULL, NULL),
(7, 'Que Pasa Yellow Tortilla Chips', 'These whole grain corn tortilla chips are yellow and only a little bit salty.', 3.00, 4.50, NULL, 350, 15, '2023-06-30', 'pics/Que_Pasa_Yellow.jpg', '2023-03-21 08:27:27', '2023-03-21 08:34:36'),
(8, 'Que Pasa Blue Tortilla Chips', 'These whole grain corn tortilla chips are blue and a little bit salty.', 3.00, 4.50, NULL, 350, 15, '2023-06-30', 'pics/Que_Pasa_Blue.jpg', '2023-03-21 08:32:18', '2023-03-21 08:37:01'),
(9, 'Que Pasa Red Tortilla Chips', 'These whole grain corn chips are red and a little bit salty.', 3.00, 4.50, NULL, 350, 15, '2023-06-30', 'pics/Que_Pasa_Red.jpg', '2023-03-21 08:36:30', NULL),
(19, 'max number', NULL, NULL, 999999.99, 'Very big', NULL, 100, NULL, NULL, '2023-03-28 15:27:42', '2023-03-28 15:36:30'),
(20, 'new', NULL, NULL, 5.00, NULL, NULL, 5, NULL, NULL, '2023-03-29 03:35:03', '2023-03-29 03:35:03'),
(21, 'Kellogg\'s Fun Pac Cereal', '8 small packages of cereal, including Rice Krispies, Corn Pops!, Froot Loops, and Frosted Flakes. Theeyyy\'re great!', 4.00, 6.00, '8x210g', 1680, 10, NULL, 'pics/Kellogg\'s Fun Pac Cereal.jpeg', '2023-03-29 03:45:03', '2023-03-29 03:45:43'),
(22, 'Pop Tarts Jumbo Pack', '24-pack of Pop Tarts with three flavours: Strawberry, Blueberry, Raspberry', 7.00, 8.50, '24x48g', 1150, 10, NULL, 'pics/Pop Tarts Jumbo Pack.jpeg', '2023-03-29 03:50:16', '2023-03-29 03:50:16'),
(23, 'Lay\'s Chips Variety Pack', '18 packages of Lay\'s chips: 6 Original, 4 Bar-B-Q, 4 Ketchup, 4 Salt & Vinegar. Warning, most of these flavours are polarizing.', 8.00, 9.25, '18x28g', 504, 10, NULL, 'pics/Lays Mix Variety Pack.jpeg', '2023-03-29 03:57:12', '2023-03-29 03:57:27'),
(24, 'Hardbite Ghost Pepper Chips', 'These Hardbite Sweet Ghost Pepper Potato Chips are pretty spicy. Eat them at your own risk.', 3.50, 4.50, NULL, 128, 10, NULL, 'pics/Hardbite Ghost Pepper Chips.jpeg', '2023-03-29 04:02:41', '2023-03-29 04:02:41'),
(25, 'Miss Vickie\'s Favourites Chips', '10 packs of Miss Vickie\'s potato chips: 4 Original Recipe, 3 Sweet Chili & Sour Cream, 3 Sea Salt & Malt Vinegar', 5.00, 6.50, '10x24g', 240, 5, NULL, 'pics/Miss Vickie\'s Favourites.jpeg', '2023-03-29 04:26:14', '2023-03-29 04:26:14'),
(27, 'newnew', NULL, NULL, 5.00, NULL, NULL, 5, NULL, NULL, '2023-03-29 05:25:49', '2023-03-29 05:25:49');

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
  `prod_price` decimal(9,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_total` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alice', 'alice@gmail.com', NULL, '$2y$10$ivXLgzRdjDhxv6Fv27q6BudydP0vUB7dvMYnTrr8R0IXfpU9c1jc6', NULL, '2023-03-20 15:16:19', '2023-03-20 15:16:19'),
(2, 'Bob', 'bob@hotmail.com', NULL, '$2y$10$h9TfKrn/YvhBC7q5CQVBo./Cvm5BXQJDwN4AB8cZax6D.BKST.mIe', NULL, '2023-03-22 03:38:31', '2023-03-22 03:38:31'),
(4, 'saladmin', 'saladmin@localhost', NULL, '$2y$10$5oUHxQpPAHUHroJLjb1suuXQafiwdqSLmUorHmC3qOZ181UhISzji', NULL, '2023-03-22 12:18:09', '2023-03-22 12:18:09');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
