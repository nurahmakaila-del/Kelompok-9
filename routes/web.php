<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pelanggan', PelangganController::class)->except('show');