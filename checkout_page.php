<?php
session_start();

// Lấy giỏ hàng hiện tại
$cart = $_SESSION['cart'] ?? [];

// Lấy danh sách ID sản phẩm được chọn để thanh toán (từ cart.php)
$checkoutIds = $_SESSION['checkout_items'] ?? array_keys($cart);

// Gom các item sẽ thanh toán
$items    = [];
$subtotal = 0;

foreach ($checkoutIds as $id) {
    if (!isset($cart[$id])) continue;

    $item          = $cart[$id];
    $itemTotal     = $item['price'] * $item['quantity'];
    $item['total'] = $itemTotal;

    $items[]   = $item;
    $subtotal += $itemTotal;
}

// Nếu không có item nào thì quay lại giỏ hàng
if (empty($items)) {
    header('Location: cart.php');
    exit;
}

// Tính giảm giá / thuế (demo)
$couponPercent = 0;
$couponAmount  = $subtotal * $couponPercent / 100;
$taxFlat       = 5; // ví dụ thuế cố định 5$
$total         = $subtotal - $couponAmount + $taxFlat;

// Xử lý submit form thanh toán
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu form
    $cardName   = trim($_POST['card_name']   ?? '');
    $cardNumber = preg_replace('/\D+/', '', $_POST['card_number'] ?? '');
    $expiryDate = trim($_POST['expiry_date'] ?? '');
    $cvc        = preg_replace('/\D+/', '', $_POST['cvc'] ?? '');

    // Validate đơn giản
    if ($cardName === '') {
        $errors[] = 'Vui lòng nhập tên trên thẻ.';
    }
    if (strlen($cardNumber) < 12 || strlen($cardNumber) > 19) {
        $errors[] = 'Số thẻ không hợp lệ.';
    }
    if (!preg_match('#^(0[1-9]|1[0-2])/[0-9]{2}$#', $expiryDate)) {
        $errors[] = 'Hạn sử dụng không đúng định dạng MM/YY.';
    }
    if (strlen($cvc) < 3 || strlen($cvc) > 4) {
        $errors[] = 'Mã CVC không hợp lệ.';
    }

    // Nếu không lỗi -> lưu đơn hàng
    if (empty($errors)) {
        require_once __DIR__ . '/config/database.php';

        $db   = new Database();
        $conn = $db->connect();
        $conn->set_charset('utf8mb4');

        // Không lưu toàn bộ số thẻ, chỉ lưu 4 số cuối (demo)
        $cardLast4 = substr($cardNumber, -4);

        try {
            $conn->begin_transaction();

            // Lưu vào orders
            $sqlOrder = "INSERT INTO orders (full_name, total_amount, created_at)
                         VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sqlOrder);
            if (!$stmt) {
                throw new Exception($conn->error);
            }
            $stmt->bind_param('sd', $cardName, $total);
            $stmt->execute();
            $orderId = $stmt->insert_id;
            $stmt->close();

            // Lưu từng order_item
            $sqlItem = "INSERT INTO order_items (order_id, course_id, course_name, price, quantity)
                        VALUES (?, ?, ?, ?, ?)";
            $stmtItem = $conn->prepare($sqlItem);
            if (!$stmtItem) {
                throw new Exception($conn->error);
            }

            foreach ($items as $it) {
                $cid   = (int)$it['id'];
                $cname = $it['name'];
                $price = (float)$it['price'];
                $qty   = (int)$it['quantity'];

                $stmtItem->bind_param('iisdi', $orderId, $cid, $cname, $price, $qty);
                $stmtItem->execute();
            }
            $stmtItem->close();

            $conn->commit();

            // Xoá các item đã thanh toán khỏi giỏ
            foreach ($checkoutIds as $id) {
                unset($_SESSION['cart'][$id]);
            }
            unset($_SESSION['checkout_items']);

            // ✅ Lưu thêm thông tin cho trang success
            $_SESSION['last_order_id']       = $orderId;
            $_SESSION['last_payment_method'] = 'Credit Card'; // hoặc sau này lấy từ form
            $_SESSION['last_order_total']    = $total;

            // Giả lập thanh toán thành công
            header('Location: checkout_success.php');
            exit;

        } catch (Exception $e) {
            $conn->rollback();
            $errors[] = 'Có lỗi khi lưu đơn hàng. Vui lòng thử lại.';
            // debug nếu cần:
            // echo $e->getMessage();
        }
    }
}

