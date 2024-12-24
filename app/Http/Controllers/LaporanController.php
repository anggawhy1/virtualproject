<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Badge;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{


     public function index()
{
    // Cek apakah pengguna sudah login

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    return view('tambah-lapor');
}

public function store(Request $request)
{
    // Cek apakah pengguna sudah login
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Unauthorized');
    }

    // Validasi input
    $validatedData = $request->validate([
        'deskripsi' => 'required|string',
        'lokasi' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric|between:-90,90',  // Validasi latitude
        'longitude' => 'nullable|numeric|between:-180,180',  // Validasi longitude
        'kategori' => 'required', // Kategori field is required
        'files.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:2048',
        'anonim' => 'nullable|boolean',
    ]);

    // Menentukan path folder untuk menyimpan file
    $folderPath = storage_path('app/public/uploads/laporan_files');

    // Memastikan folder ada, jika belum, buat folder
    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0775, true);
    }

    // Menyimpan file jika ada
    $filePaths = [];
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            // Menyimpan file di folder yang sudah dipastikan ada
            $filePaths[] = $file->store('uploads/laporan_files', 'public');
        }
    }

    // Menentukan status anonim
    $anonim = $request->has('anonim');

    // Data lokasi (manual atau dari maps)
    $lokasi = $validatedData['lokasi'] ?? null;
    $latitude = $validatedData['latitude'] ?? null;
    $longitude = $validatedData['longitude'] ?? null;

    // Membuat laporan dan mengambil ID-nya
    $laporan = Laporan::create([
        'deskripsi' => $validatedData['deskripsi'],
        'lokasi' => $lokasi,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'kategori' => $validatedData['kategori'],
        'files' => $filePaths ? json_encode($filePaths) : null,
        'user_id' => $anonim ? null : Auth::id(),  // Jika anonim, user_id diatur null
        'anonim' => $anonim,  // Menyimpan true/false ke database
    ]);

    // Redirect ke halaman selesai-lapor dengan membawa ID laporan
    return redirect()->route('selesai-lapor', ['laporan' => $laporan->id])->with('success', 'Laporan berhasil dikirim.');
}


public function updateStatus(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'status' => 'required|in:Diajukan,Diproses,Disetujui,Selesai',
        'hasil' => 'nullable|array|max:5', // Allow an array of up to 5 files
        'hasil.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:2048', // Validate each file
    ]);

    // Temukan laporan berdasarkan ID
    $laporan = Laporan::findOrFail($id);

    // Update status
    $laporan->status = $request->status;

    // Set waktu jika status berubah ke 'Diproses', 'Disetujui', atau 'Selesai'
    if ($request->status === 'Diproses') {
        $laporan->updated_at = now();
    } elseif ($request->status === 'Disetujui') {
        $laporan->approved_at = now();
    } elseif ($request->status === 'Selesai') {
        // Set waktu selesai
        $laporan->completed_at = now();

        if ($request->hasFile('hasil')) {
            // Array to store file paths
            $filePaths = [];

            // Loop through the uploaded files
            foreach ($request->file('hasil') as $file) {
                // Save each file and get the path
                $filePaths[] = $file->store('laporan_hasil', 'public');
            }

            // Update kolom 'hasil' dengan array file path dalam format JSON
            $laporan->hasil = json_encode($filePaths);
        } else {
            $laporan->hasil = null;
        }
    }

    // Simpan perubahan laporan
    $laporan->save();

    // Ambil user yang terkait dengan laporan ini
    $user = $laporan->user; // Menentukan user dari laporan yang ada

    if ($user) {
        // Get the count of completed laporan (status = 'Selesai')
        $laporanCount = $user->laporan()->where('status', 'Selesai')->count();

        // Tentukan badge yang akan diberikan berdasarkan jumlah laporan selesai
        $badge = null;
        if ($laporanCount == 1) {
            $badge = Badge::where('badge_image', 'pelaporpemula.png')->first();
        } elseif ($laporanCount == 5) {
            $badge = Badge::where('badge_image', 'pelaporaktif.png')->first();
        } elseif ($laporanCount == 10) {
            $badge = Badge::where('badge_image', 'pelaporsetia.png')->first();
        } elseif ($laporanCount == 20) {
            $badge = Badge::where('badge_image', 'saksiterpercaya.png')->first();
        } elseif ($laporanCount == 30) {
            $badge = Badge::where('badge_image', 'pelaporveteran.png')->first();
        } elseif ($laporanCount == 50) {
            $badge = Badge::where('badge_image', 'pahlawanmasyarakat.png')->first();
        } elseif ($laporanCount == 100) {
            $badge = Badge::where('badge_image', 'pelaporsuper.png')->first();
        }

        // Jika badge ditemukan, update badge_id pengguna
        if ($badge) {
            $user->badge_id = $badge->id;
            $user->save(); // Pastikan untuk menyimpan perubahan pada user
        }
    }

    // Redirect dengan pesan sukses
    return redirect()->back()->with('status', 'Status laporan berhasil diubah.');
}





  public function lacak()
{
    // Ambil semua laporan (tanpa filter user)
    $laporans = Laporan::all();

    // Passing $laporans ke view
    return view('lacak-aduan', compact('laporans'));
}

