<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\VisitorLog;
use App\Models\WhatsappClick;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Statistik Utama ─────────────────────────────────────
        $totalProduk    = Product::count();
        $totalKategori  = Category::count();
        $totalKlikWa    = WhatsappClick::count();
        $pesanBaru      = ContactMessage::where('status', 'baru')->count();

        // Total pengunjung unik hari ini
        $pengunjungHariIni = VisitorLog::whereDate('created_at', today())
            ->distinct('ip_address')
            ->count('ip_address');

        // Total pengunjung bulan ini
        $pengunjungBulanIni = VisitorLog::whereMonth('created_at', now()->month)
            ->distinct('ip_address')
            ->count('ip_address');

        // ── Produk Terlaris ─────────────────────────────────────
        $produkTerlaris = Product::orderByDesc('klik_whatsapp')
            ->with('category')
            ->take(10)
            ->get();

        // ── Grafik Klik WA (7 hari terakhir) ───────────────────
        $klikWaChart = WhatsappClick::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->mapWithKeys(fn($item) => [$item->tanggal => $item->total]);

        // ── Grafik Pengunjung (7 hari terakhir) ─────────────────
        $pengunjungChart = VisitorLog::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('COUNT(DISTINCT ip_address) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->mapWithKeys(fn($item) => [$item->tanggal => $item->total]);

        // ── Pesan Terbaru ────────────────────────────────────────
        $pesanTerbaru = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalProduk',
            'totalKategori',
            'totalKlikWa',
            'pesanBaru',
            'pengunjungHariIni',
            'pengunjungBulanIni',
            'produkTerlaris',
            'klikWaChart',
            'pengunjungChart',
            'pesanTerbaru'
        ));
    }
}
