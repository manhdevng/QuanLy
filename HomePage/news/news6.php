<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật chương trình học - IELTS School</title>
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
                <h1 class="display-4 fw-bold mb-4 text-white">Cập nhật chương trình học</h1>
                <p class="lead fs-5 mb-4 text-white">Tích hợp module Listening mới dựa trên đề thi thật 2025</p>
                <a href="#news-detail" class="btn btn-orange btn-lg px-5 py-3">Đọc chi tiết</a>
            </div>
        </div>
    </section>

    <!-- Section chi tiết -->
    <section id="news-detail" class="container py-5 fade-in">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <img src="../images/news6.jpg" alt="Cập nhật chương trình học" class="img-fluid rounded shadow-lg w-100 mb-4 detail-image">
                <h2 class="mb-3">Cập nhật chương trình học 2025</h2>
                <p class="small text-muted mb-4">10 Nov, 2025</p>
                <p class="lead mb-4">IELTS School chính thức cập nhật chương trình học cho năm 2025, với trọng tâm tích hợp module Listening mới dựa hoàn toàn trên đề thi thật từ British Council và IDP. Sự thay đổi này nhằm giúp học viên làm quen sớm với format mới, tăng cơ hội đạt band 7.0+ ở kỹ năng Listening – phần thường khó nhất với nhiều người.</p>
                <p>Module mới bao gồm 20 bài luyện tập với audio thật, phân tích lỗi phổ biến và chiến lược note-taking hiệu quả. Đội ngũ Phòng Đào Tạo đã hợp tác với chuyên gia để đảm bảo nội dung cập nhật 100% theo thay đổi đề thi tháng 1/2025.</p>
                <h4 class="mt-4 mb-3">Cập nhật nổi bật:</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>20 audio đề thi thật từ 2024-2025, với transcript chi tiết.</li>
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Chiến lược mới cho Section 3-4: Tăng tốc độ nghe và dự đoán từ khóa.</li>
                    <li class="list-group-item border-0 px-0 py-2"><i class="fas fa-check text-orange me-2"></i>Tích hợp quiz tương tác trên app học tập của trường.</li>
                </ul>
                <p>Học viên hiện tại sẽ được nâng cấp miễn phí. Liên hệ để biết lịch học mới!</p>
                <div class="text-center mb-4">
                    <a href="../news/full_news.php#news" class="btn btn-orange me-2">Quay lại bản tin</a>
                    <a href="mailto:daotao@ieltschool.com" class="btn btn-outline-orange">Cập nhật lộ trình</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sponsors section -->
    <section class="sponsors-section fade-in">
        <div class="container py-4">
            <div class="sponsors-container">
                <div class="sponsors-marquee">
                    <div class="sponsor-logo"><img src="../imgtaitro/VnEconomy.svg" alt="VnEconomy"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/Vnexpress.svg" alt="VnExpress"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/Cafebiz.svg" alt="Giáo Dục"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/apple.jpg" alt="apple"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/nvidia.jpg" alt="nvidia"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/samsung.jpg" alt="samsung"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="contact-footer">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                    <h5 class="footer-title mb-3">Thông Tin Liên Hệ</h5>
                    <div class="contact-info">
                        <p class="contact-item"><i class="fas fa-map-marker-alt icon-orange me-2"></i>Địa chỉ: Công ty trách nhiệm hữu hạn 4 thành viên ddmq</p>
                        <p class="contact-item"><i class="fas fa-phone icon-orange me-2"></i>Điện thoại: +84 8627516189</p>
                        <p class="contact-item"><i class="fas fa-envelope icon-orange me-2"></i>Email: ddmq@gmail.com</p>
                        <p class="contact-item"><i class="fas fa-clock icon-orange me-2"></i>Giờ làm việc: Thứ 2 - Thứ 6, 9:00 - 18:00</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <h5 class="footer-title mb-3">Kết Nối Với Chúng Tôi</h5>
                    <div class="social-icons">
                        <a href="../index.php#home" class="icon-btn" title="Trang chủ"><i class="fas fa-home me-2"></i> Trang chủ</a>
                        <a href="../index.php#about" class="icon-btn" title="Về chúng tôi"><i class="fas fa-info-circle me-2"></i> Về chúng tôi</a>
                        <a href="https://youtube.com" class="icon-btn" target="_blank" title="YouTube"><i class="fab fa-youtube me-2"></i> YouTube</a>
                        <a href="https://facebook.com" class="icon-btn" target="_blank" title="Fanpage"><i class="fab fa-facebook me-2"></i> Fanpage</a>
                        <a href="../login.php" class="icon-btn" title="Đăng nhập"><i class="fas fa-sign-in-alt me-2"></i> Đăng nhập</a>
                    </div>
                </div>
            </div>
            <hr class="divider mt-4 mb-4">
            <div class="text-center copyright"><p class="mb-0">&copy; 2025 ddmq. All Rights Reserved.</p></div>
        </div>
    </footer>

    <!-- Modal đăng nhập -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng Nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="../login_process.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-orange w-100">Đăng Nhập</button>
                        <div class="text-center mt-3">
                            <span class="small text-muted">Chưa có tài khoản?</span>
                            <a href="../register.php" class="small fw-bold text-decoration-none">Đăng ký ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script.js"></script>
</body>
</html>