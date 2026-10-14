<?php
session_start();
include '../config/koneksi.php';

$result = $conn->query("SELECT * FROM bahan_pembersihs ORDER BY id ASC");
$bahanPembersih = $result->fetch_all(MYSQLI_ASSOC);

$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);

function e($text) {
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Pembersih</title>
    <style>
        @import url('../assets/css/style.css');
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="index.php">Sistem Operasional Laundry</a>
        </div>
    </nav>

    <div class="container page">
        <div class="card">

            <div class="page-header">
                <div>
                    <h2>Data Bahan Pembersih</h2>
                    <p class="muted">Kelola stok bahan pembersih laundry</p>
                </div>
                <a href="create.php" class="btn btn-primary">+ Tambah Bahan</a>
            </div>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    <button type="button" class="close" onclick="this.parentElement.style.display='none'">&times;</button>
                    <?= e($success) ?>
                </div>
            <?php endif; ?>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Merek</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($bahanPembersih) > 0): ?>
                            <?php foreach ($bahanPembersih as $index => $bahan): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="nama"><?= e($bahan['nama_bahan']) ?></td>
                                    <td><?= e($bahan['merek'] ?? '-') ?></td>
                                    <td><span class="badge"><?= e($bahan['stok']) ?></span></td>
                                    <td><?= e($bahan['satuan']) ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= (int) $bahan['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="delete.php" method="POST" class="inline">
                                            <input type="hidden" name="id" value="<?= (int) $bahan['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus bahan ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty">
                                    <h3>Belum ada data</h3>
                                    <p>Belum ada bahan pembersih yang ditambahkan.</p>
                                    <a href="create.php" class="btn btn-primary">+ Tambah Bahan</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>