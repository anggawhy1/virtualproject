@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Kelola Reward</h1>
    <div class="text-sm text-blue-600 mb-6">
        <a href="{{ route('rewards.index.admin') }}" class="hover:underline">Kelola Reward</a> &gt; Aksi
    </div>

    <!-- User Information -->
    <div class="border border-blue-600 rounded-lg p-4 mb-6">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-blue-600">Pengguna</h2>
        </div>
        <div class="flex items-center">
            <img src="{{ asset($userReward->user->profile ?? 'default-avatar.png') }}" 
                 alt="{{ $userReward->user->name }}" 
                 class="w-16 h-16 rounded-full mr-4">
            <div>
                <p class="font-bold text-lg">{{ $userReward->user->name ?? 'Tidak Tersedia' }}</p>
                <p>Email: {{ strtolower($userReward->user->email ?? 'Tidak Tersedia') }}</p>
                <p>Nomor Hp: {{ $userReward->user->phone ?? 'Tidak Tersedia' }}</p>
                <p>Jumlah Point: 
                    <span class="font-bold text-blue-600">
                        {{ str_pad($userReward->user->points ?? 0, 2, '0', STR_PAD_LEFT) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- <!-- Status Section -->
    <div class="border border-blue-600 rounded-lg p-4 mb-6">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-blue-600">Status</h2>
        </div>

        @if ($userReward->status === 'menunggu konfirmasi')
        <!-- Action buttons for "menunggu konfirmasi" status -->
        <div class="flex items-center mb-4">
            <img src="{{ asset('storage/icons/' . ($userReward->reward->icon ?? 'default-icon.png')) }}" 
                 alt="{{ $userReward->reward->name ?? 'Hadiah tidak ditemukan' }}" 
                 class="w-12 h-12 mr-4">
            <div>
                <p class="mb-2">Permintaan Penukaran Hadiah:</p>
                <p class="font-semibold">{{ optional($userReward->reward)->name ?? 'Hadiah tidak ditemukan' }}</p>
            </div>
        </div>

        <div class="flex justify-end space-x-4 mt-4">
            <form action="{{ route('rewards.updateStatus', $userReward->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="ditolak">
                <button type="submit" class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100">
                    Tolak
                </button>
            </form>
            <form action="{{ route('rewards.updateStatus', $userReward->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="dikonfirmasi">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Konfirmasi
                </button>
            </form>
        </div>
        @else
        <p>Status hadiah: {{ ucfirst($userReward->status) }} - 
            {{ optional($userReward->reward)->name ?? 'Hadiah tidak ditemukan' }}</p>
        @endif
    </div> --}}

    <!-- Pending Rewards Section -->
    <div class="border border-blue-600 rounded-lg p-4 mb-6">
        <h2 class="text-lg font-bold text-blue-600 mb-2">Status</h2>
        @forelse ($pendingRewards as $reward)
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                               <img src="{{ asset('images/' . $userReward->reward->icon) }}" alt="{{ $reward->reward->name ?? 'Hadiah tidak ditemukan' }}" class="w-12 h-12 mr-4">
                <div>
                    <p class="mb-2">Permintaan Penukaran Hadiah:</p>
                    <p class="font-semibold">{{ optional($reward->reward)->name ?? 'Hadiah tidak ditemukan' }}</p>
                    
                    
                </div>
            </div>


<!-- Action buttons for pending rewards -->
<div class="flex space-x-4">
    <!-- Reject (Tolak) Action -->
    <form action="{{ route('rewards.updateStatus', $reward->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="ditolak">
        <button type="submit" class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100">
            Tolak
        </button>
    </form>

    <!-- Confirm (Dikonfirmasi) Action -->
    <form action="{{ route('rewards.updateStatus', $reward->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="dikonfirmasi">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Konfirmasi
        </button>
    </form>
</div>
</div>

@empty
    <p class="text-gray-500">Tidak ada permintaan reward yang menunggu konfirmasi.</p>
@endforelse
</div>


    
   <!-- Reward History Section -->
<div class="border border-blue-600 rounded-lg p-4">
    <h2 class="text-lg font-bold text-blue-600 mb-2">Riwayat Hadiah Pengguna</h2>
    <ul class="list-disc list-inside">
        @forelse ($userReward->user->rewards->filter(function ($reward) {
            return $reward->pivot->status === 'dikonfirmasi';
        }) as $reward)
            <li>{{ $reward->pivot->created_at->format('d F Y') }} - Menukarkan Hadiah {{ $reward->name }}</li>
        @empty
            <li class="text-gray-500">Belum ada riwayat hadiah yang dikonfirmasi.</li>
        @endforelse
    </ul>
</div>


</div>
@endsection
