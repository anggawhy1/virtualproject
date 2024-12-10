<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Kategori; 
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

    $kategori = Kategori::all();
    return view('tambah-lapor', compact('kategori'));
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
        'kategori_id' => 'required|exists:kategoris,id',
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
        'kategori_id' => $validatedData['kategori_id'],
        'files' => $filePaths ? json_encode($filePaths) : null,
        'user_id' => $anonim ? null : Auth::id(),  // Jika anonim, user_id diatur null
        'anonim' => $anonim,  // Menyimpan true/false ke database
    ]);

    // Redirect ke halaman selesai-lapor dengan membawa ID laporan
    return redirect()->route('selesai-lapor', ['laporan' => $laporan->id])->with('success', 'Laporan berhasil dikirim.');
}

 public function updateStatus($id)
    {
        // Temukan laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Cek status saat ini dan ubah ke status berikutnya
        switch ($laporan->status) {
            case 'Diajukan':
                $laporan->status = 'Diproses';
                $laporan->updated_at = now(); // Set waktu saat diproses
                break;
            case 'Diproses':
                $laporan->status = 'Disetujui';
                $laporan->approved_at = now(); // Set waktu saat disetujui
                break;
            case 'Disetujui':
                // Jika sudah disetujui, tidak ada perubahan yang bisa dilakukan
                return redirect()->back()->with('error', 'Laporan sudah disetujui.');
        }

        // Simpan perubahan status
        $laporan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('laporan.index')->with('status', 'Status laporan berhasil diubah.');
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
    
    $laporan = Laporan::findOrFail($laporanId);
    
    if ($laporan->status == 'Diajukan') {
        $laporan->status = 'Disetujui';
        $laporan->save();
        
        if ($laporan->user_id) {
            $user = User::find($laporan->user_id);            
            
            if (!$laporan->is_claimed) {
                $user->increment('points', 1); 
                $laporan->is_claimed = true;
                $laporan->save();
            }
        }
        
        return response()->json([
            'message' => 'Laporan disetujui dan 1 poin berhasil diklaim.',
        ]);
    }

    return response()->json([
        'message' => 'Laporan tidak dapat disetujui.',
    ]);
}


}