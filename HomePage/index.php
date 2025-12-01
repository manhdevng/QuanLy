<?php
require_once 'db_connect.php'; // Kết nối database để lấy tin tức
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IELTS school</title>
    <meta name="description" content="Ielts school - Nơi cung cấp các khóa học IELTS chất lượng cao với đội ngũ giảng viên giàu kinh nghiệm và phương pháp giảng dạy hiện đại.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">IELTS school</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Về chúng tôi</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#servicesModal">Dịch vụ</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="#departments">Phòng ban</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stats">Thống kê</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">Tin tức & Sự kiện</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="mailto:Ieltsschool@gmail.com" class="me-3 text-white"><i class="bi bi-envelope"></i> Ieltschool@gmail.com</a>
                    <a href="tel:+84 8627516189" class="me-3 text-white"><i class="bi bi-telephone"></i> +84 862 7516 189</a>
                    <a href="login.php" class="btn btn-orange ms-2">Đăng nhập</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="hero hero-slideshow">
        <div class="hero-overlay">
            <div class="container">
                <h1 class="display-3 fw-bold mb-4 animate-hero-text">IELTS School – Đồng hành cùng học viên chinh phục IELTS 6.5+ dễ dàng</h1>
                <p class="lead mb-4 fs-5 animate-hero-text delay-1">Khi đó giảng viên không chỉ có nhiệm vụ truyền đạt kiến thức cho học viên hiểu, mà còn phải định hướng học viên cách tiếp cận với IELTS một cách rõ ràng nhưng thú vị và đơn giản hơn, tạo sự hứng thú trong quá trình học tập.</p>
                <a href="#about" class="btn btn-orange btn-lg px-5 py-3 animate-hero-text delay-2">Tìm hiểu thêm</a>
            </div>
        </div>
    </section>

    <!-- <section class="container py-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>100</h3><p>Doanh nghiệp tại Việt Nam</p></div></div>
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>1,360</h3><p>Dự án được hoàn thành</p></div></div>
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>85%</h3><p>Đạt được thành tựu</p></div></div>
            <div class="col-md-3"><div class="stats-card scroll-animate"><h3>15</h3><p>Năm kinh nghiệm</p></div></div>
        </div>
    </section> -->

    <section class="mission-vision" id="mission">
        <div class="container position-relative">
            <h2 class="text-center mb-5">Khám phá những nguyên tắc cốt lõi của chúng tôi</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="mv-card scroll-animate">
                        <img src="img/giangvien.jpg" alt="Focused consultant at desk discussing strategies" class="img-fluid mb-3 rounded">
                        <h4>Phương pháp giảng dạy độc quyền</h4>
                        <p>Chúng tôi tự hào mang đến phương pháp giảng dạy IELTS được nghiên cứu và phát triển bởi đội ngũ giáo viên có điểm số IELTS 8.0+ với nhiều năm kinh nghiệm.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mv-card scroll-animate">
                        <img src="img/achi.jpg" alt="Team brainstorming innovative solutions in a meeting" class="img-fluid mb-3 rounded">
                        <h4>Cam kết đầu ra rõ ràng</h4>
                        <p>IELTS School cam kết đồng hành cùng học viên đến khi đạt mục tiêu, với chính sách rõ ràng và minh bạch.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="text-center mt-4"><button class="play-btn">▶</button></div> -->
        </div>
    </section>

    <section id="about" class="container py-5 fade-in">
    <h2 class="text-center mb-5">Chúng tôi là ai</h2>
    <p class="lead text-center mb-5">IELTS school - Nơi cung cấp các khóa học IELTS chất lượng cao với đội ngũ giảng viên giàu kinh nghiệm và phương pháp giảng dạy hiện đại.</p>
    
    <div class="timeline">
        <div class="timeline-item scroll-animate">
            <h5>2015</h5>
            <p>Thành lập</p>
        </div>
        <div class="timeline-item scroll-animate">
            <h5>2020</h5>
            <p>Mở rộng nhiều cơ sở ở Việt Nam</p>
        </div>
        <div class="timeline-item scroll-animate">
            <h5>2025</h5>
            <p>Đạt trên 85% sự hài lòng của khách hàng</p>
        </div>
    </div>
