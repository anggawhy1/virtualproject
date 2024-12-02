@extends('layouts.app')

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">
    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-6">Hasil Aduan</h1>
    <p class="mb-4 text-gray-800">
        Hasil dari aduan kamu dengan nomor aduan: <strong>L000032</strong>, dengan detail laporan:
    </p>
    <p class="mb-8 text-gray-700">
        Saya ingin melaporkan kondisi jalan yang rusak di Jl. Merdeka RT 04 RW 03, Kelurahan X, Kecamatan Y. Jalan ini sudah cukup lama mengalami kerusakan yang serius. Terdapat beberapa lubang besar dan aspal yang mengelupas, sehingga sangat membahayakan pengendara, terutama pengguna motor.
    </p>

    <h2 class="text-2xl font-bold text-blue-600 mb-4">Sebelum Aduan</h2>
    <div class="mb-8">
        <img src="{{ asset('images/jalan.png') }}" alt="Sebelum Aduan" class="w-full h-64 object-cover rounded-lg shadow-md cursor-pointer" id="beforeImage" onclick="openModal(beforeImages[0])" />
        <div class="flex justify-center mt-4 space-x-2">
            <button onclick="changeBeforeImage(0)" class="h-3 w-3 rounded-full bg-blue-600"></button>
            <button onclick="changeBeforeImage(1)" class="h-3 w-3 rounded-full bg-gray-300"></button>
            <button onclick="changeBeforeImage(2)" class="h-3 w-3 rounded-full bg-gray-300"></button>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-blue-600 mb-4">Sesudah Aduan</h2>
    <div class="mb-8">
        <img src="{{ asset('images/jalan3.png') }}" alt="Sesudah Aduan" class="w-full h-64 object-cover rounded-lg shadow-md cursor-pointer" id="afterImage" onclick="openModal(afterImages[0])" />
        <div class="flex justify-center mt-4 space-x-2">
            <button onclick="changeAfterImage(0)" class="h-3 w-3 rounded-full bg-blue-600"></button>
            <button onclick="changeAfterImage(1)" class="h-3 w-3 rounded-full bg-gray-300"></button>
        </div>
    </div>

    <p class="text-gray-800 text-center">
        Terima kasih telah melaporkan, semoga hasil dari aduan kamu dapat bermanfaat bagi lingkungan sekitar anda.
    </p>
</main>

<div id="imageModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-75 z-50">
    <img id="modalImage" class="max-w-full max-h-full rounded-lg" src="" alt="Full View" />
    <button onclick="closeModal()" class="absolute top-4 right-4 bg-gray-800 text-white rounded-full p-2 hover:bg-gray-700">×</button>
</div>


@endsection

@push('scripts')
<script>
    const beforeImages = [
        "{{ asset('images/jalan.png') }}",
        "{{ asset('images/before2.jpg') }}",
        "{{ asset('images/before3.jpg') }}"
    ];
    const afterImages = [
        "{{ asset('images/jalan3.png') }}",
        "{{ asset('images/after2.jpg') }}"
    ];

    let currentBeforeImageIndex = 0;
    let currentAfterImageIndex = 0;

    function changeBeforeImage(index) {
        currentBeforeImageIndex = index;
        document.getElementById('beforeImage').src = beforeImages[index];
        updateBeforeImageIndicators(index);
    }

    function updateBeforeImageIndicators(index) {
        const buttons = document.querySelectorAll('#beforeImage + .flex button');
        buttons.forEach((button, idx) => {
            button.classList.remove('bg-blue-600', 'bg-gray-300');
            button.classList.add(idx === index ? 'bg-blue-600' : 'bg-gray-300');
        });
    }

    function changeAfterImage(index) {
        currentAfterImageIndex = index;
        document.getElementById('afterImage').src = afterImages[index];
        updateAfterImageIndicators(index);
    }

    function updateAfterImageIndicators(index) {
        const buttons = document.querySelectorAll('#afterImage + .flex button');
        buttons.forEach((button, idx) => {
            button.classList.remove('bg-blue-600', 'bg-gray-300');
            button.classList.add(idx === index ? 'bg-blue-600' : 'bg-gray-300');
        });
    }

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