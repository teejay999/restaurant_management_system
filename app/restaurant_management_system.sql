-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 12:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_management_system`
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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `restaurant_outlet_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `image`, `restaurant_outlet_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Burgers', 'burger_new.jpg', '2', '1', NULL, '2023-05-26 08:43:18', '2023-05-26 08:43:18', NULL),
(2, 'Shakes', 'shake.jpg', '2', '1', NULL, '2023-05-26 08:43:34', '2023-05-26 08:43:34', NULL),
(3, 'Fries', 'fries.jpg', '2', '1', NULL, '2023-05-26 08:43:49', '2023-05-26 08:43:49', NULL),
(4, 'Desi', 'desi_food.jpg', '1', '1', NULL, '2023-05-26 08:44:06', '2023-05-26 08:49:59', NULL),
(5, 'Italian', 'italian_food.jpg', '1', '1', NULL, '2023-05-26 08:44:29', '2023-05-26 08:44:29', NULL),
(6, 'Arabic', 'arabic_food.jpg', '1', '1', NULL, '2023-05-26 08:44:41', '2023-05-26 08:53:04', NULL),
(7, 'Soft Drinks', 'drinks.jpg', '1', '1', NULL, '2023-05-26 08:44:54', '2023-05-26 08:44:54', NULL),
(8, 'Burgers', 'burger_new.jpg', '1', '1', NULL, '2023-05-26 08:45:11', '2023-05-26 08:45:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `menu_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image`, `menu_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'White Sauce Pasta', 'White Sauce pasta with chicken served with garlic bread', 850, 'white_sauce_pasta.jpg', '5', '1', NULL, '2023-05-26 08:46:50', '2023-05-26 08:46:50', NULL),
(2, 'Alfredo Pasta', 'Alfredo Pasta Served in White Sauce with garlic bread.', 850, 'alfredo.jpg', '5', '1', NULL, '2023-05-26 08:47:28', '2023-05-26 08:47:28', NULL),
(3, 'Garlic Bread', 'Toasted Cheesy Garlic Bread', 150, 'garlic_bread.jpg', '5', '1', NULL, '2023-05-26 08:47:49', '2023-05-26 08:47:59', NULL),
(4, 'Chicken Red Karahi', '5 person serving karahi served in red sauce', 1000, 'chicken_karahi.jpg', '4', '1', NULL, '2023-05-26 08:48:45', '2023-05-26 08:53:43', NULL),
(5, 'White Chicken Karahi', '5 person serving white chicken karahi', 1000, 'white_karahi.jpg', '4', '1', NULL, '2023-05-26 08:49:09', '2023-05-26 08:49:09', NULL);

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
(30, '2023_05_26_132617_menu_items', 1),
(45, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(46, '2019_08_19_000000_create_failed_jobs_table', 2),
(47, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(48, '2023_05_16_142720_create_users_table', 2),
(49, '2023_05_16_150118_create_restaurants_table', 2),
(50, '2023_05_16_150639_create_restaurant_outlets_table', 2),
(51, '2023_05_23_142947_create_menus_table', 2),
(52, '2023_05_26_133316_create_menu_items_table', 3);

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
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `user_id`, `address`, `contact_number`, `logo`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gourmet', '2', 'Bilal Arcade, Abdul Haque Rd, Block G Phase 1 Johar Town, Lahore, Punjab 54700', '0324556785', 'gourment_logo.jpg', '1', NULL, '2023-05-26 08:38:55', '2023-05-26 08:38:55', NULL),
(2, 'McDonalds', '4', 'Plot 24, Block H, Sector H DHA Phase 1, Lahore', '0324556785', 'mc_donalds.png', '1', '1', '2023-05-26 08:39:22', '2023-05-26 08:41:33', NULL),
(3, 'Pizza Hut', '8', 'H Block Market, Street 144, Defence H Block Sector H Dha Phase 1, Lahore, Punjab', '0324567758', 'pizza_hut_logo.png', '1', NULL, '2023-05-26 08:39:47', '2023-05-26 08:39:47', NULL),
(4, 'Shaheen Shinwari', '6', 'Plot 5, Block G, Sector G, Johar Town, Lahore', '0324567758', 'shaheen_shinwari.jpg', '1', NULL, '2023-05-26 08:40:10', '2023-05-26 08:40:10', NULL),
(5, 'KFC', '9', 'Plot 24, Block H, Sector H DHA Phase 1, Lahore', '042 33445674', 'kfc_logo.png', '1', '1', '2023-05-26 08:40:47', '2023-05-26 08:40:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_outlets`
--

CREATE TABLE `restaurant_outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_one` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `restaurant_id` varchar(255) NOT NULL,
  `contact_two` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `opening_time` varchar(255) NOT NULL,
  `closing_time` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_outlets`
--

INSERT INTO `restaurant_outlets` (`id`, `name`, `address`, `contact_one`, `user_id`, `restaurant_id`, `contact_two`, `logo`, `opening_time`, `closing_time`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gourmet DHA', '635 D.H.A. Main Blvd, Phase IV Sector Z DHA Phase 3, Lahore, Punjab', '03356423546', '7', '1', '03125647832', 'gourment_logo.jpg', '09:00', '21:00', '1', NULL, '2023-05-26 08:41:25', '2023-05-26 08:41:25', NULL),
(2, 'McDonalds DHA Y Block', '635 D.H.A. Main Blvd, Phase IV Sector Z DHA Phase 3, Lahore, Punjab', '03356423546', '10', '2', '03186655432', 'mc_donalds.png', '10:00', '12:00', '1', NULL, '2023-05-26 08:41:59', '2023-05-26 08:41:59', NULL),
(3, 'McDonalds DHA H Block', '635 D.H.A. Main Blvd, Phase IV Sector Z DHA Phase 3, Lahore, Punjab', '03356423546', '3', '2', '03125647832', 'mc_donalds_new.jpg', '10:00', '00:00', '1', NULL, '2023-05-26 08:42:51', '2023-05-26 08:42:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Faisal', 'faisal.khan@gmail.com', 'Admin', '$2y$10$bKx8fGxx/O8JZWD1pV1ipeH8lq9gTryGgW/XxK5lqNvYqksTKwD1i', '', NULL, '2023-05-26 08:35:10', '2023-05-26 08:35:10', NULL),
(2, 'Ahmed Khan', 'ahmed.khan@gmail.com', 'Restaurant Owner', '$2y$10$AX9oSYr9IdG8pCXY35jQgemHALLswXWklAxWCcbVtTrQpsZSq5Wvy', '1', NULL, '2023-05-26 08:36:05', '2023-05-26 08:36:05', NULL),
(3, 'Waleed Rauf', 'waleed.rauf@gmail.com', 'Branch Owner', '$2y$10$rxeTT7vL0CFkku8Q7/GXs.rEvTYp4X4XARpWgSiYSWHp92mSYX0Fy', '1', NULL, '2023-05-26 08:36:19', '2023-05-26 08:36:19', NULL),
(4, 'Khalid Qasim', 'khalid.qasim@outlook.com', 'Restaurant Owner', '$2y$10$FOB8bSwbK.1NqX1ocYmJ0uxn/EV9gFfrpqzmEwIolJGP7IEve939S', '1', NULL, '2023-05-26 08:36:31', '2023-05-26 08:36:31', NULL),
(5, 'Talha Ahmed', 'talha.ahmed@gmail.com', 'Admin', '$2y$10$qLUYjBO9/TsmP6pT.P5sQeNn0LP2GSpbSKfczKOqD3bGh2mcsQeXG', '1', NULL, '2023-05-26 08:36:44', '2023-05-26 08:36:44', NULL),
(6, 'Ahmed Rasheed', 'ahmed.rasheed@gmail.com', 'Restaurant Owner', '$2y$10$WMXODwPP2NxcyNimg6OYYultTlDkrj6SUb3JS..w27cL2T1g0Z0Km', '1', NULL, '2023-05-26 08:37:01', '2023-05-26 08:37:01', NULL),
(7, 'Tahir Baig', 'tahir_baig@gmail.com', 'Branch Owner', '$2y$10$LSqUEEOoXH16/tEshe3Yv.9RdyUoADx5F8iCgUIdQGOGi5aMgRWwm', '1', NULL, '2023-05-26 08:37:18', '2023-05-26 08:37:18', NULL),
(8, 'Waleed Tariq', 'waleed.tariq99@gmail.com', 'Restaurant Owner', '$2y$10$Xiy0OpNe/Hk/ShbjymPz4eTiWfOnsQnoSgaqkkRQek2bLBTmjjto6', '1', NULL, '2023-05-26 08:37:38', '2023-05-26 08:37:38', NULL),
(9, 'Farhan Ahmed', 'farhan_ahmed33@gmail.com', 'Restaurant Owner', '$2y$10$xet.mFYb2uhZPOqbLCRb1.hp46Tb/ju.ZFRsSb0ZzIqXb2Gjcvdl.', '1', NULL, '2023-05-26 08:37:57', '2023-05-26 08:37:57', NULL),
(10, 'Fahad Murtaza', 'fahad_murtaza@gmail.com', 'Branch Owner', '$2y$10$aMQxADsYXrS5GyCm7NzqW.rGvmmJVJnn2i.kyT0zOcJI/1zsruWSK', '1', NULL, '2023-05-26 08:38:12', '2023-05-26 08:38:12', NULL);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_outlets`
--
ALTER TABLE `restaurant_outlets`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurant_outlets`
--
ALTER TABLE `restaurant_outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
