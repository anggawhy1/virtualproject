@extends('layouts.app')

@section('content') 

    <main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-4">Lacak Aduan Kamu!</h1>
        <p class="text-gray-700 mb-8">
            Lacak aduan yang sudah kamu laporkan disini. Ingin melapor? 
            <a href="/tambah-lapor" class="text-blue-600 hover:underline">Lapor disini</a>
        </p>
        <!-- Dropdown untuk memilih laporan yang sudah dilaporkan -->
        <form action="{{ route('lacakaduan') }}" method="GET" class="flex items-center space-x-4">
            <select
                name="id"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
                required
            >
                <option value="" disabled selected>Pilih Nomor Aduan</option>
                @foreach($laporans as $laporan)
                    <option value="{{ $laporan->id }}">{{ $laporan->id }}</option>
                @endforeach
            </select>
            <button
                type="submit"
                class="px-6 py-3 text-md font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105"
            >
                Lacak
            </button>
        </form>
    </main>
 
@endsection
