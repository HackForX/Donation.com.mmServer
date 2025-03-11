-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2025 at 08:50 AM
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
-- Database: `donation.com.mm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'fsdfdsf', 'food', '2025-03-02 12:27:02', '2025-03-02 12:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'fsdf', 1, '2025-03-02 12:27:33', '2025-03-02 12:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `email`, `facebook`, `website`, `created_at`, `updated_at`) VALUES
(1, '09783150477', 'linnayye557@gmail.com', 'facebook.com', 'website.com', '2025-03-02 12:25:52', '2025-03-02 12:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `donor_requests`
--

CREATE TABLE `donor_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `business` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_02_17_140438_create_permission_tables', 1),
(10, '2024_02_18_040336_create_items_table', 1),
(11, '2024_02_18_061524_create_cities_table', 1),
(12, '2024_02_18_071242_create_townships_table', 1),
(13, '2024_02_18_131621_create_sub_items_table', 1),
(14, '2024_04_20_015651_create_categories_table', 1),
(15, '2024_04_20_015853_create_sub_categories_table', 1),
(16, '2024_04_22_084438_create_donor_requests_table', 1),
(17, '2024_04_27_152202_create_sadudithars_table', 1),
(18, '2024_04_27_180128_create_natebanzays_table', 1),
(19, '2024_04_30_104022_create_natebanzay_requests_table', 1),
(20, '2024_05_01_035309_create_sadudithar_comments_table', 1),
(21, '2024_05_01_041451_create_sadudithar_likes_table', 1),
(22, '2024_05_01_064600_create_sadudithar_views_table', 1),
(23, '2024_05_02_011421_create_natebanzay_chats_table', 1),
(24, '2024_05_02_043143_create_notifications_table', 1),
(25, '2024_05_02_044953_create_providers_table', 1),
(26, '2024_05_03_055531_create_natebanzay_chat_messages_table', 1),
(27, '2024_05_09_175657_create_natebanzay_likes', 1),
(28, '2024_05_10_153057_create_natebanzay_views_table', 1),
(29, '2024_05_10_153836_create_natebanzay_comments_table', 1),
(30, '2024_05_17_070811_create_password_resets', 1),
(31, '2024_05_17_080633_create_contacts_table', 1),
(32, '2024_09_04_081237_create_password_reset_tokens_table', 1),
(33, '2024_09_16_010708_add_is_show_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `natebanzays`
--

CREATE TABLE `natebanzays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `photos` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natebanzay_chats`
--

CREATE TABLE `natebanzay_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requester_id` bigint(20) UNSIGNED NOT NULL,
  `uploader_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natebanzay_chat_messages`
--

CREATE TABLE `natebanzay_chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natebanzay_comments`
--

CREATE TABLE `natebanzay_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `natebanzay_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natebanzay_likes`
--

CREATE TABLE `natebanzay_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `natebanzay_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natebanzay_requests`
--

CREATE TABLE `natebanzay_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `natebanzay_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `natebanzay_views`
--

CREATE TABLE `natebanzay_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `natebanzay_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('9ebb427b6d57b9877d94421a4d83bf03b03ad8427f222f5b2822975ad47a899c42ec38bb2dcdddb0', 3, 1, '09783150478_2025-03-03 02:33:18', '[]', 0, '2025-03-02 20:03:18', '2025-03-02 20:03:18', '2025-04-03 02:33:18'),
('c51cc33d0c915a1ae404cc2268a90f5287b3b14e882710e9bed4f7f22a3a5979fac06a10de584ba1', 2, 1, '09343_2025-03-02 18:57:20', '[]', 0, '2025-03-02 12:27:20', '2025-03-02 12:27:20', '2025-04-02 18:57:20'),
('e7558a49d0cf59ae1675bcb8a44aadafc36571c0b45cbe3c56558759554afeeb7620dac8a6464e15', 4, 1, '0923423_2025-03-03 03:27:37', '[]', 0, '2025-03-02 20:57:37', '2025-03-02 20:57:37', '2025-04-03 03:27:37'),
('fb44df0148e3fb5159858a11c9086f6697b686d42955c3e1f414082ec20c52148aed47ab2db6fe8b', 4, 1, '0923423_2025-03-03 03:28:25', '[]', 0, '2025-03-02 20:58:25', '2025-03-02 20:58:25', '2025-04-03 03:28:25'),
('fbf47c170a2ffe6822834c3890d440fe8b8e04948d16cb2966e97cc649d0c4e925c9605b56c2023b', 3, 1, '09783150478_2025-03-03 02:33:40', '[]', 0, '2025-03-02 20:03:40', '2025-03-02 20:03:40', '2025-04-03 02:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Donation.com.mm Personal Access Client', '7IgLYVKyKqQmVFAyeInOUriVb4rZ9L871h2fXIFp', NULL, 'http://localhost', 1, 0, 0, '2025-03-02 12:25:56', '2025-03-02 12:25:56'),
(2, NULL, 'Donation.com.mm Password Grant Client', 'Cd4bmyfcQPFdp76g6xFjgbOXVbi4REy0kIXKZ3i1', 'users', 'http://localhost', 0, 1, 0, '2025-03-02 12:25:56', '2025-03-02 12:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-03-02 12:25:56', '2025-03-02 12:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'requestDonor', 'web', '2025-03-02 12:25:52', '2025-03-02 12:25:52'),
(2, 'createSadudithar', 'web', '2025-03-02 12:25:52', '2025-03-02 12:25:52');

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
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'api', '2025-03-02 12:25:51', '2025-03-02 12:25:51'),
(2, 'user', 'api', '2025-03-02 12:25:51', '2025-03-02 12:25:51'),
(3, 'donor', 'api', '2025-03-02 12:25:51', '2025-03-02 12:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadudithars`
--

CREATE TABLE `sadudithars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `township_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estimated_amount` int(11) NOT NULL,
  `estimated_time` varchar(255) DEFAULT NULL,
  `estimated_quantity` varchar(255) DEFAULT NULL,
  `actual_start_time` time DEFAULT NULL,
  `actual_end_time` time DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0,
  `is_show` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sadudithars`
--

INSERT INTO `sadudithars` (`id`, `title`, `description`, `type`, `category_id`, `city_id`, `township_id`, `user_id`, `subcategory_id`, `estimated_amount`, `estimated_time`, `estimated_quantity`, `actual_start_time`, `actual_end_time`, `event_date`, `is_open`, `is_show`, `address`, `phone`, `image`, `status`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(3, 'sdfdsf', 'fdsfdsf', 'food', 1, 1, 1, 2, 1, 23423, 'fsdfdsf', '234', '04:34:00', '03:24:00', '2025-03-21 00:00:00', 0, 1, 'fdsf', '09234', 'images/sadudithar_photos/beoUw9zCcElC5Z6AMuSVLHQDabx2rx36HsrCdWTf.jpg', 'approved', 22.0316536, 96.101342, '2025-03-02 19:56:31', '2025-03-02 20:30:36'),
(5, 'Test', 'Test Desc', 'food', 1, 1, 1, 2, NULL, 1000, '9Am', '1000', '18:46:00', '07:46:00', '2024-09-11 00:00:00', 1, 0, 'Thazi', '09234234234', 'images/sadudithar_photos/MFqPEZQ9koHnqU6LhsnebF9OQ2RGXTB6VEkmRI7g.png', 'approved', NULL, NULL, '2025-03-02 20:06:18', '2025-03-02 20:33:05'),
(6, 'Test', 'Test Desc', 'food', 1, 1, 1, 3, NULL, 1000, '9Am', '1000', '18:46:00', '07:46:00', '2024-09-11 00:00:00', 1, 0, 'Thazi', '09234234234', 'images/sadudithar_photos/hZHn7EN2MkVshQzaUYDQFSjkUQDZYuSNL4GBF5DC.png', 'approved', NULL, NULL, '2025-03-02 20:06:39', '2025-03-02 20:33:27'),
(7, 'Test', 'Test Desc', 'food', 1, 1, 1, 3, NULL, 1000, '9Am', '1000', '18:46:00', '07:46:00', '2024-09-11 00:00:00', 1, 0, 'Thazi', '09234234234', 'images/sadudithar_photos/HkJw5cAa3cq575rXWhFZPoIjbXoidk0r86TIM2uP.png', 'denied', NULL, NULL, '2025-03-02 20:10:51', '2025-03-02 20:24:19'),
(8, 'fsdfdsf', 'fsdfdsf', 'food', 1, 1, 1, 2, 1, 23, 'sfdfds', '23', '23:42:00', '23:04:00', '2025-03-22 00:00:00', 0, 0, 'fsdf', '0934', 'images/sadudithar_photos/JirQbenubGDdwniWKjq3Cd1qxkzXX8Qro6m650Jb.jpg', 'denied', 22.031649, 96.101344, '2025-03-02 20:19:40', '2025-03-02 20:24:19'),
(9, 'fgh', 'mjmn', 'food', 1, 1, 1, 2, 1, 24, 'jghjghj', '65', '23:43:00', '23:32:00', '2025-03-23 00:00:00', 0, 0, 'jhg', '097687', 'images/sadudithar_photos/2IzpLqbEjcNwLZfCQ3C9waDqLJvuEtra1kcr0vJo.jpg', 'approved', 22.0198142, 96.0997082, '2025-03-02 20:50:36', '2025-03-02 20:50:36'),
(10, 'fhg', 'jgj', 'food', 1, 1, 1, 2, 1, 5435, 'fhgf', '35', '13:42:00', '04:32:00', '2025-03-06 00:00:00', 0, 1, 'hfhjg', '98090', 'images/sadudithar_photos/dnwlVWiyWcWcSQwUewuluoxFtqD6VtH3W24tBJoy.jpg', 'approved', 22.0316287, 96.1013066, '2025-03-02 20:54:06', '2025-03-02 20:54:06'),
(11, 'Update', 'fsdf', 'item', 1, 1, 1, 4, 1, 23423, 'fsdfd', '234', '03:42:00', '23:32:00', '2025-03-18 00:00:00', 0, 1, 'fdsf', '09324', 'images/sadudithar_photos/CwTLi6MazvnIDjMwAV0QqqBGzSL9TOBDavi4Xj82.jpg', 'approved', NULL, NULL, '2025-03-02 21:12:54', '2025-03-02 21:34:03'),
(12, 'update', 'kjhhj', 'food', 1, 1, 1, 4, 1, 324, 'kjkj', '425', '13:43:00', '16:23:00', '2025-03-29 00:00:00', 1, 0, 'jjk', '09', 'images/sadudithar_photos/p16dXUw50nb0Qbyq4PvIhq1CJl4mUqm57v5hj4IS.jpg', 'approved', NULL, NULL, '2025-03-02 23:27:29', '2025-03-02 23:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `sadudithar_comments`
--

CREATE TABLE `sadudithar_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sadudithar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadudithar_likes`
--

CREATE TABLE `sadudithar_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sadudithar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sadudithar_views`
--

CREATE TABLE `sadudithar_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sadudithar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_view` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `type`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'fsdf', 'food', 1, '2025-03-02 12:27:11', '2025-03-02 12:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `sub_items`
--

CREATE TABLE `sub_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `name`, `is_active`, `city_id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, '324234', 1, 1, 'fsdf', '2025-03-02 12:27:41', '2025-03-02 12:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '',
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `document_number` varchar(255) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `age`, `gender`, `email`, `password`, `address`, `device_token`, `profile`, `document`, `document_number`, `is_show`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '09783150476', NULL, '', 'devteam.ionic@gmail.com', '$2y$12$5eutwR1w/H7Y8.CROWFcJOn4/TIrQaqkkrpq2NGaXJp0OeYvo1p1S', NULL, NULL, '1740941807.jpg', NULL, NULL, 1, '2025-03-02 12:25:52', '2025-03-02 12:26:47'),
(2, 'fsdf', '09343', NULL, '', NULL, '$2y$12$vIvi1zJdXcQMQHEWC1BELe7FbPztnFkKlQIZtVCC9V6xOK8Zm6E32', 'fsdfdsf', NULL, NULL, NULL, NULL, 1, '2025-03-02 12:27:20', '2025-03-02 12:27:20'),
(3, 'Donor', '09783150478', NULL, '', NULL, '$2y$12$Ja62iwf0nv/zWAepCrR/FugtocKJo9A0OFq33oyoyIqbM4mQLD9rK', 'fsdfd', NULL, NULL, NULL, NULL, 1, '2025-03-02 20:03:18', '2025-03-02 20:03:18'),
(4, 'sdfdsf', '0923423', NULL, '', 'linnayye557@gmail.com', '$2y$12$IbeMb018tgS8.f/Ndtq75OIEtgNiF2slNYHA5DuaslTs/cOcJxeBq', NULL, NULL, NULL, NULL, NULL, 1, '2025-03-02 20:57:37', '2025-03-02 20:57:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor_requests`
--
ALTER TABLE `donor_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
-- Indexes for table `natebanzays`
--
ALTER TABLE `natebanzays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzays_user_id_foreign` (`user_id`),
  ADD KEY `natebanzays_item_id_foreign` (`item_id`);

--
-- Indexes for table `natebanzay_chats`
--
ALTER TABLE `natebanzay_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzay_chats_requester_id_foreign` (`requester_id`),
  ADD KEY `natebanzay_chats_uploader_id_foreign` (`uploader_id`);

--
-- Indexes for table `natebanzay_chat_messages`
--
ALTER TABLE `natebanzay_chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzay_chat_messages_chat_id_foreign` (`chat_id`),
  ADD KEY `natebanzay_chat_messages_sender_id_foreign` (`sender_id`),
  ADD KEY `natebanzay_chat_messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `natebanzay_comments`
--
ALTER TABLE `natebanzay_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzay_comments_natebanzay_id_foreign` (`natebanzay_id`),
  ADD KEY `natebanzay_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `natebanzay_likes`
--
ALTER TABLE `natebanzay_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzay_likes_natebanzay_id_foreign` (`natebanzay_id`),
  ADD KEY `natebanzay_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `natebanzay_requests`
--
ALTER TABLE `natebanzay_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzay_requests_natebanzay_id_foreign` (`natebanzay_id`),
  ADD KEY `natebanzay_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `natebanzay_views`
--
ALTER TABLE `natebanzay_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `natebanzay_views_natebanzay_id_foreign` (`natebanzay_id`),
  ADD KEY `natebanzay_views_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password_resets_phone_unique` (`phone`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `providers_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sadudithars`
--
ALTER TABLE `sadudithars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sadudithars_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `sadudithars_category_id_foreign` (`category_id`),
  ADD KEY `sadudithars_city_id_foreign` (`city_id`),
  ADD KEY `sadudithars_township_id_foreign` (`township_id`),
  ADD KEY `sadudithars_user_id_foreign` (`user_id`);

--
-- Indexes for table `sadudithar_comments`
--
ALTER TABLE `sadudithar_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sadudithar_comments_sadudithar_id_foreign` (`sadudithar_id`),
  ADD KEY `sadudithar_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `sadudithar_likes`
--
ALTER TABLE `sadudithar_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sadudithar_likes_sadudithar_id_foreign` (`sadudithar_id`),
  ADD KEY `sadudithar_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `sadudithar_views`
--
ALTER TABLE `sadudithar_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sadudithar_views_sadudithar_id_foreign` (`sadudithar_id`),
  ADD KEY `sadudithar_views_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `sub_items`
--
ALTER TABLE `sub_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `townships_city_id_foreign` (`city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donor_requests`
--
ALTER TABLE `donor_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `natebanzays`
--
ALTER TABLE `natebanzays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natebanzay_chats`
--
ALTER TABLE `natebanzay_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natebanzay_chat_messages`
--
ALTER TABLE `natebanzay_chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natebanzay_comments`
--
ALTER TABLE `natebanzay_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natebanzay_likes`
--
ALTER TABLE `natebanzay_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natebanzay_requests`
--
ALTER TABLE `natebanzay_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `natebanzay_views`
--
ALTER TABLE `natebanzay_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sadudithars`
--
ALTER TABLE `sadudithars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sadudithar_comments`
--
ALTER TABLE `sadudithar_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sadudithar_likes`
--
ALTER TABLE `sadudithar_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sadudithar_views`
--
ALTER TABLE `sadudithar_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_items`
--
ALTER TABLE `sub_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donor_requests`
--
ALTER TABLE `donor_requests`
  ADD CONSTRAINT `donor_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `natebanzays`
--
ALTER TABLE `natebanzays`
  ADD CONSTRAINT `natebanzays_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzays_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `natebanzay_chats`
--
ALTER TABLE `natebanzay_chats`
  ADD CONSTRAINT `natebanzay_chats_requester_id_foreign` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_chats_uploader_id_foreign` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `natebanzay_chat_messages`
--
ALTER TABLE `natebanzay_chat_messages`
  ADD CONSTRAINT `natebanzay_chat_messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `natebanzay_chats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_chat_messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_chat_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `natebanzay_comments`
--
ALTER TABLE `natebanzay_comments`
  ADD CONSTRAINT `natebanzay_comments_natebanzay_id_foreign` FOREIGN KEY (`natebanzay_id`) REFERENCES `natebanzays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `natebanzay_likes`
--
ALTER TABLE `natebanzay_likes`
  ADD CONSTRAINT `natebanzay_likes_natebanzay_id_foreign` FOREIGN KEY (`natebanzay_id`) REFERENCES `natebanzays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `natebanzay_requests`
--
ALTER TABLE `natebanzay_requests`
  ADD CONSTRAINT `natebanzay_requests_natebanzay_id_foreign` FOREIGN KEY (`natebanzay_id`) REFERENCES `natebanzays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `natebanzay_views`
--
ALTER TABLE `natebanzay_views`
  ADD CONSTRAINT `natebanzay_views_natebanzay_id_foreign` FOREIGN KEY (`natebanzay_id`) REFERENCES `natebanzays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `natebanzay_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sadudithars`
--
ALTER TABLE `sadudithars`
  ADD CONSTRAINT `sadudithars_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithars_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithars_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithars_township_id_foreign` FOREIGN KEY (`township_id`) REFERENCES `townships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sadudithar_comments`
--
ALTER TABLE `sadudithar_comments`
  ADD CONSTRAINT `sadudithar_comments_sadudithar_id_foreign` FOREIGN KEY (`sadudithar_id`) REFERENCES `sadudithars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithar_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sadudithar_likes`
--
ALTER TABLE `sadudithar_likes`
  ADD CONSTRAINT `sadudithar_likes_sadudithar_id_foreign` FOREIGN KEY (`sadudithar_id`) REFERENCES `sadudithars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithar_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sadudithar_views`
--
ALTER TABLE `sadudithar_views`
  ADD CONSTRAINT `sadudithar_views_sadudithar_id_foreign` FOREIGN KEY (`sadudithar_id`) REFERENCES `sadudithars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sadudithar_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_items`
--
ALTER TABLE `sub_items`
  ADD CONSTRAINT `sub_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `townships`
--
ALTER TABLE `townships`
  ADD CONSTRAINT `townships_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
