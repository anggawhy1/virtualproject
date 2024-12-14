<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserReward extends Pivot
{
    protected $table = 'user_rewards';
    protected $fillable = ['user_id', 'reward_id', 'redeemed_at', 'status'];
    public $timestamps = false;


public function users()
{
    return $this->belongsToMany(User::class, 'user_rewards')
        ->withPivot('redeemed_at')
        ->withTimestamps();
}

public function reward()
{
    return $this->belongsTo(Reward::class);
}


}
