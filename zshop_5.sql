-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- 主機: localhost:3306
-- 產生時間： 2021 年 09 月 08 日 16:06
-- 伺服器版本: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP 版本： 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `zshop_5`
--

-- --------------------------------------------------------

--
-- 資料表結構 `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `quantity`, `created_at`, `updated_at`) VALUES
(70, 2, 3, 2, '2021-08-22 22:59:51', '2021-08-22 23:03:53'),
(71, 1, 3, 1, '2021-08-22 23:04:08', '2021-08-22 23:04:08');

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `is_parent`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '3C', '3C', 1, NULL, 'active', '2021-08-18 01:49:00', '2021-08-18 01:49:00'),
(2, '日常', 'Daily Necessities', 1, NULL, 'active', '2021-08-18 01:50:00', '2021-08-18 01:50:00'),
(3, '筆電', 'Notebook', 0, 1, 'active', '2021-08-18 01:51:00', '2021-08-18 01:51:00'),
(4, '桌電', 'Desktop', 0, 1, 'active', '2021-08-18 01:52:00', '2021-08-18 01:52:00'),
(5, '電腦螢幕', 'Monitor', 0, 1, 'active', '2021-08-18 01:53:00', '2021-08-18 01:53:00'),
(6, '通訊', 'Telenoticias', 1, NULL, 'active', '2021-08-18 01:54:00', '2021-08-18 01:54:00'),
(7, '家電', 'Appliances', 1, NULL, 'active', '2021-08-18 01:55:00', '2021-08-18 01:55:00'),
(8, '食品', 'Food', 1, NULL, 'active', '2021-08-18 01:55:00', '2021-08-18 01:55:00');

-- --------------------------------------------------------

--
-- 資料表結構 `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_line` int(11) NOT NULL,
  `coupon_amount` int(11) NOT NULL,
  `coupon_type` int(11) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `name`, `coupon_line`, `coupon_amount`, `coupon_type`, `status`, `created_at`, `updated_at`) VALUES
(1, '', '滿三萬現折一百', 30000, 100, 1, 'inactive', '2021-08-18 16:00:00', '2021-09-06 23:31:47'),
(3, '0000', '滿三萬送一百購物金', 30000, 100, 2, 'inactive', '2021-08-18 16:00:00', '2021-09-06 00:54:01'),
(4, '0001', '滿十萬現折兩百', 100000, 200, 1, 'inactive', '2021-08-18 16:00:00', '2021-09-03 00:22:45'),
(5, '0002', '滿十萬送兩百購物金', 100000, 200, 2, 'inactive', '2021-08-18 16:00:00', '2021-09-03 00:22:48'),
(6, '1010', '滿一百現折十元', 100, 10, 1, 'inactive', NULL, '2021-09-06 23:31:44'),
(7, '1020', '滿一百送購物金十元', 100, 10, 2, 'active', NULL, '2021-09-05 22:47:40'),
(8, NULL, '滿50000送500', 50000, 500, 1, 'inactive', '2021-09-02 23:11:38', '2021-09-03 00:22:54'),
(9, NULL, '滿1000送100', 1000, 100, 2, 'inactive', '2021-09-03 00:21:38', '2021-09-05 18:32:03'),
(10, NULL, 'oooo', 10000, 130, 1, 'inactive', '2021-09-06 00:53:08', '2021-09-06 23:31:32'),
(11, NULL, 'ioii', 9999, 900, 2, 'inactive', '2021-09-06 00:56:46', '2021-09-06 23:31:38');

-- --------------------------------------------------------

--
-- 資料表結構 `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8_unicode_ci,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `messages`
--

