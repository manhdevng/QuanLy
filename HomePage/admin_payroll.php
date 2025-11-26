<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m'); // Mặc định tháng hiện tại

// Xử lý Lưu/Cập nhật lương
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $month = $_POST['month'];
    $base = $_POST['base_salary'];
    $bonus = $_POST['bonus'];
    $deduct = $_POST['deductions'];
    $work_days = $_POST['work_days'];
    
    // Công thức tính: (Lương CB / 26 ngày chuẩn) * Ngày làm + Thưởng - Phạt
    // Hoặc đơn giản: Lương CB + Thưởng - Phạt (Tùy chính sách, ở đây mình làm đơn giản cộng trừ)
    $total = $base + $bonus - $deduct;

    // Kiểm tra xem tháng này nhân viên đó đã được tính lương chưa
    $check = $conn->query("SELECT id FROM payroll WHERE user_id = $user_id AND month = '$month'");
    
    if ($check->num_rows > 0) {
        // Update
        $sql = "UPDATE payroll SET base_salary=?, work_days=?, bonus=?, deductions=?, total_salary=?, status='paid' WHERE user_id=? AND month=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("didddis", $base, $work_days, $bonus, $deduct, $total, $user_id, $month);
    } else {
        // Insert mới
        $sql = "INSERT INTO payroll (user_id, month, base_salary, work_days, bonus, deductions, total_salary, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'paid')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdiddd", $user_id, $month, $base, $work_days, $bonus, $deduct, $total);
    }

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Đã lưu bảng lương cho nhân viên!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// Lấy danh sách nhân viên để hiển thị
$users = $conn->query("SELECT * FROM users WHERE role != 'admin'");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Lương</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-money-bill-wave text-success"></i> Quản lý Lương & Thưởng</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="fw-bold">Chọn tháng tính lương:</label>
                    </div>
                    <div class="col-auto">
                        <input type="month" name="month" class="form-control" value="<?php echo $selected_month; ?>" onchange="this.form.submit()">
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Nhân viên</th>
                            <th>Lương cơ bản (VNĐ)</th>
                            <th>Ngày công (Tháng <?php echo date('m', strtotime($selected_month)); ?>)</th>
                            <th>Thưởng</th>
                            <th>Khấu trừ</th>
                            <th>Thực lĩnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($u = $users->fetch_assoc()): 
                            // Lấy thông tin lương đã lưu (nếu có)
                            $p_sql = "SELECT * FROM payroll WHERE user_id = " . $u['id'] . " AND month = '$selected_month'";
                            $p_data = $conn->query($p_sql)->fetch_assoc();

                            // Đếm ngày công từ bảng attendance
                            $att_sql = "SELECT COUNT(*) as days FROM attendance WHERE user_id = " . $u['id'] . " AND date LIKE '$selected_month%'";
                            $work_days = $conn->query($att_sql)->fetch_assoc()['days'];

                            // Giá trị mặc định
                            $base = $p_data['base_salary'] ?? $u['salary'] ?? 5000000; // Lấy lương set trong user, nếu k có lấy lương đã lưu, k có nữa thì mặc định 5tr
                            $bonus = $p_data['bonus'] ?? 0;
                            $deduct = $p_data['deductions'] ?? 0;
                            $total = $p_data['total_salary'] ?? ($base + $bonus - $deduct);
                            $is_paid = isset($p_data['status']) && $p_data['status'] == 'paid';
                        ?>
                        <tr>
                            <form method="POST">
                                <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                <input type="hidden" name="month" value="<?php echo $selected_month; ?>">
                                <input type="hidden" name="work_days" value="<?php echo $work_days; ?>">
                                
                                <td>
                                    <strong><?php echo $u['full_name']; ?></strong><br>
                                    <small class="text-muted"><?php echo $u['username']; ?></small>
                                </td>
                                <td>
                                    <input type="number" name="base_salary" class="form-control" value="<?php echo $base; ?>">
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark fs-6"><?php echo $work_days; ?> ngày</span>
                                </td>
                                <td>
                                    <input type="number" name="bonus" class="form-control text-success" value="<?php echo $bonus; ?>">
                                </td>
                                <td>
                                    <input type="number" name="deductions" class="form-control text-danger" value="<?php echo $deduct; ?>">
                                </td>
                                <td class="fw-bold text-primary">
                                    <?php echo number_format($total); ?> đ
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-save"></i> <?php echo $is_paid ? 'Cập nhật' : 'Tính lương'; ?>
                                    </button>
                                </td>
                            </form>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>