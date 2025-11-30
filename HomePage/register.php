<?php
require_once 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    // Mặc định đăng ký là Staff (ID = 4 trong bảng roles)
    // Bạn có thể đổi thành 3 nếu muốn mặc định là Teacher
    $role_id = 4; 

    if ($password !== $confirm_password) {
        $message = "<div class='alert alert-danger'>Mật khẩu xác nhận không khớp!</div>";
    } else {
        // Kiểm tra tồn tại
        $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
        if($stmt = $conn->prepare($check_sql)){
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();
            
            if($stmt->num_rows > 0){
                $message = "<div class='alert alert-danger'>Username hoặc Email đã tồn tại!</div>";
            } else {
                $stmt->close();
                
                // 1. Insert vào bảng users
                $sql = "INSERT INTO users (role_id, username, password, email, full_name, status) VALUES (?, ?, ?, ?, ?, 'active')";
                if($insert_stmt = $conn->prepare($sql)){
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $insert_stmt->bind_param("issss", $role_id, $username, $hashed_password, $email, $full_name);
                    
                    if($insert_stmt->execute()){
                        $new_user_id = $conn->insert_id; // Lấy ID vừa tạo
                        
                        // 2. Tạo bản ghi hồ sơ chi tiết (employee_details)
                        // Để tránh lỗi khi vào trang profile sau này
                        $conn->query("INSERT INTO employee_details (user_id, start_date) VALUES ($new_user_id, CURRENT_DATE)");

                        $message = "<div class='alert alert-success'>Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a></div>";
                    } else {
                        $message = "<div class='alert alert-danger'>Lỗi hệ thống: " . $conn->error . "</div>";
                    }
                    $insert_stmt->close();
                }
            }
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - English Center HR</title>
    <link rel="stylesheet" href="style_consult.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="left-panel">
            <div class="left-content">
                <h1>Chào mừng!</h1>
                <p>Hệ thống quản lý nhân sự dành cho Trung tâm Anh ngữ.</p>
                <a href="index.php" class="view-more-btn"><i class="fas fa-arrow-left"></i> Về Trang Chủ</a>
            </div>
        </div>

        <div class="right-panel">
            <div class="right-content">
                <h2 class="form-title">Đăng Ký Tài Khoản</h2>
                
                <?php echo $message; ?>

                <form action="" method="POST">
                    <div class="input-group">
                        <label>Họ và Tên</label>
                        <input type="text" name="full_name" placeholder="Nguyễn Văn A" required>
                    </div>

                    <div class="input-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" placeholder="username" required>
                    </div>
                    
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@example.com" required>
                    </div>
                    
                    <div class="input-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" placeholder="Tối thiểu 6 ký tự" required>
                    </div>

                    <div class="input-group">
                        <label>Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                    </div>
                    
                    <button type="submit" class="btn-common primary-btn">Đăng Ký</button>
                </form>

                <div class="switch-link">
                    <span>Đã có tài khoản?</span>
                </div>

                <a href="login.php" class="btn-common secondary-btn">Đăng Nhập</a>
            </div>
        </div>
    </div>
</body>
</html>