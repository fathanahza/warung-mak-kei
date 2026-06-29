@php
    $wishlist = session()->get('wishlist', []);
    $inWishlist = in_array($product->id, $wishlist);
@endphp

<div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700 flex flex-col"
     x-data="{ inWishlist: {{ $inWishlist ? 'true' : 'false' }}, loading: false }">

    {{-- Gambar Produk --}}
    <div class="relative overflow-hidden aspect-square bg-gray-50 dark:bg-gray-700">
        <a href="{{ $product->url }}">
            <img src="{{ $product->gambar_utama_url }}"
                 alt="{{ $product->nama_produk }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.src='{{ asset('images/placeholder-product.jpg') }}'">
        </a>

        {{-- Badges --}}
        <div class="absolute top-2 left-2 flex flex-col gap-1.5">
            @if($product->is_best_seller)
            <span class="inline-flex items-center gap-1 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow">
                🔥 Best Seller
            </span>
            @endif
            @if($product->is_promo)
            <span class="inline-flex items-center bg-accent-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow">
                -{{ $product->persentase_diskon }}%
            </span>
            @endif
            @if($product->is_stok_habis)
            <span class="inline-flex items-center bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-lg">
                Stok Habis
            </span>
            @endif
        </div>

        {{-- Wishlist Button --}}
        <button @click.prevent="
                    loading = true;
                    fetch('{{ route('wishlist.toggle', $product) }}', {
                        method: 'POST',
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
                    })
                    .then(r => r.json())
                    .then(d => { inWishlist = d.action === 'added'; loading = false; })
                    .catch(() => loading = false)
                "
                :class="inWishlist ? 'text-red-500 bg-red-50' : 'text-gray-400 bg-white/80 hover:text-red-500'"
                class="absolute top-2 right-2 w-8 h-8 rounded-xl flex items-center justify-center shadow transition-all"
                :disabled="loading">
            <svg x-show="!loading" class="w-4 h-4" :fill="inWishlist ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <div x-show="loading" x-cloak class="w-3 h-3 border-2 border-red-400 border-t-transparent rounded-full animate-spin"></div>
        </button>
    </div>

    {{-- Info Produk --}}
    <div class="p-3 lg:p-4 flex flex-col flex-1">
        <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}"
           class="text-xs text-primary-600 dark:text-primary-400 font-medium mb-1 hover:underline">
            {{ $product->category->nama_kategori }}
        </a>
        <a href="{{ $product->url }}"
           class="text-sm font-bold text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition line-clamp-2 mb-3 flex-1">
            {{ $product->nama_produk }}
        </a>

        {{-- Harga --}}
        <div class="mb-3">
            @if($product->is_promo)
            <div class="flex items-baseline gap-1.5">
                <span class="text-base font-black text-accent-600 dark:text-accent-400">{{ $product->harga_diskon_format }}</span>
                <span class="text-xs text-gray-400 line-through">{{ $product->harga_format }}</span>
            </div>
            @else
            <span class="text-base font-black text-primary-600 dark:text-primary-400">{{ $product->harga_format }}</span>
            @endif
            @if($product->berat)
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $product->berat }}{{ $product->isi_produk ? ' · ' . $product->isi_produk : '' }}</p>
            @endif
        </div>

        {{-- CTA --}}
        <a href="{{ $product->url }}"
           class="block w-full text-center {{ $product->is_stok_habis ? 'bg-gray-100 dark:bg-gray-700 text-gray-400 cursor-not-allowed' : 'bg-primary-600 hover:bg-primary-700 dark:bg-primary-600 dark:hover:bg-primary-700 text-white hover:shadow-lg hover:-translate-y-0.5' }} font-semibold text-xs py-2.5 rounded-xl transition-all duration-200">
            {{ $product->is_stok_habis ? 'Stok Habis' : 'Lihat Detail' }}
        </a>
    </div>
</div>
