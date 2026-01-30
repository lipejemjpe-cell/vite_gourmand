<?php
<?php require __DIR__ . '/partials/header.php'; ?>

<h1>Nos menus</h1>

<a href="/vite-gourmand/src/views/menu_create.php">➕ Ajouter un menu</a>

<hr>

<?php foreach ($menus as $menu): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3><?= htmlspecialchars($menu['title']) ?></h3>
        <p><?= htmlspecialchars($menu['description']) ?></p>
        <p>Prix: <?= $menu['price'] ?> €</p>
        <p>Min personnes: <?= $menu['min_persons'] ?></p>

        <a href="index.php?page=menus_admin&edit=<?= $menu['id'] ?>">✏️ Modifier</a>
        <a href="index.php?page=menus_admin&delete=<?= $menu['id'] ?>">🗑️ Supprimer</a>
        <a href="index.php?page=order&id=<?= $menu['id'] ?>">🛒 Commander</a>
    </div>
<?php endforeach; ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
