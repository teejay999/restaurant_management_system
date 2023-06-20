-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 03:31 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`) VALUES
(1, 'Faisal Khan', 'faisal.khan@gmail.com', '$2y$10$aSrhFOrR1IzE1i9.IIZJoenSDpCUtKM/y0oCUoCseVrhMWsFST4Ty', '2023-06-02 05:38:10', '2023-06-02 05:38:10', NULL, NULL, NULL),
(3, 'Talha Ahmed', 'talha.ahmed@gmail.com', '$2y$10$hk8xJ2jzKRBfbNu7ifZQg.lUyPxv6SpPIo9VL2MTTeNXR6Oguca7C', '2023-06-02 05:51:48', '2023-06-02 05:51:48', NULL, NULL, NULL);

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
(1, 'Desi', 'desi_food.jpg', '1', '1', NULL, '2023-06-01 11:38:02', '2023-06-01 11:38:02', NULL),
(2, 'Pasta', 'italian_food.jpg', '1', '1', NULL, '2023-06-01 11:38:16', '2023-06-09 12:28:19', NULL),
(3, 'Burgers', 'burger-1.jpg', '1', '1', NULL, '2023-06-01 11:38:35', '2023-06-01 11:38:35', NULL),
(4, 'Pizza', 'pizza_new.jpg', '1', '1', NULL, '2023-06-01 11:39:04', '2023-06-07 12:17:44', NULL),
(5, 'Soft Drinks', 'soft_drinks.png', '1', '1', NULL, '2023-06-07 09:39:39', '2023-06-07 09:39:39', NULL),
(6, 'Sweets', 'desi_sweets.jpg', '1', '1', NULL, '2023-06-08 10:07:34', '2023-06-13 05:35:01', NULL),
(7, 'Arabic', 'arabic_foods.jpg', '1', '1', NULL, '2023-06-08 10:09:00', '2023-06-13 05:34:59', NULL),
(8, 'Chinese', 'chinese_foods.jpg', '1', '1', NULL, '2023-06-08 11:49:35', '2023-06-09 11:41:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
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
(1, 'Chicken Karahi', '5 persons serving', '900', 'chicken_karahi.jpg', '1', '1', NULL, '2023-06-01 11:39:47', '2023-06-01 11:40:28', NULL),
(2, 'White Chicken Karahi', '5 persons serving', '1100', 'white_karahi.jpg', '1', '1', NULL, '2023-06-01 11:40:19', '2023-06-01 11:40:19', NULL),
(3, 'White Sauce Pasta', 'Pene pasta served in cheesy white sauce along with garlic bread as a side', '850', 'white_sauce_pasta.jpg', '2', '1', NULL, '2023-06-01 11:41:43', '2023-06-13 08:47:50', NULL),
(4, 'Red Sauce Pasta', 'Penne pasta served in red tomato sauce along with garlic bread as a side.', '750', 'red_sauce.jpg', '2', '1', NULL, '2023-06-01 11:42:39', '2023-06-01 11:42:39', NULL),
(5, 'Alfredo White Sauce Pasta', 'Alfredo Pasta served in white sauce along with chicken stake and garlic bread as a side', '1000', 'alfredo.jpg', '2', '1', NULL, '2023-06-01 11:43:47', '2023-06-12 11:01:05', NULL),
(6, 'Chicken Zinger', 'Fried chicken patty dipped in garlic mayo sauce along with french fries as a side.', '800', 'burger_new.jpg', '3', '1', NULL, '2023-06-01 11:45:16', '2023-06-01 11:45:16', NULL),
(7, 'Chicken Tikka Pizza', '12 inches long pizza for 2 persons', '1200', 'pizza.jpg', '4', '1', NULL, '2023-06-01 11:46:21', '2023-06-01 11:46:21', NULL),
(8, 'Pepsi', '1.5L Family Sharing Bottle', '130', 'pepsi.jpg', '5', '1', NULL, '2023-06-07 09:41:45', '2023-06-07 09:41:45', NULL),
(9, 'Mountain Dew', '1.5 L Family Sharing Bottle', '130', 'dew.jpg', '5', '1', NULL, '2023-06-07 09:42:58', '2023-06-07 09:42:58', NULL),
(10, '7 Up', '1.5 L Family Sharing Bottle', '130', '7_up.jpg', '5', '1', NULL, '2023-06-07 09:43:57', '2023-06-12 11:06:43', '2023-06-12 11:06:43'),
(11, 'Sprite Mint', '500L Single Person Drink', '80', 'sprite_mint_1.5_L.jpg', '5', '1', NULL, '2023-06-07 09:46:36', '2023-06-12 10:50:44', NULL),
(12, 'Mirinda', '1.5 L Sharing Bottle', '130', 'mirinda_1.5L.jpg', '5', '1', NULL, '2023-06-12 10:38:38', '2023-06-12 10:50:46', NULL),
(13, 'Diet Coke', '1.5L Sharing Bottle', '130', 'diet_coke_1.5L.jpg', '5', '1', NULL, '2023-06-12 10:52:17', '2023-06-12 11:03:25', NULL),
(14, 'Diet 7 Up', '1.5 L Sharing Bottle', '130', 'diet_7up_1.5L.jpg', '5', '1', NULL, '2023-06-12 10:55:05', '2023-06-12 11:03:21', NULL),
(15, 'Big Apple', '1.5L Sharing Bottle', '130', 'big_apple_1.5 L.jpg', '5', '1', NULL, '2023-06-12 11:05:41', '2023-06-12 11:05:41', NULL),
(16, 'Shawarma Platter', '2 person serving served with garlic sauce', '1000', 'shawarma_platter.jpg', '7', '1', NULL, '2023-06-13 05:36:39', '2023-06-13 05:36:39', NULL),
(17, 'Kheer', '1 person serving', '350', 'Kheer.jpg', '6', '1', NULL, '2023-06-13 05:37:41', '2023-06-13 05:37:41', NULL),
(18, 'Chicken Chilli Dry', '1 person serving', '850', 'chicken_chilli_dry.jpg', '8', '1', NULL, '2023-06-13 05:40:17', '2023-06-13 05:40:17', NULL);

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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_05_16_142720_create_users_table', 1),
(5, '2023_05_16_150118_create_restaurants_table', 1),
(6, '2023_05_16_150639_create_restaurant_outlets_table', 1),
(7, '2023_05_23_142947_create_menus_table', 1),
(8, '2023_05_30_131221_create_orders_table', 1),
(9, '2023_05_30_142743_create_menu_items_table', 1),
(10, '2023_05_30_143143_create_order_details_table', 1),
(11, '2023_05_30_143627_create_customers_table', 1),
(12, '2023_06_01_171800_add_columns_to_customers_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `address` varchar(256) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `restaurant_outlet_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `address`, `total_price`, `status`, `customer_id`, `restaurant_outlet_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(22, '2023-06-13', '1 KM Defense Road Chowk Raiwind Road near Lahore, Bhobtian, University،, Lahore, Punjab 54000', 1830, 'accepted', '1', '1', '1', NULL, NULL, '2023-06-13 08:08:05', '2023-06-14 08:16:42'),
(23, '2023-06-13', 'G8FV+2FX, Zahoor Elahi Rd, Block B Gulberg 2, Lahore, Punjab', 2840, 'rejected', '1', '1', '1', NULL, NULL, '2023-06-13 08:09:08', '2023-06-14 07:26:51'),
(24, '2023-06-13', 'G8FV+2FX, Zahoor Elahi Rd, Block B Gulberg 2, Lahore, Punjab', 3000, 'delivered', '1', '1', '1', NULL, NULL, '2023-06-13 08:09:49', '2023-06-14 07:27:06'),
(25, '2023-06-13', '1 KM Defense Road Chowk Raiwind Road near Lahore, Bhobtian, University،, Lahore, Punjab 54000', 13710, 'delivered', '1', '1', '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-14 07:59:39'),
(26, '2023-06-13', '1 KM Defense Road Chowk Raiwind Road near Lahore, Bhobtian, University،, Lahore, Punjab 54000', 1000, 'rejected', '1', '1', '1', NULL, NULL, '2023-06-13 08:40:31', '2023-06-13 08:40:31'),
(27, '2023-06-13', '1 KM Defense Road Chowk Raiwind Road near Lahore, Bhobtian, University،, Lahore, Punjab 54000', 750, 'pending', '1', '1', '1', NULL, NULL, '2023-06-13 08:42:33', '2023-06-14 07:25:05'),
(33, '2023-06-14', 'G8FV+2FX, Zahoor Elahi Rd, Block B Gulberg 2, Lahore, Punjab', 3230, 'accepted', '3', '1', '3', NULL, NULL, '2023-06-14 07:30:56', '2023-06-14 07:31:24'),
(34, '2023-06-14', '1 KM Defense Road Chowk Raiwind Road near Lahore, Bhobtian, University،, Lahore, Punjab 54000', 1050, 'accepted', '1', '1', '1', NULL, NULL, '2023-06-14 08:21:52', '2023-06-14 08:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `menu_item_id`, `order_id`, `quantity`, `unit_price`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(37, '9', '22', '1', 130, '1', NULL, NULL, '2023-06-13 08:08:05', '2023-06-13 08:08:05'),
(38, '18', '22', '2', 850, '1', NULL, NULL, '2023-06-13 08:08:05', '2023-06-13 08:08:05'),
(39, '6', '23', '2', 800, '1', NULL, NULL, '2023-06-13 08:09:08', '2023-06-13 08:09:08'),
(40, '11', '23', '3', 80, '1', NULL, NULL, '2023-06-13 08:09:08', '2023-06-13 08:09:08'),
(41, '16', '23', '1', 1000, '1', NULL, NULL, '2023-06-13 08:09:08', '2023-06-13 08:09:08'),
(42, '1', '24', '1', 900, '1', NULL, NULL, '2023-06-13 08:09:49', '2023-06-13 08:09:49'),
(43, '2', '24', '1', 1100, '1', NULL, NULL, '2023-06-13 08:09:49', '2023-06-13 08:09:49'),
(44, '5', '24', '1', 1000, '1', NULL, NULL, '2023-06-13 08:09:49', '2023-06-13 08:09:49'),
(45, '1', '25', '2', 900, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(46, '2', '25', '2', 1100, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(47, '3', '25', '3', 750, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(48, '4', '25', '2', 750, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(49, '5', '25', '2', 1000, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(50, '6', '25', '1', 800, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(51, '7', '25', '1', 1200, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(52, '9', '25', '1', 130, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(53, '15', '25', '1', 130, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(54, '18', '25', '2', 850, '1', NULL, NULL, '2023-06-13 08:37:03', '2023-06-13 08:37:03'),
(55, '5', '26', '1', 1000, '1', NULL, NULL, '2023-06-13 08:40:31', '2023-06-13 08:40:31'),
(56, '3', '27', '1', 750, '1', NULL, NULL, '2023-06-13 08:42:33', '2023-06-13 08:42:33'),
(57, '1', '33', '1', 900, '3', NULL, NULL, '2023-06-14 07:30:56', '2023-06-14 07:30:56'),
(58, '2', '33', '2', 1100, '3', NULL, NULL, '2023-06-14 07:30:56', '2023-06-14 07:30:56'),
(59, '14', '33', '1', 130, '3', NULL, NULL, '2023-06-14 07:30:56', '2023-06-14 07:30:56'),
(60, '17', '34', '3', 350, '1', NULL, NULL, '2023-06-14 08:21:52', '2023-06-14 08:21:52');

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
(1, 'Gourmet', '3', 'Plot 5, Block G, Sector G, Johar Town, Lahore', '0324556785', 'gourment_logo.jpg', '1', NULL, '2023-06-01 11:37:01', '2023-06-01 11:37:01', NULL);

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
(1, 'Gourmet DHA', 'Plot 24, Block H, Sector H DHA Phase 1, Lahore', '03245566475', '4', '1', '03125647832', 'gourment_logo.jpg', '09:00', '22:00', '1', NULL, '2023-06-01 11:37:32', '2023-06-01 11:37:32', NULL);

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
(1, 'Faisal Khan', 'faisal.khan@gmail.com', 'Admin', '$2a$12$BZ3xKU8wPm4pMcp.VQfDv.rXsFenVRT09qvzdyziMIIELcSMQViee', '', NULL, NULL, NULL, NULL),
(3, 'Fahad Murtaza', 'fahad_murtaza@gmail.com', 'Restaurant Owner', '$2y$10$rb8z99u9gM5cZVztYPplbueJ0sHvnmG2AGqSr3X/eYafl.MkMQhiy', '1', NULL, '2023-06-01 11:36:14', '2023-06-01 11:36:14', NULL),
(4, 'Talha Ahmed', 'talha.ahmed@gmail.com', 'Branch Owner', '$2y$10$3pYSR6iw46z6MUSNAPj.l.Q2mxAkhVaBzq34.2R5wdJSb3WFoQjMS', '1', NULL, '2023-06-01 11:36:30', '2023-06-01 11:36:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurant_outlets`
--
ALTER TABLE `restaurant_outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
