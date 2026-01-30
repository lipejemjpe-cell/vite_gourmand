<h2>Créer un menu</h2>
<?php require __DIR__ . '/partials/header.php'; ?>

<form method="POST" action="/vite-gourmand/src/controllers/MenuController.php?action=create">
    <input type="text" name="title" placeholder="Titre" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" name="price" step="0.01" placeholder="Prix" required><br>
    <input type="number" name="min_persons" placeholder="Min personnes" required><br>
    <input type="text" name="theme" placeholder="Thème"><br>
    <input type="text" name="regime" placeholder="Régime"><br>
    <input type="number" name="stock" placeholder="Stock"><br>

    <button type="submit">Créer</button>
</form>
<?php require __DIR__ . '/partials/footer.php'; ?>
