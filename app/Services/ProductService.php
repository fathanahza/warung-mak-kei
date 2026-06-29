<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct(
        private readonly ImageService $imageService
    ) {}

    /**
     * Buat produk baru beserta gambar-gambarnya.
     */
    public function create(array $data): Product
    {
        $data['slug'] = $this->generateSlug($data['nama_produk']);

        // Upload gambar utama
        if (isset($data['gambar_utama']) && $data['gambar_utama'] instanceof UploadedFile) {
            $data['gambar_utama'] = $this->imageService->upload($data['gambar_utama'], 'products');
        }

        $product = Product::create($data);

        // Upload galeri gambar
        if (isset($data['galeri_gambar']) && is_array($data['galeri_gambar'])) {
            $this->uploadGallery($product, $data['galeri_gambar']);
        }

        return $product;
    }

    /**
     * Update produk.
     */
    public function update(Product $product, array $data): Product
    {
        // Update slug jika nama berubah
        if ($data['nama_produk'] !== $product->nama_produk) {
            $data['slug'] = $this->generateSlug($data['nama_produk'], $product->id);
        }

        // Ganti gambar utama jika ada upload baru
        if (isset($data['gambar_utama']) && $data['gambar_utama'] instanceof UploadedFile) {
            $this->imageService->delete($product->gambar_utama);
            $data['gambar_utama'] = $this->imageService->upload($data['gambar_utama'], 'products');
        }

        $product->update($data);

        // Upload galeri gambar baru
        if (isset($data['galeri_gambar']) && is_array($data['galeri_gambar'])) {
            $this->uploadGallery($product, $data['galeri_gambar']);
        }

        return $product;
    }

    /**
     * Hapus produk beserta gambar-gambarnya.
     */
    public function delete(Product $product): void
    {
        // Hapus gambar utama
        $this->imageService->delete($product->gambar_utama);

        // Hapus semua gambar galeri
        foreach ($product->images as $image) {
            $this->imageService->delete($image->gambar);
        }

        $product->delete();
    }

    /**
     * Upload gambar galeri ke product_images.
     */
    private function uploadGallery(Product $product, array $files): void
    {
        $urutan = $product->images()->max('urutan') ?? 0;

        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $path = $this->imageService->upload($file, 'products/gallery');
                ProductImage::create([
                    'product_id' => $product->id,
                    'gambar'     => $path,
                    'alt_text'   => $product->nama_produk,
                    'urutan'     => ++$urutan,
                ]);
            }
        }
    }

    /**
     * Generate slug unik.
     */
    private function generateSlug(string $name, ?int $excludeId = null): string
    {
        $slug  = Str::slug($name);
        $count = 0;

        while (true) {
            $candidate = $count === 0 ? $slug : $slug . '-' . $count;
            $query     = Product::where('slug', $candidate);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                return $candidate;
            }
            $count++;
        }
    }
}
