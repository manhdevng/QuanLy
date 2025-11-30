<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];
$msg = "";

// Kiểm tra pending request
$has_pending_request = false;
if ($role_id != 1) { 
    $check_pending = $conn->query("SELECT * FROM profile_requests WHERE user_id = $user_id AND status = 'pending'");
    if ($check_pending->num_rows > 0) $has_pending_request = true;
}

// --- XỬ LÝ LƯU HỒ SƠ ---
if (isset($_POST['save_profile'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $edu = $_POST['education_level'];
    $major = $_POST['major'];
    $cert_type = $_POST['certificate_type'];
    $cert_score = $_POST['certificate_score'];
    $bio = $_POST['biography'];

    // 1. Xử lý Ảnh AVATAR (Mới)
    $avatar_path = $_POST['current_avatar'] ?? 'img/default.jpg';
    if (isset($_FILES['avatar_img']) && $_FILES['avatar_img']['error'] == 0) {
        $target = "img/avatars/" . time() . "_" . basename($_FILES['avatar_img']['name']);
        if (!is_dir('img/avatars')) mkdir('img/avatars', 0777, true);
        if (move_uploaded_file($_FILES['avatar_img']['tmp_name'], $target)) {
            $avatar_path = $target;
        }
    }

    // 2. Xử lý Ảnh Bằng cấp & Chứng chỉ
    $edu_proof = $_POST['current_edu_proof'] ?? '';
    if (isset($_FILES['edu_img']) && $_FILES['edu_img']['error'] == 0) {
        $target = "img/proofs/" . time() . "_edu_" . basename($_FILES['edu_img']['name']);
        if (!is_dir('img/proofs')) mkdir('img/proofs', 0777, true);
        if (move_uploaded_file($_FILES['edu_img']['tmp_name'], $target)) $edu_proof = $target;
    }

    $cert_proof = $_POST['current_cert_proof'] ?? '';
    if (isset($_FILES['cert_img']) && $_FILES['cert_img']['error'] == 0) {
        $target = "img/proofs/" . time() . "_cert_" . basename($_FILES['cert_img']['name']);
        if (!is_dir('img/proofs')) mkdir('img/proofs', 0777, true);
        if (move_uploaded_file($_FILES['cert_img']['tmp_name'], $target)) $cert_proof = $target;
    }

    if ($role_id == 1) {
        // --- ADMIN: LƯU THẲNG ---
        $conn->query("UPDATE users SET full_name='$full_name', email='$email', avatar='$avatar_path' WHERE id=$user_id");
        
        $check = $conn->query("SELECT user_id FROM employee_details WHERE user_id = $user_id");
        if ($check->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE employee_details SET phone=?, dob=?, address=?, education_level=?, major=?, certificate_type=?, certificate_score=?, biography=?, edu_proof=?, cert_proof=? WHERE user_id=?");
            $stmt->bind_param("ssssssdsssi", $phone, $dob, $address, $edu, $major, $cert_type, $cert_score, $bio, $edu_proof, $cert_proof, $user_id);
        } else {
            $stmt = $conn->prepare("INSERT INTO employee_details (phone, dob, address, education_level, major, certificate_type, certificate_score, biography, edu_proof, cert_proof, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssdsssi", $phone, $dob, $address, $edu, $major, $cert_type, $cert_score, $bio, $edu_proof, $cert_proof, $user_id);
        }
        $stmt->execute();
        $_SESSION['full_name'] = $full_name;
        $_SESSION['avatar'] = $avatar_path; // Cập nhật session ngay
        $msg = "<div class='alert alert-success'>Cập nhật hồ sơ thành công!</div>";
    
    } else {
        // --- USER: GỬI YÊU CẦU ---
        if ($has_pending_request) {
            $msg = "<div class='alert alert-warning'>Đang có yêu cầu chờ duyệt!</div>";
        } else {
            $sql = "INSERT INTO profile_requests (user_id, full_name, email, avatar, phone, dob, address, education_level, major, certificate_type, certificate_score, biography, edu_proof, cert_proof, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssssssssdsss", $user_id, $full_name, $email, $avatar_path, $phone, $dob, $address, $edu, $major, $cert_type, $cert_score, $bio, $edu_proof, $cert_proof);
            
            if ($stmt->execute()) {
                $msg = "<div class='alert alert-success'>Đã gửi yêu cầu! Vui lòng chờ duyệt.</div>";
                $has_pending_request = true; 
            } else {
                $msg = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
            }
        }
    }
}

// --- ĐỔI MẬT KHẨU ---
if (isset($_POST['change_pass'])) {
    $old = $_POST['old_pass'];
    $new = $_POST['new_pass'];
    $confirm = $_POST['confirm_pass'];

    $u = $conn->query("SELECT password FROM users WHERE id=$user_id")->fetch_assoc();
    if (password_verify($old, $u['password'])) {
        if ($new === $confirm) {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password='$hash' WHERE id=$user_id");
            $msg = "<div class='alert alert-success'>Đổi mật khẩu thành công!</div>";
        } else $msg = "<div class='alert alert-danger'>Mật khẩu mới không khớp!</div>";
    } else $msg = "<div class='alert alert-danger'>Mật khẩu cũ không đúng!</div>";
}

// Lấy thông tin hiển thị
$sql_u = "SELECT u.*, r.name as role_name, ed.* FROM users u 
          LEFT JOIN roles r ON u.role_id = r.id 
          LEFT JOIN employee_details ed ON u.id = ed.user_id 
          WHERE u.id = $user_id";
$user = $conn->query($sql_u)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hồ sơ cá nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .section-title { border-left: 4px solid #0d6efd; padding-left: 10px; font-weight: bold; color: #0d6efd; margin-bottom: 15px; margin-top: 10px; }
        .disabled-overlay { pointer-events: none; opacity: 0.6; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="fas fa-user-circle text-primary"></i> Hồ sơ của tôi</h3>
            <a href="<?php echo ($role_id == 1) ? 'admin_dashboard.php' : 'user_dashboard.php'; ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại Dashboard</a>
        </div>

        <?php echo $msg; ?>
        <?php if ($has_pending_request): ?>
        <div class="alert alert-warning border-warning shadow-sm">
            <i class="fas fa-hourglass-half"></i> Hồ sơ đang chờ duyệt! Vui lòng đợi Quản trị viên xử lý.
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body text-center">
                        <img src="<?php echo $user['avatar'] ?? 'img/default.jpg'; ?>" class="rounded-circle mx-auto d-block mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="mb-0"><?php echo $user['full_name']; ?></h5>
                        <small class="text-muted"><?php echo $user['email']; ?></small>
                        <div class="mt-2"><span class="badge bg-primary"><?php echo $user['role_name']; ?></span></div>
                    </div>
                </div>
                
                <div class="card shadow-sm mb-3 border-danger">
                    <div class="card-header bg-danger text-white fw-bold"><i class="fas fa-key"></i> Đổi mật khẩu</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-2"><label class="form-label">Mật khẩu cũ</label><input type="password" name="old_pass" class="form-control" required></div>
                            <div class="mb-2"><label class="form-label">Mật khẩu mới</label><input type="password" name="new_pass" class="form-control" required></div>
                            <div class="mb-3"><label class="form-label">Nhập lại mới</label><input type="password" name="confirm_pass" class="form-control" required></div>
                            <button type="submit" name="change_pass" class="btn btn-danger w-100">Xác nhận đổi</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold d-flex justify-content-between">
                        <span>Thông tin chi tiết</span>
                        <span class="badge <?php echo $has_pending_request?'bg-warning text-dark':'bg-success'; ?>"><?php echo $has_pending_request?'Đang khóa':'Có thể sửa'; ?></span>
                    </div>
                    <div class="card-body <?php echo $has_pending_request ? 'disabled-overlay' : ''; ?>">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <div class="section-title">1. Thông tin chung</div>
                            
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-3 col-form-label fw-bold">Ảnh đại diện</label>
                                <div class="col-sm-9">
                                    <input type="file" name="avatar_img" class="form-control" accept="image/*">
                                    <input type="hidden" name="current_avatar" value="<?php echo $user['avatar'] ?? ''; ?>">
                                    <div class="form-text small">Chọn ảnh mới nếu muốn thay đổi avatar.</div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-md-6"><label class="form-label">Họ tên</label><input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>" required></div>
                                <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required></div>
                                <div class="col-md-6"><label class="form-label">SĐT</label><input type="text" name="phone" class="form-control" value="<?php echo $user['phone'] ?? ''; ?>"></div>
                                <div class="col-md-6"><label class="form-label">Ngày sinh</label><input type="date" name="dob" class="form-control" value="<?php echo $user['dob'] ?? ''; ?>"></div>
                                <div class="col-12"><label class="form-label">Địa chỉ</label><input type="text" name="address" class="form-control" value="<?php echo $user['address'] ?? ''; ?>"></div>
                            </div>

                            <div class="section-title">2. Bằng cấp (Ảnh hưởng lương)</div>
                            <div class="row g-2 mb-3 bg-light p-3 rounded border mx-0">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Trình độ</label>
                                    <select name="education_level" class="form-select">
                                        <option value="">-- Chọn --</option>
                                        <?php $levels = ['Trung cấp', 'Cao đẳng', 'Đại học', 'Thạc sĩ', 'Tiến sĩ']; foreach($levels as $l) { $sel = ($user['education_level']??'')==$l?'selected':''; echo "<option value='$l' $sel>$l</option>"; } ?>
                                    </select>
                                </div>
                                <div class="col-md-4"><label class="form-label">Chuyên ngành</label><input type="text" name="major" class="form-control" value="<?php echo $user['major'] ?? ''; ?>"></div>
                                <div class="col-md-4">
                                    <label class="form-label">Ảnh Bằng</label>
                                    <input type="file" name="edu_img" class="form-control">
                                    <input type="hidden" name="current_edu_proof" value="<?php echo $user['edu_proof'] ?? ''; ?>">
                                    <?php if(!empty($user['edu_proof'])): ?><a href="<?php echo $user['edu_proof']; ?>" target="_blank" class="small"><i class="fas fa-image"></i> Xem ảnh</a><?php endif; ?>
                                </div>
                            </div>

                            <div class="section-title">3. Ngoại ngữ</div>
                            <div class="row g-2 mb-3 bg-light p-3 rounded border mx-0">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Chứng chỉ</label>
                                    <select name="certificate_type" class="form-select">
                                        <option value="None" <?php echo ($user['certificate_type']??'')=='None'?'selected':''; ?>>Không</option>
                                        <option value="IELTS" <?php echo ($user['certificate_type']??'')=='IELTS'?'selected':''; ?>>IELTS</option>
                                        <option value="TOEIC" <?php echo ($user['certificate_type']??'')=='TOEIC'?'selected':''; ?>>TOEIC</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><label class="form-label">Điểm số</label><input type="number" step="0.5" name="certificate_score" class="form-control" value="<?php echo $user['certificate_score'] ?? ''; ?>"></div>
                                <div class="col-md-4">
                                    <label class="form-label">Ảnh Chứng chỉ</label>
                                    <input type="file" name="cert_img" class="form-control">
                                    <input type="hidden" name="current_cert_proof" value="<?php echo $user['cert_proof'] ?? ''; ?>">
                                    <?php if(!empty($user['cert_proof'])): ?><a href="<?php echo $user['cert_proof']; ?>" target="_blank" class="small"><i class="fas fa-image"></i> Xem ảnh</a><?php endif; ?>
                                </div>
                            </div>

                            <div class="section-title">4. Tiểu sử & Lai lịch</div>
                            <div class="mb-3"><textarea name="biography" class="form-control" rows="4"><?php echo $user['biography'] ?? ''; ?></textarea></div>

                            <div class="mt-3 text-end">
                                <button type="submit" name="save_profile" class="btn btn-primary px-4" <?php echo $has_pending_request ? 'disabled' : ''; ?>>
                                    <i class="fas fa-paper-plane"></i> <?php echo ($role_id == 1) ? 'Lưu Hồ Sơ' : 'Gửi Yêu Cầu Duyệt'; ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>