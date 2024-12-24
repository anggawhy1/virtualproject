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
    // Decode the JSON field into an array, with empty array as fallback if decoding fails
    $files = json_decode($laporan->files, true) ?? [];

    // Filter image files from the decoded array
    $imageFiles = array_filter($files, function ($file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), ['jpeg', 'png', 'jpg']);
    });
    $imageFiles = array_slice($imageFiles, 0, 2); // Limit to 2 files
@endphp

@if(count($imageFiles) > 0)
    @foreach($imageFiles as $file)
        <img src="{{ asset('storage/' . $file) }}" alt="Bukti" class="w-full rounded-lg shadow-md border">
    @endforeach
@else
    <p class="text-gray-600">Tidak ada file gambar yang tersedia.</p>
@endif

    </div>
</div>

<div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Status Laporan</h2>

    <form action="{{ route('laporan.updateStatus', $laporan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="px-4 py-2 inline-block bg-green-100 text-green-800 text-sm font-medium rounded-lg">
                    {{$laporan->status ?? 'Status tidak tersedia'}}
                </span>

                <select name="status" id="status" class="bg-white border border-blue-600 text-gray-800 rounded-lg p-2">
                    <option value="Diajukan" {{ $laporan->status === 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="Diproses" {{ $laporan->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Disetujui" {{ $laporan->status === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Selesai" {{ $laporan->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        </div>

        <!-- Input file untuk hasil -->
        <div id="hasil-input" class="mt-4 hidden">
            <label for="hasil" class="block text-gray-700">Unggah File Hasil (Opsional)</label>
            <input type="file" id="hasil" name="hasil[]" class="block w-full mt-2 border border-gray-300 rounded-lg p-2" accept=".jpeg,.png,.jpg,.pdf,.doc,.docx" multiple>
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4">
            Konfirmasi
        </button>
    </form>
</div>

<div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
    <h2 class="text-lg font-semibold text-blue-600 mb-4">File Hasil</h2>
    <div class="grid grid-cols-2 gap-4">
        @php
    // Decode the JSON field into an array, with empty array as fallback if decoding fails
    $hasil = json_decode($laporan->hasil, true) ?? [];

    // Filter image files from the decoded array
    $imagehasil = array_filter($hasil, function ($file) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), ['jpeg', 'png', 'jpg']);
    });

    // Limit to 2 image files
    $imagehasil = array_slice($imagehasil, 0, 2);
@endphp

@if(count($imagehasil) > 0)
    @foreach($imagehasil as $file)
        <img src="{{ asset('storage/' . $file) }}" alt="Bukti" class="w-full rounded-lg shadow-md border">
    @endforeach
@else
    <p class="text-gray-600">Tidak ada hasil gambar yang tersedia.</p>
@endif

    </div>
</div>

<script>
    // Tampilkan input hasil jika status adalah 'Selesai'
    document.getElementById('status').addEventListener('change', function() {
        const hasilInput = document.getElementById('hasil-input');
        if (this.value === 'Selesai') {
            hasilInput.classList.remove('hidden');
        } else {
            hasilInput.classList.add('hidden');
        }
    });
</script>


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
         @if($laporan->status !== 'Disetujui' && $laporan->completed_at)
            <li>{{ $laporan->completed_at }} - Laporan berubah menjadi status "Selesai".</li>
        @endif
    </ul>
</div>

<script>
    $(document).ready(function() {
    // When the form is submitted
    $('form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Collect form data

        $.ajax({
            url: $(this).attr('action'), // The action URL of the form
            method: 'POST', // The HTTP method
            data: formData, // The form data
            contentType: false, // Allow sending files
            processData: false, // Do not process the files
            success: function(response) {
                // Handle success (update UI, show message, etc.)
                alert('Status laporan berhasil diubah.');
                location.reload(); // Reload page after success
            },
            error: function(response) {
                // Handle error (show error message, etc.)
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
});

$(document).on('change', '#status', function () {
    var status = $(this).val();
    var laporanId = {{ $laporan->id }};
    var formData = new FormData();
    formData.append('status', status);

    $.ajax({
        url: '/laporan/updateStatus/' + laporanId,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle success, update UI or show success message
            alert('Status berhasil diperbarui!');
        },
        error: function(error) {
            // Handle error
            alert('Terjadi kesalahan!');
        }
    });



</script>

</div>
@endsection