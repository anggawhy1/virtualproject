<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Kategori; 
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
        $request->validate([
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:2048',
            'anonim' => 'nullable|boolean',
        ]);

        // Menyimpan file jika ada
        $filePaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Periksa apakah file berhasil diunggah
                $filePaths[] = $file->store('uploads/laporan_files', 'public');
            }
        }

        // Menentukan status anonim
        $anonim = $request->has('anonim') ? true : false; // Jika dicentang, anonim = true

        // Membuat laporan
        Laporan::create([
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'kategori_id' => $request->kategori_id,
            'files' => $filePaths ? json_encode($filePaths) : null,
            'user_id' => $anonim ? null : Auth::id(),  // Jika anonim, user_id diatur null
            'anonim' => $anonim,  // Menyimpan true/false ke database
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim.');
    }

     public function lacak()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil laporan yang sudah dilaporkan oleh pengguna yang sedang login
        $laporans = Laporan::where('user_id', Auth::id())->get();

        // Passing $laporans variable to the view
        return view('lacak-aduan', compact('laporans'));
    }

    public function show(Request $request)
    {
        // Menangani permintaan untuk menampilkan detail laporan berdasarkan ID
        $laporan = Laporan::findOrFail($request->id);
        
        // Pass laporan ke view yang sesuai
        return view('aduan', compact('laporan'));
    }
}