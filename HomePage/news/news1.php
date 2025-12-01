<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khai giảng khóa mới - IELTS School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Navbar (active cho News) -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../index.php#home">IELTS School</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../index.php#home">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="../index.php#about">Về chúng tôi</a></li>
                <li class="nav-item"><a class="nav-link" href="../index.php#departments">Phòng ban</a></li>
                <li class="nav-item"><a class="nav-link" href="../index.php#stats">Thống kê</a></li>
                <li class="nav-item"><a class="nav-link active" href="../index.php#news">Tin tức & Sự kiện</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="mailto:ieltschool@gmail.com" class="me-3"><i class="bi bi-envelope"></i> ieltschool@gmail.com</a>
                <a href="tel:+84 8627516189" class="me-3"><i class="bi bi-telephone"></i> +84 862 7516 189</a>
                <a href="../login.php" class="btn btn-orange ms-2">Đăng nhập</a>
            </div>
        </div>
    </div>
</nav>

    <!-- Hero tùy chỉnh cho tin tức -->
    <section class="hero hero-slideshow news-hero">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="display-4 fw-bold mb-4 text-white">Khai giảng khóa mới</h1>
                <p class="lead fs-5 mb-4 text-white">Chào đón học viên K15 – Bắt đầu hành trình chinh phục IELTS</p>
                <a href="#news-detail" class="btn btn-orange btn-lg px-5 py-3">Đọc chi tiết</a>
            </div>
        </div>
    </section>

    <!-- Section chi tiết tin tức (hard-code nội dung đầy đủ) -->
    <section id="news-detail" class="container py-5 fade-in">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <img src="/HomePage/img/khaigiang.jpg" alt="Khai giảng khóa mới" class="img-fluid rounded shadow-lg w-100 mb-4 detail-image">
                <h2 class="mb-3">Khai giảng khóa mới K15</h2>
                <p class="small text-muted mb-4">30 Nov, 2025</p>
                <p class="lead mb-4">Ngày 30/11/2025, IELTS School hân hạnh tổ chức lễ khai giảng khóa học mới dành cho học viên K15. Với hơn 50 học viên tham gia, buổi lễ không chỉ là khởi đầu mà còn là cam kết đồng hành cùng bạn chinh phục band điểm mơ ước.</p>
                <p>Chương trình bao gồm các module chính: Listening, Reading, Writing, Speaking, được thiết kế dựa trên đề thi thật 2025. Giáo viên band 8.0+ sẽ hướng dẫn cá nhân hóa, giúp bạn từ 5.0 lên 7.0+ chỉ trong 3 tháng.</p>
                <h4 class="mt-4 mb-3">Nội dung chính:</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Giới thiệu phương pháp học độc quyền.</li>
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Phân bổ lớp học và lịch học linh hoạt.</li>
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Hỗ trợ tài liệu và mock test miễn phí.</li>
                </ul>
                <div class="text-center mb-4">
                    <a href="../news/full_news.php#news" class="btn btn-orange me-2">Quay lại bản tin</a>
                    <a href="mailto:news@ieltschool.com" class="btn btn-outline-orange">Liên hệ</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors và Footer (copy từ full_news.php) -->
    <!-- ... -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>