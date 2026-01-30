<?php
// src/controllers/UserController.php

require_once __DIR__ . '/../config/db.php';

// Sécurité : admin seulement
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?page=login');
    exit;
}

// =======================
// AJOUT D'UN EMPLOYÉ
// =======================
if (isset($_POST['add_employee'])) {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO users (firstname, lastname, email, password, role)
        VALUES (?, ?, ?, ?, 'employee')
    ");

    $stmt->execute([$firstname, $lastname, $email, $password]);
}

// =======================
// SUPPRESSION D'UN UTILISATEUR
// =======================
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    // Sécurité : ne pas supprimer soi-même
    if ($id !== (int)$_SESSION['user']['id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}

// =======================
// LISTE DES UTILISATEURS
// =======================
$users = $pdo->query("SELECT id, firstname, lastname, email, role FROM users ORDER BY id DESC")->fetchAll();

// =======================
// AFFICHAGE
// =======================
require __DIR__ . '/../views/admin/users.php';