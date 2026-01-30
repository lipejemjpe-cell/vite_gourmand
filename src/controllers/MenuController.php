<?php
require_once __DIR__ . '/../config/db.php';

// =======================
// SÉCURITÉ ADMIN
// =======================
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=login');
    exit;
}

// =======================
// ROUTAGE INTERNE
// =======================
$action = $_GET['action'] ?? null;

// =======================
// UPDATE MENU
// =======================
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = (int) $_POST['id'];
    $stock = (int) $_POST['stock'];

    $stmt = $pdo->prepare("UPDATE menus SET stock = ? WHERE id = ?");
    $stmt->execute([$stock, $id]);

    header("Location: index.php?page=menus_admin");
    exit;
}

// =======================
// EDIT MENU
// =======================
if ($action === 'edit' && isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM menus WHERE id = ?");
    $stmt->execute([$id]);
    $menu = $stmt->fetch();

    require __DIR__ . '/../views/admin/menu_edit.php';
    exit;
}

// =======================
// LISTE DES MENUS
// =======================
$stmt = $pdo->query("SELECT * FROM menus ORDER BY id DESC");
$menus = $stmt->fetchAll();

require __DIR__ . '/../views/admin/menus.php';

