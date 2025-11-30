-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2025 lúc 02:59 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hrm_system`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` enum('present','absent','late') DEFAULT 'present'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `date`, `check_in`, `check_out`, `status`) VALUES
(1, 3, '2025-11-30', '15:58:43', '15:58:43', 'present');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `image_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `name`, `issue_date`, `expiry_date`, `image_proof`) VALUES
(1, 3, 'IELTS 7.5', '2025-11-24', NULL, 'img/certs/1764491217_images.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT 'img/default.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'Phòng Chiến lược', 'Xây dựng kế hoạch dài hạn để tăng doanh thu.', 'img/Strategy.jpg', '2025-11-30 13:37:45'),
(2, 'Phòng Vận hành', 'Tối ưu hóa quy trình làm việc để đạt hiệu quả cao.', 'img/Operations.jpg', '2025-11-30 13:37:45'),
(3, 'Phòng Tài chính', 'Mô hình hóa tài chính và quản lý rủi ro.', 'img/Finance.jpg', '2025-11-30 13:37:45'),
(4, 'Phòng Nhân sự', 'Xây dựng văn hóa hiệu suất cao và phát triển nhân tài.', 'img/HR.jpg', '2025-11-30 13:37:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee_details`
--

CREATE TABLE `employee_details` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Nam','Nữ','Khác') DEFAULT NULL,
  `start_date` date NOT NULL,
  `education_level` varchar(100) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `contract_type` enum('Full-time','Part-time','CTV') DEFAULT 'Full-time',
  `certificate_type` enum('None','IELTS','TOEIC') DEFAULT 'None',
  `certificate_score` decimal(5,1) DEFAULT 0.0,
  `edu_proof` varchar(255) DEFAULT NULL,
  `cert_proof` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee_details`
--

INSERT INTO `employee_details` (`user_id`, `phone`, `address`, `dob`, `gender`, `start_date`, `education_level`, `major`, `contract_type`, `certificate_type`, `certificate_score`, `edu_proof`, `cert_proof`, `biography`) VALUES
(1, NULL, NULL, NULL, NULL, '2020-01-01', NULL, NULL, 'Full-time', 'None', 0.0, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, '2025-11-30', NULL, NULL, 'Full-time', 'None', 0.0, NULL, NULL, NULL),
(3, '0862751618', 'Tân Lập- Đan Phượng-Hà Nội', '2005-06-22', NULL, '2020-01-28', 'Thạc sĩ', 'Ngôn ngữ Anh', 'Full-time', 'IELTS', 7.5, 'img/proofs/1764510483_req_edu_images.jpg', 'img/proofs/1764510483_req_cert_images.jpg', ''),
(4, '0987898789', 'Ha Noi', '2008-01-30', NULL, '2022-05-26', 'Trung cấp', 'Sư phạm Toán', 'Full-time', 'None', 0.0, '', '', 'Tôi không làm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `amount` decimal(15,0) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `expense_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `receipt_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `amount`, `category`, `expense_date`, `created_by`, `receipt_image`, `created_at`) VALUES
(1, 'PR Công ty', 10000000, 'Marketing', '2025-11-30', 1, 'img/receipts/1764492612_330px-Volkswagen_Invoice.jpg', '2025-11-30 08:50:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT 'img/default.jpg',
  `created_at` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `summary`, `content`, `image`, `created_at`) VALUES
(1, 'Mẹo tuần này: Nâng cao năng suất', 'Khám phá các chiến lược cho môi trường làm việc kết hợp để tăng cường cộng tác.', NULL, 'img/Finance.jpg', '2025-11-24'),
(2, 'Báo cáo xu hướng thị trường Q4', 'Những thông tin chính về chuyển dịch kinh tế và cơ hội đầu tư cho quý sắp tới.', NULL, 'img/Operations.jpg', '2025-11-24'),
(3, 'Mở khóa tăng trưởng bền vững', 'Khám phá các bước thực tế để mở rộng quy mô doanh nghiệp giữa những bất ổn.', NULL, 'img/mission1.jpg', '2025-11-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'Lịch nghỉ lễ ngày 2-9!!', 'Nghỉ 2 ngày 1-9 và 2-9 , 3-9 tiếp tục công việc thường ngày!!', '2025-11-30 10:22:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `base_salary` decimal(15,0) NOT NULL,
  `allowance_degree` decimal(15,0) DEFAULT 0,
  `allowance_seniority` decimal(15,0) DEFAULT 0,
  `work_days` int(11) DEFAULT 0,
  `bonus` decimal(15,0) DEFAULT 0,
  `tax` decimal(15,0) DEFAULT 0,
  `total_salary` decimal(15,0) NOT NULL,
  `status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `overtime_hours` decimal(5,1) DEFAULT 0.0,
  `overtime_money` decimal(15,0) DEFAULT 0,
  `late_count` int(11) DEFAULT 0,
  `total_fine` decimal(15,0) DEFAULT 0,
  `note` text DEFAULT NULL,
  `tax_percent` decimal(5,2) DEFAULT 0.00,
  `allowance_language` decimal(15,0) DEFAULT 0,
  `unpaid_leave_days` decimal(4,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payroll`
--

INSERT INTO `payroll` (`id`, `user_id`, `month`, `base_salary`, `allowance_degree`, `allowance_seniority`, `work_days`, `bonus`, `tax`, `total_salary`, `status`, `created_at`, `overtime_hours`, `overtime_money`, `late_count`, `total_fine`, `note`, `tax_percent`, `allowance_language`, `unpaid_leave_days`) VALUES
(1, 3, '2025-11', 5000000, 500000, 1000000, 26, 500000, 0, 8126000, 'paid', '2025-11-30 08:55:24', 3.5, 126000, 0, 0, 'Tháng này làm tốt có , OT tốt thưởng 500k', 0.00, 1000000, 0.0),
(2, 4, '2025-11', 8000000, 0, 1000000, 26, 0, 0, 8500000, 'paid', '2025-11-30 09:45:04', 0.0, 0, 0, 500000, 'Tháng này đi muộn nhiều.\r\nKhông Tập trung vào công việc Phạt 500k', 0.00, 0, 0.0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `code`, `description`) VALUES
(1, 'user.view', 'Xem danh sách nhân viên'),
(2, 'user.create', 'Thêm nhân viên mới'),
(3, 'user.edit', 'Sửa hồ sơ nhân viên'),
(4, 'user.delete', 'Xóa nhân viên'),
(5, 'salary.view', 'Xem bảng lương toàn công ty'),
(6, 'salary.export', 'Xuất Excel bảng lương'),
(7, 'expense.manage', 'Quản lý chi tiêu nội bộ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profile_requests`
--

CREATE TABLE `profile_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `education_level` varchar(100) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `certificate_type` varchar(50) DEFAULT NULL,
  `certificate_score` decimal(5,1) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `edu_proof` varchar(255) DEFAULT NULL,
  `cert_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `profile_requests`
--

INSERT INTO `profile_requests` (`id`, `user_id`, `full_name`, `email`, `phone`, `dob`, `address`, `education_level`, `major`, `certificate_type`, `certificate_score`, `biography`, `edu_proof`, `cert_proof`, `status`, `request_date`, `avatar`) VALUES
(1, 3, 'Nguyen Van A', 'as@gmail.com', '0862751618', '2005-06-22', 'Tân Lập- Đan Phượng-Hà Nội', 'Thạc sĩ', 'Ngôn ngữ Anh', 'IELTS', 7.5, 'Toi la ai day la dau', '', '', 'rejected', '2025-11-30 13:46:03', NULL),
(2, 3, 'Nguyen Van A', 'as@gmail.com', '0862751618', '2005-06-22', 'Tân Lập- Đan Phượng-Hà Nội', 'Thạc sĩ', 'Ngôn ngữ Anh', 'IELTS', 7.5, '', 'img/proofs/1764510483_req_edu_images.jpg', 'img/proofs/1764510483_req_cert_images.jpg', 'approved', '2025-11-30 13:48:03', NULL),
(3, 3, 'Nguyen Van A', 'as@gmail.com', '0862751618', '2005-06-22', 'Tân Lập- Đan Phượng-Hà Nội', 'Thạc sĩ', 'Ngôn ngữ Anh', 'IELTS', 7.5, '', 'img/proofs/1764510483_req_edu_images.jpg', 'img/proofs/1764510483_req_cert_images.jpg', 'approved', '2025-11-30 13:55:46', 'img/avatars/1764510946_images.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `default_salary` decimal(15,0) DEFAULT 5000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `default_salary`) VALUES
(1, 'Admin', 'Quản trị viên hệ thống - Có toàn quyền', 20000000),
(2, 'Manager', 'Quản lý trung tâm - Xem báo cáo, duyệt đơn', 15000000),
(3, 'Teacher', 'Giáo viên - Xem lịch dạy, lương', 8000000),
(4, 'Staff', 'Nhân viên văn phòng/Tư vấn', 6000000),
(5, 'Kế Toán', 'SALARY EXPENSE', 5000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(5, 6),
(5, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `setting_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `setting_name`) VALUES
(2, 'allowance_bachelor', '500000', 'Phụ cấp ĐH (đ)'),
(3, 'allowance_master', '1500000', 'Phụ cấp Thạc sĩ (đ)'),
(4, 'allowance_sen_1y', '300000', 'Thâm niên > 1 năm (đ)'),
(5, 'allowance_sen_3y', '1000000', 'Thâm niên > 3 năm (đ)'),
(6, 'allowance_ielts_6', '500000', 'IELTS 6.0+ / TOEIC 600+ (đ)'),
(7, 'allowance_ielts_7', '1000000', 'IELTS 7.0+ / TOEIC 800+ (đ)'),
(8, 'allowance_ielts_8', '2000000', 'IELTS 8.0+ (đ)'),
(9, 'standard_work_days', '26', 'Số công chuẩn/tháng'),
(10, 'allowance_phd', '3000000', 'Phụ cấp Tiến sĩ (đ)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT 'img/default.jpg',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `full_name`, `avatar`, `status`, `created_at`) VALUES
(1, 1, 'admin', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'admin@englishcenter.com', 'Super Administrator', 'img/default.jpg', 'active', '2025-11-30 07:46:53'),
(2, 1, 'admin123', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'dat2722005@gmail.com', 'Nguyễn Tiến Đạt', 'img/default.jpg', 'active', '2025-11-30 08:05:28'),
(3, 4, 'user1', '$2y$10$tn4bmKSfPdbmlesMZT8P9OJP5ueemQ89z2SM9XBDvkpXcwZLtqq3O', 'as@gmail.com', 'Nguyen Van A', 'img/avatars/1764510946_images.jpg', 'active', '2025-11-30 08:15:51'),
(4, 3, 'user2', '$2y$10$CWcjgs1mNy62AYZcH59kT.5U5W9DfxkBwilwGLnog/cnxNPUfBWfu', 'khongco@gmail.com', 'Nguyen Van B', 'img/default.jpg', 'active', '2025-11-30 09:35:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `work_history`
--

CREATE TABLE `work_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Chỉ mục cho bảng `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `profile_requests`
--
ALTER TABLE `profile_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `work_history`
--
ALTER TABLE `work_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `profile_requests`
--
ALTER TABLE `profile_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `work_history`
--
ALTER TABLE `work_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `employee_details`
--
ALTER TABLE `employee_details`
  ADD CONSTRAINT `employee_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `profile_requests`
--
ALTER TABLE `profile_requests`
  ADD CONSTRAINT `profile_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `work_history`
--
ALTER TABLE `work_history`
  ADD CONSTRAINT `work_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
