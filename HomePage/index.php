<?php
require_once 'db_connect.php'; // Kết nối database để lấy tin tức
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DDMQ - Hệ thống Quản lý Nhân sự</title>
    <meta name="description" content="DDMQ.vn: Tư vấn doanh nghiệp tận tâm, thúc đẩy thành công của bạn thông qua hoạch định chiến lược và quản lý tăng trưởng.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">DDMQ.vn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Trang chủ</a></li>
                    <li class="nav-item"><a  a class="nav-link" href="#about">Về chúng tôi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#servicesModal">Dịch vụ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#departments">Phòng ban</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stats">Thống kê</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">Tin tức & Sự kiện</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="mailto:ddmq@gmail.com" class="me-3 text-white"><i class="bi bi-envelope"></i> ddmq@gmail.com</a>
                    <a href="tel:+84 8627516189" class="me-3 text-white"><i class="bi bi-telephone"></i> +84 862 7516 189</a>
                    <a href="login.php" class="btn btn-orange ms-2">Đăng nhập</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="hero pt-5 mt-5 hero-slideshow">
        <div class="hero-overlay">
            <h1 class="display-4 fw-bold mb-4">Về chúng tôi – Đơn vị tư vấn chiến lược dẫn lối thành công</h1>
            <p class="lead mb-4">Với hơn 15 năm kinh nghiệm, chúng tôi giúp doanh nghiệp phát triển mạnh mẽ thông qua các chiến lược đổi mới và dữ liệu chuyên sâu.</p>
            <a href="#about" class="btn btn-orange btn-lg">Tìm hiểu thêm</a>
        </div>
    </section>

    <section class="container py-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>100</h3><p>Doanh nghiệp tại Việt Nam</p></div></div>
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>1,360</h3><p>Dự án được hoàn thành</p></div></div>
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>85%</h3><p>Đạt được thành tựu</p></div></div>
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>15</h3><p>Năm kinh nghiệm</p></div></div>
        </div>
    </section>

    <section class="mission-vision" id="mission">
        <div class="container position-relative">
            <h2 class="text-center mb-5">Khám phá những nguyên tắc cốt lõi của chúng tôi</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="mv-card scroll-animate">
                        <img src="img/mission1.jpg" alt="Focused consultant at desk discussing strategies" class="img-fluid mb-3 rounded">
                        <h4>Sứ mệnh</h4>
                        <p>Sứ mệnh của chúng tôi là trao quyền cho doanh nghiệp bằng những thông tin chi tiết dựa trên dữ liệu và chiến lược tăng trưởng bền vững, biến thách thức thành cơ hội.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mv-card scroll-animate">
                        <img src="img/vision1.jpg" alt="Team brainstorming innovative solutions in a meeting" class="img-fluid mb-3 rounded">
                        <h4>Tầm nhìn</h4>
                        <p>Chúng tôi hướng đến một thế giới nơi mọi doanh nghiệp đều đạt được tiềm năng tối đa thông qua sự dẫn dắt chuyên nghiệp và các giải pháp sáng tạo.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4"><button class="play-btn">▶</button></div>
        </div>
    </section>

    <section id="about" class="container py-5 fade-in">
        <h2 class="text-center mb-5">Chúng tôi là ai</h2>
        <p class="lead text-center mb-5">DDMQ.vn là công ty tư vấn kinh doanh hàng đầu với khát vọng biến thách thức thành cơ hội. Thành lập năm 2010, chúng tôi đã phục vụ hơn 1.000 khách hàng ở nhiều lĩnh vực, mang lại kết quả đo lường được.</p>
        <div class="timeline">
            <div class="timeline-item scroll-animate"><h5>2010</h5><p>Thành lập</p></div>
            <div class="timeline-item scroll-animate"><h5>2015</h5><p>Mở rộng thị trường quốc tế</p></div>
            <div class="timeline-item scroll-animate"><h5>2020</h5><p>Đạt 97% sự hài lòng của khách hàng</p></div>
        </div>
        <div class="text-center mt-4"><a href="#" class="btn btn-orange">Khám phá thêm</a></div>
    </section>

    <section id="departments" class="container py-5 fade-in">
        <h2 class="text-center mb-5">Các phòng ban chuyên môn</h2>
        
        <?php
        // Lấy danh sách phòng ban từ DB
        $dept_query = $conn->query("SELECT * FROM departments");
        ?>

        <div class="dept-grid">
            <?php while($dept = $dept_query->fetch_assoc()): ?>
            <div class="dept-card scroll-animate">
                <img src="<?php echo $dept['image']; ?>" alt="<?php echo $dept['name']; ?>" class="img-fluid mb-3 rounded" style="height: 200px; object-fit: cover; width: 100%;">
                <h5><?php echo $dept['name']; ?></h5>
                <p><?php echo $dept['description']; ?></p>
                <a href="#" class="btn btn-orange btn-sm">Xem chi tiết</a>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section id="stats" class="achievements fade-in">
        <div class="container">
            <h2 class="text-center mb-5">Thành tựu nổi bật</h2>
            <div class="achievements-grid scroll-animate">
                <div class="achievement-box"><div class="number">680+</div><div class="description">+ Khách hàng</div></div>
                <div class="achievement-box"><div class="number">1354+</div><div class="description">Dự án hoàn thành</div></div>
                <div class="achievement-box"><div class="number">97%</div><div class="description">% Tỷ lệ hài lòng</div></div>
                <div class="achievement-box"><div class="number">15+</div><div class="description">Năm hoạt động</div></div>
                <div class="achievement-box"><div class="number">$50M+</div><div class="description">Doanh thu tạo ra cho khách</div></div>
            </div>
            <p class="text-center scroll-animate">Những cột mốc này phản ánh cam kết xuất sắc của chúng tôi.</p>
        </div>
    </section>
    
    <section class="sponsors-section fade-in">
        <div class="container py-4">
            <div class="sponsors-container">
                <div class="sponsors-marquee">
                    <div class="sponsor-logo"><img src="imgtaitro/VnEconomy.svg" alt="VnEconomy"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Vnexpress.svg" alt="VnExpress"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Cafebiz.svg" alt="Giáo Dục"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/apple.jpg" alt="apple"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/nvidia.jpg" alt="nvidia"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/samsung.jpg" alt="samsung"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/VnEconomy.svg" alt="VnEconomy"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Vnexpress.svg" alt="VnExpress"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Cafebiz.svg" alt="Giáo Dục"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/apple.jpg" alt="apple"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/nvidia.jpg" alt="nvidia"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/samsung.jpg" alt="samsung"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="news" class="container py-5 fade-in">
        <h2 class="text-center mb-5">Bản tin & Thông tin chi tiết hàng tuần</h2>
        
        <?php
        // Lấy tất cả tin tức mới nhất
        $news_query = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
        $news_items = [];
        while($row = $news_query->fetch_assoc()) {
            $news_items[] = $row;
        }
        // Chia tin tức thành từng nhóm 3 tin (để slide carousel)
        $news_chunks = array_chunk($news_items, 3);
        ?>

        <div id="newsCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php 
                $isActive = true;
                foreach($news_chunks as $chunk): 
                ?>
                <div class="carousel-item <?php echo $isActive ? 'active' : ''; $isActive = false; ?>">
                    <div class="news-grid">
                        <?php foreach($chunk as $news): ?>
                        <div class="news-card scroll-animate news-compact">
                            <img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>" class="img-fluid">
                            <div class="p-3 news-content">
                                <h5 class="news-title"><?php echo $news['title']; ?></h5>
                                <p class="small text-muted mb-1"><?php echo date('d M, Y', strtotime($news['created_at'])); ?></p>
                                <p class="small news-desc"><?php echo $news['summary']; ?></p>
                                <a href="#" class="btn btn-orange btn-sm news-btn">Đọc thêm</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Trước</span>
            </button>
            <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sau</span>
            </button>
        </div>
        <div class="text-center mt-4"><a href="#" class="read-more-btn">Xem tất cả tin tức</a></div>
    </section>

    <section class="cta-banner fade-in">
        <div class="container"></div>
    </section>

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
                        <a href="#home" class="icon-btn" title="Trang chủ"><i class="fas fa-home me-2"></i> Trang chủ</a>
                        <a href="#about" class="icon-btn" title="Về chúng tôi"><i class="fas fa-info-circle me-2"></i> Về chúng tôi</a>
                        <a href="https://youtube.com" class="icon-btn" target="_blank" title="YouTube"><i class="fab fa-youtube me-2"></i> YouTube</a>
                        <a href="https://facebook.com" class="icon-btn" target="_blank" title="Fanpage"><i class="fab fa-facebook me-2"></i> Fanpage</a>
                        <a href="#" class="icon-btn" title="Đăng nhập"><i class="fas fa-sign-in-alt me-2"></i> Đăng nhập</a>
                    </div>
                </div>
            </div>
            <hr class="divider mt-4 mb-4">
            <div class="text-center copyright"><p class="mb-0">&copy; 2025 ddmq. All Rights Reserved.</p></div>
        </div>
    </footer>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng Nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="login_process.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-orange w-100">Đăng Nhập</button>
                        
                        <div class="text-center mt-3">
                            <span class="small text-muted">Chưa có tài khoản?</span>
                            <a href="register.php" class="small fw-bold text-decoration-none">Đăng ký ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="servicesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dịch Vụ Của Chúng Tôi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="servicesAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#s1">Hoạch định chiến lược</button></h2>
                            <div id="s1" class="accordion-collapse collapse show" data-bs-parent="#servicesAccordion"><div class="accordion-body">Phát triển các chiến lược dài hạn toàn diện để gắn kết mục tiêu kinh doanh với cơ hội thị trường.</div></div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s2">Tối ưu hóa quy trình</button></h2>
                            <div id="s2" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion"><div class="accordion-body">Tinh giản vận hành để nâng cao hiệu quả, giảm chi phí và cải thiện hiệu suất tổng thể.</div></div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#s3">Quản lý sự thay đổi</button></h2>
                            <div id="s3" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion"><div class="accordion-body">Hướng dẫn tổ chức của bạn vượt qua các giai đoạn chuyển đổi với sự gián đoạn tối thiểu và sự thích nghi tối đa.</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>