<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả Phòng Ban - IELTS School</title>
    <meta name="description" content="Danh sách đầy đủ các phòng ban chuyên môn tại IELTS School.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Navbar giống index.php, với active cho Phòng ban -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php#home">IELTS School</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../index.php#home">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#about">Về chúng tôi</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../index.php#departments">Phòng ban</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#stats">Thống kê</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#news">Tin tức & Sự kiện</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="mailto:ieltschool@gmail.com" class="me-3 text-white"><i class="bi bi-envelope"></i> ieltschool@gmail.com</a>
                    <a href="tel:+84 8627516189" class="me-3 text-white"><i class="bi bi-telephone"></i> +84 862 7516 189</a>
                    <a href="../login.php" class="btn btn-orange ms-2">Đăng nhập</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero section cho trang tất cả phòng ban -->
    <section class="hero hero-slideshow dept-hero">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="display-4 fw-bold mb-4 text-white">Tất Cả Các Phòng Ban Chuyên Môn</h1>
                <p class="lead fs-5 mb-4 text-white">Khám phá đầy đủ đội ngũ chuyên môn tại IELTS School – Nơi mỗi phòng ban góp phần vào thành công của bạn.</p>
                <a href="#all-depts" class="btn btn-orange btn-lg px-5 py-3">Xem danh sách</a>
            </div>
        </div>
    </section>

    <!-- Section danh sách tất cả phòng ban (hard-code 5 card) -->
    <section id="all-depts" class="container py-5 fade-in">
        <h2 class="text-center mb-5">Danh sách đầy đủ</h2>
        <div class="dept-grid">
            <!-- Card 1: Marketing -->
            <div class="dept-card scroll-animate">
                <img src="../img/Operations.jpg" alt="Phòng Marketing" class="img-fluid mb-3 rounded">
                <h5>Phòng Marketing</h5>
                <p>Quảng bá thông tin và Tuyển sinh online.</p>
                <a href="marketing.php?id=1" class="btn btn-orange btn-sm">Xem chi tiết</a>
            </div>

            <!-- Card 2: Hành chính -->
            <div class="dept-card scroll-animate">
                <img src="../img/Finance.jpg" alt="Hành Chính - Kế Toán" class="img-fluid mb-3 rounded">
                <h5>Hành Chính - Kế Toán</h5>
                <p>Quản lý nhân sự, Thực chi và Cơ sở.</p>
                <a href="hanhchinh.php?id=2" class="btn btn-orange btn-sm">Xem chi tiết</a>
            </div>

            <!-- Card 3: Đào Tạo -->
            <div class="dept-card scroll-animate">
                <img src="../img/vision1.jpg" alt="Phòng Đào Tạo" class="img-fluid mb-3 rounded">
                <h5>Phòng Đào Tạo</h5>
                <p>Quản lý học viên và Chất lượng.</p>
                <a href="daotao.php?id=3" class="btn btn-orange btn-sm">Xem chi tiết</a>
            </div>

            <!-- Card 4: Tuyển Sinh -->
            <div class="dept-card scroll-animate">
                <img src="../img/Operations.jpg" alt="Phòng Tuyển Sinh" class="img-fluid mb-3 rounded">
                <h5>Phòng Tuyển Sinh</h5>
                <p>Tư vấn khóa học và Telesales.</p>
                <a href="tuyensinh.php?id=4" class="btn btn-orange btn-sm">Xem chi tiết</a>
            </div>

            <!-- Card 5: Công Nghệ (tùy chọn) -->
            <div class="dept-card scroll-animate">
                <img src="../img/kythuat.jpg" alt="Phòng Công Nghệ" class="img-fluid mb-3 rounded">
                <h5>Phòng Công Nghệ</h5>
                <p>Hỗ trợ hệ thống IT và Phát triển.</p>
                <a href="congnghe.php?id=5" class="btn btn-orange btn-sm">Xem chi tiết</a>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="../index.php#departments" class="btn btn-orange">Quay lại trang chủ</a>
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

    <!-- Footer giống index.php -->
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