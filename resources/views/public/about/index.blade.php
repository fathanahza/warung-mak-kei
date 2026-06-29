@extends('layouts.app')

@section('title', 'Tentang Kami – Warung Mak Kei')
@section('meta_description', 'Kenali lebih dekat Warung Mak Kei, toko frozen food berkualitas yang melayani keluarga Indonesia dengan produk segar dan terpercaya.')

@section('content')

{{-- Hero --}}
<div class="bg-gradient-to-br from-primary-700 to-green-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-white/20 backdrop-blur-sm px-4 py-1.5 rounded-full text-white text-sm font-medium mb-4">🏠 Tentang Kami</span>
        <h1 class="text-4xl lg:text-5xl font-black text-white mb-5">Warung Mak Kei</h1>
        <p class="text-primary-100 text-xl max-w-2xl mx-auto">Menyediakan frozen food dan camilan berkualitas untuk keluarga Indonesia sejak 2019.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Sejarah --}}
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
        <div>
            <span class="inline-block bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-4">📖 Sejarah Kami</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-5">Bermula dari Dapur Rumahan</h2>
            <div class="space-y-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                <p>Warung Mak Kei lahir dari kegemaran Mak Kei dalam memasak dan menyajikan hidangan lezat untuk keluarga. Berawal dari dapur kecil di Tangerang Selatan pada tahun 2019, usaha ini dimulai dengan semangat menyediakan frozen food berkualitas tinggi dengan harga yang terjangkau.</p>
                <p>Dalam waktu singkat, produk-produk Warung Mak Kei mendapat sambutan hangat dari tetangga dan kerabat. Kualitas bahan baku yang dipilih dengan cermat dan proses produksi yang higienis menjadi fondasi kepercayaan pelanggan kami.</p>
                <p>Kini, Warung Mak Kei telah melayani ribuan pelanggan setia di seluruh Indonesia melalui berbagai platform belanja online maupun pemesanan langsung via WhatsApp.</p>
            </div>
        </div>
        <div class="relative">
            <div class="bg-gradient-to-br from-primary-100 to-green-50 dark:from-primary-900/30 dark:to-green-900/20 rounded-3xl p-8 lg:p-12 text-center">
                <div class="text-8xl mb-4">🏠</div>
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">Berdiri Sejak 2019</h3>
                <p class="text-gray-600 dark:text-gray-300">Melayani keluarga Indonesia dengan penuh cinta</p>
                <div class="grid grid-cols-3 gap-4 mt-8">
                    @foreach([['angka' => '5+', 'label' => 'Tahun'], ['angka' => '1000+', 'label' => 'Pelanggan'], ['angka' => '20+', 'label' => 'Produk']] as $stat)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm">
                        <p class="text-2xl font-black text-primary-600 dark:text-primary-400">{{ $stat['angka'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $stat['label'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-20">
        <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-8 text-white">
            <div class="text-4xl mb-4">🎯</div>
            <h3 class="text-2xl font-black mb-4">Visi Kami</h3>
            <p class="text-primary-100 leading-relaxed">Menjadi toko frozen food terpercaya yang menyediakan produk berkualitas tinggi, higienis, dan terjangkau untuk setiap keluarga Indonesia dari Sabang sampai Merauke.</p>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 border border-gray-100 dark:border-gray-700">
            <div class="text-4xl mb-4">🚀</div>
            <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Misi Kami</h3>
            <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                @foreach([
                    'Menyediakan produk frozen food dari bahan baku pilihan berkualitas tinggi',
                    'Menjaga standar higienitas dan keamanan pangan dalam setiap proses produksi',
                    'Memberikan harga yang terjangkau tanpa mengorbankan kualitas',
                    'Melayani pelanggan dengan ramah, cepat, dan profesional',
                    'Terus berinovasi menghadirkan produk baru yang lezat dan bergizi',
                ] as $misi)
                <li class="flex items-start gap-2.5">
                    <span class="text-primary-600 dark:text-primary-400 font-black mt-0.5">✓</span>
                    <span class="text-sm">{{ $misi }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Keunggulan --}}
    <section class="mb-20">
        <div class="text-center mb-12">
            <span class="inline-block bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">💪 Keunggulan</span>
            <h2 class="text-3xl font-black text-gray-900 dark:text-white">Mengapa Memilih Warung Mak Kei?</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🧊', 'title' => 'Suhu Terjaga', 'desc' => 'Produk disimpan pada suhu -18°C sejak produksi hingga pengiriman menggunakan dry ice premium.'],
                ['icon' => '🌿', 'title' => 'Bahan Alami', 'desc' => 'Menggunakan bahan baku segar pilihan dari pemasok terpercaya tanpa pengawet berbahaya.'],
                ['icon' => '🏆', 'title' => 'Sertifikat Halal', 'desc' => 'Seluruh produk kami diproduksi secara halal sesuai standar MUI Indonesia.'],
                ['icon' => '📦', 'title' => 'Packing Aman', 'desc' => 'Kemasan vakum berlapis untuk menjaga kualitas produk dari kontaminasi dan kerusakan.'],
                ['icon' => '⚡', 'title' => 'Respon Cepat', 'desc' => 'Tim customer service kami merespon pesanan dan pertanyaan dalam waktu kurang dari 15 menit.'],
                ['icon' => '💝', 'title' => 'Garansi Kepuasan', 'desc' => 'Tidak puas? Kami siap mengganti atau refund produk yang tidak sesuai ekspektasi Anda.'],
            ] as $item)
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
                <div class="text-4xl mb-4">{{ $item['icon'] }}</div>
                <h3 class="font-black text-gray-900 dark:text-white mb-2">{{ $item['title'] }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gradient-to-r from-primary-600 to-green-700 rounded-3xl p-10 text-center text-white">
        <h2 class="text-3xl font-black mb-4">Tertarik Bekerja Sama? 🤝</h2>
        <p class="text-primary-100 mb-8 max-w-xl mx-auto">Kami terbuka untuk kerjasama reseller, agen, dan mitra bisnis. Hubungi kami sekarang!</p>
        <a href="{{ route('contact.index') }}"
           class="inline-flex items-center gap-2 bg-white text-primary-700 hover:bg-primary-50 font-bold px-8 py-4 rounded-2xl transition-all hover:-translate-y-0.5 shadow-xl">
            Hubungi Kami →
        </a>
    </section>
</div>

@endsection
