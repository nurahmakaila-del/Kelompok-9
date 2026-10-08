<?php

use App\Http\Controllers\BahanPembersihController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('bahan-pembersih', BahanPembersihController::class);