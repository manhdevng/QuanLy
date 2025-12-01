<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sự kiện tuyển sinh online - IELTS School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Navbar (active cho #news, copy từ news1.php) -->
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

    <!-- Hero -->
    <section class="hero hero-slideshow news-hero">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="display-4 fw-bold mb-4 text-white">Sự kiện tuyển sinh online</h1>
                <p class="lead fs-5 mb-4 text-white">Giảm 20% học phí cho đăng ký sớm – Cơ hội vàng cho bạn</p>
                <a href="#news-detail" class="btn btn-orange btn-lg px-5 py-3">Đọc chi tiết</a>
            </div>
        </div>
    </section>

    <!-- Section chi tiết -->
    <section id="news-detail" class="container py-5 fade-in">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <img src="../images/news4.jpg" alt="Sự kiện tuyển sinh online" class="img-fluid rounded shadow-lg w-100 mb-4 detail-image">
                <h2 class="mb-3">Sự kiện tuyển sinh online</h2>
                <p class="small text-muted mb-4">20 Nov, 2025</p>
                <p class="lead mb-4">IELTS School chính thức ra mắt sự kiện tuyển sinh online từ 20/11 đến 31/12/2025, mang đến ưu đãi giảm 20% học phí cho tất cả các khóa học IELTS. Đây là dịp lý tưởng để bạn đầu tư vào tương lai với chi phí hợp lý và hỗ trợ tối đa từ đội ngũ chuyên gia.</p>
                <p>Sự kiện được tổ chức qua nền tảng Zoom và website, với hàng trăm suất đăng ký đã được đặt chỗ. Tham gia ngay để nhận thêm tư vấn 1-1 và bộ tài liệu ôn thi miễn phí. Đã có hơn 200 học viên hưởng lợi từ chương trình tương tự năm ngoái, đạt tỷ lệ thành công 90%.</p>
                <h4 class="mt-4 mb-3">Ưu đãi nổi bật:</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Giảm 20% học phí cho khóa Foundation, Intermediate, Advanced.</li>
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Test đầu vào miễn phí và webinar hướng dẫn.</li>
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Quà tặng voucher học thêm 1 tháng nếu đăng ký nhóm.</li>
                </ul>
                <p>Đừng bỏ lỡ! Truy cập form đăng ký tại website hoặc gọi hotline để được hỗ trợ ngay.</p>
                <div class="text-center mb-4">
                    <a href="../news/full_news.php#news" class="btn btn-orange me-2">Quay lại bản tin</a>
                    <a href="mailto:tuyensinh@ieltschool.com" class="btn btn-outline-orange">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors và Footer (copy từ news1.php) -->
    <section class="sponsors-section fade-in">
        <!-- Copy sponsors -->
    </section>
    <footer class="contact-footer">
        <!-- Copy footer -->
    </footer>
    <div class="modal fade" id="loginModal" tabindex="-1">
        <!-- Copy modal -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>