<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->decimal('harga', 12, 2);
            $table->decimal('harga_diskon', 12, 2)->nullable();
            $table->longText('deskripsi');
            $table->string('berat')->nullable()->comment('contoh: 500g, 1kg');
            $table->string('isi_produk')->nullable()->comment('contoh: 10 pcs, 1 pack');
            $table->integer('stok')->default(0);
            $table->string('gambar_utama')->nullable();
            $table->string('link_tokopedia')->nullable();
            $table->string('link_shopee')->nullable();
            $table->string('link_gofood')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_seller')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('klik_whatsapp')->default(0);
            $table->integer('total_views')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'is_featured']);
            $table->index(['is_active', 'is_best_seller']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
