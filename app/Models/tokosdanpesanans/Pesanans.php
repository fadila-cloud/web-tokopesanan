<?php

namespace App\Models\tokosdanpesanans; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;  

class Pesanans extends Model 
{
    use HasFactory;
  /**
   * The fields that are mass assignable.
   *
   * @var array
   */
    
   protected $table = 'pesanan'; // Nama tabel di database 
    protected $fillable =[
        'user_id', 
        'nama_pesanan', 
        'total', 
    ];  

    /**
   * Get the user associated with the model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */ 
    //relasi ke modal user, setiap pesanans punya 1 user 
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class); 
    }

    //untuk relasi model pesanan ke tokonya 
    public function tokos() 
    {
        return $this->belongsToMany(Tokos::class, 'pesanan_toko');  
    }
}