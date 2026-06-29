@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.categories.index') }}"
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Tambah Kategori</h2>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required
                       placeholder="cth: Bakso, Nugget, Sosis..."
                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('nama_kategori') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                @error('nama_kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Icon (Emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', '🍱') }}"
                           placeholder="cth: 🍢 🍗 🌭"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Warna <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="warna" value="{{ old('warna', '#16a34a') }}"
                               class="w-12 h-12 rounded-xl border border-gray-200 dark:border-gray-600 cursor-pointer bg-transparent">
                        <input type="text" id="warnaText" value="{{ old('warna', '#16a34a') }}"
                               class="flex-1 px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm outline-none dark:text-white"
                               readonly>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          placeholder="Deskripsi singkat kategori..."
                          class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white dark:placeholder-gray-400 transition resize-none">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Urutan</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                <p class="text-xs text-gray-400 mt-1">Angka lebih kecil = tampil lebih awal</p>
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.categories.index') }}"
                   class="flex-1 text-center py-3 border-2 border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm">
                    Simpan Kategori
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const colorInput = document.querySelector('input[type=color]');
    const textInput  = document.getElementById('warnaText');
    colorInput.addEventListener('input', e => textInput.value = e.target.value);
</script>
@endpush
@endsection
