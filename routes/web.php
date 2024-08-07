<?php 

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Tokopesanan\TokoController;
use App\Http\Controllers\Tokopesanan\PesananController; 

// Route::view maps the root URL ("/") to the welcome view.
// When a user navigates to the application's root URL, they will see the welcome view.
Route::view('/', 'welcome'); 

// It groups the routes that are contained within it. The routes within this group have two middleware, 'auth:sanctum' and 'verified' that provide an authentication layer.
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
  // Defines a route for the "/dashboard" URL which would render the 'dashboard' view when accessed
  Route::view('/dashboard', 'dashboard')->name('dashboard');  
  // Route::view('/toko', 'toko')->name('toko');
  // Route::get('/toko', [TokoController::class, 'index'])->name('toko'); 


  // This will automatically create multiple routes for the 'Tokos' resource or in your case, routes to handle book related requests. The standard routes created for this would be create, read, update, delete and others
  Route::resource('toko', TokoController::class)->names('toko'); 
  Route::resource('pesanan', PesananController::class)->names('pesanan');  
});
 
// The fallback method is used to define a route that will be executed when no other route matches the incoming request.
// Route::fallback(function () {
  // When no other route is matched, the 'error' view is displayed
//   return view('layouts.error');
// });

//     Route::middleware(['auth'])->group(function () {
//         // Halaman selamat datang
//         Route::view('/', 'welcome')->name('home'); // Hanya satu deklarasi Route::view('/') yang diperlukan
//         // Rute untuk Toko
//         Route::group(['prefix' => 'toko'], function () {
//             Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
//             Route::get('/toko.create', [TokoController::class, 'create'])->name('toko.create');
//             Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
//             Route::get('/toko{id}', [TokoController::class, 'show'])->name('toko.show');
//         });
//     });