INSERT INTO `messages` (`id`, `name`, `subject`, `user_id`, `order_id`, `email`, `phone`, `message`, `read_at`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
(13, '44', '1', 3, 7, NULL, '444', '666', NULL, 0, NULL, '2021-08-25 20:16:31', '2021-08-25 20:16:31'),
(14, '44', '1', 3, 7, NULL, '444', '666', NULL, 0, NULL, '2021-08-25 21:32:57', '2021-08-25 21:32:57'),
(15, '123', '1', 3, 12, '123', '123', '4444', NULL, 0, NULL, '2021-08-26 18:00:00', '2021-08-26 18:00:00'),
(17, '123', '2', 4, 12, '123', '123', '5555', NULL, 0, NULL, '2021-08-26 19:00:00', '2021-08-26 19:00:00'),
(18, 'gggg', '1', 3, 12, NULL, 'gggg', '666', NULL, 0, NULL, '2021-08-26 18:47:50', '2021-08-26 18:47:50'),
(19, 'fff', '1', 3, 25, NULL, 'fff', 'ddd', NULL, 0, NULL, '2021-08-30 19:15:57', '2021-08-30 19:15:57'),
(20, 'fff', '2', NULL, 25, NULL, 'fff', 'ddd', NULL, 0, NULL, '2021-08-30 19:49:11', '2021-08-30 19:49:11'),
(21, 'dsfadsf', '1', 21, 26, NULL, 'asdfasdf', '555', NULL, 0, NULL, '2021-08-31 00:07:57', '2021-08-31 00:07:57'),
(22, 'dsf', '1', NULL, NULL, 'sadf@gmail.com', NULL, 'sadgdsagsdfasd', NULL, 0, NULL, '2021-08-31 00:15:49', '2021-08-31 00:15:49'),
(23, 'ddd', '2', 21, 29, NULL, 'ddd', '666', NULL, 0, NULL, '2021-08-31 00:37:23', '2021-08-31 00:37:23'),
(24, 'yy', '1', NULL, NULL, 'yy@gmail.com', NULL, 'dddddyyyyyy', NULL, 0, NULL, '2021-09-02 23:40:54', '2021-09-02 23:40:54'),
(25, 'dsfa', '2', 23, 36, NULL, 'asdf', 'ㄎㄎ', NULL, 0, NULL, '2021-09-06 01:05:06', '2021-09-06 01:05:06');

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_08_17_070117_create_user_levels_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2021_08_18_012638_create_categories_table', 2),
(5, '2021_08_18_013057_create_products_table', 2),
(6, '2021_08_18_091234_create_reward_money_histories_table', 3),
(7, '2021_08_19_010641_create_coupons_table', 4),
(8, '2021_08_19_011500_create_orders_table', 4),
(9, '2021_08_19_011642_create_messages_table', 4),
(10, '2021_08_19_015548_create_carts_table', 5),
(13, '2021_08_20_055737_create_settings_table', 6),
(14, '2021_08_19_020509_create_wishlists_table', 7),
(15, '2021_08_19_021506_create_order_items_table', 8),
(16, '2021_09_01_023243_create_product_imgs_table', 9);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `shipping_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `reward_money` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `subtotal`, `shipping_id`, `coupon_id`, `reward_money`, `total`, `quantity`, `status`, `name`, `email`, `phone`, `post_code`, `address`, `created_at`, `updated_at`) VALUES
(4, '202108251629880859', 3, 155400, NULL, 4, NULL, 155199, 6, 1, 'fsdgasdg', NULL, 'adsgasdg', 'agasgd', 'asdgasdg', '2021-08-25 00:40:59', '2021-08-25 00:40:59'),
(6, '202108251629881166', 3, 27900, NULL, 7, NULL, 27890, 1, 4, 'aaa', NULL, 'aaaa', 'aaaa', 'aaaa', '2021-08-25 00:46:06', '2021-08-26 22:28:25'),
(7, '202108251629881558', 3, 27900, NULL, 6, 50, 27840, 1, 4, '44', NULL, '444', '44', '44', '2021-08-25 00:52:38', '2021-08-25 21:36:40'),
(8, '202108251629881682', 3, 24900, NULL, 7, 100, 24800, 1, 0, 'gg', NULL, 'gg', 'gg', 'gg', '2021-08-25 00:54:42', '2021-08-25 22:33:22'),
(9, '202108251629881785', 3, 27900, NULL, NULL, 5, 27895, 1, 2, 'ggh', NULL, 'hhh', 'hh', 'hhh', '2021-08-25 00:56:25', '2021-09-06 23:09:35'),
(10, '202108251629882396', 3, 27900, NULL, 6, NULL, 27890, 1, 4, 'ggg', NULL, 'ggg', 'ggg', 'ggg', '2021-08-25 01:06:36', '2021-08-26 02:00:52'),
(11, '202108261629943583', 3, 108600, NULL, 4, 45, 108355, 4, 0, 'tt', NULL, 'tt', 'tt', 'tt', '2021-08-25 18:06:23', '2021-08-25 22:17:47'),
(12, '202108261629958727', 3, 55800, NULL, 1, NULL, 55690, 2, 4, 'gggg', NULL, 'gggg', 'gggg', 'ggg', '2021-08-25 22:18:47', '2021-08-25 22:52:21'),
(13, '202108271630026770', 3, 52800, NULL, 1, NULL, 52690, 2, 3, 'qq', NULL, 'qq', 'q', 'qq', '2021-08-26 17:12:50', '2021-09-06 23:09:20'),
(14, '202108271630027284', 3, 52800, NULL, 1, 10, 52690, 2, 5, 'wqewq', NULL, 'qwewqe', 'qweqwe', 'qweqwe', '2021-08-26 17:21:24', '2021-08-26 17:23:36'),
(15, '202108271630045802', 3, 27900, NULL, 7, 0, 27900, 1, 4, 'asdfa', NULL, 'cdsf', 'adf', 'adsgasdfasdfdafadsf', '2021-08-26 22:30:02', '2021-08-26 22:30:43'),
(16, '202108271630046520', 3, 27900, NULL, 7, 0, 27900, 1, 4, 'd', NULL, 'd', 'd', 'dfkjkl;dsjag;lj', '2021-08-26 22:42:00', '2021-08-26 22:42:16'),
(17, '202108271630046758', 3, 27900, NULL, 7, 20, 27880, 1, 4, 'f', NULL, 'd', 'd', 'd', '2021-08-26 22:45:58', '2021-08-26 22:46:13'),
(18, '202108271630047007', 3, 24900, NULL, 7, 0, 24900, 1, 4, 'dd', NULL, 'dd', 'dd', 'dd', '2021-08-26 22:50:07', '2021-08-26 22:50:28'),
(19, '202108271630047439', 3, 24900, NULL, 7, 0, 24900, 1, 4, 'asdfafadf', NULL, 'adsf', 'asdf', 'daffadsfgdasggggg', '2021-08-26 22:57:19', '2021-08-26 22:57:32'),
(20, '202108271630047668', 3, 24900, NULL, 7, 0, 24900, 1, 5, 'fs', NULL, 'dfasdf', 'adsf', 'asdf', '2021-08-26 23:01:08', '2021-08-29 19:08:12'),
(21, '202108271630047758', 3, 24900, NULL, 7, 0, 24900, 1, 0, 'fdaf', NULL, 'asdf', 'adsf', 'asdf', '2021-08-26 23:02:38', '2021-08-26 23:03:02'),
(22, '202108271630047970', 3, 24900, NULL, NULL, 0, 24900, 1, 0, 'dsf', NULL, 'asdfasdf', 'sadf', 'adsgasdfasdfdafadsf', '2021-08-26 23:06:10', '2021-08-26 23:06:30'),
(23, '202108271630051488', 3, 105600, NULL, 4, 100, 105300, 4, 5, 'fff', NULL, 'fff', 'fff', 'ffff', '2021-08-27 00:04:48', '2021-08-29 17:40:45'),
(24, '202108301630293435', 3, 27900, NULL, 6, 100, 27790, 1, 5, 'tt', NULL, 'tt', 'tt', 'tt', '2021-08-29 19:17:15', '2021-08-29 19:17:49'),
(25, '202108301630294079', 3, 24900, NULL, 7, 100, 24800, 1, 5, 'fff', NULL, 'fff', 'ff', 'ff', '2021-08-29 19:27:59', '2021-08-29 19:28:34'),
(26, '202108311630397256', 21, 111600, NULL, 5, 0, 111600, 4, 0, 'dsfadsf', NULL, 'asdfasdf', 'asdfasdf', 'sdafdsaf', '2021-08-31 00:07:36', '2021-08-31 17:46:18'),
(27, '202108311630397491', 21, 24900, NULL, 6, 100, 24790, 1, 0, 'sadas', NULL, 'asd', 'asd', 'asdfasdf', '2021-08-31 00:11:31', '2021-08-31 00:11:52'),
(28, '202108311630398390', 21, 178398, NULL, NULL, 0, 178398, 9, 6, 'fsga', NULL, 'asdf', 'sadf', 'sdaf', '2021-08-31 00:26:30', '2021-09-02 02:08:35'),
(29, '202108311630398583', 21, 118932, NULL, 4, 100, 118632, 6, 5, 'ddd', NULL, 'ddd', 'ddd', 'dd', '2021-08-31 00:29:43', '2021-09-02 01:22:53'),
(30, '202109021630561033', 7, 1000, NULL, 6, 0, 990, 1, 4, 'daf', NULL, 'asdf', 'asdf', 'adsgasdfasdfdafadsf', '2021-09-01 21:37:13', '2021-09-01 21:43:44'),
(31, '202109031630632807', 22, 52800, NULL, NULL, 0, 52800, 2, 6, 'xxx', NULL, 'xxx', 'xxx', 'xxx', '2021-09-02 17:33:27', '2021-09-06 01:05:51'),
(32, '202109031630633595', 22, 52800, NULL, 3, 0, 52800, 2, 4, '666', NULL, '666', '6666', '6666', '2021-09-02 17:46:35', '2021-09-02 19:23:18'),
(33, '202109031630641922', 22, 27900, NULL, 7, 0, 27900, 1, 4, 'hh', NULL, 'hh', 'hh', 'hh', '2021-09-02 20:05:22', '2021-09-02 20:11:10'),
(34, '202109031630642485', 22, 227898, NULL, 4, 20, 227678, 3, 6, 'dd', NULL, 'ddd', 'ddd', 'ddd', '2021-09-02 20:14:45', '2021-09-02 20:28:49'),
(35, '202109031630656416', 23, 52800, NULL, 3, 0, 52800, 2, 6, '444', NULL, '44', '44', '444', '2021-09-03 00:06:56', '2021-09-03 00:14:44'),
(36, '202109031630657528', 23, 4000, NULL, NULL, 0, 4000, 1, 4, 'dsfa', NULL, 'asdf', 'asdf', 'asdf', '2021-09-03 00:25:28', '2021-09-03 00:25:37');

-- --------------------------------------------------------

--
-- 資料表結構 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `is_return`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 2, 27900, 0, '2021-08-25 00:40:59', '2021-08-25 00:40:59'),
(2, 4, 2, 4, 24900, 0, '2021-08-25 00:40:59', '2021-08-25 00:40:59'),
(5, 6, 1, 1, 27900, 0, '2021-08-25 00:46:06', '2021-08-25 00:46:06'),
(6, 7, 1, 1, 27900, 0, '2021-08-25 00:52:38', '2021-08-25 00:52:38'),
(7, 8, 2, 1, 24900, 0, '2021-08-25 00:54:42', '2021-08-25 00:54:42'),
(8, 9, 1, 1, 27900, 0, '2021-08-25 00:56:25', '2021-08-25 00:56:25'),
(9, 10, 1, 1, 27900, 0, '2021-08-25 01:06:36', '2021-08-25 01:06:36'),
(10, 11, 1, 3, 27900, 0, '2021-08-25 18:06:23', '2021-08-25 18:06:23'),
(11, 11, 2, 1, 24900, 0, '2021-08-25 18:06:23', '2021-08-25 18:06:23'),
(12, 12, 1, 2, 27900, 0, '2021-08-25 22:18:47', '2021-08-25 22:18:47'),
(13, 13, 1, 1, 27900, 0, '2021-08-26 17:12:50', '2021-08-26 17:12:50'),
(14, 13, 2, 1, 24900, 0, '2021-08-26 17:12:50', '2021-08-26 17:12:50'),
(15, 14, 1, 1, 27900, 0, '2021-08-26 17:21:24', '2021-08-26 17:21:24'),
(16, 14, 2, 1, 24900, 0, '2021-08-26 17:21:24', '2021-08-26 17:21:24'),
(17, 15, 1, 1, 27900, 0, '2021-08-26 22:30:02', '2021-08-26 22:30:02'),
(18, 16, 1, 1, 27900, 0, '2021-08-26 22:42:00', '2021-08-26 22:42:00'),
(19, 17, 1, 1, 27900, 0, '2021-08-26 22:45:58', '2021-08-26 22:45:58'),
(20, 18, 2, 1, 24900, 0, '2021-08-26 22:50:07', '2021-08-26 22:50:07'),
(21, 19, 2, 1, 24900, 0, '2021-08-26 22:57:19', '2021-08-26 22:57:19'),
(22, 20, 2, 1, 24900, 0, '2021-08-26 23:01:08', '2021-08-26 23:01:08'),
(23, 21, 2, 1, 24900, 0, '2021-08-26 23:02:38', '2021-08-26 23:02:38'),
(24, 22, 2, 1, 24900, 0, '2021-08-26 23:06:10', '2021-08-26 23:06:10'),
(25, 14, 1, 1, 27900, 1, '2021-08-26 23:36:48', '2021-08-26 23:36:48'),
(26, 14, 2, 1, 24900, 1, '2021-08-26 23:36:48', '2021-08-26 23:36:48'),
(27, 23, 1, 2, 27900, 0, '2021-08-27 00:04:48', '2021-08-27 00:04:48'),
(28, 23, 2, 2, 24900, 0, '2021-08-27 00:04:48', '2021-08-27 00:04:48'),
(29, 23, 1, 1, 27900, 1, '2021-08-29 17:40:45', '2021-08-29 17:40:45'),
(30, 23, 2, 1, 24900, 1, '2021-08-29 17:40:45', '2021-08-29 17:40:45'),
(31, 20, 2, 1, 24900, 1, '2021-08-29 19:08:12', '2021-08-29 19:08:12'),
(32, 24, 1, 1, 27900, 0, '2021-08-29 19:17:15', '2021-08-29 19:17:15'),
(33, 24, 1, 1, 27900, 1, '2021-08-29 19:17:49', '2021-08-29 19:17:49'),
(34, 25, 2, 1, 24900, 0, '2021-08-29 19:27:59', '2021-08-29 19:27:59'),
(35, 25, 2, 1, 24900, 1, '2021-08-29 19:28:34', '2021-08-29 19:28:34'),
(36, 26, 1, 4, 27900, 0, '2021-08-31 00:07:36', '2021-08-31 00:07:36'),
(37, 26, 1, 2, 27900, 1, '2021-08-31 00:09:43', '2021-08-31 00:09:43'),
(38, 27, 2, 1, 24900, 0, '2021-08-31 00:11:31', '2021-08-31 00:11:31'),
(39, 28, 1, 3, 27900, 0, '2021-08-31 00:26:30', '2021-08-31 00:26:30'),
(40, 28, 2, 3, 24900, 0, '2021-08-31 00:26:30', '2021-08-31 00:26:30'),
(41, 28, 5, 3, 6666, 0, '2021-08-31 00:26:30', '2021-08-31 00:26:30'),
(42, 28, 1, 1, 27900, 1, '2021-08-31 00:27:32', '2021-08-31 00:27:32'),
(43, 28, 2, 2, 24900, 1, '2021-08-31 00:27:32', '2021-08-31 00:27:32'),
(44, 28, 5, 3, 6666, 1, '2021-08-31 00:27:32', '2021-08-31 00:27:32'),
(45, 29, 1, 2, 27900, 0, '2021-08-31 00:29:43', '2021-08-31 00:29:43'),
(46, 29, 2, 2, 24900, 0, '2021-08-31 00:29:43', '2021-08-31 00:29:43'),
(47, 29, 5, 2, 6666, 0, '2021-08-31 00:29:43', '2021-08-31 00:29:43'),
(48, 29, 1, 1, 27900, 1, '2021-08-31 00:30:25', '2021-08-31 00:30:25'),
(49, 29, 2, 1, 24900, 1, '2021-08-31 00:30:25', '2021-08-31 00:30:25'),
(50, 29, 5, 1, 6666, 1, '2021-08-31 00:30:25', '2021-08-31 00:30:25'),
(51, 30, 27, 1, 1000, 0, '2021-09-01 21:37:13', '2021-09-01 21:37:13'),
(52, 31, 1, 1, 27900, 0, '2021-09-02 17:33:27', '2021-09-02 17:33:27'),
(53, 31, 2, 1, 24900, 0, '2021-09-02 17:33:27', '2021-09-02 17:33:27'),
(60, 31, 1, 1, 27900, 1, '2021-09-02 17:45:18', '2021-09-02 17:45:18'),
(61, 31, 2, 1, 24900, 1, '2021-09-02 17:45:18', '2021-09-02 17:45:18'),
(62, 32, 1, 1, 27900, 0, '2021-09-02 17:46:35', '2021-09-02 17:46:35'),
(63, 32, 2, 1, 24900, 0, '2021-09-02 17:46:35', '2021-09-02 17:46:35'),
(66, 32, 1, 1, 27900, 1, '2021-09-02 19:27:19', '2021-09-02 19:27:19'),
(67, 33, 1, 1, 27900, 0, '2021-09-02 20:05:22', '2021-09-02 20:05:22'),
(68, 34, 1, 1, 27900, 0, '2021-09-02 20:14:45', '2021-09-02 20:14:45'),
(69, 34, 13, 2, 99999, 0, '2021-09-02 20:14:45', '2021-09-02 20:14:45'),
(70, 34, 1, 1, 27900, 1, '2021-09-02 20:15:44', '2021-09-02 20:15:44'),
(71, 34, 13, 1, 99999, 1, '2021-09-02 20:15:44', '2021-09-02 20:15:44'),
(72, 35, 1, 1, 27900, 0, '2021-09-03 00:06:56', '2021-09-03 00:06:56'),
(73, 35, 2, 1, 24900, 0, '2021-09-03 00:06:56', '2021-09-03 00:06:56'),
(74, 35, 2, 1, 24900, 1, '2021-09-03 00:07:50', '2021-09-03 00:07:50'),
(75, 36, 24, 1, 4000, 0, '2021-09-03 00:25:28', '2021-09-03 00:25:28');

-- --------------------------------------------------------

--
-- 資料表結構 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test001@gmail.com', '$2y$10$p7ROk/814.orRvDFgvxaUuo.u32SOKJbwzn/3sMg529PB8P2kwg1W', '2021-08-17 23:38:49');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `photo` text COLLATE utf8_unicode_ci,
  `stock` int(11) NOT NULL DEFAULT '1',
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `price` int(11) NOT NULL,
  `special_price` int(11) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `photo`, `stock`, `size`, `state`, `status`, `price`, `special_price`, `is_featured`, `category_id`, `subcategory_id`, `created_at`, `updated_at`) VALUES
(1, 'ACER Aspire A715-75G-70V7 黑', 'A715-75G-70V7', '15吋大螢幕★GTX1650Ti獨顯★再享好禮雙重抽', '處理器：Intel® Core™ i7-10750H\r\n顯示晶片：NVIDIA® GeForce® GTX 1650Ti\r\n記憶體：8GB DDR4\r\n硬碟：512GB PCIe NVMe SSD\r\n螢幕：15.6\" FHD/IPS/霧面/LED背光\r\n無線網路：802.11a/b/g/n/acR2+ax2x2 MU-MIMO\r\n其他：Bluetooth® 5.1、Type-C\r\n軟體：Windows 10 Home', '/storage/photos/Products/A715-75G-70V7.jpg', 86, NULL, NULL, 'active', 30900, 27900, 1, 1, 3, '2021-08-18 02:09:00', '2021-09-03 00:06:56'),
(2, 'ASUS X515JP-0471S1035G1 冰柱銀\r\n15.6吋窄邊獨顯筆電', 'X515JP-0471S1035G1', '10代i5★MX330獨顯★512G PCIe\r\n', '處理器：Intel® Core™ i5-1035G1 Processor 1.0 GHz\r\n記憶體：8GB DDR4 on board\r\n硬碟：512GB M.2 NVMe™ PCIe® 3.0 SSD\r\n獨立顯卡：Nvidia GeForce MX330 2G獨顯\r\nLCD尺寸：15.6\" FHD (1920x1080)\r\n無線網路：Wi-Fi 5(802.11ac)+Bluetooth 4.1 (Dual band) 1*1\r\n光碟機：無\r\n重量：1.8kg\r\n其他：HDMI、USB3.2 Type C\r\n作業系統：Windows 10 Home 64 Bits\r\n', '/storage/photos/Products/X515JP-0471S1035G1.jpg', 86, NULL, NULL, 'active', 27900, 24900, 1, 1, 3, '2021-08-18 16:00:00', '2021-09-03 00:06:56'),
(5, '3C蘋果', '3c_apple', 'appleapple', 'ooooooooooo', NULL, 3, 's,m,l', NULL, 'inactive', 6666, 6666, 1, 1, NULL, '2021-08-30 23:49:41', '2021-09-01 19:10:54'),
(6, 'ddd', 'dd', 'dd', 'dfsfsadfadsf', NULL, 90, NULL, NULL, 'inactive', 10000, 9000, 1, 1, NULL, '2021-08-31 00:39:15', '2021-09-01 00:04:03'),
(7, 'ggg', 'gg', 'gg', 'fdsgasfg', NULL, 990, 's', NULL, 'inactive', 60000, 50000, 1, 1, NULL, '2021-08-31 19:11:47', '2021-09-01 00:04:12'),
(9, 'ggg', 'ggggggg', 'ggggg', 'fdsgasfg', NULL, 990, 's', NULL, 'inactive', 60000, 50000, 1, 1, NULL, '2021-08-31 19:12:39', '2021-09-01 00:04:18'),
(10, '567', '567', '567', '314314134', NULL, 88, '567', NULL, 'inactive', 55555, 44444, 1, 1, NULL, '2021-08-31 19:16:55', '2021-09-01 19:10:59'),
(13, 'Armor', 'Armor_a', 'armor', 'ddddddddd', NULL, 47, 'F', NULL, 'active', 99999, 99999, 1, 1, NULL, '2021-08-31 19:38:33', '2021-09-02 20:14:45'),
(21, 'biggg音響', 'biggg', 'lllll', 'kljsdfa;kdsajf', '/storage/photos/ilHU0SN0gVL7bvZQJNi0sg35ZN76n1gn1qBe4ZLX.jpeg,/storage/photos/v59Vz58B4KOz6OLEfSSjAcsBfURZIenc3CSuIOSo.jpeg', 111, 'F', NULL, 'inactive', 8000, 6000, 1, 1, NULL, '2021-08-31 22:59:59', '2021-09-01 19:11:06'),
(22, 'ofdajofla', 'ojsadfjgoj', 'adjslfj;l', 'salfkjgal;kj', '/storage/photos/8AxL4WSKAkmZ4DcesjHWHhOnC3JNvMqrfjmacjIA.jpeg,/storage/photos/BIKaaBfxu3cZIh3dd8p4K0uuwi5WqyFj2ShgFm5s.jpeg,/storage/photos/plmXJZ04MZfe17eXq58rqm9UMrwiCs5LlhwILHHz.png', 9, NULL, NULL, 'inactive', 566, 500, 1, 1, NULL, '2021-08-31 23:50:24', '2021-09-01 19:12:17'),
(23, '盆摘444', 'er444', 'er4444444', '34gdsagffg', '/storage/photos/sTkwPIKx3xVjGvEsF9QcAlh1ib3jWhX8ZQQQrv3I.jpeg,/storage/photos/2W7wSGZft62xoRN944wFVRdhzHUrCV8dfbwRFaTD.jpeg,/storage/photos/1wHLaL6dFOcvAWluTR0feeS11jof1tVuZ48rZPmo.jpeg', 444, NULL, NULL, 'active', 5000, 4000, 1, 1, NULL, '2021-09-01 01:57:30', '2021-09-01 19:12:09'),
(24, '盆摘555', 'er555', '555', 'jdsfa;lkfgjas;k', '/storage/photos/tfsMKz1YRnixL2DE5kcnAouD4UCQh2DV6Vq9xn65.jpeg', 54, NULL, NULL, 'active', 5000, 4000, 1, 1, NULL, '2021-09-01 02:01:55', '2021-09-03 00:25:28'),
(27, '電球-牛', 'EL-Cow', 'dfadf', 'dsfasgas', '/storage/photos/2gMpGaxcJCOExHHfzjCExoJWI6P0EhaueIU7huAO.jpeg,/storage/photos/gmlSTadt90j3hmA8OVd5tS1QpzRkoBeRtbTexUkq.jpeg,/storage/photos/s2l1LXU96Yk5JweUmG36XgohEywlr06A1KbsKHor.jpeg,/storage/photos/qQ9ailqZkEhzGFpItRlr4ZFtmTV9XQdqsXp47Y4K.jpeg', 99, NULL, NULL, 'active', 100000, 10000, 1, 1, NULL, '2021-09-01 19:05:39', '2021-09-01 22:23:27'),
(29, 'ggggg', 'ggggggg0d000', 'agdga', 'ddddddddd', NULL, 100, NULL, NULL, 'inactive', 9000, 9000, 1, 1, NULL, '2021-09-03 00:16:18', '2021-09-03 00:20:12'),
(30, 'adfsaf', 'A715-75G-70V7', 'asfd', 'dddd', NULL, 90, NULL, NULL, 'active', 7000, 6999, 1, 1, NULL, '2021-09-05 23:21:25', '2021-09-05 23:41:09');

-- --------------------------------------------------------

--
-- 資料表結構 `product_imgs`
--

CREATE TABLE `product_imgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(10) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `product_imgs`
--

INSERT INTO `product_imgs` (`id`, `product_id`, `filepath`, `sort`, `created_at`, `updated_at`) VALUES
(4, 13, '/storage/photos/MatRidj6MBikS2R6fN3Mfu4khv4GKCMa29E8SsFT.jpeg', 1, '2021-08-31 19:38:33', '2021-08-31 19:38:33'),
(6, 23, '/storage/photos/sTkwPIKx3xVjGvEsF9QcAlh1ib3jWhX8ZQQQrv3I.jpeg', 1, '2021-09-01 01:57:30', '2021-09-01 01:57:30'),
(7, 23, '/storage/photos/2W7wSGZft62xoRN944wFVRdhzHUrCV8dfbwRFaTD.jpeg', 1, '2021-09-01 01:57:30', '2021-09-01 01:57:30'),
(8, 23, '/storage/photos/1wHLaL6dFOcvAWluTR0feeS11jof1tVuZ48rZPmo.jpeg', 1, '2021-09-01 01:57:30', '2021-09-01 01:57:30'),
(15, 24, '/storage/photos/Gilr3hjj6dROX80sQpYUGbY8UynD9rZblu5SeFcw.jpeg', 1, '2021-09-01 02:01:55', '2021-09-01 02:01:55'),
(16, 24, '/storage/photos/DQVSsmy3vhDarWtFluuBmLt5jRbPsZjbMJ6pHgY4.jpeg', 1, '2021-09-01 02:01:55', '2021-09-01 02:01:55'),
(17, 24, '/storage/photos/tfsMKz1YRnixL2DE5kcnAouD4UCQh2DV6Vq9xn65.jpeg', 1, '2021-09-01 02:01:55', '2021-09-01 02:01:55'),
(18, 1, '/storage/photos/Products/A715-75G-70V7.jpg', 1, NULL, NULL),
(19, 2, '/storage/photos/Products/X515JP-0471S1035G1.jpg', 1, NULL, NULL),
(28, 27, '/storage/photos/2gMpGaxcJCOExHHfzjCExoJWI6P0EhaueIU7huAO.jpeg', 13, '2021-09-01 19:05:39', '2021-09-01 19:05:39'),
(32, 27, '/storage/photos/KdMCKsBDCKOkabrKQm4pfzzzojWJV3aogvN8z6dI.jpeg', 15, '2021-09-01 22:23:27', '2021-09-01 23:13:17'),
(33, 27, '/storage/photos/5zkD70od6Tt98YMUY8EYCRVcjEzgXROlmaZVBUNB.jpeg', 16, '2021-09-01 22:23:27', '2021-09-01 23:13:29'),
(34, 27, '/storage/photos/BSzIklUxUcRNXs50tAnay6Y2zUCrls4hjT2fiHq8.jpeg', 1, '2021-09-01 23:15:25', '2021-09-01 23:15:25'),
(36, 29, '/storage/photos/cvCfccPkvxC6MAwTaNlZqH72OBLREj29idT3Hn9q.jpeg', 1, '2021-09-03 00:16:18', '2021-09-03 00:16:18'),
(37, 29, '/storage/photos/ciMcN3e8mRwCwjEszRXGSWQ3lowAreNphLUAfjsU.jpeg', 8, '2021-09-03 00:16:18', '2021-09-03 00:16:46'),
(38, 30, '/storage/photos/Dzb82oInGBKByMCaxSjRcaUfb9zhAh2f4BgQyCRE.jpeg', 1, '2021-09-05 23:21:25', '2021-09-05 23:21:25');

-- --------------------------------------------------------

--
-- 資料表結構 `reward_money_histories`
--

CREATE TABLE `reward_money_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `reward_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `reward_money_histories`
--

INSERT INTO `reward_money_histories` (`id`, `user_id`, `reward_item`, `amount`, `total`, `created_at`, `updated_at`) VALUES
(1, 3, '老闆爽給', 500, 500, '2021-08-18 09:40:00', NULL),
(2, 3, '202108251629881558結帳使用', -50, 450, '2021-08-25 00:52:38', '2021-08-25 00:52:38'),
(3, 3, '202108251629881682結帳使用', -100, 350, '2021-08-25 00:54:42', '2021-08-25 00:54:42'),
(4, 3, '202108251629881785結帳使用', -5, 345, '2021-08-25 00:56:25', '2021-08-25 00:56:25'),
(5, 3, '202108261629943583結帳使用', -45, 300, '2021-08-25 18:06:23', '2021-08-25 18:06:23'),
(6, 3, '202108261629958727結帳使用', -10, 290, '2021-08-25 22:18:47', '2021-08-25 22:18:47'),
(7, 3, '202108261629943583訂單取消，購物金退回', 45, 335, '2021-08-25 22:29:56', '2021-08-25 22:29:56'),
(8, 3, '202108251629881682訂單取消，購物金退回', 100, 435, '2021-08-25 22:33:22', '2021-08-25 22:33:22'),
(9, 3, '202108271630026770結帳使用', -10, 425, '2021-08-26 17:12:50', '2021-08-26 17:12:50'),
(10, 3, '202108271630027284結帳使用', -10, 415, '2021-08-26 17:21:24', '2021-08-26 17:21:24'),
(11, 3, '202108271630045802訂單優惠，贈送購物金', 10, 425, '2021-08-26 22:30:43', '2021-08-26 22:30:43'),
(12, 3, '202108271630046520訂單優惠，贈送購物金', 10, 435, '2021-08-26 22:42:16', '2021-08-26 22:42:16'),
(13, 3, '202108271630046758結帳使用', -20, 415, '2021-08-26 22:45:58', '2021-08-26 22:45:58'),
(14, 3, '202108271630046758訂單優惠，贈送購物金', 10, 425, '2021-08-26 22:46:13', '2021-08-26 22:46:13'),
(15, 3, '202108271630047007訂單優惠，贈送購物金', 10, 435, '2021-08-26 22:50:28', '2021-08-26 22:50:28'),
(16, 3, '202108271630047007訂單優惠，贈送購物金', 10, 445, '2021-08-26 22:50:47', '2021-08-26 22:50:47'),
(17, 3, '202108271630047439訂單優惠，贈送購物金', 10, 455, '2021-08-26 22:57:32', '2021-08-26 22:57:32'),
(18, 3, '202108271630047668訂單優惠，贈送購物金', 10, 465, '2021-08-26 23:01:23', '2021-08-26 23:01:23'),
(19, 3, '202108271630047758訂單取消，購物金退回', 0, 465, '2021-08-26 23:03:02', '2021-08-26 23:03:02'),
(20, 3, '202108271630051488結帳使用', -100, 365, '2021-08-27 00:04:48', '2021-08-27 00:04:48'),
(21, 3, '202108301630293435結帳使用', -100, 265, '2021-08-29 19:17:15', '2021-08-29 19:17:15'),
(22, 3, '202108301630294079結帳使用', -100, 165, '2021-08-29 19:27:59', '2021-08-29 19:27:59'),
(23, 3, '202108301630294079訂單優惠，贈送購物金', 10, 175, '2021-08-29 19:28:13', '2021-08-29 19:28:13'),
(24, 3, '中元節獎勵', 500, 675, '2021-08-30 20:17:14', '2021-08-30 20:17:14'),
(25, 3, '不爽收回', -100, 575, '2021-08-30 20:18:04', '2021-08-30 20:18:04'),
(26, 21, '202108311630397256訂單優惠，贈送購物金', 200, 200, '2021-08-31 00:08:13', '2021-08-31 00:08:13'),
(27, 21, '202108311630397491結帳使用', -100, 100, '2021-08-31 00:11:31', '2021-08-31 00:11:31'),
(28, 21, '202108311630397491訂單取消，購物金退回', 100, 200, '2021-08-31 00:11:52', '2021-08-31 00:11:52'),
(29, 21, '202108311630398583結帳使用', -100, 100, '2021-08-31 00:29:43', '2021-08-31 00:29:43'),
(30, 3, 'ddd', -100, 475, '2021-08-31 00:33:52', '2021-08-31 00:33:52'),
(31, 3, 'ddd', 100, 575, '2021-08-31 00:34:15', '2021-08-31 00:34:15'),
(32, 21, '202108311630398583，訂單退款', 119032, 119132, '2021-09-02 01:21:35', '2021-09-02 01:21:35'),
(33, 21, '202108311630398583，訂單退款', 119032, 238164, '2021-09-02 01:23:06', '2021-09-02 01:23:06'),
(34, 21, '202108311630398583，訂單退款', 59466, 297630, '2021-09-02 01:55:56', '2021-09-02 01:55:56'),
(35, 21, '202108311630398583，訂單退款', 59266, 356896, '2021-09-02 01:56:48', '2021-09-02 01:56:48'),
(36, 21, '202108311630398390，訂單退款', 97698, 454594, '2021-09-02 02:08:35', '2021-09-02 02:08:35'),
(37, 22, '202109031630633595訂單優惠，贈送購物金', 100, 100, '2021-09-02 17:46:55', '2021-09-02 17:46:55'),
(38, 22, '202109031630633595，訂單退款', -100, 0, '2021-09-02 17:50:07', '2021-09-02 17:50:07'),
(39, 22, '202109031630633595訂單優惠，贈送購物金', 100, 100, '2021-09-02 19:14:06', '2021-09-02 19:14:06'),
(40, 22, '202109031630633595，訂單退款', -100, 0, '2021-09-02 19:33:43', '2021-09-02 19:33:43'),
(41, 22, '202109031630641922訂單優惠，贈送購物金', 10, 10, '2021-09-02 20:05:59', '2021-09-02 20:05:59'),
(42, 22, '202109031630641922訂單優惠，贈送購物金', 10, 20, '2021-09-02 20:11:10', '2021-09-02 20:11:10'),
(43, 22, '202109031630642485結帳使用', -20, 0, '2021-09-02 20:14:45', '2021-09-02 20:14:45'),
(44, 22, '202109031630642485，訂單退款', 127699, 127699, '2021-09-02 20:28:49', '2021-09-02 20:28:49'),
(45, 23, '202109031630656416訂單優惠，贈送購物金', 100, 100, '2021-09-03 00:07:11', '2021-09-03 00:07:11'),
(46, 23, '202109031630656416，訂單退款', -100, 0, '2021-09-03 00:07:50', '2021-09-03 00:07:50'),
(47, 23, '202109031630656416，訂單退款', 24900, 24900, '2021-09-03 00:14:44', '2021-09-03 00:14:44'),
(48, 3, 'songyy', 1000, 1575, '2021-09-06 00:29:35', '2021-09-06 00:29:35'),
(49, 22, '202109031630632807，訂單退款', 52800, 180499, '2021-09-06 01:05:51', '2021-09-06 01:05:51');

-- --------------------------------------------------------

--
-- 資料表結構 `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `short_des` text COLLATE utf8_unicode_ci,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `settings`
--

INSERT INTO `settings` (`id`, `description`, `short_des`, `logo`, `photo`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '/storage/photos/Setting/zshop-logo.png', '/storage/photos/Setting/qrcode.png', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_shopping_amount` int(11) NOT NULL DEFAULT '0',
  `reward_money` int(11) NOT NULL DEFAULT '0',
  `role` enum('super_admin','admin','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `user_level_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `total_shopping_amount`, `reward_money`, `role`, `user_level_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'super_admin@gmail.com', NULL, '123456', '0000', NULL, 0, 0, 'super_admin', 1, 'active', NULL, NULL, '2021-09-06 19:44:33'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$eLDwxphEbnpgRO0F89tTKe3QW/xusMKp1VEoFo/JfGVU8XupcCvzy', NULL, NULL, 0, 0, 'admin', 1, 'active', 'VoTBmzg9MnLslaljGMlk0TOtJkanJyF3kX7KuUFr8fid4qDR4sHCTMF1G6cn', '2021-08-29 23:48:31', '2021-09-06 19:44:33'),
(3, 'fdff', 'test001@gmail.com', NULL, '$2y$10$6OjHa743utBnDquAS5Tbi.J4mBuyJsULqHmpsHrJK8pE9kp6GhRNy', '09558885552', 'dfdasf2222', 529640, 1575, 'user', 3, 'active', 'uBm4oBmDYtjT1z2vMflI5WXOcud4Hh8xqs6gn75XQ4OVlpRbcHGEG6ZEhvfh', '2021-08-17 00:22:50', '2021-09-06 19:44:33'),
(4, NULL, 'test002@gmail.com', NULL, '$2y$10$mm5PipcTSH43vzhSK4OZZuDc7A4FQwQR3i5zRp3EcYTDdmy66sGL2', NULL, NULL, 0, 0, 'user', 2, 'inactive', NULL, '2021-08-17 00:48:04', '2021-08-31 17:42:15'),
(5, NULL, 'test003@gmail.com', NULL, '$2y$10$EBEXtxkRghk9aa6omcaCg.VbRxIdroEfsYvu4Jxf4/9mEVpoE.UYu', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 00:49:39', '2021-08-17 00:49:39'),
(6, NULL, 'test004@gmail.com', NULL, '$2y$10$2ofkOA40kv7.TW44LEg1ieYSQPiNBid20FKx/6hwKICBY9lz8vuBC', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 00:50:16', '2021-08-17 00:50:16'),
(7, NULL, 'test005@gmail.com', NULL, '$2y$10$EFraLR023TxKkLLBjOAwa.e9YXG0jxszuja4y/BaSk/aNMv.WWI6C', NULL, NULL, 50000, 0, 'user', 2, 'active', NULL, '2021-08-17 00:51:36', '2021-09-06 20:28:04'),
(8, NULL, 'test006@gmail.com', NULL, '$2y$10$HNxVKal2Gdl1gA.RByZa6uFBvhIq7nXv71Juj95plknhXhZjta19S', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 00:52:42', '2021-08-17 00:52:42'),
(9, NULL, 'test007@gmail.com', NULL, '$2y$10$HxQTnxDxbgTVZC4hhRNw4.aYCBxO0e2c0cyhiSiQTgX7SroBlnYnC', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 00:58:20', '2021-08-17 00:58:20'),
(10, NULL, 'test008@gmail.com', NULL, '$2y$10$6.dqvV3kFR7sJBWUeFWMce.bhN13DvAcxUCGbVR4alqdATxrmuluK', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 00:59:53', '2021-08-17 00:59:53'),
(11, NULL, 'test009@gmail.com', NULL, '$2y$10$8RTajD662Tgnmcj6RABqhurkWTkRg1sv3GPok/zBZS/MULvNroLXa', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 01:01:20', '2021-08-17 01:01:20'),
(12, NULL, 'test010@gmail.com', NULL, '$2y$10$6TMn5KOfecMu3v.ppuhl4.ih9aZTqzQ1bxt2V3lOErLjezhFv38qK', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 01:01:56', '2021-08-17 01:01:56'),
(13, NULL, 'test011@gmail.com', NULL, '$2y$10$bgZf4I6LfGClEbwds7BfEO1I0HCWK79WT8etV9GBAb/yI42zCgNIe', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 01:05:17', '2021-08-17 01:05:17'),
(14, NULL, 'test012@gmail.com', NULL, '$2y$10$Ch6f3zJLhMTk7QT5hA/L9eo4cqlPMsoSdXa7tknoVFuymU7giNllK', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 01:09:01', '2021-08-17 01:09:01'),
(15, NULL, 'test013@gmail.com', NULL, '$2y$10$Fr6Vq9jISoQ.SbXIqsxAD.orMZ1BsgrhcgQaqU5D1NpH3GJV6mSnm', NULL, NULL, 0, 500, 'user', 1, 'active', 'smTtmI41iSUXceAjO0Jm8k0UJSIvPMGFAj8991f67NLvycLPsqv55AV9OThn', '2021-08-17 01:10:23', '2021-08-17 01:10:23'),
(16, NULL, 'test014@gmail.com', NULL, '$2y$10$qnOvW7rMNjvHTwHm9FXDVOMrd1uxcmcxV66aZ64kTV8OaUERoP6Ku', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 01:27:56', '2021-08-17 01:27:56'),
(17, NULL, 'test015@gmail.com', NULL, '$2y$10$BauUYOSKaO/hY03HpL0kUOSAm6wkDhPnJoUzrbn/Evlk8.Dqh/qCW', NULL, NULL, 0, 0, 'user', 1, 'active', NULL, '2021-08-17 01:56:18', '2021-08-17 01:56:18'),
(18, 'test666', 'test666@gmail.com', NULL, '$2y$10$7RgmwRzBhkYDqmzPPNvOOe0HMjCyMa4r6Hz7rItxQ9rEl7oDRfIui', NULL, NULL, 0, 0, 'user', 1, 'active', 'yzKv5Vi4d70xxXWkfUPSXXnDua2bKhoi3Bq03ZVjTITVBnxSIlIYZMwY8kRr', '2021-08-17 20:27:04', '2021-08-17 20:27:04'),
(19, NULL, 'test016@gmail.com', NULL, '$2y$10$QGV4QBGgrw.9DP8WfoxQru.Jl5dXdGib/EA/erBeP94L.Ogy1uQs6', NULL, NULL, 50000, 0, 'user', 2, 'active', NULL, '2021-08-17 22:44:35', '2021-09-06 20:25:51'),
(20, '017', 'test017@gmail.com', NULL, '$2y$10$QYnl4oF1Dsd3x/YL./JL4eRJLSFFCuGi1xzNbgddF4df3Ra/WCmdW', '09017017', 'gkasjg;', 0, 0, 'user', 1, 'active', 'i7p4Jq5rx0Cg5M6SnSdKzCkgbpSpaiCAX6Am7xdLEkTgeVofYMStv9FlBHad', '2021-08-17 22:47:52', '2021-08-18 01:22:41'),
(21, 'demo', 'demo001@gmail.com', NULL, '$2y$10$WHOHapAyJgbxwXw5jal9vuYHC1BreUUbZBqCUY8pncHTvrFoAS1Q.', '0000', 'fgasdf', 408630, 454594, 'user', 3, 'active', 'gkW1gi0x8pcxxUgGYqxUomkge5F8u8jbX1pnlV1aev6UYg036oNUapKs7PEJ', '2021-08-31 00:04:21', '2021-09-02 02:08:35'),
(22, NULL, 'test99@gmail.com', NULL, '$2y$10$qROJ23msgkZsgRAY2ZqSiemjcCDzh6id.sZldMoMzkviBxEXyoiiq', NULL, NULL, 199779, 180499, 'user', 3, 'active', 'eiLFzg48eLOFkVVEDB1qqda9argoNOZ5xFwrFmrBYZP8sfuxABKp0SIj4koB', '2021-09-02 17:29:28', '2021-09-06 01:05:51'),
(23, NULL, 'demo2@gmail.com', NULL, '$2y$10$c06F.ZFc3GhaqqK/zv61ouSkRoTjYWstnE/RprKFOMJIqmflgXp3G', NULL, NULL, 31900, 24900, 'user', 10, 'active', NULL, '2021-09-03 00:05:16', '2021-09-06 20:21:20');

-- --------------------------------------------------------

--
-- 資料表結構 `user_levels`
--

CREATE TABLE `user_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level_up_line` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8 NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `user_levels`
--

INSERT INTO `user_levels` (`id`, `name`, `level_up_line`, `created_at`, `updated_at`, `name_en`, `status`) VALUES
(1, '普通a會員', 0, NULL, '2021-09-02 22:33:23', 'Normal a Member', 'active'),
(2, '白銀會員', 50000, NULL, '2021-09-02 22:03:00', 'Silver Member', 'active'),
(3, '黃金會員', 100000, NULL, NULL, 'Gold Member', 'active'),
(4, '鑽石會員', 1000000, '2021-09-02 22:10:48', '2021-09-02 22:10:48', 'Diamond Member', 'active'),
(5, '天神', 10000000, '2021-09-02 22:12:41', '2021-09-02 22:12:41', 'God Member', 'active'),
(6, '三萬', 30000, '2021-09-03 00:24:52', '2021-09-03 00:24:52', '30000', 'active'),
(7, '31000', 31000, '2021-09-03 00:28:40', '2021-09-06 20:00:22', '31000', 'active'),
(8, 'fadf', 12, '2021-09-06 18:55:18', '2021-09-06 19:21:09', 'adsf', 'active'),
(9, 'fdasg', 11, '2021-09-06 19:21:02', '2021-09-06 19:21:02', 'asdg', 'active'),
(10, '31900', 31900, '2021-09-06 20:21:20', '2021-09-06 20:21:20', '31900', 'active');

-- --------------------------------------------------------

--
-- 資料表結構 `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 27, 7, '2021-09-01 21:45:58', '2021-09-01 21:45:58'),
(2, 1, 3, '2021-09-05 23:24:49', '2021-09-05 23:24:49');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- 資料表索引 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- 資料表索引 `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_order_id_foreign` (`order_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- 資料表索引 `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- 資料表索引 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`);

--
-- 資料表索引 `product_imgs`
--
ALTER TABLE `product_imgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_imgs_product_id_foreign` (`product_id`);

--
-- 資料表索引 `reward_money_histories`
--
ALTER TABLE `reward_money_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reward_money_histories_user_id_foreign` (`user_id`);

--
-- 資料表索引 `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_level_id_foreign` (`user_level_id`);

--
-- 資料表索引 `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- 使用資料表 AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用資料表 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用資料表 AUTO_INCREMENT `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用資料表 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- 使用資料表 AUTO_INCREMENT `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- 使用資料表 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- 使用資料表 AUTO_INCREMENT `product_imgs`
--
ALTER TABLE `product_imgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- 使用資料表 AUTO_INCREMENT `reward_money_histories`
--
ALTER TABLE `reward_money_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- 使用資料表 AUTO_INCREMENT `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- 使用資料表 AUTO_INCREMENT `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用資料表 AUTO_INCREMENT `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- 資料表的 Constraints `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `product_imgs`
--
ALTER TABLE `product_imgs`
  ADD CONSTRAINT `product_imgs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- 資料表的 Constraints `reward_money_histories`
--
ALTER TABLE `reward_money_histories`
  ADD CONSTRAINT `reward_money_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_level_id_foreign` FOREIGN KEY (`user_level_id`) REFERENCES `user_levels` (`id`) ON DELETE SET NULL;

--
-- 資料表的 Constraints `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
