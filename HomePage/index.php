<?php
// Không cần require db_connect.php nữa vì hard-code
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
            <h2 class="text-center mb-5">KHÁM PHÁ NHỮNG NGUYÊN TẮC CỐT LÕI CỦA CHÚNG TÔI</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="mv-card scroll-animate">
                        <img src="img/giangvien.jpg" alt="Focused consultant at desk discussing strategies" class="img-fluid mb-3 rounded" onerror="this.src='https://via.placeholder.com/300x200?text=Giảng+Viên';">
                        <h4>Phương pháp giảng dạy độc quyền</h4>
                        <p>Chúng tôi tự hào mang đến phương pháp giảng dạy IELTS được nghiên cứu và phát triển bởi đội ngũ giáo viên có điểm số IELTS 8.0+ với nhiều năm kinh nghiệm.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mv-card scroll-animate">
                        <img src="img/achi.jpg" alt="Team brainstorming innovative solutions in a meeting" class="img-fluid mb-3 rounded" onerror="this.src='https://via.placeholder.com/300x200?text=Thành+Tựu';">
                        <h4>Cam kết đầu ra rõ ràng</h4>
                        <p>IELTS School cam kết đồng hành cùng học viên đến khi đạt mục tiêu, với chính sách rõ ràng và minh bạch.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="text-center mt-4"><button class="play-btn">▶</button></div> -->
        </div>
    </section>

    <section id="about" class="container py-5 fade-in">
    <h2 class="text-center mb-5">CHÚNG TÔI LÀ AI ?</h2>
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
        <h2 class="text-center mb-5">THÀNH TỰU NỔI BẬT</h2>
        <div class="achievements-grid scroll-animate">
            <div class="achievement-box">
                <div class="number" data-target="5000">0</div>
                <div class="description">Học viên đã đạt mục tiêu</div>
            </div>
            <div class="achievement-box">
                <div class="number" data-target="95">0</div>
                <div class="description">Tỷ lệ đạt điểm cam kết</div>
            </div>
            <div class="achievement-box">
                <div class="number" data-target="7.2">0</div>
                <div class="description">Là điểm IELTS trung bình</div>
            </div>
            <div class="achievement-box">
                <div class="number" data-target="50">0</div>
                <div class="description">Giáo viên đạt 7.5+ IELTS</div>
            </div>
            <div class="achievement-box">
                <div class="number" data-target="10">0</div>
                <div class="description">Năm kinh nghiệm đào tạo</div>
            </div>
        </div>
        <!-- ✅ PHẦN HỌC VIÊN ĐẠT KẾT QUẢ CAO - 4 HỌC VIÊN, MỖI SLIDE 1 NGƯỜI (ẢNH TRÁI, TEXT PHẢI) -->
        <div class="top-students-section scroll-animate mt-5">
            <h3 class="text-center mb-4 text-white">HỌC VIÊN ĐẠT KẾT QUẢ CAO</h3>
            <div id="topStudentsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Chỉ 4 học viên demo
                    $top_students = [
                        ['name' => 'Hà Văn Dũng', 'image' => 'img/dung.jpg', 'score' => '8.0', 'testimonial' => 'Cảm ơn IELTS School đã giúp tôi đạt band 8.0 chỉ trong 3 tháng! Phương pháp học hiệu quả và giáo viên tận tâm.'],
                        ['name' => 'Nguyễn Tiến Đạt', 'image' => 'img/dat.jpg', 'score' => '7.5', 'testimonial' => 'Phương pháp học thú vị, giáo viên tận tâm. Điểm Listening lên 9.0! Tôi rất hài lòng với lộ trình cá nhân hóa.'],
                        ['name' => 'Nguyễn Minh Quân', 'image' => 'img/quan.jpg', 'score' => '7.0', 'testimonial' => 'Từ 5.0 lên 7.0, nhờ lộ trình cá nhân hóa. Trung tâm đã đồng hành sát sao, giúp tôi tự tin hơn trong kỳ thi.'],
                        ['name' => 'Nguyễn Ngọc Mạnh', 'image' => 'img/manh.jpg', 'score' => '8.5', 'testimonial' => 'Tuyệt vời! Đã chinh phục Writing band 8.5. Cảm ơn đội ngũ giảng viên đã truyền cảm hứng học tập cho tôi.']
                    ];
                    $isActive = true;
                    foreach($top_students as $student): ?>
                    <div class="carousel-item <?php echo $isActive ? 'active' : ''; $isActive = false; ?>">
                        <div class="container">
                            <div class="row align-items-center student-slide">
                                <div class="col-md-6 text-center mb-3 mb-md-0">
                                    <img src="<?php echo $student['image']; ?>" alt="<?php echo $student['name']; ?>" class="img-fluid rounded-circle student-image" onerror="this.src='https://via.placeholder.com/200?text=<?php echo urlencode($student['name']); ?>';">
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
    <h2 class="text-center mb-5">CÁC PHÒNG BAN CHUYÊN MÔN</h2>
    
    <!-- Hard-code 4 phòng ban đầu tiên với link chi tiết -->
    <div class="dept-grid">
        <!-- Card 1: Marketing -->
        <div class="dept-card scroll-animate">
            <img src="img/Strategy.jpg" alt="Phòng Marketing" class="img-fluid mb-3 rounded" onerror="this.src='https://via.placeholder.com/300x200?text=Marketing';">
            <h5>Phòng Marketing</h5>
            <p>Quảng bá thông tin và Tuyển sinh online.</p>
            <a href="departments/marketing.php?id=1" class="btn btn-orange btn-sm">Xem chi tiết</a>
        </div>

        <!-- Card 2: Hành chính -->
        <div class="dept-card scroll-animate">
            <img src="img/Finance.jpg" alt="Hành Chính - Kế Toán" class="img-fluid mb-3 rounded" onerror="this.src='https://via.placeholder.com/300x200?text=Hành+Chính';">
            <h5>Hành Chính - Kế Toán</h5>
            <p>Quản lý nhân sự, Thực chi và Cơ sở.</p>
            <a href="departments/hanhchinh.php?id=2" class="btn btn-orange btn-sm">Xem chi tiết</a>
        </div>

        <!-- Card 3: Đào Tạo -->
        <div class="dept-card scroll-animate">
            <img src="img/vision1.jpg" alt="Phòng Đào Tạo" class="img-fluid mb-3 rounded" onerror="this.src='https://via.placeholder.com/300x200?text=Đào+Tạo';">
            <h5>Phòng Đào Tạo</h5>
            <p>Quản lý học viên và Chất lượng.</p>
            <a href="departments/daotao.php?id=3" class="btn btn-orange btn-sm">Xem chi tiết</a>
        </div>

        <!-- Card 4: Tuyển Sinh -->
        <div class="dept-card scroll-animate">
            <img src="img/Operations.jpg" alt="Phòng Tuyển Sinh" class="img-fluid mb-3 rounded" onerror="this.src='https://via.placeholder.com/300x200?text=Tuyển+Sinnh';">
            <h5>Phòng Tuyển Sinh</h5>
            <p>Tư vấn khóa học và Telesales.</p>
            <a href="departments/tuyensinh.php?id=4" class="btn btn-orange btn-sm">Xem chi tiết</a>
        </div>
    </div>

    <!-- Nút xem tất cả (hard-code số 5 nếu có phòng 5) -->
    <div class="text-center mt-4">
        <a href="departments/full_departments.php" class="btn btn-orange">Xem tất cả phòng ban (5)</a>
    </div>
