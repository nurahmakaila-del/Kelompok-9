<?php
$conn = new mysqli('localhost', 'root', '', 'kelompok_9');

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}