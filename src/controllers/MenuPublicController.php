<?php
require_once __DIR__ . '/../config/db.php';

$stmt = $pdo->query("SELECT * FROM menus WHERE stock > 0");
$menus = $stmt->fetchAll();

require __DIR__ . '/../views/menus_public.php';