<?php

namespace App\Http\Controllers\Tokos;

use App\Http\Controllers\Controller;  
use App\Models\Toko\toko;   
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
        // Get the currently logged in user's ID
        $user_id = Auth::user()->id;
    
        // Get all the toko searched by the user
        $datas = User::find($user_id)->orders; 
    
        // Return the page view with order has been searched
        return view('pages.toko.index')->with('datas', $datas);
      }
  /**
   * Show the form for creating a new resource.
   */
    //menampilkan form untuk merubah toko 
    public function create()
    {
      // Return the form view to create a new order 
        return view('pages.toko.create');
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
  
      // Try to create a new store
      try {
        Tokos::create([ 
          'nama_toko' => $request->nama_toko,
          'lokasi' => $request->lokasi,
          'user_id' => Auth::user()->id,
        ]);
         // Redirect back to the page with a success message
         return redirect()->route('toko.index')->with('success', 'Store created successfully');
        } catch (\Throwable $e) {
          // Log error message if failed to create a store 
          Log::error($e->getMessage());
    
          // Redirect back to the page with an error message
          return redirect()->route('toko.index')->with('error', 'Store created fail');
        }
      }
    
      /**
       * Display the specified resource.
       */
      public function show(string $id)
      {
        // Get book data with connected user information
        $data = Tokos::with('user')->find($id);
    
        // Return the library page view with store
        return view('pages.toko.show')->with('data', $data);
      }
    
      /**
       * Show the form for editing the specified resource.
       */
      public function edit(string $id)
      {
        // Find a book based on the id
        $data = Tokos::findOrFail($id);
    
        // Return the form view edit with the store data
        return view('pages.toko.edit', compact('data'));
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
          return redirect()->route('toko.index')->with('success', 'Resource updated successfully');
        } catch (\Throwable $e) {
          // Log error message if failed to update store
          Log::error($e->getMessage());
    
          // Redirect back to the  page with an error message
          return redirect()->route('toko.index')->with('error', 'Store created fail');
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
          $toko = Toko::findOrFail($id); 
    
          // Delete the store
          $toko->delete();
    
          // Redirect back to the page with a success message
          return redirect()->route('toko.index')->with('success', 'Resource deleted successfully');
        } catch (\Throwable $e) {
          // Log error message if failed to delete store
          Log::error($e->getMessage());
    
          // Go back to the previous page with an error message
          return back()->withErrors(['error' => 'Resource deleted fail!']);
        }
      }
    }