</section>

<!-- Modal hiển thị tất cả phòng ban (hard-code nếu cần, hoặc link ra trang riêng) -->
<!-- Ở đây giữ modal đơn giản, nhưng vì hard-code, bạn có thể thay bằng link ra full_departments.php nếu muốn -->

    <section class="sponsors-section fade-in">
        <div class="container py-4">
            <div class="sponsors-container">
                <div class="sponsors-marquee">
                    <div class="sponsor-logo"><img src="imgtaitro/VnEconomy.svg" alt="VnEconomy" onerror="this.src='https://via.placeholder.com/150x50?text=VnEconomy';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Vnexpress.svg" alt="VnExpress" onerror="this.src='https://via.placeholder.com/150x50?text=VnExpress';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Cafebiz.svg" alt="Giáo Dục" onerror="this.src='https://via.placeholder.com/150x50?text=Cafebiz';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/apple.jpg" alt="apple" onerror="this.src='https://via.placeholder.com/150x50?text=Apple';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/nvidia.jpg" alt="nvidia" onerror="this.src='https://via.placeholder.com/150x50?text=NVIDIA';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/samsung.jpg" alt="samsung" onerror="this.src='https://via.placeholder.com/150x50?text=Samsung';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/VnEconomy.svg" alt="VnEconomy" onerror="this.src='https://via.placeholder.com/150x50?text=VnEconomy';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Vnexpress.svg" alt="VnExpress" onerror="this.src='https://via.placeholder.com/150x50?text=VnExpress';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/Cafebiz.svg" alt="Giáo Dục" onerror="this.src='https://via.placeholder.com/150x50?text=Cafebiz';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/apple.jpg" alt="apple" onerror="this.src='https://via.placeholder.com/150x50?text=Apple';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/nvidia.jpg" alt="nvidia" onerror="this.src='https://via.placeholder.com/150x50?text=NVIDIA';"></div>
                    <div class="sponsor-logo"><img src="imgtaitro/samsung.jpg" alt="samsung" onerror="this.src='https://via.placeholder.com/150x50?text=Samsung';"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="news" class="container py-5 fade-in">
        <h2 class="text-center mb-5">BẢN TIN & THÔNG TIN CHI TIẾT HÀNG TUẦN</h2>
        
        <?php
        // Hard-code 6 tin tức mẫu (chia thành chunks 3 cho carousel, ngày cập nhật theo 01/12/2025)
        $news_items = [
            [
                'title' => 'Khai giảng khóa mới K15',
                'date' => '01 Dec, 2025',
                'summary' => 'Chào đón học viên K15. Khởi đầu hành trình chinh phục IELTS với phương pháp hiện đại.',
                'image' => 'img/khaigiang.jpg' // Placeholder, thay bằng ảnh thật
            ],
            [
                'title' => 'Hội thảo giảng dạy 4.0',
                'date' => '30 Nov, 2025',
                'summary' => 'Áp dụng AI vào học tập. Cập nhật xu hướng mới nhất cho giáo viên và học viên.',
                'image' => 'img/hoithao.jpg'
            ],
            [
                'title' => 'Học viên đạt band 8.0',
                'date' => '25 Nov, 2025',
                'summary' => 'Câu chuyện thành công từ khóa học Speaking. Chia sẻ kinh nghiệm từ top học viên.',
                'image' => 'img/datband.jpg'
            ],
            [
                'title' => 'Sự kiện tuyển sinh online',
                'date' => '20 Nov, 2025',
                'summary' => 'Giảm 20% học phí cho đăng ký sớm. Đăng ký ngay để nhận tư vấn miễn phí.',
                'image' => 'img/tuyensinh.jpg'
            ],
            [
                'title' => 'Workshop Writing IELTS',
                'date' => '15 Nov, 2025',
                'summary' => 'Hướng dẫn viết Task 2 hiệu quả. Tham gia miễn phí với chuyên gia band 8.5.',
                'image' => 'img/workshop.jpg'
            ],
            [
                'title' => 'Cập nhật chương trình học',
                'date' => '10 Nov, 2025',
                'summary' => 'Tích hợp module Listening mới dựa trên đề thi thật 2025.',
                'image' => 'img/chuongtrinh.jpg'
            ]
        ];
        $news_chunks = array_chunk($news_items, 3); // Chia 3 tin/slide
        ?>

        <div id="newsCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php $isActive = true; foreach($news_chunks as $chunk): ?>
                <div class="carousel-item <?php echo $isActive ? 'active' : ''; $isActive = false; ?>">
                    <div class="news-grid">
                        <?php foreach($chunk as $news): ?>
                        <div class="news-card scroll-animate news-compact">
                            <img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>" class="img-fluid" onerror="this.src='https://via.placeholder.com/300x200?text=<?php echo urlencode($news['title']); ?>';">
                            <div class="p-3 news-content">
                                <h5 class="news-title"><?php echo $news['title']; ?></h5>
                                <p class="small text-muted mb-1"><?php echo $news['date']; ?></p>
                                <p class="small news-desc"><?php echo $news['summary']; ?></p>
                                <a href="news/news<?php echo array_search($news, $news_items) + 1; ?>.php" class="btn btn-orange btn-sm news-btn">Đọc thêm</a>
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
        <div class="text-center mt-4"><a href="news/full_news.php" class="read-more-btn">Xem tất cả tin tức</a></div>
    </section>

    <section class="cta-banner fade-in">
        <div class="container"></div>
    </section>

    <!-- Footer redesigned (giống IELTS Mentor: Multi-column, social icons, course list, contact) -->
