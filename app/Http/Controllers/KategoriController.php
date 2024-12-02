<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        // Menggunakan middleware 'isAdmin' pada metode yang memerlukan akses admin
        $this->middleware('isAdmin')->only(['storeKategori', 'updateKategori', 'destroyKategori']);
    }

    public function getKategoris()
    {
        $kategoris = Kategori::all();
        return response()->json($kategoris);
    }

    public function storeKategori(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Membuat kategori baru
        $kategori = Kategori::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil dibuat.',
            'kategori' => $kategori
        ], 201);
    }

    public function updateKategori(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Memperbarui kategori
        $kategori->update([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui.',
            'kategori' => $kategori
        ]);
    }

    public function destroyKategori($id)
    {
        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Menghapus kategori
        $kategori->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
