<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Lấy thông tin User
    // Chỉ cần lấy role_id là đủ để phân quyền
    $sql = "SELECT * FROM users WHERE username = ? AND status = 'active'";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $row['password'])) {
            // --- ĐĂNG NHẬP THÀNH CÔNG ---
            
            // Lưu thông tin cơ bản
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['role_id'] = $row['role_id']; // Lưu ID (số)
            $_SESSION['avatar'] = $row['avatar'];

            // [QUAN TRỌNG] Tạo thêm biến 'role' (chữ) để tương thích với code cũ
            if ($row['role_id'] == 1 || $row['role_id'] == 2) { 
                // ID 1 (Admin) và 2 (Manager) được coi là 'admin'
                $_SESSION['role'] = 'admin';
            } else {
                // Các ID còn lại là 'employee'
                $_SESSION['role'] = 'employee';
            }

            // 2. Lấy danh sách Quyền hạn (Permissions)
            $permissions = [];
            $perm_sql = "SELECT p.code 
                         FROM permissions p 
                         JOIN role_permissions rp ON p.id = rp.permission_id 
                         WHERE rp.role_id = ?";
            if ($perm_stmt = $conn->prepare($perm_sql)) {
                $perm_stmt->bind_param("i", $row['role_id']);
                $perm_stmt->execute();
                $perm_result = $perm_stmt->get_result();
                while ($perm = $perm_result->fetch_assoc()) {
                    $permissions[] = $perm['code'];
                }
                $perm_stmt->close();
            }
            $_SESSION['permissions'] = $permissions; 

            // 3. Chuyển hướng đúng trang
            if ($_SESSION['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Mật khẩu không đúng!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại hoặc chưa được kích hoạt!'); window.location.href='login.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>