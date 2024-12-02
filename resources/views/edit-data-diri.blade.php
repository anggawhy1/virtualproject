@extends('layouts.app')

@section('content')
    <div class="flex flex-grow gap-8 px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">
        @include('partials.sidebar', ['active' => 'editdatadiri'])

        <main class="flex-grow max-w-4xl mx-auto p-6 bg-white border border-gray-300 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-blue-600 mb-8">Edit Data Diri</h1>

            <div class="p-6 border border-gray-300 rounded-lg bg-white">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Data Diri</h2>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    

                    <div class="relative">
                        <input
                            type="text"
                            name="nama_lengkap"
                            value="{{ auth()->user()->nama_lengkap }}"
                            placeholder="Nama Lengkap"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                        />
                    </div>

                    <div class="relative">
                        <input
                            type="text"
                            name="phone"
                            value="{{ auth()->user()->phone }}"
                            placeholder="Nomor Telepon"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                        />
                    </div>

                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            value="{{ auth()->user()->email }}"
                            placeholder="Email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                        />
                    </div>

                    <div class="relative">
                        <input
                            type="text"
                            name="lokasi"
                            value="{{ auth()->user()->lokasi }}"
                            placeholder="Lokasi"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                        />
                    </div>

                    <button type="submit" class="w-full py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                        Selesai
                    </button>
                </form>
            </div>
        </main>
    </div>
@endsection