include 'header.php';
?>
<!-- PHẦN HTML GIỐNG CŨ, MÌNH GIỮ NGUYÊN -->
<div class="checkout-wrapper">
    <div class="checkout-layout">

        <!-- ========== FORM THANH TOÁN ========== -->
        <section class="checkout-form-section">
            <h2 class="checkout-form__title">Checkout</h2>

            <?php if (!empty($errors)): ?>
                <div class="checkout-errors">
                    <ul>
                        <?php foreach ($errors as $err): ?>
                            <li><?php echo htmlspecialchars($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form class="payment-form" method="post" action="checkout_page.php">
                <h4 class="payment-form__subtitle">Card Type</h4>
                <div class="payment-methods">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkNuec_LJ5EAkOpnoH0L04wYSFKum6t-4goQ&s"
                         alt="PayPal" class="payment-logo">
                    <img src="https://1000logos.net/wp-content/uploads/2016/10/American-Express-Color.png"
                         alt="American Express" class="payment-logo">
                    <img src="https://1000logos.net/wp-content/uploads/2017/06/VISA-Logo-2006.png"
                         alt="VISA" class="payment-logo">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD7oa6-WXok1YXYt8GN4CWbzJOpeBf69159Q&s"
                         alt="MasterCard" class="payment-logo">
                </div>

                <div class="form-group">
                    <label for="card-name" class="form-label">Name on Card</label>
                    <input type="text"
                           id="card-name"
                           name="card_name"
                           placeholder="Enter Name on Card"
                           class="form-input"
                           value="<?php echo htmlspecialchars($cardName ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="card-number" class="form-label">Card Number</label>
                    <input type="text"
                           id="card-number"
                           name="card_number"
                           placeholder="Enter Card Number"
                           class="form-input"
                           value="<?php echo htmlspecialchars($cardNumber ?? ''); ?>">
                </div>

                <div class="form-row">
                    <div class="form-group form-group--half">
                        <label for="expiry-date" class="form-label">Expiration Date (MM/YY)</label>
                        <input type="text"
                               id="expiry-date"
                               name="expiry_date"
                               placeholder="Enter Expiration Date"
                               class="form-input"
                               value="<?php echo htmlspecialchars($expiryDate ?? ''); ?>">
                    </div>
                    <div class="form-group form-group--half">
                        <label for="cvc" class="form-label">CVC</label>
                        <input type="text"
                               id="cvc"
                               name="cvc"
                               placeholder="Enter CVC"
                               class="form-input"
                               value="<?php echo htmlspecialchars($cvc ?? ''); ?>">
                    </div>
                </div>

                <div class="form-checkbox">
                    <input type="checkbox" id="save-info" name="save_info" value="1">
                    <label for="save-info">Save my information for faster checkout</label>
                </div>

                <button type="submit" class="confirm-button">Confirm Payment</button>
            </form>
        </section>

        <!-- ========== SUMMARY LẤY TỪ GIỎ HÀNG ========== -->
        <aside class="order-summary">
            <h2 class="order-summary__title">Summary</h2>

            <div class="summary-items">
                <?php foreach ($items as $item): ?>
                    <div class="summary-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>"
                             alt="<?php echo htmlspecialchars($item['name']); ?>"
                             class="summary-item__image">

                        <div class="summary-item__details">
                            <p class="summary-item__name">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </p>
                            <p class="summary-item__desc">
                                Qty: <?php echo (int)$item['quantity']; ?> ×
                                $<?php echo number_format($item['price'], 2); ?>
                            </p>
                        </div>

                        <span class="summary-item__price">
                            $<?php echo number_format($item['total'], 2); ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="summary-totals">
                <div class="summary-total-row">
                    <span>Subtotal</span>
                    <span class="total-value">
                        $<?php echo number_format($subtotal, 2); ?>
                    </span>
                </div>

                <div class="summary-total-row">
                    <span>Coupon Discount</span>
                    <span class="total-value total-value--discount">
                        <?php echo $couponPercent; ?> %
                    </span>
                </div>

                <div class="summary-total-row">
                    <span>TAX</span>
                    <span class="total-value total-value--tax">
                        $<?php echo number_format($taxFlat, 2); ?>
                    </span>
                </div>

                <div class="summary-total-row summary-total-row--final">
                    <span>Total</span>
                    <span class="total-value total-value--final">
                        $<?php echo number_format($total, 2); ?>
                    </span>
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- Phần offer giữ nguyên -->
<section class="offer-section">
    <header class="offer-header">
        <h2 class="offer-header__title">
            Top Education offers and deals are listed here
        </h2>
        <a href="#" class="offer-header__link">See all</a>
    </header>

    <div class="offer-grid">
        <!-- ... các card offer giữ nguyên ... -->
    </div>
</section>

<?php include 'footer.php'; ?>
