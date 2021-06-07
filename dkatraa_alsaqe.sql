-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2021 at 01:37 AM
-- Server version: 5.6.51
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dkatraa_alsaqe`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `url_link` text,
  `picture` varchar(255) DEFAULT NULL,
  `visits` int(11) NOT NULL DEFAULT '0',
  `special` enum('0','1') NOT NULL DEFAULT '0',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `country_id`, `city_id`, `area_id`, `department_id`, `product_id`, `name`, `name_en`, `from_date`, `to_date`, `url_link`, `picture`, `visits`, `special`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 7, 1, 2, 'خصم خاص 10% ', 'special discount 10%', '2020-06-20', '2020-10-01', NULL, 'uploads/Advertisement/1.png', 1, '0', '1', NULL, '2020-06-24 10:47:39'),
(2, 2, 1, 7, 1, 4, 'خصم خاص 10% ', 'special discount 10%', '2020-06-20', '2020-10-01', NULL, 'uploads/Advertisement/1.png', 0, '0', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `parent_id`, `name`, `name_en`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'العاصمة', 'Al Easima', '1', NULL, NULL),
(2, 2, NULL, 'الجهراء', 'Jahra', '1', NULL, NULL),
(3, 2, NULL, 'الفروانية', 'Al Farwaniyah', '1', NULL, NULL),
(4, 2, NULL, 'حولي', 'Huli', '1', NULL, NULL),
(5, 2, NULL, 'مبارك الكبير', 'Mubarak Al-Kabeer', '1', NULL, NULL),
(6, 2, NULL, 'الأحمدي', 'Ahmadi', '1', NULL, NULL),
(7, 2, 1, 'الكويت', 'Kuwait', '1', NULL, NULL),
(8, 2, 1, 'دسمان', 'Dasman', '1', NULL, NULL),
(9, 2, 2, 'الصليبية', 'Al salibia', '1', NULL, NULL),
(10, 2, 2, 'أمغرة', 'Amghara', '1', NULL, NULL),
(11, 2, 3, 'أبرق خيطان', 'Abraq Khaytan', '1', NULL, NULL),
(12, 2, 4, 'الشعب', 'Al Shaeb', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `google_lat` varchar(255) DEFAULT NULL,
  `google_lon` varchar(255) DEFAULT NULL,
  `picture` text,
  `device_id` varchar(255) DEFAULT NULL,
  `phone_code` int(11) DEFAULT NULL,
  `validate_phone_code` enum('0','1') NOT NULL DEFAULT '0',
  `forget_code` int(11) DEFAULT NULL,
  `validate_forget_code` enum('0','1') NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `google_lat`, `google_lon`, `picture`, `device_id`, `phone_code`, `validate_phone_code`, `forget_code`, `validate_forget_code`, `remember_token`, `country_id`, `city_id`, `area_id`, `active`, `created_at`, `updated_at`) VALUES
(4, 'hend', NULL, NULL, NULL, '01000000000', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '1', '2020-06-14 10:37:26', '2020-06-14 10:37:26'),
(5, 'hend', NULL, NULL, NULL, '01000000000', NULL, NULL, NULL, NULL, '123456', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-06-14 10:40:07', '2021-02-17 15:24:07'),
(6, 'hend', NULL, NULL, NULL, '01000000000', NULL, NULL, NULL, NULL, '421f25e6a98072ae', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-01 02:31:02', '2020-07-06 08:49:24'),
(7, 'I', NULL, NULL, NULL, '3333', NULL, NULL, NULL, NULL, '17D5E082-A505-4054-B34B-63479D72EB3C', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-07 01:19:02', '2020-07-07 21:59:00'),
(8, 'احمد', NULL, NULL, NULL, '1113487081', NULL, NULL, NULL, NULL, '2215a07f557415e7', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-07 04:22:46', '2020-07-07 09:35:58'),
(9, 'hend', NULL, NULL, NULL, '01000000000', NULL, NULL, NULL, NULL, '1234567', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-07 22:23:54', '2020-07-08 15:55:15'),
(10, 'محمد', NULL, NULL, NULL, '97266997', NULL, NULL, NULL, NULL, '11C868A5-A70C-4D4D-80A1-3DFDD13382ED', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-08 02:07:30', '2020-12-15 09:45:06'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'f51dc975bacecb6e', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-08 06:44:21', '2020-07-08 06:44:21'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'f51dc975bacecb6e', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-08 06:44:21', '2020-07-08 06:44:21'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12345678', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-08 15:36:43', '2020-07-08 15:36:43'),
(14, 'ahmed', NULL, NULL, NULL, '123456789', NULL, NULL, NULL, NULL, '6BCAB00D-4695-4C10-BCCF-673AFA514E82', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-09 19:10:14', '2021-02-08 10:02:18'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1234678', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-09 23:03:33', '2020-07-09 23:03:33'),
(16, 'adsdas', NULL, NULL, NULL, '888888', NULL, NULL, NULL, NULL, '0448d85e278e1580', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-07-10 06:26:32', '2020-07-10 06:41:00'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6E29CF2E-0FC5-4AEB-9EE5-6E4AC815DAA7', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-12-16 11:33:06', '2020-12-16 11:33:06'),
(18, 'نتالل', NULL, NULL, NULL, '55555', NULL, NULL, NULL, NULL, '2CDDF7F9-6DAC-4F59-BFC5-8BE71DF5926B', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2020-12-16 18:18:07', '2021-02-08 18:04:30'),
(19, 'ahmed', NULL, NULL, NULL, '1234123', NULL, NULL, NULL, NULL, '32C0E918-D844-44DF-B1C0-056EC6F7AFC0', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2021-02-07 12:19:55', '2021-02-08 09:54:41'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '48c6bb08b63eb114', NULL, '0', NULL, '0', NULL, 2, NULL, NULL, '0', '2021-02-07 15:16:55', '2021-02-07 15:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `currency_en` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `name_en`, `flag`, `currency`, `currency_en`, `country_code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'مصر', 'Egypt', NULL, 'جنية', 'Pound', '+02', '1', NULL, NULL),
(2, 'الكويت', 'Kuwait', NULL, 'دينار', 'Dinar', '+965', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `details` text,
  `details_en` text,
  `picture` text,
  `type` enum('1','2') NOT NULL DEFAULT '1',
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `parent_id`, `name`, `name_en`, `details`, `details_en`, `picture`, `type`, `active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'نقى', 'Pure', NULL, NULL, 'uploads/Department/1.png', '1', '1', NULL, NULL),
(2, NULL, 'نقى', 'Pure', NULL, NULL, 'uploads/Department/1.png', '1', '1', NULL, NULL),
(3, NULL, 'نقى', 'Pure', NULL, NULL, 'uploads/Department/1.png', '2', '1', NULL, NULL),
(4, NULL, 'نقى', 'Pure', NULL, NULL, 'uploads/Department/1.png', '2', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `my_favorite_id` int(11) NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `general_departments`
--

CREATE TABLE `general_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_departments`
--

INSERT INTO `general_departments` (`id`, `name`, `name_en`, `picture`, `type`, `active`, `created_at`, `updated_at`) VALUES
(1, 'مساجد', 'Mosques', 'uploads/GeneralDepartment/1.png', '1', '1', NULL, NULL),
(2, 'مقابر', 'Cemeteries', 'uploads/GeneralDepartment/2.png', '2', '1', NULL, NULL),
(4, 'منازل', NULL, 'uploads/GeneralDepartment/1608031543252.png', '1', '1', '2020-12-15 11:25:43', '2020-12-15 11:25:43'),
(6, 'شركات', NULL, 'uploads/GeneralDepartment/1608031821553.jpg', '1', '1', '2020-12-15 11:30:21', '2020-12-15 11:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `details` text,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `details`, `active`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'I have problem to this app', '0', '2020-06-14 13:42:04', '2020-06-14 13:42:04'),
(2, 'test', 'test@test.com', 'I have problem to this app', '0', '2020-06-14 13:42:43', '2020-06-14 13:42:43'),
(3, 'test', 'test@test.com', 'I have problem to this app', '0', '2020-07-05 03:04:35', '2020-07-05 03:04:35'),
(4, 'sdfsdfsd', 'eew', 'sdfsdhjfds f sdf dsf ds f ds fsdf ds f', '0', '2020-07-05 03:11:48', '2020-07-05 03:11:48'),
(5, 'qwewqe', 'qweq', 'qweq', '0', '2020-07-05 03:22:21', '2020-07-05 03:22:21'),
(6, 'ewwtwt', 'wetw', 'wetwetw', '0', '2020-07-05 03:41:47', '2020-07-05 03:41:47'),
(7, 'weqwe', 'qweqw', 'eqwe', '0', '2020-07-05 03:46:20', '2020-07-05 03:46:20'),
(8, 'fdsfdsf', 'sdfsdf', 'dsfsdf', '0', '2020-07-05 03:50:24', '2020-07-05 03:50:24'),
(9, 'wewqeq', 'qweqwe', 'qweqw', '0', '2020-07-05 03:53:38', '2020-07-05 03:53:38'),
(10, 'test', 'test@test.com', 'I have problem to this app', '0', '2020-07-05 14:21:48', '2020-07-05 14:21:48'),
(11, 'ewfwef', 'fwefwef', 'wefwfwf', '0', '2020-07-06 09:02:24', '2020-07-06 09:02:24'),
(12, 'Amir', 'info@alashkarkw.com', 'التطبيق ضعيف', '0', '2020-12-16 17:02:21', '2020-12-16 17:02:21'),
(13, 'Amir', 'info@alashkarkw.com', 'التطبيق ضعيف', '0', '2020-12-16 17:02:22', '2020-12-16 17:02:22'),
(14, 'Amir', 'info@alashkarkw.com', 'التطبيق ضعيف', '0', '2020-12-16 17:02:43', '2020-12-16 17:02:43'),
(15, 'Amir', 'info@alashkarkw.com', 'التطبيق ضعيف', '0', '2020-12-16 17:02:54', '2020-12-16 17:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2020_01_06_122915_create_countries_table', 1),
(7, '2020_01_06_124048_create_cities_table', 1),
(8, '2020_01_06_124125_create_general_departments_table', 1),
(9, '2020_01_06_124126_create_users_table', 1),
(10, '2020_01_06_124127_create_password_resets_table', 1),
(11, '2020_01_06_140902_create_clients_table', 1),
(12, '2020_01_06_154641_create_favorites_table', 1),
(13, '2020_01_06_155056_create_promo_codes_table', 1),
(14, '2020_01_06_155240_create_departments_table', 1),
(16, '2020_01_06_155621_create_promo_code_users_table', 1),
(17, '2020_01_08_081622_create_notifications_table', 1),
(18, '2020_01_08_082744_create_notification_clients_table', 1),
(19, '2020_02_05_122425_create_messages_table', 1),
(21, '2020_04_25_102028_create_advertisements_table', 1),
(26, '2020_01_06_155242_create_products_table', 2),
(27, '2020_02_05_194928_create_reservations_table', 2),
(28, '2020_06_14_050812_create_reservation_details_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `general_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `details` text,
  `details_en` text,
  `picture` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_clients`
--

CREATE TABLE `notification_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `details` text,
  `details_en` text,
  `information` text,
  `information_en` text,
  `picture` text,
  `min_limit` int(11) NOT NULL DEFAULT '0',
  `discount_percent` varchar(255) DEFAULT NULL,
  `price_before` decimal(8,2) NOT NULL DEFAULT '0.00',
  `price_after` decimal(8,2) NOT NULL DEFAULT '0.00',
  `size` varchar(255) DEFAULT NULL,
  `promo_code` enum('0','1') NOT NULL DEFAULT '1',
  `visits` int(11) NOT NULL DEFAULT '0',
  `special` enum('0','1') NOT NULL DEFAULT '0',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `country_id`, `city_id`, `area_id`, `department_id`, `sub_department_id`, `name`, `name_en`, `details`, `details_en`, `information`, `information_en`, `picture`, `min_limit`, `discount_percent`, `price_before`, `price_after`, `size`, `promo_code`, `visits`, `special`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 7, 1, NULL, 'مياة معدنية نقى 330 مل', 'Mineral water 330 ml', 'البيع بالكارتونة, اقل عدد 10 كراتين', 'Mineral water 330 ml', NULL, NULL, '', 10, '10', 50.00, 40.00, '330', '1', 0, '0', '1', NULL, '2020-12-15 11:07:05'),
