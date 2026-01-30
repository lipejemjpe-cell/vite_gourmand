<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php?page=login');
    exit;
}

require __DIR__ . '/../src/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = (int) $_POST['order_id'];
    $status = $_POST['status'];

    $allowed = ['en_attente', 'validee', 'livree'];
    if (!in_array($status, $allowed)) {
        die("Statut invalide");
    }

    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $orderId]);
}

header('Location: orders.php');
exit;

