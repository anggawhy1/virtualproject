@extends('layouts.app-sidebar')

@section('content')
<div class="mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Setting Profile</h1>

    @if ($section === 'default')
    <h2 class="text-sm text-blue-600 mb-4">
    </h2>
    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
        <div class="flex items-center justify-center mb-6">
            <img src="/images/pict1.png" alt="Profile Picture" class="w-24 h-24 rounded-full border border-blue-600">
        </div>
        <form action="{{ route('admin.settings', ['section' => 'default']) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nama</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" value="Karen Starr" class="w-full text-gray-800 focus:outline-none">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Email</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" value="karens.tar@gmail.com" class="w-full text-gray-800 focus:outline-none">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nomor Telepon</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" value="08319920010" class="w-full text-gray-800 focus:outline-none">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Perubahan</button>
        </form>
    </div>
    @elseif ($section === 'profile')
    <h2 class="text-sm text-blue-600 mb-4">
        <a href="{{ route('admin.settings', ['section' => 'default']) }}" class="text-blue-600 hover:underline">Settings</a> > Akun
    </h2>
    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
        <div class="flex items-center justify-center mb-6">
            <img src="/images/pict1.png" alt="Profile Picture" class="w-24 h-24 rounded-full border border-blue-600">
        </div>
        <form action="{{ route('admin.settings', ['section' => 'default']) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nama</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" value="Karen Starr" class="w-full text-gray-800 focus:outline-none">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Email</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" value="karens.tar@gmail.com" class="w-full text-gray-800 focus:outline-none">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600">Nomor Telepon</label>
                <div class="flex items-center border border-blue-600 rounded-lg p-2">
                    <input type="text" value="08319920010" class="w-full text-gray-800 focus:outline-none">
                    <i class="fas fa-edit text-blue-600"></i>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Perubahan</button>
        </form>
    </div>
    
    
    
    
    @endif
</div>
@endsection
