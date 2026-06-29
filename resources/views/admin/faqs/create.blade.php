@extends('layouts.admin')

@section('title', 'Tambah FAQ')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.faqs.index') }}"
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Tambah FAQ</h2>
    </div>

    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Pertanyaan <span class="text-red-500">*</span></label>
                <input type="text" name="pertanyaan" value="{{ old('pertanyaan') }}" required
                       placeholder="cth: Bagaimana cara memesan?"
                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('pertanyaan') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                @error('pertanyaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Jawaban <span class="text-red-500">*</span></label>
                <textarea name="jawaban" rows="5" required
                          placeholder="Tulis jawaban lengkap..."
                          class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('jawaban') border-red-400 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white dark:placeholder-gray-400 transition resize-none">{{ old('jawaban') }}</textarea>
                @error('jawaban') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Urutan</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0"
                       class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
            </div>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.faqs.index') }}"
                   class="flex-1 text-center py-3 border-2 border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">Batal</a>
                <button type="submit"
                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm">Simpan FAQ</button>
            </div>
        </div>
    </form>
</div>
@endsection
