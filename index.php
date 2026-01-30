<?php
session_start();

// Page demandée
$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'login':
        require __DIR__ . '/src/controllers/AuthController.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php');
        exit;

    case 'admin':
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }

        echo "<h1>Zone Admin</h1>";
        echo "<p>Bienvenue " . htmlspecialchars($_SESSION['user']['firstname']) . "</p>";
        echo '<p><a href="index.php?page=menus_admin">🍽️ Gérer les menus</a></p>';
        echo '<p><a href="index.php?page=users">Gérer les employés</a></p>';
        echo '<p><a href="index.php?page=admin_orders">📦 Gérer les commandes</a></p>';
        echo '<p><a href="index.php?page=logout">Se déconnecter</a></p>';
        break;

    case 'admin_orders':
        require __DIR__ . '/admin/orders.php';
        break;

    case 'users':
        require __DIR__ . '/src/controllers/UserController.php';
        break;

    case 'menus':
        require __DIR__ . '/src/controllers/MenuPublicController.php';
        break;

    case 'menus_admin':
        require __DIR__ . '/src/controllers/MenuController.php';
        break;

    case 'order':
        require __DIR__ . '/src/controllers/OrderController.php';
        break;

        case 'my_orders':
        require __DIR__ . '/src/controllers/MyOrdersController.php';
        break;

    default:
        echo "<h1>Accueil Vite Gourmand</h1>";

        if (isset($_SESSION['user'])) {
            echo '<p><a href="index.php?page=menus">🍽️ Voir les menus</a></p>';

            if ($_SESSION['user']['role'] === 'admin') {
                echo '<p><a href="index.php?page=admin">Zone Admin</a></p>';
            }

            echo '<p><a href="index.php?page=my_orders">📦 Mes commandes</a></p>';
            echo '<p><a href="index.php?page=logout">Se déconnecter</a></p>';
        } else {
            echo '<p><a href="index.php?page=login">Se connecter</a></p>';
        }
        break;
}



