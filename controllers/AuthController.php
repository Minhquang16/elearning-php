<?php
session_start();

require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../config/database.php';

class AuthController {

    private $user;

    public function __construct() {
        $db = (new Database())->connect();
        $this->user = new User($db);
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->user->find($username);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user;

            // Đăng nhập xong về trang chủ
            // Nếu index.php nằm trong /views thì đổi thành ../views/index.php
            header('Location: ../index.php');
            exit;

        } else {
            $_SESSION['error'] = 'Sai tài khoản hoặc mật khẩu';

            // Nếu login.php nằm trong /views thì đổi thành ../views/login.php
            header('Location: ../login.php');
            exit;
        }
    }

    public function register() {
        $username = $_POST['username'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

        $this->user->create($username, $email, $password);

        // Đăng ký xong quay lại trang login
        header('Location: ../login.php');
        exit;
    }

    public function logout() {
        // Xoá toàn bộ session
        session_unset();
        session_destroy();

        // Sau khi logout quay về TRANG ĐĂNG NHẬP
        // Nếu login.php nằm trong /views thì đổi thành ../views/login.php
        header('Location: ../login.php');
        exit;
    }
}

// ==== ROUTER ĐƠN GIẢN ====
$auth   = new AuthController();
$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $auth->login();
} elseif ($action === 'register') {
    $auth->register();
} elseif ($action === 'logout') {
    $auth->logout();
} else {
    // Không có action thì cho về trang chủ
    header('Location: ../index.php');
    exit;
}
