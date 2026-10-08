<?php
require __DIR__ . '/../config/koneksi.php';

$error = '';
$nama = $alamat = $no_telepon = $catatan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = trim($_POST['nama'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_telepon = trim($_POST['no_telepon'] ?? '');
    $catatan    = trim($_POST['catatan_khusus'] ?? '');

    if ($nama === '' || $no_telepon === '') {
        $error = 'Nama dan No. Telepon wajib diisi.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO pelanggans (nama, alamat, no_telepon, catatan_khusus, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())');
            $stmt->execute([$nama, $alamat, $no_telepon, $catatan]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = $e->getCode() == 23000 ? 'No. Telepon sudah terdaftar.' : 'Gagal menyimpan: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>Tambah Pelanggan</h3>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3"><label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>"></div>
        <div class="mb-3"><label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control"><?= htmlspecialchars($alamat) ?></textarea></div>
        <div class="mb-3"><label class="form-label">No. Telepon</label>
            <input type="text" name="no_telepon" class="form-control" value="<?= htmlspecialchars($no_telepon) ?>"></div>
        <div class="mb-3"><label class="form-label">Catatan Khusus Pakaian</label>
            <textarea name="catatan_khusus" class="form-control"><?= htmlspecialchars($catatan) ?></textarea></div>
        <button class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>