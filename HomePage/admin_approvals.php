<?php
session_start();
require_once 'db_connect.php';

// Check quyền: Phải là Admin HOẶC có quyền duyệt đơn (leave.approve hoặc approve.manage)
if (!isset($_SESSION['user_id']) || (!hasPermission('leave.approve') && !hasPermission('approve.manage') && $_SESSION['role_id'] != 1)) {
    header("Location: index.php");
    exit();
}
// ... phần còn lại giữ nguyên ...

// --- DUYỆT ĐƠN NGHỈ ---
if (isset($_POST['action_leave'])) {
    $id = $_POST['req_id'];
    $status = ($_POST['action_leave'] == 'approve') ? 'approved' : 'rejected';
    $stmt = $conn->prepare("UPDATE leave_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

// --- DUYỆT HỒ SƠ (UPDATE AVATAR) ---
if (isset($_POST['action_profile'])) {
    $req_id = $_POST['req_id'];
    $action = $_POST['action_profile'];

    if ($action == 'reject') {
        $conn->query("UPDATE profile_requests SET status = 'rejected' WHERE id = $req_id");
    } elseif ($action == 'approve') {
        $req = $conn->query("SELECT * FROM profile_requests WHERE id = $req_id")->fetch_assoc();
        $uid = $req['user_id'];

        // 1. Cập nhật Users (Thêm cập nhật Avatar)
        $stmt1 = $conn->prepare("UPDATE users SET full_name=?, email=?, avatar=? WHERE id=?");
        $stmt1->bind_param("sssi", $req['full_name'], $req['email'], $req['avatar'], $uid);
        $stmt1->execute();

        // 2. Cập nhật Employee Details
        $check = $conn->query("SELECT user_id FROM employee_details WHERE user_id = $uid");
        if ($check->num_rows > 0) {
            $sql_det = "UPDATE employee_details SET phone=?, dob=?, address=?, education_level=?, major=?, certificate_type=?, certificate_score=?, biography=?, edu_proof=?, cert_proof=? WHERE user_id=?";
        } else {
            $sql_det = "INSERT INTO employee_details (phone, dob, address, education_level, major, certificate_type, certificate_score, biography, edu_proof, cert_proof, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }
        $stmt2 = $conn->prepare($sql_det);
        $stmt2->bind_param("ssssssdsssi", $req['phone'], $req['dob'], $req['address'], $req['education_level'], $req['major'], $req['certificate_type'], $req['certificate_score'], $req['biography'], $req['edu_proof'], $req['cert_proof'], $uid);
        $stmt2->execute();

        // 3. Done
        $conn->query("UPDATE profile_requests SET status = 'approved' WHERE id = $req_id");
    }
}

// Lấy dữ liệu
$leaves = $conn->query("SELECT lr.*, u.full_name FROM leave_requests lr JOIN users u ON lr.user_id = u.id WHERE lr.status = 'pending' ORDER BY lr.created_at ASC");
$profiles = $conn->query("SELECT pr.*, u.username FROM profile_requests pr JOIN users u ON pr.user_id = u.id WHERE pr.status = 'pending' ORDER BY pr.request_date ASC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trung tâm Phê duyệt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-check-double text-success"></i> Trung tâm Phê duyệt</h2>
            <<a href="<?php echo ($_SESSION['role_id'] == 1) ? 'admin_dashboard.php' : 'user_dashboard.php'; ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Quay lại
</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="approvalTab" role="tablist">
                    <li class="nav-item"><button class="nav-link active fw-bold" data-bs-toggle="tab" data-bs-target="#leave-content">Đơn nghỉ phép <span class="badge bg-danger rounded-pill"><?php echo $leaves->num_rows; ?></span></button></li>
                    <li class="nav-item"><button class="nav-link fw-bold" data-bs-toggle="tab" data-bs-target="#profile-content">Cập nhật Hồ sơ <span class="badge bg-warning text-dark rounded-pill"><?php echo $profiles->num_rows; ?></span></button></li>
                </ul>
            </div>
            
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="leave-content">
                        <?php if ($leaves->num_rows > 0): ?>
                            <table class="table table-hover align-middle">
                                <thead class="table-light"><tr><th>Nhân viên</th><th>Thời gian</th><th>Lý do</th><th>Hành động</th></tr></thead>
                                <tbody>
                                    <?php while($row = $leaves->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo $row['full_name']; ?></td>
                                        <td><?php echo date('d/m', strtotime($row['start_date'])) . ' - ' . date('d/m', strtotime($row['end_date'])); ?></td>
                                        <td><?php echo $row['reason']; ?></td>
                                        <td>
                                            <form method="POST" class="d-flex gap-2">
                                                <input type="hidden" name="req_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="action_leave" value="approve" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Duyệt</button>
                                                <button type="submit" name="action_leave" value="reject" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Từ chối</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center text-muted py-3">Không có đơn nghỉ phép nào.</p>
                        <?php endif; ?>
                    </div>

                    <div class="tab-pane fade" id="profile-content">
                        <?php if ($profiles->num_rows > 0): ?>
                            <div class="accordion" id="accordionProfiles">
                                <?php while($req = $profiles->fetch_assoc()): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#req<?php echo $req['id']; ?>">
                                            <strong><?php echo $req['full_name']; ?></strong> 
                                            <span class="ms-2 text-muted small">(<?php echo $req['username']; ?>)</span>
                                        </button>
                                    </h2>
                                    <div id="req<?php echo $req['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionProfiles">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-2 text-center">
                                                    <img src="<?php echo $req['avatar'] ?? 'img/default.jpg'; ?>" class="rounded-circle border" style="width: 80px; height: 80px; object-fit: cover;">
                                                    <div class="small mt-1 text-success fw-bold">Avatar mới</div>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="mb-1"><strong>Email:</strong> <?php echo $req['email']; ?></p>
                                                    <p class="mb-1"><strong>SĐT:</strong> <?php echo $req['phone']; ?></p>
                                                    <p class="mb-1"><strong>Trình độ:</strong> <?php echo $req['education_level']; ?> - <?php echo $req['major']; ?></p>
                                                    <?php if($req['edu_proof']): ?><a href="<?php echo $req['edu_proof']; ?>" target="_blank" class="badge bg-info text-decoration-none">Ảnh bằng cấp</a><?php endif; ?>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="mb-1"><strong>Chứng chỉ:</strong> <?php echo $req['certificate_type']; ?> (<?php echo $req['certificate_score']; ?>)</p>
                                                    <?php if($req['cert_proof']): ?><a href="<?php echo $req['cert_proof']; ?>" target="_blank" class="badge bg-info text-decoration-none">Ảnh chứng chỉ</a><?php endif; ?>
                                                    <p class="mb-1 mt-2"><strong>Tiểu sử:</strong> <em class="small"><?php echo substr($req['biography'], 0, 50); ?>...</em></p>
                                                </div>
                                            </div>
                                            <div class="mt-3 text-end border-top pt-3">
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="req_id" value="<?php echo $req['id']; ?>">
                                                    <button type="submit" name="action_profile" value="reject" class="btn btn-secondary me-2">Từ chối</button>
                                                    <button type="submit" name="action_profile" value="approve" class="btn btn-success fw-bold">Phê duyệt Cập nhật</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-center text-muted py-3">Không có yêu cầu cập nhật hồ sơ nào.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>