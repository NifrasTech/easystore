-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2022 at 11:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_easystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `cretaed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `account_no`, `account_name`, `bank_name`, `balance`, `cretaed_at`, `updated_at`, `created_by`) VALUES
(1, '102100140082996', 'SLN Traders', 'Peoples Bank', '247000.00', '2020-10-02 09:07:34', '2022-01-12 19:29:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_type` varchar(20) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `date` date NOT NULL,
  `refrence_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `bank_account_id`, `amount`, `transaction_type`, `description`, `date`, `refrence_id`, `created_at`, `updated_at`, `created_by`) VALUES
(2, 1, '247000.00', 'Deposit', 'Opening Balance', '2021-01-10', 0, '2021-01-10 15:50:52', '2022-01-12 19:28:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'B-APP', 'Apple', '2021-10-27 03:33:54', '2021-10-27 07:59:37'),
(3, 'B-SAMS', 'Samsung', '2021-10-27 07:52:06', '2021-10-27 07:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'C01', 'Grocerry', '2021-10-27 03:33:15', '2022-01-18 08:29:15'),
(4, 'VEG', 'Vegetable', '2022-01-18 08:27:21', '2022-01-18 08:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `city` varchar(200) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_supplier` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `contact_no`, `email`, `city`, `address`, `balance`, `description`, `is_active`, `is_supplier`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 'GUEST', '', 'easystore@email.com', '', '', -3500, NULL, 1, 0, '2021-10-28 05:32:14', NULL, '2022-01-14 11:05:00'),
(2, 'Ajmal', '3243434', 'adafs@fsd.com', 'sdfdf', 'sdfdf', -4608, 'dfdfdf', 1, 0, '2021-10-28 06:58:59', NULL, '2022-01-16 14:34:26'),
(3, 'Versatile Ltd.', '234324343', 'vers@email.com', 'Oddamavadi', 'Oddamavadi', 42000, 'Nothing much to say', 1, 1, '2021-11-01 09:19:20', NULL, '2022-01-26 08:50:08'),
(4, 'Nifras', '0772794984', NULL, 'Oddamavadi', 'Oddamavadi', 0, NULL, 1, 0, '2022-01-01 13:14:38', NULL, '2022-01-25 08:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(300) NOT NULL,
  `expense_date` timestamp NULL DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `amount`, `description`, `expense_date`, `store_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(4, 6000, 'Salary', '2020-08-11 21:00:00', 0, '2021-03-04 14:34:43', '2022-01-18 04:14:09', '2022-01-18 04:14:09', 1),
(5, 300, 'Break Fast', '2021-01-12 21:00:00', 0, '2021-03-04 14:34:43', '2021-03-04 14:34:43', NULL, 1),
(6, 20, 'Donation', '2021-01-12 21:00:00', 0, '2021-03-04 14:34:43', '2021-03-04 14:34:43', NULL, 1),
(7, 240, 'Bresk Fast', '2021-01-04 21:00:00', 0, '2021-03-04 14:34:43', '2021-03-04 14:34:43', NULL, 1),
(8, 240, 'BF', '2021-01-11 21:00:00', 0, '2021-03-04 14:34:43', '2021-03-04 14:34:43', NULL, 1),
(12, 30, 'Tea', '2022-01-01 21:00:00', 1, '2022-01-09 08:07:12', '2022-01-09 08:07:12', NULL, 1),
(13, 123, 'ddd', '2022-01-13 21:00:00', 1, '2022-01-13 05:16:29', '2022-01-13 05:16:29', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `is_sale` tinyint(1) NOT NULL DEFAULT 1,
  `contact_id` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `note` varchar(250) DEFAULT NULL,
  `cheque_no` varchar(30) DEFAULT NULL,
  `bankname` varchar(30) DEFAULT NULL,
  `cheque_status` varchar(10) DEFAULT NULL,
  `cheque_type` varchar(20) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `reference_id`, `is_sale`, `contact_id`, `payment_type`, `amount`, `store_id`, `register_id`, `note`, `cheque_no`, `bankname`, `cheque_status`, `cheque_type`, `cheque_date`, `created_by`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'cash', '8100', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-24 11:20:41', NULL, '2021-10-24 11:20:41'),
(2, 1, 1, 1, 'cash', '8100', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-24 11:33:59', NULL, '2021-10-24 11:33:59'),
(3, 1, 1, 1, 'cash', '8100', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-24 11:38:38', NULL, '2021-10-24 11:38:38'),
(4, 1, 1, 1, 'cash', '6000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-25 09:43:59', NULL, '2021-10-25 09:43:59'),
(5, 2, 1, 1, 'credit', '5000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-25 09:48:13', NULL, '2021-10-25 09:48:13'),
(6, 5, 1, 2, 'credit', '2400', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-28 12:20:20', NULL, '2021-10-28 12:20:20'),
(7, 6, 1, 1, 'cash', '800', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-28 12:22:57', NULL, '2021-10-28 12:22:57'),
(8, 7, 1, 2, 'cash', '500', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-28 12:35:13', NULL, '2021-10-28 12:35:13'),
(9, 9, 1, 1, 'cash', '9000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-10-31 06:17:49', NULL, '2021-10-31 06:17:49'),
(10, 0, 1, 2, 'cash', '400', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 09:30:51', NULL, '2021-11-10 09:30:51'),
(11, 0, 1, 2, 'cheque', '400', 1, 0, NULL, '3201450', 'sdf', 'Completed', 'cash', '2021-11-23', 1, '2021-11-10 09:32:27', NULL, '2022-01-13 09:05:27'),
(12, 0, 1, 2, 'cash', '400', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 09:34:37', NULL, '2021-11-10 09:34:37'),
(13, 0, 0, 3, 'cash', '500', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 09:34:55', NULL, '2021-11-10 09:34:55'),
(14, 0, 0, 3, 'cash', '400', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 09:37:20', NULL, '2021-11-10 09:37:20'),
(15, 0, 1, 2, 'cash', '400', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 09:38:01', NULL, '2021-11-10 09:38:01'),
(16, 0, 1, 2, 'cash', '200', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 09:39:37', NULL, '2021-11-10 09:39:37'),
(17, 0, 1, 2, 'cheque', '500', 1, 0, NULL, '34545', 'rgdg', 'Pending', 'cash', '2021-11-25', 1, '2021-11-10 09:39:55', NULL, '2022-01-15 10:06:10'),
(18, 10, 1, 2, 'credit', '1000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 12:49:05', NULL, '2021-11-10 12:49:05'),
(19, 11, 1, 2, 'cash', '300', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-10 12:54:39', NULL, '2021-11-10 12:54:39'),
(20, 1, 1, 1, 'cash', '1000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-11-30 07:58:43', NULL, '2021-11-30 07:58:43'),
(21, 2, 1, 1, 'cash', '500', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-19 07:47:26', NULL, '2021-12-19 07:47:26'),
(22, 2, 1, 1, 'credit', '500', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-19 07:47:26', NULL, '2021-12-19 07:47:26'),
(23, 3, 1, 1, 'cash', '3000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-21 12:41:51', NULL, '2021-12-21 12:41:51'),
(24, 4, 1, 2, 'credit', '800', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-21 12:42:57', NULL, '2021-12-21 12:42:57'),
(25, 5, 1, 1, 'cash', '800', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-22 10:17:10', NULL, '2021-12-22 10:17:10'),
(26, 0, 1, 1, 'cash', '500', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-22 07:27:04', NULL, '2021-12-22 07:27:04'),
(27, 6, 1, 1, 'cash', '3000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-22 11:14:39', NULL, '2021-12-22 11:14:39'),
(28, 7, 1, 1, 'cash', '-1500', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-12-22 11:16:20', NULL, '2021-12-22 11:16:20'),
(29, 0, 1, 2, 'cash', '100', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-01-09 05:59:16', NULL, '2022-01-09 05:59:16'),
(30, 8, 1, 4, 'cash', '7300', 2, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-11 06:10:35', NULL, '2022-01-11 06:10:35'),
(31, 0, 1, 2, 'cash', '100', 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-01-11 03:23:41', NULL, '2022-01-11 03:23:41'),
(32, 9, 1, 4, 'cash', '5000', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-13 18:21:20', NULL, '2022-01-13 18:21:20'),
(33, 9, 1, 4, 'credit', '6000', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-13 18:21:20', NULL, '2022-01-13 18:21:20'),
(34, 10, 1, 2, 'cash', '111111111', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-13 18:32:31', NULL, '2022-01-13 18:32:31'),
(35, 3, 1, 1, 'credit', '1000', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-14 13:07:04', NULL, '2022-01-14 13:07:04'),
(36, 3, 1, 1, 'credit', '600', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-14 13:59:41', NULL, '2022-01-14 13:59:41'),
(37, 3, 1, 1, 'credit', '1900', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-14 14:05:00', NULL, '2022-01-14 14:05:00'),
(38, 10, 1, 2, 'credit', '1200', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-15 10:46:34', NULL, '2022-01-15 10:46:34'),
(39, 11, 1, 2, 'cash', '-600', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-15 11:32:05', NULL, '2022-01-15 11:32:05'),
(40, 12, 1, 1, 'cheque', '1000', 1, 0, NULL, '1234567', 'Peoples', 'Pending', 'Dated Cheque', '2022-01-19', 1, '2022-01-15 13:13:23', NULL, '2022-01-15 10:22:25'),
(41, 11, 1, 2, 'credit', '508', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-16 17:34:26', NULL, '2022-01-16 17:34:26'),
(42, 13, 1, 4, 'cash', '6000', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-19 11:39:35', NULL, '2022-01-19 11:39:35'),
(43, 14, 1, 2, 'cash', '1480', 1, 0, NULL, NULL, NULL, 'Paid', NULL, NULL, 1, '2022-01-21 16:08:00', NULL, '2022-01-21 16:08:00'),
(44, 0, 0, 3, 'cash', '3000', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-01-26 08:48:04', NULL, '2022-01-26 08:48:04'),
(45, 0, 0, 3, 'cash', '-400', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-01-26 08:50:08', NULL, '2022-01-26 08:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `cost` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0,
  `quantity` decimal(10,0) NOT NULL DEFAULT 0,
  `alert_quantity` decimal(10,0) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `is_service` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `note` varchar(50) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `description`, `cost`, `price`, `discount`, `quantity`, `alert_quantity`, `unit_type`, `image`, `is_service`, `is_featured`, `note`, `brand_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 'DF23', 'Apple Watch', 'Milk powder', '200', '300', '0', '65', '50', 'PCS', 'images/pages/eCommerce/1.png', 0, 1, NULL, 1, 1, '2021-10-19 10:54:24', '2022-01-25 08:49:17', NULL, 1),
