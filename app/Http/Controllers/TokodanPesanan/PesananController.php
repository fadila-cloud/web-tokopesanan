<?php 

namespace App\Http\Controllers\TokodanPesanan;

use App\Http\Controllers\Controller;
use App\Models\tokosdanpesanans\Pesanan;  
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    //menampilkan daftar pesanan
    public function index ()
    {
        $user_id = Auth::user()->id;
        if ($user_id === null) {
            return redirect()->back()->with("error,  Anda harus login terlebih dahulu"); 
        }
        //mengambil semua pesanan dari user
        $pesanan = user::find($user_id)->pesanan; 
        //menegmbalikan halaman page
        return view('pages.tokodanpesanan.index', compact('pesanan'));  
    }

    public function create()
    {
        $user_id = Auth::user();
        if ($user_id) {
            $pesanan = $user_id->pesanan; 
        return view('pages.tokodanpesanan.create', compact('pesanan'));   
        } else {
            Log::error('User is not authenticated.');
            return redirect()->route('login')->with('error', 'Anda harus loginn terlebih dahulu'); 
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pesanan' => $request->pesanan, 
            'total' => $request->total, 
        ]);

        // Try to create a new order
        try {
            Pesanan::create([
                'nama_pesanan' => $request->pesanan,
                'total' => $request->total,
                'user-id' => Auth::user()->id, 
            ]);
            return redirect()->route('pesanan.index')->with('success', 'Order berhasi dibuat.');
        }   catch (\Throwable $e) { 
            Log::error($e->getMessage());
            return redirect()->route('pesanan.index')->with('error', 'Order gagal dibuat.');
        }
    }

    public function show(string $id) 
    {
        $pesanan = Pesanan::with('user')->find($id);
        return view('pages.tokodanpesanan.show', compact('pesanan')); 
    }

    public function edit(string $id)
    {
        $pesanan = Pesanan::finfOrFail($id); 
        return view('pages.tokodanpesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, string $id)
    {
        //Validate the input data 
        $request->validate([
            'nama_pesanan' => 'required',
            'total' => 'required',
        ]);

        // Try to update the order 
        try {
            // Find a order based on the id
            $pesanan = Pesanan::findOrFail($id); 

            // Update the order name 
            $pesanan->nama_pesanan = $request->nama_pesanan;
            $pesanan->total = $request->total;

            // Save the changes 
            $pesanan->save(); 
            return redirect()->route('pesanans.index')->with('succes', 'Pesanan berhasil diperbarui');
        }   catch (\Throwable $e) {
            Log::error($e->getMessage());
            return redirect()->route('pesanan.index')->with('error', 'Pesanan gagal diperbarui.');
        }
    }

    public function destroy(string $id)   
    {
        try {
            $pesanan = Pesanan::findOrFail($id); 
            $pesanan->delete();

            return redirect()->route('pesanan.index')->with('succes', 'Pesanan berhasil dihapus');
        }   catch (\Throwable $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Pesanan gagal dihapus']);
        }
    }
}