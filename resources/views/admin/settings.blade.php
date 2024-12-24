@extends('layouts.app-sidebar')

@section('content')
<div class="mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Setting Profile</h1>

    <h2 class="text-sm text-blue-600 mb-4">Pengaturan Akun</h2>
    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
     <div class="flex items-center justify-center mb-6">
  @if ($user->profile_photo) 
    <!-- Check if the user has a profile picture -->
    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile" class="w-24 h-24 rounded-full border border-blue-600">
@else
    <div class="w-24 h-24 rounded-full border border-blue-600 flex items-center justify-center text-gray-700 text-2xl font-bold">
        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }} 
    </div>
@endif
</div>






        <form action="{{ route('admin.update-settings', ['id' => $user->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nama Lengkap</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
                @error('nama_lengkap')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Email</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nomor Telepon</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
                @error('phone')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Lokasi</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" name="lokasi" value="{{ old('lokasi', $user->lokasi) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
                @error('lokasi')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Tanggal Lahir</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
                @error('tanggal_lahir')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Role</label>
                <select name="role" class="w-full border border-blue-600 rounded-lg p-2 text-gray-800 focus:outline-none">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
              <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Perubahan</button>
</form>
 </div>
</div>

   <h2 class="text-sm text-blue-600 mb-4">Foto Profil</h2>
<div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
   <form action="{{ route('admin.update-photo', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label class="block text-sm text-gray-600">Foto Profil</label>
        <input type="file" name="profile_photo" class="w-full text-gray-800 focus:outline-none">
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Foto Profil</button>
</form>

</div>

</div>
@endsection
