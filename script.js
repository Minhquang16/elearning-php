// Dữ liệu khóa học
const coursesData = {
    course1: { image: "https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400", badge: "Course C", title: "C Programming - Complete Beginner Course", description: "Learn the core concepts of C through simple, hands-on exercises and mini projects.", rating: 5, price: "$ 450" },
    course2: { image: "./uploads/IMAGE/C++.png", badge: "Course C++", title: "C++ OOP – Object-Oriented Programming", description: "Get started with object-oriented programming in C++ using clear, practical examples.", rating: 4, price: "$ 380" },
    course3: { image: "./uploads/IMAGE/PHP.png", badge: "Course PHP", title: "PHP Fundamentals", description: "Learn how to build dynamic websites and basic back-end logic with PHP.", rating: 5, price: "$ 520" },
    course4: { image: "./uploads/IMAGE/CSS.png", badge: "Course CSS", title: "HTML & CSS Basics", description: "Master the foundations of modern web page layout with HTML and CSS.", rating: 5, price: "$ 490" },
    course5: { image: "./uploads/IMAGE/Java.png", badge: "Course Java", title: "JavaScript for Beginners", description: "Discover how to make your web pages interactive using beginner-friendly JavaScript.", rating: 4, price: "$ 410" },
    course6: { image: "./uploads/IMAGE/py.jpeg", badge: "Course Py" , title: "Python Core", description: "Learn Python from scratch with clear explanations and practical coding tasks.", rating: 5, price: "$ 580" },
    course7: { image: "./uploads/IMAGE/Java1.png", badge: "Course JavaPR", title: "Java Programming", description: "Build a solid Java foundation through real-world examples and guided exercises.", rating: 5, price: "$ 460" },
};

// Hàm tạo sao đánh giá
function createStars(rating) {
    let starsHTML = '';
    for (let i = 0; i < 5; i++) {
        if (i < rating) {
            starsHTML += '<span class="star">⭐</span>';
        } else {
            starsHTML += '<span class="star" style="opacity: 0.3">⭐</span>';
        }
    }
    return starsHTML;
}

// Hàm cập nhật thông tin và định vị form
function updateAndPositionCard(courseId, targetPill) {
    const course = coursesData[courseId];
    if (!course) return;

    const card = document.getElementById('course-card-single');
    const pillsContainer = document.getElementById('pills-container');
    if (!card || !pillsContainer) return;
    
    // 1. Định vị Card: Chèn card ngay sau pill được nhấp
    // Tìm vị trí sau pill được nhấp
    const nextPill = targetPill.nextElementSibling;
    
    if (nextPill) {
        // Chèn card trước pill kế tiếp
        pillsContainer.insertBefore(card, nextPill);
    } else {
        // Nếu là pill cuối cùng, chèn xuống cuối container
        pillsContainer.appendChild(card);
    }
    
    // 2. Cập nhật Nội dung (Không còn dùng ID số)
    const image = document.getElementById('course-image');
    const badge = document.getElementById('course-badge');
    const title = document.getElementById('course-title');
    const desc = document.getElementById('course-desc');
    const rating = document.getElementById('course-rating');
    const price = document.getElementById('course-price');
    
    // Áp dụng animation cho nội dung trước khi cập nhật
    [image, title, desc].forEach(el => el ? el.style.opacity = '0' : null);
    
    setTimeout(() => {
        if (image) image.src = course.image;
        if (badge) badge.textContent = course.badge;
        if (title) title.textContent = course.title;
        if (desc) desc.textContent = course.description;
        if (rating) rating.innerHTML = createStars(course.rating);
        if (price) price.textContent = course.price;

        // Trả lại opacity cho nội dung
        [image, title, desc].forEach(el => el ? el.style.opacity = '1' : null);
    }, 150);


    // 3. Hiển thị Card
    // Dùng setTimeout để đảm bảo card đã được di chuyển trước khi hiển thị mượt mà
    setTimeout(() => {
        card.classList.add('visible');
    }, 50);

    // Tùy chọn: Cuộn tới vị trí của card
    card.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Khởi tạo sự kiện khi DOM load xong
document.addEventListener('DOMContentLoaded', function() {
    const pills = document.querySelectorAll('.pill[data-course]');
    
    pills.forEach(pill => {
        pill.addEventListener('click', function() {
            const currentPill = this;
            const courseId = currentPill.getAttribute('data-course');
            
            // Xóa class active khỏi tất cả pills 
            pills.forEach(p => p.classList.remove('active'));
            
            // Thêm class active cho pill được chọn
            currentPill.classList.add('active');

            // Cập nhật thông tin, định vị và hiển thị card
            updateAndPositionCard(courseId, currentPill);
        });
    });

    // Thêm hiệu ứng hover mượt mà
    pills.forEach(pill => {
        pill.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
});