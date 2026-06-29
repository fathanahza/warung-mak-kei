@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan – Warung Mak Kei')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="text-center max-w-lg mx-auto">
        <div class="text-8xl mb-6 animate-bounce">🍱</div>
        <h1 class="text-7xl font-black text-primary-600 dark:text-primary-400 mb-2">404</h1>
        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8">
            Ups! Sepertinya halaman yang Anda cari sudah habis terjual atau tidak ada. Yuk kembali ke beranda!
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-bold px-7 py-3.5 rounded-2xl transition-all hover:-translate-y-0.5 shadow-lg">
                🏠 Kembali ke Beranda
            </a>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 border-2 border-primary-600 text-primary-600 dark:text-primary-400 dark:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/30 font-bold px-7 py-3.5 rounded-2xl transition-all">
                🛒 Lihat Produk
            </a>
        </div>
    </div>
</div>
@endsection
