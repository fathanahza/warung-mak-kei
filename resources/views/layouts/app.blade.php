<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', mobileMenu: false }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta --}}
    <title>@yield('title', setting('meta_title', 'Warung Mak Kei – Frozen Food Berkualitas'))</title>
    <meta name="description" content="@yield('meta_description', setting('meta_description'))">
    <meta name="keywords" content="@yield('meta_keywords', 'frozen food, bakso, nugget, sosis, camilan, warung mak kei')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', setting('meta_title', 'Warung Mak Kei'))">
    <meta property="og:description" content="@yield('og_description', setting('meta_description'))">
    <meta property="og:image" content="@yield('og_image', setting('og_image') ? Storage::url(setting('og_image')) : asset('images/og-default.jpg'))">
    <meta property="og:site_name" content="{{ setting('nama_toko', 'Warung Mak Kei') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', setting('meta_title'))">
    <meta name="twitter:description" content="@yield('og_description', setting('meta_description'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN (ganti dengan vite di produksi) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0',
                            300: '#86efac', 400: '#4ade80', 500: '#22c55e',
                            600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d',
                        },
                        accent: {
                            50: '#fff7ed', 100: '#ffedd5', 200: '#fed7aa',
                            300: '#fdba74', 400: '#fb923c', 500: '#f97316',
                            600: '#ea580c', 700: '#c2410c', 800: '#9a3412', 900: '#7c2d12',
                        },
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'bounce-soft': 'bounceSoft 2s infinite',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { transform: 'translateY(20px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                        bounceSoft: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-8px)' } },
                    },
                },
            },
        }
    </script>

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')

    {{-- Schema.org JSON-LD --}}
    @yield('schema')

    <style>
        [x-cloak] { display: none !important; }
        .skeleton { background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .dark .skeleton { background: linear-gradient(90deg, #374151 25%, #4B5563 50%, #374151 75%); background-size: 200% 100%; }
        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 6px; } ::-webkit-scrollbar-track { background: #f1f1f1; } ::-webkit-scrollbar-thumb { background: #16a34a; border-radius: 3px; }
    </style>
</head>
<body class="font-sans bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">

    {{-- NAVBAR --}}
    @include('components.public.navbar')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.public.footer')

    {{-- FLOATING BUTTONS --}}
    @include('components.public.floating-buttons')

    {{-- BACK TO TOP --}}
    @include('components.public.back-to-top')

    {{-- TOAST NOTIFICATIONS --}}
    @include('components.public.toast')

    @stack('scripts')

    {{-- Google Analytics --}}
    @if(setting('google_analytics'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('google_analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ setting("google_analytics") }}');
    </script>
    @endif
</body>
</html>
