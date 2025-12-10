<?php
// contact.php – Trang liên hệ

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';
$db = (new Database())->connect();

$name = $email = $subject = $message = '';
$errors = [];
$success = '';

// Xử lý gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate
    if ($name === '') {
        $errors[] = 'Vui lòng nhập họ tên.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không hợp lệ.';
    }
    if ($subject === '') {
        $errors[] = 'Vui lòng nhập tiêu đề.';
    }
    if ($message === '' || mb_strlen($message) < 10) {
        $errors[] = 'Nội dung phải ít nhất 10 ký tự.';
    }

    if (empty($errors)) {
        $userId  = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;
        $ip      = $_SERVER['REMOTE_ADDR'] ?? null;

        $sql = "INSERT INTO contact_messages
                (user_id, name, email, subject, message, created_at, ip_address)
                VALUES (?,?,?,?,?,NOW(),?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param(
            'isssss',
            $userId,
            $name,
            $email,
            $subject,
            $message,
            $ip
        );

        if ($stmt->execute()) {
            $success = 'Cảm ơn bạn! Chúng tôi đã nhận được tin nhắn.';
            // reset form
            $name = $email = $subject = $message = '';
        } else {
            $errors[] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
        }

        // Nếu bạn muốn gửi email nữa, có thể thêm:
        // @mail('you@example.com', "Liên hệ: $subject", $message, "From: $email");
    }
}

include 'header.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ – Dev Alpha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/CSS/base.css">
    <link rel="stylesheet" href="./assets/CSS/contact.css">
</head>
<body>

<main class="contact-page">

    <section class="contact-hero">
        <div class="contact-hero__text">
            <h1>Liên hệ với Dev Alpha</h1>
            <p>Nếu bạn có câu hỏi về khóa học, thanh toán hoặc hợp tác, hãy gửi tin nhắn cho chúng tôi.</p>
        </div>
        <div class="contact-hero__info-card">
            <h3>Thông tin liên hệ</h3>
            <ul>
                <li><i class="fa-solid fa-envelope"></i> support@dev-alpha.com</li>
                <li><i class="fa-solid fa-phone"></i> +84 0123 456 789</li>
                <li><i class="fa-solid fa-location-dot"></i> Hà Nội, Việt Nam</li>
            </ul>
        </div>
    </section>

    <section class="contact-content">
        <div class="contact-form-card">

            <div class="contact-form-card__header">
                <h2>Gửi tin nhắn</h2>
                <p>Chúng tôi sẽ phản hồi cho bạn trong thời gian sớm nhất.</p>
            </div>

            <?php if (!empty($success)): ?>
                <div class="contact-alert contact-alert--success">
                    <i class="fa-solid fa-circle-check"></i>
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="contact-alert contact-alert--error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?php foreach ($errors as $e): ?>
                        <div><?= htmlspecialchars($e) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" class="contact-form" novalidate>
                <div class="contact-form__grid">
                    <div class="field">
                        <label for="name">Họ và tên *</label>
                        <input type="text" id="name" name="name"
                               value="<?= htmlspecialchars($name) ?>" required>
                    </div>

                    <div class="field">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email"
                               value="<?= htmlspecialchars($email) ?>" required>
                    </div>

                    <div class="field field--full">
                        <label for="subject">Tiêu đề *</label>
                        <input type="text" id="subject" name="subject"
                               value="<?= htmlspecialchars($subject) ?>" required>
                    </div>

                    <div class="field field--full">
                        <label for="message">Nội dung *</label>
                        <textarea id="message" name="message" rows="5"
                                  required><?= htmlspecialchars($message) ?></textarea>
                    </div>
                </div>

                <div class="contact-form__actions">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-paper-plane"></i>
                        Gửi tin nhắn
                    </button>
                </div>
            </form>
        </div>

        <aside class="contact-side-card">
            <h3>Tại sao liên hệ với chúng tôi?</h3>
            <ul>
                <li><i class="fa-solid fa-circle-dot"></i> Tư vấn lộ trình học lập trình</li>
                <li><i class="fa-solid fa-circle-dot"></i> Hỗ trợ kỹ thuật khi học trên nền tảng</li>
                <li><i class="fa-solid fa-circle-dot"></i> Hợp tác xây dựng khóa học & nội dung</li>
            </ul>

            <!-- <div class="contact-side-card__social">
                <span>Kết nối mạng xã hội:</span>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div> -->
        </aside>
    </section>

</main>

<?php include 'footer.php'; ?>
</body>
</html>
