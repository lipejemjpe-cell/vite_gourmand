<!DOCTYPE html>
<?php require __DIR__ . '/partials/header.php'; ?>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion - Vite Gourmand</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Connexion</h1>

    <form method="post" action="index.php?page=login">
        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
<?php require __DIR__ . '/partials/footer.php'; ?>
