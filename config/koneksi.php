<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$port = '3306';          // ganti ke 3306 kalau MySQL kamu pakai port default
$db   = 'laundry_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Koneksi gagal: ' . $e->getMessage());
}

// helper biar output aman dari XSS
function e($teks) {
    return htmlspecialchars($teks ?? '', ENT_QUOTES, 'UTF-8');
}
