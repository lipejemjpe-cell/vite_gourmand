<!DOCTYPE html>
<?php require __DIR__ . '/partials/header.php'; ?>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des menus</title>
</head>
<body>

<h1>Gestion des menus</h1>

<p><a href="index.php?page=admin">⬅ Retour admin</a></p>

<h2>Ajouter un menu</h2>

<form method="post">
    <input type="text" name="title" placeholder="Nom du menu" required><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>
    <input type="number" step="0.01" name="price" placeholder="Prix" required><br><br>
    <button type="submit">Ajouter</button>
</form>

<h2>Menus existants</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Action</th>
    </tr>

<?php foreach ($menus as $menu): ?>
    <tr>
        <td><?= $menu['id'] ?></td>
        <td><?= htmlspecialchars($menu['title']) ?></td>
        <td><?= htmlspecialchars($menu['description']) ?></td>
        <td><?= $menu['price'] ?> €</td>
        <td>
            <a href="index.php?page=menus&delete=<?= $menu['id'] ?>" onclick="return confirm('Supprimer ce menu ?')">Supprimer</a>
        </td>
    </tr>
<?php endforeach; ?>

</table>

</body>
</html>
<?php require __DIR__ . '/partials/footer.php'; ?>
