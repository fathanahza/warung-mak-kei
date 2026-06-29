@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.products.index') }}"
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-black text-gray-900 dark:text-white">Tambah Produk Baru</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Lengkapi semua informasi produk</p>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column (main info) --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Info Dasar --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">📋 Informasi Dasar</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('nama_produk') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition"
                                   placeholder="cth: Bakso Sapi Premium Jumbo">
                            @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                            <select name="category_id" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('category_id') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->icon }} {{ $cat->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" rows="6" required
                                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('deskripsi') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white dark:placeholder-gray-400 transition resize-none"
                                      placeholder="Deskripsi lengkap produk...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Berat</label>
                                <input type="text" name="berat" value="{{ old('berat') }}"
                                       placeholder="cth: 500g, 1kg"
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Isi Produk</label>
                                <input type="text" name="isi_produk" value="{{ old('isi_produk') }}"
                                       placeholder="cth: 20 pcs, 1 pack"
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Harga & Stok --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">💰 Harga & Stok</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Harga Normal <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-3.5 text-gray-400 text-sm font-medium">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga') }}" required min="0"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('harga') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition"
                                       placeholder="0">
                            </div>
                            @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Harga Diskon</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-3.5 text-gray-400 text-sm font-medium">Rp</span>
                                <input type="number" name="harga_diskon" value="{{ old('harga_diskon') }}" min="0"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition"
                                       placeholder="Kosongkan jika tidak ada">
                            </div>
                            @error('harga_diskon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stok" value="{{ old('stok', 0) }}" required min="0"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('stok') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Link Platform --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">🛒 Link Platform Belanja</h3>
                    <div class="space-y-4">
                        @foreach([['name' => 'link_tokopedia', 'label' => '🛒 Tokopedia', 'placeholder' => 'https://tokopedia.com/toko/produk'], ['name' => 'link_shopee', 'label' => '🛍️ Shopee', 'placeholder' => 'https://shopee.co.id/toko/produk'], ['name' => 'link_gofood', 'label' => '🍱 GoFood', 'placeholder' => 'https://gofood.co.id/...'] ] as $link)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">{{ $link['label'] }}</label>
                            <input type="url" name="{{ $link['name'] }}" value="{{ old($link['name']) }}"
                                   placeholder="{{ $link['placeholder'] }}"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error($link['name']) border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white dark:placeholder-gray-400 transition">
                            @error($link['name']) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- SEO --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">🔍 SEO (Opsional)</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" maxlength="100"
                                   placeholder="Judul halaman untuk mesin pencari"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Meta Description</label>
                            <textarea name="meta_description" rows="2" maxlength="300"
                                      placeholder="Deskripsi singkat untuk mesin pencari (maks 300 karakter)"
                                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white dark:placeholder-gray-400 transition resize-none">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column (gambar & settings) --}}
            <div class="space-y-5">

                {{-- Gambar Utama --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
                     x-data="{ preview: null }">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">🖼️ Gambar Utama</h3>
                    <div class="space-y-3">
                        <label class="block w-full cursor-pointer">
                            <div x-show="!preview"
                                 class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-primary-400 dark:hover:border-primary-500 transition">
                                <div class="text-4xl mb-2">📷</div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Klik untuk upload gambar</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP · Maks 2MB</p>
                            </div>
                            <img x-show="preview" x-cloak :src="preview"
                                 class="w-full aspect-square object-cover rounded-2xl mb-2">
                            <input type="file" name="gambar_utama" accept="image/*" class="hidden"
                                   @change="preview = URL.createObjectURL($event.target.files[0])">
                        </label>
                        @if(isset($product) && $product->gambar_utama)
                        <img src="{{ $product->gambar_utama_url }}" class="w-full aspect-square object-cover rounded-2xl">
                        @endif
                    </div>
                </div>

                {{-- Galeri Gambar --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 pb-3 border-b border-gray-100 dark:border-gray-700">🖼️ Galeri Gambar</h3>
                    <p class="text-xs text-gray-400 mb-3">Upload beberapa gambar (maks 10 file, 2MB/file)</p>
                    <label class="block w-full cursor-pointer border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-2xl p-6 text-center hover:border-primary-400 dark:hover:border-primary-500 transition">
                        <div class="text-3xl mb-2">📸</div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Pilih beberapa gambar</p>
                        <input type="file" name="galeri_gambar[]" accept="image/*" multiple class="hidden">
                    </label>
                </div>

                {{-- Settings & Badges --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">⚙️ Pengaturan</h3>
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'is_active',      'label' => 'Produk Aktif',    'desc' => 'Tampilkan di halaman produk', 'default' => true],
                            ['name' => 'is_featured',    'label' => '⭐ Produk Unggulan', 'desc' => 'Tampilkan di halaman beranda', 'default' => false],
                            ['name' => 'is_best_seller', 'label' => '🔥 Best Seller',  'desc' => 'Tampilkan badge best seller', 'default' => false],
                        ] as $toggle)
                        <label class="flex items-center justify-between gap-3 cursor-pointer">
                            <div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $toggle['label'] }}</p>
                                <p class="text-xs text-gray-400">{{ $toggle['desc'] }}</p>
                            </div>
                            <div class="relative flex-shrink-0" x-data="{ checked: {{ old($toggle['name'], $toggle['default']) ? 'true' : 'false' }} }">
                                <input type="hidden" name="{{ $toggle['name'] }}" :value="checked ? '1' : '0'">
                                <button type="button" @click="checked = !checked"
                                        :class="checked ? 'bg-primary-600' : 'bg-gray-200 dark:bg-gray-600'"
                                        class="w-11 h-6 rounded-full transition-colors duration-200 relative">
                                    <span :class="checked ? 'translate-x-5' : 'translate-x-1'"
                                          class="absolute top-1 left-0 w-4 h-4 bg-white rounded-full shadow-sm transition-transform duration-200"></span>
                                </button>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.products.index') }}"
                       class="flex-1 text-center py-3 border-2 border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm hover:shadow-md">
                        Simpan Produk
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
