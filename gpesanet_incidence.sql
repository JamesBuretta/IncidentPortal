-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2021 at 10:49 AM
-- Server version: 5.7.34-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpesanet_incidence`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(10) NOT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `md_number` int(100) DEFAULT NULL,
  `grn_number` int(100) DEFAULT NULL,
  `date_received` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `is_dispatched` varchar(2) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_allocations`
--

CREATE TABLE `asset_allocations` (
  `id` int(10) NOT NULL,
  `dispatch_date` varchar(25) DEFAULT NULL,
  `allocation_type` varchar(25) DEFAULT NULL,
  `station_id` int(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `asset_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `vendor_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `vendor_id`) VALUES
(1, 'mikocheni', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `phone_number` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `address` varchar(1028) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `phone_number`, `email`, `address`) VALUES
(1, 'VIVO ENERGY TANZANIA', '+255689508402', 'Walpha.Shaween@vivoenergy.com', 'VIVO ENERGY Tanzania\r\nMandela Road, Kurasini\r\nP O Box 78470\r\nDar es Salaam\r\nTANZANIA'),
(2, 'ORYX OIL COMPANY LIMITED', '+255757203692', 'Octavian.Mpangaya@oryxenergies.co.tz', 'ORYX Company Limited\r\nP.O.Box 9540\r\nDar es Salaam');

-- --------------------------------------------------------

--
-- Table structure for table `customer_support_messages`
--

CREATE TABLE `customer_support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requested_by` int(11) NOT NULL,
  `support_category` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_send_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `title`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Testing FAQ', '<p>This is a test to see if its working<br></p>', '2021-03-04 18:42:51', '2021-03-04 18:42:51'),
(2, 'Noor Testing FAQ', '<p>Welcome to FAQ Section ..testing editing</p>', '2021-03-05 13:42:29', '2021-03-08 06:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `impact`
--

CREATE TABLE `impact` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `impact`
--

INSERT INTO `impact` (`id`, `name`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `incidents_logs`
--

CREATE TABLE `incidents_logs` (
  `id` int(11) NOT NULL,
  `caller_id` int(11) DEFAULT '0',
  `assigned_id` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `impact_id` int(11) DEFAULT '0',
  `status_id` int(11) DEFAULT '1',
  `priority_id` int(11) DEFAULT '0',
  `created_datetime` timestamp NULL DEFAULT NULL,
  `closed_datetime` timestamp NULL DEFAULT NULL,
  `cancelled_datetime` timestamp NULL DEFAULT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closing_comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incident_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidents_logs`
--

INSERT INTO `incidents_logs` (`id`, `caller_id`, `assigned_id`, `category_id`, `impact_id`, `status_id`, `priority_id`, `created_datetime`, `closed_datetime`, `cancelled_datetime`, `subject`, `description`, `closing_comments`, `cancel_comments`, `incident_id`) VALUES
(1, 18, 22, 0, 2, 1, 1, '2021-07-28 15:10:51', '2021-07-28 15:29:37', NULL, 'test', 'test', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `incidents_tracker`
--

CREATE TABLE `incidents_tracker` (
  `id` int(11) NOT NULL,
  `caller_id` int(11) DEFAULT '0',
  `assigned_id` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `impact_id` int(11) DEFAULT '0',
  `status_id` int(11) DEFAULT '1',
  `priority_id` int(11) DEFAULT '0',
  `created_datetime` timestamp NULL DEFAULT NULL,
  `closed_datetime` timestamp NULL DEFAULT NULL,
  `cancelled_datetime` timestamp NULL DEFAULT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closing_comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidents_tracker`
--

INSERT INTO `incidents_tracker` (`id`, `caller_id`, `assigned_id`, `category_id`, `impact_id`, `status_id`, `priority_id`, `created_datetime`, `closed_datetime`, `cancelled_datetime`, `subject`, `description`, `closing_comments`, `cancel_comments`) VALUES
(1, 18, 18, 0, 1, 1, 1, '2021-07-28 13:09:48', NULL, NULL, 'Test', 'Test', NULL, NULL),
(2, 18, 22, 0, 2, 2, 1, '2021-07-28 15:10:51', '2021-07-28 15:29:37', NULL, 'test', 'test', NULL, 'change of Nozzle');

-- --------------------------------------------------------

--
-- Table structure for table `menu_accesses`
--

CREATE TABLE `menu_accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `access_menu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_accesses`
--

INSERT INTO `menu_accesses` (`id`, `user_id`, `access_menu`, `created_at`, `updated_at`) VALUES
(1, 2, '#profile#logs', '2020-12-01 11:10:46', '2020-12-01 12:54:09'),
(2, 11, '#profile#payment_history#manage_prn#manage_licence', '2020-12-01 12:51:58', '2020-12-01 13:13:29'),
(3, 15, 'profile#payment_history#manage_prn#manage_licence', '2021-03-03 16:03:28', '2021-03-03 16:03:28'),
(4, 16, 'profile#payment_history#manage_prn#manage_licence#view_business', '2021-03-03 16:17:16', '2021-03-03 16:17:16'),
(5, 17, '#profile#payment_history#manage_municipals#manage_prn#manage_licence#view_business#faq#manage_settings#view_roles#view_stations', '2021-03-04 07:48:38', '2021-03-05 08:42:55'),
(6, 1, '#profile#manage_municipals#manage_users#logs#manage_faq#manage_settings', '2021-03-04 16:22:58', '2021-03-05 12:25:48'),
(7, 18, 'profile#payment_history#manage_prn#manage_licence#view_business#faq', '2021-03-20 12:03:29', '2021-03-20 12:03:29'),
(8, 19, '#profile#payment_history#manage_municipals#manage_users#manage_prn#manage_licence#view_business#logs#faq#manage_faq#manage_settings', '2021-04-15 10:42:58', '2021-05-13 17:07:22'),
(9, 22, 'profile#payment_history#manage_prn#manage_licence#view_business#faq#view_roles#view_stations', '2021-05-05 15:45:10', '2021-05-05 15:45:10'),
(10, 27, 'profile#payment_history#manage_prn#manage_licence#view_business#faq#view_roles#view_stations', '2021-07-31 00:00:48', '2021-07-31 00:00:48');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_10_140323_create_roles_table', 1),
(5, '2020_11_13_105802_create_municipals_table', 2),
(6, '2020_11_16_123009_create_portal_accesses_table', 3),
(7, '2020_12_01_072640_create_menu_accesses_table', 4),
(8, '2021_03_04_185926_create_f_a_q_s_table', 5),
(15, '2016_06_01_000001_create_oauth_auth_codes_table', 6),
(16, '2016_06_01_000002_create_oauth_access_tokens_table', 6),
(17, '2016_06_01_000003_create_oauth_refresh_tokens_table', 6),
(18, '2016_06_01_000004_create_oauth_clients_table', 6),
(19, '2016_06_01_000005_create_oauth_personal_access_clients_table', 6),
(20, '2021_03_12_134054_create_customer_support_messages_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `municipals`
--

CREATE TABLE `municipals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `municipal_db_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipal_description_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipals`
--

INSERT INTO `municipals` (`id`, `municipal_db_name`, `municipal_description_name`, `created_at`, `updated_at`) VALUES
(2, 'zomba_db', 'Malawi Portal', NULL, '2021-03-05 12:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('01648875205312d33c011a0eb59ef96eaa9afd39d7d9516959529beeb09f28b9989e6d1cfcf0910e', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 07:36:38', '2021-04-08 07:36:38', '2021-10-08 10:36:38'),
('03fd1e25c996307fe56276285978d7878022f503867f927789a0507554b0c1ea7beb84380593cab7', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-27 18:13:14', '2021-07-27 18:13:14', '2022-01-27 14:13:12'),
('05fab6f4ff919765f1255af88ea2570291c96003bc70fa2eb0c970633ace691d0fd29153f3471f11', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 16:30:21', '2021-04-07 16:30:21', '2021-10-07 19:30:21'),
('072c606608811edb21426f8ec1d852814b378be15f720b02157071450c2c830e0ecd4e3e0a4aedd1', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 08:07:59', '2021-04-08 08:07:59', '2021-10-08 11:07:59'),
('07a9b8382f304a5bb4446918d73f4aca1fe81cf62627d493c2f4ee625c9773e3f827f3e45d9d5f03', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-23 19:58:38', '2021-05-23 19:58:38', '2021-11-23 15:58:37'),
('088bf767d9f606c0c14249121f613f5f46e5a785afefc1092eb8b9a350df357b8936696677428903', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 13:51:06', '2021-05-22 13:51:06', '2021-11-22 09:51:05'),
('098996677fb551d2c94b50c5f40e73d13c863be0a2ebfad7f5914626fdeda41dcc33c830255bf818', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 06:02:47', '2021-04-08 06:02:47', '2021-10-08 09:02:47'),
('112399e1375eec64a5ba790478d08d657a0e97a10c48f1b9b1bf7f129892fa46f1853ee118f9f768', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 04:03:37', '2021-04-14 04:03:37', '2021-10-14 00:03:37'),
('127dfbbbb9e4160d6bff656e94b411f8e965b102e748854c63148e95e4ad9eb5885d7eb92bfb75b8', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-31 18:29:38', '2021-07-31 18:29:38', '2022-01-31 14:29:37'),
('171817c0562d363a0553726bbc1773a28cc48e903e185da2d18a30c03ee285ae545aae381ab00065', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 15:58:47', '2021-04-07 15:58:47', '2021-10-07 18:58:47'),
('175f87a4218e742eef382db2ad6effdde184abd40798bb68e33ca4eba76c012639399b29f5b13cf1', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 14:10:21', '2021-05-22 14:10:21', '2021-11-22 10:10:21'),
('176179637ddb6cc7ff5fafa475fa1c9b20246b05ca1bd7b997d9262cfd3441d646308c086da44f3a', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:38:20', '2021-04-07 18:38:20', '2021-10-07 21:38:20'),
('1ae5eca414407c9d82786676cc8de164c24ff8c5671b13056ba6f10dcf7ca872d74916351b022dfc', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-31 20:11:41', '2021-07-31 20:11:41', '2022-01-31 16:11:41'),
('1b50839414731b84084db274d4e317f4f55cf0bd857c71369727d5db6190467daf1180569f7a3bf0', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:15:44', '2021-04-21 23:15:44', '2021-10-21 19:15:44'),
('1bdf6cc31e494e346623a155f7006f4b101f1c395ae038eb893dcabce748d35ad2d756c816228582', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-20 14:02:40', '2021-04-20 14:02:40', '2021-10-20 10:02:40'),
('1f948c99a65200c63c0ca5e447583848f97d605c4d699ee6e869490a34f92abcba7630abbb64a3b3', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-20 14:17:25', '2021-04-20 14:17:25', '2021-10-20 10:17:25'),
('224046252bb48a34a82c529542115c3ea261e28a06b66d4aed08b1b89d0c525a8439de2bbcc86a7e', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 07:26:00', '2021-04-08 07:26:00', '2021-10-08 10:26:00'),
('22c16dd6cc9da0c8daab62b210a6fd5c8734a9085f9f99bc8abd89111b22c6d79568f81782d32b2b', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:38:16', '2021-04-21 23:38:16', '2021-10-21 19:38:16'),
('246a5c434d27bcb1154a8645e5f206aa8011d98f8a93f2607274897d1b2aa1d6745389928b781907', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 07:54:41', '2021-04-08 07:54:41', '2021-10-08 10:54:41'),
('2612d5874425fd315100344e29588339c1245e9f5f1f4fe00a9392ec839003ea70de0d4284acad79', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 16:00:21', '2021-04-07 16:00:21', '2021-10-07 19:00:21'),
('27a29357e316bc68795b1a76c4c14d8b8ddce6a771fedea7ef9f0a5842551a9d5ef5ffe93c3fdf60', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 03:43:17', '2021-04-15 03:43:17', '2021-10-14 23:43:17'),
('292b7943601e1bcca9d5acf5a3f03a18ccdd675a6e12000e8ff7e3826f78751869cd2cf76a8cbbf0', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 04:13:33', '2021-04-14 04:13:33', '2021-10-14 00:13:33'),
('29543ac87fd246797a2064f1177c3da2a0f3148920ea92d3c922c18d945941326db3d9d79b66b9e2', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:50:33', '2021-04-08 05:50:33', '2021-10-08 08:50:33'),
('2b164599903913e6194a58e3b2f13b0522930a994ac685ea25ece8eb92ba679985f75abd5574d934', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:30:24', '2021-04-21 23:30:24', '2021-10-21 19:30:24'),
('2d56d178348268466bf2abfebe8079ea42677693021242d938fe2b1ef5495e6eb8d943a3f9614def', 20, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-12 01:53:59', '2021-06-12 01:53:59', '2021-12-11 21:53:58'),
('2fff366900b643d3cbd3a721077ac522fea7c50ca4715247550715ac3ff35fca3ee232caa4030f84', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 14:13:50', '2021-05-22 14:13:50', '2021-11-22 10:13:50'),
('32278c99420a2cb7fb714333c6e80315e45f539236ad51b47a91e8099edf98bf56ef13eb5057abf8', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 05:05:44', '2021-04-15 05:05:44', '2021-10-15 01:05:44'),
('32c67dd478ba8c2f982831d51792bc9425d38c3e892de24797a5bc93fc5bfa0c6f4fa3d39cda096c', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 07:19:15', '2021-04-08 07:19:15', '2021-10-08 10:19:15'),
('33ad43961ddb33b61e19f8c4843cf09f7530a22d4c38817b86517dfc351b6463c44e6e480e158906', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:05:19', '2021-04-15 04:05:19', '2021-10-15 00:05:19'),
('3655d973390f750c0bcdcf1010cf9836440fd4a4159667de39542ea3b5e4ea833bb85dfb0cb095e6', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-20 03:45:00', '2021-05-20 03:45:00', '2021-11-19 23:44:59'),
('3870430c777f7bdf1fc38b326317d2bc978381c779408b380e40e65d313738e380240b6cad954be8', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 17:07:54', '2021-04-07 17:07:54', '2021-10-07 20:07:54'),
('38cfda7b40b906f748b301f9f80b968032e25883203e29e43a04ac8250d2248c5433ac8bd4557143', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:52:17', '2021-04-08 05:52:17', '2021-10-08 08:52:17'),
('3d84277a0c47493c883df1ba876e27ac1d65c8e529beadbd2838c284607b1fbb5d7af2e31d1fae02', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 00:09:10', '2021-04-14 00:09:10', '2021-10-13 20:09:10'),
('3dee1f4f15f8f38ca8acdc2e7788ea111631a4242da77b34d07ca77011b058779e4c1e208ea19b62', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:16:07', '2021-04-07 18:16:07', '2021-10-07 21:16:07'),
('3e8efe6d07c526d5780741e9066c8d950778e5e288bc421683a4033259f0e0f8d67f368bb932fe23', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-15 10:59:14', '2021-05-15 10:59:14', '2021-11-15 06:59:14'),
('45affd5953b9ff8d50bde35fd14770b2bc0ef67e33fd5bcb7bda4b1bf3c7cd67a2b409007b781c6b', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:30:01', '2021-04-21 23:30:01', '2021-10-21 19:30:01'),
('497eb98305ce9f1d40820bc98edcf1117ba2d77818aa99fc81296f6ae984b5cacdcf4bf526791055', 20, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 20:37:38', '2021-06-13 20:37:38', '2021-12-13 16:37:38'),
('49da331b2bdda3f565549f479132b03adae0be5f8327e3869a02a09cba5855762aa06a4f7eadd67b', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 18:17:14', '2021-06-13 18:17:14', '2021-12-13 14:17:14'),
('4c1495dc763321c5f48221acd2dd9e7661e0d59d9114bd623a4827eb81bd459a5181505102781d28', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-28 14:32:38', '2021-07-28 14:32:38', '2022-01-28 10:32:38'),
('4e6d02e7995f7c7688c39747cc16a784e7fcb4f8aed182cd6415af884f4f5a16faa9b934c1036dd2', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-15 18:04:55', '2021-06-15 18:04:55', '2021-12-15 14:04:55'),
('4edbe54f03d40298acf2fefc8faf1136442ab12cc8f49019a121bb3f07fd99e5bed6d229c1ebef6f', 21, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 17:58:36', '2021-04-21 17:58:36', '2021-10-21 13:58:35'),
('4f462407e99ce46667c5f892cdf28b2e8589c9b44b77fbc20a70b2945fc2d384d84447ceaa8dae20', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-22 16:06:39', '2021-07-22 16:06:39', '2022-01-22 12:06:38'),
('52bae131bffed9c660654096a05c4a37370942d015fab988fc433a7590245c7ffc7c093491993b70', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:55:47', '2021-04-21 23:55:47', '2021-10-21 19:55:47'),
('545b4daadaf51bb4a948c7403c89f2d54e3be311bfc9eb28240f04501454cce3ea5faa23fa4fc8a1', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 14:24:54', '2021-05-22 14:24:54', '2021-11-22 10:24:54'),
('5a02454fb3266f6ac98ea5a30e5a677491e84ce5f735904d872d7dd488595bbbd3491e75523df385', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:44:27', '2021-04-21 23:44:27', '2021-10-21 19:44:27'),
('5aab5c14407098865a955ea3fcecc9bc6e5ce55eda84f4589cb526f86d4854a03fa76fb256d6a28f', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:21:03', '2021-04-21 23:21:03', '2021-10-21 19:21:03'),
('5c132447fd0e1ed9eb18906ff7846179c4766ebf30df47c26c2029cdd758de8174f8ef7687fc6640', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:57:10', '2021-04-08 05:57:10', '2021-10-08 08:57:10'),
('5c27a571da7d9ea1746a2836e562292e4dd062af39d5254044401bc55a48e65bc3c3f39d5f10d9ea', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:48:43', '2021-04-21 23:48:43', '2021-10-21 19:48:43'),
('5d51845d8c611603e61d00ec6b72a218339738565e130435759f962ca951a1fe73545389f2896973', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 18:22:24', '2021-06-13 18:22:24', '2021-12-13 14:22:24'),
('5e38f9ef645b556631ef3f1ac59a7ed714b39077733434dd872dcff9d148577386081de5fdac4c0c', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:45:55', '2021-04-07 18:45:55', '2021-10-07 21:45:54'),
('5e6393ec129ff382f4941847cc0495c993d2481469b8ba94c0b646c1edb5f69fd9954b60c148ba5b', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:51:02', '2021-04-07 18:51:02', '2021-10-07 21:51:02'),
('6444d5491c89e77f5a64fb6a86d6b7ae88b844d8ef0df565ee81731b572ba6ec44c783131876aafe', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 17:55:53', '2021-06-13 17:55:53', '2021-12-13 13:55:53'),
('649ab304f94d035228ef7973b2d31281a9e124a079f96ce2d3886dda3e9997b98c6a4ce3360b1c52', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-28 13:09:20', '2021-07-28 13:09:20', '2022-01-28 09:09:20'),
('64ddf371fdf54016df79089bc257b9bc0dc847e50f462ba097365892905ccb896920db4927aa9a33', 20, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 18:21:47', '2021-06-13 18:21:47', '2021-12-13 14:21:47'),
('66448fca598b76779572dd8ed9ce7699c4077fab912569f950931224fb3b904abfa41aff83aa5660', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 03:39:54', '2021-04-15 03:39:54', '2021-10-14 23:39:54'),
('66f253479e9a3e6432023745ad243acbbda7aa66a21b2fceb12020f971758e5d946594c73d17eecc', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:58:55', '2021-04-08 05:58:55', '2021-10-08 08:58:55'),
('676b19f60bc5d6a05a6daaa3d398d4b8a57b33474cb39dc6c7542f88c4137aa936a0d27a98382067', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 19:27:37', '2021-06-13 19:27:37', '2021-12-13 15:27:37'),
('6d57a8cb0600ed46eb222d5bae08d282ea7aac57968120a38961d94d2b357d16270701169da4a867', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:35:49', '2021-04-21 23:35:49', '2021-10-21 19:35:49'),
('6e4ad23abfbd4faa8bfe353f37419c31ea19655ff8497aeedb84381d02fa6beb1079509749fbb148', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:32:37', '2021-04-07 18:32:37', '2021-10-07 21:32:37'),
('72fbc060de15fb93622791d46198cba82e0d991bf3957410398221df6598eb0cd54063bb1e377866', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 20:41:05', '2021-06-13 20:41:05', '2021-12-13 16:41:05'),
('74811dcb8b3a1bf75d90f829fd85ef172b2d26abb33a73b36302fcc0fc9ca547be6eee6239a784ff', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 20:39:38', '2021-06-13 20:39:38', '2021-12-13 16:39:38'),
('74fae8de570ba358ae4a39a5b40791cd487ca4c500f63ded3aac9373c7ff7ad5a7d2452c4b4f3778', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-20 13:21:52', '2021-04-20 13:21:52', '2021-10-20 09:21:52'),
('76e137d5ba20e3bb338d2d69b7d030d4d330cc67d3335211e2b0b03b7879d62d2b64da2bbb318886', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-21 23:21:05', '2021-05-21 23:21:05', '2021-11-21 19:21:05'),
('7846027e67a42af99701e3b984b4d50c39c9f96ae4fb1bc0c6243bedfaa7a0efe8aedb0ecdad9b86', 23, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 19:09:51', '2021-06-13 19:09:51', '2021-12-13 15:09:51'),
('78a2dec74da18b5927e3fc260c11e9db261303975487e620394205e1d5691ec41d5608ce00ed35dc', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 06:04:16', '2021-04-08 06:04:16', '2021-10-08 09:04:16'),
('78eca910a401460651c89d6bef6d57ca23986551eeec49f63a391a0d1cda0b73f298044b10e928f7', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 06:15:11', '2021-04-08 06:15:11', '2021-10-08 09:15:11'),
('7a6b82f9d7d4c11740d2a29bfaa01ec13518636ebd005cd6dc2537d1c31fa35045a7561273d3fd6d', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:54:59', '2021-04-21 23:54:59', '2021-10-21 19:54:59'),
('7bd47cce606f13224a0f9be60a62bd9a86b7ad834fff6be8767c0d4dcc0c934c98283af42be4d95b', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:30:21', '2021-04-15 04:30:21', '2021-10-15 00:30:21'),
('7cda44e7da05aca8ede66da317479e7db211dd8bff57fd5805cc3cf1354c950efeda81e7f29a0fe3', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 06:12:35', '2021-04-08 06:12:35', '2021-10-08 09:12:35'),
('7e1551be230a249a04ab9c6aa5075b5a0454158c83d92813c3e6458c438dc4c14dfe8692788beb34', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 16:28:50', '2021-04-07 16:28:50', '2021-10-07 19:28:50'),
('7fa2c26afccf226cf33833281cc635c8af90a897adce67bab22b797e5f2ce67ed26aaf3b0621ff7e', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 14:08:00', '2021-05-22 14:08:00', '2021-11-22 10:08:00'),
('81b430d18368cc44492d83ac99fafdbb59a0d37fb9e769f662136afb328e0f5d90d7c4c30316f3f0', 20, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-20 14:07:52', '2021-04-20 14:07:52', '2021-10-20 10:07:52'),
('84d3a83c3980374296625c010711498e51b1b9b30d030a469e7eb10ef33d1703f869b3421629556e', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 18:15:12', '2021-06-13 18:15:12', '2021-12-13 14:15:12'),
('850a7bdfb90ac1393a3c01779814095891f2df8d3b08a989cfff11eb032b74f79eb890c52fc090d0', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 06:07:54', '2021-04-08 06:07:54', '2021-10-08 09:07:54'),
('852e9e8c7574d5395a287b2afab85839b8652e7771ceb81131df9462530c41556c2d1fb61a9f45ef', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:54:10', '2021-04-15 04:54:10', '2021-10-15 00:54:10'),
('865cb932a282c336bf1c14a7d52cf78857138f0e0090eea337dda1250a4312998eb78dc3c5b80540', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-20 14:20:46', '2021-04-20 14:20:46', '2021-10-20 10:20:46'),
('87cba6d12166e6f088f1b9bad70fdb13f72c38574c564a7575e4d04f4bb227f9259ab87bd6489d4b', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-13 17:51:31', '2021-05-13 17:51:31', '2021-11-13 13:51:30'),
('8b1d67781db1bde286a4eee53990247298a266d1d10b9674ff43bcb21c3b9bd4271e0ea2ab6a72a3', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-31 01:05:12', '2021-07-31 01:05:12', '2022-01-30 21:05:12'),
('8c98d5eb3faa3f0af6b2e709e9753a965d7a0856bc132ea495a7f57ff53d1346ddbcd1eeb2524f9e', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:48:12', '2021-04-08 05:48:12', '2021-10-08 08:48:12'),
('8e7759d6156a58c9fcdf41ee41c298a526c48e43c4a0006a2a8f06fceebf97923c1ac195f8e6f993', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-20 13:27:57', '2021-04-20 13:27:57', '2021-10-20 09:27:57'),
('944e8cc4c656805c14987c8bce7581f7ce23b1e71487ccd78216101f129585a82c4202a7f62d0d53', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:49:50', '2021-04-21 23:49:50', '2021-10-21 19:49:50'),
('9707251d11c36429e3b65b1c393029c4c9824fdcbb0848fc3e19dfd6a12cbd56ce4d890e91c48ef9', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 15:58:07', '2021-04-07 15:58:07', '2021-10-07 18:58:07'),
('9a8ab2d300cb41aa97939e5fe513c991ce6e01b15712499b4bd8911e61cb014d928a5bb705140806', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 16:29:15', '2021-04-07 16:29:15', '2021-10-07 19:29:15'),
('9c4993f20f248d5d833df9c088ec41887f5f3edc3c4ed848fe5056140d466bc983c39941f3d8f0b9', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 03:08:37', '2021-04-14 03:08:37', '2021-10-13 23:08:37'),
('9ccaa825fd2a2d487a04e29d293d844834ce5073e88e82bebd2e5d4ebf3860c20397e76ac37e3d5c', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:33:57', '2021-04-15 04:33:57', '2021-10-15 00:33:56'),
('a43b482464dc29bfa98d83e33ab44b26cd61868f785bb76172ff857fa06310ae58502b9859231f51', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-15 18:05:29', '2021-06-15 18:05:29', '2021-12-15 14:05:29'),
('a5ec485e9ea03ec9250b05b546d850ad89d96eeb10bf90a6217affdcbe0e796d18cbb067648de09d', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-31 00:12:43', '2021-07-31 00:12:43', '2022-01-30 20:12:42'),
('a6762d9ce60d9d5ff3c3fa62789e12c6707ad691d8d1c01c5f925ab955c4c1188ba85bc0f0739d88', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 17:57:32', '2021-04-07 17:57:32', '2021-10-07 20:57:32'),
('a70f1797c2a5753d8126970123f31a5c83d0b4cbd590fb0dbcdb80e66dfec9557f92c9d5a39317d7', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-28 15:09:30', '2021-07-28 15:09:30', '2022-01-28 11:09:30'),
('aa2836fbef8ca583a6485398ad75403705ae7d496a369aac522988ad282c63bfbb4c354d5a9cf0e1', 20, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 19:26:15', '2021-06-13 19:26:15', '2021-12-13 15:26:15'),
('aade8dcc5c43c356112b0d65dc2ede6f18e7fa8ac88551874577abbc1cf2cb0f0d091c1b4991e220', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 03:22:02', '2021-04-14 03:22:02', '2021-10-13 23:22:02'),
('aee4c1bd9bad440562da1bf576d45fd4d4c62a245e6d80cdf54059fca485c547257c637042c37190', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 17:58:19', '2021-04-07 17:58:19', '2021-10-07 20:58:19'),
('af01ee2876bfd83e8853dc89319543a5f6d6311317be81d2cfbb25f88115326fac4bf4ac87f23175', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 04:17:52', '2021-04-14 04:17:52', '2021-10-14 00:17:52'),
('af26a8f4a716f97719b00d12ec889afeefb51359908e18db712201916705db2c4c29e81b504e212a', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:04:28', '2021-04-07 18:04:28', '2021-10-07 21:04:28'),
('af3550fe983ac602e35bd7677f895a5b5e73a4772e4ac3466e9be43e2b15ce11304e8bc9f49c9d9c', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:07:18', '2021-04-15 04:07:18', '2021-10-15 00:07:18'),
('af75c30e37d4044ce0d4a8aa60185d5271cd98edcb2b50a3e31c11e8a10b64fe9f3b1dc61845e904', 20, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 18:17:51', '2021-06-13 18:17:51', '2021-12-13 14:17:51'),
('b2e9042ce6a2e3901b53d0391686695a0f749f6076b843bfeecfd302605652813f9cc3f74f754f65', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 04:00:28', '2021-04-14 04:00:28', '2021-10-14 00:00:28'),
('b3b6506f62ac8d96b768c2b2280130da52c12912c0fc93b977113ea75c4ad1b547ae2b36e66347ef', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 05:00:30', '2021-04-15 05:00:30', '2021-10-15 01:00:30'),
('b6925abd17f05f9f51d0284082b55caace65b14e2e3c2497d28714b90a940becb33e4c4d25ee8d0a', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:53:33', '2021-04-08 05:53:33', '2021-10-08 08:53:33'),
('b6ef782c64c34a1ea1f90094ac9c9032b4071a11ae23b9fa4325e152a572c4bc3d8998b35167b6c0', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 20:35:33', '2021-06-13 20:35:33', '2021-12-13 16:35:33'),
('b7ae032f3b74e8ea70aad5b620f97b45d3c003a8f200507edea6508e19c52865dbda2c54cf0b6be5', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:40:56', '2021-04-15 04:40:56', '2021-10-15 00:40:56'),
('ba49fee3912e3c8817befff5ff8624eea389a7fed160a794865d1523a033e80b928ab7ceeaa44d3d', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-21 23:57:03', '2021-04-21 23:57:03', '2021-10-21 19:57:03'),
('bd5c6758c46421fd2e46463621e0c085e73e0c020de5c10edfd8c985f5bf3aad34120d0cfee24210', 23, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 19:39:36', '2021-06-13 19:39:36', '2021-12-13 15:39:36'),
('bedd4cedfd5db151e2052edeb22e073009c4bc678d4da8f2bd4e2ef7974ee49cd4701b0836816856', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 16:34:09', '2021-04-07 16:34:09', '2021-10-07 19:34:09'),
('bfda77820fbd389864f039ad1a8e3f8a0c7099301450110e267c7784e0383ce4e66b5cc4cb2e7a71', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-13 15:04:51', '2021-04-13 15:04:51', '2021-10-13 18:04:51'),
('c02254b0200e6a82055ae64d8f7bfe9b0b5f1182d73659dce63d334e1f7602c0b767ec85b41132c8', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:13:32', '2021-04-15 04:13:32', '2021-10-15 00:13:32'),
('c33d9ee9cf978fa696c0035a44b00042ffd14e37005666f1c2e4674ae4102829306fbd5e4e17ced4', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:00:06', '2021-04-07 18:00:06', '2021-10-07 21:00:06'),
('c4eebe48796ba24cffc6bf13635683b48023a7697941e8094e6dc955175cb55f2e2432000d94b848', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:11:27', '2021-04-15 04:11:27', '2021-10-15 00:11:27'),
('c53bd08975bf9be34e7bbbc3cea5cc0c9a341857b8b3fa443f165472de43d330746c4a45bf1c50a2', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-14 03:52:08', '2021-04-14 03:52:08', '2021-10-13 23:52:08'),
('c9860f26f047a49144aecdf3672de828e010611ace8eea1a2a521e2be01ec74bc5178bf942a3d7b4', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 13:52:52', '2021-05-22 13:52:52', '2021-11-22 09:52:52'),
('c9e148cbc8c48b43277f88a5e7e0dc590113a0540bc236b31611194ea9d1442bc03b0ed914b3d1f7', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:46:13', '2021-04-08 05:46:13', '2021-10-08 08:46:13'),
('cb1f4ccf7cd1f1ebcd862e0de023f82b22c09314cce7e13daa9926bf01b1af9c95fbad26c1bc06d3', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 05:55:38', '2021-04-08 05:55:38', '2021-10-08 08:55:38'),
('cba3aa037f7c59023dec5074feae2ae011be93a2b1e69614deeb5968b89de7ea6625b3d4cfec9c78', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 17:52:36', '2021-04-07 17:52:36', '2021-10-07 20:52:36'),
('d0c5fe68fe42cc4dd1be3bb6e08bf0fe62614e603bfe1d08c7aae31af2262ce9a537d3fe3570bbc9', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-23 14:04:41', '2021-07-23 14:04:41', '2022-01-23 10:04:41'),
('d0d18d6aacc186fdc38b1800852a67046cf9da71969d36ae4d00a0cf01ddba0cd83e59bfadaab88b', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 07:57:53', '2021-04-08 07:57:53', '2021-10-08 10:57:53'),
('d10dbbbce128024a6ab98b50cd06c2ac60433d06ea0856359148fe3cd152572ef670f6459e04883c', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-28 13:10:53', '2021-07-28 13:10:53', '2022-01-28 09:10:53'),
('d1dc04e6fac4c65333a34197f7cf1ece5177567cec0e7d104045f655325aae809214a4dcb803e155', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 17:55:11', '2021-04-07 17:55:11', '2021-10-07 20:55:10'),
('d259687fe7a2b38169c49e1b9b5c4fa7fe5b4ac1e2717a743774b1587aa5a19085b0bfb5861163d4', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 06:00:47', '2021-04-08 06:00:47', '2021-10-08 09:00:47'),
('d41e4a84f0d09854c81c954a01461abd165b07c6f6be70759febfbe58a8e27fdf8ca1b32ece4d2bb', 23, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-14 14:11:51', '2021-06-14 14:11:51', '2021-12-14 10:11:50'),
('d41f4e663a991c09c4ca1a0aa1216017e18da4d42f254085a69549761380319b499cc4e49b4aa297', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-14 00:09:17', '2021-06-14 00:09:17', '2021-12-13 20:09:16'),
('d6834984447808de9d588672c1375829dcefd50c322af4784e8c4213d6e4c2f8c7c04ee3600b11b5', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-16 01:09:54', '2021-07-16 01:09:54', '2022-01-15 21:09:53'),
('dc327cce5e9060b37acf2a03d2b8114064f11e0c2b762c1366ba8b0b11d1b9e22ee29d17282d315f', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-28 15:12:17', '2021-07-28 15:12:17', '2022-01-28 11:12:17'),
('dc9c4e60a1e6f6775fc912480d4be12042b81964ea573222ec15bb4a5089ef78d6272c87f122ca18', 24, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-27 18:23:04', '2021-07-27 18:23:04', '2022-01-27 14:23:04'),
('dd6e194aa14cf6c998fe559b0161abbf2ebac43830d8e5aea9ef90b857021741dcd83a08045d2461', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:57:18', '2021-04-07 18:57:18', '2021-10-07 21:57:18'),
('ddfd48c085162aab47fbd625970918ed882e8ca399b4637d688064b7b238eb1329131bbfb57a4652', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-08 08:02:50', '2021-04-08 08:02:50', '2021-10-08 11:02:50'),
('de9e5876268b18cffafa95a4f90cdb185325338119924684089ccbe988cd3301ac384468e3663fba', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-06-13 17:34:10', '2021-06-13 17:34:10', '2021-12-13 13:34:09'),
('e2fee727fbeb612702393e9e0d2a70ecd7d1c30494ceac391970fc3ec0f8c25d701b3036d5047528', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:52:00', '2021-04-15 04:52:00', '2021-10-15 00:51:59'),
('e75cb37b0dbff5f1258e6f945e6650bd7226b4f39ba343291bf23e8dc0519c2fd44b5b4e9518994c', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-15 11:56:52', '2021-05-15 11:56:52', '2021-11-15 07:56:52'),
('e9d9787e7f8f3615dfd5b6d40eed7821469944d91a5640f640e35f2b54dbe95d98764370eace2bff', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-05-22 14:20:11', '2021-05-22 14:20:11', '2021-11-22 10:20:11'),
('efa6fa0f7e099ed0951b52c11526f66c416f0d11da9520a196d9fd1689c1f824df76367b49bbf30d', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:13:12', '2021-04-07 18:13:12', '2021-10-07 21:13:12'),
('f0937845e1bd4e7e418445b6e07e77bc1e0729ccfe6622e66b989af04b456e37c2e70bc0bade970f', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:53:28', '2021-04-07 18:53:28', '2021-10-07 21:53:28'),
('f4214be63f89a25c3043cc4c9a7a86a55f1244355a32264417b4f5f4098cfca44f39fec37a8ef202', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 16:38:07', '2021-04-07 16:38:07', '2021-10-07 19:38:07'),
('f6c6873e665b547e88940b6c25af4e5f4a2586f2ec23966963dfbf63c10bfab9e96d166e1494b0a8', 22, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-07-28 14:33:07', '2021-07-28 14:33:07', '2022-01-28 10:33:07'),
('fa0c2bf85fab8665a04d2f053b19ab0203d9993e0a9910e152b5393d741e8c2c6d9ae63f2df2e4bc', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 18:18:41', '2021-04-07 18:18:41', '2021-10-07 21:18:41'),
('fb1ceb03bde7e60a63e45c99e872e633c63514066e5a1e14c8c79451d32b8e16cf000f91b2c09c79', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-07 17:00:59', '2021-04-07 17:00:59', '2021-10-07 20:00:59'),
('fcdf165529c947ef14e2ca0a25d37abc5ba085ef1a2e18c812687d7e65aa7e772db1b8ddb7edd36a', 18, '930d4db8-75c8-49c3-be6f-fee18591e4a0', 'MyApp', '[]', 0, '2021-04-15 04:22:56', '2021-04-15 04:22:56', '2021-10-15 00:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
('930d4db8-75c8-49c3-be6f-fee18591e4a0', NULL, 'Laravel Personal Access Client', '29eQZImfJUSbbP2bR1ECBQL3cLGbUGsFK5Z7NM2e', NULL, 'http://localhost', 1, 0, 0, '2021-03-27 10:57:57', '2021-03-27 10:57:57'),
('930d4db8-799e-4174-98af-49bf4c5144f3', NULL, 'Laravel Password Grant Client', 'f9il6RoLQf3Yhx5WRreNvCOUjK4rb1gy31J1bpYA', 'users', 'http://localhost', 0, 1, 0, '2021-03-27 10:57:57', '2021-03-27 10:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '930d4db8-75c8-49c3-be6f-fee18591e4a0', '2021-03-27 10:57:57', '2021-03-27 10:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `portal_accesses`
--

CREATE TABLE `portal_accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `access_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portal_accesses`
--

INSERT INTO `portal_accesses` (`id`, `access_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, NULL),
(2, 'user', NULL, NULL),
(3, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `name`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', NULL, '2021-03-31 04:02:17'),
(2, 'dealer', NULL, '2021-03-31 04:02:26'),
(3, 'manager', NULL, NULL),
(4, 'technician', NULL, '2021-03-31 03:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `longt` varchar(255) DEFAULT NULL,
  `latt` varchar(255) DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `name`, `phone_number`, `email`, `longt`, `latt`, `company_id`) VALUES
(3, 'Masaki Service Station', '+255714520209', 'engenmasaki@gmail.com', '39.276319', '-6.755174', 1),
(2, 'Mikocheni Service Station', '0684536789', 'tarimofreddy@gmail.com', '39.25929', '-6.765928', 1),
(4, 'Goba Service Station', '+255742423090', 'goba@rashalpetroleum.co.t', '39.211052', '-6.714192', 1),
(5, 'Mbezi Beach Service Station', '0787100000/784298531', 'demasare@gmail.com', '39.211052', '-6.71419', 1),
(6, 'Ubungo Service Station', '719172517', 'engenubungo@simoil.co.tz', '39.215002', '-6.795584', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Un-attended'),
(2, 'Closed'),
(3, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Internal'),
(2, 'Client'),
(3, 'Dealer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `tpin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `station_id` bigint(20) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `access`, `fullname`, `profile`, `tpin`, `phone_number`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `station_id`, `type_id`) VALUES
(1, 1, 1, 'Super Admini', '1614962676.jpeg', '-', '0767064878', 'admin@citizenportal.com', '$2y$10$JvkVRx4ooU9gkF7j743HQuzVyZU4yp7lV1bl.jOstTg82yRW5UXR6', 1, NULL, NULL, '2021-03-05 13:44:36', NULL, 0),
(2, 2, 2, 'Godson Mandla', '-', '123', '+1 (985) 329-5735', 'godsonmandla@gmail.com', '$2y$10$Mbb3YYEizAOC2vhbPijrJu9wAjxjtrcYlk9wa4fF.rGajlY9.nSKS', 1, NULL, '2020-11-12 06:52:38', '2021-03-04 06:28:55', NULL, 0),
(17, 2, 2, 'Portal User', '1615777659.jpeg', '232343', '255768064878', 'user@citizenportal.com', '$2y$10$kwCuQl4ZkD9EzIPoxsjTsevX6/JhL7nEBk7EnZPVwbN2iBK/jsCL6', 1, NULL, '2021-03-04 07:48:35', '2021-03-15 00:07:39', NULL, 0),
(18, 2, 2, 'James Buretta', '-', '-', '0683542710', 'jamesburetta39@gmail.com', '$2y$10$Xr/DZm.H1fWCICg5YrKa5O3nyHGqETeZ1Z.MuDMQE8mo.EfgJ.jqm', 1, NULL, '2021-03-20 12:03:16', '2021-07-28 13:10:35', 1, 0),
(19, 2, 2, 'Salim Ahmad Bakary', '-', '-', '0685344465', 'sab@simbaoil.com', '$2y$10$sJmFky9OOaO8ZyRuknCrWu.4sgmA87dR33z0SH9zxeVLathQXXoqm', 1, NULL, '2021-04-15 10:42:53', '2021-04-15 10:42:53', 1, 0),
(20, 2, 2, 'Jerome Jerome', '-', '-', '0769787256', 'jerome@gmail.com', '$2y$10$fX3w98s./O4tVOMamRnyC.UhxlAxiHBzUOq3xF.PODdc5Ejsq4JnG', 1, NULL, '2021-04-20 14:06:00', '2021-04-20 14:06:00', NULL, 0),
(21, 2, 2, 'Gema Buretta', '-', '-', '0713562372', 'gema@gmail.com', '$2y$10$l3W8et2l6ZRqc8qn5U7IR.CIR19Xs6l2AG0p97eM4WQZmWVx.vVqy', 1, NULL, '2021-04-21 17:58:16', '2021-04-21 17:58:16', NULL, 0),
(22, 2, 2, 'Denis Kawishe', '-', '-', '0766000938', 'denis.kawishe@simbalogistic.co.tz', '$2y$10$yiRICiuRtV2ieuC0kFUxMOeoET8fzPfo6Eh3gJnigleqjPQ89ehbG', 1, NULL, '2021-05-05 15:44:55', '2021-05-05 15:44:55', 1, 0),
(23, 2, 2, 'Kulwa Kiwanga', '-', '-', '0713295946', 'kulwa.kiwanga@simbalogistic.co.tz', '$2y$10$B7EFWK90rW97pisgWOzul.hqMcT/.mAlNJFFv6F2WMGJm/AFZdEmC', 1, NULL, '2021-06-13 19:09:31', '2021-06-13 19:09:31', NULL, 0),
(24, 2, 2, 'David Ndelwa', '-', '-', '0677222600', 'david.ndelwa@gmail.com', '$2y$10$KnFJIXSaDouFUzxV7WzV4uDt11lAK1tqM4nF4xV0Ab6UWB4vqmE2y', 1, NULL, '2021-07-27 18:22:35', '2021-07-27 18:22:35', NULL, 0),
(27, 2, 2, 'Dorine Mvungi', '-', '-', '0784702907', 'dorine@gmail.com', '$2y$10$S823wn0eA3q7YaFuhkkPeOPEISeX6vf64PkRnx1R8axFEpXzCZnnS', 1, NULL, '2021-07-31 00:00:32', '2021-07-31 00:00:32', 3, 0),
(28, 1, 2, 'J J', '-', '-', '0683542766', 'j@gmail.com', '$2y$10$HMlVy6sWLu61RmhYf9Fj9eSijzHoBZbyiGg4RpYmF5HKCOFjhCK0K', 1, NULL, '2021-07-31 17:40:16', '2021-07-31 17:40:16', 3, 0),
(30, 1, 2, 'J J', '-', '-', '0683542761', 'jj@gmail.com', '$2y$10$D7c3zO091v.0JYr2Cvm1sez45irqQfr4vAPz0S7kK5c.0MWbrf3ci', 1, NULL, '2021-07-31 17:59:45', '2021-07-31 17:59:45', 3, 0),
(31, 2, 2, 'Dorine Mvungi', '-', '-', '0759638239', 'dmvungi@jj.com', '$2y$10$68xDrQUbffsvXOlOdiC2weBFLPe3cgxkms6moWVBhF5z20Pd/bqde', 1, NULL, '2021-07-31 18:01:22', '2021-07-31 18:01:22', 4, 0),
(32, 3, 2, 'luqman salim', '-', '-', '0714520209', 'engenmasaki@gmail.com', '$2y$10$2J0FyonLw6LDGpBTdwS7qupx4l3xohuOPfX25V2fCwujEQrAl0Ti6', 1, NULL, '2021-07-31 18:36:08', '2021-07-31 18:36:08', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone_number` int(100) DEFAULT NULL,
  `email_address` varchar(1028) DEFAULT NULL,
  `description` varchar(1028) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `phone_number`, `email_address`, `description`) VALUES
(1, 'Makutahi Company Limited', 2147483647, 'deniskawishe4@gmani.com', 'Test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_allocations`
--
ALTER TABLE `asset_allocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_support_messages`
--
ALTER TABLE `customer_support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impact`
--
ALTER TABLE `impact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents_logs`
--
ALTER TABLE `incidents_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents_tracker`
--
ALTER TABLE `incidents_tracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_accesses`
--
ALTER TABLE `menu_accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipals`
--
ALTER TABLE `municipals`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `portal_accesses`
--
ALTER TABLE `portal_accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_allocations`
--
ALTER TABLE `asset_allocations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_support_messages`
--
ALTER TABLE `customer_support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `impact`
--
ALTER TABLE `impact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incidents_logs`
--
ALTER TABLE `incidents_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incidents_tracker`
--
ALTER TABLE `incidents_tracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_accesses`
--
ALTER TABLE `menu_accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `municipals`
--
ALTER TABLE `municipals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portal_accesses`
--
ALTER TABLE `portal_accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
