<?php require __DIR__ . '/../partials/header.php'; ?>

<h1>✏️ Modifier le menu</h1>

<form method="post" action="index.php?page=menus_admin&action=update">

    <input type="hidden" name="id" value="<?= $menu['id'] ?>">

    <label>Titre</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($menu['title']) ?>" required><br><br>

    <label>Description</label><br>
    <textarea name="description"><?= htmlspecialchars($menu['description']) ?></textarea><br><br>

    <label>Prix (€)</label><br>
    <input type="number" step="0.01" name="price" value="<?= $menu['price'] ?>" required><br><br>

    <label>Image</label><br>
    <input type="text" name="image" value="<?= htmlspecialchars($menu['image']) ?>"><br><br>

    <label>Stock</label><br>
    <input type="number" name="stock" value="<?= $menu['stock'] ?>" min="0" required><br><br>

    <button type="submit">Enregistrer</button>

</form>

<p><a href="index.php?page=menus_admin">⬅ Retour</a></p>

<?php require __DIR__ . '/../partials/footer.php'; ?>
