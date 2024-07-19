<?php

namespace App\Http\Controllers;

use App\Models\Toko; 
use Illuminate\Http\Request;

class TokoController extends Controller
{
    //menampilkan daftar toko
    public function index()
    {
        $tokos = Toko::all; 
        return view ('tokos.index', compact ('tokos'));
    }

    //menampilkan form untuk merubah toko 
    public function create()
    {
        return view ('tokos.create'); 
    }
}
