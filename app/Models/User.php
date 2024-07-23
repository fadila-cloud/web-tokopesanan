<?php

namespace App\Models;

use App\Models\Tokopesanan\Pesanans;
use App\Models\Tokopesanan\Tokos;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory, Notifiable; 
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

      /**
   * Get the stores for the user. 
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
    //satu user boleh punya banyak toko
    public function tokos()
    {
        return $this->hasMany(Tokos::class);  
    }

      /**
   * Get the orders for the user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
    //satu user boleh punya banyak pesanan 
    public function pesanans() 
    {
        return $this->hasMany(Pesanans::class);   
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
