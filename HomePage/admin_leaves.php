<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Xử lý Duyệt/Từ chối
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action']; // 'approve' hoặc 'reject'
    $id = $_GET['id'];
    
    $status = ($action == 'approve') ? 'approved' : 'rejected';
    
    $sql = "UPDATE leave_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Đã cập nhật trạng thái đơn!'); window.location.href='admin_leaves.php';</script>";
    }
}

// Lấy danh sách đơn nghỉ kèm tên nhân viên (JOIN bảng users)
$sql = "SELECT lr.*, u.full_name 
        FROM leave_requests lr 
        JOIN users u ON lr.user_id = u.id 
        ORDER BY lr.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Nghỉ phép</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-calendar-check text-success"></i> Quản lý Đơn nghỉ phép</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Nhân viên</th>
                            <th>Từ ngày</th>
                            <th>Đến ngày</th>
                            <th>Lý do</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-bold"><?php echo $row['full_name']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['start_date'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['end_date'])); ?></td>
                                <td><?php echo $row['reason']; ?></td>
                                <td>
                                    <?php 
                                    if($row['status'] == 'pending') echo '<span class="badge bg-warning text-dark">Chờ duyệt</span>';
                                    elseif($row['status'] == 'approved') echo '<span class="badge bg-success">Đã duyệt</span>';
                                    else echo '<span class="badge bg-danger">Đã từ chối</span>';
                                    ?>
                                </td>
                                <td>
                                    <?php if($row['status'] == 'pending'): ?>
                                        <a href="admin_leaves.php?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Duyệt</a>
                                        <a href="admin_leaves.php?action=reject&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Từ chối</a>
                                    <?php else: ?>
                                        <span class="text-muted small">Đã xử lý</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center">Chưa có đơn nghỉ phép nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>