@extends('layouts.app')

@section('content')


    <div class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
        <main class="flex-grow w-full px-4 md:px-20 py-12">
            <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-8">Bantuan</h1>

            <section class="mb-12 space-y-4 text-blue-600 font-semibold">
                <div class="cursor-pointer flex items-center">
                    <span class="mr-2">+</span> Cara membuat laporan
                </div>
                <div class="cursor-pointer flex items-center">
                    <span class="mr-2">+</span> Cara melacak perkembangan laporan
                </div>
                <div class="cursor-pointer flex items-center">
                    <span class="mr-2">+</span> Keamanan dan privasi laporan
                </div>
                <div class="cursor-pointer flex items-center">
                    <span class="mr-2">+</span> Mengelola laporan yang sudah dikirim
                </div>
            </section>

            <section class="mb-16">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Frequently Asked Questions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                        $faqs = [
                            "Bagaimana cara saya membuat laporan?",
                            "Bagaimana cara melacak perkembangan laporan saya?",
                            "Apakah saya bisa melaporkan secara anonim?",
                            "Bagaimana cara mendaftar akun baru?",
                            "Bagaimana cara memperbarui informasi akun saya?",
                            "Apa yang harus saya lakukan jika saya lupa kata sandi?",
                        ];
                    @endphp

                    @foreach ($faqs as $index => $question)
                        <div class="border border-blue-200 rounded-lg p-4">
                            <div
                                class="flex items-center justify-between cursor-pointer"
                                onclick="toggleFAQ('{{ $index }}')"
                            >
                                <span class="text-blue-600 font-semibold">{{ $question }}</span>
                                <span id="icon-{{ $index }}">+</span>
                            </div>
                            <p id="faq-{{ $index }}" class="mt-4 text-gray-700 text-sm hidden">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>


    </div>

@endsection

@push('scripts')
<script>
    function toggleFAQ(index) {
        const faq = document.getElementById(`faq-${index}`);
        const icon = document.getElementById(`icon-${index}`);
        if (faq.classList.contains('hidden')) {
            faq.classList.remove('hidden');
            icon.textContent = '−'; 
        } else {
            faq.classList.add('hidden');
            icon.textContent = '+'; 
        }
    }
</script>
@endpush
