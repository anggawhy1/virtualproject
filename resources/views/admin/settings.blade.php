@extends('layouts.app-sidebar')

@section('content')
<div class="mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Settings</h1>

    @if ($section === 'default')
    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
        <ul class="space-y-4">
            <li>
                <a href="{{ route('admin.settings', ['section' => 'profile']) }}" class="flex items-center justify-between p-4 border border-blue-600 rounded-lg hover:bg-blue-100">
                    <span class="flex items-center text-blue-600">
                        <i class="fas fa-user mr-3"></i> Akun
                    </span>
                    <i class="fas fa-chevron-right text-blue-600"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings', ['section' => 'theme']) }}" class="flex items-center justify-between p-4 border border-blue-600 rounded-lg hover:bg-blue-100">
                    <span class="flex items-center text-blue-600">
                        <i class="fas fa-paint-brush mr-3"></i> Theme
                    </span>
                    <i class="fas fa-chevron-right text-blue-600"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings', ['section' => 'language']) }}" class="flex items-center justify-between p-4 border border-blue-600 rounded-lg hover:bg-blue-100">
                    <span class="flex items-center text-blue-600">
                        <i class="fas fa-language mr-3"></i> Bahasa
                    </span>
                    <i class="fas fa-chevron-right text-blue-600"></i>
                </a>
            </li>
        </ul>
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
    @elseif ($section === 'theme')
    <h2 class="text-sm text-blue-600 mb-4">
        <a href="{{ route('admin.settings', ['section' => 'default']) }}" class="text-blue-600 hover:underline">Settings</a> > Theme
    </h2>
    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
        <form action="{{ route('admin.settings', ['section' => 'default']) }}" method="POST">
            @csrf
            <div class="mb-4">
                <button class="w-full text-left border border-blue-600 rounded-lg p-4 text-blue-600 font-bold hover:bg-blue-100">Dark Mode</button>
            </div>
            <div class="mb-4">
                <button class="w-full text-left border border-blue-600 rounded-lg p-4 text-blue-600 font-bold hover:bg-blue-100">Light Mode</button>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Perubahan</button>
        </form>
    </div>
    @elseif ($section === 'language')
    <h2 class="text-sm text-blue-600 mb-4">
        <a href="{{ route('admin.settings', ['section' => 'default']) }}" class="text-blue-600 hover:underline">Settings</a> > Bahasa
    </h2>
    <div class="bg-white rounded-lg shadow-md p-4 border border-blue-600">
        <form action="{{ route('admin.settings', ['section' => 'default']) }}" method="POST">
            @csrf
            <div class="mb-4">
                <button class="w-full text-left border border-blue-600 rounded-lg p-4 text-blue-600 font-bold hover:bg-blue-100">Bahasa Indonesia</button>
            </div>
            <div class="mb-4">
                <button class="w-full text-left border border-blue-600 rounded-lg p-4 text-blue-600 font-bold hover:bg-blue-100">English</button>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">Simpan Perubahan</button>
        </form>
    </div>
    @endif
</div>
@endsection
