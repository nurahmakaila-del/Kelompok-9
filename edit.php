<?php
require 'includes/auth_check.php';
require 'config/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM paket_layanan WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$p) { die('Data tidak ditemukan'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upd = $pdo->prepare(
        "UPDATE paket_layanan
         SET nama_paket=?, jenis=?, harga=?, satuan=?, estimasi_jam=?, deskripsi=?
         WHERE id=?"
    );
    $upd->execute([
        $_POST['nama_paket'], $_POST['jenis'], $_POST['harga'],
        $_POST['satuan'], $_POST['estimasi_jam'], $_POST['deskripsi'], $id
    ]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Paket</title></head>
<body>
  <h2>Edit Paket</h2>
  <form method="POST">
    <label>Nama Paket</label><br>
    <input type="text" name="nama_paket" value="<?= htmlspecialchars($p['nama_paket']) ?>" required><br>

    <label>Jenis</label><br>
    <select name="jenis">
      <?php foreach (['Kiloan','Satuan','Express'] as $j): ?>
        <option <?= $p['jenis'] === $j ? 'selected' : '' ?>><?= $j ?></option>
      <?php endforeach; ?>
    </select><br>

    <label>Harga (Rp)</label><br>
    <input type="number" name="harga" value="<?= $p['harga'] ?>" required><br>

    <label>Satuan</label><br>
    <input type="text" name="satuan" value="<?= htmlspecialchars($p['satuan']) ?>" required><br>

    <label>Estimasi (jam)</label><br>
    <input type="number" name="estimasi_jam" value="<?= $p['estimasi_jam'] ?>" required><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"><?= htmlspecialchars($p['deskripsi']) ?></textarea><br>

    <button type="submit">Update</button>
    <a href="index.php">Batal</a>
  </form>
</body>
</html>