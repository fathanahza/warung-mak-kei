@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-gray-900 dark:text-white">Pesan Masuk</h2>
            @if($totalBaru > 0)
            <p class="text-sm text-red-500 font-medium mt-0.5">{{ $totalBaru }} pesan baru belum dibaca</p>
            @endif
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="flex gap-2 flex-wrap">
            @foreach(['' => 'Semua', 'baru' => 'Baru', 'dibaca' => 'Dibaca', 'dibalas' => 'Dibalas'] as $val => $label)
            <a href="{{ route('admin.contacts.index', $val ? ['status' => $val] : []) }}"
               class="px-4 py-2 rounded-xl text-sm font-semibold transition
                      {{ request('status', '') === $val ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                {{ $label }}
                @if($val === 'baru' && $totalBaru > 0)
                <span class="ml-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $totalBaru }}</span>
                @endif
            </a>
            @endforeach
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Pengirim</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Pesan</th>
                        <th class="text-center px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Status</th>
                        <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Waktu</th>
                        <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition {{ $msg->status === 'baru' ? 'font-semibold' : '' }}">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2.5">
                                @if($msg->status === 'baru')
                                <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0"></span>
                                @endif
                                <div>
                                    <p class="text-gray-900 dark:text-white font-semibold">{{ $msg->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $msg->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-gray-600 dark:text-gray-300 max-w-xs">
                            <p class="truncate text-sm">{{ $msg->pesan }}</p>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full
                                {{ $msg->status === 'baru' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400' :
                                   ($msg->status === 'dibaca' ? 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400' :
                                   'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400') }}">
                                {{ ucfirst($msg->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right text-xs text-gray-400">{{ $msg->created_at->diffForHumans() }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.contacts.show', $msg) }}"
                                   class="p-2 text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $msg) }}"
                                      onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-16 text-gray-400">
                            <div class="text-5xl mb-3">📭</div>
                            <p>Belum ada pesan masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
            {{ $messages->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
