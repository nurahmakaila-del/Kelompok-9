<?php
header('Content-Type: application/json');
require '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM paket_layanan WHERE id = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$data) { http_response_code(404); $data = ['error' => 'Tidak ditemukan']; }
        } else {
            $data = $pdo->query("SELECT * FROM paket_layanan")->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($data);
        break;

    case 'POST':
        $stmt = $pdo->prepare(
            "INSERT INTO paket_layanan (nama_paket, jenis, harga, satuan, estimasi_jam, deskripsi)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $input['nama_paket'], $input['jenis'], $input['harga'],
            $input['satuan'], $input['estimasi_jam'], $input['deskripsi'] ?? null
        ]);
        http_response_code(201);
        echo json_encode(['message' => 'Berhasil ditambah', 'id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        $stmt = $pdo->prepare(
            "UPDATE paket_layanan
             SET nama_paket=?, jenis=?, harga=?, satuan=?, estimasi_jam=?, deskripsi=?
             WHERE id=?"
        );
        $stmt->execute([
            $input['nama_paket'], $input['jenis'], $input['harga'],
            $input['satuan'], $input['estimasi_jam'], $input['deskripsi'] ?? null, $id
        ]);
        echo json_encode(['message' => 'Berhasil diubah']);
        break;

    case 'DELETE':
        $pdo->prepare("DELETE FROM paket_layanan WHERE id = ?")->execute([$id]);
        echo json_encode(['message' => 'Berhasil dihapus']);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method tidak diizinkan']);
}