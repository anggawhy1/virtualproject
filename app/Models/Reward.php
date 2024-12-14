<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $fillable = ['slug', 'name', 'points', 'icon', 'description'];

 public function users()
    {
        return $this->belongsToMany(User::class, 'user_rewards')
            ->withPivot('redeemed_at', 'status')
            ->withTimestamps();
    }
}
