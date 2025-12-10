<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>

<div class="auth-wrapper">
    <div class="row g-4 align-items-center">

        <!-- LEFT IMAGE -->
        <div class="col-lg-6">
            <div class="left-image">
                <img src="uploads/IMAGE/Group 231.png" alt="">
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="col-lg-6">
            <div class="auth-box">

                <h5 class="text-center">Welcome to CodeAcademy..!
                </h5>

                <div class="toggle-btn-group mt-3 mb-4">
                    <a href="login.php" class="toggle-btn">Login</a>
                    <a href="register.php" class="toggle-btn active">Register</a>
                </div>

                <p class="text-muted text-center">
                Join thousands of learners and start mastering programming with guided lessons, hands-on projects, and a clear learning path designed to help you grow.

                </p>

                <!-- REGISTER FORM (Gửi đến Controller) -->
                <form action="../controllers/AuthController.php?action=register" method="POST">

                    <label class="mt-3">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your Email Address" required>

                    <label class="mt-3">User name</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your User name" required>

                    <label class="mt-3">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                        <i class="fa-solid fa-eye password-toggle"></i>
                    </div>

                    <?php if(isset($_SESSION['error'])): ?>
                        <p class="text-danger mt-2"><?= $_SESSION['error']; ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <button class="submit-btn mt-3" type="submit">Register</button>
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
