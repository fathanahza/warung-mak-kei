<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $bakso    = Category::where('slug', 'bakso')->first();
        $nugget   = Category::where('slug', 'nugget')->first();
        $sosis    = Category::where('slug', 'sosis')->first();
        $frozen   = Category::where('slug', 'frozen-food')->first();
        $camilan  = Category::where('slug', 'camilan')->first();

        $products = [
            // ── Bakso ──────────────────────────────────────────
            [
                'category_id'   => $bakso->id,
                'nama_produk'   => 'Bakso Sapi Premium Jumbo',
                'harga'         => 35000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Bakso sapi premium dengan ukuran jumbo, terbuat dari daging sapi pilihan 100% tanpa campuran. Tekstur kenyal, gurih, dan lezat. Cocok untuk dijadikan sup bakso, mie bakso, atau dimakan langsung. Sudah beku dan siap masak.',
                'berat'         => '500g',
                'isi_produk'    => '20 pcs',
                'stok'          => 50,
                'is_featured'   => true,
                'is_best_seller'=> true,
                'link_tokopedia'=> 'https://tokopedia.com',
                'link_shopee'   => 'https://shopee.co.id',
            ],
            [
                'category_id'   => $bakso->id,
                'nama_produk'   => 'Bakso Ikan Tenggiri',
                'harga'         => 28000,
                'harga_diskon'  => 22000,
                'deskripsi'     => 'Bakso ikan tenggiri segar, dibuat dari ikan tenggiri pilihan. Rasanya gurih, kenyal, dan kaya protein. Sangat cocok untuk anak-anak. Bebas pengawet dan pewarna buatan.',
                'berat'         => '400g',
                'isi_produk'    => '25 pcs',
                'stok'          => 30,
                'is_featured'   => false,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $bakso->id,
                'nama_produk'   => 'Bakso Mercon Pedas Level 3',
                'harga'         => 32000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Bakso sapi dengan isian cabe merah dan bumbu rahasia yang bikin ketagihan. Tersedia dalam 3 level kepedasan. Cocok bagi pecinta makanan pedas!',
                'berat'         => '500g',
                'isi_produk'    => '20 pcs',
                'stok'          => 25,
                'is_featured'   => true,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $bakso->id,
                'nama_produk'   => 'Bakso Malang Isi Keju',
                'harga'         => 38000,
                'harga_diskon'  => 32000,
                'deskripsi'     => 'Bakso khas Malang dengan isian keju leleh yang melimpah. Dipadu dengan daging sapi berkualitas, menghasilkan cita rasa yang unik dan lezat.',
                'berat'         => '400g',
                'isi_produk'    => '16 pcs',
                'stok'          => 40,
                'is_featured'   => false,
                'is_best_seller'=> true,
            ],

            // ── Nugget ─────────────────────────────────────────
            [
                'category_id'   => $nugget->id,
                'nama_produk'   => 'Nugget Ayam Crispy Original',
                'harga'         => 45000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Nugget ayam dengan lapisan crispy yang renyah di luar, lembut di dalam. Terbuat dari daging ayam fillet pilihan. Cocok untuk sarapan, bekal sekolah, atau camilan keluarga.',
                'berat'         => '500g',
                'isi_produk'    => '20 pcs',
                'stok'          => 60,
                'is_featured'   => true,
                'is_best_seller'=> true,
                'link_tokopedia'=> 'https://tokopedia.com',
                'link_shopee'   => 'https://shopee.co.id',
                'link_gofood'   => 'https://gofood.co.id',
            ],
            [
                'category_id'   => $nugget->id,
                'nama_produk'   => 'Nugget Sayur Organik',
                'harga'         => 42000,
                'harga_diskon'  => 38000,
                'deskripsi'     => 'Nugget dengan campuran sayuran organik seperti wortel, brokoli, dan bayam. Cara cerdas mengenalkan sayuran kepada anak-anak. Sehat, lezat, dan bergizi.',
                'berat'         => '400g',
                'isi_produk'    => '18 pcs',
                'stok'          => 35,
                'is_featured'   => false,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $nugget->id,
                'nama_produk'   => 'Nugget Udang Tempura',
                'harga'         => 55000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Nugget udang dengan gaya tempura khas Jepang. Dibalut tepung khusus yang menghasilkan tekstur crispy sempurna. Udang segar yang dipadukan dengan bumbu tempura tradisional.',
                'berat'         => '300g',
                'isi_produk'    => '15 pcs',
                'stok'          => 20,
                'is_featured'   => true,
                'is_best_seller'=> false,
            ],

            // ── Sosis ──────────────────────────────────────────
            [
                'category_id'   => $sosis->id,
                'nama_produk'   => 'Sosis Sapi Premium',
                'harga'         => 48000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Sosis sapi premium dengan kandungan daging sapi 80%. Rasa gurih dan juicy, cocok untuk berbagai olahan. Bebas bahan pengawet berbahaya.',
                'berat'         => '500g',
                'isi_produk'    => '10 pcs',
                'stok'          => 45,
                'is_featured'   => false,
                'is_best_seller'=> true,
                'link_shopee'   => 'https://shopee.co.id',
            ],
            [
                'category_id'   => $sosis->id,
                'nama_produk'   => 'Sosis Ayam Keju',
                'harga'         => 38000,
                'harga_diskon'  => 32000,
                'deskripsi'     => 'Sosis ayam dengan isian keju cheddar yang meleleh saat dimasak. Cocok untuk anak-anak yang suka keju. Lezat dipanggang, dikukus, atau digoreng.',
                'berat'         => '400g',
                'isi_produk'    => '12 pcs',
                'stok'          => 38,
                'is_featured'   => true,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $sosis->id,
                'nama_produk'   => 'Sosis Smoked Beef BBQ',
                'harga'         => 65000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Sosis smoked beef dengan cita rasa BBQ yang kuat. Diolah dengan teknik smoking tradisional. Cocok untuk acara BBQ keluarga atau pesta kebun.',
                'berat'         => '500g',
                'isi_produk'    => '8 pcs',
                'stok'          => 15,
                'is_featured'   => false,
                'is_best_seller'=> false,
            ],

            // ── Frozen Food ────────────────────────────────────
            [
                'category_id'   => $frozen->id,
                'nama_produk'   => 'Dimsum Ayam Udang Frozen',
                'harga'         => 52000,
                'harga_diskon'  => 45000,
                'deskripsi'     => 'Dimsum siap kukus dengan isian ayam dan udang premium. Disajikan dengan saus kecap pedas. Camilan favorit keluarga yang praktis dan lezat.',
                'berat'         => '300g',
                'isi_produk'    => '20 pcs',
                'stok'          => 55,
                'is_featured'   => true,
                'is_best_seller'=> true,
                'link_tokopedia'=> 'https://tokopedia.com',
                'link_shopee'   => 'https://shopee.co.id',
                'link_gofood'   => 'https://gofood.co.id',
            ],
            [
                'category_id'   => $frozen->id,
                'nama_produk'   => 'Gyoza Jepang Isi Daging',
                'harga'         => 48000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Gyoza autentik Jepang dengan kulit tipis dan isian daging sapi dan sayuran segar. Cocok digoreng atau dikukus. Dilengkapi saus ponzu.',
                'berat'         => '250g',
                'isi_produk'    => '15 pcs',
                'stok'          => 30,
                'is_featured'   => false,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $frozen->id,
                'nama_produk'   => 'Siomay Bandung Original',
                'harga'         => 35000,
                'harga_diskon'  => 29000,
                'deskripsi'     => 'Siomay khas Bandung dengan isian ikan tenggiri segar. Disajikan dengan bumbu kacang yang gurih. Mudah dimasak, tinggal kukus selama 15 menit.',
                'berat'         => '400g',
                'isi_produk'    => '12 pcs',
                'stok'          => 42,
                'is_featured'   => false,
                'is_best_seller'=> true,
            ],
            [
                'category_id'   => $frozen->id,
                'nama_produk'   => 'Pastel Sayur Crispy',
                'harga'         => 30000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Pastel dengan kulit krispy dan isian sayuran segar. Cocok untuk camilan pagi atau sore. Tinggal goreng, sajikan panas-panas.',
                'berat'         => '350g',
                'isi_produk'    => '10 pcs',
                'stok'          => 60,
                'is_featured'   => true,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $frozen->id,
                'nama_produk'   => 'Spring Roll Vietnam',
                'harga'         => 42000,
                'harga_diskon'  => 36000,
                'deskripsi'     => 'Spring roll khas Vietnam dengan isian udang, bihun, dan sayuran segar. Kulit tipis renyah saat digoreng. Disajikan dengan saus asam manis.',
                'berat'         => '300g',
                'isi_produk'    => '12 pcs',
                'stok'          => 25,
                'is_featured'   => false,
                'is_best_seller'=> false,
            ],

            // ── Camilan ────────────────────────────────────────
            [
                'category_id'   => $camilan->id,
                'nama_produk'   => 'Kentang Goreng Spiral',
                'harga'         => 25000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Kentang goreng spiral dengan bumbu balado, BBQ, atau original. Renyah dan crispy, cocok untuk camilan keluarga. Mudah digoreng dalam 5 menit.',
                'berat'         => '500g',
                'isi_produk'    => '1 pack',
                'stok'          => 80,
                'is_featured'   => false,
                'is_best_seller'=> true,
                'link_gofood'   => 'https://gofood.co.id',
            ],
            [
                'category_id'   => $camilan->id,
                'nama_produk'   => 'Tahu Crispy Isian Daging',
                'harga'         => 22000,
                'harga_diskon'  => 18000,
                'deskripsi'     => 'Tahu crispy dengan isian daging sapi berbumbu. Kulit tahu yang garing dengan isian yang juicy. Camilan favorit yang cocok untuk segala usia.',
                'berat'         => '300g',
                'isi_produk'    => '15 pcs',
                'stok'          => 70,
                'is_featured'   => true,
                'is_best_seller'=> true,
            ],
            [
                'category_id'   => $camilan->id,
                'nama_produk'   => 'Onion Ring Crispy',
                'harga'         => 28000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Bawang bombay dibalut tepung crispy. Cocok sebagai teman makan atau camilan sore. Disajikan dengan saus mayo pedas.',
                'berat'         => '400g',
                'isi_produk'    => '1 pack',
                'stok'          => 45,
                'is_featured'   => false,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $camilan->id,
                'nama_produk'   => 'Cheese Stick Mozarella',
                'harga'         => 35000,
                'harga_diskon'  => 29000,
                'deskripsi'     => 'Mozarella cheese stick dengan lapisan crispy. Ketika digoreng, keju leleh di dalamnya. Camilan premium yang lezat untuk seluruh keluarga.',
                'berat'         => '250g',
                'isi_produk'    => '12 pcs',
                'stok'          => 35,
                'is_featured'   => true,
                'is_best_seller'=> false,
            ],
            [
                'category_id'   => $camilan->id,
                'nama_produk'   => 'Cumi Goreng Tepung Crispy',
                'harga'         => 45000,
                'harga_diskon'  => null,
                'deskripsi'     => 'Cumi segar dibalut tepung crispy spesial. Renyah di luar, empuk di dalam. Cocok sebagai teman makan nasi atau camilan sore.',
                'berat'         => '300g',
                'isi_produk'    => '1 pack',
                'stok'          => 20,
                'is_featured'   => false,
                'is_best_seller'=> true,
                'link_shopee'   => 'https://shopee.co.id',
            ],
        ];

        foreach ($products as $productData) {
            $slug = Str::slug($productData['nama_produk']);
            Product::updateOrCreate(
                ['slug' => $slug],
                array_merge($productData, [
                    'slug'            => $slug,
                    'meta_title'      => $productData['nama_produk'] . ' - Warung Mak Kei',
                    'meta_description'=> substr($productData['deskripsi'], 0, 160),
                    'is_active'       => true,
                ])
            );
        }
    }
}
