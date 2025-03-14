<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporPak')</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">

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
    </main>

</body>
</html>