<footer class="footer-mentor bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <!-- Logo and Follow Us -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="logo-section">
                    <img src="images/logo-ielts-school.png" alt="IELTS School" class="mb-3" style="max-width: 150px;" onerror="this.src='https://via.placeholder.com/150x50?text=IELTS+School';"> <!-- Thay bằng logo thật -->
                    <h5 class="fw-bold mb-3">IELTS School</h5>
                    <p class="small mb-3">Trường Anh ngữ chất lượng cao với đội ngũ giảng viên giàu kinh nghiệm và phương pháp giảng dạy hiện đại.</p>
                    <!-- Follow Us Icons -->
                    <div class="social-icons d-flex gap-2">
                        <a href="https://facebook.com" class="text-white p-2 bg-primary rounded-circle"><i class="fab fa-facebook-f fs-5"></i></a>
                        <a href="https://youtube.com" class="text-white p-2 bg-danger rounded-circle"><i class="fab fa-youtube fs-5"></i></a>
                        <a href="https://instagram.com" class="text-white p-2 bg-gradient rounded-circle" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);"><i class="fab fa-instagram fs-5"></i></a>
                        <a href="https://tiktok.com" class="text-white p-2 bg-black rounded-circle"><i class="fab fa-tiktok fs-5"></i></a>
                        <a href="https://zalo.me" class="text-white p-2 bg-green rounded-circle"><i class="fab fa-whatsapp fs-5"></i></a> <!-- Icon Zalo tương tự WhatsApp -->
                    </div>
                </div>
            </div>

            <!-- Column 1: Danh sách khóa học -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Danh sách khóa học</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Khóa Basic</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Khóa Tiếng cao cấp</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Pre IELTS</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">IELTS 3.5-4.5</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">IELTS 4.5-5.5</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">IELTS 5.5-6.5+</a></li>
                </ul>
            </div>

            <!-- Column 2: Catalog -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Catalog</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Catalogue khóa học</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Giáo viên</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Cơ sở vật chất</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Chính sách học phí</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Học bổng</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Đăng ký</a></li>
                </ul>
            </div>

            <!-- Column 3: Blog for Mentee -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">Blog </h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Sử dụng app học viên</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Blog</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Chia sẻ kinh nghiệm</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Tips ôn IELTS</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Câu chuyện thành công</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Hỏi đáp</a></li>
                </ul>
            </div>
        </div>

        <!-- Contact Info Row -->
        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h5 class="fw-bold mb-3">Thông Tin Liên Hệ</h5>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><i class="fas fa-map-marker-alt text-orange me-2"></i>Địa chỉ: Ô diên , Hà Nội</li>
                    <li class="mb-2"><i class="fas fa-phone text-orange me-2"></i>Điện thoại: +84 862 751 689</li>
                    <li class="mb-2"><i class="fas fa-envelope text-orange me-2"></i>Email: ieltschool@gmail.com</li>
                    <li class="mb-2"><i class="fas fa-clock text-orange me-2"></i>Giờ làm việc: Thứ 2 - Thứ 6, 9:00 - 18:00</li>
                </ul>
            </div>
            <div class="col-lg-6 text-end">
                <h5 class="fw-bold mb-3">Kết Nối Với Chúng Tôi</h5>
                <div class="social-icons d-flex justify-content-end gap-2">
                    <a href="index.php#home" class="btn btn-outline-light btn-sm"><i class="fas fa-home me-1"></i> Trang chủ</a>
                    <a href="index.php#about" class="btn btn-outline-light btn-sm"><i class="fas fa-info-circle me-1"></i> Về chúng tôi</a>
                    <a href="https://youtube.com" class="btn btn-danger btn-sm"><i class="fab fa-youtube me-1"></i> YouTube</a>
                    <a href="https://facebook.com" class="btn btn-primary btn-sm"><i class="fab fa-facebook me-1"></i> Fanpage</a>
                    <a href="login.php" class="btn btn-orange btn-sm"><i class="fas fa-sign-in-alt me-1"></i> Đăng nhập</a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0 small">&copy; 2025 IELTS School. All Rights Reserved. | Designed by ddmq</p>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        // Animate numbers in stats section (nếu chưa có trong script.js)
        document.addEventListener('DOMContentLoaded', function() {
            const numbers = document.querySelectorAll('.number');
            numbers.forEach(number => {
                const target = parseFloat(number.getAttribute('data-target'));
                const increment = target / 100; // Tốc độ animate
                let current = 0;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.textContent = current.toFixed(target % 1 === 0 ? 0 : 1); // Định dạng số
                }, 20);
            });
        });
    </script>
</body>
</html>