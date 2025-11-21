// Dữ liệu khóa học
const coursesData = {
    course1: { image: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400", badge: "LOREM IPSUM", title: "Ut Sed Eros - Khóa học nấu ăn", description: "Học cách nấu những món ăn ngon và bổ dưỡng từ các đầu bếp chuyên nghiệp.", rating: 5, price: "$ 450" },
    course2: { image: "https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400", badge: "LOREM IPSUM", title: "Ormartur Sagittis - Món tráng miệng", description: "Khám phá thế giới bánh ngọt và các món tráng miệng hấp dẫn.", rating: 4, price: "$ 380" },
    course3: { image: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400", badge: "COOKING PRO", title: "Quistelus Advieront - Ẩm thực Á", description: "Thành thạo các món ăn Á Đông với hương vị đậm đà truyền thống.", rating: 5, price: "$ 520" },
    course4: { image: "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400", badge: "ITALIAN STYLE", title: "Cur Socion Sit - Pizza & Pasta", description: "Học cách làm pizza và pasta đúng chuẩn Ý từ các bậc thầy.", rating: 5, price: "$ 490" },
    course5: { image: "https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400", badge: "HEALTHY FOOD", title: "Vestilum IT Ibique - Ăn sạch", description: "Khóa học về dinh dưỡng và cách chế biến thực phẩm lành mạnh.", rating: 4, price: "$ 410" },
    course6: { image: "https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400", badge: "SEAFOOD", title: "Ut Sed Eleos - Hải sản cao cấp", description: "Nấu các món hải sản tươi ngon với kỹ thuật chuyên nghiệp.", rating: 5, price: "$ 580" },
    course7: { image: "https://images.unsplash.com/photo-1559339352-11d035aa65de?w=400", badge: "BBQ MASTER", title: "Vestlibum IT Ibisque - Nướng BBQ", description: "Trở thành chuyên gia nướng với các công thức BBQ đỉnh cao.", rating: 5, price: "$ 460" },
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