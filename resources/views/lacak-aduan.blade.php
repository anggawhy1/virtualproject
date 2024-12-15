@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">
    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-4">Lacak Aduan Kamu!</h1>
    <p class="text-gray-700 mb-8">
        Lacak aduan yang sudah kamu laporkan disini. Ingin melapor?
        <a href="/tambah-lapor" class="text-blue-600 hover:underline">Lapor disini</a>
    </p>
    <!-- Input untuk memasukkan ID laporan -->
    <form action="{{ route('lacakaduan.show') }}" method="GET" class="flex items-center space-x-4">
        <input
            type="text"
            name="id"
            placeholder="Masukkan Nomor Aduan"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700"
            required />
        <button
            type="submit"
            class="px-6 py-3 text-md font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 ">
            Lacak
        </button>

    </form>
</main>

@endsection