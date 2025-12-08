<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/**
 * 1. Thêm sản phẩm vào giỏ (từ course.php)
 */
if (isset($_POST['add_to_cart'])) {
    $id    = $_POST['course_id'];
    $name  = $_POST['course_name'];
    $price = (float) $_POST['course_price'];
    $image = $_POST['course_image'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'id'       => $id,
            'name'     => $name,
            'price'    => $price,
            'image'    => $image,
            'quantity' => 1,
        ];
    }

    // Quay lại trang trước
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    exit;
}

/**
 * 2. Xử lý update / xóa / checkout
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['add_to_cart'])) {

    // Cập nhật số lượng
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $id => $qty) {
            if (!isset($_SESSION['cart'][$id])) continue;
            $qty = (int)$qty;
            if ($qty < 1) $qty = 1;
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }

    // Xóa 1 sản phẩm
    if (isset($_POST['remove_item'])) {
        $removeId = $_POST['remove_item'];
        if (isset($_SESSION['cart'][$removeId])) {
            unset($_SESSION['cart'][$removeId]);
        }
        header('Location: cart.php');
        exit;
    }

    // Bấm "Cập nhật giỏ hàng"
    if (isset($_POST['update_cart'])) {
        header('Location: cart.php');
        exit;
    }

    // Bấm "Mua hàng" → sang checkout.php
    if (isset($_POST['checkout'])) {
        // Lấy danh sách id được tick, nếu không tick gì thì mặc định là tất cả
        if (!empty($_POST['selected']) && is_array($_POST['selected'])) {
            $selectedIds = array_keys($_POST['selected']);
        } else {
            $selectedIds = array_keys($_SESSION['cart']);
        }

        // Lưu danh sách id sản phẩm sẽ thanh toán
        $_SESSION['checkout_items'] = $selectedIds;

        header('Location: checkout_page.php');
        exit;
    }
}

// Hiển thị giỏ hàng
include 'header.php';
?>

<section class="cart-section">
    <div class="cart-container">
        <h1 class="cart-title">Giỏ hàng của bạn</h1>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="cart-empty">
                <p>Giỏ hàng đang trống.</p>
                <a href="course.php" class="btn-primary">Tiếp tục chọn khóa học</a>
            </div>
        <?php else: ?>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            ?>

            <form method="post" class="cart-form">
                <div class="cart-table-wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th style="width:40px;">Chọn</th>
                                <th>Khóa học</th>
                                <th>Hình</th>
                                <th>Giá</th>
                                <th style="width:150px;">Số lượng</th>
                                <th>Thành tiền</th>
                                <th style="width:40px;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $item):
                                $id        = $item['id'];
                                $name      = $item['name'];
                                $price     = (float)$item['price'];
                                $qty       = (int)$item['quantity'];
                                $image     = $item['image'];
                                $subtotal  = $price * $qty;
                            ?>
                                <!-- THÊM data-row-id để JS chọn từng dòng -->
                                <tr data-row-id="<?php echo $id; ?>">

                                    <!-- checkbox chọn sản phẩm để mua -->
                                    <td>
                                        <label class="cart-checkbox">
                                            <input type="checkbox" name="selected[<?php echo $id; ?>]" checked>
                                            <span class="cart-checkbox__fake"></span>
                                        </label>
                                    </td>

                                    <td class="cart-course">
                                        <div class="cart-course__name">
                                            <?php echo htmlspecialchars($name); ?>
                                        </div>
                                    </td>

                                    <td>
                                        <img src="<?php echo htmlspecialchars($image); ?>"
                                             class="cart-image"
                                             alt="<?php echo htmlspecialchars($name); ?>">
                                    </td>

                                    <!-- THÊM class + data-price cho ô giá -->
                                    <td class="cart-price" data-price="<?php echo $price; ?>">
                                        $<?php echo number_format($price, 2); ?>
                                    </td>

                                    <td>
                                        <div class="qty-control">
                                            <button type="button"
                                                    class="qty-btn qty-btn--minus"
                                                    data-target="qty_<?php echo $id; ?>">−</button>
                                            <input type="number"
                                                   id="qty_<?php echo $id; ?>"
                                                   name="quantities[<?php echo $id; ?>]"
                                                   min="1"
                                                   value="<?php echo $qty; ?>"
                                                   class="qty-input">
                                            <button type="button"
                                                    class="qty-btn qty-btn--plus"
                                                    data-target="qty_<?php echo $id; ?>">+</button>
                                        </div>
                                    </td>

                                    <!-- THÊM class cho ô thành tiền -->
                                    <td class="cart-subtotal">
                                        $<?php echo number_format($subtotal, 2); ?>
                                    </td>

                                    <td>
                                        <button type="submit"
                                                name="remove_item"
                                                value="<?php echo $id; ?>"
                                                class="cart-remove-btn"
                                                title="Xóa khỏi giỏ">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="cart-footer">
                    <div class="cart-footer__left">
                        <button type="submit" name="update_cart" class="btn-outline">
                            Cập nhật giỏ hàng
                        </button>
                    </div>
                    <div class="cart-footer__right">
                        <div class="cart-total">
                            <span class="cart-total__label">Tổng thanh toán</span>
                            <span class="cart-total__value">
                                $<?php echo number_format($total, 2); ?>
                            </span>
                        </div>
                        <button type="submit" name="checkout" class="btn-primary">
                            Mua hàng
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>

<script>
// format tiền đơn giản: $xx.xx
function formatMoney(value) {
    value = Number(value) || 0;
    return '$' + value.toFixed(2);
}

// Tính lại subtotal từng dòng + tổng toàn bộ
function recalcCartTotal() {
    let grandTotal = 0;

    // Duyệt từng dòng sản phẩm
    document.querySelectorAll('tr[data-row-id]').forEach(function (row) {
        const priceCell = row.querySelector('.cart-price');
        const qtyInput  = row.querySelector('.qty-input');
        const subCell   = row.querySelector('.cart-subtotal');
        const checkbox  = row.querySelector('input[type="checkbox"]');

        if (!priceCell || !qtyInput || !subCell) return;

        const price = parseFloat(priceCell.getAttribute('data-price')) || 0;
        const qty   = parseInt(qtyInput.value, 10) || 1;

        const subtotal = price * qty;
        subCell.textContent = formatMoney(subtotal);

        // Nếu checkbox được tick thì mới cộng vào tổng
        if (!checkbox || checkbox.checked) {
            grandTotal += subtotal;
        }
    });

    const totalElement = document.querySelector('.cart-total__value');
    if (totalElement) {
        totalElement.textContent = formatMoney(grandTotal);
    }
}

// Xử lý nút + / -
document.querySelectorAll('.qty-btn').forEach(function(btn) {
    btn.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);
        if (!input) return;

        let value = parseInt(input.value, 10) || 1;

        if (this.classList.contains('qty-btn--minus')) {
            value = Math.max(1, value - 1);
        } else {
            value = value + 1;
        }
        input.value = value;

        // Sau khi đổi số lượng → tính lại tiền
        recalcCartTotal();
    });
});

// Nếu user tự gõ số lượng bằng tay
document.querySelectorAll('.qty-input').forEach(function(input) {
    input.addEventListener('change', function () {
        let v = parseInt(this.value, 10) || 1;
        if (v < 1) v = 1;
        this.value = v;
        recalcCartTotal();
    });
});

// Khi tick / bỏ tick checkbox sản phẩm → cập nhật tổng
document.querySelectorAll('tr[data-row-id] input[type="checkbox"]').forEach(function(cb){
    cb.addEventListener('change', recalcCartTotal);
});

// Tính lại 1 lần khi load trang
recalcCartTotal();
</script>

<?php include 'footer.php'; ?>
