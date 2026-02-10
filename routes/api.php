<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\TransaksiStokController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);

  Route::apiResource('/kategori', KategoriController::class);
  Route::apiResource('/produk', ProdukController::class);
  Route::post('/transaksi-stok', [TransaksiStokController::class, 'store']);
});
