<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'user_id']; 

    //setiap toko hanya punya satu user (one to many/many to one) 
    public function user() 
    {
        return $this->belongsTo(User::class); 
    }
    
    //banyak toko bole punya banyak pesanan (many to many)   
    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_toko');  
    }
}
