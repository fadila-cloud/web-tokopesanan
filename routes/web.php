<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TokoController;

// Route::view maps the root URL ("/") to the welcome view.
// When a user navigates to the application's root URL, they will see the welcome view.
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    // Defines a route for the "/dashboard" URL which would render the 'dashboard' view when accessed
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    // This will automatically create multiple routes for the 'Perpustakaan' resource or in your case, routes to handle book related requests. The standard routes created for this would be create, read, update, delete and others
    Route::resource('toko', TokoController::class)->names('toko');
    Route::resource('pesanan', PesananController::class)->names('pesanan'); 
});
    // The fallback method is used to define a route that will be executed when no other route matches the incoming request.
    Route::fallback(function () {
        // When no other route is matched, the 'error' view is displayed
        return view('layouts.error');
      });

Route::middleware(['auth'])->group(function () {
    //menambah alamat ke pesanan
    Route::view('', 'welcome'); 
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan.create', [PesananController::class, 'create'])->name('pesanan.create'); 
    Route::post('/pesanan',[PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');   

    //menambah alamat ke toko
    Route::view('', 'welcome'); 
    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::get('/toko/create', [TokoController::class, 'create'])->name('toko.create'); 
    Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');  
    Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show'); 

});  