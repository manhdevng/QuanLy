<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrm_system";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Thiết lập charset và múi giờ
$conn->set_charset("utf8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn->query("SET time_zone = '+07:00'");

// Khởi động session nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Hàm kiểm tra quyền hạn (Permission Check)
 * @param string $code Mã quyền cần kiểm tra (VD: 'user.create', 'salary.view')
 * @return bool True nếu có quyền, False nếu không
 */
function hasPermission($code) {
    // Admin (role_id = 1) luôn có tất cả quyền
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
        return true;
    }

    // Kiểm tra trong danh sách quyền đã lưu ở Session
    if (isset($_SESSION['permissions']) && in_array($code, $_SESSION['permissions'])) {
        return true;
    }

    return false;
}
?>