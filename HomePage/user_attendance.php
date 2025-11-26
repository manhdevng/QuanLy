<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');
$message = "";

// Xử lý Check-in / Check-out
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type']; // 'check_in' hoặc 'check_out'
    $now = date('H:i:s');

    if ($type == 'check_in') {
        // Kiểm tra xem nay đã check-in chưa
        $check = $conn->query("SELECT id FROM attendance WHERE user_id = $user_id AND date = '$today'");
        if ($check->num_rows == 0) {
            $sql = "INSERT INTO attendance (user_id, date, check_in, status) VALUES (?, ?, ?, 'present')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $user_id, $today, $now);
            if ($stmt->execute()) $message = "<div class='alert alert-success'>Check-in thành công lúc $now</div>";
        } else {
            $message = "<div class='alert alert-warning'>Bạn đã check-in hôm nay rồi!</div>";
        }
    } elseif ($type == 'check_out') {
        $sql = "UPDATE attendance SET check_out = ? WHERE user_id = ? AND date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $now, $user_id, $today);
        if ($stmt->execute()) $message = "<div class='alert alert-success'>Check-out thành công lúc $now</div>";
    }
}

// Lấy thông tin chấm công hôm nay
$today_att = $conn->query("SELECT * FROM attendance WHERE user_id = $user_id AND date = '$today'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chấm Công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .clock { font-size: 3rem; font-weight: bold; color: #333; }
        .date-display { font-size: 1.2rem; color: #666; }
    </style>
</head>
<body class="bg-light text-center">
    <div class="container mt-5">
        <div class="d-flex justify-content-start mb-4">
            <a href="user_dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card shadow" style="max-width: 500px; margin: 0 auto;">
            <div class="card-body py-5">
                <h2 class="mb-4">Chấm Công Hàng Ngày</h2>
                <div class="date-display mb-2"><?php echo date('l, d/m/Y'); ?></div>
                <div class="clock mb-4" id="clock">00:00:00</div>
                
                <?php echo $message; ?>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <form method="POST">
                        <input type="hidden" name="type" value="check_in">
                        <button type="submit" class="btn btn-success btn-lg px-4" 
                            <?php if(isset($today_att['check_in'])) echo 'disabled'; ?>>
                            <i class="fas fa-sign-in-alt"></i> Vào Ca
                        </button>
                    </form>

                    <form method="POST">
                        <input type="hidden" name="type" value="check_out">
                        <button type="submit" class="btn btn-danger btn-lg px-4"
                            <?php if(!isset($today_att['check_in']) || isset($today_att['check_out'])) echo 'disabled'; ?>>
                            <i class="fas fa-sign-out-alt"></i> Tan Ca
                        </button>
                    </form>
                </div>

                <?php if(isset($today_att)): ?>
                    <div class="mt-4 pt-3 border-top text-start">
                        <p><strong><i class="fas fa-clock text-success"></i> Giờ vào:</strong> <?php echo $today_att['check_in']; ?></p>
                        <p><strong><i class="fas fa-clock text-danger"></i> Giờ ra:</strong> <?php echo $today_att['check_out'] ?? '--:--'; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Đồng hồ chạy theo thời gian thực
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('vi-VN');
            document.getElementById('clock').innerText = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>