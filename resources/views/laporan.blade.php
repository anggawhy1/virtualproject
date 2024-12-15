@extends('layouts.app')  

@section('content')

<main class="flex-grow w-full px-4 md:px-20 py-12 bg-gray-50 text-gray-800 font-sans min-h-screen">

    <div class="flex">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Konten Utama -->
        <section class="w-full md:w-3/4 p-6 border border-gray-300 rounded-lg bg-white shadow-md">
            <h1 class="text-3xl font-bold text-blue-600 mb-6">Laporan</h1>
            
            <div class="space-y-6">
                @foreach ($reports as $report)
                    <div 
                        data-id="{{ $report->id }}" 
                        class="report-item flex items-center border border-gray-200 rounded-lg bg-gray-50 shadow-sm p-4 cursor-pointer hover:shadow-lg transition duration-300">
                        
                        <!-- Gambar Laporan -->
                        <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" class="w-20 h-20 object-cover rounded-md mr-6">

                        <!-- Informasi Laporan -->
                        <div class="flex flex-col justify-between w-full">
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $report->kategori->nama }}</h2>
                            <p class="text-gray-500 text-sm mb-2">{{ $report->created_at->format('d F Y') }}</p>
                            
                            <!-- Status Laporan -->
                            <span class="inline-block w-fit px-3 py-1 text-xs font-semibold rounded-md
                                {{ $report->status === 'Diajukan' ? 'bg-yellow-100 text-yellow-600' : 
                                   ($report->status === 'Disetujui' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600') }}">
                                {{ $report->status }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

</main>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.report-item').forEach(item => {
            item.addEventListener('click', function () {
                const reportId = this.getAttribute('data-id');
                if (reportId) {
                    window.location.href = `/laporan/detail/${reportId}`; // Pastikan rute sesuai dengan rute detail laporan
                }
            });
        });
    });
</script>
@endpush
