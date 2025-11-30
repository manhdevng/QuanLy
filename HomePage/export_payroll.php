<?php
session_start();
require_once 'db_connect.php';

// Check quyền
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    exit('Access Denied');
}

$month = $_GET['month'] ?? date('Y-m');
$search = $_GET['search'] ?? '';

// Tên file khi tải về (Đuôi .xls để Excel nhận diện format bảng)
$filename = "Bang_luong_Thang_" . $month . ".xls";

// Cấu hình Header để trình duyệt tải về file Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// Bắt đầu nội dung HTML (Excel sẽ đọc cái này)
// Thêm meta charset utf-8 để KHÔNG BỊ LỖI FONT TIẾNG VIỆT
echo '<!DOCTYPE html>';
echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
echo '<head><meta charset="utf-8"></head>';
echo '<body>';

// Tạo bảng HTML (Excel sẽ hiển thị y hệt bảng này)
// border="1" để kẻ khung
echo '<table border="1" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">';

// --- PHẦN TIÊU ĐỀ CỘT ---
// style: background màu vàng nhạt, chữ đậm, căn giữa
echo '<thead>
        <tr style="background-color: #f0f0f0; font-weight: bold; text-align: center; height: 40px;">
            <th style="width: 150px;">Mã NV</th>
            <th style="width: 200px;">Họ và tên</th>
            <th style="width: 120px;">Chức vụ</th>
            <th style="width: 120px;">Lương Cứng</th>
            <th style="width: 120px;">Phụ cấp</th>
            <th style="width: 80px;">Công</th>
            <th style="width: 120px;">Tăng ca</th>
            <th style="width: 120px;">Thưởng</th>
            <th style="width: 120px;">Phạt</th>
            <th style="width: 120px;">Thuế</th>
            <th style="width: 150px; background-color: #d4edda;">Thực Lĩnh</th>
            <th style="width: 100px;">Trạng thái</th>
            <th style="width: 250px;">Ghi chú</th>
        </tr>
      </thead>';
echo '<tbody>';

// --- TRUY VẤN DỮ LIỆU (Giống admin_payroll.php) ---
$sql = "SELECT u.username, u.full_name, r.name as role_name, p.* FROM users u 
        LEFT JOIN roles r ON u.role_id = r.id
        LEFT JOIN payroll p ON u.id = p.user_id AND p.month = ? 
        WHERE u.role_id != 1";

if (!empty($search)) {
    $sql .= " AND u.full_name LIKE '%$search%'";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $month);
$stmt->execute();
$result = $stmt->get_result();

// --- GHI DỮ LIỆU TỪNG DÒNG ---
while ($row = $result->fetch_assoc()) {
    // Xử lý số liệu
    $base = $row['base_salary'] ?? 0;
    $allowance = ($row['allowance_degree'] ?? 0) + ($row['allowance_seniority'] ?? 0) + ($row['allowance_language'] ?? 0);
    $work_days = $row['work_days'] ?? 0;
    $ot_money = $row['overtime_money'] ?? 0;
    $bonus = $row['bonus'] ?? 0;
    $fine = $row['total_fine'] ?? 0;
    $tax = $row['tax'] ?? 0;
    $total = $row['total_salary'] ?? 0;
    
    // Xử lý trạng thái
    $status_text = ($row['status'] == 'paid') ? 'Đã lưu' : 'Chưa tính';
    $status_color = ($row['status'] == 'paid') ? '#28a745' : '#dc3545'; // Xanh hoặc Đỏ
    
    $note = $row['note'] ?? '';

    // Xuất dòng HTML
    echo '<tr>';
    echo '<td style="text-align: left; padding: 5px;">' . $row['username'] . '</td>';
    echo '<td style="text-align: left; padding: 5px; font-weight: bold;">' . $row['full_name'] . '</td>';
    echo '<td style="text-align: center; padding: 5px;">' . $row['role_name'] . '</td>';
    
    // Các cột tiền tệ căn phải (align right)
    echo '<td style="text-align: right; padding: 5px;">' . number_format($base) . '</td>';
    echo '<td style="text-align: right; padding: 5px;">' . number_format($allowance) . '</td>';
    echo '<td style="text-align: center; padding: 5px;">' . $work_days . '</td>';
    echo '<td style="text-align: right; padding: 5px;">' . number_format($ot_money) . '</td>';
    echo '<td style="text-align: right; padding: 5px; color: green;">' . number_format($bonus) . '</td>';
    echo '<td style="text-align: right; padding: 5px; color: red;">' . number_format($fine) . '</td>';
    echo '<td style="text-align: right; padding: 5px; color: red;">' . number_format($tax) . '</td>';
    
    // Cột thực lĩnh: Chữ to, nền xanh nhạt
    echo '<td style="text-align: right; padding: 5px; font-weight: bold; color: blue; background-color: #e2e3e5;">' . number_format($total) . '</td>';
    
    echo '<td style="text-align: center; padding: 5px; color: '.$status_color.';">' . $status_text . '</td>';
    echo '<td style="text-align: left; padding: 5px;">' . $note . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</body></html>';
exit();
?>