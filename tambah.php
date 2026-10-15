<?php
require_once 'includes/cek_login.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama_paket']);
    $jenis = $_POST['jenis'];
    $harga = (int)$_POST['harga'];
    $jam   = (int)$_POST['estimasi_jam'];
    $desk  = trim($_POST['deskripsi']);

    if ($nama === '' || !in_array($jenis, ['Kiloan', 'Satuan', 'Express']) || $harga <= 0 || $jam <= 0) {
        $error = 'Data tidak valid. Harga dan estimasi harus lebih dari 0.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO paket_layanan (nama_paket, jenis, harga, estimasi_jam, deskripsi) VALUES (?,?,?,?,?)');
        $stmt->execute([$nama, $jenis, $harga, $jam, $desk]);
        header('Location: index.php');
        exit;
    }
}

$judul = 'Tambah Paket';
include 'includes/header.php';
?>
<h2>Tambah Paket Layanan</h2>
<?php if ($error): ?><div class="error"><?= e($error) ?></div><?php endif; ?>
<form method="post">
    <label>Nama Paket</label>
    <input type="text" name="nama_paket" required>

    <label>Jenis</label>
    <select name="jenis" required>
        <option value="Kiloan">Kiloan</option>
        <option value="Satuan">Satuan</option>
        <option value="Express">Express</option>
    </select>

    <label>Harga (Rp)</label>
    <input type="number" name="harga" min="1" required>

    <label>Estimasi (jam)</label>
    <input type="number" name="estimasi_jam" min="1" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi"></textarea>

    <button type="submit">Simpan</button>
    <a href="index.php" class="btn btn-abu">Batal</a>
</form>
<?php include 'includes/footer.php'; ?>
