<?php
<?php require __DIR__ . '/partials/header.php'; ?>
// Démarrage de la session
session_start();

// Sécurité : seul un employé ou un admin peut accéder ici
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['employee', 'admin'])) {
    die("Accès refusé");
}

// Connexion à la base de données
require_once __DIR__ . '/../config/database.php';
$db = Database::getInstance();

// Récupération de toutes les commandes avec infos utilisateur et menu
$stmt = $db->query("
    SELECT o.*, u.firstname, u.lastname, m.title 
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN menus m ON o.menu_id = m.id
    ORDER BY o.created_at DESC
");
$orders = $stmt->fetchAll();
?>

<h2>Gestion des commandes</h2>

<?php foreach ($orders as $order): ?>
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <p><strong>Client :</strong> <?= htmlspecialchars($order['firstname']) ?> <?= htmlspecialchars($order['lastname']) ?></p>
        <p><strong>Menu :</strong> <?= htmlspecialchars($order['title']) ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($order['address']) ?></p>
        <p><strong>Personnes :</strong> <?= $order['persons'] ?></p>
        <p><strong>Prix :</strong> <?= $order['total_price'] ?> €</p>
        <p><strong>Statut actuel :</strong> <?= $order['status'] ?></p>

        <!-- Formulaire pour changer le statut -->
        <form method="POST" action="/vite-gourmand/src/controllers/OrderController.php?action=update_status">
            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">

            <select name="status">
                <option value="en_attente">En attente</option>
                <option value="accepte">Acceptée</option>
                <option value="en_preparation">En préparation</option>
                <option value="en_livraison">En livraison</option>
                <option value="termine">Terminée</option>
            </select>

            <button type="submit">Mettre à jour le statut</button>
        </form>
    </div>
<?php endforeach; ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
