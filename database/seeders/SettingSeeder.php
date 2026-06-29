<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── General ─────────────────────────────────────────
            ['key' => 'nama_toko',         'value' => 'Warung Mak Kei',       'group' => 'general', 'tipe' => 'text',     'label' => 'Nama Toko'],
            ['key' => 'tagline',           'value' => 'Frozen Food Berkualitas, Praktis dan Lezat', 'group' => 'general', 'tipe' => 'text', 'label' => 'Tagline'],
            ['key' => 'deskripsi_toko',    'value' => 'Warung Mak Kei menyediakan berbagai frozen food dan camilan berkualitas dengan harga terjangkau.',  'group' => 'general', 'tipe' => 'textarea', 'label' => 'Deskripsi Toko'],
            ['key' => 'logo',              'value' => null,                   'group' => 'general', 'tipe' => 'image',    'label' => 'Logo Toko'],
            ['key' => 'favicon',           'value' => null,                   'group' => 'general', 'tipe' => 'image',    'label' => 'Favicon'],

            // ── Kontak ──────────────────────────────────────────
            ['key' => 'nomor_whatsapp',    'value' => '6281234567890',        'group' => 'kontak',  'tipe' => 'text',     'label' => 'Nomor WhatsApp'],
            ['key' => 'email',             'value' => 'warungmakkei@gmail.com','group' => 'kontak', 'tipe' => 'text',     'label' => 'Email'],
            ['key' => 'instagram',         'value' => '@warungmakkei',        'group' => 'kontak',  'tipe' => 'text',     'label' => 'Instagram'],
            ['key' => 'alamat',            'value' => 'Jl. Raya Serpong No. 88, Tangerang Selatan, Banten 15310', 'group' => 'kontak', 'tipe' => 'textarea', 'label' => 'Alamat'],
            ['key' => 'google_maps_embed', 'value' => 'https://maps.google.com/maps?q=tangerang+selatan&t=&z=13&ie=UTF8&iwloc=&output=embed', 'group' => 'kontak', 'tipe' => 'text', 'label' => 'Google Maps Embed URL'],

            // ── Jam Operasional ─────────────────────────────────
            ['key' => 'jam_buka',          'value' => '08:00',                'group' => 'operasional', 'tipe' => 'text', 'label' => 'Jam Buka'],
            ['key' => 'jam_tutup',         'value' => '21:00',                'group' => 'operasional', 'tipe' => 'text', 'label' => 'Jam Tutup'],
            ['key' => 'hari_operasional',  'value' => 'Senin – Minggu',       'group' => 'operasional', 'tipe' => 'text', 'label' => 'Hari Operasional'],

            // ── SEO ─────────────────────────────────────────────
            ['key' => 'meta_title',        'value' => 'Warung Mak Kei – Frozen Food Berkualitas',  'group' => 'seo', 'tipe' => 'text',     'label' => 'Meta Title'],
            ['key' => 'meta_description',  'value' => 'Warung Mak Kei menjual aneka frozen food dan camilan berkualitas: bakso, nugget, sosis, dimsum, dan lainnya. Pesan via WhatsApp, Tokopedia, Shopee!', 'group' => 'seo', 'tipe' => 'textarea', 'label' => 'Meta Description'],
            ['key' => 'og_image',          'value' => null,                   'group' => 'seo',    'tipe' => 'image',    'label' => 'Open Graph Image'],
            ['key' => 'google_analytics',  'value' => null,                   'group' => 'seo',    'tipe' => 'text',     'label' => 'Google Analytics ID'],

            // ── Platform Belanja ────────────────────────────────
            ['key' => 'link_tokopedia',    'value' => 'https://tokopedia.com/warungmakkei', 'group' => 'platform', 'tipe' => 'text', 'label' => 'Link Tokopedia'],
            ['key' => 'link_shopee',       'value' => 'https://shopee.co.id/warungmakkei',  'group' => 'platform', 'tipe' => 'text', 'label' => 'Link Shopee'],
            ['key' => 'link_gofood',       'value' => 'https://gofood.co.id',               'group' => 'platform', 'tipe' => 'text', 'label' => 'Link GoFood'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
