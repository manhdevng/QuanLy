<?php
session_start();
require_once 'db_connect.php';

// Bảo mật: Chỉ nhân viên được vào
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$message = "";

// Xử lý gửi đơn
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = trim($_POST['reason']);

    // Validate cơ bản
    if (strtotime($end_date) < strtotime($start_date)) {
        $message = "<div class='alert alert-danger'>Ngày kết thúc không thể trước ngày bắt đầu!</div>";
    } else {
        $sql = "INSERT INTO leave_requests (user_id, start_date, end_date, reason, status) VALUES (?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_id, $start_date, $end_date, $reason);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Gửi đơn thành công! Vui lòng chờ Admin duyệt.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
        }
        $stmt->close();
    }
}

// Lấy lịch sử nghỉ phép của bản thân
$user_id = $_SESSION['user_id'];
$history_sql = "SELECT * FROM leave_requests WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($history_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$history = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xin Nghỉ Phép</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-paper-plane text-primary"></i> Gửi Đơn Xin Nghỉ</h2>
            <a href="user_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại Dashboard</a>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Điền thông tin</div>
                    <div class="card-body">
                        <?php echo $message; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label>Từ ngày</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Đến ngày</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Lý do nghỉ</label>
                                <textarea name="reason" class="form-control" rows="3" required placeholder="VD: Bị ốm, Việc gia đình..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i> Gửi Đơn</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold">Lịch sử đơn từ</div>
                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Ngày nghỉ</th>
                                    <th>Lý do</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($history->num_rows > 0): ?>
                                    <?php while($row = $history->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <?php echo date('d/m', strtotime($row['start_date'])); ?> - 
                                            <?php echo date('d/m', strtotime($row['end_date'])); ?>
                                        </td>
                                        <td><?php echo $row['reason']; ?></td>
                                        <td>
                                            <?php 
                                            if($row['status'] == 'pending') echo '<span class="badge bg-warning text-dark">Chờ duyệt</span>';
                                            elseif($row['status'] == 'approved') echo '<span class="badge bg-success">Đã duyệt</span>';
                                            else echo '<span class="badge bg-danger">Từ chối</span>';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="3" class="text-center text-muted">Bạn chưa gửi đơn nào.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>