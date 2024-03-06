-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 06, 2024 lúc 06:10 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lupis_erp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `events`
--

INSERT INTO `events` (`id`, `start`, `user_id`, `event_type`, `shift`, `status`, `created_at`, `updated_at`, `note`, `reason`) VALUES
(31, '2024-03-07', 8, 'work', '1', 1, '2024-03-06 17:02:07', '2024-03-06 17:02:07', NULL, NULL),
(32, '2024-03-11', 9, 'work', '1', 1, '2024-03-06 17:02:16', '2024-03-06 17:02:16', NULL, NULL),
(33, '2024-03-19', 9, 'work', '1', 1, '2024-03-06 17:02:24', '2024-03-06 17:02:24', NULL, NULL),
(34, '2024-03-27', 9, 'work', '1', 1, '2024-03-06 17:02:32', '2024-03-06 17:02:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_01_02_075634_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_02_075536_create_permissions_table', 1),
(7, '2024_01_02_075640_create_role_permissions_table', 1),
(8, '2024_01_03_114847_create_user_logs_table', 1),
(9, '2024_01_03_152609_create_products_table', 1),
(10, '2024_01_04_094819_create_orders_table', 1),
(11, '2024_01_04_094823_create_order_items_table', 1),
(12, '2024_01_04_120053_create_sold_items_table', 1),
(13, '2024_01_10_172345_create_events_table', 1),
(14, '2024_01_10_181330_create_product_logs_table', 1),
(15, '2024_01_10_181332_create_salary_configs_table', 2),
(18, '2024_01_10_181335_create_salary_details_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `completed_at` datetime DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('in_progress','pending','completed','cancel') NOT NULL DEFAULT 'in_progress',
  `note` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `completed_at`, `assigned_to`, `status`, `note`, `created_at`, `updated_at`) VALUES
