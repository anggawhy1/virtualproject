@extends('layouts.app2')

@section('content')
<div class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
    <main class="flex-grow w-full px-4 md:px-20 py-12">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-8">LaporBot</h1>

        <div class="border border-blue-600 rounded-lg p-4 mb-4">
            <p class="text-gray-800">
                Hi User! Aku LaporBot, virtual support bantuan untuk permasalahan kamu. Pilih berdasarkan masalah yang sering
                ditanyakan di bawah atau langsung tulis pesan kamu untuk terhubung dengan customer service kami!
            </p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <button class="faq-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-lg shadow-black focus:outline-none" data-answer="Bagaimana cara saya lapor?">
                Bagaimana cara saya lapor?
            </button>
            <button class="faq-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-lg shadow-black focus:outline-none" data-answer="Dimana saya dapat melacak laporan saya?">
                Dimana saya dapat melacak laporan saya?
            </button>
            <button class="faq-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-lg shadow-black focus:outline-none" data-answer="Apakah saya dapat melapor secara anonim?">
                Apakah saya dapat melapor secara anonim?
            </button>
            <button class="faq-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-lg shadow-black focus:outline-none" data-answer="Cara membuat akun?">
                Cara membuat akun?
            </button>
        </div>

        <div id="chat-container" class="space-y-4">
        </div>

        <div class="flex items-center mt-4">
            <input
                type="text"
                id="chat-input"
                placeholder="Tulis permasalahan kamu disini!"
                class="flex-grow border border-blue-600 rounded-lg py-2 px-4 shadow-lg shadow-black focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
            <button
                id="send-btn"
                class="ml-2 bg-blue-600 text-white p-2 rounded-full shadow hover:bg-blue-700 focus:outline-none">
                <i class="fas fa-paper-plane text-lg"></i>
            </button>

        </div>
    </main>
</div>


</div>

<script>
    document.querySelectorAll('.faq-btn').forEach(button => {
        button.addEventListener('click', function() {
            const answer = this.getAttribute('data-answer');
            const chatContainer = document.getElementById('chat-container');

            const userMessageWrapper = document.createElement('div');
            userMessageWrapper.style.display = 'flex';
            userMessageWrapper.style.justifyContent = 'flex-end';

            const userMessage = document.createElement('div');
            userMessage.textContent = this.textContent;
            userMessage.className = 'bg-blue-600 text-white p-2 rounded-lg max-w-[75%] inline-block';
            userMessageWrapper.appendChild(userMessage);

            chatContainer.appendChild(userMessageWrapper);

            setTimeout(() => {
                const botMessageWrapper = document.createElement('div');
                botMessageWrapper.style.display = 'flex';
                botMessageWrapper.style.justifyContent = 'flex-start';

                const botMessage = document.createElement('div');
                botMessage.textContent = `LaporBot: ${answer}`;
                botMessage.className = 'bg-gray-300 text-gray-800 p-2 rounded-lg max-w-[75%] inline-block';
                botMessageWrapper.appendChild(botMessage);

                chatContainer.appendChild(botMessageWrapper);

                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 500);
        });
    });

    document.getElementById('send-btn').addEventListener('click', function() {
        const input = document.getElementById('chat-input');
        const chatContainer = document.getElementById('chat-container');

        if (input.value.trim() !== '') {
            const userMessageWrapper = document.createElement('div');
            userMessageWrapper.style.display = 'flex';
            userMessageWrapper.style.justifyContent = 'flex-end';

            const userMessage = document.createElement('div');
            userMessage.textContent = input.value;
            userMessage.className = 'bg-blue-600 text-white p-2 rounded-lg max-w-[75%] inline-block';
            userMessageWrapper.appendChild(userMessage);

            chatContainer.appendChild(userMessageWrapper);

            setTimeout(() => {
                const botMessageWrapper = document.createElement('div');
                botMessageWrapper.style.display = 'flex';
                botMessageWrapper.style.justifyContent = 'flex-start';

                const botMessage = document.createElement('div');
                botMessage.textContent = `LaporBot: Terima kasih atas pertanyaan kamu! Kami akan memprosesnya.`;
                botMessage.className = 'bg-gray-300 text-gray-800 p-2 rounded-lg max-w-[75%] inline-block';
                botMessageWrapper.appendChild(botMessage);

                chatContainer.appendChild(botMessageWrapper);

                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 1000);

            input.value = '';
        }
    });
</script>

@endsection