<?php 

namespace App\Models\Tokopesanan; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Tokos extends Model 
{
    use HasFactory;

      /**
   * The fields that are mass assignable.
   *
   * @var array
   */ 
    protected $fillable = ['name_toko', 'lokasi', 'user_id']; 

      /**
   * Get the user associated with the model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    //setiap toko hanya punya satu user (one to many/many to one) 
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class); 
    }
    
    //banyak toko bole punya banyak pesanan (many to many)   
    public function pesanans()
    {
        return $this->belongsToMany(Pesanans::class, 'pesanan_toko');   
    }
}
