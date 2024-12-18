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

        <button 
            type="button" 
            onclick="showConfirmPopup()" 
            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
            Tukarkan Sekarang →
        </button>

        <p class="text-gray-500 text-sm mt-10">
            Bagaimana saya mendapatkan point? Lihat caranya 
            <a href="/info-point" class="text-blue-600 underline">disini</a>.
        </p>
    </section>
</main>

<div id="confirmPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-md w-full text-center">
        <h2 class="text-2xl font-bold text-blue-600 mb-4">Anda Yakin Ingin Menukarkan?</h2>
        <p class="text-gray-700 mb-6">
            Hadiah ini akan menggunakan sejumlah <strong class="text-blue-600">{{ $reward->points }}</strong> poin kamu untuk mendapatkan <strong class="text-blue-600">{{ $reward->name }}</strong>.
        </p>
        <div class="flex justify-center space-x-4">
            <button
                onclick="hideConfirmPopup()"
                class="px-6 py-3 border border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-100 transition">
                Tidak
            </button>
            <button
                onclick="submitRedeemForm()"
                class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Ya
            </button>
        </div>
    </div>
</div>

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
    function showConfirmPopup() {
        document.getElementById('confirmPopup').classList.remove('hidden');
    }

    function hideConfirmPopup() {
        document.getElementById('confirmPopup').classList.add('hidden');
    }

    function hideRewardPopup() {
        document.getElementById('rewardPopup').classList.add('hidden');
    }
    function hideErrorPopup() {
        document.getElementById('errorPopup').classList.add('hidden');
    }

    function submitRedeemForm() {
        hideConfirmPopup();

        fetch("{{ route('reward.redeem', $reward->id) }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('rewardPopup').classList.remove('hidden');
            } else {
                document.getElementById('errorMessage').innerText = data.error || "Poin tidak mencukupi.";
                document.getElementById('errorPopup').classList.remove('hidden');
            }
        })
        .catch(() => {
            document.getElementById('errorMessage').innerText = "Terjadi kesalahan saat menukarkan hadiah.";
            document.getElementById('errorPopup').classList.remove('hidden');
        });
    }
</script>
@endpush

@endsection
