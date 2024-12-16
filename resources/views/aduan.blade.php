@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">

<div class="mb-6 flex items-center space-x-4">
    <span class="border border-blue-600 text-blue-600 px-4 py-2 rounded-full font-semibold text-lg">Status:
        <span class="text-blue-600">{{ $laporan->status }}</span> <!-- Ambil status dari database -->
    </span>
    <span class="border border-blue-600 text-blue-600 px-4 py-2 rounded-full font-semibold text-lg">ID Aduan:
        <span class="text-blue-600">{{ $laporan->id }}</span> <!-- Ambil ID dari database -->
    </span>
</div>


<div class="mb-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-4">Foto Aduan</h2>
    <div class="grid grid-cols-2 gap-4">
        <!-- Menampilkan gambar-gambar dalam dua kolom -->
        @foreach(json_decode($laporan->files) as $index => $file)
            <img
                src="{{ asset('storage/' . str_replace('\/', '/', $file)) }}"
                alt="Foto Aduan {{ $index + 1 }}"
                class="w-full h-64 object-cover rounded-lg shadow-md cursor-pointer transition-opacity duration-500"
                onclick="openModal('{{ asset('storage/' . str_replace('\/', '/', $file)) }}')" />
        @endforeach
    </div>
</div>

<!-- Modal untuk menampilkan gambar full -->
<div id="imageModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-75 z-50">
    <!-- Gambar yang ditampilkan di modal -->
    <img id="modalImage" class="max-w-full max-h-full rounded-lg" src="" alt="Full Image" />
    
    <!-- Tombol Close -->
    <button 
        onclick="closeModal()" 
        class="absolute top-4 right-4 text-white bg-gray-800 rounded-full p-2 hover:bg-gray-700 transition">
        &times; <!-- Icon X -->
    </button>
</div>

<!-- Script untuk Modal -->
<script>
    // Fungsi untuk membuka modal dan menampilkan gambar
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>


    <p class="text-gray-700 mb-6">{{ $laporan->deskripsi }}</p> <!-- Deskripsi laporan -->

  <div class="mb-8">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Proses Aduan</h2>
    <ul class="space-y-2 text-gray-700">
        <!-- Diajukan -->
        @if($laporan->status === 'Diajukan' || $laporan->status === 'Diproses' || $laporan->status === 'Disetujui')
            <li><strong>Diajukan:</strong> {{ $laporan->created_at->format('d F Y') }}</li>
        @endif

        <!-- Diproses -->
        @if($laporan->status === 'Diproses' || $laporan->status === 'Disetujui')
            <li><strong>Diproses:</strong> {{ $laporan->updated_at->format('d F Y') }}</li>
        @endif

            <!-- Disetujui -->
            @if($laporan->status === 'Disetujui')
                <li>
                    <strong>Disetujui:</strong> {{ $laporan->approved_at->format('d F Y') }}
                    @if($laporan->is_claimed == 0)
                        <form id="claimForm" action="{{ route('laporan.approve-claim', $laporan->id) }}" method="POST" class="inline">
                            @csrf
                            <button
                                type="button"
                                id="claimButton"
                                class="ml-4 px-2 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm hover:bg-blue-200">
                                Claim Point
                            </button>
                        </form>        
                    @endif
                </li>
            @endif
        </ul>
    </div>

<!-- Hasil Aduan hanya muncul jika laporan sudah disetujui -->
@if($laporan->status === 'Disetujui')
    <div class="mb-8">
        <h2 class="text-xl font-bold text-blue-600 mb-4">Hasil Aduan</h2>
        <a href="/hasiladuan/{{ $laporan->id }}" class="text-blue-600 hover:underline">Cek disini</a>
        <p class="text-gray-500 text-sm">{{ $laporan->updated_at->format('d F Y') }}</p>
    </div>
@endif

    <!-- Popup Claim Point -->
    <div id="claimPopup" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full text-center">
            <h3 class="text-xl font-bold text-blue-600 mb-4">Claim Point</h3>
            <p class="text-gray-700 mb-4">Laporan mu telah disetujui. Selamat anda telah mengumpulkan 1 point.</p>
            <div class="flex justify-center space-x-4">
                <button
                    onclick="closePopup()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Oke
                </button>
                <a href="/rewards" class="text-blue-600 hover:underline">Cek Reward</a>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-75 z-50">
        <img id="modalImage" class="max-w-full max-h-full rounded-lg" src="" alt="Full View" />
        <button onclick="closeModal()" class="absolute top-4 right-4 bg-gray-800 text-white rounded-full p-2 hover:bg-gray-700">×</button>
    </div>

</main>

@endsection

@push('scripts')
<script>
    const images = [
        @foreach(json_decode($laporan->files) as $file)
            "{{ asset('storage/' . str_replace('\/', '/', $file)) }}",
        @endforeach
    ];
    let currentImageIndex = 0;

    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        document.getElementById('modalImage').src = imageSrc;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const claimButton = document.getElementById('claimButton');
        
        if (claimButton) {
            claimButton.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the form from being submitted normally

                showClaimPopup();

                var form = document.getElementById('claimForm');
                var formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Poin berhasil diklaim!');
                    } else {
                        alert('Gagal mengklaim poin.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
            });
        }
    });

    function showClaimPopup() {
        const popup = document.getElementById('claimPopup');
        if (popup) {
            popup.classList.remove('hidden');
            popup.classList.add('flex');
        }
    }

    function closePopup() {
        const popup = document.getElementById('claimPopup');
        if (popup) {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
        }
        refreshPage();
    }

    function refreshPage() {
        window.location.reload();  // Refresh the page
    }

    document.getElementById('claimPopup').addEventListener('click', function(event) {
        if (event.target === this) { 
            closePopup();
        }
    });
</script>
@endpush
