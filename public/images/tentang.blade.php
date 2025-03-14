@extends('layouts.app')

@section('content')
<main class="flex-grow w-full px-6 md:px-20 py-10 bg-gray-50 text-gray-800 font-sans min-h-screen">

    <section class="text-center mb-4" data-aos="fade-up">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">Tentang LaporPak.com</h1>
        <p class="text-gray-700 text-md md:text-lg">
            Membangun Indonesia yang lebih baik dengan memberdayakan masyarakat untuk melaporkan masalah di sekitar mereka.
        </p>
    </section>

    <section class="relative max-w-5xl mx-auto mb-12" data-aos="zoom-in">
        <div class="relative overflow-hidden rounded-lg shadow-lg">

            <div id="hero-slider" class="relative">
                <img
                    id="hero-image"
                    src="{{ asset('images/image1.png') }}"
                    alt="Hero Image"
                    class="w-full h-80 md:h-96 object-cover transition-opacity duration-900" />
            </div>

            <!-- Tombol Previous Slide -->
            <button
                id="prev-slide"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition">
                <i class="fas fa-chevron-left text-lg"></i>
            </button>

            <!-- Tombol Next Slide -->
            <button
                id="next-slide"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition">
                <i class="fas fa-chevron-right text-lg"></i>
            </button>
        </div>

        <div id="dots-container" class="flex justify-center mt-4 gap-4"></div>
    </section>

    <section class="flex flex-col md:flex-row items-center justify-between mb-16 px-6 md:px-20 gap-8" data-aos="fade-right">
        <div class="md:w-1/2 text-gray-800">
            <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4">Apasih LaporPak.com Itu?</h2>
            <p class="text-gray-700 mb-4 text-md md:text-lg">
                <span class="font-semibold text-blue-600">LaporPak.com</span> adalah sebuah platform digital inovatif yang memberdayakan masyarakat Indonesia untuk berpartisipasi aktif dalam pembangunan daerah mereka. Melalui platform ini, masyarakat dapat melaporkan berbagai masalah yang mereka temui di lingkungan sekitar, mulai dari jalan rusak, sampah menumpuk, hingga fasilitas publik yang tidak berfungsi dengan baik.
            </p>
            <a
                href="/tambah-lapor"
                class="px-6 py-3 text-md font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
                Mulai Laporan Sekarang
                <i class="fas fa-chevron-right ml-2 text-lg"></i>
            </a>

        </div>
        <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center" data-aos="fade-left">
            <img src="{{ asset('images/apasih.png') }}" alt="Illustration Image" class="w-full h-auto max-w-md rounded-lg shadow-lg" />
        </div>
    </section>

    <section class="text-center mb-16 px-6 md:px-20 gap-8" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-blue-600 mb-10">Bagaimana Cara Kerja LaporPak.com?</h2>
        <div class="relative overflow-hidden rounded-lg shadow-lg max-w-5xl mx-auto">
            <img
                src="{{ asset('images/bag.png') }}"
                alt="Cara Kerja LaporPak"
                class="w-full h-auto object-cover" />
        </div>
    </section>

    <section class="flex flex-col md:flex-row items-center justify-between mb-16 px-6 md:px-20 gap-8" data-aos="fade-up">
        <div class="md:w-1/2 text-gray-800">
            <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-4">Manfaat LaporPak.com Bagi Masyarakat dan Pemerintah</h2>
            <p class="text-gray-700 mb-4 text-md md:text-lg">
                LaporPak.com memudahkan masyarakat melaporkan masalah lingkungan dan membantu pemerintah mendapatkan data untuk prioritas pembangunan yang lebih tepat.
            </p>
            <ul class="list-disc list-inside text-gray-700 space-y-3 text-lg">
                <li><strong>Bagi Masyarakat</strong> - Memudahkan melaporkan masalah lingkungan. Meningkatkan rasa memiliki dan keterlibatan dalam lingkungan.</li>
                <li><strong>Bagi Pemerintah</strong> - Memberikan data real-time tentang masalah di lapangan. Membantu pemerintah mengidentifikasi prioritas pembangunan.</li>
            </ul>
        </div>
        <img src="{{ asset('images/manfaat.png') }}" alt="Benefits Image" class="md:w-1/2 h-64 md:h-80 lg:h-96 object-cover rounded-lg shadow-lg" data-aos="fade-up" />
    </section>

    <section class="text-center mb-16 px-6 md:px-20">
        <h2 class="text-3xl font-bold text-blue-600 mb-4" data-aos="fade-up">Apa Kata Pengguna LaporPak.com</h2>
        <p class="text-gray-700 mb-8 text-md md:text-lg max-w-2xl mx-auto" data-aos="fade-up">
            <span class="font-semibold text-blue-600">LaporPak.com</span> telah membantu banyak orang untuk menyampaikan keluhan mereka dengan mudah dan cepat. Lihat apa yang dikatakan para pengguna kami yang telah berkontribusi membuat lingkungan mereka lebih baik.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Feedback 1 -->
            <div class="p-6 border border-blue-300 rounded-lg bg-white shadow-md flex flex-col items-start" data-aos="fade-right">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/pict4.png') }}" alt="Adam Jacobs" class="w-10 h-10 rounded-full mr-3" />
                    <p class="text-blue-600 font-semibold">Adam Jacobs</p>
                </div>
                <p class="text-gray-600 text-left">
                    LaporPak.com memudahkan saya melaporkan masalah di sekitar saya. Hanya dengan beberapa langkah, laporan saya segera ditindaklanjuti.
                </p>
            </div>

            <!-- Feedback 2 -->
            <div class="p-6 border border-blue-300 rounded-lg bg-white shadow-md flex flex-col items-start" data-aos="fade-left">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/pict3.png') }}" alt="Adam Denis" class="w-10 h-10 rounded-full mr-3" />
                    <p class="text-blue-600 font-semibold">Adam Denis</p>
                </div>
                <p class="text-gray-600 text-left">
                    Website ini sangat membantu dalam mewujudkan transparansi dan memberikan suara bagi masyarakat. Terima kasih LaporPak!
                </p>
            </div>

            <!-- Feedback 3 -->
            <div class="p-6 border border-blue-300 rounded-lg bg-white shadow-md flex flex-col items-start" data-aos="fade-right">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/pict1.png') }}" alt="Adam Joseph" class="w-10 h-10 rounded-full mr-3" />
                    <p class="text-blue-600 font-semibold">Adam Joseph</p>
                </div>
                <p class="text-gray-600 text-left">
                    Proses pelaporan yang cepat dan mudah membuat saya merasa didengar oleh pemerintah setempat. Platform yang luar biasa!
                </p>
            </div>

            <!-- Feedback 4 -->
            <div class="p-6 border border-blue-300 rounded-lg bg-white shadow-md flex flex-col items-start" data-aos="fade-left">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/pict2.png') }}" alt="Adam Elwis" class="w-10 h-10 rounded-full mr-3" />
                    <p class="text-blue-600 font-semibold">Adam Elwis</p>
                </div>
                <p class="text-gray-600 text-left">
                    LaporPak memudahkan saya untuk berkontribusi dalam menjaga lingkungan sekitar. Saya merasa menjadi bagian dari perubahan positif.
                </p>
            </div>
        </div>
    </section>

    <section class="text-center mb-16 px-6 md:px-20" data-aos="zoom-in">
        <p class="text-lg text-gray-700 mb-4">Ayo Berkontribusi Sekarang!</p>
        <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-8 leading-relaxed">
            Bersama kita bisa menciptakan perubahan nyata di lingkungan kita. Jangan hanya diam, laporkan masalah di sekitar Anda dan bantu wujudkan lingkungan yang lebih baik!
        </h2>
        <a
            href="/tambah-lapor"
            class="px-10 py-4 text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105">
            Mulai Laporan Sekarang
            <i class="fas fa-chevron-right ml-2 text-lg"></i>
        </a>
    </section>



