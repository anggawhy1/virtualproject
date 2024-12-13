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
            <a href="{{ route('admin.users', $user['id']) }}" class="text-blue-600 hover:text-blue-800 ml-auto">
                <i class="fas fa-edit text-lg"></i> Edit
            </a>
        </div>

        <div class="flex items-center mb-6">
            <img src="{{ asset($user['profile']) }}" alt="Profile" class="w-10 h-10 rounded-full">
            <div class="ml-4"> 
                <h2 class="text-xl font-semibold">{{ $user['name'] }}</h2>
                <p class="text-gray-600">{{ $user['role'] }}</p>
            </div>
        </div>

        <div class="space-y-4">

            <div class="flex items-center space-x-6">
                <span class="font-semibold w-32">Email:</span>
                <span class="text-gray-700">{{ $user['email'] }}</span>
            </div>
            <div class="flex items-center space-x-6">
                <span class="font-semibold w-32">No HP:</span>
                <span class="text-gray-700">{{ $user['phone'] }}</span>
            </div>
            <div class="flex items-center space-x-6">
                <span class="font-semibold w-32">Lokasi:</span>
                <span class="text-gray-700">{{ $user['address'] }}</span>
            </div>
            <div class="flex items-center space-x-6">
                <span class="font-semibold w-32">Tanggal Lahir:</span>
                <span class="text-gray-700">{{ \Carbon\Carbon::parse($user['dob'])->format('d F Y') }}</span>
            </div>
        </div>

        <div class="mt-6 space-y-4">

            <div class="flex items-center justify-between bg-blue-50 border border-blue-600 rounded-lg p-4">
                <span class="font-semibold text-blue-600">Blokir/Nonaktifkan Akun</span>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Blokir
                </button>
            </div>

            <div class="flex items-center justify-between bg-blue-50 border border-blue-600 rounded-lg p-4">
                <span class="font-semibold text-blue-600">Hapus Akun</span>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection