<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke view 'profile'
        return view('profile', compact('user'));
    }

    public function edit()
    {
        return view('edit-data-diri');
    }

public function update(Request $request)
{
    $user = Auth::user(); // Mendapatkan pengguna yang sedang login

    // Validasi data input
    $validated = $request->validate([
        'nama_lengkap' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'lokasi' => 'nullable|string|max:255',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto profil
    ]);

    // Jika ada foto profil yang diunggah
    if ($request->hasFile('profile_photo')) {
        // Menghapus foto lama jika ada
        if ($user->profile_photo) {
            // Menghapus file lama jika ada
            Storage::delete('profile_photos/' . $user->profile_photo);
        }

        // Menyimpan foto baru di folder storage/app/profile_photos
        $imageName = time() . '.' . $request->profile_photo->extension();
        $request->profile_photo->storeAs('profile_photos', $imageName);

        // Memperbarui kolom profile_photo di database
        $user->profile_photo = $imageName;
    }

    // Mengupdate data pengguna
    $updated = $user->update([
        'nama_lengkap' => $validated['nama_lengkap'],
        'phone' => $validated['phone'],
        'email' => $validated['email'],
        'lokasi' => $validated['lokasi'],
    ]);

    // Redirect ke halaman profil dengan pesan sukses
    return redirect()->route('edit-profil')->with('success', 'Profil berhasil diperbarui');
}



    public function editprofil()
    {
        // Mengirim data pengguna yang sedang login untuk ditampilkan pada halaman edit
        $user = Auth::user();
        return view('edit-profil', compact('user'));
    }

public function updateProfilePhotoadmin(Request $request)
{
    $user = Auth::user();

    // Validasi file foto
    $validated = $request->validate([
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
    ]);

    if ($request->hasFile('profile_photo')) {
        // Hapus foto lama jika ada
        if ($user->profile_photo) {
            Storage::delete('profile_photos/' . $user->profile_photo); // Menghapus foto lama
        }

        // Menyimpan foto baru di dalam folder storage/app/profile_photos
        $imageName = time() . '.' . $request->profile_photo->extension();
        $request->profile_photo->storeAs('profile_photos', $imageName);

        // Update foto profil di database
        $user->profile_photo = $imageName;
        $user->save();
    }

    // Redirect kembali ke halaman settings admin dengan pesan sukses
    return redirect()->route('admin.settings', ['section' => 'profile'])->with('success', 'Foto profil berhasil diperbarui');
}


public function showSettings()
{
    // Mengambil data pengguna
    $user = Auth::user();
    return view('admin.settings', compact('user'));
}

public function updateSettings(Request $request, $section)
{
    $user = Auth::user();

    // Validate the request data
    $validated = $request->validate([
        'nama_lengkap' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'lokasi' => 'nullable|string|max:255',
    ]);

    // Update the user's profile data
    $user->update([
        'nama_lengkap' => $validated['nama_lengkap'] ?? $user->nama_lengkap,
        'phone' => $validated['phone'] ?? $user->phone,
        'email' => $validated['email'],
        'lokasi' => $validated['lokasi'] ?? $user->lokasi,
    ]);

    return redirect()->route('admin.settings', ['section' => $section])->with('success', 'Profil berhasil diperbarui');
}


}