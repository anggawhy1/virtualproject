@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
        <main class="flex-grow w-full px-4 md:px-20 py-12">
            <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-8">Bantuan</h1>

            <p class="text-gray-700 mb-8">
                Selamat datang di halaman Bantuan!
                Di sini, Anda dapat menemukan berbagai panduan dan jawaban untuk pertanyaan yang sering diajukan (FAQ). 
                Silakan cari informasi yang Anda butuhkan pada daftar FAQ di bawah ini.
                Jika Anda tidak menemukan solusi untuk permasalahan Anda, jangan ragu untuk menghubungi LaporBot service kami melalui tombol chat di sudut kanan bawah layar.
            </p>

            <section class="mb-16">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Frequently Asked Questions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                        $faqs = [
                            [
                                'question' => "Bagaimana cara saya membuat laporan?",
                                'answer' => "Kamu bisa membuat laporan dengan membuat akun terlebih dahulu, jika sudah maka kamu dapat mengklik 'Mulai Laporan' isi informasi mengenai laporan anda dan anda telah membuat laporan."
                            ],
                            [
                                'question' => "Bagaimana cara melacak perkembangan laporan saya?",
                                'answer' => "Cara melacak perkembangan laporan anda bisa menggunakan fitur 'Lacak aduan' pada navbar kami, Masukkan ID laporan anda dan anda telah menemukan informasi tentang laporan anda."
                            ],
                            [
                                'question' => "Apakah saya bisa melaporkan secara anonim?",
                                'answer' => "Ya, anda bisa melaporkan secara anonim, jika anda tidak ingin nama anda diketahui anda bisa menceklis 'Lapor sebagai anonim' saat mengisi informasi laporan."
                            ],
                            [
                                'question' => "Bagaimana cara mendaftar akun baru?",
                                'answer' => "Cara mendaftar akun baru anda bisa mengklik 'daftar' pada navbar website kami, isi informasi untuk akun anda dan anda telah siap mendaftar."
                            ],
                            [
                                'question' => "Bagaimana cara memperbarui informasi akun saya?",
                                'answer' => "Anda bisa memperbarui informasi anda dengan mengklik 'Edit profile' pada profile anda, isi informasi baru akun anda dan anda telah memperbaruinya."
                            ],
                            [
                                'question' => "Apa yang harus saya lakukan jika saya lupa kata sandi?",
                                'answer' => "Anda bisa mengklik 'lupa password' ketika anda mencoba password dan salah berkali-kali."
                            ]
                        ];
                    @endphp

                    @foreach ($faqs as $index => $faq)
                        <div class="border border-blue-300 rounded-lg p-4">
                            <div
                                class="flex items-center justify-start cursor-pointer"
                                onclick="toggleFAQ('{{ $index }}')"
                            >
                            <i class="fa fa-question-circle text-blue-600 mr-2 w-6 h-6"></i>

                                <span class="text-blue-600 font-semibold text-left">{{ $faq['question'] }}</span>
                                <span id="icon-{{ $index }}" class="ml-auto">+</span>
                            </div>
                            <p id="faq-{{ $index }}" class="mt-4 text-gray-700 text-sm hidden">
                                {{ $faq['answer'] }}
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
