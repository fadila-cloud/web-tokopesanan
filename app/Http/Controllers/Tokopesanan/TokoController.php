<?php

namespace App\Http\Controllers\Tokopesanan;   

use App\Http\Controllers\Controller;     
use App\Models\Tokopesanan\Tokos;    
use App\Models\User;  
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log; 

class TokoController extends Controller 
{
    /**
   * Display a listing of the resource.
   */
    //menampilkan daftar toko
    public function index()
    {
        $toko = Tokos::all();
        // Get the currently logged in user's ID
        $user_id = Auth::user()->id;
        // Get all the toko searched by the user
        $toko = user::find($user_id)->tokos; 
    
        // Return the page view with order has been searched
        return view('pages.tokopesanan.index', compact('toko'));
      }
  /** 
   * Show the form for creating a new resource.
   */
    //menampilkan form untuk merubah toko 
    public function create()
    {
      // Return the form view to create a new order 
        return view('pages.tokopesanan.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
      // Validate the input data
      $request->validate([
        'nama_toko' => 'required',
        'lokasi' => 'required',
      ]);
  
      // Simpan data toko baru ke database 
    try {
        Tokos::create([  
          'nama_toko' => $request->nama_toko,
          'lokasi' => $request->lokasi,
          'user_id' => Auth::user()->id,
        ]);
         // Redirect back to the page with a success message
        return redirect()->route('toko.index')->with('success', 'Toko berhasil dibuat.');
    }   catch (\Throwable $e) {
        // Log error message if failed to create a store 
        Log::error($e->getMessage());
    
        // Redirect back to the page with an error message
        return redirect()->route('toko.index')->with('error', 'Toko gagal dibuat.');
    }
    }
    
    /**
      * Display the specified resource.
      */
    public function show(Tokos $toko) 
    {
      // Get store data with connected user information
      $toko->load('user'); 
      // Return the page view with store
      return view('pages.tokopesanan.show', compact('toko'));  
    }
    
      /**
       * Show the form for editing the specified resource.
       */
    public function edit($id)
    {
      // Find a store based on the id
      $toko = Tokos::findOrFail($id); 
      // Return the form view edit with the store data
      return view('pages.tokopesanan.edit', compact('toko'));
    }
    
      /**
       * Update the specified resource in storage.
       */
    public function update(Request $request, string $id)
    {
      // Validate the input data
      $request->validate([
        'nama_toko' => 'required',
        'lokasi' => 'required',
      ]);
    
      // Try to update the store
      try {
        // Find a store based on the id
        $toko = Tokos::findOrFail($id);
        // Update the store name and publisher
        $toko->nama_toko = $request->nama_toko;
        $toko->lokasi = $request->lokasi;
        // Save the changes
        $toko->save(); 
    
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
        // Find a store based on the id
        $toko = Tokos::findOrFail($id); 
        // Delete the store
        $toko->delete();
    
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


