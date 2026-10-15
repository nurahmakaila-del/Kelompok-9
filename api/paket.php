<?php
require_once __DIR__ . '/../config/koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;
$input  = json_decode(file_get_contents('php://input'), true) ?? [];

function kirim($status, $data) {
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// GET boleh publik, selain itu harus login
if ($method !== 'GET' && !isset($_SESSION['user_id'])) {
    kirim(401, ['pesan' => 'Harus login dulu.']);
}

function valid($d) {
    return !empty($d['nama_paket'])
        && in_array($d['jenis'] ?? '', ['Kiloan', 'Satuan', 'Express'])
        && (int)($d['harga'] ?? 0) > 0
        && (int)($d['estimasi_jam'] ?? 0) > 0;
}

switch ($method) {
    case 'GET':
        if ($id) {
            $s = $pdo->prepare('SELECT * FROM paket_layanan WHERE id = ?');
            $s->execute([$id]);
            $row = $s->fetch();
            $row ? kirim(200, $row) : kirim(404, ['pesan' => 'Data tidak ditemukan']);
        }
        kirim(200, $pdo->query('SELECT * FROM paket_layanan ORDER BY id DESC')->fetchAll());
        break;

    case 'POST':
        if (!valid($input)) kirim(400, ['pesan' => 'Data tidak valid']);
        $s = $pdo->prepare('INSERT INTO paket_layanan (nama_paket, jenis, harga, estimasi_jam, deskripsi) VALUES (?,?,?,?,?)');
        $s->execute([$input['nama_paket'], $input['jenis'], (int)$input['harga'], (int)$input['estimasi_jam'], $input['deskripsi'] ?? '']);
        kirim(201, ['pesan' => 'Berhasil ditambah', 'id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        if (!$id || !valid($input)) kirim(400, ['pesan' => 'ID atau data tidak valid']);
        $s = $pdo->prepare('UPDATE paket_layanan SET nama_paket=?, jenis=?, harga=?, estimasi_jam=?, deskripsi=? WHERE id=?');
        $s->execute([$input['nama_paket'], $input['jenis'], (int)$input['harga'], (int)$input['estimasi_jam'], $input['deskripsi'] ?? '', $id]);
        kirim(200, ['pesan' => 'Berhasil diupdate']);
        break;

    case 'DELETE':
        if (!$id) kirim(400, ['pesan' => 'ID wajib diisi']);
        $s = $pdo->prepare('DELETE FROM paket_layanan WHERE id = ?');
        $s->execute([$id]);
        kirim(200, ['pesan' => 'Berhasil dihapus']);
        break;

    default:
        kirim(405, ['pesan' => 'Method tidak diizinkan']);
}
