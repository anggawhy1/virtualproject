@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">

    <div class="mb-6 flex items-center space-x-4">
        <span class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full font-semibold text-lg shadow-md">Status:
            <span class="text-blue-600">{{ $laporan->status }}</span> <!-- Ambil status dari database -->
        </span>
        <span class="bg-gray-200 text-gray-800 px-4 py-2 rounded-full font-semibold text-lg shadow-md">ID Aduan:
            <span class="text-blue-600">{{ $laporan->id }}</span> <!-- Ambil ID dari database -->
        </span>
    </div>

    <div class="mb-8">
        <div class="relative overflow-hidden rounded-lg shadow-lg">
        
            <img
            id="currentImage"
            src="{{ asset('storage/' . str_replace('\/', '/', json_decode($laporan->files)[0])) }}"
            alt="Foto Aduan"
            class="w-full h-64 object-cover transition-opacity duration-500 cursor-pointer"
            onclick="openModal('{{ asset('storage/' . str_replace('\/', '/', json_decode($laporan->files)[0])) }}')" />
        
        <div id="imageIndicators" class="flex justify-center mt-4 space-x-2">
            <!-- Misalnya, kamu punya lebih dari satu gambar -->
            {{-- @foreach($laporan->images as $index => $image) --}}
                <button onclick="changeImage({{ $laporan->images }})" class="h-3 w-3 rounded-full {{ $laporan->images == 0 ? 'bg-blue-600' : 'bg-gray-300' }}"></button>
            {{-- @endforeach --}}
        </div>
    </div>

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
                <a href="/reward" class="text-blue-600 hover:underline">Cek Reward</a>
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
        "{{ asset('storage/' . $laporan->image) }}", // Ambil gambar utama
        // Bisa tambahkan lebih banyak gambar dari array jika ada
    ];
    let currentImageIndex = 0;

    function changeImage(action) {
        if (action === 'prev') {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        } else if (action === 'next') {
            currentImageIndex = (currentImageIndex + 1) % images.length;
        } else if (typeof action === 'number') {
            currentImageIndex = action;
        }
        document.getElementById('currentImage').src = images[currentImageIndex];
        updateImageIndicators(currentImageIndex);
    }

    function updateImageIndicators(index) {
        const buttons = document.querySelectorAll('#imageIndicators button');
        buttons.forEach((button, idx) => {
            button.classList.remove('bg-blue-600', 'bg-gray-300');
            button.classList.add(idx === index ? 'bg-blue-600' : 'bg-gray-300');
        });
    }

   document.addEventListener('DOMContentLoaded', function() {
    // Check if the claimButton exists before adding the event listener
    const claimButton = document.getElementById('claimButton');
    
    if (claimButton) {
        claimButton.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the form from being submitted normally

            // Show the popup before submitting the form
            showClaimPopup();

            // Submit the form via AJAX
            var form = document.getElementById('claimForm');
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // Ensure CSRF token is sent
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
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

// Add an event listener to close the popup when clicking outside of it
document.getElementById('claimPopup').addEventListener('click', function(event) {
    if (event.target === this) { // If the click is outside the popup
        closePopup(); // Close the popup and refresh the page
    }
});


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
</script>
@endpush
