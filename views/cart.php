<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Nếu có request thêm vào giỏ
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

// Hiển thị giỏ hàng
include 'header.php';
?>

<section class="cart-section">
    <h1>Giỏ hàng của bạn</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Giỏ hàng đang trống.</p>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Khóa học</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($item['image']); ?>" style="width:80px;"></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Tổng: $<?php echo number_format($total, 2); ?></h3>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