(2, '2000', 'Chocolate', 'Milk powder', '200', '500', '0', '3', '10', 'PCS', 'images/pages/eCommerce/7.png', 0, 1, NULL, 3, 3, '2021-10-19 10:54:24', '2022-01-26 02:21:14', NULL, 1),
(3, '20', 'Chicken 400g', NULL, '100', '200', '0', '28', '50', 'Kg', 'images/products/202112300843191640896999.jpg', 0, 1, NULL, NULL, 1, '2021-12-22 02:49:09', '2022-01-18 07:48:13', NULL, 1),
(4, '4', 'Chips', NULL, '50', '100', '0', '10', '20', 'PCS', NULL, 0, 1, NULL, NULL, 1, '2022-01-18 03:45:10', '2022-01-18 09:40:20', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `reference` varchar(250) DEFAULT NULL,
  `total` double NOT NULL,
  `discount` double NOT NULL,
  `note` varchar(300) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Closed',
  `store_id` int(11) NOT NULL DEFAULT 1,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `contact_id`, `reference`, `total`, `discount`, `note`, `status`, `store_id`, `register_id`, `created_at`, `purchase_date`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 3, '12354545', 40000, 200, NULL, 'Open', 1, 0, '2021-11-02 01:19:13', '2021-11-24 21:00:00', '2022-01-21 13:06:41', NULL, 1),
