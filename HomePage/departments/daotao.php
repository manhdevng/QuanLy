<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng Đào Tạo - IELTS School</title>
    <meta name="description" content="Giới thiệu về Phòng Đào Tạo tại IELTS School - Quản lý học viên và chất lượng giảng dạy.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../style.css"> <!-- Đường dẫn lên folder cha -->
</head>
<body>
    <!-- Navbar giống index.php -->
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

    <!-- Hero section customize cho phòng Đào Tạo -->
    <section class="hero hero-slideshow dept-hero">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="display-4 fw-bold mb-4 text-white">Phòng Đào Tạo</h1>
                <p class="lead fs-5 mb-4 text-white">Quản lý học viên và Chất lượng – Cốt lõi của sứ mệnh nâng cao kỹ năng IELTS</p>
                <a href="#dept-intro" class="btn btn-orange btn-lg px-5 py-3">Tìm hiểu thêm</a>
            </div>
        </div>
    </section>

    <!-- Section giới thiệu chi tiết - Ảnh chính giữa, trách nhiệm căn giữa -->
    <section id="dept-intro" class="container py-5 fade-in">
        <!-- Tiêu đề giới thiệu -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-4">Giới thiệu Phòng Đào Tạo</h2>
                <p class="lead">Xây dựng chương trình đào tạo chuẩn IELTS, giám sát chất lượng giảng dạy và hỗ trợ học viên đạt kết quả cao. Đây là cốt lõi của sứ mệnh nâng cao kỹ năng tiếng Anh cho mọi học viên.</p>
            </div>
        </div>

        <!-- Ảnh chính giữa -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <img src="../img/Training.jpg" alt="Phòng Đào Tạo" class="img-fluid rounded shadow-lg mx-auto d-block" style="max-width: 600px;" onerror="this.src='https://via.placeholder.com/600x400?text=Phòng+Đào+Tạo';">
            </div>
        </div>

        <!-- Phần trách nhiệm chính - Căn giữa -->
        <div class="row mb-5">
            <div class="col-12">
                <h4 class="mb-4 text-center">Trách nhiệm chính</h4>
                <ul class="list-group list-group-flush mx-auto" style="max-width: 600px;"> <!-- ✅ Căn giữa list -->
                    <li class="list-group-item border-0 px-4 py-3 text-center"><i class="fas fa-check text-orange me-2"></i>Lập kế hoạch khóa học, phân bổ giáo viên và lớp học.</li>
                    <li class="list-group-item border-0 px-4 py-3 text-center"><i class="fas fa-check text-orange me-2"></i>Đánh giá chất lượng giảng dạy qua feedback học viên.</li>
                    <li class="list-group-item border-0 px-4 py-3 text-center"><i class="fas fa-check text-orange me-2"></i>Hỗ trợ học viên trong quá trình học, theo dõi tiến độ.</li>
                </ul>
            </div>
        </div>

        <!-- Phần đội ngũ - Cân đối và gọn gàng hơn -->
        <div class="row mt-5">
            <div class="col-12">
                <h5 class="mb-4 text-center"><i class="fas fa-users text-orange me-2"></i>Đội ngũ Phòng Đào Tạo</h5>
                <div class="row g-4 justify-content-center"> <!-- ✅ Tăng gap để thoáng -->
                    <!-- Thành viên 1 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card"> <!-- ✅ col-lg-4 để 3 cột desktop, cân đối hơn -->
                        <img src="../img/an_danh.jpg" alt="Đào Văn M" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=M';">
                        <h6 class="fw-bold mb-2">Đào Văn Minh</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 8.5 (Overall)</p>
                        <p class="small text-dark mb-0">Trưởng phòng, xây dựng chương trình đào tạo IELTS.</p>
                    </div>

                    <!-- Thành viên 2 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Nguyễn Thị N" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=N';">
                        <h6 class="fw-bold mb-2">Nguyễn Thị Nhàn</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 8.0</p>
                        <p class="small text-dark mb-0">Giám sát chất lượng, phân bổ giáo viên và lớp học.</p>
                    </div>

                    <!-- Thành viên 3 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Phạm Văn O" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=O';">
                        <h6 class="fw-bold mb-2">Phạm Văn Phước</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 7.5 (Overall)</p>
                        <p class="small text-dark mb-0">Hỗ trợ học viên, theo dõi tiến độ và feedback.</p>
                    </div>

                    <!-- Thành viên 4 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Trần Thị P" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=P';">
                        <h6 class="fw-bold mb-2">Trần Thị Bình</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 8.0</p>
                        <p class="small text-dark mb-0">Đánh giá giảng dạy, tổ chức đào tạo giáo viên.</p>
                    </div>

                    <!-- Thành viên 5 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Lê Văn Q" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=Q';">
                        <h6 class="fw-bold mb-2">Lê Văn Quân</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 7.5 (Overall)</p>
                        <p class="small text-dark mb-0">Quản lý học viên, xử lý khiếu nại và hỗ trợ.</p>
                    </div>

                    <!-- Thành viên 6 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Hoàng Thị R" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=R';">
                        <h6 class="fw-bold mb-2">Hoàng Thị Rạng</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 8.5</p>
                        <p class="small text-dark mb-0">Phát triển nội dung khóa học, cập nhật đề thi mới.</p>
                    </div>

                    <!-- Thành viên 7 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Vũ Văn S" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=S';">
                        <h6 class="fw-bold mb-2">Vũ Văn Sáng</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 8.0 (Overall)</p>
                        <p class="small text-dark mb-0">Giám sát lớp học, đảm bảo chất lượng trực tiếp.</p>
                    </div>

                    <!-- Thành viên 8 -->
                    <div class="col-12 col-sm-6 col-lg-4 text-center mentor-card">
                        <img src="../img/an_danh.jpg" alt="Đặng Thị T" class="rounded-circle mx-auto d-block mb-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=T';">
                        <h6 class="fw-bold mb-2">Đặng Thị Thìn</h6>
                        <p class="small text-muted mb-1">Điểm IELTS 7.5</p>
                        <p class="small text-dark mb-0">Hỗ trợ giáo viên, tổ chức hội thảo đào tạo nội bộ.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons - Căn giữa và thêm margin top -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="../departments/full_departments.php#departments" class="btn btn-orange me-3 mb-2 mb-sm-0">Quay lại danh sách phòng ban</a>
                <a href="mailto:daotao@ieltschool.com" class="btn btn-outline-orange">Liên hệ phòng ban</a>
            </div>
        </div>
    </section>

    <!-- Sponsors section nếu muốn giữ (tùy chọn) -->
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

    <!-- Modals nếu cần (copy từ index.php, nhưng có thể bỏ nếu không dùng) -->
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
    <script src="../script.js"></script> <!-- Đường dẫn lên folder cha -->
</body>
</html>