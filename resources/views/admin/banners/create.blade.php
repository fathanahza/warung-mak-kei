@extends('layouts.admin')

@section('title', 'Tambah Banner')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.banners.index') }}"
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Tambah Banner</h2>
    </div>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6 space-y-5">

            {{-- Preview Gambar --}}
            <div x-data="{ preview: null }">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Gambar Banner <span class="text-red-500">*</span></label>
                <label class="block cursor-pointer">
                    <div x-show="!preview"
                         class="border-2 border-dashed border-gray-200 dark:border-gray-600 rounded-2xl p-8 text-center hover:border-primary-400 transition">
                        <div class="text-4xl mb-2">🖼️</div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Klik untuk upload banner</p>
                        <p class="text-xs text-gray-400 mt-1">Rekomendasi: 1200×450px · Maks 3MB</p>
                    </div>
                    <img x-show="preview" x-cloak :src="preview"
                         class="w-full aspect-video object-cover rounded-2xl mb-2">
                    <input type="file" name="gambar" accept="image/*" required class="hidden"
                           @change="preview = URL.createObjectURL($event.target.files[0])">
                </label>
                @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Judul Banner <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" required
                       placeholder="cth: Promo Akhir Bulan"
                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('judul') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="2"
                          placeholder="Teks pendek yang muncul di bawah judul..."
                          class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white dark:placeholder-gray-400 transition resize-none">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Link Tujuan</label>
                    <input type="url" name="link" value="{{ old('link') }}"
                           placeholder="https://..."
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Teks Tombol</label>
                    <input type="text" name="teks_tombol" value="{{ old('teks_tombol') }}"
                           placeholder="cth: Belanja Sekarang"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Status</label>
                    <div x-data="{ checked: true }" class="flex items-center gap-3 h-[50px]">
                        <input type="hidden" name="is_active" :value="checked ? '1' : '0'">
                        <button type="button" @click="checked = !checked"
                                :class="checked ? 'bg-primary-600' : 'bg-gray-200 dark:bg-gray-600'"
                                class="w-11 h-6 rounded-full transition-colors relative">
                            <span :class="checked ? 'translate-x-5' : 'translate-x-1'"
                                  class="absolute top-1 left-0 w-4 h-4 bg-white rounded-full shadow transition-transform"></span>
                        </button>
                        <span x-text="checked ? 'Aktif' : 'Nonaktif'" class="text-sm font-medium text-gray-600 dark:text-gray-300"></span>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.banners.index') }}"
                   class="flex-1 text-center py-3 border-2 border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm">
                    Simpan Banner
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
