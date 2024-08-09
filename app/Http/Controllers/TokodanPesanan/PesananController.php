<?php 

namespace App\Http\Controllers\TokodanPesanan;

use App\Http\Controllers\Controller;
use App\Models\tokosdanpesanans\Pesanans; 
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
        $pesanan = user::find($user_id)->pesanans; 
        //menegmbalikan halaman page
        return view('pages.tokodanpesanan.index', compact('pesanan'));  
    }

    public function create()
    {
        $user_id = Auth::user();
        if ($user_id) {
            $pesanan = $user_id->pesanans; 
        return view('pages.tokodanpesanan.create', compact('pesanan'));   
        } else {
            Log::error('User is not authenticated.');
            return redirect()->route('login')->with('error', 'Anda harus loginn terlebih dahulu'); 
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pesanan' => $request->pesanans,
            'total' => $request->total,
        ]);
        try {
            Pesanans::create([
                'nama_pesanan' => $request->pesanans,
                'total' => $request->total,
            ]);
            return redirect()->route('pesanan.index')->with('success', 'Order berhasi dibuat.');
        }   catch (\Throwable $e) { 
            Log::error($e->getMessage());
            return redirect()->route('pesanan.index')->with('error', 'Order gagal dibuat.');
        }
    }

    public function show($id)
    {
        $pesanan = Pesanans::with('user')->find($id);
        return view('pages.tokodanpesanan.show', compact('pesanans')); 
    }

    public function edit(Pesanans $pesanan)
    {
        return view('pages.tokodanpesanan.edit', compact('pesanans'));
    }

    public function update(Request $request, Pesanans $pesanan)
    {
        $request->validate([
            'nama_pesanan' => 'required',
            'total' => 'required',
        ]);

        try {
            $pesanan->nama_pesanan = $request->nama_pesanan;
            $pesanan->total = $request->total;
            $pesanan->save(); 
            return redirect()->route('pesanans.index')->with('succes', 'Pesanan berhasil diperbarui');
        }   catch (\Throwable $e) {
            Log::error($e->getMessage());
            return redirect()->route('pesanan.index')->with('error', 'Pesanan gagal diperbarui.');
        }
    }

    public function destroy(Pesanans $pesanan) 
    {
        try {
            $pesanan->delete();
            return redirect()->route('pesanan.index')->with('succes', 'Pesanan berhasil dihapus');
        }   catch (\Throwable $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Pesanan gagal dihapus']);
        }
    }
}