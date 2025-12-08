<?php
session_start();
require_once __DIR__ . '/config/database.php';

$db   = new Database();
$conn = $db->connect();

/*
 * BẢNG orders hiện có:
 * id | full_name | payment_method | total_amount | created_at
 */
$sql  = "SELECT id, full_name, payment_method, total_amount, created_at
         FROM orders
         ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

include 'header.php';
?>

<style>
/* ===== ORDER HISTORY PAGE ===== */
.order-list-section {
    width: 100%;
    padding: 110px 16px 60px;
    background: #f6f8ff;
}

.order-list__container {
    max-width: 980px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 24px 60px rgba(25, 39, 90, 0.14);
    padding: 26px 26px 30px;
}

.order-list__title {
    font-size: 1.9rem;
    font-weight: 600;
    color: #252641;
    margin-bottom: 6px;
}

.order-list__subtitle {
    font-size: .95rem;
    color: #7b81a9;
    margin-bottom: 18px;
}

/* bảng */
.order-table-wrapper {
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid #e0e6ff;
}

.order-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .95rem;
}

.order-table thead {
    background: #f4f6ff;
}

.order-table th,
.order-table td {
    padding: 12px 18px;
    text-align: left;
}

.order-table th {
    font-weight: 600;
    color: #757bb1;
    font-size: .82rem;
    text-transform: uppercase;
    letter-spacing: .06em;
}

.order-table tbody tr:nth-child(even) {
    background: #fafbff;
}

.order-table tbody tr:hover {
    background: #f0f4ff;
}

.order-id {
    font-weight: 600;
    color: #30346b;
}

.order-amount {
    font-weight: 600;
    color: #00c6d7;
}

.order-method {
    color: #5058a6;
    font-size: .9rem;
}

.order-date {
    color: #8087b5;
    font-size: .9rem;
}

/* khi không có đơn hàng */
.order-list__empty {
    padding: 30px 0 10px;
    text-align: center;
    color: #7479aa;
}

/* nút quay lại */
.order-list__actions {
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
}

.order-list__btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    border-radius: 999px;
    border: 1px solid #d4ddff;
    background: #fff;
    font-size: .95rem;
    color: #4a54a1;
    text-decoration: none;
    transition: background .15s ease, border-color .15s ease;
}

.order-list__btn-back:hover {
    background: #eef3ff;
    border-color: #c0cbff;
}

/* mobile */
@media (max-width: 700px) {
    .order-list-section {
        padding: 96px 10px 40px;
    }
    .order-list__container {
        padding: 20px 14px 22px;
        border-radius: 18px;
    }
    .order-table th, .order-table td {
        padding: 10px 10px;
        font-size: .85rem;
    }
}
</style>

<section class="order-list-section">
    <div class="order-list__container">
        <h1 class="order-list__title">Lịch sử đơn hàng</h1>
        <p class="order-list__subtitle">
            Xem lại các khoá học bạn đã thanh toán trước đây.
        </p>

        <?php if (empty($orders)): ?>
            <div class="order-list__empty">
                Bạn chưa có đơn hàng nào.
            </div>
        <?php else: ?>
            <div class="order-table-wrapper">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Họ tên</th>
                            <th>Phương thức</th>
                            <th>Tổng tiền</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="order-id">#<?php echo (int)$order['id']; ?></td>
                                <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                                <td class="order-method">
                                    <?php echo htmlspecialchars($order['payment_method']); ?>
                                </td>
                                <td class="order-amount">
                                    $<?php echo number_format((float)$order['total_amount'], 2); ?>
                                </td>
                                <td class="order-date">
                                    <?php echo htmlspecialchars($order['created_at']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="order-list__actions">
            <a href="course.php" class="order-list__btn-back">
                ← Tiếp tục chọn khóa học
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
