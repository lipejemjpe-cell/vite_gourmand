<?php
// Contrôleur d'authentification

require_once __DIR__ . '/../config/db.php';

// Si le formulaire est envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération des données
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Recherche de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérification du mot de passe hashé
    if ($user && password_verify($password, $user['password'])) {

        // Stockage en session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'role' => $user['role']
        ];

        // Redirection selon le rôle
        if ($user['role'] === 'admin') {
            header('Location: index.php?page=admin');
        } else {
            header('Location: index.php');
        }
        exit;

    } else {
        $error = "Email ou mot de passe incorrect";
    }
}

// Affichage de la vue
require __DIR__ . '/../views/login.php';