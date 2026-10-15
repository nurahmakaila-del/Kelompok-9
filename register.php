<?php
require_once 'config/koneksi.php';

// Fallback kalau fungsi e() belum didefinisikan di koneksi.php / header.php
if (!function_exists('e')) {
    function e(string $s): string
    {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }
}

const PASSWORD_MIN_LENGTH = 6;

$error    = '';
$nama     = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nama === '' || $username === '') {
        $error = 'Nama lengkap dan username wajib diisi.';
    } elseif (strlen($password) < PASSWORD_MIN_LENGTH) {
        $error = 'Password minimal ' . PASSWORD_MIN_LENGTH . ' karakter.';
    } else {
        $cek = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $cek->execute([$username]);

        if ($cek->fetch()) {
            $error = 'Username sudah dipakai.';
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO users (nama, username, password) VALUES (?, ?, ?)'
            );
            $stmt->execute([
                $nama,
                $username,
                password_hash($password, PASSWORD_DEFAULT),
            ]);

            header('Location: login.php?daftar=ok');
            exit;
        }
    }
}

$judul = 'Register';
include 'includes/header.php';
?>
<div class="narrow">
    <h2>Register</h2>

    <?php if ($error !== ''): ?>
        <div class="error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="nama">Nama lengkap</label>
        <input type="text" id="nama" name="nama" value="<?= e($nama) ?>" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= e($username) ?>" required>

        <label for="password">Password (min. <?= PASSWORD_MIN_LENGTH ?> karakter)</label>
        <input type="password" id="password" name="password" minlength="<?= PASSWORD_MIN_LENGTH ?>" required>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
<?php include 'includes/footer.php'; ?>