(13, 1, '2024-03-03 16:52:31', NULL, 8, 'completed', NULL, '2024-03-03 21:52:31', '2024-03-03 23:17:22'),
(14, 1, '2024-03-03 17:03:01', NULL, 8, 'completed', NULL, '2024-03-03 22:03:01', '2024-03-04 04:31:31'),
(15, 1, '2024-03-03 17:49:24', NULL, 8, 'in_progress', NULL, '2024-03-03 22:49:24', '2024-03-04 05:44:47'),
(16, 1, '2024-03-03 23:37:29', NULL, 8, 'completed', NULL, '2024-03-04 04:37:29', '2024-03-04 05:50:36'),
(17, 1, '2024-03-05 20:22:12', NULL, 8, 'pending', NULL, '2024-03-06 01:22:12', '2024-03-06 01:34:48'),
(18, 1, '2024-03-05 20:24:16', NULL, 10, 'completed', NULL, '2024-03-06 01:24:16', '2024-03-06 06:58:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `sell_quantity` decimal(10,2) DEFAULT 0.00,
  `sell_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `sell_quantity`, `sell_price`, `cost`, `created_at`, `updated_at`) VALUES
(8, 13, 1, 11.00, 10.00, 100.00, 80.00, '2024-03-03 21:52:31', '2024-03-03 23:17:22'),
(9, 14, 4, 1.00, 1.00, 123.00, 0.00, '2024-03-03 22:03:01', '2024-03-04 04:31:31'),
(10, 14, 1, 1.00, 1.00, 100.00, 80.00, '2024-03-03 22:03:01', '2024-03-04 04:31:31'),
(11, 15, 1, 3.00, 0.00, 1000000.00, 80.00, '2024-03-03 22:49:24', '2024-03-04 05:44:47'),
(12, 15, 2, 11.00, 0.00, 99999.00, 0.00, '2024-03-03 22:49:24', '2024-03-04 05:44:47'),
(13, 16, 2, 40.00, 0.00, 99999.00, 888888.00, '2024-03-04 04:37:29', '2024-03-04 04:47:30'),
(14, 16, 1, 1.00, 1.00, 1000000.00, 800000.00, '2024-03-04 04:37:29', '2024-03-04 04:37:47'),
(15, 16, 3, 22.00, 20.00, 333333.00, 222222.00, '2024-03-04 04:37:29', '2024-03-04 04:37:47'),
(16, 17, 3, 10.00, 10.00, 333333.00, 222222.00, '2024-03-06 01:22:12', '2024-03-06 01:34:48'),
(17, 17, 2, 25.00, 20.00, 99999.00, 888888.00, '2024-03-06 01:22:12', '2024-03-06 01:34:48'),
(18, 17, 1, 4.00, 0.00, 1000000.00, 800000.00, '2024-03-06 01:22:12', '2024-03-06 01:22:12'),
(19, 18, 3, 155.00, 155.00, 333333.00, 222222.00, '2024-03-06 01:24:16', '2024-03-06 06:58:28'),
(20, 18, 2, 25.50, 25.50, 99999.00, 888888.00, '2024-03-06 01:24:16', '2024-03-06 06:58:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--
-- Error reading structure for table lupis_erp.password_reset_tokens: #1932 - Table &#039;lupis_erp.password_reset_tokens&#039; doesn&#039;t exist in engine
-- Error reading data for table lupis_erp.password_reset_tokens: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `lupis_erp`.`password_reset_tokens`&#039; at line 1

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'full_access', 'Full access for superadmin', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(2, 'inventory', 'Inventory management permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(3, 'accounting', 'Accounting permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(4, 'schedule', 'Schedule management permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(5, 'leave', 'Leave management permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(6, 'salary', 'Salary management permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(7, 'order', 'Order entry permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(8, 'view_order_confirmation', 'View order confirmation permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(9, 'note_for_approval', 'Note for approval permission', '2024-01-30 03:25:55', '2024-01-30 03:25:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `quantity`, `thumbnail`, `price`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'sp1', 'sp 1', 3.00, '2024/01/65b7c3dc8e2f0.download.dl.download.jpg', 1000000.00, 800000.00, '2024-01-30 03:27:24', '2024-03-06 01:22:12'),
(2, 'sp2', '123', 200.00, '2024/01/65b7c40e638a1.download.dl.download.jpg', 99999.00, 888888.00, '2024-01-30 03:28:14', '2024-03-06 01:24:16'),
(3, 'sp 3', NULL, 12140.00, '2024/01/65b7c41e3f1d7.download.dl.download.jpg', 333333.00, 222222.00, '2024-01-30 03:28:30', '2024-03-06 01:24:16'),
(4, 'sp4', NULL, 117.00, NULL, 123.00, 0.00, '2024-01-30 03:37:27', '2024-03-03 22:03:01'),
(5, 'sp42', NULL, 123.00, NULL, 123.00, 0.00, '2024-01-30 03:39:23', '2024-01-30 03:39:23'),
(6, 'sp425', NULL, 119.00, NULL, 123.00, 0.00, '2024-01-30 03:39:30', '2024-01-30 05:50:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_logs`
--

CREATE TABLE `product_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_logs`
--

INSERT INTO `product_logs` (`id`, `order_id`, `user_id`, `action`, `quantity`, `product_id`, `details`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'import', 11.00, 1, 'Tạo Sản Phẩm', '2024-01-30 03:27:24', '2024-01-30 03:27:24'),
(2, NULL, 1, 'import', 11.00, 2, 'Tạo Sản Phẩm', '2024-01-30 03:28:14', '2024-01-30 03:28:14'),
(3, NULL, 1, 'import', 11.00, 3, 'Tạo Sản Phẩm', '2024-01-30 03:28:30', '2024-01-30 03:28:30'),
(4, NULL, 1, 'import', 123.00, 6, 'Tạo Sản Phẩm', '2024-01-30 03:39:30', '2024-01-30 03:39:30'),
(5, 2, 1, 'export', 13.00, 2, 'Xuất Kho', '2024-01-30 05:40:37', '2024-01-30 05:40:37'),
(6, 2, 1, 'export', 4.00, 3, 'Xuất Kho', '2024-01-30 05:40:37', '2024-01-30 05:40:37'),
(7, 2, 1, 'export', 5.00, 4, 'Xuất Kho', '2024-01-30 05:40:37', '2024-01-30 05:40:37'),
(8, 3, 1, 'export', 3.00, 4, 'Xuất Kho', '2024-01-30 05:50:31', '2024-01-30 05:50:31'),
(9, 3, 1, 'export', 4.00, 6, 'Xuất Kho', '2024-01-30 05:50:31', '2024-01-30 05:50:31'),
(10, 3, 1, 'import', 3.00, 4, 'Trả hàng chốt đơn', '2024-01-30 06:25:17', '2024-01-30 06:25:17'),
(11, 4, 1, 'export', 2.00, 3, 'Xuất Kho', '2024-01-31 22:42:45', '2024-01-31 22:42:45'),
(12, 4, 1, 'export', 3.00, 2, 'Xuất Kho', '2024-01-31 22:42:45', '2024-01-31 22:42:45'),
(13, NULL, 1, 'export', 4.00, 1, 'Chỉnh Sửa Sản Phẩm', '2024-03-03 18:45:05', '2024-03-03 18:45:05'),
(14, NULL, 1, 'import', 7.00, 1, 'Chỉnh Sửa Sản Phẩm', '2024-03-03 18:45:36', '2024-03-03 18:45:36'),
(15, 13, 1, 'export', 11.00, 1, 'Xuất Kho', '2024-03-03 21:52:31', '2024-03-03 21:52:31'),
(16, 14, 1, 'export', 1.00, 4, 'Xuất Kho', '2024-03-03 22:03:01', '2024-03-03 22:03:01'),
(17, 14, 1, 'export', 1.00, 1, 'Xuất Kho', '2024-03-03 22:03:01', '2024-03-03 22:03:01'),
(18, 15, 1, 'export', 3.00, 1, 'Xuất Kho', '2024-03-03 22:49:24', '2024-03-03 22:49:24'),
(19, 15, 1, 'export', 11.00, 2, 'Xuất Kho', '2024-03-03 22:49:24', '2024-03-03 22:49:24'),
(20, 13, 1, 'import', 1.00, 1, 'Trả hàng chốt đơn', '2024-03-03 23:17:22', '2024-03-03 23:17:22'),
(21, 16, 1, 'export', 40.00, 2, 'Xuất Kho', '2024-03-04 04:37:29', '2024-03-04 04:37:29'),
(22, 16, 1, 'export', 1.00, 1, 'Xuất Kho', '2024-03-04 04:37:29', '2024-03-04 04:37:29'),
(23, 16, 1, 'export', 22.00, 3, 'Xuất Kho', '2024-03-04 04:37:29', '2024-03-04 04:37:29'),
(24, 16, 1, 'import', 5.00, 2, 'Trả hàng chốt đơn', '2024-03-04 04:37:47', '2024-03-04 04:37:47'),
(25, 16, 1, 'import', 2.00, 3, 'Trả hàng chốt đơn', '2024-03-04 04:37:47', '2024-03-04 04:37:47'),
(26, 16, 1, 'import', 4.50, 2, 'Trả hàng chốt đơn', '2024-03-04 04:41:41', '2024-03-04 04:41:41'),
(27, 16, 1, 'import', 2.00, 3, 'Trả hàng chốt đơn', '2024-03-04 04:41:41', '2024-03-04 04:41:41'),
(28, 16, 1, 'import', 40.00, 2, 'Trả hàng chốt đơn', '2024-03-04 04:47:31', '2024-03-04 04:47:31'),
(29, 16, 1, 'import', 2.00, 3, 'Trả hàng chốt đơn', '2024-03-04 04:47:31', '2024-03-04 04:47:31'),
(30, 13, 1, 'import', 1.00, 1, 'Trả hàng chốt đơn', '2024-03-04 05:31:39', '2024-03-04 05:31:39'),
(31, 16, 1, 'import', 40.00, 2, 'Trả hàng chốt đơn', '2024-03-04 05:33:22', '2024-03-04 05:33:22'),
(32, 16, 1, 'import', 2.00, 3, 'Trả hàng chốt đơn', '2024-03-04 05:33:22', '2024-03-04 05:33:22'),
(33, 15, 1, 'import', 3.00, 1, 'Trả hàng chốt đơn', '2024-03-04 05:34:14', '2024-03-04 05:34:14'),
(34, 15, 1, 'import', 11.00, 2, 'Trả hàng chốt đơn', '2024-03-04 05:34:14', '2024-03-04 05:34:14'),
(35, 15, 1, 'import', 3.00, 1, 'Trả hàng chốt đơn', '2024-03-04 05:39:40', '2024-03-04 05:39:40'),
(36, 15, 1, 'import', 11.00, 2, 'Trả hàng chốt đơn', '2024-03-04 05:39:40', '2024-03-04 05:39:40'),
(37, 16, 1, 'import', 40.00, 2, 'Trả hàng chốt đơn', '2024-03-04 05:50:36', '2024-03-04 05:50:36'),
(38, 16, 1, 'import', 2.00, 3, 'Trả hàng chốt đơn', '2024-03-04 05:50:36', '2024-03-04 05:50:36'),
(39, 16, 1, 'import', 40.00, 2, 'Trả hàng chốt đơn', '2024-03-04 05:59:57', '2024-03-04 05:59:57'),
(40, 16, 1, 'import', 2.00, 3, 'Trả hàng chốt đơn', '2024-03-04 05:59:57', '2024-03-04 05:59:57'),
(41, 17, 1, 'export', 10.00, 3, 'Xuất Kho', '2024-03-06 01:22:12', '2024-03-06 01:22:12'),
(42, 17, 1, 'export', 25.00, 2, 'Xuất Kho', '2024-03-06 01:22:12', '2024-03-06 01:22:12'),
(43, 17, 1, 'export', 4.00, 1, 'Xuất Kho', '2024-03-06 01:22:12', '2024-03-06 01:22:12'),
(44, 18, 1, 'export', 155.00, 3, 'Xuất Kho', '2024-03-06 01:24:16', '2024-03-06 01:24:16'),
(45, 18, 1, 'export', 25.50, 2, 'Xuất Kho', '2024-03-06 01:24:16', '2024-03-06 01:24:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nice_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `nice_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super Admin', 'Superadmin with full access', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(2, 'manager', 'Quản Lý', 'Manager with permissions for inventory, accounting, etc.', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(3, 'store_employee', 'Nhân Viên Cửa Hàng', 'Store Employee with permissions for viewing schedules, adding schedules, requesting leave, viewing salary', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(4, 'full_time_driver', 'Lái Xe Full Time', 'Full Time Driver with permissions for entering orders, viewing daily order confirmations (cannot edit), noting orders for manager approval', '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(5, 'part_time_driver', 'Lái Xe Part Time', 'Part Time Driver with permissions similar to full-time driver', '2024-01-30 03:25:55', '2024-01-30 03:25:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 3, 4, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 3, 6, NULL, NULL),
(7, 4, 7, NULL, NULL),
(8, 4, 8, NULL, NULL),
(9, 4, 9, NULL, NULL),
(10, 5, 7, NULL, NULL),
(11, 5, 8, NULL, NULL),
(12, 5, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary_configs`
--

CREATE TABLE `salary_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `salary_type` enum('by_shift','by_revenue') NOT NULL DEFAULT 'by_shift',
  `basic_salary` decimal(10,2) NOT NULL DEFAULT 0.00,
  `basic_salary_per_shift` decimal(10,2) DEFAULT NULL,
  `bonus_percentage` decimal(5,2) DEFAULT NULL,
  `revenue_percentage` decimal(5,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `salary_configs`
--

INSERT INTO `salary_configs` (`id`, `user_id`, `salary_type`, `basic_salary`, `basic_salary_per_shift`, `bonus_percentage`, `revenue_percentage`, `note`, `created_at`, `updated_at`) VALUES
(3, 8, 'by_revenue', 0.00, NULL, NULL, 1.00, NULL, '2024-03-02 19:41:22', '2024-03-05 23:22:29'),
(4, 9, 'by_shift', 0.00, 300000.00, NULL, NULL, NULL, '2024-03-02 19:41:57', '2024-03-02 19:41:57'),
(5, 10, 'by_revenue', 0.00, NULL, NULL, 10.00, NULL, '2024-03-06 01:23:29', '2024-03-06 01:23:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary_details`
--

CREATE TABLE `salary_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `salary_type` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `salary_month` varchar(255) NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL DEFAULT 0.00,
  `basic_salary_per_shift` decimal(10,2) DEFAULT NULL,
  `bonus_percentage` decimal(5,2) DEFAULT NULL,
  `revenue` decimal(10,2) DEFAULT 0.00,
  `revenue_percentage` decimal(5,2) DEFAULT NULL,
  `order_count` int(11) DEFAULT NULL,
  `shift_count` int(11) DEFAULT NULL,
  `salary` decimal(10,2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_salary` decimal(10,2) NOT NULL,
  `payday` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `salary_details`
--

INSERT INTO `salary_details` (`id`, `user_id`, `salary_type`, `status`, `salary_month`, `basic_salary`, `basic_salary_per_shift`, `bonus_percentage`, `revenue`, `revenue_percentage`, `order_count`, `shift_count`, `salary`, `bonus`, `total_salary`, `payday`, `created_at`, `updated_at`) VALUES
(27, 8, 'by_revenue', 0, '2024-03', 0.00, NULL, NULL, 7667883.00, 1.00, 3, NULL, 76678.83, 0.00, 76678.83, '2024-03-05', '2024-03-06 07:07:13', '2024-03-06 07:07:13'),
(28, 10, 'by_revenue', 1, '2024-03', 0.00, NULL, NULL, 54216589.50, 10.00, 1, NULL, 5421658.95, 0.00, 5421658.95, '2024-03-05', '2024-03-06 07:07:13', '2024-03-06 07:07:49'),
(29, 9, 'by_shift', 0, '2024-03', 0.00, 300000.00, NULL, 0.00, NULL, NULL, 3, 900000.00, 0.00, 900000.00, '2024-04-05', '2024-03-06 17:02:52', '2024-03-06 17:02:52'),
(30, 8, 'by_revenue', 0, '2024-03', 0.00, NULL, NULL, 7667883.00, 1.00, 3, NULL, 76678.83, 0.00, 76678.83, '2024-04-05', '2024-03-06 17:02:52', '2024-03-06 17:02:52'),
(31, 10, 'by_revenue', 0, '2024-03', 0.00, NULL, NULL, 54216589.50, 10.00, 1, NULL, 5421658.95, 0.00, 5421658.95, '2024-04-05', '2024-03-06 17:02:52', '2024-03-06 17:02:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sold_items`
--

CREATE TABLE `sold_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `sold_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `CID` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `gender`, `address`, `birthday`, `phone`, `CID`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, 1, '$2y$12$ry.mMcfv62wz8cVAAwwf3uU1hWt.spVcOV3dmTIxPkaHrgjA2RvHi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:25:55', '2024-01-30 03:25:55'),
(8, 'longnguyen', 'longnguyen123@yopmail.com', NULL, 5, '$2y$12$aDgRrmUpe15KcBwaMRfYSe9vzLivGuHZy9DzuyyMyHguIFAsgp3g6', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-02 19:41:22', '2024-03-02 19:41:22'),
(9, 'longnh23244444', 'longnh2@yopmail.com', NULL, 3, '$2y$12$3LZyCJg8sT4ONwx7HuBof.A4vyJI2l5LiXuFMDIVbAkysMAYxIWUu', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-02 19:41:57', '2024-03-05 18:57:28'),
(10, 'lái xe 2', 'lx2@yopmail.com', NULL, 5, '$2y$12$9TbW//rUKnt2G.h1z76cdOpCRKPLjh.1rCEEn0z7BdDel6T.NGDY.', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-06 01:23:29', '2024-03-06 01:23:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `created_by_id`, `action`, `details`, `json_data`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'login', 'Đăng nhập', NULL, '2024-01-31 22:00:04', '2024-01-31 22:00:04'),
(2, 1, 1, 'login', 'Đăng nhập', NULL, '2024-01-31 22:05:31', '2024-01-31 22:05:31'),
(3, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-18 04:17:51', '2024-02-18 04:17:51'),
(4, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-19 00:56:18', '2024-02-19 00:56:18'),
(5, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-19 05:19:57', '2024-02-19 05:19:57'),
(6, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-19 05:20:30', '2024-02-19 05:20:30'),
(7, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-23 23:43:34', '2024-02-23 23:43:34'),
(8, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-23 23:52:40', '2024-02-23 23:52:40'),
(10, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-25 16:45:40', '2024-02-25 16:45:40'),
(12, 1, 1, 'login', 'Đăng nhập', NULL, '2024-02-26 01:07:00', '2024-02-26 01:07:00'),
(13, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-02 18:00:58', '2024-03-02 18:00:58'),
(14, 8, 8, 'login', 'Đăng nhập', NULL, '2024-03-02 19:46:34', '2024-03-02 19:46:34'),
(15, 9, 9, 'login', 'Đăng nhập', NULL, '2024-03-02 19:48:11', '2024-03-02 19:48:11'),
(16, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-03 18:05:46', '2024-03-03 18:05:46'),
(17, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-04 02:59:09', '2024-03-04 02:59:09'),
(18, 9, 9, 'login', 'Đăng nhập', NULL, '2024-03-04 05:19:36', '2024-03-04 05:19:36'),
(19, 8, 8, 'login', 'Đăng nhập', NULL, '2024-03-04 05:43:52', '2024-03-04 05:43:52'),
(20, 9, 9, 'login', 'Đăng nhập', NULL, '2024-03-04 06:01:47', '2024-03-04 06:01:47'),
(21, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-04 22:15:21', '2024-03-04 22:15:21'),
(22, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-05 14:34:17', '2024-03-05 14:34:17'),
(23, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-05 18:00:24', '2024-03-05 18:00:24'),
(24, 9, 1, 'account_update', 'Cập nhật thông tin Nhân Viên', NULL, '2024-03-05 18:02:14', '2024-03-05 18:02:14'),
(25, 9, 1, 'account_update', 'Cập nhật thông tin Nhân Viên', '{\"id\":9,\"name\":\"longnh23244444\",\"email\":\"longnh2@yopmail.com\",\"email_verified_at\":null,\"role_id\":\"3\",\"gender\":\"1\",\"address\":null,\"birthday\":null,\"phone\":null,\"CID\":null,\"avatar\":null,\"created_at\":\"2024-03-02T07:41:57.000000Z\",\"updated_at\":\"2024-03-05T06:02:14.000000Z\",\"role_name\":\"Nh\\u00e2n Vi\\u00ean C\\u1eeda H\\u00e0ng\",\"salary_config\":{\"id\":4,\"user_id\":9,\"salary_type\":\"by_shift\",\"basic_salary\":\"0.00\",\"basic_salary_per_shift\":\"300000.00\",\"bonus_percentage\":null,\"revenue_percentage\":null,\"note\":null,\"created_at\":\"2024-03-02T07:41:57.000000Z\",\"updated_at\":\"2024-03-02T07:41:57.000000Z\"},\"role\":{\"id\":3,\"name\":\"store_employee\",\"nice_name\":\"Nh\\u00e2n Vi\\u00ean C\\u1eeda H\\u00e0ng\",\"description\":\"Store Employee with permissions for viewing schedules, adding schedules, requesting leave, viewing salary\",\"created_at\":\"2024-01-29T15:25:55.000000Z\",\"updated_at\":\"2024-01-29T15:25:55.000000Z\"}}', '2024-03-05 18:57:28', '2024-03-05 18:57:28'),
(26, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-05 22:58:50', '2024-03-05 22:58:50'),
(27, 9, 9, 'login', 'Đăng nhập', NULL, '2024-03-06 01:20:49', '2024-03-06 01:20:49'),
(28, 8, 8, 'login', 'Đăng nhập', NULL, '2024-03-06 01:21:13', '2024-03-06 01:21:13'),
(29, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-06 04:46:46', '2024-03-06 04:46:46'),
(30, 1, 1, 'login', 'Đăng nhập', NULL, '2024-03-06 17:01:17', '2024-03-06 17:01:17');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_assigned_to_foreign` (`assigned_to`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_logs`
--
ALTER TABLE `product_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_logs_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_nice_name_unique` (`nice_name`);

--
-- Chỉ mục cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Chỉ mục cho bảng `salary_configs`
--
ALTER TABLE `salary_configs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `salary_details`
--
ALTER TABLE `salary_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sold_items`
--
ALTER TABLE `sold_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sold_items_order_id_foreign` (`order_id`),
  ADD KEY `sold_items_product_id_foreign` (`product_id`),
  ADD KEY `sold_items_sold_by_foreign` (`sold_by`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign` (`user_id`),
  ADD KEY `user_logs_performed_by_foreign` (`created_by_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `product_logs`
--
ALTER TABLE `product_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `salary_configs`
--
ALTER TABLE `salary_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `salary_details`
--
ALTER TABLE `salary_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `sold_items`
--
ALTER TABLE `sold_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_logs`
--
ALTER TABLE `product_logs`
  ADD CONSTRAINT `product_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sold_items`
--
ALTER TABLE `sold_items`
  ADD CONSTRAINT `sold_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sold_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sold_items_sold_by_foreign` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_performed_by_foreign` FOREIGN KEY (`created_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
