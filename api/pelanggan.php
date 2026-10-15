<?php
require __DIR__ . '/../auth/session.php';
wajib_login_api();
require __DIR__ . '/../config/koneksi.php';

header('Content-Type: application/json; charset=utf-8');

function kirim($data, int $status = 200): void
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function cari(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare('SELECT * FROM pelanggans WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
}

$method = $_SERVER['REQUEST_METHOD'];
$id = (int)($_GET['id'] ?? 0);
if (!$id && !empty($_SERVER['PATH_INFO'])) {
    $id = (int)trim($_SERVER['PATH_INFO'], '/');
}

$input = json_decode(file_get_contents('php://input'), true) ?? [];
if (!$input && $method === 'POST') {
    $input = $_POST;
}

$nama       = trim($input['nama'] ?? '');
$alamat     = trim($input['alamat'] ?? '');
$no_telepon = trim($input['no_telepon'] ?? '');
$catatan    = trim($input['catatan_khusus'] ?? '');

try {
    switch ($method) {
        case 'GET':
            if ($id) {
                $p = cari($pdo, $id);
                $p ? kirim(['data' => $p]) : kirim(['pesan' => 'Data tidak ditemukan'], 404);
            }
            kirim(['data' => $pdo->query('SELECT * FROM pelanggans ORDER BY id DESC')->fetchAll()]);

        case 'POST':
            if ($nama === '' || $no_telepon === '') {
                kirim(['pesan' => 'nama dan no_telepon wajib diisi'], 422);
            }
            $stmt = $pdo->prepare('INSERT INTO pelanggans (nama, alamat, no_telepon, catatan_khusus, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())');
            $stmt->execute([$nama, $alamat, $no_telepon, $catatan]);
            kirim(['pesan' => 'Pelanggan ditambahkan', 'data' => cari($pdo, (int)$pdo->lastInsertId())], 201);

        case 'PUT':
        case 'PATCH':
            if (!$id || !cari($pdo, $id)) {
                kirim(['pesan' => 'Data tidak ditemukan'], 404);
            }
            if ($nama === '' || $no_telepon === '') {
                kirim(['pesan' => 'nama dan no_telepon wajib diisi'], 422);
            }
            $stmt = $pdo->prepare('UPDATE pelanggans SET nama = ?, alamat = ?, no_telepon = ?, catatan_khusus = ?, updated_at = NOW() WHERE id = ?');
            $stmt->execute([$nama, $alamat, $no_telepon, $catatan, $id]);
            kirim(['pesan' => 'Pelanggan diperbarui', 'data' => cari($pdo, $id)]);

        case 'DELETE':
            if (!$id || !cari($pdo, $id)) {
                kirim(['pesan' => 'Data tidak ditemukan'], 404);
            }
            $pdo->prepare('DELETE FROM pelanggans WHERE id = ?')->execute([$id]);
            kirim(['pesan' => 'Pelanggan dihapus']);

        default:
            kirim(['pesan' => 'Method tidak didukung'], 405);
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        kirim(['pesan' => 'No. telepon sudah terdaftar'], 409);
    }
    kirim(['pesan' => 'Kesalahan server'], 500);
}