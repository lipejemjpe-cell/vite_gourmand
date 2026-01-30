<h2>Créer un compte</h2>

<form method="POST" action="/vite-gourmand/src/controllers/AuthController.php?action=register">
    <input type="text" name="firstname" placeholder="Prénom" required><br>
    <input type="text" name="lastname" placeholder="Nom" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">S'inscrire</button>
</form>
