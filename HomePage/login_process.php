<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra user trong database
    $sql = "SELECT id, username, password, full_name, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $row['password'])) {
            // Lưu Session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['role'] = $row['role'];

            // --- PHẦN QUAN TRỌNG: PHÂN LUỒNG ---
            if ($row['role'] === 'admin') {
                header("Location: admin_dashboard.php"); // Trang của Sếp
            } else {
                header("Location: user_dashboard.php");  // Trang của Nhân viên
            }
            exit();
        } else {
            // Sai mật khẩu -> Quay về trang chủ và báo lỗi
            echo "<script>alert('Mật khẩu không đúng!'); window.location.href='index.php';</script>";
        }
    } else {
        // Sai tài khoản
        echo "<script>alert('Tài khoản không tồn tại!'); window.location.href='index.php';</script>";
    }
    $stmt->close();
    $conn->close();
}
?>