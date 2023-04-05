-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2023 at 11:05 PM
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
(2, 'Yakisoba Chow Mein', 'These noodles don\'t taste like either Yakisoba or Chow Mein, but they\'re still pretty good. Especially at this price!', 4.00, 6.00, '5x102g', 510, 12, '2024-01-01', 'pics/Yakisoba_Noodles.jpg', NULL, '2023-04-03 06:45:18'),
(3, 'Unsalted Cashews', 'These cashews are cheaper than they are at other stores.', 10.00, 13.00, NULL, 800, 9, '2024-01-01', 'pics/Unsalted_Cashews.webp', '2023-03-21 12:38:50', '2023-04-03 06:39:38'),
(4, 'Salted Cashews', 'These cashews are saltier than other cashews.', 10.00, 13.00, NULL, 800, 9, '2024-03-31', 'pics/Salted_Cashews.webp', NULL, '2023-04-03 06:39:38'),
(7, 'Que Pasa Yellow Tortilla Chips', 'These whole grain corn tortilla chips are yellow and only a little bit salty.', 3.00, 4.50, NULL, 350, 13, '2023-06-30', 'pics/Que_Pasa_Yellow.jpg', '2023-03-21 08:27:27', '2023-04-03 06:45:18'),
(8, 'Que Pasa Blue Tortilla Chips', 'These whole grain corn tortilla chips are blue and a little bit salty.', 3.00, 4.50, NULL, 350, 13, '2023-06-30', 'pics/Que_Pasa_Blue.jpg', '2023-03-21 08:32:18', '2023-04-03 06:45:18'),
(9, 'Que Pasa Red Tortilla Chips', 'These whole grain corn chips are red and a little bit salty.', 3.00, 4.50, NULL, 350, 13, '2023-06-30', 'pics/Que_Pasa_Red.jpg', '2023-03-21 08:36:30', '2023-04-03 06:45:18'),
(19, 'max number', NULL, NULL, 999999.99, 'Very big', NULL, 100, NULL, NULL, '2023-03-28 15:27:42', '2023-03-28 15:36:30'),
(20, 'new', NULL, NULL, 5.00, NULL, NULL, 4, NULL, NULL, '2023-03-29 03:35:03', '2023-03-29 11:34:02'),
(21, 'Kellogg\'s Fun Pac Cereal', '8 small packages of cereal, including Rice Krispies, Corn Pops!, Froot Loops, and Frosted Flakes. Theeyyy\'re great!', 4.00, 6.00, '8x210g', 1680, 6, NULL, 'pics/Kellogg\'s Fun Pac Cereal.jpeg', '2023-03-29 03:45:03', '2023-04-03 06:57:26'),
(22, 'Pop Tarts Jumbo Pack', '24-pack of Pop Tarts with three flavours: Strawberry, Blueberry, Raspberry', 7.00, 8.50, '24x48g', 1150, 6, NULL, 'pics/Pop Tarts Jumbo Pack.jpeg', '2023-03-29 03:50:16', '2023-04-03 06:57:26'),
(23, 'Lay\'s Chips Variety Pack', '18 packages of Lay\'s chips: 6 Original, 4 Bar-B-Q, 4 Ketchup, 4 Salt & Vinegar. Warning, most of these flavours are polarizing.', 8.00, 9.25, '18x28g', 504, 8, NULL, 'pics/Lays Mix Variety Pack.jpeg', '2023-03-29 03:57:12', '2023-04-03 06:57:26'),
(24, 'Hardbite Ghost Pepper Chips', 'These Hardbite Sweet Ghost Pepper Potato Chips are pretty spicy. Eat them at your own risk.', 3.50, 4.50, NULL, 128, 4, NULL, 'pics/Hardbite Ghost Pepper Chips.jpeg', '2023-03-29 04:02:41', '2023-04-03 06:57:26'),
(25, 'Miss Vickie\'s Favourites Chips', '10 packs of Miss Vickie\'s potato chips: 4 Original Recipe, 3 Sweet Chili & Sour Cream, 3 Sea Salt & Malt Vinegar', 5.00, 6.50, '10x24g', 240, 3, NULL, 'pics/Miss Vickie\'s Favourites.jpeg', '2023-03-29 04:26:14', '2023-04-03 06:57:26'),
(27, 'newnew', NULL, NULL, 5.00, NULL, NULL, 5, NULL, NULL, '2023-03-29 05:25:49', '2023-03-29 05:25:49'),
(28, 't', NULL, 9999999.00, NULL, NULL, NULL, 0, NULL, 'pics/', '2023-04-03 04:16:09', '2023-04-03 04:16:09'),
(29, '200000', NULL, 200000.00, NULL, NULL, NULL, 0, NULL, 'pics/', '2023-04-03 04:22:40', '2023-04-03 04:22:40'),
(31, '6', 'new', 5.00, 5.00, '5x5g', 25, 5, '2023-04-13', 'pics/5', '2023-04-03 05:00:46', '2023-04-03 05:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_prod_name_unique` (`prod_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
