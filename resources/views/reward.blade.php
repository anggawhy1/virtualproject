@extends('layouts.app')

@section('content') 

    <main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">
        @include('partials.sidebar') 

        <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
            <h1 class="text-3xl font-bold text-blue-600 mb-4">Tukar Hadiah</h1>
            <p class="text-gray-700 mb-2">Kumpulkan point dan tukarkan hadiahnya</p>
           <p class="text-gray-700 mb-8">
    @if(Auth::check())
        Point kamu sekarang adalah: <span class="font-bold text-blue-600">{{ Auth::user()->points }}</span>
    @else
        Anda belum login. Silakan login untuk melihat poin Anda.
    @endif
</p>


            <h2 class="text-lg font-semibold mb-4">Hadiah yang bisa ditukarkan.
            <a href="/hadiah-kamu" class="text-blue-600 no-underline hover:underline text-sm font-normal" style="font-weight: 400;">Lihat Hadiah Saya</a>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($rewards as $reward)
                    <div
                        data-id="{{ $reward->id }}"
                        class="p-4 border border-gray-300 rounded-lg cursor-pointer hover:shadow-lg transition duration-300 flex items-center justify-between reward-item"
                    >
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('images/' . $reward->icon) }}" alt="{{ $reward->slug }}" class="w-8 h-8" />
                            <div>
                                <h3 class="text-lg font-semibold">{{ $reward->slug }}</h3>
                                <p class="text-sm text-gray-600">Tukar Point {{ $reward->points }}</p>
                            </div>
                        </div>
                        <span class="text-gray-500">&gt;</span>
                    </div>
                @endforeach
            </div>

            <p class="text-gray-500 text-sm mt-6">
                Bagaimana saya mendapatkan point? Lihat caranya 
                <a href="/info-point" class="text-blue-600 underline">disini</a>.
            </p>
        </section>
    </main>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tambahkan event listener ke setiap item hadiah
        document.querySelectorAll('.reward-item').forEach(item => {
            item.addEventListener('click', function () {
                const rewardSlug = this.getAttribute('data-id');
                if (rewardSlug) {
                    window.location.href = `/reward/${rewardSlug}`;
                }
            });
        });
    });
</script>
@endpush
