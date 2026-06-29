@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.contacts.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="text-xl font-black text-gray-900 dark:text-white">Detail Pesan</h2>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden mb-5">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-black text-gray-900 dark:text-white">{{ $contactMessage->nama }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $contactMessage->email }}</p>
                    @if($contactMessage->nomor_hp)
                    <a href="{{ whatsapp_url('Halo '.$contactMessage->nama.', kami dari Warung Mak Kei membalas pesan Anda.', preg_replace('/[^0-9]/', '', $contactMessage->nomor_hp)) }}"
                       target="_blank" class="text-sm text-green-600 dark:text-green-400 hover:underline font-medium">
                        📱 {{ $contactMessage->nomor_hp }}
                    </a>
                    @endif
                </div>
                <span class="flex-shrink-0 text-xs font-bold px-3 py-1.5 rounded-full
                    {{ $contactMessage->status === 'baru' ? 'bg-red-100 text-red-600' : ($contactMessage->status === 'dibaca' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600') }}">
                    {{ ucfirst($contactMessage->status) }}
                </span>
            </div>
            <p class="text-xs text-gray-400 mt-2">{{ $contactMessage->created_at->format('d F Y, H:i') }} WIB</p>
        </div>

        <div class="p-6">
            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Isi Pesan</h4>
            <p class="text-gray-700 dark:text-gray-200 leading-relaxed bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                {{ $contactMessage->pesan }}
            </p>
        </div>
    </div>

    {{-- Update Status --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Update Status</h3>
        <form method="POST" action="{{ route('admin.contacts.status', $contactMessage) }}" class="space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Status</label>
                <select name="status"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                    <option value="baru" {{ $contactMessage->status === 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="dibaca" {{ $contactMessage->status === 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                    <option value="dibalas" {{ $contactMessage->status === 'dibalas' ? 'selected' : '' }}>Dibalas</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">Catatan Admin</label>
                <textarea name="catatan_admin" rows="3"
                          class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition resize-none"
                          placeholder="Catatan internal...">{{ $contactMessage->catatan_admin }}</textarea>
            </div>
            <button type="submit"
                    class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-xl text-sm transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
