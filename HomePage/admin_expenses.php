<?php
session_start();
require_once 'db_connect.php';

// Check quyền: Phải là Admin HOẶC có quyền quản lý chi tiêu
if (!isset($_SESSION['user_id']) || (!hasPermission('expense.manage') && $_SESSION['role_id'] != 1)) {
    header("Location: index.php");
    exit();
}
// ... phần còn lại giữ nguyên ...

$message = "";

// --- XỬ LÝ THÊM KHOẢN CHI ---
if (isset($_POST['add_expense'])) {
    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['expense_date'];
    $created_by = $_SESSION['user_id'];
    $receipt = '';

    // Upload hóa đơn (nếu có)
    if (isset($_FILES['receipt_img']) && $_FILES['receipt_img']['error'] == 0) {
        $target = "img/receipts/" . time() . "_" . basename($_FILES['receipt_img']['name']);
        if (!is_dir('img/receipts')) mkdir('img/receipts', 0777, true);
        if (move_uploaded_file($_FILES['receipt_img']['tmp_name'], $target)) {
            $receipt = $target;
        }
    }

    $stmt = $conn->prepare("INSERT INTO expenses (title, amount, category, expense_date, created_by, receipt_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssis", $title, $amount, $category, $date, $created_by, $receipt);
    
    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Đã lưu khoản chi!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}

// --- XỬ LÝ XÓA ---
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $conn->query("DELETE FROM expenses WHERE id = $id");
    $message = "<div class='alert alert-success'>Đã xóa khoản chi!</div>";
}

// --- LỌC DỮ LIỆU (Mặc định năm nay) ---
$filter_year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$sql = "SELECT e.*, u.full_name as creator 
        FROM expenses e 
        LEFT JOIN users u ON e.created_by = u.id 
        WHERE YEAR(e.expense_date) = ? 
        ORDER BY e.expense_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $filter_year);
$stmt->execute();
$expenses = $stmt->get_result();

// Tính tổng chi tiêu
$total_expense = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Chi tiêu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-file-invoice-dollar text-danger"></i> Quản lý Chi tiêu Nội bộ</h2>
            <a href="<?php echo ($_SESSION['role_id'] == 1) ? 'admin_dashboard.php' : 'user_dashboard.php'; ?>" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Quay lại
</a>
        </div>

        <?php echo $message; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white fw-bold">Tạo phiếu chi mới</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Tên khoản chi</label>
                                <input type="text" name="title" class="form-control" placeholder="VD: Mua 10 bộ giáo trình..." required>
                            </div>
                            <div class="mb-3">
                                <label>Số tiền (VNĐ)</label>
                                <input type="number" name="amount" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Danh mục</label>
                                <select name="category" class="form-select">
                                    <option value="Cơ sở vật chất">Cơ sở vật chất</option>
                                    <option value="Marketing">Marketing/Quảng cáo</option>
                                    <option value="Văn phòng phẩm">Văn phòng phẩm</option>
                                    <option value="Điện nước">Điện nước/Internet</option>
                                    <option value="Sự kiện">Tổ chức sự kiện</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Ngày chi</label>
                                <input type="date" name="expense_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Hóa đơn (Ảnh)</label>
                                <input type="file" name="receipt_img" class="form-control" accept="image/*">
                            </div>
                            <button type="submit" name="add_expense" class="btn btn-danger w-100 fw-bold">Lưu phiếu chi</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm mb-3">
                    <div class="card-body py-2">
                        <form method="GET" class="d-flex align-items-center gap-2">
                            <label class="fw-bold">Xem năm:</label>
                            <select name="year" class="form-select form-select-sm" style="width: 100px;" onchange="this.form.submit()">
                                <?php 
                                for($y = date('Y'); $y >= 2020; $y--) {
                                    $selected = ($y == $filter_year) ? 'selected' : '';
                                    echo "<option value='$y' $selected>$y</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Ngày</th>
                                    <th>Nội dung</th>
                                    <th>Danh mục</th>
                                    <th>Số tiền</th>
                                    <th>Hóa đơn</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($expenses->num_rows > 0): ?>
                                    <?php while($row = $expenses->fetch_assoc()): 
                                        $total_expense += $row['amount'];
                                    ?>
                                    <tr>
                                        <td><?php echo date('d/m', strtotime($row['expense_date'])); ?></td>
                                        <td>
                                            <strong><?php echo $row['title']; ?></strong><br>
                                            <small class="text-muted">Người tạo: <?php echo $row['creator']; ?></small>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?php echo $row['category']; ?></span></td>
                                        <td class="fw-bold text-danger">-<?php echo number_format($row['amount']); ?></td>
                                        <td>
                                            <?php if($row['receipt_image']): ?>
                                                <a href="<?php echo $row['receipt_image']; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-image"></i></a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form method="POST" onsubmit="return confirm('Xóa khoản chi này?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary border-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center text-muted">Chưa có khoản chi nào trong năm nay.</td></tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot class="table-danger">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Tổng chi tiêu năm <?php echo $filter_year; ?>:</td>
                                    <td colspan="3" class="fw-bold fs-5"><?php echo number_format($total_expense); ?> VNĐ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>