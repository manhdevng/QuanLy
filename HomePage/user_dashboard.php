<?php
session_start();
require_once 'db_connect.php';

// Bảo mật: Phải đăng nhập mới được vào
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 1. Lấy Thông báo từ Admin (Giữ nguyên)
$notif_query = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC LIMIT 3");

// 2. Lấy các Yêu cầu ĐANG XỬ LÝ (Pending)
// a. Đơn nghỉ phép
$pending_leaves = $conn->query("SELECT * FROM leave_requests WHERE user_id = $user_id AND status = 'pending' ORDER BY created_at DESC");

// b. Yêu cầu sửa hồ sơ
$pending_profiles = $conn->query("SELECT * FROM profile_requests WHERE user_id = $user_id AND status = 'pending' ORDER BY request_date DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card { transition: transform 0.2s; }
        .card:hover { transform: translateY(-3px); }
        .status-card-item { transition: background 0.3s; }
        .status-card-item:hover { background: #f8f9fa; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary p-3 mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><i class="fas fa-user-tag me-2"></i>Cổng Thông Tin Nhân Viên</span>
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
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <img src="<?php echo $_SESSION['avatar'] ?? 'img/default.jpg'; ?>" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <h4 class="card-title"><?php echo $_SESSION['full_name']; ?></h4>
                        <span class="badge bg-info text-dark mb-3">Nhân viên</span>
                        
                        <div class="d-grid gap-2">
                            <a href="profile.php" class="btn btn-outline-primary"><i class="fas fa-user-edit me-2"></i>Cập nhật hồ sơ</a>
                            <a href="profile.php" class="btn btn-outline-danger"><i class="fas fa-key me-2"></i>Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                
                <div class="card shadow-sm mb-4 border-primary">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="fas fa-tasks me-2"></i>Trạng thái Đơn & Yêu cầu
                    </div>
                    <div class="card-body p-0">
                        <?php if ($pending_leaves->num_rows == 0 && $pending_profiles->num_rows == 0): ?>
                            <div class="p-4 text-center text-muted">
                                <i class="fas fa-check-circle fa-2x mb-2 text-success"></i><br>
                                Không có yêu cầu nào đang chờ xử lý.
                            </div>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php while($prof = $pending_profiles->fetch_assoc()): ?>
                                    <li class="list-group-item status-card-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong class="text-dark"><i class="fas fa-id-card text-info me-2"></i>Cập nhật Hồ sơ</strong>
                                            <br><small class="text-muted">Gửi lúc: <?php echo date('H:i d/m/Y', strtotime($prof['request_date'])); ?></small>
                                        </div>
                                        <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                    </li>
                                <?php endwhile; ?>

                                <?php while($leave = $pending_leaves->fetch_assoc()): ?>
                                    <li class="list-group-item status-card-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong class="text-dark"><i class="fas fa-calendar-minus text-danger me-2"></i>Xin nghỉ phép</strong>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo date('d/m', strtotime($leave['start_date'])) . ' - ' . date('d/m', strtotime($leave['end_date'])); ?>
                                                (Lý do: <?php echo $leave['reason']; ?>)
                                            </small>
                                        </div>
                                        <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom fw-bold">
                        <i class="fas fa-bell me-2 text-warning"></i>Thông báo từ Ban quản trị
                    </div>
                    <div class="card-body p-0">
                        <?php if ($notif_query->num_rows > 0): ?>
                            <ul class="list-group list-group-flush">
                                <?php while($note = $notif_query->fetch_assoc()): ?>
                                    <li class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                            <strong class="text-primary"><?php echo $note['title']; ?></strong>
                                            <small class="text-muted bg-light px-2 rounded">
                                                <?php echo date('d/m/Y', strtotime($note['created_at'])); ?>
                                            </small>
                                        </div>
                                        <p class="mb-0 small text-dark"><?php echo nl2br($note['content']); ?></p>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <div class="p-4 text-center text-muted">
                                <i class="far fa-bell-slash fa-2x mb-2"></i><br>
                                Chưa có thông báo mới nào.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <h5 class="mb-3 text-muted"><i class="fas fa-th-large me-2"></i>Tiện ích của bạn</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-calendar-plus fa-2x text-primary mb-3"></i>
                                <h6 class="card-title">Xin nghỉ phép</h6>
                                <a href="user_leaves.php" class="btn btn-sm btn-primary w-100 stretched-link">Tạo đơn</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-fingerprint fa-2x text-success mb-3"></i>
                                <h6 class="card-title">Chấm công</h6>
                                <a href="user_attendance.php" class="btn btn-sm btn-success w-100 stretched-link">Check-in/out</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-file-invoice-dollar fa-2x text-warning mb-3"></i>
                                <h6 class="card-title">Bảng lương</h6>
                                <a href="user_payroll.php" class="btn btn-sm btn-warning text-white w-100 stretched-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>