<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'nama'           => 'Siti Rahayu',
                'asal'           => 'Jakarta Selatan',
                'isi_testimoni'  => 'Bakso sapi jumbonya enak banget! Sudah pesan berkali-kali dan selalu puas. Pengiriman juga cepat dan produk tiba dalam kondisi beku sempurna. Highly recommended!',
                'rating'         => 5,
                'urutan'         => 1,
            ],
            [
                'nama'           => 'Budi Santoso',
                'asal'           => 'Tangerang Selatan',
                'isi_testimoni'  => 'Nugget ayam crispynya juara! Anak-anak saya suka banget. Harganya juga terjangkau untuk kualitas segini. Warung Mak Kei jadi langganan keluarga kami.',
                'rating'         => 5,
                'urutan'         => 2,
            ],
            [
                'nama'           => 'Dewi Kusuma',
                'asal'           => 'Shopee Buyer',
                'isi_testimoni'  => 'Beli lewat Shopee, packing rapih dan produk masih beku saat sampai. Dimsum ayam udangnya enak banget, bikin nagih. Pasti beli lagi!',
                'rating'         => 4,
                'urutan'         => 3,
            ],
            [
                'nama'           => 'Ahmad Fauzi',
                'asal'           => 'Bekasi',
                'isi_testimoni'  => 'Sosis sapi premiumnya beda dari yang lain, rasanya lebih gurih dan juicy. Pelayanannya ramah, respon cepat via WhatsApp. Stok selalu tersedia!',
                'rating'         => 5,
                'urutan'         => 4,
            ],
            [
                'nama'           => 'Rina Marlina',
                'asal'           => 'Tokopedia Buyer',
                'isi_testimoni'  => 'Sudah langganan 6 bulan. Kualitas produk konsisten dan harga stabil. Cheese stick mozarellanya favorit keluarga. Terima kasih Warung Mak Kei!',
                'rating'         => 5,
                'urutan'         => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
