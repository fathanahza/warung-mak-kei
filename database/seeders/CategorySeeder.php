<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Bakso',
                'slug'          => 'bakso',
                'icon'          => '🍢',
                'warna'         => '#ef4444',
                'deskripsi'     => 'Aneka produk bakso segar dan berkualitas',
                'urutan'        => 1,
            ],
            [
                'nama_kategori' => 'Nugget',
                'slug'          => 'nugget',
                'icon'          => '🍗',
                'warna'         => '#f97316',
                'deskripsi'     => 'Nugget ayam, ikan, dan varian lainnya',
                'urutan'        => 2,
            ],
            [
                'nama_kategori' => 'Sosis',
                'slug'          => 'sosis',
                'icon'          => '🌭',
                'warna'         => '#eab308',
                'deskripsi'     => 'Sosis sapi, ayam, dan campuran premium',
                'urutan'        => 3,
            ],
            [
                'nama_kategori' => 'Frozen Food',
                'slug'          => 'frozen-food',
                'icon'          => '❄️',
                'warna'         => '#3b82f6',
                'deskripsi'     => 'Berbagai produk frozen food pilihan',
                'urutan'        => 4,
            ],
            [
                'nama_kategori' => 'Camilan',
                'slug'          => 'camilan',
                'icon'          => '🍟',
                'warna'         => '#8b5cf6',
                'deskripsi'     => 'Camilan lezat untuk menemani hari-hari kamu',
                'urutan'        => 5,
            ],
            [
                'nama_kategori' => 'Promo',
                'slug'          => 'promo',
                'icon'          => '🏷️',
                'warna'         => '#16a34a',
                'deskripsi'     => 'Produk dengan harga spesial dan diskon menarik',
                'urutan'        => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
