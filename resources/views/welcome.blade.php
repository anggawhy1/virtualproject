@extends('layouts.app3')

@section('content')

<section class="container mx-auto px-4 md:px-10 py-12 flex flex-col md:flex-row items-center gap-12" data-aos="fade-up">
    <!-- Bagian Kiri: Teks -->
    <div class="text-left flex-1" style="margin-left: 11.5%; max-width: 600px;" data-aos="fade-right">
        <h1 class="text-4xl md:text-4xl font-bold text-gray-900 leading-relaxed mb-6">
            <span class="text-blue-600 font-bold block mb-2">LaporPak.Com</span>
            <span class="block font-extrabold mt-3">Suara Anda,</span>
            <span class="block font-extrabold mt-3">Perubahan Kita!</span>
        </h1>
        <p class="text-base md:text-lg text-gray-600 leading-loose mb-8">
            Laporkan masalah di sekitar Anda dengan
            <span class="block mt-2">mudah dan bantu pemerintah memperbaiki</span>
            <span class="block mt-2">infrastruktur publik.</span>
        </p>
        <a href="/login"
            class="px-6 py-3 inline-flex items-center text-white text-base md:text-lg bg-blue-600 font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
            <span class="inline-block">Mulai Laporan Sekarang</span>
            <i class="fas fa-chevron-right ml-2 text-lg"></i>
        </a>
    </div>

    <!-- Bagian Kanan: Gambar -->
    <div class="flex-1 flex justify-center md:justify-end" style="margin-right: 4%;" data-aos="fade-left">
        <img src="images/landing.png" alt="Hero Image"
            class="w-full max-w-sm md:max-w-md object-contain">
    </div>
</section>

<section class="max-w-5xl mx-auto px-6 md:px-12 py-10">
    <h2 class="text-3xl font-bold text-left text-gray-900 mb-10" data-aos="fade-down">
        Hanya dengan 3 Tahap !
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
        <!-- Step 1 -->
        <div class="relative flex items-center p-6 border border-blue-600 rounded-lg bg-white shadow-md shadow-blue-600 w-full md:w-[300px]" data-aos="zoom-in" data-aos-delay="100">
            <img src="images/login 1.png" alt="Register Icon" class="w-10 h-10 mr-4" />
            <div class="flex-1">
                <h3 class="text-lg font-bold text-blue-600 mb-1">Daftar/Login</h3>
                <p class="text-sm text-gray-600">Buat akun untuk melapor permasalahan di sekitar Anda.</p>
            </div>
            <div class="ml-auto">
                <i class="fas fa-arrow-right text-blue-600 text-lg"></i>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="relative flex items-center p-6 border border-blue-600 rounded-lg bg-white shadow-md shadow-blue-600 w-full md:w-[300px]" data-aos="zoom-in" data-aos-delay="200">
            <img src="images/clipboard.png" alt="Report Icon" class="w-10 h-10 mr-4" />
            <div class="flex-1">
                <h3 class="text-lg font-bold text-blue-600 mb-1">Isi Laporan</h3>
                <p class="text-sm text-gray-600">Buat laporan secara detail dengan foto/video pendukung.</p>
            </div>
            <div class="ml-auto">
                <i class="fas fa-arrow-right text-blue-600 text-lg"></i>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="relative flex items-center p-6 border border-blue-600 rounded-lg bg-white shadow-md shadow-blue-600 w-full md:w-[300px]" data-aos="zoom-in" data-aos-delay="300">
            <img src="images/monitor.png" alt="Track Icon" class="w-10 h-10 mr-4" />
            <div class="flex-1">
                <h3 class="text-lg font-bold text-blue-600 mb-1">Lacak Laporan</h3>
                <p class="text-sm text-gray-600">Lihat proses laporan dan tindakan yang diambil.</p>
            </div>
            <div class="ml-auto">
                <i class="fas fa-arrow-right text-blue-600 text-lg"></i>
            </div>
        </div>
    </div>

    <div class="mt-8 mb-12 text-left" data-aos="fade-up">
        <a href="/tentang"
            class="w-full md:w-auto px-8 py-3 text-md md:text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
            Cek Selengkapnya Tentang Kami
            <i class="fas fa-chevron-right ml-2"></i>
        </a>
    </div>
</section>


@endsection