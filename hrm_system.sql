-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2025 lúc 06:41 PM
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
(1, 2, '2025-11-30', '07:55:00', '17:05:00', 'present'),
(2, 3, '2025-11-30', '08:00:00', '17:30:00', 'present'),
(3, 4, '2025-11-30', '08:30:00', '18:00:00', 'present'),
(4, 6, '2025-11-30', '08:00:00', '17:00:00', 'present'),
(5, 2, '2025-10-01', '07:50:00', '17:00:00', 'present'),
(6, 3, '2025-10-01', '07:55:00', '17:05:00', 'present'),
(7, 4, '2025-10-01', '08:15:00', '17:00:00', 'late'),
(8, 6, '2025-10-01', '08:00:00', '17:30:00', 'present'),
(9, 2, '2025-10-02', '07:55:00', '17:00:00', 'present'),
(10, 3, '2025-10-02', '08:00:00', '17:10:00', 'present'),
(11, 4, '2025-10-02', '08:00:00', '17:00:00', 'present'),
(12, 6, '2025-10-02', '08:05:00', '17:00:00', 'present');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `image_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `schedule`, `room`, `teacher_id`, `student_count`) VALUES
(1, 'IELTS Master K15', 'Thứ 2 - Thứ 4 (19:00 - 21:00)', 'Room 301', 4, 15),
(2, 'Giao tiếp nâng cao', 'Thứ 3 - Thứ 5 (18:00 - 20:00)', 'Room 202', 4, 12);

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
(1, 'Phòng Marketing', 'Quảng bá thương hiệu và Tuyển sinh Online.', 'img/Strategy.jpg', '2025-11-30 14:32:40'),
(2, 'Hành chính - Kế toán', 'Quản lý tài chính, Thu chi, Cơ sở vật chất.', 'img/Finance.jpg', '2025-11-30 14:32:40'),
(3, 'Phòng Đào Tạo', 'Quản lý Giáo viên, Chất lượng giảng dạy.', 'img/vision1.jpg', '2025-11-30 14:32:40'),
(4, 'Phòng Tuyển Sinh', 'Tư vấn khóa học, Telesale.', 'img/Operations.jpg', '2025-11-30 14:32:40'),
(5, 'Phòng Nhân Sự', 'Tuyển dụng, Chấm công, Lương thưởng.', 'img/HR.jpg', '2025-11-30 14:32:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee_details`
--

CREATE TABLE `employee_details` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `education_level` varchar(100) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `certificate_type` varchar(50) DEFAULT 'None',
  `certificate_score` decimal(5,1) DEFAULT 0.0,
  `start_date` date DEFAULT NULL,
  `contract_type` enum('Full-time','Part-time','CTV') DEFAULT 'Full-time',
  `biography` text DEFAULT NULL,
  `edu_proof` varchar(255) DEFAULT NULL,
  `cert_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee_details`
--

