<?php
session_start();
require_once 'db_connect.php';

// Bảo mật
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 1. LẤY THÔNG TIN USER
$sql_user = "SELECT u.*, r.name as role_name 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.id = $user_id";
$user_info = $conn->query($sql_user)->fetch_assoc();

// 2. Các query phụ
$notif_query = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC LIMIT 3");
$pending_leaves = $conn->query("SELECT * FROM leave_requests WHERE user_id = $user_id AND status = 'pending' ORDER BY created_at DESC");
$pending_profiles = $conn->query("SELECT * FROM profile_requests WHERE user_id = $user_id AND status = 'pending' ORDER BY request_date DESC");

// --- CHECK QUYỀN QUẢN LÝ (ADMIN/MANAGER/ACC) ---
$can_manage_salary = hasPermission('salary.manage');
$can_manage_expense = hasPermission('expense.manage');
$can_approve = hasPermission('leave.approve');
$can_view_users = hasPermission('user.view');
$can_manage_news = hasPermission('news.manage');
$is_manager = ($can_manage_salary || $can_manage_expense || $can_approve || $can_view_users || $can_manage_news);

// --- CHECK QUYỀN CHUYÊN MÔN (TEACHER/SALE) ---
$is_teacher = hasPermission('class.view');
$is_sales = hasPermission('lead.manage');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - <?php echo $user_info['full_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card { transition: transform 0.2s; border: none; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
        .icon-box { font-size: 2rem; margin-bottom: 10px; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><i class="fas fa-user-tag me-2"></i>Cổng Thông Tin Nhân Viên</span>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Xin chào, <a href="profile.php" class="text-white fw-bold text-decoration-none"><?php echo $user_info['full_name']; ?></a></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3"><img src="<?php echo $user_info['avatar'] ?? 'img/default.jpg'; ?>" class="rounded-circle shadow-sm" style="width: 110px; height: 110px; object-fit: cover;"></div>
                        <h4 class="card-title mb-1"><?php echo $user_info['full_name']; ?></h4>
                        <span class="badge bg-primary text-white mb-3 px-3 py-2 rounded-pill"><?php echo $user_info['role_name']; ?></span>
                        <div class="d-grid gap-2 mt-2">
                            <a href="profile.php" class="btn btn-outline-primary"><i class="fas fa-user-edit me-2"></i>Cập nhật hồ sơ</a>
                            <a href="profile.php" class="btn btn-outline-danger"><i class="fas fa-key me-2"></i>Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-white border-bottom fw-bold text-warning"><i class="fas fa-bell me-2"></i>Thông báo mới</div>
                    <div class="card-body p-0">
                        <?php if ($notif_query->num_rows > 0): ?>
                            <ul class="list-group list-group-flush">
                                <?php while($note = $notif_query->fetch_assoc()): ?>
                                    <li class="list-group-item"><small class="text-muted d-block"><?php echo date('d/m', strtotime($note['created_at'])); ?></small><strong class="text-dark"><?php echo $note['title']; ?></strong></li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <div class="p-3 text-center text-muted small">Không có thông báo.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                
                <?php if ($is_teacher): ?>
                <div class="mb-4">
                    <h5 class="mb-3 text-primary border-bottom pb-2"><i class="fas fa-chalkboard-teacher me-2"></i>Góc Giảng Dạy</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-start border-4 border-primary shadow-sm">
                                <div class="card-body text-center">
                                    <div class="icon-box text-primary"><i class="fas fa-calendar-alt"></i></div>
                                    <h6 class="card-title fw-bold">Lịch Dạy & Lớp Học</h6>
                                    <p class="card-text small text-muted">Xem lịch và danh sách lớp.</p>
                                    <a href="teacher_classes.php" class="stretched-link text-decoration-none">Truy cập</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($is_sales): ?>
                <div class="mb-4">
                    <h5 class="mb-3 text-success border-bottom pb-2"><i class="fas fa-headset me-2"></i>Góc Tuyển Sinh</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-start border-4 border-success shadow-sm">
                                <div class="card-body text-center">
                                    <div class="icon-box text-success"><i class="fas fa-users-cog"></i></div>
                                    <h6 class="card-title fw-bold">Quản lý Leads</h6>
                                    <p class="card-text small text-muted">Danh sách khách hàng cần tư vấn.</p>
                                    <a href="sale_leads.php" class="stretched-link text-decoration-none">Truy cập</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($is_manager): ?>
                <div class="mb-4">
                    <h5 class="mb-3 text-danger border-bottom pb-2"><i class="fas fa-briefcase me-2"></i>Chức năng Quản lý</h5>
                    <div class="row g-3">
                        <?php if ($can_manage_salary): ?><div class="col-md-4 col-sm-6"><div class="card h-100 border-start border-4 border-warning shadow-sm"><div class="card-body text-center"><div class="icon-box text-warning"><i class="fas fa-calculator"></i></div><h6 class="card-title fw-bold">Tính Lương</h6><a href="admin_payroll.php" class="stretched-link text-decoration-none">Truy cập</a></div></div></div><?php endif; ?>
                        <?php if ($can_manage_expense): ?><div class="col-md-4 col-sm-6"><div class="card h-100 border-start border-4 border-danger shadow-sm"><div class="card-body text-center"><div class="icon-box text-danger"><i class="fas fa-file-invoice-dollar"></i></div><h6 class="card-title fw-bold">Chi tiêu</h6><a href="admin_expenses.php" class="stretched-link text-decoration-none">Truy cập</a></div></div></div><?php endif; ?>
                        <?php if ($can_approve): ?><div class="col-md-4 col-sm-6"><div class="card h-100 border-start border-4 border-success shadow-sm"><div class="card-body text-center"><div class="icon-box text-success"><i class="fas fa-check-double"></i></div><h6 class="card-title fw-bold">Phê duyệt</h6><a href="admin_approvals.php" class="stretched-link text-decoration-none">Truy cập</a></div></div></div><?php endif; ?>
                        <?php if ($can_view_users): ?><div class="col-md-4 col-sm-6"><div class="card h-100 border-start border-4 border-info shadow-sm"><div class="card-body text-center"><div class="icon-box text-info"><i class="fas fa-users"></i></div><h6 class="card-title fw-bold">Nhân sự</h6><a href="admin_employees.php" class="stretched-link text-decoration-none">Truy cập</a></div></div></div><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <h5 class="mb-3 text-muted border-bottom pb-2"><i class="fas fa-coffee me-2"></i>Tiện ích cá nhân</h5>
                
                <div class="card shadow-sm mb-4 border-0 bg-white">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-3 text-muted fw-bold">Trạng thái yêu cầu</h6>
                        <?php if ($pending_leaves->num_rows == 0 && $pending_profiles->num_rows == 0): ?>
                            <div class="alert alert-light border text-center mb-0"><i class="fas fa-check-circle text-success me-2"></i> Không có yêu cầu nào.</div>
                        <?php else: ?>
                            <div class="list-group">
                                <?php while($prof = $pending_profiles->fetch_assoc()): ?><div class="list-group-item d-flex justify-content-between align-items-center"><div><i class="fas fa-id-card text-info me-2"></i> Cập nhật Hồ sơ</div><span class="badge bg-warning text-dark">Chờ duyệt</span></div><?php endwhile; ?>
                                <?php while($leave = $pending_leaves->fetch_assoc()): ?><div class="list-group-item d-flex justify-content-between align-items-center"><div><i class="fas fa-calendar-minus text-danger me-2"></i> Xin nghỉ phép</div><span class="badge bg-warning text-dark">Chờ duyệt</span></div><?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row g-3">
                    <?php if (hasPermission('leave.create')): ?><div class="col-md-4 col-sm-6"><div class="card h-100 shadow-sm text-center"><div class="card-body"><i class="fas fa-calendar-plus fa-2x text-primary mb-3"></i><h6 class="card-title">Xin nghỉ phép</h6><a href="user_leaves.php" class="btn btn-sm btn-outline-primary w-100 stretched-link">Tạo đơn</a></div></div></div><?php endif; ?>
                    <?php if (hasPermission('attendance.check')): ?><div class="col-md-4 col-sm-6"><div class="card h-100 shadow-sm text-center"><div class="card-body"><i class="fas fa-fingerprint fa-2x text-success mb-3"></i><h6 class="card-title">Chấm công</h6><a href="user_attendance.php" class="btn btn-sm btn-outline-success w-100 stretched-link">Check-in</a></div></div></div><?php endif; ?>
                    <?php if (hasPermission('salary.read_personal')): ?><div class="col-md-4 col-sm-6"><div class="card h-100 shadow-sm text-center"><div class="card-body"><i class="fas fa-file-invoice-dollar fa-2x text-warning mb-3"></i><h6 class="card-title">Bảng lương</h6><a href="user_payroll.php" class="btn btn-sm btn-outline-warning w-100 stretched-link text-dark">Xem chi tiết</a></div></div></div><?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</body>
</html>