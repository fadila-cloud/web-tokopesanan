<?php

namespace App\Http\Controllers\Tokopesanan;      

use App\Http\Controllers\Controller;  
use App\Models\Tokopesanan\Pesanans;
use App\Models\User; 
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
        // Mengambil semua pesanan dari user 
        $pesanan = user::find($user_id)->pesanans; 

        // Return the page view with orders data ordered 
        return view('pages.tokopesanan.index', compact('pesanan'));   
    }

    /**
   * Show the form for creating a new resource.
   */ 
    public function create() 
    {
        $pesanan = Auth::user()->pesanan;  
        // Return the form view to create a new order
        return view('pages.tokopesanan.create', compact('pesanan'));  
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
        Pesanans::create([ 
            'pesanan' => $request->pesanan, 
            'toko' => $request->toko,
            'total' => $request->total, 
            'user_id' => Auth::user()->id,
        ]); 
        
        // Redirect back to the page with a success message
        return redirect()->route('pesanan.index')->with('success', 'Order berhasil dibuat.'); 
    }   catch (\Throwable $e) {
        // Log error message if failed to create an order
        Log::error($e->getMessage()); 

        // Redirect back to the page with an error message
        return redirect()->route('pesanan.index')->with('error', 'Order gagal dibuat.');  
        }
    }

    /**
   * Display the specified resource.
   */
    //menampilkan detail pesanan
    public function show($id) 
    {
        // Get order data with connected user information
        // Menggunakan $pesanan yang sudah diresolusi oleh Laravel 
        $pesanan = Pesanans::with('user')->find($id);   
        // Return the page view with order data
        return view('pages.tokopesanan.show', compact('pesanan'));   
    }

    /**
   * Show the form for editing the specified resource.
   */
    //menampilkan form untuk mengedit pesanan
    public function edit(Pesanans $pesanan)
    {
        // Return the form view edit with the order data
        return view('pages.tokopesanan.edit', compact('pesanan'));  
    }

    /**
   * Update the specified resource in storage.
   */
    //memperbarui pesanan di database
    public function update(Request $request, Pesanans $pesanan)
    {
        // Validate the input data
        $request->validate([
            'user_id' => 'required', 
            'nama_pesanan' => 'required',  
        ]);
        // Try to update the order
    try { 
        // Update the order name and publisher
        $pesanan->nama_pesanan = $request->nama_pesann;
        $pesanan->toko = $request->toko; 
        // Save the changes
        $pesanan->save();

        // Redirect back to the page with a success message
        return redirect()->route('pesanan.index')->with('success', 'Sumber daya berhasil diperbarui');
    }   catch (\Throwable $e) {
            // Log error message if failed to update book
            Log::error($e->getMessage());
            // Redirect back to the page with an error message
            return redirect()->route('pesanan.index')->with('error', 'Pesanan gagal dibuat'); 
        }
    }
    
    /**
   * Remove the specified resource from storage.
   */
    //menghapus pesanan dari database 
    public function destroy(Pesanans $pesanan)  
    {
        // Try to delete the order
    try { 
        // Delete the order
        $pesanan->delete();
        // Redirect back to the page with a success message
        return redirect()->route('pesanan.index')->with('success', 'Sumber daya berhasil dihapus');
    }   catch (\Throwable $e) {
            // Log error message if failed to delete order
            Log::error($e->getMessage());
  
            // Go back to the previous page with an error message
            return back()->withErrors(['error' => 'Sumber Daya gagal dihapus!']); 
    }
    }    
}
