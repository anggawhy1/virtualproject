@extends('layouts.app3')

@section('content')

    <section class="max-w-5xl mx-auto px-6 md:px-12 py-12">
        <img src="images/frame1.png" alt="Hero Image" class="w-full h-80 md:h-96 object-cover rounded-lg shadow-lg" />

        <div class="mt-8 text-left max-w-2xl">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">
                Bersama Kita Bangun Daerah Lebih Baik!
            </h1>
            <p class="text-md md:text-lg text-gray-600 mb-6">
                Laporkan masalah di sekitar Anda dengan mudah dan bantu pemerintah memperbaiki infrastruktur publik.
            </p>
            <a 
                href="/login" 
                class="px-8 py-3 text-md md:text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
                Mulai Laporan Sekarang <span class="ml-2">→</span>
            </a>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 md:px-12 py-10">
        <h2 class="text-3xl font-bold text-left text-gray-900 mb-10">
            Hanya dengan 3 Tahap!
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            
            <!-- Step 1 -->
            <div class="relative flex items-center p-6 border border-gray-300 rounded-lg bg-white shadow-md w-full md:w-[300px]">
                <img src="images/login 1.png" alt="Register Icon" class="w-10 h-10 mr-4" />
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-blue-600 mb-1">Daftar/Login</h3>
                    <p class="text-sm text-gray-600">Buat akun untuk melapor permasalahan di sekitar Anda.</p>
                </div>
                <div class="ml-auto">
                    <img src="images/Arrow right.png" alt="Arrow Icon" class="w-5 h-5" />
                </div>
            </div>

            <div class="relative flex items-center p-6 border border-gray-300 rounded-lg bg-white shadow-md w-full md:w-[300px]">
                <img src="images/clipboard.png" alt="Report Icon" class="w-10 h-10 mr-4" />
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-blue-600 mb-1">Isi Laporan</h3>
                    <p class="text-sm text-gray-600">Buat laporan secara detail dengan foto/video pendukung.</p>
                </div>
                <div class="ml-auto">
                    <img src="images/Arrow right.png" alt="Arrow Icon" class="w-5 h-5" />
                </div>
            </div>

            <div class="relative flex items-center p-6 border border-gray-300 rounded-lg bg-white shadow-md w-full md:w-[300px]">
                <img src="images/monitor.png" alt="Track Icon" class="w-10 h-10 mr-4" />
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-blue-600 mb-1">Lacak Laporan</h3>
                    <p class="text-sm text-gray-600">Lihat proses laporan dan tindakan yang diambil.</p>
                </div>
                <div class="ml-auto">
                    <img src="images/Arrow right.png" alt="Arrow Icon" class="w-5 h-5" />
                </div>
            </div>

        </div>

        <div class="mt-8 text-left">
            <a 
                href="/about" 
                class="w-full md:w-auto px-8 py-3 text-md md:text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
                Cek Selengkapnya Tentang Kami <span class="ml-2">→</span>
            </a>
        </div>
    </section>

@endsection
