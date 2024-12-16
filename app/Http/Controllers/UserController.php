<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index(Request $request)
{
    // Ambil filter role dari query string
    $roles = $request->input('roles', []); // Mengambil nilai filter roles dari query string

    // Query untuk mengambil user berdasarkan role
    $users = User::when(!empty($roles), function ($query) use ($roles) {
        return $query->whereIn('role', $roles); // Filter berdasarkan role
    })->get();

    // Mengirimkan data pengguna ke view
    return view('admin.users', compact('users'));
}


public function show($id)
{
    $user = User::findOrFail($id);
    return view('admin.user-detail', compact('user')); 
}


    public function create()
    {
        return view('admin.user-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|unique:users,phone',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

  public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.user-edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6',
        'phone' => 'nullable|string|unique:users,phone,' . $id,
        'role' => 'required|in:admin,user',
        'lokasi' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
    ]);

    $user->update([
        'nama_lengkap' => $request->nama_lengkap,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
        'phone' => $request->phone,
        'role' => $request->role,
        'lokasi' => $request->lokasi,
        'tanggal_lahir' => $request->tanggal_lahir,
    ]);

    return redirect()->route('users.edit', $user->id)->with('success', 'User berhasil diperbarui.');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }


}
