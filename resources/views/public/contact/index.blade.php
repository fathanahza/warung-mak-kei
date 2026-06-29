@extends('layouts.app')

@section('title', 'Kontak – Warung Mak Kei')
@section('meta_description', 'Hubungi Warung Mak Kei via WhatsApp, email, atau form kontak. Kami siap melayani Anda.')

@section('content')

{{-- Header --}}
<div class="bg-gradient-to-br from-primary-700 to-green-900 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-white/20 px-4 py-1.5 rounded-full text-white text-sm font-medium mb-4">📞 Kontak</span>
        <h1 class="text-4xl font-black text-white mb-3">Hubungi Kami</h1>
        <p class="text-primary-100 text-lg">Kami siap membantu Anda kapan saja!</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- ── INFO KONTAK ───────────────────────── --}}
        <div class="lg:col-span-1 space-y-5">

            {{-- WhatsApp (Primary CTA) --}}
            <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-2xl p-6 text-white">
                <div class="text-3xl mb-3">💬</div>
                <h3 class="font-black text-lg mb-1">WhatsApp</h3>
                <p class="text-green-100 text-sm mb-4">Respon tercepat! Biasanya balas dalam 15 menit.</p>
                <a href="{{ whatsapp_url('Halo Warung Mak Kei, saya ingin bertanya tentang produk Anda.') }}"
                   target="_blank"
                   @click="fetch('/contact/whatsapp-click', { method:'POST', headers:{'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content, 'Content-Type':'application/json'}, body: JSON.stringify({sumber:'kontak'}) })"
                   class="inline-flex items-center gap-2 bg-white text-green-700 font-bold px-5 py-2.5 rounded-xl text-sm hover:bg-green-50 transition shadow-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Chat Sekarang
                </a>
            </div>

            {{-- Info Cards --}}
            @foreach([
                ['icon' => '📧', 'title' => 'Email', 'val' => setting('email', 'warungmakkei@gmail.com'), 'link' => 'mailto:'.setting('email'), 'sub' => 'Balas dalam 1x24 jam'],
                ['icon' => '📍', 'title' => 'Alamat', 'val' => setting('alamat', 'Tangerang Selatan, Banten'), 'link' => null, 'sub' => 'Kunjungi toko kami'],
                ['icon' => '🕐', 'title' => 'Jam Operasional', 'val' => setting('hari_operasional', 'Senin–Minggu').' · '.setting('jam_buka','08:00').'–'.setting('jam_tutup','21:00').' WIB', 'link' => null, 'sub' => 'Kami siap melayani Anda'],
                ['icon' => '📸', 'title' => 'Instagram', 'val' => setting('instagram', '@warungmakkei'), 'link' => 'https://instagram.com/'.ltrim(setting('instagram','warungmakkei'),'@'), 'sub' => 'Follow untuk promo terbaru'],
            ] as $info)
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 flex items-start gap-4">
                <div class="text-2xl mt-0.5">{{ $info['icon'] }}</div>
                <div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 font-medium uppercase tracking-wide mb-0.5">{{ $info['title'] }}</p>
                    @if($info['link'])
                    <a href="{{ $info['link'] }}" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:underline">{{ $info['val'] }}</a>
                    @else
                    <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $info['val'] }}</p>
                    @endif
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $info['sub'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ── FORM & MAP ─────────────────────────── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Form Kontak --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 lg:p-8 border border-gray-100 dark:border-gray-700 shadow-sm">
                <h2 class="text-xl font-black text-gray-900 dark:text-white mb-6">Kirim Pesan</h2>

                @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-2xl px-5 py-4 mb-6 flex items-start gap-3">
                    <span class="text-green-500 text-xl">✅</span>
                    <p class="text-green-700 dark:text-green-400 text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                   placeholder="Masukkan nama Anda"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('nama') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none dark:text-white dark:placeholder-gray-400 transition">
                            @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   placeholder="email@contoh.com"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('email') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none dark:text-white dark:placeholder-gray-400 transition">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">No. HP / WhatsApp</label>
                        <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}"
                               placeholder="08xxxxxxxxxx"
                               class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none dark:text-white dark:placeholder-gray-400 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Pesan <span class="text-red-500">*</span></label>
                        <textarea name="pesan" rows="5" required
                                  placeholder="Tulis pesan Anda di sini..."
                                  class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('pesan') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none dark:text-white dark:placeholder-gray-400 transition resize-none">{{ old('pesan') }}</textarea>
                        @error('pesan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit"
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 rounded-2xl text-base transition-all hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                        Kirim Pesan 📨
                    </button>
                </form>
            </div>

            {{-- Google Maps --}}
            @if(setting('google_maps_embed'))
            <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        📍 Lokasi Toko
                    </h3>
                </div>
                <div class="relative h-64">
                    <iframe src="{{ setting('google_maps_embed') }}"
                            width="100%" height="100%"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full">
                    </iframe>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
