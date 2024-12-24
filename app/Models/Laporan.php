<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Laporan extends Model
{
    use HasFactory;

    // Tentukan bahwa ID adalah bigInteger
    protected $keyType = 'int'; // Tipe data ID adalah integer
    public $incrementing = false; // Disable auto-increment untuk ID

    // Menentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'deskripsi',
        'lokasi',
        'latitude',
        'longitude',
        'status',
        'files',
        'hasil',
        'user_id',
        'kategori',
        'anonim',
        'approved_at',
        'completed_at',
        'is_claimed',
    ];

    // Menambahkan ID acak 10 digit secara otomatis saat data baru dibuat
    protected static function booted()
    {
        static::creating(function ($laporan) {
            $laporan->id = random_int(1000000000, 9999999999); // Menghasilkan angka acak 10 digit
        });
    }

    // Relasi dengan tabel 'users' (user_id)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     // Relasi ke UserReward (Laporan memiliki UserReward)
    public function userReward()
    {
        return $this->belongsTo(UserReward::class, 'user_reward_id');
    }

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}
