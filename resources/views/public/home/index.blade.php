@extends('layouts.app')

@section('title', setting('meta_title', 'Warung Mak Kei – Frozen Food Berkualitas'))

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FoodEstablishment",
    "name": "{{ setting('nama_toko', 'Warung Mak Kei') }}",
    "description": "{{ setting('deskripsi_toko') }}",
    "url": "{{ url('/') }}",
    "telephone": "+{{ setting('nomor_whatsapp') }}",
    "address": { "@type": "PostalAddress", "addressLocality": "Tangerang Selatan", "addressCountry": "ID" },
    "openingHours": "Mo-Su {{ setting('jam_buka') }}-{{ setting('jam_tutup') }}"
}
</script>
@endsection

@section('content')

{{-- ══════════════════════════════════════════════════════════
     HERO / BANNER SLIDER
════════════════════════════════════════════════════════════ --}}
<section x-data="{ current: 0, total: {{ $banners->count() ?: 1 }}, timer: null }"
         x-init="timer = setInterval(() => current = (current + 1) % total, 5000)"
         class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-green-800 min-h-[520px] lg:min-h-[600px] flex items-center">

    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"40\" height=\"40\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"20\" cy=\"20\" r=\"3\" fill=\"white\"/></svg>'); background-size: 40px 40px;"></div>
    </div>

    @if($banners->count() > 0)
        @foreach($banners as $i => $banner)
        <div x-show="current === {{ $i }}"
             x-transition:enter="transition ease-in-out duration-700"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-white">
                        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-1.5 rounded-full text-sm font-medium mb-6">
                            🔥 Promo Spesial Warung Mak Kei
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight mb-4">{{ $banner->judul }}</h1>
                        <p class="text-primary-100 text-lg leading-relaxed mb-8">{{ $banner->deskripsi }}</p>
                        @if($banner->link && $banner->teks_tombol)
                        <a href="{{ $banner->link }}"
                           class="inline-flex items-center gap-2 bg-white text-primary-700 hover:bg-primary-50 font-bold px-8 py-4 rounded-2xl text-base shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-0.5">
                            {{ $banner->teks_tombol }}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                    <div class="hidden lg:flex justify-center">
                        <div class="relative w-80 h-80">
                            <div class="absolute inset-0 bg-white/10 rounded-[3rem] rotate-6"></div>
                            <div class="absolute inset-0 bg-white/10 rounded-[3rem] -rotate-3"></div>
                            <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul }}"
                                 class="relative w-full h-full object-cover rounded-[2.5rem] shadow-2xl"
                                 loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Dots indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2 z-10">
            @foreach($banners as $i => $banner)
            <button @click="current = {{ $i }}; clearInterval(timer); timer = setInterval(() => current = (current + 1) % total, 5000)"
                    :class="current === {{ $i }} ? 'w-8 bg-white' : 'w-2.5 bg-white/50'"
                    class="h-2.5 rounded-full transition-all duration-300"></button>
            @endforeach
        </div>
    @else
        {{-- Default hero bila tidak ada banner --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-white text-center py-20">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-1.5 rounded-full text-sm font-medium mb-6">🍱 Frozen Food Premium</div>
            <h1 class="text-4xl lg:text-6xl font-black mb-6">Frozen Food Berkualitas,<br><span class="text-yellow-300">Praktis dan Lezat</span></h1>
            <p class="text-xl text-primary-100 mb-10 max-w-2xl mx-auto">{{ setting('deskripsi_toko', 'Warung Mak Kei menyediakan berbagai frozen food dan camilan berkualitas dengan harga terjangkau.') }}</p>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 bg-white text-primary-700 font-bold px-8 py-4 rounded-2xl text-lg shadow-xl hover:shadow-2xl transition-all hover:-translate-y-0.5">
                Belanja Sekarang <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    @endif
</section>

{{-- ══════════════════════════════════════════════════════════
     KATEGORI STRIP
════════════════════════════════════════════════════════════ --}}
<section class="py-12 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black text-gray-900 dark:text-white">Belanja per Kategori</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-primary-600 dark:text-primary-400 font-semibold hover:underline">Lihat Semua →</a>
        </div>
        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-3 lg:gap-4">
            @foreach($categories as $category)
            <a href="{{ route('products.index', ['kategori' => $category->slug]) }}"
               class="group flex flex-col items-center gap-2.5 p-4 bg-gray-50 dark:bg-gray-800 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-2xl transition-all duration-200 hover:-translate-y-1 hover:shadow-lg border border-transparent hover:border-primary-200 dark:hover:border-primary-700">
                <span class="text-3xl lg:text-4xl leading-none">{{ $category->icon }}</span>
                <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-primary-700 dark:group-hover:text-primary-400 text-center leading-tight">{{ $category->nama_kategori }}</span>
                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $category->products_count }} produk</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     PRODUK UNGGULAN
