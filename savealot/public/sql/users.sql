-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2023 at 10:50 PM
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
(5, 'ron', 'ron@hogwarts.edu', NULL, '$2y$10$3AGZQj.B2FmxVJeHGI0Lfe3Cdaaexqq58gW5lqz5nnj6Yq56jD2mW', 0, NULL, '2023-03-29 06:49:09', '2023-03-29 06:49:09'),
(6, 'harry', 'harry@hogwarts.edu', NULL, '$2y$10$1fObGpSNGeUcxxZcP4L8..PkdcKH38A3ctmSfExixmJ6cYoh1PBbG', 1, NULL, '2023-03-29 06:50:00', '2023-03-29 06:50:00'),
(7, 'new', 'new@edu.edu', NULL, '$2y$10$lANlZM.uXs2XRxvImYIiO.pzyMI9aECCwnxntaDQSkzxDaQT4JX1u', 0, NULL, '2023-03-29 06:50:52', '2023-03-29 06:50:52'),
(8, 'test', 'test@test', NULL, '$2y$10$v0KMRXKYnD2M/dxznoG2nu3pwNx4gmFS7VZgttiy7dsu1ceGjsqTO', 0, NULL, '2023-03-29 06:52:55', '2023-03-29 06:52:55'),
(9, 'lets go', 'letsgo@edu.edu', NULL, '$2y$10$/o1w7t5NvsIemdKdUDyEp.KFloe73RcH8fAeUNWIA9qV4Yy/CMP6O', 0, NULL, '2023-03-29 06:59:43', '2023-03-29 06:59:43'),
(10, 'go', 'go@h.edu', NULL, '$2y$10$h5cFCeJu8srkrMeiwPu6Yu9Zwl8dMvEFd7xY1rhcXcYHMiKeHs8Wm', 1, NULL, '2023-03-29 07:03:13', '2023-03-29 07:03:13'),
(11, 'non-student', 'non-student@non-student', NULL, '$2y$10$02pLxuYur0ilbW4DitgAF.tgA.C5tC1vhK/ZrY9TzASPoYkUcUaXe', 0, NULL, '2023-03-29 07:05:48', '2023-03-29 07:05:48'),
(12, 'Student Email', 'student@student.edu', NULL, '$2y$10$vI5k59nrykDfjIGEsHy3X.S5HZkAxAV/igXgmaCdVZAkoAFKoVawa', 1, NULL, '2023-03-29 11:09:41', '2023-03-29 11:09:41');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
