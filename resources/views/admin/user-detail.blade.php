@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-blue-600 mb-6">Kelola User</h1>

    <div class="flex items-center mb-6 text-sm text-gray-600">
        <a href="{{ route('admin.users') }}" class="text-blue-600">Kelola User</a>
        <span class="mx-2"> > </span>
        <span class="text-blue-600 font-medium">Detail User</span>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('users.edit', $user['id']) }}" class="text-blue-600 hover:text-blue-800 ml-auto">
                <i class="fas fa-edit text-lg"></i> Edit
            </a>
        </div>

      <div class="flex items-center mb-6">
   @if ($user->profile_photo) <!-- Check if the user has a profile picture -->
    <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile" class="w-10 h-10 rounded-full">
@else
    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 text-2xl font-bold">
        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }} <!-- Display the first letter of the user's name if no photo -->
    </div>
@endif

<div class="ml-4">
    <h2 class="text-xl font-semibold">{{ $user->nama_lengkap ?? 'Nama tidak tersedia' }}</h2>
    <p class="text-gray-600">{{ $user->role ?? 'Role tidak tersedia' }}</p>
</div>
</div>


    <div class="space-y-4">
    <div class="flex items-center space-x-6">
        <span class="font-semibold w-32">Email:</span>
        <span class="text-gray-700">{{ $user['email'] ?? 'Email tidak tersedia' }}</span>
    </div>
    <div class="flex items-center space-x-6">
        <span class="font-semibold w-32">No HP:</span>
        <span class="text-gray-700">{{ $user['phone'] ?? 'No HP tidak tersedia' }}</span>
    </div>
    <div class="flex items-center space-x-6">
        <span class="font-semibold w-32">Lokasi:</span>
        <span class="text-gray-700">{{ $user['lokasi'] ?? 'Lokasi tidak tersedia' }}</span>
    </div>
    <div class="flex items-center space-x-6">
        <span class="font-semibold w-32">Tanggal Lahir:</span>
        <span class="text-gray-700">
            {{ $user['dob'] ? \Carbon\Carbon::parse($user['dob'])->format('d F Y') : 'Tanggal Lahir tidak tersedia' }}
        </span>
    </div>
</div>
        <div class="mt-6 space-y-4">

           <div class="flex items-center justify-between bg-blue-50 border border-blue-600 rounded-lg p-4">
    <span class="font-semibold text-blue-600">Hapus Akun</span>
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
            Hapus
        </button>
    </form>
</div>

        </div>
    </div>
</div>
@endsection