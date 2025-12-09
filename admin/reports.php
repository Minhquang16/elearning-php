<?php
// admin/reports.php
session_start();
require_once __DIR__ . '/../config/database.php';

// ==== CHỈ CHO ADMIN TRUY CẬP ====
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

/* ================== BỘ LỌC NGÀY ================== */
// Mặc định: 30 ngày gần nhất
$today = date('Y-m-d');
$defaultFrom = date('Y-m-d', strtotime($today . ' -29 days'));

$dateFrom = trim($_GET['date_from'] ?? $defaultFrom);
$dateTo   = trim($_GET['date_to']   ?? $today);

// Đảm bảo from <= to
if ($dateFrom > $dateTo) {
    [$dateFrom, $dateTo] = [$dateTo, $dateFrom];
}

/* ================== THỐNG KÊ TỔNG ================== */
$stats = [
    'revenue'   => 0,
    'orders'    => 0,
    'avg_order' => 0,
    'customers' => 0,
];

$sqlSummary = "
    SELECT 
        COALESCE(SUM(total_amount),0)  AS revenue,
        COUNT(*)                       AS orders,
        COALESCE(AVG(total_amount),0)  AS avg_order,
        COUNT(DISTINCT full_name)      AS customers
    FROM orders
    WHERE DATE(created_at) BETWEEN ? AND ?
";
$stmt = $db->prepare($sqlSummary);
$stmt->bind_param('ss', $dateFrom, $dateTo);
$stmt->execute();
$res = $stmt->get_result();
if ($res && $row = $res->fetch_assoc()) {
    $stats['revenue']   = (float)$row['revenue'];
    $stats['orders']    = (int)$row['orders'];
    $stats['avg_order'] = (float)$row['avg_order'];
    $stats['customers'] = (int)$row['customers'];
}

/* ================== DOANH THU THEO NGÀY ================== */
$revLabels = [];
$revData   = [];

$sqlRevenueDaily = "
    SELECT 
        DATE(created_at) AS d,
        SUM(total_amount) AS revenue
    FROM orders
    WHERE DATE(created_at) BETWEEN ? AND ?
    GROUP BY d
    ORDER BY d ASC
";
$stmt = $db->prepare($sqlRevenueDaily);
$stmt->bind_param('ss', $dateFrom, $dateTo);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $revLabels[] = $row['d'];
    $revData[]   = (float)$row['revenue'];
}

/* ================== DOANH THU THEO HÌNH THỨC THANH TOÁN ================== */
$payLabels = [];
$payData   = [];

$sqlPayment = "
    SELECT 
        payment_method,
        SUM(total_amount) AS revenue
    FROM orders
    WHERE DATE(created_at) BETWEEN ? AND ?
    GROUP BY payment_method
";
$stmt = $db->prepare($sqlPayment);
$stmt->bind_param('ss', $dateFrom, $dateTo);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $label = $row['payment_method'] ?: 'Other';
    $payLabels[] = $label;
    $payData[]   = (float)$row['revenue'];
}

/* ================== TOP KHÓA HỌC (THEO DOANH THU) ================== */
$topCourses = [];

$sqlTopCourses = "
    SELECT 
        c.id,
        c.title,
        SUM(oi.quantity)                         AS qty,
        COALESCE(SUM(oi.price * oi.quantity),0)  AS revenue,
        COUNT(DISTINCT oi.order_id)              AS orders
    FROM order_items oi
    JOIN orders  o ON o.id = oi.order_id
    JOIN courses c ON c.id = oi.course_id
    WHERE DATE(o.created_at) BETWEEN ? AND ?
    GROUP BY c.id, c.title
    ORDER BY revenue DESC
    LIMIT 10
";
$stmt = $db->prepare($sqlTopCourses);
$stmt->bind_param('ss', $dateFrom, $dateTo);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $topCourses[] = $row;
}

