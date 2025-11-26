<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Lọc theo ngày (Mặc định là hôm nay)
$filter_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Lấy dữ liệu chấm công kết hợp thông tin nhân viên
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
                        <input type="date" name="date" class="form-control" value="<?php echo $filter_date; ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Xem dữ liệu</button>
                    </div>
                    <div class="col-auto ms-auto">
                        <span class="text-muted">Hôm nay: <strong><?php echo date('d/m/Y'); ?></strong></span>
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
                            <th>Giờ vào (Check-in)</th>
                            <th>Giờ ra (Check-out)</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="text-start fw-bold"><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><span class="badge bg-success"><?php echo $row['check_in']; ?></span></td>
                                <td>
                                    <?php if($row['check_out']): ?>
                                        <span class="badge bg-danger"><?php echo $row['check_out']; ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">--:--</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        // Giả sử 8:30 là muộn
                                        if (strtotime($row['check_in']) > strtotime('08:30:00')) {
                                            echo '<span class="badge rounded-pill bg-warning text-dark">Đi muộn</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill bg-primary">Đúng giờ</span>';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center text-muted py-4">Không có dữ liệu chấm công cho ngày này.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>