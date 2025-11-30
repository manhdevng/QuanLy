<?php
session_start();
require_once 'db_connect.php';

// Check quyền
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    exit('Access Denied');
}

$search = $_GET['search'] ?? ''; // Nhận từ khóa tìm kiếm
$filename = "Danh_sach_Nhan_vien_" . date('Y-m-d') . ".xls";

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

echo '<!DOCTYPE html>';
echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
echo '<head><meta charset="utf-8"></head>';
echo '<body>';

echo '<h2 style="text-align:center">DANH SÁCH NHÂN SỰ</h2>';
if($search) echo '<p style="text-align:center">Từ khóa tìm kiếm: "'.htmlspecialchars($search).'"</p>';

echo '<table border="1" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">';
echo '<thead>
        <tr style="background-color: #f0f0f0; font-weight: bold; text-align: center; height: 40px;">
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Tài khoản</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>SĐT</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Trình độ</th>
            <th>Chuyên ngành</th>
            <th>Chứng chỉ NN</th>
            <th>Điểm số</th>
            <th>Ngày vào làm</th>
            <th>Hợp đồng</th>
            <th>Trạng thái</th>
            <th style="width: 300px;">Tiểu sử / Lai lịch</th>
        </tr>
      </thead>';
echo '<tbody>';

// --- TRUY VẤN DỮ LIỆU CÓ LỌC ---
$sql = "SELECT u.id, u.username, u.full_name, u.email, u.status, r.name as role_name, 
               ed.phone, ed.dob, ed.address, ed.education_level, ed.major, 
               ed.certificate_type, ed.certificate_score, ed.start_date, ed.contract_type, ed.biography
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.id 
        LEFT JOIN employee_details ed ON u.id = ed.user_id 
        WHERE u.role_id != 1"; // Không xuất Super Admin

// Thêm điều kiện tìm kiếm
if (!empty($search)) {
    $sql .= " AND (u.full_name LIKE '%$search%' OR u.email LIKE '%$search%' OR u.username LIKE '%$search%')";
}

$sql .= " ORDER BY u.id DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $status_text = ($row['status'] == 'active') ? 'Hoạt động' : 'Đã nghỉ';
    $cert_info = ($row['certificate_type'] != 'None') ? $row['certificate_type'] : '';
    
    echo '<tr>';
    echo '<td style="text-align: center;">' . $row['id'] . '</td>';
    echo '<td><strong>' . $row['full_name'] . '</strong></td>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td style="text-align: center;">' . $row['role_name'] . '</td>';
    
    echo '<td style="text-align: center;">' . ($row['phone'] ?? '-') . '</td>';
    echo '<td style="text-align: center;">' . ($row['dob'] ? date('d/m/Y', strtotime($row['dob'])) : '-') . '</td>';
    echo '<td>' . ($row['address'] ?? '-') . '</td>';
    echo '<td style="text-align: center;">' . ($row['education_level'] ?? '-') . '</td>';
    echo '<td>' . ($row['major'] ?? '-') . '</td>';
    
    echo '<td style="text-align: center;">' . $cert_info . '</td>';
    echo '<td style="text-align: center;">' . ($row['certificate_score'] > 0 ? $row['certificate_score'] : '') . '</td>';
    
    echo '<td style="text-align: center;">' . ($row['start_date'] ? date('d/m/Y', strtotime($row['start_date'])) : '-') . '</td>';
    echo '<td style="text-align: center;">' . ($row['contract_type'] ?? '-') . '</td>';
    
    echo '<td style="text-align: center;">' . $status_text . '</td>';
    echo '<td style="white-space: pre-wrap;">' . $row['biography'] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</body></html>';
exit();
?>