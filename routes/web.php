<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanPembersihController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bahan-pembersih', [BahanPembersihController::class, 'index']);

Route::get('/bahan-pembersih/create', [BahanPembersihController::class, 'create']);

Route::post('/bahan-pembersih', [BahanPembersihController::class, 'store']);

Route::delete('/bahan-pembersih/{id}', [BahanPembersihController::class, 'destroy']);