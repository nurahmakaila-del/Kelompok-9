<?php
require 'includes/auth_check.php';
require 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO paket_layanan (nama_paket, jenis, harga, satuan, estimasi_jam, deskripsi)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $_POST['nama_paket'], $_POST['jenis'], $_POST['harga'],
        $_POST['satuan'], $_POST['estimasi_jam'], $_POST['deskripsi']
    ]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Paket</title></head>
<body>
  <h2>Tambah Paket</h2>
  <form method="POST">
    <label>Nama Paket</label><br>
    <input type="text" name="nama_paket" required><br>

    <label>Jenis</label><br>
    <select name="jenis">
      <option>Kiloan</option><option>Satuan</option><option>Express</option>
    </select><br>

    <label>Harga (Rp)</label><br>
    <input type="number" name="harga" min="0" required><br>

    <label>Satuan</label><br>
    <input type="text" name="satuan" value="kg" required><br>

    <label>Estimasi (jam)</label><br>
    <input type="number" name="estimasi_jam" min="1" required><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"></textarea><br>

    <button type="submit">Simpan</button>
    <a href="index.php">Batal</a>
  </form>
</body>
</html>