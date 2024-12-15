<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
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
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'kategori' => 'required', // Kategori field is required
        'files.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:2048',
        'anonim' => 'nullable|boolean',
    ]);

    // Ambil nilai kategori dari input
    $kategori = $validatedData['kategori'];

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
        'kategori' => $kategori, // Save kategori
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
        'status' => 'required|in:Diajukan,Diproses,Disetujui',
    ]);

    // Temukan laporan berdasarkan ID
    $laporan = Laporan::findOrFail($id);

    // Update status
    $laporan->status = $request->status;

    // Set waktu jika status berubah ke 'Diproses' atau 'Disetujui'
    if ($request->status === 'Diproses') {
        $laporan->updated_at = now(); // Update timestamp saat status berubah ke Diproses
    } elseif ($request->status === 'Disetujui') {
        $laporan->approved_at = now(); // Set waktu persetujuan
    }

    // Simpan perubahan
    $laporan->save();

    // Redirect dengan pesan sukses
    return redirect()->back()->with('status', 'Status laporan berhasil diubah.');
}


     public function lacak()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil laporan yang sudah dilaporkan oleh pengguna yang sedang login
        $laporans = Laporan::where('user_id', Auth::id())->get();
        // dd($laporans);
        // die;
        // Passing $laporans variable to the view
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

    // Pass laporan ke view yang sesuai
    return view('aduan', compact('laporan'));
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

public function approveAndClaimPoint($laporanId)
{
    // Retrieve the laporan by its ID
    $laporan = Laporan::findOrFail($laporanId);
    
    // Check if the laporan status is 'Disetujui'
    if ($laporan->status == 'Disetujui') {
        // Mark the claim as done
        $laporan->is_claimed = 1; 
        $laporan->save(); // Save the updated laporan
        $user = Auth::user();
        
        if ($user) {
            // Increment the points of the currently logged-in user
            $user->increment('points', 1); // Adds 1 to the current points
            $user->save(); // Save the updated user points
        }
        
        // Return success message
        return response()->json(['success' => true, 'message' => 'Laporan disetujui dan 1 poin berhasil diklaim.']);
    }

    // Return failure message if the laporan is not approved
    return response()->json(['success' => false, 'message' => 'Laporan tidak dapat disetujui.']);
}

public function adminReports()
{
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $reports = Laporan::with('user')->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.reports', compact('reports'));
}


public function reportshow($id)
{
    // Menampilkan laporan berdasarkan ID dengan kategori yang terkait
    $laporan = Laporan::findOrFail($id);
    
    
    return view('admin.reports-detail', compact('laporan'));
}

public function laporan()
{
    // Mengambil laporan berdasarkan user yang login
    $reports = Report::where('user_id', auth()->id())->get(); 

    // Mengecek apakah ada laporan yang diambil
    if ($reports->isEmpty()) {
        dd('Tidak ada laporan yang ditemukan');
    } else {
        dd($reports);  // Menampilkan laporan yang ditemukan
    }

    return view('laporan', compact('reports'));  // Pastikan nama view sesuai dengan yang digunakan
}



}