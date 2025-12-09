<?php
// admin/dashboard.php
session_start();
require_once __DIR__ . '/../config/database.php';

// Bảo vệ: chỉ admin mới vào được
if (
    !isset($_SESSION['user']) ||
    ($_SESSION['user']['role'] ?? 'user') !== 'admin'
) {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

/* ================== THỐNG KÊ CHÍNH ================== */

// Doanh thu + số đơn
$stats = [
    'revenue' => 0,
    'orders'  => 0,
    'courses' => 0,
    'students'=> 0,
];

if ($result = $db->query("SELECT COALESCE(SUM(total_amount),0) AS revenue,
                                 COUNT(*) AS orders
                          FROM orders")) {
    $row = $result->fetch_assoc();
    $stats['revenue'] = (float)$row['revenue'];
    $stats['orders']  = (int)$row['orders'];
}

// Số khóa học
if ($result = $db->query("SELECT COUNT(*) AS c FROM courses")) {
    $row = $result->fetch_assoc();
    $stats['courses'] = (int)$row['c'];
}

// Số học viên (user thường)
if ($result = $db->query("SELECT COUNT(*) AS c FROM users WHERE role = 'user'")) {
    $row = $result->fetch_assoc();
    $stats['students'] = (int)$row['c'];
}

/* ================== ĐƠN GẦN ĐÂY ================== */
$recentOrders = [];
$sqlRecent = "
    SELECT id, full_name, total_amount, payment_method, created_at
    FROM orders
    ORDER BY created_at DESC
    LIMIT 6
";
if ($res = $db->query($sqlRecent)) {
    while ($row = $res->fetch_assoc()) {
        $recentOrders[] = $row;
    }
}

/* ================== KHÓA HỌC BÁN CHẠY ================== */
$popularCourses = [];
$sqlPopular = "
    SELECT c.id,
           c.title,
           COUNT(oi.id)                            AS sold,
           COALESCE(SUM(oi.price * oi.quantity),0) AS revenue
    FROM order_items oi
    JOIN courses c ON c.id = oi.course_id
    GROUP BY c.id, c.title
    ORDER BY sold DESC
    LIMIT 5
";
if ($res = $db->query($sqlPopular)) {
    while ($row = $res->fetch_assoc()) {
        $popularCourses[] = $row;
    }
}

/* ================== HỌC VIÊN MỚI ================== */
$newStudents = [];
$sqlStudents = "
    SELECT id, username, email, created_at
    FROM users
    WHERE role = 'user'
    ORDER BY created_at DESC
    LIMIT 5
";
if ($res = $db->query($sqlStudents)) {
    while ($row = $res->fetch_assoc()) {
        $newStudents[] = $row;
    }
}

/* ================== DOANH THU THEO THÁNG ================== */
$chartLabels = [];
$chartData   = [];

$sqlChart = "
    SELECT DATE_FORMAT(created_at, '%Y-%m') AS ym,
           SUM(total_amount)                AS revenue
    FROM orders
    GROUP BY ym
    ORDER BY ym ASC
    LIMIT 12
";
if ($res = $db->query($sqlChart)) {
    while ($row = $res->fetch_assoc()) {
        $chartLabels[] = $row['ym'];
        $chartData[]   = (float)$row['revenue'];
    }
}

// Tên admin
$adminName = htmlspecialchars($_SESSION['user']['username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard – Dev Alpha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font & Icon -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/CSS/admin-dashboard.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- css -->
     <style>
        :root {
    --bg: #f4f7fe;
    --sidebar-bg: #101332;
    --card-bg: #ffffff;
    --text-main: #252641;
    --text-muted: #7b7f9e;
    --border: #e4e8ff;
    --accent: #00c6d7;
    --radius-lg: 18px;
    --shadow-soft: 0 18px 40px rgba(16, 19, 50, 0.12);
}

*,
*::before,
*::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: "Roboto", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
    sans-serif;
    background: var(--bg);
    color: var(--text-main);
}

/* LAYOUT */
.admin-layout {
    display: grid;
    grid-template-columns: 260px minmax(0, 1fr);
    min-height: 100vh;
}

/* SIDEBAR */
.sidebar {
    background: var(--sidebar-bg);
    color: #ffffff;
    padding: 22px 18px 18px;
    display: flex;
    flex-direction: column;
}

.sidebar__logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 26px;
}

.sidebar__logo-icon {
    width: 38px;
    height: 38px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #00c6d7, #01a7d2);
    color: #fff;
    font-size: 22px;
}

.sidebar__logo-text {
    font-weight: 700;
    letter-spacing: 0.02em;
}

.sidebar__logo-text span {
    display: block;
    font-size: 13px;
    opacity: 0.85;
}

.sidebar__nav {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-top: 10px;
}

.sidebar__link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 12px;
    color: #c9cdf7;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.15s ease, color 0.15s ease;
}

.sidebar__link i {
    width: 20px;
    text-align: center;
    font-size: 15px;
}

.sidebar__link:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
}

