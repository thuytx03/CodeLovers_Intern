-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2023 at 07:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codelovers`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_types`
--

CREATE TABLE `blog_types` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `color_id` bigint UNSIGNED DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `quantity`, `user_id`, `size_id`, `color_id`, `total`, `created_at`, `updated_at`) VALUES
(65, 9, 1, 13, 2, 1, '150000', '2023-09-21 08:01:51', '2023-09-21 08:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `description`, `parent_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Áo', 'ao', NULL, NULL, '0', NULL, '2023-08-22 14:57:11', '2023-08-22 14:57:11'),
(2, 'Áo Thun', 'ao-thun', NULL, NULL, '1', NULL, '2023-08-22 14:57:19', '2023-08-22 14:57:19'),
(3, 'Áo Polo', 'ao-polo', NULL, NULL, '1', NULL, '2023-08-22 14:57:34', '2023-08-22 14:57:34'),
(4, 'Quần', 'quan', NULL, NULL, '0', NULL, '2023-08-22 14:57:51', '2023-08-22 14:57:51'),
(5, 'Quần Jean', 'quan-jean', NULL, NULL, '4', NULL, '2023-08-22 14:58:03', '2023-08-22 14:58:03'),
(6, 'Quần Baggy', 'quan-baggy', NULL, NULL, '4', NULL, '2023-08-22 14:58:11', '2023-08-22 14:58:11'),
(7, 'Áo Hoodie', 'ao-hoodie', NULL, NULL, '1', NULL, '2023-08-23 15:28:18', '2023-08-23 15:28:18'),
(8, 'Áo sơ mi', 'ao-so-mi', NULL, NULL, '1', NULL, '2023-08-23 15:28:37', '2023-08-23 15:28:37'),
(9, 'Áo khoác', 'ao-khoac', NULL, NULL, '1', NULL, '2023-08-23 15:28:56', '2023-08-23 15:28:56'),
(10, 'Giày', 'giay', NULL, NULL, '0', '2023-09-20 06:16:23', '2023-08-25 08:38:16', '2023-09-20 06:16:23'),
(11, 'Giày Sneaker', 'giay-sneaker', NULL, NULL, '10', '2023-09-20 06:16:01', '2023-08-25 08:38:30', '2023-09-20 06:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Đen', NULL, '2023-08-22 14:55:12', '2023-08-22 14:55:12'),
(2, 'Trắng', NULL, '2023-08-22 14:55:18', '2023-08-22 14:55:18'),
(3, 'Cam', NULL, '2023-08-22 14:55:22', '2023-08-22 14:55:22'),
(4, 'Vàng', NULL, '2023-08-22 14:55:29', '2023-08-22 14:55:29'),
(5, 'Xanh', NULL, '2023-08-22 14:55:34', '2023-08-22 14:55:34'),
(6, 'Hồng', NULL, '2023-08-22 14:55:40', '2023-08-22 14:55:40'),
(7, 'Trinh Xuan Thuy', '2023-08-27 09:00:53', '2023-08-27 09:00:43', '2023-08-27 09:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'eqweqw eqwe', 'trinhxuanthuy1542003@gmail.com', '98765321', 'eqwe', '2', '2023-09-04 09:10:32', '2023-09-04 09:17:32', NULL),
(2, 'eqweqw eqwe', 'trinhxuanthuy1542003@gmail.com', '98765321', 'eqwe', '2', '2023-09-04 09:11:30', '2023-09-08 02:49:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_order_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_order_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` datetime NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `quantity`, `min_order_amount`, `max_order_amount`, `start_date`, `end_date`, `description`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(6, 'GIAM10K', '2', '10000', '100', NULL, NULL, '2023-08-31 04:28:00', '2023-09-23 11:29:00', NULL, NULL, '1', '2023-08-31 04:29:07', '2023-09-08 02:48:14'),
(7, 'GIAM10%', '1', '10', '100', NULL, NULL, '2023-08-31 04:29:00', '2023-09-16 11:29:00', '<p>qasdas</p>', NULL, '1', '2023-08-31 04:29:38', '2023-09-08 02:47:53'),
(8, 'GIAMGIA10K', '2', '10000', '100', '200000', '300000', '2023-08-31 04:30:00', '2023-09-13 11:30:00', NULL, NULL, '1', '2023-08-31 04:30:54', '2023-09-11 07:32:41'),
(9, 'GIAMGIA10%', '1', '10', '100', '200000', '300000', '2023-08-31 04:31:00', '2023-09-22 11:31:00', NULL, NULL, '1', '2023-08-31 04:31:32', '2023-09-08 02:46:35'),
(10, 'MIN200KTHEO%', '1', '0.1', '100', '200000', NULL, '2023-08-31 09:02:00', '2023-09-01 16:02:00', NULL, NULL, '2', '2023-08-31 09:03:02', '2023-09-04 07:16:51'),
(11, 'MAX300KTHEO%', '1', '0.1', '100', NULL, '300000', '2023-08-31 09:04:00', '2023-09-10 16:04:00', NULL, NULL, '2', '2023-08-31 09:04:10', '2023-09-11 07:32:25'),
(12, 'MIN200KTHEOGIA', '2', '10000', '100', '200000', NULL, '2023-08-31 09:04:00', '2023-09-07 16:04:00', NULL, NULL, '2', '2023-08-31 09:04:53', '2023-09-08 02:30:04'),
(13, 'MAX300KTHEOGIA', '2', '10000', '100', NULL, '300000', '2023-08-31 09:05:00', '2023-09-08 16:05:00', NULL, NULL, '2', '2023-08-31 09:05:28', '2023-09-11 07:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'logo/1692785969_logo.png', NULL, '2023-08-23 10:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(69, '2014_10_12_000000_create_users_table', 1),
(70, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(71, '2019_08_19_000000_create_failed_jobs_table', 1),
(72, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(73, '2023_08_17_084908_create_categories_table', 1),
(74, '2023_08_17_084930_create_products_table', 1),
(75, '2023_08_17_085019_create_product_category_table', 1),
(76, '2023_08_17_085728_create_product_image_table', 1),
(77, '2023_08_17_085918_create_colors_table', 1),
(78, '2023_08_17_085935_create_sizes_table', 1),
(79, '2023_08_17_090012_create_product_color_table', 1),
(80, '2023_08_17_090044_create_product_size_table', 1),
(81, '2023_08_17_090221_create_carts_table', 1),
(82, '2023_08_17_090335_create_orders_table', 1),
(83, '2023_08_17_162920_create_order_detail_table', 1),
(84, '2023_08_17_163333_create_logo_table', 1),
(85, '2023_08_17_163400_create_slider_table', 1),
(86, '2023_08_30_160057_create_coupons_table', 2),
(87, '2023_09_04_155022_create_contacts_table', 3),
(88, '2023_09_04_155141_create_types_table', 3),
(89, '2023_09_04_155155_create_blogs_table', 3),
(90, '2023_09_04_155208_create_blog_types_table', 3),
(91, '2023_09_09_160509_create_ratings_table', 4),
(93, '2019_12_15_102554_create_permission_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `total`, `payment`, `status`, `note`, `cancel_reason`, `user_id`, `created_at`, `updated_at`) VALUES
(120, 'Trinh Xuan Thuy', 'thuytxph26691@fpt.edu.vn', '98782123', 'HN', '150000', 'online_payment', 'Chờ xác nhận', NULL, NULL, 13, '2023-09-21 08:02:19', '2023-09-21 08:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `color_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `size_id`, `color_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(170, 120, 9, 2, 1, 1, '150000', NULL, '2023-09-21 08:02:19', '2023-09-21 08:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `group`, `guard_name`, `created_at`, `updated_at`) VALUES
(55, 'admin-dashboard', 'Dashboard Admin', 'Admin', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(56, 'user-list', 'Danh sách tài khoản', 'Tài khoản', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(57, 'user-add', 'Thêm mới tài khoản', 'Tài khoản', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(58, 'user-edit', 'Chỉnh sửa tài khoản', 'Tài khoản', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(59, 'user-delete', 'Xoá tài khoản', 'Tài khoản', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(60, 'user-trash', 'Thùng rác tài khoản', 'Tài khoản', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(61, 'role-list', 'Danh sách vai trò', 'Vai trò', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(62, 'role-add', 'Thêm mới vai trò', 'Vai trò', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(63, 'role-edit', 'Chỉnh sửa vai trò', 'Vai trò', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(64, 'role-delete', 'Xoá vai trò', 'Vai trò', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(65, 'permission-list', 'Danh sách quyền', 'Quyền', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(66, 'permission-add', 'Thêm mới quyền', 'Quyền', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(67, 'permission-edit', 'Chỉnh sửa quyền', 'Quyền', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(68, 'permission-delete', 'Xoá quyền', 'Quyền', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(69, 'category-list', 'Danh sách danh mục sản phẩm', 'Danh mục sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(70, 'category-add', 'Thêm mới danh mục sản phẩm', 'Danh mục sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(71, 'category-edit', 'Chỉnh sửa danh mục sản phẩm', 'Danh mục sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(72, 'category-delete', 'Xoá danh mục sản phẩm', 'Danh mục sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(73, 'category-trash', 'Thùng rác danh mục sản phẩm', 'Danh mục sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(74, 'product-list', 'Danh sách sản phẩm', 'Sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(75, 'product-add', 'Thêm mới sản phẩm', 'Sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(76, 'product-edit', 'Chỉnh sửa sản phẩm', 'Sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(77, 'product-delete', 'Xoá sản phẩm', 'Sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(78, 'product-trash', 'Thùng rác sản phẩm', 'Sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(79, 'attribute-menu', 'Danh sách màu sắc', 'Thuộc tính sản phẩm', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(80, 'color-list', 'Danh sách màu sắc', 'Thuộc tính Màu sắc', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(81, 'color-add', 'Thêm mới màu sắc', 'Thuộc tính Màu sắc', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(82, 'color-edit', 'Chỉnh sửa màu sắc', 'Thuộc tính Màu sắc', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(83, 'color-delete', 'Xoá màu sắc', 'Thuộc tính Màu sắc', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(84, 'size-list', 'Danh sách kích thước', 'Thuộc tính Kích thước', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(85, 'size-add', 'Thêm mới kích thước', 'Thuộc tính Kích thước', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(86, 'size-edit', 'Chỉnh sửa kích thước', 'Thuộc tính Kích thước', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(87, 'size-delete', 'Xoá kích thước', 'Thuộc tính Kích thước', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(88, 'interface-menu', 'Danh sách màu sắc', 'Giao diện', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(89, 'logo-interface', 'Logo Website', 'Logo', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(90, 'slider-list', 'Danh sách slider', 'Slider', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(91, 'slider-add', 'Thêm mới slider', 'Slider', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(92, 'slider-edit', 'Chỉnh sửa slider', 'Slider', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(93, 'slider-delete', 'Xoá slider', 'Slider', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(94, 'order-list', 'Danh sách đơn hàng', 'Đơn hàng', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(95, 'coupon-list', 'Danh sách mã giảm giá', 'Mã giảm giá', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(96, 'coupon-add', 'Thêm mới mã giảm giá', 'Mã giảm giá', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(97, 'coupon-edit', 'Chỉnh sửa mã giảm giá', 'Mã giảm giá', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(98, 'coupon-delete', 'Xoá mã giảm giá', 'Mã giảm giá', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(99, 'contact-list', 'Danh sách liên hệ', 'Liên hệ', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(100, 'rating-list', 'Danh sách đánh giá', 'Đánh giá', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(101, 'type-list', 'Danh sách danh mục bài viết', 'Danh mục bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(102, 'type-add', 'Thêm mới danh mục bài viết', 'Danh mục bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(103, 'type-edit', 'Chỉnh sửa danh mục bài viết', 'Danh mục bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(104, 'type-delete', 'Xoá danh mục bài viết', 'Danh mục bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(105, 'type-trash', 'Thùng rác danh mục bài viết', 'Danh mục bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(106, 'blog-list', 'Danh sách bài viết', 'Bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(107, 'blog-add', 'Thêm mới bài viết', 'Bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(108, 'blog-edit', 'Chỉnh sửa bài viết', 'Bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(109, 'blog-delete', 'Xoá bài viết', 'Bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56'),
(110, 'blog-trash', 'Thùng rác bài viết', 'Bài viết', 'web', '2023-09-20 09:45:56', '2023-09-20 09:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `features` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `like` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `view` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `brand`, `selling_price`, `discount_price`, `quantity`, `description`, `features`, `percent`, `like`, `status`, `view`, `deleted_at`, `created_at`, `updated_at`) VALUES
(8, 'Áo Polo sọc kẻ trắng', 'ao-polo-soc-ke-trang', 'products/1692804218_anh1.webp', 'VN', '200000', '150000', 70, '<p>H&agrave;ng việt nam chất lượng cao</p>', '2', NULL, NULL, 1, 353, NULL, '2023-08-23 15:23:38', '2023-09-18 08:01:05'),
(9, 'Áo Thun Unisex Nam Nữ 2023', 'ao-thun-unisex-nam-nu-2023', 'products/1692804475_anh13.3.webp', 'VN', '200000', '150000', 970, '<p>H&agrave;ng việt nam chất lượng cao</p>', '', NULL, NULL, 1, 419, NULL, '2023-08-23 15:27:55', '2023-09-21 08:02:19'),
(10, 'Quần Jean Đen mẫu mới 2023', 'quan-jean-den-mau-moi-2023', 'products/1692804611_anh5.webp', 'VN', '400000', '200000', 989, '<p>H&agrave;ng việt nam chất lượng cao</p>', '', NULL, NULL, 1, 223, NULL, '2023-08-23 15:30:11', '2023-09-11 04:00:34'),
(11, 'Quần Baggy hoạ tiết chữ', 'quan-baggy-hoa-tiet-chu', 'products/1692804670_anh6.webp', 'VN', '400000', '200000', 53, '<p>&nbsp;H&agrave;ng việt nam chất lượng cao</p>', '', NULL, NULL, 1, 11, NULL, '2023-08-23 15:31:10', '2023-09-04 07:37:52'),
(12, 'Áo Hoodie Teelab Nam Nữ', 'ao-hoodie-teelab-nam-nu', 'products/1692804786_anh7.1.webp', 'Teelab', '350000', '290000', 94, '<p>H&agrave;ng việt nam chất lượng cao</p>', NULL, NULL, NULL, 1, 28, NULL, '2023-08-23 15:33:06', '2023-09-16 11:05:40'),
(13, 'Áo Hoodie From Rộng Nam Nữ Unisex', 'ao-hoodie-from-rong-nam-nu-unisex', 'products/1692804897_anh12.webp', 'VN', '350000', '300000', 213, '<p>H&agrave;ng việt nam chất lượng cao</p>', '', NULL, NULL, 1, 37, NULL, '2023-08-23 15:34:57', '2023-09-10 15:43:28'),
(14, 'Áo Sơ Mi Phong Cách Badboy', 'ao-so-mi-phong-cach-badboy', 'products/1692804987_anh15.webp', 'VN', '400000', '350000', 93, '<p>H&agrave;ng việt nam chất lượng cao</p>', NULL, NULL, NULL, 1, 69, NULL, '2023-08-23 15:36:27', '2023-09-11 04:04:31'),
(15, 'Áo Khoác Gió Nam Nữ Unisex 2023', 'ao-khoac-gio-nam-nu-unisex-2023', 'products/1692866133_anh18.webp', 'Heyyou', '500000', NULL, 99, '<p>H&agrave;ng việt nam chất lượng cao</p>', '1', NULL, NULL, 1, 23, NULL, '2023-08-24 08:35:33', '2023-09-10 08:03:25'),
(20, 'Trinh Xuan Thuy', 'trinh-xuan-thuy', 'products/1693152685_Ảnh chụp màn hình 2023-06-10 175631.png', 'VN', '200000', '180000', 100, '<p>wqe</p>', NULL, '10', NULL, 1, 1000, NULL, '2023-08-27 16:11:25', '2023-09-20 06:15:17'),
(21, 'Trinh Xuan Thuy123', 'trinh-xuan-thuy123', 'products/1693152726_Ảnh chụp màn hình 2023-06-20 164706.png', 'Heyyou', '200000', '150000', 31, '<p>123</p>', NULL, NULL, NULL, 1, 43, NULL, '2023-08-27 16:12:06', '2023-09-20 06:15:17'),
(22, 'Áo Sơ Mi Nâu Be Siêu Hot 2023', 'ao-so-mi-nau-be-sieu-hot-2023', 'products/1693384674_anh16.webp', 'Heyyou', '200000', '120000', 100, '<p>H&agrave;ng việt nam chất lượng cao</p>', '2', '40', NULL, NULL, 13, NULL, '2023-08-30 08:37:54', '2023-09-04 07:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(108, 13, 1, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(109, 13, 7, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(111, 11, 4, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(112, 11, 6, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(113, 10, 4, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(114, 10, 5, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(115, 9, 1, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(116, 9, 2, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(137, 8, 1, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(138, 8, 3, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(139, 15, 1, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(140, 15, 9, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(145, 20, 5, '2023-08-27 16:11:25', '2023-08-27 16:11:25'),
(156, 14, 1, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(157, 14, 8, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(170, 22, 1, '2023-09-16 11:05:02', '2023-09-16 11:05:02'),
(171, 22, 8, '2023-09-16 11:05:02', '2023-09-16 11:05:02'),
(172, 12, 1, '2023-09-16 11:05:40', '2023-09-16 11:05:40'),
(173, 21, 10, '2023-09-20 06:15:51', '2023-09-20 06:15:51'),
(174, 21, 11, '2023-09-20 06:15:51', '2023-09-20 06:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `color_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(108, 13, 1, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(109, 13, 2, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(112, 11, 1, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(113, 10, 1, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(114, 9, 1, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(115, 9, 2, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(116, 9, 5, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(125, 8, 1, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(126, 8, 2, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(127, 15, 1, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(129, 14, 1, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(130, 12, 1, '2023-09-16 11:05:40', '2023-09-16 11:05:40'),
(131, 12, 2, '2023-09-16 11:05:40', '2023-09-16 11:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(19, 8, 'products/1692804218_anh1.1.webp', '2023-08-23 15:23:38', '2023-08-23 15:23:38'),
(20, 8, 'products/1692804218_anh1.webp', '2023-08-23 15:23:38', '2023-08-23 15:23:38'),
(21, 9, 'products/1692804475_anh13.1.webp', '2023-08-23 15:27:55', '2023-08-23 15:27:55'),
(22, 9, 'products/1692804475_anh13.2.webp', '2023-08-23 15:27:55', '2023-08-23 15:27:55'),
(23, 9, 'products/1692804475_anh13.3.webp', '2023-08-23 15:27:55', '2023-08-23 15:27:55'),
(24, 9, 'products/1692804475_anh13.webp', '2023-08-23 15:27:55', '2023-08-23 15:27:55'),
(25, 10, 'products/1692804611_anh5.1.webp', '2023-08-23 15:30:11', '2023-08-23 15:30:11'),
(26, 10, 'products/1692804611_anh5.webp', '2023-08-23 15:30:11', '2023-08-23 15:30:11'),
(27, 11, 'products/1692804670_anh6.1.webp', '2023-08-23 15:31:10', '2023-08-23 15:31:10'),
(28, 11, 'products/1692804670_anh6.webp', '2023-08-23 15:31:10', '2023-08-23 15:31:10'),
(29, 12, 'products/1692804786_anh7.1.webp', '2023-08-23 15:33:06', '2023-08-23 15:33:06'),
(30, 12, 'products/1692804786_anh7.webp', '2023-08-23 15:33:06', '2023-08-23 15:33:06'),
(31, 13, 'products/1692804897_anh12.1.webp', '2023-08-23 15:34:57', '2023-08-23 15:34:57'),
(32, 13, 'products/1692804897_anh12.2.webp', '2023-08-23 15:34:57', '2023-08-23 15:34:57'),
(33, 13, 'products/1692804897_anh12.webp', '2023-08-23 15:34:57', '2023-08-23 15:34:57'),
(34, 14, 'products/1692804988_anh15.1.webp', '2023-08-23 15:36:28', '2023-08-23 15:36:28'),
(35, 14, 'products/1692804988_anh15.webp', '2023-08-23 15:36:28', '2023-08-23 15:36:28'),
(36, 15, 'products/1692866133_anh18.1.webp', '2023-08-24 08:35:33', '2023-08-24 08:35:33'),
(37, 15, 'products/1692866133_anh18.2.webp', '2023-08-24 08:35:33', '2023-08-24 08:35:33'),
(38, 15, 'products/1692866133_anh18.webp', '2023-08-24 08:35:33', '2023-08-24 08:35:33'),
(44, 20, 'products/1693152685_Ảnh chụp màn hình 2023-06-10 175631.png', '2023-08-27 16:11:25', '2023-08-27 16:11:25'),
(45, 21, 'products/1693152726_Ảnh chụp màn hình 2023-06-19 145412.png', '2023-08-27 16:12:06', '2023-08-27 16:12:06'),
(46, 22, 'products/1693384674_anh16.1.webp', '2023-08-30 08:37:54', '2023-08-30 08:37:54'),
(47, 22, 'products/1693384674_anh16.webp', '2023-08-30 08:37:54', '2023-08-30 08:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(142, 13, 2, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(143, 13, 3, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(144, 13, 4, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(145, 13, 5, '2023-08-24 08:32:55', '2023-08-24 08:32:55'),
(150, 11, 2, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(151, 11, 3, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(152, 11, 4, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(153, 11, 5, '2023-08-24 08:33:38', '2023-08-24 08:33:38'),
(154, 10, 2, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(155, 10, 3, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(156, 10, 4, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(157, 10, 5, '2023-08-24 08:33:51', '2023-08-24 08:33:51'),
(158, 9, 2, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(159, 9, 3, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(160, 9, 4, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(161, 9, 5, '2023-08-24 08:34:11', '2023-08-24 08:34:11'),
(173, 8, 2, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(174, 8, 3, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(175, 8, 4, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(176, 8, 5, '2023-08-27 15:32:07', '2023-08-27 15:32:07'),
(177, 15, 2, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(178, 15, 3, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(179, 15, 4, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(180, 15, 5, '2023-08-27 15:32:39', '2023-08-27 15:32:39'),
(185, 14, 2, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(186, 14, 3, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(187, 14, 4, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(188, 14, 5, '2023-08-30 08:42:16', '2023-08-30 08:42:16'),
(189, 22, 2, '2023-09-16 11:05:02', '2023-09-16 11:05:02'),
(190, 12, 2, '2023-09-16 11:05:40', '2023-09-16 11:05:40'),
(191, 12, 3, '2023-09-16 11:05:40', '2023-09-16 11:05:40'),
(192, 12, 4, '2023-09-16 11:05:40', '2023-09-16 11:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `rating` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `video` longtext COLLATE utf8mb4_unicode_ci,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `group`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'Super Admin', NULL, 'web', '2023-09-19 04:39:37', '2023-09-20 02:51:16'),
(2, 'nhan-vien', 'Thuỷ Nhân Viên 1', 'system', 'web', '2023-09-19 06:47:14', '2023-09-19 06:55:50'),
(3, 'khach-hang', 'Khách hàng', NULL, 'web', '2023-09-19 15:04:03', '2023-09-19 15:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(55, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'S', NULL, '2023-08-22 14:56:04', '2023-08-22 14:56:04'),
(3, 'M', NULL, '2023-08-22 14:56:35', '2023-08-22 14:56:35'),
(4, 'L', NULL, '2023-08-22 14:56:39', '2023-08-22 14:56:39'),
(5, 'XL', NULL, '2023-08-22 14:56:43', '2023-08-22 14:56:43'),
(6, 'XXL', NULL, '2023-08-22 14:56:47', '2023-08-22 14:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, NULL, 'slider/1692802878_slider_2.webp', '1', '2023-08-23 14:35:55', '2023-08-23 15:01:18'),
(3, NULL, 'slider/1692802900_slider_1.webp', '1', '2023-08-23 14:36:09', '2023-08-23 15:01:40'),
(4, NULL, 'slider/1692801390_slider_3.webp', '1', '2023-08-23 14:36:30', '2023-08-23 14:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `slug`, `image`, `description`, `parent_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Chính trị', 'chinh-tri', NULL, NULL, '0', NULL, '2023-09-05 07:31:07', '2023-09-05 07:31:51'),
(2, 'Hot', 'hot', NULL, NULL, '0', NULL, '2023-09-05 07:31:22', '2023-09-05 07:31:22'),
(3, 'Trong ngày', 'trong-ngay', NULL, NULL, '2', NULL, '2023-09-05 07:31:32', '2023-09-05 07:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `google_id`, `facebook_id`, `email`, `email_verified_at`, `password`, `avatar`, `phone`, `address`, `gender`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(13, 'Super Admin', NULL, NULL, 'admin@gmail.com', NULL, '$2y$10$XtkJVsIt1Pueg8HWiznK.O0VVZQylEYe30N1Z4g1lC7ohelPMfTA2', NULL, NULL, NULL, NULL, '1', NULL, NULL, '2023-09-19 04:39:37', '2023-09-19 04:39:37'),
(14, 'Thuỷ nhân viên', NULL, NULL, 'thuytxph26691@fpt.edu.vn', NULL, '$2y$10$5KdxSi9ZynZ8AwHUAuMH0.jjTko6j.IgYRIfYv46hrBKPNcRr/wIy', 'https://cdn2.iconfinder.com/data/icons/avatar-flat-6/614/Page_19-512.png', '98782123', 'HN', '1', '1', NULL, NULL, '2023-09-19 07:22:05', '2023-09-19 07:22:05'),
(15, 'Khách hàng', NULL, NULL, 'trinhxuanthuy1542003@gmail.com', NULL, '$2y$10$tIY1/NuHcmScXn0sEhIGiuur7tAdhMzN3XEl6xpeQXWaLEsS40FQO', 'https://cdn2.iconfinder.com/data/icons/avatar-flat-6/614/Page_19-512.png', '0964540524', '12', '1', '1', NULL, NULL, '2023-09-19 15:04:33', '2023-09-19 15:04:33'),
(16, 'chatgpt@conca.ga', NULL, NULL, 'chatgpt@conca.ga', NULL, '$2y$10$X9Huzn9jFd1rpL5WrheVFOtUjYa76OLplJHqgVE.m2P5lNpMnwDfq', 'https://cdn2.iconfinder.com/data/icons/avatar-flat-6/614/Page_19-512.png', '0964540587', '123', '1', '1', NULL, NULL, '2023-09-20 02:46:42', '2023-09-20 02:46:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog_types`
--
ALTER TABLE `blog_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_types_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_types_type_id_foreign` (`type_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_size_id_foreign` (`size_id`),
  ADD KEY `carts_color_id_foreign` (`color_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
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
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`),
  ADD KEY `order_detail_product_id_foreign` (`product_id`),
  ADD KEY `order_detail_size_id_foreign` (`size_id`),
  ADD KEY `order_detail_color_id_foreign` (`color_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_color_product_id_foreign` (`product_id`),
  ADD KEY `product_color_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_image_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_product_id_foreign` (`product_id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`);

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
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_types`
--
ALTER TABLE `blog_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_types`
--
ALTER TABLE `blog_types`
  ADD CONSTRAINT `blog_types_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_types_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_detail_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
