<?php
require_once 'config/koneksi.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama'];
        header('Location: index.php');
        exit;
    }
    $error = 'Username atau password salah.';
}

$judul = 'Login';
include 'includes/header.php';
?>
<div class="narrow">
    <h2>Login</h2>
    <?php if (isset($_GET['daftar'])): ?><div class="sukses">Registrasi berhasil, silakan login.</div><?php endif; ?>
    <?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Masuk</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
<?php include 'includes/footer.php'; ?>
