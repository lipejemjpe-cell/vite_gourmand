<h1>Gestion des employés</h1>

<h2>Ajouter un employé</h2>

<form method="post">
    <input type="text" name="firstname" placeholder="Prénom" required><br><br>
    <input type="text" name="lastname" placeholder="Nom" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>

    <button type="submit" name="add_employee">Créer le compte employé</button>
</form>

<hr>

<h2>Utilisateurs</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Rôle</th>
    <th>Action</th>
</tr>

<?php foreach ($users as $user): ?>
<tr>
    <td><?= $user['id'] ?></td>
    <td><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></td>
    <td><?= htmlspecialchars($user['email']) ?></td>
    <td><?= $user['role'] ?></td>
    <td>
        <?php if ($user['id'] != $_SESSION['user']['id']): ?>
            <a href="index.php?page=users&delete=<?= $user['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">🗑 Supprimer</a>
        <?php else: ?>
            —
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>