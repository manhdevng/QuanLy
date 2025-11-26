<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

// Xử lý Thêm / Xóa thông báo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_notif'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        
        if (!empty($title) && !empty($content)) {
            $sql = "INSERT INTO notifications (title, content) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $title, $content);
            
            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Đã gửi thông báo thành công!</div>";
            } else {
                $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
            }
        }
    } elseif (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $conn->query("DELETE FROM notifications WHERE id = $id");
        $message = "<div class='alert alert-success'>Đã xóa thông báo!</div>";
    }
}

// Lấy danh sách thông báo (Mới nhất lên đầu)
$notifs = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Thông báo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-bullhorn text-warning"></i> Quản lý Thông báo</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark fw-bold">Soạn thông báo mới</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" class="form-control" required placeholder="VD: Lịch nghỉ lễ...">
                            </div>
                            <div class="mb-3">
                                <label>Nội dung</label>
                                <textarea name="content" class="form-control" rows="4" required placeholder="Nhập nội dung thông báo..."></textarea>
                            </div>
                            <button type="submit" name="add_notif" class="btn btn-warning w-100 fw-bold">Gửi ngay</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold">Lịch sử thông báo</div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nội dung</th>
                                    <th width="150">Thời gian</th>
                                    <th width="50">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($notifs->num_rows > 0): ?>
                                    <?php while($row = $notifs->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <strong class="text-primary"><?php echo $row['title']; ?></strong><br>
                                            <span class="text-muted small"><?php echo nl2br($row['content']); ?></span>
                                        </td>
                                        <td class="small text-muted">
                                            <?php echo date('H:i d/m/Y', strtotime($row['created_at'])); ?>
                                        </td>
                                        <td>
                                            <form method="POST" onsubmit="return confirm('Xóa thông báo này?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="3" class="text-center text-muted">Chưa có thông báo nào.</td></tr>
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