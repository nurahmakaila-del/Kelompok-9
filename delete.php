<?php
require '../includes/auth_check.php';
require '../config/database.php';

$id = (int) ($_GET['id'] ?? 0);
$pdo->prepare("DELETE FROM paket_layanan WHERE id = ?")->execute([$id]);
header('Location: index.php');