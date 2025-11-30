<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin/Manager
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    header("Location: index.php");
    exit();
}

$selected_year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// 1. Lấy tổng chi tiêu MUA SẮM theo tháng
$sql_expenses = "SELECT MONTH(expense_date) as month, SUM(amount) as total 
                 FROM expenses 
                 WHERE YEAR(expense_date) = ? 
                 GROUP BY MONTH(expense_date)";
$stmt = $conn->prepare($sql_expenses);
$stmt->bind_param("s", $selected_year);
$stmt->execute();
$res_expenses = $stmt->get_result();

$expense_data = array_fill(1, 12, 0); // Mảng 12 tháng, mặc định 0
while ($row = $res_expenses->fetch_assoc()) {
    $expense_data[$row['month']] = $row['total'];
}

// 2. Lấy tổng chi LƯƠNG theo tháng
// Lưu ý: payroll.month lưu dạng 'YYYY-MM'
$sql_payroll = "SELECT SUBSTRING(month, 6, 2) as month, SUM(total_salary) as total 
                FROM payroll 
                WHERE LEFT(month, 4) = ? 
                GROUP BY month";
$stmt = $conn->prepare($sql_payroll);
$stmt->bind_param("s", $selected_year);
$stmt->execute();
$res_payroll = $stmt->get_result();

$payroll_data = array_fill(1, 12, 0);
while ($row = $res_payroll->fetch_assoc()) {
    $payroll_data[(int)$row['month']] = $row['total'];
}

// 3. Tính tổng hợp
$total_expense_year = array_sum($expense_data);
$total_payroll_year = array_sum($payroll_data);
$grand_total = $total_expense_year + $total_payroll_year;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo Tài chính</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-chart-line text-primary"></i> Báo Cáo Tài Chính Năm <?php echo $selected_year; ?></h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body py-2">
                <form method="GET" class="d-flex align-items-center gap-2">
                    <label class="fw-bold">Chọn năm báo cáo:</label>
                    <select name="year" class="form-select form-select-sm" style="width: 100px;" onchange="this.form.submit()">
                        <?php 
                        for($y = date('Y'); $y >= 2020; $y--) {
                            $selected = ($y == $selected_year) ? 'selected' : '';
                            echo "<option value='$y' $selected>$y</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Chi Lương</h5>
                        <h3 class="fw-bold"><?php echo number_format($total_payroll_year); ?> đ</h3>
                        <p class="mb-0 small">Chiếm <?php echo ($grand_total > 0) ? round(($total_payroll_year/$grand_total)*100, 1) : 0; ?>% tổng chi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-dark">Tổng Chi Khác</h5>
                        <h3 class="fw-bold text-dark"><?php echo number_format($total_expense_year); ?> đ</h3>
                        <p class="mb-0 small text-dark">Điện, nước, văn phòng phẩm...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Dòng Tiền Ra</h5>
                        <h3 class="fw-bold"><?php echo number_format($grand_total); ?> đ</h3>
                        <p class="mb-0 small">Tổng chi phí vận hành trung tâm</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">Biểu đồ Chi tiêu theo Tháng</div>
            <div class="card-body">
                <canvas id="financeChart" height="100"></canvas>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">Chi tiết từng tháng (VNĐ)</div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tháng</th>
                            <th>Lương Nhân viên</th>
                            <th>Chi phí Khác</th>
                            <th>Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=1; $i<=12; $i++): 
                            $p = $payroll_data[$i];
                            $e = $expense_data[$i];
                            $t = $p + $e;
                            if ($t == 0) continue; // Ẩn tháng không có dữ liệu
                        ?>
                        <tr>
                            <td>Tháng <?php echo $i; ?></td>
                            <td class="text-success"><?php echo number_format($p); ?></td>
                            <td class="text-warning text-dark"><?php echo number_format($e); ?></td>
                            <td class="fw-bold text-danger"><?php echo number_format($t); ?></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                datasets: [
                    {
                        label: 'Lương Nhân viên',
                        data: <?php echo json_encode(array_values($payroll_data)); ?>,
                        backgroundColor: '#198754',
                        stack: 'Stack 0',
                    },
                    {
                        label: 'Chi phí Khác',
                        data: <?php echo json_encode(array_values($expense_data)); ?>,
                        backgroundColor: '#ffc107',
                        stack: 'Stack 0',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: { stacked: true },
                    y: { 
                        stacked: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>