════════════════════════════════════════════════════════════ --}}
@if($produk_unggulan->count() > 0)
<section class="py-16 bg-gray-50 dark:bg-gray-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="inline-block bg-primary-100 dark:bg-primary-900/50 text-primary-700 dark:text-primary-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">⭐ Pilihan Terbaik</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Produk Unggulan</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Produk pilihan kami yang paling diminati pelanggan</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($produk_unggulan as $produk)
                @include('components.public.product-card', ['product' => $produk])
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('products.index', ['filter' => 'unggulan']) }}"
               class="inline-flex items-center gap-2 border-2 border-primary-600 text-primary-600 dark:text-primary-400 dark:border-primary-400 hover:bg-primary-600 hover:text-white dark:hover:bg-primary-600 dark:hover:text-white font-bold px-8 py-3 rounded-2xl transition-all duration-200">
                Lihat Semua Produk Unggulan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════
     KEUNGGULAN TOKO
════════════════════════════════════════════════════════════ --}}
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block bg-accent-100 dark:bg-accent-900/30 text-accent-700 dark:text-accent-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">🏆 Mengapa Kami</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Keunggulan Warung Mak Kei</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon' => '🧊', 'title' => 'Produk Beku Segar', 'desc' => 'Semua produk disimpan pada suhu ideal -18°C untuk menjaga kesegaran dan kualitas terbaik.'],
                ['icon' => '✅', 'title' => 'Tanpa Pengawet Berbahaya', 'desc' => 'Bebas bahan pengawet berbahaya. Aman untuk seluruh keluarga termasuk anak-anak.'],
                ['icon' => '🚚', 'title' => 'Pengiriman Aman', 'desc' => 'Dikemas dengan es batu/dry ice agar produk tetap beku dan sampai dalam kondisi sempurna.'],
                ['icon' => '💬', 'title' => 'Respon Cepat 24 Jam', 'desc' => 'Tim kami siap membantu Anda kapan saja via WhatsApp, Tokopedia, maupun Shopee.'],
            ] as $item)
            <div class="group p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border border-transparent hover:border-primary-100 dark:hover:border-primary-800">
                <div class="text-4xl mb-4">{{ $item['icon'] }}</div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-700 dark:group-hover:text-primary-400">{{ $item['title'] }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     PRODUK TERLARIS
════════════════════════════════════════════════════════════ --}}
@if($produk_terlaris->count() > 0)
<section class="py-16 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800/50 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="inline-block bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">🔥 Terlaris</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Produk Terlaris</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Paling banyak dipesan dan disukai pelanggan kami</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach($produk_terlaris as $produk)
                @include('components.public.product-card', ['product' => $produk])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════
     PROMO BANNER
════════════════════════════════════════════════════════════ --}}
@if($produk_promo->count() > 0)
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-accent-500 to-red-600 rounded-3xl overflow-hidden p-8 lg:p-12 relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="relative z-10">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="text-white">
                        <span class="inline-block bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium mb-4">🏷️ Penawaran Spesial</span>
                        <h2 class="text-3xl font-black mb-3">Produk Promo Hari Ini!</h2>
                        <p class="text-red-100 text-lg">Hemat lebih banyak dengan harga diskon spesial.</p>
                    </div>
                    <a href="{{ route('products.index', ['filter' => 'promo']) }}"
                       class="flex-shrink-0 inline-flex items-center gap-2 bg-white text-accent-600 hover:bg-red-50 font-bold px-8 py-4 rounded-2xl shadow-xl hover:shadow-2xl transition-all hover:-translate-y-0.5">
                        Lihat Semua Promo
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mt-8">
                    @foreach($produk_promo as $produk)
                    <a href="{{ $produk->url }}" class="bg-white/10 backdrop-blur-sm hover:bg-white/20 rounded-2xl p-3 transition group">
                        <img src="{{ $produk->gambar_utama_url }}" alt="{{ $produk->nama_produk }}"
                             class="w-full h-32 object-cover rounded-xl mb-2 group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        <p class="text-white text-xs font-semibold truncate">{{ $produk->nama_produk }}</p>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="text-yellow-300 text-sm font-bold">{{ $produk->harga_diskon_format }}</span>
                            <span class="text-red-200 text-xs line-through">{{ $produk->harga_format }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════
     TESTIMONI
════════════════════════════════════════════════════════════ --}}
@if($testimonials->count() > 0)
<section class="py-16 bg-gray-50 dark:bg-gray-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">⭐ Testimoni</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Kata Pelanggan Kami</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Ribuan pelanggan sudah mempercayai Warung Mak Kei</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimoni)
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                {{-- Stars --}}
                <div class="flex gap-0.5 mb-4">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $testimoni->rating ? 'text-yellow-400' : 'text-gray-200 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-5 italic">"{{ $testimoni->isi_testimoni }}"</p>
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <img src="{{ $testimoni->foto_url }}" alt="{{ $testimoni->nama }}"
                         class="w-10 h-10 rounded-full object-cover" loading="lazy">
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $testimoni->nama }}</p>
                        @if($testimoni->asal)
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $testimoni->asal }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════
     FAQ
