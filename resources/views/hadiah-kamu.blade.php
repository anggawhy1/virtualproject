@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 flex space-x-10 bg-gray-50 text-gray-800 font-sans min-h-screen">
    @include('partials.sidebar') 

    <section class="w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
        <h1 class="text-3xl font-bold text-blue-600 mb-6">Hadiah Kamu</h1>
        <div class="space-y-6">
            @foreach ([ 
                [
                    'title' => 'Voucher Belanja',
                    'points' => 10,
                    'status' => 'Telah dikirim',
                    'icon' => 'voucher.png',
                ],
                [
                    'title' => 'Tiket Liburan',
                    'points' => 100,
                    'status' => 'Menunggu Konfirmasi',
                    'icon' => 'tiket.png',
                ],
                [
                    'title' => 'Merchandise',
                    'points' => 20,
                    'status' => 'Selesai',
                    'icon' => 'merchandise.png',
                ],
            ] as $reward)
                <div class="flex items-center p-4 border border-gray-300 rounded-lg shadow-md">

                    <div class="flex-shrink-0 w-16 h-16 flex items-center justify-center border border-gray-200 rounded-md bg-gray-50">
                        <img src="{{ asset('images/' . $reward['icon']) }}" alt="{{ $reward['title'] }}" class="w-12 h-12 object-contain">
                    </div>

                    <div class="flex-grow ml-4">
                        <h2 class="text-lg font-bold text-gray-800">{{ $reward['title'] }}</h2>
                        <p class="text-gray-600 text-sm">
                            Kamu telah menukarkan {{ $reward['title'] }} dengan total point sebanyak 
                            <span class="text-blue-600 font-bold">{{ $reward['points'] }}</span>
                        </p>
                    </div>

                    <span class="text-sm px-4 py-1 rounded-full bg-blue-100 text-blue-600">
                        {{ $reward['status'] }}
                    </span>
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
