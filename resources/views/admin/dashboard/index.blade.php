@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        @foreach([
            ['label' => 'Total Produk',         'value' => $totalProduk,           'icon' => '📦', 'color' => 'blue'],
            ['label' => 'Total Kategori',        'value' => $totalKategori,         'icon' => '🏷️', 'color' => 'purple'],
            ['label' => 'Klik WhatsApp',         'value' => $totalKlikWa,           'icon' => '💬', 'color' => 'green'],
            ['label' => 'Pesan Baru',            'value' => $pesanBaru,             'icon' => '📧', 'color' => 'red'],
            ['label' => 'Pengunjung Hari Ini',   'value' => $pengunjungHariIni,     'icon' => '👀', 'color' => 'orange'],
            ['label' => 'Pengunjung Bulan Ini',  'value' => $pengunjungBulanIni,    'icon' => '📈', 'color' => 'teal'],
        ] as $stat)
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow">
            <div class="text-2xl mb-3">{{ $stat['icon'] }}</div>
            <p class="text-2xl font-black text-gray-900 dark:text-white">{{ number_format($stat['value']) }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium">{{ $stat['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Klik WA Chart --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <h3 class="font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                <span>💬</span> Klik WhatsApp (7 Hari)
            </h3>
            <canvas id="waChart" height="200"></canvas>
        </div>

        {{-- Visitor Chart --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm">
            <h3 class="font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                <span>👀</span> Pengunjung Unik (7 Hari)
            </h3>
            <canvas id="visitorChart" height="200"></canvas>
        </div>
    </div>

    {{-- Bottom Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Produk Terlaris --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 dark:text-white">🔥 Produk Terlaris</h3>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-primary-600 dark:text-primary-400 font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-700/50">
                @forelse($produkTerlaris as $i => $product)
                <div class="flex items-center gap-3 px-6 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                    <span class="w-6 h-6 rounded-full {{ $i < 3 ? 'bg-primary-100 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400' : 'bg-gray-100 dark:bg-gray-700 text-gray-500' }} flex items-center justify-center text-xs font-black flex-shrink-0">{{ $i + 1 }}</span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ $product->nama_produk }}</p>
                        <p class="text-xs text-gray-400">{{ $product->category->nama_kategori }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-primary-600 dark:text-primary-400">{{ number_format($product->klik_whatsapp) }}x</p>
                        <p class="text-xs text-gray-400">klik WA</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-400 px-6 py-8 text-center">Belum ada data</p>
                @endforelse
            </div>
        </div>

        {{-- Pesan Terbaru --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 dark:text-white">📧 Pesan Terbaru</h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs text-primary-600 dark:text-primary-400 font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50 dark:divide-gray-700/50">
                @forelse($pesanTerbaru as $pesan)
                <a href="{{ route('admin.contacts.show', $pesan) }}"
                   class="flex items-start gap-3 px-6 py-3.5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                    <div class="w-8 h-8 bg-primary-100 dark:bg-primary-900/40 rounded-full flex items-center justify-center text-sm font-bold text-primary-600 dark:text-primary-400 flex-shrink-0 mt-0.5">
                        {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ $pesan->nama }}</p>
                            @if($pesan->status === 'baru')
                            <span class="flex-shrink-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 truncate">{{ Str::limit($pesan->pesan, 50) }}</p>
                    </div>
                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $pesan->created_at->diffForHumans() }}</span>
                </a>
                @empty
                <p class="text-sm text-gray-400 px-6 py-8 text-center">Belum ada pesan masuk</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const isDark = document.documentElement.classList.contains('dark');
    const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.05)';
    const textColor = isDark ? '#9CA3AF' : '#6B7280';

    // Prepare labels (last 7 days)
    const labels = [];
    for (let i = 6; i >= 0; i--) {
        const d = new Date();
        d.setDate(d.getDate() - i);
        labels.push(d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' }));
    }

    const waRaw   = @json($klikWaChart);
    const visRaw  = @json($pengunjungChart);

    function buildData(raw) {
        return labels.map((_, i) => {
            const d = new Date();
            d.setDate(d.getDate() - (6 - i));
            const key = d.toISOString().split('T')[0];
            return raw[key] ?? 0;
        });
    }

    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: gridColor }, ticks: { color: textColor, font: { size: 11 } } },
            y: { grid: { color: gridColor }, ticks: { color: textColor, font: { size: 11 }, stepSize: 1 }, beginAtZero: true }
        }
    };

    new Chart(document.getElementById('waChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{ data: buildData(waRaw), backgroundColor: 'rgba(22, 163, 74, 0.8)', borderRadius: 8, borderSkipped: false }]
        },
        options: defaultOptions
    });

    new Chart(document.getElementById('visitorChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                data: buildData(visRaw),
                borderColor: '#f97316',
                backgroundColor: 'rgba(249,115,22,0.1)',
                borderWidth: 2.5,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#f97316',
                pointRadius: 4
            }]
        },
        options: defaultOptions
    });
</script>
@endpush
