@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Manajemen Reward</h1>
    <div class="text-sm text-blue-600 mb-6">
        <a href="{{ route('admin.rewards') }}" class="hover:underline">Manajemen Reward</a> &gt; Aksi
    </div>

    <div class="border border-blue-600 rounded-lg p-4 mb-6 relative">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-blue-600">Pengguna</h2>
            <a href="{{ route('admin.rewards', $reward['id']) }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-edit text-lg"></i> Edit
            </a>
        </div>
        <div class="flex items-center">
            <img src="{{ asset($reward['profile']) }}" alt="{{ $reward['name'] }}" class="w-16 h-16 rounded-full mr-4">
            <div>
                <p class="font-bold text-lg">{{ $reward['name'] }}</p>
                <p>Email: {{ strtolower($reward['name']) }}5688@gmail.com</p>
                <p>Nomor Hp: 081280345688</p>
                <p>Jumlah Point: <span class="font-bold text-blue-600">{{ str_pad($reward['points'], 2, '0', STR_PAD_LEFT) }}</span></p>
            </div>
        </div>
    </div>

<div class="border border-blue-600 rounded-lg p-4 mb-6">
    <div class="flex justify-between items-center mb-2"> <!-- Mengurangi margin-bottom -->
        <h2 class="text-lg font-bold text-blue-600">Status</h2>
        @if($reward['status'] === 'Permintaan Penukaran Hadiah')
        <div class="flex space-x-4">
            <button class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100">Tolak</button>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Konfirmasi</button>
        </div>
        @endif
    </div>
    @if($reward['status'] === 'Permintaan Penukaran Hadiah')
    <div class="flex items-center">
        <img src="{{ asset('images/tiket.png') }}" alt="Tiket Liburan" class="w-12 h-12 mr-4">
        <div>
            <p class="mb-2">Permintaan Penukaran Hadiah:</p>
            <p class="font-semibold">Tiket Liburan</p>
        </div>
    </div>
    @else
    <p class="font-semibold text-gray-600">Belum ada permintaan penukaran hadiah.</p>
    @endif
</div>

    <div class="border border-blue-600 rounded-lg p-4">
        <h2 class="text-lg font-bold text-blue-600 mb-2">Riwayat Hadiah Pengguna</h2>
        <ul class="list-disc list-inside">
            <li>17 November 2024 - Menukarkan Hadiah Voucher Belanja.</li>
            <li>18 November 2024 - Menukarkan Hadiah Merchandise Belanja.</li>
        </ul>
    </div>
</div>
@endsection