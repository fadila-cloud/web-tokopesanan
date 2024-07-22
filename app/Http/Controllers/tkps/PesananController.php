<?php

namespace App\Http\Controllers\Pesanans;  

use App\Http\Controllers\Controller;  
use App\Models\Pesanan\Pesanan;  
use Illuminate\Http\Request;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log; 

class PesananController extends Controller
{
    //menampilkan daftar pesanan
    public function index()
    {
        // Get the currently logged in user's ID
        $user_id = Auth::user()->id;

        // Get all the orders ordered by the user 
        $datas = User::find($user_id)->pesanans;

        // Return the page view with orders data ordered 
        return view('pages.pesanan.index')->with('datas', $datas);  
    }

  /**
   * Show the form for creating a new resource.
   */ 
    public function create() 
    {
        $tokos = Auth::user()->tokos; 
        // Return the form view to create a new order
        return view('pages.pesanan.create'); 
    }

  /**
   * Store a newly created resource in storage.
   */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'user_id' => 'required', 
            'nama' => 'required',
        ]); 

        // Try to create a new order
        try {
            Pesanan::create([
                'pesanan' => $request->pesanans, 
                'toko' => $request->toko,
                'user_id' => Auth::user()->id,
            ]); 
        
            // Redirect back to the page with a success message
            return redirect()->route('pesanan.index')->with('success', 'Store created successfully');
        }   catch (\Throwable $e) {
            // Log error message if failed to create an order
            Log::error($e->getMessage());

            // Redirect back to the page with an error message
            return redirect()->route('pesanan.index')->with('error', 'Store created fail');
        }
    }

    /**
   * Display the specified resource.
   */
    //menampilkan detail pesanan
    public function show(Pesanan $pesanan)
    {
        // Get order data with connected user information
        $data = Pesanan::with('user')->find($id); 
        // Return the library page view with book data
        return view('pages.pesanan.show')->with('data', $data);
    }

    /**
   * Show the form for editing the specified resource.
   */
    //menampilkan form untuk mengedit pesanan
    public function edit(Pesanan $pesanan)
    {
         // Find a order based on the id
        $data = Pesanan::findOrFail($id);
        // Return the form view edit with the book data
        return view('pages.pesanan.edit', compact('pesanan'));  
    }

    /**
   * Update the specified resource in storage.
   */
    //memperbarui pesanan di database
    public function update(Request $request, Pesanan $pesanan)
    {
        // Validate the input data
        $request->validate([
            'user_id' => 'required', 
            'nama' => 'required', 
        ]);
        // Try to update the order
    try {
         // Find a order based on the id
      $pesanan = Pesanan::findOrFail($id);

      // Update the order name and publisher
      $pesanan->nama_pesanan = $request->nama_pesann;
      $pesanan->lokasi = $request->lokasi;

      // Save the changes
      $pesanan->save();
    } 
          // Redirect back to the page with a success message
          return redirect()->route('pesanan.index')->with('success', 'Resource updated successfully');
        } catch (\Throwable $e) {
          // Log error message if failed to update book
          Log::error($e->getMessage());
    
          // Redirect back to the page with an error message
          return redirect()->route('pesanan.index')->with('error', 'Store created fail');
    }

    /**
   * Remove the specified resource from storage.
   */
    //menghapus pesanan dari database 
    public function destroy(pesanan $pesanan) 
    {
      // Try to delete the order
      try {
        // Find a order based on the id
        $pesanan = Pesanan::findOrFail($id);
  
        // Delete the order
        $pesanan->delete();
  
        // Redirect back to the page with a success message
        return redirect()->route('pesanan.index')->with('success', 'Resource deleted successfully');
    } catch (\Throwable $e) {
        // Log error message if failed to delete order
        Log::error($e->getMessage());
  
        // Go back to the previous page with an error message
        return back()->withErrors(['error' => 'Resource deleted fail!']);
      }
    } 

