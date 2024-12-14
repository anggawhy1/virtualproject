@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">
    @include('partials.sidebar')

    <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Notifikasi</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-6"> <!-- Menambahkan mb-6 untuk memberi jarak bawah -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $notification['title'] }}</h2>
            <p class="text-gray-600 mb-4">{{ $notification['message'] }}</p>
            <p class="text-gray-500 text-sm">Tanggal: {{ $notification['date'] }}</p>
        </div>

        <a href="javascript:history.back()" class="inline-block mt-6">
            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Kembali
            </button>
        </a>

    </section>
</main>

@endsection