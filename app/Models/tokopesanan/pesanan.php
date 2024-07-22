<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable =['name', 'details', 'user_id'];  

    //untuk model ke usernya
    public function user() 
    {
        return $this->belongsToMany(User::class); 
    }

    //untuk model ke tokonya 
    public function tokos() 
    {
        return $this->belongsToMany(Toko::class, 'pesanan_toko'); 
    }
}