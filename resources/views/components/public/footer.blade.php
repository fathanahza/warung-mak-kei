<footer class="bg-gray-900 dark:bg-gray-950 text-gray-300">

    {{-- Newsletter Strip --}}
    <div class="bg-gradient-to-r from-primary-600 to-primary-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-xl font-bold text-white">Dapatkan Info Promo Terbaru! 🎉</h3>
                    <p class="text-primary-100 text-sm mt-1">Daftar newsletter dan jangan lewatkan penawaran spesial kami.</p>
                </div>
                <form action="{{ route('newsletter.subscribe') }}" method="POST"
                      class="flex w-full md:w-auto gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="Masukkan email kamu..."
                           required
                           class="flex-1 md:w-72 px-4 py-3 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-white outline-none">
                    <button type="submit"
                            class="px-5 py-3 bg-white hover:bg-gray-100 text-primary-700 font-bold rounded-xl text-sm transition whitespace-nowrap shadow-lg">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center">
                        <span class="text-white font-black">MK</span>
                    </div>
                    <div>
                        <p class="font-bold text-white text-base">Warung Mak Kei</p>
                        <p class="text-xs text-primary-400">Frozen Food & Camilan</p>
                    </div>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed mb-5">
                    {{ setting('deskripsi_toko', 'Menyediakan berbagai frozen food dan camilan berkualitas dengan harga terjangkau.') }}
                </p>
                {{-- Social Media --}}
                <div class="flex items-center gap-3">
                    @if(setting('instagram'))
                    <a href="https://instagram.com/{{ ltrim(setting('instagram'), '@') }}" target="_blank"
                       class="w-9 h-9 bg-gray-800 hover:bg-pink-600 rounded-xl flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    @endif
                    <a href="{{ whatsapp_url('Halo Warung Mak Kei!') }}" target="_blank"
                       class="w-9 h-9 bg-gray-800 hover:bg-green-600 rounded-xl flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Menu</h4>
                <ul class="space-y-2.5">
                    @foreach([['route' => 'home','label' => 'Beranda'],['route' => 'products.index','label' => 'Semua Produk'],['route' => 'about','label' => 'Tentang Kami'],['route' => 'contact.index','label' => 'Kontak'],['route' => 'wishlist.index','label' => '❤️ Favorit Saya']] as $link)
                    <li><a href="{{ route($link['route']) }}" class="text-sm text-gray-400 hover:text-primary-400 transition">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Kategori --}}
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Kategori</h4>
                <ul class="space-y-2.5">
                    @foreach(\App\Models\Category::active()->take(6)->get() as $cat)
                    <li>
                        <a href="{{ route('products.index', ['kategori' => $cat->slug]) }}"
                           class="text-sm text-gray-400 hover:text-primary-400 transition flex items-center gap-1.5">
                            <span>{{ $cat->icon }}</span> {{ $cat->nama_kategori }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Hubungi Kami</h4>
                <ul class="space-y-3.5 text-sm text-gray-400">
                    <li class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ setting('alamat', 'Tangerang Selatan, Banten') }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="{{ whatsapp_url() }}" class="hover:text-primary-400 transition">{{ setting('nomor_whatsapp') }}</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ setting('email') }}" class="hover:text-primary-400 transition">{{ setting('email') }}</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p>{{ setting('hari_operasional', 'Senin – Minggu') }}</p>
                            <p>{{ setting('jam_buka', '08:00') }} – {{ setting('jam_tutup', '21:00') }} WIB</p>
                        </div>
                    </li>
                </ul>

                {{-- Platform Links --}}
                <div class="mt-5 flex flex-wrap gap-2">
                    @if(setting('link_tokopedia'))
                    <a href="{{ setting('link_tokopedia') }}" target="_blank"
                       class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1">
                        🛒 Tokopedia
                    </a>
                    @endif
                    @if(setting('link_shopee'))
                    <a href="{{ setting('link_shopee') }}" target="_blank"
                       class="px-3 py-1.5 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1">
                        🛍️ Shopee
                    </a>
                    @endif
                    @if(setting('link_gofood'))
                    <a href="{{ setting('link_gofood') }}" target="_blank"
                       class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition flex items-center gap-1">
                        🍱 GoFood
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-gray-800 py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
            <p>© {{ date('Y') }} <span class="text-primary-500 font-semibold">Warung Mak Kei</span>. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-4">
                <span>Dibuat dengan ❤️ untuk keluarga Indonesia</span>
            </div>
        </div>
    </div>
</footer>
