<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LaporPak')</title>
    <link rel="icon" href="images/Logo.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
@stack('scripts')
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    @include('partials.navbar') 

    <main class="flex-grow">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>

        <div id="chat-bot-icon"
            style="position: fixed; bottom: 20px; right: 20px; width: 56px; height: 56px; border: 1px solid #1D4ED8; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #ffffff; z-index: 9999; cursor: pointer;"
            onclick="navigateToChatbot()"
            onmouseover="showTooltip()"
            onmouseout="hideTooltip()">
            <img src="{{ asset('images/bot.png') }}" alt="Bot Icon" style="width: 36px; height: 36px;">

            <div id="chat-tooltip"
                style="position: absolute; bottom: 70px; right: 0; transform: translateX(-10%); background-color: #1D4ED8; color: #ffffff; padding: 8px 12px; border-radius: 6px; font-size: 12px; white-space: nowrap; display: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                Butuh bantuan ? Klik disini !
            </div>
        </div>

        <script>
            function navigateToChatbot() {
                window.location.href = "{{ route('chatbot') }}"; 
            }

            function showTooltip() {
                const tooltip = document.getElementById('chat-tooltip');
                tooltip.style.display = 'block';
                tooltip.style.opacity = '1';
            }

            function hideTooltip() {
                const tooltip = document.getElementById('chat-tooltip');
                tooltip.style.display = 'none';
                tooltip.style.opacity = '0';
            }
        </script>
    </main>

    @include('partials.footer') 
</body>
</html>
