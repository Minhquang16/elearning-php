<?php
session_start();
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? 'user') !== 'admin') {
    header('Location: ../login.php');
    exit;
}
