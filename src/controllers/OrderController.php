<?php
require_once __DIR__ . '/../config/db.php';


// Sécurité : utilisateur connecté obligatoire
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$menu = null;

// ==========================
// RÉCUPÉRER LE MENU
// ==========================
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM menus WHERE id = ?");
    $stmt->execute([$id]);
    $menu = $stmt->fetch();
}

// ==========================
// TRAITEMENT COMMANDE
// ==========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['menu_id'])) {
        die("Menu manquant.");
    }

    $menu_id = (int) $_POST['menu_id'];
    $persons = (int) $_POST['persons'];
    $address = $_POST['address'];
    $user_id = $_SESSION['user']['id'];

    // Récupérer le prix du menu
    $stmt = $pdo->prepare("SELECT price, stock FROM menus WHERE id = ?");
    $stmt->execute([$menu_id]);
    $menuData = $stmt->fetch();

if (!$menuData) {
    die("Menu invalide.");
}

if ($menuData['stock'] < $persons) {
    die("❌ Stock insuffisant pour cette commande.");
}

$total_price = $menuData['price'] * $persons;

    // Insertion commande
    $stmt = $pdo->prepare("
        INSERT INTO orders (user_id, menu_id, persons, address, total_price, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
    ");

    $stmt->execute([
        $user_id,
        $menu_id,
        $persons,
        $address,
        $total_price
    ]);
    // Décrémenter le stock
    $stmt = $pdo->prepare("UPDATE menus SET stock = stock - ? WHERE id = ?");
    $stmt->execute([$persons, $menu_id]);

    $success = "✅ Commande enregistrée avec succès !";

// ==========================
// AFFICHAGE
// ==========================
}
require __DIR__ . '/../views/order.php';
