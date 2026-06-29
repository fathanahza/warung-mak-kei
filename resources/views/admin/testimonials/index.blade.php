@extends('layouts.admin')

@section('title', 'Testimoni Pelanggan')

@section('content')
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Testimoni Pelanggan</h2>
        <a href="{{ route('admin.testimonials.create') }}"
           class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Testimoni
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($testimonials as $testimoni)
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-5">
            <div class="flex items-start gap-3 mb-3">
                <img src="{{ $testimoni->foto_url }}" alt="{{ $testimoni->nama }}"
                     class="w-11 h-11 rounded-full object-cover flex-shrink-0">
                <div class="min-w-0 flex-1">
                    <p class="font-bold text-gray-900 dark:text-white text-sm truncate">{{ $testimoni->nama }}</p>
                    @if($testimoni->asal)
                    <p class="text-xs text-gray-400">{{ $testimoni->asal }}</p>
                    @endif
                    <div class="flex mt-1">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-3.5 h-3.5 {{ $i <= $testimoni->rating ? 'text-yellow-400' : 'text-gray-200 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                </div>
                <span class="flex-shrink-0 text-xs font-bold px-2 py-0.5 rounded-full {{ $testimoni->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-red-100 dark:bg-red-900/30 text-red-500' }}">
                    {{ $testimoni->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 italic line-clamp-3 mb-4">"{{ $testimoni->isi_testimoni }}"</p>
            <div class="flex gap-2">
                <a href="{{ route('admin.testimonials.edit', $testimoni) }}"
                   class="flex-1 text-center py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Edit</a>
                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimoni) }}"
                      onsubmit="return confirm('Hapus testimoni?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full py-2 bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 font-semibold text-xs rounded-xl hover:bg-red-100 transition">Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <div class="text-5xl mb-3">⭐</div>
            <p>Belum ada testimoni</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
