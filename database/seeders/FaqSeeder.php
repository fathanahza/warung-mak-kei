<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'pertanyaan' => 'Bagaimana cara memesan produk dari Warung Mak Kei?',
                'jawaban'    => 'Anda dapat memesan melalui beberapa cara: (1) WhatsApp langsung dengan menekan tombol "Pesan via WhatsApp" pada halaman produk, (2) Tokopedia melalui tombol "Beli di Tokopedia", (3) Shopee melalui tombol "Beli di Shopee", atau (4) GoFood untuk area tertentu. Tim kami siap membantu Anda 24 jam.',
                'urutan'     => 1,
            ],
            [
                'pertanyaan' => 'Apakah produk frozen food aman untuk dikonsumsi?',
                'jawaban'    => 'Ya, semua produk kami telah melalui proses quality control yang ketat. Kami menggunakan bahan-bahan berkualitas tinggi tanpa pengawet berbahaya. Produk disimpan pada suhu -18°C untuk menjaga kesegaran dan kualitas.',
                'urutan'     => 2,
            ],
            [
                'pertanyaan' => 'Berapa lama produk bisa disimpan di freezer?',
                'jawaban'    => 'Produk frozen food kami dapat bertahan hingga 3-6 bulan jika disimpan dengan benar di freezer pada suhu -18°C atau lebih dingin. Pastikan produk tidak dibuka sebelum dikonsumsi untuk menjaga kualitasnya.',
                'urutan'     => 3,
            ],
            [
                'pertanyaan' => 'Apakah tersedia layanan pengiriman ke luar kota?',
                'jawaban'    => 'Ya, kami melayani pengiriman ke seluruh Indonesia melalui platform Tokopedia dan Shopee dengan menggunakan jasa pengiriman yang terpercaya dan dilengkapi packing es batu (dry ice) untuk menjaga produk tetap beku selama pengiriman.',
                'urutan'     => 4,
            ],
            [
                'pertanyaan' => 'Bagaimana cara memasak produk frozen food dengan benar?',
                'jawaban'    => 'Untuk mendapatkan hasil terbaik: (1) Jangan mencairkan produk sebelum dimasak kecuali disarankan, (2) Goreng dengan minyak panas yang cukup, (3) Kukus dengan api sedang sesuai waktu yang tertera pada kemasan, (4) Panaskan oven pada suhu 180°C untuk produk yang dipanggang. Ikuti petunjuk pada kemasan untuk hasil optimal.',
                'urutan'     => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
