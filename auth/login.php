<?php

require __DIR__ . '/../config/koneksi.php';
require __DIR__ . '/session.php';

if (!empty($_SESSION['user'])) {
    header('Location: ../pelanggan/index.php');
    exit;
}

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM pengguna WHERE username = ?');
    $stmt->execute([$username]);
    $u = $stmt->fetch();

    if ($u && password_verify($password, $u['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => $u['id'], 'nama' => $u['nama'], 'username' => $u['username']];
        header('Location: ../pelanggan/index.php');
        exit;
    }
    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5" style="max-width:420px">
    <h3 class="mb-3">Login</h3>
    <?php if (isset($_GET['daftar'])): ?><div class="alert alert-success">Akun dibuat, silakan login.</div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3"><label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>"></div>
        <div class="mb-3"><label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"></div>
        <button class="btn btn-primary w-100">Masuk</button>
    </form>
    <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
</body>
</html>