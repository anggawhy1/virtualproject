<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;


use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminLaporController;
use App\Http\Controllers\RewardsAdminController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\NotificationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route for Beranda (Homepage)
Route::middleware(['auth'])->get('/beranda', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('beranda');
})->name('beranda');



Route::middleware(['auth', 'isAdmin'])->get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');



// Admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');
});

Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/admin/reports', [LaporanController::class, 'adminReports'])->name('admin.reports');
    Route::get('/admin/reports/{laporan}', [LaporanController::class, 'reportshow'])->name('admin.reports.show');
});

Route::middleware(['auth', 'isAdmin'])->group(function() {
Route::get('/admin/rewards', [RewardController::class, 'indexadmin'])->name('rewards.index.admin');

});



// Show register form (GET request)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Handle registration (POST request)
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Show login form (GET request)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login form submission (POST request)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route for Google login redirect
Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');

// Handle Google login callback
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Logout Route (POST request)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('edit-profil');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-profil', [ProfileController::class, 'editprofil'])->name('edit-profil-photo');
    Route::post('/update-profile-photo', [ProfileController::class, 'updateProfilePhoto'])->name('update-profile-photo');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporanstore', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/selesai-lapor/{laporan}', [LaporanController::class, 'selesaiLapor'])->name('selesai-lapor');
    Route::get('/lacakaduan', [LaporanController::class, 'lacak'])->name('lacakaduan');
    Route::get('/lacak-aduan/show', [LaporanController::class, 'show'])->name('lacakaduan.show');
    Route::post('/laporan/{id}/update-status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::get('/hasiladuan/{id}', [LaporanController::class, 'hasilAduan'])->name('hasiladuan');
});

Route::middleware(['auth'])->group(function () {
    // Klaim Poin
    Route::post('/laporan/approve-claim/{laporanId}', [LaporanController::class, 'approveAndClaimPoint'])->name('laporan.approve-claim');

    // Rewards
    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
   Route::get('/reward/{id}', [RewardController::class, 'show'])->name('reward.detail');
   Route::post('/reward/{id}/redeem', [RewardController::class, 'redeem'])->name('reward.redeem');
    Route::get('/reward/{slug}', [RewardController::class, 'showpop']);
    Route::get('/hadiah-kamu', [RewardController::class, 'showRewards'])->name('hadiah-kamu');
});




// Route::middleware(['auth'])->group(function () {
//     // Rute untuk mendapatkan semua kategori (terbuka untuk semua pengguna)
//     Route::get('/kategoris', [KategoriController::class, 'getKategoris'])->name('kategoris.index');

//     // Menggunakan middleware 'isAdmin' untuk akses admin
//     Route::middleware(['isAdmin'])->group(function () {
//         // Menambah kategori baru
//         Route::post('/kategoris', [KategoriController::class, 'storeKategori'])->name('kategoris.store');

//         // Memperbarui kategori
//         Route::put('/kategoris/{id}', [KategoriController::class, 'updateKategori'])->name('kategoris.update');

//         // Menghapus kategori
//         Route::delete('/kategoris/{id}', [KategoriController::class, 'destroyKategori'])->name('kategoris.destroy');
//     });
// });



Route::get('/tambah-lapor', function () {
    return view('tambah-lapor'); 
});
Route::post('/selesai-lapor', function () {
    return redirect('/selesai-lapor'); 
});

Route::get('/tentang', function () {
    return view('tentang'); 
});



Route::get('/selesai-lapor', function () {
    return view('selesai-lapor');
});

// Route::get('/lacakaduan', function () {
//     return view('lacak-aduan');
// });
// Route::get('/aduan', function (Illuminate\Http\Request $request) {
//     $aduanId = $request->query('id');
//     return view('aduan', ['aduanId' => $aduanId]);
// });


// Route::get('/aduan', function () {
//     return view('aduan');
// });

// Route::get('/hasiladuan1', function () {
//     return view('hasil-aduan');
// });

// Route::get('/reward', function () {
//     return view('reward');
// });
// Route::get('/reward/{id}', function ($id) {
//     return "Detail reward dengan ID: $id"; 
// });
// Route::get('/reward', function () {
//     return view('reward');
// })->name('reward');
// Route::get('/reward/{id}', [RewardController::class, 'show'])->name('reward.detail');
// Route::get('/redeem/{id}', function ($id) {
//     return "Penukaran untuk hadiah dengan ID: {$id} sedang diproses.";
// })->name('reward.redeem');

// Route::get('/hadiah-kamu', function () {
//     return view('hadiah-kamu');
// })->name('hadiah.kamu');





// Route::get('/laporan', function () {
//     return view('laporan'); 
// });
// Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');




// Route::get('/laporan/{id}', function ($id) {
//     return "Detail laporan dengan ID: $id"; 
// });

Route::get('/notifications', function () {
    return view('notifications'); 
});
Route::get('/notifikasi/{id}', [NotificationController::class, 'show'])->name('notifications.show');
// Route::get('/profile', function () {
//     return view('profile'); 
// });
// Route::get('/editprofil', function () {
//     return view('edit-profil'); 
// });
// Route::get('/editdatadiri', function () {
//     return view('edit-data-diri'); 
// });





Route::get('/edit-data-diri', function () {
    return view('edit-data-diri'); 
});

Route::get('/bantuan', function () {
    return view('bantuan');
});

Route::get('/info-point', function () {
    return view('info-point');
})->name('info-point');





Route::get('/admin/reports/index', [AdminLaporController::class, 'index'])->name('admin.reports.index');

Route::prefix('admin')->group(function () {
    Route::get('/rewards', [RewardsAdminController::class, 'index'])->name('admin.rewards');
    Route::get('/rewards/{id}', [RewardsAdminController::class, 'show'])->name('rewards.show');
});

Route::prefix('admin')->group(function () {
    Route::get('/message', [PesanController::class, 'index'])->name('admin.message');
    Route::get('/message/{id}', [PesanController::class, 'show'])->name('admin.message.detail');
});

Route::get('/admin/settings', function (Illuminate\Http\Request $request) {
    $section = $request->input('section', 'default'); 
    return view('admin.settings', compact('section'));
})->name('admin.settings');

// Route::get('/logout', function () {
//     return redirect('/');
// })->name('logout');



//chatbot
Route::get('/chatbot', function () {
    return view('chatbot'); 
})->name('chatbot');