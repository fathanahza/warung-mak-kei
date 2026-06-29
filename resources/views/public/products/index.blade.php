@extends('layouts.app')

@section('title', 'Semua Produk – Warung Mak Kei')
@section('meta_description', 'Temukan berbagai frozen food dan camilan berkualitas: bakso, nugget, sosis, dimsum, dan banyak lagi di Warung Mak Kei.')

@section('content')

{{-- Page Header --}}
<div class="bg-gradient-to-r from-primary-700 to-primary-900 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm text-primary-200 mb-3">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
            <span class="mx-2">›</span>
            <span class="text-white font-medium">Produk</span>
        </nav>
        <h1 class="text-3xl font-black text-white">Semua Produk</h1>
        <p class="text-primary-200 mt-1">{{ $products->total() }} produk tersedia</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── SIDEBAR FILTER ───────────────────────── --}}
        <aside class="lg:w-64 flex-shrink-0"
               x-data="{ showFilter: false }">

            {{-- Mobile Filter Toggle --}}
            <button @click="showFilter = !showFilter"
                    class="lg:hidden w-full flex items-center justify-between gap-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-4 py-3 rounded-2xl mb-4 shadow-sm">
                <span class="font-semibold text-gray-700 dark:text-gray-200 text-sm">🔍 Filter Produk</span>
                <svg :class="showFilter && 'rotate-180'" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div :class="showFilter ? 'block' : 'hidden lg:block'" class="space-y-4">

                {{-- Search --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-3">Cari Produk</h3>
                    <form action="{{ route('products.index') }}" method="GET">
                        @if(request('kategori'))<input type="hidden" name="kategori" value="{{ request('kategori') }}">@endif
                        @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Nama produk..."
                                   class="w-full px-4 py-2.5 pl-9 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none dark:text-white dark:placeholder-gray-400 transition">
                            <svg class="absolute left-2.5 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <button type="submit" class="mt-2 w-full bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold py-2.5 rounded-xl transition">Cari</button>
                    </form>
                </div>

                {{-- Kategori Filter --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-3">Kategori</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->except(['kategori', 'page']), [])) }}"
                               class="flex items-center justify-between px-3 py-2 rounded-xl text-sm transition
                                      {{ !request('kategori') ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                <span>🔹 Semua Kategori</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->except(['kategori', 'page']), ['kategori' => $category->slug])) }}"
                               class="flex items-center justify-between px-3 py-2 rounded-xl text-sm transition
                                      {{ request('kategori') === $category->slug ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                <span>{{ $category->icon }} {{ $category->nama_kategori }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Filter Khusus --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white text-sm mb-3">Filter</h3>
                    <ul class="space-y-1">
                        @foreach([['slug' => 'terlaris', 'label' => '🔥 Terlaris'], ['slug' => 'unggulan', 'label' => '⭐ Unggulan'], ['slug' => 'promo', 'label' => '🏷️ Promo'], ['slug' => 'stok', 'label' => '✅ Stok Tersedia']] as $filter)
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->except(['filter', 'page']), ['filter' => $filter['slug']])) }}"
                               class="flex items-center px-3 py-2 rounded-xl text-sm transition
                                      {{ request('filter') === $filter['slug'] ? 'bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                {{ $filter['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Reset --}}
                @if(request()->hasAny(['q', 'kategori', 'filter', 'sort']))
                <a href="{{ route('products.index') }}"
                   class="block text-center text-sm text-red-500 hover:text-red-700 font-medium py-2 bg-red-50 dark:bg-red-900/20 rounded-xl transition">
                    ✕ Hapus Semua Filter
                </a>
                @endif
            </div>
        </aside>

        {{-- ── PRODUCT GRID ─────────────────────────── --}}
        <div class="flex-1 min-w-0">

            {{-- Toolbar --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $products->total() }}</span> produk
                </div>
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
                    @foreach(request()->except('sort') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="sort" onchange="this.form.submit()"
                            class="text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2 focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlaris" {{ request('sort') === 'terlaris' ? 'selected' : '' }}>Terlaris</option>
                        <option value="termurah" {{ request('sort') === 'termurah' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="termahal" {{ request('sort') === 'termahal' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </form>
            </div>

            {{-- Products --}}
            @if($products->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($products as $product)
                    @include('components.public.product-card', ['product' => $product])
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $products->onEachSide(1)->links('components.public.pagination') }}
            </div>

            @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="text-6xl mb-4">🛒</div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Produk Tidak Ditemukan</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Coba ubah kata kunci atau filter pencarian Anda.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                    Lihat Semua Produk
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
