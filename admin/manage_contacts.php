<?php
// admin/manage_contacts.php
session_start();
require_once __DIR__ . '/../config/database.php';

// Chỉ cho admin
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$db = (new Database())->connect();

$messages = [];
$res = $db->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
if ($res) {
    $messages = $res->fetch_all(MYSQLI_ASSOC);
}

// Xem chi tiết 1 message
$viewMessage = null;
if (isset($_GET['view'])) {
    $id = (int)$_GET['view'];
    if ($id > 0) {
        $stmt = $db->prepare("SELECT * FROM contact_messages WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $viewMessage = $stmt->get_result()->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin – Contact messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/CSS/_sidebar.css">
    <link rel="stylesheet" href="../assets/CSS/admin-manage-courses.css">
    <style>
        .msg-body {
            white-space: pre-wrap;
            font-size: 13px;
            line-height: 1.6;
            color: #4b5563;
            background: #f9fafb;
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
<div class="admin-layout">
    <?php
    $activePage = 'contacts';
    include __DIR__ . '/_sidebar.php';
    ?>

    <main class="main">
        <header class="main__header">
            <div>
                <div class="main__title">Contact messages</div>
                <div class="main__subtitle">
                    Xem các tin nhắn mà người dùng gửi từ trang liên hệ.
                </div>
            </div>
        </header>

        <div class="grid">

            <!-- Khung xem chi tiết -->
            <section class="card card--form">
                <div class="card__header">
                    <div class="card__title">
                        <?= $viewMessage ? 'Message #' . (int)$viewMessage['id'] : 'Chọn một tin nhắn bên phải để xem chi tiết'; ?>
                    </div>
                </div>

                <?php if ($viewMessage): ?>
                    <div class="form-grid">
                        <div class="full">
                            <strong>From:</strong>
                            <?= htmlspecialchars($viewMessage['name']) ?>
                            &lt;<?= htmlspecialchars($viewMessage['email']) ?>&gt;
                        </div>
                        <div class="full">
                            <strong>Subject:</strong>
                            <?= htmlspecialchars($viewMessage['subject']) ?>
                        </div>
                        <div>
                            <strong>Thời gian:</strong><br>
                            <?= htmlspecialchars($viewMessage['created_at']) ?>
                        </div>
                        <div>
                            <strong>IP:</strong><br>
                            <?= htmlspecialchars($viewMessage['ip_address'] ?? '-') ?>
                        </div>
                        <div class="full">
                            <strong>Nội dung:</strong>
                            <div class="msg-body">
                                <?= nl2br(htmlspecialchars($viewMessage['message'])) ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p style="font-size:14px;color:#6b7280;margin-top:10px;">
                        Chưa chọn tin nhắn nào.
                    </p>
                <?php endif; ?>
            </section>

            <!-- Danh sách -->
            <section class="card card--list">
                <div class="card__header">
                    <div class="card__title">Danh sách liên hệ</div>
                    <span class="tag"><?= count($messages) ?> messages</span>
                </div>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người gửi</th>
                            <th>Email</th>
                            <th>Tiêu đề</th>
                            <th>Ngày gửi</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="6">Chưa có tin nhắn nào.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($messages as $m): ?>
                                <tr>
                                    <td>#<?= (int)$m['id'] ?></td>
                                    <td><?= htmlspecialchars($m['name']) ?></td>
                                    <td><?= htmlspecialchars($m['email']) ?></td>
                                    <td><?= htmlspecialchars(mb_strimwidth($m['subject'], 0, 40, '…')) ?></td>
                                    <td><?= htmlspecialchars($m['created_at']) ?></td>
                                    <td style="text-align:right;">
                                        <a href="manage_contacts.php?view=<?= (int)$m['id'] ?>"
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

        </div>
    </main>
</div>
</body>
</html>
