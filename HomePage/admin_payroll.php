<?php
session_start();
require_once 'db_connect.php';

// Check quyền
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    header("Location: index.php");
    exit();
}

$message = "";
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$search_query = isset($_GET['search']) ? trim($_GET['search']) : ''; // Biến tìm kiếm

// --- 1. CẤU HÌNH (CONSTANTS) ---
const ALLOWANCE_DEGREE_BACHELOR = 500000;
const ALLOWANCE_DEGREE_MASTER   = 1500000;
const ALLOWANCE_SENIORITY_1Y    = 300000;
const ALLOWANCE_SENIORITY_3Y    = 1000000;
const FINE_PER_LATE = 50000; 
const STANDARD_WORK_DAYS = 26; 

// --- XỬ LÝ LƯU LƯƠNG ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $month = $_POST['month'];
    
    // Nhận dữ liệu
    $base = $_POST['base_salary'];
    $al_degree = $_POST['allowance_degree'];
    $al_seniority = $_POST['allowance_seniority'];
    $al_lang = $_POST['allowance_language']; 

    $work_days = $_POST['work_days'];
    $ot_hours = $_POST['overtime_hours'];
    $bonus = $_POST['bonus'];
    $tax_percent = $_POST['tax_percent'];
    $late_count = $_POST['late_count'];
    $total_fine = $_POST['total_fine'];
    $note = $_POST['note']; 
    
    // Tính toán Server-side
    $actual_salary = ($base / STANDARD_WORK_DAYS) * $work_days;
    $ot_money = ($base / STANDARD_WORK_DAYS / 8) * 1.5 * $ot_hours;
    $gross = $actual_salary + $al_degree + $al_seniority + $al_lang + $bonus + $ot_money;
    $tax_money = $gross * ($tax_percent / 100);
    $total = $gross - $tax_money - $total_fine;

    // Làm tròn
    $ot_money = round($ot_money, -3);
    $tax_money = round($tax_money, -3);
    $total = round($total, -3);

    // Lưu DB
    $check = $conn->query("SELECT id FROM payroll WHERE user_id = $user_id AND month = '$month'");
    
    if ($check->num_rows > 0) {
        $sql = "UPDATE payroll SET base_salary=?, allowance_degree=?, allowance_seniority=?, allowance_language=?, work_days=?, overtime_hours=?, overtime_money=?, bonus=?, tax=?, tax_percent=?, late_count=?, total_fine=?, note=?, total_salary=?, status='paid' WHERE user_id=? AND month=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddddiddddddisss", $base, $al_degree, $al_seniority, $al_lang, $work_days, $ot_hours, $ot_money, $bonus, $tax_money, $tax_percent, $late_count, $total_fine, $note, $total, $user_id, $month);
    } else {
        $sql = "INSERT INTO payroll (user_id, month, base_salary, allowance_degree, allowance_seniority, allowance_language, work_days, overtime_hours, overtime_money, bonus, tax, tax_percent, late_count, total_fine, note, total_salary, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'paid')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isddddiddddddisd", $user_id, $month, $base, $al_degree, $al_seniority, $al_lang, $work_days, $ot_hours, $ot_money, $bonus, $tax_money, $tax_percent, $late_count, $total_fine, $note, $total);
    }

    if ($stmt->execute()) $message = "<div class='alert alert-success'>Đã lưu lương thành công!</div>";
    else $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
}

// --- LẤY DANH SÁCH NHÂN VIÊN (CÓ TÌM KIẾM) ---
$sql_users = "SELECT u.id, u.username, u.full_name, u.role_id, 
                     r.name as role_name, r.default_salary, 
                     ed.start_date, ed.education_level, ed.certificate_type, ed.certificate_score 
              FROM users u 
              LEFT JOIN roles r ON u.role_id = r.id
              LEFT JOIN employee_details ed ON u.id = ed.user_id 
              WHERE u.role_id != 1"; 

// Thêm điều kiện tìm kiếm
if (!empty($search_query)) {
    $sql_users .= " AND u.full_name LIKE '%$search_query%'";
}

