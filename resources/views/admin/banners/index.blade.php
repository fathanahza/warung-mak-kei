@extends('layouts.admin')

@section('title', 'Banner Promosi')

@section('content')
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Banner Promosi</h2>
        <a href="{{ route('admin.banners.create') }}"
           class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Banner
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($banners as $banner)
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="relative aspect-video bg-gray-100 dark:bg-gray-700">
                <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul }}"
                     class="w-full h-full object-cover">
                <div class="absolute top-2 right-2">
                    <form method="POST" action="{{ route('admin.banners.toggle', $banner) }}">
                        @csrf
                        <button type="submit"
                                class="text-xs font-bold px-2.5 py-1 rounded-full shadow
                                       {{ $banner->is_active ? 'bg-green-500 hover:bg-green-600 text-white' : 'bg-gray-400 hover:bg-gray-500 text-white' }} transition">
                            {{ $banner->is_active ? '✓ Aktif' : '✕ Nonaktif' }}
                        </button>
                    </form>
                </div>
                <div class="absolute bottom-2 left-2 bg-black/60 text-white text-xs px-2 py-0.5 rounded-lg">
                    Urutan: {{ $banner->urutan }}
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-900 dark:text-white text-sm truncate mb-1">{{ $banner->judul }}</h3>
                @if($banner->deskripsi)
                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mb-2">{{ $banner->deskripsi }}</p>
                @endif
                @if($banner->teks_tombol)
                <span class="inline-block text-xs bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 px-2 py-0.5 rounded-full font-medium">
                    CTA: {{ $banner->teks_tombol }}
                </span>
                @endif
            </div>
            <div class="px-4 pb-4 flex gap-2">
                <a href="{{ route('admin.banners.edit', $banner) }}"
                   class="flex-1 text-center py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold text-xs rounded-xl hover:bg-blue-100 transition">
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}"
                      onsubmit="return confirm('Hapus banner ini?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full py-2 bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 font-semibold text-xs rounded-xl hover:bg-red-100 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <div class="text-5xl mb-3">🖼️</div>
            <p>Belum ada banner. Tambahkan banner promosi pertama!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
