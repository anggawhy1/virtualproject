<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
            // Path foto lama di storage
            $oldPhotoPath = public_path($user->profile_photo);
            
            // Memastikan foto lama ada sebelum dihapus
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath); // Menghapus foto lama
            }
        }

        // Menyimpan foto baru di folder public/profile_photos
        $imageName = uniqid() . '.' . $request->profile_photo->extension(); // Generate nama file unik
        $request->profile_photo->move(public_path('profile_photos'), $imageName);

        // Memperbarui kolom profile_photo di database dengan path lengkap
        $user->profile_photo = 'profile_photos/' . $imageName;
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

public function updateProfilePhoto(Request $request)
{
    // Validasi file yang diunggah
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Ambil data pengguna yang sedang login
    $user = Auth::user();

    // Cek apakah sudah ada foto sebelumnya dan hapus jika ada
    if ($user->profile_photo) {
        // Menghapus foto lama jika ada
        $oldPhotoPath = public_path('storage/profile_photos/' . $user->profile_photo);
        
        // Hapus foto lama jika ada
        if (file_exists($oldPhotoPath)) {
            unlink($oldPhotoPath);
        }
    }

    // Simpan foto yang diunggah
    // Path yang disimpan di database hanya perlu mencakup 'profile_photos/namafile'
    $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');

    // Perbarui foto profil pengguna dengan path relatif
    $user->profile_photo = 'profile_photos/' . basename($photoPath);
    $user->save();

    // Redirect ke halaman profil dengan pesan sukses
    return redirect()->route('edit-profil-photo')->with('success', 'Foto profil berhasil diperbarui.');
}



public function showSettings()
{
    // Mengambil data pengguna
    $user = Auth::user();
    return view('admin.settings', compact('user'));
}

public function updateSettings(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi data yang diterima
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6',
        'phone' => 'nullable|string|unique:users,phone,' . $id,
        'role' => 'required|in:admin,user',
        'lokasi' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
    ]);

    // Update data user
    $user->update([
        'nama_lengkap' => $request->nama_lengkap,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'phone' => $request->phone,
        'role' => $request->role,
        'lokasi' => $request->lokasi,
        'tanggal_lahir' => $request->tanggal_lahir,
    ]);

    // Redirect ke halaman settings dengan pesan sukses
    return redirect()->route('admin.settings', ['id' => $id])->with('success', 'Profil berhasil diperbarui');
}

public function updateProfilePhotoadmin(Request $request, $id)
{
    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Validasi file foto
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Jika file diunggah
    if ($request->hasFile('profile_photo')) {
        // Simpan foto di storage
        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        // Hapus foto lama jika ada
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Update data user
        $user->update([
            'profile_photo' => $path,
        ]);
    }

    // Redirect dengan pesan sukses
    return redirect()->route('admin.settings')->with('success', 'Foto Profil berhasil diperbarui');
}


}