(2, 2, 1, 6, 1, NULL, 'مياة معدنية نقى 330 مل', 'Mineral water 330 ml', 'البيع بالكارتونة, اقل عدد 10 كراتين', 'Mineral water 330 ml', NULL, NULL, 'uploads/Product/1.png', 10, '10', 50.00, 40.00, '330', '1', 0, '0', '1', NULL, NULL),
(3, 2, 1, 6, 2, NULL, 'مياة معدنية نقى 330 مل', 'Mineral water 330 ml', 'البيع بالكارتونة, اقل عدد 10 كراتين', 'Mineral water 330 ml', NULL, NULL, 'uploads/Product/1.png', 0, '10', 50.00, 40.00, '330', '1', 0, '0', '1', NULL, NULL),
(4, 2, 1, 6, 1, NULL, 'مياة معدنية نقى 330 مل', 'Mineral water 330 ml', 'البيع بالكارتونة, اقل عدد 10 كراتين', 'Mineral water 330 ml', NULL, NULL, 'uploads/Product/1.png', 10, '10', 50.00, 40.00, '330', '1', 0, '0', '1', NULL, NULL),
(5, 2, 1, 8, 1, NULL, 'ابراج', NULL, NULL, NULL, NULL, NULL, 'uploads/Product/1608030862560.jpg', 10, NULL, 0.56, 0.55, '0.330', '0', 0, '0', '1', '2020-12-15 11:12:26', '2020-12-15 11:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `only_user_count` int(11) NOT NULL DEFAULT '0',
  `users_count` int(11) NOT NULL DEFAULT '0',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `country_id`, `name`, `amount`, `from_date`, `to_date`, `only_user_count`, `users_count`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, '123456', 10, '2020-07-01', '2020-07-31', 100, 100, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_code_clients`
--

CREATE TABLE `promo_code_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `promo_code_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `promo_code_users`
--

CREATE TABLE `promo_code_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `promo_code_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `general_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `delivery` decimal(8,2) NOT NULL DEFAULT '0.00',
  `reservation_prayer_hour` varchar(255) DEFAULT NULL,
  `reservation_prayer_hour_time` enum('1','2') DEFAULT '1',
  `reservation_time` time DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `notes` text,
  `promo_code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `bill_number` int(11) DEFAULT NULL,
  `payment_hash_mac` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `payment_statues` int(11) NOT NULL DEFAULT '0',
  `payment_method` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `payment_active` enum('0','1','2') NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `country_id`, `city_id`, `area_id`, `general_department_id`, `user_id`, `client_id`, `price`, `delivery`, `reservation_prayer_hour`, `reservation_prayer_hour_time`, `reservation_time`, `reservation_date`, `notes`, `promo_code_id`, `active`, `bill_number`, `payment_hash_mac`, `payment_id`, `payment_statues`, `payment_method`, `payment_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2020-06-26', 'test test', NULL, '1', 1500, 1612404370, NULL, 0, '2', '1', NULL, '2021-02-04 00:06:10', '2021-02-04 00:06:40'),
(2, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2020-06-26', 'test test', NULL, '1', 1501, 1612404427, NULL, 0, '2', '1', NULL, '2021-02-04 00:07:07', '2021-02-04 00:07:17'),
(3, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2020-06-26', 'test test', NULL, '1', 1502, 1612404472, NULL, 0, '1', '0', NULL, '2021-02-04 00:07:52', '2021-02-04 00:08:10'),
(4, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2020-06-26', 'test test', NULL, '1', 1503, 1612404496, NULL, 0, '1', '0', NULL, '2021-02-04 00:08:16', '2021-02-04 00:08:21'),
(5, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2020-06-26', 'test test', NULL, '1', 1650, 1612404506, NULL, 0, '2', '1', NULL, '2021-02-04 00:08:26', '2021-02-04 00:20:20'),
(6, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2020-06-26', 'test test', NULL, '1', 1651, 1612405235, NULL, 0, '3', '0', NULL, '2021-02-04 00:20:35', '2021-02-10 19:57:46'),
(7, 2, 1, 2, NULL, 2, 19, 0.00, 1.00, '2', '1', NULL, '2021-02-09', 'Test', NULL, '1', 1652, 1612700395, NULL, 0, '1', '0', NULL, '2021-02-07 12:19:55', '2021-02-08 09:54:03'),
(8, 2, 1, 2, NULL, 2, 18, 0.00, 1.00, NULL, NULL, NULL, '2021-02-09', 'تتالل', NULL, '0', 1653, 1612710751, NULL, 0, '2', '0', NULL, '2021-02-07 15:12:31', '2021-02-08 18:04:30'),
(9, 2, 1, 2, NULL, 2, 20, 0.00, 1.00, NULL, '1', NULL, NULL, NULL, NULL, '0', 1654, 1612711015, NULL, 0, '1', '0', NULL, '2021-02-07 15:16:55', '2021-02-07 15:16:55'),
(10, 2, 1, 2, NULL, 2, 19, 0.00, 1.00, NULL, NULL, NULL, '2021-02-09', 'Test', NULL, '0', 1655, 1612778057, NULL, 0, '2', '0', NULL, '2021-02-08 09:54:17', '2021-02-08 09:54:41'),
(11, 2, 1, 2, NULL, 2, 14, 0.00, 1.00, '3', '1', NULL, '2021-02-09', 'Test', NULL, '1', 1656, 1612778158, NULL, 0, '1', '0', NULL, '2021-02-08 09:55:58', '2021-02-08 10:01:18'),
(12, 2, 1, 2, NULL, 4, 14, 0.00, 1.00, NULL, NULL, NULL, '2021-02-09', 'Test', NULL, '0', 1657, 1612778518, NULL, 0, '2', '0', NULL, '2021-02-08 10:01:58', '2021-02-08 10:02:18'),
(13, 2, 1, 2, NULL, 2, 15, 0.00, 1.00, '2', NULL, '14:00:00', '2021-06-26', 'test test', NULL, '1', 1658, 1613575447, NULL, 0, '2', '1', NULL, '2021-02-17 14:37:19', '2021-02-17 15:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_details`
--

CREATE TABLE `reservation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `count` int(11) NOT NULL DEFAULT '0',
  `total_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation_details`
--

INSERT INTO `reservation_details` (`id`, `reservation_id`, `product_id`, `price`, `count`, `total_price`, `active`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 40.00, 2, 80.00, '1', '2021-02-04 02:24:47', '2021-02-04 02:24:47'),
(2, 7, 1, 40.00, 49, 1960.00, '1', '2021-02-07 12:19:55', '2021-02-08 09:48:11'),
(3, 8, 1, 40.00, 20, 800.00, '1', '2021-02-07 15:12:31', '2021-02-08 18:03:25'),
(4, 9, 1, 40.00, 10, 400.00, '1', '2021-02-07 15:16:55', '2021-02-07 15:16:55'),
(5, 10, 1, 40.00, 10, 400.00, '1', '2021-02-08 09:54:17', '2021-02-08 09:54:17'),
(6, 11, 2, 40.00, 10, 400.00, '1', '2021-02-08 09:55:58', '2021-02-08 09:55:58'),
(7, 12, 1, 40.00, 30, 1200.00, '1', '2021-02-08 10:01:58', '2021-02-25 14:45:40'),
(8, 13, 1, 40.00, 4, 160.00, '1', '2021-02-17 14:37:19', '2021-02-17 14:59:47'),
(9, 13, 2, 40.00, 2, 80.00, '1', '2021-02-17 15:00:47', '2021-02-17 15:00:47'),
(10, 12, 5, 0.55, 10, 5.50, '1', '2021-02-25 14:46:34', '2021-02-25 14:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_en` varchar(255) DEFAULT NULL,
  `google_lat` varchar(255) DEFAULT NULL,
  `google_lan` varchar(255) DEFAULT NULL,
  `picture` text,
  `profile` text,
  `profile_en` text,
  `tags` text,
  `tags_en` text,
  `delivery_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `booking_type` enum('1','2') NOT NULL DEFAULT '1',
  `reservation_prayer_hour` varchar(255) DEFAULT NULL,
  `special` enum('0','1') NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `general_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `disable` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `name_en`, `email`, `email_verified_at`, `password`, `phone`, `address`, `address_en`, `google_lat`, `google_lan`, `picture`, `profile`, `profile_en`, `tags`, `tags_en`, `delivery_price`, `booking_type`, `reservation_prayer_hour`, `special`, `visits`, `remember_token`, `general_department_id`, `country_id`, `city_id`, `area_id`, `active`, `disable`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'admin@yahoo.com', NULL, '$2y$10$NfM9D6IF9gCuQPKPRRTaNur617UU4mV0z73kBRPAQEfkPzIReGvua', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '1', '2,3,4,5', '0', 1, '9d7pKMYzFoRUpGW283Y0ofHb8nfT6nYmaq1R0AEtH0Wz6ToD5lVgLnpFoX0B', NULL, NULL, NULL, NULL, '1', '0', '2020-06-14 06:56:26', '2020-07-09 03:28:23'),
(2, 'مسجد السلام', 'Salam Mosque', NULL, NULL, NULL, NULL, 'شارع رقم 20 - المنطقة ب', 'Street No. 20 - Area B.\r\n', '30.1304000', '31.3121706', NULL, NULL, NULL, NULL, NULL, 1.00, '1', '2,3,4,5', '0', 5, NULL, 1, 2, 1, 2, '1', '0', NULL, '2020-06-23 01:38:55'),
(3, 'مسجد الاحمدى', 'Al-Ahmady Mosque', NULL, NULL, NULL, NULL, 'شارع رقم 20 - المنطقة ب', 'Street No. 20 - Area B.\r\n', '30.1304000', '31.3121730', NULL, NULL, NULL, NULL, NULL, 2.00, '1', '2,3,4,5', '0', 0, NULL, 1, 2, 1, 7, '1', '0', NULL, NULL),
(4, 'مقابر العبور', 'Tombs of transit', NULL, NULL, NULL, NULL, 'شارع رقم 20 - المنطقة ب', 'Street No. 20 - Area B.\r\n', '30.1304000', '31.3121706', NULL, NULL, NULL, NULL, NULL, 1.00, '1', NULL, '0', 0, NULL, 2, 2, 1, 2, '1', '0', NULL, NULL),
(5, 'مقابر الفرعونية', 'Pharaonic tombs', NULL, NULL, NULL, NULL, 'شارع رقم 20 - المنطقة ب', 'Street No. 20 - Area B.\r\n', '30.1304000', '31.3121760', NULL, NULL, NULL, NULL, NULL, 2.00, '1', NULL, '0', 0, NULL, 2, 2, 1, 7, '1', '0', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisements_country_id_foreign` (`country_id`),
  ADD KEY `advertisements_city_id_foreign` (`city_id`),
  ADD KEY `advertisements_area_id_foreign` (`area_id`),
  ADD KEY `advertisements_department_id_foreign` (`department_id`),
  ADD KEY `advertisements_product_id_foreign` (`product_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`),
  ADD KEY `cities_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_country_id_foreign` (`country_id`),
  ADD KEY `clients_city_id_foreign` (`city_id`),
  ADD KEY `clients_area_id_foreign` (`area_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_client_id_foreign` (`client_id`);

--
-- Indexes for table `general_departments`
--
ALTER TABLE `general_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_country_id_foreign` (`country_id`),
  ADD KEY `notifications_general_department_id_foreign` (`general_department_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_product_id_foreign` (`product_id`);

--
-- Indexes for table `notification_clients`
--
ALTER TABLE `notification_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_clients_notification_id_foreign` (`notification_id`),
  ADD KEY `notification_clients_client_id_foreign` (`client_id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_department_id_foreign` (`department_id`),
  ADD KEY `products_sub_department_id_foreign` (`sub_department_id`),
  ADD KEY `products_country_id_foreign` (`country_id`),
  ADD KEY `products_city_id_foreign` (`city_id`),
  ADD KEY `products_area_id_foreign` (`area_id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_codes_country_id_foreign` (`country_id`);

--
-- Indexes for table `promo_code_clients`
--
ALTER TABLE `promo_code_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_clients_client_id_foreign` (`client_id`),
  ADD KEY `promo_code_clients_promo_code_id_foreign` (`promo_code_id`),
  ADD KEY `promo_code_clients_reservation_id_foreign` (`reservation_id`);

--
-- Indexes for table `promo_code_users`
--
ALTER TABLE `promo_code_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_users_user_id_foreign` (`user_id`),
  ADD KEY `promo_code_users_promo_code_id_foreign` (`promo_code_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_country_id_foreign` (`country_id`),
  ADD KEY `reservations_city_id_foreign` (`city_id`),
  ADD KEY `reservations_area_id_foreign` (`area_id`),
  ADD KEY `reservations_general_department_id_foreign` (`general_department_id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`),
  ADD KEY `reservations_client_id_foreign` (`client_id`),
  ADD KEY `reservations_promo_code_id_foreign` (`promo_code_id`);

--
-- Indexes for table `reservation_details`
--
ALTER TABLE `reservation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_details_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_general_department_id_foreign` (`general_department_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_city_id_foreign` (`city_id`),
  ADD KEY `users_area_id_foreign` (`area_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_departments`
--
ALTER TABLE `general_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_clients`
--
ALTER TABLE `notification_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo_code_clients`
--
ALTER TABLE `promo_code_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_code_users`
--
ALTER TABLE `promo_code_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reservation_details`
--
ALTER TABLE `reservation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisements_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisements_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisements_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cities_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_general_department_id_foreign` FOREIGN KEY (`general_department_id`) REFERENCES `general_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification_clients`
--
ALTER TABLE `notification_clients`
  ADD CONSTRAINT `notification_clients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_clients_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD CONSTRAINT `promo_codes_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_code_clients`
--
ALTER TABLE `promo_code_clients`
  ADD CONSTRAINT `promo_code_clients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promo_code_clients_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promo_code_clients_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_code_users`
--
ALTER TABLE `promo_code_users`
  ADD CONSTRAINT `promo_code_users_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promo_code_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_general_department_id_foreign` FOREIGN KEY (`general_department_id`) REFERENCES `general_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_promo_code_id_foreign` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_details`
--
ALTER TABLE `reservation_details`
  ADD CONSTRAINT `reservation_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_details_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_general_department_id_foreign` FOREIGN KEY (`general_department_id`) REFERENCES `general_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
