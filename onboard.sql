-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2017 at 09:31 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onboard`
--
CREATE DATABASE IF NOT EXISTS `onboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `onboard`;

-- --------------------------------------------------------

--
-- Table structure for table `checked_item`
--

CREATE TABLE `checked_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checked_item`
--

INSERT INTO `checked_item` (`id`, `request_id`, `item_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 1, 12, '7', '', '2017-05-26 04:04:21', '2017-05-26 04:04:21'),
(2, 1, 20, '7', '', '2017-05-26 04:04:21', '2017-05-26 04:04:21'),
(3, 1, 23, '7', '', '2017-05-26 04:04:21', '2017-05-26 04:04:21'),
(4, 1, 47, '7', '', '2017-05-26 04:04:21', '2017-05-26 04:04:21'),
(5, 1, 5, '7', '', '2017-05-26 04:04:21', '2017-05-26 04:04:21'),
(6, 2, 20, '2', '', '2017-05-29 02:37:53', '2017-05-29 02:37:53'),
(7, 2, 23, '2', '', '2017-05-29 02:37:53', '2017-05-29 02:37:53'),
(8, 2, 16, '2', '', '2017-05-29 02:37:53', '2017-05-29 02:37:53'),
(9, 2, 5, '2', '', '2017-05-29 02:37:53', '2017-05-29 02:37:53'),
(10, 2, 47, '2', '', '2017-05-29 02:37:53', '2017-05-29 02:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `holdingId` int(11) NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `role_id`, `holdingId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Not defined yet', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'GEMS', NULL, 2, NULL, NULL, NULL, NULL),
(3, 'BIB', NULL, 2, NULL, NULL, NULL, NULL),
(4, 'KIM', NULL, 2, NULL, NULL, NULL, NULL),
(5, 'TRADING', NULL, 2, NULL, NULL, NULL, NULL),
(6, 'MAL', NULL, 2, NULL, NULL, NULL, NULL),
(7, 'BSL', NULL, 2, NULL, NULL, NULL, NULL),
(8, 'BC', NULL, 3, NULL, NULL, NULL, NULL),
(9, 'BCE', NULL, 3, NULL, NULL, NULL, NULL),
(10, 'PSPM', NULL, 3, NULL, NULL, NULL, NULL),
(11, 'MTL', NULL, 3, NULL, NULL, NULL, NULL),
(12, 'KB', NULL, 3, NULL, NULL, NULL, NULL),
(13, 'BBE', NULL, 3, NULL, NULL, NULL, NULL),
(14, 'BKES', NULL, 4, NULL, NULL, NULL, NULL),
(15, 'HRB', NULL, 4, NULL, NULL, NULL, NULL),
(16, 'ASL', NULL, 4, NULL, NULL, NULL, NULL),
(17, 'DAL', NULL, 4, NULL, NULL, NULL, NULL),
(18, 'CAI', NULL, 4, NULL, NULL, NULL, NULL),
(19, 'ASL', NULL, 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `desc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `name`, `role_id`, `desc`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 'IT', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(2, 'HR', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(3, 'GA', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(4, 'Procurement', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(5, 'Finance', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(6, 'Accounting', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(7, 'Operation', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(8, 'Legal', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38'),
(9, 'Marketing', NULL, NULL, NULL, NULL, NULL, '2017-05-24 04:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `name`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 'Staff', NULL, NULL, NULL, '2017-05-24 04:42:55'),
(2, 'Manager', NULL, NULL, NULL, '2017-05-24 04:42:55'),
(3, 'GM', NULL, NULL, NULL, '2017-05-24 04:42:56'),
(4, 'Directors', NULL, NULL, NULL, '2017-05-24 04:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `holding`
--

CREATE TABLE `holding` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `holding`
--

INSERT INTO `holding` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Not defined yet', NULL, NULL, NULL, NULL),
(2, 'GEMS', NULL, NULL, NULL, NULL),
(3, 'BC', NULL, NULL, NULL, NULL),
(4, 'Non Group', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itcategory`
--

CREATE TABLE `itcategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `itcategory`
--

INSERT INTO `itcategory` (`id`, `name`, `role_id`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'IT Adm', NULL, 1, NULL, NULL),
(2, 'IT Inf', NULL, 1, NULL, NULL),
(3, 'IT App', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_category` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_category`, `name`, `brand`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Standard', NULL, NULL, NULL, NULL),
(2, 1, 'VIP', NULL, NULL, NULL, NULL),
(3, 1, 'VVIP', NULL, NULL, NULL, NULL),
(4, 1, 'Hotspot', NULL, NULL, NULL, NULL),
(5, 2, 'Create email', NULL, NULL, NULL, NULL),
(6, 2, 'External communication', NULL, NULL, NULL, NULL),
(7, 2, 'Mobile access', NULL, NULL, NULL, NULL),
(8, 4, 'HP i5 ~12JT', NULL, NULL, NULL, NULL),
(9, 4, 'HP i7 ~14JT', NULL, NULL, NULL, NULL),
(10, 4, 'HP i7 ~20JT', NULL, NULL, NULL, NULL),
(11, 4, 'Lenovo i5 ~12JT', NULL, NULL, NULL, NULL),
(12, 4, 'Lenovo i7 ~14JT', NULL, NULL, NULL, NULL),
(13, 4, 'Lenovo i7 ~20JT', NULL, NULL, NULL, NULL),
(14, 4, 'HP ~25JT', NULL, NULL, NULL, NULL),
(15, 4, 'Lenovo ~25JT', NULL, NULL, NULL, NULL),
(16, 4, 'Macbook ~25JT', NULL, NULL, NULL, NULL),
(17, 4, 'Workstation ~35JT', NULL, NULL, NULL, NULL),
(18, 5, 'Windows 7 License', NULL, NULL, NULL, NULL),
(19, 5, 'Windows 8 License', NULL, NULL, NULL, NULL),
(20, 5, 'Windows 10 License', NULL, NULL, NULL, NULL),
(21, 5, 'MineScape License', NULL, NULL, NULL, NULL),
(22, 5, 'AutoCAD License', NULL, NULL, NULL, NULL),
(23, 5, 'Microsoft Office 2016 License', NULL, NULL, NULL, NULL),
(24, 5, 'Microsoft Office 2013 License', NULL, NULL, NULL, NULL),
(25, 5, 'Microsoft Vision License', NULL, NULL, NULL, NULL),
(26, 5, 'Microsoft Project License', NULL, NULL, NULL, NULL),
(27, 7, 'Install Libre Office', NULL, NULL, NULL, NULL),
(28, 7, 'Install TrendMicro AV', NULL, NULL, NULL, NULL),
(29, 7, 'Install 7Zip', NULL, NULL, NULL, NULL),
(30, 7, 'Install UltraVNC', NULL, NULL, NULL, NULL),
(31, 7, 'Install Skype', NULL, NULL, NULL, NULL),
(32, 7, 'Install Adobe PDF (Free)', NULL, NULL, NULL, NULL),
(33, 7, 'Install SAP GUI client', NULL, NULL, NULL, NULL),
(34, 6, 'Samsung J2', NULL, NULL, NULL, NULL),
(35, 6, 'Samsung S7', NULL, NULL, NULL, NULL),
(36, 7, 'Install KPI Soft mobile apps', NULL, NULL, NULL, NULL),
(37, 7, 'Install Windows 7', NULL, NULL, NULL, NULL),
(38, 7, 'Install Windows 8', NULL, NULL, NULL, NULL),
(39, 7, 'Install Windows 10', NULL, NULL, NULL, NULL),
(40, 7, 'Install MineScape', NULL, NULL, NULL, NULL),
(41, 7, 'Install AutoCAD', NULL, NULL, NULL, NULL),
(42, 7, 'Install Microsoft Office 2016', NULL, NULL, NULL, NULL),
(43, 7, 'Install Microsoft Office 2013', NULL, NULL, NULL, NULL),
(44, 7, 'Install Microsoft Vision', NULL, NULL, NULL, NULL),
(45, 7, 'Install Microsoft Project', NULL, NULL, NULL, NULL),
(46, 8, 'Create user active directory', NULL, NULL, NULL, NULL),
(47, 3, 'Create user SAP', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itemcategory`
--

CREATE TABLE `itemcategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `it_category` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `itemcategory`
--

INSERT INTO `itemcategory` (`id`, `name`, `it_category`, `created_at`, `updated_at`) VALUES
(1, 'Internet', 2, NULL, NULL),
(2, 'Email', 2, NULL, NULL),
(3, 'SAP', 3, NULL, NULL),
(4, 'Notebook', 1, NULL, NULL),
(5, 'Software license', 1, NULL, NULL),
(6, 'Mobile device', 1, NULL, NULL),
(7, 'Install software', 2, NULL, NULL),
(8, 'Active directory', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_05_16_071307_create_it_category', 1),
('2017_05_16_071804_create_item_category', 1),
('2017_05_16_073946_create_item', 1),
('2017_05_18_085727_create_users', 1),
('2017_05_19_033044_create_company', 1),
('2017_05_19_040144_create_holding', 1),
('2017_05_19_082222_create_division', 1),
('2017_05_19_082246_create_grade', 1),
('2017_05_19_082432_create_onboard', 1),
('2017_05_19_083005_create_onboard_detail', 1),
('2017_05_19_094131_update_onboard', 1),
('2017_05_20_214213_create_workflow', 1),
('2017_05_20_215428_update_workflow', 1),
('2017_05_22_100430_create_suggested_list', 1),
('2017_05_22_100458_update_suggested_list', 1),
('2017_05_22_100550_create_onboard_item', 1),
('2017_05_22_100618_update_onboard_item', 1),
('2017_05_22_171550_create_request', 1),
('2017_05_22_171639_update_request', 1),
('2017_05_23_091224_add_column_suggested_list', 1),
('2017_05_23_094757_create_workplace', 2),
('2017_05_23_163937_create_role', 3),
('2017_05_23_164003_create_user_role', 3),
('2017_05_23_172428_create_permissions', 3),
('2017_05_23_174914_create_role_permissions', 3),
('2017_05_23_175242_create_prepared_item', 3),
('2017_05_23_175300_create_checked_item', 4),
('2017_05_23_175754_add_column_table', 4),
('2017_05_24_091513_laratrust_setup_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `onboard`
--

CREATE TABLE `onboard` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `joindate` date NOT NULL,
  `workplace_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `onboard`
--

INSERT INTO `onboard` (`id`, `name`, `company_id`, `division_id`, `grade_id`, `joindate`, `workplace_id`, `email`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 'Rizky', 2, 3, 2, '2017-06-28', 2, 'heryanto@sinarmasmining.com', 'Admin', '', '2017-05-26 04:02:58', '2017-05-26 04:01:12'),
(2, 'Ravinder Mawa', 8, 1, 4, '2017-07-01', 6, 'muhammad.sandy@sinarmasmining.com', 'Admin', '', '2017-05-29 02:36:43', '2017-05-29 02:31:23'),
(3, 'Ravinder Mawa', 8, 1, 4, '2017-07-01', 6, '', 'Admin', '', '2017-05-29 04:12:26', '2017-05-29 04:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `onboard_detail`
--

CREATE TABLE `onboard_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `onboard_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `itemcat_id` int(10) UNSIGNED NOT NULL,
  `is_checked` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onboard_item`
--

CREATE TABLE `onboard_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `onboard_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `onboard_item`
--

INSERT INTO `onboard_item` (`id`, `onboard_id`, `item_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 1, 12, '4', '', '2017-05-26 04:06:31', '2017-05-26 04:06:31'),
(2, 1, 20, '4', '', '2017-05-26 04:06:31', '2017-05-26 04:06:31'),
(3, 1, 23, '4', '', '2017-05-26 04:06:31', '2017-05-26 04:06:31'),
(4, 1, 47, '4', '', '2017-05-26 04:06:31', '2017-05-26 04:06:31'),
(5, 1, 5, '4', '', '2017-05-26 04:06:31', '2017-05-26 04:06:31'),
(6, 2, 20, '2', '', '2017-05-29 02:38:46', '2017-05-29 02:38:46'),
(7, 2, 23, '2', '', '2017-05-29 02:38:46', '2017-05-29 02:38:46'),
(8, 2, 16, '2', '', '2017-05-29 02:38:46', '2017-05-29 02:38:46'),
(9, 2, 5, '2', '', '2017-05-29 02:38:46', '2017-05-29 02:38:46'),
(10, 2, 47, '2', '', '2017-05-29 02:38:46', '2017-05-29 02:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prepared_item`
--

CREATE TABLE `prepared_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prepared_item`
--

INSERT INTO `prepared_item` (`id`, `request_id`, `item_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 1, 12, '4', '', '2017-05-26 04:01:57', '2017-05-26 04:01:57'),
(2, 1, 20, '4', '', '2017-05-26 04:01:57', '2017-05-26 04:01:57'),
(3, 1, 23, '4', '', '2017-05-26 04:01:57', '2017-05-26 04:01:57'),
(4, 1, 47, '4', '', '2017-05-26 04:02:29', '2017-05-26 04:02:29'),
(5, 1, 5, '4', '', '2017-05-26 04:02:58', '2017-05-26 04:02:58'),
(6, 2, 20, '2', '', '2017-05-29 02:35:59', '2017-05-29 02:35:59'),
(7, 2, 23, '2', '', '2017-05-29 02:35:59', '2017-05-29 02:35:59'),
(8, 2, 16, '2', '', '2017-05-29 02:35:59', '2017-05-29 02:35:59'),
(9, 2, 5, '2', '', '2017-05-29 02:36:43', '2017-05-29 02:36:43'),
(10, 2, 47, '2', '', '2017-05-29 02:37:17', '2017-05-29 02:37:17'),
(11, 3, 20, '2', '', '2017-05-29 04:14:37', '2017-05-29 04:14:37'),
(12, 3, 23, '2', '', '2017-05-29 04:14:37', '2017-05-29 04:14:37'),
(13, 3, 16, '2', '', '2017-05-29 04:14:37', '2017-05-29 04:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(10) UNSIGNED NOT NULL,
  `onboard_id` int(10) UNSIGNED NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request_by` int(11) NOT NULL,
  `ticket` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `created_by` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `onboard_id`, `request_date`, `request_by`, `ticket`, `delivery_date`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 1, '2017-05-26 04:01:12', 1, '1WJp', '2017-05-26 14:04:17', '', '', '2017-05-26 07:04:17', '2017-05-26 04:01:12'),
(2, 2, '2017-05-29 02:31:23', 1, '7Vce', '2017-05-29 09:38:46', '', '', '2017-05-29 02:38:46', '2017-05-29 02:31:23'),
(3, 3, '2017-05-29 04:12:26', 1, 'iDHj', NULL, '', '', '2017-05-29 04:12:26', '2017-05-29 04:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'User Administrator', 'User Administrator', '2017-05-25 16:44:15', '2017-05-25 16:44:15'),
(2, 'itadm', 'IT Administrator', 'IT Administrator', '2017-05-25 16:44:15', '2017-05-25 16:44:15'),
(3, 'itinf', 'IT Infrastructure', 'IT Infrastructure', '2017-05-25 16:44:15', '2017-05-25 16:44:15'),
(4, 'itapp', 'IT Application', 'IT Application', '2017-05-25 16:44:15', '2017-05-25 16:44:15'),
(5, 'check', 'Checker', 'Checker IT', '2017-05-25 16:44:15', '2017-05-25 16:44:15'),
(6, 'users', 'Users', 'User is the owner of a given project', '2017-05-25 16:44:15', '2017-05-25 16:44:15'),
(7, 'hrreq', 'HR - Requirement', 'HR Area', '2017-05-25 16:44:15', '2017-05-25 16:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`, `user_type`) VALUES
(6, 4, 'ITApps'),
(7, 5, 'Review'),
(8, 2, 'ITAdm'),
(9, 3, 'ITInfra'),
(10, 7, 'HRView'),
(11, 6, 'Users');

-- --------------------------------------------------------

--
-- Table structure for table `suggested_list`
--

CREATE TABLE `suggested_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `holding_id` int(11) NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suggested_list`
--

INSERT INTO `suggested_list` (`id`, `holding_id`, `company_id`, `division_id`, `grade_id`, `item_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 0, 0, 0, 0, 5, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(2, 2, 0, 0, 1, 11, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(3, 2, 0, 0, 2, 12, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(4, 2, 0, 0, 3, 13, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(5, 2, 0, 0, 4, 15, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(6, 0, 0, 0, 0, 20, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(7, 0, 0, 0, 0, 23, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(8, 0, 0, 0, 0, 47, NULL, NULL, NULL, '2017-05-24 04:49:49'),
(9, 3, 0, 0, 4, 16, NULL, NULL, NULL, '2017-05-29 02:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', 'admin@gmail.com', '$2y$10$C.DDneoLkOAv565pMCG5GeWASolCv3Gb2TokPl433eCwW8Wgq3K/i', 'H881PWTYMqrOHK0c0YdKoxWaz0hdCJzFuB1l9FGtykA45JwYnZB3oOXaO45L', '2017-05-23 02:46:41', '2017-05-29 03:58:13'),
(2, 'Muhammad Sandy', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$Qb6wnGC3s/p4qud.1DebjOdGNFpbyJe1qRUlBjAaamYU1mY9Y8YEu', '2KGJ0X2iJqxbuO5b44LA8PX2xvtyHpm0WqdjvyDE040PIsISToJBzncdfuhn', '2017-05-25 16:22:32', '2017-05-29 03:58:19'),
(3, 'Tommy Wijaya', '', 'tommy.wijaya@sinarmasmining.com', '$2y$10$hr2TWtYWgAXZmj/cLcLJcOSE5a3IDuFZ7aHjebZ0MnHi7EMmnq1RK', 'gf2TDLJWSrfp5dSn4o0AevAGFjuaOmEs9v0UhRAhKEadCVrF7KaYDknwTZPN', '2017-05-25 16:23:21', '2017-05-25 16:23:29'),
(4, 'Heryanto', '', 'heryanto@sinarmasmining.com', '$2y$10$xCpnzVwNy2tVp/bdJ3OiOOdeQx9UBQDNDmAHMFqcV47DOiNMw808y', 'uzH1T0PDYClHpUsQW5eKXjQw6im59nKUaqEKOv78OEZftOrL7LTRiIY767Xh', '2017-05-25 16:24:21', '2017-05-26 04:03:51'),
(5, 'Ravinder Mawa', '', 'ravinder.mawa@sinarmasmining.com', '$2y$10$aZnXJZk2Ndx0/tjWoR9L6eo/a97LDGQFQEDIu3HF2zAno7U6HpAM2', 'aLNbL3sKLMybRhZbw7V8vQVKpdrtLp43JP1lczA2GLSJjUO0Y2jQ35tFKrGB', '2017-05-25 16:26:09', '2017-05-25 16:26:47'),
(6, 'Paulus Adi', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$s1dMN6kbeJsVUj0glsIs3ujP8.bOJBZmMO66WAkkEMxdxT9d/4ps6', 'vAzauTnqP5eKQmJCNQmSbUK5d9UJnBWgdTXBvsvDI3W9gh2dUqYvX8xsxub0', '2017-05-25 16:28:17', '2017-05-25 16:28:27'),
(7, 'Fathia Justine', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$88OnLVBRwIl2JFL9OZ3AFuXhvhZAF7t3xR8Gx3CfvTDa2/0BsfAla', '7Y8bweWxV5fLYIPUE6fYCYMmXwImGGNjHMUNxRsz0pNSBx9VHz2wfAXS14N7', '2017-05-25 16:28:46', '2017-05-26 04:05:09'),
(8, 'Justin', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$MmAN5KPjC2UsgOmhPJHf5.zWYPggO594EE42Slo3vo6bQKhrVwaOa', '6IW4XHbSzfcBgmSorgXgQMFj9Vn2MrN9jV6DnP1FYSoaxmjTvTpVKSsojV1N', '2017-05-25 16:30:02', '2017-05-25 16:34:26'),
(9, 'Roy Rachmanto', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$YE5QQiOYv5Ia1hogGl5LF.FOQ4RvZKugYpGdqlyBT6zYmsDZXUvqu', 'gYfARzvHRQv2pGNaWiLPmfWecAc1LjufQpET8jSnxCHT97W6iDyhdTiCajy2', '2017-05-25 16:35:27', '2017-05-25 16:35:41'),
(10, 'Dimas Hendra', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$xiGSOEvyi08/4lH/MPh7d.V5omx5HOARyqIKkDnmlEk3NOUR9i.Ri', 'pb2cH7YbjHETxKdgmN4YYgg63Pgv4QoG5I4TQ93DFPfJGxxJRqIZzNNvA6BN', '2017-05-25 16:36:45', '2017-05-25 16:36:57'),
(11, 'Aulia Rayhanti', '', 'aulia.rayhandi@beraucoal.co.id', '$2y$10$7e4PYNjfvyR9c72ke5b4keoxN.keDMQSA4Nmt4cH6YayxcP7Xwe96', 'gkcP6czBuyjBYdZweXfFNG4E2CAnjJnVxWD7zVPqiT7AGBshvVWsKTJBoPkX', '2017-05-25 16:37:43', '2017-05-25 16:55:18'),
(12, 'Andry Steven', '', 'heryanto@sinarmasmining.com', '$2y$10$yBV7z7zSa4Lme4gPuDLVDeH1tmEpJOojAm9aGYgKE8CkUk3OYPsEa', '', '2017-05-26 03:49:11', '2017-05-26 03:49:11'),
(13, 'Rizky', '', 'heryanto@sinarmasmining.com', '$2y$10$AxojvCMF/Wciq7R/ZyzKAun5fQmQoNOKt.BEPKgQiqkeoCxxGTQfy', '', '2017-05-26 04:02:58', '2017-05-26 04:02:58'),
(14, 'Ravinder Mawa', '', 'muhammad.sandy@sinarmasmining.com', '$2y$10$Kodjz0y6LFqAYEWZLMRbD.q6eW47wplD2v70kRRYDjyvWyGVXtoWm', '', '2017-05-29 02:36:43', '2017-05-29 02:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

CREATE TABLE `workflow` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `it_category` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`id`, `request_id`, `user_id`, `it_category`, `comment`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 1, 4, 1, 'Haha\r\na', 'Heryanto', '', '2017-05-26 04:01:57', '2017-05-26 04:01:57'),
(2, 1, 4, 3, 'Hihi.\r\nasd\r\nsad\r\nasd\r\nasd\r\nsad\r\nsad\r\nasdasdasdadasdasdHihi.\r\nasd\r\nsad\r\nasd\r\nasd\r\nsad\r\nsad\r\nasdasdasdadasdasdHihi.\r\nasd\r\nsad\r\nasd\r\nasd\r\nsad\r\nsad\r\nasdasdasdadasdasdHihi.\r\nasd\r\nsad\r\nasd\r\nasd\r\nsad\r\nsad\r\nasdasdasdadasdasd', 'Heryanto', '', '2017-05-26 04:02:29', '2017-05-26 04:02:29'),
(3, 1, 4, 2, 'testesdfsfdsfdsf\r\ndsf\r\ndsf\r\nsd\r\nf', 'Heryanto', '', '2017-05-26 04:02:58', '2017-05-26 04:02:58'),
(4, 1, 1, 4, 'Lengkap Banget ya', 'Admin', '', '2017-05-26 07:03:14', '2017-05-26 07:03:14'),
(5, 1, 1, 5, 'Done , Thanks Admin', 'Admin', '', '2017-05-26 07:04:17', '2017-05-26 07:04:17'),
(6, 2, 2, 1, 'Done, Prepared Email', 'Muhammad Sandy', '', '2017-05-29 02:35:59', '2017-05-29 02:35:59'),
(7, 2, 2, 2, 'Done , Prepared to Apps', 'Muhammad Sandy', '', '2017-05-29 02:36:43', '2017-05-29 02:36:43'),
(8, 2, 2, 3, 'Done, Submit to Checker', 'Muhammad Sandy', '', '2017-05-29 02:37:17', '2017-05-29 02:37:17'),
(9, 2, 2, 4, 'Done', 'Muhammad Sandy', '', '2017-05-29 02:37:53', '2017-05-29 02:37:53'),
(10, 2, 2, 5, 'Done All item', 'Muhammad Sandy', '', '2017-05-29 02:38:46', '2017-05-29 02:38:46'),
(11, 3, 2, 1, 'Done, from admin', 'Muhammad Sandy', '', '2017-05-29 04:14:37', '2017-05-29 04:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `workplace`
--

CREATE TABLE `workplace` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `workplace`
--

INSERT INTO `workplace` (`id`, `name`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 'Sinarmas Land Plaza, Tower 2nd, 6th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(2, 'Sinarmas Land Plaza, Tower 2nd, 7th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(3, 'Sinarmas Land Plaza, Tower 1st, 5th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(4, 'Sinarmas Land Plaza, Tower 3rd, 4th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(5, 'Sinarmas Land Plaza, Tower 3rd, 9th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(6, 'Menara Prima, Tower 2nd, 17th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(7, 'Menara Prima, Tower 2nd, 18th floor', NULL, NULL, NULL, '2017-05-24 04:51:31'),
(8, 'Berau Coal Head Office', NULL, NULL, NULL, '2017-05-24 04:51:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checked_item`
--
ALTER TABLE `checked_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checked_item_request_id_foreign` (`request_id`),
  ADD KEY `checked_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_role_id_foreign` (`role_id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_role_id_foreign` (`role_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holding`
--
ALTER TABLE `holding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itcategory`
--
ALTER TABLE `itcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itcategory_role_id_foreign` (`role_id`),
  ADD KEY `itcategory_division_id_foreign` (`division_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcategory`
--
ALTER TABLE `itemcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onboard`
--
ALTER TABLE `onboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onboard_company_id_foreign` (`company_id`),
  ADD KEY `onboard_division_id_foreign` (`division_id`),
  ADD KEY `onboard_grade_id_foreign` (`grade_id`),
  ADD KEY `onboard_workplace_id_foreign` (`workplace_id`);

--
-- Indexes for table `onboard_detail`
--
ALTER TABLE `onboard_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onboard_item`
--
ALTER TABLE `onboard_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `onboard_item_onboard_id_foreign` (`onboard_id`),
  ADD KEY `onboard_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`permission_id`,`user_id`,`user_type`);

--
-- Indexes for table `prepared_item`
--
ALTER TABLE `prepared_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prepared_item_request_id_foreign` (`request_id`),
  ADD KEY `prepared_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_onboard_id_foreign` (`onboard_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `suggested_list`
--
ALTER TABLE `suggested_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suggested_list_company_id_foreign` (`company_id`),
  ADD KEY `suggested_list_division_id_foreign` (`division_id`),
  ADD KEY `suggested_list_grade_id_foreign` (`grade_id`),
  ADD KEY `suggested_list_item_id_foreign` (`item_id`),
  ADD KEY `suggested_list_holding_id_foreign` (`holding_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workflow`
--
ALTER TABLE `workflow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workflow_onboard_id_foreign` (`request_id`),
  ADD KEY `workflow_user_id_foreign` (`user_id`);

--
-- Indexes for table `workplace`
--
ALTER TABLE `workplace`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checked_item`
--
ALTER TABLE `checked_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `holding`
--
ALTER TABLE `holding`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `itcategory`
--
ALTER TABLE `itcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `itemcategory`
--
ALTER TABLE `itemcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `onboard`
--
ALTER TABLE `onboard`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `onboard_detail`
--
ALTER TABLE `onboard_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `onboard_item`
--
ALTER TABLE `onboard_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prepared_item`
--
ALTER TABLE `prepared_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `suggested_list`
--
ALTER TABLE `suggested_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `workflow`
--
ALTER TABLE `workflow`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `workplace`
--
ALTER TABLE `workplace`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
