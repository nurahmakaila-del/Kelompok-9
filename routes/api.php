<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;

Route::apiResource('pelanggan', PelangganController::class);