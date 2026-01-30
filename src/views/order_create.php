<?php
<?php require __DIR__ . '/partials/header.php'; ?>
// On démarre la session pour récupérer l'utilisateur connecté
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
if (!isset($_SESSION['user'])) {
    header('Location: /vite-gourmand/src/views/auth/login.php');
    exit;
}

// Connexion à la base de données
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance();

// On récupère le menu sélectionné
$stmt = $db->prepare("SELECT * FROM menus WHERE id = ?");
$stmt->execute([$_GET['menu_id']]);
$menu = $stmt->fetch();
?>

<h2>Commander le menu : <?= htmlspecialchars($menu['title']) ?></h2>

<form method="POST" action="/vite-gourmand/src/controllers/OrderController.php?action=create">

    <!-- ID du menu commandé (caché) -->
    <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">

    <!-- Adresse de livraison -->
    <input type="text" name="address" placeholder="Adresse de livraison" required><br>

    <!-- Nombre de personnes -->
    <input type="number" name="persons" min="<?= $menu['min_persons'] ?>" value="<?= $menu['min_persons'] ?>" required><br>

    <button type="submit">Valider la commande</button>
</form>
<?php require __DIR__ . '/partials/footer.php'; ?>
