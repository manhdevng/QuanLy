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

// Khởi động session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Hàm kiểm tra quyền hạn
 */
function hasPermission($code) {
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
        return true;
    }
    if (isset($_SESSION['permissions']) && in_array($code, $_SESSION['permissions'])) {
        return true;
    }
    return false;
}

/**
 * MỚI: Hàm lấy giá trị cấu hình từ DB
 */
function getSetting($key) {
    global $conn;
    $sql = "SELECT setting_value FROM settings WHERE setting_key = '$key'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc()['setting_value'];
    }
    return 0; // Mặc định trả về 0 nếu không tìm thấy
}
?>