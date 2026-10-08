<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function wajib_login(): void
{
    if (empty($_SESSION['user'])) {
        header('Location: ../auth/login.php');
        exit;
    }
}

function wajib_login_api(): void
{
    if (empty($_SESSION['user'])) {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['pesan' => 'Belum login'], JSON_UNESCAPED_UNICODE);
        exit;
    }
}