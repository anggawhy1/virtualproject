<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserReward extends Pivot
{
    protected $table = 'user_rewards';
    protected $fillable = ['user_id', 'reward_id', 'redeemed_at', 'status'];
    public $timestamps = false;


 // Relasi many-to-many dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-many dengan Reward
    public function reward()
    {
        return $this->belongsTo(Reward::class,  'reward_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }


}
