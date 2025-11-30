<?php
session_start();
require_once 'db_connect.php';

// Check quyền
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    header("Location: index.php");
    exit();
}

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Xử lý Xóa
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    if ($id != $_SESSION['user_id']) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) echo "<script>alert('Đã xóa!'); window.location.href='admin_employees.php';</script>";
    } else {
        echo "<script>alert('Không thể xóa chính mình!');</script>";
    }
}

// --- TRUY VẤN CÓ TÌM KIẾM ---
$sql = "SELECT u.*, r.name as role_name, ed.phone, ed.education_level 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.id 
        LEFT JOIN employee_details ed ON u.id = ed.user_id 
        WHERE u.id != ?"; // Luôn trừ bản thân người đang login

// Thêm điều kiện tìm kiếm
if (!empty($search_query)) {
    $sql .= " AND (u.full_name LIKE ? OR u.email LIKE ? OR u.username LIKE ?)";
}

$sql .= " ORDER BY u.id DESC";

$stmt = $conn->prepare($sql);

// Bind tham số linh hoạt
if (!empty($search_query)) {
    $param = "%$search_query%";
    $stmt->bind_param("isss", $_SESSION['user_id'], $param, $param, $param);
} else {
    $stmt->bind_param("i", $_SESSION['user_id']);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Nhân sự</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-users text-primary"></i> Danh sách Nhân sự</h2>
            
            <div class="d-flex gap-2">
                <a href="register.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Thêm mới</a>
                <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body py-3">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-auto">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm tên, email..." value="<?php echo htmlspecialchars($search_query); ?>" style="width: 250px;">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Tìm kiếm</button>
                            <?php if(!empty($search_query)): ?>
                                <a href="admin_employees.php" class="btn btn-outline-secondary" title="Xóa tìm kiếm"><i class="fas fa-times"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-auto ms-auto">
                        <a href="export_employees.php?search=<?php echo urlencode($search_query); ?>" class="btn btn-success fw-bold">
                            <i class="fas fa-file-excel"></i> Xuất danh sách
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Họ tên & Email</th>
                            <th>Vai trò</th>
                            <th>Trình độ</th>
                            <th>Liên hệ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px;">
                                            <?php echo strtoupper(substr($row['full_name'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo $row['full_name']; ?></strong><br>
                                            <small class="text-muted"><?php echo $row['email']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info text-dark"><?php echo $row['role_name']; ?></span></td>
                                <td><?php echo $row['education_level'] ?? '-'; ?></td>
                                <td><?php echo $row['phone'] ?? '-'; ?></td>
                                <td>
                                    <?php if($row['status'] == 'active'): ?>
                                        <span class="badge bg-success">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Đã nghỉ</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="admin_employee_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i> Hồ sơ</a>
                                    <a href="admin_employees.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Xóa?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-search me-1"></i> Không tìm thấy nhân viên nào phù hợp.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>