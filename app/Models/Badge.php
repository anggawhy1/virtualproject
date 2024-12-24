<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_image', // Nama file gambar badge
        'description', // Deskripsi badge
    ];

public function users()
{
    return $this->hasMany(User::class);
}
}
