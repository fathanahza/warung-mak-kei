<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_produk',
        'slug',
        'harga',
        'harga_diskon',
        'deskripsi',
        'berat',
        'isi_produk',
        'stok',
        'gambar_utama',
        'link_tokopedia',
        'link_shopee',
        'link_gofood',
        'is_featured',
        'is_best_seller',
        'is_active',
        'klik_whatsapp',
        'total_views',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'harga'         => 'decimal:2',
        'harga_diskon'  => 'decimal:2',
        'is_featured'   => 'boolean',
        'is_best_seller'=> 'boolean',
        'is_active'     => 'boolean',
        'stok'          => 'integer',
    ];

    // Auto generate slug
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->nama_produk);
            }
        });
    }

    // ─── Relasi ───────────────────────────────────────────────
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('urutan');
    }

    public function whatsappClicks(): HasMany
    {
        return $this->hasMany(WhatsappClick::class);
    }

    // ─── Scopes ───────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeBestSeller($query)
    {
        return $query->where('is_best_seller', true)->where('is_active', true);
    }

    public function scopePromo($query)
    {
        return $query->whereNotNull('harga_diskon')->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stok', '>', 0);
    }

    public function scopeSearch($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_produk', 'like', "%{$keyword}%")
              ->orWhere('deskripsi', 'like', "%{$keyword}%");
        });
    }

    // ─── Accessors ────────────────────────────────────────────
    public function getGambarUtamaUrlAttribute(): string
    {
        if ($this->gambar_utama && Storage::disk('public')->exists($this->gambar_utama)) {
            return Storage::url($this->gambar_utama);
        }
        return asset('images/placeholder-product.jpg');
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getHargaDiskonFormatAttribute(): ?string
    {
        if ($this->harga_diskon) {
            return 'Rp ' . number_format($this->harga_diskon, 0, ',', '.');
        }
        return null;
    }

    public function getPersentaseDiskonAttribute(): ?int
    {
        if ($this->harga_diskon && $this->harga > 0) {
            return (int) round((($this->harga - $this->harga_diskon) / $this->harga) * 100);
        }
        return null;
    }

    public function getHargaAktifAttribute(): float
    {
        return $this->harga_diskon ?? $this->harga;
    }

    public function getIsPromoAttribute(): bool
    {
        return !is_null($this->harga_diskon) && $this->harga_diskon < $this->harga;
    }

    public function getIsStokHabisAttribute(): bool
    {
        return $this->stok <= 0;
    }

    public function getUrlAttribute(): string
    {
        return route('products.show', $this->slug);
    }

    public function getWhatsappPesanAttribute(): string
    {
        $pesan = "Halo Warung Mak Kei, saya ingin memesan produk {$this->nama_produk}.";
        return urlencode($pesan);
    }

    public function getWhatsappUrlAttribute(): string
    {
        $nomorWa = setting('nomor_whatsapp', '6281234567890');
        return "https://wa.me/{$nomorWa}?text={$this->whatsapp_pesan}";
    }
}
