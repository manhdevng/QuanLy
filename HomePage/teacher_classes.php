<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || !hasPermission('class.view')) {
    header("Location: index.php");
    exit();
}

$uid = $_SESSION['user_id'];
$classes = $conn->query("SELECT * FROM classes WHERE teacher_id = $uid");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch Dạy Của Tôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="fas fa-chalkboard-teacher text-primary"></i> Lớp Học & Lịch Dạy</h3>
            <a href="user_dashboard.php" class="btn btn-secondary">Quay lại</a>
        </div>

        <div class="row">
            <?php if($classes->num_rows > 0): ?>
                <?php while($row = $classes->fetch_assoc()): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-primary h-100">
                        <div class="card-header bg-primary text-white fw-bold">
                            <?php echo $row['class_name']; ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><i class="fas fa-clock me-2 text-muted"></i> <strong>Lịch:</strong> <?php echo $row['schedule']; ?></p>
                            <p class="card-text"><i class="fas fa-map-marker-alt me-2 text-muted"></i> <strong>Phòng:</strong> <?php echo $row['room']; ?></p>
                            <p class="card-text"><i class="fas fa-users me-2 text-muted"></i> <strong>Sĩ số:</strong> <?php echo $row['student_count']; ?> học viên</p>
                            <a href="#" class="btn btn-outline-primary btn-sm w-100 mt-2">Điểm danh lớp này</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="alert alert-info">Bạn chưa được phân công lớp dạy nào.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>