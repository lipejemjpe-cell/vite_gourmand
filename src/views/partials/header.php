<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vite Gourmand</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<nav style="padding:10px; background:#222;">
    <a href="index.php" style="color:white; margin-right:15px;">🏠 Accueil</a>
    <a href="index.php?page=menus" style="color:white; margin-right:15px;">🍽️ Menus</a>

    <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?page=my_orders" style="color:white; margin-right:15px;">📦 Mes commandes</a>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?page=admin" style="color:orange; margin-right:15px;">⚙️ Admin</a>
        <?php endif; ?>

        <a href="index.php?page=logout" style="color:red;">🚪 Déconnexion</a>
    <?php else: ?>
        <a href="index.php?page=login" style="color:white;">🔑 Connexion</a>
    <?php endif; ?>
</nav>

<hr>