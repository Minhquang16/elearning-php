<?php
session_start();

// Nếu đã đăng nhập thì không cho vào trang login nữa
if (isset($_SESSION['user'])) {
    // chuyển về trang chủ hoặc dashboard
    header("Location: index.php"); // vì login.php và index.php cùng thư mục
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>

<div class="auth-wrapper">
    <div class="row g-4 align-items-center">

        <!-- LEFT IMAGE -->
        <div class="col-lg-6">
            <div class="left-image">
                <img src="uploads/IMAGE/Group 232.png" alt="">
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="col-lg-6">
            <div class="auth-box">

                <h5 class="text-center">Welcome to lorem..!</h5>

                <!-- Toggle Buttons -->
                <div class="toggle-btn-group mt-3 mb-4">
                    <a href="login.php" class="toggle-btn active">Login</a>
                    <a href="register.php" class="toggle-btn">Register</a>
                </div>

                <p class="text-muted text-center">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>

                <form action="controllers/AuthController.php?action=login" method="POST">

                    <label class="mt-3">User name</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your User name" required>

                    <label class="mt-3">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                        <i class="fa-solid fa-eye password-toggle"></i>
                    </div>

                    <!-- Error message -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <p class="text-danger mt-2"><?= $_SESSION['error']; ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            <input type="checkbox"> Remember me
                        </div>
                        <a href="#" class="text-decoration-none text-muted">Forgot Password ?</a>
                    </div>

                    <button class="submit-btn mt-3" type="submit">Login</button>
                </form>

            </div>
        </div>

    </div>
</div>

<footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle eye icon
        document.querySelectorAll(".password-toggle").forEach(icon => {
            icon.addEventListener("click", () => {
                let input = icon.previousElementSibling;
                input.type = (input.type === "password") ? "text" : "password";
            });
        });
    </script>
</footer>

</body>
</html>
