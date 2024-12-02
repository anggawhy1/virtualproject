@extends('layouts.app')

@section('content')

    <main class="flex-grow flex w-full max-w-7xl mx-auto px-4 md:px-20 py-12 space-x-8 bg-gray-50 text-gray-800 font-sans min-h-screen">
        @include('partials.sidebar')

        <div class="flex-grow p-8 border border-gray-300 rounded-lg shadow-lg bg-white">
            <h1 class="text-3xl font-bold text-blue-600 mb-8">Profile</h1>

            <div class="flex items-center space-x-8 mb-8">

                <div class="relative flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-gray-300">
                        @if ($user->profile_photo)
                            <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile" class="object-cover w-full h-full" />
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-700 text-2xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <a
                        href="{{ route('edit-profil-photo') }}"
                        class="mt-2 flex items-center text-blue-600 hover:underline"
                        title="Edit Profil"
                    >
                        <i class="fas fa-pencil-alt mr-1"></i> Edit Profil
                    </a>
                </div>

                <div class="flex-grow border border-gray-200 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Diri</h2>
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-semibold">Nama Lengkap:</span> {{ $user->nama_lengkap }}
                        </div>
                        <div>
                            <span class="font-semibold">Email:</span> {{ $user->email }}
                        </div>
                        <div>
                            <span class="font-semibold">Nomor Telepon:</span> {{ $user->phone ?? 'Tidak tersedia' }}
                        </div>
                        <div>
                            <span class="font-semibold">Lokasi:</span> {{ $user->lokasi ?? 'Tidak tersedia' }}
                        </div>
                    </div>
                    <a
                        href="{{ route('edit-profil') }}"
                        class="mt-4 px-4 py-2 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg flex items-center space-x-2 hover:bg-gray-100"
                    >
                        <i class="fas fa-edit"></i>
                        <span>Edit Data Diri</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

@endsection