.sidebar__link--active {
    background: linear-gradient(135deg, #00c6d7, #01a7d2);
    color: #ffffff;
}

.sidebar__footer {
    margin-top: auto;
    font-size: 12px;
    opacity: 0.5;
}

/* MAIN */
.main {
    display: flex;
    flex-direction: column;
}

/* TOPBAR */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 26px;
    background: #ffffff;
    border-bottom: 1px solid #edf1ff;
}

.topbar__title {
    font-size: 22px;
    font-weight: 600;
}

.topbar__subtitle {
    font-size: 13px;
    color: var(--text-muted);
}

.topbar__right {
    display: flex;
    align-items: center;
    gap: 14px;
}

.topbar__search {
    background: #f4f6ff;
    border-radius: 999px;
    padding: 6px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 230px;
}

.topbar__search i {
    color: #969ad0;
    font-size: 13px;
}

.topbar__search input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 13px;
    width: 100%;
}

.topbar__icon-btn {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    border: none;
    background: #f4f6ff;
    color: #6c71af;
    cursor: pointer;
}

.topbar__profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 4px 10px 4px 4px;
    border-radius: 999px;
    background: #f4f6ff;
}

.topbar__avatar {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    object-fit: cover;
}

.topbar__profile-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.topbar__name {
    font-size: 14px;
    font-weight: 500;
}

.topbar__role {
    font-size: 11px;
    color: var(--text-muted);
}

.topbar__logout {
    color: #6c71af;
    text-decoration: none;
    font-size: 14px;
}

/* CONTENT */
.content {
    padding: 20px 26px 28px;
}

/* STATS */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 22px;
}

.stat-card {
    background: var(--card-bg);
    border-radius: 18px;
    padding: 16px 16px 14px;
    display: flex;
    gap: 12px;
    box-shadow: var(--shadow-soft);
}

.stat-card__icon {
    width: 40px;
    height: 40px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    color: #ffffff;
    font-size: 18px;
}

.stat-card__icon--cyan {
    background: linear-gradient(135deg, #00c6d7, #01a7d2);
}

.stat-card__icon--purple {
    background: linear-gradient(135deg, #6b60f9, #9074ff);
}

.stat-card__icon--orange {
    background: linear-gradient(135deg, #ffb64d, #ff8a38);
}

.stat-card__icon--green {
    background: linear-gradient(135deg, #4cd964, #2ac76f);
}

.stat-card__label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-muted);
}

.stat-card__value {
    display: block;
    font-size: 20px;
    font-weight: 600;
    margin-top: 4px;
}

.stat-card__hint {
    font-size: 12px;
    color: var(--text-muted);
    margin-top: 2px;
}

/* PANELS & GRID */
.grid-2 {
    display: grid;
    grid-template-columns: 2fr 1.5fr;
    gap: 18px;
    margin-bottom: 22px;
}

.panel {
    background: var(--card-bg);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-soft);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.panel__header {
    padding: 16px 18px 6px;
}

.panel__title {
    font-size: 16px;
    font-weight: 600;
}

.panel__subtitle {
    font-size: 12px;
    color: var(--text-muted);
}

.panel__body {
    padding: 12px 18px 18px;
}

.panel__body--table {
    padding-top: 4px;
}

/* TABLE */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.table th,
.table td {
    padding: 8px 4px;
    border-bottom: 1px solid var(--border);
    text-align: left;
}

.table th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-muted);
}

