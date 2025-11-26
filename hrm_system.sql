-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2025 lúc 02:55 PM
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
(1, 4, '2025-11-25', '08:27:51', '08:27:58', 'present'),
(2, 3, '2025-11-25', '08:38:53', '08:45:58', 'present');

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
(1, 'Phòng Chiến lược', 'Xây dựng kế hoạch dài hạn để tăng doanh thu.', 'img/Strategy.jpg', '2025-11-24 17:57:28'),
(2, 'Phòng Vận hành', 'Tối ưu hóa quy trình làm việc để đạt hiệu quả cao.', 'img/Operations.jpg', '2025-11-24 17:57:28'),
(3, 'Phòng Tài chính', 'Mô hình hóa tài chính và quản lý rủi ro.', 'img/Finance.jpg', '2025-11-24 17:57:28'),
(4, 'Phòng Nhân sự', 'Xây dựng văn hóa hiệu suất cao và phát triển nhân tài.', 'img/HR.jpg', '2025-11-24 17:57:28'),
(5, 'adasdad', 'ádadsdad', 'img/Strategy.jpg', '2025-11-24 17:58:59');

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
(1, 3, '2025-11-13', '2025-11-29', 'Bị Cúm A', 'approved', '2025-11-24 16:12:51'),
(2, 3, '2025-11-25', '2025-11-28', 'Việc gia đình', 'rejected', '2025-11-25 01:38:42');

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
(3, 'Mở khóa tăng trưởng bền vững', 'Khám phá các bước thực tế để mở rộng quy mô doanh nghiệp giữa những bất ổn.', NULL, 'img/mission1.jpg', '2025-11-24'),
(4, 'Tương lai của đổi mới kinh doanh', 'Các công nghệ mới nổi đang định hình bối cảnh tư vấn.', NULL, 'img/aboutus3.png', '2025-11-23'),
(5, 'Truyện Hôm nay', 'Không có', NULL, 'img/Strategy.jpg', '2025-11-25');

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
(1, 'Chào mừng thành viên mới', 'Công ty DDMQ chính thức đi vào hoạt động. Chúc mọi người làm việc hiệu quả!', '2025-11-25 01:40:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `base_salary` decimal(15,0) NOT NULL,
  `work_days` int(11) DEFAULT 0,
  `bonus` decimal(15,0) DEFAULT 0,
  `deductions` decimal(15,0) DEFAULT 0,
  `total_salary` decimal(15,0) NOT NULL,
  `status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payroll`
--

INSERT INTO `payroll` (`id`, `user_id`, `month`, `base_salary`, `work_days`, `bonus`, `deductions`, `total_salary`, `status`, `created_at`) VALUES
(1, 3, '2025-11', 5000000, 1, 5000000, 2000, 9998000, 'paid', '2025-11-24 17:49:18'),
(2, 4, '2025-11', 5000000, 1, 0, 50000, 4950000, 'paid', '2025-11-25 01:31:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 'Quản trị viên', 'admin', '2025-11-24 14:11:35'),
(2, 'dat2722005', '$2y$10$GthskVt31yTtr66rmmfzr.1nbZpXEV0fzFeeCuychyLPwYnfLO7ie', 'nguyentiendat2722005@gmail.com', 'Đạt Nguyễn Tiến Đạt', 'admin', '2025-11-24 14:36:22'),
(3, 'dat272', '$2y$10$Js2IdFYWZtJ/rzy25gvgzesWYbRe.AoM0XspleyD8lVUDjiv1zrXm', 'khongco@gmail.com', 'NhanVien1', '', '2025-11-24 16:12:11'),
(4, 'dat123', '$2y$10$EdaVNc53EYJ.DyyOBnkMlehhYLU77RVhpfJdAXuEKqvHjzidDDlwO', 'n5@gmail.com', 'Toi', '', '2025-11-25 01:27:08'),
(5, 'admin123', '$2y$10$7segGNNXoCJOExBXZy1Dwe4vIy/7BHr2U5OhnMjbZo6CMGsSPkgi2', 'aas@gmail.com', 'Nguyen', 'admin', '2025-11-25 03:31:26');

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
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

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
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
