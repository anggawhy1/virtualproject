@extends('layouts.app-sidebar')

@section('content')
<div class="mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit User</h1>

    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
        <div class="flex items-center justify-center mb-6">
            @if ($user->profile_photo) 
                <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile" class="w-24 h-24 rounded-full border border-blue-600">
            @else
                <div class="w-24 h-24 rounded-full border border-blue-600 flex items-center justify-center text-gray-700 text-2xl font-bold">
                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600">Role</label>
            <div class="flex items-center border border-blue-600 rounded-lg p-2">
                <input type="text" value="{{ $user->role == 'admin' ? 'Admin' : 'User' }}" class="w-full text-gray-800 focus:outline-none" readonly>
            </div>
        </div>

        <form action="{{ route('admin.update-settings', $user->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Email</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nomor Telepon</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Lokasi</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" name="lokasi" value="{{ old('lokasi', $user->lokasi) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600">Tanggal Lahir</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" class="w-full text-gray-800 focus:outline-none">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
