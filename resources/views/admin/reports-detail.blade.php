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
        <p><strong>Nama Pelapor:</strong> Uji</p>
        <p><strong>Email:</strong> uji@uji.com</p>
        <p><strong>Nomor HP:</strong> 081234567890</p>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">Detail Laporan</h2>
        <p><strong>ID Laporan:</strong> LAP-2024-00123</p>
        <p><strong>Tanggal Laporan:</strong> 18 November 2024</p>
        <p><strong>Deskripsi Laporan:</strong></p>
        <p>
            Saya ingin melaporkan kondisi jalan yang rusak di Jl. Merdeka RT 04 RW 03, Kelurahan X, Kecamatan Y. Jalan ini sudah cukup lama mengalami kerusakan yang parah. Terdapat beberapa lubang besar di tengah jalan, terutama saat musim hujan, sehingga sering menyebabkan pengendara tergelincir. Jalan tersebut tergolong dalam rute vital, meningkatkan risiko kecelakaan bagi warga sekitar.
        </p>
        <p>
            Kami berharap kondisi ini dapat segera mendapatkan perhatian dan perbaikan agar jalan tersebut bisa kembali aman dan nyaman digunakan oleh masyarakat.
        </p>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">Kategori Laporan</h2>
        <p class="text-gray-700">Infrastruktur</p>
    </div>

    <div class="relative bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">Lokasi Kejadian</h2>
        <p><strong>Alamat:</strong> Jalan Melati No. 24, Kelurahan Harapan Jaya, Kecamatan Bahagia, Kota Fiktif, 12345</p>

        <a href="https://www.google.com/maps/search/?api=1&query=Jalan+Melati+No.+24,+Kelurahan+Harapan+Jaya,+Kecamatan+Bahagia,+Kota+Fiktif,+12345"
            target="_blank"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 text-blue-600">
            <i class="fas fa-map-marker-alt text-xl"></i>
        </a>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">File Pendukung</h2>
        <div class="grid grid-cols-2 gap-4">
            <img src="{{ asset('images/jalan.png') }}" alt="Bukti 1" class="w-full rounded-lg shadow-md border">
            <img src="{{ asset('images/jalan.png') }}" alt="Bukti 2" class="w-full rounded-lg shadow-md border">
        </div>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">Status Laporan</h2>
        <span class="px-4 py-2 inline-block bg-green-100 text-green-800 text-sm font-medium rounded-lg">Disetujui</span>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg p-6 mb-6 shadow-md">
        <h2 class="text-lg font-semibold text-blue-600 mb-4">Riwayat Status Laporan</h2>
        <ul class="list-disc pl-6 space-y-2 text-gray-700" style="list-style-position: inside;">
            <li>17 November 2024 - Laporan diterima dengan status "Diajukan".</li>
            <li>18 November 2024 - Laporan berubah menjadi status "Disetujui".</li>
            <li>20 November 2024 - Laporan berubah menjadi status "Diproses".</li>
        </ul>
    </div>

</div>
@endsection