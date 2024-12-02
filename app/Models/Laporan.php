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
        'user_id',
        'kategori_id',
        'anonim',
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

    // Relasi dengan tabel 'kategoris' (kategori_id)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
