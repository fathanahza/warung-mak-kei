<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – Warung Mak Kei</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#f0fdf4', 100:'#dcfce7', 500:'#22c55e', 600:'#16a34a', 700:'#15803d' },
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="min-h-full bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex items-center justify-center px-4 py-12 font-sans">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl shadow-xl mb-4">
                <span class="text-white font-black text-2xl">MK</span>
            </div>
            <h1 class="text-2xl font-black text-white">Warung Mak Kei</h1>
            <p class="text-gray-400 text-sm mt-1">Admin Panel</p>
        </div>

        {{-- Card --}}
        <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 shadow-2xl">
            <h2 class="text-xl font-bold text-white mb-6 text-center">Masuk ke Dashboard</h2>

            {{-- Error messages --}}
            @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500/30 text-red-400 rounded-2xl px-4 py-3 mb-5 text-sm flex items-start gap-2">
                <span class="text-red-400 mt-0.5">⚠️</span>
                <div>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@warungmakkei.com"
                           class="w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-500 text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full px-4 py-3.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-500 text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition">
                </div>

                <div class="flex items-center gap-3">
                    <label class="relative flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-500 text-primary-600 focus:ring-primary-500">
                        <span class="text-sm text-gray-300">Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 rounded-2xl text-base transition-all hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>

        {{-- Back to site --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white transition inline-flex items-center gap-1">
                ← Kembali ke Website
            </a>
        </div>

        {{-- Hint (dev only) --}}
        @if(config('app.debug'))
        <div class="mt-4 bg-yellow-500/10 border border-yellow-500/20 rounded-2xl px-4 py-3 text-center">
            <p class="text-yellow-400 text-xs">🔑 Dev: admin@warungmakkei.com / password</p>
        </div>
        @endif
    </div>

</body>
</html>
