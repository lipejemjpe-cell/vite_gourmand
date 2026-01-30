<h1>Vite & Gourmand</h1>
<?php require __DIR__ . '/partials/header.php'; ?>

<?php if (isset($_SESSION['user'])): ?>
    <p>Bonjour <?= htmlspecialchars($_SESSION['user']['firstname']) ?></p>
    <a href="/vite-gourmand/src/controllers/AuthController.php?action=logout">Déconnexion</a>
<?php else: ?>
    <a href="/vite-gourmand/src/views/auth/login.php">Connexion</a><br>
    <a href="/vite-gourmand/src/views/auth/register.php">Créer un compte</a>
    <a href="index.php?page=order&id=<?= $menu['id'] ?>">🛒 Commander</a>
<?php endif; ?>
<?php require __DIR__ . '/partials/footer.php'; ?>


