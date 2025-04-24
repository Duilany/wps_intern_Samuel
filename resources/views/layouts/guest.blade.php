<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistem Log Harian</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @if(isset($useDefaultLayout) && $useDefaultLayout)
            <!-- Layout default untuk form terpusat (cocok untuk register) -->
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                <main class="flex justify-center">
                    <div class="w-full sm:max-w-md mt-6 mb-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        @yield('content')
                    </div>
                </main>
            </div>
        @else
            <!-- Tanpa pembungkus default, biarkan template anak mengontrol tata letak (cocok untuk login) -->
            @yield('content')
        @endif
    </body>
</html>