<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\ProfileController;



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


// Rute halaman beranda, hanya bisa diakses setelah login
Route::get('/beranda', function () {
    // Pastikan pengguna sudah login sebelum mengakses halaman beranda
    if (Auth::check()) {
        return view('beranda');  // Pastikan view 'beranda' ada di resources/views
    } else {
        return redirect()->route('login');  // Jika belum login, redirect ke halaman login
    }
})->name('beranda');

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
    Route::post('/rewards/{id}/redeem', [RewardController::class, 'redeem'])->name('rewards.redeem');
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

Route::get('/reward', function () {
    return view('reward');
});
Route::get('/reward/{id}', function ($id) {
    return "Detail reward dengan ID: $id"; 
});
Route::get('/reward', function () {
    return view('reward');
})->name('reward');
Route::get('/reward/{id}', [RewardController::class, 'show'])->name('reward.detail');
Route::get('/redeem/{id}', function ($id) {
    return "Penukaran untuk hadiah dengan ID: {$id} sedang diproses.";
})->name('reward.redeem');

Route::get('/hadiah-kamu', function () {
    return view('hadiah-kamu');
})->name('hadiah.kamu');





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


