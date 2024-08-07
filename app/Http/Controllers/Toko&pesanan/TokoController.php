<?php

namespace App\Http\Controllers\Tokopesanan;   

use App\Http\Controllers\Controller;     
use App\Models\Tokopesanan\Tokos;    
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
  //menampilkan daftar toko dan daftar pesanan
  public function index()
  { 
    $toko = Tokos::all(); 
    // Get the currently logged in user's ID
    $user_id = Auth::user()->id;
    if ($user) {
      return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.'); 
    }
    // Get all the stores and the orders ordered and searched by the user 
    $tokos = user::find($user_id)->tokos; 
    $pesanans = user::find($user_id)->pesanans; 
    
    // Return the page view with order and store has been searched and ordered
    return view('pages.tokopesanan.index', compact('tokos', 'pesanans'));   
  }

  /** 
    * Show the form for creating a new resource.
    */
  //menampilkan form untuk merubah toko 
  public function create()
  {
    /** Return the form view to create a new store and order
      * Mengembalikan tampilan formulir untuk membuat toko dan pesanan baru
      */ 
    return view('pages.tokopesanan.create');
  }
  
  /**
    * Store a newly created resource in storage.
    */ 
  public function store(Request $request)
  {
    // Validate the input data dari toko dan pesanan
    $request->validate([
      'nama_pesanan' => 'required', 
      'nama_toko' => 'required', 
      'tanggal_lahir' => 'required',
      'address'=> 'required', 
    ]);
  
    /** Simpan data toko dan pesanan baru ke database 
      * membuat pesanan
      */
    try {
      Tokos::create([  
        'nama_toko' => $request->nama_toko,
        'address' => $request->address, 
        'user_id' => Auth::user()->id,
      ]);
      Pesanans::create([
        'nama_pesanan' => $request->nama_pesanan,
        'total' => $request->total,
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
  public function show($id)  
  {
    // Get store data with connected user information
    $toko = Tokos::with('user')->find($id);  
    $pesanan = Pesanans::with('user')->find($id);

    // Periksa apakah data ditemukan
    if ($toko === null) {
      return redirect()->routes('toko.index')->with('erorr', 'Toko tidak ditemukan'); 
    }
    // Return the page view with store and order
    return view('pages.tokopesanan.show', compact('toko', 'pesanan'));    
  }
    
  /**
    * Show the form for editing the specified resource.
    */
  public function edit(string $id) 
  {
    // Find a store based on the store
    $toko = Tokos::findOrFail($id); 
    // Return the form view edit with the store data
    return view('pages.tokopesanan.edit', compact('toko', 'pesanan'));  
  }
    
  /**
    * Update the specified resource in storage
    * memperbarui toko dan pesanan di database
    */
  public function update(Request $request, string $id) 
  {
    // Validate the input data
    $request->validate([
      'nama_toko' => 'required',
      'nama_pesanan' => 'required', 
      'tanggal_lahir' => 'required',
      'address'=> 'required',
    ]);
    
    // Try to update the store and the order 
    try {
      // Find a store based on the id
      $toko = Tokos::findOrFail($id);  
      $pesanan = Pesanans::findOrFail($id); 
      // Update nama toko dan pesanan
      $toko->nama_toko = $request->nama_toko;
      $toko->address = $request->address;
      $pesanan->nama_pesanan = $request->nama_pesanan;
      $pesanan->total = $request->total; 
      // Save the changes
      $toko->save(); 
      $pesanan->save(); 
    
      // Redirect back to the page with a success message
      return redirect()->route('toko.index')->with('success', 'Sumber daya berhasil diperbarui');
    } catch (\Throwable $e) {
      // Log error message if failed to update store
      Log::error($e->getMessage());
    
      // Redirect back to the  page with an error message
      return redirect()->route('toko.index')->with('error', 'Sumber daya gagal diperbarui');
    }
  }
    
  /**
    * Remove the specified resource from storage.
    */
  public function destroy(string $id)
  {
    // Try to delete the store
    try {
      // Find a store based on the store and the order
      $toko = Tokos::findOrFail($id);
      $pesanan = Pesanans::findOrFail($id);   
      // Delete the store and the order
      $toko->delete();
      $pesanan->delete(); 
    
      // Redirect back to the page with a success message
      return redirect()->route('toko.index')->with('success', 'Sumber daya berhasil dihapus');
    } catch (\Throwable $e) {
      // Log error message if failed to delete store
      Log::error($e->getMessage());
    
      // Go back to the previous page with an error message
      return back()->withErrors(['error' => 'Sumber daya gagal dihapus!']);
    }
  }
}


