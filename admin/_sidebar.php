<?php
// admin/_sidebar.php
// $activePage dùng để set menu đang được chọn, ví dụ: 'dashboard', 'courses', 'users', ...
if (!isset($activePage)) {
    $activePage = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/CSS/_sidebar.css">
    <link rel="stylesheet" href="../assets/CSS/admin-dashboard.css">
</head>
<body>
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
        <a href="dashboard.php"
           class="sidebar__link <?= $activePage === 'dashboard' ? 'sidebar__link--active' : '' ?>">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span>
        </a>

        <a href="manage_courses.php"
           class="sidebar__link <?= $activePage === 'courses' ? 'sidebar__link--active' : '' ?>">
            <i class="fa-solid fa-book-open"></i>
            <span>Courses</span>
        </a>

        <a href="manage_users.php"
           class="sidebar__link <?= $activePage === 'users' ? 'sidebar__link--active' : '' ?>">
            <i class="fa-solid fa-users"></i>
            <span>Students</span>
        </a>

        <a href="manage_orders.php"
           class="sidebar__link <?= $activePage === 'orders' ? 'sidebar__link--active' : '' ?>">
            <i class="fa-solid fa-receipt"></i>
            <span>Orders</span>
        </a>

        <a href="reports.php"
           class="sidebar__link <?= $activePage === 'reports' ? 'sidebar__link--active' : '' ?>">
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
</body>
</html>

