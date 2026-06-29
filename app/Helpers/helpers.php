<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Ambil nilai setting dari database.
     * Contoh: setting('nama_toko', 'Default Name')
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('rupiah')) {
    /**
     * Format angka ke format Rupiah.
     * Contoh: rupiah(25000) -> "Rp 25.000"
     */
    function rupiah(float|int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('whatsapp_url')) {
    /**
     * Generate URL WhatsApp dengan pesan.
     */
    function whatsapp_url(string $message = '', ?string $nomor = null): string
    {
        $nomor = $nomor ?? setting('nomor_whatsapp', '6281234567890');
        $pesan = urlencode($message);
        return "https://wa.me/{$nomor}?text={$pesan}";
    }
}

if (!function_exists('star_rating')) {
    /**
     * Generate HTML bintang rating.
     */
    function star_rating(int $rating, int $max = 5): string
    {
        $html = '';
        for ($i = 1; $i <= $max; $i++) {
            $class = $i <= $rating ? 'text-yellow-400' : 'text-gray-300';
            $html .= "<span class=\"{$class}\">★</span>";
        }
        return $html;
    }
}
