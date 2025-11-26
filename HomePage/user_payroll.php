<?php
session_start();
require_once 'db_connect.php';

// Check quyền đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Lấy lịch sử lương
$sql = "SELECT * FROM payroll WHERE user_id = ? ORDER BY month DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng Lương Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-file-invoice-dollar text-warning"></i> Bảng Lương Của Tôi</h2>
            <a href="user_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Tháng</th>
                            <th>Ngày công</th>
                            <th>Lương cơ bản</th>
                            <th>Thưởng</th>
                            <th>Khấu trừ</th>
                            <th>Thực lĩnh</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-bold"><?php echo date('m/Y', strtotime($row['month'])); ?></td>
                                <td><?php echo $row['work_days']; ?></td>
                                <td><?php echo number_format($row['base_salary']); ?> đ</td>
                                <td class="text-success">+<?php echo number_format($row['bonus']); ?> đ</td>
                                <td class="text-danger">-<?php echo number_format($row['deductions']); ?> đ</td>
                                <td class="fw-bold text-primary fs-5"><?php echo number_format($row['total_salary']); ?> đ</td>
                                <td>
                                    <span class="badge bg-success">Đã thanh toán</span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-muted py-4">Chưa có dữ liệu lương nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>