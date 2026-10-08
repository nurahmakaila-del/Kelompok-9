<?php
require __DIR__ . '/../auth/session.php';
wajib_login();
require __DIR__ . '/../config/koneksi.php';
$data = $pdo->query('SELECT * FROM pelanggans ORDER BY id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Pelanggan</h3>
        <a href="tambah.php" class="btn btn-primary">+ Tambah</a>
    </div>
    <table class="table table-bordered">
        <thead><tr><th>No</th><th>Nama</th><th>Alamat</th><th>No. Telepon</th><th>Catatan Khusus</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach ($data as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['nama']) ?></td>
                <td><?= htmlspecialchars($p['alamat']) ?></td>
                <td><?= htmlspecialchars($p['no_telepon']) ?></td>
                <td><?= htmlspecialchars($p['catatan_khusus']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$data): ?>
            <tr><td colspan="6" class="text-center">Belum ada data</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>