/* ================== TÊN ADMIN ================== */
$currentAdminName = htmlspecialchars($_SESSION['user']['username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS chung admin -->
    <link rel="stylesheet" href="../assets/CSS/_sidebar.css">
    <link rel="stylesheet" href="../assets/CSS/admin-manage-courses.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .summary-row {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }
        .summary-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: 0 12px 30px rgba(16,19,50,0.08);
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .summary-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #9ca3c8;
        }
        .summary-value {
            font-size: 20px;
            font-weight: 600;
        }
        .summary-hint {
            font-size: 11px;
            color: #9ca3c8;
        }
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
            margin-bottom: 16px;
        }
        .filter-bar label {
            font-size: 12px;
            color: #6b7280;
        }
        .filter-bar .input {
            max-width: 160px;
        }
        .panel-grid-2 {
            display: grid;
            grid-template-columns: 2.2fr 1.3fr;
            gap: 18px;
            margin-bottom: 20px;
        }
        .panel {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(16, 19, 50, 0.12);
            padding: 14px 18px 16px;
        }
        .panel-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .panel-subtitle {
            font-size: 12px;
            color: #9ca3c8;
            margin-bottom: 10px;
        }
        .table-small th,
        .table-small td {
            font-size: 13px;
        }
        .badge-rank {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            background: #c4c6ff;
        }
        .badge-rank--1 { background: linear-gradient(135deg,#f97316,#facc15); }
        .badge-rank--2 { background: linear-gradient(135deg,#6366f1,#a855f7); }
        .badge-rank--3 { background: linear-gradient(135deg,#10b981,#22c55e); }

        @media (max-width: 1100px) {
            .summary-row {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }
            .panel-grid-2 {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .summary-row {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php
        $activePage = 'reports';
        include __DIR__ . '/_sidebar.php';
    ?>

    <main class="main">
        <!-- HEADER -->
        <header class="main__header">
            <div>
                <div class="main__title">Reports & Analytics</div>
                <div class="main__subtitle">
                    Visualize revenue, orders and top-performing courses.
                </div>
            </div>
            <div class="admin-user">
                <img src="../uploads/IMAGE/OIP.webp" class="admin-user__avatar" alt="admin">
                <div class="admin-user__name">
                    <?php echo $currentAdminName; ?>
                </div>
                <a href="../controllers/AuthController.php?action=logout"
                   class="btn btn--outline btn--xs">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </div>
        </header>

        <section class="content">
            <!-- FILTER BAR -->
            <form class="filter-bar" method="get">
                <label for="date_from">From</label>
                <input type="date" id="date_from" name="date_from"
                       class="input"
                       value="<?php echo htmlspecialchars($dateFrom); ?>">

                <label for="date_to">to</label>
                <input type="date" id="date_to" name="date_to"
                       class="input"
                       value="<?php echo htmlspecialchars($dateTo); ?>">

                <button class="btn btn--outline" type="submit">
                    <i class="fa-solid fa-filter"></i>
                    Apply
                </button>
            </form>

            <!-- SUMMARY CARDS -->
            <div class="summary-row">
                <div class="summary-card">
                    <div class="summary-label">Total revenue</div>
                    <div class="summary-value">
                        $<?php echo number_format($stats['revenue'], 2); ?>
                    </div>
                    <div class="summary-hint">
                        For orders between <?php echo htmlspecialchars($dateFrom); ?>
                        and <?php echo htmlspecialchars($dateTo); ?>.
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Total orders</div>
                    <div class="summary-value">
                        <?php echo number_format($stats['orders']); ?>
                    </div>
                    <div class="summary-hint">Successful checkouts</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Average order value</div>
                    <div class="summary-value">
                        $<?php echo number_format($stats['avg_order'], 2); ?>
                    </div>
                    <div class="summary-hint">Revenue per order</div>
                </div>

                <div class="summary-card">
                    <div class="summary-label">Unique customers</div>
                    <div class="summary-value">
                        <?php echo number_format($stats['customers']); ?>
                    </div>
                    <div class="summary-hint">Based on billing name</div>
                </div>
            </div>

            <!-- CHARTS -->
            <div class="panel-grid-2">
                <!-- Revenue line chart -->
                <div class="panel">
                    <div class="panel-title">Revenue over time</div>
                    <div class="panel-subtitle">
                        Daily revenue between the selected dates.
                    </div>
                    <canvas id="revenueChart" height="120"></canvas>
                </div>

                <!-- Payment method pie chart -->
                <div class="panel">
                    <div class="panel-title">Revenue by payment method</div>
                    <div class="panel-subtitle">
                        Distribution of revenue across payment methods.
                    </div>
                    <canvas id="paymentChart" height="120"></canvas>
                </div>
            </div>

            <!-- TOP COURSES TABLE -->
            <section class="card card--list">
                <div class="card__header">
                    <div class="card__title">Top earning courses</div>
                    <span class="tag"><?php echo count($topCourses); ?> courses</span>
                </div>

                <div style="overflow-x:auto;">
                    <table class="table-small">
                        <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Course</th>
                            <th style="width:80px;">Orders</th>
                            <th style="width:80px;">Students</th>
                            <th style="width:120px;">Revenue</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($topCourses)): ?>
                            <tr>
                                <td colspan="5">No course revenue in this period.</td>
                            </tr>
                        <?php else: ?>
                            <?php $rank = 1; ?>
                            <?php foreach ($topCourses as $c): ?>
                                <?php
                                    $badgeClass = 'badge-rank';
                                    if ($rank === 1)      $badgeClass .= ' badge-rank--1';
                                    elseif ($rank === 2) $badgeClass .= ' badge-rank--2';
                                    elseif ($rank === 3) $badgeClass .= ' badge-rank--3';
                                ?>
                                <tr>
                                    <td>
                                        <span class="<?php echo $badgeClass; ?>">
                                            <?php echo $rank; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="course-title">
                                            <?php echo htmlspecialchars($c['title']); ?>
                                        </div>
                                    </td>
                                    <td><?php echo (int)$c['orders']; ?></td>
                                    <td><?php echo (int)$c['qty']; ?></td>
                                    <td>
                                        <span class="price">
                                            $<?php echo number_format((float)$c['revenue'], 2); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php $rank++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </main>
</div>

<script>
    const revLabels = <?php echo json_encode($revLabels); ?>;
    const revData   = <?php echo json_encode($revData); ?>;
    const payLabels = <?php echo json_encode($payLabels); ?>;
    const payData   = <?php echo json_encode($payData); ?>;

    // Revenue line chart
    if (revLabels.length > 0) {
        const ctxRev = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRev, {
            type: 'line',
            data: {
                labels: revLabels,
                datasets: [{
                    label: 'Revenue',
                    data: revData,
                    tension: 0.3,
                    borderWidth: 3,
                    pointRadius: 3,
                    borderColor: '#00c6d7',
                    backgroundColor: 'rgba(0,198,215,0.16)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false }},
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

    // Payment pie chart
    if (payLabels.length > 0) {
        const ctxPay = document.getElementById('paymentChart').getContext('2d');
        new Chart(ctxPay, {
            type: 'doughnut',
            data: {
                labels: payLabels,
                datasets: [{
                    data: payData,
                    backgroundColor: [
                        '#00c6d7',
                        '#6366f1',
                        '#f97316',
                        '#10b981',
                        '#a855f7',
                        '#facc15'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 14, font: { size: 11 } }
                    }
                },
                cutout: '55%'
            }
        });
    }
</script>

</body>
</html>
