// CHỨC NĂNG CƠ BẢN (Smooth Scrolling & Scroll Animation Observer)

// Smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({ behavior: "smooth" });
    }
  });
});

// Scroll Animation Observer (cho các phần tử có class .scroll-animate)
const scrollObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        // Add animate class for staggered effect
        setTimeout(() => {
          entry.target.classList.add("animate");
        }, index * 100); // Delay based on index for stagger
        // Giữ lại observer để các phần tử scroll-animate khác tiếp tục được quan sát
        // Nếu muốn hiệu ứng chỉ chạy 1 lần, hãy thêm logic unobserve ở đây.
      }
    });
  },
  { threshold: 0.1 }
);

// Observe all scroll-animate elements
document.querySelectorAll(".scroll-animate").forEach((el) => {
  scrollObserver.observe(el);
});

// HIỆU ỨNG ĐẾM SỐ LIỆU CHO PHẦN 'Our Key Achievements'
function animateValue(obj, start, end, duration) {
  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);

    let displayValue;
    const rawEndValue = parseFloat(end.replace(/[^0-9.]/g, "")); // Lấy giá trị số (ví dụ: 680, 1354, 97)

    if (end.includes(".")) {
      // Xử lý số thập phân nếu cần
      displayValue = (progress * rawEndValue).toFixed(1);
    } else {
      displayValue = Math.floor(progress * rawEndValue).toLocaleString("en-US"); // Thêm dấu phẩy cho số lớn
    }

    // Thêm lại dấu '+' hoặc '%' vào cuối
    if (end.includes("+")) {
      displayValue += "+";
    } else if (end.includes("%")) {
      displayValue += "%";
    }

    obj.textContent = displayValue;

    if (progress < 1) {
      window.requestAnimationFrame(step);
    } else {
      // Đảm bảo giá trị cuối cùng chính xác
      obj.textContent = end;
    }
  };
  window.requestAnimationFrame(step);
}

function startCounterObserver() {
  // Chỉ chạy hàm này một lần
  let hasAnimated = false;

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        // entry.target là phần tử .achievements-grid
        if (entry.isIntersecting && !hasAnimated) {
          // Lấy tất cả các thẻ .number
          const counterElements = entry.target.querySelectorAll(".number");

          // Định nghĩa các số liệu tĩnh (cần khớp với HTML)
          const stats = [
            {
              element: counterElements[0],
              end: "680+",
              start: 0,
              duration: 3000,
            },
            {
              element: counterElements[1],
              end: "1354+",
              start: 0,
              duration: 3500,
            },
            {
              element: counterElements[2],
              end: "97%",
              start: 0,
              duration: 3600,
            },
            {
              element: counterElements[3],
              end: "15+",
              start: 0,
              duration: 3700,
            },
            {
              element: counterElements[4],
              end: "$50M+",
              start: 0,
              duration: 4000,
            },
          ];

          stats.forEach((stat) => {
            animateValue(stat.element, stat.start, stat.end, stat.duration);
          });

          hasAnimated = true; // Đánh dấu đã chạy
          observer.unobserve(entry.target); // Ngừng theo dõi
        }
      });
    },
    {
      threshold: 0.5, // Kích hoạt khi 50% phần tử nằm trong viewport
    }
  );

  // Bắt đầu theo dõi phần tử cha: .achievements-grid
  const achievementsGrid = document.querySelector(".achievements-grid");
  if (achievementsGrid) {
    observer.observe(achievementsGrid);
  }
}

// Chạy hàm observer đếm số khi DOM đã tải xong
document.addEventListener("DOMContentLoaded", startCounterObserver);

// =======================================================
// XỬ LÝ FORM VÀ SLIDESHOW CƠ BẢN
// =======================================================

// ĐÃ XÓA PHẦN MOCK LOGIN ĐỂ PHP XỬ LÝ

// Pause slideshow khi hover
document.addEventListener("DOMContentLoaded", () => {
  const heroSlideshow = document.querySelector(".hero-slideshow");
  if (heroSlideshow) {
    heroSlideshow.addEventListener("mouseenter", function () {
      this.style.animationPlayState = "paused";
    });
    heroSlideshow.addEventListener("mouseleave", function () {
      this.style.animationPlayState = "running";
    });
  }
});
