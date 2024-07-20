<?php

namespace App\Http\Controllers;

use App\Models\Pesanan; 
use App\Models\Toko; 
use Illuminate\Http\Request;
use Livewire\Exceptions\PublicPropertyNotFoundException;

class PesananController extends Controller
{
    //menampilkan daftar pesanan
    public function index()
    {
        $pesanans = Auth::user()->pesanans; 
        return view('pesanans.index', compact('pesanans')); 
    }

    //menampilkan form untuk menambah pesanan
    public function create()
    {
        $tokos = Auth::user()->tokos; 
        return view('pesanans.create', compact('tokos')); 
    }

    //menyimpan pesanan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id', 
            'nama' => 'required|string|max255',
        ]); 

        $pesanans = new Pesanan();
        $pesanans->name = $request->name;
        $pesanans->details = $request->details;
        $pesanans->user_id = Auth::id(); 
        $pesanans->save(); 

        $pesanans->tokos()->attach($request->toko_ids);  
        return redirect()->route('pesanans.index')->with('success', 'Pesanan berhasil ditambahkan'); 
    }

    //menampilkan detail pesanan
    public function show(Pesanan $pesanan)
    {
        return view('pesanans.show', compact('pesanan')); 
    }

    //menampilkan form untuk mengedit pesanan
    public function edit(Pesanan $pesanan)
    {
        return view('pesanans.edit', compact('pesanan')); 
    }

    //memperbarui pesanan di database
    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255'
        ]); 

        $pesanan->update($request->all()); 
        return redirect()->route('pesanans.index')->with('success', 'Pesanan berhasil diperbarui');  
    }

    //menghapus pesanan dari database 
    public function destroy(Pesanan $pesanan) 
    {
        $pesanan->delete();
        return redirect()->route('pesanans.index')->with('success', 'Pesanan berhasil dihapus'); 
    }
}

