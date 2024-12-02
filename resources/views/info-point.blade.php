@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">

    @include('partials.sidebar', ['active' => 'Info Point'])

    <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Cara Kamu Mendapatkan Point</h1>
        <p class="text-gray-700 mb-4">
            Kamu bisa mendapatkan point dengan cara melaporkan aduan. Aduan yang telah terverifikasi dan disetujui akan terhitung sebagai 1 point.
        </p>
        <p class="text-gray-700 mb-8">
            Kamu dapat menukarkan point tersebut dengan berbagai hadiah. Semakin berharga hadiahnya, semakin banyak point yang perlu kamu tukar.
        </p>
        <a href="{{ url('/tambah-lapor') }}" 
           class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
           Mulai Laporan Sekarang! <span class="ml-2">→</span>
        </a>
    </section>
</main>

@endsection
