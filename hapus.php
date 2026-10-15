<?php
require_once 'includes/cek_login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $stmt = $pdo->prepare('DELETE FROM paket_layanan WHERE id = ?');
    $stmt->execute([$id]);
}
header('Location: index.php');
exit;
