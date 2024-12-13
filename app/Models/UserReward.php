<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserReward extends Pivot
{
    protected $table = 'user_rewards';
    protected $fillable = ['user_id', 'reward_id', 'redeemed_at'];
    public $timestamps = false;


    // Reward.php
public function users()
{
    return $this->belongsToMany(User::class, 'user_rewards')
        ->withPivot('redeemed_at')
        ->withTimestamps();
}

}
