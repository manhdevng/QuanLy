<?php
session_start();
require_once 'db_connect.php';

// Chỉ Super Admin được vào
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: index.php");
    exit();
}

$message = "";

// Xử lý Lưu cấu hình
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'setting_') === 0) {
            $real_key = substr($key, 8); // Bỏ prefix 'setting_'
            $real_value = str_replace(',', '', $value); // Bỏ dấu phẩy
            
            $stmt = $conn->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
            $stmt->bind_param("ss", $real_value, $real_key);
            $stmt->execute();
        }
    }
    $message = "<div class='alert alert-success'>Đã cập nhật cấu hình thành công!</div>";
}

// Lấy danh sách cấu hình
$settings = $conn->query("SELECT * FROM settings");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cấu hình Hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-cogs text-secondary"></i> Cấu hình Tham số Lương & Phạt</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
                Bảng tham số hệ thống
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <?php while($row = $settings->fetch_assoc()): ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold"><?php echo $row['setting_name']; ?></label>
                            <div class="input-group">
                                <input type="number" name="setting_<?php echo $row['setting_key']; ?>" 
                                       class="form-control" value="<?php echo $row['setting_value']; ?>" required>
                                <span class="input-group-text bg-light">
                                    <?php echo ($row['setting_key'] == 'standard_work_days') ? 'ngày' : 'VNĐ'; ?>
                                </span>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary px-5 fw-bold">
                            <i class="fas fa-save"></i> Lưu Thay Đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle"></i> <strong>Lưu ý:</strong> Các thay đổi ở đây sẽ áp dụng ngay lập tức cho việc tính lương tháng này và các tháng sau.
        </div>
    </div>
</body>
</html>