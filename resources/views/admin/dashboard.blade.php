@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">
    <div class="content-wrapper h-[calc(100vh-80px)] overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white border border-blue-600 p-4 rounded-lg flex items-center justify-between shadow-md">
                <div class="flex items-center space-x-4">

                    <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-up text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah total pengguna terdaftar</p>
                        <p id="total-pengguna" class="text-2xl font-bold text-gray-800">2,547</p>
                        <p id="penambahan-pengguna" class="text-green-600 text-sm">+12%</p>
                    </div>
                </div>
                <div class="text-blue-600 flex items-center space-x-2">
                    <i class="fas fa-users text-2xl"></i>
                    <span class="text-sm">Total Pengguna</span>
                </div>
            </div>

            <div class="bg-white border border-blue-600 p-4 rounded-lg flex items-center justify-between shadow-md">
                <div class="flex items-center space-x-4">
                    <!-- Ikon -->
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-arrow-down text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Laporan yang diterima bulan ini</p>
                        <p id="laporan-terbaru" class="text-2xl font-bold text-gray-800">200</p>
                        <p id="pengurangan-laporan" class="text-red-500 text-sm">-5%</p>
                    </div>
                </div>
                <div class="text-blue-600 flex items-center space-x-2">
                    <i class="fas fa-chart-bar text-2xl"></i>
                    <span class="text-sm">Laporan</span>
                </div>
            </div>

            <div class="bg-white border border-blue-600 p-4 rounded-lg flex items-center justify-between shadow-md">
                <div class="flex items-center space-x-4">

                    <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tingkat penyelesaian pemrosesan</p>
                        <p id="penyelesaian" class="text-2xl font-bold text-gray-800">90%</p>
                        <p id="penambahan-penyelesaian" class="text-green-600 text-sm">+10%</p>
                    </div>
                </div>
                <div class="text-blue-600 flex items-center space-x-2">
                    <i class="fas fa-clipboard-check text-2xl"></i>
                    <span class="text-sm">Penyelesaian</span>
                </div>
            </div>

            <div class="bg-white border border-blue-600 rounded-lg p-6 shadow-md">
                <h2 class="font-bold text-lg mb-6">Kategori Laporan Terpopuler</h2>
                <div class="space-y-4">
                    @php
                    $categories = [
                    ['name' => 'Kebersihan', 'value' => 45],
                    ['name' => 'Keamanan', 'value' => 32],
                    ['name' => 'Fasilitas Umum', 'value' => 28],
                    ['name' => 'Lain-Lain', 'value' => 51],
                    ];
                    @endphp

                    @foreach ($categories as $category)
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span>{{ $category['name'] }}</span>
                            <span class="font-bold text-sm">{{ $category['value'] }}%</span>
                        </div>

                        <div class="bg-blue-100 rounded-full h-3 relative">
                            <div
                                class="bg-blue-600 h-3 rounded-full absolute top-0 left-0 progress-bar"
                                data-value="{{ $category['value'] }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-yellow-100 border border-blue-600 p-4 rounded-lg flex items-center space-x-4 shadow-md">

                <i class="fas fa-bell text-lg text-blue-600"></i>
                <div>
                    <h3 class="text-lg font-bold text-blue-600">Laporan Baru</h3>
                    <p class="text-sm text-gray-700">
                        Anda memiliki laporan baru yang perlu diverifikasi. Segera tinjau dan ambil tindakan yang diperlukan.
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.reports') }}">
                <div class="bg-blue-600 text-white border border-blue-600 p-4 rounded-lg flex items-center justify-center shadow-md cursor-pointer hover:bg-blue-700 transition">
                    <p class="text-lg font-bold text-center">Mulai Manajemen Laporan</p>
                </div>
            </a>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const progressBars = document.querySelectorAll('.progress-bar');

        progressBars.forEach(bar => {
            const value = parseInt(bar.getAttribute('data-value')); 
            bar.style.width = value + '%'; 
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const data = {
            totalPengguna: {
                jumlah: 2547,
                persen: 12
            },
            laporanTerbaru: {
                jumlah: 200,
                persen: -5
            },
            penyelesaian: {
                persen: 90,
                persenPenyelesaian: 10
            }
        };

        const totalPengguna = document.getElementById('total-pengguna');
        const penambahanPengguna = document.getElementById('penambahan-pengguna');
        totalPengguna.textContent = data.totalPengguna.jumlah;
        penambahanPengguna.textContent = `+${data.totalPengguna.persen}%`;

        const laporanTerbaru = document.getElementById('laporan-terbaru');
        const penguranganLaporan = document.getElementById('pengurangan-laporan');
        laporanTerbaru.textContent = data.laporanTerbaru.jumlah;
        penguranganLaporan.textContent = `${data.laporanTerbaru.persen}%`;

        const penyelesaian = document.getElementById('penyelesaian');
        const penambahanPenyelesaian = document.getElementById('penambahan-penyelesaian');
        penyelesaian.textContent = `${data.penyelesaian.persen}%`;
        penambahanPenyelesaian.textContent = `+${data.penyelesaian.persenPenyelesaian}%`;
    });
</script>
@endsection