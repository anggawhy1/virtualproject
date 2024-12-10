<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards.index', compact('rewards'));
    }

    public function redeem($id)
    {
        $reward = Reward::findOrFail($id);
        $user = Auth::user();

        // Cek apakah user memiliki cukup poin
        if ($user->points < $reward->points) {
            return redirect()->back()->with('error', 'Poin Anda tidak cukup untuk menukarkan reward ini!');
        }

        // Kurangi poin pengguna dan catat reward
        $user->decrement('points', $reward->points);
        $user->rewards()->attach($reward->id, ['redeemed_at' => now()]);

        return redirect()->back()->with('success', 'Reward berhasil ditukarkan!');
    }
}
