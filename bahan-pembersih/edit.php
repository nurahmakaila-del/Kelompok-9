<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bahan Pembersih</title>
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

            <h2 style="margin-bottom:24px;">Edit Bahan Pembersih</h2>

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

            <form action="edit.php?id=<?= $id ?>" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">

                <div class="form-group">
                    <label for="nama_bahan">Nama Bahan</label>
                    <input type="text" id="nama_bahan" name="nama_bahan" value="<?= e($old['nama_bahan']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="merek">Merek</label>
                    <input type="text" id="merek" name="merek" value="<?= e($old['merek']) ?>">
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" value="<?= e($old['stok']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" id="satuan" name="satuan" value="<?= e($old['satuan']) ?>" required>
                </div>

                <div class="actions">
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>

</body>
</html>