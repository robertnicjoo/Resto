-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2019 at 01:12 AM
-- Server version: 5.7.19
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrd`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `price`, `photo`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 'Air Putih', '2000', 'MenuItem-1550017010.jpg', 2, '2019-02-12 17:16:50', '2019-02-12 17:16:50'),
(2, 'Ayam Goreng', '5000', 'MenuItem-1550017033.jpg', 1, '2019-02-12 17:17:13', '2019-02-12 17:17:13'),
(3, 'Capcay', '16000', 'MenuItem-1550017047.jpg', 1, '2019-02-12 17:17:27', '2019-02-12 17:17:27'),
(4, 'Es Teh', '4000', 'MenuItem-1550017060.jpg', 2, '2019-02-12 17:17:40', '2019-02-12 17:17:40'),
(5, 'Ice Cream', '7000', 'MenuItem-1550017076.jpeg', 3, '2019-02-12 17:17:56', '2019-02-12 17:17:56'),
(6, 'Ikan Lele', '18000', 'MenuItem-1550017092.jpg', 1, '2019-02-12 17:18:12', '2019-02-12 17:18:12'),
(7, 'Kerupuk', '2000', 'MenuItem-1550017108.jpg', 3, '2019-02-12 17:18:28', '2019-02-12 17:18:28'),
(8, 'Nasi Goreng', '13000', 'MenuItem-1550017122.jpg', 1, '2019-02-12 17:18:42', '2019-02-12 17:18:42'),
(9, 'Nasi', '5000', 'MenuItem-1550017135.jpg', 1, '2019-02-12 17:18:55', '2019-02-12 17:18:55'),
(10, 'Sate', '14000', 'MenuItem-1550017150.jpg', 1, '2019-02-12 17:19:10', '2019-02-12 17:19:10'),
(11, 'Soto', '15000', 'MenuItem-1550017163.jpg', 1, '2019-02-12 17:19:23', '2019-02-12 17:19:23'),
(12, 'Teh Tawar', '5000', 'MenuItem-1550017178.jpg', 2, '2019-02-12 17:19:38', '2019-02-12 17:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `menu_types`
--

CREATE TABLE `menu_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_types`
--

INSERT INTO `menu_types` (`id`, `name`) VALUES
(1, 'Foods'),
(2, 'Drinks'),
(3, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_11_105650_create_permission_tables', 1),
(4, '2019_02_11_144520_create_menu_types_table', 1),
(5, '2019_02_11_144535_create_menus_table', 1),
(6, '2019_02_11_144823_create_orders_table', 1),
(7, '2019_02_11_145209_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(2, 'app\\User', 4),
(3, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waiter_id` int(10) UNSIGNED DEFAULT NULL,
  `cashier_id` int(10) UNSIGNED DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `customer`, `table_no`, `waiter_id`, `cashier_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ERP20190213-001', 'Irene', '01', 3, 2, 33000, 'Active', '2019-02-12 17:29:09', '2019-02-12 17:29:09'),
(2, 'ERP20190213-002', 'Frank', '02', 3, 2, 8000, 'Active', '2019-02-12 17:29:50', '2019-02-12 17:29:50'),
(3, 'ERP20190213-003', 'Shima', '03', 5, 4, 26000, 'Active', '2019-02-12 17:33:05', '2019-02-12 17:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`) VALUES
(1, 1, 2, 1),
(2, 1, 3, 1),
(3, 1, 5, 1),
(4, 1, 12, 1),
(5, 2, 4, 2),
(6, 3, 5, 1),
(7, 3, 9, 1),
(8, 3, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administer roles & permissions', 'web', '2019-02-12 17:10:48', '2019-02-12 17:10:48'),
(2, 'Create Order', 'web', '2019-02-12 17:10:48', '2019-02-12 17:10:48'),
(3, 'Edit Order', 'web', '2019-02-12 17:10:48', '2019-02-12 17:10:48'),
(4, 'Employees', 'web', '2019-02-12 17:10:48', '2019-02-12 17:10:48'),
(5, 'Menus', 'web', '2019-02-12 17:10:48', '2019-02-12 17:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'web', '2019-02-12 17:10:48', '2019-02-12 17:10:48'),
(2, 'Cashier', 'web', '2019-02-12 17:10:49', '2019-02-12 17:10:49'),
(3, 'Waiter', 'web', '2019-02-12 17:10:49', '2019-02-12 17:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'robert', 'admin@admin.com', NULL, '$2y$10$vgftWgDeNGGJqVNWgJ7fUeRMA1S1BfqPFSK9jbsWIGvr2GQqqv.eS', 'N0Qvr6YVFZj5NakJcEjGBgPYcotulRH3ZldSnaZL9KnuH9ZeQM2XeyLbFb9y', '2019-02-12 17:12:08', '2019-02-12 17:12:08'),
(2, 'Sarah F.', 'cashier@admin.com', NULL, '$2y$10$vgftWgDeNGGJqVNWgJ7fUeRMA1S1BfqPFSK9jbsWIGvr2GQqqv.eS', 'NpcUBucDnuvV8J1TItFpqyL6xNN9VUxQKxhg2tPvn5kiX2FQdiBhT8syQGvR', '2019-02-12 17:12:08', '2019-02-12 17:12:08'),
(3, 'Tony J.', 'waiter@admin.com', NULL, '$2y$10$vgftWgDeNGGJqVNWgJ7fUeRMA1S1BfqPFSK9jbsWIGvr2GQqqv.eS', 'mek2V7ejzuR9U57Ba4wAmQ2DYQ84ocOngWV9u4qLgdjnvcEUkF6AyKmjjrNI', '2019-02-12 17:12:08', '2019-02-12 17:12:08'),
(4, 'Nima', 'cashier2@admin.com', NULL, '$2y$10$vgftWgDeNGGJqVNWgJ7fUeRMA1S1BfqPFSK9jbsWIGvr2GQqqv.eS', 'DBHyRBoClEJJn61u9gYF45wvyGIiHVvpoVseDvpPNfBKYhHgyoEMQpA2OF6F', '2019-02-12 17:12:08', '2019-02-12 17:12:08'),
(5, 'Sam', 'waiter2@admin.com', NULL, '$2y$10$vgftWgDeNGGJqVNWgJ7fUeRMA1S1BfqPFSK9jbsWIGvr2GQqqv.eS', 'DBHyRBoClEJJn61u9gYF45wvyGIiHVvpoVseDvpPNfBKYhHgyoEMQpA2OF6F', '2019-02-12 17:12:08', '2019-02-12 17:12:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_type_id_foreign` (`type_id`);

--
-- Indexes for table `menu_types`
--
ALTER TABLE `menu_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_waiter_id_foreign` (`waiter_id`),
  ADD KEY `orders_cashier_id_foreign` (`cashier_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu_types`
--
ALTER TABLE `menu_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `menu_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cashier_id_foreign` FOREIGN KEY (`cashier_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_waiter_id_foreign` FOREIGN KEY (`waiter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
