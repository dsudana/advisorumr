<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <title>{{ $site_settings->site_name }}</title>
    @if($site_settings->favicon_path)
        <link rel="icon" href="{{ Storage::url($site_settings->favicon_path) }}">
    @endif
    <meta name="description"
        content="@yield('meta_description', $site_settings->site_description ?? 'Trusted Umroh Travel Agency providing comfortable and spiritual journeys.')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('meta_title', config('app.name'))">
    <meta property="og:description"
        content="@yield('meta_description', 'Trusted Umroh Travel Agency providing comfortable and spiritual journeys.')">
    <meta property="og:image" content="@yield('meta_image', asset('images/default-og.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('meta_title', config('app.name'))">
    <meta property="twitter:description"
        content="@yield('meta_description', 'Trusted Umroh Travel Agency providing comfortable and spiritual journeys.')">
    <meta property="twitter:image" content="@yield('meta_image', asset('images/default-og.jpg'))">

    @stack('seo')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .hero-pattern {
            background-color: #047857;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23065f46' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-white">
    <div class="min-h-screen flex flex-col">
        @include('components.navbar')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('components.footer')

        <!-- Floating WhatsApp Button -->
        <a href="https://wa.me/6281234567890" target="_blank"
            class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition transform hover:-translate-y-1 hover:shadow-xl flex items-center justify-center group">
            <i class="fa-brands fa-whatsapp text-3xl"></i>
            <span class="absolute right-full mr-3 bg-white px-3 py-1 rounded-lg shadow-md text-sm font-medium text-gray-700 opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                Chat dengan Kami
            </span>
        </a>
    </div>
</body>

</html>