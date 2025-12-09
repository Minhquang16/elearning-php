<?php
// admin/manage_orders.php
session_start();
require_once __DIR__ . '/../config/database.php';

// ==== CHỈ CHO ADMIN TRUY CẬP ====
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

$errors  = [];
$success = '';

/* ================== FILTERS (SEARCH + PAYMENT + DATE) ================== */
$search     = trim($_GET['q'] ?? '');
$payment    = trim($_GET['payment'] ?? '');
$dateFrom   = trim($_GET['date_from'] ?? '');
$dateTo     = trim($_GET['date_to'] ?? '');

$whereSql = ' WHERE 1 ';
$params   = [];
$types    = '';

// Tìm theo tên khách hoặc ID
if ($search !== '') {
    $whereSql .= ' AND (full_name LIKE ? OR id = ?) ';
    $like = '%' . $search . '%';
    $idSearch = ctype_digit($search) ? (int)$search : 0;
    $params[] = $like;
    $params[] = $idSearch;
    $types   .= 'si';
}

// Lọc theo phương thức thanh toán
if ($payment !== '') {
    $whereSql .= ' AND payment_method = ? ';
    $params[] = $payment;
    $types   .= 's';
}

// Lọc theo ngày
if ($dateFrom !== '') {
    $whereSql .= ' AND DATE(created_at) >= ? ';
    $params[] = $dateFrom;
    $types   .= 's';
}
if ($dateTo !== '') {
    $whereSql .= ' AND DATE(created_at) <= ? ';
    $params[] = $dateTo;
    $types   .= 's';
}

/* ================== THỐNG KÊ TỔNG (THEO FILTER) ================== */
$stats = [
    'total_orders'  => 0,
    'total_revenue' => 0,
    'avg_value'     => 0,
];

$sqlSummary = "
    SELECT
        COUNT(*)                        AS total_orders,
        COALESCE(SUM(total_amount),0)   AS total_revenue,
        COALESCE(AVG(total_amount),0)   AS avg_value
    FROM orders
    $whereSql
";

if ($types === '') {
    $res = $db->query($sqlSummary);
} else {
    $stmt = $db->prepare($sqlSummary);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();
}
if ($res && $row = $res->fetch_assoc()) {
    $stats['total_orders']  = (int)$row['total_orders'];
    $stats['total_revenue'] = (float)$row['total_revenue'];
    $stats['avg_value']     = (float)$row['avg_value'];
}

/* ================== LẤY DANH SÁCH ORDER ================== */
$orders = [];
$sqlList = "
    SELECT id, full_name, total_amount, payment_method, created_at
    FROM orders
    $whereSql
    ORDER BY created_at DESC
    LIMIT 200
";

if ($types === '') {
    $res = $db->query($sqlList);
} else {
    $stmt = $db->prepare($sqlList);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();
}
if ($res) {
    $orders = $res->fetch_all(MYSQLI_ASSOC);
}

/* ================== CHI TIẾT ĐƠN HÀNG (KHI ?view=ID) ================== */
$viewOrder      = null;
$viewOrderItems = [];

