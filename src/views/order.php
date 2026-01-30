<!DOCTYPE html>
<?php require __DIR__ . '/partials/header.php'; ?>
<html>
<head>
    <meta charset="utf-8">
    <title>Passer une commande</title>
</head>
<body>

<h1>Passer une commande</h1>

<p><a href="index.php">⬅ Retour accueil</a></p>

<?php if (!empty($success)): ?>
    <p style="color:green;"><?= $success ?></p>
<?php endif; ?>

<form method="post">

    <label>Menu choisi :</label><br>

    <?php if ($menu): ?>

    <h3><?= htmlspecialchars($menu['title']) ?> - <?= number_format($menu['price'], 2) ?> €</h3>
    <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">

<?php else: ?>

    <p style="color:red;">❌ Menu introuvable.</p>

<?php endif; ?>

    <br>

    <label>Nombre de personnes :</label><br>
    <input type="number" name="persons" min="1" value="1" required><br><br>

    <label>Adresse de livraison :</label><br>
    <textarea name="address" required></textarea><br><br>

    <?php if ($menu): ?>
    <button type="submit">Commander</button>
<?php endif; ?>

</form>

</body>
</html>
<?php require __DIR__ . '/partials/footer.php'; ?>
