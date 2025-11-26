<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Quản Trị - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card { transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-danger p-3 mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><i class="fas fa-user-shield me-2"></i>Admin Control Panel</span>
            
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Xin chào, 
                    <a href="profile.php" class="text-white text-decoration-none fw-bold">
                        <?php echo $_SESSION['full_name']; ?> <i class="fas fa-edit small"></i>
                    </a>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="alert alert-primary mb-4 shadow-sm">
            <h4><i class="fas fa-chart-line me-2"></i>Tổng quan hệ thống</h4>
            <p class="mb-0">Chào mừng quản trị viên quay trở lại. Hãy chọn chức năng bên dưới.</p>
        </div>
        
        <div class="row g-4"> <div class="col-md-4">
                <div class="card text-white bg-primary h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users me-2"></i>Nhân sự</h5>
                        <p class="card-text">Quản lý danh sách nhân viên, xóa nhân viên vi phạm.</p>
                        <a href="admin_employees.php" class="btn btn-light btn-sm text-primary fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-check-circle me-2"></i>Duyệt đơn nghỉ</h5>
                        <p class="card-text">Xem và phê duyệt các yêu cầu nghỉ phép của nhân viên.</p>
                        <a href="admin_leaves.php" class="btn btn-light btn-sm text-success fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-dark"><i class="fas fa-coins me-2"></i>Tính Lương</h5>
                        <p class="card-text text-dark">Tính toán và quản lý lương thưởng hàng tháng.</p>
                        <a href="admin_payroll.php" class="btn btn-light btn-sm text-warning fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-clock me-2"></i>Quản lý Chấm công</h5>
                        <p class="card-text">Xem nhật ký check-in/out của nhân viên theo ngày.</p>
                        <a href="admin_attendance.php" class="btn btn-light btn-sm text-info fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-dark h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-newspaper me-2"></i>Quản lý Tin tức</h5>
                        <p class="card-text">Đăng bài viết mới lên trang chủ.</p>
                        <a href="admin_news.php" class="btn btn-light btn-sm text-dark fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-secondary h-100 shadow-sm" style="background-color: #6c757d !important;"> <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-building me-2"></i>Quản lý Phòng ban</h5>
                        <p class="card-text">Thiết lập cơ cấu tổ chức và các bộ phận.</p>
                        <a href="admin_departments.php" class="btn btn-light btn-sm text-secondary fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-dark h-100 shadow-sm" style="background-color: #fd7e14 !important;"> <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-bullhorn me-2"></i>Thông báo nội bộ</h5>
                        <p class="card-text">Gửi thông báo đến toàn bộ nhân viên.</p>
                        <a href="admin_notifications.php" class="btn btn-light btn-sm text-dark fw-bold stretched-link">Truy cập</a>
                    </div>
                </div>
            </div>

             <div class="col-md-4">
                <div class="card text-white bg-secondary h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-home me-2"></i>Trang chủ</h5>
                        <p class="card-text">Quay về trang hiển thị chính.</p>
                        <a href="index.php" class="btn btn-light btn-sm text-secondary fw-bold stretched-link">Về trang chủ</a>
                    </div>
                </div>
            </div>

        </div> </div>
</body>
</html>