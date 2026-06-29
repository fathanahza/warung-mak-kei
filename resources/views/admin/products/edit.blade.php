@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.products.index') }}"
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-black text-gray-900 dark:text-white">Edit Produk</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $product->nama_produk }}</p>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: Info --}}
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">📋 Informasi Dasar</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('nama_produk') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                            <select name="category_id" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->icon }} {{ $cat->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" rows="6" required
                                      class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition resize-none">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Berat</label>
                                <input type="text" name="berat" value="{{ old('berat', $product->berat) }}"
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Isi Produk</label>
                                <input type="text" name="isi_produk" value="{{ old('isi_produk', $product->isi_produk) }}"
                                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Harga & Stok --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">💰 Harga & Stok</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Harga Normal <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-3.5 text-gray-400 text-sm">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga', $product->harga) }}" required min="0"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Harga Diskon</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-3.5 text-gray-400 text-sm">Rp</span>
                                <input type="number" name="harga_diskon" value="{{ old('harga_diskon', $product->harga_diskon) }}" min="0"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stok" value="{{ old('stok', $product->stok) }}" required min="0"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                        </div>
                    </div>
                </div>

                {{-- Link Platform --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">🛒 Link Platform Belanja</h3>
                    <div class="space-y-4">
                        @foreach([['name' => 'link_tokopedia', 'label' => '🛒 Tokopedia'], ['name' => 'link_shopee', 'label' => '🛍️ Shopee'], ['name' => 'link_gofood', 'label' => '🍱 GoFood']] as $link)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">{{ $link['label'] }}</label>
                            <input type="url" name="{{ $link['name'] }}" value="{{ old($link['name'], $product->{$link['name']}) }}"
                                   class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right: Media & Settings --}}
            <div class="space-y-5">

                {{-- Gambar Utama Sekarang --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm"
                     x-data="{ preview: null }">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 pb-3 border-b border-gray-100 dark:border-gray-700">🖼️ Gambar Utama</h3>
                    {{-- Current --}}
                    <img :src="preview || '{{ $product->gambar_utama_url }}'"
                         class="w-full aspect-square object-cover rounded-2xl mb-3">
                    <label class="block w-full cursor-pointer border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-4 text-center hover:border-primary-400 transition">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Ganti gambar utama</p>
                        <input type="file" name="gambar_utama" accept="image/*" class="hidden"
                               @change="preview = URL.createObjectURL($event.target.files[0])">
                    </label>
                </div>

                {{-- Galeri Gambar --}}
                @if($product->images->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 pb-3 border-b border-gray-100 dark:border-gray-700">🖼️ Galeri Saat Ini</h3>
                    <div class="grid grid-cols-3 gap-2 mb-3">
                        @foreach($product->images as $image)
                        <div class="relative group">
                            <img src="{{ $image->gambar_url }}" class="w-full aspect-square object-cover rounded-xl">
                            <form method="POST" action="{{ route('admin.products.image.destroy', [$product, $image]) }}"
                                  onsubmit="return confirm('Hapus gambar ini?')"
                                  class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition rounded-xl">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-xs font-bold">✕</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Tambah Galeri --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-3 pb-3 border-b border-gray-100 dark:border-gray-700">➕ Tambah Galeri</h3>
                    <label class="block w-full cursor-pointer border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-xl p-5 text-center hover:border-primary-400 transition">
                        <div class="text-2xl mb-1">📸</div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Pilih gambar baru</p>
                        <input type="file" name="galeri_gambar[]" accept="image/*" multiple class="hidden">
                    </label>
                </div>

                {{-- Settings --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-5 pb-3 border-b border-gray-100 dark:border-gray-700">⚙️ Pengaturan</h3>
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'is_active',      'label' => 'Produk Aktif',       'desc' => 'Tampilkan di website'],
                            ['name' => 'is_featured',    'label' => '⭐ Produk Unggulan',  'desc' => 'Tampilkan di beranda'],
                            ['name' => 'is_best_seller', 'label' => '🔥 Best Seller',      'desc' => 'Badge best seller'],
                        ] as $toggle)
                        <label class="flex items-center justify-between gap-3 cursor-pointer">
                            <div>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $toggle['label'] }}</p>
                                <p class="text-xs text-gray-400">{{ $toggle['desc'] }}</p>
                            </div>
                            <div class="relative" x-data="{ checked: {{ old($toggle['name'], $product->{$toggle['name']}) ? 'true' : 'false' }} }">
                                <input type="hidden" name="{{ $toggle['name'] }}" :value="checked ? '1' : '0'">
                                <button type="button" @click="checked = !checked"
                                        :class="checked ? 'bg-primary-600' : 'bg-gray-200 dark:bg-gray-600'"
                                        class="w-11 h-6 rounded-full transition-colors relative flex-shrink-0">
                                    <span :class="checked ? 'translate-x-5' : 'translate-x-1'"
                                          class="absolute top-1 left-0 w-4 h-4 bg-white rounded-full shadow transition-transform"></span>
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
                        Update Produk
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
