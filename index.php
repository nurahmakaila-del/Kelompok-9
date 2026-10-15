<?php
require 'includes/auth_check.php';
require 'config/koneksi.php';

$pakets = $pdo->query("SELECT * FROM paket_layanan ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head><title>Layanan & Tarif</title></head>
<body>
  <h2>Daftar Paket Layanan</h2>
  <p>Halo, <?= htmlspecialchars($_SESSION['nama']) ?> | <a href="logout.php">Logout</a></p>
  <a href="create.php">+ Tambah Paket</a>
  <br><br>
  <table border="1" cellpadding="6">
    <tr>
      <th>No</th><th>Nama</th><th>Jenis</th><th>Harga</th><th>Estimasi</th><th>Aksi</th>
    </tr>
    <?php foreach ($pakets as $i => $p): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= htmlspecialchars($p['nama_paket']) ?></td>
      <td><?= $p['jenis'] ?></td>
      <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
      <td><?= $p['estimasi_jam'] ?> jam</td>
      <td>
        <a href="edit.php?id=<?= $p['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>