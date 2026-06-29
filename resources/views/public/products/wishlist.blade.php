@extends('layouts.app')

@section('title', 'Produk Favorit Saya – Warung Mak Kei')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white">❤️ Favorit Saya</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $products->count() }} produk tersimpan</p>
        </div>
        @if($products->count() > 0)
        <a href="{{ route('products.index') }}"
           class="text-sm text-primary-600 dark:text-primary-400 font-semibold hover:underline">
            Tambah Produk →
        </a>
        @endif
    </div>

    @if($products->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach($products as $product)
            @include('components.public.product-card', ['product' => $product])
        @endforeach
    </div>
    @else
    {{-- Empty State --}}
    <div class="flex flex-col items-center justify-center py-24 text-center">
        <div class="text-7xl mb-6">💔</div>
        <h2 class="text-2xl font-black text-gray-800 dark:text-white mb-3">Belum Ada Favorit</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-sm">Tambahkan produk ke favorit dengan menekan ikon ❤️ pada kartu produk.</p>
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-4 rounded-2xl transition-all hover:-translate-y-0.5 shadow-lg">
            Jelajahi Produk
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
    @endif
</div>
@endsection
