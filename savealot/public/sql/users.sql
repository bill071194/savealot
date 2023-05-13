-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2023 at 05:09 PM
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
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `student` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `admin`, `student`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alice', 'alice@gmail.com', NULL, '$2y$10$ivXLgzRdjDhxv6Fv27q6BudydP0vUB7dvMYnTrr8R0IXfpU9c1jc6', 0, 0, NULL, '2023-03-20 15:16:19', '2023-03-20 15:16:19'),
(2, 'Bob', 'bob@hotmail.com', NULL, '$2y$10$h9TfKrn/YvhBC7q5CQVBo./Cvm5BXQJDwN4AB8cZax6D.BKST.mIe', 0, 0, NULL, '2023-03-22 03:38:31', '2023-03-22 03:38:31'),
(4, 'saladmin', 'saladmin@localhost', NULL, '$2y$10$5oUHxQpPAHUHroJLjb1suuXQafiwdqSLmUorHmC3qOZ181UhISzji', 1, 0, NULL, '2023-03-22 12:18:09', '2023-03-22 12:18:09'),
(5, 'ron', 'ron@hogwarts.edu', NULL, '$2y$10$3AGZQj.B2FmxVJeHGI0Lfe3Cdaaexqq58gW5lqz5nnj6Yq56jD2mW', 0, 1, NULL, '2023-03-29 06:49:09', '2023-03-29 06:49:09'),
(6, 'harry', 'harry@hogwarts.edu', NULL, '$2y$10$1fObGpSNGeUcxxZcP4L8..PkdcKH38A3ctmSfExixmJ6cYoh1PBbG', 0, 1, NULL, '2023-03-29 06:50:00', '2023-03-29 06:50:00'),
(7, 'new', 'new@edu.edu', NULL, '$2y$10$lANlZM.uXs2XRxvImYIiO.pzyMI9aECCwnxntaDQSkzxDaQT4JX1u', 0, 1, NULL, '2023-03-29 06:50:52', '2023-03-29 06:50:52'),
(8, 'test', 'test@test', NULL, '$2y$10$v0KMRXKYnD2M/dxznoG2nu3pwNx4gmFS7VZgttiy7dsu1ceGjsqTO', 0, 0, NULL, '2023-03-29 06:52:55', '2023-03-29 06:52:55'),
(9, 'lets go', 'letsgo@edu.edu', NULL, '$2y$10$/o1w7t5NvsIemdKdUDyEp.KFloe73RcH8fAeUNWIA9qV4Yy/CMP6O', 0, 1, NULL, '2023-03-29 06:59:43', '2023-03-29 06:59:43'),
(10, 'go', 'go@h.edu', NULL, '$2y$10$h5cFCeJu8srkrMeiwPu6Yu9Zwl8dMvEFd7xY1rhcXcYHMiKeHs8Wm', 0, 1, NULL, '2023-03-29 07:03:13', '2023-03-29 07:03:13'),
(11, 'non-student', 'non-student@non-student', NULL, '$2y$10$02pLxuYur0ilbW4DitgAF.tgA.C5tC1vhK/ZrY9TzASPoYkUcUaXe', 0, 0, NULL, '2023-03-29 07:05:48', '2023-03-29 07:05:48'),
(12, 'Student Email', 'student@student.edu', NULL, '$2y$10$vI5k59nrykDfjIGEsHy3X.S5HZkAxAV/igXgmaCdVZAkoAFKoVawa', 0, 1, NULL, '2023-03-29 11:09:41', '2023-03-29 11:09:41'),
(13, 'Chris', 'chris@gmail.com', NULL, '$2y$10$eOKv0eACxazikJUujkcEiukCGhxbGSflSdL3ZohHdK17.MOFZyje2', 0, 0, NULL, '2023-04-08 04:57:37', '2023-04-08 04:57:37'),
(14, 'David Student', 'david@school.edu', NULL, '$2y$10$96jhDmFFSBOCU/Y9cFNz2.XMqGsFJ8gE6HYdKfxho9vvp//Mn1.3C', 0, 1, NULL, '2023-04-08 08:39:35', '2023-04-08 08:39:35'),
(15, 'Emily Carr', 'emilycarr@victoria', NULL, '$2y$10$RnR1YA17ZEcIfUh8bWFtSe/I.jfuDDGWhXb.XS7zkWY6oyKBuXBay', 0, 0, NULL, '2023-04-08 09:45:25', '2023-04-08 09:45:25'),
(16, 'Jacob', 'jacob@student.edu', NULL, '$2y$10$NQtb.NSjSVLEc2EcbRDV.e4wRnpiAo71SHJS90ttOr3s9dKY3MlJq', 0, 1, NULL, '2023-04-08 10:08:07', '2023-04-08 10:08:07'),
(17, 'Fire', 'fire@hotmail.com', NULL, '$2y$10$HadB0lsOLxTAeEJUQGaI3.wXCAZm6K/hRlh38zs1VkEapgBDVxdU2', 0, 0, NULL, '2023-04-08 10:25:30', '2023-04-08 10:25:30'),
(18, 'deleted', 'deleted@localhost', NULL, 'deleted123!', 0, 0, NULL, '2023-04-08 23:21:07', '2023-04-08 23:21:26'),
(19, 'deleted', 'deleted19@localhost', NULL, 'deleted123!', 0, 1, NULL, '2023-04-08 23:25:34', '2023-04-08 23:25:44'),
(20, 'deleted', 'deleted20@localhost', NULL, 'deleted123!', 0, 1, NULL, '2023-04-08 23:26:42', '2023-04-08 23:26:59'),
(21, 'deleted', 'deleted21@localhost', NULL, 'deleted123!', 0, 0, NULL, '2023-04-08 23:29:43', '2023-04-08 23:29:50'),
(22, 'deleted', 'deleted22@localhost', NULL, 'deleted123!', 0, 1, NULL, '2023-04-08 23:30:07', '2023-04-08 23:30:11'),
(28, 'deleted', 'deleted27@localhost', NULL, '$2y$10$Kjy8juG6jOO7WdOHfIOP5.QYHyhq8mYJZyYEVnNECMElNCKLOUbJ6', 0, 1, NULL, '2023-04-09 00:02:08', '2023-04-09 00:55:05'),
(37, 'deleted', 'deleted34@localhost', NULL, '$2y$10$.azrajfIDPZmNoAgJNFbHuKTN0STuVQ1gleTGgZcbWVl47J9ZTn5m', 0, 1, NULL, '2023-04-09 00:09:04', '2023-04-09 00:59:55'),
(38, 'Hermione Granger', 'hermione@hogwarts.edu', NULL, '$2y$10$2kOjrdN72vTxP/N51QqST.vYM7xo9TKMbCqIqFysyF7Yvu91/AP0S', 0, 1, NULL, '2023-04-09 03:49:16', '2023-04-09 03:49:16'),
(39, 'Admin', 'admin@admin', NULL, '$2y$10$XVdOw3WLSgsmZQQjE.WXf.sdpBc.7tKa84AqmRfUeBHnD/8Um2sOe', 1, 0, NULL, '2023-05-13 17:01:14', '2023-05-13 17:01:14');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
