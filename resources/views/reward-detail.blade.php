@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">
    @include('partials.sidebar')

    <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
        <h1 class="text-3xl font-bold text-blue-600 mb-6 flex items-center">
            {{ $reward['title'] }}
            <img src="{{ asset('images/' . $reward['icon']) }}" alt="{{ $reward['title'] }}" class="w-8 h-8 ml-2">
        </h1>

        <p class="text-gray-700 leading-relaxed mb-6">
            {{ $reward['description'] }}
        </p>

        <div class="text-left mb-8">
            <button
                onclick="showRewardPopup()"
                class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                Tukarkan Sekarang →
            </button>
        </div>

        <p class="text-gray-500 text-sm text-left mt-10">
            Bagaimana saya mendapatkan point? Lihat caranya 
            <a href="/info-point" class="text-blue-600 underline">disini</a>.
        </p>
    </section>

    <div id="rewardPopup" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
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
                    Cek Hadiah Kamu
                </a>
            </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')
<script>
    function showRewardPopup() {
        const popup = document.getElementById('rewardPopup');
        popup.classList.remove('hidden');
        popup.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function hideRewardPopup() {
        const popup = document.getElementById('rewardPopup');
        popup.classList.add('hidden');
        popup.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush
