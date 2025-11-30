<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin (ID 1 hoặc 2)
if (!isset($_SESSION['user_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
    header("Location: index.php");
    exit();
}

$user_id = $_GET['id'] ?? 0;
$msg = "";

// --- XỬ LÝ CẬP NHẬT TÀI KHOẢN (Account) ---
if (isset($_POST['update_account'])) {
    $role_id = $_POST['role_id'];
    $status = $_POST['status'];
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);

    if ($user_id == 1 && $role_id != 1) {
        $msg = "<div class='alert alert-danger'>Không thể đổi quyền Super Admin!</div>";
    } else {
        $sql = "UPDATE users SET role_id=?, status=?, full_name=?, email=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $role_id, $status, $full_name, $email, $user_id);
        
        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Cập nhật tài khoản thành công!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
        }
    }
}

// --- XỬ LÝ CẬP NHẬT HỒ SƠ CHI TIẾT (Profile) ---
if (isset($_POST['update_details'])) {
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $edu = $_POST['education_level'];
    $major = $_POST['major'];
    $start_date = $_POST['start_date'];
    $contract = $_POST['contract_type'];
    $cert_type = $_POST['certificate_type'];
    $cert_score = $_POST['certificate_score'];
    $biography = $_POST['biography']; // Đã thêm lại biến này

    // Upload Ảnh Bằng cấp
    $edu_proof = $_POST['current_edu_proof'] ?? '';
    if (isset($_FILES['edu_img']) && $_FILES['edu_img']['error'] == 0) {
        $target = "img/proofs/" . time() . "_edu_" . basename($_FILES['edu_img']['name']);
        if (!is_dir('img/proofs')) mkdir('img/proofs', 0777, true);
        if (move_uploaded_file($_FILES['edu_img']['tmp_name'], $target)) $edu_proof = $target;
    }

    // Upload Ảnh Chứng chỉ
    $cert_proof = $_POST['current_cert_proof'] ?? '';
    if (isset($_FILES['cert_img']) && $_FILES['cert_img']['error'] == 0) {
        $target = "img/proofs/" . time() . "_cert_" . basename($_FILES['cert_img']['name']);
        if (!is_dir('img/proofs')) mkdir('img/proofs', 0777, true);
        if (move_uploaded_file($_FILES['cert_img']['tmp_name'], $target)) $cert_proof = $target;
    }

    // Kiểm tra & Lưu
    $check = $conn->query("SELECT user_id FROM employee_details WHERE user_id = $user_id");
    
    if ($check->num_rows > 0) {
        // Update (Có thêm biography)
        $sql = "UPDATE employee_details SET phone=?, dob=?, address=?, education_level=?, major=?, start_date=?, contract_type=?, certificate_type=?, certificate_score=?, edu_proof=?, cert_proof=?, biography=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssdsssi", $phone, $dob, $address, $edu, $major, $start_date, $contract, $cert_type, $cert_score, $edu_proof, $cert_proof, $biography, $user_id);
    } else {
        // Insert (Có thêm biography)
        $sql = "INSERT INTO employee_details (phone, dob, address, education_level, major, start_date, contract_type, certificate_type, certificate_score, edu_proof, cert_proof, biography, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssdsssi", $phone, $dob, $address, $edu, $major, $start_date, $contract, $cert_type, $cert_score, $edu_proof, $cert_proof, $biography, $user_id);
    }
    
    if ($stmt->execute()) $msg = "<div class='alert alert-success'>Đã lưu hồ sơ chi tiết!</div>";
    else $msg = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
}

// --- LẤY DỮ LIỆU HIỂN THỊ ---
$sql_u = "SELECT u.*, ed.*, r.name as role_name 
          FROM users u 
          LEFT JOIN roles r ON u.role_id = r.id
          LEFT JOIN employee_details ed ON u.id = ed.user_id 
          WHERE u.id = ?";
$stmt = $conn->prepare($sql_u);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) die("Không tìm thấy nhân viên!");

