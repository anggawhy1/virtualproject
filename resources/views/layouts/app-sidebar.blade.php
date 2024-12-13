<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaporPak')</title>
    <link rel="icon" href="images/Logo.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
@stack('scripts')
<body class="bg-gray-50 text-gray-800 min-h-screen flex">

    @include('partials.sidebar-admin')

    <div class="flex-grow ml-64">

        @include('partials.header-fix')

        <main class="container mx-auto px-4 py-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