public function show(Request $request)
{
    // Validasi ID yang dimasukkan
    $validated = $request->validate([
        'id' => 'required|exists:laporans,id', // Memastikan ID ada di tabel laporans
    ]);

    // Menangani permintaan untuk menampilkan detail laporan berdasarkan ID
    $laporan = Laporan::findOrFail($request->id);

    // Menangani kemungkinan $laporan->files kosong atau tidak sesuai format
    $files = json_decode($laporan->files);
    
    // Periksa apakah files tidak kosong dan memiliki data yang benar
    $images = is_array($files) ? array_map(function ($file) {
        return asset('storage/' . str_replace('\/', '/', $file));
    }, $files) : [];

    // Pass laporan dan images ke view yang sesuai
    return view('aduan', compact('laporan', 'images'));
}



public function selesaiLapor($laporan)
{
    // Menampilkan halaman selesai-lapor dengan ID laporan
    $laporan = Laporan::findOrFail($laporan);  // Ambil data laporan berdasarkan ID
    return view('selesai-lapor', compact('laporan'));
}

public function hasilAduan($id)
{
    // Find the laporan by ID
    $laporan = Laporan::findOrFail($id);

    // Pass the laporan data to the view
    return view('hasil-aduan', compact('laporan'));
}


public function approveAndClaimPoint($id)
{
    // Retrieve the laporan by its ID
    $laporan = Laporan::findOrFail($id);

    // Check if laporan status is 'Disetujui' or 'Selesai'
    if (!in_array($laporan->status, ['Disetujui', 'Selesai'])) {
        return response()->json(['success' => false, 'message' => 'Status laporan tidak sesuai untuk klaim poin.']);
    }

    // Check if the point has already been claimed
    if ($laporan->is_claimed) {
        return response()->json(['success' => false, 'message' => 'Poin sudah diklaim sebelumnya.']);
    }

    // Mark the claim as done
    $laporan->is_claimed = 1;
    $laporan->save();

    // Get the authenticated user
    $user = Auth::user();
    if ($user) {
        // Increment the user's points
        $user->increment('points', 5);
    } else {
        return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
    }

    // Return success response
    return response()->json(['success' => true, 'message' => 'Poin berhasil diklaim.']);
}





public function adminReports(Request $request)
{
    // Check if the user is authenticated and has the 'admin' role
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Get the 'status' filter from the request, default to 'semua'
    $status = $request->get('status', 'semua'); 

    // Start the query for the reports
    $reportsQuery = Laporan::with('user')->orderBy('created_at', 'desc');

    // Apply filter if a specific status is selected
    $validStatuses = ['diajukan', 'diproses', 'disetujui', 'selesai']; // Valid statuses
    if ($status !== 'semua' && in_array($status, $validStatuses)) {
        $reportsQuery->where('status', ucfirst($status)); // Apply filter based on status
    }

    // Paginate reports
    $reports = $reportsQuery->paginate(10);
$reportsArray = $reports->map(function ($report) {
    $profilePhotoUrl = $report->user->profile_photo ? 
                       asset('storage/profile_photos/' . $report->user->profile_photo) : 
                       strtoupper(substr($report->user->nama_lengkap, 0, 1));
    
    
    return [
        'id' => $report->id,
        'name' => $report->user->nama_lengkap,
        'date' => $report->created_at->format('Y-m-d H:i'),
        'status' => $report->status,
        'profile_photo' => $profilePhotoUrl,
    ];
})->toArray();


    // Pass the reports and the transformed reports array to the view
    return view('admin.reports', compact('reportsArray', 'reports'));
}





public function reportshow($id)
{
    // Menampilkan laporan berdasarkan ID dengan kategori yang terkait
    $laporan = Laporan::findOrFail($id);
    
    
    return view('admin.reports-detail', compact('laporan'));
}

public function showReports(Request $request)
{
    $status = $request->input('status', 'semua'); // Default to 'semua' if no filter applied

    $reportsQuery = Report::with('user'); 

    if ($status !== 'semua') {
        $reportsQuery->where('status', $status);
    }

    $reports = $reportsQuery->get()->map(function ($report) {
        return [
            'id' => $report->id,
            'name' => $report->user->nama_lengkap,
            'date' => $report->created_at->format('Y-m-d H:i'),
            'status' => $report->status,
            'profile_photo' => $report->user->profile_photo ? 
                                 asset('storage/profile_photos/' . $report->user->profile_photo) : 
                                 strtoupper(substr($report->user->nama_lengkap, 0, 1)),
        ];
    });

    // Debugging: Log the reports
    \Log::info('Fetched reports:', $reports->toArray());

    return response()->json(['reports' => $reports]);
}


// public function laporan()
// {
//     // // Mengambil laporan berdasarkan user yang login
//     // $reports = Report::where('user_id', auth()->id())->get(); 

//     // // Mengecek apakah ada laporan yang diambil
//     // if ($reports->isEmpty()) {
//     //     dd('Tidak ada laporan yang ditemukan');
//     // } else {
//     //     dd($reports);  // Menampilkan laporan yang ditemukan
//     // }

//     // , compact('reports')

//     return view('laporan');  // Pastikan nama view sesuai dengan yang digunakan
}