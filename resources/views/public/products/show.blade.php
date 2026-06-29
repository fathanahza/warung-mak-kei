@extends('layouts.app')

@section('title', $product->meta_title ?? $product->nama_produk . ' – Warung Mak Kei')
@section('meta_description', $product->meta_description ?? substr(strip_tags($product->deskripsi), 0, 160))
@section('og_title', $product->nama_produk)
@section('og_description', substr(strip_tags($product->deskripsi), 0, 200))
@section('og_image', $product->gambar_utama_url)

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $product->nama_produk }}",
    "description": "{{ strip_tags($product->deskripsi) }}",
    "image": "{{ $product->gambar_utama_url }}",
    "offers": {
        "@type": "Offer",
        "price": "{{ $product->harga_aktif }}",
        "priceCurrency": "IDR",
        "availability": "{{ $product->is_stok_habis ? 'https://schema.org/OutOfStock' : 'https://schema.org/InStock' }}"
    }
}
</script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6 flex items-center gap-2 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-primary-600 dark:hover:text-primary-400">Beranda</a>
        <span>›</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400">Produk</a>
        <span>›</span>
        <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:text-primary-600 dark:hover:text-primary-400">{{ $product->category->nama_kategori }}</a>
        <span>›</span>
        <span class="text-gray-800 dark:text-gray-200 font-medium truncate">{{ $product->nama_produk }}</span>
    </nav>

    {{-- Main Product Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-12"
         x-data="{ activeImage: '{{ $product->gambar_utama_url }}', inWishlist: {{ $inWishlist ? 'true' : 'false' }}, wishlistLoading: false }">

        {{-- ── GALLERY ────────────────────────────────── --}}
        <div class="space-y-3">
            {{-- Main Image --}}
            <div class="relative aspect-square bg-gray-50 dark:bg-gray-800 rounded-3xl overflow-hidden">
                <img :src="activeImage" alt="{{ $product->nama_produk }}"
                     class="w-full h-full object-cover"
                     loading="eager">

                {{-- Badges --}}
                <div class="absolute top-4 left-4 flex flex-col gap-2">
                    @if($product->is_best_seller)
                    <span class="inline-flex items-center gap-1 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-xl shadow-lg">🔥 Best Seller</span>
                    @endif
                    @if($product->is_promo)
                    <span class="bg-accent-500 text-white text-sm font-black px-3 py-1.5 rounded-xl shadow-lg">-{{ $product->persentase_diskon }}% OFF</span>
                    @endif
                    @if($product->is_stok_habis)
                    <span class="bg-gray-600 text-white text-xs font-bold px-3 py-1.5 rounded-xl">Stok Habis</span>
                    @endif
                </div>

                {{-- Wishlist on gallery --}}
                <button @click="
                            wishlistLoading = true;
                            fetch('{{ route('wishlist.toggle', $product) }}', {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
                            })
                            .then(r => r.json())
                            .then(d => { inWishlist = d.action === 'added'; wishlistLoading = false; })
                            .catch(() => wishlistLoading = false)
                        "
                        :class="inWishlist ? 'bg-red-500 text-white' : 'bg-white/90 text-gray-500 hover:text-red-500'"
                        class="absolute top-4 right-4 w-11 h-11 rounded-2xl flex items-center justify-center shadow-lg transition-all"
                        :disabled="wishlistLoading">
                    <svg x-show="!wishlistLoading" class="w-5 h-5" :fill="inWishlist ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <div x-show="wishlistLoading" x-cloak class="w-4 h-4 border-2 border-red-400 border-t-transparent rounded-full animate-spin"></div>
                </button>
            </div>

            {{-- Thumbnail Gallery --}}
            @if($product->images->count() > 0)
            <div class="flex gap-2 overflow-x-auto pb-1">
                <button @click="activeImage = '{{ $product->gambar_utama_url }}'"
                        :class="activeImage === '{{ $product->gambar_utama_url }}' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                        class="flex-shrink-0 w-16 h-16 rounded-xl overflow-hidden">
                    <img src="{{ $product->gambar_utama_url }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                </button>
                @foreach($product->images as $image)
                <button @click="activeImage = '{{ $image->gambar_url }}'"
                        :class="activeImage === '{{ $image->gambar_url }}' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                        class="flex-shrink-0 w-16 h-16 rounded-xl overflow-hidden">
                    <img src="{{ $image->gambar_url }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover" loading="lazy">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── PRODUCT INFO ───────────────────────────── --}}
        <div class="flex flex-col">
            <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}"
               class="inline-flex items-center gap-1.5 text-sm text-primary-600 dark:text-primary-400 font-semibold hover:underline mb-3">
                <span>{{ $product->category->icon }}</span> {{ $product->category->nama_kategori }}
            </a>

            <h1 class="text-2xl lg:text-3xl font-black text-gray-900 dark:text-white mb-4 leading-tight">{{ $product->nama_produk }}</h1>

            {{-- Harga --}}
            <div class="flex items-end gap-3 mb-5">
                <span class="text-3xl font-black {{ $product->is_promo ? 'text-accent-600 dark:text-accent-400' : 'text-primary-600 dark:text-primary-400' }}">
                    {{ $product->is_promo ? $product->harga_diskon_format : $product->harga_format }}
                </span>
                @if($product->is_promo)
                <div class="flex flex-col">
                    <span class="text-base text-gray-400 line-through">{{ $product->harga_format }}</span>
                    <span class="text-xs text-accent-500 font-bold">Hemat {{ rupiah($product->harga - $product->harga_diskon) }}</span>
                </div>
                @endif
            </div>

            {{-- Spesifikasi Singkat --}}
            <div class="grid grid-cols-2 gap-3 mb-6">
                @if($product->berat)
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-0.5">Berat</p>
                    <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $product->berat }}</p>
                </div>
                @endif
                @if($product->isi_produk)
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-0.5">Isi</p>
                    <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $product->isi_produk }}</p>
                </div>
                @endif
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-0.5">Stok</p>
                    <p class="text-sm font-bold {{ $product->is_stok_habis ? 'text-red-500' : 'text-green-600 dark:text-green-400' }}">
                        {{ $product->is_stok_habis ? 'Habis' : $product->stok . ' tersedia' }}
                    </p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-0.5">Klik WA</p>
                    <p class="text-sm font-bold text-gray-800 dark:text-white">{{ number_format($product->klik_whatsapp) }}x</p>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="mb-6">
                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed line-clamp-4">{{ strip_tags($product->deskripsi) }}</p>
            </div>

            {{-- CTA Buttons --}}
            <div class="space-y-3 mt-auto">
                {{-- WhatsApp --}}
                <a href="{{ $product->whatsapp_url }}"
                   target="_blank"
                   rel="noopener"
                   @click="
                        fetch('{{ route('products.whatsapp.click', $product) }}', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
                        });
                   "
                   class="flex items-center justify-center gap-2.5 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-2xl text-base shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5 {{ $product->is_stok_habis ? 'opacity-50 pointer-events-none' : '' }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Pesan via WhatsApp
                </a>

                {{-- Platform Links --}}
                <div class="grid grid-cols-3 gap-2">
                    @if($product->link_tokopedia)
                    <a href="{{ $product->link_tokopedia }}" target="_blank"
                       class="flex flex-col items-center gap-1 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/40 text-green-700 dark:text-green-400 font-semibold text-xs py-3 rounded-xl transition border border-green-200 dark:border-green-800">
                        🛒 <span>Tokopedia</span>
                    </a>
                    @endif
                    @if($product->link_shopee)
                    <a href="{{ $product->link_shopee }}" target="_blank"
                       class="flex flex-col items-center gap-1 bg-orange-50 dark:bg-orange-900/20 hover:bg-orange-100 dark:hover:bg-orange-900/40 text-orange-600 dark:text-orange-400 font-semibold text-xs py-3 rounded-xl transition border border-orange-200 dark:border-orange-800">
                        🛍️ <span>Shopee</span>
                    </a>
                    @endif
                    @if($product->link_gofood)
                    <a href="{{ $product->link_gofood }}" target="_blank"
                       class="flex flex-col items-center gap-1 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 text-red-600 dark:text-red-400 font-semibold text-xs py-3 rounded-xl transition border border-red-200 dark:border-red-800">
                        🍱 <span>GoFood</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ── DESKRIPSI LENGKAP ─────────────────────── --}}
    <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 lg:p-8 border border-gray-100 dark:border-gray-700 mb-10">
        <h2 class="text-xl font-black text-gray-900 dark:text-white mb-5">Deskripsi Produk</h2>
        <div class="prose prose-sm dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed">
            {!! nl2br(e($product->deskripsi)) !!}
        </div>
    </div>

    {{-- ── PRODUK TERKAIT ────────────────────────── --}}
    @if($produk_terkait->count() > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6">Produk Serupa</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($produk_terkait as $produk)
                @include('components.public.product-card', ['product' => $produk])
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── PRODUK TERLARIS ──────────────────────── --}}
    @if($produk_terlaris->count() > 0)
    <div>
        <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6">🔥 Produk Terlaris</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($produk_terlaris as $produk)
                @include('components.public.product-card', ['product' => $produk])
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