</main>

<!-- AOS Scripts -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000, // Durasi animasi
        once: true // Animasi hanya berjalan sekali
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroImages = [
            "{{ asset('images/about2.png') }}",
            "{{ asset('images/about10.png') }}",
            "{{ asset('images/about20.png') }}"
        ];

        let currentIndex = 0;
        const heroImageElement = document.getElementById('hero-image');
        const dotsContainer = document.getElementById('dots-container');
        const prevButton = document.getElementById('prev-slide');
        const nextButton = document.getElementById('next-slide');

        // Membuat dot navigasi
        heroImages.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.classList.add(
                'cursor-pointer',
                'w-3',
                'h-3',
                'rounded-full',
                'mx-1',
                'transition-all',
                'duration-300',
                'bg-gray-300'
            );
            dot.dataset.index = index;
            dot.addEventListener('click', () => setCurrentIndex(index));
            dotsContainer.appendChild(dot);
        });

        const updateSlider = () => {
            // Tambahkan efek transisi Tailwind
            heroImageElement.classList.add('opacity-0', 'transition-opacity', 'duration-700');

            setTimeout(() => {
                heroImageElement.src = heroImages[currentIndex];
                heroImageElement.classList.remove('opacity-0');
            }, 300);

            // Perbarui dot navigasi
            Array.from(dotsContainer.children).forEach((dot, index) => {
                dot.classList.toggle('bg-blue-600', index === currentIndex);
                dot.classList.toggle('bg-gray-300', index !== currentIndex);
            });
        };

        const setCurrentIndex = (index) => {
            currentIndex = index;
            updateSlider();
        };

        const handleNext = () => {
            currentIndex = (currentIndex + 1) % heroImages.length;
            updateSlider();
        };

        const handlePrev = () => {
            currentIndex = (currentIndex - 1 + heroImages.length) % heroImages.length;
            updateSlider();
        };

        // Tombol navigasi slider
        prevButton.addEventListener('click', handlePrev);
        nextButton.addEventListener('click', handleNext);

        // Auto-slide dengan interval cepat (setiap 2 detik)
        setInterval(handleNext, 2000); // 2 detik

        // Inisialisasi slider
        updateSlider();
    });
</script>


@endsection