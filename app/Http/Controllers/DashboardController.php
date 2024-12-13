<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $reportsThisMonth = Laporan::whereMonth('created_at', now()->month)->count();
        $completionRate = Laporan::where('status', 'Disetujui')->count() / max(Laporan::count(), 1) * 100;

        $categories = Laporan::selectRaw('kategori_id, COUNT(*) as total')
            ->groupBy('kategori_id')
            ->orderBy('total', 'desc')
            ->get();

        // Mapping kategori_id ke nama kategori (relasi dapat ditambahkan jika ada)
        $categories = $categories->map(function ($category) {
            return [
                'name' => $category->kategori_id, // Ganti dengan relasi jika tersedia
                'value' => $category->total
            ];
        });

        return view('admin.dashboard', compact('totalUsers', 'reportsThisMonth', 'completionRate', 'categories'));
    }
}
