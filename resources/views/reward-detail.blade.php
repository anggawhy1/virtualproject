@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">
    @include('partials.sidebar')

    <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
        <h1 class="text-3xl font-bold text-blue-600 mb-6 flex items-center">
            {{ $reward->name }}
            <img src="{{ asset('images/' . $reward->icon) }}" alt="{{ $reward->name }}" class="w-8 h-8 ml-2">
        </h1>

        <p class="text-gray-700 leading-relaxed mb-4">
            {{ $reward->description }}
        </p>

        <p class="text-gray-700 font-semibold mb-6">
            <strong>Point yang Dibutuhkan:</strong> {{ $reward->points }}
        </p>

        <!-- Form untuk redeem hadiah -->
        <form id="redeemForm" action="{{ route('reward.redeem', $reward->id) }}" method="POST">
            @csrf
            <button 
                type="submit"
                class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                Tukarkan Sekarang → 
            </button>
        </form>

        <p class="text-gray-500 text-sm mt-10">
            Bagaimana saya mendapatkan point? Lihat caranya 
            <a href="/info-point" class="text-blue-600 underline">disini</a>.
        </p>
    </section>
    </main>
    <!-- Popup Section -->
    <div id="rewardPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-lg w-full text-center">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Hadiah Telah Ditukarkan!</h2>
            <p class="text-gray-700 mb-6">
                Hadiah anda telah ditukarkan, kami akan mengabarkan anda untuk proses selanjutnya!
            </p>
            <div class="flex justify-center space-x-4">
                <button
                    onclick="hideRewardPopup()"
                    class="px-6 py-3 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-100 transition">
                    Oke
                </button>
                <a 
                    href="/hadiah-kamu" 
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Lihat Hadiah Kamu
                </a>
            </div>
        </div>
    </div>

    <!-- Error message section -->
    <div id="errorPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full text-center">
            <h3 class="text-xl font-bold text-red-600 mb-4">Terjadi Kesalahan!</h3>
            <p class="text-gray-700 mb-4" id="errorMessage"></p>
            <div class="flex justify-center space-x-4">
                <button
                    onclick="hideErrorPopup()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Oke
                </button>
            </div>
        </div>
    </div>




@push('scripts')
<script>
    // Menunggu hingga DOM sepenuhnya dimuat sebelum menjalankan JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const redeemForm = document.getElementById('redeemForm');
        
        if (redeemForm) {
            redeemForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman formulir default

                const formData = new FormData(this); // Ambil data dari formulir

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Menandakan bahwa ini adalah permintaan AJAX
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log respons untuk debugging
                    if (data.success) {
                        // Jika sukses, tampilkan popup
                        showRewardPopup();
                    } else {
                        // Jika ada error, tampilkan pesan error
                        showErrorPopup(data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }
    });

    // Menampilkan popup setelah redeem berhasil
    function showRewardPopup() {
        const popup = document.getElementById('rewardPopup');
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        document.body.style.overflow = 'hidden'; // Mencegah scroll di belakang popup
    }

    // Menampilkan popup error jika terjadi kesalahan
    function showErrorPopup(message) {
        const popup = document.getElementById('errorPopup');
        const messageElement = document.getElementById('errorMessage');
        messageElement.innerText = message; // Set error message
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        document.body.style.overflow = 'hidden'; // Mencegah scroll di belakang popup
    }

    // Menyembunyikan popup
    function hideRewardPopup() {
        const popup = document.getElementById('rewardPopup');
        popup.classList.add('hidden');
        popup.classList.remove('flex');
        document.body.style.overflow = 'auto'; // Mengizinkan scroll kembali
    }

    // Menyembunyikan popup error
    function hideErrorPopup() {
        const popup = document.getElementById('errorPopup');
        popup.classList.add('hidden');
        popup.classList.remove('flex');
        document.body.style.overflow = 'auto'; // Mengizinkan scroll kembali
    }
</script>
@endpush

@endsection