════════════════════════════════════════════════════════════ --}}
@if($faqs->count() > 0)
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">❓ FAQ</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Pertanyaan Umum</h2>
        </div>
        <div class="space-y-3" x-data="{ openFaq: null }">
            @foreach($faqs as $i => $faq)
            <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <button @click="openFaq = openFaq === {{ $i }} ? null : {{ $i }}"
                        class="w-full flex items-center justify-between gap-4 px-6 py-4 text-left">
                    <span class="font-semibold text-gray-900 dark:text-white text-sm lg:text-base">{{ $faq->pertanyaan }}</span>
                    <svg :class="openFaq === {{ $i }} ? 'rotate-180 text-primary-600' : 'text-gray-400'"
                         class="w-5 h-5 flex-shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="openFaq === {{ $i }}" x-collapse x-cloak>
                    <div class="px-6 pb-5 text-sm text-gray-600 dark:text-gray-300 leading-relaxed border-t border-gray-100 dark:border-gray-700 pt-4">
                        {!! nl2br(e($faq->jawaban)) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════
     CTA SECTION
════════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-gradient-to-br from-primary-700 via-primary-800 to-green-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-black text-white mb-5">Siap Memesan? 🛒</h2>
        <p class="text-primary-100 text-lg mb-10 max-w-xl mx-auto">Dapatkan frozen food berkualitas langsung ke pintu rumah Anda. Pesan sekarang via WhatsApp atau platform belanja favorit Anda!</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ whatsapp_url('Halo Warung Mak Kei, saya ingin memesan produk.') }}" target="_blank"
               class="inline-flex items-center gap-2.5 bg-green-500 hover:bg-green-400 text-white font-bold px-7 py-4 rounded-2xl text-base shadow-xl hover:shadow-2xl transition-all hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                Pesan via WhatsApp
            </a>
            @if(setting('link_tokopedia'))
            <a href="{{ setting('link_tokopedia') }}" target="_blank"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-bold px-7 py-4 rounded-2xl text-base border border-white/20 transition-all hover:-translate-y-0.5">
                🛒 Beli di Tokopedia
            </a>
            @endif
            @if(setting('link_shopee'))
            <a href="{{ setting('link_shopee') }}" target="_blank"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-bold px-7 py-4 rounded-2xl text-base border border-white/20 transition-all hover:-translate-y-0.5">
                🛍️ Beli di Shopee
            </a>
            @endif
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Alpine x-collapse plugin minimal
    document.addEventListener('alpine:init', () => {
        Alpine.directive('collapse', (el, { modifiers, expression }, { effect, evaluate }) => {
            effect(() => {
                const show = evaluate(expression);
                if (show) {
                    el.style.display = '';
                    el.style.overflow = 'hidden';
                    const height = el.scrollHeight;
                    el.style.height = '0px';
                    requestAnimationFrame(() => {
                        el.style.transition = 'height 0.3s ease';
                        el.style.height = height + 'px';
                        setTimeout(() => { el.style.height = ''; el.style.overflow = ''; }, 300);
                    });
                } else {
                    el.style.overflow = 'hidden';
                    el.style.height = el.scrollHeight + 'px';
                    requestAnimationFrame(() => {
                        el.style.transition = 'height 0.3s ease';
                        el.style.height = '0px';
                        setTimeout(() => { el.style.display = 'none'; }, 300);
                    });
                }
            });
        });
    });
</script>
@endpush
