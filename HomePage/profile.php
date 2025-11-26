<?php
session_start();
require_once 'db_connect.php';

// Phải đăng nhập mới được vào
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$msg = "";

// 1. Xử lý cập nhật thông tin chung
if (isset($_POST['update_info'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    
    $sql = "UPDATE users SET full_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $full_name, $email, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['full_name'] = $full_name; // Cập nhật lại session
        $msg = "<div class='alert alert-success'>Cập nhật thông tin thành công!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// 2. Xử lý đổi mật khẩu
if (isset($_POST['change_pass'])) {
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    // Lấy mật khẩu cũ từ DB để so sánh
    $query = $conn->query("SELECT password FROM users WHERE id = $user_id");
    $row = $query->fetch_assoc();

    if (password_verify($old_pass, $row['password'])) {
        if ($new_pass === $confirm_pass) {
            $hashed_new = password_hash($new_pass, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password = '$hashed_new' WHERE id = $user_id");
            $msg = "<div class='alert alert-success'>Đổi mật khẩu thành công!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Mật khẩu mới không khớp!</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Mật khẩu hiện tại không đúng!</div>";
    }
}

// Lấy thông tin hiện tại để hiển thị vào form
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hồ sơ cá nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-user-cog text-secondary"></i> Cài đặt tài khoản</h2>
                    <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin_dashboard.php' : 'user_dashboard.php'; ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại Dashboard
                    </a>
                </div>

                <?php echo $msg; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-primary text-white">Thông tin cá nhân</div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label>Tên đăng nhập</label>
                                        <input type="text" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                                        <small class="text-muted">Không thể thay đổi tên đăng nhập</small>
                                    </div>
                                    <div class="mb-3">
                                        <label>Họ và tên</label>
                                        <input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                                    </div>
                                    <button type="submit" name="update_info" class="btn btn-primary w-100">Lưu thay đổi</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-danger text-white">Đổi mật khẩu</div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label>Mật khẩu hiện tại</label>
                                        <input type="password" name="old_pass" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" name="new_pass" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nhập lại mật khẩu mới</label>
                                        <input type="password" name="confirm_pass" class="form-control" required>
                                    </div>
                                    <button type="submit" name="change_pass" class="btn btn-danger w-100">Đổi mật khẩu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>