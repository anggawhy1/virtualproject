@extends('layouts.app')

@section('content')
<main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">
    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-6">Hasil Aduan</h1>

    <!-- Deskripsi Aduan -->
    <p class="mb-4 text-gray-800">
        Hasil dari aduan kamu dengan nomor aduan: <strong>{{ $laporan->id }}</strong>, dengan detail laporan:
    </p>
    <p class="mb-8 text-gray-700">
        {{ $laporan->deskripsi }}
    </p>

    <!-- Lokasi Aduan -->
    @if($laporan->lokasi)
    <p class="mb-4 text-gray-700">Lokasi: <strong>{{ $laporan->lokasi }}</strong></p>
    @endif

    <!-- Sebelum Aduan (Before Image) -->
    <h2 class="text-2xl font-bold text-blue-600 mb-4">Sebelum Aduan</h2>
    @if($laporan->files && count(json_decode($laporan->files)) > 0)
    <div class="mb-8 grid grid-cols-2 gap-4">
        <!-- Menampilkan semua gambar sebelum aduan -->
        @foreach(json_decode($laporan->files) as $file)
        <img
            src="{{ asset('storage/' . str_replace('\/', '/', $file)) }}"
            alt="Sebelum Aduan"
            class="w-full h-64 object-cover rounded-lg shadow-md cursor-pointer"
            onclick="openModal('{{ asset('storage/' . str_replace('\/', '/', $file)) }}')" />
        @endforeach
    </div>
    @endif

    <h2 class="text-2xl font-bold text-blue-600 mb-4">Sesudah Aduan</h2>

    @if($laporan->status === 'Selesai')
    @if($laporan->files && isset(json_decode($laporan->files)[1]))
    <div class="mb-8">
        <img src="{{ asset('storage/' . json_decode($laporan->files)[1]) }}" alt="Sesudah Aduan" class="w-full h-64 object-cover rounded-lg shadow-md cursor-pointer" id="afterImage" />
    </div>
    @else
    <p class="text-gray-600 italic mb-4">Gambar belum diunggah oleh admin.</p>
    @endif
    @else
    <p class="text-gray-600 italic mb-4">Status laporan belum selesai. Gambar hanya akan muncul setelah status selesai.</p>
    @endif

    <p class="text-gray-800 text-center">
        Terima kasih telah melaporkan, semoga hasil dari aduan kamu dapat bermanfaat bagi lingkungan sekitar anda.
    </p>


    <div id="imageModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-75 z-50">
        <img id="modalImage" class="max-w-full max-h-full rounded-lg" src="" alt="Full View" />
        <button onclick="closeModal()" class="absolute top-4 right-4 bg-gray-800 text-white rounded-full p-2 hover:bg-gray-700">×</button>
    </div>

    @endsection

    @push('scripts')
    <script>
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
    @endpush