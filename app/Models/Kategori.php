<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'kategoris';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama',  // misalnya kolom nama kategori
    ];

    // Relasi dengan model Laporan (banyak kategori bisa memiliki banyak laporan)
    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'kategori_id');
    }
}
