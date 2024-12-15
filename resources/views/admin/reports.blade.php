@extends('layouts.app-sidebar')

@section('content')
<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Kelola Laporan</h1>
    </div>

    <div class="mb-4 flex justify-between">
        <ul class="flex space-x-4 text-blue-600">
            <li><a href="#" class="font-semibold tab" id="semuaLaporanTab" onclick="filterByTab('semua')">Semua Laporan</a></li>
            <li><a href="#" class="hover:underline tab" id="diajukanTab" onclick="filterByTab('diajukan')">Diajukan</a></li>
            <li><a href="#" class="hover:underline tab" id="diprosesTab" onclick="filterByTab('diproses')">Diproses</a></li>
            <li><a href="#" class="hover:underline tab" id="disetujuiTab" onclick="filterByTab('disetujui')">Disetujui</a></li>
            <li><a href="#" class="hover:underline tab" id="selesaiTab" onclick="filterByTab('selesai')">Selesai</a></li>
        </ul>

        <div class="relative">
            <button onclick="toggleFilter()" class="flex items-center px-4 py-2 border border-blue-600 rounded-lg text-blue-600">
                <i class="fas fa-filter mr-2 text-blue-600"></i> Filter
            </button>
            <div id="filterDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                <div class="p-2">
                    <label class="block text-sm font-semibold">Filter Status:</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="Diajukan" class="filter-checkbox"> Diajukan
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="Diproses" class="filter-checkbox"> Diproses
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="Disetujui" class="filter-checkbox"> Disetujui
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="Selesai" class="filter-checkbox"> Selesai
                        </label>
                    </div>
                    <div class="mt-3 text-right">
                        <button onclick="applyFilter()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Terapkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-blue-600 rounded-lg shadow-md p-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left">
                    <th class="py-2 px-4 text-sm font-semibold">ID</th>
                    <th class="py-2 px-4 text-sm font-semibold">Nama</th>
                    <th class="py-2 px-4 text-sm font-semibold">Tanggal</th>
                    <th class="py-2 px-4 text-sm font-semibold">Status</th>
                    <th class="py-2 px-4 text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody id="laporanContent">
                @foreach ($reports as $report)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $report['id'] }}</td>
                        <td class="py-2 px-4 flex items-center space-x-2">
                          @if ($report->user->profile_photo) <!-- Periksa jika ada foto profil -->
    <img src="{{ asset('storage/profile_photos/' . $report->user->profile_photo) }}" alt="Profile" class="w-10 h-10 rounded-full">
@else
    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 text-2xl font-bold">
        {{ strtoupper(substr($report->user->nama_lengkap, 0, 1)) }} <!-- Ambil huruf pertama dari nama -->
    </div>
@endif

                            <span>{{ $report->user->nama_lengkap }}</span>
                        </td>
                        <td class="py-2 px-4">{{ $report['created_at'] }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 text-sm rounded-full
                                {{ $report['status'] == 'Diproses' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                {{ $report['status'] == 'Disetujui' ? 'bg-green-200 text-green-800' : '' }}
                                {{ $report['status'] == 'Diajukan' ? 'bg-red-200 text-red-800' : '' }}
                                {{ $report['status'] == 'Selesai' ? 'bg-gray-200 text-gray-800' : '' }}">
                                {{ $report['status'] }}
                            </span>
                        </td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.reports.show', $report['id']) }}" class="text-blue-600 hover:underline">
                                <i class="fas fa-cogs"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleFilter() {
        const filterDropdown = document.getElementById('filterDropdown');
        filterDropdown.classList.toggle('hidden');
    }

    function applyFilter() {
        const selectedStatuses = Array.from(document.querySelectorAll('.filter-checkbox:checked')).map(checkbox => checkbox.value);
        const laporanContent = document.getElementById('laporanContent');
        
        let filteredReports = @json($reports);

        if (selectedStatuses.length > 0) {
            filteredReports = filteredReports.filter(report => selectedStatuses.includes(report.status));
        }

        let htmlContent = '';

        filteredReports.forEach(report => {
            htmlContent += `
                <tr class="border-b">
                    <td class="py-2 px-4">#${report.id}</td>
                    <td class="py-2 px-4 flex items-center space-x-2">
                        <img src="{{ asset('images/pict1.png') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                        <span>${report.name}</span>
                    </td>
                    <td class="py-2 px-4">${report.date}</td>
                    <td class="py-2 px-4">
                        <span class="px-2 py-1 text-sm rounded-full
                            ${report.status === 'Diproses' ? 'bg-yellow-200 text-yellow-800' : ''}
                            ${report.status === 'Disetujui' ? 'bg-green-200 text-green-800' : ''}
                            ${report.status === 'Diajukan' ? 'bg-red-200 text-red-800' : ''}
                            ${report.status === 'Selesai' ? 'bg-gray-200 text-gray-800' : ''}">
                            ${report.status}
                        </span>
                    </td>
                    <td class="py-2 px-4">
                        <a href="/admin/reports/${report.id}" class="text-blue-600 hover:underline">
                            <i class="fas fa-cogs"></i>
                        </a>
                    </td>
                </tr>
            `;
        });

        laporanContent.innerHTML = htmlContent;
    }

    function filterByTab(tab) {
        const laporanContent = document.getElementById('laporanContent');
        let filteredReports = @json($reports);

        if (tab === 'semua') {
            filteredReports = @json($reports);
        } else {
            filteredReports = filteredReports.filter(report => report.status.toLowerCase() === tab);
        }

        let htmlContent = '';

        filteredReports.forEach(report => {
            htmlContent += `
                <tr class="border-b">
                    <td class="py-2 px-4">#${report.id}</td>
                    <td class="py-2 px-4 flex items-center space-x-2">
                        <img src="{{ asset('images/pict1.png') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                        <span>${report.name}</span>
                    </td>
                    <td class="py-2 px-4">${report.date}</td>
                    <td class="py-2 px-4">
                        <span class="px-2 py-1 text-sm rounded-full
                            ${report.status === 'Diproses' ? 'bg-yellow-200 text-yellow-800' : ''}
                            ${report.status === 'Disetujui' ? 'bg-green-200 text-green-800' : ''}
                            ${report.status === 'Diajukan' ? 'bg-red-200 text-red-800' : ''}
                            ${report.status === 'Selesai' ? 'bg-gray-200 text-gray-800' : ''}">
                            ${report.status}
                        </span>
                    </td>
                    <td class="py-2 px-4">
                        <a href="/admin/reports/${report.id}" class="text-blue-600 hover:underline">
                            <i class="fas fa-cogs"></i>
                        </a>
                    </td>
                </tr>
            `;
        });

        laporanContent.innerHTML = htmlContent;

        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => tab.classList.remove('border-b-2', 'border-blue-600'));

        const activeTab = document.getElementById(`${tab}Tab`);
        activeTab.classList.add('border-b-2', 'border-blue-600');
    }

    document.addEventListener('DOMContentLoaded', function() {
        filterByTab('semua');
    });
</script>
@endsection
