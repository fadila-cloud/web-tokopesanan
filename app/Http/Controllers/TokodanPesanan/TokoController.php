<?php

namespace App\Http\Controllers\TokodanPesanan;  

use App\Http\Controllers\Controller;     
use App\Models\tokosdanpesanans\Toko;     
use App\Models\User;  
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportValidation\BaseRule; 

class TokoController extends Controller 
{
  /**
   * Display a listing of the resource.
   */
  //menampilkan daftar toko
  public function index()
  { 
    $toko = Toko::all(); 
    // Get the currently logged in user's ID
    $user_id = Auth::user()->id;
    if ($user_id) { 
      return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.'); 
    }
    // Get all the stores and the orders ordered and searched by the user 
    $toko = user::find($user_id)->toko; 
    
    // Return the page view with order and store has been searched and ordered
    return view('pages.tokodanpesanan.index', compact('toko'));   
  }

  /** 
    * Show the form for creating a new resource.
    */
  //menampilkan form untuk merubah toko 
  public function create()
  {
    /** Return the form view to create a new store 
      * Mengembalikan tampilan formulir untuk membuat toko 
      */ 
    return view('pages.tokodanpesanan.create');
  }
  
  /**
    * Store a newly created resource in storage.
    */ 
  public function store(Request $request)
  {
    // Validate the input data 
    $request->validate([ 
      'nama_toko' => 'required', 
      'address'=> 'required', 
    ]);
  
    // Try to create a new store 
    try {
      Toko::create([  
        'nama_toko' => $request->nama_toko,
        'address' => $request->address, 
        'user_id' => Auth::user()->id,
      ]);

      // Redirect back to the page with a success message
      return redirect()->route('toko.index')->with('success', 'Toko berhasil dibuat.'); 
    } catch (\Throwable $e) {
      // Log error message if failed to create a store 
      Log::error($e->getMessage());
    
      // Redirect back to the page with an error message
      return redirect()->route('toko.index')->with('error', 'Toko gagal dibuat.');
    }
  }
    
  /**
    * Display the specified resource.
    */
  public function show(string $id)  
  {
    // Get store data with connected user information
    $toko = Toko::with('user')->find($id);   

    // Periksa apakah data ditemukan
    if ($toko === null) {
      return redirect()->routes('toko.index')->with('erorr', 'Toko tidak ditemukan'); 
    }
    // Return the page view with store 
    return view('pages.tokodanpesanan.show', compact('toko'));    
  }
    
  /**
    * Show the form for editing the specified resource.
    */
  public function edit(string $id) 
  {
    // Find a store based on the store
    $toko = Toko::findOrFail($id); 
    // Return the form view edit with the store data
    return view('pages.tokopesanan.edit', compact('toko'));  
  }
    
  /**
    * Update the specified resource in storage
    * 
    */
  public function update(Request $request, string $id) 
  {
    // Validate the input data
    $request->validate([
      'nama_toko' => 'required',
      'address'=> 'required',
    ]);
    
    // Try to update the store and the order 
    try {
      // Find a store based on the id
      $toko = Toko::findOrFail($id); 
      // Update the store name 
      $toko->nama_toko = $request->nama_toko; 
      $toko->address = $request->address;
      // Save the changes
      $toko->save(); 
    
      // Redirect back to the page with a success message
      return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui');
    } catch (\Throwable $e) {
      // Log error message if failed to update store
      Log::error($e->getMessage());
    
      // Redirect back to the  page with an error message
      return redirect()->route('toko.index')->with('error', 'Toko gagal diperbarui');
    }
  }
    
  /**
    * Remove the specified resource from storage.
    */
  public function destroy(string $id)
  {
    // Try to delete the store
    try {
      // Find a store based on the store 
      $toko = Toko::findOrFail($id);  
      // Delete the store 
      $toko->delete(); 
    
      // Redirect back to the page with a success message
      return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus');
    } catch (\Throwable $e) {
      // Log error message if failed to delete store
      Log::error($e->getMessage());
    
      // Go back to the previous page with an error message
      return back()->withErrors(['error' => 'Toko gagal dihapus!']);
    }
  }
}