$users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng Lương & Báo Cáo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .form-control-sm { font-size: 0.85rem; padding: 0.25rem 0.5rem; }
        .input-money { text-align: right; min-width: 90px; font-weight: 500; }
        .table-input th { font-size: 0.8rem; white-space: nowrap; text-align: center; vertical-align: middle; }
        .table-input td { padding: 5px; vertical-align: middle; }
        textarea.form-control-sm { resize: none; height: 38px; min-width: 120px; }
        .readonly-input { background-color: #f8f9fa; border: 1px solid #dee2e6; color: #6c757d; }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="fas fa-calculator text-success"></i> Bảng Lương</h3>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body py-3">
                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="fw-bold me-2">Tháng:</label>
                        <input type="month" name="month" class="form-control d-inline-block" style="width: 150px;" value="<?php echo $selected_month; ?>" onchange="this.form.submit()">
                    </div>

                    <div class="col-auto">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Tìm tên nhân viên..." value="<?php echo $search_query; ?>">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Tìm</button>
                        </div>
                    </div>

                    <div class="col-auto ms-auto">
                        <a href="export_payroll.php?month=<?php echo $selected_month; ?>&search=<?php echo $search_query; ?>" class="btn btn-success fw-bold">
                            <i class="fas fa-file-excel"></i> Xuất Excel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-input align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="min-width: 150px;">Nhân viên</th>
                                <th>Lương Cứng</th>
                                <th>Công</th>
                                <th>Phụ cấp (BC/TN/NN)</th>
                                <th>OT (h)</th>
                                <th>Thưởng</th>
                                <th class="bg-danger text-white">Phạt</th>
                                <th class="text-warning">Thuế %</th>
                                <th>Ghi chú</th>
                                <th>Thực lĩnh</th>
                                <th>Lưu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($users->num_rows > 0): ?>
                                <?php while($u = $users->fetch_assoc()): 
                                    $p_sql = "SELECT * FROM payroll WHERE user_id = " . $u['id'] . " AND month = '$selected_month'";
                                    $p_data = $conn->query($p_sql)->fetch_assoc();

                                    // --- 1. AUTO CALC ---
                                    $auto_sen = 0; $sen_text = "Mới";
                                    if (!empty($u['start_date'])) {
                                        $years = (new DateTime($u['start_date']))->diff(new DateTime())->y;
                                        if ($years >= 3) { $auto_sen = ALLOWANCE_SENIORITY_3Y; $sen_text = ">3y"; }
                                        elseif ($years >= 1) { $auto_sen = ALLOWANCE_SENIORITY_1Y; $sen_text = ">1y"; }
                                    }

                                    $auto_edu = 0; $edu_text = "";
                                    if (($u['education_level'] ?? '') == 'Đại học') { $auto_edu = ALLOWANCE_DEGREE_BACHELOR; $edu_text="ĐH"; }
                                    elseif (($u['education_level'] ?? '') == 'Thạc sĩ') { $auto_edu = ALLOWANCE_DEGREE_MASTER; $edu_text="ThS"; }

                                    $auto_lang = 0; $lang_text = "";
                                    $type = $u['certificate_type'] ?? 'None';
                                    $score = $u['certificate_score'] ?? 0;
                                    if ($type == 'IELTS') {
                                        $lang_text = "IELTS $score";
                                        if ($score >= 8.0) $auto_lang = 2000000;
                                        elseif ($score >= 7.0) $auto_lang = 1000000;
                                        elseif ($score >= 6.0) $auto_lang = 500000;
                                    } elseif ($type == 'TOEIC') {
                                        $lang_text = "TOEIC $score";
                                        if ($score >= 800) $auto_lang = 1000000;
                                        elseif ($score >= 600) $auto_lang = 500000;
                                    }

                                    $att_sql = "SELECT COUNT(*) as days FROM attendance WHERE user_id = " . $u['id'] . " AND date LIKE '$selected_month%'";
                                    $work_days_count = $conn->query($att_sql)->fetch_assoc()['days'];
                                    
                                    $late_sql = "SELECT COUNT(*) as lates FROM attendance WHERE user_id = " . $u['id'] . " AND date LIKE '$selected_month%' AND status = 'late'";
                                    $late_count_auto = $conn->query($late_sql)->fetch_assoc()['lates'];
                                    $late_fine_auto = $late_count_auto * FINE_PER_LATE;

                                    // --- 2. GÁN GIÁ TRỊ ---
                                    $saved_edu = $p_data['allowance_degree'] ?? 0;
                                    $saved_sen = $p_data['allowance_seniority'] ?? 0;
                                    $saved_lang = $p_data['allowance_language'] ?? 0;

                                    $val_edu = ($saved_edu > 0) ? $saved_edu : $auto_edu;
                                    $val_sen = ($saved_sen > 0) ? $saved_sen : $auto_sen;
                                    $val_lang = ($saved_lang > 0) ? $saved_lang : $auto_lang;

                                    $base = $p_data['base_salary'] ?? $u['default_salary'] ?? 5000000;
                                    $val_days = $p_data['work_days'] ?? $work_days_count;
                                    $val_ot_hours = $p_data['overtime_hours'] ?? 0;
                                    $val_ot_money = $p_data['overtime_money'] ?? 0;
                                    $val_bonus = $p_data['bonus'] ?? 0;
                                    $val_tax_percent = $p_data['tax_percent'] ?? 0; 
                                    $val_late_count = $p_data['late_count'] ?? $late_count_auto;
                                    $val_total_fine = $p_data['total_fine'] ?? $late_fine_auto;
                                    $val_note = $p_data['note'] ?? '';

                                    $actual_salary = ($base / STANDARD_WORK_DAYS) * $val_days;
                                    $ot_money = ($base / STANDARD_WORK_DAYS / 8) * 1.5 * $val_ot_hours;
                                    $gross = $actual_salary + $val_edu + $val_sen + $val_lang + $val_bonus + $ot_money;
                                    $tax_money = $gross * ($val_tax_percent / 100);
                                    $val_total = $gross - $tax_money - $val_total_fine;

                                    $is_paid = isset($p_data['status']) && $p_data['status'] == 'paid';
                                ?>
                                <tr class="salary-row">
                                    <form method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                        <input type="hidden" name="month" value="<?php echo $selected_month; ?>">
                                        
                                        <td>
                                            <strong><?php echo $u['full_name']; ?></strong><br>
                                            <small class="text-muted"><?php echo $u['username']; ?></small><br>
                                            <div class="mt-1" style="font-size: 0.75rem;">
                                                <?php if($edu_text) echo "<span class='badge bg-light text-dark border me-1'>$edu_text</span>"; ?>
                                                <?php if($sen_text != "Mới") echo "<span class='badge bg-light text-dark border me-1'>$sen_text</span>"; ?>
                                                <?php if($lang_text) echo "<span class='badge bg-info text-dark border'>$lang_text</span>"; ?>
                                            </div>
                                        </td>

                                        <td><input type="number" name="base_salary" class="form-control form-control-sm input-money inp-base readonly-input" value="<?php echo $base; ?>" readonly></td>
                                        <td><input type="number" step="0.5" name="work_days" class="form-control form-control-sm text-center inp-days" value="<?php echo $val_days; ?>" oninput="calculateRow(this)"></td>

                                        <td style="width: 140px;">
                                            <div class="input-group input-group-sm mb-1"><span class="input-group-text px-1" style="width: 30px;">BC</span><input type="number" step="1000" name="allowance_degree" class="form-control input-money inp-deg" value="<?php echo $val_edu; ?>" oninput="calculateRow(this)"></div>
                                            <div class="input-group input-group-sm mb-1"><span class="input-group-text px-1" style="width: 30px;">TN</span><input type="number" step="1000" name="allowance_seniority" class="form-control input-money inp-sen" value="<?php echo $val_sen; ?>" oninput="calculateRow(this)"></div>
                                            <div class="input-group input-group-sm"><span class="input-group-text px-1" style="width: 30px;">NN</span><input type="number" step="1000" name="allowance_language" class="form-control input-money inp-lang text-primary fw-bold" value="<?php echo $val_lang; ?>" oninput="calculateRow(this)"></div>
                                        </td>

                                        <td class="bg-light">
                                            <input type="number" step="0.5" name="overtime_hours" class="form-control form-control-sm text-center mb-1 inp-ot-hours" value="<?php echo $val_ot_hours; ?>" placeholder="Giờ" oninput="calculateRow(this)">
                                            <div class="text-end small text-success fw-bold ot-money-display"><?php echo number_format($ot_money); ?></div>
                                        </td>

                                        <td><input type="number" step="1000" name="bonus" class="form-control form-control-sm input-money text-success inp-bonus" value="<?php echo $val_bonus; ?>" oninput="calculateRow(this)"></td>
                                        
                                        <td>
                                            <input type="hidden" name="late_count" class="inp-late" value="<?php echo $val_late_count; ?>">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-1 text-danger"><i class="fas fa-gavel"></i></span>
                                                <input type="number" step="1000" name="total_fine" class="form-control input-money text-danger fw-bold inp-fine" value="<?php echo $val_total_fine; ?>" oninput="calculateRow(this)">
                                            </div>
                                            <?php if($val_late_count > 0): ?><small class="text-muted d-block text-end">(Muộn: <?php echo $val_late_count; ?>)</small><?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="0.1" name="tax_percent" class="form-control text-center text-warning fw-bold inp-tax-percent" value="<?php echo $val_tax_percent; ?>" oninput="calculateRow(this)">
                                                <span class="input-group-text px-1">%</span>
                                            </div>
                                            <div class="text-end small text-muted tax-money-display pt-1">-<?php echo number_format($tax_money); ?></div>
                                        </td>

                                        <td><textarea name="note" class="form-control form-control-sm" placeholder="..."><?php echo $val_note; ?></textarea></td>
                                        
                                        <td class="fw-bold text-end text-primary total-salary-display fs-6"><?php echo number_format($val_total); ?></td>

                                        <td><button type="submit" class="btn btn-sm btn-success w-100"><i class="fas fa-save"></i></button></td>
                                    </form>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="11" class="text-center py-4">Không tìm thấy nhân viên nào phù hợp.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info mt-3 small">
            <strong><i class="fas fa-info-circle"></i> Quy tắc tự động:</strong><br>
            - <strong>NN (Ngoại ngữ):</strong> IELTS 6.0+ (+500k), 7.0+ (+1tr), 8.0+ (+2tr). TOEIC 600+ (+500k), 800+ (+1tr).<br>
            - Bằng cấp & Thâm niên: Tự động điền theo hồ sơ.
        </div>
    </div>

    <script>
        function calculateRow(element) {
            const row = element.closest('tr');
            
            const base = parseFloat(row.querySelector('.inp-base').value) || 0;
            const days = parseFloat(row.querySelector('.inp-days').value) || 0;
            const deg = parseFloat(row.querySelector('.inp-deg').value) || 0;
            const sen = parseFloat(row.querySelector('.inp-sen').value) || 0;
            const lang = parseFloat(row.querySelector('.inp-lang').value) || 0; 
            const bonus = parseFloat(row.querySelector('.inp-bonus').value) || 0;
            const tax_percent = parseFloat(row.querySelector('.inp-tax-percent').value) || 0;
            const ot_hours = parseFloat(row.querySelector('.inp-ot-hours').value) || 0;
            const fine = parseFloat(row.querySelector('.inp-fine').value) || 0;
            
            // 1. Lương theo ngày công
            let actual_salary = (base / 26) * days;

            // 2. Tiền OT
            let ot_money = (base / 26 / 8) * 1.5 * ot_hours;
            
            // 3. Tổng thu nhập (Gross)
            let gross = actual_salary + deg + sen + lang + bonus + ot_money;

            // 4. Tiền Thuế
            let tax_money = gross * (tax_percent / 100);

            // Làm tròn
            ot_money = Math.round(ot_money / 1000) * 1000;
            tax_money = Math.round(tax_money / 1000) * 1000;

            row.querySelector('.ot-money-display').innerText = new Intl.NumberFormat('vi-VN').format(ot_money);
            row.querySelector('.tax-money-display').innerText = '-' + new Intl.NumberFormat('vi-VN').format(tax_money);

            // 5. Thực lĩnh
            let total = gross - tax_money - fine;
            total = Math.round(total / 1000) * 1000;

            row.querySelector('.total-salary-display').innerText = new Intl.NumberFormat('vi-VN').format(total);
        }
    </script>
</body>
</html>