<?php
session_start();

// LẤY DỮ LIỆU TỪ SESSION
$orderId        = $_SESSION['last_order_id']       ?? null;
$paymentMethod  = $_SESSION['last_payment_method'] ?? 'Credit Card';
$orderTotalSess = $_SESSION['last_order_total']    ?? null;

if ($orderTotalSess === null || $orderTotalSess === '') {
    $orderTotalDisplay = '$0.00';
} elseif (is_numeric($orderTotalSess)) {
    $orderTotalDisplay = '$' . number_format((float)$orderTotalSess, 2);
} else {
    // Trường hợp đã format sẵn như "$405.00"
    $orderTotalDisplay = $orderTotalSess;
}

// (TÙY CHỌN) XOÁ SESSION SAU KHI DÙNG
unset(
    $_SESSION['last_order_id'],
    $_SESSION['last_payment_method'],
    $_SESSION['last_order_total']
);

include 'header.php';
?>
<style>
/* ===== ORDER SUCCESS ===== */
.order-success {
    width: 100%;
    padding: 110px 16px 40px;
    background: linear-gradient(180deg, #f5f7ff 0%, #f1f5ff 45%, #101332 100%);
}

.order-success__card {
    max-width: 720px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    padding: 32px 32px 28px;
    box-shadow: 0 26px 60px rgba(18, 52, 102, 0.20);
    text-align: center;
}

.order-success__icon-wrap {
    display: flex;
    justify-content: center;
    margin-bottom: 16px;
}

.order-success__icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle at 30% 0,
                #9ff8ff 0, #00c6d7 40%, #0095c2 100%);
    color: #ffffff;
    box-shadow: 0 18px 36px rgba(0, 198, 215, 0.55);
    font-size: 34px;
}

.order-success__title {
    font-size: 2rem;
    font-weight: 600;
    color: #252641;
    margin-bottom: 6px;
}

.order-success__subtitle {
    font-size: 1rem;
    color: #5b5f85;
    margin-bottom: 26px;
}

.order-success__meta {
    display: flex;
    justify-content: center;
    gap: 24px;
    flex-wrap: wrap;
    padding: 18px 22px;
    border-radius: 18px;
    background: #f6f8ff;
    border: 1px solid #e0e6ff;
    margin-bottom: 28px;
}

.order-success__meta-item {
    min-width: 180px;
    text-align: left;
}

.order-success__meta-item .label {
    display: block;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #8b90b3;
    margin-bottom: 6px;
}

.order-success__meta-item .value {
    font-size: 1rem;
    font-weight: 600;
    color: #252641;
}

.order-success__actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 14px;
    margin-top: 8px;
}

.order-success__btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 30px;
    border-radius: 999px;
    background: linear-gradient(135deg, #00c6d7, #01a7d2);
    color: #ffffff;
    font-size: 0.98rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 10px 28px rgba(0, 198, 215, 0.55);
    transition: transform 0.15s ease, box-shadow 0.15s ease, filter 0.15s ease;
}

.order-success__btn-primary:hover {
    filter: brightness(1.03);
    transform: translateY(-1px);
    box-shadow: 0 16px 34px rgba(0, 198, 215, 0.55);
}

.order-success__btn-primary:active {
    transform: translateY(0);
    box-shadow: 0 8px 20px rgba(0, 198, 215, 0.4);
}

.order-success__btn-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    border-radius: 999px;
    background: transparent;
    border: 1px solid #d4ddff;
    color: #4a54a1;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.15s ease, color 0.15s ease, border-color 0.15s ease;
}

.order-success__btn-link:hover {
    background: #eef3ff;
    border-color: #c0cbff;
}

/* Mobile */
@media (max-width: 600px) {
    .order-success {
        padding-top: 96px;
    }
    .order-success__card {
        padding: 24px 18px 20px;
        border-radius: 18px;
    }
    .order-success__title {
        font-size: 1.6rem;
    }
    .order-success__meta {
        gap: 16px;
        padding: 12px 10px;
    }
    .order-success__btn-primary,
    .order-success__btn-link {
        width: 100%;
        max-width: 320px;
    }
}
</style>

<section class="order-success">
    <div class="order-success__card">
        <div class="order-success__icon-wrap">
            <span class="order-success__icon">
                <i class="fas fa-check"></i>
            </span>
        </div>

        <h1 class="order-success__title">Cảm ơn bạn đã thanh toán!</h1>

        <p class="order-success__subtitle">
            Đơn hàng
            <strong>#<?php echo htmlspecialchars($orderId ?? 1, ENT_QUOTES, 'UTF-8'); ?></strong>
            đã được tạo thành công.
        </p>

        <div class="order-success__meta">
            <div class="order-success__meta-item">
                <span class="label">Phương thức</span>
                <span class="value">
                    <?php echo htmlspecialchars($paymentMethod, ENT_QUOTES, 'UTF-8'); ?>
                </span>
            </div>
            <div class="order-success__meta-item">
                <span class="label">Số tiền</span>
                <span class="value">
                    <?php echo htmlspecialchars($orderTotalDisplay, ENT_QUOTES, 'UTF-8'); ?>
                </span>
            </div>
        </div>

        <div class="order-success__actions">
            <a href="course.php" class="order-success__btn-primary">
                Tiếp tục chọn khóa học
            </a>
            <a href="orders.php" class="order-success__btn-link">
                Xem lịch sử đơn hàng
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
