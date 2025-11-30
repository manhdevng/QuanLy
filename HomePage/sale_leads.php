<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || !hasPermission('lead.manage')) {
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['user_id'];
$leads = $conn->query("SELECT * FROM leads WHERE assigned_to = $uid ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Tuyển sinh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="fas fa-headset text-success"></i> Danh sách Tư vấn</h3>
            <a href="user_dashboard.php" class="btn btn-secondary">Quay lại</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Họ tên</th>
                            <th>SĐT</th>
                            <th>Quan tâm</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($leads->num_rows > 0): ?>
                            <?php while($row = $leads->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-bold"><?php echo $row['name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['course_interest']; ?></td>
                                <td>
                                    <?php 
                                    $st = $row['status'];
                                    if($st=='new') echo '<span class="badge bg-danger">Mới</span>';
                                    elseif($st=='contacted') echo '<span class="badge bg-warning text-dark">Đã gọi</span>';
                                    elseif($st=='enrolled') echo '<span class="badge bg-success">Đã chốt</span>';
                                    else echo '<span class="badge bg-secondary">Thất bại</span>';
                                    ?>
                                </td>
                                <td><button class="btn btn-sm btn-primary">Gọi điện</button></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center">Chưa có dữ liệu.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>