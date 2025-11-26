<?php
session_start();
// Nếu đã đăng nhập thì chuyển hướng luôn
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: user_dashboard.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Forcre.vn</title>
    <link rel="stylesheet" href="style_consult.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="left-panel">
            <div class="left-content">
                <h1>Chào mừng trở lại!</h1>
                <p>Kết nối với hệ thống quản trị nhân sự chuyên nghiệp của DDMQ.vn.</p>
                <a href="index.php" class="view-more-btn"><i class="fas fa-arrow-left"></i> Về Trang Chủ</a>
            </div>
        </div>

        <div class="right-panel">
            <div class="right-content">
                <h2 class="form-title">Đăng Nhập</h2>
                
                <form action="login_process.php" method="POST">
                    <div class="input-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="username" placeholder="Nhập username của bạn" required>
                    </div>
                    
                    <div class="input-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>

                    <button type="submit" class="btn-common primary-btn">
                        Đăng Nhập
                    </button>
                </form>

                <div class="switch-link">
                    <span>Chưa có tài khoản?</span>
                </div>

                <a href="register.php" class="btn-common secondary-btn">
                    Đăng Ký Tài Khoản Mới
                </a>
            </div>
        </div>
    </div>
</body>
</html>