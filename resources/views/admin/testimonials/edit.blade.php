@extends('layouts.admin')

@section('title', 'Edit Testimoni')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.testimonials.index') }}"
           class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Edit Testimoni</h2>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6 space-y-5">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $testimonial->nama) }}" required
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Asal</label>
                    <input type="text" name="asal" value="{{ old('asal', $testimonial->asal) }}"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Rating</label>
                <div x-data="{ rating: {{ old('rating', $testimonial->rating) }} }" class="flex gap-2 items-center">
                    <input type="hidden" name="rating" :value="rating">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" @click="rating = {{ $i }}"
                            :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'"
                            class="text-3xl leading-none transition-colors hover:text-yellow-400">★</button>
                    @endfor
                    <span x-text="rating + '/5'" class="text-sm text-gray-500 dark:text-gray-400 ml-2"></span>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Isi Testimoni <span class="text-red-500">*</span></label>
                <textarea name="isi_testimoni" rows="4" required
                          class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition resize-none">{{ old('isi_testimoni', $testimonial->isi_testimoni) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Ganti Foto</label>
                    @if($testimonial->foto)
                    <img src="{{ $testimonial->foto_url }}" class="w-16 h-16 rounded-xl object-cover mb-2">
                    @endif
                    <input type="file" name="foto" accept="image/*"
                           class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-600 dark:text-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $testimonial->urutan) }}" min="0"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Status</label>
                <div x-data="{ checked: {{ $testimonial->is_active ? 'true' : 'false' }} }" class="flex items-center gap-3">
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

            <div class="flex gap-3 pt-2">
                <a href="{{ route('admin.testimonials.index') }}"
                   class="flex-1 text-center py-3 border-2 border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">Batal</a>
                <button type="submit"
                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-sm">Update Testimoni</button>
            </div>
        </div>
    </form>
</div>
@endsection
