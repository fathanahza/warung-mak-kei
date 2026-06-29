<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            BannerSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            SettingSeeder::class,
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('👤 Admin: admin@warungmakkei.com | password: password');
    }
}
