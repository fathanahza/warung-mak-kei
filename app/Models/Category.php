<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'slug',
        'icon',
        'warna',
        'deskripsi',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto-generate slug saat membuat kategori
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->nama_kategori);
            }
        });
    }

    // Relasi ke Products
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Scope hanya kategori aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    // Accessor: jumlah produk aktif
    public function getJumlahProdukAttribute(): int
    {
        return $this->products()->where('is_active', true)->count();
    }

    // URL kategori
    public function getUrlAttribute(): string
    {
        return route('products.index', ['kategori' => $this->slug]);
    }
}
