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