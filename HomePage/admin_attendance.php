<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    header("Location: index.php");
    exit();
}

// Lọc theo ngày (Mặc định là hôm nay)
$filter_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$current_month = date('m', strtotime($filter_date));
$current_year = date('Y', strtotime($filter_date));

// Lấy dữ liệu chấm công kết hợp thông tin nhân viên cho ngày được chọn
$sql = "SELECT a.*, u.full_name, u.username 
        FROM attendance a 
        JOIN users u ON a.user_id = u.id 
        WHERE a.date = ? 
        ORDER BY a.check_in DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $filter_date);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Chấm công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-clock text-info"></i> Nhật ký Chấm công</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-auto">
                        <label class="form-label fw-bold">Chọn ngày xem:</label>
                        <input type="date" name="date" class="form-control" value="<?php echo $filter_date; ?>" onchange="this.form.submit()">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Xem</button>
                    </div>
                    <div class="col-auto ms-auto">
                        <span class="text-muted">Đang xem dữ liệu tháng: <strong><?php echo "$current_month/$current_year"; ?></strong></span>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-info">
                        <tr>
                            <th>Nhân viên</th>
                            <th>Mã NV</th>
                            <th>Giờ vào</th>
                            <th>Giờ ra</th>
                            <th>Trạng thái (Hôm nay)</th>
                            <th class="text-danger">Đi muộn (Tháng này)</th> <th class="text-primary">Nghỉ phép (Tháng này)</th> </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): 
                                $uid = $row['user_id'];

                                // 1. Đếm số lần đi muộn trong tháng này
                                $sql_late = "SELECT COUNT(*) as count FROM attendance 
                                             WHERE user_id = $uid 
                                             AND MONTH(date) = '$current_month' 
                                             AND YEAR(date) = '$current_year' 
                                             AND status = 'late'";
                                $late_count = $conn->query($sql_late)->fetch_assoc()['count'];

                                // 2. Đếm số đơn nghỉ phép ĐÃ DUYỆT trong tháng này
                                // (Tính sơ bộ dựa trên ngày bắt đầu nghỉ nằm trong tháng)
                                $sql_leave = "SELECT COUNT(*) as count FROM leave_requests 
                                              WHERE user_id = $uid 
                                              AND MONTH(start_date) = '$current_month' 
                                              AND YEAR(start_date) = '$current_year' 
                                              AND status = 'approved'";
                                $leave_count = $conn->query($sql_leave)->fetch_assoc()['count'];
                            ?>
                            <tr>
                                <td class="text-start fw-bold"><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                
                                <td>
                                    <span class="badge bg-success" style="font-size: 0.9rem;">
                                        <?php echo date('H:i', strtotime($row['check_in'])); ?>
                                    </span>
                                </td>
                                
                                <td>
                                    <?php if($row['check_out']): ?>
                                        <span class="badge bg-danger" style="font-size: 0.9rem;">
                                            <?php echo date('H:i', strtotime($row['check_out'])); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted small">--:--</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td>
                                    <?php 
                                        if ($row['status'] == 'late') {
                                            echo '<span class="badge rounded-pill bg-warning text-dark">Đi muộn</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill bg-primary">Đúng giờ</span>';
                                        }
                                    ?>
                                </td>

                                <td>
                                    <?php if($late_count > 0): ?>
                                        <strong class="text-danger"><?php echo $late_count; ?> lần</strong>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if($leave_count > 0): ?>
                                        <strong class="text-primary"><?php echo $leave_count; ?> đơn</strong>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center text-muted py-4">Chưa có dữ liệu chấm công cho ngày này.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="alert alert-info mt-3 small">
            <i class="fas fa-info-circle"></i> <strong>Ghi chú:</strong><br>
            - Cột <strong>Đi muộn</strong> và <strong>Nghỉ phép</strong> hiển thị tổng số liệu tích lũy của nhân viên đó trong tháng <strong><?php echo $current_month; ?></strong>.
        </div>
    </div>
</body>
</html>