if (isset($_GET['view'])) {
    $viewId = (int)$_GET['view'];
    if ($viewId > 0) {
        // Thông tin đơn
        $stmt = $db->prepare("
            SELECT id, full_name, total_amount, payment_method, created_at
            FROM orders
            WHERE id = ?
        ");
        $stmt->bind_param('i', $viewId);
        $stmt->execute();
        $viewOrder = $stmt->get_result()->fetch_assoc();

        // Items
        $stmt = $db->prepare("
            SELECT 
                oi.quantity,
                oi.price,
                c.title
            FROM order_items oi
            JOIN courses c ON c.id = oi.course_id
            WHERE oi.order_id = ?
        ");
        $stmt->bind_param('i', $viewId);
        $stmt->execute();
        $viewOrderItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

// Tên admin hiện tại
$currentAdminName = htmlspecialchars($_SESSION['user']['username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Manage Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS chung của admin -->
    <link rel="stylesheet" href="../assets/CSS/_sidebar.css">
    <link rel="stylesheet" href="../assets/CSS/admin-manage-courses.css">

    <style>
        .chip-payment {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
        }
        .chip-payment--card {
            background: rgba(0, 198, 215, 0.12);
            color: #00a4b8;
        }
        .chip-payment--paypal {
            background: rgba(43, 108, 176, 0.12);
            color: #2b6cb0;
        }
        .chip-payment--other {
            background: rgba(107, 114, 128, 0.12);
            color: #4b5563;
        }
        .order-id-text {
            font-size: 11px;
            color: #9ca3c8;
        }
        .order-date-text {
            font-size: 11px;
            color: #9ca3c8;
        }
        .summary-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }
        .summary-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 10px 14px;
            box-shadow: 0 12px 30px rgba(16,19,50,0.08);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .summary-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #9ca3c8;
        }
        .summary-value {
            font-size: 18px;
            font-weight: 600;
        }
        .summary-hint {
            font-size: 11px;
            color: #9ca3c8;
        }
        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .detail-title {
            font-size: 16px;
            font-weight: 600;
        }
        .detail-meta {
            font-size: 13px;
            color: #9ca3c8;
        }
        .detail-total {
            font-size: 18px;
            font-weight: 600;
            color: #00a4b8;
        }
        .detail-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            background: #f4f6ff;
            color: #4b5563;
            gap: 6px;
        }
        .detail-items-table th,
        .detail-items-table td {
            font-size: 13px;
        }
        @media (max-width: 1100px) {
            .summary-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php
        $activePage = 'orders';
        include __DIR__ . '/_sidebar.php';
    ?>

    <main class="main">
        <!-- HEADER -->
        <header class="main__header">
            <div>
                <div class="main__title">Manage Orders</div>
                <div class="main__subtitle">
                    Track payments and order history across your platform.
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

        <!-- MESSAGES -->
        <?php if (!empty($success)): ?>
            <div class="msg msg--success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $e): ?>
                <div class="msg msg--error"><?php echo htmlspecialchars($e); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- SUMMARY CARDS (THEO FILTER HIỆN TẠI) -->
        <div class="summary-row">
            <div class="summary-card">
                <div class="summary-label">Total orders</div>
                <div class="summary-value">
                    <?php echo number_format($stats['total_orders']); ?>
                </div>
                <div class="summary-hint">Matching current filters</div>
            </div>
            <div class="summary-card">
                <div class="summary-label">Total revenue</div>
                <div class="summary-value">
                    $<?php echo number_format($stats['total_revenue'], 2); ?>
                </div>
                <div class="summary-hint">Sum of order totals</div>
            </div>
            <div class="summary-card">
                <div class="summary-label">Average order value</div>
                <div class="summary-value">
                    $<?php echo number_format($stats['avg_value'], 2); ?>
                </div>
                <div class="summary-hint">Revenue per order</div>
            </div>
        </div>

        <div class="grid">
            <!-- ORDER LIST -->
            <section class="card card--list">
                <div class="card__header">
                    <div class="card__title">Order List</div>
                    <span class="tag"><?php echo count($orders); ?> Orders</span>
                </div>

                <form class="search-bar" method="get">
                    <input type="text" name="q" class="input"
                           placeholder="Search by customer name or order ID..."
                           value="<?php echo htmlspecialchars($search); ?>">

                    <select name="payment" class="input" style="max-width:160px;">
                        <option value="">Payment: All</option>
                        <option value="Credit Card" <?php echo $payment === 'Credit Card' ? 'selected' : ''; ?>>
                            Credit Card
                        </option>
                        <option value="PayPal" <?php echo $payment === 'PayPal' ? 'selected' : ''; ?>>
                            PayPal
                        </option>
                        <option value="Visa" <?php echo $payment === 'Visa' ? 'selected' : ''; ?>>
                            Visa
                        </option>
                        <option value="Mastercard" <?php echo $payment === 'Mastercard' ? 'selected' : ''; ?>>
                            Mastercard
                        </option>
                    </select>

                    <input type="date" name="date_from" class="input"
                           value="<?php echo htmlspecialchars($dateFrom); ?>"
                           style="max-width:150px;">
                    <input type="date" name="date_to" class="input"
                           value="<?php echo htmlspecialchars($dateTo); ?>"
                           style="max-width:150px;">

                    <button class="btn btn--outline" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Filter
                    </button>
                </form>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6">No orders found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $o): ?>
                                <tr>
                                    <td>
                                        <div class="course-title">
                                            #<?php echo (int)$o['id']; ?>
                                        </div>
                                        <div class="order-id-text">
                                            Order ID
                                        </div>
                                    </td>
                                    <td>
                                        <div class="course-title">
                                            <?php echo htmlspecialchars($o['full_name']); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            $pm = $o['payment_method'] ?? '';
                                            $pmLower = strtolower($pm);
                                            if (strpos($pmLower, 'paypal') !== false) {
                                                $pmClass = 'chip-payment chip-payment--paypal';
                                                $pmIcon  = 'fa-brands fa-paypal';
                                            } elseif (strpos($pmLower, 'card') !== false) {
                                                $pmClass = 'chip-payment chip-payment--card';
                                                $pmIcon  = 'fa-regular fa-credit-card';
                                            } else {
                                                $pmClass = 'chip-payment chip-payment--other';
                                                $pmIcon  = 'fa-regular fa-credit-card';
                                            }
                                        ?>
                                        <span class="<?php echo $pmClass; ?>">
                                            <i class="<?php echo $pmIcon; ?>" style="margin-right:5px;"></i>
                                            <?php echo htmlspecialchars($pm ?: 'N/A'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="price">
                                            $<?php echo number_format((float)$o['total_amount'], 2); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="order-date-text">
                                            <?php echo htmlspecialchars($o['created_at']); ?>
                                        </span>
                                    </td>
                                    <td style="text-align:right;">
                                        <a href="manage_orders.php?<?php
                                            // giữ filter khi xem chi tiết
                                            $qs = $_GET;
                                            $qs['view'] = (int)$o['id'];
                                            echo htmlspecialchars(http_build_query($qs));
                                        ?>"
                                           class="btn btn--outline btn--xs">
                                            <i class="fa-solid fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- ORDER DETAIL -->
            <section class="card card--form">
                <div class="card__header">
                    <div class="card__title">
                        <?php echo $viewOrder ? 'Order Detail' : 'Select an order'; ?>
                    </div>
                    <?php if ($viewOrder): ?>
                        <span class="tag">#<?php echo (int)$viewOrder['id']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="panel__body">
                    <?php if (!$viewOrder): ?>
                        <p style="font-size:13px;color:#9ca3c8;">
                            Choose an order from the list to see full details, including purchased
                            courses and payment information.
                        </p>
                    <?php else: ?>
                        <div class="detail-header">
                            <div>
                                <div class="detail-title">
                                    Order #<?php echo (int)$viewOrder['id']; ?>
                                </div>
                                <div class="detail-meta">
                                    <?php echo htmlspecialchars($viewOrder['full_name']); ?>
                                    &nbsp;&middot;&nbsp;
                                    <?php echo htmlspecialchars($viewOrder['created_at']); ?>
                                </div>
                            </div>
                            <div style="text-align:right;">
                                <div class="detail-total">
                                    $<?php echo number_format((float)$viewOrder['total_amount'], 2); ?>
                                </div>
                                <div>
                                    <span class="detail-badge">
                                        <i class="fa-regular fa-credit-card"></i>
                                        <?php echo htmlspecialchars($viewOrder['payment_method'] ?? 'N/A'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h4 style="margin:12px 0 6px;font-size:13px;color:#6b7280;text-transform:uppercase;letter-spacing:.08em;">
                            Purchased courses
                        </h4>

                        <?php if (empty($viewOrderItems)): ?>
                            <p style="font-size:13px;color:#9ca3c8;">
                                No order items found for this order.
                            </p>
                        <?php else: ?>
                            <div style="overflow-x:auto;">
                                <table class="detail-items-table">
                                    <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th style="width:90px;">Quantity</th>
                                        <th style="width:120px;">Unit price</th>
                                        <th style="width:120px;">Line total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $calcTotal = 0;
                                    foreach ($viewOrderItems as $item):
                                        $qty   = (int)$item['quantity'];
                                        $price = (float)$item['price'];
                                        $line  = $qty * $price;
                                        $calcTotal += $line;
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($item['title']); ?></td>
                                            <td><?php echo $qty; ?></td>
                                            <td>$<?php echo number_format($price, 2); ?></td>
                                            <td>$<?php echo number_format($line, 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div style="margin-top:10px;text-align:right;font-size:13px;color:#6b7280;">
                                Calculated from items:
                                <strong>$<?php echo number_format($calcTotal, 2); ?></strong>
                            </div>
                        <?php endif; ?>

                        <hr style="margin:16px 0;border:none;border-top:1px solid #e5e7eb;">

                        <p style="font-size:12px;color:#9ca3c8;">
                            This order is generated after a successful checkout on the website.
                            You can use this page to confirm payments, check which courses
                            were purchased, and support your learners if they have any questions.
                        </p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>
</div>

</body>
</html>
