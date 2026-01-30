<?php
require_once __DIR__ . '/../config/db.php';

// Sécurité
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$user_id = $_SESSION['user']['id'];

// Récupérer les commandes du user
$stmt = $pdo->prepare("
    SELECT 
        o.*,
        m.title AS menu_title
    FROM orders o
    JOIN menus m ON o.menu_id = m.id
    WHERE o.user_id = ?
    ORDER BY o.created_at DESC
");

$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();

require __DIR__ . '/../views/my_orders.php';
