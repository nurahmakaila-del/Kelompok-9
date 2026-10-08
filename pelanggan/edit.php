<?php
require __DIR__ . '/../auth/session.php';
wajib_login();
require __DIR__ . '/../config/koneksi.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM pelanggans WHERE id = ?');
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) {
    http_response_code(404);
    die('Data tidak ditemukan.');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p['nama']           = trim($_POST['nama'] ?? '');
    $p['alamat']         = trim($_POST['alamat'] ?? '');
    $p['no_telepon']     = trim($_POST['no_telepon'] ?? '');
    $p['catatan_khusus'] = trim($_POST['catatan_khusus'] ?? '');

    if ($p['nama'] === '' || $p['no_telepon'] === '') {
        $error = 'Nama dan No. Telepon wajib diisi.';
    } else {
        try {
            $stmt = $pdo->prepare('UPDATE pelanggans SET nama = ?, alamat = ?, no_telepon = ?, catatan_khusus = ?, updated_at = NOW() WHERE id = ?');
            $stmt->execute([$p['nama'], $p['alamat'], $p['no_telepon'], $p['catatan_khusus'], $id]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = $e->getCode() == 23000 ? 'No. Telepon sudah dipakai pelanggan lain.' : 'Gagal menyimpan: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>Edit Pelanggan</h3>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3"><label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($p['nama']) ?>"></div>
        <div class="mb-3"><label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control"><?= htmlspecialchars($p['alamat']) ?></textarea></div>
        <div class="mb-3"><label class="form-label">No. Telepon</label>
            <input type="text" name="no_telepon" class="form-control" value="<?= htmlspecialchars($p['no_telepon']) ?>"></div>
        <div class="mb-3"><label class="form-label">Catatan Khusus Pakaian</label>
            <textarea name="catatan_khusus" class="form-control"><?= htmlspecialchars($p['catatan_khusus']) ?></textarea></div>
        <button class="btn btn-primary">Perbarui</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>