(2, 3, '123', 0, 0, NULL, 'Open', 1, 0, '2021-11-02 01:20:57', '2021-11-02 21:00:00', '2022-01-25 08:50:14', NULL, 1),
(3, 3, '23', 0, 0, NULL, 'Closed', 1, 0, '2021-11-02 01:22:03', '2021-11-01 21:00:00', '2022-01-19 09:24:48', NULL, 1),
(4, 4, 'f', 0, 0, NULL, 'Closed', 2, 0, '2022-01-17 09:33:58', '2022-01-03 21:00:00', '2022-01-17 09:33:58', NULL, 1),
(5, 4, 'f', 0, 0, NULL, 'Closed', 2, 0, '2022-01-17 09:36:01', '2022-01-03 21:00:00', '2022-01-17 09:36:01', NULL, 1),
(6, 4, 'f', 0, 0, NULL, 'Closed', 2, 0, '2022-01-17 09:49:25', '2022-01-03 21:00:00', '2022-01-17 09:49:25', NULL, 1),
(7, 4, 'f', 0, 0, NULL, 'Closed', 2, 0, '2022-01-17 09:49:45', '2022-01-03 21:00:00', '2022-01-17 09:49:45', NULL, 1),
(8, 2, 'f', 0, 0, NULL, 'Closed', 2, 0, '2022-01-17 09:52:07', '2022-01-03 21:00:00', '2022-01-17 09:52:07', NULL, 1),
(9, 2, 'f', 0, 0, NULL, 'Closed', 1, 0, '2022-01-17 09:53:14', '2022-01-03 21:00:00', '2022-01-17 09:53:14', NULL, 1),
(10, 2, 'f', 500, 0, NULL, 'Closed', 1, 0, '2022-01-17 09:57:08', '2022-01-03 21:00:00', '2022-01-17 09:57:08', NULL, 1),
(11, 3, '5467', 740, 60, NULL, 'Closed', 2, 0, '2022-01-18 02:32:54', '2022-01-17 21:00:00', '2022-01-18 02:32:54', NULL, 1),
(12, 3, '4576', 37000, 0, NULL, 'Closed', 1, 0, '2022-01-26 02:12:37', '2022-01-16 21:00:00', '2022-01-26 02:12:37', NULL, 1),
(13, 3, '4576', 200, 200, NULL, 'Closed', 1, 0, '2022-01-26 02:18:38', '2022-01-16 21:00:00', '2022-01-26 02:18:38', NULL, 1),
(14, 3, '4576', 200, 0, NULL, 'Closed', 1, 0, '2022-01-26 02:21:14', '2022-01-16 21:00:00', '2022-01-26 02:21:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `hold_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0,
  `quantity` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `note` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_id`, `hold_id`, `product_id`, `cost`, `price`, `discount`, `quantity`, `created_at`, `updated_at`, `deleted_at`, `note`) VALUES
(1, 2, NULL, 2, '200', '500', '0', '200', '2021-11-02 04:20:57', '2022-01-25 08:49:33', '2022-01-25 08:49:33', NULL),
(2, 2, NULL, 1, '200', '300', '0', '1', '2021-11-02 04:20:57', '2022-01-25 08:49:17', '2022-01-25 08:49:17', NULL),
(3, 3, NULL, 2, '200', '500', '0', '500', '2021-11-02 04:22:03', '2022-01-19 09:24:48', '2022-01-19 09:24:48', NULL),
(4, 5, NULL, 1, '300', '300', '0', '1', '2022-01-17 12:36:02', '2022-01-17 12:36:02', NULL, NULL),
(5, 6, NULL, 1, '300', '300', '0', '1', '2022-01-17 12:49:25', '2022-01-17 12:49:25', NULL, NULL),
(6, 7, NULL, 1, '300', '300', '0', '3', '2022-01-17 12:49:45', '2022-01-17 12:49:45', NULL, NULL),
(7, 8, NULL, 2, '500', '500', '0', '1', '2022-01-17 12:52:08', '2022-01-17 12:52:08', NULL, NULL),
(8, 9, NULL, 2, '500', '500', '0', '1', '2022-01-17 12:53:14', '2022-01-17 12:53:14', NULL, NULL),
(9, 10, NULL, 2, '500', '500', '0', '1', '2022-01-17 12:57:08', '2022-01-17 12:57:08', NULL, NULL),
(10, 11, NULL, 2, '200', '200', '0', '4', '2022-01-18 05:32:54', '2022-01-18 05:32:54', NULL, NULL),
(11, 12, NULL, 2, '200', '200', '0', '185', '2022-01-26 05:12:37', '2022-01-26 05:12:37', NULL, NULL),
(12, 13, NULL, 2, '200', '200', '0', '2', '2022-01-26 05:18:38', '2022-01-26 05:18:38', NULL, NULL),
(13, 14, NULL, 2, '200', '200', '0', '1', '2022-01-26 05:21:14', '2022-01-26 05:21:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `quotation_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `note` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_items`
--

CREATE TABLE `quotation_items` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `hold_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0,
  `quantity` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `note` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `open_cash` decimal(10,0) NOT NULL DEFAULT 0,
  `open_cheque` decimal(10,0) NOT NULL DEFAULT 0,
  `close_cash` decimal(10,0) NOT NULL DEFAULT 0,
  `close_cheque` decimal(10,0) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `register_histories`
--

CREATE TABLE `register_histories` (
  `id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL,
  `cash` decimal(10,0) NOT NULL DEFAULT 0,
  `cheque` decimal(10,0) NOT NULL DEFAULT 0,
  `description` varchar(150) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `reference` varchar(250) DEFAULT NULL,
  `total` double NOT NULL,
  `discount` double NOT NULL,
  `profit` double NOT NULL DEFAULT 0,
  `paid` decimal(10,0) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'Closed',
  `note` varchar(300) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `contact_id`, `reference`, `total`, `discount`, `profit`, `paid`, `status`, `note`, `store_id`, `register_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 1, '', 1000, 600, 800, '0', 'Closed', NULL, 1, 0, '2021-11-30 04:58:43', '2021-11-30 04:58:43', NULL, 1),
(2, 1, '', 1000, 800, 1000, '0', 'Closed', NULL, 1, 0, '2021-12-19 04:47:25', '2021-12-19 04:47:26', NULL, 1),
(3, 1, '', 6500, 0, 2600, '0', 'Closed', NULL, 1, 0, '2021-12-21 09:41:50', '2022-01-15 10:43:32', NULL, 1),
(4, 2, '', 800, 0, 400, '0', 'Closed', NULL, 1, 0, '2021-12-21 09:42:57', '2022-01-18 09:32:49', NULL, 1),
(5, 1, 'Ajmal', 500, 200, 400, '0', 'Closed', NULL, 1, 0, '2021-12-22 07:17:10', '2022-01-18 09:32:45', NULL, 1),
(6, 1, NULL, 3000, 0, 1000, '0', 'Closed', NULL, 1, 0, '2021-12-22 08:14:39', '2021-12-22 08:14:39', NULL, 1),
(7, 1, NULL, -1500, 0, -500, '0', 'Closed', NULL, 1, 0, '2021-12-22 08:16:19', '2022-01-18 07:43:17', NULL, 1),
(8, 4, NULL, 1900, 50, 1700, '7300', 'Closed', NULL, 2, 0, '2022-01-11 03:10:34', '2022-01-18 07:48:13', NULL, 1),
(9, 4, 'Ajmal', 11000, 200, 5100, '5000', 'Closed', NULL, 1, 0, '2022-01-13 15:21:19', '2022-01-13 15:21:20', NULL, 1),
(10, 2, NULL, -200, 200, -3200, '111111111', 'Closed', NULL, 1, 0, '2022-01-13 15:32:30', '2022-01-18 07:42:32', NULL, 1),
(11, 2, 'Ajmal', 0, 8, 108, '-600', 'Closed', NULL, 1, 0, '2022-01-15 08:32:05', '2022-01-18 07:37:09', NULL, 1),
(12, 1, 'hi', 1100, 100, 400, '1000', 'Closed', NULL, 1, 0, '2022-01-15 10:13:23', '2022-01-18 07:36:20', NULL, 1),
(13, 4, NULL, 0, 0, -2600, '6000', 'Open', NULL, 1, 0, '2022-01-19 08:39:35', '2022-01-25 08:44:24', NULL, 1),
(14, 2, 'Rid', 1480, 20, 500, '1480', 'Closed', NULL, 1, 0, '2022-01-21 13:08:00', '2022-01-21 13:08:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_holds`
--

CREATE TABLE `sale_holds` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `note` varchar(300) DEFAULT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `hold_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0,
  `quantity` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `note` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `hold_id`, `product_id`, `cost`, `price`, `discount`, `quantity`, `created_at`, `updated_at`, `deleted_at`, `note`) VALUES
(1, 1, NULL, 1, '200', '300', '0', '2', '2021-11-30 07:58:43', '2021-11-30 07:58:43', NULL, NULL),
(2, 1, NULL, 2, '200', '500', '0', '2', '2021-11-30 07:58:43', '2021-11-30 07:58:43', NULL, NULL),
(3, 2, NULL, 1, '200', '300', '0', '1', '2021-12-19 07:47:26', '2021-12-19 07:47:26', NULL, NULL),
(4, 2, NULL, 2, '200', '500', '0', '3', '2021-12-19 07:47:26', '2021-12-19 07:47:26', NULL, NULL),
(5, 3, NULL, 1, '200', '300', '0', '10', '2021-12-21 12:41:51', '2021-12-21 12:41:51', NULL, NULL),
(6, 4, NULL, 2, '200', '500', '0', '1', '2021-12-21 12:42:57', '2021-12-21 12:42:57', NULL, NULL),
(7, 4, NULL, 1, '200', '300', '0', '1', '2021-12-21 12:42:57', '2021-12-21 12:42:57', NULL, NULL),
(8, 5, NULL, 1, '200', '300', '0', '1', '2021-12-22 10:17:10', '2022-01-18 06:12:19', '2022-01-18 06:12:19', NULL),
(9, 5, NULL, 2, '200', '500', '0', '1', '2021-12-22 10:17:10', '2021-12-22 10:17:10', NULL, NULL),
(10, 5, NULL, 3, '100', '200', '0', '1', '2021-12-22 10:17:10', '2021-12-22 10:17:10', NULL, NULL),
(11, 6, NULL, 1, '200', '300', '0', '10', '2021-12-22 11:14:39', '2021-12-22 11:14:39', NULL, NULL),
(12, 7, NULL, 1, '200', '300', '0', '-5', '2021-12-22 11:16:20', '2021-12-22 11:16:20', NULL, NULL),
(13, 8, NULL, 1, '200', '300', '0', '6', '2022-01-11 06:10:35', '2022-01-11 06:10:35', NULL, NULL),
(14, 8, NULL, 2, '200', '500', '0', '10', '2022-01-11 06:10:35', '2022-01-18 07:46:43', '2022-01-18 07:46:43', NULL),
(15, 8, NULL, 3, '100', '200', '0', '2', '2022-01-11 06:10:35', '2022-01-18 07:48:13', '2022-01-18 07:48:13', NULL),
(16, 9, NULL, 2, '200', '500', '0', '10', '2022-01-13 18:21:20', '2022-01-13 18:21:20', NULL, NULL),
(17, 9, NULL, 3, '100', '200', '0', '1', '2022-01-13 18:21:20', '2022-01-13 18:21:20', NULL, NULL),
(18, 9, NULL, 1, '200', '300', '0', '20', '2022-01-13 18:21:20', '2022-01-13 18:21:20', NULL, NULL),
(19, 10, NULL, 2, '200', '500', '0', '10', '2022-01-13 18:32:31', '2022-01-18 05:35:19', '2022-01-18 05:35:19', NULL),
(20, 10, NULL, 3, '100', '200', '0', '1', '2022-01-13 18:32:31', '2022-01-18 05:35:16', '2022-01-18 05:35:16', NULL),
(21, 10, NULL, 1, '200', '300', '0', '20', '2022-01-13 18:32:31', '2022-01-18 05:35:13', '2022-01-18 05:35:13', NULL),
(43, 3, NULL, 1, '200', '300', '20', '1', '2022-01-14 13:07:04', '2022-01-14 13:07:04', NULL, ''),
(44, 3, NULL, 2, '200', '500', '0', '1', '2022-01-14 13:07:04', '2022-01-14 13:07:04', NULL, NULL),
(45, 3, NULL, 3, '100', '200', '0', '1', '2022-01-14 13:07:04', '2022-01-14 13:07:04', NULL, NULL),
(46, 3, NULL, 1, '200', '300', '0', '2', '2022-01-14 13:59:41', '2022-01-14 13:59:41', NULL, NULL),
(47, 3, NULL, 1, '200', '300', '0', '3', '2022-01-14 14:05:00', '2022-01-14 14:05:00', NULL, NULL),
(48, 3, NULL, 2, '200', '500', '0', '2', '2022-01-14 14:05:00', '2022-01-14 14:05:00', NULL, '14 / 01 /2022'),
(49, 10, NULL, 1, '200', '300', '0', '1', '2022-01-15 10:46:34', '2022-01-18 05:35:10', '2022-01-18 05:35:10', '14/01/2022'),
(50, 10, NULL, 2, '200', '500', '0', '1', '2022-01-15 10:46:34', '2022-01-18 05:35:05', '2022-01-18 05:35:05', '14/02/2022'),
(51, 10, NULL, 3, '100', '200', '0', '2', '2022-01-15 10:46:34', '2022-01-18 05:34:53', '2022-01-18 05:34:53', '14/02/2022'),
(52, 11, NULL, 1, '200', '300', '0', '-2', '2022-01-15 11:32:05', '2022-01-18 05:33:55', '2022-01-18 05:33:55', NULL),
(53, 12, NULL, 1, '200', '300', '0', '4', '2022-01-15 13:13:23', '2022-01-18 05:30:56', '2022-01-18 05:30:56', NULL),
(54, 11, NULL, 1, '200', '300', '0', '1', '2022-01-16 17:34:26', '2022-01-18 05:33:59', '2022-01-18 05:33:59', NULL),
(55, 11, NULL, 3, '100', '200', '0', '1', '2022-01-16 17:34:26', '2022-01-18 05:33:48', '2022-01-18 05:33:48', NULL),
(58, 0, 10, 1, '200', '300', '0', '2', '2022-01-16 18:45:50', '2022-01-18 04:15:06', '2022-01-18 04:15:06', NULL),
(59, 0, 10, 3, '100', '200', '0', '2', '2022-01-16 18:45:50', '2022-01-18 04:15:06', '2022-01-18 04:15:06', NULL),
(62, 13, NULL, 1, '200', '300', '0', '21', '2022-01-19 11:39:35', '2022-01-25 08:44:13', '2022-01-25 08:44:13', NULL),
(63, 14, NULL, 1, '200', '300', '0', '5', '2022-01-21 16:08:00', '2022-01-21 16:08:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `store_name` varchar(200) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `address` varchar(250) NOT NULL,
  `bill_note` varchar(300) NOT NULL DEFAULT 'Note is not defined yet',
  `cheque_alert` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `store_name`, `logo`, `contact_no`, `email`, `address`, `bill_note`, `cheque_alert`, `created_at`, `updated_at`) VALUES
(1, 'Easy Store', 'logo.png', '0772794984', 'sdf@email.com', 'Main Street, Oddamavadi, Batticaloa', 'Note is not defined yet', 5, '2021-11-04 08:05:54', '2021-12-31 16:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`id`, `store_id`, `product_id`, `quantity`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '10.00', 'p', 1, '2021-10-30 11:04:02', '2021-10-30 11:04:02'),
(2, 1, 1, '90.00', 'p', 1, '2021-10-30 11:05:04', '2021-10-30 11:05:04'),
(3, 2, 2, '34.00', 'Purchase', 1, '2021-10-30 11:06:20', '2021-10-30 11:06:20'),
(4, 1, 3, '10.00', 'Purchase', 1, '2021-12-22 02:54:45', '2021-12-22 02:54:45'),
(5, 1, 3, '-1.00', 'Damaged', 1, '2021-12-22 03:42:29', '2021-12-22 03:42:29'),
(6, 1, 3, '20.00', 'Added', 1, '2021-12-22 03:42:48', '2021-12-22 03:42:48'),
(7, 2, 3, '1.00', 'Addedd', 1, '2021-12-22 03:44:22', '2021-12-22 03:44:22'),
(8, 2, 1, '5.00', 'dfdf', 1, '2022-01-13 05:36:27', '2022-01-13 05:36:27'),
(9, 2, 4, '10.00', 'Purchase', 1, '2022-01-18 09:40:20', '2022-01-18 09:40:20'),
(10, 1, 2, '487.00', 'Purchase', 1, '2022-01-23 02:52:55', '2022-01-23 02:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `code`, `name`, `address`, `email`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'HEAD', 'Head Store', 'Umar Ibn Abdul Aziz Rd, Az Zahra, Riyadh', 'contact@easystore.com', '+96656949846', '2021-10-27 11:11:03', '2021-10-27 11:11:03'),
(2, 'BR-ODD', 'Oddamavadi Branch', 'Oddamavadi, Batticaloa, Sri Lanka', 'odd@easystore.lk', '+94772794984', '2021-10-27 08:58:04', '2021-10-27 08:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE `store_products` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_products`
--

INSERT INTO `store_products` (`id`, `store_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '14.00', '2021-10-30 11:04:02', '2022-01-28 18:01:16'),
(2, 1, 1, '51.00', '2021-10-30 11:05:05', '2022-01-28 18:01:16'),
(4, 1, 3, '26.96', '2021-12-22 02:54:45', '2022-01-18 05:35:16'),
(5, 2, 3, '1.00', '2021-12-22 03:44:23', '2022-01-18 07:48:13'),
(6, 2, 2, '9.00', '2022-01-17 09:52:07', '2022-01-28 18:02:05'),
(7, 1, 2, '-6.00', '2022-01-17 09:53:14', '2022-01-28 18:02:05'),
(8, 2, 4, '10.00', '2022-01-18 09:40:20', '2022-01-18 09:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `transfer_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference` varchar(100) DEFAULT NULL,
  `from_store` int(11) NOT NULL,
  `to_store` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `note` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `transfer_date`, `reference`, `from_store`, `to_store`, `cost`, `status`, `note`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-12-06 21:00:00', NULL, 1, 2, '1000', 'Pending', 'fdf', 1, '2021-12-07 09:25:51', '2022-01-28 18:00:46', NULL),
(5, '2022-01-19 21:00:00', '4567', 1, 2, '300', 'Pending', NULL, 1, '2022-01-27 09:05:37', '2022-01-28 17:26:07', NULL),
(6, '2022-01-27 21:00:00', '789', 1, 2, '800', 'Pending', NULL, 1, '2022-01-28 16:43:44', '2022-01-28 18:01:16', NULL),
(7, '2022-01-27 21:00:00', '789', 2, 1, '3000', 'Pending', NULL, 1, '2022-01-28 16:45:08', '2022-01-28 18:02:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_items`
--

CREATE TABLE `transfer_items` (
  `id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_items`
--

INSERT INTO `transfer_items` (`id`, `transfer_id`, `product_id`, `cost`, `price`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '200', '500', '5', '2021-12-07 12:25:52', '2021-12-07 12:25:52', NULL),
(2, 2, 2, '200', '500', '1', '2021-12-07 12:38:38', '2021-12-07 12:38:38', NULL),
(3, 2, 1, '200', '300', '500', '2021-12-07 12:38:38', '2021-12-07 12:38:38', NULL),
(4, 5, 1, '200', '300', '1', '2022-01-27 12:05:37', '2022-01-27 12:05:37', NULL),
(5, 6, 2, '200', '500', '1', '2022-01-28 19:43:44', '2022-01-28 19:43:44', NULL),
(6, 6, 1, '200', '300', '1', '2022-01-28 19:43:44', '2022-01-28 19:43:44', NULL),
(7, 7, 2, '200', '500', '6', '2022-01-28 19:45:08', '2022-01-28 19:45:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role_id`, `store_id`, `remember_token`, `last_login_ip`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '', NULL, '$2y$10$gLZ3Z4yKkLpFXmG12lWVLOkwRbVQdAdaQ46dW5q0HiiMsg.0p38ZC', 1, 1, NULL, '127.0.0.1', '2022-01-28 16:40:18', '2021-11-01 12:23:32', '2022-01-28 16:40:18', NULL),
(2, 'Mohamed Nifras', 'nifras', 'nifras@email.com', NULL, '$2y$10$n2bVMlXdntEA3EDa1igcIuhbFO7dQeQObGr5EnBCLkvH.Vq//LCa6', 3, 1, NULL, '127.0.0.1', '2022-01-16 08:42:23', '2021-12-23 05:55:45', '2022-01-16 08:42:23', NULL),
(3, 'Mohamed Nifras', 'ajmal', 'ajmal@email.com', NULL, '$2y$10$NbRXBAGp0nb2Ak1FF6hLeeUtGrvoJWMY4C2JF9.fHOyDjzP/SogvK', 2, 1, NULL, '127.0.0.1', '2022-01-21 13:35:30', '2022-01-21 13:35:11', '2022-01-21 13:35:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `user_ip`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', '2022-01-16 08:17:15', '2022-01-16 08:17:15'),
(2, 2, '127.0.0.1', '2022-01-16 08:42:23', '2022-01-16 08:42:23'),
(3, 1, '127.0.0.1', '2022-01-16 08:44:00', '2022-01-16 08:44:00'),
(4, 1, '127.0.0.1', '2022-01-16 12:56:50', '2022-01-16 12:56:50'),
(5, 1, '127.0.0.1', '2022-01-17 06:56:30', '2022-01-17 06:56:30'),
(6, 1, '127.0.0.1', '2022-01-18 02:19:02', '2022-01-18 02:19:02'),
(7, 1, '127.0.0.1', '2022-01-19 04:58:42', '2022-01-19 04:58:42'),
(8, 1, '127.0.0.1', '2022-01-21 12:56:55', '2022-01-21 12:56:55'),
(9, 3, '127.0.0.1', '2022-01-21 13:35:30', '2022-01-21 13:35:30'),
(10, 1, '127.0.0.1', '2022-01-23 01:51:47', '2022-01-23 01:51:47'),
(11, 1, '127.0.0.1', '2022-01-25 08:39:52', '2022-01-25 08:39:52'),
(12, 1, '127.0.0.1', '2022-01-26 02:05:34', '2022-01-26 02:05:34'),
(13, 1, '127.0.0.1', '2022-01-26 08:17:14', '2022-01-26 08:17:14'),
(14, 1, '127.0.0.1', '2022-01-27 07:48:14', '2022-01-27 07:48:14'),
(15, 1, '127.0.0.1', '2022-01-28 16:40:18', '2022-01-28 16:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `permission` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'All', '2021-11-29 11:15:21', '2021-11-29 11:15:21'),
(2, 'Admin', 'All', '2021-11-29 11:15:21', '2021-11-29 11:15:21'),
(3, 'Cashier', 'pos,products,categories', '2021-11-29 08:18:35', '2021-11-29 09:19:29'),
(4, 'Accountant', 'contacts,sales,purchases', '2021-11-29 09:16:19', '2021-11-29 09:20:15'),
(5, 'User 1', '', '2022-01-01 11:38:18', '2022-01-01 11:39:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_code` (`code`),
  ADD UNIQUE KEY `category_name` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_code` (`code`),
  ADD UNIQUE KEY `category_name` (`name`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_supplier` (`is_supplier`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Date` (`expense_date`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_id` (`contact_id`),
  ADD KEY `amount` (`amount`),
  ADD KEY `payment_type` (`payment_type`),
  ADD KEY `cheque_no` (`cheque_no`),
  ADD KEY `cheque_status` (`cheque_status`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `invoiceid` (`reference_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_id` (`contact_id`),
  ADD KEY `total` (`total`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`product_id`),
  ADD KEY `tbl_sold_items_ibfk_1` (`purchase_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_items`
--
ALTER TABLE `quotation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`product_id`),
  ADD KEY `tbl_sold_items_ibfk_1` (`quotation_id`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_histories`
--
ALTER TABLE `register_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_id` (`contact_id`),
  ADD KEY `total` (`total`);

--
-- Indexes for table `sale_holds`
--
ALTER TABLE `sale_holds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_id` (`contact_id`),
  ADD KEY `total` (`total`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`product_id`),
  ADD KEY `tbl_sold_items_ibfk_1` (`sale_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_items`
--
ALTER TABLE `transfer_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`product_id`),
  ADD KEY `tbl_sold_items_ibfk_1` (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_items`
--
ALTER TABLE `quotation_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_histories`
--
ALTER TABLE `register_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sale_holds`
--
ALTER TABLE `sale_holds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transfer_items`
--
ALTER TABLE `transfer_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
