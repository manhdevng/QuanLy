<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_dept'])) {
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $image = 'img/default.jpg'; 

        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $target_dir = "img/";
            $file_name = basename($_FILES["image_file"]["name"]);
            $target_file = $target_dir . $file_name;
            
            if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $message = "<div class='alert alert-danger'>Lỗi: Không thể upload ảnh.</div>";
            }
        }

        if (empty($message)) {
            $stmt = $conn->prepare("INSERT INTO departments (name, description, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $desc, $image);
            
            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Thêm phòng ban thành công!</div>";
            } else {
                $message = "<div class='alert alert-danger'>Lỗi DB: " . $conn->error . "</div>";
            }
        }
    } elseif (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $conn->query("DELETE FROM departments WHERE id = $id");
        $message = "<div class='alert alert-success'>Đã xóa phòng ban!</div>";
    }
}

$depts = $conn->query("SELECT * FROM departments");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Phòng ban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-building text-info"></i> Quản lý Phòng ban</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white fw-bold">Thêm Phòng ban mới</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Tên phòng ban</label>
                                <input type="text" name="name" class="form-control" required placeholder="VD: Marketing">
                            </div>
                            <div class="mb-3">
                                <label>Mô tả ngắn</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Hình ảnh đại diện</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" required onchange="previewDeptImage(this)">
                                
                                <div class="mt-2 text-center border rounded p-2 bg-white" style="min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                    <img id="deptImgPreview" src="#" class="img-fluid" style="max-height: 150px; display: none;">
                                    <span id="deptPlaceholder" class="text-muted small">Ảnh xem trước</span>
                                </div>
                            </div>

                            <button type="submit" name="add_dept" class="btn btn-info text-white w-100 fw-bold">Lưu lại</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">Ảnh</th>
                                    <th>Thông tin</th>
                                    <th width="100">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $depts->fetch_assoc()): ?>
                                <tr>
                                    <td><img src="<?php echo $row['image']; ?>" class="rounded" width="60" height="40" style="object-fit: cover;"></td>
                                    <td>
                                        <strong><?php echo $row['name']; ?></strong><br>
                                        <small class="text-muted"><?php echo $row['description']; ?></small>
                                    </td>
                                    <td>
                                        <form method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewDeptImage(input) {
            var preview = document.getElementById('deptImgPreview');
            var placeholder = document.getElementById('deptPlaceholder');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>