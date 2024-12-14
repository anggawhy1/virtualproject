<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserReward;
use Illuminate\Support\Facades\DB; 

class RewardController extends Controller
{

public function index()
{
    $rewards = Reward::all();
    return view('reward', compact('rewards'));
}



public function show($id)
    {
        // Ambil data hadiah berdasarkan ID
        $reward = Reward::findOrFail($id);
        return view('reward-detail', compact('reward'));
    }

public function redeem($id)
{
    $user = Auth::user(); // Dapatkan user yang sedang login
    $reward = Reward::findOrFail($id); // Cari reward berdasarkan ID

    // Periksa apakah user memiliki cukup poin
    if ($user->points < $reward->points) {
        return response()->json(['error' => 'Poin Anda tidak cukup untuk menukarkan reward ini.'], 400);
    }

    // Mulai transaksi untuk memastikan konsistensi data
    DB::beginTransaction();

    try {
        // Kurangi poin pengguna yang cukup untuk redeem reward
        $user->decrement('points', $reward->points);

        // Tambahkan entri baru ke tabel user_rewards
        $user->rewards()->attach($reward->id, [
            'redeemed_at' => now(),
            'status' => 'menunggu konfirmasi'
        ]);

        // Commit transaksi jika semua berhasil
        DB::commit();

        // Kembalikan respons sukses
        return response()->json(['success' => 'Hadiah berhasil ditukarkan! Kami akan menghubungi Anda untuk proses selanjutnya.']);

    } catch (\Exception $e) {
        // Rollback transaksi jika ada error
        DB::rollBack();

        // Kembalikan respons gagal
        return response()->json(['error' => 'Terjadi kesalahan, silakan coba lagi.'], 500);
    }
}


public function showpop($slug)
{
    $reward = Reward::where('slug', $slug)->firstOrFail();
    return view('rewards.detail', compact('reward'));
}


public function showRewards()
{
    $user_id = auth()->id(); // Get the currently logged-in user's ID

    // Get the rewards that the user has redeemed, along with the status
    $rewards = Reward::join('user_rewards', 'user_rewards.reward_id', '=', 'rewards.id')
                     ->where('user_rewards.user_id', $user_id)
                     ->get(['rewards.*', 'user_rewards.redeemed_at', 'user_rewards.status'])
                     ->map(function ($reward) {
                         // Ensure that the redeemed_at field is a Carbon instance
                         $reward->redeemed_at = \Carbon\Carbon::parse($reward->redeemed_at);
                         return $reward;
                     });

    return view('hadiah-kamu', compact('rewards'));
}


public function indexadmin()
{
    $userRewards = UserReward::with(['user', 'reward'])->get();
    
    // Debugging: Cek apakah data berhasil diambil
    if ($userRewards->isEmpty()) {
        \Log::info('Tidak ada data user rewards.');
    } else {
        \Log::info('Data user rewards berhasil diambil.', ['data' => $userRewards]);
    }

    return view('admin.rewards', compact('userRewards'));
}


}
