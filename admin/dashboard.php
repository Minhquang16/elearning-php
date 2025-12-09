<?php
// admin/dashboard.php
session_start();
require_once __DIR__ . '/../config/database.php';

// Chỉ cho admin vào
if (
    !isset($_SESSION['user']) ||
    ($_SESSION['user']['role'] ?? 'user') !== 'admin'
) {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

/* ================== THỐNG KÊ CHÍNH ================== */
$stats = [
    'revenue'  => 0,
    'orders'   => 0,
    'courses'  => 0,
    'students' => 0,
];

if ($result = $db->query("SELECT COALESCE(SUM(total_amount),0) AS revenue, COUNT(*) AS orders FROM orders")) {
    $row = $result->fetch_assoc();
    $stats['revenue'] = (float)$row['revenue'];
    $stats['orders']  = (int)$row['orders'];
}

if ($result = $db->query("SELECT COUNT(*) AS c FROM courses")) {
    $row = $result->fetch_assoc();
    $stats['courses'] = (int)$row['c'];
}

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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   
</head>
<body>

<div class="admin-layout">

    <?php
        $activePage = 'dashboard';
        include __DIR__ . '/_sidebar.php';
    ?>

    <main class="main">
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

        <section class="content">

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

            <div class="grid-2">
                <div class="panel">
                    <div class="panel__header">
                        <h2 class="panel__title">Revenue by month</h2>
                        <span class="panel__subtitle">Last 12 months</span>
                    </div>
                    <div class="panel__body">
                        <canvas id="revenueChart" height="160"></canvas>
                    </div>
                </div>

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

            <div class="grid-2">
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
