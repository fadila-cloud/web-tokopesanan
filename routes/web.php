<?php 

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\TokodanPesanan\TokoController;
use App\Http\Controllers\TokodanPesanan\PesananController; 

// Route::view maps the root URL ("/") to the welcome view.
Route::view('/', 'welcome'); 

// It groups the routes that are contained within it. The routes within this group have two middleware, 'auth:sanctum' and 'verified' that provide an authentication layer.
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
  // Defines a route for the "/dashboard" URL which would render the 'dashboard' view when accessed
  Route::view('/dashboard', 'dashboard')->name('dashboard'); 

  // This will automatically create multiple routes for the 'Tokos' resource or in your case, routes to handle book related requests. The standard routes created for this would be create, read, update, delete and others
  // Use resource routes for `toko` and `pesanan`
  Route::resource('toko', TokoController::class)->names('toko'); 
  Route::resource('pesanan', PesananController::class)->names('pesanan');  
});

// The fallback method is used to define a route that will be executed when no other route matches the incoming request.
Route::fallback(function () { 
  //When no other route is matched, the 'error' view is displayed
  return view('layout.error'); 
});  
 

