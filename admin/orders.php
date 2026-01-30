<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si pas connecté ou pas admin → dehors
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php?page=login');
    exit;
}

require __DIR__ . '/../src/config/db.php';

// Sécurité : accès admin uniquement
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=login');
    exit;
}

// Si on clique sur un bouton de changement de statut
if (isset($_POST['change_status'])) {
    $orderId = (int) $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$newStatus, $orderId]);

    echo "<p style='color:green'>Statut mis à jour</p>";
}

// Récupération des commandes
$stmt = $pdo->query("
    SELECT orders.*, menus.title AS menu_name
    FROM orders
    JOIN menus ON orders.menu_id = menus.id
    ORDER BY orders.created_at DESC
");

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Gestion des commandes</h1>
<p><a href="index.php?page=admin">⬅ Retour admin</a></p>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Client</th>
    <th>Menu</th>
    <th>Personnes</th>
    <th>Adresse</th>
    <th>Statut</th>
    <th>Action</th>
</tr>

<?php foreach ($orders as $order): ?>
<tr>
    <td><?= $order['id'] ?></td>
    <td><?= htmlspecialchars($order['user_id']) ?></td>
    <td><?= htmlspecialchars($order['menu_name']) ?></td>
    <td><?= $order['persons'] ?></td>
    <td><?= htmlspecialchars($order['address']) ?></td>
    <td><?= $order['status'] ?></td>
    <td>
        <?php if ($order['status'] === 'en_attente'): ?>
            <form method="post" style="display:inline;">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                <input type="hidden" name="new_status" value="en_preparation">
                <button type="submit" name="change_status">Passer en préparation</button>
            </form>
        <?php elseif ($order['status'] === 'en_preparation'): ?>
            <form method="post" style="display:inline;">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                <input type="hidden" name="new_status" value="livree">
                <button type="submit" name="change_status">Marquer comme livrée</button>
            </form>
        <?php else: ?>
            ✅ Terminée
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

