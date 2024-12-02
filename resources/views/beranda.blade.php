@extends('layouts.app')

@section('content')


    <section class="max-w-5xl mx-auto px-6 md:px-12 py-12">
        <img src="{{ asset('images/frame1.png') }}" alt="Hero Image" class="w-full h-80 md:h-96 object-cover rounded-lg shadow-lg" />
        <div class="mt-8 text-left max-w-2xl">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">
                Bersama Kita Bangun Daerah Lebih Baik!
            </h1>
            <p class="text-md md:text-lg text-gray-600 mb-6">
                Laporkan masalah di sekitar Anda dengan mudah dan bantu pemerintah memperbaiki infrastruktur publik.
            </p>
            <a 
                href="{{ route('laporan.index') }}" 
                class="px-8 py-3 text-md md:text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
                Mulai Laporan Sekarang <span class="ml-2">→</span>
            </a>
        </div>
    </section>

@endsection
