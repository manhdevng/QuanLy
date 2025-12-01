<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả Bản Tin - IELTS School</title>
    <meta name="description" content="Danh sách đầy đủ bản tin và thông tin chi tiết từ IELTS School.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Navbar FIXED: bg-dark navbar-dark để hiển thị rõ ràng, active cho #news -->
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

    <!-- Hero section cho trang tất cả bản tin -->
    <section class="hero hero-slideshow dept-hero">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="display-4 fw-bold mb-4 text-white">Tất Cả Bản Tin & Sự Kiện</h1>
                <p class="lead fs-5 mb-4 text-white">Cập nhật thông tin mới nhất từ IELTS School – Kiến thức, sự kiện và câu chuyện thành công.</p>
                <a href="#all-news" class="btn btn-orange btn-lg px-5 py-3">Xem danh sách</a>
            </div>
        </div>
    </section>

    <!-- Section danh sách tất cả tin (hard-code grid 6 tin, 3 cột responsive) -->
    <section id="all-news" class="container py-5 fade-in">
        <h2 class="text-center mb-5">Danh sách đầy đủ</h2>
        <div class="row g-4"> <!-- Sử dụng Bootstrap row cho grid responsive -->
            <!-- Tin 1: Khái giảng khóa mới K15 -->
            <div class="col-md-6 col-lg-4">
                <div class="news-card-full scroll-animate h-100">
                    <img src="../img/khaigiang.jpg" alt="Khái giảng khóa mới K15" class="img-fluid rounded-top" onerror="this.src='https://via.placeholder.com/400x250?text=Khởi+Giảng+K15';">
                    <div class="p-4 news-content-full">
                        <h5 class="news-title">Khai giảng khóa mới K15</h5>
                        <p class="small text-muted mb-2">01 Dec, 2025</p>
                        <p class="news-desc-full">Chào đón học viên K15. Khởi đầu hành trình chinh phục IELTS với phương pháp hiện đại.</p>
                        <a href="news1.php" class="btn btn-orange btn-sm">Đọc chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Tin 2: Hội thảo giảng dạy 4.0 -->
            <div class="col-md-6 col-lg-4">
                <div class="news-card-full scroll-animate h-100">
                    <img src="../img/hoithao.jpg" alt="Hội thảo giảng dạy 4.0" class="img-fluid rounded-top" onerror="this.src='https://via.placeholder.com/400x250?text=Hội+Thảo+4.0';">
                    <div class="p-4 news-content-full">
                        <h5 class="news-title">Hội thảo giảng dạy 4.0</h5>
                        <p class="small text-muted mb-2">30 Nov, 2025</p>
                        <p class="news-desc-full">Áp dụng AI vào học tập. Cập nhật xu hướng mới nhất cho giáo viên và học viên.</p>
                        <a href="news2.php" class="btn btn-orange btn-sm">Đọc chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Tin 3: Học viên đạt band 8.0 -->
            <div class="col-md-6 col-lg-4">
                <div class="news-card-full scroll-animate h-100">
                    <img src="../img/datband.jpg" alt="Học viên đạt band 8.0" class="img-fluid rounded-top" onerror="this.src='https://via.placeholder.com/400x250?text=Band+8.0';">
                    <div class="p-4 news-content-full">
                        <h5 class="news-title">Học viên đạt band 8.0</h5>
                        <p class="small text-muted mb-2">25 Nov, 2025</p>
                        <p class="news-desc-full">Câu chuyện thành công từ khóa học Speaking. Chia sẻ kinh nghiệm từ top học viên.</p>
                        <a href="news3.php" class="btn btn-orange btn-sm">Đọc chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Tin 4: Sự kiện tuyển sinh online -->
            <div class="col-md-6 col-lg-4">
                <div class="news-card-full scroll-animate h-100">
                    <img src="../img/tuyensinh.jpg" alt="Sự kiện tuyển sinh online" class="img-fluid rounded-top" onerror="this.src='https://via.placeholder.com/400x250?text=Tuyển+Sinnh';">
                    <div class="p-4 news-content-full">
                        <h5 class="news-title">Sự kiện tuyển sinh online</h5>
                        <p class="small text-muted mb-2">20 Nov, 2025</p>
                        <p class="news-desc-full">Giảm 20% học phí cho đăng ký sớm. Đăng ký ngay để nhận tư vấn miễn phí.</p>
                        <a href="news4.php" class="btn btn-orange btn-sm">Đọc chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Tin 5: Workshop Writing IELTS -->
            <div class="col-md-6 col-lg-4">
                <div class="news-card-full scroll-animate h-100">
                    <img src="../img/workshop.jpg" alt="Workshop Writing IELTS" class="img-fluid rounded-top" onerror="this.src='https://via.placeholder.com/400x250?text=Workshop+Writing';">
                    <div class="p-4 news-content-full">
                        <h5 class="news-title">Workshop Writing IELTS</h5>
                        <p class="small text-muted mb-2">15 Nov, 2025</p>
                        <p class="news-desc-full">Hướng dẫn viết Task 2 hiệu quả. Tham gia miễn phí với chuyên gia band 8.5.</p>
                        <a href="news5.php" class="btn btn-orange btn-sm">Đọc chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Tin 6: Cập nhật chương trình học -->
            <div class="col-md-6 col-lg-4">
                <div class="news-card-full scroll-animate h-100">
                    <img src="../img/chuongtrinh.jpg" alt="Cập nhật chương trình học" class="img-fluid rounded-top" onerror="this.src='https://via.placeholder.com/400x250?text=Cập+Nhật+Chương+Trình';">
                    <div class="p-4 news-content-full">
                        <h5 class="news-title">Cập nhật chương trình học</h5>
                        <p class="small text-muted mb-2">10 Nov, 2025</p>
                        <p class="news-desc-full">Tích hợp module Listening mới dựa trên đề thi thật 2025.</p>
                        <a href="news6.php" class="btn btn-orange btn-sm">Đọc chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="../index.php#news" class="btn btn-orange">Quay lại trang chủ</a>
        </div>
    </section>

    <!-- Sponsors section -->
    <section class="sponsors-section fade-in">
        <div class="container py-4">
            <div class="sponsors-container">
                <div class="sponsors-marquee">
                    <div class="sponsor-logo"><img src="../imgtaitro/VnEconomy.svg" alt="VnEconomy" onerror="this.src='https://via.placeholder.com/150x50?text=VnEconomy';"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/Vnexpress.svg" alt="VnExpress" onerror="this.src='https://via.placeholder.com/150x50?text=VnExpress';"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/Cafebiz.svg" alt="Giáo Dục" onerror="this.src='https://via.placeholder.com/150x50?text=Cafebiz';"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/apple.jpg" alt="apple" onerror="this.src='https://via.placeholder.com/150x50?text=Apple';"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/nvidia.jpg" alt="nvidia" onerror="this.src='https://via.placeholder.com/150x50?text=NVIDIA';"></div>
                    <div class="sponsor-logo"><img src="../imgtaitro/samsung.jpg" alt="samsung" onerror="this.src='https://via.placeholder.com/150x50?text=Samsung';"></div>
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