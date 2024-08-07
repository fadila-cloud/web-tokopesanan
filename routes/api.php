<?php

use App\Http\Controllers\Tokopesanan\PesananController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/pesanan/{id}', [PesananController::class, 'show']);
Route::post('/pesanan', [PesananController::class, 'store']);
Route::put ('/pesanan/{id}', [PesananController::class, 'update']);
Route::delete('/pesanan/{id}', [PesananController::class, 'destroy']); 