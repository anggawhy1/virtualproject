@extends('layouts.app')

@section('content')

    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8 bg-gray-50 text-gray-800 font-sans min-h-screen">
        <div class="w-full max-w-lg px-6 py-12 text-center bg-white rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-blue-600 mb-4">Terimakasih Telah Melapor!</h1>
            <p class="text-gray-700 mb-2">
                Laporan kamu akan segera ditindak lanjuti, cek secara berkala pada 
                <a href="/lacakaduan" class="text-blue-600 font-semibold ml-1 cursor-pointer">
                    “Lacak Aduan”
                </a>
            </p>
            <p class="text-gray-700 mb-6 flex items-center justify-center">
                ID Laporan Kamu: <span class="font-semibold ml-1" id="reportId">{{ $laporan->id }}</span>
                <button
                    onclick="copyReportId()"
                    class="ml-2 text-blue-600 cursor-pointer"
                >
                    <img src="{{ asset('images/Copy.png') }}" alt="Copy Icon" class="w-5 h-5 inline" />
                </button>
            </p>
            
            <a
                href="/beranda"
                class="w-full px-8 py-3 text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md transform hover:scale-105 text-center block"
            >
                Kembali ke Beranda
            </a>
        </div>
    </main>
 
@endsection

@push('scripts')
<script>
    function copyReportId() {
        const reportId = document.getElementById('reportId').innerText;
        navigator.clipboard.writeText(reportId).then(() => {
            alert("ID Laporan disalin ke clipboard!");
        });
    }
</script>
@endpush
