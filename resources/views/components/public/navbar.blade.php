<nav x-data="{
        mobileMenu: false,
        searchOpen: false,
        searchQuery: '',
        searchResults: [],
        searching: false,
        wishlistCount: {{ count(session('wishlist', [])) }},

        async doSearch() {
            if (this.searchQuery.length < 2) { this.searchResults = []; return; }
            this.searching = true;
            try {
                const res = await fetch(`/products/search?q=${encodeURIComponent(this.searchQuery)}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                this.searchResults = data.products || [];
            } catch(e) { this.searchResults = []; }
            finally { this.searching = false; }
        }
     }"
     class="sticky top-0 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-md">
                    <span class="text-white font-black text-sm">MK</span>
                </div>
                <div class="hidden sm:block">
                    <p class="font-bold text-gray-900 dark:text-white text-sm leading-tight">Warung Mak Kei</p>
                    <p class="text-xs text-primary-600 dark:text-primary-400 font-medium">Frozen Food</p>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'home',            'label' => 'Beranda'],
                        ['route' => 'products.index',  'label' => 'Produk'],
                        ['route' => 'about',           'label' => 'Tentang Kami'],
                        ['route' => 'contact.index',   'label' => 'Kontak'],
                    ];
                @endphp
                @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-150
                          {{ request()->routeIs($link['route']) ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                    {{ $link['label'] }}
                </a>
                @endforeach
            </div>

            {{-- Right Actions --}}
            <div class="flex items-center gap-2">

                {{-- Search Button --}}
                <button @click="searchOpen = !searchOpen"
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                {{-- Wishlist --}}
                <a href="{{ route('wishlist.index') }}"
                   class="relative p-2 text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    @if(count(session('wishlist', [])) > 0)
                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">
                        {{ count(session('wishlist', [])) }}
                    </span>
                    @endif
                </a>

                {{-- Dark Mode --}}
                <button @click="darkMode = !darkMode"
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenu = !mobileMenu"
                        class="lg:hidden p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition">
                    <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenu" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Search Bar Dropdown --}}
        <div x-show="searchOpen" x-cloak x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             class="pb-4 relative" @click.outside="searchOpen = false; searchResults = []">
            <div class="relative">
                <input type="text"
                       x-model="searchQuery"
                       @input.debounce.300ms="doSearch()"
                       @keydown.escape="searchOpen = false; searchResults = []"
                       placeholder="Cari produk..."
                       autofocus
                       class="w-full px-4 py-3 pl-11 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition dark:text-white dark:placeholder-gray-400">
                <svg class="absolute left-3.5 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <div x-show="searching" x-cloak class="absolute right-3.5 top-3.5">
                    <div class="w-4 h-4 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </div>

            {{-- Search Results --}}
            <div x-show="searchResults.length > 0" x-cloak
                 class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50">
                <template x-for="product in searchResults" :key="product.id">
                    <a :href="product.url"
                       class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <img :src="product.gambar_url" :alt="product.nama_produk"
                             class="w-12 h-12 rounded-xl object-cover flex-shrink-0 bg-gray-100">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate" x-text="product.nama_produk"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="product.category_name"></p>
                        </div>
                        <div class="ml-auto flex-shrink-0 text-right">
                            <p class="text-sm font-bold text-primary-600 dark:text-primary-400" x-text="product.is_promo ? product.harga_diskon_format : product.harga_format"></p>
                            <span x-show="product.is_promo" class="text-xs bg-accent-500 text-white px-1.5 py-0.5 rounded-full font-medium">Promo</span>
                        </div>
                    </a>
                </template>
                <a href="{{ route('products.index') }}"
                   @click="searchOpen=false"
                   class="block text-center text-sm text-primary-600 dark:text-primary-400 font-semibold py-3 border-t border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Lihat semua hasil →
                </a>
            </div>

            {{-- No results --}}
            <div x-show="!searching && searchQuery.length >= 2 && searchResults.length === 0" x-cloak
                 class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 px-4 py-6 text-center z-50">
                <p class="text-gray-500 dark:text-gray-400 text-sm">Produk tidak ditemukan 😔</p>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenu" x-cloak x-transition class="lg:hidden pb-4 border-t border-gray-100 dark:border-gray-800 pt-4 space-y-1">
            @foreach($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="block px-4 py-2.5 rounded-xl text-sm font-semibold
                      {{ request()->routeIs($link['route']) ? 'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                {{ $link['label'] }}
            </a>
            @endforeach
        </div>
    </div>
</nav>
