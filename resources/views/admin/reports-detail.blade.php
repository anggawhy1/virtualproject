@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-3xl font-bold text-gray-900 mb-4">Kelola Laporan</h1>

    <div class="mb-6 text-sm text-blue-600 flex items-center space-x-1">
        <a href="{{ route('admin.reports') }}" class="hover:underline text-blue-600">Kelola Laporan</a>
        <span class="text-gray-400"> > </span>
        <span class="text-blue-600"> Detail Laporan</span>
    </div>

<div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Informasi Pelapor</h2>
    
   @if(isset($laporan->user))
    <p><strong>Nama Pelapor:</strong> {{ isset($laporan->user->nama_lengkap) ? $laporan->user->nama_lengkap : 'Tidak diketahui' }}</p>
    <p><strong>Email:</strong> {{ isset($laporan->user->email) ? $laporan->user->email : 'Tidak tersedia' }}</p>
    <p><strong>Nomor HP:</strong> {{ isset($laporan->user->phone) ? $laporan->user->phone : 'Tidak tersedia' }}</p>
@else
    <p><strong>Pelapor:</strong> Anonim</p>
@endif

</div>


    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Detail Laporan</h2>
    <p><strong>ID Laporan:</strong> {{ $laporan->id ?? 'Tidak tersedia' }}</p>
    <p><strong>Tanggal Laporan:</strong> {{ $laporan->created_at ?? 'Tidak tersedia' }}</p>
    <p><strong>Deskripsi Laporan:</strong></p>
    <p class="whitespace-nowrap break-words">
        {{ $laporan->deskripsi ?? 'Deskripsi tidak tersedia' }}
    </p>


    </div>

    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">Kategori Laporan</h2>
        <p class="text-gray-700">{{$laporan->kategori ?? 'Kategori tidak tersedia'}}</p>
    </div>

    <div class="relative bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Lokasi Kejadian</h2>
    <p><strong>Alamat:</strong> {{$laporan->lokasi ?? 'Lokasi tidak tersedia'}}</p>

    @if ($laporan->latitude && $laporan->longitude)
        <a href="https://www.google.com/maps/search/?api=1&query={{$laporan->latitude}},{{$laporan->longitude}}"
            target="_blank"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 text-blue-600">
            <i class="fas fa-map-marker-alt text-xl"></i>
        </a>
    @else
        <p>Lokasi tidak tersedia.</p>
    @endif
</div>


  <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">File Pendukung</h2>
    <div class="grid grid-cols-2 gap-4">
        @php
            $files = json_decode($laporan->files);
            $imageFiles = array_filter($files, function ($file) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                return in_array(strtolower($extension), ['jpeg', 'png', 'jpg']);
            });
            $imageFiles = array_slice($imageFiles, 0, 2); // Limit to 2 files
        @endphp

        @if(count($files) > 0)
            @if(count($imageFiles) > 0)
                @foreach($imageFiles as $file)
                    <img src="{{ asset('storage/' . $file) }}" alt="Bukti" class="w-full rounded-lg shadow-md border">
                @endforeach
            @else
                <p class="text-gray-600">Tidak ada file gambar yang tersedia.</p>
            @endif
        @else
            <p class="text-gray-600">Tidak ada file pendukung yang tersedia.</p>
        @endif
    </div>
</div>

<div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Status Laporan</h2>
    
    <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT"> <!-- Meniru metode PUT -->
        
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="px-4 py-2 inline-block bg-green-100 text-green-800 text-sm font-medium rounded-lg">
                    {{$laporan->status ?? 'Status tidak tersedia'}}
                </span>

                <select name="status" class="bg-white border border-blue-600 text-gray-800 rounded-lg p-2">
                    <option value="Diajukan" {{ $laporan->status === 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="Diproses" {{ $laporan->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Disetujui" {{ $laporan->status === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                </select>
            </div>

            <div class="flex items-center space-x-4">
                <label for="image-upload" class="bg-blue-600 text-white py-2 px-4 rounded-lg cursor-pointer shadow-md hover:bg-blue-700">
                    Unggah Gambar
                </label>
                <input type="file" id="image-upload" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
            </div>
        </div>

        <!-- Preview Gambar -->
        <div id="image-preview" class="mt-4">
            <img id="preview" src="" alt="Preview Gambar" class="hidden max-w-full h-auto rounded-lg shadow-md">
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4">
            Konfirmasi
        </button>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
                preview.classList.remove('hidden'); // Menampilkan gambar preview
                previewContainer.classList.remove('hidden'); // Menampilkan kontainer preview
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.classList.add('hidden'); // Menyembunyikan preview jika tidak ada gambar
            previewContainer.classList.add('hidden'); // Menyembunyikan kontainer preview
        }
    }
</script>


    

<div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Riwayat Status Laporan</h2>
    <ul class="list-disc pl-6 space-y-2 text-gray-700" style="list-style-position: inside;">
        <li>{{ $laporan->created_at }} - Laporan diterima dengan status "Diajukan".</li>
        
        @if($laporan->status !== 'Diajukan' && $laporan->updated_at)
            <li>{{ $laporan->updated_at }} - Laporan berubah menjadi status "Diproses".</li>
        @endif

        @if($laporan->status !== 'Diproses' && $laporan->approved_at)
            <li>{{ $laporan->approved_at }} - Laporan berubah menjadi status "Disetujui".</li>
        @endif
    </ul>
</div>


</div>
@endsection