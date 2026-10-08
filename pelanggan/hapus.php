<?php
require __DIR__ . '/../config/koneksi.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('DELETE FROM pelanggans WHERE id = ?');
$stmt->execute([$id]);

header('Location: index.php');
exit;