INSERT INTO `employee_details` (`user_id`, `phone`, `dob`, `address`, `education_level`, `major`, `certificate_type`, `certificate_score`, `start_date`, `contract_type`, `biography`, `edu_proof`, `cert_proof`) VALUES
(2, '0901000111', NULL, NULL, 'Thạc sĩ', 'Quản lý giáo dục', 'IELTS', 7.5, '2018-01-01', 'Full-time', '10 năm kinh nghiệm.', NULL, NULL),
(3, '0902000222', NULL, NULL, 'Đại học', 'Kế toán', 'TOEIC', 700.0, '2021-05-01', 'Full-time', 'Kế toán viên.', NULL, NULL),
(4, '0903000333', NULL, NULL, 'Thạc sĩ', 'TESOL', 'None', 0.0, '2023-01-15', 'Full-time', 'Giáo viên bản ngữ.', NULL, NULL),
(5, '0904000444', NULL, NULL, 'Đại học', 'Sư phạm Anh', 'IELTS', 8.0, '2022-09-01', 'Full-time', 'Giáo viên chuyên.', NULL, NULL),
(6, '0905000555', NULL, NULL, 'Cao đẳng', 'Kinh tế', 'None', 0.0, '2024-02-01', 'Full-time', 'Tư vấn viên.', NULL, NULL),
(7, '0906000666', NULL, NULL, 'Đại học', 'Marketing', 'TOEIC', 600.0, '2023-11-01', 'Full-time', 'Content Creator.', NULL, NULL);

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
(1, 'In tờ rơi', 2000000, 'Marketing', '2025-11-30', 3, NULL, '2025-11-30 14:32:40'),
(2, 'Mua máy chiếu', 8500000, 'Cơ sở vật chất', '2025-11-27', 3, NULL, '2025-11-30 14:32:40'),
(3, 'Tổ chức Trung thu cho học viên', 5000000, 'Sự kiện', '2025-09-15', 3, NULL, '2025-09-15 03:00:00'),
(4, 'Sửa điều hòa phòng 201', 1200000, 'Cơ sở vật chất', '2025-09-20', 3, NULL, '2025-09-20 07:00:00'),
(5, 'In ấn tài liệu Marketing tháng 10', 3000000, 'Marketing', '2025-10-01', 3, NULL, '2025-10-01 02:00:00'),
(6, 'Tiền nước uống tháng 10', 800000, 'Văn phòng phẩm', '2025-10-05', 3, NULL, '2025-10-05 03:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `course_interest` varchar(100) DEFAULT NULL,
  `status` enum('new','contacted','enrolled','lost') DEFAULT 'new',
  `assigned_to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `leads`
--

INSERT INTO `leads` (`id`, `name`, `phone`, `course_interest`, `status`, `assigned_to`, `created_at`) VALUES
(1, 'Trần Văn Học', '0912345678', 'IELTS 6.5', 'new', 6, '2025-11-30 17:25:25'),
(2, 'Lê Thị B', '0987654321', 'Tiếng Anh trẻ em', 'contacted', 6, '2025-11-30 17:25:25'),
(3, 'Phạm Văn C', '0909090909', 'TOEIC', 'enrolled', 6, '2025-11-30 17:25:25');

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

--
-- Đang đổ dữ liệu cho bảng `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `start_date`, `end_date`, `reason`, `status`, `created_at`) VALUES
(1, 6, '2025-12-05', '2025-12-06', 'Về quê', 'pending', '2025-11-30 14:32:40'),
(2, 3, '2025-10-15', '2025-10-15', 'Nghỉ việc riêng', 'approved', '2025-10-14 02:00:00'),
(3, 4, '2025-09-10', '2025-09-11', 'Bị cúm', 'approved', '2025-09-09 01:00:00');

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
(1, 'Khai giảng khóa mới', 'Chào đón học viên K15.', NULL, 'img/default.jpg', '2025-11-30'),
(2, 'Hội thảo giảng dạy 4.0', 'Áp dụng AI vào lớp học.', NULL, 'img/default.jpg', '2025-11-30');

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
(1, 'Lịch nghỉ lễ', 'Toàn công ty nghỉ 1 ngày.', '2025-11-30 14:32:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `base_salary` decimal(15,0) DEFAULT 0,
  `allowance_degree` decimal(15,0) DEFAULT 0,
  `allowance_seniority` decimal(15,0) DEFAULT 0,
  `allowance_language` decimal(15,0) DEFAULT 0,
  `work_days` decimal(4,1) DEFAULT 0.0,
  `overtime_hours` decimal(5,1) DEFAULT 0.0,
  `overtime_money` decimal(15,0) DEFAULT 0,
  `bonus` decimal(15,0) DEFAULT 0,
  `tax` decimal(15,0) DEFAULT 0,
  `tax_percent` decimal(5,2) DEFAULT 0.00,
  `late_count` int(11) DEFAULT 0,
  `total_fine` decimal(15,0) DEFAULT 0,
  `unpaid_leave_days` decimal(4,1) DEFAULT 0.0,
  `note` text DEFAULT NULL,
  `total_salary` decimal(15,0) NOT NULL,
  `status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payroll`
--

INSERT INTO `payroll` (`id`, `user_id`, `month`, `base_salary`, `allowance_degree`, `allowance_seniority`, `allowance_language`, `work_days`, `overtime_hours`, `overtime_money`, `bonus`, `tax`, `tax_percent`, `late_count`, `total_fine`, `unpaid_leave_days`, `note`, `total_salary`, `status`, `created_at`) VALUES
(1, 2, '2025-10', 18000000, 1500000, 2000000, 1000000, 26.0, 5.0, 650000, 2000000, 0, 0.00, 0, 0, 0.0, 'Thưởng KPI quý 3', 25150000, 'paid', '2025-10-31 08:00:00'),
(2, 3, '2025-10', 9000000, 500000, 300000, 500000, 25.0, 0.0, 0, 500000, 0, 0.00, 0, 0, 1.0, '', 10454000, 'paid', '2025-10-31 08:00:00'),
(3, 4, '2025-10', 12000000, 1500000, 300000, 0, 26.0, 10.0, 865000, 0, 0, 0.00, 2, 100000, 0.0, 'Đi muộn 2 lần', 14565000, 'paid', '2025-10-31 08:00:00'),
(4, 6, '2025-10', 7000000, 300000, 0, 0, 26.0, 0.0, 0, 3500000, 0, 0.00, 0, 0, 0.0, 'Hoa hồng tuyển sinh', 10800000, 'paid', '2025-10-31 08:00:00'),
(5, 2, '2025-09', 18000000, 1500000, 2000000, 1000000, 26.0, 0.0, 0, 0, 0, 0.00, 0, 0, 0.0, '', 22500000, 'paid', '2025-09-30 08:00:00'),
(6, 3, '2025-09', 9000000, 500000, 300000, 500000, 26.0, 2.0, 130000, 200000, 0, 0.00, 0, 0, 0.0, '', 10630000, 'paid', '2025-09-30 08:00:00'),
(7, 4, '2025-09', 12000000, 1500000, 300000, 0, 24.0, 0.0, 0, 0, 0, 0.00, 0, 0, 2.0, 'Nghỉ ốm', 12876000, 'paid', '2025-09-30 08:00:00'),
(8, 6, '2025-09', 7000000, 300000, 0, 0, 26.0, 0.0, 0, 1500000, 0, 0.00, 1, 50000, 0.0, '', 8750000, 'paid', '2025-09-30 08:00:00');

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
(5, 'salary.view', 'Xem bảng lương'),
(6, 'salary.manage', 'Tính lương và Chốt lương'),
(7, 'salary.export', 'Xuất Excel lương'),
(8, 'expense.manage', 'Quản lý Chi tiêu'),
(9, 'leave.approve', 'Duyệt đơn nghỉ phép'),
(10, 'news.manage', 'Đăng tin tức'),
(11, 'leave.create', 'Xin nghỉ phép cá nhân'),
(12, 'attendance.check', 'Chấm công hàng ngày'),
(13, 'salary.read_personal', 'Xem lương cá nhân'),
(20, 'class.view', 'Xem lịch dạy và lớp học'),
(21, 'lead.manage', 'Quản lý khách hàng tiềm năng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profile_requests`
--

CREATE TABLE `profile_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
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
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Admin', 'Quản trị viên hệ thống', 25000000),
(2, 'Trưởng phòng', 'Quản lý phòng ban', 18000000),
(3, 'Kế toán', 'Chuyên viên Kế toán', 9000000),
(4, 'Giáo viên', 'Giáo viên Tiếng Anh', 12000000),
(5, 'Tuyển sinh', 'Nhân viên Sale/Tư vấn', 7000000),
(6, 'Nhân viên', 'Nhân viên Hành chính', 6000000);

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
(1, 11),
(1, 12),
(1, 13),
(2, 1),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 11),
(3, 12),
(3, 13),
(4, 11),
(4, 12),
(4, 13),
(4, 20),
(5, 11),
(5, 12),
(5, 13),
(5, 21),
(6, 10),
(6, 11),
(6, 12),
(6, 13);

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
(1, 'allowance_bachelor', '500000', 'Phụ cấp Đại học (đ)'),
(2, 'allowance_master', '1500000', 'Phụ cấp Thạc sĩ (đ)'),
(3, 'allowance_phd', '3000000', 'Phụ cấp Tiến sĩ (đ)'),
(4, 'allowance_intermediate', '200000', 'Phụ cấp Trung cấp (đ)'),
(5, 'allowance_college', '300000', 'Phụ cấp Cao đẳng (đ)'),
(6, 'allowance_sen_1y', '300000', 'Thâm niên > 1 năm (đ)'),
(7, 'allowance_sen_3y', '1000000', 'Thâm niên > 3 năm (đ)'),
(8, 'allowance_sen_5y', '2000000', 'Thâm niên > 5 năm (đ)'),
(9, 'allowance_ielts_6', '500000', 'IELTS 6.0+ / TOEIC 600+'),
(10, 'allowance_ielts_7', '1000000', 'IELTS 7.0+ / TOEIC 800+'),
(11, 'allowance_ielts_8', '2000000', 'IELTS 8.0+'),
(12, 'standard_work_days', '26', 'Số công chuẩn/tháng');

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
(1, 1, 'admin', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'admin@center.com', 'Super Admin', 'img/default.jpg', 'active', '2025-11-30 14:32:40'),
(2, 2, 'tp_daotao', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'manager@center.com', 'Trần Đào Tạo', 'img/default.jpg', 'active', '2025-11-30 14:32:40'),
(3, 3, 'ketoan', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'acc@center.com', 'Lê Kế Toán', 'img/default.jpg', 'active', '2025-11-30 14:32:40'),
(4, 4, 'teacher_native', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'teacher1@center.com', 'Mr. David Beck', 'img/default.jpg', 'active', '2025-11-30 14:32:40'),
(5, 4, 'teacher_vn', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'teacher2@center.com', 'Cô Mai Anh', 'img/default.jpg', 'active', '2025-11-30 14:32:40'),
(6, 5, 'sale_staff', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'sale@center.com', 'Nguyễn Văn Sale', 'img/default.jpg', 'active', '2025-11-30 14:32:40'),
(7, 6, 'mkt_staff', '$2y$10$1tzcfBb3Y1Z3dUIdd4eE2esR25Z4ARIVv2zLvJ8VMZOGnHEc4tENi', 'mkt@center.com', 'Phạm Marketing', 'img/default.jpg', 'active', '2025-11-30 14:32:40');

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
-- Chỉ mục cho bảng `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

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
-- Chỉ mục cho bảng `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `profile_requests`
--
ALTER TABLE `profile_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Các ràng buộc cho bảng `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Các ràng buộc cho bảng `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
