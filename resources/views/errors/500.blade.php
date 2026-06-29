@extends('layouts.app')

@section('title', 'Server Error – Warung Mak Kei')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="text-center max-w-lg mx-auto">
        <div class="text-8xl mb-6">🔧</div>
        <h1 class="text-7xl font-black text-red-500 mb-2">500</h1>
        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Oops! Server Bermasalah</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8">
            Sedang ada gangguan teknis. Tim kami sedang memperbaikinya. Mohon coba beberapa saat lagi.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-bold px-7 py-3.5 rounded-2xl transition-all hover:-translate-y-0.5 shadow-lg">
                🏠 Kembali ke Beranda
            </a>
            <a href="{{ whatsapp_url('Halo Warung Mak Kei, saya mengalami masalah di website.') }}" target="_blank"
               class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold px-7 py-3.5 rounded-2xl transition-all">
                💬 Laporkan ke WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
