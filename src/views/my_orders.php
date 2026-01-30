<!DOCTYPE html>
<?php require __DIR__ . '/partials/header.php'; ?>
<html>
<head>
    <meta charset="utf-8">
    <title>Mes commandes</title>
</head>
<body>

<h1>📦 Mes commandes</h1>

<p><a href="index.php">⬅ Retour accueil</a></p>

<?php if (empty($orders)): ?>
    <p>Tu n'as encore passé aucune commande.</p>
<?php else: ?>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Menu</th>
        <th>Personnes</th>
        <th>Total</th>
        <th>Statut</th>
        <th>Date</th>
    </tr>

<?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $order['id'] ?></td>
        <td><?= htmlspecialchars($order['menu_title']) ?></td>
        <td><?= $order['persons'] ?></td>
        <td><?= number_format((float)($order['total_price'] ?? 0), 2) ?> €</td>
        <td><?= htmlspecialchars($order['status']) ?></td>
        <td><?= $order['created_at'] ?></td>
    </tr>
<?php endforeach; ?>

</table>

<?php endif; ?>

</body>
</html>
<?php require __DIR__ . '/partials/footer.php'; ?>
