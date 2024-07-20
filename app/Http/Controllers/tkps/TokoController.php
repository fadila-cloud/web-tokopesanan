<?php

namespace App\Http\Controllers;

use App\Models\Pesanan; 
use App\Models\Toko; 
use Illuminate\Http\Request; 

class TokoController extends Controller
{
    //menampilkan daftar toko
    public function index()
    {
        $tokos = Toko::all();  
        return view ('tokos.index', compact ('tokos'));
    }

    //menampilkan form untuk merubah toko 
    public function create()
    {
        $pesanans = Pesanan::all(); 
        return view ('tokos.create', compact ('pesanans'));  
    }

    public function store(Request $request)
    {
        $tokos = new Toko();
        $tokos->name = $request->name;
        $tokos->location = $request->location;
        $tokos->save(); 

        return redirect()->route('tokos.index'); 
    }
}
