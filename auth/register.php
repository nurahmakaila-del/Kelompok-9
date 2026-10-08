<?php

require __DIR__ . '/../config/koneksi.php';
require __DIR__ . '/session.php';

$error = '';
$nama = $username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nama === '' || $username === '' || $password === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO pengguna (nama, username, password) VALUES (?, ?, ?)');
            $stmt->execute([$nama, $username, password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: login.php?daftar=1');
            exit;
        } catch (PDOException $e) {
            $error = $e->getCode() == 23000 ? 'Username sudah dipakai.' : 'Gagal mendaftar.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5" style="max-width:420px">
    <h3 class="mb-3">Daftar Akun</h3>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3"><label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>"></div>
        <div class="mb-3"><label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>"></div>
        <div class="mb-3"><label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"></div>
        <button class="btn btn-primary w-100">Daftar</button>
    </form>
    <p class="mt-3 text-center">Sudah punya akun? <a href="login.php">Masuk</a></p>
</div>
</body>
</html>