</section>

    <section id="stats" class="achievements fade-in">
    <div class="container">
        <h2 class="text-center mb-5">Thành tựu nổi bật</h2>
        <div class="achievements-grid scroll-animate">
            <div class="achievement-box">
                <div class="number">0</div>
                <div class="description">Học viên đã đạt mục tiêu</div>
            </div>
            <div class="achievement-box">
                <div class="number">0</div>
                <div class="description">Tỷ lệ đạt điểm cam kết</div>
            </div>
            <div class="achievement-box">
                <div class="number">0</div>
                <div class="description">Là điểm IELTS trung bình</div>
            </div>
            <div class="achievement-box">
                <div class="number">0</div>
                <div class="description">Giáo viên đạt 7.5+ IELTS</div>
            </div>
            <div class="achievement-box">
                <div class="number">0</div>
                <div class="description">Năm kinh nghiệm đào tạo</div>
            </div>
        </div>
        <!-- ✅ PHẦN HỌC VIÊN ĐẠT KẾT QUẢ CAO - 4 HỌC VIÊN, MỖI SLIDE 1 NGƯỜI (ẢNH TRÁI, TEXT PHẢI) -->
        <div class="top-students-section scroll-animate mt-5">
            <h3 class="text-center mb-4 text-white">Học viên đạt kết quả cao</h3>
            <div id="topStudentsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Chỉ 4 học viên demo
                    $top_students = [
                        ['name' => 'Hà Văn Dũng', 'image' => 'img/students/student1.jpg', 'score' => '8.0', 'testimonial' => 'Cảm ơn IELTS School đã giúp tôi đạt band 8.0 chỉ trong 3 tháng! Phương pháp học hiệu quả và giáo viên tận tâm.'],
                        ['name' => 'Nguyễn Tiến Đạt', 'image' => 'img/students/student2.jpg', 'score' => '7.5', 'testimonial' => 'Phương pháp học thú vị, giáo viên tận tâm. Điểm Listening lên 9.0! Tôi rất hài lòng với lộ trình cá nhân hóa.'],
                        ['name' => 'Nguyễn Minh Quân', 'image' => 'img/students/student3.jpg', 'score' => '7.0', 'testimonial' => 'Từ 5.0 lên 7.0, nhờ lộ trình cá nhân hóa. Trung tâm đã đồng hành sát sao, giúp tôi tự tin hơn trong kỳ thi.'],
                        ['name' => 'Nguyễn Ngọc Mạnh', 'image' => 'img/students/student4.jpg', 'score' => '8.5', 'testimonial' => 'Tuyệt vời! Đã chinh phục Writing band 8.5. Cảm ơn đội ngũ giảng viên đã truyền cảm hứng học tập cho tôi.']
                    ];
                    $isActive = true;
                    foreach($top_students as $student): ?>
                    <div class="carousel-item <?php echo $isActive ? 'active' : ''; $isActive = false; ?>">
                        <div class="container">
                            <div class="row align-items-center student-slide">
                                <div class="col-md-6 text-center mb-3 mb-md-0">
                                    <img src="<?php echo $student['image']; ?>" alt="<?php echo $student['name']; ?>" class="img-fluid rounded-circle student-image">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3"><?php echo $student['name']; ?></h5>
                                    <p class="fw-bold text-orange mb-3 fs-4">IELTS <?php echo $student['score']; ?></p>
                                    <p class="lead"><?php echo $student['testimonial']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#topStudentsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Trước</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#topStudentsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sau</span>
                </button>
            </div>
        </div>
    </div>
</section>

    <section id="departments" class="container py-5 fade-in">
    <h2 class="text-center mb-5">Các phòng ban chuyên môn</h2>
    
    <?php
    // Lấy danh sách phòng ban từ DB
    $dept_query = $conn->query("SELECT * FROM departments");
    $all_departments = [];
    while($dept = $dept_query->fetch_assoc()) {
        $all_departments[] = $dept;
    }
    $total_depts = count($all_departments);
    ?>

    <div class="dept-grid">
        <?php 
        // ✅ CHỈ HIỂN THỊ 4 PHÒNG BAN ĐẦU TIÊN
        for($i = 0; $i < min(4, $total_depts); $i++): 
            $dept = $all_departments[$i];
        ?>
        <div class="dept-card scroll-animate">
            <img src="<?php echo $dept['image']; ?>" alt="<?php echo $dept['name']; ?>" class="img-fluid mb-3 rounded">
            <h5><?php echo $dept['name']; ?></h5>
            <p><?php echo $dept['description']; ?></p>
            <a href="#" class="btn btn-orange btn-sm">Xem chi tiết</a>
        </div>
        <?php endfor; ?>
    </div>

    <?php if($total_depts > 4): ?>
    <!-- ✅ NÚT XEM THÊM (nếu có hơn 4 phòng ban) -->
    <div class="text-center mt-4">
        <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#allDepartmentsModal">
            Xem tất cả phòng ban (<?php echo $total_depts; ?>)
        </button>
    </div>
    <?php endif; ?>
</section>

<!-- ✅ MODAL HIỂN THỊ TẤT CẢ PHÒNG BAN -->
<div class="modal fade" id="allDepartmentsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tất cả các phòng ban chuyên môn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="dept-grid">
                    <?php foreach($all_departments as $dept): ?>
                    <div class="dept-card">
                        <img src="<?php echo $dept['image']; ?>" alt="<?php echo $dept['name']; ?>" class="img-fluid mb-3 rounded">
                        <h5><?php echo $dept['name']; ?></h5>
                        <p><?php echo $dept['description']; ?></p>
                        <a href="#" class="btn btn-orange btn-sm">Xem chi tiết</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    
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