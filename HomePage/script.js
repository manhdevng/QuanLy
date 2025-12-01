// =======================================================
// CHỨC NĂNG CƠ BẢN
// =======================================================

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

// Scroll Animation Observer
const scrollObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        setTimeout(() => {
          entry.target.classList.add("animate");
        }, index * 100);
      }
    });
  },
  { threshold: 0.1 }
);

document.querySelectorAll(".scroll-animate").forEach((el) => {
  scrollObserver.observe(el);
});

// =======================================================
// HIỆU ỨNG ĐẾM SỐ - PHẦN THÀNH TỰU
// =======================================================

function animateCounter(element, endValue, duration) {
  const startTime = performance.now();
  
  // Tách số và ký tự đặc biệt
  const hasPercent = endValue.includes("%");
  const hasPlus = endValue.includes("+");
  const hasDot = endValue.includes(".");
  
  // Lấy số thuần túy
  const targetNumber = parseFloat(endValue.replace(/[^0-9.]/g, ""));
  
  function update(currentTime) {
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);
    
    // Tính giá trị hiện tại
    let currentValue = progress * targetNumber;
    
    // Format số
    let displayText;
    if (hasDot) {
      displayText = currentValue.toFixed(1);
    } else {
      displayText = Math.floor(currentValue).toString();
    }
    
    // Thêm ký tự đặc biệt
    if (hasPlus) displayText += "+";
    if (hasPercent) displayText += "%";
    
    element.textContent = displayText;
    
    // Tiếp tục animation
    if (progress < 1) {
      requestAnimationFrame(update);
    } else {
      element.textContent = endValue; // Đảm bảo giá trị cuối chính xác
    }
  }
  
  requestAnimationFrame(update);
}

// Observer để kích hoạt animation khi scroll đến
function initCounterAnimation() {
  let hasAnimated = false;
  
  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting && !hasAnimated) {
          console.log("🎯 Counter animation triggered!");
          
          const numbers = entry.target.querySelectorAll(".number");
          
          // Dữ liệu IELTS
          const stats = [
            { value: "2005+", duration: 2500 },
            { value: "89%", duration: 2000 },
            { value: "6.5+", duration: 2500 },
            { value: "24+", duration: 2500 },
            { value: "10+", duration: 2000 }
          ];
          
          // Bắt đầu animation cho từng số
          numbers.forEach((num, index) => {
            if (stats[index]) {
              setTimeout(() => {
                animateCounter(num, stats[index].value, stats[index].duration);
              }, index * 100); // Delay mỗi số 100ms
            }
          });
          
          hasAnimated = true;
          counterObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.3 }
  );
  
  // Bắt đầu observe
  const grid = document.querySelector(".achievements-grid");
  if (grid) {
    console.log("✅ Found achievements grid, observing...");
    counterObserver.observe(grid);
  } else {
    console.error("❌ Cannot find .achievements-grid element!");
  }
}

// =======================================================
// SLIDESHOW HERO - Cải thiện với pause on hover
// =======================================================

const heroSlideshow = document.querySelector(".hero-slideshow");
if (heroSlideshow) {
  heroSlideshow.addEventListener("mouseenter", function () {
    this.style.animationPlayState = "paused";
  });
  heroSlideshow.addEventListener("mouseleave", function () {
    this.style.animationPlayState = "running";
  });
}

// =======================================================
// KHỞI ĐỘNG KHI DOM LOADED
// =======================================================

document.addEventListener("DOMContentLoaded", function() {
  console.log("✅ DOM Loaded");
  initCounterAnimation();
});