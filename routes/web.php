<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TokoController;

//saya matikan alamat ini 
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware(['auth'])->group(function () {
    //menambah alamat ke pesanan
    Route::get('/pesanans', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanans.create', [PesananController::class, 'create'])->name('pesanan.create'); 
    Route::post('/pesanans',[PesananController::class, 'store'])->name('pesanan.store'); 

    //menambah alamat ke toko
    Route::get('/tokos', [TokoController::class, 'index'])->name('toko.index');
    Route::get('/tokos/create', [TokoController::class, 'create'])->name('toko.create'); 
    Route::post('/tokos', [TokoController::class, 'store'])->name('toko.store');  

});  