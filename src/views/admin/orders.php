<?php
require_once __DIR__ . '/../src/config/db.php';
session_start();

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=login');
    exit;
}

// Récupérer toutes les commandes
$stmt = $pdo->query("
    SELECT 
        o.*,
        u.firstname,
        u.lastname,
        m.title AS menu_title
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN menus m ON o.menu_id = m.id
    ORDER BY o.created_at DESC
");

$orders = $stmt->fetchAll();

// Traitement changement de statut
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['status'], $_POST['order_id']]);

    header("Location: index.php?page=admin_orders");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des commandes</title>
</head>
<body>

<h1>📦 Gestion des commandes</h1>

<p><a href="index.php?page=admin">⬅ Retour admin</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Menu</th>
        <th>Personnes</th>
        <th>Total</th>
        <th>Adresse</th>
        <th>Statut</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $order['id'] ?></td>
        <td><?= htmlspecialchars($order['firstname'] . ' ' . $order['lastname']) ?></td>
        <td><?= htmlspecialchars($order['menu_title']) ?></td>
        <td><?= $order['persons'] ?></td>
        <td><?= number_format($order['total_price'], 2) ?> €</td>
        <td><?= htmlspecialchars($order['address']) ?></td>
        <td><?= htmlspecialchars($order['status']) ?></td>
        <td><?= $order['created_at'] ?></td>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                <select name="status">
                    <option value="pending" <?= $order['status']=='pending'?'selected':'' ?>>pending</option>
                    <option value="preparation" <?= $order['status']=='preparation'?'selected':'' ?>>preparation</option>
                    <option value="livre" <?= $order['status']=='livre'?'selected':'' ?>>livré</option>
                    <option value="annule" <?= $order['status']=='annule'?'selected':'' ?>>annulé</option>
                </select>
                <button type="submit">Changer</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

</table>

</body>
</html>