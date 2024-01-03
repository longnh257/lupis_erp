-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 03, 2024 lúc 06:33 PM
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
-- Cấu trúc bảng cho bảng `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `materials`
--

INSERT INTO `materials` (`id`, `name`, `description`, `quantity`, `thumbnail`, `price`, `created_at`, `updated_at`) VALUES
(1, 'nl1', '123', 2, '2024/0165954b7e12d37.download.jpg', 0.00, '2024-01-03 23:56:46', '2024-01-03 23:56:46');

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
(9, '2024_01_03_152609_create_materials_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'full_access', 'Full access for superadmin', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(2, 'inventory', 'Inventory management permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(3, 'accounting', 'Accounting permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(4, 'schedule', 'Schedule management permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(5, 'leave', 'Leave management permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(6, 'salary', 'Salary management permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(7, 'order', 'Order entry permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(8, 'view_order_confirmation', 'View order confirmation permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(9, 'note_for_approval', 'Note for approval permission', '2024-01-03 17:14:22', '2024-01-03 17:14:22');

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
(1, 'superadmin', 'Super Admin', 'Superadmin with full access', '2024-01-03 17:14:21', '2024-01-03 17:14:21'),
(2, 'manager', 'Quản Lý', 'Manager with permissions for inventory, accounting, etc.', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(3, 'store_employee', 'Nhân Viên Cửa Hàng', 'Store Employee with permissions for viewing schedules, adding schedules, requesting leave, viewing salary', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(4, 'full_time_driver', 'Lái Xe Full Time', 'Full Time Driver with permissions for entering orders, viewing daily order confirmations (cannot edit), noting orders for manager approval', '2024-01-03 17:14:22', '2024-01-03 17:14:22'),
(5, 'part_time_driver', 'Lái Xe Part Time', 'Part Time Driver with permissions similar to full-time driver', '2024-01-03 17:14:22', '2024-01-03 17:14:22');

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
  `phone` varchar(255) DEFAULT NULL,
  `CID` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `gender`, `address`, `phone`, `CID`, `avatar`, `remember_token`, `created_at`, `updated_at`, `birthday`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, 1, '$2y$12$Hm.aCTHAJig5ylQbEmIgje5vzzTVPdTFvQiK9gfjWWLfxKNwlWgzq', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-03 17:14:22', '2024-01-03 17:14:22', NULL),
(2, 'manager123', 'manager1@gmail.com', NULL, 2, '$2y$12$kEj4ysNjrVZxNnHeCXK.Vuyu.zv5xqzP0l8XNi8c1nd0fHTCF2jDO', 1, 'Ngô Gia Tự - HCM1', '1234123413', NULL, NULL, NULL, '2024-01-03 17:27:05', '2024-01-03 18:50:33', '2024-01-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `performed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `performed_by`, `action`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'login', 'Đăng nhập', '2024-01-03 17:24:07', '2024-01-03 17:24:07'),
(4, 2, 1, 'account_update', 'Update profile', '2024-01-03 17:32:52', '2024-01-03 17:32:52'),
(5, 2, 1, 'account_update', 'Update profile', '2024-01-03 17:33:15', '2024-01-03 17:33:15'),
(8, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 17:36:09', '2024-01-03 17:36:09'),
(9, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 17:36:16', '2024-01-03 17:36:16'),
(10, 2, 2, 'login', 'Đăng nhập', '2024-01-03 17:36:33', '2024-01-03 17:36:33'),
(11, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 17:36:39', '2024-01-03 17:36:39'),
(12, 2, 2, 'login', 'Đăng nhập', '2024-01-03 17:36:47', '2024-01-03 17:36:47'),
(13, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:36:51', '2024-01-03 18:36:51'),
(14, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:37:31', '2024-01-03 18:37:31'),
(15, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:37:41', '2024-01-03 18:37:41'),
(16, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:37:59', '2024-01-03 18:37:59'),
(17, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:46:25', '2024-01-03 18:46:25'),
(18, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:48:06', '2024-01-03 18:48:06'),
(19, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:50:24', '2024-01-03 18:50:24'),
(20, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:50:29', '2024-01-03 18:50:29'),
(21, 2, 1, 'account_update', 'Cập nhật thông tin người dùng', '2024-01-03 18:50:33', '2024-01-03 18:50:33'),
(22, 1, 1, 'login', 'Đăng nhập', '2024-01-03 19:14:14', '2024-01-03 19:14:14'),
(23, 1, 1, 'login', 'Đăng nhập', '2024-01-03 22:18:48', '2024-01-03 22:18:48'),
(24, 1, 1, 'login', 'Đăng nhập', '2024-01-03 22:46:01', '2024-01-03 22:46:01');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD KEY `user_logs_performed_by_foreign` (`performed_by`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_performed_by_foreign` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