$roles_list = $conn->query("SELECT * FROM roles");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hồ sơ: <?php echo $user['full_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .section-title { border-left: 4px solid #0d6efd; padding-left: 10px; font-weight: bold; color: #0d6efd; margin-bottom: 15px; margin-top: 10px; }
        .bg-account { background-color: #e9ecef; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="fas fa-id-card text-primary"></i> Hồ sơ nhân sự</h3>
            <a href="admin_employees.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại DS</a>
        </div>

        <?php echo $msg; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body text-center">
                        <img src="<?php echo $user['avatar'] ?? 'img/default.jpg'; ?>" class="rounded-circle mx-auto d-block mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="mb-0"><?php echo $user['full_name']; ?></h5>
                        <small class="text-muted"><?php echo $user['email']; ?></small>
                        <div class="mt-2">
                            <span class="badge bg-primary"><?php echo $user['role_name']; ?></span>
                            <span class="badge <?php echo ($user['status']=='active')?'bg-success':'bg-danger'; ?>">
                                <?php echo ucfirst($user['status']); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-3 border-warning">
                    <div class="card-header bg-warning text-dark fw-bold">
                        <i class="fas fa-user-shield"></i> Cài đặt Tài khoản & Vai trò
                    </div>
                    <div class="card-body bg-account">
                        <form method="POST">
                            <div class="mb-2">
                                <label class="form-label fw-bold">Họ tên</label>
                                <input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Vai trò</label>
                                    <select name="role_id" class="form-select border-primary">
                                        <?php 
                                        $roles_list->data_seek(0); 
                                        while($r = $roles_list->fetch_assoc()): 
                                            $selected = ($user['role_id'] == $r['id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $r['id']; ?>" <?php echo $selected; ?>><?php echo $r['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option value="active" <?php echo ($user['status']=='active')?'selected':''; ?>>Hoạt động</option>
                                        <option value="inactive" <?php echo ($user['status']=='inactive')?'selected':''; ?>>Đã khóa</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="update_account" class="btn btn-warning w-100 fw-bold">
                                <i class="fas fa-sync-alt"></i> Cập nhật Tài khoản
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold">Thông tin chi tiết</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="section-title">1. Thông tin cá nhân</div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">SĐT</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $user['phone'] ?? ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ngày sinh</label>
                                    <input type="date" name="dob" class="form-control" value="<?php echo $user['dob'] ?? ''; ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo $user['address'] ?? ''; ?>">
                                </div>
                            </div>

                            <div class="section-title">2. Bằng cấp (Tính lương)</div>
                            <div class="row g-3 mb-3 bg-light p-3 rounded border mx-0">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Trình độ</label>
                                    <select name="education_level" class="form-select">
                                        <option value="">-- Chọn --</option>
                                        <?php 
                                        $levels = ['Trung cấp', 'Cao đẳng', 'Đại học', 'Thạc sĩ', 'Tiến sĩ'];
                                        foreach($levels as $l) {
                                            $sel = ($user['education_level'] ?? '') == $l ? 'selected' : '';
                                            echo "<option value='$l' $sel>$l</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Chuyên ngành</label>
                                    <input type="text" name="major" class="form-control" value="<?php echo $user['major'] ?? ''; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Ảnh Bằng</label>
                                    <input type="file" name="edu_img" class="form-control">
                                    <input type="hidden" name="current_edu_proof" value="<?php echo $user['edu_proof'] ?? ''; ?>">
                                    <?php if(!empty($user['edu_proof'])): ?>
                                        <a href="<?php echo $user['edu_proof']; ?>" target="_blank" class="small"><i class="fas fa-image"></i> Xem ảnh</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="section-title">3. Ngoại ngữ (Tính lương)</div>
                            <div class="row g-3 mb-3 bg-light p-3 rounded border mx-0">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Chứng chỉ</label>
                                    <select name="certificate_type" class="form-select">
                                        <option value="None" <?php echo ($user['certificate_type']??'')=='None'?'selected':''; ?>>Không</option>
                                        <option value="IELTS" <?php echo ($user['certificate_type']??'')=='IELTS'?'selected':''; ?>>IELTS</option>
                                        <option value="TOEIC" <?php echo ($user['certificate_type']??'')=='TOEIC'?'selected':''; ?>>TOEIC</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Điểm số</label>
                                    <input type="number" step="0.5" name="certificate_score" class="form-control" value="<?php echo $user['certificate_score'] ?? ''; ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Ảnh Chứng chỉ</label>
                                    <input type="file" name="cert_img" class="form-control">
                                    <input type="hidden" name="current_cert_proof" value="<?php echo $user['cert_proof'] ?? ''; ?>">
                                    <?php if(!empty($user['cert_proof'])): ?>
                                        <a href="<?php echo $user['cert_proof']; ?>" target="_blank" class="small"><i class="fas fa-image"></i> Xem ảnh</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="section-title">4. Thông tin công việc</div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Ngày vào làm (Tính thâm niên)</label>
                                    <input type="date" name="start_date" class="form-control" value="<?php echo $user['start_date'] ?? ''; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Hợp đồng</label>
                                    <select name="contract_type" class="form-select">
                                        <option value="Full-time" <?php echo ($user['contract_type']??'')=='Full-time'?'selected':''; ?>>Full-time</option>
                                        <option value="Part-time" <?php echo ($user['contract_type']??'')=='Part-time'?'selected':''; ?>>Part-time</option>
                                        <option value="CTV" <?php echo ($user['contract_type']??'')=='CTV'?'selected':''; ?>>CTV</option>
                                    </select>
                                </div>
                            </div>

                            <div class="section-title">5. Tiểu sử & Lai lịch</div>
                            <div class="mb-3">
                                <textarea name="biography" class="form-control" rows="5" placeholder="Nhập kinh nghiệm làm việc, quê quán, sở thích, tiểu sử bản thân..."><?php echo $user['biography'] ?? ''; ?></textarea>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" name="update_details" class="btn btn-primary px-4">
                                    <i class="fas fa-save"></i> Lưu hồ sơ chi tiết
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>