<?php
session_start();
require_once 'db_connect.php';

// Check quyền Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

// Xử lý Thêm / Xóa tin
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_news'])) {
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $image = 'img/default.jpg'; // Ảnh mặc định nếu không upload

        // Xử lý Upload Ảnh
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $target_dir = "img/";
            // Lấy tên file gốc (VD: hinh1.jpg)
            $file_name = basename($_FILES["image_file"]["name"]);
            $target_file = $target_dir . $file_name;
            
            // Di chuyển file từ bộ nhớ tạm vào thư mục img/
            if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
                $image = $target_file; // Lưu đường dẫn mới (VD: img/hinh1.jpg)
            } else {
                $message = "<div class='alert alert-danger'>Lỗi: Không thể upload ảnh.</div>";
            }
        }
        
        if (empty($message)) { // Chỉ lưu vào DB nếu không có lỗi upload
            $sql = "INSERT INTO news (title, summary, image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $title, $summary, $image);
            
            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Đã đăng tin mới thành công!</div>";
            } else {
                $message = "<div class='alert alert-danger'>Lỗi DB: " . $conn->error . "</div>";
            }
        }
    } elseif (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $conn->query("DELETE FROM news WHERE id = $id");
        $message = "<div class='alert alert-success'>Đã xóa tin tức!</div>";
    }
}

// Lấy danh sách tin tức
$news_list = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-newspaper text-primary"></i> Quản lý Tin tức</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <?php echo $message; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Đăng tin mới</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Mô tả ngắn</label>
                                <textarea name="summary" class="form-control" rows="3" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label>Chọn ảnh đại diện</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*" required onchange="previewImage(this)">
                                
                                <div class="mt-2 text-center border rounded p-2 bg-white" style="min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                    <img id="imgPreview" src="#" class="img-fluid" style="max-height: 150px; display: none;">
                                    <span id="placeholderText" class="text-muted small">Ảnh xem trước sẽ hiện ở đây</span>
                                </div>
                            </div>

                            <button type="submit" name="add_news" class="btn btn-primary w-100">Đăng bài</button>
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
                                    <th width="100">Hình ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $news_list->fetch_assoc()): ?>
                                <tr>
                                    <td><img src="<?php echo $row['image']; ?>" class="img-fluid rounded" style="max-height: 60px;"></td>
                                    <td>
                                        <strong><?php echo $row['title']; ?></strong><br>
                                        <small class="text-muted"><?php echo substr($row['summary'], 0, 50); ?>...</small>
                                    </td>
                                    <td>
                                        <form method="POST" onsubmit="return confirm('Xóa tin này?');">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
        function previewImage(input) {
            var preview = document.getElementById('imgPreview');
            var placeholder = document.getElementById('placeholderText');
            
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