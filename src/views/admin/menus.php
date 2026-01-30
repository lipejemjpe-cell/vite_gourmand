<?php
// src/views/admin/menus.php
?>

<h1>Gestion des menus</h1>

<?php
$isEdit = isset($_GET['edit']);
$menuToEdit = null;

if ($isEdit) {
    foreach ($menus as $m) {
        if ($m['id'] == $_GET['edit']) {
            $menuToEdit = $m;
            break;
        }
    }
}
?>

<h2><?= $isEdit ? "Modifier le menu" : "Ajouter un menu" ?></h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $menuToEdit['id'] ?? '' ?>">

    <input type="text" name="title" placeholder="Titre" required
        value="<?= htmlspecialchars($menuToEdit['title'] ?? '') ?>"><br><br>

    <textarea name="description" placeholder="Description" required><?= htmlspecialchars($menuToEdit['description'] ?? '') ?></textarea><br><br>

    <input type="number" step="0.01" name="price" placeholder="Prix" required
        value="<?= $menuToEdit['price'] ?? '' ?>"><br><br>

    <input type="number" name="min_persons" placeholder="Minimum de personnes"
        value="<?= $menuToEdit['min_persons'] ?? '' ?>"><br><br>

    <input type="text" name="theme" placeholder="Catégorie / Thème"
        value="<?= htmlspecialchars($menuToEdit['theme'] ?? '') ?>"><br><br>

    <input type="text" name="regime" placeholder="Régime alimentaire"
        value="<?= htmlspecialchars($menuToEdit['regime'] ?? '') ?>"><br><br>

    <input type="text" name="allergens" placeholder="Allergènes"
        value="<?= htmlspecialchars($menuToEdit['allergens'] ?? '') ?>"><br><br>

    <input type="text" name="image" placeholder="Nom du fichier image"
        value="<?= htmlspecialchars($menuToEdit['image'] ?? '') ?>"><br><br>

    <input type="number" name="stock" placeholder="Stock"
        value="<?= $menuToEdit['stock'] ?? '' ?>"><br><br>

    <button type="submit" name="<?= $isEdit ? 'update_menu' : 'add_menu' ?>">
        <?= $isEdit ? 'Mettre à jour' : 'Ajouter le menu' ?>
    </button>

    <?php if ($isEdit): ?>
        <a href="index.php?page=menus">Annuler</a>
    <?php endif; ?>
</form>

<hr>

<h2>Menus existants</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Titre</th>
    <th>Prix</th>
    <th>Stock</th>
    <th>Actions</th>
</tr>

<?php foreach ($menus as $menu): ?>
<tr>
    <td><?= $menu['id'] ?></td>
    <td><?= htmlspecialchars($menu['title']) ?></td>
    <td><?= $menu['price'] ?> €</td>
    <td><?= $menu['stock'] ?></td>
    <td>
        <a href="index.php?page=menus_admin&action=edit&id=<?= $menu['id'] ?>">
    ✏️ Modifier
        </a> 
        <a href="index.php?page=menus&delete=<?= $menu['id'] ?>" onclick="return confirm('Supprimer ce menu ?')">🗑 Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>