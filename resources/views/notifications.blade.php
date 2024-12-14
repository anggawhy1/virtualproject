@extends('layouts.app')

@section('content') 

<main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">
    @include('partials.sidebar') 

    <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Notifikasi</h1>

        <div class="space-y-4">
            <!-- Notifikasi 1 -->
            <a href="{{ url('/notifikasi/1') }}" class="flex items-center p-4 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition duration-300">
                <div class="flex-grow">
                    <p class="text-lg font-semibold text-gray-800">Lapran kamu telah terverifikasi, lihat disini !</p>
                </div>
                <div class="ml-4 text-gray-500">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ url('/notifikasi/2') }}" class="flex items-center p-4 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition duration-300">
                <div class="flex-grow">
                    <p class="text-lg font-semibold text-gray-800">Lapran kamu telah terverifikasi, lihat disini !</p>
                </div>
                <div class="ml-4 text-gray-500">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ url('/notifikasi/3') }}" class="flex items-center p-4 bg-white border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition duration-300">
                <div class="flex-grow">
                    <p class="text-lg font-semibold text-gray-800">Kamu telah melaporkan aduan, lihat disini ! </p>
                </div>
                <div class="ml-4 text-gray-500">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </div>
    </section>
</main>

@endsection
