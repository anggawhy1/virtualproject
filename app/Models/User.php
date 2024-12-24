<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'role',
        'gender',
        'nama_lengkap',
        'lokasi',
        'badge_id',
        'profile_photo',
        'points',
        'tanggal_lahir',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // User.php
    public function aduan()
    {
        return $this->hasMany(Aduan::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role; 
    }
  public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

public function badge()
{
    return $this->belongsTo(Badge::class);
}




    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'user_rewards')
            ->withPivot('redeemed_at', 'status')
            ->withTimestamps();
    }

    


}
