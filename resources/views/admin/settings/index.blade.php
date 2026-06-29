@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <h2 class="text-xl font-black text-gray-900 dark:text-white">⚙️ Pengaturan Website</h2>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach($settings as $group => $groupSettings)
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <h3 class="font-bold text-gray-900 dark:text-white capitalize">
                    {{ match($group) {
                        'general' => '🏠 Informasi Umum',
                        'kontak'  => '📞 Kontak',
                        'operasional' => '🕐 Jam Operasional',
                        'seo'     => '🔍 SEO',
                        'platform' => '🛒 Platform Belanja',
                        default   => ucfirst($group),
                    } }}
                </h3>
            </div>
            <div class="p-6 space-y-5">
                @foreach($groupSettings as $setting)
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5">
                        {{ $setting->label ?? $setting->key }}
                    </label>

                    @if($setting->tipe === 'textarea')
                    <textarea name="{{ $setting->key }}" rows="3"
                              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition resize-none">{{ $setting->value }}</textarea>

                    @elseif($setting->tipe === 'image')
                    <div class="space-y-2">
                        @if($setting->value)
                        <img src="{{ Storage::url($setting->value) }}" class="h-16 rounded-xl object-cover" alt="">
                        @endif
                        <input type="file" name="{{ $setting->key }}" accept="image/*"
                               class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm text-gray-600 dark:text-gray-300">
                    </div>

                    @elseif($setting->tipe === 'boolean')
                    <div x-data="{ checked: {{ $setting->value ? 'true' : 'false' }} }">
                        <input type="hidden" name="{{ $setting->key }}" :value="checked ? '1' : '0'">
                        <button type="button" @click="checked = !checked"
                                :class="checked ? 'bg-primary-600' : 'bg-gray-200 dark:bg-gray-600'"
                                class="w-11 h-6 rounded-full transition-colors relative">
                            <span :class="checked ? 'translate-x-5' : 'translate-x-1'"
                                  class="absolute top-1 left-0 w-4 h-4 bg-white rounded-full shadow transition-transform"></span>
                        </button>
                    </div>

                    @else
                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 outline-none dark:text-white transition">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="sticky bottom-0 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm border-t border-gray-100 dark:border-gray-700 py-4 flex justify-end">
            <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-xl transition shadow-lg hover:shadow-xl">
                Simpan Semua Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