.table__course-name {
    max-width: 220px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.empty-text {
    font-size: 13px;
    color: var(--text-muted);
}

/* RESPONSIVE */
@media (max-width: 1100px) {
    .admin-layout {
        grid-template-columns: 220px minmax(0, 1fr);
    }
    .grid-2 {
        grid-template-columns: 1fr;
    }
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 768px) {
    .admin-layout {
        grid-template-columns: 1fr;
    }
    .sidebar {
        display: none; /* đơn giản: ẩn sidebar trên mobile */
    }
    .stats-grid {
        grid-template-columns: 1fr 1fr;
    }
    .topbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .topbar__right {
        width: 100%;
        justify-content: space-between;
    }
}

     </style>

<div class="admin-layout">

    <!-- ========== SIDEBAR ========== -->
    <aside class="sidebar">
        <div class="sidebar__logo">
            <div class="sidebar__logo-icon">
                <i class="fa-brands fa-codiepie"></i>
            </div>
            <div class="sidebar__logo-text">
                dev <span>Alpha</span>
            </div>
        </div>

        <nav class="sidebar__nav">
            <a href="dashboard.php" class="sidebar__link sidebar__link--active">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
            <a href="manage_courses.php" class="sidebar__link">
                <i class="fa-solid fa-book-open"></i>
                <span>Courses</span>
            </a>
            <a href="manage_users.php" class="sidebar__link">
                <i class="fa-solid fa-users"></i>
                <span>Students</span>
            </a>
            <a href="manage_orders.php" class="sidebar__link">
                <i class="fa-solid fa-receipt"></i>
                <span>Orders</span>
            </a>
            <a href="reports.php" class="sidebar__link">
                <i class="fa-solid fa-chart-line"></i>
                <span>Reports</span>
            </a>
            <a href="../index.php" class="sidebar__link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to site</span>
            </a>
        </nav>

        <div class="sidebar__footer">
            <span class="sidebar__version">Admin Panel v1.0</span>
        </div>
    </aside>

    <!-- ========== MAIN ========== -->
    <main class="main">

        <!-- TOP BAR -->
        <header class="topbar">
            <div class="topbar__left">
                <h1 class="topbar__title">Dashboard</h1>
                <span class="topbar__subtitle">Overview of your e-learning platform</span>
            </div>

            <div class="topbar__right">
                <div class="topbar__search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search courses, students, orders…">
                </div>
                <button class="topbar__icon-btn">
                    <i class="fa-regular fa-bell"></i>
                </button>
                <div class="topbar__profile">
                    <img src="../uploads/IMAGE/OIP.webp"
                         alt="Admin Avatar" class="topbar__avatar">
                    <div class="topbar__profile-text">
                        <span class="topbar__name"><?= $adminName ?></span>
                        <span class="topbar__role">Administrator</span>
                    </div>
                    <a href="../controllers/AuthController.php?action=logout"
                       class="topbar__logout" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <section class="content">

            <!-- ===== SUMMARY CARDS ===== -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card__icon stat-card__icon--cyan">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                    <div class="stat-card__content">
                        <span class="stat-card__label">Total revenue</span>
                        <span class="stat-card__value">
                            $<?= number_format($stats['revenue'], 2) ?>
                        </span>
                        <span class="stat-card__hint">From all paid orders</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card__icon stat-card__icon--purple">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div class="stat-card__content">
                        <span class="stat-card__label">Total orders</span>
                        <span class="stat-card__value">
                            <?= number_format($stats['orders']) ?>
                        </span>
                        <span class="stat-card__hint">Successful checkouts</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card__icon stat-card__icon--orange">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div class="stat-card__content">
                        <span class="stat-card__label">Active courses</span>
                        <span class="stat-card__value">
                            <?= number_format($stats['courses']) ?>
                        </span>
                        <span class="stat-card__hint">Published on the platform</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card__icon stat-card__icon--green">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div class="stat-card__content">
                        <span class="stat-card__label">Total students</span>
                        <span class="stat-card__value">
                            <?= number_format($stats['students']) ?>
                        </span>
                        <span class="stat-card__hint">Registered learners</span>
                    </div>
                </div>
            </div>

            <!-- ===== CHART + TOP COURSES ===== -->
            <div class="grid-2">
                <!-- Revenue chart -->
                <div class="panel">
                    <div class="panel__header">
                        <h2 class="panel__title">Revenue by month</h2>
                        <span class="panel__subtitle">Last 12 months</span>
                    </div>
                    <div class="panel__body">
                        <canvas id="revenueChart" height="160"></canvas>
                    </div>
                </div>

                <!-- Popular courses -->
                <div class="panel">
                    <div class="panel__header">
                        <h2 class="panel__title">Top selling courses</h2>
                        <span class="panel__subtitle">Most purchased courses</span>
                    </div>
                    <div class="panel__body panel__body--table">
                        <?php if (empty($popularCourses)): ?>
                            <p class="empty-text">No course sales yet.</p>
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Enrolled</th>
                                    <th>Revenue</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($popularCourses as $course): ?>
                                    <tr>
                                        <td class="table__course-name">
                                            <?= htmlspecialchars($course['title']) ?>
                                        </td>
                                        <td><?= (int)$course['sold'] ?></td>
                                        <td>$<?= number_format($course['revenue'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ===== RECENT ORDERS + NEW STUDENTS ===== -->
            <div class="grid-2">
                <!-- Recent orders -->
                <div class="panel">
                    <div class="panel__header">
                        <h2 class="panel__title">Recent orders</h2>
                        <span class="panel__subtitle">Last 6 payments</span>
                    </div>
                    <div class="panel__body panel__body--table">
                        <?php if (empty($recentOrders)): ?>
                            <p class="empty-text">No orders yet.</p>
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Customer</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($recentOrders as $order): ?>
                                    <tr>
                                        <td>#<?= (int)$order['id'] ?></td>
                                        <td><?= htmlspecialchars($order['full_name']) ?></td>
                                        <td><?= htmlspecialchars($order['payment_method'] ?? 'Card') ?></td>
                                        <td>$<?= number_format($order['total_amount'], 2) ?></td>
                                        <td><?= htmlspecialchars($order['created_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- New students -->
                <div class="panel">
                    <div class="panel__header">
                        <h2 class="panel__title">Newest students</h2>
                        <span class="panel__subtitle">Recently registered users</span>
                    </div>
                    <div class="panel__body panel__body--table">
                        <?php if (empty($newStudents)): ?>
                            <p class="empty-text">No students yet.</p>
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Joined at</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($newStudents as $st): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($st['username']) ?></td>
                                        <td><?= htmlspecialchars($st['email']) ?></td>
                                        <td><?= htmlspecialchars($st['created_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>

<script>
    const chartLabels = <?= json_encode($chartLabels) ?>;
    const chartData   = <?= json_encode($chartData) ?>;

    if (chartLabels.length > 0) {
        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Revenue',
                    data: chartData,
                    tension: 0.3,
                    borderWidth: 3,
                    pointRadius: 4,
                    borderColor: '#00c6d7',
                    backgroundColor: 'rgba(0,198,215,0.12)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {legend: {display: false}},
                scales: {
                    y: {
                        ticks: {
                            callback: value => '$' + value
                        }
                    }
                }
            }
        });
    }
</script>

</body>
</html>
