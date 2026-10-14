<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan Pembersih</title>
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

    <div class="container-sm page">
        <div class="card">

            <h2>Tambah Bahan Pembersih</h2>
            <p class="muted" style="margin-bottom:24px;">Masukkan informasi bahan pembersih baru.</p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <strong>Ada kesalahan:</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= e($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="create.php" method="POST">

                <div class="form-group">
                    <label for="nama_bahan">Nama Bahan</label>
                    <input type="text" id="nama_bahan" name="nama_bahan"
                        value="<?= e($old['nama_bahan']) ?>" placeholder="Contoh: Deterjen" required>
                </div>

                <div class="form-group">
                    <label for="merek">Merek</label>
                    <input type="text" id="merek" name="merek"
                        value="<?= e($old['merek']) ?>" placeholder="Contoh: Rinso">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" id="stok" name="stok"
                            value="<?= e($old['stok']) ?>" min="0" placeholder="0" required>
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select id="satuan" name="satuan" required>
                            <option value="">Pilih satuan</option>
                            <option value="kg" <?= $old['satuan'] === 'kg' ? 'selected' : '' ?>>Kilogram (kg)</option>
                            <option value="liter" <?= $old['satuan'] === 'liter' ? 'selected' : '' ?>>Liter</option>
                            <option value="pcs" <?= $old['satuan'] === 'pcs' ? 'selected' : '' ?>>Pcs</option>
                            <option value="botol" <?= $old['satuan'] === 'botol' ? 'selected' : '' ?>>Botol</option>
                        </select>
                    </div>
                </div>

                <div class="actions">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Bahan</button>
                </div>

            </form>

        </div>
    </div>

</body>
</html>