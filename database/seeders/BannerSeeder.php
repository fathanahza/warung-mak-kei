<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'judul'       => 'Promo Akhir Bulan – Diskon 30%',
                'deskripsi'   => 'Dapatkan diskon 30% untuk semua produk bakso dan nugget. Berlaku hingga akhir bulan!',
                'gambar'      => 'banners/banner-promo.jpg',
                'link'        => '/products?kategori=promo',
                'teks_tombol' => 'Belanja Sekarang',
                'is_active'   => true,
                'urutan'      => 1,
            ],
            [
                'judul'       => 'New Arrival – Bakso Mercon Pedas',
                'deskripsi'   => 'Produk terbaru kami hadir! Bakso Mercon dengan level kepedasan yang bisa disesuaikan.',
                'gambar'      => 'banners/banner-new.jpg',
                'link'        => '/products?sort=terbaru',
                'teks_tombol' => 'Lihat Produk',
                'is_active'   => true,
                'urutan'      => 2,
            ],
            [
                'judul'       => 'Gratis Ongkir Pembelian 200rb+',
                'deskripsi'   => 'Pesan via Tokopedia & Shopee dengan minimum pembelian Rp200.000 dan dapatkan gratis ongkos kirim!',
                'gambar'      => 'banners/banner-ongkir.jpg',
                'link'        => 'https://tokopedia.com',
                'teks_tombol' => 'Pesan di Tokopedia',
                'is_active'   => true,
                'urutan'      => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
