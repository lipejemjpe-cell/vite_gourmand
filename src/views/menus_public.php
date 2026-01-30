<h1>🍽️ Nos menus</h1>
<?php require __DIR__ . '/partials/header.php'; ?>

<div class="menus">
<?php foreach ($menus as $menu): ?>
    <div class="menu-card">

        <img src="assets/images/<?= htmlspecialchars($menu['image']) ?>?v=<?= time() ?>" width="200">

        <h3><?= htmlspecialchars($menu['title'] ?? 'Menu') ?></h3>

        <p><?= htmlspecialchars($menu['description']) ?></p>

        <p><strong><?= number_format($menu['price'], 2) ?> €</strong></p>

        <p>Stock restant : <?= (int)$menu['stock'] ?></p>

        <a href="index.php?page=order&id=<?= $menu['id'] ?>">🛒 Commander</a>

    </div>
<?php endforeach; ?>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>