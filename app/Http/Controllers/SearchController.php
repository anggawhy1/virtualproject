<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;   // Model Laporan
use App\Models\User;      // Model User
use App\Models\UserReward;  // Model UserReward (untuk akses status reward)

class SearchController extends Controller
{
    /**
     * Handle search request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        // Validasi query pencarian
        $request->validate([
            'q' => 'required|string|min:1',  // Pastikan query tidak kosong dan valid
        ]);

        $query = $request->input('q');  // Ambil query pencarian dari input user

        // Lakukan pencarian pada beberapa kolom (id_laporan, status_laporan, status_reward, nama_lengkap, email)
        $results = Laporan::where('id', 'like', "%{$query}%")  // Pencarian berdasarkan id laporan
            ->orWhere('status', 'like', "%{$query}%")          // Pencarian berdasarkan status laporan
            ->orWhereHas('userReward', function($q) use ($query) {  // Pencarian berdasarkan status reward (melalui relasi UserReward)
                $q->where('status', 'like', "%{$query}%");
            })
            ->orWhereHas('user', function($q) use ($query) {    // Pencarian berdasarkan nama_lengkap atau email (melalui relasi user)
                $q->where('nama_lengkap', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->with('user', 'userReward')  // Pastikan memuat relasi user dan userReward
            ->get(['id', 'status', 'user_reward_id', 'user_id']);  // Ambil kolom yang dibutuhkan

        // Format hasil pencarian dan kembalikan sebagai response JSON
        $formattedResults = $results->map(function ($laporan) {
            return [
                'id_laporan' => $laporan->id,
                'status_laporan' => $laporan->status,
                'status_reward' => $laporan->userReward ? $laporan->userReward->status : 'Tidak Ada',  // Status reward (jika ada)
                'user_name' => $laporan->user->nama_lengkap,
                'user_email' => $laporan->user->email,
                'url' => route('laporan.show', $laporan->id),  // URL untuk mengakses detail laporan
            ];
        });

        // Kembalikan hasil pencarian dalam format JSON
        return response()->json($formattedResults);
    }
}
