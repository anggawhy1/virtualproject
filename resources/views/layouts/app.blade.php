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
            onmouseover="forceShowTooltip()"
            onmouseout="checkMouseOut(event)">
            <img src="{{ asset('images/bot.png') }}" alt="Bot Icon" style="width: 36px; height: 36px;">

            <!-- Tooltip -->
            <div id="chat-tooltip"
                style="position: absolute; bottom: 70px; right: 0; transform: translateX(-10%) scale(0); background-color: #1D4ED8; color: #ffffff; padding: 8px 12px; border-radius: 6px; font-size: 12px; white-space: nowrap; display: none; opacity: 0; transition: opacity 0.3s ease, transform 0.3s ease; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
                onmouseover="forceShowTooltip()"
                onmouseout="checkMouseOut(event)">
                Butuh bantuan ? Klik disini!
            </div>
        </div>

        <script>
            let isTooltipVisible = false;

            function navigateToChatbot() {
                window.location.href = "{{ route('chatbot') }}";
            }

            function forceShowTooltip() {
                if (!isTooltipVisible) {
                    showTooltip();
                }
            }

            function showTooltip() {
                const tooltip = document.getElementById('chat-tooltip');
                tooltip.style.display = 'block';
                setTimeout(() => {
                    tooltip.style.opacity = '1';
                    tooltip.style.transform = 'translateX(-10%) scale(1)';
                }, 10);
                isTooltipVisible = true;
            }

            function checkMouseOut(event) {
                const chatBotIcon = document.getElementById('chat-bot-icon');
                const tooltip = document.getElementById('chat-tooltip');

                if (!chatBotIcon.contains(event.relatedTarget) && !tooltip.contains(event.relatedTarget)) {
                    hideTooltip();
                }
            }

            function hideTooltip() {
                const tooltip = document.getElementById('chat-tooltip');
                tooltip.style.opacity = '0';
                tooltip.style.transform = 'translateX(-10%) scale(0)';
                setTimeout(() => {
                    tooltip.style.display = 'none';
                }, 300);
                isTooltipVisible = false;
            }
            
        </script>
    </main>

    @include('partials.footer') 
</body>
</html>
