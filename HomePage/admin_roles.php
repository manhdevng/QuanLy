<?php
session_start();
require_once 'db_connect.php';

// Chỉ Super Admin (ID=1) mới được vào trang này
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: index.php");
    exit();
}

$message = "";

// --- XỬ LÝ: THÊM VAI TRÒ ---
if (isset($_POST['add_role'])) {
    $role_name = trim($_POST['role_name']);
    $role_desc = trim($_POST['role_desc']);
    
    if (!empty($role_name)) {
        $stmt = $conn->prepare("INSERT INTO roles (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $role_name, $role_desc);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Thêm vai trò thành công!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
        }
    }
}

// --- XỬ LÝ: XÓA VAI TRÒ ---
if (isset($_POST['delete_role'])) {
    $role_id = $_POST['role_id'];
    if ($role_id != 1) {
        $conn->query("DELETE FROM roles WHERE id = $role_id");
        $message = "<div class='alert alert-success'>Đã xóa vai trò!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Không thể xóa Super Admin!</div>";
    }
}

// --- XỬ LÝ: LƯU PHÂN QUYỀN ---
if (isset($_POST['save_permissions'])) {
    $role_id = $_POST['role_id'];
    $selected_perms = $_POST['perms'] ?? [];

    $conn->query("DELETE FROM role_permissions WHERE role_id = $role_id");

    if (!empty($selected_perms)) {
        $sql_insert = "INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql_insert);
        foreach ($selected_perms as $perm_id) {
            $stmt->bind_param("ii", $role_id, $perm_id);
            $stmt->execute();
        }
    }
    $message = "<div class='alert alert-success'>Cập nhật quyền hạn thành công!</div>";
}

// --- LẤY DỮ LIỆU (Lưu vào mảng để dùng 2 lần) ---
$roles_result = $conn->query("SELECT * FROM roles");
$roles_data = [];
while ($row = $roles_result->fetch_assoc()) {
    $roles_data[] = $row;
}

$permissions_result = $conn->query("SELECT * FROM permissions");
$all_perms = [];
while ($row = $permissions_result->fetch_assoc()) {
    $all_perms[] = $row;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Phân quyền</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Đảm bảo modal luôn hiển thị đúng lớp */
        .modal { z-index: 1055 !important; }
        .modal-backdrop { z-index: 1050 !important; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-user-tag text-warning"></i> Quản lý Vai trò & Phân quyền</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark fw-bold">Thêm Vai trò mới</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label>Tên vai trò (Role)</label>
                                <input type="text" name="role_name" class="form-control" placeholder="VD: Kế toán..." required>
                            </div>
                            <div class="mb-3">
                                <label>Mô tả</label>
                                <textarea name="role_desc" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" name="add_role" class="btn btn-warning w-100 fw-bold">Thêm mới</button>
                        </form>
                    </div>
                </div>
                
                <div class="alert alert-info small">
                    <i class="fas fa-info-circle"></i> <strong>Lưu ý:</strong><br>
                    - <strong>Admin:</strong> Có toàn quyền.<br>
                    - Các vai trò khác sẽ bị giới hạn theo quyền bạn cấp.
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên vai trò</th>
                                    <th>Mô tả</th>
                                    <th width="150">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles_data as $role): ?>
                                <tr>
                                    <td><?php echo $role['id']; ?></td>
                                    <td><span class="badge bg-primary fs-6"><?php echo $role['name']; ?></span></td>
                                    <td class="text-muted small"><?php echo $role['description']; ?></td>
                                    <td>
                                        <?php if($role['id'] != 1): ?>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#permModal<?php echo $role['id']; ?>">
                                                <i class="fas fa-key"></i> Phân quyền
                                            </button>
                                            
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Xóa vai trò này?');">
                                                <input type="hidden" name="role_id" value="<?php echo $role['id']; ?>">
                                                <button type="submit" name="delete_role" class="btn btn-sm btn-outline-danger border-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Toàn quyền</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($roles_data as $role): ?>
        <?php if($role['id'] != 1): ?>
        <div class="modal fade" id="permModal<?php echo $role['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form method="POST" class="modal-content bg-white">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Cấp quyền cho: <strong><?php echo $role['name']; ?></strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="role_id" value="<?php echo $role['id']; ?>">
                        <div class="row">
                            <?php 
                            // Lấy quyền hiện tại của role này
                            $current_perms = [];
                            $cp_sql = $conn->query("SELECT permission_id FROM role_permissions WHERE role_id = " . $role['id']);
                            while($cp = $cp_sql->fetch_assoc()) $current_perms[] = $cp['permission_id'];

                            foreach($all_perms as $perm): 
                                $checked = in_array($perm['id'], $current_perms) ? 'checked' : '';
                            ?>
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="perms[]" value="<?php echo $perm['id']; ?>" id="p_<?php echo $role['id'].'_'.$perm['id']; ?>" <?php echo $checked; ?>>
                                    <label class="form-check-label cursor-pointer" for="p_<?php echo $role['id'].'_'.$perm['id']; ?>">
                                        <strong><?php echo $perm['code']; ?></strong><br>
                                        <small class="text-muted"><?php echo $perm['description']; ?></small>
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" name="save_permissions" class="btn btn-success">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>